<!--mini cart-->
<div class="mini_cart" style="overflow-y: auto;">
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
            <div class="cart_item" id="cart_item_{{$item->id}}">
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
                    <a href="{{route("delete-from-cart", ["product"=>$item->id])}}"
                       data-url="{{route("ajax-delete-from-cart", ["product"=>$item->id])}}"
                       data-cart-item="#cart_item_{{$item->id}}"><i
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
@once
    @push('scripts')
        <script>
            $(document).ready(function () {
                $(".mini_cart .cart_item .cart_remove a").click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $this = $(this);
                    console.log($this.target)
                    $.ajax({
                        type: 'DELETE',
                        url: $this.data("url"),
                        success: function (data) {
                            console.log($this.data("cart-item"))
                            element = $.parseHTML(
                                '<div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">'
                                + '<div class="d-flex">'
                                + '<div class="toast-body">'
                                + data.success
                                + '</div>'
                                + '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>'
                                + '</div>'
                                + '</div>');
                            $(".toast-container").append(element);
                            $(element).toast("show");
                            $($this.data("cart-item")).remove();
                            $(".cart_total .price").text(data.cart.total);
                        }
                    });
                })
            });
        </script>
    @endpush
@endonce
