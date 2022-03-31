<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $bestSeller = Product::leftJoin('commandedet', 'product.rowid', '=', 'commandedet.fk_product')
            ->selectRaw(DB::getTablePrefix() . 'product.*, COALESCE(sum(' . DB::getTablePrefix() . 'commandedet.qty),0) total')
            ->groupBy('product.rowid')
            ->orderBy('total', 'desc')
            ->where('tosell', '>', '0')
            ->where('stock', '>', 0)
            ->take(5)
            ->get();

        $products = Product::where('tosell', '>', '0')->inRandomOrder()->take(20)->get();
        $categories = Category::where('visible', '0')->where('fk_parent', '2')->take(6)->get();

        $newProducts = Product::where('tosell', '>', '0')->where('datec', '>', now()->subDays(30)->endOfDay())->inRandomOrder()->take(30)->get();
        $promo = Product::where('tosell', '>', '0')->where('price_min', '>', 0)->where('stock', '>', 0)->inRandomOrder()->take(30)->get();
        return view("home")->with([
            "products" => $products,
            "bestSeller" => $bestSeller,
            "newProducts" => $newProducts,
            "promo" => $promo,
            "categories" => $categories
        ]);
    }

}
