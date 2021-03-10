@extends('layouts.index')

@section('content')
    <br/>
    <form method="POST" action="{{ url('pegawai/'.$model->id) }}">
        @csrf 
        <input type="hidden" name="_method" value="PATCH">
        Nama : <input type="text" name="nama" value="{{ $model->nama }}"><br/>
        Tanggal Lahir : <input type="text" name="tanggal_lahir" value="{{ $model->tanggal_lahir }}"><br/>
        Gelar : <input type="text" name="gelar" value="{{ $model->gelar }}"><br/>
        NIP : <input type="text" name="nip"  value="{{ $model->nip }}"><br/>

        <button type="submit">SIMPAN</button>
    </form>
@endsection