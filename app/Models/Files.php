<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

/**
 * @property int id
 * @property string storage
 * @property string name
 * @property string hash_name
 * @property string version_name
 * @property string version_status
 * @property int size
 * @property UserData creator
 * @property Folders folder
 * @mixin Builder
 */

class Files extends Model{
    use HasFactory;

    protected $table = 'files';

    /**
     * @param string $storage
     * @param UploadedFile $file
     * @param Folders $folder
     * @param string $versionName
     */
    public function addFile($storage, $file, $folder, $versionName){
        $this->storage = $storage;
        $this->name = $file->getClientOriginalName();
        $this->hash_name = $file->hashName();
        $this->version_name = $versionName;
        $this->version_status = 'actual';
        $this->size = $file->getSize();
        $this->userData()->associate(UserData::getUserDataCurrentUser());
        $this->getFolder()->associate($folder);
        $this->save();
    }

    /**
     * @param Files $file
     * @param Files $addedFile
     * @param string $versionName
     */
    public function addVersion($file, $addedFile, $versionName){
        $this->storage = $file->storage;
        $this->name = $file->name;
        $this->hash_name = $addedFile->hashName();
        $this->version_name = $versionName;
        $this->version_status = 'none';
        $this->size = $addedFile->getSize();
        $this->userData()->associate(UserData::getUserDataCurrentUser());
        $this->getFolder()->associate($file->getFolder()->sole());
        $this->save();
    }

    /**
     * @param UploadedFile $newFile
     */
    public function updateFile($newFile){
        $this->size = $newFile->getSize();
        $this->save();
    }

    /**
     * @param string $storage
     * @param UploadedFile $file
     * @param Folders $folder
     * @return boolean
     */
    public static function isFileExists($storage, $file, $folder){
        return Files::where(['storage' => $storage, 'name' => $file->getClientOriginalName(), 'folder' => $folder->id])->exists();
    }

    /**
     * @param Files $file
     * @return Files[]
     */
    public static function getAllFileVersion($file){
        return Files::where(['storage' => $file->storage, 'name' => $file->name, 'folder' => $file->folder])->get();
    }

    public static function getFileByHashName($hashName){
        return Files::where(['hash_name' => $hashName])->firstOrFail();
    }

    public function userData(){
        return $this->belongsTo(UserData::class, 'creator', 'id');
    }

    public function getFolder(){
        return $this->belongsTo(Folders::class, 'folder', 'id');
    }

    public function getComments(){
        return $this->hasMany(Comment::class, 'file', 'id');
    }

}
