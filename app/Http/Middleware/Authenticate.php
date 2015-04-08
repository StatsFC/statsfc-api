<?php namespace App\Http\Middleware;

use App;
use App\Customer;
use Closure;

class Authenticate {

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
			return $this->error();
		}

		$key = $request->input('key');

		$customers = Customer::where('key', '=', $key)->get();

		if ($customers->count() !== 1) {
			return $this->error();
		}

		$customer = $customers->first();

		if ($customer->ip !== $request->ip()) {
			return $this->error();
		}

		return $next($request);
	}

	/**
	 * Trigger an HTTP error with JSON response.
	 *
	 * @param  string  $message
	 * @param  integer $code
	 * @return mixed
	 */
	private function error($message = 'Unauthorised', $code = 401)
	{
		return response(json_encode(['error' => $message]), 401)->header('Content-Type', 'application/json');
	}

}
