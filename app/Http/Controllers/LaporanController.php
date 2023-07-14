<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Excel;
use App\Models\Laporan;
use App\Exports\LaporanExport;
use App\Models\Dalok;

class LaporanController extends Controller
{
    //

    public function index(){
        // echo 'test';

        $unit = Unit::all();
        // echo json_encode($unit);
        // exit;


        return view('laporan.index',[
            'unit'=>$unit
        ]);
    }

    public function all_report(){
        // return $request->tahun_laporan;
        $res=[];


        $report = Laporan::all_laporan(request('id_unit'), request('tahun'));
        $totalAlokasi = Laporan::sum_alokasi_per_tahun(request('id_unit'), request('tahun'));

        foreach ($report as $index => $value) {

            $value->no = $index+1;
            $value->nominal = number_format($value->nominal);
            # code...
            // echo json_encode($value->no_surat_edoc);
            $index++;
        }
        // echo json_encode($report);
        // exit;

        if(empty($report)){
            $res['rc']='99';
            $res['message']='Data tidak ada';
            $res['data']=[];
            $res['total_alokasi']=0;
        }else{
            $res['rc']='00';
            $res['message']='Data berhasil didapatkan';
            $res['data']=$report;
            $res['total_alokasi']=number_format($totalAlokasi);
            
        }
        return $res;


    }

    public function download_excel(){
        
        $data = [];
        $namaPemda = Unit::where("id_unit",'798')->first() ;
        // $data['daerah'];
        $data['nama_pemda'] = $namaPemda['jns_wilayah']." ".$namaPemda['pemda'];
        $data['tahun'] = request('tahun');
        // exit;

        $report = Laporan::all_laporan(request('id_unit'), request('tahun'));
        $total = Laporan::sum_alokasi_per_tahun(request('id_unit'), request('tahun'));
        $data['report'] = $report;
        $data['total'] = $total;
        $data['belumDipakai'] = (Dalok::where([["id_unit", request('id_unit')], ["tahun", date('Y')]])->first())->dana_alokasi;
        $data['totalAll'] = (Dalok::where([["id_unit", request('id_unit')], ["tahun", date('Y')]])->first())->dana_alokasi + $total;
        // echo json_encode($data);
        // exit;
    

        return view('laporan.excel_template', ['data'=>$data]);
        // return Excel::download(new LaporanExport($data, 'laporan.excel_template'), "laporan_".request('id_unit')."_".request('tahun').".xlsx" );
    }
}
