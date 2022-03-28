@extends("layouts.app")
@section("title", "Page introuvable")

@section("content")
    <!--error section area start-->
    <div class="error_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="error_form">
                        <h1>404</h1>
                        <h2>Oups! PAGE INTROUVABLE</h2>
                        <p>Désolé, mais la page que vous recherchez n'existe pas, a été<br> supprimée, le nom a changé
                            ou est temporairement indisponible.</p>
                        <a href="{{url('/')}}">Retour à la page d'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--error section area end-->
@endsection

@push("scripts")
@endpush
