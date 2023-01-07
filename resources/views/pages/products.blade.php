@extends("layouts.app")
@section("title", isset($category)? $category->label: $title)

@section("content")
    @isset($category)
        <x-breadcrumbs :levels="[$category]"/>
    @endisset
    <!--shop  area start-->
    <div class="shop_area shop_reverse mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    @include("partials.catalog.sidebar")
                </div>
                <div class="col-lg-9 col-md-12" id="products-main-container">
                    @include("partials.catalog.products")
                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->
@endsection

@push("scripts")
@endpush
