@extends('layouts.app', ['page' => __('Petugas'), 'pageSlug' => 'petugas', 'showCollapse' => 'show'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">TABEL PETUGAS</h4>
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
                                        <th>ID PETUGAS</th>
                                        <th>NAMA PETUGAS</th>
                                        <th>AKSI</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($master_petugas as $petugas)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $petugas->id_petugas }}
                                                </td>
                                                <td>
                                                    {{ $petugas->nama_petugas }}
                                                </td>
                                                <td>
                                                    <a href="#" type="button" title="payment method"
                                                        class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#modalform{{ $petugas->id_petugas }} "><i
                                                            class="fa fa-edit"></i></a>
                                                    <a href="#" type="button" title="payment method"
                                                        class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modaldelete{{ $petugas->id_petugas }} "><i
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
                        <h3 class="modal-title" id="modal-title-default">Tambah Data Petugas</h3>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{ route('petugas.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nama_petugas" class="form-control-label">Nama Petugas</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-file"
                                                style="color: black"></i></span>
                                    </div>
                                    <input class="form-control" style="color: black" placeholder="Nama Petugas"
                                        type="text" name="nama_petugas" id="nama_petugas">
                                </div>
                            </div>

                            <div class="text-center">
                                <button id="formSubmit" type="submit" class="btn btn-primary"
                                    onclick="swal ( 'Berhasil','Data Petugas Telah Ditambahkan','success')">Tambah</button>
                                <button type="button" class="btn btn-danger  ml-auto" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($master_petugas as $petugas)
        <div class="col-md-4">
            <div class="modal fade" id="modalform{{ $petugas->id_petugas }}" tabindex="-1" role="dialog"
                aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Edit Petugas</h3>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="{{ route('petugas.edit', [$petugas->id_petugas]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group mb-3">
                                    <label for="id_petugas" class="form-control-label">ID Petugas</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input readonly style="background-color: white; color:black;" class="form-control"
                                            value="{{ $petugas->id_petugas }}" type="text" name="id_petugas"
                                            id="id_petugas">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_petugas" class="form-control-label">Edit Nama
                                        Petugas</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input class="form-control" style="background-color: white; color:black;"
                                            value="{{ $petugas->nama_petugas }}" type="text" name="nama_petugas"
                                            id="nama_petugas">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button id="formSubmit" type="submit" class="btn btn-primary"
                                        onclick="swal ( 'Berhasil','ID {{ $petugas->id_petugas }} Telah Berhasil Di Edit','success')">Simpan</button>
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
    @foreach ($master_petugas as $petugas)
        <div class="modal fade" id="modaldelete{{ $petugas->id_petugas }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Hapus Petugas ?</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-10">
                                <form action="{{ route('petugas.destroy', [$petugas->id_petugas]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="row ">
                                        <div class="col md-4 mr-auto">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                        </div>
                                        <div class="col md-6 mr-auto">
                                            <button type="submit" title="Hapus" class="btn btn-danger"
                                                onclick="swal ( 'Berhasil','Data {{ $petugas->nama_petugas }} Telah Dihapus','warning')">Ya</button>

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
