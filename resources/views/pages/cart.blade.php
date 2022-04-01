@extends("layouts.app")
@section("title", "Panier")

@section("content")
    @php
        $shipping = 8;
        if (\Cart::getTotal()>=200)
            $shipping = 0;
    @endphp
    <!--shopping cart area start -->
    <div class="shopping_cart_area mt-60">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mb-2">
                    {{ session('success') }}
                </div>
            @endif
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger mt-2">{{ $error }}</div>
            @endforeach
            @if(Cart::isEmpty())
                <div class="shop_toolbar_wrapper"><h5 class="w-100 text-center">Aucun produit dans votre panier</h5>
                </div>
            @else
                <form method="POST" action="{{route("update-cart")}}">
                    @csrf
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
                                                            src="{{route("dolibarr", ["file"=>'produit/' . $item->associatedModel->ref . '/' .$item->associatedModel->photos->get(0)])}}"
                                                            alt=""></a>
                                                </td>
                                                <td class="product_name">
                                                    <a href="{{$item->associatedModel->route}}">{{$item->name}}</a>
                                                </td>
                                                <td class="product-price">
                                                    @if($item->associatedModel->price_min>0)
                                                        <div class="price_box">
                                                            <span
                                                                class="d-block current_price">{{$item->associatedModel->price_ttc}}</span>
                                                            <span
                                                                class="d-block old_price">{{$item->associatedModel->old_price}}</span>
                                                        </div>
                                                    @else
                                                        {{$item->associatedModel->price_ttc}}
                                                    @endif
                                                </td>
                                                <td class="product_quantity"><label for="qty">Quantité</label>
                                                    <input id="qty" name="{{$item->id}}" min="1"
                                                           max="100"
                                                           value="{{$item->quantity}}"
                                                           type="number">
                                                </td>
                                                <td class="product_total">{{numfmt_format_currency(numfmt_create( 'fr_TN', NumberFormatter::CURRENCY ),$item->getPriceSum() , 'TND')}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart_submit">
                                    <button type="submit">mettre à jour le panier</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--coupon code area start-->
                    <div class="coupon_area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="coupon_code left">
                                    <h3>Livraison</h3>
                                    <div class="coupon_inner">
                                        <p>Livraison gratuite pour toutes commandes de plus de 300 DT.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="coupon_code right">
                                    <h3>TOTAUX DU PANIER</h3>
                                    <div class="coupon_inner">
                                        <div class="cart_subtotal">
                                            <p>{{Cart::getContent()->sum('quantity')}} articles</p>
                                            <p class="cart_amount">{{numfmt_format_currency(numfmt_create( 'fr_TN', NumberFormatter::CURRENCY ), Cart::getTotal(), 'TND')}}</p>
                                        </div>
                                        <div class="cart_subtotal">
                                            <p>Livraison</p>
                                            <p class="cart_amount"> {{numfmt_format_currency(numfmt_create( 'fr_TN', NumberFormatter::CURRENCY ), $shipping, 'TND')}}</p>
                                        </div>

                                        <div class="cart_subtotal">
                                            <p>Total TTC</p>
                                            <p class="cart_amount">{{numfmt_format_currency(numfmt_create( 'fr_TN', NumberFormatter::CURRENCY ), Cart::getTotal() + $shipping, 'TND')}}</p>
                                        </div>
                                        <div class="checkout_btn">
                                            <a href="{{route("checkout")}}">Passer la commande</a>
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
