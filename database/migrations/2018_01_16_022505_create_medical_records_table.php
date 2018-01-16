<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates the Medical Records table
 */
class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('user_id');
            $table->timestamp('fecha');
            $table->double('peso', 12, 4);
            $table->double('talla', 12, 4);
            $table->double('percentilo_cefalico', 12, 4);
            $table->double('percentilo_perimetro_cefalico', 12, 4);
            $table->string('alimentacion_observaciones', 255);
            $table->boolean('vacunas_completas');
            $table->string('vacunas_observaciones', 255);
            $table->boolean('maduracion_acorde');
            $table->string('maduracion_observaciones', 255);
            $table->boolean('examen_fisico_normal');
            $table->string('examen_fisico_observaciones', 255);
            $table->string('observaciones', 255);
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('medical_records');
    }
}
