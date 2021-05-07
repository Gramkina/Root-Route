<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;

class FileIndexController extends Controller{
    use SharedMethodStorage;

    public function __invoke(Request $request, Files $file){
        $fileBase64 = $this->getBase64File($file->hash_name);
        $allFileVersion = Files::getAllFileVersion($file);
        return view('file', [
            'file' => $file,
            'fileBase64' => $fileBase64,
            'allFileVersion' => $allFileVersion,
        ]);
    }

}
