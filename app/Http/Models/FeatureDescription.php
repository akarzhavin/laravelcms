<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\FeatureDescription
 *
 * @property int $feature_id
 * @property string $title
 * @property string $description
 * @property string $prefix
 * @property string $suffix
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureDescription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureDescription whereFeatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureDescription wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureDescription whereSuffix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\FeatureDescription whereTitle($value)
 * @mixin \Eloquent
 */
class FeatureDescription extends Model
{
    /**
     * primaryKey
     *
     * @var integer
     * @access protected
     */
    protected $primaryKey = 'feature_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feature_description';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'prefix',
        'suffix'
    ];

    protected $guarded = ['feature_id'];

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