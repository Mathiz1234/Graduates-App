<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Graduate extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'surname', 'shared', 'matura_year', 'description', 'avatar', 'edited_by'];


    /*Relationships*/

    public function scans()
    {
        return $this->hasMany('App\Scan');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function editor()
    {
        return $this->belongsTo('App\User', 'edited_by', 'id');
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
                    return $query->where($key, 'like', '%' . $value . '%');
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

    public function addScan($filename)
    {
        return $this->scans()->create(['image_url' => $filename]);
    }

    public function addFile($filename, $fileOriginName)
    {
        return $this->files()->create([
            'image_url' => $filename,
            'filename' => $fileOriginName
        ]);
    }

    public function hasFile($name){

        if($this->files()->where('image_url', $name)->first()){
            return true;
        }else{
            false;
        }

    }

    public function hasScan($name){

        if($this->scans()->where('image_url', $name)->first()){
            return true;
        }else{
            false;
        }

    }
}
