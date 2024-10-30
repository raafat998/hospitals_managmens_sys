<?php


namespace App\Repository\insurances;
use App\Models\Section;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreInsuranceRequest;
use App\Interfaces\insurances\insuranceRepositoryInterface;
use App\Models\InsuranceTranslation;

class insuranceRepository implements insuranceRepositoryInterface
{

    public function index()
    {
        $insurances = insurance::all();
        return view('insurances.index', compact('insurances'));
    }

    public function create()
    {
        return view('insurances.create');
    }

    public function store($request)
    {
        try {
            $insurances = new insurance();
            $insurances->insurance_code = $request->insurance_code;
            $insurances->discount_percentage = $request->discount_percentage;
            $insurances->Company_rate = $request->Company_rate;
            $insurances->status = 1;
            $insurances->save();

            // insert trans
            $insurances->name = $request->name;
            $insurances->notes = $request->notes;
            $insurances->save();
            session()->flash('add');
            return redirect()->route('insurances.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $insurance = insurance::findorfail($id);
        $insurancetrans = InsuranceTranslation::findorfail($id);
        return view('insurances.edit', compact('insurance','insurancetrans'));
    }
    
    
    public function update($request)
    {
        if (!$request->has('status'))
            $request->request->add(['status' => 0]);
        else
            $request->request->add(['status' => 1]);

        $insurances = insurance::findOrFail($request->id);


        $insurances->update($request->all());

        // insert trans
        $insurances->name = $request->name;
        $insurances->notes = $request->notes;
        $insurances->save();

        session()->flash('edit');
        return redirect('insurances');
    }

    
    public function destroy($id)
{
    try {
        // ابحث عن القسم وحذفه
        $insurance = Insurance::findOrFail($id);
        $insurance->delete();

        // ارجع استجابة JSON مع رسالة نجاح
        return response()->json(['success' => 'Section deleted successfully.']);
    } catch (\Exception $e) {
        // ارجع استجابة JSON مع رسالة خطأ
        return response()->json(['error' => 'There was an error deleting the section: ' . $e->getMessage()], 400);
    }
}
    


public function updateStatus(Request $request, $id)
{
    $insurance = Insurance::findOrFail($id);

    $insurance->status = $request->input('status');
    $insurance->save();

    return redirect()->back()->with('success', 'User status updated successfully!');
}

// public function find($id)
//     {
//         // Retrieve a specific section by ID
//         return Section::findOrFail($id);
//     }
    

   

}
