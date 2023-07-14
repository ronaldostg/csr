@extends('adminlte::page')

@section('title', 'Detail Unit')

@section('content_header')
<h1 class="m-0 text-dark">{{$unit->pemda}}</h1>
<h5 class="mb-3 text-dark">{{$unit->nama_unit}}</h5>

<div class="row">
    <div class="col-md-4">
        <a href="{{url('unit/create/'.$unit->id_unit)}}" class="btn btn-success ">Tambah</a>
    </div>
    <div class="col-md-1 offset-md-7">
        <a href="{{url('/unit')}}" class="btn btn-danger ">Kembali</a>
    </div>
</div>
</td>
</tr>
</table>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">
                <!-- body -->
                <h3 class="mb-3 text-dark">Dana Alokasi Unit Per Tahun</h3>

                <table class="table table-hover table-bordered table-stripped table-responsive-xl" id="example2">
                    <thead>
                        <tr class="text-center">
                            <td><b>Tahun </b></td>
                            <td><b>Dana Alokasi</b></td>
                            <td style="width: 20%"><b>Action</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dalok as $key => $item)
                        <tr class="text-center">
                            <td><b>{{$item->tahun}}</b></td>
                            <td>Rp.{{ number_format($item->dana_alokasi,2,',','.'); }},-</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="{{ url('edit_dalok/'.$item->id_alokasi) }}" class="btn btn-warning btn-sm mx-3">
                                        Edit</a>
                                    <form action="{{ url('hapus_dalok/'.$item->id_alokasi) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin untuk menghapus data ini ?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>



                <!-- End div -->

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
function goBack() {
    window.history.back();
}
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
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });        

// $('#download_evaluasi').click(function(){
//         // var id = $("#id").val();
//         // if (id!="") {
//         //     let formData = new FormData();
//         //     formData.append('id', id);

//         //     $.ajax({
//         //         type: 'POST',
//         //         url: "/download_evaluasi",
//         //         data: formData,
//         //         cache: false,
//         //         processData: false,
//         //         contentType: false,
//                 success: function (msg) {
//                 alert("Downloaded!");
//                 },
//                 error: function () {
//                     alert("Gagal!");
//                 }
//             });
//         // }
//         // });
</script>
@endpush