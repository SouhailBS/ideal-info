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
                <div class="col-lg-9 col-md-12">
                    @if($products->isEmpty())
                        <div class="shop_toolbar_wrapper"><h5 class="w-100 text-center">Aucun produit à afficher</h5>
                        </div>
                    @else
                    <!--shop wrapper start-->
                        @include("partials.catalog.toolbar-top")

                        <div class="row shop_wrapper @if($products->count()>5)grid_4 @else grid_list @endif">
                            @foreach($products as $product)
                                <div class="@if($products->count()>5)col-lg-3 col-md-4 col-sm-6 @else col-12 @endif">
                                    <article class="single_product">
                                        <figure>
                                            <div class="product_thumb">
                                                @if($product->photos->isEmpty())
                                                    <a class="primary_img" href="product-details.html"><img
                                                            src="/assets/img/product/product1.jpg" alt=""></a>
                                                    <a class="secondary_img" href="product-details.html"><img
                                                            src="/assets/img/product/product2.jpg" alt=""></a>

                                                @else
                                                    <a class="primary_img" href="{{$product->route}}"><img
                                                            src="{{route("dolibarr", ["file"=>'produit/' . $product->ref . '/' .$product->photos->get(0)])}}"
                                                            alt=""></a>
                                                    @if($product->photos->get(1))
                                                        <a class="secondary_img" href="{{$product->route}}"><img
                                                                src="{{route("dolibarr", ["file"=>'produit/' . $product->ref . '/' .$product->photos->get(1)])}}"
                                                                alt=""></a>
                                                    @endif
                                                @endif

                                                <div class="label_product left">
                                                    @if($product->price_min>0)
                                                        <span class="label_promo">Promo</span>
                                                        <span class="label_discount">{{$product->discount}}</span>
                                                    @endif
                                                </div>
                                                <div class="label_product">
                                                    @if($product->stock>0)
                                                        <span class="label_sale">Dispo</span>
                                                    @else
                                                        <span class="label_out_of_stock">Épuisé</span>
                                                    @endif
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        {{--<li class="wishlist"><a href="wishlist.html"
                                                                                title="Add to Wishlist"><i
                                                                    class="fa fa-heart-o" aria-hidden="true"></i></a>
                                                        </li>
                                                        <li class="compare"><a href="#" title="compare"><span
                                                                    class="ion-levels"></span></a></li>--}}
                                                        <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                                    data-bs-target="#modal_box_{{$product->rowid}}"
                                                                                    title="Aperçu"> <span
                                                                    class="ion-ios-search-strong"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="add_to_cart">
                                                    @if($product->stock>0)
                                                        <a href="{{route("add-to-cart", ["product"=>$product])}}"
                                                           title="Ajouter au panier">Ajouter au panier</a>
                                                    @else
                                                        <a class="disabled" aria-disabled="true" title="Produit épuisé">Ajouter au panier</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product_content grid_content">
                                                <div class="price_box">
                                                    @if($product->price_min>0)
                                                        <span class="old_price">{{$product->price_ttc}}</span>
                                                        <span class="current_price">{{$product->price_min_ttc}}</span>
                                                    @else
                                                        <span class="current_price">{{$product->price_ttc}}</span>
                                                    @endif
                                                </div>
                                                <div class="product_ratings">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <h3 class="product_name grid_name"><a
                                                        href="{{$product->route}}">{{$product->label}}</a>
                                                </h3>
                                            </div>
                                            <div class="product_content list_content">
                                                <div class="left_caption">
                                                    <div class="price_box">
                                                        @if($product->price_min>0)
                                                            <span class="old_price">{{$product->price_ttc}}</span>
                                                            <span
                                                                class="current_price">{{$product->price_min_ttc}}</span>
                                                        @else
                                                            <span class="current_price">{{$product->price_ttc}}</span>
                                                        @endif
                                                    </div>
                                                    <h3 class="product_name"><a
                                                            href="{{$product->route}}">{{$product->label}}</a>
                                                    </h3>
                                                    <div class="product_ratings">
                                                        <ul>
                                                            <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_desc">
                                                        <p>{!! $product->description !!}</p>
                                                    </div>
                                                </div>
                                                <div class="right_caption">
                                                    <div class="add_to_cart">
                                                        @if($product->stock>0)
                                                            <a href="{{route("add-to-cart", ["product"=>$product])}}"
                                                               title="Ajouter au panier">Ajouter au panier</a>
                                                        @else
                                                            <a class="disabled" aria-disabled="true" title="Produit épuisé">Ajouter au panier</a>
                                                        @endif
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            {{--<li class="wishlist"><a href="wishlist.html"
                                                                                    title="Add to Wishlist"><i
                                                                        class="fa fa-heart-o"
                                                                        aria-hidden="true"></i> Add to Wishlist</a></li>
                                                            <li class="compare"><a href="#" title="compare"><span
                                                                        class="ion-levels"></span> Compare</a></li>--}}
                                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                                        data-bs-target="#modal_box_{{$product->rowid}}"
                                                                                        title="Aperçu"> <span
                                                                        class="ion-ios-search-strong"></span> Aperçu</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </figure>
                                    </article>
                                </div>
                                @push("modals")
                                    @include('partials.catalog.product-modal')
                                @endpush
                            @endforeach
                        </div>

                    @include("partials.catalog.toolbar-bottom")
                    <!--shop wrapper end-->
                </div>
                @endif
            </div>
        </div>
    </div>
    <!--shop  area end-->
@endsection

@push("scripts")
@endpush
