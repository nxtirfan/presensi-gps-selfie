# PresensiGPS

Sistem presensi berbasis GPS dan foto selfie, dibangun dengan Laravel 10.

PresensiGPS memvalidasi titik masuk dan pulang menggunakan koordinat GPS, serta mendokumentasikan kehadiran melalui foto selfie. Aplikasi mendukung tiga peran (Admin, Guru, Siswa), CRUD siswa dan angkatan, riwayat presensi, pengajuan izin, monitoring pada peta, serta laporan dan rekap presensi.

## Status

Project ini tidak lagi dalam pengembangan aktif.

Kelanjutan pengembangan dari basis kode ini tersedia di **[Attendify](https://github.com/nxtirfan/attendify)**: sistem presensi berbasis GPS dan selfie yang memakai infrastruktur cloud (EC2, RDS for MySQL, S3 privat, CloudWatch).

## Teknologi

- Backend: Laravel 10, PHP 8.1+
- Database: MySQL
- Frontend: Blade, Bootstrap/Tabler, jQuery, Leaflet/OpenStreetMap
- Kamera: WebcamJS
