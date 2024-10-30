<?php


namespace App\Interfaces\Services;
use Illuminate\Http\Request;

use App\Models\Service;


interface SingleServiceRepositoryInterface
{

    // Get SingleServices
    public function index();

    // store SingleServices
    public function store($request);

    // update SingleServices
    public function update($request);

    // destroy SingleServices
    public function destroy($request);

    public function edit($id);

    public function create();

    public function updateStatus(Request $request, $id);
    


}