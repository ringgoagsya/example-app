@extends('layouts.app', ['page' => __('Layanan '), 'pageSlug' => 'layanans', 'showCollapse' => 'show'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">TABEL LAYANAN</h4>
                            <p class="card-category">data master</p>
                            <div class="text-left">
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#modal-tambah">New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>No</th>
                                        <th>ID LAYANAN</th>
                                        <th>NAMA LAYANAN</th>
                                        <th>AKSI</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($master_layanan as $layanan)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $layanan->id_layanan }}
                                                </td>
                                                <td>
                                                    {{ $layanan->nama_layanan }}
                                                </td>
                                                <td>
                                                    <a href="#" type="button" title="payment method"
                                                        class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#modalform{{ $layanan->id_layanan }} "><i
                                                            class="fa fa-edit"></i></a>
                                                    <a href="#" type="button" title="payment method"
                                                        class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modaldelete{{ $layanan->id_layanan }} "><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>
                                                    {{ 'Belum Ada Data' }}
                                                </td>
                                            </tr>
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
    {{-- Modal Buat Tambah Data --}}
    <div class="col-md-4">
        <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-tambah"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Tambah Data Layanan</h3>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{ route('layanan.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nama_layanan" class="form-control-label">Nama Layanan</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-file"
                                                style="color: black"></i></span>
                                    </div>
                                    <input class="form-control" style="color: black" placeholder="Nama Layanan"
                                        type="text" name="nama_layanan" id="nama_layanan">
                                </div>
                            </div>

                            <div class="text-center">
                                <button id="formSubmit" type="submit" class="btn btn-primary"
                                    onclick="swal ( 'Berhasil','Data Layanan Telah Ditambahkan','success')">Tambah</button>
                                <button type="button" class="btn btn-danger  ml-auto" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($master_layanan as $layanan)
        <div class="col-md-4">
            <div class="modal fade" id="modalform{{ $layanan->id_layanan }}" tabindex="-1" role="dialog"
                aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Edit Layanan</h3>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="{{ route('layanan.edit', [$layanan->id_layanan]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group mb-3">
                                    <label for="id_layanan" class="form-control-label">ID Layanan</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input readonly style="background-color: white; color:black;" class="form-control"
                                            value="{{ $layanan->id_layanan }}" type="text" name="id_layanan"
                                            id="id_layanan">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_layanan" class="form-control-label">Edit Nama
                                        Layanan</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input class="form-control" style="background-color: white; color:black;"
                                            value="{{ $layanan->nama_layanan }}" type="text" name="nama_layanan"
                                            id="nama_layanan">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button id="formSubmit" type="submit" class="btn btn-primary"
                                        onclick="swal ( 'Berhasil','ID {{ $layanan->id_layanan }} Telah Berhasil Di Edit','success')">Simpan</button>
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
    {{-- Modal Buat Delete --}}
    @foreach ($master_layanan as $layanan)
        <div class="modal fade" id="modaldelete{{ $layanan->id_layanan }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Hapus Layanan ?</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-10">
                                <form action="{{ route('layanan.destroy', [$layanan->id_layanan]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="row ">
                                        <div class="col md-4 mr-auto">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                        </div>
                                        <div class="col md-6 mr-auto">
                                            <button type="submit" title="Hapus" class="btn btn-danger"
                                                onclick="swal ( 'Berhasil','Data {{ $layanan->nama_layanan }} Telah Dihapus','warning')">Ya</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
