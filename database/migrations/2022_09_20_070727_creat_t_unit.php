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
                Schema::create('t_unit', function (Blueprint $table) {
            $table->increments('id_unit');
            $table->string('nama_unit');
            $table->string('nama_pem');
            $table->year('tahun');
            $table->bigInteger('dana_alokasi');
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
