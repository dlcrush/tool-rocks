@include("admin.pageTypes.all", [
    'title' => 'Shows',
    'page' => 'shows',
    'filters' => [
        'band' => [
            'bands' => $bands,
            'current' => $bandId
        ],
        'tour' => [
            'tours' => $tours,
            'current' => $tourId,
            'bandId' => $bandId
        ]
    ],
    'createButton' => [
        'text' => 'New Show',
        'href' => action('Admin\ShowController@create')
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
                'header' => 'Date',
                'valueKey' => 'date'
            ],
            [
                'type' => 'button',
                'button' => [
                    'type' => 'edit',
                    'text' => 'Edit',
                    'href' => [
                        'action' => 'Admin\ShowController@edit',
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
                        'action' => 'Admin\ShowController@delete',
                        'params' => [
                            'id' => 'id'
                        ]
                    ]
                ]
            ]
        ],
        'data' => $shows
    ]
])
