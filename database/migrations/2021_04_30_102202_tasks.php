<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tasks extends Migration{

    public function up(){
        Schema::create('task', function (Blueprint $table){
            $table->id();
            $table->string('type');
            $table->foreignId('customer')->constrained('user_data');
            $table->foreignId('executor')->constrained('user_data');
            $table->date('start_date');
            $table->date('finish_date');
            $table->string('name');
            $table->string('description');
            $table->string('sharedName');
            $table->string('sharedDescription');
            $table->string('group');
            $table->uuid('hashName');
            $table->string('status');
            $table->json('files')->nullable();
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('task');
    }
}
