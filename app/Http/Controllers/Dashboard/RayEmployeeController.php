<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class RayEmployeeController extends Controller
{
    private $employee;

    public function __construct(RayEmployeeRepositoryInterface $employee)
    {
        $this->employee = $employee;
    }


    public function index()
    {
        return $this->employee->index();
    }


    public function create()
    {
        return $this->employee->create();
    }


    public function store(Request $request)
    {
        return $this->employee->store($request);
    }



    public function update(Request $request, $id)
    {
        return $this->employee->update($request,$id);
    }


    public function updateStatus(Request $request, $id){

        return $this->employee->updateStatus($request, $id);
    }

    public function destroy($id)
    {
        return $this->employee->destroy($id);
    }

    public function edit($id)
    {
        // استدعاء دالة edit من المستودع (repository)
        return $this->employee->edit($id);
    }
    
}
