@extends("layouts.app")
@section("title", "Panier")

@section("content")
    @php
        $shipping=0;
    @endphp
    <!--Checkout page section-->
    <div class="Checkout_section mt-60">
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
                    @php
                        $shipping = 8;
                        if (\Cart::getTotal()>=200)
                            $shipping = 0;
                    @endphp
                    <form method="POST" action="{{route("submit-checkout")}}">
                        @csrf

                        <div class="checkout_form">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <!--Accordion area-->
                                    <div class="accordion_area pb-3">
                                        <div id="accordion" class="card__accordion">
                                            <div class="card card_dipult">
                                                <div class="card-header card_accor" id="headingOne">
                                                    <button type="button"
                                                            class="btn-link fa fa-check @if(auth()->user()->client) collapsed done @endif"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                        1. Adresse

                                                        <i title="Modifier" class="fa fa-pencil"></i>
                                                        <i class="fa fa-minus"></i>

                                                    </button>

                                                </div>

                                                <div id="collapseOne"
                                                     class="collapse @if(!auth()->user()->client) show @endif"
                                                     aria-labelledby="headingOne"
                                                     data-parent="#accordion">
                                                    <div class="card-body">
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
                                                                <div class="order-notes">
                                                                    <label for="address">Adresse <span>*</span></label>
                                                                    <textarea id="address" name="address"
                                                                              placeholder="Votre adresse"
                                                                              type="text">@if(auth()->user()->client){{auth()->user()->client->address}}@endif</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 mb-20">
                                                                <label for="zip">Code postal <span>*</span></label>
                                                                <input
                                                                    @if(auth()->user()->client)value="{{auth()->user()->client->zip}}"
                                                                    @endif type="number" id="zip" name="zip" required
                                                                    placeholder="Code postal">
                                                            </div>

                                                            <div class="col-lg-4 mb-20">
                                                                <label for="region">Ville <span>*</span></label>
                                                                <input
                                                                    @if(auth()->user()->client)value="{{auth()->user()->client->town}}"
                                                                    @endif type="text" id="region" name="town" required
                                                                    placeholder="Région">
                                                            </div>

                                                            <div class="col-lg-4 mb-20">
                                                                <label for="ville">Gouvernorat <span>*</span></label>
                                                                <select class="nice-select" id="ville"
                                                                        name="fk_departement">
                                                                    <option value="0">&nbsp;</option>
                                                                    <option value="363">Ariana</option>
                                                                    <option value="364">Béja</option>
                                                                    <option value="365">Ben Arous</option>
                                                                    <option value="366">Bizerte</option>
                                                                    <option value="367">Gabès</option>
                                                                    <option value="368">Gafsa</option>
                                                                    <option value="369">Jendouba</option>
                                                                    <option value="370">Kairouan</option>
                                                                    <option value="371">Kasserine</option>
                                                                    <option value="372">Kébili</option>
                                                                    <option value="373">La Manouba</option>
                                                                    <option value="374">Le Kef</option>
                                                                    <option value="375">Mahdia</option>
                                                                    <option value="376">Médenine</option>
                                                                    <option value="377">Monastir</option>
                                                                    <option value="378">Nabeul</option>
                                                                    <option value="379">Sfax</option>
                                                                    <option value="380">Sidi Bouzid</option>
                                                                    <option value="381">Siliana</option>
                                                                    <option value="382">Sousse</option>
                                                                    <option value="383">Tataouine</option>
                                                                    <option value="384">Tozeur</option>
                                                                    <option value="385">Tunis</option>
                                                                    <option value="386">Zaghouan</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-6 mb-20">
                                                                <label for="tel">Téléphone<span>*</span></label>
                                                                <input
                                                                    @if(auth()->user()->client)value="{{auth()->user()->client->phone}}"
                                                                    @endif type="tel" id="tel" name="phone" required
                                                                    placeholder="Votre numéro de téléphone">
                                                            </div>

                                                            <div class="col-lg-6 mb-20">
                                                                <label for="identity">Numéro CIN ou matricule
                                                                    fiscal</label>
                                                                <input
                                                                    @if(auth()->user()->client)value="{{auth()->user()->client->siret}}"
                                                                    @endif type="text" id="identity" name="identity"
                                                                    placeholder="Votre numéro CIN ou matricule fiscal">

                                                            </div>

                                                            <div class="col-12 mb-20">
                                                                <label for="company">Votre Société</label>
                                                                <input
                                                                    @if(auth()->user()->client)value="{{auth()->user()->client->name_alias}}"
                                                                    @endif type="text" name="name_alias" id="company"
                                                                    placeholder="Votre Société">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card  card_dipult">
                                                <div class="card-header card_accor" id="headingTwo">
                                                    <button id="shipping_method" type="button"
                                                            class="btn-link fa fa-check @if(!auth()->user()->client) collapsed @endif"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                        2. Mode de livraison
                                                        <i class="fa fa-pencil"></i>
                                                        <i class="fa fa-minus"></i>

                                                    </button>
                                                </div>
                                                <div id="collapseTwo"
                                                     class="collapse @if(auth()->user()->client) show @endif"
                                                     aria-labelledby="headingTwo"
                                                     data-parent="#accordion">
                                                    <div class="card-body">
                                                        <p>Comment voulez-vous que votre commande soit livrée ?</p>
                                                        <div class="input-radio">
                                                            <span class="custom-radio d-block mb-3">
                                                                <input required type="radio" value="2"
                                                                       name="shipping_method"> Livraison à domicile ou au bureau: <small
                                                                    class="d-block ps-3" style="color: gray">Frais de livraison : <span
                                                                        style="color: black; font-weight: bold">8 DT</span></small></span>
                                                            <span class="custom-radio d-block">
                                                                <input required type="radio" value="1"
                                                                       name="shipping_method"> Retrait magasin <small
                                                                    class="d-block ps-3" style="color: gray">Frais de livraison : <span
                                                                        style="color: black; font-weight: bold">gratuit</span></small></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="order-notes">
                                            <label for="order_note">Notes</label>
                                            <textarea
                                                style="height: auto;line-height: 24px;padding: 6px 30px 6px 20px;"
                                                rows="3" name="note" id="order_note"
                                                placeholder="Remarques concernant votre commande, par exemple notes spéciales pour la livraison."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">

                                    <h3>Votre commande</h3>
                                    <div class="order_table table-responsive">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(Cart::getContent() as $item)
                                                <tr>
                                                    <td> {{$item->name}} <strong> × {{$item->quantity}}</strong>
                                                    </td>
                                                    <td> {{numfmt_format_currency(numfmt_create( 'fr_TN', NumberFormatter::CURRENCY ),$item->getPriceSum() , 'TND')}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Total du panier</th>
                                                <td>{{numfmt_format_currency(numfmt_create( 'fr_TN', NumberFormatter::CURRENCY ), Cart::getTotal(), 'TND')}}</td>
                                            </tr>
                                            <tr>
                                                <th>Livraison</th>
                                                <td>
                                                    <strong
                                                        id="shipping_fees">{{numfmt_format_currency(numfmt_create( 'fr_TN', NumberFormatter::CURRENCY ), $shipping, 'TND')}}</strong>
                                                </td>
                                            </tr>
                                            <tr class="order_total">
                                                <th>Montant à payé</th>
                                                <td>
                                                    <strong
                                                        id="total">{{numfmt_format_currency(numfmt_create( 'fr_TN', NumberFormatter::CURRENCY ), Cart::getTotal() + $shipping, 'TND')}}</strong>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="payment_method">
                                        <div class="order_button">
                                            <button class="pull-right" type="submit">Confirmer ma commande</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                @endauth
            @endif
        </div>
    </div>
    <!--Checkout page section end-->
@endsection
@push("scripts")
    @if(auth()->check() && auth()->user()->client)
        <script>
            $(document).ready(function () {
                $("#ville").val('{{auth()->user()->client->fk_departement}}').niceSelect('update');
            })
        </script>
    @endif
    @auth()
        <script>
            $('[name=shipping_method]').change(function () {
                $("#shipping_method").click().addClass("done");
                if ({{$shipping}} > 0) {
                    if (this.value === '1') {
                        $('#shipping_fees').text(Intl.NumberFormat('fr-TN', {
                            style: 'currency',
                            currency: 'TND'
                        }).format(0));
                        $('#total').text(Intl.NumberFormat('fr-TN', {
                            style: 'currency',
                            currency: 'TND'
                        }).format({{Cart::getTotal()}}));
                    } else {
                        $('#shipping_fees').text(Intl.NumberFormat('fr-TN', {
                            style: 'currency',
                            currency: 'TND'
                        }).format({{$shipping}}))
                        $('#total').text(Intl.NumberFormat('fr-TN', {
                            style: 'currency',
                            currency: 'TND'
                        }).format({{Cart::getTotal() + $shipping}}))
                    }
                }
            });
        </script>
    @endauth
@endpush
