<ul>
    @foreach($categories as $category)
        {{--<li class="active"><a class="active" href="index.html">home<i
                    class="fa fa-angle-down"></i></a>
            <ul class="sub_menu">
                <li><a href="index.html">Home shop 1</a></li>
                <li><a href="index-2.html">Home shop 2</a></li>
                <li><a href="index-3.html">Home shop 3</a></li>
                <li><a href="index-4.html">Home shop 4</a></li>
                <li><a href="index-5.html">Home shop 5</a></li>
            </ul>
        </li>--}}
        <li class="mega_items"><a href="{{$category->route}}">{{$category->label}}<i
                    class="fa fa-angle-down"></i></a>
            <div class="mega_menu">
                <ul class="mega_menu_inner">
                    @foreach($category->subCategories as $subCategory)
                        <li><a href="{{$subCategory->route}}">{{$subCategory->label}}</a>
                            <ul>
                                @foreach($subCategory->subCategories as $subSubCategory)
                                    <li><a href="{{$subSubCategory->route}}">{{$subSubCategory->label}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
    @endforeach
</ul>
