<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Filter
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property int|null $feature_id
 * @property string $status
 * @property int $order
 * @property string $display
 * @property int $display_count
 * @property array $other
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\Category[] $categories
 * @property-read \App\Http\Models\Feature|null $feature
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Filter whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Filter whereDisplayCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Filter whereFeatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Filter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Filter whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Filter whereOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Filter whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Filter whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Filter whereType($value)
 * @mixin \Eloquent
 */
class Filter extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'filters';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'status',
        'feature_id',
        'order',
        'display',
        'display_count',
        'other',
    ];

    protected $guarded = ['id'];

    public $timestamps = false;

    public $with = ['feature'];

    protected $casts = [
        'other' => 'array',
    ];

    /**
     * Product belong a categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->morphToMany('App\Http\Models\Category', 'model', 'category_morph');
    }

    public function feature()
    {
        return $this->belongsTo('App\Http\Models\Feature');
    }
}