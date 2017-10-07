<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * App\Http\Models\ProductDescription
 *
 * @property int $product_id
 * @property string $title
 * @property string $short_title
 * @property string $short_description
 * @property string $full_description
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $search_words
 * @property string $page_title
 * @property string $promo_text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductDescription whereFullDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductDescription whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductDescription whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductDescription wherePageTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductDescription whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductDescription wherePromoText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductDescription whereSearchWords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductDescription whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductDescription whereShortTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ProductDescription whereTitle($value)
 * @mixin \Eloquent
 */
class ProductDescription extends Model
{
    use Searchable;
    public $asYouType = true;
    /**
     * primaryKey
     *
     * @var integer
     * @access protected
     */
    protected $primaryKey = 'product_id';

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
    protected $table = 'product_descriptions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'short_title',
        'short_description',
        'full_description',
        'meta_keywords',
        'meta_description',
        'search_words',
        'page_title',
        'promo_text'
    ];

    protected $guarded = ['product_id'];

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
