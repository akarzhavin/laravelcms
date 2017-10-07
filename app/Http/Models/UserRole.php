<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Roles
 *
 * @property int $id
 * @property string $status
 * @property string $type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Roles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Roles whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Roles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Roles whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Roles whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Roles whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Roles extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'status',
//        'type',
//    ];

    protected $guarded = ['*'];

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
}
