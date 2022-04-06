@extends("layouts.app")
@section("title", "Mon compte")

@section("content")
    <!-- my account start  -->
    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button">
                            <ul role="tablist" class="nav flex-column dashboard-list">
                                <li><a href="#account-details" data-bs-toggle="tab" class="nav-link active">Détails du compte</a>
                                </li>
                                {{--<li><a href="#orders" data-bs-toggle="tab" class="nav-link">Commandes</a></li>
                                <li><a href="#address" data-bs-toggle="tab" class="nav-link">Adresses</a></li>--}}

                                <li><a href="{{route("logout")}}" class="nav-link">Se déconnecter</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">
                            <div class="tab-pane fade show active" id="account-details">
                                <h3>Détails du compte</h3>
                                <div class="login">
                                    <div class="login_form_container">
                                        <div class="account_login_form">
                                            <form method="POST" action="#">
                                                <div class="input-radio">
                                                    <span class="custom-radio"><input type="radio" value="1"
                                                                                      name="id_gender"> M.</span>
                                                    <span class="custom-radio"><input type="radio" value="2"
                                                                                      name="id_gender"> Mme.</span>
                                                </div>
                                                <br>
                                                <label for="firstname">Prénom <span>*</span></label>
                                                <input value="{{auth()->user()->firstname}}" type="text" name="firstname" id="firstname" required placeholder="Votre prénom">
                                                <label for="lastname">Nom <span>*</span></label>
                                                <input value="{{auth()->user()->lastname}}" type="text" name="lastname" id="lastname" required placeholder="Votre nom">
                                                <label for="email">Email <span>*</span></label>
                                                <input value="{{auth()->user()->email}}" type="email" name="email" id="email" readonly>
                                                <label for="password">Mot de passe</label>
                                                <input type="password" name="password" id="password" placeholder="Votre mot de passe">
                                                <div class="save_button primary_btn default_button">
                                                    <button type="submit">Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="orders">
                                <h3>Orders</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>May 10, 2018</td>
                                            <td><span class="success">Completed</span></td>
                                            <td>$25.00 for 1 item</td>
                                            <td><a href="cart.html" class="view">view</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>May 10, 2018</td>
                                            <td>Processing</td>
                                            <td>$17.00 for 1 item</td>
                                            <td><a href="cart.html" class="view">view</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="address">
                                <p>The following addresses will be used on the checkout page by default.</p>
                                <h4 class="billing-address">Billing address</h4>
                                <a href="#" class="view">Edit</a>
                                <p><strong>Bobby Jackson</strong></p>
                                <address>
                                    House #15<br>
                                    Road #1<br>
                                    Block #C <br>
                                    Banasree <br>
                                    Dhaka <br>
                                    1212
                                </address>
                                <p>Bangladesh</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account end   -->
@endsection

@push("scripts")
@endpush
