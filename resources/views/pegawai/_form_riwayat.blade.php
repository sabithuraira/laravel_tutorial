
@if(isset($model))
<br/>
<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#form-pendidikan">
  Tambah Riwayat Pendidikan
</button><br/><br/>

<table class="table-bordered table">
    <tr class="text-center">
        <th>Nama Sekolah</th>
        <th>Periode Pendidikan</th>
        <th colspan="2">AKSI</th>
    </tr>
    @foreach($riwayat_pendidikan as $value)
        <tr>
            <td>{{ $value->nama_pendidikan }}</td>
            <td>{{ $value->periode_pendidikan }}</td>
           
            <td class="text-center">
                <a class="btn btn-info btn-edit" 
                    data-id="{{ $value->id }}" 
                    data-nama_pendidikan="{{ $value->nama_pendidikan }}" 
                    data-periode_pendidikan="{{ $value->periode_pendidikan }}" >Update</a>
            </td>
            <td class="text-center">
                <form action="{{ url('pegawai/'.$value->id.'/'.$model->id.'/riwayat') }}" method="POST">
                    @csrf 
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger" type="submit">DELETE</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<div class="modal fade" id="form-pendidikan" tabindex="-1" role="dialog" aria-labelledby="form-pendidikan" aria-hidden="true">
    <form method="POST" action="{{ url('pegawai/'.$model->id.'/riwayat') }}" enctype="multipart/form-data">
        @csrf 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Riwayat Pendidikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input id="riwayat_id" type="hidden" name="riwayat_id">
                <div class="row clearfix">
                    <div class="col-md-6">Nama Pendidikan</div>
                    <div class="col-md-6">
                        <input class="form-control" id="nama_pendidikan" type="text" name="nama_pendidikan">
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-md-6">Periode Pendidikan</div>
                    <div class="col-md-6">
                        <input class="form-control" id="periode_pendidikan" type="text" name="periode_pendidikan">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </form>
</div>
@endif

@section('script')
<script>
    $(document).ready(function() {
        $(".btn-edit").click(function(){
            let data_id = $(this).attr("data-id");
            let data_nama_pendidikan = $(this).attr("data-nama_pendidikan");
            let data_periode_pendidikan = $(this).attr("data-periode_pendidikan");

            $('#riwayat_id').val(data_id);
            $('#nama_pendidikan').val(data_nama_pendidikan);
            $('#periode_pendidikan').val(data_periode_pendidikan);

            $('#form-pendidikan').modal('show')

        }); 
    });
</script>
@endsection