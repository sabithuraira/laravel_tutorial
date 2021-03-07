<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return "Ini dari Home Controller";
    }

    public function show_html(){
        return view('home.halo');
    }
    
    public function belajar_blade(){
        $nama = "Joko";
        $daftar_hewan = ["Kucing", "Jerapah", "Bebek"];
        return view('home.belajar_blade', compact(
            'nama', 'daftar_hewan'
        ));
    }
}
