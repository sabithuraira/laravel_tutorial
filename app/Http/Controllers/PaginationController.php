<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationController extends Controller
{
    //example of how to show array data with pagination
    public function index(){
        $arr_data = ["Cat", "Dog", "Elephant", "Turtle", "Butterfly", "Horse", "Chicken", "Bird", "Fish"];
        $data_with_paginate = $this->paginate($arr_data);
        $data_with_paginate->withPath('pagination');

        return view('pagination.index', compact(
            'data_with_paginate'
        ));
    }

    public function show_api(){
        $data = Http::get('https://api.npoint.io/99c279bb173a6e28359c/surat/33');
        $data_with_paginate = $this->paginate($data->json());
        $data_with_paginate->withPath('show_api');

        return view('pagination.show_api', compact(
            'data_with_paginate'
        ));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
