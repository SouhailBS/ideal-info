<?php

namespace App\Http\Controllers;

use App\Mail\OrderReceived;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([

        ]);

        $user = auth()->user();
        if (!$user->fk_soc) {
            $client = new Client($request->except(['firstname', 'lastname', 'note', 'identity']));
            //$client->code_client = "CU2203-00352";
            $client->nom = $request->firstname . " " . $request->lastname;
            $client->client = 1;
            $client->fournisseur = 0;
            $client->fk_pays = 10;
            $client->status = 1;
            $client->siret = $request->identity;
            $client->save();
            $user->fk_soc = $client->rowid;
            $user->save();
        }
        $order = new Order();
        $order->fk_soc = $user->client->rowid;
        $order->date_commande = now()->format('Y-m-d');
        $order->fk_statut = 1;
        $order->model_pdf = 'einstein';
        $order->fk_multicurrency = 0;
        $order->multicurrency_code = 'TND';
        $order->multicurrency_tx = 1;
        $order->ref = 'WEB-' . $user->fk_soc . '-' . time();
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
            ->bcc(config('mail.reply_to.address'))
            ->queue(new OrderReceived($order));

        //return new OrderReceived($order);
        return redirect()->route('cart')->with('success', 'Votre commande est recu');
    }
}
