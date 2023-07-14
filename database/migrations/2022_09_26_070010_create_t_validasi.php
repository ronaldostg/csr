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
        Schema::create('t_validasi', function (Blueprint $table) {
            $table->increments('id_validasi');
            $table->string('prop_rencana');
            $table->string('check_judul', 6);
            $table->string('check_jumlah', 6);
            $table->string('check_norek', 6);
            $table->string('surat_pernyataan');
            $table->string('surat_permohonan');
            $table->string('check_data_diri', 40);
            $table->string('surat_ket');
            $table->longText('sasaran_prog');
            $table->longText('tujuan_prog');
            $table->longText('kesimpulan');
            $table->bigInteger('id_val_master');
            $table->string('file_val');
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
        Schema::dropIfExists('t_validasi');
    }
};
