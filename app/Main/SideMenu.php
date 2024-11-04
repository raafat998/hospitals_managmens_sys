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
                'title' => 'Dashboard',
                'route_name' => 'dashboard-overview-1',
                'params' => [
                    'layout' => 'side-menu'
                ],
                
            ],
            'crud' => [
                'icon' => 'users',
                'title' => 'User management',
                'sub_menu' => [
                    'user-management' => [
                        'icon' => '',
                        'route_name' => 'user-mangment',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'User Management'
                    ],
                    
                ],
            ],
           'Section' => [
    'icon' => 'users',
    'title' => 'Section',
    'sub_menu' => [
        'Section-management' => [
            'icon' => '',
            'route_name' => 'Section.index',
            'params' => [
                'layout' => 'side-menu'
            ],
            'title' => 'Section'
        ],
    ],
],
            'Doctors' => [
                'icon' => 'users',
                'title' => 'Doctors',
                'sub_menu' => [
                    'Doctors-management' => [
                        'icon' => '',
                        'route_name' => 'Doctors.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Doctors Management'
                    ],
                   
                ],
            ],

            'services' => [
                'icon' => 'users',
                'title' => 'services',
                'sub_menu' => [
                    
                    'single-service' => [
                        'icon' => '',
                        'route_name' => 'Service.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Single Service'
                    ],

                    'services-group' => [
                        'icon' => 'users',
                        'route_name' => 'create_group_services',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Services Group'
                    ],

                    'insurance-companies' => [
                        'icon' => 'users',
                        'route_name' => 'insurances.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'insurance-companies'
                    ],

                    'ambulance' => [
                        'icon' => 'users',
                        'route_name' => 'Ambulances.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Ambulance'
                    ],
                    'ambulance-calls' => [
                        'icon' => 'users',
                        'route_name' => 'Doctors.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Ambulance Calls'
                    ],
                    
                ],
            ],



               'Patients' => [
                'icon' => 'users',
                        'route_name' => 'Patients.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Patients'
                    ],

                    'Invoices' => [
                        'icon' => 'users',
                        'title' => 'Invoices',
                        'sub_menu' => [
                            'Single-Invoices' => [
                                'icon' => 'users',
                                'route_name' => 'single_invoices',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Single Invoices'
                            ],
                            'group_invoices' => [
                                'icon' => 'users',
                                'route_name' => 'group_invoices',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'group invoices'
                            ],
                        ],
                    ],

                    'ooo' => [
                            'icon' => 'fa-solid fa-x-ray fa-2x',  
                            'title' => 'x ray section ',
                            'route_name' => 'ray_employee.index',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                        ],

                        'lab' => [
                            'icon' => 'fa-solid fa-flask-vial fa-bounce fa-2x',  
                            'title' => 'laboratorie',
                            'route_name' => 'laboratorie_employee.index',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                        ],
                        'Accounting-Department' => [
                        'icon' => 'users',
                        'title' => 'Accounting',
                        'sub_menu' => [
                            'Receipt-voucher' => [
                                'icon' => 'users',
                                'route_name' => 'Receipt.index',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Receipt voucher'
                            ],
                            'Payment-voucher' => [
                                'icon' => 'users',
                                'route_name' => 'Payment.index',
                                'params' => [
                                    'layout' => 'side-menu'
                                ],
                                'title' => 'Payment voucher'
                            ],
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
                'title' => 'Diagnostics',
                'sub_menu' => [
                    'Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'invoices.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Diagnostics List'
                    ],

                    'C-Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'completedInvoices_d',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => ' Completed Diagnostics '
                    ],
                    
                    'Reviews-List' => [
                        'icon' => '',
                        'route_name' => 'reviewInvoices',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Reviews List'
                    ],
                

                ],
            ],
        ];
    }
    
// dashboard-overview-3
    private static function getGuestMenu()
    {
        return [
            'devider',
            'information' => [
                'icon' => 'info',
                'title' => 'Dashboard',
                'route_name' => 'dashboard-overview-Patient',
                'params' => [
                    'layout' => 'side-menu'
                ],
            ],

            'Consultations' => [
                'icon' => 'info',
                'title' => 'Patient information',
                
                'sub_menu' => [

                    'invoices-List' => [
                        'icon' => '',
                        'route_name' => 'invoices.patient',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => ' invoices List'
                    ],

                    'xRay-List' => [
                        'icon' => '',
                        'route_name' => 'rays.patient',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => ' X-Ray List'
                    ],

                    'C-Diagnostics-List' => [
                        'icon' => 'info',
                        'route_name' => 'laboratories.patient',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => ' Laboratorie List'
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
                'title' => 'Dashboard',
                'route_name' => 'dashboard-ray-emplyee',
                'params' => [
                    'layout' => 'side-menu'
                ],
                
            ],
            'Consultations' => [
                'icon' => 'users',
                'title' => 'Diagnostics',
                'sub_menu' => [
                    'Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'invoices_ray_employee.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Diagnostics in progress List'
                    ],

                    'C-Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'invoices_ray_employee.create',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => ' Completed Diagnostics '
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
                'title' => 'Dashboard',
                'route_name' => 'dashboard-ray-emplyee',
                'params' => [
                    'layout' => 'side-menu'
                ],
                
            ],
            'Consultations' => [
                'icon' => 'users',
                'title' => 'Diagnostics',
                'sub_menu' => [
                    'Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'invoices_laboratorie_employee.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Diagnostics in progress List'
                    ],

                    'C-Diagnostics-List' => [
                        'icon' => '',
                        'route_name' => 'completed_invoices',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => ' Completed Diagnostics '
                    ],
                    

                

                ],
            
            ],
        ];
    }
}
