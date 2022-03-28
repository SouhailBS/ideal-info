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
    ];

    public function getRouteAttribute(): string
    {
        return route('single-product', ['product' => $this->rowid, 'slug' => Str::slug($this->label)]);
    }

    public function getPriceTtcAttribute($value)
    {
        $fmt = new NumberFormatter('fr_FR', NumberFormatter::CURRENCY);
        $fmt->setPattern('#,##0.00 DT');
        return $fmt->formatCurrency($value, 'TND');
    }
}
