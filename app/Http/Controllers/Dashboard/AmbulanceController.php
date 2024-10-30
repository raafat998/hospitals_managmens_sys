<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAmbulanceRequest;
use App\Http\Requests\StoreInsuranceRequest;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;

class AmbulanceController extends Controller
{

    private $Ambulance;

    public function __construct(AmbulanceRepositoryInterface $Ambulance)
    {
        $this->Ambulance = $Ambulance;
    }

    public function index()
    {
        return $this->Ambulance->index();
    }


    public function create()
    {
        return $this->Ambulance->create();
    }


    public function store(StoreAmbulanceRequest $request)
    {
        return $this->Ambulance->store($request);
    }


    public function edit($id){

        return $this->Ambulance->edit($id);
    }

    public function update(Request $request)
    {
       return $this->Ambulance->update($request);
    }


    public function updateStatus(StoreAmbulanceRequest $request, $id){

        return $this->Ambulance->updateStatus($request, $id);
    }
    

    public function destroy($id)
    {
        return $this->Ambulance->destroy($id); 
    }
}
