<?php

namespace App\Interfaces\Doctors;
use Illuminate\Http\Request;

interface DoctorRepositoryInterface
{
    // get Doctor
    public function index();

    // create Doctor
    public function create();

    // store Doctor
    public function store(Request $request);


    // عرض صفحة تعديل الطبيب
    public function edit($id);

  // update Doctor
  public function update(Request $request, $id);
  // destroy Doctor
  public function destroy(Request $request, $id);

  public function updateStatus(Request $request, $id);
    
}