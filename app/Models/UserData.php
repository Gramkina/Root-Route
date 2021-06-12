<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property string name
 * @property string surname
 * @property string patronymic
 * @property string department
 * @property string position
 * @property string email
 * @property string role
 * @property AuthData user
 * @mixin Builder
 */
class UserData extends Model{
    use HasFactory;

    protected $table = 'user_data';

    public function invites(){
        return $this->hasMany('App\Models\Invites');
    }

    public function add($name, $surname, $patronymic, $department, $position, $email, $role, $user = null){
        $this->name = $name;
        $this->surname = $surname;
        $this->patronymic = $patronymic;
        $this->department = $department;
        $this->position = $position;
        $this->email = $email;
        $this->role = $role;
        $this->user = $user;
        return $this->save();
    }

    public function setAuthData($authData){
        $this->authData()->associate($authData);
        return $this->save();
    }

    public function authData(){
        return $this->belongsTo(AuthData::class, 'user','id');
    }

    /**
     * @return UserData
     */
    public static function getUserDataCurrentUser(){
        if(Auth::user()->role === 'user')
            return AuthData::where(['id' => Auth::user()->id])->firstOrFail()->userData()->sole();
        return 0;

    }

}
