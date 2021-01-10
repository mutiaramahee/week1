<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Participant;
use App\Provinsi;
use DB;

class ParticipantController extends Controller
{
    public function __construct(){
        $this->middleware('logs', ['only' => ['store']]);
    }
    
    public function index()
    {
        $participant = Participant::get();
        return view('pages.participant', ['participant' => $participant]);
    }

    public function create()
    {
        $provinsi = Provinsi::get();
        return view('pages.participant-create', ['provinsi' => $provinsi]);
    }

    public function getKabupatenKota($id){
    	$kab = DB::table('kabupaten_kota')
    				->where('provinsi_id', $id)
    				->select('id', 'name')
    				->get();
    	return json_encode($kab);
    }

    public function getKecamatan($id){
    	$kecamatan = DB::table('kecamatan')
    				->where('kabupaten_kota_id', $id)
    				->select('id', 'name')
    				->get();
    	return json_encode($kecamatan);
    }

    public function getKelurahan($id){
    	$kelurahan = DB::table('kelurahan')
    				->where('kecamatan_id', $id)
    				->select('id', 'name')
    				->get();
    	return json_encode($kelurahan);
    }

    public function store(Request $request){ 
    	$request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|min:8|max:255',
            'phone' => 'required|min:8|max:15',
            'image' => 'mimes:jpg,png,jpeg,svg|max:2048'
        ]);  

        if($files = $request->file('image'))
        {   
        	$filename = Str::random(15).'.'.$files->getClientOriginalExtension();
        	$files->move('uploads/', $filename);
        	$store = Participant::create(['name' => $request->name,
        								  'email' => $request->email,
        								  'phone' => $request->phone,
        								  'image' => $filename,
        								  'provinsi_id' => $request->provinsi_id,
        								  'kabupaten_kota_id' => $request->kabupaten_kota_id,
        								  'kecamatan_id' => $request->kecamatan_id,
        								  'kelurahan_id' => $request->kelurahan_id,
        								]);
        } else{
        	$store = Participant::create($request->all());
        }
        if($store){ // jika berhasil insert 
            return redirect()->route('participant.index')
                             ->with('success','Data berhasil ditambahkan');     
        } else{
             return redirect()->route('participant.index')
                              ->with('failed','Data gagal ditambahkan');
        }
    }

    public function show($id){
        $exist = Participant::select("id")
                        ->where("id", $id)
                        ->exists();
        if (!$exist || !is_numeric($id)){
            return redirect()->route('participant.index')
                             ->with('failed','Tidak tersedia data participant dengan ID '.$id);
        }
        $part = Participant::leftJoin('provinsi', 'provinsi.id', '=', 'participant.provinsi_id')
    						->leftJoin('kabupaten_kota', 'kabupaten_kota.id', '=', 'participant.kabupaten_kota_id')
    						->leftJoin('kecamatan', 'kecamatan.id', '=', 'participant.kecamatan_id')
    						->leftJoin('kelurahan', 'kelurahan.id', '=', 'participant.kelurahan_id')
                            ->select('participant.*', 'provinsi.name as provinsi_name', 'kabupaten_kota.name as kab_name', 'kecamatan.name as kecamatan_name', 'kelurahan.name as kelurahan_name')
                            ->where('participant.id', '=', $id)
                            ->first();
    	return view('pages.participant-show', ['participant' => $part]);
    }

    public function edit($id){
        $exist = Participant::select("id")
                        ->where("id", $id)
                        ->exists();
        if (!$exist || !is_numeric($id)){
            return redirect()->route('participant.index')
                             ->with('failed','Tidak tersedia data participant dengan ID '.$id);
        }
        $participant = Participant::findOrFail($id);
        $provinsi = Provinsi::get();
        $kab = DB::table('kabupaten_kota')
                    ->where('provinsi_id', $participant->provinsi_id)
                    ->get();
        $kecamatan = DB::table('kecamatan')
                    ->where('kabupaten_kota_id', $participant->kabupaten_kota_id)
                    ->get();
        $kelurahan = DB::table('kelurahan')
                    ->where('kecamatan_id', $participant->kecamatan_id)
                    ->get();
        return view('pages.participant-edit', ['provinsi' => $provinsi, 'kab' => $kab, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'participant'=> $participant]);
    }

    public function update(Request $request, Participant $participant){
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|min:8|max:255',
            'phone' => 'required|min:8|max:15',
            'image' => 'mimes:jpg,png,jpeg,svg|max:2048'
        ]);  

        if($files = $request->file('image')){   
            $filename = Str::random(15).'.'.$files->getClientOriginalExtension();
            $files->move('uploads/', $filename);
            $update = $participant->update(['name' => $request->name,
                                          'email' => $request->email,
                                          'phone' => $request->phone,
                                          'image' => $filename,
                                          'provinsi_id' => $request->provinsi_id,
                                          'kabupaten_kota_id' => $request->kabupaten_kota_id,
                                          'kecamatan_id' => $request->kecamatan_id,
                                          'kelurahan_id' => $request->kelurahan_id,
                                        ]);
        } else{
            $update = $participant->update($request->all());
        }

        if($update){ // jika berhasil insert 
            return redirect()->route('participant.index')
                                 ->with('success','Data berhasil diupdate');     
        } else{
            return redirect()->route('participant.index')
                                 ->with('failed','Data gagal diupdate');
        }
    }

    public function destroy($id){
    	$participant = Participant::findOrFail($id);
    	$delete = $participant->delete();
        if($delete){
            return redirect()->route('participant.index')
                             ->with('success','Data berhasil dihapus');
        } else{
            return redirect()->route('participant.index')
                             ->with('failed','Data gagal dihapus');
        }
    }

}
