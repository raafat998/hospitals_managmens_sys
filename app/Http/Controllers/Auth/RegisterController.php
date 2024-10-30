<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Section;
use App\Models\Appointment;

use App\Models\RayEmployee;
use Illuminate\Support\Str;
use App\Notifications\NewUser;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\AdminNewUserNotification;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function registerView()
    {
        $roles = Role::all();
        $sections= Section::all();
        $appointments=Appointment::all();
        return view('auth.register', compact('roles','sections','appointments'));
    }

    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:10'],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    
        if ($data['role_id'] == 3) { // Assuming 3 is the ID for 'patients'
            $rules['Date_Birth'] = ['required', 'date'];
            $rules['Gender'] = ['required', 'integer'];
            $rules['Blood_Group'] = ['required', 'string', 'max:3'];
            $rules['Address'] = ['required', 'string', 'max:255'];
        }
    
        return Validator::make($data, $rules);
    }
    
    protected function create(array $data)
    {
        $profileImagePath = '';
        
        if (isset($data['profile_image']) && $data['profile_image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['profile_image']->store('public/properties'); 
            $profileImagePath = Storage::url($path);
        }
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'role_id' => $data['role_id'],
            'profile_image' => $profileImagePath,
        ]);
    
        if ($user->role_id == 1) { // Admin
            $user->active = 1;
            $user->save();
            
            Admin::create([
               
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'role_id' => $user->role_id,
                'profile_image' => $user->profile_image,
                'active' => $user->active,
                'password' => $user->password,
            ]);
        }
    
        if ($user->role_id == 2) { // Doctor
            $user->active = 0;
            $user->save();
            
            $doctor = Doctor::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'section_id' => $data['section_id'],
                'phone' => $user->phone,
                'password' => $user->password,
                'role_id' => $user->role_id,
                'active' => $user->active,
            ]);

                $doctor->translateOrNew(app()->getLocale())->appointments = implode(",",  $data['appointments']);
                $doctor->save();
                $doctor->doctorappointments()->attach($data['appointments']); // إرفاق المواعيد

            // رفع الصورة للطبيب
            if (isset($data['profile_image']) && $data['profile_image'] instanceof \Illuminate\Http\UploadedFile) {
                $doctorName = Str::slug($data['name']);
                $extension = $data['profile_image']->getClientOriginalExtension();
                $filename = $doctorName . '.' . $extension;
                $path = $data['profile_image']->storeAs('public/properties/doctors', $filename);
                
                // تحديث أو إنشاء سجل الصورة للطبيب
                $doctor->image()->updateOrCreate([], ['filename' => $filename]);
            }
        }
    
        if ($user->role_id == 3) { // Patient
            $user->active = 1; 
            $user->save();
            
            Patient::create([
                'id' => $user->id,
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'password' => $user->password,
                'role_id' => $user->role_id, 
                'Date_Birth' => $data['Date_Birth'],
                'phone' => $user->phone,
                'Gender' => $data['Gender'],
                'Blood_Group' => $data['Blood_Group'],
                'Address' => $data['Address'],
            ]);
        }
    
        if ($user->role_id == 4) { 
            $user->active = 0;
            $user->save();
        
            // محاولة العثور على سجل الموظف القائم
            $employee = RayEmployee::where('user_id', $user->id)->first();
        
            // إذا كان سجل الموظف موجودًا، نقوم بتحديثه
            if ($employee) {
                $employee->name = $user->name;
                $employee->email = $user->email;
                $employee->phone = $user->phone;
                $employee->role_id = $user->role_id;
                $employee->save();
            } else {
                // إذا لم يكن موجودًا، نقوم بإنشائه
                $employee = RayEmployee::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'password' => $user->password,
                    'role_id' => $user->role_id,
                ]);
            }
        
            // رفع الصورة للطبيب
            if (isset($data['employee_profile_image']) && $data['employee_profile_image'] instanceof \Illuminate\Http\UploadedFile) {
                $employeeName = Str::slug($data['name']);
                $extension = $data['employee_profile_image']->getClientOriginalExtension();
                $filename = $employeeName . '.' . $extension;
        
                // تحقق من وجود المجلد قبل التخزين
                $directory = 'public/properties/employee';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
        
                $path = $data['employee_profile_image']->storeAs($directory, $filename);
        
                // تحديث أو إنشاء سجل الصورة للطبيب
                $employee->image()->updateOrCreate([], ['filename' => $filename]);
            }
        }
        
        // Notify administrators
        $administrators = User::with('role')->where('role_id', 1)->get();
        $adminEmails = $administrators->pluck('email')->toArray(); 
        
        if (count($adminEmails) > 0) {
            $user->notify(new AdminNewUserNotification($user));
        }
        
        return $user;
    }        
}