  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
  </script>


  <div style="font-size: 13px;" class="m-1">

      <!-- <p class="text-start">Start aligned text on all viewport sizes.</p>
<p class="text-center">Center aligned text on all viewport sizes.</p> -->
      {{-- <p class="text-end" style="font-size: 10px">Lampiran 9SE </br>No. &nbsp;&nbsp;&nbsp;/Dir/SP-CSR/SE/2022</p> --}}

      <div style="background-color: #a5a5a5;border:1px;border-style: solid;height: auto; width: auto; padding-right:20px;" class="m-2">
        <p style="text-align: center;font-size: 15px;"><b>MEMORANDUM ANALISA
                </br>PROGRAM KEMITRAAN BANK SUMUT</b><br/>
                Nomor : &hellip;.&hellip;../SP-CSR/MM/{{ date('Y') }}<br/>
                Tanggal : &hellip;.&hellip;&hellip;.&hellip;&hellip;.&hellip;.../{{ $bulan }}/{{ date('Y') }}<br/>  
        
        </p>
            <p style="text-align: right;">{{$unit->jns_wilayah}} : {{$unit->pemda}}</p>
    </div>

      <ol style="list-style-type: upper-roman;" class="mt-4">
          <li style="font-weight: bold;"><strong><u>KETERANGAN USULAN PROGRAM KEMITRAAN</u></strong></li>
      </ol>
      <ol style="margin-left: 15px;">
          <div style="border:1px;border-style: solid; width: 290px;">1. Data usulan Program Kemitraan</div>
          <table class="mt-3">
            <tbody>

                <tr>
                    <td>a. Pemerintah Daerah</td>
                    <td>
                        :
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$unit->pemda}}</td>

                </tr>
                <tr>
                    <td>b. Nama Kegiatan</td>
                    <td>
                        :
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$rows1->nama_kegiatan}} </td>
                </tr>
                <tr>
                    <td>c. Lokasi Kegiatan</td>
                    <td>
                        :
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$rows1->lokasi_kegiatan}} </td>
                </tr>
                <tr>
                    <td>d. Nominal</td>
                    <td>
                        :
                    </td>
                    <td>
                        <div style="margin :0px 40px 0px 18px;">
                            Rp.{{ number_format($rows1->nominal, 2, ',', '.'); }},-
                            &nbsp;terbilang ({{Riskihajar\Terbilang\Facades\Terbilang::make($rows1->nominal)}} rupiah)                            
                        </div>
                    
                    </td>
                </tr>
                <tr>
                    <td>e. Ruang Lingkup Program Kemitraan</td>
                    <td>:</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$rows1->ruang_lingkup}}</td>
                </tr>
                <tr>
                    <td>f. Alokasi Anggaran Program Kemitraan</td>
                    <td>
                        :
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pemerintah {{$unit->pemda}}</td>
                </tr>
                <tr>
                    <td>g. Sisa Dana Program Kemitraan</td>
                    <td>
                        : </td>
                    
                    {{-- <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp.{{ number_format($dalok->dana_alokasi,2,',','.'); }},-
                        &nbsp; (terbilang {{Riskihajar\Terbilang\Facades\Terbilang::make($dalok->dana_alokasi)}} rupiah)
                    </td> --}}
                    <td>
                        <div style="margin :0px 40px 0px 18px;">
                            Rp.{{ number_format($dalok->dana_alokasi, 2, ',', '.'); }},-
                            &nbsp;terbilang ({{Riskihajar\Terbilang\Facades\Terbilang::make($dalok->dana_alokasi)}} rupiah)                            
                        </div>
                    
                    </td>
                </tr>

            </tbody>
        </table>

          <div style="border:1px;border-style: solid; width: 290px;margin-top: 20px"> 2. Check List Kelengkapan
              Administratif


          </div>
          <table class="mt-3">
            <tbody>
                <tr>
                    <td>
                        
                        {{-- <input class="form-check-input-sm" type="checkbox" value="Ya"
                            aria-label="Checkbox for following text input" name="prop_rencana[]"
                            {{$rows->prop_rencana[0] == 'Ya' ? 'checked' : ''}}>
                             --}}
                             {{-- <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:red"> 
                                
                             </span> --}}
                                {{-- {{$rows->prop_rencana[0] == 'Ya' ? 'V' : 'X'}} --}}

                                @if($rows->prop_rencana[0] =='Ya')
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:green"> 
                                    V
                                </span>
                                
                                @else
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:red"> 
                                    X
                                </span>
                                @endif
                            a. Proposal Rencana Kegiatan dan
                        Pengguanan Dana 
                    
                    </td>
                    <td> : </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$rows->prop_rencana[1] == 'No' ? '' : $rows->prop_rencana[1]}}
                    </td>
                </tr>
                <tr>
                    <td> 
                        {{-- <input class="form-check-input-sm" type="checkbox" value="Ya"
                            aria-label="Checkbox for following text input" name="check_judul" id="exampleInputName"
                            {{$rows->check_judul[0] == 'Ya' ? 'checked' : ''}}>b. Nama / Judul Program Kemitraan</br> --}}

                            @if($rows->check_judul[0] =='Ya')
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:green"> 
                                    V
                                </span>
                                
                                @else
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:red"> 
                                    X
                                </span>
                                @endif
                                b. Nama / Judul Program Kemitraan</br>

                    </td>
                    <td> : </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$rows->check_judul[1] == 'No' ? '' : $rows->check_judul[1]}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{-- <input class="form-check-input-sm" type="checkbox" value="Ya"
                            aria-label="Checkbox for following text input" name="check_jumlah"
                            {{$rows->check_jumlah == 'Ya' ? 'checked' : ''}}> --}}
                            @if($rows->check_jumlah =='Ya')
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:green"> 
                                    V
                                </span>
                                
                                @else
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:red"> 
                                    X
                                </span>
                                @endif
                               
                            
                            c. Jumlah Permohonan</br>

                    </td>
                </tr>
                <tr>
                    <td>
                        
                         
                            @if($rows->check_norek =='Ya')
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:green"> 
                                    V
                                </span>
                                
                                @else
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:red"> 
                                    X
                                </span>
                                @endif
                            
                            d. No. Rekening Tabungan</br>

                    </td>
                </tr>
                <tr>
                    <td>
                        {{-- <input class="form-check-input-sm" type="checkbox" value="Ya"
                            aria-label="Checkbox for following text input" name="surat_pernyataan[]"
                            {{$rows->surat_pernyataan[0] == 'Ya' ? 'checked' : ''}}>
                             --}}
                             @if($rows->surat_pernyataan[0] =='Ya')
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:green"> 
                                    V
                                </span>
                                
                                @else
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:red"> 
                                    X
                                </span>
                                @endif
                            
                            e. Surat Pernyataan Asli Bahwa
                        Program Kemitraan </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tidak ditampung dalam APBD /APBN
                    </td>
                    <td> : </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        

                        {{$rows->surat_pernyataan[1] == 'No' ? 'No. ------' : 'No.'.$rows->surat_pernyataan[1] }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{-- <input class="form-check-input-sm" type="checkbox" value="Ya"
                            aria-label="Checkbox for following text input" name="surat_permohonan[]"
                            {{$rows->surat_permohonan[0] == 'Ya' ? 'checked' : ''}}> --}}
                            
                            @if($rows->surat_permohonan[0] =='Ya')
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:green"> 
                                    V
                                </span>
                            
                            @else
                                <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:red"> 
                                    X
                                </span>
                            @endif
                            f. Surat Permohonan Pemerintah
                        Daerah
                    </td>
                    <td> : </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$rows->surat_permohonan[1] == 'No' ? 'No. ------' : 'No.'.$rows->surat_permohonan[1] }}
                    </td>
                </tr>
                <b>Khusus untuk Bantuan yang bersifat Individu / Kelompok turut disertakan</b>
                <tr>
                    <td>
                        {{-- <input class="form-check-input-sm @error('check_data_diri') is-invalid @enderror"
                            type="checkbox" value="Ya" aria-label="Checkbox for following text input"
                            name="check_data_diri[]" {{$rows->check_data_diri[0] == 'Ya' ? 'checked' : ''}}>
                             --}}
                        @if($rows->check_data_diri[0] =='Ya')
                             <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:green"> 
                                 V
                             </span>
                         
                         @else
                             <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:red"> 
                                 X
                             </span>
                         @endif
                            a.
                        Identitas Diri KTP / SIM / Paspor / Kartu Keluarga
                    </td>
                    <td>: </td>
                    <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        @if ($rows->check_data_diri[1] == 'Terlampir')
                        Terlampir
                        <del>/tidak terlampir</del>

                        @else

                        <del>
                            terlampir/</del>
                        tidak terlampir
                    </td>

                    @endif

                </tr>
                <tr>
                    <td>
                        {{-- <input class="form-check-input-sm" type="checkbox" value="Ya"
                            aria-label="Checkbox for following text input" name="surat_ket[]"
                            {{$rows->surat_ket[0] == 'Ya' ? 'checked' : ''}}>
                             --}}
                             @if($rows->surat_ket[0] =='Ya')
                             <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:green"> 
                                 V
                             </span>
                         
                         @else
                             <span style="border:1px;border-style: solid; padding:1px 1px 1px 2px; width: 3px ;position: relative; color:red"> 
                                 X
                             </span>
                         @endif
                            
                            b. Surat Keterangan dari Dinas /
                        Kelurahan / Yayasan </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sekolah Terkait / Lainnya
                    </td>
                    <td> : </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$rows->surat_ket[1] == 'No' ? 'No. ------' : 'No.'.$rows->surat_ket[1] }}
                    </td>
                </tr>
            </tbody>
        </table>

          <div style="border:1px;border-style: solid; width: 290px; margin-top: 20px" class="mt-3">3. Sasaran Program
              Kemitraan</div>
          <p class="mt-2">{{$rows->sasaran_prog}}</p>


          <div style="border:1px;border-style: solid; width: 290px; margin-top: 20px">4. Tujuan Program Kemitraan</div>
          <p class="mt-2"> Bagi Pemerintah {{$unit->pemda}} :</p>

          <p>{{$rows->tujuan_prog}}</p>


          <div style="border:1px;border-style: solid; width: 370px; margin-top: 20px" class="mt-3"> 5. Program Kemitraan
              yang telah disalurkan Tahun {{$rows2->tahun}}</div>

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
                    <td style="border: 2px solid #999"> {{ $y->status =='SELESAI' ? 'Sudah diproses' : ''    }}</td>
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

      </ol>
      <p style="margin-bottom: 100px">&nbsp;</p>

      <p style="font-weight: bold;margin-top: 80px"><strong><u>II. KESIMPULAN DAN USUL</u></strong></p>
      <h4> Kesimpulan </h4>
      <p> Berdasarkan data-data sebelumnya diperoleh kesimpulan sebagai berikut.</p>
      <ol type="A">
          <li>Sasaran Program</li>
          <p class="mt-3" style="text-align: justify;">{{$rows->kesimpulan[0]}}</p>
          <li>Tujuan Program</li>
          <p class="mt-3" style="text-align: justify;">{{$rows->kesimpulan[1]}}</p>
          <li>Kelengkapan Administratif</li>
          <p class="mt-3" style="text-align: justify;">{{$rows->kesimpulan[2]}}</p>
          <li>Budget Program Kemitraan</li>
          <p style="text-align: justify;" class="ml-2">
              Dana usulan program yang dimohon sebesar Rp.{{ number_format($rows1->nominal, 2, ',', '.'); }},-
              (terbilang {{Riskihajar\Terbilang\Facades\Terbilang::make($rows1->nominal)}} rupiah) akan direalisasikan
              dengan biaya Program Kemitraan
              tahun {{$rows2->tahun}} Alokasi Pemerintah {{$rows2->nama_pem}} dan tidak melebihi sisa dana Program
              Kemitraan tersebut.
          </p>
      </ol>
      <p class="mt-3"><u>USUL</u></p>
      <p style="text-align: justify;">
        {{ $rows->usulan }}     
    </p>
      <p style="text-align: center;margin-top: 30px">Diusulkan&nbsp;</p>
      <p style="text-align: center;">Unit CSR</p>
      <p style="text-align: center;"><br></p>
      <table class="table">
          <tr>
              {{-- <td>
                  <p style="text-align: left; margin-left: 80px;">Nama&nbsp;</p>
              </td>
              <td>
                  <p style="text-align: left; margin-left: 360px;">Nama</p><br><br><br>
              </td> --}}
          </tr>
          <tr>
              <td>
                <p style="text-align: left; margin-left: 80px; margin-top: 80px;">
                    {{ $nama_surat[0]['value_setting']}}<br/>
                    Analis
              </td>
              <td>
                  {{-- <p style="text-align: left; ">Abdul Hamid</p> --}}
                  <p style="text-align: left; margin-left: 60px; margin-top: 80px;">
                    {{ explode(',', $nama_surat[1]['value_setting'])[0]  }}<br/>
                    {{ explode(',', $nama_surat[1]['value_setting'])[1]  }}
                </p>
              </td>
          </tr>
      </table>


      <p style="text-align: left;">Keputusan Sekretaris Perusahaan:&nbsp;</p>
      <p style="text-align: left;">......................................................................&nbsp;</p>
      <p style="text-align: left;">......................................................................&nbsp;</p>
      <p style="text-align: left;">......................................................................&nbsp;</p>


  </div>