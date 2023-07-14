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

        <form action="{{ url('/bapi') }}" method="POST">
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
<input type="text" class="form-control @error('nama') is-invalid @enderror" id="jabatan" placeholder="Nama Penerima Manfaat" name="nama" value="{{old('nama')}}" required>
@error('nama') <span class="text-danger">{{$message}}</span> @enderror
                </div>
</td>
                </tr> 

                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>
               <div class="form-group">
<input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" placeholder="Jabatan Penerima Manfaat" name="jabatan" value="{{old('jabatan')}}" required>
@error('jabatan') <span class="text-danger">{{$message}}</span> @enderror
                </div>
</td>                
                </tr> 

                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>
               <div class="form-group">
<input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat Penerima Manfaat" name="alamat" value="{{old('alamat')}}" required>
@error('alamat') <span class="text-danger">{{$message}}</span> @enderror
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
<input type="text" class="form-control @error('nama_bank') is-invalid @enderror" id="nama_bank" placeholder="Nama Pihak Terkait" name="nama_bank" value="{{old('nama_bank')}}" required>
@error('nama_bank') <span class="text-danger">{{$message}}</span> @enderror
                </div>
</td>               
                </tr> 

                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>
               <div class="form-group">
<input type="text" class="form-control @error('jabatan_bank') is-invalid @enderror" id="jabatan_bank" placeholder="Jabatan Pihak Terkait" name="jabatan_bank" value="{{old('jabatan_bank')}}" required>
@error('jabatan_bank') <span class="text-danger">{{$message}}</span> @enderror
                </div>
</td>                
                </tr> 

                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>
               <div class="form-group">
<input type="text" class="form-control @error('alamat_bank') is-invalid @enderror" id="alamat_bank" placeholder="Alamat Pihak Terkait" name="alamat_bank" value="{{old('alamat_bank')}}" required>
@error('alamat_bank') <span class="text-danger">{{$message}}</span> @enderror
                </div>
</td>                
                </tr> 

               <tr>
                    <td>Cabang</td>
                    <td>:</td>
                    <td> 
                      <select class="form-control" aria-label="Default select example" id="unit" name="id_bapi_unit">
                      <option value=""> --Pilih--</option>>
 @foreach ($row as $rows)
  <option value="{{  $rows->id_unit }}">{{  $rows->nama_unit }}</option>
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
                      <option value=""> --Pilih--</option>>

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
<input type="text" class="form-control @error('saksi') is-invalid @enderror" id="saksi1" placeholder="Nama Saksi 1" name="saksi[]" value="{{old('saksi[0]')}}" required>
@error('saksi') <span class="text-danger">{{$message}}</span> @enderror
                </div>
</td>                
                </tr> 

                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>
               <div class="form-group">
<input type="text" class="form-control @error('saksi') is-invalid @enderror" id="jabatan1" placeholder="Jabatan Saksi 1" name="saksi[]" value="{{old('saksi[1]')}}" required>
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
<input type="text" class="form-control @error('saksi') is-invalid @enderror" id="saksi2" placeholder="Nama Saksi 2" name="saksi[]" value="{{old('saksi[2]')}}" required>
@error('saksi') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                </td>
                </tr> 
<input type="hidden" name="id_val_master" value="{{$a->id_master}}">

                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>
               <div class="form-group">
<input type="text" class="form-control @error('saksi') is-invalid @enderror" id="jabatan2" placeholder="Jabatan Saksi 2" name="saksi[]" value="{{old('saksi[3]')}}" required>
@error('saksi') <span class="text-danger">{{$message}}</span> @enderror
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
   $(document).on('change', '#evaluasi_file', function(){
  $(document).ready( function () {
      var evaluasi_file = $('#evaluasi_file').prop('files')[0];
      var id = $('#id').val();
 
      if (id!="" && evaluasi_file!="") {
            let formData = new FormData();
            formData.append('evaluasi_file', evaluasi_file);
            formData.append('id', id);
 
            $.ajax({
                type: 'POST',
                url: "/upload_validasi",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (msg) {
          alert("Data Berhasil Diupload!");
                },
                error: function () {
                    alert("Data Gagal Diupload!");
                }
            });
        }
        });
    });
function close_(){
   $('#uploaded_image').html("");
   }


    </script>
@endpush