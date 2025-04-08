<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'attribute_id',
        'name',
    ];

    public function attributes()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function cart_attr_vars()
    {
        return $this->hasMany(CartAttrVar::class);
    }
}
