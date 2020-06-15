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
        DB::statement('SET NAMES "utf8mb4"');

        return $next($request);
    }
}
