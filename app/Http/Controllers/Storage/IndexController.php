<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Folders;
use Illuminate\Http\Request;

class IndexController extends Controller{
    use SharedMethodStorage;

    public function __invoke(Request $request){
        $storage = $this->getCurrentStorage();
        $path = '/'.$storage.'/'.$request['path'];
        $folderInfo = $this->getFolderInfo($path);
        if(!Folders::isFolderExists($storage, $folderInfo['parent'], $folderInfo['name']))
            abort(404);
        $folders = Folders::where(['path' => $path])->get();
        $files = Folders::getFolderByInfo($folderInfo)->getFiles()->where(['version_status' => 'actual'])->get();
        return view('files', [
            'path' => $request['path'],
            'parent' => preg_replace('/\/'.$storage.'\//', '', $folderInfo['parent'], 1),
            'folders' => $folders,
            'files' => $files,
            'storage' => ($storage == 'shared' ? 'shared_storage' : 'personal_storage'),
            'storageName' => $storage,
        ]);
    }

}
