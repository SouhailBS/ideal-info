{{--
<!-- modal area start-->
<div class="modal fade" id="modal_box_{{$product->rowid}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal_body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="modal_tab">
                                <div class="tab-content product-details-large">
                                    @foreach($product->photos as $img)
                                        <div class="tab-pane fade show @if($loop->first)active @endif"
                                             id="tab_{{$product->rowid}}_{{$loop->iteration}}" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="{{$product->route}}" class="elevatezoom-gallery active">
                                                    <img loading="lazy"
                                                        src="{{route("dolibarr", ["file"=>'produit/' . $product->ref . '/' .$img])}}"
                                                        alt=""/>
                                                </a>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="modal_tab_button">
                                    <ul class="nav product_navactive owl-carousel" role="tablist">
                                        @foreach($product->photos as $img)
                                            <li>
                                                <a class="nav-link  @if($loop->first)active @endif" data-bs-toggle="tab"
                                                   href="#tab_{{$product->rowid}}_{{$loop->iteration}}" role="tab"
                                                   aria-controls="tab_{{$product->rowid}}_{{$loop->iteration}}"
                                                   aria-selected="false"><img loading="lazy"
                                                        src="{{route("dolibarr", ["file"=>'produit/' . $product->ref . '/' .$img])}}"
                                                        alt=""/></a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="modal_right">
                                <div class="modal_title mb-10">
                                    <h2>{{$product->label}}</h2>
                                </div>
                                <div class="modal_price mb-10">
                                    @if($product->price_min>0)
                                        <span class="old_price">{{$product->old_price}}</span>
                                        <span
                                            class="current_price promo">{{$product->price_ttc}}</span>
                                    @else
                                        <span class="current_price">{{$product->price_ttc}}</span>
                                    @endif
                                </div>
                                <div class="modal_description mb-15">
                                    <p>{!! $product->description !!}</p>
                                </div>
                                <div class="variants_selects">
                                    --}}
{{--<div class="variants_size">
                                        <h2>size</h2>
                                        <select class="select_option">
                                            <option selected value="1">s</option>
                                            <option value="1">m</option>
                                            <option value="1">l</option>
                                            <option value="1">xl</option>
                                            <option value="1">xxl</option>
                                        </select>
                                    </div>
                                    <div class="variants_color">
                                        <h2>color</h2>
                                        <select class="select_option">
                                            <option selected value="1">purple</option>
                                            <option value="1">violet</option>
                                            <option value="1">black</option>
                                            <option value="1">pink</option>
                                            <option value="1">orange</option>
                                        </select>
                                    </div>--}}{{--

                                    <div class="modal_add_to_cart">
                                        <form method="GET" action="{{route("add-to-cart", ["product"=>$product])}}">
                                            @if($product->stock>0)
                                                <input id="qte" min="1" max="100" value="1" name="quantity" type="number">
                                                <button class="button" type="submit">Ajouter au panier</button>
                                            @else
                                                <input readonly id="qte" min="1" max="100" value="1" name="quantity" type="number">
                                                <button aria-disabled="true" disabled class="button disabled" type="submit" title="Produit épuisé">Ajouter au panier</button>
                                            @endif

                                        </form>
                                    </div>
                                </div>
                                <div class="modal_social">
                                    <h2>Partager ce produit</h2>
                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                    <div class="addthis_inline_share_toolbox_mkde" data-url="{{$product->route}}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal area end-->
--}}
