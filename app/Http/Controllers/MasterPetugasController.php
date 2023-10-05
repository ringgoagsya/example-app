<?php

namespace App\Http\Controllers;

use App\Models\master_petugas;
use Illuminate\Http\Request;

class MasterPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master_petugas = master_petugas::all();

        return view('admin.petugas.petugas_index',compact('master_petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required'
        ]);
        $lastId = master_petugas::orderBy('id_petugas', 'desc')->first();
        $latestId = $lastId->id_petugas ? $lastId->id_petugas: 'LAY000';
        $nextId = 'PTG' . str_pad((intval(substr($latestId, 3)) + 1), 3, '0', STR_PAD_LEFT);
        // dd($lastId,$nextId);
        master_petugas::create([
            'id_petugas' => $nextId,
            'nama_petugas' => $request->nama_petugas,
            ]);
        return redirect()->route('petugas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\master_petugas  $master_petugas
     * @return \Illuminate\Http\Response
     */
    public function show(master_petugas $master_petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\master_petugas  $master_petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request, $id)
    {
        master_petugas::where('id_petugas', '=',$id)->update([
            'nama_petugas' => $request->nama_petugas,
        ]);

        return redirect()->route('petugas.index')->with('success','Berhasil Edit Data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\master_petugas  $master_petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, master_petugas $master_petugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\master_petugas  $master_petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        master_petugas::where('id_petugas','=', $id)->delete();
        return redirect()->route('petugas.index')->with('success','Berhasil Hapus');
    }
}
