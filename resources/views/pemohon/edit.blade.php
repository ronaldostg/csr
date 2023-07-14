@extends('adminlte::page')

@section('title', 'Edit Data Permohonan')

@section('content_header')
<h1 class="m-0 text-dark">Edit Data Permohonan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- END OPEN DIV -->

                {{-- <form action="{{ url('update_pemohon/' . $rows->id_master.'/update_pemohon') }}" method="post"
                    enctype="multipart/form-data"> --}}
                <form id="form_permohonan" >
                    {{-- @method('PATCH') --}}
                    @csrf

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <tr>
                                <td><b><label for="exampleInputName">Nomor Surat Permohonan</label></b></td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control @error('no_surat_edoc') is-invalid @enderror"
                                            id="no_surat_edoc" placeholder="Nomor Surat Edoc" name="no_surat_edoc"
                                            value="{{$rows->no_surat_edoc}}" required>
                                        @error('no_surat_edoc') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                            </tr>

                            <tr>
                                <td><b><label for="exampleInputName">Unit Kantor</label></b></td>
                                <td>:</td>
                                <td>
                                    <select class="form-control select2" style="width: 100%;"
                                        aria-label="Default select example" id="unit_kantor" name="id_unit_master">
                                        <option value="{{$rows1->id_unit}}"> {{$rows1->nama_unit}}</option>>
                                        @foreach ($row as $d)
                                        <option value="{{  $d->id_unit }}">{{ $d->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><b>Alokasi / PEMKO</b></td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" value="" id="pemda" readonly>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" value="Rp.0,-" id="alokasi" readonly>
                                </td>
                            </tr>
                </form>
                <tr>
                    <td><b>Nama Kegiatan</b></td>
                    <td>:</td>
                    <td>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm" placeholder="Nama Kegiatan" name="nama_kegiatan"
                            id="nama_kegiatan"
                            value="{{$rows->nama_kegiatan}}" required>
                    </td>
                </tr>
                <tr>
                    <td><b>Lokasi Kegiatan</b></td>
                    <td>:</td>
                    <td>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm" placeholder="Lokasi Kegiatan" name="lokasi_kegiatan"
                            id="lokasi_kegiatan"
                            value="{{$rows->lokasi_kegiatan}}" required>
                    </td>
                </tr>
                <tr>
                    <td><b>No. Rekening Giro / Tabungan</b></td>
                    <td>:</td>
                    <td>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm" placeholder="N" name="norek"
                            value="{{$rows->norek}}" id="norek" required>
                    </td>
                </tr>
                <tr>
                    <td><b>Nominal</b></td>
                    <td>:</td>
                    <td>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror"
                                placeholder="Nominal" aria-label="Username" aria-describedby="basic-addon1" id="nominal"
                                name="nominal" value="{{$rows->nominal}}" required>
                        </div>
                        @error('nominal')
                        <span class="text-danger">{{'awdww'}}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><b>Ruang Lingkup Program Kemitraan</b></td>
                    <td>:</td>
                    <td>
                        {{-- <div class="row">
                            <div class="col">
                                <input class="form-check-input" type="checkbox" value="Ekonomi"
                                    aria-label="Checkbox for following text input" name="ruang_lingkup[]"
                                    {{$rows->ruang_lingkup[0] == 'Ekonomi' ? 'checked' : ''}}
                                    {{$rows->ruang_lingkup[0] == 'Ekonomi' ? 'checked' : ''}}> Ekonomi
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="checkbox" value="Pendidikan"
                                    aria-label="Checkbox for following text input" name="ruang_lingkup[]"
                                    {{$rows->ruang_lingkup[0] == 'Pendidikan' ? 'checked' : ''}}> Pendidikan
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="form-check-input" type="checkbox" value="Sosial"
                                    aria-label="Checkbox for following text input" name="ruang_lingkup[]"
                                    {{$rows->ruang_lingkup[0] == 'Sosial' ? 'checked' : ''}}> Sosial
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="checkbox" value="Lingkungan"
                                    aria-label="Checkbox for following text input" name="ruang_lingkup[]"
                                    {{$rows->ruang_lingkup[0] == 'Lingkungan' ? 'checked' : ''}}> Lingkungan
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col">
                                <input class="form-check-input" type="radio" value="Ekonomi" aria-label="Checkbox for following text input" name="ruang_lingkup" {{$rows->ruang_lingkup[0] == 'Ekonomi' ? 'checked' : ''}}> Ekonomi
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" value="Pendidikan" aria-label="Checkbox for following text input" name="ruang_lingkup" {{$rows->ruang_lingkup[0] == 'Pendidikan' ? 'checked' : ''}}> Pendidikan
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="form-check-input" type="radio" value="Sosial" aria-label="Checkbox for following text input" name="ruang_lingkup" {{$rows->ruang_lingkup[0] == 'Sosial' ? 'checked' : ''}}> Sosial
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" value="Lingkungan" aria-label="Checkbox for following text input" name="ruang_lingkup" {{$rows->ruang_lingkup[0] == 'Lingkungan' ? 'checked' : ''}}> Lingkungan
                            </div>
                        </div>

                    </td>
                </tr>
                
                <tr>
                    <td> </td>
                    <td></td>

                    <td>
                        <div class="mb-3">
                            <input type="button" class="btn btn-success" value="Kirim" id="submitButton">
                        </div>
                    </td>
                </tr>
                </table>
                </form>


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
    $("#norek").on("input", function () {
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


    $('#nominal').mask('000.000.000.000.000.000', {
        reverse: true
    });
    $('.select2').select2();
    var unitID = $(this).find(":selected").val();
    if (unitID != null) {
        $.ajax({
            type: 'GET',
            url: '/getAlok',
            data: {
                unitID: unitID
            },
            dataType: 'JSON',
            success: function(res) {
                // alert(res);
                if (res) {
                    // alert(res);
                    $('#pemda').val(res[1]);
                    $('#alokasi').val(res[0]);
                } else {
                    $("#alokasi").empty();
                    $("#pemda").empty();
                }
            }
        });
    }

    $('#submitButton').click(function() {


var alokasi = Number(
    $("#alokasi")
    .val()
    .replace(/[^0-9]+/g, "")
);
var nominal = Number(
    $("#nominal")
    .val()
    .replace(/[^0-9]+/g, "")
);
if (nominal > alokasi) {

    Swal.fire(
        'Maaf!'
        , 'Nominal yang diajukan melebihi alokasi'
        , 'error'
    )
} else {
    // console.log('aman')
    var formData = new FormData();
    formData.append('_method', "PATCH");
    formData.append('_token', $('input[name=_token]').val());
    formData.append('id_unit_master', $('#unit_kantor').val());
    formData.append('no_surat_edoc', $('#no_surat_edoc').val());
    formData.append('nama_kegiatan', $('#nama_kegiatan').val());
    formData.append('lokasi_kegiatan', $('#lokasi_kegiatan').val());
    formData.append('nominal', $('#nominal').val());
    formData.append('norek', $('#norek').val());
    formData.append('ruang_lingkup', $('input[name=ruang_lingkup]:checked').val());

    // for (const value of formData.values()) {
    // console.log(value);


    // }
    // // return false;
    var id_pemohon = "{{ $rows->id_master }}"
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
   
        url: '/update_pemohon/'+id_pemohon+'/update_pemohon'
        , type: "POST"
        , data: formData
        , cache: false
        ,contentType: false
        , processData: false
        , beforeSend: function() {
            // console.log('menunggu')
        }
        , success: function(res) {
            // console.log(res)
            // return false;

            if (res.rc == '01') {

                var listMessage = res.message;
                var resMessage = "";

                $.each(listMessage, function(i, member) {
                    // console.log(member);
                    for (var i in member) {
                 
                        resMessage += "<p>" + member[i] + "</p>";
                    }
                });
               



                Swal.fire({
                    icon: 'error',
                    title: 'Maaf...',
                    html: "<p>" + resMessage + "</p>",

                })

            } else {
                // console.log('aman');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    // html: "<p>" + res.message + "</p>",
                    html: "<p>" +"Berhasil tambah data"+"</p>",
                    allowOutsideClick: false

                }).then((result)=>{
                    if (result.isConfirmed) {
                        location.href = "/pemohon";
                    }
                })

 
            }

        }
        , error: function(
            xhr
            , ajaxOptions
            , thrownError
        ) {
            alert(
                xhr.status +
                "\n" +
                xhr.responseText +
                "\n" +
                thrownError
            );
        }
        , });
    }


});


});
$('#unit_kantor').change(function() {
    // consoole.log($(this))

    var unitID = $(this).find(":selected").val();
    if (unitID != null) {
        $.ajax({
            type: 'GET',
            url: '/getAlok',
            data: {
                unitID: unitID
            },
            dataType: 'JSON',
            success: function(res) {
                // alert(res);
                if (res) {
                    // alert(res);
                    $('#pemda').val(res[1]);
                    $('#alokasi').val(res[0]);
                } else {
                    $("#alokasi").empty();
                    $("#pemda").empty();
                }
            }
        });
    }
});
</script>
@endpush