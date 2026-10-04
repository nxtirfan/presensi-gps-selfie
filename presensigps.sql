-- 1. Buat Database
DROP DATABASE IF EXISTS presensigps;
CREATE DATABASE presensigps;
USE presensigps;

-- 2. Tabel USER
CREATE TABLE USER (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('Siswa', 'Guru', 'Admin') NOT NULL,
  remember_token VARCHAR(255)
);

-- 3. Tabel ANGKATAN
CREATE TABLE ANGKATAN (
  angkatan_id INT PRIMARY KEY, -- contoh: 23, 24, 25
  nama_angkatan VARCHAR(50)    -- contoh: 'Angkatan 2024'
);


-- 4. Tabel SISWA
CREATE TABLE SISWA (
  siswa_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  nis VARCHAR(20) NOT NULL UNIQUE,
  nama_lengkap VARCHAR(255) NOT NULL,
  kelas VARCHAR(10) NOT NULL,
  angkatan_id INT, -- relasi ke tabel ANGKATAN
  no_hp VARCHAR(20) NOT NULL,
  foto VARCHAR(50),
  alamat VARCHAR(255),
  tanggal_lahir DATE,
  FOREIGN KEY (user_id) REFERENCES USER(user_id) ON DELETE CASCADE,
  FOREIGN KEY (angkatan_id) REFERENCES ANGKATAN(angkatan_id) ON DELETE SET NULL
);

-- 5. Tabel GURU
CREATE TABLE GURU (
  guru_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  nama_lengkap VARCHAR(255) NOT NULL,
  no_hp VARCHAR(20) NOT NULL,
  email VARCHAR(100) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES USER(user_id) ON DELETE CASCADE
);

-- 6. Tabel PRESENSI
CREATE TABLE PRESENSI (
  presensi_id INT AUTO_INCREMENT PRIMARY KEY,
  siswa_id INT NOT NULL,
  tgl_presensi DATE NOT NULL,
  jam_in TIME DEFAULT NULL,
  jam_out TIME DEFAULT NULL,
  lokasi_in VARCHAR(255),
  lokasi_out VARCHAR(255),
  foto_in VARCHAR(255),
  foto_out VARCHAR(255),
  status ENUM('hadir', 'terlambat', 'izin', 'sakit', 'alpha') NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (siswa_id) REFERENCES SISWA(siswa_id) ON DELETE CASCADE
);

-- 7. Tabel Izin
CREATE TABLE IZIN (
  izin_id INT AUTO_INCREMENT PRIMARY KEY,
  siswa_id INT NOT NULL,
  tgl_izin DATE NOT NULL,
  keterangan VARCHAR(255),
  status ENUM('izin', 'sakit') NOT NULL,
  status_approved ENUM('pending', 'disetujui', 'ditolak') NOT NULL DEFAULT 'pending',
  FOREIGN KEY (siswa_id) REFERENCES SISWA(siswa_id) ON DELETE CASCADE
);


-- 8. Data ANGKATAN
INSERT INTO ANGKATAN (angkatan_id, nama_angkatan)
VALUES 
(22, 'Angkatan 2022'),
(23, 'Angkatan 2023'),
(24, 'Angkatan 2024');


-- 9. Input Data USER: Siswa & Guru
INSERT INTO USER (username, password, role) VALUES
('irfan', '$2y$12$Csr7i1aDtbTC7hWb7rz0v.iN0RxBZSvom9FAVcnr.y/itKIVYihwG', 'siswa'), -- password1
('salfa', '$2y$12$Csr7i1aDtbTC7hWb7rz0v.iN0RxBZSvom9FAVcnr.y/itKIVYihwG', 'siswa'), -- password1
('kanaya', '$2y$12$Csr7i1aDtbTC7hWb7rz0v.iN0RxBZSvom9FAVcnr.y/itKIVYihwG', 'siswa'), -- password1
('muharima', '$2y$12$Csr7i1aDtbTC7hWb7rz0v.iN0RxBZSvom9FAVcnr.y/itKIVYihwG', 'siswa'), -- password1
('guru1', '$2y$12$Csr7i1aDtbTC7hWb7rz0v.iN0RxBZSvom9FAVcnr.y/itKIVYihwG', 'guru'); -- password1


-- 10. Data USER -> Admin
INSERT INTO USER (username, password, role) 
VALUES ('admin1', '$2y$12$H4DW/R1w.TvY4W9eRy24auJs.SgsWgsgmZyIRRGy7P7Sh9wHtsqOW', 'admin'); -- admin123

-- 11. Data SISWA (data contoh untuk demo)
INSERT INTO SISWA (user_id, nis, nama_lengkap, kelas, angkatan_id, no_hp, alamat, tanggal_lahir) VALUES
(1, '24023', 'M Irfan Al Hakim', 'X', 24, '081200000001', 'Jl. Contoh No. 1', '2008-01-01'),
(2, '23002', 'Salfa Putri Lestari', 'XI', 23, '081200000002', 'Jl. Contoh No. 2', '2007-06-01'),
(3, '22018', 'Kanaya Azalea Chandra', 'XII', 22, '081200000003', 'Jl. Contoh No. 3', '2006-07-01'),
(4, '22039', 'Muharima Sahara', 'XII', 22, '081200000004', 'Jl. Contoh No. 4', '2006-03-01');

-- 11. Data GURU (data contoh untuk demo)
INSERT INTO GURU (user_id, nama_lengkap, no_hp, email) VALUES
(5, 'Dimas Tejo Gumilang, S.Pd.', '081200000005', 'guru.contoh@example.com');


-- 12. Data PRESENSI
INSERT INTO PRESENSI (siswa_id, tgl_presensi, jam_in, jam_out, lokasi_in, lokasi_out, status) VALUES
(1, '2023-03-01', '08:05:00', '10:00:00', '(-6.123,106.789)', '(-6.124,106.788)', 'hadir');
