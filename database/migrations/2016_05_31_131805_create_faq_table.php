$table->increments('id');
            $table->string('category_name')->unique();
            $table->timestamps();<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->foreign('category_id')->references('id')->on('categories');                    
            $table->text('question');
            $table->text('answer');
            $table->boolean('moderated')->default(0);
            $table->boolean('archived')->default(0);
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
         Schema::dropIfExists('faq');
    }
}
