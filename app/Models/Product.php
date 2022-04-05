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
        "discount",
        "old_price",
        "thumb_small"
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
        $fmt = new NumberFormatter('fr-TN', NumberFormatter::CURRENCY);
        $fmt->setPattern('#,##0.000 DT');
        return $fmt->formatCurrency($value, 'TND');
    }

    public function getDiscountAttribute()
    {
        $fmt = new NumberFormatter('fr_TN', NumberFormatter::CURRENCY);
        $fmt->setPattern('#,##0.000 DT');
        return $fmt->formatCurrency($this->getRawOriginal('price_min_ttc') - $this->getRawOriginal('price_ttc'), 'TND');
    }

    public function getOldPriceAttribute()
    {
        $fmt = new NumberFormatter('fr_TN', NumberFormatter::CURRENCY);
        $fmt->setPattern('#,##0.000 DT');
        return $fmt->formatCurrency($this->getRawOriginal('price_min_ttc') + $this->getRawOriginal('price_ttc'), 'TND');
    }

    public function getPriceMinTtcAttribute($value)
    {
        $fmt = new NumberFormatter('fr_TN', NumberFormatter::CURRENCY);
        $fmt->setPattern('#,##0.000 DT');
        return $fmt->formatCurrency($value, 'TND');
    }

    public function getPhotosAttribute(): \Illuminate\Support\Collection
    {
        $dir = $this->baseDir . $this->ref;
        if (is_dir($dir))
            return collect($this->scanFiles($dir))->values();
        return collect([]);
    }

    public function getThumbSmallAttribute()
    {
        if ($this->getPhotosAttribute()->count() > 0)
            return $this->miniPhoto($this->getPhotosAttribute()->get(0));
        return '';
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

    public function photo(string $image)
    {
        return route("dolibarr", ["file" => 'produit/' . $this->ref . '/' . $image]);
    }

    public function thumbPhoto(string $image)
    {
        $arr = explode('.', $image);
        return route("dolibarr", ["file" => 'produit/' . $this->ref . '/thumbs/' . Str::replaceLast('.' . end($arr), '_small.' . end($arr), $image)]);
    }

    public function miniPhoto(string $image)
    {
        $arr = explode('.', $image);
        return route("dolibarr", ["file" => 'produit/' . $this->ref . '/thumbs/' . Str::replaceLast('.' . end($arr), '_mini.' . end($arr), $image)]);
    }

}
