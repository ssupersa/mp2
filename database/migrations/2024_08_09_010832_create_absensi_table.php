<?php
// database/migrations/xxxx_xx_xx_create_absensi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_absen');
            $table->boolean('hadir')->default(false);
            $table->string('bukti_kegiatan')->nullable(); // Kolom untuk upload bukti kegiatan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
