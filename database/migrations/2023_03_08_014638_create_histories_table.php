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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->integer('id_petugas');
            $table->integer('nisn');            
            $table->string('nama');
            $table->integer('id_kelas');
            $table->text('alamat');
            $table->string('no_telp');
            $table->date('tgl_bayar');
            $table->string('bulan_dibayar');
            $table->string('tahun_dibayar');  
            $table->integer('id_spp');
            $table->integer('jumlah_bayar');
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
        Schema::dropIfExists('histories');
    }
};
