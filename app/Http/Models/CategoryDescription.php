<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\CategoryDescription
 *
 * @property int $category_id
 * @property string $title
 * @property string $description
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $page_title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\CategoryDescription whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\CategoryDescription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\CategoryDescription whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\CategoryDescription whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\CategoryDescription wherePageTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\CategoryDescription whereTitle($value)
 * @mixin \Eloquent
 */
class CategoryDescription extends Model
{
    /**
     * primaryKey
     *
     * @var integer
     * @access protected
     */
    protected $primaryKey = 'category_id';

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
    protected $table = 'category_description';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'meta_keywords',
        'meta_description',
        'page_title'
    ];

    protected $guarded = ['category_id'];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['title'];

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