@extends('adminlte::page')

@section('title', 'Proses Validasi')

@section('content_header')
<h1 class="m-0 text-dark">CSR Pemerintah {{ $unit->pemda }}</h1>
<h5>
    Rp<?= number_format($rows->nominal, 2, ',', '.') ?>,-
</h5>
<button onclick="goBack()" class="btn btn-danger ">Kembali</button>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card ">
            <div class="card-body h-auto d-inline-block">
                <!-- END OPEN DIV -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active text-dark" id="nav-home-tab" data-toggle="tab"
                            href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Keterangan
                            Usulan</a>
                        <a class="nav-item nav-link text-dark" id="nav-profile-tab" data-toggle="tab"
                            href="#nav-profile" role="tab" aria-controls="nav-profile"
                            aria-selected="false">Kesimpulan</a>
                        <a class="nav-item nav-link text-dark" id="nav-contact-tab" data-toggle="tab"
                            href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Pakta
                            Integritas</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="container mt-3">
                            <h4 align="center"> <b> <ins>I. KETERANGAN USULAN PROGRAM KEMITRAAN</ins></b></h4>

                            <h4 class="mt-4"> 1. Data Usulan Program Kemitraan </h4>
                            <table>
                                <tr>
                                    <td> a. Pemerintah Daerah</td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$unit->pemda}}</td>
                                </tr>
                                <tr>
                                    <td> b. Nama Kegiatan</td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$rows->nama_kegiatan}} </td>
                                </tr>
                                <tr>
                                    <td> c. Lokasi Kegiatan</td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$rows->lokasi_kegiatan}}</td>
                                </tr>
                                <tr>
                                    <td> d. Nominal</td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp<?= number_format($rows->nominal, 2, ',', '.') ?>,-
                                        terbilang ({{Riskihajar\Terbilang\Facades\Terbilang::make($rows->nominal)}} rupiah)
                                    </td>
                                </tr>
                                <tr>
                                    <td> e. Ruang Lingkup Program Kemitraan </td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$rows->ruang_lingkup}}</td>
                                </tr>
                                <tr>
                                    <td> f. Alokasi Anggaran Program Kemitraan </td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pemerintah {{$unit->pemda}}</td>
                                </tr>
                                <tr>
                                    <td> g. Dana Program Kemitraan yang belum terpakai</td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp<?= number_format($dalok->dana_alokasi, 2, ',', '.')  ?>,-
                                        terbilang ({{Riskihajar\Terbilang\Facades\Terbilang::make($dalok->dana_alokasi)}} rupiah)
                                    </td>
                                </tr>
                            </table>

                            <form action="{{ url('/valid') }}" method="POST">
                                @csrf
                                <h4 class="mt-2"> 2. Check List Kelengkapan Administratif </h4>
                                <table>
                                    <tr>
                                        <td><input class="form-check-input-sm " type="checkbox" value="Ya"
                                                aria-label="Checkbox for following text input" name="prop_rencana[]"
                                                {{(old('prop_rencana.0') =='Ya' ) ? 'checked' : ''}}>
                                            Proposal Rencana Kegiatan dan Penggunaan Dana </td>
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                        <td style="width: 50%; max-width:100px"><input type="text" class="form-control" aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-sm" name="prop_rencana[]"
                                                value="{{ old('prop_rencana.1') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <input
                                                class="form-check-input-sm @error('check_judul') is-invalid @enderror"
                                                type="checkbox" value="Ya"
                                                aria-label="Checkbox for following text input" name="check_judul[]"
                                                id="exampleInputName" {{(old('check_judul.0') =='Ya' ) ? 'checked' : ''}}>
                                            Nama / Judul Program Kemitraan
                                            </br>
                                            @error('check_judul')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror

                                        </td>
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                        <td style="width: 50%; max-width:100px">
                                            <input type="text" class="form-control" aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-sm" name="check_judul[]"
                                                value="{{ old('check_judul.1') }}">
                                        </td>
                                        
                                        {{-- <td style="width: 50%; max-width:100px"><input type="text" class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" name="prop_rencana[]"
                                            value="{{ old('prop_rencana.1') }}">
                                        </td> --}}
                                    </tr>
                                    <tr>
                                        <td>
                                            <input
                                                class="form-check-input-sm @error('check_jumlah') is-invalid @enderror"
                                                type="checkbox" value="Ya"
                                                aria-label="Checkbox for following text input" name="check_jumlah"
                                                {{(old('check_jumlah') =='Ya' ) ? 'checked' : ''}}>
                                            Jumlah Permohonan</br>
                                            @error('check_jumlah')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </td>
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                        <td>Rp. {{ number_format($rows->nominal, 0, ',', '.'); }},- terbilang ({{Riskihajar\Terbilang\Facades\Terbilang::make($rows->nominal)}} rupiah)</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input
                                                class="form-check-input-sm @error('check_norek') is-invalid @enderror"
                                                type="checkbox" value="Ya"
                                                aria-label="Checkbox for following text input" name="check_norek"
                                                {{(old('check_norek') =='Ya' ) ? 'checked' : ''}}> No.
                                            Rekening Tabungan</br>
                                            @error('check_norek')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </td>
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                        <td> {{ $rows->norek}}  </td>
                                    
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input-sm" type="checkbox" value="Ya"
                                                aria-label="Checkbox for following text input" name="surat_pernyataan[]"
                                                {{(old('surat_pernyataan.0') =='Ya' ) ? 'checked' : ''}}> Surat
                                            Pernyataan Asli Bahwa Program Kemitraan
                                            </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tidak ditampung dalam APBD /APBN
                                        </td>
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: No.</td>
                                        <td><input type="text" class="form-control" aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-sm" name="surat_pernyataan[]"
                                                value="{{ old('surat_pernyataan.1') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input-sm" type="checkbox" value="Ya"
                                                aria-label="Checkbox for following text input" name="surat_permohonan[]"
                                                {{(old('surat_permohonan.0') =='Ya' ) ? 'checked' : ''}}> Surat
                                            Permohonan Pemerintah Daerah
                                        </td>
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: No.</td>
                                        <td><input type="text" class="form-control" aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-sm" name="surat_permohonan[]"
                                                value="{{ old('surat_permohonan.1') }}"> </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5><b>Khusus untuk Bantuan yang bersifat </br>Individu / Kelompok turut
                                                    disertakan</b></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input
                                                class="form-check-input-sm @error('check_data_diri') is-invalid @enderror"
                                                type="checkbox" value="Ya"
                                                aria-label="Checkbox for following text input" name="check_data_diri_1[]"
                                                {{(old('check_data_diri.1') =='Ya' ) ? 'checked' : ''}}>
                                            Identitas Diri KTP / SIM / Paspor / Kartu Keluarga
                                            @error('check_data_diri')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </td>
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                                   
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <input class="form-check-input" type="radio" value="Terlampir" aria-label="Checkbox for following text input" name="check_data_diri_2"> Terlampir
                                                    
                                                </div>
                                                <div class="col">
                                                    <input class="form-check-input" type="radio" value="Tidak Terlampir" aria-label="Checkbox for following text input" name="check_data_diri_2"> Tidak Terlampir
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input-sm" type="checkbox" value="Ya"
                                                aria-label="Checkbox for following text input" name="surat_ket[]"
                                                {{(old('surat_ket.0') =='Ya' ) ? 'checked' : ''}}> Surat
                                            Keterangan dari Dinas / Kelurahan / Yayasan
                                            </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sekolah Terkait / Lainnya
                                        </td>
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: No.</td>
                                        <td><input type="text" class="form-control" aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-sm" name="surat_ket[]"
                                                value="{{ old('surat_ket.1') }}"> </td>
                                    </tr>
                                </table>
                                <h4>3. Sasaran Program Kemitraan</h4>
                                <textarea name="sasaran_prog"
                                    class="form-control @error('sasaran_prog') is-invalid @enderror" style="width: 100%"
                                    required id="sasaran_prog">{{old('sasaran_prog')}}</textarea>
                                @error('sasaran_prog')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <h4 class="mt-3">4. Tujuan Program Kemitraan</h4>
                                <table>
                                    <tr>
                                        <td> Bagi Pemerintah {{$unit->pemda}} </td>
                                    </tr>
                                </table>
                                <input type="text"
                                    class="form-control order mt-2 @error('tujuan_prog') is-invalid @enderror"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                    name="tujuan_prog" value="{{ old('tujuan_prog') }}">
                                @error('tujuan_prog')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                                </table>
                                <h4 class="mt-3">5. Program Kemitraan yang telah disalurkan Tahun {{date('Y')}}
                                </h4>
                                <table class="table mt-3" style="color: #232323;
          border-collapse: collapse; height: auto;">
                                    <tr style="border: 2px solid #999;
          padding: 8px 20px;">
                                        <th style="border: 2px solid #999; text-align:center;"> No.</th>
                                        <th style="border: 2px solid #999; text-align:center;"> Nama Program</th>
                                        <th style="border: 2px solid #999; text-align:center;"> Lokasi </th>
                                        <th style="border: 2px solid #999; text-align:center;"> Nominal</th>
                                        <th style="border: 2px solid #999; text-align:center;"> Keterangan</th>
                                    </tr>
                                    @foreach($thn as $key => $y)
                                    <tr style="border: 2px solid #999;
         padding: 8px 20px;">
                                        <td style="border: 2px solid #999"> {{$key+1}}</td>
                                        <td style="border: 2px solid #999">{{$y->nama_kegiatan}}</td>
                                        <td style="border: 2px solid #999"> {{$y->lokasi_kegiatan}}</td>
                                        <td style="border: 2px solid #999">Rp. {{ number_format($y->nominal, 0, ',', '.'); }},-</td>
                                        <td style="border: 2px solid #999"> {{   $y->status =='SELESAI' ? 'Sudah diproses' : ''    }}</td>
                                    </tr>
                                    @endforeach

                                    <tr style="border: 2px solid #999;
        padding: 8px 20px;">
                                        <td colspan="3" class="text-center" style="border: 2px solid #999;"><b>TOTAL REALISASI</b></td>
                                        <td style="text-align:center;"><b>Rp.{{ number_format($tot, 0, ',', '.'); }},-</b></td>
                                        <td> </td>
                                    </tr>
                                    <tr style="border: 2px solid #999;
        padding: 8px 20px;">
                                        <td colspan="3" class="text-center" style="border: 2px solid #999;"><b>TOTAL alokasi Pemerintah {{$unit->jns_wilayah}} {{$unit->pemda}} </b></td>
                                        <td style="text-align:center;"><b>Rp.{{ number_format($totAlokasi, 0, ',', '.'); }},-</b></td>
                                        <td> </td>
                                    </tr>
                                    <tr style="border: 2px solid #999;
        padding: 8px 20px;">
                                        <td colspan="3" class="text-center" style="border: 2px solid #999;"><b>SISA ALOKASI</b></td>
                                        <td style="text-align:center;"><b>Rp.{{ number_format($blmTerpakai, 0, ',', '.'); }},-</b></td>
                                        <td> </td>
                                    </tr>
                                </table>
                        </div>
                    </div>

                    <!-- tab kesimpulan -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="container mt-3">
                            <h4 align="center"> <b> <ins>II. KESIMPULAN DAN SARAN</ins></b></h4>

                            <h4> Kesimpulan </h4>
                            <p> Berdasarkan data-data sebelumnya diperoleh kesimpulan sebagai berikut.</p>
                            <ol type="A">
                                <li>Sasaran Program</li>
                                <input type="text"
                                    class="form-control order mt-2 @error('kesimpulan[]') is-invalid @enderror"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                    name="kesimpulan[]" value="{{ old('kesimpulan.0') }}">
                                @error('kesimpulan[]')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <li>Tujuan Program</li>
                                <input type="text"
                                    class="form-control order mt-2 @error('kesimpulan[]') is-invalid @enderror"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                    name="kesimpulan[]" value="{{ old('kesimpulan.1') }}">
                                @error('kesimpulan[]')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <li>Kelengkapan Administratif</li>
                                <input type="text"
                                    class="form-control order mt-2 @error('kesimpulan[]') is-invalid @enderror"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                    name="kesimpulan[]" value="{{ old('kesimpulan.2') }}">
                                @error('kesimpulan[]')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </ol>
                            <div class="my-3">
                                <h4> Usulan </h4>
                                <div class="form-group">
                                    <textarea type="text" name="usulan" 
                                    class="form-control @error('usulan') is-invalid @enderror"">{{ $usulan }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- tab kesimpulan -->
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="container mt-3">
                            <h4 align="center"> <b> <ins>III. Form Pakta Intregitas</ins></b></h4>

                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <tr>
                                        <td><label for="exampleInputName">YB) : Pihak Kedua (Penerima Manfaat / <br/>Panitia Program)*</label></td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    id="jabatan" placeholder="Nama Penerima Manfaat" name="nama"
                                                    value="{{old('nama')}}" required>
                                                @error('nama') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Jabatan</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('jabatan') is-invalid @enderror"
                                                    id="jabatan" placeholder="Jabatan Penerima Manfaat" name="jabatan"
                                                    value="{{old('jabatan')}}" required>
                                                @error('jabatan') <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('alamat') is-invalid @enderror"
                                                    id="alamat" placeholder="Alamat Penerima Manfaat" name="alamat"
                                                    value="{{old('alamat')}}" required>
                                                @error('alamat') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('nik_pihak_2') is-invalid @enderror"
                                                    id="nik_pihak_2" placeholder="NIK Pihak Kedua" name="nik_pihak_2"
                                                    value="{{old('nik_pihak_2')}}" required>
                                                @error('nik_pihak_2') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NPWP</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('npwp_pihak_2') is-invalid @enderror"
                                                    id="npwp_pihak_2" placeholder="NPWP Pihak Kedua" name="npwp_pihak_2"
                                                    value="{{old('npwp_pihak_2')}}" required>
                                                @error('npwp_pihak_2') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Selaku</td>
                                        <td>:</td>
                                        <td>
                                            <select class="form-control @error('selaku') is-invalid @enderror"
                                                aria-label="Default select example" "
                                                name="selaku">
                                                <option value="">
                                                    --Pilih--</option>>

                                                <option value="Penerima Manfaat" @if (old("selaku")=="Penerima Manfaat" ) selected
                                                    @endif>Penerima Manfaat
                                                </option>
                                                <option value="Panitia Program" @if (old("selaku")=="Panitia Program" ) selected
                                                    @endif>
                                                    Panitia Program
                                                </option>

                                            </select>
                                            @error('selaku') <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="exampleInputName">YB) : Pt Bank Sumut terkait*</label></td>
                                    </tr>

                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('nama_bank') is-invalid @enderror"
                                                    id="nama_bank" placeholder="Nama Pihak Terkait" name="nama_bank"
                                                    value="{{old('nama_bank')}}" required>
                                                @error('nama_bank') <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Jabatan</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('jabatan_bank') is-invalid @enderror"
                                                    id="jabatan_bank" placeholder="Jabatan Pihak Terkait"
                                                    name="jabatan_bank" value="{{old('jabatan_bank')}}" required>
                                                @error('jabatan_bank') <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('alamat_bank') is-invalid @enderror"
                                                    id="alamat_bank" placeholder="Alamat Pihak Terkait"
                                                    name="alamat_bank" value="{{old('alamat_bank')}}" required>
                                                @error('alamat_bank') <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cabang</td>
                                        <td>:</td>
                                        <td>
                                            <select
                                                class="form-control select2 @error('id_bapi_unit') is-invalid @enderror"
                                                style="width: 100%;" aria-label="Default select example" id="unit"
                                                name="id_bapi_unit">

                                                <option value=""> --Pilih--</option>>
                                                @foreach ($row as $rows)

                                                <option value="{{  $rows->id_unit }}"
                                                    {{(old("id_bapi_unit") == $rows->id_unit ? "selected" : '')}}>
                                                    {{$rows->nama_unit}}
                                                </option>


                                                @endforeach
                                            </select>
                                            @error('id_bapi_unit') <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><b><label for="exampleInputName">Terkait*</label></b></td>
                                    </tr>

                                    <tr>
                                        <td>Jenis Bantuan</td>
                                        <td>:</td>
                                        <td>
                                            <select class="form-control @error('jenis_bantuan') is-invalid @enderror"
                                                aria-label="Default select example" id="jenis_bantuan"
                                                name="jenis_bantuan">
                                                <option value="">
                                                    --Pilih--</option>>

                                                <option value="barang" @if (old("jenis_bantuan")=="barang" ) selected
                                                    @endif>Barang
                                                </option>
                                                <option value="dana" @if (old("jenis_bantuan")=="dana" ) selected
                                                    @endif>
                                                    Dana
                                                </option>

                                            </select>
                                            @error('jenis_bantuan') <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><b><label for="exampleInputName">Saksi 1*</label></b></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Saksi 1</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('saksi') is-invalid @enderror"
                                                    id="saksi1" placeholder="Nama Saksi 1" name="saksi[]"
                                                    value="{{old('saksi.0')}}" required>
                                                @error('saksi') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Jabatan</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('saksi') is-invalid @enderror"
                                                    id="jabatan1" placeholder="Jabatan Saksi 1" name="saksi[]"
                                                    value="{{old('saksi.1')}}" required>
                                                @error('saksi') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><b><label for="exampleInputName">Saksi 2*</label></b></td>
                                    </tr>

                                    <tr>
                                        <td>Nama Saksi 2 </td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('saksi') is-invalid @enderror"
                                                    id="saksi2" placeholder="Nama Saksi 2" name="saksi[]"
                                                    value="{{old('saksi.2')}}" required>
                                                @error('saksi') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="id_val_master" value="{{$c->id_master}}">

                                    <tr>
                                        <td>Jabatan</td>
                                        <td>:</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('saksi') is-invalid @enderror"
                                                    id="jabatan2" placeholder="Jabatan Saksi 2" name="saksi[]"
                                                    value="{{old('saksi.3')}}" required>
                                                @error('saksi') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div><a onclick="goBack()" class="btn btn-danger ">Kembali</a></div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="mb-3">
                                                <input type="submit" class="btn btn-success" value="Submit">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>




                        </form>
                    </div>





                    <!-- CLOSE DIV -->
                </div>
            </div>
        </div>
    </div>
    @stop

    @push('js')
    <script src="/jquery/src/jquery.mask.js"></script>
    <script src="/vendor/moment/moment.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.select2').select2();
        
        $("#nik_pihak_2").on("input", function () {
            var value = $(this).val();

            //var len = max_length - $(this).val().length;
            var c = this.selectionStart,
                // r = /[^0-9]/gi,
                r = /[^0-9]/gi,
                v = $(this).val();

            if (r.test(v)) {
                $(this).val(v.replace(r, ""));
                // $(this).val(v.replace(/(\d{2})(\d{3})(\d{3})(\d{1})(\d{3})(\d{3})/, ''));
                c--;
            }
        })
        $("#npwp_pihak_2").on("input", function () {
            var value = $(this).val();

            //var len = max_length - $(this).val().length;
            var c = this.selectionStart,
                // r = /[^0-9]/gi,
                r = /[^0-9]/gi,
                v = $(this).val();

            if (r.test(v)) {
                $(this).val(v.replace(r, ""));
                // $(this).val(v.replace(/(\d{2})(\d{3})(\d{3})(\d{1})(\d{3})(\d{3})/, ''));
                c--;
            }
        })

    });

    function goBack() {
        window.history.back();
    }
    </script>
    @endpush