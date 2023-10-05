<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxRegistrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_registrasis', function (Blueprint $table) {
            $table->string('no_regis')->primary();
            $table->string('id_pasien');
            $table->string('id_layanan');
            $table->string('id_jenis_pendaftaran');
            $table->timestamp('waktu_regis');
            $table->timestamps();
            $table->foreign('id_pasien')->references('id_pasien')->on('master_pasiens')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_layanan')->references('id_layanan')->on('master_layanans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jenis_pendaftaran')->references('id_jenis_pendaftaran')->on('master_jenis_pendaftarans')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_registrasis');
    }
}
