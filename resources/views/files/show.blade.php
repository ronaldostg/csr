@extends('adminlte::page')

@section('title', 'Archives')

@section('content_header')
<h1 class="m-0 text-dark">{{$all->nama_kegiatan}}</h1>
<h1 class="m-0 text-dark"> Rp.{{ number_format($all->nominal, 0, ',', '.'); }},-</h1>
<div class="row">
    <div class="col-md-1 offset-md-11"><button onclick="goBack()" class="btn btn-danger ">Kembali</button></div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- body -->
                <h3 class="mb-3 text-dark">Unduh File Archives</h3>
                <button type="button" class="btn btn-warning my-2" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-download"></i> Download Dokumen Arsip
                </button>
                <table class="table table-striped">
                    <tr>
                        <td><b>Nomor Surat Permohonan</b></td>
                        <td>:</td>
                        <td><b>{{$all->no_surat_edoc}}</b></td>
                        <td><b>Lokasi Kegiatan</b></td>
                        <td>:</td>
                        <td><b>{{$all->lokasi_kegiatan}}</b></td>
                    </tr>
                    <tr>
                        <td><b>Ruang Lingkup</b></td>
                        <td>:</td>
                        <td><b>{{$all->ruang_lingkup}}</b></td>
                        <td>
                            <font color="red"><b>Status Proses</b></font>
                        </td>
                        <td>
                            <font color="red">:</font>
                        </td>
                        <td>
                            <font color="red"><b>{{$all->status}}</b></font>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Kantor Cabang</b></td>
                        <td>:</td>
                        <td><b>{{$all->nama_unit}}</b></td>
                        <td><b>Tahun</b></td>
                        <td>:</td>
                        <td><b>{{date('Y')}}</b></td>
                    </tr>
                    
                </table>
               

                <div class="container mt-3">
                    <h3 class="">Seremonial</h3>
                    <div class="row my-2">
                        @foreach($foto_sere as $fs)
                            <div class="col-sm-4 col-12">
                                <img class="img-thumbnail"
                                src="{{ url('') }}/gambar/{{ $all->id_master }}/{{$fs->filename}}" alt="Card image cap">
                        
                            </div>
                        @endforeach
                    </div>
                </div>
                    


                <!-- Large modal -->
                <!-- Button trigger modal -->

               

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cetak File</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @if (empty($permohonan->file_val))
                            <div class="modal-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>
                                            <h5 style="text-align: left;">Memorandum Analisa</h5>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <font color="red"><b>BELUM DIUPLOAD</b></font>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="text-align: left;">File Berita Acara</h5>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <font color="red"><b>BELUM DIUPLOAD</b></font>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="text-align: left;">File Surat Keputusan</h5>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <font color="red"><b>BELUM DIUPLOAD</b></font>
                                        </td>
                                    </tr>
                                </table>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tr>
                            <td>
                                <h5 style="text-align: left;">Memorandum Analisa</h5>
                            </td>
                            <td>:</td>
                            <td><a class="btn btn-success btn-sm btn-block" href="{{ route('files.download_evaluasi', $all->id_master) }}">Download</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 style="text-align: left;">File Berita Acara</h5>
                            </td>
                            <td>:</td>
                            <td><a class="btn btn-success btn-sm btn-block" href="{{ route('files.download_bapi', $all->id_master) }}">Download</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 style="text-align: left;">File Surat Keputusan</h5>
                            </td>
                            <td>:</td>
                            <td><a class="btn btn-success btn-sm btn-block" href="{{ route('files.download_sk', $all->id_master) }}">Download</a>
                            </td>
                        </tr>
                    </table>
                    

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>


{{-- </div>
</div> --}}



<input type="hidden" id="id" value="{{$all->id_val_master}}">

<!-- End div -->

{{-- </div>
</div>
</div> --}}
</div>
@stop

@push('js')

<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script>
    function goBack() {
        window.history.back();
    }
    $('#example2').DataTable({
        "responsive": true
    , });

    function notificationBeforeDelete(event, el) {
        event.preventDefault();
        if (confirm('Apakah anda yakin akan menghapus data ? ')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });        

    // $('#download_evaluasi').click(function(){
    //         // var id = $("#id").val();
    //         // if (id!="") {
    //         //     let formData = new FormData();
    //         //     formData.append('id', id);

    //         //     $.ajax({
    //         //         type: 'POST',
    //         //         url: "/download_evaluasi",
    //         //         data: formData,
    //         //         cache: false,
    //         //         processData: false,
    //         //         contentType: false,
    //                 success: function (msg) {
    //                 alert("Downloaded!");
    //                 },
    //                 error: function () {
    //                     alert("Gagal!");
    //                 }
    //             });
    //         // }
    //         // });

</script>
@endpush

