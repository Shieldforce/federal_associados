<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alloweds', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("plan_id");
            $table->foreign("plan_id")
                ->references("id")
                ->on("plans")
                ->onDelete("cascade");

            $table->string("type");
            $table->decimal("value", 12, 2);
            $table->boolean("rule");
            $table->boolean("required")->default(0);

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('alloweds');
    }
};
