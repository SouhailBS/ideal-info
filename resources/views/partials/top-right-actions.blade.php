<ul>
    @auth
        <li><a href="{{route("account")}}">Mon compte</a></li>
    @endauth
    @guest
        <li><a href="{{route("login-form")}}">Se connecter</a></li>
    @endguest
    <li><a href="checkout.html"> Checkout </a></li>
</ul>
