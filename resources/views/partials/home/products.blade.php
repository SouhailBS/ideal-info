<!--product area start-->
<section class="product_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Produits pourraient vous intéresser</h2>
                </div>
            </div>
        </div>
        <div class="product_slick product_slick_column5">
            @foreach($products as $product)
                @include("partials.catalog.product-miniature")
            @endforeach
        </div>
    </div>
</section>
<!--product area end-->
