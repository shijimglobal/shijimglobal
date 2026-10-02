@include('errors.layout', [
    'code' => 403,
    'icon' => 'icon-[tabler--lock-access]',
    'heading' => __('Access denied'),
    'description' => __('You do not have permission to view this page.'),
])
