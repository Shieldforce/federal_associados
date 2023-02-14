<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->id();

            $table->string("number_registration");

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('trackers');
    }
};
