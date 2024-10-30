<?php
namespace App\Repository\Sections;
use Illuminate\Http\Request;

use App\Models\Section;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Doctor;
use App\Models\SectionTranslation;

class SectionRepository implements SectionRepositoryInterface
{
    public function index()
    {
        // Retrieve all sections
        $sections = Section::all();
        return view('Sections.index', compact('sections'));
    }

    public function show($id)
    {
        $section = Section::findOrFail($id);
        // // Retrieve all sections
        $doctors = Section::findOrFail($id)->doctors()->paginate(10);
        //  $doctors = Doctor::where('section_id',$id)->paginate(10);

         return view('Sections.show_doctors', compact('doctors' ,'section'));
    }

    public function create()
    {
        return view('Sections.create');
    }

    public function store($request)
{
    // Validate and create a new section
    Section::create([
        'name' => $request->input('name'),
        'description' => $request->input('description', 'test'), // Use default value
    ]);

    session()->flash('add', 'Section added successfully.'); // Optional success message
    return redirect()->route('Section.index');
}


    public function edit(Section $section)
    {
        return view('Sections.edit', compact('section'));
    }

    public function update(Request $request)
{
    // Find the section and update its details
    $section = Section::findOrFail($request->id); // استخدم $request->id هنا
    $section->update([
        'name' => $request->input('name'),
        'description' => $request->input('description', 'test'), // Use default value

    ]);

    session()->flash('success', 'Section updated successfully.');
    return redirect()->route('Section.index');
}

public function destroy($id)
{
    try {
        // ابحث عن القسم وحذفه
        $section = Section::findOrFail($id);
        $section->delete();

        // ارجع استجابة JSON مع رسالة نجاح
        return response()->json(['success' => 'Section deleted successfully.']);
    } catch (\Exception $e) {
        // ارجع استجابة JSON مع رسالة خطأ
        return response()->json(['error' => 'There was an error deleting the section: ' . $e->getMessage()], 400);
    }
}



    public function find($id)
    {
        // Retrieve a specific section by ID
        return Section::findOrFail($id);
    }
}
