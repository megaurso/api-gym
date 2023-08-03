<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGymPlanTable extends Migration
{
    public function up()
    {
        Schema::create('user_gym_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade')->unique();
            $table->foreignUuid('gym_plan_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_gym_plan');
    }
}