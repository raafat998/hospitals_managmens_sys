<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;





use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard_Patient\PatientController;
use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_Laboratorie_Employee\InvoiceController;

// #################### dashboard doctor ######################################################################################

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    // #################### dashboard patients ######################################################################################

Route::group(['middleware' => ['redirect.Patient','check.patient']], function () {

    Route::get('/patient/dashboard', [\App\Http\Controllers\PageController::class,'dashboardOverview_Patient'])->name('dashboard-overview-Patient');

            //############################# patients route ##########################################
            Route::get('invoices', [PatientController::class,'invoices'])->name('invoices.patient');
            Route::get('laboratories', [PatientController::class,'laboratories'])->name('laboratories.patient');
            Route::get('view_laboratories/{id}', [PatientController::class,'viewLaboratories'])->name('laboratories.view');
            Route::get('rays', [PatientController::class,'rays'])->name('rays.patient');
            Route::get('view_rays/{id}', [PatientController::class,'viewRays'])->name('rays.view');
            Route::get('payments', [PatientController::class,'payments'])->name('payments.patient');
            //############################# end patients route ######################################
});


// #################### end dashboard patients ######################################################################################



});





    
 











