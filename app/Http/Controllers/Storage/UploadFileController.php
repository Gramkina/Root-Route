<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Files;
use App\Models\Folders;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UploadFileController extends Controller{
    use SharedMethodStorage;

    public function __invoke(Request $request){
        $storage = $request['storage_name'];
        $request['path'] = '/'.$storage.'/'.$request['path'];

        /* Validation */
        if(!$uploadFile = $request->file('file'))
            return ['status' => 0, 'errors' => 'Необходимо выбрать файл'];
        $validation = Validator::make($request->all(), $this->validationRule);
        if($validation->fails())
            return ['status' => 0, 'errors' => $validation->errors()->first()];

        try{
            DB::transaction(function () use ($request, $storage, $uploadFile){
                $folderInfo = $this->getFolderInfo($request['path']);
                $folder = Folders::where(['storage' => $storage, 'path' => $folderInfo['parent'], 'name' => $folderInfo['name']])->firstOrFail();
                $file = new Files();
                $file->addFile($storage, $uploadFile, $folder, $request['version_name']);
                $uploadFile->store('files');
            });
            return ['status' => 1, 'url' => $request->headers->get('referer')];
        } catch (Exception $exception){
            return ['status' => 0, 'errors' => 'Ошибка на сервере'];
        }

    }

    private $validationRule = [
        'version_name' => 'bail|required',
        'storage_name' => 'bail|required',
    ];

}
