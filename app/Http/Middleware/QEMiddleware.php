<?php
/**
 * PHP version 7.2.13 and Laravel version 5.8.17
 * Teacher Middleware Class
 * Provides functionality for teacher alone access
 *
 * @Package             Middleware
 * @Author              AC Jerin Monish
 * @Created On          15-05-2018
 * @Modified            AC Jerin Monish
 * @Modified On         15-05-2018
 */
namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure;

class QEMiddleware
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
        if ($request->user() && $request->user()->user_role != 'QE')
        {
            return new Response(view('unauthorized')->with('role', 'QE'));
        }
        return $next($request);
    }
}
