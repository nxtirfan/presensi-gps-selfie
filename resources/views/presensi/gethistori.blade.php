@if ($histori->isEmpty())
    <div class="alert alert-warning">
        <p>Belum ada data presensi</p>
    </div>
@endif

@foreach ($histori as $d)
    <ul class="listview image-listview">
        <li>
            <div class="item">
                @php
                    $path = Storage::url('public/uploads/absensi/' . $d->foto_in);
                @endphp
                <img src="{{ $path }}" alt="Foto Masuk" class="imaged w64">
                <div class="in">
                    <div class="ml-1">
                        <b>{{ \Carbon\Carbon::parse($d->tgl_presensi)->translatedFormat('l, d F Y') }}</b><br>
                    </div>
                    <div>
                        {{-- <span class="badge {{ $d->jam_in < "07:00" ? "bg-primary" : "bg-danger" }}"> --}}
                        <span class="badge bg-success">
                            {{ $d->jam_in }}
                        </span>
                        <span class="badge {{ $d->jam_out != null ? "bg-danger" : "bg-warning" }}">
                            {{ $d->jam_out ?? 'Belum Absen' }}
                        </span>
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