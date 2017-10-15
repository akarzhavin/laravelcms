<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Product
 * Product model.
 *
 * @property int $id
 * @property string $status
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\Category[] $categories
 * @property-read \App\Http\Models\ProductDescription $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\ProductFeature[] $featurePivot
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\FeatureValue[] $featureValues
 * @property-read mixed $features
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\Images[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\ProductRolePrices[] $prices
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\ProductRolePrices[] $roles
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Models\Product onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Models\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Models\Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
    ];

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
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $with = ['description', 'prices', 'categories'];
    
    /**
     * Each category has many products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function description()
    {
        return $this->hasOne('App\Http\Models\ProductDescription');
    }

    /**
     * Product belong a categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->morphToMany('App\Http\Models\Category', 'model', 'category_morph')->withPivot('link_type', 'order');
    }

    public function images()
    {
        return $this->morphToMany('App\Http\Models\Images', 'model', 'images_morph', 'model_id', 'image_id')->withPivot('main', 'order');
    }

    public function prices()
    {
        return $this->hasMany('App\Http\Models\ProductRolePrices');
    }

    public function roles()
    {
        return $this->hasMany('App\Http\Models\ProductRolePrices');
    }


    /*
     * Feature methods
     */

    //Get all attach features
    public function getFeaturesAttribute()
    {
        $ids = $this->categories->pluck('id')->toArray();
        return Feature::whereHas('categories', function($query) use ($ids) {
            $query->whereIn('id',  $ids);
        })->get();
    }

    //Get attach values of features
    public function featurePivot()
    {
        return $this->hasMany('App\Http\Models\ProductFeature');
    }

    //Get attach values of features
    public function featureValues()
    {
        return $this->belongsToMany('App\Http\Models\FeatureValue', 'product_feature_pivot', 'product_id', 'value_id')
            ->withPivot('feature_id');
    }
}