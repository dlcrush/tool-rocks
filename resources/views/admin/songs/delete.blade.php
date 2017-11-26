@include('admin.pageTypes.delete', [
    'title' => 'Delete Song',
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
    'model' => $song,
    'action' => action('Admin\SongController@destroy', $song->id)
]);
