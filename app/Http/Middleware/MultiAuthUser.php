<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MultiAuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $userType)
    {
        if(auth()->user()->type == 'petugas' || auth()->user()->type == 'admin' || auth()->user()->type == 'siswa'){
            return $next($request);
        }else{
            return back();
        }
    }
}
