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
            $table->string('service_type_ids', 20)->comment('FR array from table: service_items');
            $table->string('service_log_for', 20)->comment('new/renewal');
            $table->date('service_start_date');
            $table->date('service_expire_date');
            $table->text('comment')->nullable();
            $table->tinyInteger('invoice_status')->default('0')->comment('0 = Invoice Not Ready, 1 = Invoice Ready');
            $table->integer('invoice_number')->unsigned()->nullable();
            // $table->tinyInteger('payment_status')->default('0')->comment('0 = Not Paid, 1 = Paid, 2 = Partial Paid');
            $table->timestamps();

            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
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
