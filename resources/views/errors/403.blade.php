@include('errors.layout', [
    'code' => 403,
    'icon' => 'ti-lock-access',
    'heading' => __('Access denied'),
    'description' => __('You do not have permission to view this page.'),
])
