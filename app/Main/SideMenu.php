<?php

namespace App\Main;

use Illuminate\Support\Facades\Auth;

class SideMenu
{
    /**
     * List of side menu items based on role_id.
     *
     * @return array
     */
    public static function menu()
    {
        // تحقق مما إذا كان المستخدم مسجلاً
        if (!Auth::check()) {
            return []; // إرجاع قائمة فارغة إذا لم يكن هناك مستخدم
        }

        $userRoleId = Auth::user()->role_id;

        // إرجاع القائمة بناءً على role_id
        switch ($userRoleId) {
            case 1:
                return self::getAdminMenu();
            case 2:
                return self::getUserMenu();
            case 3:
                return self::getGuestMenu();
            case 4:
                return self::getRayEmployeeMenu();
            case 5:
                return self::getLabEmployeeMenu();
            default:
                return []; // إرجاع قائمة فارغة لأي دور آخر
        }
    }

    private static function getAdminMenu()
    {
        return [
            'devider',
            'forms' => [
                'icon' => 'home',
                'title' => __('messages.dashboard'), // ترجمة
                'route_name' => 'dashboard-overview-1',
                'params' => [
                    'layout' => 'side-menu'
                ],
                
            ],
            'crud' => [
                'icon' => 'users',
                'title' => __('messages.user_management'), // ترجمة
                'sub_menu' => [
                    'user-management' => [
                        'icon' => '',
                        'route_name' => 'user-mangment',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.user_management') // ترجمة
                    ],
                    
                ],
            ],
           'Section' => [
                'icon' => 'users',
                'title' => __('messages.section'), // ترجمة
                'sub_menu' => [
                    'Section-management' => [
                        'icon' => '',
                        'route_name' => 'Section.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.section') // ترجمة
                    ],
                ],
            ],

            // --------------------------------------------------------------------------------------------------------------------------
            'Patients' => [
                'icon' => 'users',
                'route_name' => 'Patients.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => __('messages.patients') // ترجمة
            ],

            'Invoices' => [
                'icon' => 'users',
                'title' => __('messages.invoices'), // ترجمة
                'sub_menu' => [
                    'Single-Invoices' => [
                        'icon' => 'users',
                        'route_name' => 'single_invoices',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.single_invoices') // ترجمة
                    ],
                    'group_invoices' => [
                        'icon' => 'users',
                        'route_name' => 'group_invoices',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.group_invoices') // ترجمة
                    ],
                ],
            ],

            'ooo' => [
                'icon' => 'fa-solid fa-x-ray fa-2x',  
                'title' => __('messages.x_ray_section'), // ترجمة
                'route_name' => 'ray_employee.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
            ],

            'lab' => [
                'icon' => 'fa-solid fa-flask-vial fa-bounce fa-2x',  
                'title' => __('messages.laboratory'), // ترجمة
                'route_name' => 'laboratorie_employee.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
            ],
            'Accounting-Department' => [
                'icon' => 'users',
                'title' => __('messages.accounting'), // ترجمة
                'sub_menu' => [
                    'Receipt-voucher' => [
                        'icon' => 'users',
                        'route_name' => 'Receipt.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.receipt_voucher') // ترجمة
                    ],
                    'Payment-voucher' => [
                        'icon' => 'users',
                        'route_name' => 'Payment.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.payment_voucher') // ترجمة
                    ],
                ],  
            ],  

            // ----------------------------------------------------------------------------------------------------------------------
            'Doctors' => [
                'icon' => 'users',
                'title' => __('messages.doctors'), // ترجمة
                'sub_menu' => [
                    'Doctors-management' => [
                        'icon' => '',
                        'route_name' => 'Doctors.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.doctors_management') // ترجمة
                    ],
                   
                ],
            ],

            'services' => [
                'icon' => 'users',
                'title' => __('messages.services'), // ترجمة
                'sub_menu' => [
                    
                    'single-service' => [
                        'icon' => '',
                        'route_name' => 'Service.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.single_service') // ترجمة
                    ],

                    'services-group' => [
                        'icon' => 'users',
                        'route_name' => 'create_group_services',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.services_group') // ترجمة
                    ],

                    'insurance-companies' => [
                        'icon' => 'users',
                        'route_name' => 'insurances.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.insurance_companies') // ترجمة
                    ],

                    'ambulance' => [
                        'icon' => 'users',
                        'route_name' => 'Ambulances.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.ambulance') // ترجمة
                    ],
                    'ambulance-calls' => [
                        'icon' => 'users',
                        'route_name' => 'Doctors.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.ambulance_calls') // ترجمة
                    ],
                    
                ],
            ],


               'Patients' => [
                'icon' => 'users',
                        'route_name' => 'Patients.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.patients') // ترجمة
                    ],

                    'Invoices' => [
                        'icon' => 'users',
                        'title' => __('messages.invoices'), // ترجمة
                        'sub_menu' => [
                            'Single-Invoices' => [
                                'icon' => 'users',
                                'route_name' => 'single_invoices',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => __('messages.single_invoices') // ترجمة
                            ],
                            'group_invoices' => [
                                'icon' => 'users',
                                'route_name' => 'group_invoices',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => __('messages.group_invoices') // ترجمة
                            ],
                        ],
                    ],

                    'ooo' => [
                            'icon' => 'fa-solid fa-x-ray fa-2x',  
                            'title' => __('messages.x_ray_section'), // ترجمة
                            'route_name' => 'ray_employee.index',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                        ],

                        'lab' => [
                            'icon' => 'fa-solid fa-flask-vial fa-bounce fa-2x',  
                            'title' => __('messages.laboratory'), // ترجمة
                            'route_name' => 'laboratorie_employee.index',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                        ],
                        'Accounting-Department' => [
                        'icon' => 'users',
                        'title' => __('messages.accounting'), // ترجمة
                        'sub_menu' => [
                            'Receipt-voucher' => [
                                'icon' => 'users',
                                'route_name' => 'Receipt.index',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => __('messages.receipt_voucher') // ترجمة
                            ],
                            'Payment-voucher' => [
                                'icon' => 'users',
                                'route_name' => 'Payment.index',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => __('messages.payment_voucher') // ترجمة
                            ],
                        ],  
                    ],  


                    'Appointment' => [
                        'icon' => 'users',
                        'title' => __('messages.appointment'), // ترجمة
                        'sub_menu' => [
                            
                                                    'confirmed' => [
                                                        'icon' => '',
                                                        'route_name' => 'appointments.index',
                                                        'params' => [
                                                            'layout' => 'side-menu'
                                                        ],
                                                        'title' => __('messages.confirmed_appointment') // ترجمة
                                                    ],
                                                        'Pending' => [
                                                            'icon' => '',
                                                            'route_name' => 'user-mangment',
                                                            'params' => [
                                                                'layout' => 'side-menu'
                                                            ],
                                                            'title' => __('messages.pending_appointment') // ترجمة
                                                        ],
                    
                                                        'Expired' => [
                                                            'icon' => '',
                                                            'route_name' => 'user-mangment',
                                                            'params' => [
                                                                'layout' => 'side-menu'
                                                            ],
                                                            'title' => __('messages.expired_appointment') // ترجمة
                                                ],
                                                // Route::get('appointments',[AppointmentController::class,'index'])->name('appointments.index');
                                                // Route::put('appointments/approval/{id}',[AppointmentController::class,'approval'])->name('appointments.approval');
                                                // Route::get('appointments/approval',[AppointmentController::class,'index2'])->name('appointments.index2');

                        ],
                    ],
        ];
    }

    private static function getUserMenu()
    {
        return [
            'devider',
            'Consultations' => [
                'icon' => 'users',
                'title' => __('messages.diagnostics'), // ترجمة
                'sub_menu' => [
                    'Diagnostics-List' => [
                        'icon' => '',
                        //  'route_name' => 'invoices.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.diagnostics_list') // ترجمة
                    ],

                    'C-Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'completedInvoices_d',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.completed_diagnostics') // ترجمة
                    ],
                    
                    'Reviews-List' => [
                        'icon' => '',
                        'route_name' => 'reviewInvoices',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.reviews_list') // ترجمة
                    ],
                ],
            ],
        ];
    }

    private static function getGuestMenu()
    {
        return [
            'devider',
            'information' => [
                'icon' => 'info',
                'title' => __('messages.dashboard'), // ترجمة
                'route_name' => 'dashboard-overview-Patient',
                'params' => [
                    'layout' => 'side-menu'
                ],
            ],

            'Consultations' => [
                'icon' => 'info',
                'title' => __('messages.patient_information'), // ترجمة
                'sub_menu' => [

                    'invoices-List' => [
                        'icon' => '',
                        'route_name' => 'invoices.patient',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.invoices_list') // ترجمة
                    ],

                    'xRay-List' => [
                        'icon' => '',
                        'route_name' => 'rays.patient',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.x_ray_list') // ترجمة
                    ],

                    'C-Diagnostics-List' => [
                        'icon' => 'info',
                        'route_name' => 'laboratories.patient',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.laboratory_list') // ترجمة
                    ],
                    
                ],
            
            ],

            'Chat' => [
                'icon' => 'users',
                'title' => __('messages.conversations'), // ترجمة
                'sub_menu' => [
                    'Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'list.doctors',
                        'params' => [
                            
                        ],
                        'title' => __('messages.doctor_list') // ترجمة
                    ],

                    'C-Diagnostics-List' => [
                        'icon' => '',
                        // 'route_name' => '',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.last_conversations') // ترجمة
                    ],
                    
                   
                ],
            ],
        ];
    }

    private static function getRayEmployeeMenu(){

        return [
            
            'devider',
            'forms' => [
                'icon' => 'home',
                'title' => __('messages.dashboard'), // ترجمة
                'route_name' => 'dashboard-ray-emplyee',
                'params' => [
                    'layout' => 'side-menu'
                ],
                
            ],
            'Consultations' => [
                'icon' => 'users',
                'title' => __('messages.diagnostics'), // ترجمة
                'sub_menu' => [
                    'Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'invoices_ray_employee.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.diagnostics_in_progress') // ترجمة
                    ],

                    'C-Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'invoices_ray_employee.create',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.completed_diagnostics') // ترجمة
                    ],
                ],
            
            ],
        ];
    }


    private static function getLabEmployeeMenu(){
       
        return [
            
            'devider',
            'forms' => [
                'icon' => 'home',
                'title' => __('messages.dashboard'), // ترجمة
                'route_name' => 'dashboard-ray-emplyee',
                'params' => [
                    'layout' => 'side-menu'
                ],
                
            ],
            'Consultations' => [
                'icon' => 'users',
                'title' => __('messages.diagnostics'), // ترجمة
                'sub_menu' => [
                    'Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'invoices_laboratorie_employee.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.diagnostics_in_progress') // ترجمة
                    ],

                    'C-Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'completed_invoices',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => __('messages.completed_diagnostics') // ترجمة
                    ],
                ],
            
            ],
        ];
    }
}
