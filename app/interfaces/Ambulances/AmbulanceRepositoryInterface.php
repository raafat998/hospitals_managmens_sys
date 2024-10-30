<?php


namespace App\Interfaces\Ambulances;
use Illuminate\Http\Request;

use App\Http\Requests\StoreAmbulanceRequest;
use App\Http\Requests\StoreInsuranceRequest;


interface AmbulanceRepositoryInterface
{
    // Get Ambulance data
    public function index();
    // show form add
    public function create();
    //insert data
    public function store($request);
    //show form edit
    public function edit($id);
    //update data
    public function update($request);
    //delete data
    public function destroy($id);

    public function updateStatus(Request $request, $id);

}
