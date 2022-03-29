<ul class="offcanvas_main_menu">
    @foreach($categories as $category)
        <li class="menu-item-has-children">
            <a href="{{$category->route}}">{{$category->label}}</a>
            <ul class="sub-menu">
                @foreach($category->subCategories as $subCategory)
                    <li class="menu-item-has-children">
                        <a href="{{$subCategory->route}}">{{$subCategory->label}}</a>
                        <ul class="sub-menu">
                            @foreach($subCategory->subCategories as $subSubCategory)
                                <li><a href="{{$subSubCategory->route}}">{{$subSubCategory->label}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
