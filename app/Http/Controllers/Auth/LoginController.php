<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // الحصول على بيانات الاعتماد
        $credentials = $request->only('email', 'password');
    
        // محاولة تسجيل الدخول باستخدام جدول المستخدمين
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            // التحقق مما إذا كان الحساب نشطًا
            if (!$user->active) {
                return redirect()->back()->withErrors(['email' => 'Your account is inactive.']);
            }
    
            // إعادة توجيه المستخدم بناءً على دوره
            return $this->redirectUser($user);
        }
    
        // إذا لم تنجح عملية تسجيل الدخول
        return redirect()->back()->withErrors(['email' => 'Invalid login credentials.']);
    }
    
    protected function redirectUser($user)
    {
        // إعادة توجيه المستخدم بناءً على role_id
        switch ($user->role_id) {
            case 1:
                return redirect()->route('dashboard-overview-1');
            case 2:
                return redirect()->route('alert1');
            case 3:
                return redirect()->route('dashboard-overview-Patient');
            case 4:
                return redirect()->route('dashboard-ray-emplyee'); 
            case 5:
                return redirect()->route('dashboard-lab-emplyee');
            default:
                return redirect()->route('login')->with('error', 'Role ID is invalid.');
        }
    }
    
}
