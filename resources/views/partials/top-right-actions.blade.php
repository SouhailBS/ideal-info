<ul>
    @auth
        <li><a href="{{route("account")}}">Mon compte</a></li>
        <li><a href="{{route("checkout")}}"> Passer ma commande </a></li>
    @endauth
    @guest
        <li><a href="{{route("login-form")}}">Se connecter</a></li>
        <li><a href="{{route("register-form")}}">Crée un compte</a></li>
    @endguest
</ul>
