<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\FeatureValueCheckMulti
 *
 * @property int $id
 * @property int $feature_id
 * @property int|null $value_bool
 * @property string|null $value_string
 * @property float|null $value_double
 * @property string|null $description
 * @property int $order
 * @property-read \App\Http\Models\Feature $feature
 * @property-read mixed $value
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureValue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureValue whereFeatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureValue whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureValue whereValueBool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureValue whereValueDouble($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureValue whereValueString($value)
 * @mixin \Eloquent
 */
class FeatureValue extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feature_values';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['feature_id', 'description', 'order'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['value_bool', 'value_string', 'value_double'];

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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    public function getValueAttribute()
    {
        if(!is_null($this->value_bool)){
            return $this->value_bool;
        }

        if(!is_null($this->value_string)){
            return $this->value_string;
        }

        if(!is_null($this->value_double)){
            return $this->value_double;
        }
    }

    public function products()
    {
        return $this->belongsToMany('App\Http\Models\Product', 'product_feature_pivot', 'product_id', 'value_id');
    }

    public function feature()
    {
        return $this->belongsTo('App\Http\Models\Feature');
    }
}
