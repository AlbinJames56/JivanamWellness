@extends('layouts.app')

@section('content')


    @include('components.home.hero')
    @include('components.home.treatments-section', ['treatments' => $treatments ?? collect()])
    @include('components.home.clinics-section', ['clinics' => $clinics ?? collect()])
    @include('components.home.testimonials-section', ['testimonials' => $testimonials ?? collect()])
    @include('components.home.blog-section', ['blogPosts' => $articles ?? collect()])
@endsection
