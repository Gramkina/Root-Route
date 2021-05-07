<?php

namespace Database\Seeders;

use App\Models\AuthData;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{

    public function run(){
        $authData = new AuthData();
        $authData->add('root', 'root', 'admin');
    }
}
