<!--featured product area start-->
<section class="featured_product_area mb-40 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Ordinateurs et accessoires gaming</h2>
                </div>
            </div>
        </div>
        <div class="row featured_container featured_column3">
            @foreach($bestSeller as $product)
                <div class="col-lg-4">
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                @if($product->photos->isEmpty())
                                    <a class="primary_img" href="{{$product->route}}"><img
                                            src="/assets/img/product/product1.jpg" alt=""></a>
                                    <a class="secondary_img" href="{{$product->route}}"><img
                                            src="/assets/img/product/product2.jpg" alt=""></a>

                                @else
                                    <a class="primary_img" href="{{$product->route}}"><img loading="lazy"
                                            src="{{$product->thumbPhoto($product->photos->get(0))}}"
                                            alt=""></a>
                                    @if($product->photos->get(1))
                                        <a class="secondary_img" href="{{$product->route}}"><img loading="lazy"
                                                src="{{$product->thumbPhoto($product->photos->get(1))}}"
                                                alt=""></a>
                                    @endif
                                @endif
                                <div class="label_product left">
                                    @if($product->price_min>0)
                                        <span class="label_discount">Promo</span>
                                    @endif
                                </div>
                                <div class="label_product">
                                    @if($product->stock>0)
                                        <span class="label_sale">Dispo</span>
                                    @else
                                        <span class="label_out_of_stock">Épuisé</span>
                                    @endif
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <div class="price_box">
                                    @if($product->price_min>0)
                                        <span class="old_price">{{$product->old_price}}</span>
                                        <span class="current_price promo">{{$product->price_ttc}}</span>
                                    @else
                                        <span class="current_price">{{$product->price_ttc}}</span>
                                    @endif
                                </div>
                                <h3 class="product_name"><a href="{{$product->route}}">{{$product->label}}</a></h3>
                                <div class="add_to_cart">
                                    @if($product->stock>0)
                                        <a href="{{route("add-to-cart", ["product"=>$product])}}"
                                           title="Ajouter au panier">Ajouter au panier</a>
                                    @else
                                        <a class="disabled" aria-disabled="true" title="Produit épuisé">Ajouter au
                                            panier</a>
                                    @endif
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--featured product area end-->
