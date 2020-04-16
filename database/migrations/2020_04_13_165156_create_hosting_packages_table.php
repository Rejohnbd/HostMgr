<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostingPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosting_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('space', 50)->comment('in MB');
            $table->string('bandwidth', 50)->comment('in MB');
            $table->string('db_qty', 50);
            $table->string('emails_qty', 50);
            $table->string('subdomain_qty', 50);
            $table->string('ftp_qty', 50);
            $table->string('park_domain_qty', 50);
            $table->string('addon_domain_qty', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosting_packages');
    }
}
