<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id'); 
            $table->uuid('user_id');
            $table->string('title');
            $table->string('slug')->index('slug');
            $table->text('content');
            $table->integer('published')->unsigned()->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->primary('id');
             $table->foreign('user_id')->references('id')->on('users')
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

          Schema::table('articles', function (Blueprint $table)
        {
            $table->dropPrimary('id');
            $table->dropForeign(['user_id']);

        });

        Schema::dropIfExists('articles');
    }
}
