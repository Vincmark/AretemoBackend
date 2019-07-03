<?php

$menuList = [
    [
        // Dashboard
        'type' => 'item',
        'title' => 'Dashboard',
        'uri' => 'dashboard',
        'icon' => ''
    ],
    [
        // HABITS
        'type' => 'section',
        'title' => 'Habits',
        'uri' => '',
        'icon' => ''

    ],
    [
        // Dictionaries
        'type' => 'item',
        'title' => 'Dictionaries',
        'uri' => 'dictionaries',
        'icon' => ''

    ],
    [
        // Habits
        'type' => 'item',
        'title' => 'Habits',
        'uri' => 'habits',
        'icon' => ''
    ],
    [
        // ADMIN
        'type' => 'section',
        'title' => 'Admin',
        'uri' => '',
        'icon' => ''
    ],
    [
        // Admins
        'id' => '1',
        'type' => 'item',
        'title' => 'Admins',
        'uri' => 'admins',
        'icon' => ''
    ],
    [
        // Settings
        'type' => 'item',
        'title' => 'Settings',
        'uri' => 'settings',
        'icon' => ''
    ],
    [
        // USER
        'type' => 'section',
        'title' => 'User',
        'uri' => '',
        'icon' => ''
    ],
    [
        // Profile
        'type' => 'item',
        'title' => 'Profile',
        'uri' => 'profile',
        'icon' => ''
    ]
];

$pages = [
    [
        // login
        'id' => '1',
        'uri' => 'login',
        'title' => 'Login',
        'h1' => 'Login',
        'description' => 'Login',
        'breadCrambs' => [
            [
                'title' => '',
                'link' => ''
            ],
            [
                'title' => '',
                'link' => ''
            ],
            [
                'title' => '',
                'link' => ''
            ]
        ]

    ],
    [
        // dashboard
        'id' => '2',
        'uri' => 'dashboard',
        'title' => 'Dashboard',
        'h1' => 'Dashboard',
        'description' => 'Dashboard',
        'breadCrambs' => [
            [
                'title' => 'Dashboard',
                'link' => ''
            ]
        ]
    ],
    [
        // users
        'id' => '3',
        'uri' => 'admins',
        'title' => 'Admins',
        'h1' => 'Admins',
        'description' => 'Admins',
        'breadCrambs' => [
            [
                'title' => 'Amins',
                'link' => ''
            ]
        ]
    ],
    [
        // user
        'id' => '4',
        'uri' => 'admin',
        'title' => 'Admin',
        'h1' => 'Admin',
        'description' => 'Admin',
        'breadCrambs' => [
            [
                'title' => 'Admins',
                'link' => ''
            ],
            [
                'title' => 'Admin',
                'link' => ''
            ]
        ]
    ],
    [
        // profile
        'id' => '5',
        'uri' => 'profile',
        'title' => 'Profile',
        'h1' => 'Profile',
        'description' => 'Profile',
        'breadCrambs' => [
            [
                'title' => 'Profile',
                'link' => ''
            ],
        ]
    ],
    [
        // dictionaries
        'id' => '6',
        'uri' => 'dictionaries',
        'title' => 'Dictionaries',
        'h1' => 'Dictionaries',
        'description' => 'Dictionaries',
        'breadCrambs' => [
            [
                'title' => 'Dictionaries',
                'link' => ''
            ],
        ]
    ],
    [],
    [],
    [],
    [],
    [],
    [],
    [],
    [],
    []
];