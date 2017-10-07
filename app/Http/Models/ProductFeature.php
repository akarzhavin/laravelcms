<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\Pivot as Pivot;

/**
 * App\Http\Models\ProductFeature
 *
 * @property int $product_id
 * @property int $feature_id
 * @property int $value_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductFeature whereFeatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductFeature whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductFeature whereValueId($value)
 * @mixin \Eloquent
 */
class ProductFeature extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'product_feature_pivot';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'feature_id', 'value_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public $primaryKey = 'PRIMARY';
}
