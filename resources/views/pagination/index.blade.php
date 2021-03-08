@extends('layouts.index')

@section('content')
    <p>Contoh Pagination</p>
    <ul>
        @foreach($data_with_paginate as $value)
            <li>{{ $value }}</li>
        @endforeach
    </ul>
    {{ $data_with_paginate->links() }}
@endsection