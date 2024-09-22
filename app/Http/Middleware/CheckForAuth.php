<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckForAuth
{
    /**
     * Handle an incoming request.
     *
     * //@param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * //@return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->url('admin/login') ) {
            if(isset(Auth::guard('admin')->user()->name)) {
                return redirect()->route('admins.dashboard');
            } 
        }
        return $next($request);
    }
}
