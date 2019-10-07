<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug', 60)->unique();
            $table->text('title');
            $table->longText('content')->nullable();
            $table->text('sourcePreviewLink')->nullable();
            $table->enum('showSourcePreviewLink', ['0', '1'])->default(0);
            $table->text('livePreviewLink')->nullable();
            $table->enum('showLivePreviewLink', ['0', '1'])->default(0);
            $table->integer('order')->default(0);
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
        Schema::dropIfExists('posts');
    }
}
