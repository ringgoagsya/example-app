@extends('layouts.app', ['page' => __('Registrasi'), 'pageSlug' => 'registrasis', 'showCollapse' => 'hidden'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">TABEL REGISTRASI</h4>
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
                                        <th>NO. REGISTRASI</th>
                                        <TH>NAMA PASIEN</TH>
                                        <TH>JENIS REGISTRASI</TH>
                                        <TH>LAYANAN</TH>
                                        <TH>VERIF</TH>
                                        <TH>MASUK</TH>
                                        <TH>SELESAI</TH>
                                        <TH>STATUS</TH>
                                        <th>PEMBAYARAN</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($trx_registrasi as $registrasi)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $registrasi->no_regis }}
                                                </td>
                                                <td>
                                                    {{ $registrasi->master_pasien->nama_pasien }}
                                                </td>
                                                <td>
                                                    {{ $registrasi->master_jenis_pendaftaran->nama_jenis_pendaftaran }}
                                                </td>
                                                <td>
                                                    {{ $registrasi->master_layanan->nama_layanan }}
                                                </td>
                                                <TD>
                                                    @if ($registrasi->waktu_confirm == null)
                                                        <a class="fa fa-check btn btn-primary btn-sm"
                                                            enctype="multipart/form-data" method="post"
                                                            href="{{ route('pelayanan.confirm', [$registrasi->no_regis]) }}"
                                                            type="button" title="confirm perencanaan"></a>
                                                    @else
                                                        {{ $registrasi->waktu_confirm }}
                                                    @endif
                                                </TD>
                                                <TD>
                                                    @if ($registrasi->waktu_mulai == null)
                                                        <a class="fa fa-check btn btn-default btn-sm"
                                                            enctype="multipart/form-data" method="post"
                                                            href="{{ route('pelayanan.mulai', [$registrasi->no_regis]) }}"
                                                            type="button" title="confirm perencanaan"></a>
                                                    @else
                                                        {{ $registrasi->waktu_mulai }}
                                                    @endif
                                                </TD>
                                                <TD>
                                                    @if ($registrasi->waktu_selesai == null)
                                                        <a class="fa fa-check btn btn-success btn-sm"
                                                            enctype="multipart/form-data" method="post"
                                                            href="{{ route('pelayanan.selesai', [$registrasi->no_regis]) }}"
                                                            type="button" title="confirm perencanaan"></a>
                                                    @else
                                                        {{ $registrasi->waktu_mulai }}
                                                    @endif
                                                </TD>
                                                <TD>
                                                    @if ($registrasi->status == null)
                                                        {{ 'Belum Verifikasi' }}
                                                    @else
                                                        {{ $registrasi->status }}
                                                    @endif
                                                </TD>
                                                <td center>
                                                    @if ($registrasi->id_metode_pembayaran == null)
                                                        @if ($registrasi->status == null)
                                                            {{ 'Verifikasi Terlebih Dahulu' }}
                                                        @else
                                                            <a href="#" type="button" title="payment method"
                                                                class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#modalform{{ $registrasi->no_regis }} "><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                    @else
                                                        @php
                                                            $nama_metode_pembayaran = 'Belum Bayar';
                                                        @endphp
                                                        @foreach ($metode_pembayaran as $metodenya)
                                                            @if ($metodenya->id_metode_pembayaran == $registrasi->id_metode_pembayaran)
                                                                @php $nama_metode_pembayaran = $metodenya->nama_metode_pembayaran; @endphp
                                                            @endif
                                                        @endforeach
                                                        {{ $nama_metode_pembayaran }}
                                                    @endif
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
@section('modals')
    @foreach ($trx_registrasi as $registrasi)
        <div class="col-md-4">
            <div class="modal fade" id="modalform{{ $registrasi->no_regis }}" tabindex="-1" role="dialog"
                aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-gradient-default">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Tambah Metode Pembayaran</h3>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post"
                                action="{{ route('pelayanan.payment', [$registrasi->no_regis]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group mb-3">
                                    <label for="id_area" class="form-control-label">Nama Metode Pembayaran</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-credit-card"
                                                    style="color: black"></i></span>
                                        </div>
                                        <select id="id_metode_pembayaran" name="id_metode_pembayaran" style="color: black"
                                            class="form-control{{ $errors->has('id_metode_pembayaran') ? ' is-invalid' : '' }}">
                                            @foreach ($metode_pembayaran as $metode_pembayarannya)
                                                <option value="{{ $metode_pembayarannya->id_metode_pembayaran }}"
                                                    @if ($metode_pembayarannya->id_metode_pembayaran == 'PAYMENT001') selected @endif>
                                                    {{ $metode_pembayarannya->nama_metode_pembayaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button id="formSubmit" type="submit" class="btn btn-primary"
                                        onclick="swal ( 'Berhasil','No Regis {{ $registrasi->no_regis }} Telah Berhasil Di Tambahkan','success')">Simpan</button>
                                    <button type="button" class="btn btn-danger  ml-auto"
                                        data-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
