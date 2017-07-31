<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_cates', function (Blueprint $table) {
            $table->integer('post_id')->unsigned();
            $table->integer('cate_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('cate_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_cates');
    }
}
