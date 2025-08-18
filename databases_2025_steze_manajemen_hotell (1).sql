-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2025 at 12:07 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `databases_2025_steze_manajemen_hotell`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_admin`
--

CREATE TABLE IF NOT EXISTS `data_admin` (
  `id_admin` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_admin`
--

INSERT INTO `data_admin` (`id_admin`, `id_hotel`, `nama`, `username`, `password`) VALUES
('ADM20250710063810359', 'HOT20250710063626968', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
('ADM20250718042547760', 'HOT20250710063548555', 'adminA', 'adminA', '91183e1cb4e46961f86a2ef6287927ad');

-- --------------------------------------------------------

--
-- Table structure for table `data_bank`
--

CREATE TABLE IF NOT EXISTS `data_bank` (
  `id_bank` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `rekening` varchar(250) DEFAULT NULL,
  `atas_nama` varchar(250) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_bank`
--

INSERT INTO `data_bank` (`id_bank`, `nama_bank`, `rekening`, `atas_nama`, `id_hotel`) VALUES
('BAN20250806031226162', 'bank mandiri', '3198837474', 'Steze Hotel', 'HOT20250710063626968'),
('BAN20250806031242220', 'none', 'none', 'Steze Hotel', 'HOT20250710063626968');

-- --------------------------------------------------------

--
-- Table structure for table `data_hapus_transaksi`
--

CREATE TABLE IF NOT EXISTS `data_hapus_transaksi` (
  `id_hapus_transaksi` varchar(50) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `id_pelanggan` varchar(50) NOT NULL,
  `id_kamar` varchar(50) NOT NULL,
  `waktu_checkin` date NOT NULL,
  `waktu_checkout` date NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `harga` varchar(60) NOT NULL,
  `metode_transaksi` varchar(60) NOT NULL,
  `jumlah_dewasa` varchar(10) NOT NULL,
  `jumlah_anak_anak` varchar(10) NOT NULL,
  `discount` varchar(10) NOT NULL,
  `status_transaksi` enum('Booking','Belum Lunas','Lunas','Selesai') NOT NULL,
  `id_hotel` varchar(60) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_hapus_transaksi`
--

INSERT INTO `data_hapus_transaksi` (`id_hapus_transaksi`, `id_transaksi`, `id_pelanggan`, `id_kamar`, `waktu_checkin`, `waktu_checkout`, `no_rekening`, `harga`, `metode_transaksi`, `jumlah_dewasa`, `jumlah_anak_anak`, `discount`, `status_transaksi`, `id_hotel`, `tanggal`, `id_admin`) VALUES
('', 'TRA20250806090324106', 'PEL20250715065839276', 'KAM20250710085556471', '2025-08-06', '2025-08-08', '3198837474', '300000', 'MET20250806031339605', '2', '0', '0', 'Selesai', 'HOT20250710063626968', '2025-08-09 11:32:05', ''),
('HAP20250811153009662', 'TRA20250811152640121', 'PEL20250715065839276', 'KAM20250715065633581', '2025-08-12', '2025-08-15', 'none', '540000', 'Tunai', '2', '0', '0', 'Lunas', '', '2025-08-11 15:30:09', 'ADM20250710063810359');

-- --------------------------------------------------------

--
-- Table structure for table `data_hotel`
--

CREATE TABLE IF NOT EXISTS `data_hotel` (
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(50) DEFAULT NULL,
  `koordinat` varchar(250) DEFAULT NULL,
  `gambar` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_hotel`
--

INSERT INTO `data_hotel` (`id_hotel`, `nama`, `alamat`, `no_telepon`, `koordinat`, `gambar`) VALUES
('HOT20250710063548555', 'Sipin', 'Jl. Syamsu Bahroen No.12, Selamat, Kec. Telanaipura, Kota Jambi, Jambi 36124', '2129707600', '-6.198290958000439,106.81770801544191', '1754638585-71504-sipin.webp'),
('HOT20250710063626968', 'Nusa Indah 1', 'Jl. Nusa Indah I, Rw. Sari, Kec. Kota Baru, Kota Jambi, Jambi 36361', '82184614212', '-6.200117527420315,106.81715011596681', '1754638334-52363-nusa_indah1.webp'),
('HOT20250710063726341', 'Nusa Indah 3', 'Jl. Nusa Indah 3 RT 8, Rawasari Kec. Alam Barajo, Rawasari, Kec. Kota Baru 36124', '82173027422', '-6.199946870107371,106.81783676147462', '1754638664-74075-nusa indah3.webp'),
('HOT202507100637263410', 'Telanaipura 1', 'Jl. Pakis II No.44, Pematang Sulur, Kec. Telanaipura, Kota Jambi, Jambi 36361', '82177912506', '-6.200288184678057,106.81766510009767', '1754638880-89063-telanai1.jpg'),
('HOT202507100637263411', 'Telanaipura 2', 'Jl. RE. Marta Dinata No.47, RT.04, Telanaipura, Kec. Telanaipura, Kota Jambi 36122', '82136008756', '-6.199946870107371,106.81715011596681', '1754639050-21986-telanai2.webp'),
('HOT202507100637263412', 'Mendalo', '9GVF+W64, Mendalo Darat, Kec. Jambi Luar Kota, Kabupaten Muaro Jambi, Jambi 36361', '2129707601', '-6.200117527420315,106.81697845458986', '1754639294-63973-mendalo.jpg'),
('HOT20250710063726343', 'Kota Baru', 'Jl. Pintu Besi, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129', '82177912507', '-6.199946870107371,106.81732177734376', '1754639461-28514-kota baru.webp'),
('HOT20250710063726344', 'Tehok 1', 'Lrg. Jelita, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36123', '82185045406', '-6.200117527420315,106.81697845458986', '1754639566-59875-tehok 1.webp'),
('HOT20250710063726345', 'Tehok 2', 'Jl. Dr. Mawardi, RT.001/RW.01, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36122', '82282103560', '-6.200288184678057,106.81697845458986', '1754639730-63959-thehok2.webp'),
('HOT20250710063726346', 'Talang Banjar', 'Budiman, Kec. Jambi Tim., Kota Jambi, Jambi 36123', '82184548411', '-6.200117527420315,106.81715011596681', '1754639814-76851-talangbanjar.jpg'),
('HOT20250710063726347', 'Haji Kamil', 'Jl. Angkasa Puri No.74-60, Pasir Putih, Kec. Jambi Sel., Kota Jambi, Jambi 36129', '87840695290', '-6.200288184678057,106.81697845458986', '1754639971-63728-pasirputih.webp');

-- --------------------------------------------------------

--
-- Table structure for table `data_kamar`
--

CREATE TABLE IF NOT EXISTS `data_kamar` (
  `id_kamar` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `harga_harian` varchar(100) NOT NULL,
  `harga_bulanan` varchar(30) NOT NULL,
  `no_kamar` varchar(30) NOT NULL,
  `id_tipe_kamar` varchar(50) NOT NULL,
  `status_kamar` enum('Terisi','Kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kamar`
--

INSERT INTO `data_kamar` (`id_kamar`, `id_hotel`, `kapasitas`, `harga_harian`, `harga_bulanan`, `no_kamar`, `id_tipe_kamar`, `status_kamar`) VALUES
('KAM20250710085556471', 'HOT20250710063626968', '2', '150000', '4500000', '1', 'TIP20250710064026817', 'Terisi'),
('KAM20250710085622157', 'HOT20250710063626968', '2', '150000', '4500000', '2', 'TIP20250710064026817', 'Terisi'),
('KAM20250715065633581', 'HOT20250710063626968', '4', '180000', '5400000', '3', 'TIP20250710064017527', 'Terisi'),
('KAM20250717045522633', 'HOT20250710063626968', '2', '180000', '5400000', '4', 'TIP20250710064026817', 'Terisi'),
('KAM20250718042727162', 'HOT20250710063548555', '2', '130000', '3900000', '1', 'TIP20250710064026817', 'Kosong'),
('KAM20250718042757517', 'HOT20250710063548555', '4', '180000', '6000000', '2', 'TIP20250710064017527', 'Kosong'),
('KAM20250730035628305', 'HOT20250710063626968', '12', '150000', '0', '4', 'TIP20250710064017527', 'Terisi'),
('KAM20250730040511945', 'HOT20250710063626968', '3', '15000', '15000000', '5', 'TIP20250710064017527', 'Kosong'),
('KAM20250730040511946', 'HOT20250710063626968', '3', '15000', '15000000', '5', 'TIP20250710064017527', 'Kosong'),
('KAM20250730040511947', 'HOT20250710063626968', '3', '15000', '15000000', '5', 'TIP20250710064017527', 'Kosong'),
('KAM20250730040511948', 'HOT20250710063626968', '3', '15000', '15000000', '5', 'TIP20250710064017527', 'Kosong'),
('KAM20250730040511944', 'HOT20250710063626968', '3', '15000', '15000000', '5', 'TIP20250710064017527', 'Kosong');

-- --------------------------------------------------------

--
-- Table structure for table `data_metode_pembayaran`
--

CREATE TABLE IF NOT EXISTS `data_metode_pembayaran` (
  `id_metode_pembayaran` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `id_bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_metode_pembayaran`
--

INSERT INTO `data_metode_pembayaran` (`id_metode_pembayaran`, `id_hotel`, `metode_pembayaran`, `id_bank`) VALUES
('MET20250806031305618', 'HOT20250710063626968', 'Tunai', 'BAN20250806031242220'),
('MET20250806031324936', 'HOT20250710063626968', 'QRIS', 'BAN20250806031242220'),
('MET20250806031339605', 'HOT20250710063626968', 'Transfer Tunai', 'BAN20250806031226162');

-- --------------------------------------------------------

--
-- Table structure for table `data_operasional`
--

CREATE TABLE IF NOT EXISTS `data_operasional` (
  `id_operasional` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `operasional` varchar(100) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `keperluan` text NOT NULL,
  `biaya` varchar(30) NOT NULL,
  `id_admin` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_operasional`
--

INSERT INTO `data_operasional` (`id_operasional`, `id_hotel`, `tanggal`, `operasional`, `jumlah`, `keperluan`, `biaya`, `id_admin`) VALUES
('OPE20250809055903657', 'HOT20250710063626968', '2025-08-09', 'ATK hotel', '10 set', 'Isi ulang ATK hotel', '200000', 'ADM20250710063810359');

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggan`
--

CREATE TABLE IF NOT EXISTS `data_pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pelanggan`
--

INSERT INTO `data_pelanggan` (`id_pelanggan`, `nama`, `jenis_kelamin`, `id_hotel`, `no_hp`) VALUES
('PEL20250714082108440', 'Rianti', 'perempuan', 'HOT20250710063626968', '8349394234'),
('PEL20250715065839276', 'Rangga Aditya', 'laki-laki', 'HOT20250710063626968', '876435532'),
('PEL20250715070034707', 'Fatma Fiani', 'perempuan', 'HOT20250710063626968', '837443722'),
('PEL20250717043546608', 'vioni', 'perempuan', 'HOT20250710063626968', '8734634'),
('PEL20250717045213800', 'ahmad sarkowi', 'laki-laki', 'HOT20250710063626968', '9384377433'),
('PEL20250722095444394', 'Rani Samanta', 'perempuan', 'HOT20250710063626968', '8937473743'),
('PEL20250809060403879', 'ramadhana', 'laki-laki', 'HOT20250710063626968', '08372626525'),
('PEL20250812043404533', 'Fajaruddin', 'laki-laki', 'HOT20250710063626968', '08967332233');

-- --------------------------------------------------------

--
-- Table structure for table `data_pengaturan_printer`
--

CREATE TABLE IF NOT EXISTS `data_pengaturan_printer` (
  `id_pengaturan_printer` varchar(50) NOT NULL DEFAULT '',
  `nama_printer_nota` varchar(100) DEFAULT NULL,
  `ukuran_kertas` enum('32','48') NOT NULL,
  `pengaturan_cash_drawer` enum('matikan','sebelum cetak','setelah cetak') DEFAULT NULL,
  `nama_printer_laporan` varchar(100) DEFAULT NULL,
  `gambar_logo` varchar(250) DEFAULT NULL,
  `header1` varchar(100) DEFAULT NULL,
  `header2` varchar(100) DEFAULT NULL,
  `header3` varchar(100) DEFAULT NULL,
  `footer1` varchar(100) DEFAULT NULL,
  `footer2` varchar(100) DEFAULT NULL,
  `footer3` varchar(100) DEFAULT NULL,
  `nota_email` enum('ya','tidak') DEFAULT NULL,
  `email_sumber` varchar(100) DEFAULT NULL,
  `nota_wa` enum('ya','tidak') DEFAULT NULL,
  `no_wa_sumber` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pengaturan_printer`
--

INSERT INTO `data_pengaturan_printer` (`id_pengaturan_printer`, `nama_printer_nota`, `ukuran_kertas`, `pengaturan_cash_drawer`, `nama_printer_laporan`, `gambar_logo`, `header1`, `header2`, `header3`, `footer1`, `footer2`, `footer3`, `nota_email`, `email_sumber`, `nota_wa`, `no_wa_sumber`) VALUES
('PEN1912001', 'RP58 Printer', '48', 'sebelum cetak', '-', '1754447802-36347-steze-2.png', 'SteZe', 'Jambi', 'Telp - (021) 29707600', 'Terima Kasih', '-', 'SteZe Syariah Jambi', 'ya', 'fajarudinsidik@gmail.com', 'tidak', '85266383993');

-- --------------------------------------------------------

--
-- Table structure for table `data_pengelola`
--

CREATE TABLE IF NOT EXISTS `data_pengelola` (
  `id_pengelola` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pengelola`
--

INSERT INTO `data_pengelola` (`id_pengelola`, `nama`, `username`, `password`) VALUES
('PEN2334RTT', 'pengelola', 'pengelola', '3c7913bc17671596a43dcb4581992bdf');

-- --------------------------------------------------------

--
-- Table structure for table `data_tipe_kamar`
--

CREATE TABLE IF NOT EXISTS `data_tipe_kamar` (
  `id_tipe_kamar` varchar(50) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `id_hotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_tipe_kamar`
--

INSERT INTO `data_tipe_kamar` (`id_tipe_kamar`, `tipe_kamar`, `id_hotel`) VALUES
('TIP20250710064017527', 'deluxe', 'HOT20250710063626968'),
('TIP20250710064026817', 'twin', 'HOT20250710063626968');

-- --------------------------------------------------------

--
-- Table structure for table `data_transaksi`
--

CREATE TABLE IF NOT EXISTS `data_transaksi` (
  `id_transaksi` varchar(50) NOT NULL,
  `id_pelanggan` varchar(50) NOT NULL,
  `id_kamar` varchar(50) NOT NULL,
  `waktu_checkin` date NOT NULL,
  `waktu_checkout` date NOT NULL,
  `no_rekening` varchar(300) NOT NULL,
  `harga` varchar(300) NOT NULL,
  `metode_transaksi` varchar(100) NOT NULL,
  `jumlah_dewasa` varchar(10) NOT NULL,
  `jumlah_anak_anak` varchar(10) NOT NULL,
  `discount` varchar(10) NOT NULL,
  `status_transaksi` enum('Belum Lunas','Lunas','Selesai') NOT NULL,
  `nama_pelanggan` varchar(250) DEFAULT NULL,
  `no_hp_pelanggan` varchar(50) DEFAULT NULL,
  `no_kamar` varchar(50) DEFAULT NULL,
  `tipe_kamar` varchar(50) DEFAULT NULL,
  `jam_checkin` time DEFAULT NULL,
  `jam_checkout` time DEFAULT NULL,
  `jumlah_hari` int(10) DEFAULT NULL,
  `jenis_transaksi` enum('harian','bulanan') DEFAULT NULL,
  `id_admin` varchar(50) DEFAULT NULL,
  `nama_admin` varchar(250) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL,
  `nama_hotel` varchar(50) DEFAULT NULL,
  `waktu_transaksi` datetime DEFAULT NULL,
  `id_bank` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(250) DEFAULT NULL,
  `nominal_bayar` varchar(50) DEFAULT NULL,
  `sisa_pembayaran` varchar(60) NOT NULL,
  `jumlah_kembalian` varchar(60) DEFAULT NULL,
  `biaya_tambahan_checkin` varchar(60) NOT NULL,
  `deskripsi_biaya_checkin` text NOT NULL,
  `biaya_tambahan_checkout` varchar(60) NOT NULL,
  `deskripsi_biaya_checkout` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_transaksi`
--

INSERT INTO `data_transaksi` (`id_transaksi`, `id_pelanggan`, `id_kamar`, `waktu_checkin`, `waktu_checkout`, `no_rekening`, `harga`, `metode_transaksi`, `jumlah_dewasa`, `jumlah_anak_anak`, `discount`, `status_transaksi`, `nama_pelanggan`, `no_hp_pelanggan`, `no_kamar`, `tipe_kamar`, `jam_checkin`, `jam_checkout`, `jumlah_hari`, `jenis_transaksi`, `id_admin`, `nama_admin`, `id_hotel`, `nama_hotel`, `waktu_transaksi`, `id_bank`, `nama_bank`, `nominal_bayar`, `sisa_pembayaran`, `jumlah_kembalian`, `biaya_tambahan_checkin`, `deskripsi_biaya_checkin`, `biaya_tambahan_checkout`, `deskripsi_biaya_checkout`) VALUES
('TRA20250806090531157', 'PEL20250715070034707', 'KAM20250710085622157', '2025-08-06', '2025-08-08', '3198837474', '300000', 'MET20250806031339605', '1', '0', '0', 'Selesai', 'Fatma Fiani', '837443722', '2', 'twin', '09:05:31', '09:05:31', 2, 'harian', 'ADM20250710063810359', 'admin', 'HOT20250710063626968', 'Nusa Indah 1', '2025-08-06 09:05:31', '', '', '', '', '', '', '', '', ''),
('TRA20250806090715972', 'PEL20250722095444394', 'KAM20250717045522633', '2025-08-06', '2025-08-09', '3198837474', '486000', 'Transfer Tunai', '2', '0', '10', 'Lunas', 'Rani Samanta', '8937473743', '4', 'twin', '09:07:15', '09:07:15', 3, 'harian', 'ADM20250710063810359', 'admin', 'HOT20250710063626968', 'Nusa Indah 1', '2025-08-06 09:07:15', '', '', '', '', '', '', '', '', ''),
('TRA20250809110459753', 'PEL20250809060403256', 'KAM20250710085622157', '2025-08-06', '2025-10-05', '-', '9000000', 'Tunai', '1', '1', '0', 'Lunas', 'ramadhana', '08372626525', '2', 'twin', '11:04:59', '11:04:59', 60, 'bulanan', 'ADM20250710063810359', 'admin', 'HOT20250710063626968', 'Nusa Indah 1', '2025-08-09 11:04:59', '', '', '', '', '', '', '', '', ''),
('TRA20250809111706667', 'PEL20250714082108440', 'KAM20250710085556471', '2025-08-09', '2025-08-12', '3198837474', '450000', 'MET20250806031305618', '1', '0', '0', 'Selesai', 'Rianti', '8349394234', '1', 'twin', '11:17:06', '11:17:06', 3, 'harian', 'ADM20250710063810359', 'admin', 'HOT20250710063626968', 'Nusa Indah 1', '2025-08-09 11:17:06', '', '', '', '', '', '', '', '', ''),
('TRA20250809114202330', 'PEL20250717045213800', 'KAM20250730035628305', '2025-08-09', '2025-08-11', '3198837474', '270000', 'Transfer Tunai', '2', '0', '10', 'Lunas', 'ahmad sarkowi', '9384377433', '4', 'deluxe', '11:42:02', '11:42:02', 2, 'harian', 'ADM20250710063810359', 'admin', 'HOT20250710063626968', 'Nusa Indah 1', '2025-08-09 11:42:02', '', '', '', '', '', '', '', '', ''),
('TRA20250811170822737', 'PEL20250714082108440', 'KAM20250715065633581', '2025-08-12', '2025-08-15', 'none', '640000', 'MET20250806031305618', '1', '0', '0', 'Lunas', 'Rianti', '8349394234', '3', 'deluxe', '17:08:22', '17:08:22', 3, 'harian', 'ADM20250710063810359', 'admin', 'HOT20250710063626968', 'Nusa Indah 1', '2025-08-11 17:08:22', 'BAN20250806031242220', 'none', '650000', '', '10000', '100000', 'extra bed', '', ''),
('TRA20250812094529829', 'PEL20250812043404533', 'KAM20250710085556471', '2025-08-12', '2025-10-11', 'none', '8030000', 'MET20250806031305618', '2', '2', '17', 'Lunas', 'Fajaruddin', '08967332233', '1', 'twin', '09:45:29', '09:45:29', 60, 'bulanan', 'ADM20250710063810359', 'admin', 'HOT20250710063626968', 'Nusa Indah 1', '2025-08-12 09:45:29', 'BAN20250806031242220', 'none', '7500000', '', 'RpÂ 30.000', '200000', 'lupa bawa pulang sempak', '', ''),
('TRA20250812145629644', 'PEL20250812043404533', 'KAM20250730040511945', '2025-08-13', '2025-08-19', 'none', '190000', 'MET20250806031305618', '2', '2', '17', 'Selesai', 'Fajaruddin', '08967332233', '5', 'deluxe', '14:56:29', '14:56:29', 6, 'harian', 'ADM20250710063810359', 'admin', 'HOT20250710063626968', 'Nusa Indah 1', '2025-08-12 14:56:29', 'BAN20250806031242220', 'none', '200000', '', '', '100000', 'extra bed', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_hotel`
--
ALTER TABLE `data_hotel`
 ADD PRIMARY KEY (`id_hotel`);

--
-- Indexes for table `data_pengaturan_printer`
--
ALTER TABLE `data_pengaturan_printer`
 ADD PRIMARY KEY (`id_pengaturan_printer`);

--
-- Indexes for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
 ADD PRIMARY KEY (`id_transaksi`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
