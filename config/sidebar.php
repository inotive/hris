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
            'label' => 'Management Company',
            'roles' => ['superadmin', 'admin'],
            'children' => [
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
            ],
        ],

        [
            'icon' => 'icons.user',
            'label' => 'Management Employee',
            'roles' => ['superadmin', 'admin', 'finance'],
            'children' => [
                [
                    'label' => 'Employee Departments',
                    'route' => 'employee-departments.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'employee-departments.*' => ['superadmin','admin'],
                    ],
                ],
                [
                    'label' => 'Employee Positions',
                    'route' => 'employee-positions.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'employee-positions.*' => ['superadmin','admin'],
                    ],
                ],

                [
                    'label' => 'Employee Levels',
                    'route' => 'employee-levels.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'employee-levels.*' => ['superadmin','admin'],
                    ],
                ],
                [
                    'label' => 'Employee Shifts',
                    'route' => 'employee-shifts.index',
                    'roles' => ['superadmin', 'admin'],

                    'routes'    => [
                        'employee-shifts.*' => ['superadmin','admin'],
                    ],
                ],
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
                        'employee-reset-password'   => ['superadmin', 'admin', 'finance','content'],
                    ],
                ],
            ],
        ],
        [
            'icon' => 'icons.clipboard',
            'label' => 'Management Attendances',
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
            'label' => 'Management Leave',
            'roles' => ['superadmin', 'admin', 'finance'],
            'children' => [
                [
                    'label' => 'Master Leave Types',
                    'route' => 'leave-types.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'leave-types.*' => ['superadmin','admin'],
                    ],
                ],
                [
                    'label' => 'Leave Requests',
                    'route' => 'leave-requests.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
                    'routes'    => [
                        'leave-requests.*' => ['superadmin','admin','finance'],
                    ],
                ],
            ],
        ],

        [
            'icon' => 'icons.timer',
            'label' => 'Management Overtime',
            'roles' => ['superadmin', 'admin'],
            'children' => [
                [
                    'label' => 'Master Overtime Shifts',
                    'route' => 'overtime-shift-requests.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes'    => [
                        'overtime-shift-requests.*' => ['superadmin', 'admin'],
                    ],
                ],
                [
                    'label' => 'Overtime Requests',
                    'route' => 'overtime-requests.index',
                    'roles' => ['superadmin', 'admin'],
                    'routes' => [
                        'overtime-requests.*' => ['superadmin','admin'],
                    ],
                ],
            ],
        ],

        [
            'icon' => 'icons.money',
            'label' => 'Management Reimbursement',
            'roles' => ['superadmin', 'admin', 'finance'],
            'children' => [
                [
                    'label' => 'Master Reimbursment Expenses',
                    'route' => '',
                    'roles' => ['superadmin', 'admin'],
                ],
                [
                    'label' => 'Master Reimbursment Types',
                    'route' => '',
                    'roles' => ['superadmin', 'admin'],
                ],
                [
                    'label' => 'Reimbursement Request',
                    'route' => '',
                    'roles' => ['superadmin', 'admin', 'finance'],
                ],
            ],
        ],

        [
            'icon' => 'icons.clipboard-list',
            'label' => 'Management Payslip',
            'roles' => ['superadmin', 'admin', 'finance'],
            'children' => [
                [
                    'label' => 'Master Category Payslips',
                    'route' => 'employee-payslip-masters.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
                    'routes'    => [
                        'employee-payslip-masters.*'    => ['superadmin', 'admin', 'finance'],
                    ],
                ],
                [
                    'label' => 'Payslips',
                    'route' => 'employee-payslip-details.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
                    'routes'    => [
                        'employee-payslip-details.*'    => ['superadmin', 'admin', 'finance'],
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
