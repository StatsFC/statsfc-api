<?php
namespace App\Http\Middleware;

use App;
use App\Competition;
use App\Customer;
use App\RateLimiter;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Closure;

class Authenticate extends ApiController
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (App::isDownForMaintenance()) {
            return $this->respondUnavailable('Down for maintenance. We\'ll be right back');
        }

        $key = $request->header('X-StatsFC-Key');

        if (! $key) {
            return $this->respondUnauthorised('API key not provided');
        }

        $customers = Customer::where('key', $key)->get();

        if ($customers->count() !== 1) {
            return $this->respondUnauthorised('API key not found');
        }

        $customer = $customers->first();

        if (! $this->authenticateRequestIp($request, $customer)) {
            return $this->respondUnauthorised('IP address does not match');
        }

        if ($this->hasRequestedInvalidCompetition($request, $customer)) {
            return $this->respondUnauthorised('The chosen competition is not in your API subscription');
        }

        if ($this->hasExceededRateLimit($customer)) {
            return $this->respondTooManyRequests();
        }

        // Put the customer into a session
        $request->session()->put('customer_id', $customer->id);

        return $next($request);
    }

    /**
     * Check whether the request has come from the customer's IP
     *
     * @param  Request  $request
     * @param  Customer $customer
     * @return boolean
     */
    private function authenticateRequestIp($request, $customer)
    {
        if (App::environment() === 'local') {
            return true;
        }

        if ($customer->liftIpRestriction) {
            return true;
        }

        return ($request->ip() === $customer->ip);
    }

    /**
     * Check whether the customer has requested a valid competition
     *
     * @param  Request  $request
     * @param  Customer $customer
     * @return boolean
     */
    private function hasRequestedInvalidCompetition($request, $customer)
    {
        if ($request->has('competition')) {
            $competitions = Competition::where('name', $request->input('competition'))->get();
        } elseif ($request->has('competition_id')) {
            $competitions = Competition::where('id', $request->input('competition_id'))->get();
        } elseif ($request->has('competition_key')) {
            $competitions = Competition::where('key', $request->input('competition_key'))->get();
        } else {
            return false;
        }

        if ($competitions->count() === 0) {
            return false;
        }

        $competition = $competitions->first();

        return (! in_array($competition->id, $customer->competitions('id')));
    }

    /**
     * Check whether the customer has exceeded their rate limit
     *
     * @param  Customer $customer
     * @return boolean
     */
    private function hasExceededRateLimit($customer)
    {
        if (App::environment() === 'local') {
            return false;
        }

        $rateLimiter = RateLimiter::firstOrCreate([
            'customer_id' => $customer->id,
            'date'        => Carbon::today()->toDateString()
        ]);

        if ($rateLimiter->calls >= $customer->dailyRateLimit()) {
            return true;
        }

        $rateLimiter->incrementCalls();

        return false;
    }
}
