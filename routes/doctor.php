<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard_Doctor\RayController;
use App\Http\Controllers\Dashboard_Doctor\InvoiceController;
use App\Http\Controllers\Dashboard_Laboratorie_Employee\InvoiceController as LabEmployeeInvoiceController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;


// #################### dashboard doctor ######################################################################################


    
    Route::group(['middleware' => ['redirect.doctor','check.doctor']], function () {
        Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

            Route::get('/doctor2/dashboard', [\App\Http\Controllers\PageController::class,'dashboardOverview_doctor'])->name('alert1');


                        //############################# invoices route ##########################################
                        Route::resource('invoices', InvoiceController::class);
                        //############################# end invoices route ######################################
            
                        //############################# Diagnostics route ##########################################
            
                         Route::resource('Diagnostics', DiagnosticController::class);
            
                        //############################# end Diagnostics route ######################################
                       
                        //############################# completed_invoices route ##########################################
                        Route::get('doctor_completed_invoices', [InvoiceController::class,'completedInvoices'])->name('completedInvoices_d');
                        //############################# end invoices route ################################################
                        
                        //############################# review_invoices route ##########################################
                        Route::get('review_invoices', [InvoiceController::class,'reviewInvoices'])->name('reviewInvoices');
                        //############################# end invoices route #############################################

                        //############################# review_invoices route ##########################################
                        Route::post('add_review', [DiagnosticController::class,'addReview'])->name('add_review');
                        //############################# end invoices route #############################################

                        //############################# rays route ##########################################

                        Route::resource('rays', RayController::class);

                        //############################# end rays route ######################################

                        //############################# Laboratories route ##########################################

                        Route::resource('Laboratories', LaboratorieController::class);
                        Route::get('show_laboratorie/{id}', [LabEmployeeInvoiceController::class,'view_laboratories'])->name('show.laboratorie');

                        //############################# end Laboratories route ######################################

                        //############################# rays route ##########################################

                        Route::get('patient_details/{id}', [PatientDetailsController::class,'index'])->name('patient_details');

                        //############################# end rays route ######################################


                        //################################ dashboard ray employee ########################################

                  
                        


                        //################################ end ray employee #####################################


        });
    });
// #################### end dashboard doctor ######################################################################################












