<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;




use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_Ray_Employee\InvoiceController;

// #################### dashboard doctor ######################################################################################

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

Route::group(['middleware' => ['check.lab.employee','redirect.lab_employee']], function () {

    Route::get('/lab_emplyee/dashboard', [\App\Http\Controllers\PageController::class,'dashboardOverview_lab_employee'])->name('dashboard-lab-emplyee');

    //############################# invoices route ##########################################
    Route::resource('invoices_ray_employee', InvoiceController::class);
    //############################# end invoices route ######################################


});

});
    
 











