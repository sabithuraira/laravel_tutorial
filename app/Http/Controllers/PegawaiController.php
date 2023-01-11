<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\RiwayatPendidikan;
use App\Http\Requests\PegawaiRequest;
use Illuminate\Support\Facades\File;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
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
    public function create(){
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
    public function store(PegawaiRequest $request){
        $model = new Pegawai;
        $model->nama = $request->nama;
        $model->tanggal_lahir = $request->tanggal_lahir;
        $model->gelar = $request->gelar;
        $model->nip = $request->nip;
        // $model->foto_profile = $request->foto_profile;
        //kita akan membuat code untuk upload file
        if($request->file('foto_profile')){
            $file = $request->file('foto_profile');
            $nama_file = time().str_replace(" ", "", $file->getClientOriginalName());
            $file->move('foto', $nama_file);
            $model->foto_profile = $nama_file;
        }
        $model->save();

        return redirect('pegawai')->with('success', "Data berhasil disimpan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $model = Pegawai::find($id);
        $riwayat_pendidikan = RiwayatPendidikan::where('pegawai_id', $id)->get();

        return view('pegawai.edit', compact(
            'model', 'riwayat_pendidikan'
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
        
        if($request->file('foto_profile')){
            $file = $request->file('foto_profile');
            $nama_file = time().str_replace(" ", "", $file->getClientOriginalName());
            $file->move('foto', $nama_file);

            File::delete('foto/'.$model->foto_profile);
            $model->foto_profile = $nama_file;
        }

        $model->save();

        return redirect('pegawai')->with('success', "Data berhasil diperbaharui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $model = Pegawai::find($id);
        $model->delete();
        return redirect('pegawai');
    }


    public function store_riwayat(Request $request, $id){
        $model = new RiwayatPendidikan;

        if(strlen($request->riwayat_id)>0){
            $model = RiwayatPendidikan::find($request->riwayat_id);
        }
        
        $model->pegawai_id = $id;
        $model->nama_pendidikan = $request->nama_pendidikan;
        $model->periode_pendidikan = $request->periode_pendidikan;

        $model->save();

        return redirect('pegawai/'.$id.'/edit')->with('success', "Data berhasil diperbaharui");
    }

    public function destroy_riwayat($id, $pegawai_id){
        $model = RiwayatPendidikan::find($id);
        $model->delete();
        return redirect('pegawai/'.$pegawai_id.'/edit');
    }
}
