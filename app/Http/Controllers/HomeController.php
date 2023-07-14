<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permohonan, Unit, Validasi, LogModel};
use Auth;
use Session;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $master = DB::table('t_master')
            ->count();
        $selesai = DB::table('t_master')
            ->whereNotNull('file_val')
            ->count();
        $belum = DB::table('t_master')
            ->where('file_val', NULL)
            ->count();
        $unit = DB::table('t_unit')
            ->count();
        return view('home', ['master' => $master, 'unit' => $unit, 'selesai' => $selesai, 'belum' => $belum]);
    }
    public function new()
    {
        $rows = Unit::all();

        return view('new', compact('rows'));
    }
    public function proses($id)
    {
        $rows = Permohonan::findOrFail($id);
        return view('proses', compact('rows'));
    }
    public function proses_validasi($id)
    {
        $rows = Permohonan::findOrFail($id);

        return view('proses_validasi', compact('rows'));
    }

    public function getAlok(Request $request)
    {
        // echo json_encode($_GET);exit();
        $name = Unit::where("id_unit", $_GET['unitID'])->pluck('nama_pem');
        $alokasi = Unit::where("id_unit", $_GET['unitID'])->pluck('dana_alokasi');

        $alo = number_format($alokasi[0], 0, ',', '.');
        // print_r("Rp. $alo");
        // exit;

        $data = [
            "Rp. $alo",
            $name[0]
        ];
        return response()->json($data);
    }

    // public function loadalokasi(Request $request) [
    //  {
    //
    // $alok = $request->;

    // return $kabupaten;
    // exit;
    //    $alokasi = DB::table('t_unit')->where('alokasi','=', $alok)->get();
    //     return response()->json(['success'=>'Got Simple Ajax Request.']);


    //}


    public function store(Request $request)
    {
        $request->validate(
            [
                'id_unit_master' => 'required',
                'no_surat_edoc' => 'bail|required|unique:tb_surat',
                'nama_kegiatan' => 'required',
                'lokasi_kegiatan' => 'required',
                'nominal' => 'required',
                'ruang_lingkup' => 'required'
            ],
            [
                'id_unit_master' => 'Wajib Diisi!',
                'no_surat_edoc.unique' => 'Nomor Surat Sudah Ada!',
                'nama_kegiatan.required' => 'Nama Kegiatan Wajib Diisi!',
                'lokasi_kegiatan.unique' => 'Lokasi Kegiatan Wajib Diisi!',
                'nominal.required' => 'Nominal Wajib Diisi!',
                'ruang_lingkup.required' => 'Ruang Lingkup Wajib Di Checklis!',
            ]
        );
        $data = $request->all();
        $data['ruang_lingkup'] = implode(",", $request->ruang_lingkup);
        $data['status'] = "NEW";
        $pendaftar = Permohonan::create($data);
        return redirect('home');
    }
    public function valid(Request $request)
    {
        $request->validate(
            [
                'prop_rencana' => 'required',
                'check_judul' => 'required',
                'check_jumlah' => 'required',
                'check_norek' => 'required',
                'surat_pernyataan' => 'required',
                'surat_permohonan' => 'required',
                'check_data_diri' => 'required',
                'surat_ket' => 'required',
                'sasaran_prog' => 'required',
                'tujuan_prog' => 'required',
                'kesimpulan' => 'required',
            ],
            [
                'prop_rencana' => 'Wajib!',
                'check_judul' => 'Wajib!',
                'check_jumlah' => 'Wajib!',
                'check_norek' => 'Wajib!',
                'surat_pernyataan' => 'Wajib!',
                'surat_permohonan' => 'Wajib!',
                'check_data_diri' => 'Wajib!',
                'surat_ket' => 'Wajib!',
                'sasaran_prog' => 'Wajib!',
                'tujuan_prog' => 'Wajib!',
                'kesimpulan' => 'Wajib!',
            ]
        );
        $data = $request->all();
        $data['prop_rencana'] = implode(",", $request->prop_rencana);
        $data['surat_pernyataan'] = implode(",", $request->surat_pernyataan);
        $data['surat_permohonan'] = implode(",", $request->surat_permohonan);
        $data['check_data_diri'] = implode(",", $request->check_data_diri);
        $data['surat_ket'] = implode(",", $request->surat_ket);
        $data['tujuan_prog'] = implode(",", $request->tujuan_prog);
        $data['kesimpulan'] = implode(",", $request->kesimpulan);


        $valid = Validasi::create($data);
        $row = Permohonan::findOrFail($request->id_val_master);
        $row->update([
            'status' => 'EVALUASI'
        ]);

        return redirect('home');
    }

    public function cetak($id)
    {

        $rows = Permohonan::findOrFail($id);

        $pdf = PDF::loadview('validasi_pdf', ['rows' => $rows]);
        return $pdf->stream();
    }


    public function dest()
    {
        $logData = [];
        $logData['activity'] = 'Logout Aplikasi';
        $logData['master_data'] = 'Keluar dari Aplikasi';
        $logData['username'] = (Session::get('user'))->data[0]->nama_login;
        LogModel::create($logData);

        Session::flush();



        return redirect()->to('login');
    }
}
