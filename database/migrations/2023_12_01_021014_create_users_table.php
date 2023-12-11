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
        Schema::create('users', function (Blueprint $table)
        {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->longText('password');
            $table->string('phone')->nullable();
            $table->boolean('is_super_user')->nullable();
            $table->boolean('is_active')->nullable();
            $table->timestamps();
            //$table->foreignId('id')->constrained('emails', 'created_by');
            //$table->foreignId('id')->constrained('proxies', 'created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
