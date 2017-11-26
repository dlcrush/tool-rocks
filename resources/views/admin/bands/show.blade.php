@include('admin.pageTypes.show', [
    'title' => 'Show Band',
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
    'model' => $band
])
