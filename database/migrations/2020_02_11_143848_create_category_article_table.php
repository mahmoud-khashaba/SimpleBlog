<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_article', function (Blueprint $table) {
            $table->uuid('category_id');
            $table->uuid('article_id');

            $table->foreign('category_id')->references('id')->on('categories')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('article_id')->references('id')->on('articles')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('category_article', function (Blueprint $table)
        {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['article_id']);


        });
        Schema::dropIfExists('category_article');
        Schema::enableForeignKeyConstraints();

    }
}
