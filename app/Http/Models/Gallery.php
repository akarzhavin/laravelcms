<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $table = 'galleries';

    protected $fillable = [
        'title',
        'description',
        'status',
        'hard',
    ];

    public function setHard(bool $value)
    {
        $this->attributes['hard'] = $value;
        return $this;
    }

    public function getHard()
    {
        return $this->attributes['hard'];
    }

    public function images()
    {
        return $this->morphToMany('App\Http\Models\Images', 'model', 'images_morph', 'model_id', 'image_id')->withPivot('main', 'order');
    }
}