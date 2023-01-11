
@if(isset($model))
<br/>
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#form-riwayat">
        Tambah Riwayat Pendidikan
    </button><br/><br/>
    <table class="table-bordered table">
        <tr class="text-center">
            <th>Nama Pendidikan</th>
            <th>Periode Pendidikan</th>
            <th colspan="2">AKSI</th>
        </tr>
        @foreach($riwayat_pendidikan as $riwayat)
                <tr>
                    <td>{{ $riwayat->nama_pendidikan }}</td>
                    <td>{{ $riwayat->periode_pendidikan }}</td>
                    <td class="text-center">
                        <a class="btn btn-info btn-edit" href="#"
                            data-id="{{ $riwayat->id }}" 
                            data-nama_pendidikan="{{ $riwayat->nama_pendidikan }}"
                            data-periode_pendidikan="{{ $riwayat->periode_pendidikan }}">Update</a>
                    </td>
                    <td class="text-center">
                        <form action="{{ url('pegawai/'.$riwayat->id.'/'.$model->id.'/riwayat') }}" method="POST">
                            @csrf 
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" type="submit">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </table>

<!-- Modal -->
    <div class="modal fade" id="form-riwayat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                    <input type="hidden" id="riwayat_id" name="riwayat_id" > 
                    <div class="row clearfix">
                            <div class="col-md-6">Nama Pendidikan</div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" id="nama_pendidikan" name="nama_pendidikan" > 
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-6">Periode Pendidikan</div>
                            
                            <div class="col-md-6">
                                <input class="form-control" type="text" id="periode_pendidikan" name="periode_pendidikan">
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
    $(document).ready(function(){
        $('.btn-edit').click(function(){
            let data_id = $(this).attr("data-id");
            let data_nama_pendidikan = $(this).attr("data-nama_pendidikan");
            let data_periode_pendidikan = $(this).attr("data-periode_pendidikan");

            $('#nama_pendidikan').val(data_nama_pendidikan);
            $('#periode_pendidikan').val(data_periode_pendidikan);
            $('#riwayat_id').val(data_id);

            $('#form-riwayat').modal('show')
        });
    });
</script>
@endsection