@extends("layouts.app")
@section("title", "Panier")

@section("content")
    <!--shopping cart area start -->
    <div class="shopping_cart_area mt-60">
        <div class="container">
            @if(Cart::isEmpty())
                Votre panier est vide
            @else
                <form action="#">
                    <div class="row">
                        <div class="col-12">
                            <div class="table_desc">
                                <div class="cart_page table-responsive">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="product_remove">Supprimer</th>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Produit</th>
                                            <th class="product-price">Prix</th>
                                            <th class="product_quantity">Quantité</th>
                                            <th class="product_total">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(Cart::getContent() as $item)
                                            <tr>
                                                <td class="product_remove">
                                                    <a href="{{route("delete-from-cart", ["product"=>$item->id])}}"><i
                                                            class="fa fa-trash-o"></i></a>
                                                </td>
                                                <td class="product_thumb">
                                                    <a href="{{$item->associatedModel->route}}">
                                                        <img
                                                            src="{{route("dolibarr", ["file"=>'produit/' . $item->ref . '/' .$item->associatedModel->photos->get(0)])}}"
                                                            alt=""></a>
                                                </td>
                                                <td class="product_name">
                                                    <a href="{{$item->associatedModel->route}}">{{$item->name}}</a>
                                                </td>
                                                <td class="product-price">{{$item->associatedModel->price_ttc}}</td>
                                                <td class="product_quantity"><label>Quantity</label>
                                                    <input min="1"
                                                           max="100"
                                                           value="{{$item->quantity}}"
                                                           type="number">
                                                </td>
                                                <td class="product_total">£130.00</td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart_submit">
                                    <button type="submit">update cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--coupon code area start-->
                    <div class="coupon_area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="coupon_code left">
                                    <h3>Coupon</h3>
                                    <div class="coupon_inner">
                                        <p>Enter your coupon code if you have one.</p>
                                        <input placeholder="Coupon code" type="text">
                                        <button type="submit">Apply coupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="coupon_code right">
                                    <h3>Cart Totals</h3>
                                    <div class="coupon_inner">
                                        <div class="cart_subtotal">
                                            <p>Subtotal</p>
                                            <p class="cart_amount">£215.00</p>
                                        </div>
                                        <div class="cart_subtotal ">
                                            <p>Shipping</p>
                                            <p class="cart_amount"><span>Flat Rate:</span> £255.00</p>
                                        </div>
                                        <a href="#">Calculate shipping</a>

                                        <div class="cart_subtotal">
                                            <p>Total TTC</p>
                                            <p class="cart_amount">{{numfmt_format_currency(numfmt_create( 'tn_TN', NumberFormatter::CURRENCY ), Cart::getTotal(), 'TND')}}</p>
                                        </div>
                                        <div class="checkout_btn">
                                            <a href="#">Proceed to Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--coupon code area end-->
                </form>
            @endif
        </div>
    </div>
    <!--shopping cart area end -->
@endsection
@push("scripts")
@endpush
