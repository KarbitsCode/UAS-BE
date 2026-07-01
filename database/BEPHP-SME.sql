CREATE DATABASE IF NOT EXISTS `sme_php`;
USE `sme_php`;

-- Tabel Users (Admin & Penyelenggara)
CREATE TABLE `users` (
  `id_user` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) UNIQUE NOT NULL,
  `password` varchar(255) NOT NULL, -- Di-hash pake password_hash()
  `nama_organisasi` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL COMMENT 'Enum: administrator, penyelenggara',
  `aktif` boolean NOT NULL DEFAULT false COMMENT 'false = pending, true = diverifikasi admin'
);

-- Tabel Event (Dibuat oleh Penyelenggara)
CREATE TABLE `event` (
  `id_event` int PRIMARY KEY AUTO_INCREMENT,
  `id_user` int, -- Yang buat event ini
  `nama_event` varchar(150) NOT NULL,
  `kategori` varchar(50) NOT NULL, -- Enum: Workshop, Seminar, Lomba
  `kuota` int NOT NULL,
  `tanggal_event` datetime NOT NULL,
  `deskripsi` text,
  `poster_event` varchar(255) -- Menyimpan nama file gambar poster yang di-upload
);

-- Tabel Peserta (Data Master Publik)
CREATE TABLE `peserta` (
  `nik_nim` varchar(50) PRIMARY KEY, -- NIK/NIM sebagai PK
  `nama_peserta` varchar(100) NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `jenis_identitas` varchar(20) NOT NULL COMMENT 'Enum: Mahasiswa, Umum'
);

-- Tabel Pendaftaran (Jembatan Banyak-ke-Banyak)
CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int PRIMARY KEY AUTO_INCREMENT,
  `nik_nim` varchar(50),
  `id_event` int,
  `tanggal_daftar` timestamp DEFAULT (current_timestamp),
  `status_kehadiran` varchar(20) DEFAULT 'tidak hadir' COMMENT 'Enum: tidak hadir, hadir'
);

ALTER TABLE `event` ADD FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

ALTER TABLE `pendaftaran` ADD FOREIGN KEY (`nik_nim`) REFERENCES `peserta` (`nik_nim`);

ALTER TABLE `pendaftaran` ADD FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`);


/*
Table users {
  id_user int [pk, increment]
  username varchar(50) [unique, not null]
  password varchar(255) [not null]
  nama_organisasi varchar(100) [not null]
  role varchar(20) [note: "Enum: administrator, penyelenggara", not null]
  aktif boolean [default: false, note: "false = pending, true = diverifikasi admin", not null]
}

Table event {
  id_event int [pk, increment]
  id_user int [ref: > users.id_user]
  nama_event varchar(150) [not null]
  kategori varchar(50) [not null]
  kuota int [not null]
  tanggal_event datetime [not null]
  deskripsi text
  poster_event varchar(255)
}

Table peserta {
  nik_nim varchar(50) [pk]
  nama_peserta varchar(100) [not null]
  email varchar(100) [unique, not null]
  jenis_identitas varchar(20) [note: "Enum: Mahasiswa, Umum", not null]
}

Table pendaftaran {
  id_pendaftaran int [pk, increment]
  nik_nim varchar(50) [ref: > peserta.nik_nim]
  id_event int [ref: > event.id_event]
  tanggal_daftar timestamp [default: `current_timestamp`]
  status_kehadiran varchar(20) [default: "tidak hadir", note: "Enum: tidak hadir, hadir"]
}
*/
