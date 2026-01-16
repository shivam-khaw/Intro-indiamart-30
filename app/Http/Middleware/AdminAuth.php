<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
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
       if ($request->session()->has('ADMIN_login')) {
          echo "hamid";
        }else{
            
            //return redirect('admin/login');
        }

        // If login fails, redirect back with an error message
        //return back()->withInput($request->only('email'))->withErrors(['email' => 'Invalid login credentials']);
    
    }
}

