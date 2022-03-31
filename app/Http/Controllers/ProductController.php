<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $sortDisplay = "Trier par";
    private $sortDisplayValues = [
        "price_ttc.asc" => "Prix croissant",
        "price_ttc.desc" => "Prix décroissant",
        "label.asc" => "Nom A-Z",
        "label.desc" => "Nom Z-A",
    ];

    public function promo()
    {
        if (request()->has("orderby") && isset($this->sortDisplayValues[request()->get("orderby")])) {
            $order = explode('.', request()->get("orderby"));
            $products = Product::where('tosell', '>', '0')->where('price_min', '>', 0)->orderBy($order[0], $order[1])->paginate(12)->withQueryString();
            $this->sortDisplay .= ": " . $this->sortDisplayValues[request()->get("orderby")];
        } else
            $products = Product::where('tosell', '>', '0')->where('price_min', '>', 0)->paginate(12)->withQueryString();
        return view("pages.products")->with([
            "title" => "Nos promotions",
            "products" => $products,
            "sortDisplay" => $this->sortDisplay,
            "mainCategory" => Category::where('rowid', 2)->first()
        ]);
    }

    public function category(Category $category, $slug)
    {
        if ($slug != Str::slug($category->label))
            return redirect($category->route);

        if (request()->has("orderby") && isset($this->sortDisplayValues[request()->get("orderby")])) {
            $order = explode('.', request()->get("orderby"));
            $products = $category->products()->where('tosell', '>', '0')->orderBy($order[0], $order[1])->paginate(12)->withQueryString();
            $this->sortDisplay .= ": " . $this->sortDisplayValues[request()->get("orderby")];
        } else
            $products = $category->products()->where('tosell', '>', '0')->paginate(12)->withQueryString();

        $category->loadMissing("subCategories");
        return view("pages.products")->with(["sortDisplay" => $this->sortDisplay, "category" => $category, "products" => $products]);
    }

    public function product(Product $product, $slug)
    {
        abort_unless($product->tosell, 404);
        if ($slug != Str::slug($product->label))
            return redirect($product->route);

        return view("pages.product")->with(["product" => $product]);
    }
}
