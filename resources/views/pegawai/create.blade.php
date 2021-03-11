@extends('layouts.index')

@section('content')
    <br/>
    <form method="POST" action="{{ url('pegawai') }}" enctype="multipart/form-data">
        @csrf 
        @include('pegawai._form')
    </form>
@endsection