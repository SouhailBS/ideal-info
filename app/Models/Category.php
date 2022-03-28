<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
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

    public function getImageAttribute(): string
    {
        $dir = env("DOLIBARR_PATH") . '/categorie/' . $this->rowid . '/0/' . $this->rowid;
        if (is_dir($dir))
            return route("dolibarr", ["file" => $dir . '/' . $this->scanFiles($dir)[0]]);
        return "assets/img/s-product/category1.jpg";
    }

    private function image_route($dir_element)
    {
        if (!is_dir($dir_element)) {
            return $dir_element;
        }
    }

    private function scanFiles($dir)
    {
        $scanned_dir = scandir($dir);
        return array_filter($scanned_dir, $this->image_route(...));
    }
}
