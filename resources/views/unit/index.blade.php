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
                <table class="table table-hover table-bordered table-stripped table-responsive-xl" id="example2">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Pemerintahan Daerah</th>
                            <!-- <th>Tahun</th>
                            <th>Dana Alokasi</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $key => $row)
                        <tr class="text-center">
                            <td>{{$key+1}}</td>
                            <td>{{ $row->pemda }}</td>
                            <!-- @foreach($dalok as $item)
                            @if($item->id_unit == $row->id_unit)
                            <td>{{$item->tahun}}</td>
                            <td>Rp.{{ number_format($item->dana_alokasi, 0, ',', '.'); }},-</td>
                            @else
                            <td></td>
                            <td></td>
                            @endif
                            @endforeach -->
                            <td>
                                <a href="{{ route('unit.show', $row->id_unit) }}" class="btn btn-warning btn-l">
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