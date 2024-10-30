<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\SingleServiceRepositoryInterface;

class Single_service_Controller extends Controller
{
    private $SingleService;

    public function __construct(SingleServiceRepositoryInterface $SingleService)
    {
        $this->SingleService = $SingleService;
    }

    public function index()
    {
     return $this->SingleService->index();
    }

    
    public function create()
    {
     return $this->SingleService->create();
    }

    public function edit($id)
    {
        // استدعاء دالة edit من المستودع (repository)
        return $this->SingleService->edit($id);
    }


    public function store(Request $request)
    {
        return $this->SingleService->store($request);
    }


    public function update(Request $request)
    {
       return $this->SingleService->update($request);

    }


    public function destroy($id)
    {
        return $this->SingleService->destroy($id);
    }

    public function updateStatus(Request $request, $id){

        return $this->SingleService->updateStatus($request, $id);

    }
    

}
