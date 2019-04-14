<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Scan extends Model
{
    protected $fillable = ['image_url'];


    public function graduate()
    {
        return $this->belongsTo('App\Graduate');
    }

    public static function getName($image)
    {
        return time().rand(1, 500).Str::random(5).'.'.$image->extension();
    }
}
