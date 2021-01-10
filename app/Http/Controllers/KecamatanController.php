<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;
use App\KabupatenKota;

class KecamatanController extends Controller
{
    public function __construct(){
        $this->middleware('logs', ['only' => ['store']]);
    }
    
    public function index()
    {
        $kecamatan = Kecamatan::join('kabupaten_kota', 'kecamatan.kabupaten_kota_id', '=', 'kabupaten_kota.id')
                                ->select('kecamatan.*', 'kabupaten_kota.name as kab_name')
                                ->get();
        $kab = KabupatenKota::orderBy('name')->get();
        return view('pages.kecamatan', ['kecamatan' => $kecamatan, 'kab' => $kab]);
    }

    public function store(Request $request){
    	$request->validate([
            'kabupaten_kota_id' => 'required',
            'name' => 'required|min:3|max:255'
        ]);
    
        $store = Kecamatan::create($request->all());
        if($store){
            return redirect()->route('kecamatan.index')
                             ->with('success','Data berhasil ditambahkan');
        } else{
            return redirect()->route('kecamatan.index')
                             ->with('failed','Data gagal ditambahkan');
        }
    }

    public function edit($id){
        $exist = Kecamatan::select("id")
                        ->where("id", $id)
                        ->exists();
        if (!$exist || !is_numeric($id)){
            return redirect()->route('kecamatan.index')
                             ->with('failed','Tidak tersedia data kecamatan dengan ID '.$id);
        }
        $kecamatan = Kecamatan::findOrFail($id);
        $kab = KabupatenKota::get();
        return view('pages.kecamatan-edit', ['kab' => $kab, 'kecamatan'=>$kecamatan]);
    }

    public function update(Request $request, Kecamatan $kecamatan){
        $request->validate([
            'kabupaten_kota_id' => 'required',
            'name' => 'required|min:3|max:255'
        ]);

        $update = $kecamatan->update($request->all());
        if($update){
            return redirect()->route('kecamatan.index')
                             ->with('success','Data berhasil diupdate');
        } else{
            return redirect()->route('kecamatan.index')
                             ->with('failed','Data gagal diupdate');
        }
    }

    public function destroy(Kecamatan $kecamatan){
        $delete = $kecamatan->delete();
        if($delete){
            return redirect()->route('kecamatan.index')
                             ->with('success','Data berhasil dihapus');
        } else{
            return redirect()->route('kecamatan.index')
                             ->with('failed','Data gagal dihapus');
        }
    }

    public function show($id){
         return redirect()->route('kecamatan.index');
    }
}
