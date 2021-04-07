<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Folders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class StorageController extends Controller{

    public function index(Request $request){
        $path = '/shared/'.$request['path'];
        $folderInfo = $this->getFolderInfo($path);
        if(!Folders::isFolderExists($folderInfo['parent'], $folderInfo['name']))
            abort(404);
        $folders = Folders::where(['path' => $path])->get();
        $files = Folders::getFolderByInfo($folderInfo)->getFiles()->get();
        return view('files', ['path' => $request['path'], 'parent' => preg_replace('/\/shared\//', '', $folderInfo['parent'], 1), 'folders' => $folders, 'files' => $files]);
    }

    public function createFolder(Request $request){
        $request['path'] = '/shared/'.$request['path'];
        $validation = Validator::make($request->all(), [
            'name' => 'bail|required|regex:/^[А-Яа-я0-9A-Za-z ]+$/',
            'path' => 'bail|required',
        ]);
        if($validation->fails())
            return ['status' => 0, 'errors' => $validation->errors()->first()];
        try {
            $folderInfo = $this->getFolderInfo($request['path']);
            if (Folders::isFolderExists($folderInfo['parent'], $folderInfo['name'])){
                if (Folders::isFolderExists($request['path'], $request['name']))
                    return ['status' => 0, 'errors' => ['Такая папка уже существует']];
                $folder = new Folders();
                $folder->add($request['name'], $request['path']);
                return ['status' => 1, 'url' => $request->headers->get('referer')];
            }
            else return ['status' => 0, 'errors' => ['Нет такого пути']];
        } catch (Exception $exception){
            return ['status' => 0, 'errors' => ['Ошибка на сервере']];
        }
    }

    public function uploadFile(Request $request){
        $request['path'] = '/shared/'.$request['path'];
        $validation = Validator::make($request->all(), [
            'file' => 'bail|required',
            'path' => 'bail|required'
        ]);
        if($validation->fails())
            return ['status' => 0, $validation->errors()->first()];
        try{
            $folderInfo = $this->getFolderInfo($request['path']);
            $folder = Folders::where(['path' => $folderInfo['parent'], 'name' => $folderInfo['name']])->firstOrFail();
            $file = new Files();
            $file->add($request->file('file'), $folder);
            $request->file('file')->store('file');
            return $folder;
        } catch (Exception $exception){
            return ['status' => 0, 'errors' => 'Ошибка на сервере'];
        }
    }

    protected function getFolderInfo($path){
        $pathArray = explode('/', $path);
        $nameFolder = $pathArray[count($pathArray)-2];
        unset($pathArray[count($pathArray)-2]);
        $pathFolder = implode('/', $pathArray);
        return ['parent' => $pathFolder, 'name' => $nameFolder];
    }
}
