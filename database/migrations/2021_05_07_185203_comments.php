<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comments extends Migration{

    public function up(){
        Schema::create('comments', function(Blueprint $table){
            $table->id();
            $table->foreignId('file')->constrained('files');
            $table->foreignId('user')->constrained('user_data');
            $table->foreignId('answer')->nullable()->constrained('comments');
            $table->string('comment');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::table('comments', function (Blueprint $table) {
            Schema::dropIfExists('comments');
        });
    }
}
