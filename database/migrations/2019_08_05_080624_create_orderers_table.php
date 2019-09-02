<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('orderers', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name')->nullable();
        //     $table->string('phone_number', 20)->nullable();
        //     $table->string('mobile_number', 20)->nullable();
        //     $table->string('email', 40)->nullable();
        //     $table->string('address_basic')->nullable();
        //     $table->string('address_detail')->nullable();
        //     $table->string('address_city', 50)->nullable();
        //     $table->string('address_state', 50)->nullable();
        //     $table->timestamp('ordered_time')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('orderers');
    }
}
