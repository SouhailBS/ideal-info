<!--product area start-->
<div class="product_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_tab_btn3">
                    <ul class="nav" role="tablist">
                        <li>
                            <a class="active" data-bs-toggle="tab" href="#Sale3" role="tab" aria-controls="Sale3"
                               aria-selected="true">
                                Promotions
                            </a>
                        </li>
                        <li>
                            <a data-bs-toggle="tab" href="#Products3" role="tab" aria-controls="Products3"
                               aria-selected="false">
                                Nouveaux produits
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">

            <div class="tab-pane fade" id="Products3" role="tabpanel">
                <div class="@if($newProducts->count()>=10)product_slick product_slick_column5 @else product_carousel product_column5 owl-carousel @endif">
                    @foreach($newProducts as $product)
                        @include("partials.catalog.product-miniature")
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade show active" id="Sale3" role="tabpanel">
                <div
                    class="@if($promo->count()>=10)product_slick product_slick_column5 @else product_carousel product_column5 owl-carousel @endif">
                    @foreach($promo as $product)
                        @include("partials.catalog.product-miniature")
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--product area end-->
