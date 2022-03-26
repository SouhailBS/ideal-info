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
    <div class=" niceselect_option">
        <form class="select_option" action="#">
            <select name="orderby" id="short">

                <option selected value="1">Sort by average rating</option>
                <option value="2">Sort by popularity</option>
                <option value="3">Sort by newness</option>
                <option value="4">Sort by price: low to high</option>
                <option value="5">Sort by price: high to low</option>
                <option value="6">Product Name: Z</option>
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
