<?php
namespace App\Http\Middleware;

use App;
use App\Customer;
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

        $key = $request->header('X-Auth-Key');

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

        /*if ($customer->lastApiCall < Carbon::now()->toDateString()) {
            $customer->resetApiCallsRemaining();
            // $customer->apiCallsRemaining = 100;
            // $customer->lastApiCall       = Carbon::now()->toDateString();
        }*/

        if ($customer->apiCallsRemaining === 0) {
            return $this->respondTooManyRequests();
        }

        //$customer->decrementApiCallsRemaining();

        return $next($request);
    }
}
