<?php

namespace App\Http\Controllers;

use App\Mail\OrderReceived;
use App\Models\Address;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'town' => 'required',
            'fk_departement' => 'required',
            'zip' => 'required|digits:4',
            'phone' => 'required',
            'shipping_method' => 'required|in:1,2'
        ]);

        foreach (\Cart::getContent() as $item) {
            $product = Product::where('rowid', $item->id)->first();
            if ($product->tosell < $item->quantity)
                return back()->withErrors([
                    'product' => 'Stock insuffisant pour le produit "' . $product->label . '"'
                ]);

            if ($product->stock === 0)
                return back()->withErrors([
                    'product' => 'Le produit "' . $product->label . '" n\'est plus disponible!'
                ]);
        }

        $user = auth()->user();
        $client = new Client();
        if ($user->fk_soc) {
            $client = $user->client;
        } else {
            $client->email = $user->email;
            //$client->code_client = "CU2203-00352";
        }
        $client->fill($request->only([
            "name_alias",
            "address",
            "zip",
            "town",
            "fk_departement",
            "phone",
            "siret",
        ]));
        $client->nom = $request->firstname . " " . $request->lastname;
        $client->client = 1;
        $client->fournisseur = 0;
        $client->fk_pays = 10;
        $client->status = 1;
        $client->siret = $request->identity;
        $client->save();
        $user->fk_soc = $client->rowid;
        $user->save();

        $order = new Order();
        $order->fk_soc = $user->client->rowid;
        $order->date_commande = now()->format('Y-m-d');
        $order->fk_shipping_method = $request->shipping_method;//1 retrai mag 2: transporteur
        $order->fk_statut = 1;
        $order->model_pdf = 'einstein';
        $order->fk_multicurrency = 0;
        $order->multicurrency_code = 'TND';
        $order->multicurrency_tx = 1;
        $order->ref = 'WEB-' . $user->fk_soc . '-' . time();
        $order->note_private = "Commande du site web";
        $order->note_public = $request->get('note', '');
        $order->save();
        $order->total_ht = 0;
        $order->total_ttc = 0;
        $order->total_tva = 0;
        foreach (\Cart::getContent() as $item) {
            $order_line = new OrderLine();
            $order_line->fk_commande = $order->rowid;
            $order_line->fk_product = $item->id;
            $order_line->tva_tx = $item->associatedModel->tva_tx;
            $order_line->qty = $item->quantity;
            $order_line->remise_percent = 0;
            $order_line->remise = 0;
            $order_line->price = $item->associatedModel->price;
            $order_line->subprice = $item->associatedModel->price;
            $order_line->total_ht = $item->associatedModel->price * $item->quantity;
            $order_line->total_ttc = $item->getPriceSum();
            $order_line->total_tva = $order_line->total_ttc - $order_line->total_ht;
            $order_line->product_type = $item->associatedModel->fk_product_type;
            $order_line->buy_price_ht = $item->associatedModel->cost_price;
            $order_line->multicurrency_code = 'TND';
            $order_line->multicurrency_subprice = $order_line->subprice;
            $order_line->multicurrency_total_ht = $order_line->total_ht;
            $order_line->multicurrency_total_ttc = $order_line->total_ttc;
            $order_line->multicurrency_total_tva = $order_line->total_tva;
            $order_line->save();
            $order->total_ht += $order_line->total_ht;
            $order->total_ttc += $order_line->total_ttc;
            $order->total_tva += $order_line->total_tva;
        }
        $order->multicurrency_total_ht = $order->total_ht;
        $order->multicurrency_total_ttc = $order->total_ttc;
        $order->multicurrency_total_tva = $order->total_tva;
        $order->ref = '(PROV' . $order->rowid . ')';
        $order->save();
        \Cart::clear();

        Mail::to($request->user())
            ->bcc([config('mail.reply_to.address'), 'mbenney@gmail.com '])
            ->queue(new OrderReceived($order));

        //return new OrderReceived($order);
        return redirect()->route('cart')->with('success', 'Nous avons reçu votre commande');
    }
}
