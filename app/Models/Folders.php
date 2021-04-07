<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property int creator
 * @property string path
 * @mixin Builder
 */
class Folders extends Model{
    use HasFactory;

    protected $table = 'folders';

    public function add($name, $path){
        $folder = new Folders();
        $folder->name = $name;
        $folder->userData()->associate(UserData::getUserDataCurrentUser());
        $folder->path = $path;
        $folder->save();
    }

    public function userData(){
        return $this->belongsTo(UserData::class, 'creator', 'id');
    }

    public static function isFolderExists($path, $folder = null){
        return Folders::where(($folder ? ['path' => $path, 'name' => $folder] : ['path' => $path]))->exists();
    }

    public function getFiles(){
        return $this->hasMany(Files::class, 'folder');
    }

    public static function getFolderByInfo($folderInfo){
        return Folders::where(['path' => $folderInfo['parent'], 'name' => $folderInfo['name']])->firstOrFail();
    }
}
