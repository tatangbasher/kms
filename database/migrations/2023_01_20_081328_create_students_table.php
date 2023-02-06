<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_class_id')->unsigned();
            $table->foreign('student_class_id')->references('id')->on('student_classes')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nis');
            $table->string('name');
            $table->enum('gender', ['Laki-Laki', 'Perempuan'])->default('Laki-Laki');
            $table->longText('address');
            $table->string('phone');
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
        Schema::dropIfExists('students');
    }
}
