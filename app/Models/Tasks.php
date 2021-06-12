<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int id
 * @property string type
 * @property UserData customer
 * @property UserData executor
 * @property string start_date
 * @property string finish_date
 * @property string name
 * @property string description
 * @property int group
 * @property string sharedName
 * @property string sharedDescription
 * @property string status
 * @property string hashName
 * @property array files
 * @mixin Builder
 */

class Tasks extends Model{
    use HasFactory;

    protected $table = 'task';

    public function add($type, $executor, $start_date, $finish_date, $name, $description, $group, $sharedName, $sharedDescription, $files = null){
        $this->type = $type;
        $this->getExecutor()->associate($executor);
        $this->getCustomer()->associate(UserData::getUserDataCurrentUser());
        $this->start_date = $start_date;
        $this->finish_date = $finish_date;
        $this->name = $name;
        $this->description = $description;
        $this->group = $group;
        $this->sharedName = $sharedName;
        $this->sharedDescription = $sharedDescription;
        $this->status = 'В процессе';
        $this->hashName = Str::uuid();
        $this->files = $files;
        $this->save();
    }

    public function getExecutor(){
        return $this->belongsTo(UserData::class, 'executor', 'id');
    }

    public function getCustomer(){
        return $this->belongsTo(UserData::class, 'customer', 'id');
    }
}
