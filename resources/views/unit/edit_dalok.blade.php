@extends('adminlte::page')

@section('title', 'Detail Unit')

@section('content_header')
<h1 class="m-0 text-dark">{{$unit->nama_unit}}</h1>
<h5 class="mb-3 text-dark">Kode Cabang : {{$unit->kd_unit}}</h5>

<div class="row">
 <div class="col-md-4 offset-md-11">
  <button onclick="goBack()" class="btn btn-danger ">Kembali</button>
 </div>
</div>
</td>
</tr>
</table>
@stop

@section('content')
<div class="row">
 <div class="col-12">
  <div class="card">
   <div class="card-body">
    <!-- body -->

    <form action="{{ url('update/' . $dalok->id_alokasi) }}" method="post" enctype="multipart/form-data">
     @method('PATCH')
     @csrf
    
     <table class="table">
      <thead>
       <tr>
        <td><b><label for="exampleInputName">Tahun</label></b></td>
        <td>:</td>
        <td>
          <div class="form-group">
            <select class="form-control select2" style="width: 100%;"
                                            aria-label="Default select example" name="tahun">
                                                {{ $last= date('Y')-7 }}
                                                {{ $now = date('Y') }}
                                                @for ($i = $now; $i >= $last; $i--)
                                                <option value="{{ $i }}" @if($dalok->tahun== $i) selected @endif>{{ $i }}</option>
                                                @endfor
                                                
                                        </select>
            
            
                                        {{-- <input type="text" class="form-control @error('tahun') is-invalid @enderror"
            id="exampleInputName" name="tahun" value="{{$dalok->tahun}}" required>
            @error('tahun') <span class="text-danger">{{$message}}</span> @enderror --}}


          </div>
        </td>
       </tr>
       <tr>
        <td><b>Dana Alokasi</b></td>
        <td>:</td>
        <td>
         <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Rp</span>
          <input type="text" class="form-control @error('dana_alokasi') is-invalid @enderror" placeholder="Nominal" aria-label="Username" aria-describedby="basic-addon1" name="dana_alokasi" value="{{ $dalok->dana_alokasi}}" id="dana_alokasi" required>
         </div>
         <input type="hidden" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="id_unit" value="{{$unit->id_unit}}">
        </td>
       </tr>
      </thead>
     </table>

     <div class="row">
      <div class="col-md-1 offset-md-11">
    <input type="submit" class="btn btn-success" value="Edit">
      </div>
     </div>
     </form>     

     <!-- End div -->

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
   $('#dana_alokasi').mask('000.000.000.000.000.000', {
    reverse: true
   });
  });
  function goBack() {
   window.history.back();
  }
  $('#example2').DataTable({
   "responsive": true,
  });
 </script>
 @endpush