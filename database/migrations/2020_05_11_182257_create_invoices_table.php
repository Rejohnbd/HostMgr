<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('FK from table: users');
            $table->unsignedBigInteger('service_id')->comment('FK from table: services');
            $table->string('invoice_year', 10);
            $table->integer('invoice_serial')->unsigned();
            $table->integer('invoice_number')->unsigned();
            $table->decimal('invoice_gross_total', 10, 2);
            $table->decimal('invoice_discount', 10, 2);
            $table->decimal('invoice_total', 10, 2);
            $table->tinyInteger('payment_status')->default('0')->comment('0 = Not Paid, 1 = Paid, 2 = Partial Paid');
            $table->unsignedBigInteger('created_by')->comment('FK from table: users');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('service_id')
                ->references('id')
                ->on('services');

            $table->foreign('created_by')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
