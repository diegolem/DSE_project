<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('detail', 100);
            $table->string('description', 1000);
            $table->decimal('amount', 15, 2);
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('repair_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('repair_id')->references('id')->on('repairs');
            $table->foreign('category_id')->references('id')->on('categories');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_details');
    }
}
