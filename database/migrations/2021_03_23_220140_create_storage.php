<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorage extends Migration{

    public function up(){
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('storage');
            $table->string('name');
            $table->foreignId('creator')->nullable()->constrained('user_data');
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table){
            $table->id();
            $table->string('storage');
            $table->string('name');
            $table->string('hash_name');
            $table->string('version_name');
            $table->string('version_status');
            $table->integer('size');
            $table->foreignId('creator')->constrained('user_data');
            $table->foreignId('folder')->constrained('folders');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::table('folders', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('folders');
            Schema::dropIfExists('files');
            Schema::enableForeignKeyConstraints();
        });
    }
}
