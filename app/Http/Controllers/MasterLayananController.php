<?php

namespace App\Http\Controllers;

use App\Models\master_layanan;
use Illuminate\Http\Request;

class MasterLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master_layanan = master_layanan::all();

        return view('admin.layanan.layanan_index',compact('master_layanan'));
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
            'nama_layanan' => 'required'
        ]);
        $lastId = master_layanan::orderBy('id_layanan', 'desc')->first();
        $latestId = $lastId->id_layanan ? $lastId->id_layanan: 'LAY000';
        $nextId = 'LAY' . str_pad((intval(substr($latestId, 3)) + 1), 3, '0', STR_PAD_LEFT);
        // dd($lastId,$nextId);
        master_layanan::create([
            'id_layanan' => $nextId,
            'nama_layanan' => $request->nama_layanan,
            ]);
        return redirect()->route('layanan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\master_layanan  $master_layanan
     * @return \Illuminate\Http\Response
     */
    public function show(master_layanan $master_layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\master_layanan  $master_layanan
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request, $id)
    {
        master_layanan::where('id_layanan', '=',$id)->update([
            'nama_layanan' => $request->nama_layanan,
        ]);

        return redirect()->route('layanan.index')->with('success','Berhasil Edit Data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\master_layanan  $master_layanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, master_layanan $master_layanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\master_layanan  $master_layanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        master_layanan::where('id_layanan','=', $id)->delete();

        return redirect()->route('layanan.index')->with('success','Berhasil Hapus');
    }
}
