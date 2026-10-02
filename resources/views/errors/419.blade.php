@include('errors.layout', [
    'code' => 419,
    'icon' => 'ti-clock-exclamation',
    'heading' => __('Page expired'),
    'description' => __('Your session has expired. Please refresh the page and try again.'),
])
