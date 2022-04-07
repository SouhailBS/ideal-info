@extends("layouts.app")
@section("title", $product->label)
@section("type", 'og:product')
@section("description", strip_tags($product->description))

@section("content")
    <x-breadcrumbs :levels="[$product->categories->last(), $product]"/>
    <!--product details start-->
    <div class="product_details mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom text-center">
                            @if($product->photos->isEmpty())
                                <a href="#">
                                    <img id="zoom1" src="/assets/img/product/productbig5.jpg"
                                         data-zoom-image="/assets/img/product/productbig5.jpg" alt="big-1">
                                </a>
                            @else
                                @section("image", route("dolibarr", ["file"=>'produit/' . $product->ref . '/' . $product->photos->get(0)]))
                            <a href="{{$product->route}}">
                                <img id="zoom1"
                                     src="{{$product->thumbPhoto($product->photos->get(0))}}"
                                     data-zoom-image="{{$product->photo($product->photos->get(0))}}"
                                     alt="big-1">
                            </a>
                            @endif
                        </div>
                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                @if($product->photos->isEmpty())
                                    <li>
                                        <a href="#" class="elevatezoom-gallery active" data-update=""
                                           data-image="/assets/img/product/productbig.jpg"
                                           data-zoom-image="/assets/img/product/productbig.jpg">
                                            <img src="/assets/img/product/productbig.jpg" alt="zo-th-1"/>
                                        </a>

                                    </li>
                                @else
                                    @foreach($product->photos as $img)
                                        <li>
                                            <a href="#" class="elevatezoom-gallery active" data-update=""
                                               data-image="{{$product->thumbPhoto($img)}}"
                                               data-zoom-image="{{$product->photo($img)}}">
                                                <img
                                                    src="{{$product->miniPhoto($img)}}"
                                                    alt="zo-th-1"/>
                                            </a>

                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                        <form method="GET" action="{{route("add-to-cart", ["product"=>$product])}}">

                            <h1>{{$product->label}}</h1>
                            <div class="product_nav">
                                <ul>
                                    <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                    <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul>
                            </div>
                            {{--<div class=" product_ratting">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="review"><a href="#"> (customer review ) </a></li>
                                </ul>

                            </div>--}}
                            <div class="price_box">
                                @if($product->price_min>0)
                                    <span class="old_price">{{$product->old_price}}</span>
                                    <span
                                        class="current_price promo">{{$product->price_ttc}}</span>
                                @else
                                    <span class="current_price">{{$product->price_ttc}}</span>
                                @endif

                            </div>
                            <div class="product_desc">
                                <p>{!! $product->description !!}</p>
                            </div>
                            {{--<div class="product_variant color">
                                <h3>Available Options</h3>
                                <label>color</label>
                                <ul>
                                    <li class="color1"><a href="#"></a></li>
                                    <li class="color2"><a href="#"></a></li>
                                    <li class="color3"><a href="#"></a></li>
                                    <li class="color4"><a href="#"></a></li>
                                </ul>
                            </div>--}}
                            <div class="product_variant quantity">
                                <label for="qte">Quantité</label>

                                @if($product->stock>0)
                                    <input id="qte" min="1" max="{{$product->stock}}" value="1" name="quantity"
                                           type="number">
                                    <button class="button" type="submit">Ajouter au panier</button>
                                @else
                                    <input disabled id="qte" min="1" max="{{$product->stock}}" value="1" name="quantity"
                                           type="number">
                                    <button disabled class="button disabled" aria-disabled="true" title="Produit épuisé">Ajouter
                                        au panier
                                    </button>
                                @endif
                            </div>
                            {{--<div class=" product_d_action">
                                <ul>
                                    <li><a href="#" title="Add to wishlist">+ Add to Wishlist</a></li>
                                    <li><a href="#" title="Add to wishlist">+ Compare</a></li>
                                </ul>
                            </div>--}}
                            <div class="product_meta">
                                <span>Categories:
                                    @foreach($product->categories as $cat)
                                        <a href="{{$cat->route}}">{{$cat->label}}</a>
                                    @endforeach
                                </span>
                            </div>

                        </form>
                        <div class="priduct_social">
                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product details end-->

    {{-- <!--product info start-->
     <div class="product_d_info mb-60">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="product_d_inner">
                         <div class="product_info_button">
                             <ul class="nav" role="tablist">
                                 <li>
                                     <a class="active" data-bs-toggle="tab" href="#info" role="tab" aria-controls="info"
                                        aria-selected="false">Description</a>
                                 </li>
                                 <li>
                                     <a data-bs-toggle="tab" href="#sheet" role="tab" aria-controls="sheet"
                                        aria-selected="false">Specification</a>
                                 </li>
                                 <li>
                                     <a data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                        aria-selected="false">Reviews (1)</a>
                                 </li>
                             </ul>
                         </div>
                         <div class="tab-content">
                             <div class="tab-pane fade show active" id="info" role="tabpanel">
                                 <div class="product_info_content">
                                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec
                                         est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare
                                         lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus
                                         eu, suscipit id nulla.</p>
                                     <p>Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis
                                         fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa
                                         massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit
                                         est, sed commodo augue nisi non neque. Lorem ipsum dolor sit amet, consectetur
                                         adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere
                                         nisl, in accumsan elit odio quis mi. Cras neque metus, consequat et blandit et,
                                         luctus a nunc. Etiam gravida vehicula tellus, in imperdiet ligula euismod eget.
                                     </p>
                                 </div>
                             </div>
                             <div class="tab-pane fade" id="sheet" role="tabpanel">
                                 <div class="product_d_table">
                                     <form action="#">
                                         <table>
                                             <tbody>
                                             <tr>
                                                 <td class="first_child">Compositions</td>
                                                 <td>Polyester</td>
                                             </tr>
                                             <tr>
                                                 <td class="first_child">Styles</td>
                                                 <td>Girly</td>
                                             </tr>
                                             <tr>
                                                 <td class="first_child">Properties</td>
                                                 <td>Short Dress</td>
                                             </tr>
                                             </tbody>
                                         </table>
                                     </form>
                                 </div>
                                 <div class="product_info_content">
                                     <p>Fashion has been creating well-designed collections since 2010. The brand offers
                                         feminine designs delivering stylish separates and statement dresses which have
                                         since evolved into a full ready-to-wear collection in which every item is a
                                         vital part of a woman's wardrobe. The result? Cool, easy, chic looks with
                                         youthful elegance and unmistakable signature style. All the beautiful pieces are
                                         made in Italy and manufactured with the greatest attention. Now Fashion extends
                                         to a range of accessories including shoes, hats, belts and more!</p>
                                 </div>
                             </div>

                             <div class="tab-pane fade" id="reviews" role="tabpanel">
                                 <div class="reviews_wrapper">
                                     <h2>1 review for Donec eu furniture</h2>
                                     <div class="reviews_comment_box">
                                         <div class="comment_thmb">
                                             <img src="/assets/img/blog/comment2.jpg" alt="">
                                         </div>
                                         <div class="comment_text">
                                             <div class="reviews_meta">
                                                 <div class="star_rating">
                                                     <ul>
                                                         <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                         <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                         <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                         <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                         <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                     </ul>
                                                 </div>
                                                 <p><strong>admin </strong>- September 12, 2018</p>
                                                 <span>roadthemes</span>
                                             </div>
                                         </div>

                                     </div>
                                     <div class="comment_title">
                                         <h2>Add a review </h2>
                                         <p>Your email address will not be published. Required fields are marked </p>
                                     </div>
                                     <div class="product_ratting mb-10">
                                         <h3>Your rating</h3>
                                         <ul>
                                             <li><a href="#"><i class="fa fa-star"></i></a></li>
                                             <li><a href="#"><i class="fa fa-star"></i></a></li>
                                             <li><a href="#"><i class="fa fa-star"></i></a></li>
                                             <li><a href="#"><i class="fa fa-star"></i></a></li>
                                             <li><a href="#"><i class="fa fa-star"></i></a></li>
                                         </ul>
                                     </div>
                                     <div class="product_review_form">
                                         <form action="#">
                                             <div class="row">
                                                 <div class="col-12">
                                                     <label for="review_comment">Your review </label>
                                                     <textarea name="comment" id="review_comment"></textarea>
                                                 </div>
                                                 <div class="col-lg-6 col-md-6">
                                                     <label for="author">Name</label>
                                                     <input id="author" type="text">

                                                 </div>
                                                 <div class="col-lg-6 col-md-6">
                                                     <label for="email">Email </label>
                                                     <input id="email" type="text">
                                                 </div>
                                             </div>
                                             <button type="submit">Submit</button>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!--product info end-->--}}

    <!--product area start-->
    <section class="product_area related_products">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Produits dans la même catégorie </h2>
                    </div>
                </div>
            </div>
            <div class="product_carousel product_column5 owl-carousel">
                @foreach($product->categories->last()->products()->where('tosell', '>', '0')->inRandomOrder()->take(10)->get() as $product)
                    @include('partials.catalog.product-miniature')
                @endforeach
            </div>
        </div>
    </section>
    <!--product area end-->
@endsection

@push("scripts")
@endpush
