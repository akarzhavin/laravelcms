<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;

/**
 * App\Http\Models\Category
 *
 * @property int $id
 * @property int $parent_id
 * @property string $status
 * @property string $id_path
 * @property int $level
 * @property string $user_role_ids
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $product_count
 * @property int $order
 * @property-read \App\Http\Models\CategoryDescription $description
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Models\Category onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category whereIdPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category whereProductCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category whereUserRoleIds($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Models\Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Models\Category withoutTrashed()
 * @mixin \Eloquent
 * @property-read mixed $is_trashed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Category withoutMainCategory()
 */
class Category extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'user_role_ids',
        'product_count',
        'order'
    ];

    protected $guarded = [
        'parent_id',
        'id_path',
        'level',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $with = ['description'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['is_trashed'];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id', 'description', 'is_trashed'];

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

    public function getIsTrashedAttribute()
    {
        return $this->trashed();
    }

    public function scopeWithoutMainCategory($query)
    {
        return $query->where('id', '!=', 1);
    }

    /**
     * Each category has many products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->morphedByMany('App\Http\Models\Product', 'model', 'category_morph')->withPivot('link_type', 'order');
    }

    /**
     * Each category has many products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function features()
    {
        return $this->morphedByMany('App\Http\Models\Feature', 'model', 'category_morph')->withPivot('link_type', 'order');
    }

    /**
     * Each category has many products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function filters()
    {
        return $this->morphedByMany('App\Http\Models\Filter', 'model', 'category_morph');
    }

    public function description()
    {
        return $this->hasOne('App\Http\Models\CategoryDescription');
    }

    public static function tree(Collection $categories = null)
    {
        if(!$categories) {
            $categories = Category::with('description')->get();
        }

        //Group categories by level
        $groups = $categories
            ->keyBy('id')
            ->groupBy('level', true)
            ->makeVisible(['parent_id', 'id_path', 'level'])
            ->toArray();
        krsort($groups);
        $groups = array_values($groups);

        // Move subcategories to their parents' elements
        // and url parameter
        foreach($groups as $level => $categories){
            foreach($categories as $key => $category){
                if(
                    isset($groups[$level + 1][$category['parent_id']])
                ){
                    $child = $groups[$level][$key];
                    $child['url'] = $category['id_path'];
                    $groups[$level + 1][$category['parent_id']]['subcategories'][$category['id']] = $child;

                    unset($groups[$level][$key]);
                }
            }
        }

        return array_pop($groups);
    }
}