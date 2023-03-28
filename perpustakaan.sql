-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Des 2019 pada 19.36
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_literasi_umum`
--

CREATE TABLE `buku_literasi_umum` (
  `kode_buku_literasi` varchar(7) NOT NULL,
  `judul_buku_literasi` varchar(100) NOT NULL,
  `id_penerbit` int(5) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `id_rak` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `gambar_sampul` varchar(30) NOT NULL,
  `deskripsi_buku` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku_literasi_umum`
--

INSERT INTO `buku_literasi_umum` (`kode_buku_literasi`, `judul_buku_literasi`, `id_penerbit`, `tahun_terbit`, `id_rak`, `id_kategori`, `gambar_sampul`, `deskripsi_buku`) VALUES
('ag2001', 'islam di asia tenggara', 7, 2000, 7, 4, '5e08e05bead75.png', '    bagaimana dakwah yang terjadi untuk penyebaran islam khususnya di asia tenggara'),
('fi1001', 'filsafat umum akal dan hati sejak thales sampai capra', 2, 2002, 2, 4, '5e08e1dc8ae4b.jpg', '  belajar filsafat semenjak lahirnya thales sekitar abad ke-5 sampai abad 21'),
('fi1002', 'filsafat ilmu', 5, 2009, 2, 2, 'filsafat.jpg', '  ilmu filsafat yang diperbincangkan oleh ahli ahlinya dan core of the core siaappp'),
('is3001', 'BJ.Habibie si jenius', 5, 2011, 4, 4, 'habibie.jpg', 'kejeniusan seorang presiden ke 3 indonesia digambarkan dalam buku ini '),
('is3002', 'manusia dan pendidikan', 1, 1999, 4, 4, 'manusia_dan_pendidikan.jpg', 'suatu analisa psikologi dan pendidikan'),
('ku0001', 'hayati', 1, 2010, 1, 1, 'hayati.jpg', ' mempelajari makhluk hidup yang berupa tumbuhan dengan hubungannya dengan makhluk lain'),
('sg001', 'zaman peralihan', 5, 2007, 10, 10, '5e08e73bab189.jpg', 'zaman dimana adaptasi seseorang untuk mau menggunakan alat yang bisa dibilang lebih modern dan canggih');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_mapel_kelas`
--

CREATE TABLE `buku_mapel_kelas` (
  `id_judul_buku_mapel` varchar(7) NOT NULL,
  `judul_buku_mapel` varchar(50) NOT NULL,
  `id_penerbit` int(5) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `untuk_kelas` varchar(5) NOT NULL,
  `gambar_sampul` varchar(30) NOT NULL,
  `stok` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku_mapel_kelas`
--

INSERT INTO `buku_mapel_kelas` (`id_judul_buku_mapel`, `judul_buku_mapel`, `id_penerbit`, `tahun_terbit`, `untuk_kelas`, `gambar_sampul`, `stok`) VALUES
('ag11', 'pendidikan agama islam(PAI XI)', 1, 2004, '11', 'agama11.jpg', 40),
('big10', 'bahasa inggris(BIG X)', 1, 2000, '10', 'binggris10.jpg', 120),
('big11', 'bahasa inggris (BIG XI)', 1, 2001, '11', 'binggris11.jpg', 33),
('big12', 'bahasa inggris(BIG XII)', 1, 2003, '12', 'binggris12.jpg', 152),
('bin10', 'bahasa indonesia(BIN X)', 1, 2002, '10', 'bindo10.jpg', 64),
('kim10', 'kimia(KIM X)', 1, 2003, '10', 'kimia10.jpg', 85),
('kim11', 'kimia(KIM XI)', 1, 2004, '11', 'kimia11.jpg', 76),
('mtk12', 'matematika(MTK XII)', 1, 2001, '12', 'buku_mtk.jpg', 55),
('pkn12', 'pendidikan kewarganegaraan(PKN XII)', 1, 2004, '12', 'bukupkn.jpg', 103);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_tahunan_siswa`
--

CREATE TABLE `buku_tahunan_siswa` (
  `id_judul_buku_tahunan` varchar(7) NOT NULL,
  `judul_buku_tahunan` varchar(50) NOT NULL,
  `id_penerbit` int(5) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `untuk_kelas` varchar(5) NOT NULL,
  `gambar_sampul` varchar(15) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku_tahunan_siswa`
--

INSERT INTO `buku_tahunan_siswa` (`id_judul_buku_tahunan`, `judul_buku_tahunan`, `id_penerbit`, `tahun_terbit`, `untuk_kelas`, `gambar_sampul`, `stok`) VALUES
('fis10', 'fisika(FIS X)', 1, 2003, '10', 'fisika10.jpg', 349),
('fis12', 'fisika(FIS XII)', 1, 2000, '12', 'fisika12.jpg', 341),
('mtk11', 'matematika(MTK XI)', 1, 2006, '11', 'mtk11.jpg', 361),
('pdk10', 'prakarya dan kewirausahaan(KWU X)', 1, 2000, '10', 'prakarya10.jpg', 356),
('pdk11', 'prakarya dan kewirausahaan(KWU XI)', 1, 2006, '11', 'prakarya11.jpg', 354),
('pdk12', 'prakarya dan kewirausahaan(KWU XII)', 1, 2005, '12', 'prakarya12.jpg', 349),
('pkn10', 'pendidikan kewarganegaraan(PKN X)', 1, 2001, '10', 'pkn10.jpg', 357),
('pkn11', 'pendidikan kewarganegaraan(PKN XI)', 1, 2009, '11', 'pkn11.jpg', 350),
('sbd10', 'seni budaya(SBD X)', 1, 2001, '10', 'senbud10.jpg', 357),
('sbd12', 'seni budaya(SBD XII)', 1, 2002, '12', 'senbud12.jpg', 350);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'karya umum'),
(2, 'filsafat'),
(3, 'agama'),
(4, 'ilmu sosial'),
(5, 'bahasa'),
(6, 'sains'),
(7, 'teknologi'),
(8, 'seni, olahraga'),
(9, 'kesusastraan'),
(10, 'sejarah, geografi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` varchar(10) NOT NULL,
  `jurusan` varchar(60) NOT NULL,
  `wali_kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `jurusan`, `wali_kelas`) VALUES
('xbkp', '10 bisnis kontruksi dan properti', 'andi wihatmoko'),
('xdpib1', '10 desain permodelan informasi bangunan 1', 'erik kustian'),
('xdpib2', '10 desain permodelan informasi bangunan 2', 'ilham jatmiko'),
('xibkp', '11 bisnis kontruksi dan properti', 'bambang wijayanto'),
('xidpib1', '11 desain permodelan informasi bangunan 1', 'erna ningtiyas'),
('xidpib2', '11 desain permodelan informasi bangunan 2', 'galeh sandi'),
('xiibkp', '12 bisnis kontruksi dan properti', 'ayu rahayu'),
('xiidpib1', '12 desain permodelan informasi bangunan 1', 'kuswari'),
('xiidpib2', '12 desain permodelan informasi bangunan 2', 'hari purnomo'),
('xiitbo', '12 teknik bodi otomotif', 'tian amelia'),
('xiitbsm1', '12 teknik bisnis sepeda motor 1', 'sutanto'),
('xiitbsm2', '12 teknik bisnis sepeda motor 2', 'eko yulianto'),
('xiitbsm3', '12 teknik bisnis sepeda motor 3', 'lutfi ahmad'),
('xiitei1', '12 teknik elektronika industri 1', 'husein sahab'),
('xiitei2', '12 teknik elektronika industri 2', 'firmansyah'),
('xiitkro1', '12 teknik kendaraan ringan otomotif 1', 'abdurrahman'),
('xiitkro2', '12 teknik kendaraan ringan otomotif 2', 'dayat sugianto'),
('xiitkro3', '12 teknik kendaraan ringan otomotif 3', 'badrus sholeh'),
('xitbo', '11 teknik bodi otomotif', 'sugeng efendi'),
('xitbsm1', '11 teknik bisnis sepeda motor 1', 'aji setiyo'),
('xitbsm2', '11 teknik bisnis sepeda motor 2', 'edi fausi'),
('xitbsm3', '11 teknik bisnis sepeda motor 3', 'abu hasan'),
('xitei1', '11 teknik elektronika industri 1', 'agus paryoga'),
('xitei2', '11 teknik elektronika industri 2', 'ali ahmad'),
('xitkro1', '11 teknik kendaraan ringan otomotif 1', 'anang giansyah'),
('xitkro2', '11 teknik kendaraan ringan otomotif 2', 'herman joyo'),
('xitkro3', '11 teknik kendaraan ringan otomotif 3', 'sulistiyowati'),
('xtbo', '10 teknik bodi otomotif', 'sugiono arif'),
('xtbsm1', '10 teknik bisnis sepeda motor 1', 'tika wijayanti'),
('xtbsm2', '10 teknik bisnis sepeda motor 2', 'rahman darsono'),
('xtbsm3', '10 teknik bisnis sepeda motor 3', 'feri agustiono'),
('xtei1', '10 teknik elektronika industri 1', 'wayu subo seto'),
('xtei2', '10 teknik elektronika industri 2', 'intan meriana'),
('xtkro1', '10 teknik kendaraan ringan otomotif 1', 'dewi kumala'),
('xtkro2', '10 teknik kendaraan ringan otomotif 2', 'andi seto'),
('xtkro3', '10 teknik kendaraan ringan otomotif 3', 'ahmad tanjung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member_perpus`
--

CREATE TABLE `member_perpus` (
  `nis` varchar(15) NOT NULL,
  `nama_siswa` varchar(30) NOT NULL,
  `jurusan` varchar(40) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member_perpus`
--

INSERT INTO `member_perpus` (`nis`, `nama_siswa`, `jurusan`, `no_telp`, `alamat`, `status`) VALUES
('235372372', 'ilham sanjaya', '12 teknik bisnis sepeda motor 2', '0829293728', 'jl. mawar', 'aktif'),
('3464236227', 'akbar hidayat', 'teknik kendaraan ringan otomotif', '082644738283', 'jl. kh hasyim asyari', 'aktif'),
('3464298267', 'yadi ahmad', 'teknik bodi otomotif', '089756364822', 'jl.diponegoro', 'aktif'),
('3467276227', 'agung joyo', 'teknik bisnis sepeda motor', '0829237382838', 'jl. perikanan darat', 'aktif'),
('3467298282', 'alex ahmad', 'teknik bodi otomotif', '082272725978', 'jl. ahmad dahlan', 'aktif'),
('45645653', 'ilham', 'tbo', '08932428239', 'jl.fughefewbv', 'aktif'),
('4594/022/003', 'ahmad fatoni', '', '', '', 'tidak aktif'),
('4595/023/003', 'ahmad sibil kohron', '', '', '', 'tidak aktif'),
('4596/024/003', 'anton tri wijaya', '', '', '', 'tidak aktif'),
('45960/028/003', 'feri irawan', '', '', '', 'tidak aktif'),
('459601/029/003', 'irwan ardiansyah', '', '', '', 'tidak aktif'),
('459602/030/003', 'marisa yuni sukmawati', '', '', '', 'tidak aktif'),
('459603/031/003', 'maulana firman', '', '', '', 'tidak aktif'),
('459605/033/003', 'mohammad daniel tangka', '', '', '', 'tidak aktif'),
('459606/034/003', 'mohammad edo fernando zegi', '', '', '', 'tidak aktif'),
('459607/035/003', 'mohammad fahrul falidan', '', '', '', 'tidak aktif'),
('459608/036/003', 'mohammad hairul anam', '', '', '', 'tidak aktif'),
('4597/025/003', 'auliya ali sofyan', '', '', '', 'tidak aktif'),
('4598/026/003', 'bramadya lukmana', '', '', '', 'tidak aktif'),
('4599/027/003', 'ferdian angga dwi kurniawan', '', '', '', 'tidak aktif'),
('46010/038/003', 'mohammad wilyanto', '', '', '', 'tidak aktif'),
('46011/039/003', 'rofi\'an azizi', '', '', '', 'tidak aktif'),
('4609/037/003', 'mohammad rofi\'i', '', '', '', 'tidak aktif'),
('4987436538', 'irfan', 'tbo', '08932428239', 'jl.fughefewbv', 'terkonfirmasi'),
('534643645', 'ilham sanjaya', 'tbo', '087274248244', 'jl.fughefewewt', 'aktif'),
('anggi', 'asaadasd', 'bisnis kontruksi dan properti ', '08737237233', 'jl. perikanan darat', 'tidak aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_buku_literasi`
--

CREATE TABLE `peminjaman_buku_literasi` (
  `id_pinjam_buku_literasi` int(5) NOT NULL,
  `kode_buku_literasi` varchar(7) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `tanggal_peminjaman` varchar(20) NOT NULL,
  `tanggal_hrs_kembali` varchar(20) NOT NULL,
  `notifikasi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman_buku_literasi`
--

INSERT INTO `peminjaman_buku_literasi` (`id_pinjam_buku_literasi`, `kode_buku_literasi`, `nis`, `tanggal_peminjaman`, `tanggal_hrs_kembali`, `notifikasi`) VALUES
(105, 'fi1001', '3464236227', '2019-11-12', '2019-11-19', 'kembali'),
(155, 'is3002', '3467276227', '2019-12-01', '2019-12-08', 'kembali'),
(164, 'fi1002', '4987436538', '2019-12-23', '2019-12-30', 'masa pinjam'),
(172, 'sg001', '45645653', '2019-12-30', '2020-01-06', 'masa pinjam'),
(173, 'sg001', '3467276227', '2019-12-15', '2019-12-22', 'masa pinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_buku_mapel`
--

CREATE TABLE `peminjaman_buku_mapel` (
  `id_pinjam_buku_mapel` int(7) NOT NULL,
  `id_judul_buku_mapel` varchar(7) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `nama_peminjam` varchar(30) NOT NULL,
  `waktu_peminjaman` varchar(40) NOT NULL,
  `banyak_buku` int(5) NOT NULL,
  `notifikasi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman_buku_mapel`
--

INSERT INTO `peminjaman_buku_mapel` (`id_pinjam_buku_mapel`, `id_judul_buku_mapel`, `kode_kelas`, `nama_peminjam`, `waktu_peminjaman`, `banyak_buku`, `notifikasi`) VALUES
(544, 'big10', 'xiitbsm1', 'yudi iriyanto', '10:01, 28 December 2019', 24, 'kembali'),
(545, 'mtk12', 'xibkp', 'agus susanto', '11:57, 28 December 2019', 24, 'kembali'),
(546, 'mtk12', 'xdpib2', 'aris rahman', '12:01, 28 December 2019', 20, 'kembali'),
(547, 'ag11', 'xiidpib2', 'arif', '18:04, 29 December 2019', 20, 'kembali'),
(548, 'ag11', 'xbkp', 'yy', '18:41, 29 December 2019', 14, 'kembali'),
(549, 'ag11', 'xibkp', 'aa', '18:58, 29 December 2019', 20, 'kembali');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_buku_tahunan`
--

CREATE TABLE `peminjaman_buku_tahunan` (
  `id_pinjam_buku_tahunan` int(5) NOT NULL,
  `id_judul_buku_tahunan` varchar(7) NOT NULL,
  `kode_buku_tahunan` varchar(5) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `tanggal_peminjaman` varchar(20) NOT NULL,
  `tanggal_hrs_kembali` varchar(20) NOT NULL,
  `notifikasi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman_buku_tahunan`
--

INSERT INTO `peminjaman_buku_tahunan` (`id_pinjam_buku_tahunan`, `id_judul_buku_tahunan`, `kode_buku_tahunan`, `nis`, `tanggal_peminjaman`, `tanggal_hrs_kembali`, `notifikasi`) VALUES
(99, 'fis10', 'coba4', '3464236227', '2019-12-03', '2020-12-02', 'kembali'),
(111, 'fis12', '125', '4987436538', '2019-12-24', '2020-12-23', 'masa pinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(5) NOT NULL,
  `nama_penerbit` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`) VALUES
(1, 'erlangga'),
(2, 'elexmedia komputindo'),
(3, 'andi publisher'),
(4, 'gagas media'),
(5, 'grasindo'),
(6, 'gramedia pustaka utama'),
(7, 'agro media '),
(8, 'mizan'),
(9, 'noura books'),
(14, 'empat serangkai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian_buku_literasi`
--

CREATE TABLE `pengembalian_buku_literasi` (
  `id_kembali_literasi` int(5) NOT NULL,
  `id_pinjam_buku_literasi` int(5) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `terlambat` int(5) NOT NULL,
  `denda` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian_buku_literasi`
--

INSERT INTO `pengembalian_buku_literasi` (`id_kembali_literasi`, `id_pinjam_buku_literasi`, `tanggal_pengembalian`, `terlambat`, `denda`) VALUES
(1, 105, '2019-11-16', 0, '0'),
(19, 155, '2019-12-17', 9, '9000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian_buku_mapel`
--

CREATE TABLE `pengembalian_buku_mapel` (
  `id_kembali_mapel` int(5) NOT NULL,
  `id_pinjam_buku_mapel` int(5) NOT NULL,
  `nama_pengembali` varchar(30) NOT NULL,
  `waktu_pengembalian` varchar(40) NOT NULL,
  `banyak_buku_kembali` int(5) NOT NULL,
  `buku_kurang` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian_buku_mapel`
--

INSERT INTO `pengembalian_buku_mapel` (`id_kembali_mapel`, `id_pinjam_buku_mapel`, `nama_pengembali`, `waktu_pengembalian`, `banyak_buku_kembali`, `buku_kurang`) VALUES
(56, 544, 'yudi iriyanto', '11:21, 28 December 2019', 24, 0),
(57, 545, 'agus susanto', '11:58, 28 December 2019', 24, 0),
(58, 546, 'aris rahman', '12:02, 28 December 2019', 20, 0),
(59, 547, 'arif', '18:05, 29 December 2019', 20, 0),
(60, 548, 'yy', '18:41, 29 December 2019', 14, 0),
(61, 549, 'aa', '18:58, 29 December 2019', 20, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian_buku_tahunan`
--

CREATE TABLE `pengembalian_buku_tahunan` (
  `id_pengembalian_tahunan` int(5) NOT NULL,
  `id_pinjam_buku_tahunan` int(5) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `terlambat` int(5) NOT NULL,
  `denda` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian_buku_tahunan`
--

INSERT INTO `pengembalian_buku_tahunan` (`id_pengembalian_tahunan`, `id_pinjam_buku_tahunan`, `tanggal_pengembalian`, `terlambat`, `denda`) VALUES
(21, 99, '2019-12-03', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengunjung_siswa`
--

CREATE TABLE `pengunjung_siswa` (
  `id_pengunjung` int(5) NOT NULL,
  `tanggal_absensi` varchar(25) NOT NULL,
  `nama_siswa` varchar(30) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `keperluan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengunjung_siswa`
--

INSERT INTO `pengunjung_siswa` (`id_pengunjung`, `tanggal_absensi`, `nama_siswa`, `kode_kelas`, `keperluan`) VALUES
(271, '2019-12-28', 'anwar husaini', 'xibkp', 'meminjam buku'),
(274, '2019-12-30', 'aji pratama', 'xiitbsm1', 'membaca buku'),
(275, '2019-12-11', 'yudi iriyanto', 'xiitbsm2', 'meminjam buku'),
(276, '2019-12-10', 'riko antono', 'xiitei2', 'mencari referensi mengerjakan tugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pustakawan`
--

CREATE TABLE `pustakawan` (
  `nip` int(18) NOT NULL,
  `nama_pustakawan` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pustakawan`
--

INSERT INTO `pustakawan` (`nip`, `nama_pustakawan`, `username`, `password`) VALUES
(237632, 'anwar husaini', 'anwar', '$2y$10$euUNHgi/gAEETXs/NfkV3ep.6ChMTJNlv7PDX2IDplGUSx0Cgw9QW'),
(4536537, 'ahmad andi', 'ahmad', '$2y$10$uiwaz5QhMAPp09DsnEE7VujvedHYfgVU15MmJN5mUNjwagXuyom7O'),
(23543545, 'yudi riyanto', 'yudi', '$2y$10$IoRh8Ul5K2mZI3xxW/go.uWpVQuOWh91S6oeYp.0rgFDfyR.nkc2y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak`
--

CREATE TABLE `rak` (
  `id_rak` int(5) NOT NULL,
  `no_rak` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rak`
--

INSERT INTO `rak` (`id_rak`, `no_rak`) VALUES
(1, '0001'),
(2, '1001'),
(3, '2001'),
(4, '3001'),
(5, '4001'),
(6, '5001'),
(7, '6001'),
(8, '7001'),
(9, '8001'),
(10, '9001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE `tamu` (
  `id_tamu` int(5) NOT NULL,
  `nama_tamu` varchar(30) NOT NULL,
  `delegasi` varchar(30) NOT NULL,
  `kepentingan` varchar(50) NOT NULL,
  `tanggal_kedatangan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tamu`
--

INSERT INTO `tamu` (`id_tamu`, `nama_tamu`, `delegasi`, `kepentingan`, `tanggal_kedatangan`) VALUES
(1, 'vika ayuni', 'universitas jember', 'wawancara ', '2019-12-11'),
(2, 'umam ahmad', 'universitas jember', 'wawancara', '2019-12-12'),
(3, 'rafi anto', 'sma 1 bondowoso', 'membaca buku referensi', '2019-12-13'),
(4, 'burhan hakim', 'sma 1 bondowoso', 'membaca buku referensi', '2019-12-14'),
(5, 'agus herman', 'politeknik negeri jember', 'observasi alur peminjaman perpustakaan', '2019-12-15'),
(6, 'niken mersita', 'politeknik negeri jember', 'observasi alur peminjaman perpustakaan', '2019-12-16'),
(7, 'budi cahyanto', 'universitas banyuwangi', 'observasi sistem informasi perpustakaan', '2019-12-17'),
(8, 'galeh iimron', 'universitas banyuwangi', 'observasi sistem informasi perpustakaan', '2019-12-18'),
(9, 'desti tiara', 'perusahaan gramedia ', 'pengecekan kelengkapan buku sekolah', '2019-12-19'),
(10, 'rudi hartono', 'perusahaan senyum media', 'menawarkan buku edukasi', '2019-12-20'),
(11, 'agung ahmad', 'politeknik negeri jember', 'wawancara ', '2019-12-28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku_literasi_umum`
--
ALTER TABLE `buku_literasi_umum`
  ADD PRIMARY KEY (`kode_buku_literasi`),
  ADD KEY `id_penerbit` (`id_penerbit`),
  ADD KEY `id_rak` (`id_rak`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `buku_mapel_kelas`
--
ALTER TABLE `buku_mapel_kelas`
  ADD PRIMARY KEY (`id_judul_buku_mapel`),
  ADD KEY `id_penerbit` (`id_penerbit`);

--
-- Indeks untuk tabel `buku_tahunan_siswa`
--
ALTER TABLE `buku_tahunan_siswa`
  ADD PRIMARY KEY (`id_judul_buku_tahunan`),
  ADD KEY `id_penerbit` (`id_penerbit`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kode_kelas`);

--
-- Indeks untuk tabel `member_perpus`
--
ALTER TABLE `member_perpus`
  ADD PRIMARY KEY (`nis`);

--
-- Indeks untuk tabel `peminjaman_buku_literasi`
--
ALTER TABLE `peminjaman_buku_literasi`
  ADD PRIMARY KEY (`id_pinjam_buku_literasi`),
  ADD KEY `kode_buku_literasi` (`kode_buku_literasi`) USING BTREE,
  ADD KEY `nis` (`nis`) USING BTREE;

--
-- Indeks untuk tabel `peminjaman_buku_mapel`
--
ALTER TABLE `peminjaman_buku_mapel`
  ADD PRIMARY KEY (`id_pinjam_buku_mapel`),
  ADD KEY `id_judul_buku_mapel` (`id_judul_buku_mapel`) USING BTREE,
  ADD KEY `kode_kelas` (`kode_kelas`) USING BTREE;

--
-- Indeks untuk tabel `peminjaman_buku_tahunan`
--
ALTER TABLE `peminjaman_buku_tahunan`
  ADD PRIMARY KEY (`id_pinjam_buku_tahunan`),
  ADD KEY `id_judul_buku_tahunan` (`id_judul_buku_tahunan`) USING BTREE,
  ADD KEY `nis` (`nis`) USING BTREE,
  ADD KEY `id_judul_buku_tahunan_2` (`id_judul_buku_tahunan`),
  ADD KEY `nis_2` (`nis`),
  ADD KEY `id_judul_buku_tahunan_3` (`id_judul_buku_tahunan`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indeks untuk tabel `pengembalian_buku_literasi`
--
ALTER TABLE `pengembalian_buku_literasi`
  ADD PRIMARY KEY (`id_kembali_literasi`),
  ADD UNIQUE KEY `id_pinjam_buku_literasi` (`id_pinjam_buku_literasi`),
  ADD KEY `id_pinjam_buku_literasi_2` (`id_pinjam_buku_literasi`);

--
-- Indeks untuk tabel `pengembalian_buku_mapel`
--
ALTER TABLE `pengembalian_buku_mapel`
  ADD PRIMARY KEY (`id_kembali_mapel`),
  ADD UNIQUE KEY `id_pinjam_buku_mapel` (`id_pinjam_buku_mapel`);

--
-- Indeks untuk tabel `pengembalian_buku_tahunan`
--
ALTER TABLE `pengembalian_buku_tahunan`
  ADD PRIMARY KEY (`id_pengembalian_tahunan`),
  ADD UNIQUE KEY `id_pinjam_buku_tahunan` (`id_pinjam_buku_tahunan`);

--
-- Indeks untuk tabel `pengunjung_siswa`
--
ALTER TABLE `pengunjung_siswa`
  ADD PRIMARY KEY (`id_pengunjung`),
  ADD KEY `kode_kelas` (`kode_kelas`) USING BTREE,
  ADD KEY `kode_kelas_2` (`kode_kelas`),
  ADD KEY `kode_kelas_3` (`kode_kelas`);

--
-- Indeks untuk tabel `pustakawan`
--
ALTER TABLE `pustakawan`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indeks untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_buku_literasi`
--
ALTER TABLE `peminjaman_buku_literasi`
  MODIFY `id_pinjam_buku_literasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_buku_mapel`
--
ALTER TABLE `peminjaman_buku_mapel`
  MODIFY `id_pinjam_buku_mapel` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=550;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_buku_tahunan`
--
ALTER TABLE `peminjaman_buku_tahunan`
  MODIFY `id_pinjam_buku_tahunan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pengembalian_buku_literasi`
--
ALTER TABLE `pengembalian_buku_literasi`
  MODIFY `id_kembali_literasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pengembalian_buku_mapel`
--
ALTER TABLE `pengembalian_buku_mapel`
  MODIFY `id_kembali_mapel` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `pengembalian_buku_tahunan`
--
ALTER TABLE `pengembalian_buku_tahunan`
  MODIFY `id_pengembalian_tahunan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pengunjung_siswa`
--
ALTER TABLE `pengunjung_siswa`
  MODIFY `id_pengunjung` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT untuk tabel `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id_tamu` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku_literasi_umum`
--
ALTER TABLE `buku_literasi_umum`
  ADD CONSTRAINT `buku_literasi_umum_ibfk_1` FOREIGN KEY (`id_rak`) REFERENCES `rak` (`id_rak`),
  ADD CONSTRAINT `buku_literasi_umum_ibfk_2` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`),
  ADD CONSTRAINT `buku_literasi_umum_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `buku_mapel_kelas`
--
ALTER TABLE `buku_mapel_kelas`
  ADD CONSTRAINT `buku_mapel_kelas_ibfk_1` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`);

--
-- Ketidakleluasaan untuk tabel `buku_tahunan_siswa`
--
ALTER TABLE `buku_tahunan_siswa`
  ADD CONSTRAINT `buku_tahunan_siswa_ibfk_1` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`);

--
-- Ketidakleluasaan untuk tabel `peminjaman_buku_literasi`
--
ALTER TABLE `peminjaman_buku_literasi`
  ADD CONSTRAINT `peminjaman_buku_literasi_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `member_perpus` (`nis`),
  ADD CONSTRAINT `peminjaman_buku_literasi_ibfk_3` FOREIGN KEY (`kode_buku_literasi`) REFERENCES `buku_literasi_umum` (`kode_buku_literasi`);

--
-- Ketidakleluasaan untuk tabel `peminjaman_buku_mapel`
--
ALTER TABLE `peminjaman_buku_mapel`
  ADD CONSTRAINT `peminjaman_buku_mapel_ibfk_2` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`),
  ADD CONSTRAINT `peminjaman_buku_mapel_ibfk_3` FOREIGN KEY (`id_judul_buku_mapel`) REFERENCES `buku_mapel_kelas` (`id_judul_buku_mapel`);

--
-- Ketidakleluasaan untuk tabel `peminjaman_buku_tahunan`
--
ALTER TABLE `peminjaman_buku_tahunan`
  ADD CONSTRAINT `peminjaman_buku_tahunan_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `member_perpus` (`nis`),
  ADD CONSTRAINT `peminjaman_buku_tahunan_ibfk_3` FOREIGN KEY (`id_judul_buku_tahunan`) REFERENCES `buku_tahunan_siswa` (`id_judul_buku_tahunan`);

--
-- Ketidakleluasaan untuk tabel `pengembalian_buku_literasi`
--
ALTER TABLE `pengembalian_buku_literasi`
  ADD CONSTRAINT `pengembalian_buku_literasi_ibfk_1` FOREIGN KEY (`id_pinjam_buku_literasi`) REFERENCES `peminjaman_buku_literasi` (`id_pinjam_buku_literasi`);

--
-- Ketidakleluasaan untuk tabel `pengembalian_buku_mapel`
--
ALTER TABLE `pengembalian_buku_mapel`
  ADD CONSTRAINT `pengembalian_buku_mapel_ibfk_1` FOREIGN KEY (`id_pinjam_buku_mapel`) REFERENCES `peminjaman_buku_mapel` (`id_pinjam_buku_mapel`);

--
-- Ketidakleluasaan untuk tabel `pengembalian_buku_tahunan`
--
ALTER TABLE `pengembalian_buku_tahunan`
  ADD CONSTRAINT `pengembalian_buku_tahunan_ibfk_1` FOREIGN KEY (`id_pinjam_buku_tahunan`) REFERENCES `peminjaman_buku_tahunan` (`id_pinjam_buku_tahunan`);

--
-- Ketidakleluasaan untuk tabel `pengunjung_siswa`
--
ALTER TABLE `pengunjung_siswa`
  ADD CONSTRAINT `pengunjung_siswa_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
