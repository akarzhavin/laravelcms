<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * App\Http\Models\Feature
 *
 * @property int $id
 * @property int $parent_id
 * @property string $type
 * @property bool $display_on_product
 * @property bool $display_on_catalog
 * @property bool $display_on_header
 * @property string $status
 * @property int $order
 * @property bool $comparison
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\Category[] $categories
 * @property-read \App\Http\Models\FeatureDescription $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\FeatureValue[] $values
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Models\Feature onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereComparison($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereDisplayOnCatalog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereDisplayOnHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereDisplayOnProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Feature whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Models\Feature withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Models\Feature withoutTrashed()
 * @mixin \Eloquent
 */
class Feature extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'features';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_on_product',
        'display_on_catalog',
        'display_on_header',
        'type',
        'status',
        'order',
        'comparison',
    ];

    protected $guarded = [
        'parent_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $with = ['description'];

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
    protected $casts = [
        'display_on_product' => 'boolean',
        'display_on_catalog' => 'boolean',
        'display_on_header' => 'boolean',
        'comparison' => 'boolean'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function description()
    {
        return $this->hasOne(
            'App\Http\Models\FeatureDescription',
            'feature_id'
        );
    }

    public function values()
    {
        return $this->hasMany('App\Http\Models\FeatureValue', 'feature_id');
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

}