<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();

            $table->bigInteger('subject_id')->unsigned()->nullable();

            $table->string('type')->nullable();

            $table->float('grade',8,2)->nullable();

            $table->foreign('student_id')->references('id')->on('student_records')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('class_id')->references('class_id')->on('classes_records')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('subject_id')->references('id')->on('subjects')
                ->onUpdate('cascade')->onDelete('cascade');


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
        Schema::dropIfExists('grades');
    }
}
