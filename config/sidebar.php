<?php

// sidebar menu by role

return [
    'menus' => [
        [
            'header_menu'=> 'MAIN MENU',
        ],

        [
            'icon' => 'icons.dashboard',
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'roles' => ['superadmin', 'admin', 'finance', 'content'],
            'routes'    => [
                'change-language'   => ['superadmin','admin','finance','content'],
            ]
        ],

       

        [
            'icon' => 'icons.building',
            'label' => 'Company',
            'page_title' => 'Management Company',
            'roles' => ['superadmin', 'admin'],
            
            'children' => [
                [
                    'label' => 'Companies',
                    'route' => 'companies.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'companies.index'   => ['superadmin', 'admin'],
                        'companies.create'   => ['superadmin'],
                        'companies.store'   => ['superadmin'],
                        'companies.edit'   => ['superadmin','admin'],
                        'companies.update'   => ['superadmin','admin'],
                        'companies.destroy'   => ['superadmin'],
                        'companies.select2'   => ['superadmin','admin','finance','content'],
                        'companies.payout-setting'   => ['superadmin','admin'],
                        'companies.payout-setting.*'   => ['superadmin','admin'],
                    ],
                ],
                [
                    'label' => 'Company Subscriptions',
                    'route' => 'company-subscriptions.index',
                    'roles' => ['superadmin','admin'],
                    'routes'    => [
                        'company-subscriptions.index'   => ['superadmin', 'admin'],
                        'company-subscriptions.create'   => ['superadmin'],
                        'company-subscriptions.store'   => ['superadmin'],
                        'company-subscriptions.edit'   => ['superadmin'],
                        'company-subscriptions.update'   => ['superadmin'],
                        'company-subscriptions.destroy'   => ['superadmin'],
                    ],
                ],
               
            ],
        ],

        [
            'icon' => 'icons.user',
            'label' => 'Employee',
            'page_title' => 'Management Employee',
            'roles' => ['superadmin', 'admin', 'finance'],
            
            'children' => [
                [
                    'label' => 'Employees',
                    'route' => 'employees.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
                    'routes' => [
                        'employees.*'   => ['superadmin', 'admin', 'finance'],
                        'emergency-contact.*'   => ['superadmin', 'admin', 'finance'],
                        'family-info.*'   => ['superadmin', 'admin', 'finance'],
                        'organization-experience.*'   => ['superadmin', 'admin', 'finance'],
                        'education.*'   => ['superadmin', 'admin', 'finance'],
                        'contract.*'   => ['superadmin', 'admin', 'finance'],
                        'employee-reset-password'   => ['superadmin', 'admin', 'finance','content'],
                    ],
                ],
                [
                    'label' => 'Departments',
                    'route' => 'employee-departments.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'employee-departments.*' => ['superadmin','admin'],
                    ],
                ],
                [
                    'label' => 'Positions',
                    'route' => 'employee-positions.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'employee-positions.*' => ['superadmin','admin'],
                    ],
                ],

                [
                    'label' => 'Levels',
                    'route' => 'employee-levels.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'employee-levels.*' => ['superadmin','admin'],
                    ],
                ],
                [
                    'label' => 'Shifts',
                    'route' => 'employee-shifts.index',
                    'roles' => ['superadmin', 'admin'],

                    'routes'    => [
                        'employee-shifts.*' => ['superadmin','admin'],
                    ],
                ],
               
            ],
        ],
        [
            'icon' => 'icons.clipboard',
            'label' => 'Attendances',
            'page_title' => 'Management Attendances',
            'roles' => ['superadmin', 'admin', 'finance'],
            
            'children' => [
                [
                    'label' => 'Attendances',
                    'route' => 'attendances.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'attendances.*' => ['superadmin','admin'],
                    ],
                ],
                [
                    'label' => 'Report Attendances',
                    'route' => '',
                    'roles' => ['superadmin', 'admin', 'finance'],
                ],
            ],
        ],

        [
            'icon' => 'icons.signout',
            'label' => 'Leave',
            'page_title' => 'Management Leave',
            'roles' => ['superadmin', 'admin', 'finance'],
            
            'children' => [
                [
                    'label' => 'Leave Requests',
                    'route' => 'leave-requests.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
                    'routes'    => [
                        'leave-requests.*' => ['superadmin','admin','finance'],
                    ],
                ],
                [
                    'label' => 'Master Leave Types',
                    'route' => 'leave-types.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'leave-types.*' => ['superadmin','admin'],
                    ],
                ],
               
            ],
        ],

        [
            'icon' => 'icons.timer',
            'label' => 'Overtime',
            'page_title' => 'Management Overtime',
            'roles' => ['superadmin', 'admin'],
            
            'children' => [
                [
                    'label' => 'Overtime Requests',
                    'route' => 'overtime-requests.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes' => [
                        'overtime-requests.*' => ['superadmin','admin'],
                    ],
                ],
                [
                    'label' => 'Master Overtime Shifts',
                    'route' => 'overtime-shift-requests.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'overtime-shift-requests.*' => ['superadmin', 'admin'],
                    ],
                ],
              
            ],
        ],

        [
            'icon' => 'icons.money',
            'label' => 'Reimbursement',
            'page_title' => 'Management Reimbursement',
            'roles' => ['superadmin', 'admin', 'finance'],
            
            'children' => [
                [
                    'label' => 'Reimbursement Request',
                    'route' => 'reimbursement-requests.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
                    'routes'    => [
                        'reimbursement-requests.*' => ['superadmin','admin','finance'],
                    ],
                    
                ],
                [
                    'label' => 'Master Reimbursment Expenses',
                    'route' => 'reimbursement-expenses.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'reimbursement-expenses.*' => ['superadmin','admin'],
                    ],
                ],
                [
                    'label' => 'Master Reimbursment Types',
                    'route' => 'reimbursement-types.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'reimbursement-types.*' => ['superadmin','admin'],
                    ],
                ],
              
            ],
        ],

        [
            'icon' => 'icons.clipboard-list',
            'label' => 'Payslip',
            'page_title' => 'Management Payslip',
            'roles' => ['superadmin', 'admin', 'finance'],
            
            'children' => [
                [
                    'label' => 'Payslips',
                    'route' => 'employee-payslips.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
                    'routes'    => [
                        'employee-payslips.*'    => ['superadmin', 'admin', 'finance'],
                    ],
                ],
                [
                    'label' => 'Master Category Payslips',
                    'route' => 'employee-payslip-masters.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
                    'routes'    => [
                        'employee-payslip-masters.*'    => ['superadmin', 'admin', 'finance'],
                    ],
                ],
               
                [
                    'label' => 'PTKP',
                    'route' => 'ptkp.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
                    'routes'    => [
                        'ptkp.*'    => ['superadmin'],
                        'ptkp.index'    => ['superadmin', 'admin', 'finance'],
                    ],
                ],
            ],
        ],

    
        [
            'border'=> 'true',
        ],
[
    'header_menu'=> 'CONTENT',
],
        [
            'icon' => 'icons.image',
            'label' => 'Banners',
            'route' => 'banners.index',
            'roles' => ['superadmin', 'admin', 'content'],
            'routes'    => [
                'banners.*' => ['superadmin','admin','content'],
            ],
        ],
        [
            'icon' => 'icons.image',
            'label' => 'Post',
            'route' => 'posts.index',
            'roles' => ['superadmin', 'admin', 'content'],
            'routes'    => [
                'posts.*' => ['superadmin','admin','content'],
            ],
        ],
        [
            'icon' => 'icons.image',
            'label' => 'Announcement',
            'route' => 'announcements.index',
            'roles' => ['superadmin', 'admin', 'content'],
            'routes'    => [
                'announcements.*' => ['superadmin','admin','content'],
            ],
        ],

        [
            'border'=> 'true',
        ],

        [
            'header_menu'=> 'OTHER',
        ],

        [
            'icon' => 'icons.cloud',
            'label' => 'EWA',
            'route' => '',
            'roles' => ['superadmin', 'admin', 'finance'],
        ],

        [
            'icon' => 'icons.user',
            'label' => 'User',
            'route' => 'users.index',
            'roles' => ['superadmin'],
            'routes' => [
                'users.*'   => ['superadmin'],
                'user.*'   => ['superadmin','admin', 'finance','content'],
            ],
        ],

      
    ],
];
