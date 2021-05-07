<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller{
    use SharedMethodStorage;

    public function __invoke(Request $request, Files $file){
        return Storage::disk('local')->download('files/'.$file->hash_name);
    }
}
