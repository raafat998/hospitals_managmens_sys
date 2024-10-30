<?php

namespace App\interfaces\Sections;
use Illuminate\Http\Request;

use App\Models\Section;



/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface SectionRepositoryInterface
{
    public function index();
    public function create();

// In App\Interfaces\Sections\SectionRepositoryInterface
public function edit(Section $section);

  // Update Sections
  public function update(Request $request); // تأكد من تطابق النوع هنا

  // destroy Sections
  public function destroy($id);

  public function show($id);

}