<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectDoctor
{
    public function handle(Request $request, Closure $next)
    {
        // تحقق مما إذا كان المستخدم مسجل دخول كطبيب
        if (Auth::guard('doctor')->check()) {
            $doctor = Auth::guard('doctor')->user();
            $roleId = $doctor->role_id;

            // التحقق من صلاحية الدور
            if ($roleId === 2) { // إذا كان الطبيب لديه role_id=2
                return redirect(RouteServiceProvider::DOCTOR_HOME);
            }
        }

        // إذا لم يكن المستخدم مسجلاً كطبيب، تابع الطلب
        return $next($request);
    }
}
