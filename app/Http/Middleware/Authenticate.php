<?php
namespace App\Http\Middleware;

use App;
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (App::environment() === 'local') {
            return $next($request);
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

        if ($customer->ip !== $request->ip()) {
            return $this->respondUnauthorised('IP address does not match');
        }

        $rateLimiter = RateLimiter::firstOrCreate([
            'customer_id' => $customer->id,
            'date'        => Carbon::today()->toDateString()
        ]);

        if ($rateLimiter->calls >= RateLimiter::DAILY_LIMIT) {
            return $this->respondTooManyRequests();
        }

        $rateLimiter->increment();

        return $next($request);
    }
}
