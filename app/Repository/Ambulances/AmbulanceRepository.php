<?php


namespace App\Repository\Ambulances;
use App\Models\Ambulance;
use App\Http\Requests\StoreAmbulanceRequest;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use Illuminate\Http\Request;


class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    public function index()
    {
        $ambulances = Ambulance::all();
        return view('Ambulances.index',compact('ambulances'));
    }

    public function create()
    {
        return view('Ambulances.create');
    }

    public function store($request)
    {
        try {

       $ambulances = new Ambulance();
       $ambulances->car_number = $request->car_number;
       $ambulances->car_model = $request->car_model;
       $ambulances->car_year_made = $request->car_year_made;
       $ambulances->driver_license_number = $request->driver_license_number;
       $ambulances->driver_phone = $request->driver_phone;
       $ambulances->is_available = 1;
       $ambulances->car_type = $request->car_type;
       $ambulances->save();

       //insert trans
       $ambulances->driver_name = $request->driver_name;
       $ambulances->notes = $request->notes;
       $ambulances->save();

      session()->flash('add');
      return redirect()->route('Ambulances.index');

        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $ambulance = Ambulance::findorfail($id);
        return view('Ambulances.edit',compact('ambulance'));
    }

    public function update($request)    {
        if (!$request->has('is_available'))
            $request->request->add(['is_available' => 2]);
        else
            $request->request->add(['is_available' => 1]);

            $ambulance = Ambulance::findOrFail($request->id);
        $ambulance->update($request->all());

        // insert trans
        $ambulance->driver_name = $request->driver_name;
        $ambulance->notes = $request->notes;
        $ambulance->save();

        session()->flash('edit');
        return redirect()->route('Ambulances.index');
    }

    public function destroyk($request)
    {
        Ambulance ::destroy($request->id);
        session()->flash('delete');
        return redirect()->back();
    }
    

    public function destroy($id)
    {
        try {
            $ambulance = Ambulance::findOrFail($id);
            $ambulance->delete();
    
            return response()->json(['success' => 'Ambulance deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'There was an error deleting the section: ' . $e->getMessage()], 400);
        }
    }
    public function updateStatus(Request $request, $id)
{
    $amplance = Ambulance::findOrFail($id);

    $amplance->status = $request->input('status');
    $amplance->save();

    return redirect()->back()->with('success', 'User status updated successfully!');
}
}
