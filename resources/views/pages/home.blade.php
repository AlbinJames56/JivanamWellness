@extends('layouts.app')

@section('content')
    @include('components.home.hero')
    @include('components.home.treatments-section')
    @include('components.home.clinics-section')
    @include('components.home.testimonials-section')
    @include('components.home.blog-section')
@endsection
