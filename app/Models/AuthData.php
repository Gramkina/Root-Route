<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * @property string login
 * @property string password
 * @property string role
 * @mixin Builder
 */
class AuthData extends Authenticatable{
    use HasFactory, Notifiable;

    protected $table = 'auth_data';

    protected $hidden = [
        'password',
    ];

    public function add($login, $password, $role){
        $this->login = $login;
        $this->password = $password;
        $this->role = $role;
        return $this->save();
    }

    protected function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }

    public function userData(){
        return $this->hasOne('App\Models\UserData', 'user');
    }
}
