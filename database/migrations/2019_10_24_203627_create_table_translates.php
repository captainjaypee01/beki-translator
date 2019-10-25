<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTranslates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translates', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('word_id')->nullable();
            $table->string('name')->nullable();
            $table->string('language')->nullable(); 
            $table->tinyInteger('status')->defualt(1)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translates');
    }
}
