<?php namespace App\Http\Middleware;

use App;
use App\Customer;
use Closure;

// 429 Too Many Requests (rate limiting)

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
			return $this->error('API key not provided');
		}

		$key = $request->input('key');

		$customers = Customer::where('key', '=', $key)->get();

		if ($customers->count() !== 1) {
			return $this->error('API key not found');
		}

		$customer = $customers->first();

		if ($customer->ip !== $request->ip()) {
			return $this->error('IP address does not match');
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
	private function error($message = 'Unauthorised', $httpStatusCode = 401)
	{
		return response()->json([
			'error' => [
				'message' => $message
			]
		], $httpStatusCode);
	}

}
