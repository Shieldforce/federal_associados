<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->text("description");
            $table->boolean("protect_plan")->default(0);
            $table->boolean("tracking")->default(0);
            $table->string("file_link")->nullable();

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
