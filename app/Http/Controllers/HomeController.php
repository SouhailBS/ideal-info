<?php

namespace App\Http\Controllers;

use App\Mail\MessageSent;
use App\Mail\OrderReceived;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('tosell', '>', '0')->where('fk_product_type',0)->inRandomOrder()->take(20)->get();
        $categories = Category::where('visible', '0')->where('fk_parent', '2')->take(6)->get();
        $bestSeller = Category::where("rowid", 5)->first()->products()->where('tosell', '>', '0')->take(12)->get();
        $newProducts = Product::where('tosell', '>', '0')->where('fk_product_type',0)->where('datec', '>', now()->subDays(30)->endOfDay())->inRandomOrder()->take(20)->get();
        $promo = Product::where('tosell', '>', '0')->where('price_min', '>', 0)->where('stock', '>', 0)->inRandomOrder()->take(20)->get();
        $reconditionnes = Product::where('tosell', '0')->where('stock', '>', 0)->whereHas('categories', function ($q) {
            $q->where('categorie_product.fk_categorie', env('DOLIBARR_RECONDITIONNES_ID', 265));
        })->get();
        return view("home")->with([
            "products" => $products,
            "bestSeller" => $bestSeller,
            "newProducts" => $newProducts,
            "promo" => $promo,
            "reconditionnes" => $reconditionnes,
            "categories" => $categories
        ]);
    }

    public function contact(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email|not_in:eric.jones.z.mail@gmail.com',
            'message' => 'required',
            'g-recaptcha-response' => 'required'
        ]);

        $secret = '6Le9yXAgAAAAAE6yJ545FB53qSISTzX7BJGzbLvl';

        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret) . '&response=' . urlencode($request->get('g-recaptcha-response')) . '&remoteip=' . urlencode($ip);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);
        // should return JSON with success as true
        if (!$responseKeys["success"]) {
            // spammar
            return back()->withErrors([
                'recaptcha'=>'Échec de la vérification anti-robot'
            ]);
        }

        Mail::to(config('mail.reply_to.address'))
            ->queue(new MessageSent((object)$request->all()));

        return back()->with('success', 'Nous avons reçu votre message.');
    }

    public function about()
    {
        $employees = Employee::where("statut", 1)->where('note', 'SITEWEB')->get();
        return view("pages.about-us")->with([
            "employees" => $employees
        ]);
    }

}
