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
                                <label>E-mail <span>*</span></label>
                                <input type="email" name="email" required placeholder="Votre adresse email">
                            </p>
                            <p>
                                <label>Mot de passe <span>*</span></label>
                                <input type="password" name="password" required placeholder="Votre mot de passe">
                            </p>
                            <div class="login_submit">
                                <a href="#">Lost your password?</a>
                                <label for="remember">
                                    <input id="remember" value="1" type="checkbox">
                                    Remember me
                                </label>
                                <button type="submit">Connexion</button>

                            </div>

                        </form>
                    </div>
                </div>
                <!--login area start-->

                <!--register area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register">
                        <h2>Register</h2>
                        <img src="/img/login.png">
                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div>
    <!-- customer login end -->
@endsection
@push("scripts")
@endpush
