@include('errors.layout', [
    'code' => 404,
    'icon' => 'ti-map-question',
    'heading' => __('Page not found'),
    'description' => __('The page you are looking for does not exist or has been moved.'),
])
