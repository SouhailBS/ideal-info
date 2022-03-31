<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use NumberFormatter;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        \Cart::add(['id' => $product->rowid,
            'name' => $product->label,
            'price' => $product->price_min > 0 ? $product->getRawOriginal('price_min_ttc') : $product->getRawOriginal('price_ttc'),
            'quantity' => $request->get("quantity", 1),
            'attributes' => array(),
            'associatedModel' => $product]);
        return back();
    }

    public function update(Request $request)
    {

        foreach ($request->except('_token') as $key => $item) {
            $product = Product::where('rowid', $key)->first();
            \Cart::update($product->rowid, [
                'name' => $product->label,
                'price' => $product->price_min > 0 ? $product->getRawOriginal('price_min_ttc') : $product->getRawOriginal('price_ttc'),
                'quantity' => [
                    'relative' => false,
                    'value' => $item
                ],
                'attributes' => array(),
                'associatedModel' => $product
            ]);
        }
        return back();
    }

    public function delete($product)
    {
        \Cart::remove($product);
        return back();
    }
}
