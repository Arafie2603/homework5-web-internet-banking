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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id_transaksi');
            $table->integer('total_item')->default(0);
            $table->integer('total_harga')->default(0);
            $table->unsignedBigInteger('akun_id')->references('id_akun')->on('akun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
