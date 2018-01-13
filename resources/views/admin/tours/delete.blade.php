@include('admin.pageTypes.delete', [
    'title' => 'Delete Tour',
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
    'model' => $tour,
    'action' => action('Admin\TourController@destroy', $tour->id)
]);
