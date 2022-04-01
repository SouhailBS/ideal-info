@component('mail::message')

Nom: {{$message->nom}}
Email: {{$message->email}}
Objet: {{$message->subject}}
Message: {{$message->message}}

@endcomponent
