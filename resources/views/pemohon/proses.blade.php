@extends('adminlte::page')

@section('title', 'Proses Permohonan')

@section('content_header')
<h1 class="m-0 text-dark">CSR Pemerintahan {{ $unit->pemda }}</h1>
<input type="hidden" id="id" value="{{  $rows->id_master }}">
<h5>
    Rp<?= number_format($rows->nominal, 2, ',', '.') ?>,-
</h5>

@stop

@section('content')

<head>
    <style type="text/css">
    .fileUpload {
        position: relative;
        overflow: hidden;
    }

    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    </style>
</head>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- END OPEN DIV -->



                <table class="table table-bordered">
                    <?php
          $no = 0;
          $no++; ?>
                    @if ($rows->status == 'DOKUMENTASI' )
                    <tr align="center">
                        <td>No</td>
                        <td>Kegiatan</td>
                        <td colspan="2">Action</td>
                    </tr>

                    <tr align="center">
                        <td>{{$no++}}.</td>
                        <td>Memorandum Analisa</td>
                        <td rowspan="2"><a class="btn btn-success mt-3"
                                href="{{ url('edit_evaluasi/' . $rows->id_master . '/edit_evaluasi') }}">{{ __('Edit') }}</a>
                        </td>
                        <td rowspan="2">
                            <!-- Large modal -->
                            <!-- Button trigger modal -->

                            <button type="button" class="btn btn-danger mt-3" data-toggle="modal"
                                data-target="#exampleModal">
                                Cetak
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cetak File</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>
                                                        <h5 style="text-align: left;">File Memorandum Analisa</h5>
                                                    </td>
                                                    <td>:</td>
                                                    <td><a class="btn btn-danger btn-sm btn-block" target="_blank"
                                                            href="{{ url('cetak/' . $rows->id_master . '/cetak') }}">Cetak</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 style="text-align: left;">File Berita Acara</h5>
                                                    </td>
                                                    <td>:</td>
                                                    <td><a class="btn btn-danger btn-sm btn-block" target="_blank"
                                                            href="{{ url('cetak_bapi/' . $rows->id_master . '/cetak_bapi') }}">Cetak</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 style="text-align: left;">File Surat Keputusan Diterima</h5>
                                                    </td>
                                                    <td>:</td>
                                                    <td><a class="btn btn-danger btn-sm btn-block" target="_blank"
                                                            href="{{ url('cetak_sk/' . $rows->id_master . '/cetak_sk') }}">Cetak</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 style="text-align: left;">File Surat Keputusan Ditolak</h5>
                                                    </td>
                                                    <td>:</td>
                                                    <td><a class="btn btn-danger btn-sm btn-block" target="_blank"
                                                            href="{{ url('cetak_skr/' . $rows->id_master . '/cetak_skr') }}">Cetak</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 style="text-align: left;">File Kwitansi</h5>
                                                    </td>
                                                    <td>:</td>
                                                    <td><a class="btn btn-danger btn-sm btn-block" target="_blank"
                                                            href="{{ url('cetak_k/' . $rows->id_master . '/cetak_k') }}">Cetak</a>
                                                    </td>
                                                </tr>
                                            </table>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>{{$no++}}.</td>
                        <td>Berita Acara dan Pakta Integritas</td>
                    </tr>
                    <tr align="center">
                        <td>{{$no++}}.</td>
                        <td><b>Dokumentasi dan Seremonial</b></td>
                        <td colspan="2">
                            <!-- Large modal -->
                            <!-- Button trigger modal -->

                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal1">
                                Upload
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Upload File </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST"
                                            action="{{ url('upload_file/' . $rows->id_master . '/upload_file') }}"
                                            enctype="multipart/form-data">
                                            @csrf @method('PATCH')
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <p style="text-align: left;"><b>Memorandum Analisa.pdf*</b></p>
                                                    <input type="file" class="form-control-file"
                                                        name="file_val" accept="application/pdf"  required>
                                                </div>
                                                <div class="form-group">
                                                    <p style="text-align: left;"><b>File BA & PI.pdf*</b></p>
                                                    <input type="file" class="form-control-file"
                                                        name="file_bapi" accept="pdf" required>
                                                </div>
                                                <div class="form-group">
                                                    <p style="text-align: left;"><b>Surat Keputusan.pdf*</b></p>
                                                    <input type="file" class="form-control-file"
                                                        name="file_sk" accept="pdf" required>
                                                </div>
                                                <div class="form-group">
                                                    <p style="text-align: left;"><b>Foto Seremonial / Dokumentasi </b></p>
                                                    <input type="file" class="form-control-file"
                                                         name="file_seremonial[]" id="file_seremonial" multiple 
                                                        accept=".PNG,.JPG,.JPEG,.png,.jpg,.jpeg," 
                                                        required>
                                                        <div class="gallery m-3"></div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @elseif ($rows->status == 'SELESAI' )
                    <tr align="center">
                        <td>No</td>
                        <td>Kegiatan</td>
                        <td colspan="2">Action</td>
                    </tr>

                    <tr align="center">
                        <td>{{$no++}}.</td>
                        <td>Memorandum Analisa</td>
                        <td rowspan="2"><a class="btn btn-success mt-3"
                                href="{{ url('edit_evaluasi/' . $rows->id_master . '/edit_evaluasi') }}">{{ __('Edit') }}</a>
                        </td>
                        <td rowspan="2">
                            <!-- Large modal -->
                            <!-- Button trigger modal -->

                            <button type="button" class="btn btn-danger mt-3" data-toggle="modal"
                                data-target="#exampleModal">
                                Cetak
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cetak File</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>
                                                        <h5 style="text-align: left;">File Memorandum Analisa</h5>
                                                    </td>
                                                    <td>:</td>
                                                    <td><a class="btn btn-danger btn-sm btn-block"
                                                            href="{{ url('cetak/' . $rows->id_master . '/cetak') }}">Cetak</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 style="text-align: left;">File Berita Acara</h5>
                                                    </td>
                                                    <td>:</td>
                                                    <td><a class="btn btn-danger btn-sm btn-block"
                                                            href="{{ url('cetak_bapi/' . $rows->id_master . '/cetak_bapi') }}">Cetak</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 style="text-align: left;">File Surat Keputusan Diterima</h5>
                                                    </td>
                                                    <td>:</td>
                                                    <td><a class="btn btn-danger btn-sm btn-block"
                                                            href="{{ url('cetak_sk/' . $rows->id_master . '/cetak_sk') }}">Cetak</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 style="text-align: left;">File Surat Keputusan Ditolak</h5>
                                                    </td>
                                                    <td>:</td>
                                                    <td><a class="btn btn-danger btn-sm btn-block"
                                                            href="{{ url('cetak_skr/' . $rows->id_master . '/cetak_skr') }}">Cetak</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 style="text-align: left;">File Kwitansi</h5>
                                                    </td>
                                                    <td>:</td>
                                                    <td><a class="btn btn-danger btn-sm btn-block"
                                                            href="{{ url('cetak_k/' . $rows->id_master . '/cetak_k') }}">Cetak</a>
                                                    </td>
                                                </tr>
                                            </table>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>{{$no++}}.</td>
                        <td>Berita Acara dan Pakta Integritas</td>
                    </tr>
                    <tr align="center">
                        <td>{{$no++}}.</td>
                        <td><b>Dokumentasi dan Seremonial</b></td>
                        <td colspan="2">
                            <!-- Large modal -->
                            <!-- Button trigger modal -->

                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal1">
                                Upload
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Upload File </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST"
                                            action="{{ url('upload_file/' . $rows->id_master . '/upload_file') }}"
                                            enctype="multipart/form-data">
                                            @csrf @method('PATCH')
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <p style="text-align: left;"><b>Memorandum Analisa.pdf*</b></p>
                                                    <input type="file" class="form-control-file"
                                                        id="exampleFormControlFile1" name="file_val" accept="application/pdf" required>
                                                </div>
                                                <div class="form-group">
                                                    <p style="text-align: left;"><b>File BA & PI.pdf*</b></p>
                                                    <input type="file" class="form-control-file"
                                                        id="exampleFormControlFile1" name="file_bapi" accept="pdf" required>
                                                </div>
                                                <div class="form-group">
                                                    <p style="text-align: left;"><b>Surat Keputusan.pdf*</b></p>
                                                    <input type="file" class="form-control-file"
                                                        id="exampleFormControlFile1" name="file_sk" accept="pdf" required>
                                                </div>
                                                <div class="form-group">
                                                    <p style="text-align: left;"><b>Foto Seremonial / Dokumentasi</b></p>
                                                    <input type="file" class="form-control-file"
                                                         name="file_seremonial[]" id="file_seremonial" multiple 
                                                        accept=".PNG,.JPG,.JPEG,.png,.jpg,.jpeg,"
                                                        required>
                                                        <div class="gallery m-3"></div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    @else
                    <tr align="center">
                        <td>No</td>
                        <td>Kegiatan</td>
                        <td colspan="2">Action </td>
                    </tr>
                    <tr align="center">
                        <td><b>{{$no++}}.</b></td>
                        <td><b>Memorandum Analisa</b></td>
                        <td rowspan="2"><a class="btn btn-success mt-3"
                                href="{{ url('proses_validasi/' . $rows->id_master . '/proses_validasi') }}">{{ __('Proses') }}</a>
                        </td>
                        <td rowspan="2">
                            <a class="btn btn-secondary mt-3">
                                <!-- href="{{ url('cetak/' . $rows->id_master . '/cetak') }}" -->{{ __('Cetak') }}
                            </a>
                        </td>
                    </tr>
                    <tr align="center">
                        <td><b>{{$no++}}.</b></td>
                        <td><b>Berita Acara dan Pakta Integritas</b></td>
                    </tr>
                    <tr align="center">
                        <td>{{$no++}}.</td>
                        <td>Dokumentasi</td>
                        <td colspan="2"><a class="btn btn-secondary">{{ __('Upload') }}</a></td>
                    </tr>
                    @endif
                </table>
                <p></p>

                <div><a class="btn btn-danger" href="{{route('pemohon.index')}}">Kembali</a></div>



                <!-- CLOSE DIV -->
            </div>
        </div>
    </div>
</div>
@stop

@push('js')

<script>
function goBack() {
    window.history.back();
}
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//    $(document).on('change', '#evaluasi_file', function(){
	$(document).ready( function () {

        var imagesPreview = function(input, placeToInsertImagePreview) {
            let files = input.files;
            // console.log(input.files)
            console.log(files.length)
        
        
        if (input.files) {
          
          
            var filesAmount = input.files.length;

            if(filesAmount>0){

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
    
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result)
                        .css({"width": "40%", "height": "40%",})
                        .appendTo(placeToInsertImagePreview);
                    }
    
                    reader.readAsDataURL(input.files[i]);
                }
            }else{
                // console.log('kosongkan')
                $('.gallery').children('img').remove()
            }
        } 

        };

        $('#file_seremonial').on('change', function() {
        imagesPreview(this, 'div.gallery');
        });


// 			var evaluasi_file = $('#evaluasi_file').prop('files')[0];
// 			var id = $('#id').val();

// 			if (id!="" && evaluasi_file!="") {
// 		        let formData = new FormData();
// 		        formData.append('evaluasi_file', evaluasi_file);
// 		        formData.append('id', id);

// 		        $.ajax({
// 		            type: 'POST',
// 		            url: "/upload_validasi",
// 		            data: formData,
// 		            cache: false,
// 		            processData: false,
// 		            contentType: false,
// 		            success: function (msg) {
// 					alert("Data Berhasil Diupload!");
// 		            },
// 		            error: function () {
// 		                alert("Data Gagal Diupload!");
// 		            }
// 		        });
// 		    }
//         });
    });
// function close_(){
//    $('#uploaded_image').html("");
//    }
</script>
@endpush