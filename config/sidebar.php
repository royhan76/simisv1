<?php

return [

    'menu' => [

        [
            'title' => 'Dashboard',
            'icon' => 'fas fa-home',
            'route' => [
                'admin' => '/admin',
                'sekretaris' => '/sekretaris',
                'bendahara' => '/bendahara',
                'maarif' => '/maarif',
                'keamanan' => '/keamanan'
            ],
            'roles' => ['admin','sekretaris','bendahara','maarif','keamanan']
        ],

        [
            'title' => 'Master',
            'icon' => 'fas fa-layer-group',
            'roles' => ['admin'],
            'submenu' => [

                [
                    'title' => 'Data Masyayikh',
                    'url' => '/masyayikh/dataMasyayikh'
                ],

                [
                    'title' => 'Struktur Organisasi',
                    'url' => '/sekretaris/strukturorg'
                ],

                [
                    'title' => 'Data Santri',
                    'url' => '/admin/alldatasantri'
                ],

                [
                    'title' => 'Pengguna',
                    'url' => '/admin/users'
                ],

                [
                    'title' => 'Master Bendahara',
                    'url' => '/admin/bendahara/mBendahara'
                ]


            ]
        ],
        [
            'title' => 'Master',
            'icon' => 'fas fa-layer-group',
            'roles' => ['sekretaris'],
            'submenu' => [

                [
                    'title' => 'Data Santri',
                    'url' => '/admin/alldatasantri'
                ],
            ]
        ],

        [
            'title' => 'Pendaftaran Santri',
            'icon' => 'fas fa-pen-square',
            'roles' => ['admin','sekretaris'],
            'submenu' => [

                [
                    'title' => 'Santri Baru',
                    'url' => '/admin/form_baru'
                ],

                [
                    'title' => 'Santri Lama',
                    'url' => '/admin/form_lama'
                ],

            ]
        ],

        [
            'title' => 'Bendahara',
            'icon' => 'fas fa-money-bill',
            'roles' => ['admin','bendahara'],
            'submenu' => [

                [
                    'title' => 'Pembayaran Santri',
                    'url' => 'admin/bendahara'
                ]

            ]
        ],


        [
            'title' => 'Ma\'arif',
            'icon' => 'fas fa-table',
            'roles' => ['admin','maarif'],
            'submenu' => [

                [
                    'title' => 'Data Pendidikan',
                    'url' => '/maarif'
                ]

            ]
        ],

        [
            'title' => 'Keamanan',
            'icon' => 'fas fa-shield-alt',
            'roles' => ['admin','keamanan'],
            'submenu' => [

                [
                    'title' => 'Pelanggaran Santri',
                    'url' => '/keamanan'
                ]

            ]
        ],

        // [
        //     'title' => 'Keuangan',
        //     'icon' => 'fas fa-money-bill',
        //     'roles' => ['admin','bendahara'],
        //     'url' => '/bendahara'
        // ],

    ]

];
