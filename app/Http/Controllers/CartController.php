<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use NumberFormatter;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        if ($product->stock === 0)
            return back()->withErrors(['stock' => 'Produit épuisé.']);
        \Cart::add(['id' => $product->rowid,
            'name' => $product->label,
            'price' => $product->getRawOriginal('price_ttc'),
            'quantity' => $request->get("quantity", 1),
            'attributes' => array(),
            'associatedModel' => $product]);
        return back();
    }

    public function update(Request $request)
    {
        $error = [];
        foreach ($request->except('_token') as $key => $item) {
            $product = Product::where('rowid', $key)->first();
            if ($product->stock < $item)
                $error[] = 'Stock insuffisant pour le produit "' . $product->label . '"';
            else
                \Cart::update($product->rowid, [
                    'name' => $product->label,
                    'price' => $product->getRawOriginal('price_ttc'),
                    'quantity' => [
                        'relative' => false,
                        'value' => $item
                    ],
                    'attributes' => array(),
                    'associatedModel' => $product
                ]);
        }
        if (count($error) > 0)
            return back()->withErrors($error);
        return back()->with('success', 'Votre panier est à jour');
    }

    public function delete($product)
    {
        \Cart::remove($product);
        return back();
    }
}
