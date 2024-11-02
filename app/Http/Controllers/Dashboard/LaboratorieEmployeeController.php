<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\LaboratorieEmployee\LaboratorieEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class LaboratorieEmployeeController extends Controller
{

    private $laboratorie_employee;

    public function __construct(LaboratorieEmployeeRepositoryInterface $laboratorie_employee)
    {
        $this->laboratorie_employee = $laboratorie_employee;
    }

    public function index()
    {
        return $this->laboratorie_employee->index();
    }


    public function create()
    {
        return $this->laboratorie_employee->create();
    }


    public function store(Request $request)
    {
        return $this->laboratorie_employee->store($request);
    }



    public function update(Request $request, $id)
    {
        return $this->laboratorie_employee->update($request,$id);
    }


    public function updateStatus(Request $request, $id){

        return $this->laboratorie_employee->updateStatus($request, $id);
    }

    public function destroy($id)
    {
        return $this->laboratorie_employee->destroy($id);
    }

    public function edit($id)
    {
        // استدعاء دالة edit من المستودع (repository)
        return $this->laboratorie_employee->edit($id);
    }
}
