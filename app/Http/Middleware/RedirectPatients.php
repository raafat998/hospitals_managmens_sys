<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectPatients
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



    
        if (Auth::guard('patient')->check()) {
            $patient = Auth::guard('patient')->user();
            $roleId = $patient->role_id;

            
            if ($roleId === 3) { 
                return redirect(RouteServiceProvider::PATIENT_HOME);
            }
        }

 
        return $next($request);
    }
     
}
