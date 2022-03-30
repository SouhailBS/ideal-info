<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use NumberFormatter;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $fmt = new NumberFormatter('fr_TN', NumberFormatter::CURRENCY);

        \Cart::add(['id' => $product->rowid,
            'name' => $product->label,
            'price' => $fmt->parseCurrency($product->price_ttc, $curr),
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
