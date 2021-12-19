<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRecordSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_record_subject', function (Blueprint $table) {
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('subject_id')->unsigned();

            $table->foreign('subject_id')->references('id')->on('subjects')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('class_id')->references('class_id')->on('classes_records')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['class_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_record_subject');
    }
}
