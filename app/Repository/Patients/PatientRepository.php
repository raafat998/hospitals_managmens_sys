<?php


namespace App\Repository\Patients;
use App\Models\Ray;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Laboratorie;
use Illuminate\Support\Str;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Models\single_invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\Patients\PatientRepositoryInterface;

class PatientRepository implements PatientRepositoryInterface
{
   public function index()
   {
       $Patients = Patient::all();
       return view('Patients.index',compact('Patients'));
   }

   public function create()
   {
       return view('Patients.create');
   }


       public function store($request)
       {
           DB::beginTransaction();
           try {
               // إنشاء المستخدم أو المريض الجديد باستخدام $request
               $user = new User();
               $user->name = $request->name;
               $user->email = $request->email;
               $user->password = Hash::make($request->password);
               $user->role_id = 3;
               $user->active = 1; 
               $user->save();
               
               $patient = new Patient();
               $patient->id = $user->id; 
               $patient->user_id = $user->id;
               $patient->role_id = $user->role_id;
               $patient->email = $request->email;
               $patient->password = Hash::make($request->password); 
               $patient->Date_Birth = $request->Date_Birth;
               $patient->phone = $request->Phone;
               $patient->Gender = $request->Gender;
               $patient->Blood_Group = $request->Blood_Group;
               $patient->save();
   
        if ($request->hasFile('photo')) {
            $PatientName = Str::slug($request->name);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = $PatientName . '.' . $extension;
            $path = $request->file('photo')->storeAs('public/properties/Patient', $filename);
            $patient->image()->updateOrCreate([], ['filename' => $filename]);
        }

        $translation = $patient->translateOrNew($request->locale);
        $translation->name = $request->name;
        $translation->Address = $request->Address;
        $translation->save();

        DB::commit();

        session()->flash('add', __('Patients.patient_added_successfully'));
        return redirect()->route('Patients.create');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
 }

   
   

   public function edit($id)
   {
       $Patient = Patient::findorfail($id);
       return view('Patients.edit',compact('Patient'));
   }
   public function update($request)
   {
       try {
           // العثور على المريض
           $Patient = Patient::findOrFail($request->id);
   
           // تحديث بيانات المستخدم المرتبط بالمريض
           $user = $Patient->user;
           $user->name = $request->name;  // تحديث اسم المستخدم
           $user->email = $request->email;  // تحديث البريد الإلكتروني للمستخدم
           if ($request->filled('password')) {
               $user->password = Hash::make($request->password);  // تحديث كلمة المرور فقط في حال تم إدخال كلمة مرور جديدة
           }
           $user->save();  // حفظ البيانات المحدثة للمستخدم
   
           // تحديث بيانات المريض
           $Patient->email = $request->email;
           $Patient->Password = Hash::make($request->Phone); // تأمين كلمة المرور
           $Patient->Date_Birth = $request->Date_Birth;
           $Patient->Phone = $request->Phone;
           $Patient->Gender = $request->Gender;
           $Patient->Blood_Group = $request->Blood_Group;
           $Patient->save();  // حفظ البيانات المحدثة للمريض
   
           // تحديث الصورة إذا تم رفع صورة جديدة
           if ($request->hasFile('photo')) {
               $PatientName = Str::slug($request->name);
               $extension = $request->file('photo')->getClientOriginalExtension();
               $filename = $PatientName . '.' . $extension;
               $path = $request->file('photo')->storeAs('public/properties/Patient', $filename);
               $Patient->image()->updateOrCreate([], ['filename' => $filename]);
           }
   
           // تحديث الترجمة
           $translation = $Patient->translateOrNew($request->locale);  // تأكد من وجود locale في الطلب
           $translation->name = $request->name;
           $translation->Address = $request->Address;
           $translation->save();  // احفظ الترجمة
   
           DB::commit();
   
           // تمرير رسالة النجاح
           session()->flash('edit', __('Patients.patient_updated_successfully'));
           return redirect()->route('Patients.index');
       } catch (\Exception $e) {
           DB::rollBack();
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
   }
   

   public function destroyl($request)
   {
       Patient ::destroy($request->id);
       session()->flash('delete');
       return redirect()->back();
   }

   public function destroy($id)
    {
        try {
            $Patient = Patient::findOrFail($id);
            $Patient->delete();
    
            return response()->json(['success' => 'Patient deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'There was an error deleting the section: ' . $e->getMessage()], 400);
        }
    }

    public function Show($id)
    {
        $Patient = patient::findorfail($id);
        $patient_rays = Ray::where('patient_id',$id)->get();
        $rays=Ray::where('patient_id', $id)->first();
        $invoices = Invoice::where('patient_id', $id)->get();
        $receipt_accounts = ReceiptAccount::where('patient_id', $id)->get();
        $Patient_accounts = PatientAccount::where('patient_id', $id)->get();
        $patient_Laboratories  = Laboratorie::where('patient_id',$id)->get();
        return view('Patients.show', compact('Patient', 'invoices', 'receipt_accounts', 'Patient_accounts','patient_rays','patient_Laboratories','rays'));
    }

    public function viewRays($id)
    {
        $rays = Ray::findorFail($id);
        if($rays->patient_id !=auth()->user()->id){
            return redirect()->route('404');
        }
        return view('Doctors.invoices.patient_view_rays', compact('rays'));
    }

    // public function create($id){

        

    //     $patient_records = Diagnostic::where('patient_id',$id)->get();
    //     $patient_rays = Ray::where('patient_id',$id)->get();
    //     $patient_Laboratories  = Laboratorie::where('patient_id',$id)->get();
    //     return view('Doctors.invoices.patient_details',compact('patient_records','patient_rays','patient_Laboratories'));
    // }
}

