<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesRecordStudentRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_record_student_record', function (Blueprint $table) {
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();

            $table->foreign('student_id')->references('id')->on('student_records')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('class_id')->references('class_id')->on('classes_records')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['class_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes_record_student_record');
    }
}
