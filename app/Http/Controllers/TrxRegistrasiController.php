<?php

namespace App\Http\Controllers;

use App\Models\trx_registrasi;
use App\Models\master_metode_pembayaran;
use Illuminate\Http\Request;

use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\DB;
class TrxRegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $day = Carbon::parse($now)->format('d');
        $month = Carbon::parse($now)->format('m');
        $year = Carbon::parse($now)->format('Y');
        $trx_registrasi = trx_registrasi::leftJoin('trx_pelayanans','trx_pelayanans.no_regis','=','trx_registrasis.no_regis')
                        ->select('trx_registrasis.*','trx_pelayanans.waktu_mulai','trx_pelayanans.waktu_selesai','trx_pelayanans.status','trx_pelayanans.created_at as waktu_confirm','trx_pelayanans.id_metode_pembayaran')
                        ->whereDay('waktu_regis','=',$day)->whereMonth('waktu_regis','=',$month)->whereYear('waktu_regis','=',$year)->get();
        $metode_pembayaran = master_metode_pembayaran::all();
        return view('admin.trans_registrasi.trans_registrasi_index',compact('trx_registrasi','metode_pembayaran','now'));
    }

    public function filter(request $request)
    {
        $now = Carbon::parse($request->tanggal_input)->format('Y-m-d');
        $day = Carbon::parse($now)->format('d');
        $month = Carbon::parse($now)->format('m');
        $year = Carbon::parse($now)->format('Y');
        $trx_registrasi = trx_registrasi::leftJoin('trx_pelayanans','trx_pelayanans.no_regis','=','trx_registrasis.no_regis')
                        ->select('trx_registrasis.*','trx_pelayanans.waktu_mulai','trx_pelayanans.waktu_selesai','trx_pelayanans.status','trx_pelayanans.created_at as waktu_confirm','trx_pelayanans.id_metode_pembayaran')
                        ->whereDay('waktu_regis','=',$day)->whereMonth('waktu_regis','=',$month)->whereYear('waktu_regis','=',$year)->get();
        $metode_pembayaran = master_metode_pembayaran::all();
        return view('admin.trans_registrasi.trans_registrasi_index',compact('trx_registrasi','metode_pembayaran','now'));
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
     * @param  \App\Models\trx_registrasi  $trx_registrasi
     * @return \Illuminate\Http\Response
     */
    public function show(trx_registrasi $trx_registrasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\trx_registrasi  $trx_registrasi
     * @return \Illuminate\Http\Response
     */
    public function edit(trx_registrasi $trx_registrasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\trx_registrasi  $trx_registrasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, trx_registrasi $trx_registrasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\trx_registrasi  $trx_registrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(trx_registrasi $trx_registrasi)
    {
        //
    }
}
