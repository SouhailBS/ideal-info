<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'commande';

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
    const CREATED_AT = 'date_creation';
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'date_valid';
}
