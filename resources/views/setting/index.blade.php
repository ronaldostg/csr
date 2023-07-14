@extends('adminlte::page')

@section('title', 'Setting')

@section('content_header')
<h1 class="m-0 text-dark">Pengaturan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-8">
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
                
                <form method="post" enctype="multipart/form-data" action="edit-settings">
                    @csrf @method("POST")
                    <table class="table">

                        <thead>
                            <tr>
                            <td>No</td>  
                            <td>Option</td>  
                            <td>Field</td>  
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Analis</td>
                                <td>
                                    <div class="form-group">
                                        <label>Nama Analis</label>
                                        <input class="form-control" type="text" value="{{ $dataSetting[0]['value_setting'] }}" name="nama_analis">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Supervisi</td>
                                <td>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" type="text" name="nama_supervisi" value="{{ explode(',', $dataSetting[1]['value_setting'])[0]  }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input class="form-control" type="text" name="jabatan_supervisi" value="{{ explode(',', $dataSetting[1]['value_setting'])[1]  }}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Yang Mengetahui</td>
                                <td>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" type="text" name="nama_mengetahui" value="{{ explode(',', $dataSetting[2]['value_setting'])[0]  }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input class="form-control" type="text" name="jabatan_mengetahui" value="{{ explode(',', $dataSetting[2]['value_setting'])[1]  }}">
                                    </div>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>

                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
 
@stop

@push('js')
{{-- <form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form> --}}
<script>


</script>
@endpush

