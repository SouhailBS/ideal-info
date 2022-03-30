<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

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

    }
}
