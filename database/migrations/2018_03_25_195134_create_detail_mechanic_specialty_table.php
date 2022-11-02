<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailMechanicSpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_mechanic_specialty', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("especialty_id")->unsigned();
            $table->integer("user_id")->unsigned();

            $table->foreign("especialty_id")->references("id")->on("specialties");
            $table->foreign("user_id")->references("id")->on("users");
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_mechanic_specialty');
    }
}
