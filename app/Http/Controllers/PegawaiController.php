<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Http\Requests\PegawaiRequest;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        // $datas = Pegawai::all();
        $datas = Pegawai::where('nama', 'LIKE', '%'.$keyword.'%')
            ->orWhere('gelar', 'LIKE', '%'.$keyword.'%')
            ->orWhere('nip', 'LIKE', '%'.$keyword.'%')
            ->paginate();
        $datas->withPath('pegawai');
        $datas->appends($request->all());
        return view('pegawai.index', compact(
            'datas', 'keyword'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Pegawai;
        return view('pegawai.create', compact(
            'model'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {
        $model = new Pegawai;
        $model->nama = $request->nama;
        $model->tanggal_lahir = $request->tanggal_lahir;
        $model->gelar = $request->gelar;
        $model->nip = $request->nip;
        $model->save();

        return redirect('pegawai')->with('success', "Data berhasil disimpan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Pegawai::find($id);
        return view('pegawai.edit', compact(
            'model'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiRequest $request, $id)
    {
        $model = Pegawai::find($id);
        $model->nama = $request->nama;
        $model->tanggal_lahir = $request->tanggal_lahir;
        $model->gelar = $request->gelar;
        $model->nip = $request->nip;
        $model->save();

        return redirect('pegawai')->with('success', "Data berhasil diperbaharui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Pegawai::find($id);
        $model->delete();
        return redirect('pegawai');
    }
}
