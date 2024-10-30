<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;




use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_Ray_Employee\InvoiceController;

// #################### dashboard doctor ######################################################################################

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

Route::group(['middleware' => ['check.ray.employee','redirect.employee']], function () {

    Route::get('/ray_emplyee/dashboard', [\App\Http\Controllers\PageController::class,'dashboardOverview1'])->name('dashboard-ray-emplyee');

    //############################# invoices route ##########################################
    Route::get('invoices', [InvoiceController::class,'index'])->name('invoices.index');
    //############################# end invoices route ######################################


});

});
    
 











