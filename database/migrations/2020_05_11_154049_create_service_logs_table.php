<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->comment('FK from table: customers');
            $table->unsignedBigInteger('service_id')->comment('FK from table: services');
            $table->unsignedBigInteger('service_type_id')->comment('FR from table: service_types');
            $table->string('service_log_for', 20)->comment('new/renewal');
            $table->date('service_start_date');
            $table->date('service_expire_date');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

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
        Schema::dropIfExists('service_logs');
    }
}
