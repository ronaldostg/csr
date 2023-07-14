<?php

namespace App\Http\Controllers;

use App\Models\SettingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{
    //

    public function index()
    {
        $dataSetting = SettingsModel::all();

        // return $dataSetting[0]['id'];

        return view('setting.index', ['dataSetting' => $dataSetting]);
    }

    public function edit(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'nama_analis' => 'required',
                'nama_supervisi' => 'required',
                'jabatan_supervisi' => 'required',
                'nama_mengetahui' => 'required',
                'jabatan_mengetahui' => 'required',
            ],
            [
                'nama_analis.required '=>' Mohon Isi Nama Analis',
                'nama_supervisi.required '=>' Mohon Isi Nama Supervisi',
                'jabatan_supervisi.required '=>' Mohon Isi Jabatan Supervisi',
                'nama_mengetahui.required '=>' Mohon Isi Nama Mengetahui',
                'jabatan_mengetahui.required '=>' Mohon Isi Jabatan Mengetahui',
            ]
        );

        if (!$validator->fails()) {


            $dataAnalis = $request->nama_analis;

            $dataSupervisi = implode(',', [$request->nama_supervisi, $request->jabatan_supervisi]);
            $dataMengetahui = implode(',', [$request->nama_mengetahui, $request->jabatan_mengetahui]);


            $editAnalis = SettingsModel::where('id', '1')->update(['value_setting' => $dataAnalis]);
            $editSupervisi = SettingsModel::where('id', '2')->update(['value_setting' => $dataSupervisi]);
            $editMengetahui = SettingsModel::where('id', '3')->update(['value_setting' => $dataMengetahui]);
            
            return Redirect::to("/settings")->with('success_message', 'Berhasil Edit Master Surat!');


        } else {
            return redirect()->back()->withErrors($validator)->withInput($request->all());

            
        }
    }
}
