<div class="search_container">
    <form action="{{route("search")}}">
        <div class="search_box">
            <input autocomplete="off" class="search-input" placeholder="Rechercher un produit ..." type="search"
                   name="q">
            <button type="submit">Rechercher</button>
        </div>
    </form>
    <!--mini cart-->
    <div class="mini_cart search-result"></div>
    <!--mini cart end-->
</div>
@once
    @push('scripts')
        <script>
            $(document).ready(function () {
                $(".search-input").focus(function () {
                    if ($('.search-result').children().length)
                        $(".search_container").addClass("has-results");
                });
                $(".search-input").blur(function () {
                    setTimeout(function () {
                        $(".search_container").removeClass("has-results");
                    }, 500)
                });
                $(".search-input").keyup(function () {
                    if (this.value.length < 3) {
                        $(".search_container").removeClass("has-results");
                        return;
                    }

                    $.get('/search', {q: this.value, output: 'json'}, function (data) {
                        if (data.length === 0)
                            return;
                        $('.search-result').html("")
                        $(".search_container").addClass("has-results");
                        for (const product of data) {
                            let element = $.parseHTML("<div data-href=\"" + product.route + "\" class=\"cart_item\">\n" +
                                "            <div class=\"cart_img\">\n" +
                                "                <a href=\"" + product.route + "\"><img src=\"" + product.thumb_small + "\" alt=\"\"></a>\n" +
                                "            </div>\n" +
                                "            <div class=\"cart_info\">\n" +
                                "                <a href=\"" + product.route + "\">" + product.label + "</a>\n" +
                                "            </div>\n" +
                                "        </div>"
                            )
                            $(element).bind('click', function () {
                                location.href = $(this).data("href")
                            });
                            $('.search-result').append(element);
                        }
                    })
                });
            });
        </script>
    @endpush
@endonce
