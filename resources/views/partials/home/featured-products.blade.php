<!--featured product area start-->
<section class="featured_product_area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Produits populaires</h2>
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
                                <div class="add_to_cart">
                                    <a href="{{route("add-to-cart", ["product"=>$product])}}"
                                       title="Ajouter au panier">Ajouter au panier</a>
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
