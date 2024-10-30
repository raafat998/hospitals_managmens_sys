<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectRayEmployee
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
       
        if (Auth::guard('ray_employees')->check()) {
            $ray_employee = Auth::guard('ray_employees')->user();
            $roleId = $ray_employee->role_id;

           
            if ($roleId === 4) { 
                return redirect(RouteServiceProvider::RAY_EMPLOYEE_HOME);
            }
        }

        
        return $next($request);
    }
}
