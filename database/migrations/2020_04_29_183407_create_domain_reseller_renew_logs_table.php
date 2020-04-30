<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainResellerRenewLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_reseller_renew_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('domain_reseller_id')->comment('FK from table: domain_reseller');
            $table->date('domain_reseller_renew_date');
            $table->integer('domain_reseller_renew_for');
            $table->decimal('domain_reseller_renew_amount', 10, 2);
            $table->timestamps();

            $table->foreign('domain_reseller_id')
                ->references('id')
                ->on('domain_resellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domain_reseller_renew_logs');
    }
}
