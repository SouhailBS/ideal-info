<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'societe';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'rowid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name_alias",
        "address",
        "zip",
        "town",
        "fk_departement",
        "phone",
        "email",
        "siret",
    ];
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'datec';
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'datec';

    public function siret(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::startsWith(strtolower($value), 'cin') ? Str::replaceFirst('cin', '', strtolower($value)) : $value,
            set: fn($value) => is_numeric($value) ? 'CIN: ' . $value : $value,
        );
    }
}
