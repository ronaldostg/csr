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
        Schema::create('t_master', function (Blueprint $table) {
            $table->increments('id_master');
            $table->string('no_surat_edoc');
            $table->string('nama_kegiatan');
            $table->string('lokasi_kegiatan');
            $table->bigInteger('nominal');
            $table->string('ruang_lingkup');
            $table->string('status');
            $table->int('id_unit_master');
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
        //
    }
};
