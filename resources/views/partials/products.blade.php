<!--product area start-->
<section class="product_area mb-46">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Computer & Laptop</h2>
                </div>
            </div>
        </div>
        <div class="product_slick product_slick_column5">
            @foreach($products as $product)
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
                                <span class="label_new">Nouveau</span>
                                <span class="label_promo">Promo</span>
                                <span class="label_discount">-70,00 TND</span>
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
                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                    <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                    </li>
                                    <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#modal_box"
                                                                title="quick view"> <span
                                                class="ion-ios-search-strong"></span></a></li>
                                </ul>
                            </div>
                            <div class="add_to_cart">
                                <a href="cart.html" title="add to cart">Add to cart</a>
                            </div>
                        </div>
                        <figcaption class="product_content">
                            <div class="price_box">
                                @if($product->price_min>0)
                                    <span class="old_price">{{$product->price_ttc}}</span>
                                    <span class="current_price">{{$product->price_min_ttc}}</span>
                                @else
                                    <span class="current_price">{{$product->price_ttc}}</span>
                                @endif
                            </div>
                            <h3 class="product_name"><a href="{{$product->route}}">{{$product->label}}</a></h3>
                        </figcaption>
                    </figure>
                </article>
            @endforeach
        </div>
    </div>
</section>
<!--product area end-->
