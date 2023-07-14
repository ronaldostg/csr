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
        //migration database in laravel

        
           Schema::create('t_ba-pi', function (Blueprint $table) {
            $table->increments('id_bapi');
            $table->string('nama', 60);
            $table->string('jabatan', 40);
            $table->text('alamat');
            $table->string('nama_bank', 60);
            $table->string('jabatan_bank', 40);
            $table->text('alamat_bank');            
            $table->bigInteger('id_ba-pi_unit');
            $table->string('jenis_bantuan', 35);
            $table->LongText('saksi');
            $table->bigInteger('id_val_master');
            $table->string('file_ba');
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
