<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');     
            $table->bigInteger('post_id')->unsigned()->default(0);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');    
            $table->text('content');               
            $table->boolean('approved')->default(0);
            $table->bigInteger('parent')->unsigned()->default(0);
            $table->index(['user_id', 'post_id', 'approved', 'parent']);   
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
        Schema::dropIfExists('comments');
    }
};
