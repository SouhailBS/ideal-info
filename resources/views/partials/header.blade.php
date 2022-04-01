<!--Offcanvas menu area start-->
<div class="off_canvars_overlay">

</div>
<div class="Offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                </div>
                <div class="Offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                    </div>
                    <div class="support_info">
                        @include("partials.support-info")
                    </div>
                    <div class="top_right text-right">
                        @include("partials.top-right-actions")
                    </div>

                    @include("partials.search-box")

                    <div class="middel_right_info">
                        {{--<div class="header_wishlist">
                            <a href="wishlist.html"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                            <span class="wishlist_quantity">3</span>
                        </div>--}}
                        <div class="mini_cart_wrapper">
                            <a href="javascript:void(0)">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                {{numfmt_format_currency(numfmt_create( 'fr_TN', NumberFormatter::CURRENCY ), Cart::getTotal(), 'TND')}}
                                <i class="fa fa-angle-down"></i></a>
                            @if(!Cart::isEmpty())
                                <span class="cart_quantity">{{Cart::getContent()->count()}}</span>
                            @endif
                            @include('partials.catalog.mini-cart')
                        </div>
                    </div>
                    <div id="menu" class="text-left ">
                        @include('partials.menu-mobile')
                    </div>

                    <div class="Offcanvas_footer">
                        <span><a href="mailto:{{config("company.MAIN_INFO_SOCIETE_MAIL")}}"><i
                                    class="fa fa-envelope-o"></i> {{config("company.MAIN_INFO_SOCIETE_MAIL")}}</a></span>
                        <ul>
                            <li><a target="_blank" class="facebook"
                                   href="{{config("company.MAIN_INFO_SOCIETE_FACEBOOK_URL")}}"
                                   title="Facebook"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a target="_blank" class="twitter"
                                   href="{{config("company.MAIN_INFO_SOCIETE_TWITTER_URL")}}"
                                   title="Twitter"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a target="_blank" class="instagram"
                                   href="{{config("company.MAIN_INFO_SOCIETE_INSTAGRAM_URL")}}"
                                   title="Instagram"><i
                                        class="fa fa-instagram"></i></a></li>
                            <li><a target="_blank" class="linkedin"
                                   href="{{config("company.MAIN_INFO_SOCIETE_LINKEDIN_URL")}}"
                                   title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li><a target="_blank" class="whatsapp"
                                   href="{{config("company.MAIN_INFO_SOCIETE_WHATSAPP_URL")}}"
                                   title="WhatsApp"><i class="fa fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Offcanvas menu area end-->

<!--header area start-->
<header>
    <div class="main_header">
        <!--header top start-->
        <div class="header_top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="support_info">
                            @include("partials.support-info")
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="top_right text-right">
                            @include("partials.top-right-actions")
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header top start-->
        <!--header middel start-->
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="logo">
                            <a href="{{url('/')}}"><img
                                    src="{{route("dolibarr",['mycompany/logos/' . config("company.MAIN_INFO_SOCIETE_LOGO")])}}"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-6">
                        <div class="middel_right">

                            @include("partials.search-box")

                            <div class="middel_right_info">
                                {{--<div class="header_wishlist">
                                    <a href="wishlist.html"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <span class="wishlist_quantity">3</span>
                                </div>--}}
                                <div class="mini_cart_wrapper">
                                    <a href="javascript:void(0)"><i class="fa fa-shopping-bag"
                                                                    aria-hidden="true"></i>{{numfmt_format_currency(numfmt_create( 'fr_TN', NumberFormatter::CURRENCY ), Cart::getTotal(), 'TND')}}
                                        <i
                                            class="fa fa-angle-down"></i></a>
                                    @if(!Cart::isEmpty())
                                        <span class="cart_quantity">{{Cart::getContent()->count()}}</span>
                                    @endif
                                    @include('partials.catalog.mini-cart')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header middel end-->
        <!--header bottom satrt-->
        <div class="main_menu_area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="main_menu menu_position">
                            <nav>
                                @include('partials.menu')
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header bottom end-->
    </div>
</header>
<!--header area end-->

<!--sticky header area start-->
<div class="sticky_header_area sticky-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-2">
                <div class="logo">
                    <a href="{{url('/')}}"><img
                            src="{{route("dolibarr",['mycompany/logos/' . config("company.MAIN_INFO_SOCIETE_LOGO")])}}"
                            alt=""></a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="sticky_header_right menu_position">
                    <div class="main_menu" style="margin-right: 30px">
                        <nav>
                            @include('partials.menu')
                        </nav>
                    </div>
                    <div class="middel_right_info">
                        <div class="mini_cart_wrapper">
                            <a href="javascript:void(0)">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
                            @if(!Cart::isEmpty())
                                <span class="cart_quantity">{{Cart::getContent()->count()}}</span>
                            @endif
                            @include('partials.catalog.mini-cart')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--sticky header area end-->
