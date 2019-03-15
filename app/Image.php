<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function graduate()
    {
        return $this->belongsTo('App\Graduate');
    }
}
