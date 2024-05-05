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
        Schema::create('history_transaksi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_users')->required();
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_detail_simpanan')->nullable();
            $table->foreign('id_detail_simpanan')->references('id')->on('detail_simpanan')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_pinjaman')->nullable();
            $table->foreign('id_pinjaman')->references('id_pinjaman')->on('pinjaman')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_detail_pinjaman')->nullable();
            $table->foreign('id_detail_pinjaman')->references('id')->on('detail_pinjaman')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('tipe_transaksi', ['Pemasukan', 'Pengeluaran']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_transaksi');
    }
};