<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;




use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_Laboratorie_Employee\InvoiceController;

// #################### dashboard doctor ######################################################################################

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

Route::group(['middleware' => ['check.lab.employee','redirect.lab_employee']], function () {

    Route::get('/lab_emplyee/dashboard', [\App\Http\Controllers\PageController::class,'dashboardOverview_lab_employee'])->name('dashboard-lab-emplyee');

    //############################# invoices route ##########################################
    Route::resource('invoices_laboratorie_employee', InvoiceController::class);
    Route::get('completed_invoices', [InvoiceController::class,'completed_invoices'])->name('completed_invoices');
    Route::get('view_laboratories/{id}', [InvoiceController::class,'view_laboratories'])->name('view_laboratories');
   //############################# end invoices route ######################################


});

});
    
 











