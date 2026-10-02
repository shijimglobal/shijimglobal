@include('errors.layout', [
    'code' => 429,
    'icon' => 'icon-[tabler--hourglass-high]',
    'heading' => __('Too many requests'),
    'description' => __('You have sent too many requests. Please wait a moment and try again.'),
])
