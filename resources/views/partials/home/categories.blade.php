<!--top- category area start-->
<section class="top_category_product mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-3">
                <div class="top_category_header">
                    <h3>Top Categories This Week</h3>
                    <p>Aliquam eget consectetuer habitasse interdum.</p>
                    <a href="shop.html">Show All Categories</a>
                </div>
            </div>
            <div class="col-lg-10 col-md-9">
                <div class="top_category_container category_column5 owl-carousel">
                    @foreach($categories as $category)
                        <div class="col-lg-2">
                            <article class="single_category">
                                <figure>
                                    <div class="category_thumb">

                                        <a href="{{$category->route}}"><img
                                                src="{{$category->image}}" alt=""></a>
                                    </div>
                                    <figcaption class="category_name">
                                        <h3>
                                            <a href="{{$category->route}}">{{$category->label}}</a>
                                        </h3>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--top- category area end-->
