<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data'=>Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'role_name'=> 'required',
        ]);
        $role = Role::create($validateData);
        return response()->json(['data'=> $role,'message'=>'role created succefully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json(['data'=> $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validateData = $request->validate([
            'role_name'=> 'required',
        ]);
        $role->update($validateData);   
        return response()->json(['data'=> $role,'message'=>'role updated succefully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['data'=> $role,"message"=>"role deleted succefully"]);
    }
}
