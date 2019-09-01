<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelTemplateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('rel_template_file', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('template_id')->unsigned()->nullable();
        //     $table->integer('file_id')->unsigned()->nullable();
        //     $table->integer('order_number')->nullable();
        //     $table->tinyInteger('is_thumbnail')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('rel_template_file');
    }
}
