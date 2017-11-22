<?php

namespace App\Http\Middleware;

use App\Cook;
use Closure;

class CooksMiddleware
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
        //dd($request->auth->id);
        if(!Cook::find($request->auth->id)){
            return response()->json(['error'=>'user is not a cook'],401);
        }
        return $next($request);
    }
}
