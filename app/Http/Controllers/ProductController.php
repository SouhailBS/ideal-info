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
        $queryBuilder = $category->products()
            ->where('tosell', '>', '0');

        $queryBuilderAll = clone $queryBuilder;
        $filters = Category::where('visible', '0')->where('fk_parent', env('DOLIBARR_FILTERS_ID', 183))->get();
        $filters->loadMissing('subCategories');
        $filters2 = clone $filters;
        $filters2->each(function ($item, $key) {
            $item->subCategoriesIds = $item->subCategories->pluck('rowid');
        });
        $filters2 = $filters2->pluck('subCategoriesIds')->collapse()->unique();
        $categoriesList = $queryBuilderAll->get();
        $stock = $categoriesList->where('stock', '>', '0')->count();
        $commande = $categoriesList->count() - $stock;
        $categoriesList->loadMissing('categories');
        $categoriesList->each(function ($item, $key) {
            $item->categories = $item->categories->pluck('rowid');
        });
        $categoriesList = $categoriesList->pluck('categories')->collapse()->unique();
        $filterIds = $filters2->intersect($categoriesList);
        $filtersList = collect([]);
        $filters->each(function ($item, $key) use ($filterIds, $filtersList) {
            if ($item->subCategoriesIds->intersect($filterIds)->count()) {
                $filtersList->push($item);
            }
        });

        $filterBy = [];
        foreach ($filtersList as $item) {
            if (request()->has("filter_" . $item->rowid)) {
                $input = request()->get("filter_" . $item->rowid);
                $filterBy[$item->rowid] = array_values(is_array($input) ? $input : [$input]);
            }
        }

        $min = $queryBuilder->min('price_ttc');
        $max = $queryBuilder->max('price_ttc');
        if (count($filterBy) > 0) {
            foreach ($filterBy as $value) {
                $queryBuilder->whereHas('categories', function ($q) use ($value) {
                    $q->whereIn('categorie_product.fk_categorie', $value);
                });
            }
        }

        if (request()->has("price")) {
            $vmin = explode("*", request()->get("price"))[0];
            $vmax = explode("*", request()->get("price"))[1];
        } else {
            $vmin = $min;
            $vmax = $max;
        }
        $queryBuilder->whereBetween('price_ttc', [$vmin, $vmax]);

        if (request()->has("stock")) {
            if (request()->get("stock") == 0) {
                $queryBuilder->where(function ($query) {
                    $query->where('stock', '=', '0')
                        ->orWhereNull('stock');
                }
                );
            } else
                $queryBuilder->where('stock', '>', '0');
        }

        if (request()->has("orderby") && isset($this->sortDisplayValues[request()->get("orderby")])) {
            $orderby = request()->get("orderby");
            $order = explode('.', request()->get("orderby"));
            $queryBuilder->orderBy($order[0], $order[1]);
            $this->sortDisplay .= ": " . $this->sortDisplayValues[request()->get("orderby")];
        }

        $products = $queryBuilder
            ->paginate(12)
            ->withQueryString();

        $category->loadMissing("subCategories");
        $isAjax = strtolower(request()->getContentType()) == 'json';
        return view($isAjax ? "partials.catalog.products" : "pages.products")->with([
            "sortDisplay" => $this->sortDisplay,
            "orderby" => $orderby,
            "category" => $category,
            "min" => $min,
            "max" => $max,
            "vmin" => $vmin,
            "vmax" => $vmax,
            "products" => $products,
            "commande" => $commande,
            "stock" => $stock,
            "filter" => $filtersList
        ]);
    }

    public function search(Request $request)
    {

        $orderby = '';
        $queryBuilder = Product::where('tosell', '>', '0')->where('fk_product_type', 0);
        if ($request->has('output') && $request->output === 'json') {
            $queryBuilder = $queryBuilder->where(function ($query) use ($request) {
                $query->where('label', 'like', '%' . $request->get("q") . "%")
                    ->orWhere('description', 'like', '%' . $request->get("q") . "%");
            })->take(5)->get();

            return response()->json($queryBuilder);
        }

        $queryBuilderAll = clone $queryBuilder;
        $filters = Category::where('visible', '0')->where('fk_parent', env('DOLIBARR_FILTERS_ID', 183))->get();
        $filters->loadMissing('subCategories');
        $filters2 = clone $filters;
        $filters2->each(function ($item, $key) {
            $item->subCategoriesIds = $item->subCategories->pluck('rowid');
        });
        $filters2 = $filters2->pluck('subCategoriesIds')->collapse()->unique();
        $categoriesList = $queryBuilderAll->get();
        $stock = $categoriesList->where('stock', '>', '0')->count();
        $commande = $categoriesList->count() - $stock;
        $categoriesList->loadMissing('categories');
        $categoriesList->each(function ($item, $key) {
            $item->categories = $item->categories->pluck('rowid');
        });
        $categoriesList = $categoriesList->pluck('categories')->collapse()->unique();
        $filterIds = $filters2->intersect($categoriesList);
        $filtersList = collect([]);
        $filters->each(function ($item, $key) use ($filterIds, $filtersList) {
            if ($item->subCategoriesIds->intersect($filterIds)->count()) {
                $filtersList->push($item);
            }
        });

        $filterBy = [];
        foreach ($filtersList as $item) {
            if (request()->has("filter_" . $item->rowid)) {
                $input = request()->get("filter_" . $item->rowid);
                $filterBy[$item->rowid] = array_values(is_array($input) ? $input : [$input]);
            }
        }

        $min = $queryBuilder->where(function ($query) use ($request) {
            $query->where('label', 'like', '%' . $request->get("q") . "%")
                ->orWhere('description', 'like', '%' . $request->get("q") . "%");
        })->min('price_ttc');
        $max = $queryBuilder->where(function ($query) use ($request) {
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
        $queryBuilder->whereBetween('price_ttc', [$vmin, $vmax]);
        if (request()->has("stock")) {
            $queryBuilder->where('stock', request()->get("stock") == 0 ? '=' : '>', '0');
        }

        if (count($filterBy) > 0) {
            foreach ($filterBy as $value) {
                $queryBuilder->whereHas('categories', function ($q) use ($value) {
                    $q->whereIn('categorie_product.fk_categorie', $value);
                });
            }
        }

        if (request()->has("orderby") && isset($this->sortDisplayValues[request()->get("orderby")])) {
            $orderby = request()->get("orderby");
            $order = explode('.', request()->get("orderby"));
            $queryBuilder
                ->where(function ($query) use ($request) {
                    $query->where('label', 'like', '%' . $request->get("q") . "%")
                        ->orWhere('description', 'like', '%' . $request->get("q") . "%");
                })
                ->orderBy($order[0], $order[1]);
            $this->sortDisplay .= ": " . $this->sortDisplayValues[request()->get("orderby")];
        } else
            $queryBuilder
                ->where(function ($query) use ($request) {
                    $query->where('label', 'like', '%' . $request->get("q") . "%")
                        ->orWhere('description', 'like', '%' . $request->get("q") . "%");
                });

        $queryBuilder = $queryBuilder->paginate(12)->withQueryString();
        $category = Category::where('rowid', 2)->first();
        $category->loadMissing("subCategories");
        $isAjax = strtolower(request()->getContentType()) == 'json';
        return view($isAjax ? "partials.catalog.products" : "pages.products")->with([
            "title" => "Résultats de recherche " . $request->get("q"),
            "products" => $queryBuilder,
            "sortDisplay" => $this->sortDisplay,
            "orderby" => $orderby,
            "min" => $min,
            "max" => $max,
            "vmin" => $vmin,
            "vmax" => $vmax,
            "search" => $request->q,
            "mainCategory" => $category,
            "commande" => $commande,
            "stock" => $stock,
            "filter" => $filtersList
        ]);
    }

    public function product(Product $product, $slug)
    {
        abort_unless($product->tosell && $product->fk_product_type === 0, 404);
        if ($slug != Str::slug($product->label))
            return redirect($product->route);

        return view("pages.product")->with(["product" => $product]);
    }

    public function services()
    {
        $services = Product::where('tosell', 0)->where('fk_product_type', 1)->get();
        return view('pages.our-services')->with("services", $services);
    }
}
