<ul>
    @isset($filter)
        @if($filter->isNotEmpty())
            @foreach($filter as $item)
                <li class="widget_sub_categories"><a href="javascript:void(0)" class="">{{$item->label}}</a>
                    <ul class="widget_dropdown_categories">
                        @foreach($item->subCategories as $subSubCategory)
                            @if($subSubCategory->products->isNotEmpty())
                                <li class="border-bottom-0">
                                    <a class="p-0">
                                        <input type="checkbox" name="filter_{{$item->rowid}}"
                                               id="filter_{{$subSubCategory->rowid}}"
                                               value="{{$subSubCategory->rowid}}">
                                        <label class="p-2"
                                               for="filter_{{$subSubCategory->rowid}}">{{$subSubCategory->label}} </label>
                                        <span class="pull-right p-2" style="color:#CCCCCC;">({{$subSubCategory->products->count()}})</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
        @endif
    @endisset
    <li class="widget_sub_categories"><a href="javascript:void(0)" class="">Disponibilité</a>
        <ul class="widget_dropdown_categories">
            <li class="border-bottom-0">
                <a class="p-0">
                    <input type="radio" id="stock_1" name="stock"
                           value="1">
                    <label class="p-2"
                           for="stock_1">Disponible </label>
                    <span class="pull-right p-2" style="color:#CCCCCC;">({{$stock}})</span>
                </a>
            </li>
            <li class="border-bottom-0">
                <a class="p-0">
                    <input type="radio" id="stock_0" name="stock"
                           value="0">
                    <label class="p-2"
                           for="stock_0">Sur commande </label>
                    <span class="pull-right p-2" style="color:#CCCCCC;">({{$commande}})</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="widget_sub_categories border-bottom-0"><a href="javascript:void(0)" class="">Fourchette des prix</a>
        <ul class="widget_dropdown_categories" style="">
            <li class="border-bottom-0">
                <form>
                    <div id="slider-range" class="mt-2 mb-2" data-max="{{$max}}" data-min="{{$min}}"
                         data-vmax="{{$vmax}}"
                         data-vmin="{{$vmin}}"></div>
                    <input type="text" id="amount" readonly/>
                    <input type="hidden" name="price" id="price" value="{{$vmin.'*'.$vmax}}">
                    @isset($search)
                        <input type="hidden" id="search" name="q" value="{{$search}}">
                    @endisset
                </form>
            </li>
        </ul>
    </li>
    <li><a id="clear_filter" class="w-100 btn btn-danger btn-sm mt-3 mb-0">Vider le filtre</a></li>
</ul>
@push("scripts")
    <script>
        function reload() {
            data = {};
            for (let val of $(".widget_filter input, #sort").serializeArray()) {
                if (data[val.name] === undefined) {
                    data[val.name] = val.value;
                } else if (typeof data[val.name] === 'object') {
                    data[val.name].push(val.value);
                } else {
                    data[val.name] = [data[val.name], val.value];
                }
            }
            window.history.pushState({}, null, "{{url()->current()}}/?" + $.param(data));
            $(".widget_filter input, #price").attr("disabled", true);
            $('#products-main-container').load("{{url()->current()}}/?" + $.param(data), function () {
                $(".widget_filter input, #sort, #price").attr("disabled", false);
                $('#sort').val(data["orderby"]);
                $('#sort').niceSelect();
            });
        }

        $(document).ready(function () {
            const urlParams = new URLSearchParams(window.location.search);
            entries = urlParams.entries();
            if (urlParams.has("orderby"))
                $('#sort').val(urlParams.get("orderby"));
            if (urlParams.has("stock"))
                $('#stock_' + urlParams.get("stock")).prop("checked", true);
            for (const entry of entries) {
                console.log(`${entry[0]}: ${entry[1]}`);
                if (entry[0].startsWith("filter_"))
                    $("#filter_" + entry[1]).prop("checked", true);
            }
            $.ajaxSetup({
                    'headers': {
                        'Content-Type': 'application/json',
                    }
                }
            );
            $(".widget_filter input, #sort, #price").change(reload)
            $("#slider-range").on("slidechange", function (event, ui) {
                if (ui.values[0] != {{$vmin}} || ui.values[1] != {{$vmax}})
                    reload();
            });
            $("#clear_filter").click(function (event) {
                event.preventDefault();
                $("#slider-range").slider("values", 1, {{$max}}).slider("values", 0, {{$min}});
                $(".widget_filter input[type=checkbox], .widget_filter input[type=radio]").each(function () {
                    $(this).prop("checked", false);
                });
            });
        });
    </script>
@endpush
