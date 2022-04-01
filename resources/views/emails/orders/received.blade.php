@component('mail::message')
    #Cher(e) {{$order->client->nom}},

    Nous vous remercions pour vos achats sur {{ config('app.name') }}! Votre commande {{$order->rowid}} a été confirmée avec succès.

    Elle sera traitée dès que possible. Vous recevrez une notification de notre part dès que le(s) article(s) sera(seront) prêt(s) à être livré(s).

    Merci d'avoir fait vos achats sur {{ config('app.name') }}.

    @component('mail::table')
        | Produit       | Quantité         | Prix  |
        | ------------- |:-------------:| --------:|
        @foreach($order->lines as $line)
        | {{$line->product->label}}      | {{$line->qty}}      | {{$line->total_ttc}} DT     |
        @endforeach
    @endcomponent

    Bon Shopping !

    Bonne journée,
    L'équipe de {{ config('app.name') }}
@endcomponent
