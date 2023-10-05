<?php

namespace App\Http\Controllers;

use App\Models\master_pasien;
use App\Models\master_layanan;
use App\Models\master_jenis_pendaftaran;
use App\Models\trx_registrasi;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class MasterPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master_pasien = master_pasien::all();
        $layanan = master_layanan::all();
        $jenis_pendaftaran = master_jenis_pendaftaran::all();
        return view('admin.pasien.pasien_index',compact('master_pasien','layanan','jenis_pendaftaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        $day = Carbon::parse($now)->format('d');
        $month = Carbon::parse($now)->format('m');
        $year = Carbon::parse($now)->format('Y');
        // dd($request);
        $lastPatient = master_pasien::orderBy('id_pasien', 'desc')->first();
        if (!$lastPatient) {
        $nextId = 'PAS000001';
        } else {
        $lastIdNumber = intval(substr($lastPatient->id_pasien, 3));
        $nextIdNumber = $lastIdNumber + 1;
        $nextId = 'PAS' . str_pad($nextIdNumber, 6, '0', STR_PAD_LEFT);
        }
        $tahun =intval(substr($year, 2));
        $bulan =str_pad($month, 2, '0', STR_PAD_LEFT);
        $day = str_pad($day, 2, '0', STR_PAD_LEFT);
        $no_registrasi = $tahun.$bulan.$day.str_pad($nextIdNumber, 4, '0', STR_PAD_LEFT);
        // dd($no_registrasi);
        $pasien = master_pasien::create([
            'id_pasien' => $nextId,
            'nama_pasien' => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => Carbon::parse($request->input('tanggal_lahir'))->format('Y-m-d'),

        ]);
        $pendaftaran = trx_registrasi::create([
            'no_regis' => $no_registrasi,
            'id_pasien' => $nextId,
            'id_layanan' => $request->id_layanan,
            'id_jenis_pendaftaran'=> $request->id_jenis_pendaftaran,
            'waktu_regis' => Carbon::now()->format('Y-m-d'),
        ]);
        // dd($pendaftaran);
        return redirect()->route('pasien.create')->with('success', 'Pendaftaran berhasil! No. Registrasi :'.$no_registrasi.' No. Pasien :'.$nextId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $layanan = master_layanan::all();
        $jenis_pendaftaran = master_jenis_pendaftaran::all();

        return view('auth.register',compact('layanan','jenis_pendaftaran'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\master_pasien  $master_pasien
     * @return \Illuminate\Http\Response
     */
    public function show(master_pasien $master_pasien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\master_pasien  $master_pasien
     * @return \Illuminate\Http\Response
     */
    public function edit(master_pasien $master_pasien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\master_pasien  $master_pasien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, master_pasien $master_pasien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\master_pasien  $master_pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy(master_pasien $master_pasien)
    {
        //
    }
}
