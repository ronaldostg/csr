@extends('adminlte::page')

@section('title', 'Laporan Realisasi')

@section('content_header')
<h1 class="m-0 text-dark">Laporan Realisasi</h1>
@stop

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">


                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">

                            <label for="tahun_laporan">Tahun</label>
                            <select class="form-control" id="tahun_laporan">
                                <option value="">---Pilih Tahun---</option>
                                @php

                                $earliest_year = 2011;
                                @endphp
                                @foreach (range(date('Y'), $earliest_year) as $x)
                                <option value={{ $x }} {{ request('tahun') == $x ? 'selected' : '' }}>
                                    {{ $x }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="nama_unit">Nama Unit</label>
                            <select class="form-control" id="id_unit">
                                <option value="">---Pilih Unit---</option>

                                @foreach($unit as $index=> $un)
                                <option value="{{ $un->id_unit }}">{{ $un->nama_unit }}</option>

                                @endforeach

                            </select>

                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group mt-4">

                            {{-- <button class="btn btn-primary mt-2" id="cari_laporan"><i class="fas fa-search"></i> Cari</button> --}}
                            <button class="btn btn-primary mt-2" onclick="laporan_real()"><i class="fas fa-search"></i> Cari</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row" id="table-report">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <a class="btn btn-success my-2" id="download_report">
                    <i class="fas fa-download"></i> Download Laporan
                </a>
                <div id="total_alokasi" class="my-2">

                    <h5>Total Alokasi : Rp. <span id="sumTotalAlokasi"></span></h5>
                </div>

                <table class="table table-hover datatatable-bordered table-stripped table-responsive-xxl" id="tbl_main">
                    <thead>
                        <tr class="text-center">
                            <th></th>
                            <th>Cabang</th>
                            <th>Pemda</th>
                            <th>Nama Program</th>
                            <th>Nominal (Rp.)</th>
                            <th>Tahun</th>
                            <th>Pilar</th>
                            <th>Nomor Surat</th>
                            <th>Nama Penerima</th>
                            <th>Alamat</th>
                            <th>No. Rekening</th>

                        </tr>
                    </thead>

                    <tbody>


                    </tbody>
                </table>





                </table>


            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script>

    $('#download_report').hide();
    $('#total_alokasi').hide();

    const urlMain = "http://127.0.0.1:8000/";


    function laporan_real() {
        // console.log('fetch')
        var tahun = $('#tahun_laporan').val();
        var unit = $('#id_unit').val();

        // var tahun = $('#tahun_laporan').val();
        // var unit = $('#id_unit').val();

        if (tahun == "" || unit == "") {
            Swal.fire({
                icon: 'error'
                , title: 'Gagal',
                // html: "<p>" + res.message + "</p>",
                html: "Mohon Isi Tahun dan Nama Unit",


            })
        } else {

            // laporan_real();
            $("#table-report").show();
            $('#download_report').show();
            $('#total_alokasi').show();
            $('#download_report').attr("href", urlMain + "download_excel?id_unit=" + unit + "&tahun=" + tahun).attr('target', '_blank')
            getAlokasi(unit, tahun)

            $('#tbl_main').DataTable({
                "scrollX":        true,
                // "emptyTable: "Data Tidak Ada"
                // buttons: [ "excel"],
                // processing: true
                // , serverSide: true
                // , serverMethod: "get"
                // , paggingType: "full_numbers",

                "responsive": true,
                "processing": true,
                "serverSide": false,
                "destroy": true,
                "pagging": false,
                "fixedColumns": {
                    leftColumns: 2,

                },

                "ajax": {
                    "url": `/api/laporan?id_unit=${unit}}&tahun=${tahun}`,
                    "error": function (xhr, error, code) {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Ada Masalah di server',
           
                        })
                    }
                },
                
                "language": {
                    processing: '<i class="fa fa-sync fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
                    emptyTable: 'Belum ada data atau tidak ditemukan',
                },

                "columns": [{
                        "data": "no"
                        , 'width': "10px"
                        , 'orderable': false
                    }
                    , {
                        "data": "nama_unit"
                        , 'orderable': true
                    }
                    , {
                        "data": "pemda"
                        , 'orderable': true
                    }
                    , {
                        "data": "nama_kegiatan"


                        , 'orderable': true
                    }
                    , {
                        "data": "nominal"
                        , 'orderable': true
                    }
                    , {
                        "data": "tahun"
                        , 'orderable': true
                    }
                    , {
                        "data": "ruang_lingkup"
                        , 'orderable': true
                    }
                    , {
                        "data": "no_surat_edoc"
                        , 'orderable': true
                    }
                    , {
                        "data": "nama"
                        , 'orderable': true
                    }
                    , {
                        "data": "lokasi_kegiatan"
                        , 'orderable': true
                    }
                    , {
                        "data": "norek"
                        , 'orderable': true
                    },

                ]


            });
        }



    }

    function getAlokasi(unit, tahun){
        $.ajax({
                // type: 'POST'
                // , url: '/pemohon'
                // , data : formData
                // , dataType: 'JSON'
                // `/api/laporan?id_unit=${unit}}&tahun=${tahun}`,
                url: `/api/laporan?id_unit=${unit}}&tahun=${tahun}`
                , type: "GET"
                // , data: 
                // , cache: false
                // , contentType: false
                // , processData: false
                , beforeSend: function() {
                    // console.log('menunggu')
                }
                , success: function(res) {
                    $('#sumTotalAlokasi').html(res.total_alokasi)
                    // console.log('hasil'+JSON.stringify(res))
                    // console.log('hasil'+JSON.stringify(res))
                }
            });
    }
    $(document).ready(function() {

        const urlMain = "http://127.0.0.1:8000/";

        $("#table-report").hide();
        var tahun = $('#tahun_laporan').val();
        var unit = $('#id_unit').val();

        // $('#download_report').DataTable({
        //     dom: 'Bfrtip'
        //     , responsive: true
        //     , buttons: [
        //         'copy', 'csv', 'excel', 'pdf', 'print'
        //     ]
        // });

        // $('#cari_laporan').on("click", function() {





        // })






    })


    function notificationBeforeDelete(event, el) {
        event.preventDefault();
        if (confirm('Apakah anda yakin akan menghapus data ? ')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }

</script>
@endpush

