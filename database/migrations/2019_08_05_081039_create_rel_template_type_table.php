<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelTemplateTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('rel_template_type', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('template_id')->unsigned()->nullable();
        //     $table->integer('type_id')->unsigned()->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('rel_template_type');
    }
}
