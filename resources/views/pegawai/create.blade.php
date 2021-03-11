@extends('layouts.index')

@section('content')
    <br/>
    <form method="POST" action="{{ url('pegawai') }}">
        @csrf 
        @include('pegawai._form')
    </form>
@endsection