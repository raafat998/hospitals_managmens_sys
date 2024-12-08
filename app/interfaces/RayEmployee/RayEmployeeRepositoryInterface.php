<?php

namespace App\Interfaces\RayEmployee;

use Illuminate\Http\Request;

interface RayEmployeeRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    public function create();

    public function updateStatus(Request $request, $id);
    public function edit($id);

}
