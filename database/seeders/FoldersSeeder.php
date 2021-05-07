<?php

namespace Database\Seeders;

use App\Models\AuthData;
use App\Models\Folders;
use App\Models\UserData;
use Illuminate\Database\Seeder;

class FoldersSeeder extends Seeder{

    public function run(){
        $folder = new Folders();
        $folder->add('shared', 'shared', '/', 0);

        $users = UserData::whereNotNull('user')->get();
        foreach ($users as $user){
            $folderUser = new Folders();
            /** @var AuthData $authData */
            $authData = $user->authData()->sole();
            $folderUser->add($authData->login, $authData->login, '/', 0);
        }
    }
}
