@include("admin.pageTypes.all", [
    'title' => 'Songs',
    'filters' => [
        'band' => [
            'bands' => $bands,
            'current' => $bandId
        ]
    ],
    'createButton' => [
        'text' => 'New Song',
        'href' => action('Admin\SongController@create')
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
                'header' => 'Has Lyrics',
                'valueKey' => 'has_lyrics'
            ],
            [
                'type' => 'button',
                'button' => [
                    'type' => 'edit',
                    'text' => 'Edit',
                    'href' => [
                        'action' => 'Admin\SongController@edit',
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
                        'action' => 'Admin\SongController@delete',
                        'params' => [
                            'id' => 'id'
                        ]
                    ]
                ]
            ]
        ],
        'data' => $songs
    ]
])
