<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

/**
 * App\Http\Models\User
 *
 * @property int $id
 * @property string|null $name
 * @property string $email
 * @property string $password
 * @property int|null $status
 * @property int $role_id
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Http\Models\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\Subscription[] $subscriptions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'role_id',
    ];

    protected $guarded = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Http\Models\Role', 'role_id');
    }
}
