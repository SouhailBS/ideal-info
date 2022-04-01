<div class="search_container">
    <form action="{{route("search")}}">
        <div class="hover_category">
            <select class="select_option" name="category" id="categories">
                <option selected value="2">Tous les catégories</option>
                @foreach($categories as $category)
                    <option value="{{$category->rowid}}">{{$category->label}}</option>
                @endforeach
            </select>
        </div>
        <div class="search_box">
            <input placeholder="Rechercher un produit ..." type="search" name="q">
            <button type="submit">Rechercher</button>
        </div>
    </form>
</div>
