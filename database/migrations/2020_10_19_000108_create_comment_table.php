<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_comment')->nullable();
            $table->text('content')->nullable();
            // $table->tinyInteger('type')->nullable();//1:comment 2:đánh giá
            $table->tinyInteger('status')->nullable(); // 1:pending 2:duyệt ; 3:xóa ;
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('email')->nullable();
            $table->string('member_rate')->default(0)->nullable(); //số kí tự muốn hiện ở short content
            $table->tinyInteger('type')->nullable();
            $table->integer('link_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('comment');
    }
}
