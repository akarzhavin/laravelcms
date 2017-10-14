<?php

namespace App\Http\Models;

use App\Exceptions\SystemExceptions;
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

    public function setValueBoolAttribute($value)
    {
        $value = (bool) $value;
        if(!is_bool($value)){ $this->invalidTypeExeption(); }
        $this->attributes['value_bool'] = $value;
    }

    public function setValueStringAttribute($value)
    {
        $value = (string) $value;
        if(!is_string($value)){ $this->invalidTypeExeption(); }
        $this->attributes['value_string'] = $value;
    }

    public function setValueDoubleAttribute($value)
    {
        $value = (double) $value;
        if(!is_double($value)){ $this->invalidTypeExeption(); }
        $this->attributes['value_double'] = $value;
    }

    public function setOrderAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['order'] = $value;
        } else {
            $this->attributes['order'] = 0;
        }
    }

    public function setDescripitonAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['description'] = $value;
        }
    }

    public function products()
    {
        return $this->belongsToMany('App\Http\Models\Product', 'product_feature_pivot', 'product_id', 'value_id');
    }

    public function feature()
    {
        return $this->belongsTo('App\Http\Models\Feature', 'feature_id');
    }

    private function invalidTypeExeption()
    {
        throw new SystemExceptions('Invalid $value type');
    }

}
