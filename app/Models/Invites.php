<?php

namespace App\Models;

use App\Events\InviteGenerating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string code
 * @property boolean status
 * @mixin Builder
 */
class Invites extends Model{
    use HasFactory;

    protected $table = 'invites';

    public function userData(){
        return $this->belongsTo('App\Models\UserData', 'user', 'id');
    }

    public function add($user){
        $this->userData()->associate($user);
        return $this->save();
    }

    public function deactivate(){
        $this->status = 1;
        return $this->save();
    }

    protected $dispatchesEvents = [
        'creating' => InviteGenerating::class,
    ];

}
