@extends("layouts.app")
@section("title", "Panier")

@section("content")
    @php
        $shipping = 8;
        if (\Cart::getTotal()>300)
            $shipping = 0;
    @endphp
    <!--Checkout page section-->
    <div class="Checkout_section mt-60">
        <div class="container">
            @if(Cart::isEmpty())
                <div class="shop_toolbar_wrapper"><h5 class="w-100 text-center">Aucun produit dans votre panier</h5>
                </div>
            @else
                @guest
                    <div class="row">
                        <div class="col-12">
                            <div class="user-actions">
                                <h3>
                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                    Déjà client?
                                    <a class="Returning" href="{{route("login-form")}}">Cliquez ici pour vous
                                        connecter</a>

                                </h3>
                            </div>
                            <div class="user-actions">
                                <h3>
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                    Nouveau client?
                                    <a class="Returning" href="{{route("register-form")}}">Cliquez ici pour vous
                                        inscrire</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endguest

                @auth
                    <div class="checkout_form">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <form action="#">
                                    <h3>Détails de livraison</h3>
                                    <div class="row">
                                        <div class="col-lg-6 mb-20">
                                            <label for="firstname">Prénom <span>*</span></label>
                                            <input type="text" name="firstname" id="firstname"
                                                   value="{{auth()->user()->firstname}}" required
                                                   placeholder="Votre prénom">
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <label for="lastname">Nom <span>*</span></label>
                                            <input type="text" name="lastname" id="lastname"
                                                   value="{{auth()->user()->lastname}}" required
                                                   placeholder="Votre nom">
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label for="company">Votre Société<span>Facultatif</span></label>
                                            <input type="text" name="company" id="company" placeholder="Votre Société">
                                        </div>

                                        <div class="col-12 mb-20">
                                            <div class="order-notes">
                                                <label for="address">Adresse <span>*</span></label>
                                                <textarea id="address" name="address" placeholder="Votre adresse"
                                                          type="text"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-20">
                                            <label>Region <span>*</span></label>
                                            <input type="text">
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <label>Ville <span>*</span></label>
                                            <input type="text">
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <label>Telephone<span>*</span></label>
                                            <input type="text">

                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <label> Email Address <span>*</span></label>
                                            <input type="text">

                                        </div>
                                        <div class="col-12">
                                            <div class="order-notes">
                                                <label for="order_note">Order Notes</label>
                                                <textarea id="order_note"
                                                          placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <form action="#">
                                    <h3>Your order</h3>
                                    <div class="order_table table-responsive">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td> Handbag fringilla <strong> × 2</strong></td>
                                                <td> $165.00</td>
                                            </tr>
                                            <tr>
                                                <td> Handbag justo <strong> × 2</strong></td>
                                                <td> $50.00</td>
                                            </tr>
                                            <tr>
                                                <td> Handbag elit <strong> × 2</strong></td>
                                                <td> $50.00</td>
                                            </tr>
                                            <tr>
                                                <td> Handbag Rutrum <strong> × 1</strong></td>
                                                <td> $50.00</td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Cart Subtotal</th>
                                                <td>$215.00</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td><strong>$5.00</strong></td>
                                            </tr>
                                            <tr class="order_total">
                                                <th>Order Total</th>
                                                <td><strong>$220.00</strong></td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="payment_method">
                                        <div class="panel-default">
                                            <input id="payment" name="check_method" type="radio"
                                                   data-bs-target="createp_account"/>
                                            <label for="payment" data-bs-toggle="collapse" data-bs-target="#method"
                                                   aria-controls="method">Create an account?</label>

                                            <div id="method" class="collapse one" data-parent="#accordion">
                                                <div class="card-body1">
                                                    <p>Please send a check to Store Name, Store Street, Store Town,
                                                        Store
                                                        State
                                                        / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-default">
                                            <input id="payment_defult" name="check_method" type="radio"
                                                   data-bs-target="createp_account"/>
                                            <label for="payment_defult" data-bs-toggle="collapse"
                                                   data-bs-target="#collapsedefult"
                                                   aria-controls="collapsedefult">PayPal <img
                                                    src="assets/img/icon/papyel.png"
                                                    alt=""></label>

                                            <div id="collapsedefult" class="collapse one" data-parent="#accordion">
                                                <div class="card-body1">
                                                    <p>Pay via PayPal; you can pay with your credit card if you don’t
                                                        have a
                                                        PayPal account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order_button">
                                            <button type="submit">Proceed to PayPal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            @endif
        </div>
    </div>
    <!--Checkout page section end-->
@endsection
@push("scripts")
@endpush
