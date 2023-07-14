@extends('adminlte::page')

@section('title', 'Form Pakta Integitas')

@section('content_header')
<h1 class="m-0 text-dark">Form Pakta Integitas</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- END OPEN DIV -->
                <form action="{{ url('update_bapi') }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <tr>
                                <td><label for="exampleInputName">YB) : Penerima Manfaat*</label></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="jabatan" placeholder="Nama Penerima Manfaat" name="nama" value="{{$rows->nama}}" required>

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" placeholder="Jabatan Penerima Manfaat" name="jabatan" value="{{$rows->jabatan}}" required>

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat Penerima Manfaat" name="alamat" value="{{$rows->alamat}}" required>
                                        <input type="hidden" name="id_val_master" value="{{$rows->id_val_master}}">

                                    </div>
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
                                        <input type="text" class="form-control @error('nama_bank') is-invalid @enderror" id="nama_bank" placeholder="Nama Pihak Terkait" name="nama_bank" value="{{$rows->nama_bank}}" required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('jabatan_bank') is-invalid @enderror" id="jabatan_bank" placeholder="Jabatan Pihak Terkait" name="jabatan_bank" value="{{$rows->jabatan_bank}}" required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('alamat_bank') is-invalid @enderror" id="alamat_bank" placeholder="Alamat Pihak Terkait" name="alamat_bank" value="{{$rows->alamat_bank}}" required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Cabang</td>
                                <td>:</td>
                                <td>
                                    <select class="form-control" aria-label="Default select example" id="unit" name="id_bapi_unit">

                                        @foreach ($row as $w)
                                        @if ($w->id_unit == $rows->id_bapi_unit)
                                        <option value="{{$rows->id_bapi_unit}}" selected>{{$w->nama_unit}}</option>
                                        @endif
                                        <option value="{{  $w->id_unit }}">{{ $w->nama_unit }}</option>
                                        @endforeach
                                    </select></td>
                            </tr>


                            <tr>
                                <td><b><label for="exampleInputName">Terkait*</label></b></td>
                            </tr>

                            <tr>
                                <td>Jenis Bantuan</td>
                                <td>:</td>
                                <td>
                                    <select class="form-control" aria-label="Default select example" id="jenis_bantuan" name="jenis_bantuan">
                                        <option value="{{$rows->jenis_bantuan}}"> {{$rows->jenis_bantuan}}</option>>

                                        <option value="barang">Barang</option>
                                        <option value="dana">Dana</option>

                                    </select></td>
                            </tr>

                            <tr>
                                <td><b><label for="exampleInputName">Saksi 1*</label></b></td>
                            </tr>
                            <tr>
                                <td>Nama Saksi 1</td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control " id="saksi1" placeholder="Nama Saksi 1" name="saksi[]" value="{{$rows->saksi[0]}}" required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('saksi') is-invalid @enderror" id="jabatan1" placeholder="Jabatan Saksi 1" name="saksi[]" value="{{$rows->saksi[1]}}" required>
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
                                        <input type="text" class="form-control @error('saksi') is-invalid @enderror" id="saksi2" placeholder="Nama Saksi 2" name="saksi[]" value="{{$rows->saksi[2]}}" required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('saksi') is-invalid @enderror" id="jabatan2" placeholder="Jabatan Saksi 2" name="saksi[]" value="{{$rows->saksi[3]}}" required>
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
                </form>


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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('change', '#evaluasi_file', function() {
        $(document).ready(function() {
            var evaluasi_file = $('#evaluasi_file').prop('files')[0];
            var id = $('#id').val();

            if (id != "" && evaluasi_file != "") {
                let formData = new FormData();
                formData.append('evaluasi_file', evaluasi_file);
                formData.append('id', id);

                $.ajax({
                    type: 'POST'
                    , url: "/upload_validasi"
                    , data: formData
                    , cache: false
                    , processData: false
                    , contentType: false
                    , success: function(msg) {
                        alert("Data Berhasil Diupload!");
                    }
                    , error: function() {
                        alert("Data Gagal Diupload!");
                    }
                });
            }
        });
    });

    function close_() {
        $('#uploaded_image').html("");
    }

</script>
@endpush
