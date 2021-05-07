<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string storage
 * @property string name
 * @property int creator
 * @property string path
 * @mixin Builder
 */
class Folders extends Model{
    use HasFactory;

    protected $table = 'folders';

    public function add($storage, $name, $path, $useUser = 1){
        $folder = new Folders();
        $folder->storage = $storage;
        $folder->name = $name;
        if($useUser == 1)
            $folder->userData()->associate(UserData::getUserDataCurrentUser());
        $folder->path = $path;
        $folder->save();
    }

    public function userData(){
        return $this->belongsTo(UserData::class, 'creator', 'id');
    }

    public static function isFolderExists($storage, $path, $folder = null){
        return Folders::where(($folder ? ['storage' => $storage, 'path' => $path, 'name' => $folder] : ['storage' => $storage, 'path' => $path]))->exists();
    }

    public function getFiles(){
        return $this->hasMany(Files::class, 'folder');
    }

    public static function getFolderByInfo($folderInfo){
        return Folders::where(['path' => $folderInfo['parent'], 'name' => $folderInfo['name']])->firstOrFail();
    }
}
