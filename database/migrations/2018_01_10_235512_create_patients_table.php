<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates the patients table
 */
class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doc_type_id');
            $table->integer('home_type_id');
            $table->integer('heating_type_id');
            $table->integer('water_type_id');
            $table->integer('medical_insurance_id');
            $table->string('name');
            $table->string('last_name');
            $table->string('dni')->unique();
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female', 'unknown']);
            $table->string('address');
            $table->string('phone');
            $table->boolean('has_refrigerator');
            $table->boolean('has_electricity');
            $table->boolean('has_pet');
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
        Schema::dropIfExists('patients');
    }
}
