@include("admin.pageTypes.all", [
    'title' => 'Maynardisms',
    'page' => 'maynardisms',
    'createButton' => [
        'text' => 'New Maynardism',
        'href' => action('Admin\MaynardismController@create')
    ],
    'table' => [
        'columns' => [
            [
                'header' => 'id',
                'valueKey' => 'id'
            ],
            [
                'header' => 'Content',
                'valueKey' => 'content'
            ],
            [
                'type' => 'button',
                'button' => [
                    'type' => 'edit',
                    'text' => 'Edit',
                    'href' => [
                        'action' => 'Admin\MaynardismController@edit',
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
                        'action' => 'Admin\MaynardismController@delete',
                        'params' => [
                            'id' => 'id'
                        ]
                    ]
                ]
            ]
        ],
        'data' => $maynardisms
    ]
])
