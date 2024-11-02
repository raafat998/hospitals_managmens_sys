<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectLabEmployee
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
       
        if (Auth::guard('lab_employees')->check()) {
            $lab_employee = Auth::guard('lab_employees')->user();
            $roleId = $lab_employee->role_id;

           
            if ($roleId === 5) { 
                return redirect(RouteServiceProvider::LAB_EMPLOYEE_HOME);
            }
        }

        
        return $next($request);
    }
}
