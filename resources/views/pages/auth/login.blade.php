@extends("layouts.app")
@section("title", "Connectez-vous à votre compte")

@section("content")
    <!-- customer login start -->
    <div class="customer_login mt-60">
        <div class="container">
            <div class="row">
                <!--login area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form">
                        <h2>Connectez-vous à votre compte</h2>
                        <form method="POST" action="{{route("login")}}">
                            @csrf
                            <p>
                                <label for="email">E-mail <span>*</span></label>
                                <input id="email" type="email" name="email" required placeholder="Votre adresse email">
                            </p>
                            <p>
                                <label for="pass">Mot de passe <span>*</span></label>
                                <input id="pass" type="password" name="password" required placeholder="Votre mot de passe">
                            </p>
                            <div class="login_submit">
                                <a href="#">Lost your password?</a>
                                <label for="remember">
                                    <input id="remember" name="remember_me" value="1" type="checkbox">
                                    Rester connecté
                                </label>
                                <button type="submit">Connexion</button>

                            </div>

                        </form>
                    </div>
                </div>
                <!--login area start-->

                <!--image area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register text-center">
                        <img src="/img/login.png" class="mt-md-4 w-50">
                    </div>
                </div>
                <!--image area end-->
            </div>
        </div>
    </div>
    <!-- customer login end -->
@endsection
@push("scripts")
@endpush
