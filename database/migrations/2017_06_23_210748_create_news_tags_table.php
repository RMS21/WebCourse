<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_tags', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->unsignedInteger('news_id');
            $table->unsignedInteger('tag_id');
            $table->timestamps();
        });

        Schema::table('news_tags', function ($table) {
          $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
          $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_tags');
    }
}
