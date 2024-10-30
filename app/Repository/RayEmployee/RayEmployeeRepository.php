<?php

namespace App\Repository\RayEmployee;

use App\Models\User;
use App\Models\RayEmployee;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface
{

    public function index()
    {
        $ray_employees = RayEmployee::all();
        return view('Dashboard.ray_employee.index',compact('ray_employees'));
    }

    public function store($request)
    {
        try {

            $user = new User(); 
            $user->name = $request->name; 
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 2; 
            $user->active = 1; 
            $user->save(); 
            
            // $ray_employee = new RayEmployee();
            // $ray_employee->name = $request->name;
            // $ray_employee->email = $request->email;
            // $ray_employee->password = Hash::make($request->password);
            // $ray_employee->save();

            $ray_employee =new RayEmployee();
            $ray_employee->id = $user->id; 
            $ray_employee->user_id = $user->id; 
            $ray_employee->email =  $user->email;
            $ray_employee->section_id = $request->section_id;
            $ray_employee->phone = $request->phone;
            $ray_employee->password = Hash::make($request->password); 
            $ray_employee->role_id=4;
            $ray_employee->save();
            

            if ($request->hasFile('photo')) {
                $EmployeeName = Str::slug($request->name);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $filename = $EmployeeName . '.' . $extension;
                $path = $request->file('photo')->storeAs('public/properties/Ray_employee', $filename);
                $ray_employee->image()->updateOrCreate([], ['filename' => $filename]);
            }
              DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.create');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input = Arr::except($input, ['password']);
        }

        $ray_employee = RayEmployee::find($id);
        $ray_employee->update($input);

        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            RayEmployee::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
