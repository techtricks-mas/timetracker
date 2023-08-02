<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class CheckActiveEmployee
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
        // check auth user
        if (!Auth::check()) {
            Auth::logout();
        }
        $employe = Employee::where('user_id', Auth::user()->id)->first();
        if($employe->status == 1){
            return $next($request);
        }
        else{
            Auth::logout();
            // notify that you account is not active
            return redirect()->route('login')->with('error', 'Your account is not active');
            
        }


       
       
      
    }
}