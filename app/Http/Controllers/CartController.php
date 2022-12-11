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
        if ($request->expectsJson())
            return response([
                'product' => $product,
                'quantity' => $request->get("quantity", 1)
            ]);
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
        if ($request->expectsJson()) {
            if (count($error) > 0)
                return response($error, 400);
            return response(['success', 'Votre panier est à jour']);
        }
        if (count($error) > 0)
            return back()->withErrors($error);
        return back()->with('success', 'Votre panier est à jour');
    }

    public function delete(Request $request, $product)
    {
        \Cart::remove($product);
        if ($request->expectsJson()) {
            $fmt = new NumberFormatter('fr_TN', NumberFormatter::CURRENCY);
            $fmt->setPattern('#,##0.000 DT');

            return response([
                'success' => 'Votre panier est à jour',
                'cart' => [
                    'items' => \Cart::getContent()->toArray(),
                    'total' => $fmt->formatCurrency(\Cart::getTotal(), 'TND'),
                ]
            ]);
        }
        return back();
    }
}
