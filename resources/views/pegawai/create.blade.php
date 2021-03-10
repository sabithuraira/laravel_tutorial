@extends('layouts.index')

@section('content')
    <br/>
    <form method="POST" action="{{ url('pegawai') }}">
        @csrf 
        Nama : <input type="text" name="nama"><br/>
        Tanggal Lahir : <input type="text" name="tanggal_lahir"><br/>
        Gelar : <input type="text" name="gelar"><br/>
        NIP : <input type="text" name="nip"><br/>

        <button type="submit">SIMPAN</button>
    </form>
@endsection