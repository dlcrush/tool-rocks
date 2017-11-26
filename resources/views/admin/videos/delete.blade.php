@include('admin.pageTypes.delete', [
    'title' => 'Delete Video',
    'rows' => [
        [
            'label' => 'ID:',
            'valueKey' => 'id'
        ],
        [
            'label' => 'Name:',
            'valueKey' => 'name'
        ]
    ],
    'model' => $video,
    'action' => action('Admin\VideoController@destroy', $video->id)
])
