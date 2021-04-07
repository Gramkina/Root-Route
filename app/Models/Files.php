<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

/**
 * @property string name
 * @property string storage_name
 * @property float size
 * @property UserData creator
 * @property Folders folder
 */

class Files extends Model{
    use HasFactory;

    protected $table = 'files';

    /**
     * @param UploadedFile $file
     * @param Folders $folder
     */
    public function add($file, $folder){
        $this->name = $file->getClientOriginalName();
        $this->storage_name = $file->hashName();
        $this->size = $file->getSize();
        $this->userData()->associate(UserData::getUserDataCurrentUser());
        $this->getFolder()->associate($folder);
        $this->save();
    }

    public function userData(){
        return $this->belongsTo(UserData::class, 'creator', 'id');
    }

    public function getFolder(){
        return $this->belongsTo(Folders::class, 'folder', 'id');
    }

}
