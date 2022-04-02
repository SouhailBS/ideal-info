<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $sortDisplay = "Trier par";
    private $sortDisplayValues = [
        "price_ttc.asc" => "Prix croissant",
        "price_ttc.desc" => "Prix décroissant",
        "label.asc" => "Nom A-Z",
        "label.desc" => "Nom Z-A",
    ];

    public function promo()
    {
        $orderby = '';

        $min = Product::where('tosell', '>', '0')
            ->where('price_min', '>', 0)->min('price_ttc');
        $max = Product::where('tosell', '>', '0')
            ->where('price_min', '>', 0)->max('price_ttc');

        if (request()->has("price")) {
            $vmin = explode("*", request()->get("price"))[0];
            $vmax = explode("*", request()->get("price"))[1];
        } else {
            $vmin = $min;
            $vmax = $max;
        }
        if (request()->has("orderby") && isset($this->sortDisplayValues[request()->get("orderby")])) {
            $order = explode('.', request()->get("orderby"));
            $orderby = request()->get("orderby");
            $products = Product::where('tosell', '>', '0')
                ->where('price_min', '>', 0)
                ->whereBetween('price_ttc', [$vmin, $vmax])
                ->orderBy($order[0], $order[1])
                ->paginate(12)
                ->withQueryString();
            $this->sortDisplay .= ": " . $this->sortDisplayValues[request()->get("orderby")];
        } else
            $products = Product::where('tosell', '>', '0')
                ->where('price_min', '>', 0)
                ->whereBetween('price_ttc', [$vmin, $vmax])
                ->paginate(12)
                ->withQueryString();
        return view("pages.products")->with([
            "title" => "Nos promotions",
            "products" => $products,
            "sortDisplay" => $this->sortDisplay,
            "orderby" => $orderby,
            "min" => $min,
            "max" => $max,
            "vmin" => $vmin,
            "vmax" => $vmax,
            "mainCategory" => Category::where('rowid', 2)->first()
        ]);
    }

    public function category(Category $category, $slug)
    {
        if ($slug != Str::slug($category->label))
            return redirect($category->route);

        $orderby = '';

        $min = $category->products()
            ->where('tosell', '>', '0')->min('price_ttc');
        $max = $category->products()
            ->where('tosell', '>', '0')->max('price_ttc');

        if (request()->has("price")) {
            $vmin = explode("*", request()->get("price"))[0];
            $vmax = explode("*", request()->get("price"))[1];
        } else {
            $vmin = $min;
            $vmax = $max;
        }
        if (request()->has("orderby") && isset($this->sortDisplayValues[request()->get("orderby")])) {
            $orderby = request()->get("orderby");
            $order = explode('.', request()->get("orderby"));
            $products = $category->products()
                ->where('tosell', '>', '0')
                ->whereBetween('price_ttc', [$vmin, $vmax])
                ->orderBy($order[0], $order[1])
                ->paginate(12)
                ->withQueryString();
            $this->sortDisplay .= ": " . $this->sortDisplayValues[request()->get("orderby")];
        } else
            $products = $category->products()
                ->where('tosell', '>', '0')
                ->whereBetween('price_ttc', [$vmin, $vmax])
                ->paginate(12)
                ->withQueryString();

        $category->loadMissing("subCategories");
        return view("pages.products")->with([
            "sortDisplay" => $this->sortDisplay,
            "orderby" => $orderby,
            "category" => $category,
            "min" => $min,
            "max" => $max,
            "vmin" => $vmin,
            "vmax" => $vmax,
            "products" => $products
        ]);
    }

    public function search(Request $request)
    {
        $orderby = '';
        $products = Product::where('tosell', '>', '0');
        $min = $products->where(function ($query) use ($request) {
            $query->where('label', 'like', '%' . $request->get("q") . "%")
                ->orWhere('description', 'like', '%' . $request->get("q") . "%");
        })->min('price_ttc');
        $max = $products->where(function ($query) use ($request) {
            $query->where('label', 'like', '%' . $request->get("q") . "%")
                ->orWhere('description', 'like', '%' . $request->get("q") . "%");
        })->max('price_ttc');

        if (request()->has("price")) {
            $vmin = explode("*", request()->get("price"))[0];
            $vmax = explode("*", request()->get("price"))[1];
        } else {
            $vmin = $min;
            $vmax = $max;
        }
        $products = $products->whereBetween('price_ttc', [$vmin, $vmax]);
        if (request()->has("orderby") && isset($this->sortDisplayValues[request()->get("orderby")])) {
            $orderby = request()->get("orderby");
            $order = explode('.', request()->get("orderby"));
            $products = $products
                ->where(function ($query) use ($request) {
                    $query->where('label', 'like', '%' . $request->get("q") . "%")
                        ->orWhere('description', 'like', '%' . $request->get("q") . "%");
                })
                ->orderBy($order[0], $order[1])
                ->paginate(12)
                ->withQueryString();
            $this->sortDisplay .= ": " . $this->sortDisplayValues[request()->get("orderby")];
        } else
            $products = $products
                ->where(function ($query) use ($request) {
                    $query->where('label', 'like', '%' . $request->get("q") . "%")
                        ->orWhere('description', 'like', '%' . $request->get("q") . "%");
                })
                ->paginate(12)
                ->withQueryString();

        $category = Category::where('rowid', 2)->first();
        $category->loadMissing("subCategories");
        return view("pages.products")->with([
            "title" => "Résultats de recherche " . $request->get("q"),
            "products" => $products,
            "sortDisplay" => $this->sortDisplay,
            "orderby" => $orderby,
            "min" => $min,
            "max" => $max,
            "vmin" => $vmin,
            "vmax" => $vmax,
            "search" => $request->q,
            "mainCategory" => $category
        ]);
    }

    public function product(Product $product, $slug)
    {
        abort_unless($product->tosell, 404);
        if ($slug != Str::slug($product->label))
            return redirect($product->route);

        return view("pages.product")->with(["product" => $product]);
    }
}
