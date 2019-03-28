<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Graduate extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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

    public static function getDeletedGraduates()
    {
        return Graduate::onlyTrashed()
            ->orderBy('surname', 'asc')
            ->paginate(15);
    }

    public static function findWithDeleted($id)
    {
        return Graduate::withTrashed()->find($id);
    }
}
