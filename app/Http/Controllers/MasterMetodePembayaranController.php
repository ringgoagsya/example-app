<?php

namespace App\Http\Controllers;

use App\Models\master_metode_pembayaran;
use Illuminate\Http\Request;

class MasterMetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master_metode_pembayaran = master_metode_pembayaran::all();

        return view('admin.metode_pembayaran.metode_pembayaran_index',compact('master_metode_pembayaran'));
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
            'nama_metode_pembayaran' => 'required'
        ]);
        $lastId = master_metode_pembayaran::orderBy('id_metode_pembayaran', 'desc')->first();
        $latestId = $lastId->id_metode_pembayaran ? $lastId->id_metode_pembayaran: 'LAY000';
        $nextId = 'PAYMENT' . str_pad((intval(substr($latestId, 7)) + 1), 3, '0', STR_PAD_LEFT);
        // dd($lastId,$nextId);
        master_metode_pembayaran::create([
            'id_metode_pembayaran' => $nextId,
            'nama_metode_pembayaran' => $request->nama_metode_pembayaran,
            ]);
        return redirect()->route('metode_pembayaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\master_metode_pembayaran  $master_metode_pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(master_metode_pembayaran $master_metode_pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\master_metode_pembayaran  $master_metode_pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request,$id)
    {
        master_metode_pembayaran::where('id_metode_pembayaran', '=',$id)->update([
            'nama_metode_pembayaran' => $request->nama_metode_pembayaran,
        ]);

        return redirect()->route('metode_pembayaran.index')->with('success','Berhasil Edit Data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\master_metode_pembayaran  $master_metode_pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, master_metode_pembayaran $master_metode_pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\master_metode_pembayaran  $master_metode_pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        master_metode_pembayaran::where('id_metode_pembayaran','=', $id)->delete();
        return redirect()->route('metode_pembayaran.index')->with('success','Berhasil Hapus');
    }
}
