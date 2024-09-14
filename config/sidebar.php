<?php

// sidebar menu by role

return [
    'menus' => [
        [
            'icon' => 'icons.dashboard',
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'roles' => ['superadmin', 'admin', 'finance', 'content'],
        ],

        [
            'icon' => 'icons.user',
            'label' => 'User',
            'route' => 'users.index',
            'roles' => ['superadmin'],
        ],

        [
            'icon' => 'icons.building',
            'label' => 'Management Company',
            'roles' => ['superadmin', 'admin'],
            'children' => [
                [
                    'label' => 'Company Subscriptions',
                    'route' => '',
                    'roles' => ['superadmin'],
                ],
                [
                    'label' => 'Companies',
                    'route' => 'companies.index',
                    'roles' => ['superadmin'],
                ],

                [
                    'label' => 'My Company',
                    'route' => '',
                    'roles' => ['admin'],
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
                ],
                [
                    'label' => 'Employee Positions',
                    'route' => 'companies.index',
                    'roles' => ['superadmin', 'admin'],
                ],

                [
                    'label' => 'Employee Levels',
                    'route' => '',
                    'roles' => ['superadmin', 'admin'],
                ],
                [
                    'label' => 'Employee Shifts',
                    'route' => '',
                    'roles' => ['superadmin', 'admin'],
                ],
                [
                    'label' => 'Employees',
                    'route' => 'employees.index',
                    'roles' => ['superadmin', 'admin', 'finance'],
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
                    'route' => '',
                    'roles' => ['superadmin', 'admin'],
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
                    'route' => '',
                    'roles' => ['superadmin', 'admin'],
                ],
                [
                    'label' => 'Leave Requests',
                    'route' => '',
                    'roles' => ['superadmin', 'admin', 'finance'],
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
                    'route' => '',
                    'roles' => ['superadmin', 'admin'],
                ],
                [
                    'label' => 'Overtime Requests',
                    'route' => '',
                    'roles' => ['superadmin', 'admin'],
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
                    'route' => '',
                    'roles' => ['superadmin', 'admin', 'finance'],
                ],
                [
                    'label' => 'Payslips',
                    'route' => '',
                    'roles' => ['superadmin', 'admin', 'finance'],
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
                    'route' => '',
                    'roles' => ['superadmin', 'admin', 'content'],
                ],
                [
                    'label' => 'Post',
                    'route' => '',
                    'roles' => ['superadmin', 'admin', 'content'],
                ],
                [
                    'label' => 'Announcement',
                    'route' => '',
                    'roles' => ['superadmin', 'admin', 'content'],
                ],
            ],
        ],
    ],
];