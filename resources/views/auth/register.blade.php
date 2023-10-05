@extends('layouts.app', ['class' => 'register-page', 'page' => __('Register Page'), 'contentClass' => 'register-page'])

@section('content')
    <div class="row">
        @if (session('success'))
            <div id="myCard" class="alert alert-success col-md-10" style="margin-left:10px">
                <p style="color: white">
                    {{ session('success') }}
                </p>
            </div>
        @endif
        <div class="col-md-10">
            <div class="card card-register card-white">
                <div class="card-header" style="height: 100px">
                    <h3 class="card-title" style="color: black; margin-left:10px">{{ 'Pendaftaran Pasien' }}</h3>
                </div>
                <form class="form" method="post" action="{{ route('pasien.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#myCard").fadeOut(500); // Menghilangkan card dalam 0,5 detik
            }, 6000); // 60.000 milidetik (1 menit)
        });
    </script>
@endsection
