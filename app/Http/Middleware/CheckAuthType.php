<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuthType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()){
            if($request->user()->hasRole('admin')){
                return redirect()->route('dashboard.index');
            }
            else{
                if($request->user()->hasRole('spectator') || $request->user()->hasRole('organizer')){
                    return redirect()->route('index');
                }
            } 
        }
        else return redirect()->route('login');
        return $next($request);
    }
}
