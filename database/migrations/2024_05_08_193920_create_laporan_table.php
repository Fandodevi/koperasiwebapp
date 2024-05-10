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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_detail_pinjaman')->nullable();
            $table->foreign('id_detail_pinjaman')->references('id')->on('detail_pinjaman')->onDelete('cascade')->onUpdate('cascade');
            $table->string('keterangan');
            $table->enum('klasifikasi', ['Pendapatan', 'Beban Operasional']);
            $table->decimal('jumlah_uang', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
