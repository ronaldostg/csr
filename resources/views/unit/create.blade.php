@extends('adminlte::page')

@section('title', 'Create Dana Alokasi')

@section('content_header')

<h1 class="m-0 text-dark">{{$unit->pemda}}</h1>
<h5 class="mb-3 text-dark">{{$unit->nama_unit}}</h5>
<button onclick="goBack()" class="btn btn-danger ">Kembali</button>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- END OPEN DIV -->
                <h3 class="m-0 text-dark">Create Dana Alokasi</h3>
                <br><br>
                <form action="{{route('unit.store')}}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table align-middle">
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
                                                <option value="{{ $i }}" >{{ $i }}</option>
                                                @endfor
                                        </select>
                                        



                                    </div>
                            </tr>

                            <tr>
                                <td><b>Dana Alokasi</b></td>
                                <td>:</td>
                                <td>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="text"
                                            class="form-control @error('dana_alokasi') is-invalid @enderror"
                                            placeholder="Nominal" aria-label="Username" aria-describedby="basic-addon1"
                                            name="dana_alokasi" value="{{ old('dana_alokasi') }}" id="dana_alokasi"
                                            required>
                                    </div>
                                    <input type="hidden" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" name="id_unit"
                                        value="{{$unit->id_unit}}">
                                </td>
                            </tr>


                            <tr>
                                <td> </td>
                                <td></td>
                                <td></td>

                                <td>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-success" value="Tambah">
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

<!-- InputMask -->

@push('js')
<script src="/jquery/src/jquery.mask.js"></script>
<script src="/vendor/moment/moment.min.js"></script>
<script>
$(document).ready(function() {
    $('#dana_alokasi').mask('000.000.000.000.000,00', {
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