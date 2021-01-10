<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;


class ProvinsiController extends Controller
{
    public function __construct(){
        $this->middleware('logs', ['only' => ['store']]);
    }

    public function index()
    {
        $provinsi = Provinsi::get();
        return view('pages.provinsi', ['provinsi' => $provinsi]);
    }

    public function store(Request $request){
    	$request->validate([
            'name' => 'required|min:3|max:255'
        ]);
    
        $store = Provinsi::create($request->all());
        if($store){
            return redirect()->route('provinsi.index')
                             ->with('success','Data berhasil ditambahkan');
        } else{
            return redirect()->route('provinsi.index')
                             ->with('failed','Data gagal ditambahkan');
        }
    }

    public function edit(Provinsi $provinsi){
    	return view('pages.provinsi-edit', compact('provinsi'));
    }

    public function update(Request $request, Provinsi $provinsi){
    	$request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        $update = $provinsi->update($request->all());
        if($update){
            return redirect()->route('provinsi.index')
                             ->with('success','Data berhasil diupdate');
        } else{
            return redirect()->route('provinsi.index')
                             ->with('failed','Data gagal diupdate');
        }
    }

    public function destroy(Provinsi $provinsi){
    	$delete = $provinsi->delete();
    	if($delete){
            return redirect()->route('provinsi.index')
                             ->with('success','Data berhasil dihapus');
        } else{
            return redirect()->route('provinsi.index')
                             ->with('failed','Data gagal dihapus');
        }
    }

    public function show($id){
         return redirect()->route('provinsi.index');
    }
}
