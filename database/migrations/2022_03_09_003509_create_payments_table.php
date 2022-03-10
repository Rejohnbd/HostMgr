<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('FK from table: users');
            $table->unsignedBigInteger('service_id')->comment('FK from table: services');
            $table->unsignedBigInteger('invoice_id')->comment('FK from table: invoices');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->decimal('due_amount', 10, 2);
            $table->decimal('invoice_total', 10, 2);
            $table->string('payment_method', 20)->comment('cash/bkash/bank');
            $table->string('bkash_mobile_number', 20)->nullable();
            $table->string('bkash_transaction_no', 20)->nullable();
            $table->unsignedBigInteger('bank_account_id')->nullable()->comment('FK from table: bank_accounts');
            $table->date('payment_date');
            $table->unsignedBigInteger('created_by')->comment('FK from table: users');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('service_id')
                ->references('id')
                ->on('services');

            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices');

            $table->foreign('bank_account_id')
                ->references('id')
                ->on('bank_accounts');

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
        Schema::dropIfExists('payments');
    }
}
