<?php

namespace App\Repository\doctor_dashboard;
use App\Models\Ray;
use App\Models\Invoice;
use App\Models\Laboratorie;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;

class InvoicesRepository implements InvoicesRepositoryInterface
{

    public function index()
    {
        $invoices = Invoice::where('doctor_id',  Auth::user()->id)->where('invoice_status',1)->get();
        return view('Doctors.invoices.index',compact('invoices'));

        
    }
     // قائمة المراجعات
     public function reviewInvoices()
     {
         $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 2)->get();
         return view('Doctors.invoices.review_invoices', compact('invoices'));
     }
 
     // قائمة الفواتير المكتملة
     public function completedInvoices()
 
     {
         $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 3)->get();
         return view('Doctors.invoices.completed_invoices', compact('invoices'));
     }

     public function show($id)
     {
       
        $rays = Ray::findorFail($id);
        if($rays->doctor_id !=auth()->user()->id){

            //abort(404);
            return redirect()->route('error-page');
        }

        return view('Doctors.invoices.view_rays', compact('rays'));
     }


     public function showLaboratorie($id)
     {
         $laboratories = Laboratorie::findorFail($id);
         if($laboratories->doctor_id !=auth()->user()->id){
             //abort(404);
             return redirect()->route('404');
         }
         return view('Dashboard.Doctor.invoices.view_laboratories', compact('laboratories'));
     }
}