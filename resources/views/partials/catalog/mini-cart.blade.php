<!--mini cart-->
<div class="mini_cart">
    @if(Cart::isEmpty())
        <div class="mini_cart_table">
            <div class="cart_total">
                <span class="w-100 text-center">Aucun produit dans votre panier</span>
            </div>
        </div>

        <div class="mini_cart_footer">
            <div class="cart_button">
                <a href="{{route("cart")}}">Voir mon panier</a>
            </div>

        </div>
    @else
        @foreach(Cart::getContent()->take(3) as $item)
            <div class="cart_item">
                <div class="cart_img">
                    <a href="{{$item->associatedModel->route}}"><img loading="lazy"
                            src="{{route("dolibarr", ["file"=>'produit/' . $item->associatedModel->ref . '/' .$item->associatedModel->photos->get(0)])}}"
                            alt=""></a>
                </div>
                <div class="cart_info">
                    <a href="{{$item->associatedModel->route}}">{{$item->name}}</a>
                    <p>Qte: {{$item->quantity}} X <span> {{$item->associatedModel->price_ttc}} </span></p>
                </div>
                <div class="cart_remove">
                    <a href="{{route("delete-from-cart", ["product"=>$item->id])}}"><i
                            class="ion-android-close"></i></a>
                </div>
            </div>
        @endforeach
        <div class="mini_cart_table">
            <div class="cart_total">
                <span>Total:</span>
                <span
                    class="price">{{numfmt_format_currency(numfmt_create( 'fr_TN', NumberFormatter::CURRENCY ), Cart::getTotal(), 'TND')}}</span>
            </div>
        </div>

        <div class="mini_cart_footer">
            <div class="cart_button">
                <a href="{{route("cart")}}">Voir mon panier</a>
            </div>
            <div class="cart_button">
                <a href="{{route("checkout")}}">Passer la commande</a>
            </div>

        </div>
    @endif

</div>
<!--mini cart end-->
