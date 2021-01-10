<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KabupatenKota;
use App\Provinsi;

class KabupatenKotaController extends Controller
{
    public function __construct(){
        $this->middleware('logs', ['only' => ['store']]);
    }
    
    public function index()
    {
        $kab = KabupatenKota::join('provinsi', 'kabupaten_kota.provinsi_id', '=', 'provinsi.id')
                                ->select('kabupaten_kota.*', 'provinsi.name as provinsi_name')
                                ->get();
        $provinsi = Provinsi::orderBy('name')->get();
        return view('pages.kabupaten_kota', ['kab' => $kab, 'provinsi' => $provinsi]);
    }

    public function store(Request $request){
    	$request->validate([
            'provinsi_id' => 'required',
            'name' => 'required|min:3|max:255'
        ]);
    
        $store = KabupatenKota::create($request->all());
        if($store){
            return redirect()->route('kabupaten-kota.index')
                             ->with('success','Data berhasil ditambahkan');
        } else{
            return redirect()->route('kabupaten-kota.index')
                             ->with('failed','Data gagal ditambahkan');
        }
    }

    public function edit($id){
        $exist = KabupatenKota::select("id")
                        ->where("id", $id)
                        ->exists();
        if (!$exist || !is_numeric($id)){
            return redirect()->route('kabupaten-kota.index')
                             ->with('failed','Tidak tersedia data Kabupaten/ Kota dengan ID '.$id);
        }
        $provinsi = Provinsi::get();
        $kabupaten = KabupatenKota::where('id', $id)->first();
        return view('pages.kabupaten_kota-edit', ['provinsi' => $provinsi, 'kabupaten' => $kabupaten]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'provinsi_id' => 'required',
            'name' => 'required|min:3|max:255'
        ]);
        $kab = KabupatenKota::find($id);
        $update = $kab->update($request->all());
        if($update){
            return redirect()->route('kabupaten-kota.index')
                             ->with('success','Data berhasil diupdate');
        } else{
            return redirect()->route('kabupaten-kota.index')
                             ->with('failed','Data gagal diupdate');
        }
    }

    public function destroy(KabupatenKota $kab){
        $delete = $kab->delete();
        if($delete){
            return redirect()->route('kabupaten-kota.index')
                             ->with('success','Data berhasil dihapus');
        } else{
            return redirect()->route('kabupaten-kota.index')
                             ->with('failed','Data gagal dihapus');
        }
    }

     public function show($id){
         return redirect()->route('kabupaten-kota.index');
    }
}
