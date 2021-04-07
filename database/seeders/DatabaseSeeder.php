<?php

namespace Database\Seeders;

use App\Models\AuthData;
use App\Models\Folders;
use App\Models\Invites;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder{

    public function run(){
        $authData = new AuthData();
        $authData->add('root', 'root', 'admin');

        $folder = new Folders();
        $folder->add('shared', null, '/');
    }
}
