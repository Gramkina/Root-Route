<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Http\Request;

class IndexEditFileController extends Controller{
    use SharedMethodStorage;

    public function __invoke(Request $request, Files $file){
        $fileBase64 = $this->getBase64File($file->hash_name);
        return view('storage.editFile', [
            'file' => $file,
            'fileBase64' => $fileBase64,
        ]);
    }

}
