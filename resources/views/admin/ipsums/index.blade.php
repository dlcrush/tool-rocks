@include("admin.pageTypes.all", [
    'title' => 'Ipsums',
    'page' => 'ipsums',
    'filters' => [
        'band' => [
            'bands' => $bands,
            'current' => $bandId
        ]
    ],
    'createButton' => [
        'text' => 'New Ipsum',
        'href' => action('Admin\IpsumController@create')
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
                        'action' => 'Admin\IpsumController@edit',
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
                        'action' => 'Admin\IpsumController@delete',
                        'params' => [
                            'id' => 'id'
                        ]
                    ]
                ]
            ]
        ],
        'data' => $ipsums
    ]
])
