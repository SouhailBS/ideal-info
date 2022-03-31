<!--footer area start-->
<footer class="footer_widgets">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widgets_container contact_us">
                        <div class="footer_logo">
                            <a href="{{url('/')}}"><img
                                    src="{{route("dolibarr",['mycompany/logos/' . config("company.MAIN_INFO_SOCIETE_LOGO")])}}"
                                    alt=""></a>
                        </div>
                        <div class="footer_contact">
                            <p>{{config("company.MAIN_INFO_SOCIETE_NOTE")}}</p>
                            <p><span>Adresse: </span>{{config("company.MAIN_INFO_SOCIETE_ADDRESS")}}
                                , {{config("company.MAIN_INFO_SOCIETE_ZIP")}}
                                , {{config("company.MAIN_INFO_SOCIETE_TOWN")}}
                                , {{explode(':', config("company.MAIN_INFO_SOCIETE_STATE"))[2]}}
                                , {{explode(':', config("company.MAIN_INFO_SOCIETE_COUNTRY"))[2]}}</p>
                            <p><span>Appelez-nous: </span><a
                                    href="tel:{{config("company.MAIN_INFO_SOCIETE_TEL")}}">{{config("company.MAIN_INFO_SOCIETE_TEL")}}</a>
                                – <a
                                    href="tel:{{config("company.MAIN_INFO_SOCIETE_FAX")}}">{{config("company.MAIN_INFO_SOCIETE_FAX")}}</a>
                            </p>
                            <p><span>Écrivez-nous: </span><a
                                    href="mailto:{{config("company.MAIN_INFO_SOCIETE_MAIL")}}">{{config("company.MAIN_INFO_SOCIETE_MAIL")}}</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>Liens utiles</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="{{route("about-us")}}">À propos de nous</a></li>
                                <li><a href="{{route("contact-us")}}">Contactez-nous</a></li>
                                <li><a href="{{route("our-services")}}">Nos Services</a></li>
                                <li><a href="{{route("promo")}}">Nos promotions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>Compte</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="{{route("account")}}">Mon Compte</a></li>
                                <li><a href="{{route("cart")}}">Mon panier</a></li>
                                <li><a href="{{route("login-form")}}">Se connecter</a></li>
                                <li><a href="{{route("register-form")}}">Crée un compte</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="widgets_container newsletter">
                        <h3>Suivez-nous</h3>
                        <div class="footer_social_link">
                            <ul>
                                <li><a target="_blank" class="facebook" href="{{config("company.MAIN_INFO_SOCIETE_FACEBOOK_URL")}}"
                                       title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a target="_blank" class="twitter" href="{{config("company.MAIN_INFO_SOCIETE_TWITTER_URL")}}"
                                       title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a target="_blank" class="instagram" href="{{config("company.MAIN_INFO_SOCIETE_INSTAGRAM_URL")}}"
                                       title="Instagram"><i
                                            class="fa fa-instagram"></i></a></li>
                                <li><a target="_blank" class="linkedin" href="{{config("company.MAIN_INFO_SOCIETE_LINKEDIN_URL")}}"
                                       title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li><a target="_blank" class="whatsapp" href="{{config("company.MAIN_INFO_SOCIETE_WHATSAPP_URL")}}"
                                       title="WhatsApp"><i class="fa fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                        {{--<div class="subscribe_form">
                            <h3>Join Our Newsletter Now</h3>
                            <form id="mc-form" class="mc-form footer-newsletter">
                                <input id="mc-email" type="email" autocomplete="off"
                                       placeholder="Your email address..."/>
                                <button id="mc-submit">Subscribe!</button>
                            </form>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts text-centre">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                            </div><!-- mailchimp-alerts end -->
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright_area">
                        <p class="copyright-text">2006 - {{now()->year}} &copy; <a
                                href="{{url('/')}}">{{config('company.MAIN_INFO_SOCIETE_NOM')}}</a>.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="footer_payment text-right">
                        <a href="#"><img src="/assets/img/icon/payment.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer area end-->
