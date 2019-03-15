<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    /*Relationships*/

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    /*Scopes*/

    public function scopeShared($query)
    {
        return $query->where('shared', 1);
    }

    /*Functions*/

    public static function getGraduates()
    {
        return Graduate::shared()->orderBy('surname', 'asc')->paginate(15);
    }
}
