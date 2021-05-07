<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Folders;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateFolderController extends Controller{
    use SharedMethodStorage;

    public function __invoke(Request $request){
        $storage = $request['storage_name'];
        $request['path'] = '/'.$storage.'/'.$request['path'];

        /* Validation */
        $validation = Validator::make($request->all(), $this->validationRule);
        if($validation->fails())
            return ['status' => 0, 'errors' => $validation->errors()->first()];

        try {
            $folderInfo = $this->getFolderInfo($request['path']);
            if (Folders::isFolderExists($storage, $folderInfo['parent'], $folderInfo['name'])){
                if (Folders::isFolderExists($storage, $request['path'], $request['name']))
                    return ['status' => 0, 'errors' => ['Такая папка уже существует']];
                $folder = new Folders();
                $folder->add($storage, $request['name'], $request['path']);
                return ['status' => 1, 'url' => $request->headers->get('referer')];
            }
            else return ['status' => 0, 'errors' => ['Нет такого пути']];
        } catch (Exception $exception){
            return ['status' => 0, 'errors' => ['Ошибка на сервере']];
        }
    }

    private $validationRule = [
        'name' => 'bail|required|regex:/^[А-Яа-я0-9A-Za-z ]+$/',
        'storage_name' => 'bail|required',
    ];

}
