@component('mail::message')

Nom: {{$message->nom}}
Email: {{$message->email}}
Objet: {{$message->objet}}
Message: {{$message->message}}

@endcomponent
