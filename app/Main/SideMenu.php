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
                        'route_name' => 'completedInvoices',
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
                'title' => 'Information',
                'route_name' => 'info.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
            ],
        ];
    }

    private static function getRayEmployeeMenu(){

        return [
            'devider',
            'ray-diagnostics' => [
                'icon' => 'info',
                'title' => 'Ray Diagnostics',
                'route_name' => 'dashboard-overview-4',
                'params' => [
                    'layout' => 'side-menu'
                ],
            ],
        ];

    }
}
