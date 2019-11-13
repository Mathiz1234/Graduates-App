<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Graduate;

class UploadsController extends Controller
{
    public function index($type, $name, Graduate $graduate)
    {
        switch($type){
            case 'avatars':

                if ($graduate->avatar == $name){
                    return response()->file(storage_path('app/uploads/avatars/'.$name));
                }else{
                    abort(404);
                }

                break;
            case 'files':

                if ($graduate->hasFile($name)){
                    return response()->file(storage_path('app/uploads/files/'.$name));
                }else{
                    abort(404);
                }

                break;
            case 'scans':

                if ($graduate->hasScan($name)){
                    return response()->file(storage_path('app/uploads/scans/'.$name));
                }else{
                    abort(404);
                }

                break;
            default:
                abort(404);

        }
    }
}
