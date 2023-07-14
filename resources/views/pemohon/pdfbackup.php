


<div style="border:1px;border-style: solid;height: auto;" class="pt-3" >  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<!-- <p class="text-start">Start aligned text on all viewport sizes.</p>
<p class="text-center">Center aligned text on all viewport sizes.</p> -->
<p class="text-end" style="font-size: 13px">Lampiran 9SE </br>No. /Dir/SP-CSR/SE/2022</p>

<div style="background-color: #a5a5a5;border:1px;border-style: solid;height: auto; width: auto;" class="pt-5">
<p style="text-align: center;font-size: 22px;"><b>MEMORANDUM ANALISA
</br>PROGRAM PENYALURAN PROGRAM KEMITRAAN BANK SUMUT</b></p>
<p style="text-align: center;">Nomor : &hellip;.&hellip;..&hellip;..&hellip;..&hellip;..&hellip;..&hellip;..</p>
<p style="text-align: right;">Prov/Kab/Kota : &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;...&hellip;.</p>
</div>

<ol style="list-style-type: upper-roman;" class="mt-4">
    <li style="font-weight: bold;"><strong><u>KETERANGAN USULAN PROGRAM KEMITRAAN</u></strong></li>
</ol>
<ol style="margin-left: 40px;">
    <li style="text-align: left; line-height: 1.5;">Data usulan Program Kemitraan
                   <table>
                    <tbody>

  <tr>
                            <td >a. Pemerintah Daerah</td>
                            <td >
                                :
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pemerintah Prov/Kab/Kota ------------------------</td>
       
</tr>            
                        <tr>
                            <td >b. Nama Kegiatan</td>
                            <td >
                                :
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        </tr>
                        <tr>
                            <td >c. Lokasi Kegiatan</td>
                            <td >
                                :
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        </tr>
                        <tr>
                            <td >d. Nominal</td>
                            <td >
                                :
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp-------------(terbilang --------------------------) </td>
                        </tr>
                        <tr>
                            <td>e. Ruang Lingkup Program Kemitraan</td>
                            <td>:</td>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>f. Alokasi Anggaran Program Kemitraan</td>
                            <td>
                                :
                            </td>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td >g. Sisa Dana Program Kemitraan</td>
                            <td >
                                :                            </td>
                            <td><br></td>
                        </tr>
          
        </tbody>
      </table>


    </li>
    <li style="line-height: 1.5;" class="mt-4">Check List Kelengkapan Administratif</li>
</ol>
<table>
<tr>
  <td><input class="form-check-input-sm" type="checkbox" value="Ya" aria-label="Checkbox for following text input" name="prop_rencana[]"> Proposal Rencana Kegiatan dan Pengguanan Dana </td>
<td> : </td>
<td> 
</td>
</tr>
<tr>
<td>   <input class="form-check-input-sm @error('check_judul') is-invalid @enderror" type="checkbox" value="Ya" aria-label="Checkbox for following text input" name="check_judul" id="exampleInputName"> Nama / Judul Program Kemitraan</br>

</td>
</tr>
<tr>
  <td>
   <input class="form-check-input-sm @error('check_jumlah') is-invalid @enderror" type="checkbox" value="Ya" aria-label="Checkbox for following text input" name="check_jumlah"> Jumlah Permohonan</br>

</td>
</tr>
<tr>
  <td>
   <input class="form-check-input-sm @error('check_norek') is-invalid @enderror" type="checkbox" value="Ya" aria-label="Checkbox for following text input" name="check_norek"> No. Rekening Tabungan</br>

</td>
</tr>
   <tr>
<td>
   <input class="form-check-input-sm" type="checkbox" value="Ya" aria-label="Checkbox for following text input" name="surat_pernyataan[]"> Surat Pernyataan Asli Bahwa Program Kemitraan </br>tidak ditampung dalam APBD /APBN </td>
<td> : </td>
<td><input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="surat_pernyataan[]" value="{{ old('surat_pernyataan[]') }}"> 

</td>
</tr>
<tr>
<td>
   <input class="form-check-input-sm" type="checkbox" value="Ya" aria-label="Checkbox for following text input" name="surat_permohonan[]"> Surat Permohonan Pemerintah Daerah
</td>
<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
<td> </td>   
</tr>   
<tr>
  <td><h5><b>Khusus untuk Bantuan yang bersifat </br>Individu / Kelompok turut disertakan</b></h5></td>
</tr>
<tr>
<td>
   <input class="form-check-input-sm @error('check_data_diri') is-invalid @enderror" type="checkbox" value="Ya" aria-label="Checkbox for following text input" name="check_data_diri[]"> Identitas Diri KTP / SIM / Paspor / Kartu Keluarga
</td>
<td>: </td>
<td> terlampir
   tidak terlampir </td>   
</tr>   
   <tr>
<td>
   <input class="form-check-input-sm" type="checkbox" value="Ya" aria-label="Checkbox for following text input" name="surat_ket[]"> Surat Keterangan dari Dinas / Kelurahan / Yayasan </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sekolah Terkait / Lainnya </td>
<td> : </td>
<td></td>
</tr>
</table>
<h4>3. Sasaran Program Kemitraan</h4>

<h4 class="mt-3">4. Tujuan Program Kemitraan</h4>
<table>
  <tr>
    <td> Bagi Pemerintah Provinsi / Kabupaten / Kota {{$rows->lokasi_kegiatan}} </td>
</tr>
</table>
</table>
<h4 class="mt-3">5. Program Kemitraan Diambil dari Realisasi</h4>
</div>
  </div>
  <div class="tab-pane fade text-dark" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
        <div class="container mt-3">
<h4 align="center"> <b> <ins>II. KESIMPULAN DAN SARAN</ins></b></h4>

<h4> Kesimpulan </h4>
<p> Berdasarkan data-data sebelumnya diperoleh kesimpulan sebagai berikut.</p>
<ol type="A">
<li>Sasaran Program</li>
  <input type="text" class="form-control order mt-2 @error('kesimpulan') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="kesimpulan[]" value="{{ old('kesimpulan[]') }}" required>
@error('kesimpulan') 
<span class="text-danger">{{$message}}</span> 
@enderror       
<li>Tujuan Program</li>
  <input type="text" class="form-control order mt-2 @error('kesimpulan') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="kesimpulan[]" value="{{ old('kesimpulan[]') }}" required>
@error('kesimpulan') 
<span class="text-danger">{{$message}}</span> 
@enderror         
<li>Kelengkapan Administratif</li>
  <input type="text" class="form-control order mt-2 @error('kesimpulan') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="kesimpulan[]" value="{{ old('kesimpulan[]') }}" required>
@error('kesimpulan') 
<span class="text-danger">{{$message}}</span> 
@enderror       
  </ol>
            <div class="mb-3">
                <input type="submit" class="btn btn-success" value="Submit">
            </div>
  </div>

<p><br></p>
<p><br></p>
</div>