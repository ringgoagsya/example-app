<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('REG') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('RUMAH SAKIT') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fa fa-database"></i>
                    <span class="nav-link-text">{{ __('Data Master') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div @if ($showCollapse == 'hidden') class="collapse hidden " @endif id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index') }}">
                                <i class="fa fa-user"></i>
                                <p>{{ __('User') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'pasiens') class="active " @endif>
                            <a href="{{ route('pasien.index') }}">
                                <i class="fa fa-heart"></i>
                                <p>{{ __('Pasien') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'layanans') class="active " @endif>
                            <a href="{{ route('layanan.index') }}">
                                <i class="fa fa-bed"></i>
                                <p>{{ __('Layanan') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'jenis_pendaftarans') class="active " @endif>
                            <a href="{{ route('jenis_pendaftaran.index') }}">
                                <i class="fa fa-stethoscope"></i>
                                <p>{{ __('Jenis Pendaftaran') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'petugas') class="active " @endif>
                            <a href="{{ route('petugas.index') }}">
                                <i class="fa fa-address-book"></i>
                                <p>{{ __('Petugas') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'metode_pembayarans') class="active " @endif>
                            <a href="{{ route('metode_pembayaran.index') }}">
                                <i class="fa fa-credit-card"></i>
                                <p>{{ __('Metode Pembayaran') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li @if ($pageSlug == 'registrasis') class="active " @endif>
                <a href="{{ route('registrasi.index') }}">
                    <i class="fa fa-retweet"></i>
                    <p>{{ __('Registrasi') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'pelayanans') class="active " @endif>
                <a href="{{ route('pelayanan.index') }}">
                    <i class="fa fa-file"></i>
                    <p>{{ __('Pelayanan') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
