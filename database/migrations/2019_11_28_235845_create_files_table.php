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
            $table->bigIncrements('id');
            $table->string('file_subject_title');
            $table->string('file_author_name');
            $table->date('file_published_date');
            $table->date('file_received_date');
            $table->integer('file_reference_id')->unsigned();
            $table->integer('file_publisher_id')->unsigned();
            $table->integer('current_movement_id')->unsigned()->nullable()->comment('Null if not on issue');
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
