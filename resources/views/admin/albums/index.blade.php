@include("admin.pageTypes.all", [
    'title' => 'Albums',
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
                    'href' => '#'
                ]
            ],
            [
                'type' => 'button',
                'button' => [
                    'type' => 'delete',
                    'text' => 'Delete',
                    'href' => '#'
                ]
            ]
        ],
        'data' => $albums
    ]
])
