<?php

namespace App\Http\Controllers;

use App\Models\master_jenis_pendaftaran;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class MasterJenisPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master_jenis_pendaftaran = master_jenis_pendaftaran::all();

        return view('admin.jenis_pendaftaran.jenis_pendaftaran_index',compact('master_jenis_pendaftaran'));
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
            'nama_jenis_pendaftaran' => 'required'
        ]);
        $lastId = master_jenis_pendaftaran::orderBy('id_jenis_pendaftaran', 'desc')->first();
        $lastId = $lastId->id_jenis_pendaftaran ? $lastId->id_jenis_pendaftaran : 'JP000';
        $nextId = 'JP' . str_pad((intval(substr($lastId, 2)) + 1), 3, '0', STR_PAD_LEFT);
        master_jenis_pendaftaran::create([
            'id_jenis_pendaftaran' => $nextId,
            'nama_jenis_pendaftaran' => $request->nama_jenis_pendaftaran,
            ]);
        return redirect()->route('jenis_pendaftaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\master_jenis_pendaftaran  $master_jenis_pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(master_jenis_pendaftaran $master_jenis_pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\master_jenis_pendaftaran  $master_jenis_pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request, $id)
    {
        master_jenis_pendaftaran::where('id_jenis_pendaftaran', '=',$id)->update([
            'nama_jenis_pendaftaran' => $request->nama_jenis_pendaftaran,
        ]);

        return redirect()->route('jenis_pendaftaran.index')->with('success','Berhasil Edit Data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\master_jenis_pendaftaran  $master_jenis_pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, master_jenis_pendaftaran $master_jenis_pendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\master_jenis_pendaftaran  $master_jenis_pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        master_jenis_pendaftaran::where('id_jenis_pendaftaran','=', $id)->delete();

        return redirect()->route('jenis_pendaftaran.index')->with('success','Berhasil Hapus');
    }
}
