<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $roleId = $user->role_id;

            // إذا كان المستخدم يحاول الوصول إلى صفحة تسجيل الدخول
            if ($request->routeIs('login')) {
                // تحقق مما إذا كان المستخدم طبيبًا
                // if ($user instanceof \App\Models\Doctor) {
                //     // لا يجب توجيه الطبيب إلى الصفحات الخاصة بالمستخدمين
                //     return redirect()->route('alert'); // توجيه إلى صفحة تحذير أو أي صفحة أخرى مخصصة
                // }

                switch ($roleId) {
                    case 1: // مسؤول
                        return redirect(RouteServiceProvider::ADMIN_HOME);
                    case 2: // طبيب
                        return redirect(RouteServiceProvider::DOCTOR_HOME);
                    case 3: // مريض
                        return redirect(RouteServiceProvider::PATIENT_HOME);
                    case 4: // مريض
                            return redirect(RouteServiceProvider::RAY_EMPLOYEE_HOME);
                    default:
                        return redirect()->route('login');
                }
            }
        }

        return $next($request);
    }
}
