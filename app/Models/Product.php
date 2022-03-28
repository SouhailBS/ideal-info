<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use NumberFormatter;

/**
 * @property mixed $route
 * @property mixed $label
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'rowid';
    protected $appends = [
        "route",
        "photos"
    ];

    public function getRouteAttribute(): string
    {
        return route('single-product', ['product' => $this->rowid, 'slug' => Str::slug($this->label)]);
    }

    public function getPhotosAttribute(): array
    {
        return collect($this->scanFiles(env("DOLIBARR_PATH") . '/produit/' . $this->ref));
    }

    public function getPriceTtcAttribute($value)
    {
        $fmt = new NumberFormatter('fr_FR', NumberFormatter::CURRENCY);
        $fmt->setPattern('#,##0.00 DT');
        return $fmt->formatCurrency($value, 'TND');
    }


    private function scanFiles($dir)
    {
        $scanned_dir = scandir($dir);
        return array_filter($scanned_dir, "image_route");
    }
}

function image_route($dir_element)
{
    if (!is_dir($dir_element)) {
        return route("dolibarr", ["file" => 'produit/' . $this->ref . '/' . $dir_element]);
    }
}
