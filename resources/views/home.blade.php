@extends("layouts.app")
@section("title", __("Accueil"))

@section("content")
    @include("partials.home.slider")
    @include("partials.home.shipping")
    @include("partials.tabs-products")
    @include("partials.home.banner")
    @include("partials.featured-products")
    @include("partials.home.categories")
    @include("partials.home.banner2")
    @include("partials.products")
    @include("partials.home.brands")
@endsection

@push("scripts")
@endpush
