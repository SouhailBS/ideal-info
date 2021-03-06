<ul class="offcanvas_main_menu">
    @foreach($categories as $category)
        <li @if($category->subCategories->isNotEmpty()) class="menu-item-has-children" @endif>
            <a href="{{$category->route}}">{{$category->label}}</a>
            @if($category->subCategories->isNotEmpty())
                <ul class="sub-menu">
                    @foreach($category->subCategories as $subCategory)
                        <li @if($subCategory->subCategories->isNotEmpty()) class="menu-item-has-children" @endif>
                            <a href="{{$subCategory->route}}">{{$subCategory->label}}</a>
                            @if($subCategory->subCategories->isNotEmpty())
                                <ul class="sub-menu">
                                    @foreach($subCategory->subCategories as $subSubCategory)
                                        <li><a href="{{$subSubCategory->route}}">{{$subSubCategory->label}}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach

    <li class="menu-item-has-children"><a href="{{route('our-services')}}">Nos Services</a></li>
    <li class="menu-item-has-children"><a href="{{route('contact-us')}}"> Contactez-nous</a></li>
</ul>
