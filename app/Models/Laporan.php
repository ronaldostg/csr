<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Laporan extends Model
{
    use HasFactory;

    public static function all_laporan($id_unit, $tahun)
    {
        $query = "SELECT tm.no_surat_edoc ,tm.nominal,tm.ruang_lingkup,tb.nama,
        tm.lokasi_kegiatan,tm.nama_kegiatan,tb.tahun,tm.norek,tu.nama_unit, tu.pemda FROM t_master tm
        left join t_unit tu on tm.id_unit_master = tu.id_unit
        left join t_ba_pi tb on tb.id_val_master = tm.id_master
                        where tu.id_unit = " . "'" . $id_unit . "' 
                        and tm.status='SELESAI' and tb.tahun=" . "'" . $tahun . "'";

        $report = DB::select($query);

        return $report;
    }


    public static function sum_alokasi_per_tahun($id_unit, $tahun)
    {

        $query  = "SELECT SUM(tm.nominal) as total_alokasi				
        FROM t_master tm
        left join t_unit tu on tm.id_unit_master = tu.id_unit
        left join t_ba_pi tb on tb.id_val_master = tm.id_master
                where tu.id_unit =  " . "'" . $id_unit . "' 
                and tm.status='SELESAI' and tb.tahun=" . "'" . $tahun . "'";
        $totalAlokasi = DB::select($query)[0]->total_alokasi;

        return $totalAlokasi;
    }
}
