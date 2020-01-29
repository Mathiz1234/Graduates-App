<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scan extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['image_url', 'shared'];


    public function graduate()
    {
        return $this->belongsTo('App\Graduate');
    }

    public static function getName($image)
    {
        return time().rand(1, 500).Str::random(5).'.'.$image->extension();
    }
}
