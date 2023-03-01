<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fipe_references', function (Blueprint $table) {
            $table->id();

            $table->string("Mes")->nullable();
            $table->string("Codigo")->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fipe_references');
    }
};
