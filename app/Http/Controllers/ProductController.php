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
        $products = Product::where('tosell', '>', '0')->paginate(12)->withQueryString();
        $category->loadMissing("subCategories");
        return view("pages.products")->with(["title" => $category->label, "category" => $category, "products" => $products]);
    }

    public function product(Product $product, $slug)
    {
        if ($slug != Str::slug($product->label))
            return redirect($product->route);

        return view("pages.product")->with(["product" => $product]);
    }
}
