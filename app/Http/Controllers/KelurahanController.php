<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelurahan;
use App\Kecamatan;

class KelurahanController extends Controller
{
    public function __construct(){
        $this->middleware('logs', ['only' => ['store']]);
    }
    
    public function index()
    {
        $kelurahan = Kelurahan::join('kecamatan', 'kelurahan.kecamatan_id', '=', 'kecamatan.id')
                                ->select('kelurahan.*', 'kecamatan.name as kecamatan_name')
                                ->get();
        $kecamatan = Kecamatan::orderBy('name')->get();
        return view('pages.kelurahan', ['kelurahan' => $kelurahan, 'kecamatan' => $kecamatan]);
    }

    public function store(Request $request){
    	$request->validate([
            'kecamatan_id' => 'required',
            'name' => 'required|min:3|max:255'
        ]);
    
        $store = Kelurahan::create($request->all());
        if($store){
            return redirect()->route('kelurahan.index')
                             ->with('success','Data berhasil ditambahkan');
        } else{
            return redirect()->route('kelurahan.index')
                             ->with('failed','Data gagal ditambahkan');
        }
    }

    public function edit($id){
        $exist = Kelurahan::select("id")
                        ->where("id", $id)
                        ->exists();
        if (!$exist || !is_numeric($id)){
            return redirect()->route('kelurahan.index')
                             ->with('failed','Tidak tersedia data kelurahan dengan ID '.$id);
        }
        $kelurahan = Kelurahan::findOrFail($id);
        $kecamatan = Kecamatan::get();
        return view('pages.kelurahan-edit', ['kecamatan' => $kecamatan, 'kelurahan'=> $kelurahan]);
    }

    public function update(Request $request, Kelurahan $kelurahan){
        $request->validate([
            'kecamatan_id' => 'required',
            'name' => 'required|min:3|max:255'
        ]);

        $update = $kelurahan->update($request->all());
        if($update){
            return redirect()->route('kelurahan.index')
                             ->with('success','Data berhasil diupdate');
        } else{
            return redirect()->route('kelurahan.index')
                             ->with('failed','Data gagal diupdate');
        }
    }

    public function destroy(Kelurahan $kelurahan){
        $delete = $kelurahan->delete();
        if($delete){
            return redirect()->route('kelurahan.index')
                             ->with('success','Data berhasil dihapus');
        } else{
            return redirect()->route('kelurahan.index')
                             ->with('failed','Data gagal dihapus');
        }
    }

     public function show($id){
         return redirect()->route('kelurahan.index');
    }
}
