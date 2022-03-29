@extends("layouts.app")
@section("title", "Créez votre compte")

@section("content")
    <!-- customer register start -->
    <div class="customer_login mt-60">
        <div class="container">
            <div class="row">
                <!--image area start-->
                <div class="col-lg-6 col-md-6 d-none d-md-block">
                    <div class="account_form register text-center">
                        <img src="/img/login.png" class="mt-md-4 w-75" alt="Connectez-vous à votre compte">
                    </div>
                </div>
                <!--image area end-->

                <!--register area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register">
                        <h2>Créez votre compte</h2>
                        <form method="POST" action="{{route("register")}}">
                            @csrf
                            <p>Vous avez déjà un compte? <a href="{{route("login-form")}}">Connectez-vous !</a></p>
                            <div class="input-radio">
                                Titre:
                                <label for="gender_m">
                                    <span class="custom-radio">
                                        <input type="radio" value="1" name="id_gender" id="gender_m"> M.</span>
                                </label>
                                <label for="gender_mm">
                                <span class="custom-radio">
                                    <input type="radio" value="2" name="id_gender" id="gender_mm"> Mme.</span></label>
                            </div>
                            <label for="firstname">Prénom</label>
                            <input type="text" name="firstname" id="firstname" required placeholder="Votre prénom">
                            <label for="lastname">Nom</label>
                            <input type="text" name="lastname" id="lastname" required placeholder="Votre nom">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" required placeholder="Votre adresse email">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" required placeholder="Votre mot de passe">
                            <br>
                            <br>
                            <div class="login_submit">
                                <button type="submit">S'inscrire</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div>
    <!-- customer register end -->
@endsection
@push("scripts")
@endpush
