<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Notifications\AdminNewUserNotification;
use App\Notifications\UserApprovedNotification;
use App\Notifications\UserNotApprovedNotification;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Models\Role;

use Illuminate\Support\Facades\Notification;
class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
  
    public function index()
    {
        try {
            $users = User::with('role')->paginate(10); // Paginate with 10 users per page
            $totalUsers = User::count(); // Total number of users for display
            return view('users.index', compact('users', 'totalUsers'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve users', 'message' => $e->getMessage()], 500);
        }
    }
    

    public function create()
    {
        $roles = Role::all(); // Ensure Role model exists and has data
        return view('users.create', compact('roles'));
    }

    public function edit(User $user)
    {
        try {
            $roles = Role::all();
            return view('users.edit', [
                'user' => $user,
                'roles' => $roles, 
                'userRole' => $user->role_id 
            ]);
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Failed to retrieve user for editing: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'phone' => 'nullable|string|max:15',
                'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
            ]);
    
            // تعيين المسار الافتراضي كقيمة فارغة
            $profileImagePath = '';
    
            // التحقق من وجود صورة في البيانات وتخزينها
            if ($request->hasFile('profile_image')) {

                $path = $request->file('profile_image')->store('public/properties'); 
                $profileImagePath = Storage::url($path);
            }
    
            
            $validatedData['role_id'] = 2; 
            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['profile_image'] = $profileImagePath;
    
            // إنشاء المستخدم
            $user = User::create($validatedData);
    
            // إذا كان role_id يساوي 1
            if ($user->role_id == 1) {
                $user->active = 1; // تعيين active إلى 1
                $user->save();
    
                // تخزين معلومات المسؤول في جدول admins
                Admin::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role_id' => $user->role_id,
                    'profile_image' => $user->profile_image,
                    'active' => $user->active,
                    'admin' => $user->admin,
                    'password' => $user->password,
                ]);
            }

    
            return redirect()->route('user-mangment');
    
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation Error', 'messages' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create user', 'message' => $e->getMessage()], 500);
        }
    }
    
    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        try {
            $user->load('role');
            return response()->json(['data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve user', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified user in storage.
     */

     public function update(Request $request, User $user)
     {
         try {
             // تحديد قواعد التحقق من صحة البيانات
             $rules = [
                 'name' => 'sometimes|string|max:255',
                 'phone' => 'sometimes|string|max:20',
                 'role_id' => 'sometimes|exists:roles,id',
                 'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                 'active' => 'sometimes|boolean',
             ];
     
             // التحقق من البريد الإلكتروني فقط إذا تم تغييره
             if ($request->email !== $user->email) {
                 $rules['email'] = 'sometimes|email|unique:users,email,' . $user->id;
             }
     
             // التحقق من كلمة المرور فقط إذا تم إدخالها
             if ($request->filled('password')) {
                 $rules['password'] = 'nullable|string|min:8|confirmed';
             }
     
             // التحقق من صحة البيانات
             $validatedData = $request->validate($rules);
     
             // تشفير كلمة المرور فقط إذا تم إدخالها
             if ($request->filled('password')) {
                 $validatedData['password'] = Hash::make($request->password);
             }
     
             // تعيين المسار الافتراضي كقيمة فارغة
             $profileImagePath = '';
     
             // التحقق من وجود صورة في البيانات وتخزينها
             if ($request->hasFile('profile_image')) {
                 // تخزين الصورة وتحديث المسار
                 $path = $request->file('profile_image')->store('public/properties'); // تأكد من صحة المسار
                 $profileImagePath = Storage::url($path);
                 
                 // تعيين المسار الجديد إلى البيانات المحققة
                 $validatedData['profile_image'] = $profileImagePath;
             }
     
             // تحديث بيانات المستخدم
             $user->update($validatedData);
     
             // إعادة التوجيه مع رسالة نجاح
             return redirect()->route('user-mangment')
                 ->with('success', 'User updated successfully');
         } catch (ValidationException $e) {
             return redirect()->back()->withErrors($e->errors())->withInput();
         } catch (\Exception $e) {
             return redirect()->route('user-mangment')
                 ->with('error', 'Failed to update user: ' . $e->getMessage());
         }
     }
     
     
     
     
     
     
     
    

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['error' => 'User not found.'], 404);
    }

    $user->delete();
    return response()->json(['success' => 'User deleted successfully.']);
}

    public function login(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        "email" => "required|email",
        "password" => "required",
    ]);

    // Attempt to find the user by email
    $user = User::where('email', $validatedData['email'])->first();

    // If user not found or password does not match
    if (!$user || !Hash::check($validatedData['password'], $user->password)) {
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Log the user in
    auth()->login($user);

    // If credentials are correct, redirect to the 'search' page (or any other route you prefer)
    return redirect()->route('search')->with('success', 'Login successfully');
}


public function updateStatus(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->active = $request->input('active');
    $user->save();

    // إذا كانت الحالة جديدة هي 'active'
    if ($user->active) {
        // إرسال الإشعار عبر البريد الإلكتروني
        Notification::send($user, new UserApprovedNotification($user));
    }else{
        Notification::send($user, new UserNotApprovedNotification($user));

    }

    return redirect()->back()->with('success', 'User status updated successfully!');
}

}