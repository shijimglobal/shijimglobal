@include('errors.layout', [
    'code' => 503,
    'icon' => 'ti-tool',
    'heading' => __('Under maintenance'),
    'description' => __('We are making some improvements. The website will be back shortly.'),
])
