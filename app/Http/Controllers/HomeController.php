<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('tosell', '>', '0')->take(20)->get();
        $categories = Category::where('visible', '0')->where('fk_parent', '2')->take(6)->get();
        return view("home")->with(["products" => $products, "categories" => $categories]);
    }

}
