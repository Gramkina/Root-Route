<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SaveChangeFileController extends Controller{
    use SharedMethodStorage;

    public function __invoke(Request $request){
        $hashName = $request['currentFileHashName'];

        /* Validation */
        if(!$file = $request->file('file'))
            return ['status' => 0, 'errors' => 'Нет файла'];
        $validation = Validator::make($request->all(), $this->validationRule);
        if($validation->fails())
            return ['status' => 0, 'errors' => $validation->errors()->first()];

        try{
            DB::transaction(function () use($hashName, $file){
                $oldFile = Files::getFileByHashName($hashName);
                $oldFile->updateFile($file);
                $file->storeAs('files', $hashName);
            });
        }
        catch (\Exception $exception){
            return ['status' => 0, 'errors' => 'Ошибка на сервере'];
        }
        return ['status' => 1, 'url' => $request->header('referer')];
    }

    private $validationRule = [
        'currentFileHashName' => 'bail|required',
    ];
}
