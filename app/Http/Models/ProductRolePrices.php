<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\ProductRolePrices
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $role_id
 * @property float $recommend_price
 * @property float $price
 * @property string $discount
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductRolePrices whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductRolePrices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductRolePrices wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductRolePrices whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductRolePrices whereRecommendPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductRolePrices whereRoleId($value)
 * @mixin \Eloquent
 */
class ProductRolePrices extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_roles_prices';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recommend_price',
        'price',
        'discount'
    ];

    protected $guarded = [
        'product_id',
        'role_id'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
}
