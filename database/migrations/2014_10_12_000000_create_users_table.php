<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->integer('role');
            $table->string('email')->unique();
            $table->string('nik');
            $table->string('telp');
            $table->bigInteger('total_simpanan')->default(0);
            $table->bigInteger('total_pinjaman')->default(0);
            $table->bigInteger('minimal_bayar')->default(0);
            $table->tinyInteger('status');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};