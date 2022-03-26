<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listing()
    {
        $products = Product::where('tosell', '>', '0')->paginate(12)->withQueryString();
        return view("pages.products")->with("products", $products);
    }

    public function category()
    {
        $products = Product::where('tosell', '>', '0')->paginate(12)->withQueryString();
        return view("pages.products")->with("products", $products);
    }
}
