<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        \Cart::add(['id' => $product->rowid,
            'name' => $product->label,
            'price' => preg_replace("/[^0-9.,]/", "", $product->price_ttc),
            'quantity' => $request->get("quantity", 1),
            'attributes' => array(),
            'associatedModel' => $product]);
        return back();
    }

    public function delete($product){
        \Cart::remove($product);
        return back();
    }
}
