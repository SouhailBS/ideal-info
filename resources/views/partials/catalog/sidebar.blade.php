<!--sidebar widget start-->
<aside class="sidebar_widget">
    <div class="widget_inner">
        <div class="widget_list widget_categories">
            @php
                if (isset($category)){
                    $sideCategories = $category;
                    if($category->subCategories->isEmpty())
                        $sideCategories = $category->parent;
                    }
                else
                    $sideCategories = $mainCategory;
            @endphp
            <h2>{{$sideCategories->label}}</h2>
            <ul>

                @foreach($sideCategories->subCategories as $subCategory)
                    @if($subCategory->subCategories->isEmpty())
                        <li><a href="{{$subCategory->route}}">{{$subCategory->label}}</a></li>
                    @else
                        <li class="widget_sub_categories"><a class="active"
                                                             href="javascript:void(0)">{{$subCategory->label}}</a>
                            <ul class="widget_dropdown_categories" style="display: none">
                                @foreach($subCategory->subCategories as $subSubCategory)
                                    <li><a href="{{$subSubCategory->route}}">{{$subSubCategory->label}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
        <div class="widget_list widget_filter">
            <h2>Filtrer par prix</h2>
            <form action="{{url()->current()}}">
                <div id="slider-range" data-max="{{$max}}" data-min="{{$min}}" data-vmax="{{$vmax}}" data-vmin="{{$vmin}}"></div>
                <button type="submit">Filtrer</button>
                <input type="text" id="amount" readonly/>
                <input type="hidden" name="price" id="price" value="{{$vmin.'*'.$vmax}}">
                <input value="{{$orderby}}" type="hidden" name="orderby">
            </form>
        </div>
        {{--<div class="widget_list">
            <h2>Compare Products</h2>
            <div class="recent_product_container">
                <article class="recent_product_list">
                    <figure>
                        <div class="product_thumb">
                            <a href="{{$product->route}}"><img
                                    src="/assets/img/product/product1.jpg" alt=""></a>
                        </div>
                        <div class="product_content">
                            <h3><a href="{{$product->route}}">Natus erro at congue</a></h3>
                            <div class="product_ratings">
                                <ul>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="price_box">
                                <span class="old_price">$70.00</span>
                                <span class="current_price">$65.00</span>
                            </div>
                        </div>
                    </figure>
                </article>
                <article class="recent_product_list">
                    <figure>
                        <div class="product_thumb">
                            <a href="{{$product->route}}"><img
                                    src="/assets/img/product/product2.jpg" alt=""></a>
                        </div>
                        <div class="product_content">
                            <h3><a href="{{$product->route}}">Auctor gravida enim</a></h3>
                            <div class="product_ratings">
                                <ul>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="price_box">
                                <span class="old_price">$70.00</span>
                                <span class="current_price">$65.00</span>
                            </div>
                        </div>
                    </figure>
                </article>
                <article class="recent_product_list">
                    <figure>
                        <div class="product_thumb">
                            <a href="{{$product->route}}"><img
                                    src="/assets/img/product/product24.jpg" alt=""></a>
                        </div>
                        <div class="product_content">
                            <h3><a href="{{$product->route}}">Cillum dolore tortor</a></h3>
                            <div class="product_ratings">
                                <ul>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="price_box">
                                <span class="old_price">$70.00</span>
                                <span class="current_price">$65.00</span>
                            </div>
                        </div>
                    </figure>
                </article>
            </div>
        </div>--}}
    </div>
</aside>
<!--sidebar widget end-->
