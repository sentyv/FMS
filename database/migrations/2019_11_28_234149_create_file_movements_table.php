<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('file_id')->unsigned();
            // $table->integer('user_id')->unsigned();
            $table->string('movement_start_date');
            $table->string('movement_return_date')->nullable();
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
        Schema::dropIfExists('file_movements');
    }
}
