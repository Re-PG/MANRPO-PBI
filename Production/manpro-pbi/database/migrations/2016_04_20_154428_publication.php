<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Publication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('publication',function(Blueprint $table)
      {
        $table->increments('id');
        $table -> integer('author_id') -> unsigned() -> default(0);
        $table->foreign('author_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
        $table->string('title')->unique();
        $table->string('abstract');
        $table->string('mime');
        $table->string('originalFilename')->unique();
        $table->string('Filename')->unique();
        $table->string('slug')->unique();
        $table->text('body');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Publication');
    }
}
