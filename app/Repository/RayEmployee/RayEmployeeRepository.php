<?php

namespace App\Repository\RayEmployee;
use App\Models\User;
use App\Models\RayEmployee;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserApprovedNotification;
use App\Notifications\UserNotApprovedNotification;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface
{

    public function index()
    {
        $ray_employees = RayEmployee::all();
        return view('ray_employees.index',compact('ray_employees'));
    }

    public function create()
    {

        return view('ray_employees.create');
    }
    public function edit($id)
    {
        $ray_employee = RayEmployee::findOrFail($id);
        return view('ray_employees.edit',compact('ray_employee'));
    }
    public function store($request)
    {
        try {

            $user = new User(); 
            $user->name = $request->name; 
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 4; 
            $user->active = 1; 
            $user->save(); 
            
            // $ray_employee = new RayEmployee();
            // $ray_employee->name = $request->name;
            // $ray_employee->email = $request->email;
            // $ray_employee->password = Hash::make($request->password);
            // $ray_employee->save();

            $ray_employee =new RayEmployee();
            $ray_employee->id = $user->id; 
            $ray_employee->user_id = $user->id; 
            $ray_employee->name =  $user->name;
            $ray_employee->email =  $user->email;
            $ray_employee->phone = $request->phone;
            $ray_employee->password = Hash::make($request->password); 
            $ray_employee->role_id=4;
            $ray_employee->save();
            


            if ($request->hasFile('photo')) {
                $EmployeeName = Str::slug($request->name);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $filename = $EmployeeName . '.' . $extension;
                $path = $request->file('photo')->storeAs('public/properties/Ray_employee', $filename);
                $ray_employee->image()->updateOrCreate([], ['filename' => $filename]);
            }
              DB::commit();
            session()->flash('add');
            return redirect()->route('ray_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {

        $ray_employee = RayEmployee::findOrFail($id);
    
        // تحقق من القيم المستلمة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        

        $ray_employee->name = $validatedData['name'];
        $ray_employee->email = $validatedData['email'];
        $ray_employee->phone = $validatedData['phone'];

        // معالجة الصورة
        if ($request->hasFile('photo')) {
            // استرجاع الصورة الحالية
            $currentImage = $ray_employee->image; // استرجاع الصورة الحالية

            // حذف الصورة القديمة إذا كانت موجودة
            if ($currentImage) {
                \Log::info('Current Image: ' . $currentImage->filename); // سجّل اسم الصورة القديمة

                // تحديد المسار القديم
                $oldImagePath = 'public/properties/Ray_employee/' . $currentImage->filename; // تأكد من إضافة 'public/' هنا
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath); // حذف الصورة القديمة
                    $currentImage->delete(); // حذف السجل من جدول images
                    \Log::info('Deleted Image: ' . $oldImagePath); // سجّل اسم الصورة المحذوفة
                } else {
                    \Log::warning('Image not found: ' . $oldImagePath); // إذا كانت الصورة غير موجودة
                }
            }

            // تعيين اسم الصورة الجديد ليتوافق مع اسم الطبيب
            $doctorName = str_replace(' ', '_', $validatedData['name']); // استبدال المسافات بالشرطتين السفلية
            $filename = $doctorName . '.' . $request->file('photo')->getClientOriginalExtension(); // الحصول على امتداد الصورة

            // تخزين الصورة الجديدة
            $request->file('photo')->storeAs('public/properties/Ray_employee', $filename); // استخدام storeAs لتعيين اسم الملف

            // حفظ اسم الصورة في جدول images
            $ray_employee->image()->updateOrCreate([], ['filename' => $filename]);

            \Log::info('Uploaded New Image: ' . $filename); // سجّل اسم الصورة الجديدة
        }
        $ray_employee->save();

        return redirect()->route('ray_employee.index')->with('success', 'employee updated successfully.');

    }

    // public function destroy($id)
    // {
    //     try {
    //         RayEmployee::destroy($id);
    //         session()->flash('delete');
    //         return redirect()->back();
    //     }

    //     catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }


    public function destroy($id)
    {
        try {
            // $employee = RayEmployee::findOrFail($id);
            $user = User::findOrFail($id);
            $user->delete(); 
    
            return response()->json(['success' => 'employee deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'There was an error deleting the section: ' . $e->getMessage()], 400);
        }
    }


    public function updateStatus(Request $request, $id)
{
    $employee = RayEmployee::findOrFail($id);

    $employee->active = $request->input('active');
    $employee->save();

    $user = $employee->user;
    
    $user->active = $request->input('active');
    $user->save();

    // إذا كانت الحالة جديدة هي 'active'
    if ($employee->active) {
        // إرسال الإشعار عبر البريد الإلكتروني
        Notification::send($user, new UserApprovedNotification($user));
    }else{
        Notification::send($user, new UserNotApprovedNotification($user));

    }

    return redirect()->back()->with('success', 'Doctor status updated successfully!');
}

    
}
