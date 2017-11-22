<?php

namespace App\Http\Middleware;

use App\Responsable as Parents;
use Closure;

class ParentsMiddleware
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
        if(!Parent::find($request->auth->id)){
            return response()->json(['error'=>'user is not a parent'],401);
        }
        return $next($request);
    }
}
