<?php namespace App\Http\Middleware;

use App;
use App\Customer;
use App\Http\Controllers\ApiController;
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

		if (! $request->has('key')) {
			return $this->setStatusCode(401)->respondUnauthorised('API key not provided');
		}

		$key = $request->input('key');

		$customers = Customer::where('key', $key)->get();

		if ($customers->count() !== 1) {
			return $this->setStatusCode(401)->respondUnauthorised('API key not found');
		}

		$customer = $customers->first();

		if ($customer->ip !== $request->ip()) {
			return $this->setStatusCode(401)->respondUnauthorised('IP address does not match');
		}

		return $next($request);
	}
}
