<?php

namespace App\Interfaces\LaboratorieEmployee;

use Illuminate\Http\Request;

interface LaboratorieEmployeeRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    public function create();

    public function updateStatus(Request $request, $id);
    public function edit($id);

}
