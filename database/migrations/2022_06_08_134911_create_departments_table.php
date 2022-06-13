<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('short');
            $table->string('name');
            $table->string('legal_form')->nullable();
            $table->string('street');
            $table->string('postal_code');
            $table->string('city');
            $table->string('country');
            $table->string('logo')->nullable();
            $table->string('vat_id');
            $table->string('regon');
            $table->string('krs');
            $table->string('aeo')->nullable();
            $table->string('fmc')->nullable();
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
        Schema::dropIfExists('departments');
    }
};
