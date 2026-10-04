@extends('layouts.presensi')
@section('content')

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section" id="user-section">
            <div id="user-detail">
                <div class="avatar">
                    @if(!empty(Auth::user()->siswa->foto))
                    <!-- If user has a photo, display it -->
                    @php
                        $path = Storage::url('public/uploads/siswa/' . Auth::user()->siswa->foto);
                    @endphp
                    <img src="{{ $path }}" alt="avatar" class="imaged w64 rounded" style="height: 64px; width: 64px;">
                    @else
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                    @endif
                </div>
                <div id="user-info">
                    <h2 id="user-name">
                        {{  Auth::user()->siswa->nama_lengkap }}
                    </h2>
                    <span id="user-role">{{  Auth::user()->role }}</span>
                </div>
            </div>
        </div>

        <div class="section" id="menu-section">
            <div class="card">
                <div class="card-body text-center">
                    <div class="list-menu">
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/editprofile" class="green" style="font-size: 40px;">
                                    <ion-icon name="person-sharp"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Profil</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/presensi/izin" class="danger" style="font-size: 40px;">
                                    <ion-icon name="calendar-number"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Izin</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/presensi/histori" class="warning" style="font-size: 40px;">
                                    <ion-icon name="document-text"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Histori</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/proseslogout" class="orange" style="font-size: 40px;">
                                    <ion-icon name="location"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                Logout
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section mt-2" id="presence-section">
            <div class="todaypresence">
                <div class="row">
                    <div class="col-6">
                        <div class="card gradasigreen">
                            <div class="card-body">
                                <div class="presencecontent mt-0" style="min-height: 48px;">
                                    <div class="iconpresence">
                                        @if ($presensitoday != null)
                                            @php
                                                $path = Storage::url('public/uploads/absensi/' . $presensitoday->foto_in);
                                            @endphp
                                            <img src="{{ $path }}" alt="Foto Masuk" class="imaged w64">
                                        @else
                                            <ion-icon name="camera"></ion-icon>
                                        @endif
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Masuk</h4>
                                        <span>{{ $presensitoday != null ? $presensitoday->jam_in : 'Belum Absen' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card gradasired">
                            <div class="card-body">
                                <div class="presencecontent" style="min-height: 48px;">
                                    <div class="iconpresence">
                                        @if ($presensitoday != null && $presensitoday->jam_out != null)
                                            @php
                                                $path = Storage::url('public/uploads/absensi/' . $presensitoday->foto_out);
                                            @endphp
                                            <img src="{{ $path }}" alt="Foto Keluar" class="imaged w64">
                                        @else
                                            <ion-icon name="camera"></ion-icon>
                                        @endif
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Pulang</h4>
                                        <span>{{ $presensitoday != null && $presensitoday->jam_out != null ? $presensitoday->jam_out : 'Belum Absen' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Rekap Presensi Bulan Ini Start-->
            <div class="rekappresensi">
                <h3>Rekap Presensi Bulan {{ $namabulan[$bulanini] }} Tahun {{ $tahunini }}</h3>
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-center gap-2" style="padding: 12px 12px !important; line-height:0.8rem">
                                <div class="presensiicon">
                                    <ion-icon name="accessibility-outline" style="font-size: 1.6rem;" class="text-primary"></ion-icon>
                                </div>
                                <div class="presensidetail text-start ml-1" style="display: flex; flex-direction: column;">
                                    <h4 style="font-size: 0.8rem; margin-bottom:0">Hadir</h4>
                                    <span style="font-size: 0.8rem; font-weight:500;">{{ $rekappresensi->jmlhadir }} hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-center gap-2" style="padding: 12px 12px !important; line-height:0.8rem">
                                <div class="presensiicon">
                                    <ion-icon name="newspaper-outline" style="font-size: 1.6rem;" class="text-success"></ion-icon>
                                </div>
                                <div class="presensidetail ml-1" style="display: flex; flex-direction: column; align-items: flex-start; text-align: left;">
                                    <h4 style="font-size: 0.8rem; margin-bottom:0">Izin</h4>
                                    <span style="font-size: 0.8rem; font-weight:500;">{{ $rekapizin->jmlizin }} hari</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Spacer only visible on mobile -->
                    <div class="d-block d-md-none w-100 mt-1"></div>

                    <div class="col-6 col-md-3">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-center gap-2" style="padding: 12px 12px !important; line-height:0.8rem">
                                <div class="presensiicon">
                                    <ion-icon name="medkit-outline" style="font-size: 1.6rem;" class="text-warning"></ion-icon>
                                </div>
                                <div class="presensidetail ml-1" style="display: flex; flex-direction: column; align-items: flex-start; text-align: left;">
                                    <h4 style="font-size: 0.8rem; margin-bottom:0">Sakit</h4>
                                    <span style="font-size: 0.8rem; font-weight:500;">{{ $rekapizin->jmlsakit }} hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-center gap-2" style="padding: 12px 12px !important; line-height:0.8rem">
                                <div class="presensiicon">
                                    <ion-icon name="alarm-outline" style="font-size: 1.7rem;" class="text-danger"></ion-icon>
                                </div>
                                <div class="presensidetail ml-1" style="display: flex; flex-direction: column; align-items: flex-start; text-align: left;">
                                    <h4 style="font-size: 0.8rem; margin-bottom:0">Terlambat</h4>
                                    <span style="font-size: 0.8rem; font-weight:500;">{{ $rekappresensi->jmlterlambat }} hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Rekap Presensi Bulan Ini End-->

            <div class="presencetab mt-2">
                <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                    <ul class="nav nav-tabs style1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                30 Hari Terakhir
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                Leaderboard
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-2" style="margin-bottom:100px;">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach ($historibulanini as $d)
                            @php
                                $path = Storage::url('public/uploads/absensi/' . $d->foto_in);
                            @endphp
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="finger-print-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        {{-- <div>{{ date("d-m-Y",strtotime($d->tgl_presensi))}}</div> --}}
                                        <div>{{ \Carbon\Carbon::parse($d->tgl_presensi)->translatedFormat('l, d F Y') }}</div>
                                        <div>
                                            <span class="badge badge-success">{{ $d->jam_in }}</span>
                                            <span class="badge badge-danger">{{ $presensitoday != null && $d->jam_out != null ? $d->jam_out : 'Belum Absen' }}</span>
                                            @php
                                                $statusColors = [
                                                    'hadir' => 'primary',
                                                    'terlambat' => 'warning',
                                                    'izin' => 'info',
                                                    'sakit' => 'secondary',
                                                    'alpha' => 'danger'
                                                ];
                                            @endphp

                                            <span class="badge badge-{{ $statusColors[$d->status] ?? 'dark' }}">
                                                {{ ucfirst($d->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach ( $leaderboard as $d)
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>{{$d->nama_lengkap}}</div>
                                        {{-- <span class="text-muted">Designer</span> --}}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->

    </body>

    </html>
@endsection