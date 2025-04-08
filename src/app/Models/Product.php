<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'type',
        'subtype',
        'price',
        'stock',
        'brand',
    ];

    public function user_favourites()
    {
        return $this->hasMany(UserFavourite::class);
    }

    public function shopping_carts()
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public  function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
