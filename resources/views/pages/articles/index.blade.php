@extends('layouts.app')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => __('Knowledge'),
        'heading' => __('Understand it in a minute'),
        'lead' => __('Short visual guides to the technology behind your business.'),
        'breadcrumbs' => [[__('Knowledge'), null]],
    ])

    @include('sections.knowledge', ['hideHeading' => true, 'articles' => $articles])

    @include('sections.contact')
@endsection
