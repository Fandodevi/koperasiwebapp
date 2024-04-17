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
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id('id_pinjaman');
            $table->unsignedBigInteger('id_anggota')->required();
            $table->foreign('id_anggota')->references('id_anggota')->on('anggota')->onDelete('cascade')->onUpdate('cascade');
            $table->string('no_pinjaman');
            $table->decimal('total_pinjaman', 10, 2);
            $table->integer('angsuran');
            $table->decimal('sisa_lancar_keseluruhan', 10, 2);
            $table->enum('status_pinjaman', ['Belum Lunas', 'Lunas', 'Lewat Jatuh Tempo']);            
            $table->timestamp('tanggal_realisasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};