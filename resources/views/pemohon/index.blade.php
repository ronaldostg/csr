@extends('adminlte::page')

@section('title', 'Data Permohonan')

@section('content_header')
<h1 class="m-0 text-dark">Data Permohonan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <a href="{{route('pemohon.create')}}" class="btn btn-success mb-3">
                    Tambah Data Permohonan
                </a>

                <table class="table table-hover table-bordered table-stripped table-responsive-xxl" id="example2">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>No Surat Permohonan </th>
                            <th>Program</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $key => $row)
                        <tr class="text-center">
                            <td>{{$key+1}}</td>
                            <td>{{ $row->no_surat_edoc }}</td>
                            <td>{{ $row->nama_kegiatan }}</td>
                            <td>Rp.{{ number_format($row->nominal,2,',','.'); }},-</td>
                            <td>
                                <font color="green"><b>{{ $row->status }}</b></font>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="{{ url('proses/' . $row->id_master . '/proses') }}"
                                        class="btn btn-success btn-l mx-1">
                                        Proses
                                    </a>

                                    <a href="{{ url('pemohon/' . $row->id_master . '/edit') }}"
                                        class="btn btn-warning btn-l mx-1">
                                        Edit
                                    </a>

                                    <form action="{{ url('pemohon/' . $row->id_master) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-l mx-1" onclick="return confirm('Yakin untuk menghapus data ini ?')" >Hapus</button>
                                    </form>
                                </div>
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