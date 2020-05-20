<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id')->comment('FR from table: invoice');
            $table->integer('invoice_number')->unsigned()->comment('FR from table: invoices');
            $table->unsignedBigInteger('service_type_id')->comment('FR from table: service_types');
            $table->tinyInteger('invoice_item_for')->comment('new service/renew service/others');
            $table->text('invoice_item_details');
            $table->decimal('invoice_item_subtotal', 10, 2);
            $table->decimal('invoice_item_discount', 10, 2);
            $table->decimal('invoice_item_total', 10, 2);
            $table->timestamps();

            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices');

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
        Schema::dropIfExists('invoice_items');
    }
}
