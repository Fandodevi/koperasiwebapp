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
        Schema::create('detail_simpanan', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_simpanan')->required();
            $table->foreign('id_simpanan')->references('id_simpanan')->on('simpanan')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_users')->required();
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('jenis_transaksi', ['Setor', 'Tarik']);
            $table->decimal('simpanan_pokok', 10, 2)->nullable();
            $table->decimal('simpanan_wajib', 10, 2)->nullable();
            $table->decimal('simpanan_sukarela', 10, 2)->nullable();
            $table->decimal('subtotal_saldo', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_simpanan');
    }
};