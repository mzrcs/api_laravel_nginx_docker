<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_response_logs', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('status')->nullable();
            $table->mediumText('description')->nullable();
            $table->text('request_header')->nullable();
            $table->text('request_data')->nullable();
            $table->mediumText('response_data')->nullable();
            $table->string('time_in')->nullable();
            $table->string('time_out')->nullable();
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
        Schema::drop('request_response_logs');
    }
};
