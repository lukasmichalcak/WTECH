<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'city',
        'zip_code',
        'country',
        'transport_option',
        'payment_method',
        'time_of_order',
        'state_of_order',
    ];

    public function shopping_carts()
    {
        return $this->hasMany(ShoppingCart::class);
    }
}
