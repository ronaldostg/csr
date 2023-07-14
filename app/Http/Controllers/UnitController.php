<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permohonan, Unit, Validasi, Dalok};
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use DB;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Unit::all();
        $dalok = Dalok::all();
        return view('unit.index', [
            'rows' => $rows, 'dalok' => $dalok
        ]);
    }
    public function proses()
    {
        $rows = Unit::all();

        return view('pemohon.proses', [
            'rows' => $rows
        ]);
    }
    public function create($id)
    {
        $unit = Unit::where('id_unit', $id)->first();
        $dalok = Dalok::where('id_unit', $id)->get();
        return view('unit.create', [
            'unit' => $unit, 'dalok' => $dalok
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tahun'=> 'required',
            'dana_alokasi'=> 'required',
        ], [
            'tahun.required' => 'Tahun Masih Kosong!',
            'dana_alokasi.required' => 'Dana Alokasi Masih Kosong!',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $data = $request->all();
        $data['dana_alokasi'] = str_replace('.','', $request->dana_alokasi);
        $data['created_at'] =date('d-m-y h:i:s');

        $tahun = $request->input('tahun');
        // $id_unit = request()->segment(2);
        $id_unit = request()->segment(2) =='' ? $request->id_unit : request()->segment(2) ;
        $where = [
            'tahun'=>$tahun, 
            'id_unit'=>$id_unit, 
            
        ];
        // echo json_encode($where);
        // exit();
        $cekData = Dalok::where($where)->get();
        //  echo json_encode($cekData);

        // exit();
        if(count($cekData)>0){
            //echo "sudah ditambahkan";
            return Redirect::to("unit/".$request->id_unit)->with('error_message', 'Maaf, dana alokasi sudah ditambahkan sebelumnya');
        }else{

            $dalok= Dalok::create($data);
            return Redirect::to("unit/".$request->id_unit)->with('success_message', 'Berhasil Tambah Dana Alokasi!');
        }
        exit;   
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Unit::where('id_unit', $id)->first();
        $dalok = Dalok::where('id_unit', $id)->get();
        return view('unit.show', [
            'unit' => $unit, 'dalok' => $dalok
        ]);
    }

    public function edit_dalok($id)
    {

        $dalok = Dalok::where('id_alokasi', $id)->first();
        $unit = Unit::where('id_unit', $dalok->id_unit)->first();
        return view('unit.edit_dalok', [
            'unit' => $unit, 'dalok' => $dalok
        ]);
    }    


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'tahun'=> 'required',
            'dana_alokasi'=> 'required',
        ], [
            'tahun.required' => 'Tahun Masih Kosong!',
            'dana_alokasi.required' => 'Dana Alokasi Masih Kosong!',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $data = $request->all();
        $data['dana_alokasi'] = str_replace('.','', $request->dana_alokasi);
        $dalok = Dalok::findOrFail($id);        
        $dalok->update($data);
        return Redirect::to("unit/".$request->id_unit)->with('success_message', 'Berhasil Edit Dana Alokasi!');
        // return Redirect::to(url("/unit/".$request->id_unit)->with('success_message', 'Berhasil Edit Dana Alokasi!');
    }


    public function hapus_dalok($id)
    {
        $dalok = Dalok::findOrFail($id);
        $dalok->delete();
        return Redirect::to("unit/".$dalok->id_unit)->with('success_message', 'Berhasil Hapus Dana Alokasi!');
    }
}