<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createtablesmtpc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smtp_configuration', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('smtp_driver');
            $table->string('smtp_host');
            $table->string('smtp_port');
            $table->string('user_name');
            $table->string('password');
            $table->string('from_name');
            $table->string('smtp_encryption');
            $table->string('from_email');
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
        Schema::dropIfExists('smtp_configuration');
    }
}
