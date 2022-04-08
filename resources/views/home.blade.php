@extends("layouts.app")
@section("title", __("Vente en ligne Pc portable, Smartphone, Matériel Informatique Tunisie"))
@section("description", config("company.MAIN_INFO_SOCIETE_NOTE"))

@section("content")
    @include("partials.home.slider")
    @include("partials.home.tabs-products")
    @include("partials.home.banner")
    @include("partials.home.featured-products")
   {{-- @include("partials.home.categories")--}}
    @include("partials.home.banner2")
    @include("partials.home.products")
    @include("partials.home.shipping")
    {{--@include("partials.home.brands")--}}
@endsection

@push("scripts")
@endpush
