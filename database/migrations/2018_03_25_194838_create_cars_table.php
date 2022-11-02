<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string("motor", 20);
            $table->string("displacement", 10);
            $table->string("license", 10)->unique();
            $table->integer("mileage");
            $table->string("observations", 255);
            $table->year("year");
            $table->integer("model_id")->unsigned();
            $table->integer("transmission_id")->unsigned();
            $table->integer("user_id")->unsigned();

            $table->foreign("model_id")->references("id")->on("models");
            $table->foreign("transmission_id")->references("id")->on("transmissions");
            $table->foreign("user_id")->references("id")->on("users");

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
