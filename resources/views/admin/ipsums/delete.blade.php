@include('admin.pageTypes.delete', [
    'title' => 'Delete Ipsum',
    'rows' => [
        [
            'label' => 'ID:',
            'valueKey' => 'id'
        ],
        [
            'label' => 'Ipsum:',
            'valueKey' => 'content'
        ]
    ],
    'model' => $ipsum,
    'action' => action('Admin\IpsumController@destroy', $ipsum->id)
])
