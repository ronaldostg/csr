<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView; 
use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromCollection; 
// use Maatwebsite\Excel\Concerns\WithEvents;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class LaporanExport implements FromView 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($reportData, $viewExcelReprt)
    {
        $this->reportData = $reportData;
        $this->viewExcel = $viewExcelReprt;

    }

    public function view(): View
    {
        // $query = "SELECT tm.no_surat_edoc ,tm.nominal,tm.ruang_lingkup,tb.nama,
        // tm.lokasi_kegiatan,tm.nama_kegiatan,tm.norek,tu.nama_unit, tu.pemda FROM t_master tm
        // left join t_unit tu on tm.id_unit_master = tu.id_unit
        // left join t_ba_pi tb on tb.id_val_master = tm.id_master
        //                 where tu.id_unit = '798'"; 
        //                 // -- and tm.status='SELESAI'";

        // $report = DB::select($query);
        $report = $this->reportData;


       return view($this->viewExcel,["data"=>$report]);
    }


}
