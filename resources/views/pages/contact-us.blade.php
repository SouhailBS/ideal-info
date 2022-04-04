@extends("layouts.app")
@section("title", "Contactez-nous")

@section("content")
    <x-breadcrumbs :levels="[(object) array('label' => 'Contactez-nous')]"/>
    <!--contact map start-->
    <div class="contact_map">
        <div class="map-area">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12834.874772477595!2d10.80265!3d36.464354!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc4737f19d61dca0!2sIDEAL%20INFORMATIQUE!5e0!3m2!1sfr!2stn!4v1648752068234!5m2!1sfr!2stn"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <!--contact map end-->

    <!--contact area start-->
    <div class="contact_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message content">
                        <h3>Nous contacter</h3>
                        <p>{{config("company.MAIN_INFO_SOCIETE_NOTE")}}</p>
                        <ul>
                            <li>
                                <i class="fa fa-home"></i> Adresse : {{config("company.MAIN_INFO_SOCIETE_ADDRESS")}}
                                , {{config("company.MAIN_INFO_SOCIETE_ZIP")}}
                                , {{config("company.MAIN_INFO_SOCIETE_TOWN")}}
                                , {{explode(':', config("company.MAIN_INFO_SOCIETE_STATE"))[2]}}
                                , {{explode(':', config("company.MAIN_INFO_SOCIETE_COUNTRY"))[2]}}
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"> </i>
                                Email: <a
                                    href="mailto:{{config("company.MAIN_INFO_SOCIETE_MAIL")}}">{{config("company.MAIN_INFO_SOCIETE_MAIL")}}</a>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> Téléphone: <a
                                    href="tel:{{config("company.MAIN_INFO_SOCIETE_TEL")}}">{{config("company.MAIN_INFO_SOCIETE_TEL")}}</a>
                                – <a
                                    href="tel:{{config("company.MAIN_INFO_SOCIETE_FAX")}}">{{config("company.MAIN_INFO_SOCIETE_FAX")}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success mb-2">
                            {!! session('success') !!}
                        </div>
                    @endif
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mt-2">{{ $error }}</div>
                    @endforeach
                    <div class="contact_message form">
                        <h3>Discutez avec nous</h3>
                        <form method="POST" action="{{route("submit-contact")}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-20">
                                    <label for="name"> Votre nom (obligatoire)</label>
                                    <input value="{{old('nom')}}" id="name" name="nom" placeholder="Votre nom *" type="text">
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label for="email"> Votre adresse email (obligatoire)</label>
                                    <input value="{{old('email')}}" id="email" name="email" placeholder="Email *" type="email">
                                </div>

                                <div class="col-12 mb-20">
                                    <label for="subject"> Sujet</label>
                                    <input value="{{old('subject')}}" id="subject" name="subject" placeholder="Sujet" type="text">
                                </div>
                                <div class="contact_textarea col-12">
                                    <label for="msg"> Votre Message</label>
                                    <textarea required id="msg" placeholder="Message *" name="message"
                                              class="form-control2">{{old('message')}}</textarea>
                                </div>

                                <div class="d-grid gap-2 col-md-6">
                                    <div class="mb-sm-2 g-recaptcha" data-sitekey="6LdaiEUfAAAAACnQRC-7zQaAA3pKCSDNU20M_Xzu"></div>
                                </div>

                                <div class="d-grid gap-2 col-md-6 ps-lg-4 ps-md-4 ps-xl-4">
                                    <button type="submit"> Envoyer</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--contact area end-->
@endsection
@push("scripts")
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
