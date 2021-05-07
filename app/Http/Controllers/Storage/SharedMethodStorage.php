<?php

namespace App\Http\Controllers\Storage;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

trait SharedMethodStorage{

    public function getFolderInfo($path){
        $pathArray = explode('/', $path);
        $nameFolder = $pathArray[count($pathArray) - 2];
        unset($pathArray[count($pathArray)-2]);
        $pathFolder = implode('/', $pathArray);
        return ['parent' => $pathFolder, 'name' => $nameFolder];
    }

    public function getCurrentStorage(){
        switch(Route::currentRouteName()){
            case 'shared_storage':
                return 'shared';
            case 'personal_storage':
                return Auth::user()->login;
        }
    }

    public function getBase64File($fileName){
        return base64_encode(Storage::disk('local')->get('files/'.$fileName));
    }

}
