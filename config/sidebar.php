<?php

// sidebar menu by role

return [
    'menus' => [
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
            'icon' => 'icons.user',
            'label' => 'User',
            'route' => 'users.index',
            'roles' => ['superadmin'],
            'routes' => [
                'users.*'   => ['superadmin'],
                'user.*'   => ['superadmin','admin', 'finance','content'],
            ],
        ],

        [
            'icon' => 'icons.building',
            'label' => 'Company',
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
            'roles' => ['superadmin', 'admin', 'finance'],
            'children_tab'    => true,
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
            'roles' => ['superadmin', 'admin', 'finance'],
            'children' => [
                [
                    'label' => 'Leave',
                    'route' => 'leave-requests.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
                    'routes'    => [
                        'leave-requests.*' => ['superadmin','admin','finance'],
                    ],
                ],
                [
                    'label' => 'Leave Types',
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
            'roles' => ['superadmin', 'admin'],
            'children' => [
                [
                    'label' => 'Overtime',
                    'route' => 'overtime-requests.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes' => [
                        'overtime-requests.*' => ['superadmin','admin'],
                    ],
                ],
                [
                    'label' => 'Overtime Shifts',
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
            'roles' => ['superadmin', 'admin', 'finance'],
            'children' => [
                [
                    'label' => 'Reimbursement',
                    'route' => 'reimbursement-requests.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
                    'routes'    => [
                        'reimbursement-requests.*' => ['superadmin','admin','finance'],
                    ],
                    
                ],
                [
                    'label' => 'Reimbursment Expenses',
                    'route' => 'reimbursement-expenses.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'reimbursement-expenses.*' => ['superadmin','admin'],
                    ],
                ],
                [
                    'label' => 'Reimbursment Types',
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
                    'label' => 'Category Payslips',
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
            'icon' => 'icons.cloud',
            'label' => 'EWA',
            'route' => '',
            'roles' => ['superadmin', 'admin', 'finance'],
        ],

        [
            'icon' => 'icons.image',
            'label' => 'Content',
            'roles' => ['superadmin', 'admin', 'content'],
            'children' => [
                [
                    'label' => 'Banners',
                    'route' => 'banners.index',
                    'roles' => ['superadmin', 'admin', 'content'],
                    'routes'    => [
                        'banners.*' => ['superadmin','admin','content'],
                    ],
                ],
                [
                    'label' => 'Post',
                    'route' => 'posts.index',
                    'roles' => ['superadmin', 'admin', 'content'],
                    'routes'    => [
                        'posts.*' => ['superadmin','admin','content'],
                    ],
                ],
                [
                    'label' => 'Announcement',
                    'route' => 'announcements.index',
                    'roles' => ['superadmin', 'admin', 'content'],
                    'routes'    => [
                        'announcements.*' => ['superadmin','admin','content'],
                    ],
                ],
            ],
        ],
    ],
];
