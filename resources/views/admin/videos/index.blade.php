@include("admin.pageTypes.all", [
    'title' => 'Videos',
    'page' => 'videos',
    'filters' => [
        'band' => [
            'bands' => $bands,
            'current' => $bandId
        ]
    ],
    'createButton' => [
        'text' => 'New Video',
        'href' => action('Admin\VideoController@create')
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
            // [
            //     'header' => 'Description',
            //     'valueKey' => 'description'
            // ],
            [
                'type' => 'button',
                'button' => [
                    'type' => 'edit',
                    'text' => 'Edit',
                    'href' => [
                        'action' => 'Admin\VideoController@edit',
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
                        'action' => 'Admin\VideoController@delete',
                        'params' => [
                            'id' => 'id'
                        ]
                    ]
                ]
            ]
        ],
        'data' => $videos
    ]
])
