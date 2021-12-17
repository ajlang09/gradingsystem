<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //unsigned empty integer
        Schema::create('class_id_stud_id', function (Blueprint $table) {
            $table->integer('stud_id')->unsigned();
            $table->integer('class_id')->unsigned();

            $table->primary(['stud_id', 'class_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tom');
    }
}
