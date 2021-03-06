<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPembelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pembelis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pembelian');
            $table->string('nama_pembelian');
            $table->integer('jumlah_pembelian');
            $table->bigInteger('harga_pembelian');
            $table->bigInteger('total_pembelian');
            $table->string('dibayar');
            $table->string('sisa');
            $table->foreignId('id_pembeli')->references('id')->on('data_pembelis');
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
        Schema::dropIfExists('riwayat_pembelis');
    }
}
