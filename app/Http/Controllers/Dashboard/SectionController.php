<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\interfaces\Sections\SectionRepositoryInterface;

class SectionController extends Controller
{
    private $Sections;

    public function __construct(SectionRepositoryInterface $Sections)
    {
        $this->Sections = $Sections;
    }

    public function index()
    {
        return $this->Sections->index();
    }

    public function create()
    {
        return $this->Sections->create();
    }

    public function edit($id)
    {
        // Use the repository to find the section
        $section = $this->Sections->find($id);
        
        // Pass the section to the edit function in the repository
        return $this->Sections->edit($section);
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Call the update method in the repository
        return $this->Sections->update($request, $id);
    }

    public function store(Request $request)
    {
        // Call the store method from the repository
        return $this->Sections->store($request);
    }

    public function destroy($id)
    {
        return $this->Sections->destroy($id); // Call the destroy method from the repository
    
       
    }

    public function show($id){
        return $this->Sections->show($id);
    }
}
