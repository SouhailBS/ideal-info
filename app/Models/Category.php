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
}
