<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('nama');
            $table->unsignedBigInteger('tingkat');
            $table->unsignedBigInteger('nama_kelas');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            
            $table->foreign('tingkat')
                  ->references('id')
                  ->on('classes')
                  ->onDelete('cascade');

            $table->foreign('nama_kelas')
                  ->references('id')
                  ->on('majors')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
