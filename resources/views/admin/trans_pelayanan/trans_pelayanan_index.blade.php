@extends('layouts.app', ['page' => __('Pelayanan'), 'pageSlug' => 'pelayanans', 'showCollapse' => 'hidden'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">TABEL PELAYANAN</h4>
                            <p class="card-category">data transaksi</p>
                        </div>
                        <div class="col-md-12 col-12 text-right">
                            <form role="form" method="post" action="{{ route('registrasi.filter', [$now]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <label for="tanggal_input">Tanggal:</label>
                                <input class="" value="{{ $now }}" type="date" id="tanggal_input"
                                    name="tanggal_input">
                                <button style="width:70px" id="formSubmit" type="submit"
                                    class="btn btn-sm btn-primary">Submit
                                </button>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead class=" text-primary">
                                        <th>No</th>
                                        <th>WAKTU REGISTRASI</th>
                                        <th>NO. REGISTRASI</th>
                                        <th>NO. REKAM MEDIS</th>
                                        <TH>NAMA PASIEN</TH>
                                        <TH>JENIS KELAMIN</TH>
                                        <TH>TANGGAL LAHIR</TH>
                                        <TH>JENIS REGISTRASI</TH>
                                        <TH>LAYANAN</TH>
                                        <TH>JENIS PEMBAYARAN</TH>
                                        <TH>STATUS REGISTRASI</TH>
                                        <TH>WAKTU MULAI PELAYANAN</TH>
                                        <TH>WAKTU SELESAI PELAYANAN</TH>
                                        <TH>PETUGAS PENDAFTARAN</TH>
                                    </thead>
                                    <tbody>
                                        @forelse ($trx_pelayanan as $pelayanan)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $pelayanan->trx_registrasi->created_at }}
                                                </td>
                                                <td>
                                                    {{ $pelayanan->trx_registrasi->no_regis }}
                                                </td>
                                                <td>
                                                    {{ $pelayanan->no_rekam_medis }}
                                                </td>
                                                <td>
                                                    {{ $pelayanan->trx_registrasi->master_pasien->nama_pasien }}
                                                </td>
                                                <td>
                                                    {{ $pelayanan->trx_registrasi->master_pasien->jenis_kelamin }}
                                                </td>
                                                <td>
                                                    {{ $pelayanan->trx_registrasi->master_pasien->tanggal_lahir }}
                                                </td>
                                                <td>
                                                    {{ $pelayanan->trx_registrasi->master_jenis_pendaftaran->nama_jenis_pendaftaran }}
                                                </td>
                                                <td>
                                                    {{ $pelayanan->trx_registrasi->master_layanan->nama_layanan }}
                                                </td>
                                                <td>
                                                    @if ($pelayanan->id_metode_pembayaran != null)
                                                        {{ $pelayanan->master_metode_pembayaran->nama_metode_pembayaran }}
                                                    @else
                                                        {{ 'Belum Pembayaran' }}
                                                    @endif

                                                </td>
                                                <td>
                                                    {{ $pelayanan->status }}
                                                </td>
                                                <td>
                                                    {{ $pelayanan->waktu_mulai }}
                                                </td>
                                                <td>
                                                    {{ $pelayanan->waktu_selesai }}
                                                </td>
                                                <td>
                                                    {{ $pelayanan->master_petugas->nama_petugas }}
                                                </td>
                                            </tr>
                                        @empty
                                            <div>
                                                <td colspan="12">{{ 'Belum Ada Data' }}</td>

                                            </div>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            var Datatable = $('#datatable').DataTable({

                buttons: ['print', 'excel'],
                dom: "<'row'<'col-md-3'l><'col-md-5 btn-sm'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu: [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ]
            });

        });
    </script>
@endsection
