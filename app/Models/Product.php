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
        "photos",
        "discount"
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tosell' => 'boolean',
    ];

    protected $baseDir = "";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->baseDir = env("DOLIBARR_PATH") . '/produit/';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categorie_product', 'fk_product', 'fk_categorie');
    }

    public function getRouteAttribute(): string
    {
        return route('single-product', ['product' => $this->rowid, 'slug' => Str::slug($this->label)]);
    }

    public function getPriceTtcAttribute($value)
    {
        $fmt = new NumberFormatter('fr_TN', NumberFormatter::CURRENCY);
        //$fmt->setPattern('#,##0.00 DT');
        return $fmt->formatCurrency($value, 'TND');
    }

    public function getPriceDiscountAttribute()
    {
        $fmt = new NumberFormatter('fr_TN', NumberFormatter::CURRENCY);
        //$fmt->setPattern('#,##0.00 DT');
        return $fmt->formatCurrency($this->getRawOriginal('price_min_ttc') - $this->getRawOriginal('price_ttc'), 'TND');
    }

    public function getPriceMinTtcAttribute($value)
    {
        $fmt = new NumberFormatter('fr_TN', NumberFormatter::CURRENCY);
        //$fmt->setPattern('#,##0.00 DT');
        return $fmt->formatCurrency($value, 'TND');
    }

    public function getPhotosAttribute(): \Illuminate\Support\Collection
    {
        $dir = $this->baseDir . $this->ref;
        if (is_dir($dir))
            return collect($this->scanFiles($dir))->values();
        return collect([]);
    }

    private function image_route($dir_element)
    {
        if (!is_dir($this->baseDir . $this->ref . '/' . $dir_element)) {
            return $dir_element;
        }
    }

    private function scanFiles($dir)
    {
        $scanned_dir = scandir($dir);
        return array_filter($scanned_dir, $this->image_route(...));
    }
}
