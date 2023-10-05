<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxPelayanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_pelayanans', function (Blueprint $table) {
            $table->string('no_rekam_medis')->primary();
            $table->string('no_regis');
            $table->string('id_petugas');
            $table->string('id_metode_pembayaran')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamps();
            $table->foreign('no_regis')->references('no_regis')->on('trx_registrasis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_petugas')->references('id_petugas')->on('master_petugas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_metode_pembayaran')->references('id_metode_pembayaran')->on('master_metode_pembayarans')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_pelayanans');
    }
}
