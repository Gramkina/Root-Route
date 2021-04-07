<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration{

    public function up(){
        Schema::create('auth_data', function (Blueprint $table) {
            $table->id();
            $table->string('login', 20)->unique();
            $table->string('password');
            $table->string('role', 10);
            $table->timestamps();
        });

        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user')->nullable()->constrained('auth_data');
            $table->string('name', 30);
            $table->string('surname', 30);
            $table->string('patronymic', 30)->nullable();
            $table->string('department', 50);
            $table->string('position', 50);
            $table->string('email')->unique();
            $table->string('role', 10);
            $table->timestamps();
        });

        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->uuid('code')->unique();
            $table->foreignId('user')->constrained('user_data');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

    }

    public function down(){
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('invites');
        Schema::dropIfExists('user_data');
        Schema::dropIfExists('auth_data');
        Schema::enableForeignKeyConstraints();
    }
}
