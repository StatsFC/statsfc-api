<?php
namespace App\Http\Middleware;

use Closure;
use DB;

class Database
{
    /**
     * Set the database encoding
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return Closure
     */
    public function handle($request, Closure $next)
    {
        DB::statement('SET NAMES latin1');

        return $next($request);
    }
}
