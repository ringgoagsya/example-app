<?php

namespace App\Http\Controllers;

use App\Models\trx_pelayanan;
use Illuminate\Http\Request;

use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\DB;
class TrxPelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(request $request,$id){
        $ac = trx_pelayanan::where('no_regis','=', $id)
        ->update(
            ['id_metode_pembayaran' => $request->id_metode_pembayaran]
        );
        return redirect()->route('registrasi.index')->with('success','Berhasil Menambahkan Metode Pembayaran');
    }

    public function confirm($id){
        $lastId = trx_pelayanan::orderBy('no_rekam_medis', 'desc')->first();
        // dd($lastId);
            if ($lastId) {
                $parts = explode('-', $lastId->no_rekam_medis);

                $nextNumber = (int) end($parts) + 1;
                $nextId = implode('-', array_slice($parts, 0,-1)) . '-' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
                // dd($nextId);
            } else {
                // Jika tidak ada ID sebelumnya, mulai dari "00-00-00-01"
                $nextId = '00-00-00-01';
            }
            // dd($nextId);
        $pelayanan = trx_pelayanan::create([
            'no_rekam_medis' => $nextId,
            'no_regis' => $id,
            'id_petugas' => auth()->user()->id_petugas,
            'status' => "Verifikasi"
        ]);
        // dd($pelayanan);
        return redirect()->route('registrasi.index')->with('success','Berhasil Verifikasi');
    }
    public function mulai($id){
        $now = Carbon::now()->format('H:m:s');
        $status = "Aktif";
        $ac = trx_pelayanan::where('no_regis','=', $id)
        ->update(
            ['waktu_mulai' => $now = Carbon::now(),
            'status' => $status]
        );
        // dd($ac);
        return redirect()->route('registrasi.index')->with('success','Berhasil Mulai Kunjungan');
    }
    public function selesai($id){
        $now = Carbon::now()->format('H:m:s');
        $status = "Tutup Kunjungan";
        $ac = trx_pelayanan::where('no_regis','=', $id)
        ->update(
            ['waktu_selesai' => $now = Carbon::now(),
            'status' => $status ],
        );
        return redirect()->route('registrasi.index')->with('success','Berhasil Tutup Kunjungan');
    }
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $day = Carbon::parse($now)->format('d');
        $month = Carbon::parse($now)->format('m');
        $year = Carbon::parse($now)->format('Y');
        $trx_pelayanan = trx_pelayanan::whereDay('created_at','=',$day)->whereMonth('created_at','=',$month)->whereYear('created_at','=',$year)->get();

        return view('admin.trans_pelayanan.trans_pelayanan_index',compact('trx_pelayanan','now'));
    }
    public function filter(request $request)
    {
        $now = Carbon::parse($request->tanggal_input)->format('Y-m-d');
        $day = Carbon::parse($now)->format('d');
        $month = Carbon::parse($now)->format('m');
        $year = Carbon::parse($now)->format('Y');
        $trx_pelayanan = trx_pelayanan::whereDay('created_at','=',$day)->whereMonth('created_at','=',$month)->whereYear('created_at','=',$year)->get();

        return view('admin.trans_pelayanan.trans_pelayanan_index',compact('trx_pelayanan','now'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\trx_pelayanan  $trx_pelayanan
     * @return \Illuminate\Http\Response
     */
    public function show(trx_pelayanan $trx_pelayanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\trx_pelayanan  $trx_pelayanan
     * @return \Illuminate\Http\Response
     */
    public function edit(trx_pelayanan $trx_pelayanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\trx_pelayanan  $trx_pelayanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, trx_pelayanan $trx_pelayanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\trx_pelayanan  $trx_pelayanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(trx_pelayanan $trx_pelayanan)
    {
        //
    }
}
