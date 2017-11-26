@include("admin.pageTypes.all", [
    'title' => 'Bands',
    'createButton' => [
        'text' => 'New Band',
        'href' => action('Admin\BandController@create')
    ],
    'table' => [
        'columns' => [
            [
                'header' => 'id',
                'valueKey' => 'id'
            ],
            [
                'header' => 'Name',
                'valueKey' => 'name'
            ],
            [
                'header' => 'Slug',
                'valueKey' => 'slug'
            ],
            [
                'type' => 'button',
                'button' => [
                    'type' => 'edit',
                    'text' => 'Edit',
                    'href' => [
                        'action' => 'Admin\BandController@edit',
                        'params' => [
                            'id' => 'id'
                        ]
                    ]
                ]
            ],
            [
                'type' => 'button',
                'button' => [
                    'type' => 'delete',
                    'text' => 'Delete',
                    'href' => [
                        'action' => 'Admin\BandController@delete',
                        'params' => [
                            'id' => 'id'
                        ]
                    ]
                ]
            ]
        ],
        'data' => $bands
    ]
])
