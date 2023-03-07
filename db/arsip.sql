-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2021 pada 17.16
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bagian`
--

CREATE TABLE `tbl_bagian` (
  `id_bagian` int(10) NOT NULL,
  `nama_bagian` text DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_bagian`
--

INSERT INTO `tbl_bagian` (`id_bagian`, `nama_bagian`, `id_user`) VALUES
(26, 'Staf GM SDM', 2),
(27, 'Staf Adm Personalia', 2),
(28, 'Staf Pengembang Karir &amp; Konseling', 2),
(29, 'Staf Pengelolaan Kompetensi', 2),
(30, 'Staf Pengembangan Organisasi', 2),
(31, 'Staf Knowledge Management', 2),
(32, 'Supt. Pengembangan Karir &amp; Konseling', 2),
(33, 'Supt.Pengelolaan SDM &amp; Organisasi', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_disposisi`
--

CREATE TABLE `tbl_disposisi` (
  `id_disposisi` int(15) NOT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `nama_bagian` varchar(35) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `tgl_disposisi` date DEFAULT NULL,
  `no_urut` varchar(30) NOT NULL,
  `asal_surat` varchar(30) NOT NULL,
  `tgl_sm` date NOT NULL,
  `tgl_surat` date NOT NULL,
  `no_agenda` varchar(30) NOT NULL,
  `perihal` text NOT NULL,
  `kepada` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_disposisi`
--

INSERT INTO `tbl_disposisi` (`id_disposisi`, `no_surat`, `nama_bagian`, `catatan`, `tgl_disposisi`, `no_urut`, `asal_surat`, `tgl_sm`, `tgl_surat`, `no_agenda`, `perihal`, `kepada`) VALUES
(54, '010/S.Peng/FV/UBD/III/2021', 'Staf GM SDM', 'izinkan', '2021-06-08', 'D/001', 'Universitas Bina Darma', '0000-00-00', '0000-00-00', 'NA/001', 'Izin Penelitan Skripsi/TA', 'Pimpinan PT.Pusri Palembang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_klasifikasi`
--

CREATE TABLE `tbl_klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `nama_klasifikasi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_klasifikasi`
--

INSERT INTO `tbl_klasifikasi` (`id_klasifikasi`, `nama_klasifikasi`) VALUES
(1, 'Sangat Rahasia'),
(2, 'Rahasia/terbatas'),
(3, 'Biasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_lampiran`
--

CREATE TABLE `tbl_lampiran` (
  `id_lampiran` int(10) NOT NULL,
  `token_lampiran` varchar(100) NOT NULL,
  `nama_berkas` text DEFAULT NULL,
  `ukuran` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_lampiran`
--

INSERT INTO `tbl_lampiran` (`id_lampiran`, `token_lampiran`, `nama_berkas`, `ukuran`) VALUES
(77, '2845135b23a4b8bf0405271b373dfd30', 'SK_2.pdf', '123.81'),
(78, '3f71f5b3b7454c0a0ae607807d136466', 'SK_3.pdf', '121.53'),
(79, '604fcdae7ee8c8d57326d380d1f4e292', 'SK_31.pdf', '121.53'),
(76, '3f71f5b3b7454c0a0ae607807d136466', 'SK_1.pdf', '142.39'),
(73, 'aa68d08aebd86458b1e6e2349ed62afc', 'SM_2.pdf', '278.52'),
(74, '6c4c8d619597eabca326f27cd86610cb', 'SM_1.jpg', '106.98'),
(75, '1d91d8277c4eab7cbcb2910bfb1ed2cc', 'SM_4.jpg', '49.56'),
(80, '6b837a65e49bd9e0d18434d0945505c6', '23013-43460-1-PB.pdf', '481.17'),
(81, '2c20f7317d4186bc23e298c2d1d36bbd', '2889-5658-1-SM.pdf', '253'),
(82, '5b37467ac18b712ae56f0241e0b61915', '39191-75676620051-1-PB.pdf', '549.24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sk`
--

CREATE TABLE `tbl_sk` (
  `id_sk` int(10) NOT NULL,
  `no_surat` text DEFAULT NULL,
  `tgl_ns` date DEFAULT NULL,
  `pengirim` text NOT NULL,
  `penerima` text DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `id_bagian` int(10) NOT NULL,
  `token_lampiran` text DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `dibaca` int(1) NOT NULL,
  `disposisi` text NOT NULL,
  `peringatan` int(1) NOT NULL,
  `tgl_sk` date DEFAULT NULL,
  `kepada` text NOT NULL,
  `dari` text NOT NULL,
  `tembusan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sk`
--

INSERT INTO `tbl_sk` (`id_sk`, `no_surat`, `tgl_ns`, `pengirim`, `penerima`, `perihal`, `id_bagian`, `token_lampiran`, `id_user`, `dibaca`, `disposisi`, `peringatan`, `tgl_sk`, `kepada`, `dari`, `tembusan`) VALUES
(27, '25365/F/HM/TB200/IT/2020', '0000-00-00', '', NULL, 'Proposal Pengajuan Kerja Praktik', 0, '3f71f5b3b7454c0a0ae607807d136466', 3, 1, '', 0, '2021-06-11', 'Manager Corporate Social Responsibility', 'Departemen Pendidikan &amp; Pelatihan', 'Arsip'),
(28, '10515/F/SM/TB000/IT/2020', NULL, '', NULL, 'Undangan Rapat Koordinasi Survey Karyawan 2020', 0, '2845135b23a4b8bf0405271b373dfd30', 3, 0, '', 0, '2021-06-05', '- Manager PSDM &amp; Organisasi - Manager Ketenagakerjaan - Manager Diklat - Marlina (Supt. Pengelolan SDM &amp; Organisasi) - Kris Herjanto (Staf GM SDM) - Desi Pusrikasari (Staf Pengembangan Karir &amp; Konseling) - Metha Amelia Jalalludin (Staf Adm Pengelolan Kompetensi) - Yanur Arizka (Staf Pengembang Organisasi) - Andri Jutawan Saputra (Staf Knowledge Management)', 'GM SDM', 'Arsip'),
(29, '25214/F/DL/TB200/IT/2020', NULL, '', NULL, 'Penugasan Peserta Sharing Knowledge &rdquo;Laporan Konsolidasian&rdquo;', 0, '604fcdae7ee8c8d57326d380d1f4e292', 3, 1, '', 0, '2021-06-04', '*) Peserta Terlampir', 'Departemen Diklat', 'Manager Akuntansi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sm`
--

CREATE TABLE `tbl_sm` (
  `id_sm` int(10) NOT NULL,
  `no_surat` text DEFAULT NULL,
  `tgl_ns` date DEFAULT NULL,
  `no_asal` text DEFAULT NULL,
  `tgl_no_asal` date DEFAULT NULL,
  `pengirim` text DEFAULT NULL,
  `penerima` text DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `token_lampiran` varchar(100) DEFAULT NULL,
  `dibaca` int(1) NOT NULL,
  `disposisi` int(1) NOT NULL,
  `id_user` int(10) DEFAULT NULL,
  `tgl_sm` date DEFAULT NULL,
  `tgl_surat` date NOT NULL,
  `asal_surat` text NOT NULL,
  `no_agenda` varchar(20) NOT NULL,
  `klasifikasi` varchar(30) NOT NULL,
  `kepada` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sm`
--

INSERT INTO `tbl_sm` (`id_sm`, `no_surat`, `tgl_ns`, `no_asal`, `tgl_no_asal`, `pengirim`, `penerima`, `perihal`, `token_lampiran`, `dibaca`, `disposisi`, `id_user`, `tgl_sm`, `tgl_surat`, `asal_surat`, `no_agenda`, `klasifikasi`, `kepada`) VALUES
(50, '11/12/11/2019', NULL, NULL, NULL, NULL, 'Staf Adm Personalia', 'Penawaran Barang', '1d91d8277c4eab7cbcb2910bfb1ed2cc', 0, 0, 2, '2021-06-04', '2021-06-01', 'PT. MAJU JAYA SEJAHTERA', 'NA/003', 'Biasa', 'Pimpinan PT.Pusri Palembang'),
(48, '010/S.Peng/FV/UBD/III/2021', NULL, NULL, NULL, NULL, 'Staf Knowledge Management', 'Izin Penelitan Skripsi/TA', 'aa68d08aebd86458b1e6e2349ed62afc', 0, 0, 2, '2021-06-04', '2021-06-06', 'Universitas Bina Darma', 'NA/001', 'Biasa', 'Pimpinan PT.Pusri Palembang'),
(49, '152/AJII/KOP-PLG/0716', NULL, NULL, NULL, NULL, 'Staf GM SDM', 'Surat Pemberitahuan Kerjasama Badan Usaha PT.Pusri Palembang - COB Smart Plus', '6c4c8d619597eabca326f27cd86610cb', 0, 0, 2, '2021-06-04', '2021-06-12', 'PT.Asuransi Jiwa InHealth Indonesia', 'NA/002', 'Rahasia/terbatas', 'Seluruh Provider Managed Care '),
(52, '54645h', NULL, NULL, NULL, NULL, 'Staf Adm Personalia', 'dgfhfgh', '2c20f7317d4186bc23e298c2d1d36bbd', 0, 0, 2, '2021-06-04', '2021-06-04', 'asddsad', 'NA/004', 'Biasa', 'dfh'),
(53, 'dsfsdfsdf', NULL, NULL, NULL, NULL, 'Staf GM SDM', 'dsfds', '5b37467ac18b712ae56f0241e0b61915', 1, 0, 2, '2021-06-01', '2021-06-04', 'fsdfds', 'NA/005', 'Biasa', 'fsdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(30) DEFAULT NULL,
  `pengalaman` text DEFAULT NULL,
  `level` enum('s_admin','admin','user') DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `tgl_daftar` varchar(20) DEFAULT NULL,
  `terakhir_login` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `alamat`, `telp`, `pengalaman`, `level`, `status`, `tgl_daftar`, `terakhir_login`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'SUPER ADMIN', 'Super_admin@gmail.com', 'Palembang', '453454', 'ok', 's_admin', 'aktif', '07-5-2021 17:03:12', '04-06-2021 22:06:43'),
(2, 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'ADMIN', 'Andika@gmail.com', 'Ogan Komering Ulu', '4646546', 'ok', 'admin', 'aktif', '07-05-2021 17:30:08', '04-06-2021 22:10:06'),
(3, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'BAGIAN ADMINISTRASI', 'Septiawan@gmail.com', 'OKU', '0987775', 'ok', 'user', 'aktif', '07-05-2021 17:31:54', '04-06-2021 22:08:54');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indeks untuk tabel `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  ADD PRIMARY KEY (`id_disposisi`);

--
-- Indeks untuk tabel `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indeks untuk tabel `tbl_lampiran`
--
ALTER TABLE `tbl_lampiran`
  ADD PRIMARY KEY (`id_lampiran`);

--
-- Indeks untuk tabel `tbl_sk`
--
ALTER TABLE `tbl_sk`
  ADD PRIMARY KEY (`id_sk`);

--
-- Indeks untuk tabel `tbl_sm`
--
ALTER TABLE `tbl_sm`
  ADD PRIMARY KEY (`id_sm`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  MODIFY `id_bagian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  MODIFY `id_disposisi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_lampiran`
--
ALTER TABLE `tbl_lampiran`
  MODIFY `id_lampiran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `tbl_sk`
--
ALTER TABLE `tbl_sk`
  MODIFY `id_sk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tbl_sm`
--
ALTER TABLE `tbl_sm`
  MODIFY `id_sm` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
