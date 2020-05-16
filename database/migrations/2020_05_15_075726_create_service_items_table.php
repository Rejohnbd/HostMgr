<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_id')->comment('FK from table: services');
            $table->unsignedBigInteger('service_type_id')->comment('FR from table: service_types');
            $table->text('item_details')->nullable();
            $table->timestamps();

            $table->foreign('service_id')
                ->references('id')
                ->on('services');

            $table->foreign('service_type_id')
                ->references('id')
                ->on('service_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_items');
    }
}
