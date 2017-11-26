@include('admin.pageTypes.delete', [
    'title' => 'Delete Band',
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
        ]
    ],
    'model' => $band,
    'action' => action('Admin\BandController@destroy', $band->id)
])
