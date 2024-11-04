<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Ray;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Interfaces\Patients\PatientRepositoryInterface;

class PatientController extends Controller
{

    private $Patient;

    public function __construct(PatientRepositoryInterface $Patient)
    {
        $this->Patient = $Patient;
    }

    public function index()
    {
        return $this->Patient->index();
    }

    

    public function create()
    {
        return$this->Patient->create();
    }


    public function store(StorePatientRequest $request)
    {
       return $this->Patient->store($request);
    }


    public function viewRays($id)
    {
        $rays = Ray::findorFail($id);
        if($rays->patient_id !=auth()->user()->id){
            return redirect()->route('404');
        }
        return view('Doctors.invoices.patient_view_rays', compact('rays'));
    }


    public function edit($id)
    {
        return $this->Patient->edit($id);
    }


    public function update(StorePatientRequest $request)
    {
        return $this->Patient->update($request);
    }


    

    public function destroy($id)
    {
        return $this->Patient->destroy($id); 
    }

    public function show($id){
        return $this->Patient->show($id);
    }
}
