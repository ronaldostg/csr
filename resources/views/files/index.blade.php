@extends('adminlte::page')

@section('title', 'Archives')

@section('content_header')
<h1 class="m-0 text-dark">Data Arsip</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table class="table table-hover table-bordered table-stripped table-responsive-xl" id="example2">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Cabang</th>
                            {{-- <th>No Surat E-Doc </th> --}}
                            <th>Nama Bantuan</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>Files</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permohonan as $key => $row)
                        <tr class="text-center">
                            <td>{{$key+1}}</td>
                            <td> {{$row->nama_unit}}

                            </td>
                            {{-- <td>{{ $row->no_surat_edoc }}</td> --}}
                            <td>{{ $row->nama_kegiatan }}</td>
                            <td>Rp.{{ number_format($row->nominal, 2, ',', '.'); }},-</td>
                            <td>
                                @if($row->status == 'SELESAI')
                                    <p class="text-success font-weight-bold">SUDAH DIPROSES</p>
                                @else
                                    <p class="text-success font-weight-bold">SEDANG DIPROSES</p>
                                @endif
                                                                
                            </td>
                            <td>
                                <a href="{{ route('files.show', $row->id_master) }}" class="btn btn-success btn-l">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
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
$('#example2').DataTable({
    "responsive": true,
});

function notificationBeforeDelete(event, el) {
    event.preventDefault();
    if (confirm('Apakah anda yakin akan menghapus data ? ')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
}
</script>
@endpush