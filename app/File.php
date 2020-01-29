<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['image_url', 'filename', 'shared'];

    public function graduate()
    {
        return $this->belongsTo('App\Graduate');
    }
}
