@include('admin.pageTypes.delete', [
    'title' => 'Delete Album',
    'rows' => [
        [
            'label' => 'ID:',
            'valueKey' => 'id'
        ],
        [
            'label' => 'Name:',
            'valueKey' => 'name'
        ],
        [
            'label' => 'Slug:',
            'valueKey' => 'slug'
        ],
        [
            'label' => 'Band:',
            'valueKey' => 'band'
        ]
    ],
    'model' => $album,
    'action' => action('Admin\AlbumController@destroy', $album->id)
])
