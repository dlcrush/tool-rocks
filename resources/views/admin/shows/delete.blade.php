@include('admin.pageTypes.delete', [
    'title' => 'Delete Show',
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
    'model' => $show,
    'action' => action('Admin\ShowController@destroy', $show->id)
]);
