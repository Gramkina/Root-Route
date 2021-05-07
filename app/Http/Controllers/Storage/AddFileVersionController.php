<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddFileVersionController extends Controller{
    use SharedMethodStorage;

    public function __invoke(Request $request){
        $hashName = $request['hash_name'];
        $versionName = $request['version_name'];

        /* Validation */
        if(!$file = $request->file('file'))
            return ['status' => 0, 'errors' => 'Необходимо добавить файл'];
        $validation = Validator::make($request->all(), $this->validationRule);
        if($validation->failed())
            return ['status' => 0, 'errors' => $validation->errors()->first()];

        try {
            $fileByHashName = Files::getFileByHashName($hashName);
            $newFile = new Files();
            $newFile->addVersion($fileByHashName, $file, $versionName);
            $file->store('files');
            return ['status' => 1, 'url' => $request->headers->get('referer')];
        }
        catch (\Exception $exception){
            return ['status' => 0, 'errors' => 'Ошибка на сервере'];
        }
    }

    private $validationRule = [
        'hash_name' => 'bail|required',
        'version_name' => 'bail|required',
    ];
}
