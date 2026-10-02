@include('errors.layout', [
    'code' => 500,
    'icon' => 'ti-server-off',
    'heading' => __('Something went wrong'),
    'description' => __('An unexpected error occurred on our server. We are working on it — please try again later.'),
])
