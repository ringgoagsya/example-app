@extends('layouts.app', ['page' => __('Pasiens'), 'pageSlug' => 'pasiens', 'showCollapse' => 'show'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">TABEL PASIEN</h4>
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
                                        <th>ID PASIEN</th>
                                        <th>NAMA PASIEN</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>TANGGAL LAHIR</th>
                                        <th>AKSI</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($master_pasien as $pasien)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $pasien->id_pasien }}
                                                </td>
                                                <td>
                                                    {{ $pasien->nama_pasien }}
                                                </td>
                                                <td>
                                                    {{ $pasien->jenis_kelamin }}
                                                </td>
                                                <td>
                                                    {{ $pasien->tanggal_lahir }}
                                                </td>
                                                <td>
                                                    <a href="#" type="button" title="payment method"
                                                        class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#modalform{{ $pasien->id_pasien }} "><i
                                                            class="fa fa-edit"></i></a>
                                                    <a href="#" type="button" title="payment method"
                                                        class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modaldelete{{ $pasien->id_pasien }} "><i
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
                        <h3 class="modal-title" id="modal-title-default">Tambah Data Pasien</h3>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{ route('pasien.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-single-02"></i>
                                    </div>
                                </div>
                                <input type="text" name="name"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Name') }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                            <div class="input-group{{ $errors->has('jenis_kelamin') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-venus-mars "></i>
                                    </div>
                                </div>
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="form-control{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}">
                                    <option value="Laki-Laki" selected>
                                        {{ 'Laki-Laki' }}
                                    </option>
                                    <option value="Perempuan">
                                        {{ 'Perempuan' }}
                                    </option>
                                </select>
                                @include('alerts.feedback', ['field' => 'jenis_kelamin'])
                            </div>
                            <div class="input-group{{ $errors->has('tanggal_lahir') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar-times "></i>
                                    </div>
                                </div>
                                <input type="date" name="tanggal_lahir"
                                    class="form-control{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Tanggal Lahir') }}">
                                @include('alerts.feedback', ['field' => 'tanggal_lahir'])
                            </div>
                            <div class="input-group{{ $errors->has('jenis_pendaftaran') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-file "></i>
                                    </div>
                                </div>
                                <select id="id_jenis_pendaftaran" name="id_jenis_pendaftaran"
                                    class="form-control{{ $errors->has('id_jenis_pendaftaran') ? ' is-invalid' : '' }}">
                                    @foreach ($jenis_pendaftaran as $jenis_pendaftarannya)
                                        <option value="{{ $jenis_pendaftarannya->id_jenis_pendaftaran }}"
                                            @if ($jenis_pendaftarannya->id_jenis_pendaftaran == 'JP001') selected @endif>
                                            {{ $jenis_pendaftarannya->nama_jenis_pendaftaran }}
                                        </option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'jenis_pendaftaran'])
                            </div>
                            <div class="input-group{{ $errors->has('id_layanan') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-stethoscope"></i>
                                    </div>
                                </div>
                                <select id="id_layanan" name="id_layanan"
                                    class="form-control{{ $errors->has('id_layanan') ? ' is-invalid' : '' }}">
                                    @foreach ($layanan as $layanannya)
                                        <option value="{{ $layanannya->id_layanan }}"
                                            @if ($layanannya->id_layanan == 'LAY001') selected @endif>
                                            {{ $layanannya->nama_layanan }}
                                        </option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'id_layanan'])
                            </div>
                    </div>
                    <div class="card-footer" style="margin-top: -20px">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">{{ __('Daftar') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @foreach ($master_pasien as $pasien)
        <div class="col-md-4">
            <div class="modal fade" id="modalform{{ $pasien->id_pasien }}" tabindex="-1" role="dialog"
                aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Edit Pasien</h3>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post"
                                action="{{ route('pasien.edit', [$pasien->id_pasien]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group mb-3">
                                    <label for="id_pasien" class="form-control-label">ID Pasien</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input readonly style="background-color: white; color:black;" class="form-control"
                                            value="{{ $pasien->id_pasien }}" type="text" name="id_pasien"
                                            id="id_pasien">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_pasien" class="form-control-label">Edit Nama
                                        Pasien</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input class="form-control" style="background-color: white; color:black;"
                                            value="{{ $pasien->nama_pasien }}" type="text" name="nama_pasien"
                                            id="nama_pasien">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_pasien" class="form-control-label">Edit Jenis Kelamin
                                        Pasien</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file"
                                                    style="color: black"></i></span>
                                        </div>
                                        <select id="jenis_kelamin" name="jenis_kelamin" style="color: black"
                                            class="form-control{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}">
                                            <option value="Laki-Laki" @if ($pasien->jenis_kelamin == 'Laki-Laki') selected @endif>
                                                {{ 'Laki-Laki' }}
                                            </option>
                                            <option value="Perempuan" @if ($pasien->jenis_kelamin == 'Laki-Laki') selected @endif>
                                                {{ 'Perempuan' }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_pasien" class="form-control-label">Edit Tanggal Lahir
                                        Pasien</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input class="form-control" style="background-color: white; color:black;"
                                            value="{{ $pasien->tanggal_lahir }}" type="date" name="tanggal_lahir"
                                            id="tanggal_lahir">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button id="formSubmit" type="submit" class="btn btn-primary"
                                        onclick="swal ( 'Berhasil','ID {{ $pasien->id_pasien }} Telah Berhasil Di Edit','success')">Simpan</button>
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
    @foreach ($master_pasien as $pasien)
        <div class="modal fade" id="modaldelete{{ $pasien->id_pasien }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Hapus Pasien ?</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-10">
                                <form action="{{ route('pasien.destroy', [$pasien->id_pasien]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="row ">
                                        <div class="col md-4 mr-auto">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                        </div>
                                        <div class="col md-6 mr-auto">
                                            <button type="submit" title="Hapus" class="btn btn-danger"
                                                onclick="swal ( 'Berhasil','Data {{ $pasien->nama_pasien }} Telah Dihapus','warning')">Ya</button>

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
