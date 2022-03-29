<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function listing()
    {
        $products = Product::where('tosell', '>', '0')->paginate(12)->withQueryString();
        return view("pages.products")->with(["title" => "Nos produits", "products" => $products]);
    }

    public function category(Category $category, $slug)
    {
        if ($slug != Str::slug($category->label))
            return redirect($category->route);
        $sortDisplay = "Trier par";
        $sortDisplayValues = [
            "price_ttc.asc" => "Prix croissant",
            "price_ttc.desc" => "Prix décroissant",
            "label.asc" => "Nom A-Z",
            "label.desc" => "Nom Z-A",
        ];

        if (request()->has("orderby") && isset($sortDisplayValues[request()->get("orderby")])) {
            $order = explode('.', request()->get("orderby"));
            $products = Product::where('tosell', '>', '0')->orderBy($order[0], $order[1])->paginate(12)->withQueryString();
            $sortDisplay .= ": " . $sortDisplayValues[request()->get("orderby")];
        } else
            $products = $category->products()->where('tosell', '>', '0')->paginate(12)->withQueryString();

        $category->loadMissing("subCategories");
        return view("pages.products")->with(["sortDisplay" => $sortDisplay, "category" => $category, "products" => $products]);
    }

    public function product(Product $product, $slug)
    {
        if ($slug != Str::slug($product->label))
            return redirect($product->route);

        return view("pages.product")->with(["product" => $product]);
    }
}
