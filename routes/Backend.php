<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Single_service_Controller;
use App\Http\Controllers\Dashboard\LaboratorieEmployeeController;





// #################### dashboard admin ######################################################################################


                    // Route::get('/admin_dashboard', [\App\Http\Controllers\PageController::class,'dashboardOverview1'])->name('dashboard-overview-1')->middleware([\App\Http\Middleware\ApprovalMiddleware::class  ]);

                    Route::group(['middleware' => ['auth']], function () {
                   
                    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

                        Route::get('/admin/dashboard', [\App\Http\Controllers\PageController::class,'dashboardOverview_admin'])->name('dashboard-overview-1');
                        Route::patch('/User-update/{user}', [UserController::class, 'update'])->name('users.update');
                        Route::get('User-edit/{user}', [UserController::class, 'edit'])->name('users.edit');

                    //############################# sections route ##########################################

                    Route::resource('Section', SectionController::class);

                    //###### end sections route ######################################
                    
                    
                    //###### Doctors route ##########################################
                    
                            Route::resource('Doctors', DoctorController::class);
                    
                    //###### end Doctors route ######################################
                    

                    //###### Services route ##########################################
                    Route::resource('Service', Single_service_Controller::class);

                    //###### end Services route ######################################

                    //###### Grup Services route ##########################################
                        Route::view('create_group_services', 'livewire.GroupServices.include_create')->name('create_group_services');
                    //###### Grup Services route ######################################


                //###### insurances route ##########################################
                Route::resource('insurances', InsuranceController::class);
                //###### insurances route ######################################


                //###### Ambulances route ##########################################
                Route::resource('Ambulances', AmbulanceController::class);
                //###### Ambulances route ######################################

                //############################# Patients route ##########################################

                Route::resource('Patients', PatientController::class);

                //############################# end Patients route ######################################

                    //############################# single_invoices route ##########################################

                    Route::view('single_invoices','livewire.single_invoices.index')->name('single_invoices');

                    Route::view('Print_single_invoices','livewire.single_invoices.print')->name('Print_single_invoices');

                    //############################# end single_invoices route ######################################
                

                    //############################# Receipt route ##########################################

                    Route::resource('Receipt', ReceiptAccountController::class);



                    //############################# end Receipt route ######################################

                    //############################# Payment route ##########################################

                            Route::resource('Payment', PaymentAccountController::class);

                    //############################# end Payment route ######################################
                    
                    
                    //############################# RayEmployee route ##########################################

                    Route::resource('ray_employee', RayEmployeeController::class);

                    //############################# end RayEmployee route ######################################


                    //############################# laboratorie_employee route ##########################################

                     Route::resource('laboratorie_employee', LaboratorieEmployeeController::class);

                    //############################# end laboratorie_employee route ######################################


                    //############################# group_invoices route ##########################################

                    Route::view('group_invoices','livewire.group_invoices.index')->name('group_invoices');

                    Route::view('Print_group_invoices','livewire.group_invoices.print')->name('group_Print_single_invoices');
                    

                    //############################# end group_invoices route ######################################
                });


                Route::put('/insurance/{id}/status', [InsuranceController::class, 'updateStatus'])->name('InsuranceStatus');

                    Route::put('/Doctor/{id}/status', [DoctorController::class, 'updateStatus'])->name('DoctorupdateStatus');
                    Route::put('/service/{id}/update-status', [Single_service_Controller::class, 'updateStatus'])->name('ServiceupdateStatus');
                    Route::put('/Ambulance/{id}/status', [AmbulanceController::class, 'updateStatus'])->name('AmbulanceStatus');
                    Route::put('/employee/{id}/status', [RayEmployeeController::class, 'updateStatus'])->name('EmployeeUpdateStatus');
                    Route::put('/lab_employee/{id}/status', [LaboratorieEmployeeController::class, 'updateStatus'])->name('lab_EmployeeUpdateStatus');



                });


// #################### end dashboard admin ######################################################################################



