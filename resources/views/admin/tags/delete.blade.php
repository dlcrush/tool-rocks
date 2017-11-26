@include('admin.pageTypes.delete', [
    'title' => 'Delete Tag',
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
    'model' => $tag,
    'action' => action('Admin\TagController@destroy', $tag->id)
])
