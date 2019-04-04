@include('admin.pageTypes.delete', [
    'title' => 'Delete Maynardism',
    'rows' => [
        [
            'label' => 'ID:',
            'valueKey' => 'id'
        ],
        [
            'label' => 'Maynardism:',
            'valueKey' => 'content'
        ]
    ],
    'model' => $ipsum,
    'action' => action('Admin\MaynardismController@destroy', $maynardism->id)
])
