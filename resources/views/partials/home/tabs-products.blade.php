<!--product area start-->
<div class="product_area mb-46">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_tab_btn3">
                    <ul class="nav" role="tablist">
                        <li>
                            <a class="active" data-bs-toggle="tab" href="#Products3" role="tab" aria-controls="Products3"
                               aria-selected="true">
                                Nouveaux produits
                            </a>
                        </li>
                        <li>
                            <a data-bs-toggle="tab" href="#Sale3" role="tab" aria-controls="Sale3"
                               aria-selected="false">
                                Produits en promotions
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">

            <div class="tab-pane fade show active" id="Products3" role="tabpanel">
                <div class="product_carousel product_column5 owl-carousel">
                    @foreach($newProducts as $product)
                        @include("partials.catalog.product-miniature")
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="Sale3" role="tabpanel">
                <div class="product_carousel product_column5 owl-carousel">
                    @foreach($promo as $product)
                        @include("partials.catalog.product-miniature")
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--product area end-->