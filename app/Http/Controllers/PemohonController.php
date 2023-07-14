<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permohonan, Unit, Validasi, Bapi, Dalok, Wilayah,HistoryAlokasi,SeremonialModel,LogModel, SettingsModel};
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Redirect;
use PDF;
use File;
use DB;
use Session;

use Illuminate\Support\Facades\Storage;
// use SeremonialModel;
use Image;




class PemohonController extends Controller
{
     public function index()
     {
          // $rows = Permohonan::all()->i;
          $rows = Permohonan::orderBy('id_master', 'DESC')->get();
          // $value = Session()->get('user');
          //   $value1 = Session()->get('status_login');
          // var_dump($value);
          // echo '<br><br>';
          // exit();
          return view('pemohon.index', [
               'rows' => $rows
          ]);
     }
     public function proses($id)
     {
          $rows = Permohonan::findOrFail($id);
          $unit = Unit::where('id_unit', $rows->id_unit_master)->first();
          return view('pemohon.proses', [
               'rows' => $rows, 'unit' => $unit
          ]);
     }
     public function getAlok(Request $request)
     {
          $pemda = Unit::where("id_unit", $_GET['unitID'])->pluck('pemda')->first();
          $alokasi = Dalok::where([["id_unit", $_GET['unitID']], ["tahun", date('Y')]])->pluck('dana_alokasi')->first();
          // $alokasi = Dalok::where([["id_unit", $_GET['unitID']], ["tahun", date('Y')]]);
          // return $alokasi;

          if (!empty($alokasi)) {
               $alo = number_format($alokasi, 0, ',', '.');
               $data = [
                    "Rp. $alo",
                    $pemda
               ];
               return response()->json($data);
          } else {
               $data = [
                    "Kosong!",
                    $pemda
               ];
               return response()->json($data);
          }
     }
     public function create()
     {

          $rows = Unit::all();
          $wilayah = Wilayah::all();
          return view('pemohon.create', [
               'rows' => $rows, 'wilayah' => $wilayah
          ]);
     }
     public function store(Request $request)
     {
          $validator = Validator::make(
               $request->all(),
               [
                    'id_unit_master' => 'required',
                    'no_surat_edoc' => 'bail|required',
                    'nama_kegiatan' => 'required|min:4|max:220',
                    'lokasi_kegiatan' => 'required|min:4|max:255',
                    'ruang_lingkup' => 'required',
                    'nominal' => 'required',
                    'ruang_lingkup' => 'required',
                    'norek' => 'required',
          
               ],
               [
                    'id_unit_master.required' => 'Mohon Pilih Unit Kantor!',
                    'no_surat_edoc.required' => 'Mohon Isi Nomor Surat!',
                    'nama_kegiatan.required' => 'Mohon isi Nama Kegiatan!',
                    'norek.required' => 'Mohon isi Nomor Rekening!',
                    'nama_kegiatan.min' => 'Nama Kegiatan minimum 4 Karakter!',
                    'nama_kegiatan.max' => 'Nama Kegiatan maximal 255 Karakter!',
                    'lokasi_kegiatan.required' => 'Mohon Isi Lokasi Kegiatan!',
                    'lokasi_kegiatan.min' => 'Lokasi Kegiatan minimum 4 Karakter!',
                    'lokasi_kegiatan.max' => 'Lokasi Kegiatan maximal 255 Karakter!',
                    'ruang_lingkup.required' => 'Mohon Ceklis Ruang Lingkup Kemitraan!',
            
                    
                    
                    'nominal.required' => 'Mohon Isi Nominal',
                    'ruang_lingkup.required' => 'Mohon Isi Ruang lingkup',
               ]
          );


          //  return response()->json($validator);
          //  exit;


          $data = $request->all();
          $data['nominal'] = str_replace('.', '', $request->nominal);
          // $ff = $data['nominal'];
          // $data['nominal'] = str_replace(',00', '', $ff);
          $a = Dalok::where([["id_unit", $request->id_unit_master], ["tahun", date('Y')]])->first();
          if (empty($a)) {
               return redirect()->back()->with('error_message', 'Dana alokasi Cabang ini Kosong!')->withInput($request->all());
          }
          $aa = $a['dana_alokasi'];
          // $b = $aa - $data['nominal'];

          // $data['ruang_lingkup'] = implode(",", $request->ruang_lingkup);
          $data['ruang_lingkup'] =$request->ruang_lingkup;
          $data['status'] = "NEW";
          $data['norek'] = $request->norek;
          $data['nominal'] = str_replace('.', '', $request->nominal);
          // $a = Dalok::where([["id_unit", $request->id_unit_master], ["tahun", date('Y')]])->first();
          // $a->update(['dana_alokasi' => $b]);


          // $recAloc = HistoryAlokasi::create([
          //      'nominal'=>$data['nominal'],
               
          //      'id_unit_master'=>$request->id_unit_master,
          //      'tahun'=>date('Y'),
          // ])->first();

          
          // $pendaftar = Permohonan::create($data);
          // return redirect()->route('pemohon.index')
          //      ->with('success_message', 'Berhasil menambah Data Permohonan baru!');

          $logData = [];
          $logData['activity'] = 'input permohonan';
          $logData['master_data'] = json_encode($data);
          $logData['username'] = (Session::get('user'))->data[0]->nama_login;
 
          $res = [];     

          if (!$validator->fails()) {
               Permohonan::create($data);
               LogModel::create($logData);
               $res['rc'] = '00';
               $res['message'] = 'Berhasil Tambah Data';
          } else {
               $res['rc'] = '01';
               $res['message'] = $validator->errors()->messages();
               // $data['validation'] = json_encode($validator->fails());
          }

         return $res;
     }
     public function proses_validasi($id)
     {

          $rows = Permohonan::findOrFail($id);
          $unit = Unit::where('id_unit', $rows->id_unit_master)->first();
          $dalok = Dalok::where([["id_unit", $rows->id_unit_master], ["tahun", date('Y')]])->first();
          $thn = Permohonan::where([['id_unit_master', $rows->id_unit_master], ['status', "SELESAI"]])->whereYear('created_at', date('Y'))->get();
          $c = Permohonan::where('id_master', $rows->id_master)->first();
          $tot =  $thn->sum('nominal');
          $blmTerpakai = $dalok->dana_alokasi;
          $totAlokasi =  $dalok->dana_alokasi + $tot;
          $usulan = 'Berdasarkan data di atas, dengan ini kami usulkan/rekomendasikan kiranya usulan Program Kemitraan tersebut dapat disetujui dan kami akan menindaklanjuti surat persetujuan tersebut kepada penerima manfaat Program Kemitraan';
          // $totalRealisasi = 
          // $sisaRealisasi = 

          $row = Unit::all();
          return view('pemohon.proses_validasi', [
               'rows' => $rows, 
               'thn' => $thn, 
               'tot' => $tot, 
               'totAlokasi' => $totAlokasi, 
               'blmTerpakai'=>$blmTerpakai,
               'usulan'=>$usulan,
               'row' => $row, 'c' => $c, 'unit' => $unit, 'dalok' => $dalok]);
     }
     public function proses_bapi($id)
     {
          $rows = Permohonan::findOrFail($id);
          $a = Permohonan::where('id_master', $rows->id_master)->first();
          $row = Unit::all();
          return view('pemohon.proses_bapi', [
               'rows' => $rows, 'row' => $row, 'a' => $a
          ]);
     }
     public function valid(Request $request)
     {

          // echo json_encode($_POST);
          // exit;
          $validator = Validator::make($request->all(), [
               'check_judul' => 'required',
               'check_jumlah' => 'required',
               'check_norek' => 'required',
               // 'check_data_diri_0' => 'required',
               'check_data_diri_1' => 'required',
               'check_data_diri_2' => 'required',
               'sasaran_prog' => 'required|min:5',
               'tujuan_prog' => 'required|min:5',
               'kesimpulan[]' => 'min|2',
               'nama' => 'required|min:5|max:150',
               'jabatan' => 'required|max:75',
               'alamat' => 'required|min:7',
               'selaku' => 'required',
               'nik_pihak_2' => 'required',
               'npwp_pihak_2' => 'required',


               'nama_bank' => 'required|min:2|max:150',
               'jabatan_bank' => 'required|min:2|max:90',
               'alamat_bank' => 'required|min:7',
               'id_bapi_unit' => 'required',
               'jenis_bantuan' => 'required',
               'saksi' => 'required',

               'usulan' => 'required',
          ], [
               'check_judul.required' => 'Mohon Ceklis Nama/Judul Program Kemitraan!',
               'check_norek.required' => 'Mohon Ceklis Nomor Rekening!',
               'check_jumlah.required' => 'Mohon Ceklis Jumlah Permohonan!',
               // 'check_data_diri_0.required' => 'Mohon Ceklis Identitas Diri KTP / SIM / Paspor / Kartu Keluarga!',
               'check_data_diri_1.required' => 'Mohon Ceklis Ketersediaan Identitas Diri!',
               'check_data_diri_2.required' => 'Mohon Ceklis Ketersediaan Identitas Diri!',
               'sasaran_prog.required' => 'Mohon Isi Sasaran Progam Kemitraan!',
               'tujuan_prog.required' => 'Mohon Isi Tujuan Program Kemitraan!',
               'kesimpulan[].min' => 'Form Kesimpulan Minimal 2 Karakter!',
               'nama.required' => 'Mohon Isi Nama Penerima Manfaat',
               'nama.min' => 'Nama Penerima Manfaat minimal 5 Karakter!',
               'nama.max' => 'Nama Penerima Manfaat maximal 150 Karakter!',
               'jabatan.required' => 'Mohon Isi Jabatan Penerima Manfaat!',
               'jabatan.max' => 'Jabatan Penerima Manfaat maximal 75 Karakter!',
               'alamat.required' => 'Mohon Isi Alamat Penerima Manfaat!',
               'alamat.min' => 'Alamat Penerima Manfaat minimal 7 Karakter!',
               'selaku.required' => 'Mohon isi selaku pihak kedua ',
               'nik_pihak_2.required' => 'Mohon isi NIK Pihak kedua',
               'npwp_pihak_2.required' => 'Mohon isi NPWP Pihak kedua',
               
               'nama_bank.required' => 'Mohon Isi Nama Bank Sumut Terkait',
               'nama_bank.min' => 'Nama Bank Sumut Terkait minimal 5 Karakter!',
               'nama_bank.max' => 'Nama Bank Sumut Terkait maximal 150 Karakter!',
               'jabatan_bank.required' => 'Mohon Isi Jabatan Bank Sumut Terkait!',
               'jabatan_bank.max' => 'Jabatan Bank Sumut Terkait maximal 75 Karakter!',
               'alamat_bank.required' => 'Mohon Isi Alamat Bank Sumut Terkait!',
               'alamat_bank.min' => 'Alamat Bank Sumut Terkait minimal 7 Karakter!',
               'id_bapi_unit.required' => 'Mohon Pilih Cabang!',
               'jenis_bantuan.required' => 'Mohon Pilih Jenis Bantuan!',
               'saksi.required' => 'Mohon Isi Saksi!',
               'usulan.required' => 'Mohon Isi Usulan',
          ]);
          if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput($request->all());
          }

          $cekDataDiri = $request->check_data_diri_1[0].',' . $request->check_data_diri_2;
  
          $valid = Validasi::create([
               'check_jumlah' => $request->check_jumlah ? 'Ya' : 'No',
               'check_norek' => $request->check_norek ? 'Ya' : 'No',
               'check_data_diri' => $cekDataDiri,
               'sasaran_prog' => $request->sasaran_prog,
               
               
               'prop_rencana' => implode(",", $request->prop_rencana) ? implode(",", $request->prop_rencana)  : implode(",", ['No', 'No']),
               // 'check_judul' => $request->check_judul ? 'Ya' : 'No',
               'check_judul' => implode(",", $request->check_judul) ? implode(",", $request->check_judul)  : implode(",", ['No', 'No']),
               


               'surat_pernyataan' => implode(",", $request->surat_pernyataan) ? implode(",", $request->surat_pernyataan)  : implode(",", ['No', 'No']),
               'surat_permohonan' => implode(",", $request->surat_permohonan) ? implode(",", $request->surat_permohonan)  : implode(",", ['No', 'No']),
               'surat_ket' => implode(",", $request->surat_ket) ? implode(",", $request->surat_ket)  : implode(",", ['No', 'No']),
               'tujuan_prog' => $request->tujuan_prog,
               'id_val_master' => $request->id_val_master,
               'kesimpulan' => implode(",", $request->kesimpulan),
               'usulan'=>$request->usulan
            


          ]);
          $bapi = Bapi::create([
               'nama' => $request->nama,
               'jabatan' => $request->jabatan,
               'alamat' => $request->alamat,
               'nama_bank' => $request->nama_bank,
               'jabatan_bank' => $request->jabatan_bank,
               'alamat_bank' => $request->alamat_bank,
               'id_bapi_unit' => $request->id_bapi_unit,
               'jenis_bantuan' => $request->jenis_bantuan,
               'id_val_master' => $request->id_val_master,
               'saksi' => implode(',', $request->saksi),
               'tahun'=>date('Y'),
               'selaku_pihak_2' => $request->selaku,
               'nik_pihak_2' => $request->nik_pihak_2,
               'npwp_pihak_2' => $request->npwp_pihak_2,
          ]);
          $row = Permohonan::findOrFail($request->id_val_master);
          $row->update([
               'status' => 'DOKUMENTASI'
          ]);

          $dataMaster = Permohonan::where('id_master', $request->id_val_master)->first();

          $logData = [];
          $logData['activity'] = 'Tambah Validasi Data';
          $logData['master_data'] = json_encode($dataMaster);
          $logData['username'] = (Session::get('user'))->data[0]->nama_login;
          LogModel::create($logData);



          return Redirect::to("proses/" . $request->id_val_master . "/proses")->with('success_message', 'Berhasil Input Form Evaluasi!');
     }
     public function bapi(Request $request)
     {
          $data = $request->all();
          $data['saksi'] = implode(",", $request->saksi);
          $bapi = Bapi::create($data);
          $rows = Permohonan::where('id_master', $data['id_val_master'])->first();
          $rows->update(['status' => 'BA & PI']);
          return Redirect::to("proses/" . $request->id_val_master . "/proses")->with('success_message', 'Berhasil Input Form Evaluasi!');
     }

     public function upload_validasi(Request $request, $id)
     {
          $row = Permohonan::findOrFail($id);
          $rows = Validasi::where('id_val_master', $row->id_master)->first();

          if ($request->file('evaluasi_file')) {
               $file = $request->file('evaluasi_file');
               $filename = $file->getClientOriginalName();
               $evaluasi_file = $request->file('evaluasi_file')->store('evaluasi_file');
               $a = $evaluasi_file;
          }
          $rows->update(['file_val' => $a]);
          return redirect()->back()->with('success_message', 'Berhasil Upload Dokumentasi !');
     }
     public function upload_bapi(Request $request, $id)
     {
          $row = Permohonan::findOrFail($id);
          $rows = Bapi::where('id_val_master', $row->id_master)->first();
          if ($request->file('file_bapi')) {
               $file = $request->file('file_bapi');
               $filename = $file->getClientOriginalName();
               $bapi_file = $request->file('file_bapi')->store('file_bapi');
               $a = $bapi_file;
          }
          $rows->update(['file_ba' => $a]);
          return redirect()->back()->with('success_message', 'Berhasil Upload File BA & PI!');
     }
     public function edit_evaluasi($id)
     {

          $rows1 = Permohonan::findOrFail($id);
          $unit = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $dalok = Dalok::where([["id_unit", $rows1->id_unit_master], ["tahun", date('Y')]])->first();

          $row = Unit::all();
          $rows = Validasi::where('id_val_master', $id)->first();
          $rows2 = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $c = Permohonan::where('id_master', $rows1->id_master)->first();
          $bapi = Bapi::where('id_val_master', $id)->first();
          $bapi['saksi'] = explode(",", $bapi->saksi);

          $rows['prop_rencana'] = explode(",", $rows->prop_rencana);
          $rows['check_judul'] = explode(",", $rows->check_judul);
          $rows['check_data_diri'] = explode(",", $rows->check_data_diri);
          $rows['surat_pernyataan'] = explode(",", $rows->surat_pernyataan);
          $rows['surat_permohonan'] = explode(",", $rows->surat_permohonan);
          $rows['surat_ket'] = explode(",", $rows->surat_ket);
          $rows['kesimpulan'] = explode(",", $rows->kesimpulan);
          

          $thn = Permohonan::where([['id_unit_master', $rows1->id_unit_master], ['status', "SELESAI"]])->whereYear('created_at', date('Y'))->get();
          // echo json_encode($rows1->id_unit_master);exit;
          // echo json_encode($thn);exit;
          $tot =  $thn->sum('nominal');
          $blmTerpakai = $dalok->dana_alokasi;
          $totAlokasi =  $dalok->dana_alokasi + $tot;

          return view('pemohon.edit_evaluasi', 
          [
               'rows' => $rows, 
               'rows1' => $rows1, 
               'rows2' => $rows2, 
               'thn' => $thn, 
               'unit' => $unit, 
               'tot' => $tot, 
               'totAlokasi' => $totAlokasi, 
               'blmTerpakai' => $blmTerpakai, 
               'c' => $c, 
               'bapi' => $bapi, 
               'dalok' => $dalok, 
               'row' => $row]);
     }
     public function edit_bapi($id)
     {
          $rows1 = Permohonan::findOrFail($id);
          $rows = Bapi::where('id_val_master', $id)->first();
          $row = Unit::all();
          $rows['saksi'] = explode(",", $rows->saksi);
          return view('pemohon.edit_bapi', ['rows' => $rows, 'row' => $row]);
     }
     public function edit($id)
     {
          $rows = Permohonan::findOrFail($id);
          $rows1 = Unit::where('id_unit', $rows->id_unit_master)->first();
          $wilayah = Wilayah::where('id_wilayah', $rows->id_wilayah)->first();
          $row = Unit::all();
          $wilayah_all = Wilayah::all();
          $rows['ruang_lingkup'] = explode(",", $rows->ruang_lingkup);
          return view('pemohon.edit', ['rows' => $rows, 'row' => $row, 'rows1' => $rows1, 'wilayah' => $wilayah, 'wilayah_all' => $wilayah_all]);
     }
     public function update_pemohon(Request $request, $id)
     {
          // echo json_encode($request->ruang_lingkup);
          // // echo $id  ;
          // exit;
          $validator = Validator::make(
               $request->all(),
               [
                    'id_unit_master' => 'required',
                    'no_surat_edoc' => 'bail|required',
                    'nama_kegiatan' => 'required|min:4|max:220',
                    'lokasi_kegiatan' => 'required|min:4|max:255',
                    'ruang_lingkup' => 'required',
                    'nominal' => 'required',
                    'ruang_lingkup' => 'required',
                    'norek' => 'required',
          
               ],
               [
                    'id_unit_master.required' => 'Mohon Pilih Unit Kantor!',
                    'no_surat_edoc.required' => 'Mohon Isi Nomor Surat!',
                    'nama_kegiatan.required' => 'Mohon isi Nama Kegiatan!',
                    'norek.required' => 'Mohon isi Nomor Rekening!',
                    'nama_kegiatan.min' => 'Nama Kegiatan minimum 4 Karakter!',
                    'nama_kegiatan.max' => 'Nama Kegiatan maximal 255 Karakter!',
                    'lokasi_kegiatan.required' => 'Mohon Isi Lokasi Kegiatan!',
                    'lokasi_kegiatan.min' => 'Lokasi Kegiatan minimum 4 Karakter!',
                    'lokasi_kegiatan.max' => 'Lokasi Kegiatan maximal 255 Karakter!',
                    'ruang_lingkup.required' => 'Mohon Ceklis Ruang Lingkup Kemitraan!',
            
                    
                    
                    'nominal.required' => 'Mohon Isi Nominal',
                    'ruang_lingkup.required' => 'Mohon Isi Ruang lingkup',
               ]
               // [
               //      'id_unit_master' => 'required',
               //      'no_surat_edoc' => 'bail|required',
               //      'nama_kegiatan' => 'required|min:4|max:220',
               //      'lokasi_kegiatan' => 'required|min:4|max:255',
               //      'ruang_lingkup' => 'required',
               //      'nominal' => 'required',
                    
               // ],
               // [
               //      'id_unit_master.required' => 'Mohon Pilih Unit Kantor!',
               //      'no_surat_edoc.required' => 'Mohon Isi Nomor Surat!',
               //      'nama_kegiatan.required' => 'Mohon isi Nama Kegiatan!',
               //      'nama_kegiatan.min' => 'Nama Kegiatan minimum 4 Karakter!',
               //      'nama_kegiatan.max' => 'Nama Kegiatan maximal 255 Karakter!',
               //      'lokasi_kegiatan.required' => 'Mohon Isi Lokasi Kegiatan!',
               //      'lokasi_kegiatan.min' => 'Lokasi Kegiatan minimum 4 Karakter!',
               //      'lokasi_kegiatan.max' => 'Lokasi Kegiatan maximal 255 Karakter!',
               //      'ruang_lingkup.required' => 'Mohon Ceklis Ruang Lingkup Kemitraan!',
                   
                  
               // ]
          );
    
          // return $validator->errors()->messages();
          // exit;
          
          
          // return redirect('pemohon')->with('success_message', 'Berhasil Edit Permohonan!');
        
     //      $data = $request->all();
     //      $data['nominal'] = str_replace('.', '', $request->nominal);
     //      // $ff = $data['nominal'];
     //      // $data['nominal'] = str_replace(',00', '', $ff);
     //      $a = Dalok::where([["id_unit", $request->id_unit_master], ["tahun", date('Y')]])->first();
     //      if (empty($a)) {
     //           return redirect()->back()->with('error_message', 'Dana alokasi Cabang ini Kosong!')->withInput($request->all());
     //      }
     //      $aa = $a['dana_alokasi'];
     //      // $b = $aa - $data['nominal'];

     //      // $data['ruang_lingkup'] = implode(",", $request->ruang_lingkup);
     //      $data['ruang_lingkup'] =$request->ruang_lingkup;
     //      $data['status'] = "NEW";
     //      $data['norek'] = $request->norek;
     //      $data['nominal'] = str_replace('.', '', $request->nominal);
          
     //      $logData = [];
     //      $logData['activity'] = 'input permohonan';
     //      $logData['master_data'] = json_encode($data);
     //      $logData['username'] = (Session::get('user'))->data[0]->nama_login;

          $rows = Permohonan::findOrFail($id);
          //$data['ruang_lingkup'] = implode(",", $request->ruang_lingkup);
          $data['ruang_lingkup'] =$request->ruang_lingkup;
          $data['nominal'] = str_replace('.', '', $request->nominal);
          $dalok = Dalok::where([["id_unit", $request->id_unit_master], ["tahun", date('Y')]])->first();
          // if (empty($dalok)) {
          //      return redirect()->back()->with('error_message', 'Dana alokasi Cabang ini Kosong!')->withInput($request->all());
          // }
          $tot = $rows->nominal + $dalok->dana_alokasi;
          // $total = $tot - $data['nominal'];
          // $dalok->update(['dana_alokasi' => $total]);
          
 
          $res = [];  

          $logData = [];
          $logData['activity'] = 'edit permohonan';
          $logData['master_data'] = json_encode($data);
          $logData['username'] = (Session::get('user'))->data[0]->nama_login;   

          if (!$validator->fails()) {
               // Permohonan::create($data);
               $rows->update($data);
               LogModel::create($logData);
               $res['rc'] = '00';
               $res['message'] = 'Berhasil Edit Data';
          }
          else {
               $res['rc'] = '01';
               $res['message'] = $validator->errors()->messages();
               // $data['validation'] = json_encode($validator->fails());
          }

         return $res;
  
     }
     public function update(Request $request)
     {
          // echo json_encode($request->surat_ket[0]);
          // echo json_encode($_POST);
          // exit();


          $valid = Validasi::where('id_val_master', $request->id_val_master)->first();
          $bapi = Bapi::where('id_val_master', $request->id_val_master)->first();
          $validator = Validator::make($request->all(), [
               'check_judul' => 'required',
               'check_jumlah' => 'required',
               'check_data_diri_1' => 'required',
               'check_data_diri_2' => 'required',
               'sasaran_prog' => 'required|min:5',
               'tujuan_prog' => 'required|min:5',
               'kesimpulan[2]' => 'min|2',
               'nama' => 'required|min:5|max:150',
               'jabatan' => 'required|max:75',
               'alamat' => 'required|min:7',
               
               'selaku' => 'required',
               'nik_pihak_2' => 'required',
               'npwp_pihak_2' => 'required',


               'nama_bank' => 'required|min:2|max:150',
               'jabatan_bank' => 'required|min:2|max:90',
               'alamat_bank' => 'required|min:7',
               'id_bapi_unit' => 'required',
               'jenis_bantuan' => 'required',
               'saksi' => 'required',
               'usulan' => 'required',
          ], [
               'check_judul.required' => 'Mohon Ceklis Nama/Judul Program Kemitraan!',
               'check_jumlah.required' => 'Mohon Ceklis Jumlah Permohonan!',
               // 'check_data_diri.required' => 'Mohon Ceklis Ketersediaan Identitas Diri!',
               'check_data_diri_1.required' => 'Mohon Ceklis Ketersediaan Identitas Diri!',
               'check_data_diri_2.required' => 'Mohon Ceklis Ketersediaan Identitas Diri!',
               'sasaran_prog.required' => 'Mohon Isi Sasaran Progam Kemitraan!',
               'tujuan_prog.required' => 'Mohon Isi Tujuan Program Kemitraan!',
               'kesimpulan[2].min' => 'Mohon Isi Kesimpulan!     ',
               'nama.required' => 'Mohon Isi Nama Penerima Manfaat',
               'nama.min' => 'Nama Penerima Manfaat minimal 5 Karakter!',
               'nama.max' => 'Nama Penerima Manfaat maximal 150 Karakter!',
               'jabatan.required' => 'Mohon Isi Jabatan Penerima Manfaat!',
               'jabatan.max' => 'Jabatan Penerima Manfaat maximal 75 Karakter!',
               'alamat.required' => 'Mohon Isi Alamat Penerima Manfaat!',
               'alamat.min' => 'Alamat Penerima Manfaat minimal 7 Karakter!',

               'selaku.required' => 'Mohon isi selaku pihak kedua ',
               'nik_pihak_2.required' => 'Mohon isi NIK Pihak kedua',
               'npwp_pihak_2.required' => 'Mohon isi NPWP Pihak kedua',
               
               'nama_bank.required' => 'Mohon Isi Nama Bank Sumut Terkait',
               'nama_bank.min' => 'Nama Bank Sumut Terkait minimal 5 Karakter!',
               'nama_bank.max' => 'Nama Bank Sumut Terkait maximal 150 Karakter!',
               'jabatan_bank.required' => 'Mohon Isi Jabatan Bank Sumut Terkait!',
               'jabatan_bank.max' => 'Jabatan Bank Sumut Terkait maximal 75 Karakter!',
               'alamat_bank.required' => 'Mohon Isi Alamat Bank Sumut Terkait!',
               'alamat_bank.min' => 'Alamat Bank Sumut Terkait minimal 7 Karakter!',
               'id_bapi_unit.required' => 'Mohon Pilih Cabang!',
               'jenis_bantuan.required' => 'Mohon Pilih Jenis Bantuan!',
               'saksi.required' => 'Mohon Isi Saksi!',
               'usulan.required' => 'Mohon Isi Usulan!',
          ]);
          if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput($request->all());
          }

          $cekIdentitas = empty($request->check_data_diri_1[0])?'Tidak':'Ya'; 

          $cekDataDiri = $cekIdentitas.',' . $request->check_data_diri_2;
  

          $valid->update([

               // 'check_judul' => $request->check_judul ? 'Ya' : 'No',
               'check_judul' => implode(",", $request->check_judul) ? implode(",", $request->check_judul)  : implode(",", ['No', 'No']),
              



               'check_jumlah' => $request->check_jumlah ? 'Ya' : 'No',
               'check_norek' => $request->check_norek ? 'Ya' : 'No',

               'check_data_diri' => $cekDataDiri,
               'sasaran_prog' => $request->sasaran_prog,
               'prop_rencana' => implode(",", $request->prop_rencana) ? implode(",", $request->prop_rencana)  : implode(",", ['No', 'No']),
               'surat_pernyataan' => implode(",", $request->surat_pernyataan) ? implode(",", $request->surat_pernyataan)  : implode(",", ['No', 'No']),
               'surat_permohonan' => implode(",", $request->surat_permohonan) ? implode(",", $request->surat_permohonan)  : implode(",", ['No', 'No']),
               'surat_ket' => implode(",", $request->surat_ket) ? implode(",", $request->surat_ket)  : implode(",", ['No', 'No']),
               'tujuan_prog' => $request->tujuan_prog,
               'id_val_master' => $request->id_val_master,
               'kesimpulan' => implode(",", $request->kesimpulan),
          ]);

          $bapi->update([

               'nama' => $request->nama,
               'jabatan' => $request->jabatan,
               'alamat' => $request->alamat,
               'nama_bank' => $request->nama_bank,
               'jabatan_bank' => $request->jabatan_bank,
               'alamat_bank' => $request->alamat_bank,
               'id_bapi_unit' => $request->id_bapi_unit,
               'jenis_bantuan' => $request->jenis_bantuan,
               'id_val_master' => $request->id_val_master,
               'saksi' => implode(',', $request->saksi),
               
               'selaku_pihak_2' => $request->selaku,
               'nik_pihak_2' => $request->nik_pihak_2,
               'npwp_pihak_2' => $request->npwp_pihak_2,


          ]);

          // return Redirect::to("proses/" . $request->id_val_master . "/proses")->with('success_message', 'Berhasil edit Evaluasi!');


          $valid = Validasi::where('id_val_master', $request->id_val_master)->first();
          $bapi = Bapi::where('id_val_master', $request->id_val_master)->first();
          $validator = Validator::make($request->all(), [
               'check_judul' => 'required',
               'check_jumlah' => 'required',
               'check_data_diri_1' => 'required',
               'check_data_diri_2' => 'required',
               'sasaran_prog' => 'required|min:5',
               'tujuan_prog' => 'required|min:5',
               'kesimpulan[2]' => 'min|2',
               'nama' => 'required|min:5|max:150',
               'jabatan' => 'required|max:75',
               'alamat' => 'required|min:7',
               'nama_bank' => 'required|min:2|max:150',
               'jabatan_bank' => 'required|min:2|max:90',
               'alamat_bank' => 'required|min:7',
               'id_bapi_unit' => 'required',
               'jenis_bantuan' => 'required',
               'saksi' => 'required',
          ], [
               'check_judul.required' => 'Mohon Ceklis Nama/Judul Program Kemitraan!',
               'check_jumlah.required' => 'Mohon Ceklis Jumlah Permohonan!',
               'check_data_diri_1.required' => 'Mohon Ceklis Ketersediaan Identitas Diri!',
               'check_data_diri_2.required' => 'Mohon Ceklis Ketersediaan Identitas Diri!',
               'sasaran_prog.required' => 'Mohon Isi Sasaran Progam Kemitraan!',
               'tujuan_prog.required' => 'Mohon Isi Tujuan Program Kemitraan!',
               'kesimpulan[2].min' => 'Mohon Isi Kesimpulan!',
               'nama.required' => 'Mohon Isi Nama Penerima Manfaat',
               'nama.min' => 'Nama Penerima Manfaat minimal 5 Karakter!',
               'nama.max' => 'Nama Penerima Manfaat maximal 150 Karakter!',
               'jabatan.required' => 'Mohon Isi Jabatan Penerima Manfaat!',
               'jabatan.max' => 'Jabatan Penerima Manfaat maximal 75 Karakter!',
               'alamat.required' => 'Mohon Isi Alamat Penerima Manfaat!',
               'alamat.min' => 'Alamat Penerima Manfaat minimal 7 Karakter!',
               'nama_bank.required' => 'Mohon Isi Nama Bank Sumut Terkait',
               'nama_bank.min' => 'Nama Bank Sumut Terkait minimal 5 Karakter!',
               'nama_bank.max' => 'Nama Bank Sumut Terkait maximal 150 Karakter!',
               'jabatan_bank.required' => 'Mohon Isi Jabatan Bank Sumut Terkait!',
               'jabatan_bank.max' => 'Jabatan Bank Sumut Terkait maximal 75 Karakter!',
               'alamat_bank.required' => 'Mohon Isi Alamat Bank Sumut Terkait!',
               'alamat_bank.min' => 'Alamat Bank Sumut Terkait minimal 7 Karakter!',
               'id_bapi_unit.required' => 'Mohon Pilih Cabang!',
               'jenis_bantuan.required' => 'Mohon Pilih Jenis Bantuan!',
               'saksi.required' => 'Mohon Isi Saksi!',
          ]);
          if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput($request->all());
          }


          $valid->update([

               // 'check_judul' => $request->check_judul ? 'Ya' : 'No',
               'check_judul' => implode(",", $request->check_judul) ? implode(",", $request->check_judul)  : implode(",", ['No', 'No']),
               'check_jumlah' => $request->check_jumlah ? 'Ya' : 'No',
               'check_norek' => $request->check_norek ? 'Ya' : 'No',
               // 'check_data_diri' => implode(",", $request->check_data_diri) ? implode(",", $request->check_data_diri)  : implode(",", ['No', 'No']),
               'check_data_diri' => $cekDataDiri,
               'sasaran_prog' => $request->sasaran_prog,
               'prop_rencana' => implode(",", $request->prop_rencana) ? implode(",", $request->prop_rencana)  : implode(",", ['No', 'No']),
               'surat_pernyataan' => implode(",", $request->surat_pernyataan) ? implode(",", $request->surat_pernyataan)  : implode(",", ['No', 'No']),
               'surat_permohonan' => implode(",", $request->surat_permohonan) ? implode(",", $request->surat_permohonan)  : implode(",", ['No', 'No']),
               'surat_ket' => implode(",", $request->surat_ket) ? implode(",", $request->surat_ket)  : implode(",", ['No', 'No']),
               'tujuan_prog' => $request->tujuan_prog,
               'id_val_master' => $request->id_val_master,
               'kesimpulan' => implode(",", $request->kesimpulan),
          ]);

          $bapi->update([

               'nama' => $request->nama,
               'jabatan' => $request->jabatan,
               'alamat' => $request->alamat,
               'nama_bank' => $request->nama_bank,
               'jabatan_bank' => $request->jabatan_bank,
               'alamat_bank' => $request->alamat_bank,
               'id_bapi_unit' => $request->id_bapi_unit,
               'jenis_bantuan' => $request->jenis_bantuan,
               'id_val_master' => $request->id_val_master,
               'saksi' => implode(',', $request->saksi),

          ]);
          $logData = [];
          $logData['activity'] = 'Edit Data Permohonan';
          $logData['master_data'] = json_encode($valid);
          $logData['username'] = (Session::get('user'))->data[0]->nama_login;
          LogModel::create($logData);


          return Redirect::to("proses/" . $request->id_val_master . "/proses")->with('success_message', 'Berhasil edit Evaluasi!');
     }

     public function update_bapi(Request $request)
     {
          $data = $request->all();
          $data['saksi'] = implode(",", $request->saksi);
          $up = Bapi::where('id_val_master', $request->id_val_master)->first();
          $up->update($data);
          return Redirect::to("proses/" . $request->id_val_master . "/proses")->with('success_message', 'Berhasil edit Pakta Integitas!');
     }

     public function destroy($id)
     {    
          $detailData = Permohonan::where('id_master', $id)->first();
          $logData = [];
          $logData['activity'] = 'Hapus Data Permohonan';
          $logData['master_data'] = json_encode($detailData);
          $logData['username'] = (Session::get('user'))->data[0]->nama_login;
          LogModel::create($logData);

          //remove archive seremonial
          File::deleteDirectory(public_path('gambar/'.'57'));
          
          Storage::deleteDirectory("backup_file_pdf"."/".$id);
          Storage::deleteDirectory("arsip_pdf"."/".$id);
          $row = Permohonan::findOrFail($id);
          $row->delete();
          return redirect('pemohon')->with('success_message', 'Berhasil Hapus Permohonan!');
     }


     public function cetak($id)
     {
          $rows1 = Permohonan::findOrFail($id);
          $rows = Validasi::where('id_val_master', $id)->first();
          $rows2 = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $rows['prop_rencana'] = explode(",", $rows->prop_rencana);
          $rows['check_judul'] = explode(",", $rows->check_judul);
          $rows['check_data_diri'] = explode(",", $rows->check_data_diri);
          $rows['surat_pernyataan'] = explode(",", $rows->surat_pernyataan);
          $rows['surat_permohonan'] = explode(",", $rows->surat_permohonan);
          $rows['surat_ket'] = explode(",", $rows->surat_ket);
          $rows['kesimpulan'] = explode(",", $rows->kesimpulan);
          $unit = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $dalok = Dalok::where([["id_unit", $rows1->id_unit_master], ["tahun", date('Y')]])->first();
          
          $bulan = $this->convertBulan(date('n'));
          $thn = Permohonan::where([['id_unit_master', $rows1->id_unit_master], ['status', "SELESAI"]])->whereYear('created_at', '2022')->get();
          
          
          $tot =  $thn->sum('nominal');

          $tot =  $thn->sum('nominal');
          $blmTerpakai = $dalok->dana_alokasi;
          $totAlokasi =  $dalok->dana_alokasi + $tot;
          $datas = [
               'rows' => $rows, 
               'rows1' => $rows1, 
               'rows2' => $rows2, 
               'thn' => $thn, 
               'unit' => $unit, 
               'dalok' => $dalok, 
               'tot' => $tot, 
               'totAlokasi' => $totAlokasi, 
               'blmTerpakai' => $blmTerpakai, 
               'nama_surat'=> SettingsModel::all(),
               'bulan'=>$bulan];

          if ($rows1->nominal < 50000000) {
               // return view('pemohon.validasi_pdf', $datas);
               // exit;


               $pdf = PDF::loadview('pemohon.validasi_pdf', $datas);
               $content = $pdf->download()->getOriginalContent();
                $storePath = "backup_file_pdf".'/' .$id. '/' . 'Kelengkapan Usulan' . '.pdf';
               Storage::put($storePath, $content);
                return $pdf->download('Memorandum Analisa.pdf');
               // return $pdf->stream();
                

          } elseif ($rows1->nominal < 100000000) {
               // return view('pemohon.validasi50-100_pdf',$datas);
               // exit;


               $pdf = PDF::loadview('pemohon.validasi50-100_pdf', $datas);
               $content = $pdf->download()->getOriginalContent();
                $storePath = "backup_file_pdf".'/' .$id. '/' . 'Kelengkapan Usulan' . '.pdf';
               Storage::put($storePath, $content);
                return $pdf->download('Memorandum Analisa.pdf');
               //  return $pdf->stream();
 
          } else {
               // return view('pemohon.validasi100_pdf', $datas);
               // exit;

               $pdf = PDF::loadview('pemohon.validasi100_pdf', $datas);
               $content = $pdf->download()->getOriginalContent();
                $storePath = "backup_file_pdf".'/' .$id. '/' . 'Kelengkapan Usulan' . '.pdf';
               Storage::put($storePath, $content);
               return $pdf->download('Memorandum Analisa.pdf');
               // return $pdf->stream();
              
          }
     }
     public function cetak_bapi($id)
     {
          $master = Permohonan::findOrFail($id);
          $validasi = Validasi::where('id_val_master', $id)->first();
          $unit = Unit::where('id_unit', $master->id_unit_master)->first();
          $bapi = Bapi::where('id_val_master', $id)->first();
          $validasi['prop_rencana'] = explode(",", $validasi->prop_rencana);
          $validasi['check_data_diri'] = explode(",", $validasi->check_data_diri);
          $validasi['surat_pernyataan'] = explode(",", $validasi->surat_pernyataan);
          $validasi['surat_permohonan'] = explode(",", $validasi->surat_permohonan);
          $validasi['surat_ket'] = explode(",", $validasi->surat_ket);
          $validasi['kesimpulan'] = explode(",", $validasi->kesimpulan);
          $bapi['saksi'] = explode(",", $bapi->saksi);
          // $wilayah = Wilayah::where('id_unit', $master->id_unit_master)->first();
          $wilayah = DB::select('SELECT * FROM t_unit where id_unit='.$master->id_unit_master)[0];
          $thn = Permohonan::where('id_unit_master', $master->id_unit_master)->whereYear('updated_at', '2022')->get();
          
          $data = ['master' => $master, 'validasi' => $validasi, 'unit' => $unit, 'bapi' => $bapi,'wilayah' => $wilayah];
          // $customPaper = array(0,0,567.00,283.80);
          
          if ($bapi->jenis_bantuan == 'barang') {
               // var_dump($wilayah);
               // exit;

               // return view('pemohon.bapibarang_pdf',  ['master' => $master, 'validasi' => $validasi, 'unit' => $unit, 'bapi' => $bapi,'wilayah' => $wilayah]);
               // exit;
               $pdf = PDF::loadview('pemohon.bapibarang_pdf',$data)->setPaper('a4', 'portrait');
               $content = $pdf->download()->getOriginalContent();
               // $storePath = $id.'/' . $unit->pemda . '/' . $master->nama_kegiatan . $master->id_master . '/' . 'Backup File PDF' . '/' . 'Berita Acara & Pakta Integritas' . '.pdf';
               $storePath = "backup_file_pdf".'/' .$id. '/' . 'Berita Acara & Pakta Integritas' . '.pdf';
               Storage::put($storePath, $content);
               return $pdf->download('Berita Acara & Pakta Integritas.pdf');
          
               // return $pdf->stream();
          } else {

               // return view('pemohon.bapi_pdf',  ['master' => $master, 'validasi' => $validasi, 'unit' => $unit, 'bapi' => $bapi,'wilayah' => $wilayah]);


               $pdf = PDF::loadview('pemohon.bapi_pdf', $data)->setPaper('a4', 'portrait');
               $content = $pdf->download()->getOriginalContent();
               // $storePath = $id.'/' . $unit->pemda . '/' . $master->nama_kegiatan . $master->id_master . '/' . 'Backup File PDF' . '/' . 'Berita Acara & Pakta Integritas' . '.pdf';
               $storePath = "backup_file_pdf".'/' .$id. '/' . 'Berita Acara & Pakta Integritas' . '.pdf';
               Storage::put($storePath, $content);
               return $pdf->download('Berita Acara & Pakta Integritas.pdf');
          
               // return $pdf->stream();
          }
     }

     public function cetak_sk($id)
     {
          $rows1 = Permohonan::findOrFail($id);
          $rows = Validasi::where('id_val_master', $id)->first();
          $rows2 = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $rows['prop_rencana'] = explode(",", $rows->prop_rencana);
          $rows['check_data_diri'] = explode(",", $rows->check_data_diri);
          $rows['surat_pernyataan'] = explode(",", $rows->surat_pernyataan);
          $rows['surat_permohonan'] = explode(",", $rows->surat_permohonan);
          $rows['surat_ket'] = explode(",", $rows->surat_ket);
          $rows['kesimpulan'] = explode(",", $rows->kesimpulan);
          $wilayah = Wilayah::where('id_wilayah', $rows1->id_wilayah)->first();
          $thn = Permohonan::where('id_unit_master', $rows1->id_unit_master)->whereYear('updated_at', '2022')->get();
          $tgl_surat = $this->tgl_indo(date('Y-m-d'));

          // echo $tgl_surat;
          // exit;
          $pdf = PDF::loadview('pemohon.surat_keputusan_pdf', 
          [
               'rows' => $rows, 
               'rows1' => $rows1, 
               'rows2' => $rows2, 
               'thn' => $thn, 
               'wilayah' => $wilayah,
               'nama_surat'=> SettingsModel::all(),
               'tgl_surat'=>$tgl_surat
          ]);
          $content = $pdf->download()->getOriginalContent();
          // $storePath = $id.'/' . $rows2->pemda . '/' . $rows1->nama_kegiatan . $rows1->id_master . '/' . 'Backup File PDF' . '/' . 'Surat Keputusan' . '.pdf';
          $storePath = "backup_file_pdf".'/' .$id. '/' . 'Surat Keputusan' . '.pdf';
          Storage::put($storePath, $content);
          return $pdf->download('Surat Keputusan Diterima.pdf');
          // return $pdf->stream();
     }

     public function cetak_skr($id)
     {
          $rows1 = Permohonan::findOrFail($id);
          $rows = Validasi::where('id_val_master', $id)->first();
          $rows2 = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $rows['prop_rencana'] = explode(",", $rows->prop_rencana);
          $rows['check_data_diri'] = explode(",", $rows->check_data_diri);
          $rows['surat_pernyataan'] = explode(",", $rows->surat_pernyataan);
          $rows['surat_permohonan'] = explode(",", $rows->surat_permohonan);
          $rows['surat_ket'] = explode(",", $rows->surat_ket);
          $rows['kesimpulan'] = explode(",", $rows->kesimpulan);
          $wilayah = Wilayah::where('id_wilayah', $rows1->id_wilayah)->first();
          $thn = Permohonan::where('id_unit_master', $rows1->id_unit_master)->whereYear('updated_at', '2022')->get();
          $tgl_surat = $this->tgl_indo(date('Y-m-d'));

          $pdf = PDF::loadview('pemohon.surat_keputusan_ditolak', 
          [
               'rows' => $rows, 
               'rows1' => $rows1, 
               'rows2' => $rows2, 
               'thn' => $thn, 
               'wilayah' => $wilayah,
               'nama_surat'=> SettingsModel::all(),
               'tgl_surat'=>$tgl_surat
          ]);
          $content = $pdf->download()->getOriginalContent();
          // $storePath = $id.'/' . $rows2->pemda . '/' . $rows1->nama_kegiatan . $rows1->id_master . '/' . 'Backup File PDF' . '/' . 'Surat Keputusan_Ditolak' . '.pdf';
          $storePath = "backup_file_pdf".'/' .$id. '/' . 'Surat Keputusan_Ditolak' . '.pdf';
          Storage::put($storePath, $content);
          return $pdf->download('Surat Keputusan Ditolak.pdf');
          // return $pdf->stream();
     }


     public function cetak_k($id)
     {
          $rows1 = Permohonan::findOrFail($id);
          $rows = Validasi::where('id_val_master', $id)->first();
          $rows2 = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $rows['prop_rencana'] = explode(",", $rows->prop_rencana);
          $rows['check_data_diri'] = explode(",", $rows->check_data_diri);
          $rows['surat_pernyataan'] = explode(",", $rows->surat_pernyataan);
          $rows['surat_permohonan'] = explode(",", $rows->surat_permohonan);
          $rows['surat_ket'] = explode(",", $rows->surat_ket);
          $bapi = Bapi::where('id_val_master', $id)->first();
          $rows['kesimpulan'] = explode(",", $rows->kesimpulan);
          $wilayah = Wilayah::where('id_wilayah', $rows1->id_wilayah)->first();
          $thn = Permohonan::where('id_unit_master', $rows1->id_unit_master)->whereYear('updated_at', '2022')->get();

          $pdf = PDF::loadview('pemohon.kwitansi', 
          ['rows' => $rows, 
          'rows1' => $rows1, 
          'rows2' => $rows2, 
          'thn' => $thn,
          'nama_surat'=>SettingsModel::all(), 
          'bapi'=>$bapi]);

          $content = $pdf->download()->getOriginalContent();
          // $storePath = $id.'/' . $rows2->pemda . '/' . $rows1->nama_kegiatan . $rows1->id_master . '/' . 'Backup File PDF' . '/' . 'Kwitansi' . '.pdf';
          $storePath = "backup_file_pdf".'/' .$id. '/' . 'Kwitansi' . '.pdf';
          Storage::put($storePath, $content);
          return $pdf->download('Kwitansi.pdf');
          // return $pdf->stream();
     }

     public function upload_file(Request $request, $id)
     {
          $row = Permohonan::findOrFail($id);
          $unit = Unit::where('id_unit', $row->id_unit_master)->first();
          $dalok = Dalok::where([["id_unit", $row->id_unit_master], ["tahun", date('Y')]])->first();
         
          
          if($dalok->dana_alokasi < $row->nominal){
               return redirect()->back()->with('error_message', 'Maaf, Nominal pengajuan anda melebihi alokasi ');
               exit;
          }else{

               if($row->is_uploaded =='1'){
                  

                    DB::raw("
                    update dana_alokasi SET dana_alokasi = dana_alokasi + ".$row->nominal." WHERE id_unit='".$row->id_unit_master."' AND tahun = ".date('Y')."' AND updated_at = ".date('Y-m-d h:i:s').";
                    update dana_alokasi SET dana_alokasi = dana_alokasi - ".$row->nominal." WHERE id_unit='".$row->id_unit_master."' AND tahun = ".date('Y')."' AND updated_at = ".date('Y-m-d h:i:s'));


               }else{

                    $potongAlokasi = $dalok->dana_alokasi - $row->nominal;
                    
                    $dalok->update(['dana_alokasi'=>$potongAlokasi]);
               }

          }

          $foto = SeremonialModel::where(['id_val_master'=>$row['id_master']])->get();

          foreach($foto as $ft){
               File::delete(public_path("gambar/".$ft->id_val_master."/".$ft->filename))."<br>"; 
               
               SeremonialModel::where('id_val_master',$ft->id_val_master)->delete();


          }


          

          if ($request->hasfile('file_seremonial')) { 
               $files = [];
               foreach ($request->file('file_seremonial') as $file) {
                   if ($file->isValid()) {
                       
                    $filename = strtotime(date('d-m-Y h:i:s')).'-'.substr(str_replace(' ','-',$file->getClientOriginalName()),10,8).'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('gambar/'.($row['id_master']) ), $filename);                    
                         SeremonialModel::create([
                              'filename'=>$filename,
                              'id_val_master'=>$row->id_master
                         ]);
                    
                         $files[] = [
                           'filename' => $filename,
                       ];

                       
                   }
               }
 
           } 

          // exit;
          if ($request->file('file_val')) {
               $file = $request->file('file_val');
               $filename = "anu_" . $file->getClientOriginalExtension();
               $storePath = "arsip_pdf"."/".$row['id_master'].'/' . 'Kelengkapan Usulan' . '.pdf';
               $a = Storage::put($storePath, file_get_contents($file));

               $file1 = $request->file('file_bapi');
               $filename1 = "anu_" . $file1->getClientOriginalExtension();
               $storePath1 ="arsip_pdf"."/". $row['id_master']. '/' . 'Berita Acara & Pakta Integritas' . '.pdf';
               $b = Storage::put($storePath1, file_get_contents($file1));


               $file2 = $request->file('file_sk');
               $filename2 = "anu_" . $file2->getClientOriginalExtension();
               $storePath2 = "arsip_pdf"."/". $row['id_master'].'/' . 'Surat Keputusan' . '.pdf';
               $c = Storage::put($storePath2, file_get_contents($file2));
          }

          $row->update([
               'file_val' => $storePath,
               'file_bapi' => $storePath1,
               'file_sk' => $storePath2,
               'status' => 'SELESAI',
               'is_uploaded' => '1'
          ]);
 
          return redirect()->back()->with('success_message', 'Berhasil Upload Dokumentasi!');


     }


     public function remove_file(){
 
     }

     function tgl_indo($tanggal){
          $bulan = array (
               1 =>   'Januari',
               'Februari',
               'Maret',
               'April',
               'Mei',
               'Juni',
               'Juli',
               'Agustus',
               'September',
               'Oktober',
               'November',
               'Desember'
          );
          $pecahkan = explode('-', $tanggal);
          
          // variabel pecahkan 0 = tanggal
          // variabel pecahkan 1 = bulan
          // variabel pecahkan 2 = tahun
      
          return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
     }

     public function convertBulan($bulan){
          // return $bulan;
          // exit;
          $tempBulan = $bulan = array (
               'Januari',
               'Februari',
               'Maret',
               'April',
               'Mei',
               'Juni',
               'Juli',
               'Agustus',
               'September',
               'Oktober',
               'November',
               'Desember'
          );

          return $tempBulan[((int)$bulan)+1 ];
     }
     // function bulan($bulan){
     //      $bulan = array (
     //           1 =>   'Januari',
     //           'Februari',
     //           'Maret',
     //           'April',
     //           'Mei',
     //           'Juni',
     //           'Juli',
     //           'Agustus',
     //           'September',
     //           'Oktober',
     //           'November',
     //           'Desember'
     //      );
     //      $pecahkan = explode('-', $tanggal);
          
     //      // variabel pecahkan 0 = tanggal
     //      // variabel pecahkan 1 = bulan
     //      // variabel pecahkan 2 = tahun
      
     //      return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
     // }


}
