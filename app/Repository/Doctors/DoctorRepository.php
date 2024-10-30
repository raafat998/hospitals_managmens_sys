<?php
namespace App\Repository\Doctors;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

use App\Models\Image;
use App\Models\Doctor;
use App\Models\Section;
use App\Models\Appointment;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Notifications\UserApprovedNotification;
use App\Notifications\UserNotApprovedNotification;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use Illuminate\Support\Str; // تأكد من استيراد Str في أعلى الملف

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadTrait;

    public function index()
{
    $doctors = Doctor::with('doctorappointments')->paginate(10);
    
    return view('Doctors.index', compact('doctors'));
}

    public function create()
    {
        $appointments = Appointment::all();
        $sections = Section::all();
        return view('Doctors.create', compact('sections', 'appointments'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // إنشاء مستخدم جديد
            $user = new User(); 
            $user->name = $request->name; 
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 2; 
            $user->active = 1; 
            $user->save(); 
    
            // إنشاء طبيب جديد
            $doctors = new Doctor();
            $doctors->id = $user->id; 
            $doctors->user_id = $user->id; 
            $doctors->email =  $user->email;
            $doctors->section_id = $request->section_id;
            $doctors->phone = $request->phone;
            $doctors->password = Hash::make($request->password); 
            $doctors->active  = 0;
            $doctors->role_id=2;
            $doctors->save();
            
            // حفظ الاسم والمواعيد
            $doctors->translateOrNew(app()->getLocale())->name = $request->name;
            $doctors->translateOrNew(app()->getLocale())->appointments = implode(",", $request->appointments);
            $doctors->save();
            
            // إضافة المواعيد للطبيب
            $doctors->doctorappointments()->attach($request->appointments); // إرفاق المواعيد
    
            // رفع الصورة
            if ($request->hasFile('photo')) {
                $doctorName = Str::slug($request->name);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $filename = $doctorName . '.' . $extension;
                $path = $request->file('photo')->storeAs('public/properties/doctors', $filename);
                $doctors->image()->updateOrCreate([], ['filename' => $filename]);
            }
    
            DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.create');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    
    

    

    public function edit($id)
    {
        $appointments = Appointment::all();

        $doctor = Doctor::findOrFail($id);
        $sections = Section::all();
        return view('Doctors.edit', compact('doctor', 'sections','appointments'));
    }
   
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
    
        // تحقق من القيم المستلمة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'section_id' => 'required|exists:sections,id',
            'appointments' => 'required|array',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // تحديث البيانات
        $doctor->name = $validatedData['name'];
        $doctor->email = $validatedData['email'];
        $doctor->phone = $validatedData['phone'];
        $doctor->section_id = $validatedData['section_id'];
        $doctor->doctorappointments()->sync($validatedData['appointments']); // تحديث المواعيد
    
        // معالجة الصورة
        if ($request->hasFile('photo')) {
            // استرجاع الصورة الحالية
            $currentImage = $doctor->image; // استرجاع الصورة الحالية
    
            // حذف الصورة القديمة إذا كانت موجودة
            if ($currentImage) {
                \Log::info('Current Image: ' . $currentImage->filename); // سجّل اسم الصورة القديمة
    
                // تحديد المسار القديم
                $oldImagePath = 'public/properties/doctors/' . $currentImage->filename; // تأكد من إضافة 'public/' هنا
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
            $request->file('photo')->storeAs('public/properties/doctors', $filename); // استخدام storeAs لتعيين اسم الملف
    
            // حفظ اسم الصورة في جدول images
            $doctor->image()->updateOrCreate([], ['filename' => $filename]);
    
            \Log::info('Uploaded New Image: ' . $filename); // سجّل اسم الصورة الجديدة
        }
    
        $doctor->save();
    
        return redirect()->route('Doctors.index')->with('success', 'Doctor updated successfully.');
    }
    
    
    

    
    


    
    
    public function destroy(Request $request, $id)
{
    $doctor = Doctor::findOrFail($id); // جلب الطبيب باستخدام $id

    // حذف الصورة إذا كانت موجودة
    $currentImage = $doctor->image;
    if ($currentImage) {
        $oldImagePath = 'public/properties/doctors/' . $currentImage->filename;
        if (Storage::exists($oldImagePath)) {
            Storage::delete($oldImagePath);
        }
        $currentImage->delete();
    }

    $doctor->delete(); // حذف السجل من جدول doctors
    
    // إعادة استجابة بصيغة JSON
    return response()->json(['success' => 'Doctor deleted successfully!']);
}



public function updateStatus(Request $request, $id)
{
    $doctor = Doctor::findOrFail($id);

    $doctor->active = $request->input('active');
    $doctor->save();

    $user = $doctor->user;
    
    $user->active = $request->input('active');
    $user->save();

    // إذا كانت الحالة جديدة هي 'active'
    if ($doctor->active) {
        // إرسال الإشعار عبر البريد الإلكتروني
        Notification::send($user, new UserApprovedNotification($user));
    }else{
        Notification::send($user, new UserNotApprovedNotification($user));

    }

    return redirect()->back()->with('success', 'Doctor status updated successfully!');
}


}
