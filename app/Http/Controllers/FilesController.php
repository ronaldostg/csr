<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permohonan, Unit, Validasi, Bapi};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use PDF;
use DB;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permohonan = DB::table('t_master')
            ->join('t_unit', 't_unit.id_unit', '=', 't_master.id_unit_master')
            ->get();
        return view('files.index', ['permohonan' => $permohonan]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {

        $permohonan = Permohonan::where('id_master', $id)->first();
        
        $all = DB::table('t_master')
            ->join('t_unit', 't_unit.id_unit', '=', 't_master.id_unit_master')
            ->join('t_validasi', 't_validasi.id_val_master', '=', 't_master.id_master')
            // ->join('t_seremonial', 't_validasi.id_val_master', '=', 't_master.id_master')
            ->where('id_master', $id)
            ->first();
        $dok_sere = DB::select("SELECT * FROM t_seremonial where id_val_master = '".$all->id_master."'");
        if (!$all) {
            return redirect()->route('pemohon.index')
                ->with('error_message', 'Data Permohonan Belum Diproses, Silahkan Proses Terlebih Dahulu!');
        }
        // echo json_encode(['all' => $dok_sere]);
        // exit;
        return view('files.show', ['all' => $all, 'permohonan'=>$permohonan, 'foto_sere'=>$dok_sere]);
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function download_evaluasi($id)
    {
        $permohonan = Permohonan::where('id_master', $id)->first();
        // return 'app/' . $permohonan->file_val;

        if (empty($permohonan->file_val)) {
            return redirect()->back()->with('error_message', 'File Memorandum Analisa Belum Diupload!');
        }
        return response()->download(storage_path('app/' . $permohonan->file_val));
    }

    public function download_bapi($id)
    {
        $permohonan = Permohonan::where('id_master', $id)->first();
        if (empty($permohonan->file_bapi)) {
            return redirect()->back()->with('error_message', 'File Berita Acara Belum Diupload!');
        }
        return response()->download(storage_path('app/' . $permohonan->file_bapi));
    }
    public function download_sk($id)
    {
        $permohonan = Permohonan::where('id_master', $id)->first();
        if (empty($permohonan->file_sk)) {
            return redirect()->back()->with('error_message', 'File Surat Keputusan Belum Diupload!');
        }
        return response()->download(storage_path('app/' . $permohonan->file_sk));
    }
}