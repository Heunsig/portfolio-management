<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mime', 40)->nullable();
            $table->string('saved_dir')->nullable();
            $table->string('saved_name')->nullable();
            $table->string('orig_name')->nullable();
            $table->string('raw_name')->nullable();
            $table->string('extension', 10)->nullable();
            $table->integer('size')->nullable();
            $table->tinyInteger('is_image')->nullable()->defalut(false);
            $table->integer('download')->nullable()->default(0);
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
        Schema::dropIfExists('files');
    }
}
