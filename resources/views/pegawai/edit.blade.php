@extends('layouts.index')

@section('content')
    <br/>
    <form method="POST" action="{{ url('pegawai/'.$model->id) }}" enctype="multipart/form-data">
        @csrf 
        <input type="hidden" name="_method" value="PATCH">

        @include('pegawai._form')
    </form>
@endsection