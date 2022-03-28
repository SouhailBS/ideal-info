<!--shop toolbar start-->
<div class="shop_toolbar_wrapper">
    <div class="shop_toolbar_btn">
        <button data-role="grid_3" type="button" class="btn-grid-3" data-bs-toggle="tooltip"
                title="3"></button>
        <button data-role="grid_4" type="button" class="btn-grid-4" data-bs-toggle="tooltip"
                title="4"></button>
        <button data-role="grid_list" type="button" class="active btn-list" data-bs-toggle="tooltip"
                title="List"></button>
    </div>

    <div class="niceselect_option">
        <form action="{{url()->current()}}">
            <select class="nice-select" name="orderby" id="short" onchange="this.form.submit()">
                <option data-display="{{$sortDisplay}}" value="none">Ne pas trier</option>
                <option value="price_ttc.asc">Prix croissant</option>
                <option value="price_ttc.desc">Prix décroissant</option>
                <option value="label.asc">Nom A-Z</option>
                <option value="label.desc">Nom Z-A</option>
            </select>
        </form>
    </div>
    <div class="page_amount">
        <p>Affichage de {{$products->perPage() * ($products->currentPage() -1) + 1}}
            à {{($products->perPage() * ($products->currentPage() -1)) + $products->count()}} sur {{$products->total()}}
            résultats</p>
    </div>
</div>
<!--shop toolbar end-->
