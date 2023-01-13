<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Sitemap\Contracts\Sitemapable;

class Category extends Model implements Sitemapable
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorie';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'rowid';
    protected $appends = [
        "route",
        "image"
    ];

    protected $baseDir = "";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->baseDir = env("DOLIBARR_PATH") . '/categorie/';
    }

    public function getRouteAttribute(): string
    {
        return route('category-product-listing', ['category' => $this->rowid, 'slug' => Str::slug($this->label)]);
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'fk_parent', 'rowid');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'fk_parent');
    }

    public function productsByFilter($id) {
        return $this->products()->whereHas('categories', function($q) use ($id){
            $q->where('categorie_product.fk_categorie', $id);
        });
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'categorie_product', 'fk_categorie', 'fk_product');
    }

    public function getImageAttribute(): string
    {
        $dir = $this->baseDir . ($this->rowid % 10) . '/' . strval($this->rowid % 100)[0] . '/' . $this->rowid . '/photos';
        if (is_dir($dir)) {
            $images = array_values($this->scanFiles($dir));
            if (count($images) > 0)
                return route("dolibarr", ["file" => 'categorie/' . ($this->rowid % 10) . '/' . strval($this->rowid % 100)[0] . '/' . $this->rowid . '/photos/' . $images[0]]);
        }
        return $dir;//"assets/img/s-product/category1.jpg";
    }

    private function image_route($dir_element)
    {
        if (!is_dir($this->baseDir . $this->rowid . '/0/' . $this->rowid . '/photos/' . $dir_element)) {
            return $dir_element;
        }
    }

    private function scanFiles($dir)
    {
        $scanned_dir = scandir($dir);
        return array_filter($scanned_dir, $this->image_route(...));
    }

    public function toSitemapTag(): string|array
    {
        return route('category-product-listing', ['category' => $this, 'slug' => Str::slug($this->label)]);
    }
}
