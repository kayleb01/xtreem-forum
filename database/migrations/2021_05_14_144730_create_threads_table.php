<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('slug');
            $table->text('body');
            $table->smallInteger('status')->default(0);
            $table->integer('forum_id');
            $table->string('title');
            $table->string('report')->nullable();
            $table->smallInteger('locked')->default(0);
            $table->integer('replies_count');
            $table->integer('last_reply_at')->nullable();
            $table->integer('visits')->default(0);
            $table->string('reply_user')->nullable();
            $table->integer('category_id');
            $table->integer('fp');
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
        Schema::dropIfExists('threads');
    }
}
