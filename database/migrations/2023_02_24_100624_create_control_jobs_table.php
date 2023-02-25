<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('control_jobs', function (Blueprint $table) {
            $table->id();

            $table->string("type");
            $table->integer("total_count")->nullable();
            $table->integer("finish_count")->nullable();
            $table->boolean("finish")->default(0);

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('control_jobs');
    }
};
