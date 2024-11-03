<?php

namespace App\Http\Controllers\Dashboard_Patient;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\PatientAccount;
use App\Models\Ray;
use App\Models\ReceiptAccount;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function invoices(){

        $invoices = Invoice::where('patient_id',auth()->user()->id)->get();
        return view('dashboard_patient.invoices',compact('invoices'));
    }

    public function laboratories(){

        $laboratories = Laboratorie::where('patient_id',auth()->user()->id)->get();
        return view('dashboard_patient.laboratories',compact('laboratories'));
    }

    public function viewLaboratories($id){

        $laboratorie = Laboratorie::findorFail($id);
        if($laboratorie->patient_id !=auth()->user()->id){
            return redirect()->route('404');
        }
        return view('dashboard_LaboratorieEmployee.invoices.patient_view_lab', compact('laboratorie'));
    }

    public function rays(){

        $rays = Ray::where('patient_id',auth()->user()->id)->get();
        return view('dashboard_patient.rays',compact('rays'));
    }

    public function viewRays($id)
    {
        $rays = Ray::findorFail($id);
        if($rays->patient_id !=auth()->user()->id){
            return redirect()->route('404');
        }
        return view('Doctors.invoices.patient_view_rays', compact('rays'));
    }

    public function payments(){

        $payments = ReceiptAccount::where('patient_id',auth()->user()->id)->get();
        return view('dashboard_patient.payments',compact('payments'));
    }
}