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

    public function isShared()
    {
        return $this->shared;
    }

    public static function getGraduates($data, $shared = true)
    {
        return Graduate::when($data, function ($query, $data) {
            foreach ($data as $key => $input) {
                $query->when($input, function ($query, $value) use ($key) {
                    return $query->where($key, 'like', '%'.$value.'%');
                });
            }
        })
        ->when($shared, function ($query) {
            return $query->shared();
        })
        ->orderBy('surname', 'asc')
        ->paginate(15);
    }
}
