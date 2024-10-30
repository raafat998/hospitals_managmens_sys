<?php


namespace App\Repository\Services;
use Illuminate\Http\Request;

use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Models\Service;

class SingleServiceRepository implements SingleServiceRepositoryInterface
{

    public function index()
    {
        $services = Service::all();
        return view('Services.Single.index',compact('services'));
    }

    public function create()
    {
        return view('Services.Single.create');
    }

   
    public function edit($id)
    {

        $service = Service::findOrFail($id);
        return view('Services.Single.edit', compact('service'));
    }
    public function store($request)
    {
        try {
            $SingleService = new Service();
            $SingleService->price = $request->price;
            $SingleService->description = $request->description;
            $SingleService->status = 1;
            $SingleService->save();

            // store trans
            $SingleService->name = $request->name;
            $SingleService->save();

            session()->flash('add');
            return redirect()->route('Service.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {

            $SingleService = Service::findOrFail($request->id);
            $SingleService->price = $request->price;
            $SingleService->description = $request->description;
            // $SingleService->status = $request->status;

            $SingleService->save();

            // store trans
            $SingleService->name = $request->name;
            $SingleService->save();

            session()->flash('edit');
            return redirect()->route('Service.index')->with('success', 'Service  updated successfully!');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Service::destroy($id);
        session()->flash('delete', 'Service has been deleted successfully.');
        return response()->json(['success' => 'Service has been deleted successfully.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $SingleService = Service::findOrFail($id);
        $SingleService->status = $request->input('status');
        $SingleService->save();
    
        return redirect()->route('Service.index')->with('success', 'Service status updated successfully!');
    }
    
}