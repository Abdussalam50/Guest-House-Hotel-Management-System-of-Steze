CREATE DATABASE IF NOT EXISTS `databases_2025_steze_manajemen_hotel`;

USE `databases_2025_steze_manajemen_hotel`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `data_admin`;

CREATE TABLE `data_admin` (
  `id_admin` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_admin` VALUES ("ADM20250710063810359","HOT20250710063626968","admin","admin","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250718042547760","HOT20250710063548555","adminA","adminA","91183e1cb4e46961f86a2ef6287927ad");


DROP TABLE IF EXISTS `data_bank`;

CREATE TABLE `data_bank` (
  `id_bank` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `rekening` varchar(250) DEFAULT NULL,
  `atas_nama` varchar(250) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `data_hotel`;

CREATE TABLE `data_hotel` (
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(50) DEFAULT NULL,
  `koordinat` varchar(250) DEFAULT NULL,
  `gambar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_hotel` VALUES ("HOT20250710063548555","Sipin","Jl. Syamsu Bahroen No.12, Selamat, Kec. Telanaipura, Kota Jambi, Jambi 36124",02129707600,"-6.198290958000439,106.81770801544191","1753951615-16299-sipin.jpg"),
("HOT20250710063626968","Nusa Indah 1","Jl. Nusa Indah I, Rw. Sari, Kec. Kota Baru, Kota Jambi, Jambi 36361",082184614212,"-6.200117527420315,106.81715011596681","1753951632-61135-nusa indah 1.jpg"),
("HOT20250710063726341","Nusa Indah 3","Jl. Nusa Indah 3 RT 8, Rawasari Kec. Alam Barajo, Rawasari, Kec. Kota Baru 36124",082173027422,"-6.199946870107371,106.81783676147462","1753951645-20913-nusa indah 3.jpg"),
("HOT202507100637263410","Telanaipura 1","Jl. Pakis II No.44, Pematang Sulur, Kec. Telanaipura, Kota Jambi, Jambi 36361",082177912506,"-6.200288184678057,106.81766510009767","1753951658-72937-telanai1.jpg"),
("HOT202507100637263411","Telanaipura 2","Jl. RE. Marta Dinata No.47, RT.04, Telanaipura, Kec. Telanaipura, Kota Jambi 36122",082136008756,"-6.199946870107371,106.81715011596681","1753951674-47132-telanai2.jpg"),
("HOT202507100637263412","Mendalo","9GVF+W64, Mendalo Darat, Kec. Jambi Luar Kota, Kabupaten Muaro Jambi, Jambi 36361",02129707601,"-6.200117527420315,106.81697845458986","1753951688-68511-mendalo.jpg"),
("HOT20250710063726343","Kota Baru","Jl. Pintu Besi, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129",082177912507,"-6.199946870107371,106.81732177734376","1753954438-80998-kotabaru.jpg"),
("HOT20250710063726344","Tehok 1","Lrg. Jelita, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36123",082185045406,"-6.200117527420315,106.81697845458986","1753954456-11067-thehok1.jpg"),
("HOT20250710063726345","Tehok 2","Jl. Dr. Mawardi, RT.001/RW.01, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36122",082282103560,"-6.200288184678057,106.81697845458986","1753954471-60245-thehok2.jpg"),
("HOT20250710063726346","Talang Banjar","Budiman, Kec. Jambi Tim., Kota Jambi, Jambi 36123",082184548411,"-6.200117527420315,106.81715011596681","1753954486-12258-talangbanjar.jpg"),
("HOT20250710063726347","Haji Kamil","Jl. Angkasa Puri No.74-60, Pasir Putih, Kec. Jambi Sel., Kota Jambi, Jambi 36129",087840695290,"-6.200288184678057,106.81697845458986","1753954500-18046-hajikamil.jpg");


DROP TABLE IF EXISTS `data_kamar`;

CREATE TABLE `data_kamar` (
  `id_kamar` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `harga_harian` varchar(100) NOT NULL,
  `harga_bulanan` varchar(30) NOT NULL,
  `no_kamar` varchar(30) NOT NULL,
  `id_tipe_kamar` varchar(50) NOT NULL,
  `status_kamar` enum('Terisi','Kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_kamar` VALUES ("KAM20250710085556471","HOT20250710063626968",2,150000,4500000,1,"TIP20250710064026817","Terisi"),
("KAM20250710085622157","HOT20250710063626968",2,150000,4500000,2,"TIP20250710064026817","Kosong"),
("KAM20250715065633581","HOT20250710063626968",4,180000,5400000,3,"TIP20250710064017527","Terisi"),
("KAM20250717045522633","HOT20250710063626968",2,180000,5400000,4,"TIP20250710064026817","Kosong"),
("KAM20250718042727162","HOT20250710063548555",2,130000,3900000,1,"TIP20250710064026817","Kosong"),
("KAM20250718042757517","HOT20250710063548555",4,180000,6000000,2,"TIP20250710064017527","Kosong"),
("KAM20250730035628305","HOT20250710063626968",12,150000,0,4,"TIP20250710064017527","Kosong"),
("KAM20250730040511945","HOT20250710063626968",3,15000,15000000,5,"TIP20250710064017527","Kosong"),
("KAM20250730040511946","HOT20250710063626968",3,15000,15000000,5,"TIP20250710064017527","Kosong"),
("KAM20250730040511947","HOT20250710063626968",3,15000,15000000,5,"TIP20250710064017527","Kosong"),
("KAM20250730040511948","HOT20250710063626968",3,15000,15000000,5,"TIP20250710064017527","Kosong"),
("KAM20250730040511944","HOT20250710063626968",3,15000,15000000,5,"TIP20250710064017527","Kosong");


DROP TABLE IF EXISTS `data_metode_pembayaran`;

CREATE TABLE `data_metode_pembayaran` (
  `id_metode_pembayaran` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `rekening` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_metode_pembayaran` VALUES ("MET20250723032909428","HOT20250710063626968","Tunai",254317),
("MET20250723042221522","HOT20250710063626968","QRIS",254317);


DROP TABLE IF EXISTS `data_operasional`;

CREATE TABLE `data_operasional` (
  `id_operasional` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `operasional` varchar(100) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `biaya` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_operasional` VALUES ("OPE20250714114543911","HOT20250710063626968","2025-07-18","Event Organizer",1,13000000),
("OPE20250719080252576","HOT20250710063626968","2025-07-18","ATK hotel","2 set",500000);


DROP TABLE IF EXISTS `data_pelanggan`;

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pelanggan` VALUES ("PEL20250714082108440","Rianti","perempuan","HOT20250710063626968",08349394234),
("PEL20250715065839276","Rangga Aditya","laki-laki","HOT20250710063626968",0876435532),
("PEL20250715070034707","Fatma Fiani","perempuan","HOT20250710063626968",0837443722),
("PEL20250717043546608","vioni","perempuan","HOT20250710063626968",08734634),
("PEL20250717045213800","ahmad sarkowi","laki-laki","HOT20250710063626968",09384377433),
("PEL20250722095444394","Rani Samanta","perempuan","HOT20250710063626968",08937473743);


DROP TABLE IF EXISTS `data_pengaturan_printer`;

CREATE TABLE `data_pengaturan_printer` (
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
  `no_wa_sumber` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pengaturan_printer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengaturan_printer` VALUES ("PEN1912001","RP58 Printer",48,"sebelum cetak","-","1753869444-68463-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",085266383993);


DROP TABLE IF EXISTS `data_pengelola`;

CREATE TABLE `data_pengelola` (
  `id_pengelola` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengelola` VALUES ("PEN2334RTT","pengelola","pengelola","3c7913bc17671596a43dcb4581992bdf");


DROP TABLE IF EXISTS `data_tipe_kamar`;

CREATE TABLE `data_tipe_kamar` (
  `id_tipe_kamar` varchar(50) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `id_hotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_tipe_kamar` VALUES ("TIP20250710064017527","deluxe","HOT20250710063626968"),
("TIP20250710064026817","twin","HOT20250710063626968");


DROP TABLE IF EXISTS `data_transaksi`;

CREATE TABLE `data_transaksi` (
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
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_transaksi` VALUES ("TRA20250719050303349","PEL20250714082108440","KAM20250710085556471","2025-07-19","2025-07-21",34883392,270000,"Tunai",2,0,10,"Selesai",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
("TRA20250719053039101","PEL20250717043546608","KAM20250710085622157","2025-07-19","2025-08-18",34883392,4500000,"QRIS",2,1,0,"Selesai",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
("TRA20250721055632997","PEL20250715070034707","KAM20250710085556471","2025-07-21","2025-07-22",2455783,150000,"QRIS",2,0,0,"Selesai",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
("TRA20250721060647571","PEL20250715065839276","KAM20250715065633581","2025-07-21","2025-07-23",2458584,360000,"Rekening",1,0,0,"Selesai",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
("TRA20250722091159685","PEL20250715070034707","KAM20250710085556471","2025-07-22","2025-07-23",2466784,150000,"tunai",1,1,0,"Selesai",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
("TRA20250722095514473","PEL20250722095444394","KAM20250710085622157","2025-07-22","2025-07-23",76363,150000,"tunai",1,0,0,"Selesai",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
("TRA20250722095706784","PEL20250714082108440","KAM20250715065633581","2025-07-22","2025-07-24",6345352,360000,"QRIS",2,0,0,"Belum Lunas",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
("TRA20250723042409541","PEL20250717045213800","KAM20250710085556471","2025-07-23","2025-07-24",789965,150000,"MET20250723042221522",1,0,0,"Lunas",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);


SET foreign_key_checks = 1;
CREATE DATABASE IF NOT EXISTS `databases_2025_steze_manajemen_hotel`;

USE `databases_2025_steze_manajemen_hotel`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `data_admin`;

CREATE TABLE `data_admin` (
  `id_admin` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_admin` VALUES ("ADM20250710063810359","HOT20250710063626968","admin","admin","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250718042547760","HOT20250710063548555","adminA","adminA","91183e1cb4e46961f86a2ef6287927ad");


DROP TABLE IF EXISTS `data_hotel`;

CREATE TABLE `data_hotel` (
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_hotel` VALUES ("HOT20250710063548555","Hotel A","jln ahmad dahlan depan saimen"),
("HOT20250710063626968","Hotel B","jln. Singadekane telanai pura"),
("HOT20250710063726341","Hotel C","Jln. Pertamina Kota Baru");


DROP TABLE IF EXISTS `data_kamar`;

CREATE TABLE `data_kamar` (
  `id_kamar` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `harga_harian` varchar(100) NOT NULL,
  `harga_bulanan` varchar(30) NOT NULL,
  `no_kamar` varchar(30) NOT NULL,
  `id_tipe_kamar` varchar(50) NOT NULL,
  `status_kamar` enum('Terisi','Kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_kamar` VALUES ("KAM20250710085556471","HOT20250710063626968",2,150000,4500000,1,"TIP20250710064026817","Terisi"),
("KAM20250710085622157","HOT20250710063626968",2,150000,4500000,2,"TIP20250710064026817","Kosong"),
("KAM20250715065633581","HOT20250710063626968",4,180000,5400000,3,"TIP20250710064017527","Terisi"),
("KAM20250717045522633","HOT20250710063626968",2,180000,5400000,4,"TIP20250710064026817","Kosong"),
("KAM20250718042727162","HOT20250710063548555",2,130000,3900000,1,"TIP20250710064026817","Kosong"),
("KAM20250718042757517","HOT20250710063548555",4,180000,6000000,2,"TIP20250710064017527","Kosong");


DROP TABLE IF EXISTS `data_metode_pembayaran`;

CREATE TABLE `data_metode_pembayaran` (
  `id_metode_pembayaran` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `rekening` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_metode_pembayaran` VALUES ("MET20250723032909428","HOT20250710063626968","Tunai",254317),
("MET20250723042221522","HOT20250710063626968","QRIS",254317);


DROP TABLE IF EXISTS `data_operasional`;

CREATE TABLE `data_operasional` (
  `id_operasional` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `operasional` varchar(100) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `biaya` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_operasional` VALUES ("OPE20250714114543911","HOT20250710063626968","2025-07-18","Event Organizer",1,13000000),
("OPE20250719080252576","HOT20250710063626968","2025-07-18","ATK hotel","2 set",500000);


DROP TABLE IF EXISTS `data_pelanggan`;

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pelanggan` VALUES ("PEL20250714082108440","Rianti","perempuan","HOT20250710063626968",08349394234),
("PEL20250715065839276","Rangga Aditya","laki-laki","HOT20250710063626968",0876435532),
("PEL20250715070034707","Fatma Fiani","perempuan","HOT20250710063626968",0837443722),
("PEL20250717043546608","vioni","perempuan","HOT20250710063626968",08734634),
("PEL20250717045213800","ahmad sarkowi","laki-laki","HOT20250710063626968",09384377433),
("PEL20250722095444394","Rani Samanta","perempuan","HOT20250710063626968",08937473743);


DROP TABLE IF EXISTS `data_pengelola`;

CREATE TABLE `data_pengelola` (
  `id_pengelola` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengelola` VALUES ("PEN2334RTT","pengelola","pengelola","3c7913bc17671596a43dcb4581992bdf");


DROP TABLE IF EXISTS `data_tipe_kamar`;

CREATE TABLE `data_tipe_kamar` (
  `id_tipe_kamar` varchar(50) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `id_hotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_tipe_kamar` VALUES ("TIP20250710064017527","deluxe","HOT20250710063626968"),
("TIP20250710064026817","twin","HOT20250710063626968");


DROP TABLE IF EXISTS `data_transaksi`;

CREATE TABLE `data_transaksi` (
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
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_transaksi` VALUES ("TRA20250719050303349","PEL20250714082108440","KAM20250710085556471","2025-07-19","2025-07-21",34883392,270000,"Tunai",2,0,10,"Selesai"),
("TRA20250719053039101","PEL20250717043546608","KAM20250710085622157","2025-07-19","2025-08-18",34883392,4500000,"QRIS",2,1,0,"Selesai"),
("TRA20250721055632997","PEL20250715070034707","KAM20250710085556471","2025-07-21","2025-07-22",2455783,150000,"QRIS",2,0,0,"Selesai"),
("TRA20250721060647571","PEL20250715065839276","KAM20250715065633581","2025-07-21","2025-07-23",2458584,360000,"Rekening",1,0,0,"Selesai"),
("TRA20250722091159685","PEL20250715070034707","KAM20250710085556471","2025-07-22","2025-07-23",2466784,150000,"tunai",1,1,0,"Selesai"),
("TRA20250722095514473","PEL20250722095444394","KAM20250710085622157","2025-07-22","2025-07-23",76363,150000,"tunai",1,0,0,"Selesai"),
("TRA20250722095706784","PEL20250714082108440","KAM20250715065633581","2025-07-22","2025-07-24",6345352,360000,"QRIS",2,0,0,"Belum Lunas"),
("TRA20250723042409541","PEL20250717045213800","KAM20250710085556471","2025-07-23","2025-07-24",789965,150000,"MET20250723042221522",1,0,0,"Lunas");


SET foreign_key_checks = 1;
CREATE DATABASE IF NOT EXISTS `databases_2025_steze_manajemen_hotel`;

USE `databases_2025_steze_manajemen_hotel`;

SET foreign_key_checks = 0;

SET foreign_key_checks = 1;
CREATE DATABASE IF NOT EXISTS `databases_2025_steze_manajemen_hotel`;

USE `databases_2025_steze_manajemen_hotel`;

SET foreign_key_checks = 0;

SET foreign_key_checks = 1;
CREATE DATABASE IF NOT EXISTS `databases_2025_steze_manajemen_hotel`;

USE `databases_2025_steze_manajemen_hotel`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `data_admin`;

CREATE TABLE `data_admin` (
  `id_admin` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_admin` VALUES ("ADM20250710063810359","HOT20250710063626968","admin","admin","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250718042547760","HOT20250710063548555","adminA","adminA","91183e1cb4e46961f86a2ef6287927ad");


DROP TABLE IF EXISTS `data_bank`;

CREATE TABLE `data_bank` (
  `id_bank` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `rekening` varchar(250) DEFAULT NULL,
  `atas_nama` varchar(250) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `data_hotel`;

CREATE TABLE `data_hotel` (
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_hotel` VALUES ("HOT20250710063548555","Hotel A","jln ahmad dahlan depan saimen"),
("HOT20250710063626968","Hotel B","jln. Singadekane telanai pura"),
("HOT20250710063726341","Hotel C","Jln. Pertamina Kota Baru");


DROP TABLE IF EXISTS `data_kamar`;

CREATE TABLE `data_kamar` (
  `id_kamar` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `harga_harian` varchar(100) NOT NULL,
  `harga_bulanan` varchar(30) NOT NULL,
  `no_kamar` varchar(30) NOT NULL,
  `id_tipe_kamar` varchar(50) NOT NULL,
  `status_kamar` enum('Terisi','Kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_kamar` VALUES ("KAM20250710085556471","HOT20250710063626968",2,150000,4500000,1,"TIP20250710064026817","Terisi"),
("KAM20250710085622157","HOT20250710063626968",2,150000,4500000,2,"TIP20250710064026817","Kosong"),
("KAM20250715065633581","HOT20250710063626968",4,180000,5400000,3,"TIP20250710064017527","Terisi"),
("KAM20250717045522633","HOT20250710063626968",2,180000,5400000,4,"TIP20250710064026817","Kosong"),
("KAM20250718042727162","HOT20250710063548555",2,130000,3900000,1,"TIP20250710064026817","Kosong"),
("KAM20250718042757517","HOT20250710063548555",4,180000,6000000,2,"TIP20250710064017527","Kosong");


DROP TABLE IF EXISTS `data_metode_pembayaran`;

CREATE TABLE `data_metode_pembayaran` (
  `id_metode_pembayaran` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `rekening` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_metode_pembayaran` VALUES ("MET20250723032909428","HOT20250710063626968","Tunai",254317),
("MET20250723042221522","HOT20250710063626968","QRIS",254317);


DROP TABLE IF EXISTS `data_operasional`;

CREATE TABLE `data_operasional` (
  `id_operasional` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `operasional` varchar(100) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `biaya` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_operasional` VALUES ("OPE20250714114543911","HOT20250710063626968","2025-07-18","Event Organizer",1,13000000),
("OPE20250719080252576","HOT20250710063626968","2025-07-18","ATK hotel","2 set",500000);


DROP TABLE IF EXISTS `data_pelanggan`;

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pelanggan` VALUES ("PEL20250714082108440","Rianti","perempuan","HOT20250710063626968",8349394234),
("PEL20250715065839276","Rangga Aditya","laki-laki","HOT20250710063626968",876435532),
("PEL20250715070034707","Fatma Fiani","perempuan","HOT20250710063626968",837443722),
("PEL20250717043546608","vioni","perempuan","HOT20250710063626968",8734634),
("PEL20250717045213800","ahmad sarkowi","laki-laki","HOT20250710063626968",9384377433),
("PEL20250722095444394","Rani Samanta","perempuan","HOT20250710063626968",8937473743);


DROP TABLE IF EXISTS `data_pengaturan_printer`;

CREATE TABLE `data_pengaturan_printer` (
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
  `no_wa_sumber` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pengaturan_printer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengaturan_printer` VALUES ("PEN1912001","RP58 Printer","","sebelum cetak","-","1753869444-68463-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993);


DROP TABLE IF EXISTS `data_pengelola`;

CREATE TABLE `data_pengelola` (
  `id_pengelola` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengelola` VALUES ("PEN2334RTT","pengelola","pengelola","3c7913bc17671596a43dcb4581992bdf");


DROP TABLE IF EXISTS `data_tipe_kamar`;

CREATE TABLE `data_tipe_kamar` (
  `id_tipe_kamar` varchar(50) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `id_hotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_tipe_kamar` VALUES ("TIP20250710064017527","deluxe","HOT20250710063626968"),
("TIP20250710064026817","twin","HOT20250710063626968");


DROP TABLE IF EXISTS `data_transaksi`;

CREATE TABLE `data_transaksi` (
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
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_transaksi` VALUES ("TRA20250719050303349","PEL20250714082108440","KAM20250710085556471","2025-07-19","2025-07-21",34883392,270000,"Tunai",2,0,10,"Selesai"),
("TRA20250719053039101","PEL20250717043546608","KAM20250710085622157","2025-07-19","2025-08-18",34883392,4500000,"QRIS",2,1,0,"Selesai"),
("TRA20250721055632997","PEL20250715070034707","KAM20250710085556471","2025-07-21","2025-07-22",2455783,150000,"QRIS",2,0,0,"Selesai"),
("TRA20250721060647571","PEL20250715065839276","KAM20250715065633581","2025-07-21","2025-07-23",2458584,360000,"Rekening",1,0,0,"Selesai"),
("TRA20250722091159685","PEL20250715070034707","KAM20250710085556471","2025-07-22","2025-07-23",2466784,150000,"tunai",1,1,0,"Selesai"),
("TRA20250722095514473","PEL20250722095444394","KAM20250710085622157","2025-07-22","2025-07-23",76363,150000,"tunai",1,0,0,"Selesai"),
("TRA20250722095706784","PEL20250714082108440","KAM20250715065633581","2025-07-22","2025-07-24",6345352,360000,"QRIS",2,0,0,"Belum Lunas"),
("TRA20250723042409541","PEL20250717045213800","KAM20250710085556471","2025-07-23","2025-07-24",789965,150000,"MET20250723042221522",1,0,0,"Lunas");


SET foreign_key_checks = 1;
CREATE DATABASE IF NOT EXISTS `databases_2025_steze_manajemen_hotel`;

USE `databases_2025_steze_manajemen_hotel`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `data_admin`;

CREATE TABLE `data_admin` (
  `id_admin` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_admin` VALUES ("ADM20250710063810359","HOT20250710063626968","admin","admin","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250718042547760","HOT20250710063548555","adminA","adminA","91183e1cb4e46961f86a2ef6287927ad");


DROP TABLE IF EXISTS `data_bank`;

CREATE TABLE `data_bank` (
  `id_bank` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `rekening` varchar(250) DEFAULT NULL,
  `atas_nama` varchar(250) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_bank` VALUES ("BAN20250801055906697","bank mandiri",3198837474,"Steze Hotel","HOT20250710063626968"),
("BAN20250804070223624","none","none","Steze Hotel","HOT20250710063626968");


DROP TABLE IF EXISTS `data_hapus_transaksi`;

CREATE TABLE `data_hapus_transaksi` (
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
  `tanggal` datetime NOT NULL,
  `id_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `data_hotel`;

CREATE TABLE `data_hotel` (
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_hotel` VALUES ("HOT20250710063548555","Hotel A","jln ahmad dahlan depan saimen"),
("HOT20250710063626968","Hotel B","jln. Singadekane telanai pura"),
("HOT20250710063726341","Hotel C","Jln. Pertamina Kota Baru");


DROP TABLE IF EXISTS `data_kamar`;

CREATE TABLE `data_kamar` (
  `id_kamar` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `harga_harian` varchar(100) NOT NULL,
  `harga_bulanan` varchar(30) NOT NULL,
  `no_kamar` varchar(30) NOT NULL,
  `id_tipe_kamar` varchar(50) NOT NULL,
  `status_kamar` enum('Terisi','Kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_kamar` VALUES ("KAM20250710085556471","HOT20250710063626968",2,150000,4500000,1,"TIP20250710064026817","Terisi"),
("KAM20250710085622157","HOT20250710063626968",2,150000,4500000,2,"TIP20250710064026817","Kosong"),
("KAM20250715065633581","HOT20250710063626968",4,180000,5400000,3,"TIP20250710064017527","Terisi"),
("KAM20250717045522633","HOT20250710063626968",2,180000,5400000,4,"TIP20250710064026817","Kosong"),
("KAM20250718042727162","HOT20250710063548555",2,130000,3900000,1,"TIP20250710064026817","Kosong"),
("KAM20250718042757517","HOT20250710063548555",4,180000,6000000,2,"TIP20250710064017527","Kosong");


DROP TABLE IF EXISTS `data_metode_pembayaran`;

CREATE TABLE `data_metode_pembayaran` (
  `id_metode_pembayaran` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `id_bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_metode_pembayaran` VALUES ("MET20250805085252594","HOT20250710063626968","Tunai","BAN20250804070223624"),
("MET20250805085317642","HOT20250710063626968","QRIS","BAN20250804070223624"),
("MET20250805085527300","HOT20250710063626968","Transfer Tunai","BAN20250801055906697");


DROP TABLE IF EXISTS `data_operasional`;

CREATE TABLE `data_operasional` (
  `id_operasional` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `operasional` varchar(100) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `biaya` varchar(30) NOT NULL,
  `id_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_operasional` VALUES ("OPE20250714114543911","HOT20250710063626968","2025-07-18","Event Organizer",1,13000000,""),
("OPE20250719080252576","HOT20250710063626968","2025-07-18","ATK hotel","2 set",500000,""),
("OPE20250804053203634","HOT20250710063626968","2025-08-04","alat kebersihan hotel","10 set",1500000,"ADM20250710063810359");


DROP TABLE IF EXISTS `data_pelanggan`;

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pelanggan` VALUES ("PEL20250714082108440","Rianti","perempuan","HOT20250710063626968",8349394234),
("PEL20250715065839276","Rangga Aditya","laki-laki","HOT20250710063626968",876435532),
("PEL20250715070034707","Fatma Fiani","perempuan","HOT20250710063626968",837443722),
("PEL20250717043546608","vioni","perempuan","HOT20250710063626968",8734634),
("PEL20250717045213800","ahmad sarkowi","laki-laki","HOT20250710063626968",9384377433),
("PEL20250722095444394","Rani Samanta","perempuan","HOT20250710063626968",8937473743);


DROP TABLE IF EXISTS `data_pengaturan_printer`;

CREATE TABLE `data_pengaturan_printer` (
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
  `no_wa_sumber` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pengaturan_printer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengaturan_printer` VALUES ("PEN1912001","RP58 Printer","","sebelum cetak","-","1753869444-68463-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993);


DROP TABLE IF EXISTS `data_pengelola`;

CREATE TABLE `data_pengelola` (
  `id_pengelola` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengelola` VALUES ("PEN2334RTT","pengelola","pengelola","3c7913bc17671596a43dcb4581992bdf");


DROP TABLE IF EXISTS `data_tipe_kamar`;

CREATE TABLE `data_tipe_kamar` (
  `id_tipe_kamar` varchar(50) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `id_hotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_tipe_kamar` VALUES ("TIP20250710064017527","deluxe","HOT20250710063626968"),
("TIP20250710064026817","twin","HOT20250710063626968");


DROP TABLE IF EXISTS `data_transaksi`;

CREATE TABLE `data_transaksi` (
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
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_transaksi` VALUES ("TRA20250719050303349","PEL20250714082108440","KAM20250710085556471","2025-07-19","2025-07-21",34883392,270000,"Tunai",2,0,10,"Selesai"),
("TRA20250719053039101","PEL20250717043546608","KAM20250710085622157","2025-07-19","2025-08-18",34883392,4500000,"QRIS",2,1,0,"Selesai"),
("TRA20250721055632997","PEL20250715070034707","KAM20250710085556471","2025-07-21","2025-07-22",2455783,150000,"QRIS",2,0,0,"Selesai"),
("TRA20250721060647571","PEL20250715065839276","KAM20250715065633581","2025-07-21","2025-07-23",2458584,360000,"Rekening",1,0,0,"Selesai"),
("TRA20250722091159685","PEL20250715070034707","KAM20250710085556471","2025-07-22","2025-07-23",2466784,150000,"tunai",1,1,0,"Selesai"),
("TRA20250722095514473","PEL20250722095444394","KAM20250710085622157","2025-07-22","2025-07-23",76363,150000,"tunai",1,0,0,"Selesai"),
("TRA20250722095706784","PEL20250714082108440","KAM20250715065633581","2025-07-22","2025-07-24",6345352,360000,"QRIS",2,0,0,"Belum Lunas"),
("TRA20250723042409541","PEL20250717045213800","KAM20250710085556471","2025-07-23","2025-07-24",789965,150000,"MET20250801093210478",1,0,0,"Lunas");


SET foreign_key_checks = 1;
CREATE DATABASE IF NOT EXISTS `databases_2025_steze_manajemen_hotel`;

USE `databases_2025_steze_manajemen_hotel`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `data_admin`;

CREATE TABLE `data_admin` (
  `id_admin` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_admin` VALUES ("ADM20250710063548555","HOT20250710063548555","Admin TAC Sipin","tac_sipin","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063626968","HOT20250710063626968","Admin Nusa Indah 1","nusa_indah_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263410","HOT202507100637263410","Admin Telanaipura 1","telanaipura_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726343","HOT20250710063726343","Admin Kota Baru","kota_baru","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726341","HOT20250710063726341","Admin Nusa Indah 3","nusa_indah_3","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726344","HOT20250710063726344","Admin Tehok 1","tehok_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726346","HOT20250710063726346","Admin Talang Banjar","talang_banjar","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726347","HOT20250710063726347","Admin Haji Kamil","haji_kamil","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263411","HOT202507100637263411","Admin Telanaipura 2","telanaipura_2","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726345","HOT20250710063726345","Admin Tehok 2","tehok_2","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263412","HOT202507100637263412","Admin Mendalo","mendalo","21232f297a57a5a743894a0e4a801fc3");


DROP TABLE IF EXISTS `data_bank`;

CREATE TABLE `data_bank` (
  `id_bank` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `rekening` varchar(250) DEFAULT NULL,
  `atas_nama` varchar(250) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_bank` VALUES ("BAN20250817000026161","Bank Mandiri",1234566,"Steze Hotel","HOT20250710063548555"),
("BAN20250817000042219","none","none","Steze Hotel","HOT20250710063548555"),
("BAN20250806031226162","Bank Mandiri",1234567,"Steze Hotel","HOT20250710063626968"),
("BAN20250806031242220","none","none","Steze Hotel","HOT20250710063626968"),
("BAN20250817000026163","Bank Mandiri",1234568,"Steze Hotel","HOT202507100637263410"),
("BAN20250817000042221","none","none","Steze Hotel","HOT202507100637263410"),
("BAN20250817000026164","Bank Mandiri",1234569,"Steze Hotel","HOT20250710063726343"),
("BAN20250817000042222","none","none","Steze Hotel","HOT20250710063726343"),
("BAN20250817000026165","Bank Mandiri",1234570,"Steze Hotel","HOT20250817000026165"),
("BAN20250817000042223","none","none","Steze Hotel","HOT20250817000026165"),
("BAN20250817000026166","Bank Mandiri",1234571,"Steze Hotel","HOT20250710063726344"),
("BAN20250817000042224","none","none","Steze Hotel","HOT20250710063726344"),
("BAN20250817000026167","Bank Mandiri",1234572,"Steze Hotel","HOT20250710063726346"),
("BAN20250817000042225","none","none","Steze Hotel","HOT20250710063726346"),
("BAN20250817000026168","Bank Mandiri",1234573,"Steze Hotel","HOT20250710063726347"),
("BAN20250817000042226","none","none","Steze Hotel","HOT20250710063726347"),
("BAN20250817000026169","Bank Mandiri",1234574,"Steze Hotel","HOT202507100637263411"),
("BAN20250817000042227","none","none","Steze Hotel","HOT202507100637263411"),
("BAN20250817000026170","Bank Mandiri",1234575,"Steze Hotel","HOT20250710063726345"),
("BAN20250817000042228","none","none","Steze Hotel","HOT20250710063726345"),
("BAN20250817000026171","Bank Mandiri",1234576,"Steze Hotel","HOT202507100637263412"),
("BAN20250817000042229","none","none","Steze Hotel","HOT202507100637263412");


DROP TABLE IF EXISTS `data_hapus_transaksi`;

CREATE TABLE `data_hapus_transaksi` (
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

INSERT INTO `data_hapus_transaksi` VALUES ("","TRA20250806090324106","PEL20250715065839276","KAM20250710085556471","2025-08-06","2025-08-08",3198837474,300000,"MET20250806031339605",2,0,0,"Selesai","HOT20250710063626968","2025-08-09 11:32:05",""),
("HAP20250811153009662","TRA20250811152640121","PEL20250715065839276","KAM20250715065633581","2025-08-12","2025-08-15","none",540000,"Tunai",2,0,0,"Lunas","","2025-08-11 15:30:09","ADM20250710063810359");


DROP TABLE IF EXISTS `data_hotel`;

CREATE TABLE `data_hotel` (
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(50) DEFAULT NULL,
  `koordinat` varchar(250) DEFAULT NULL,
  `gambar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_hotel` VALUES ("HOT20250710063548555","TAC Sipin","Jl. Syamsu Bahroen No.12, Selamat, Kec. Telanaipura, Kota Jambi, Jambi 36124",2129707600,"-6.198290958000439,106.81770801544191","1754638585-71504-sipin.webp"),
("HOT20250710063626968","Nusa Indah 1","Jl. Nusa Indah I, Rw. Sari, Kec. Kota Baru, Kota Jambi, Jambi 36361",82184614212,"-6.200117527420315,106.81715011596681","1754638334-52363-nusa_indah1.webp"),
("HOT20250710063726341","Nusa Indah 3","Jl. Nusa Indah 3 RT 8, Rawasari Kec. Alam Barajo, Rawasari, Kec. Kota Baru 36124",82173027422,"-6.199946870107371,106.81783676147462","1754638664-74075-nusa indah3.webp"),
("HOT202507100637263410","Telanaipura 1","Jl. Pakis II No.44, Pematang Sulur, Kec. Telanaipura, Kota Jambi, Jambi 36361",82177912506,"-6.200288184678057,106.81766510009767","1754638880-89063-telanai1.jpg"),
("HOT202507100637263411","Telanaipura 2","Jl. RE. Marta Dinata No.47, RT.04, Telanaipura, Kec. Telanaipura, Kota Jambi 36122",82136008756,"-6.199946870107371,106.81715011596681","1754639050-21986-telanai2.webp"),
("HOT202507100637263412","Mendalo","9GVF+W64, Mendalo Darat, Kec. Jambi Luar Kota, Kabupaten Muaro Jambi, Jambi 36361",2129707601,"-6.200117527420315,106.81697845458986","1754639294-63973-mendalo.jpg"),
("HOT20250710063726343","Kota Baru","Jl. Pintu Besi, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129",82177912507,"-6.199946870107371,106.81732177734376","1754639461-28514-kota baru.webp"),
("HOT20250710063726344","Tehok 1","Lrg. Jelita, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36123",82185045406,"-6.200117527420315,106.81697845458986","1754639566-59875-tehok 1.webp"),
("HOT20250710063726345","Tehok 2","Jl. Dr. Mawardi, RT.001/RW.01, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36122",82282103560,"-6.200288184678057,106.81697845458986","1754639730-63959-thehok2.webp"),
("HOT20250710063726346","Talang Banjar","Budiman, Kec. Jambi Tim., Kota Jambi, Jambi 36123",82184548411,"-6.200117527420315,106.81715011596681","1754639814-76851-talangbanjar.jpg"),
("HOT20250710063726347","Haji Kamil","Jl. Angkasa Puri No.74-60, Pasir Putih, Kec. Jambi Sel., Kota Jambi, Jambi 36129",87840695290,"-6.200288184678057,106.81697845458986","1754639971-63728-pasirputih.webp");


DROP TABLE IF EXISTS `data_kamar`;

CREATE TABLE `data_kamar` (
  `id_kamar` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `harga_harian` varchar(100) NOT NULL,
  `harga_bulanan` varchar(30) NOT NULL,
  `no_kamar` varchar(30) NOT NULL,
  `id_tipe_kamar` varchar(50) NOT NULL,
  `status_kamar` enum('Terisi','Kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_kamar` VALUES ("KMHOT20250710063548555-1","HOT20250710063548555",2,160000,4800000,1,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-2","HOT20250710063548555",2,160000,4800000,2,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-3","HOT20250710063548555",2,160000,4800000,3,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-4","HOT20250710063548555",2,160000,4800000,4,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-5","HOT20250710063548555",2,160000,4800000,5,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-6","HOT20250710063548555",2,160000,4800000,6,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-7","HOT20250710063548555",2,160000,4800000,7,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-8","HOT20250710063548555",2,160000,4800000,8,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-9","HOT20250710063548555",2,160000,4800000,9,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-10","HOT20250710063548555",2,160000,4800000,10,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-11","HOT20250710063548555","2-3",180000,5400000,11,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-12","HOT20250710063548555","2-3",180000,5400000,12,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-13","HOT20250710063548555","2-3",180000,5400000,13,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-14","HOT20250710063548555","2-3",180000,5400000,14,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-15","HOT20250710063548555","2-3",180000,5400000,15,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-16","HOT20250710063548555","2-3",180000,5400000,16,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-17","HOT20250710063548555","2-3",180000,5400000,17,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-18","HOT20250710063548555","2-3",180000,5400000,18,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-19","HOT20250710063548555","2-3",180000,5400000,19,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-20","HOT20250710063548555","2-3",180000,5400000,20,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-21","HOT20250710063548555",4,250000,7500000,21,"TYPHOT20250710063548555-3","Kosong"),
("KMHOT20250710063548555-22","HOT20250710063548555",4,250000,7500000,22,"TYPHOT20250710063548555-3","Kosong"),
("KMHOT20250710063626968-1","HOT20250710063626968",1,120000,3600000,1,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-2","HOT20250710063626968",1,120000,3600000,2,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-3","HOT20250710063626968",1,120000,3600000,3,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-4","HOT20250710063626968",2,150000,4500000,4,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-5","HOT20250710063626968",2,150000,4500000,5,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-6","HOT20250710063626968",2,150000,4500000,6,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-7","HOT20250710063626968",2,150000,4500000,7,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-8","HOT20250710063626968",2,150000,4500000,8,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-9","HOT20250710063626968",2,150000,4500000,9,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-10","HOT20250710063626968",2,150000,4500000,10,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-11","HOT20250710063626968",2,150000,4500000,11,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-12","HOT20250710063626968",2,150000,4500000,12,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-13","HOT20250710063626968",2,150000,4500000,13,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-14","HOT20250710063626968",2,150000,4500000,14,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-15","HOT20250710063626968",2,150000,4500000,15,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-16","HOT20250710063626968",2,150000,4500000,16,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-17","HOT20250710063626968",2,150000,4500000,17,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-18","HOT20250710063626968",2,150000,4500000,18,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-19","HOT20250710063626968",2,150000,4500000,19,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-20","HOT20250710063626968",2,150000,4500000,20,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-21","HOT20250710063626968",2,150000,4500000,21,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-22","HOT20250710063626968",2,150000,4500000,22,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-23","HOT20250710063626968",2,150000,4500000,23,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-24","HOT20250710063626968",2,150000,4500000,24,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-25","HOT20250710063626968",2,150000,4500000,25,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-26","HOT20250710063626968",2,150000,4500000,26,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-27","HOT20250710063626968","2-3",160000,4800000,27,"TYPHOT20250710063626968-3","Kosong"),
("KMHOT20250710063626968-28","HOT20250710063626968",2,190000,5700000,28,"TYPHOT20250710063626968-4","Kosong"),
("KMHOT20250710063626968-29","HOT20250710063626968",4,220000,6600000,29,"TYPHOT20250710063626968-5","Kosong"),
("KMHOT202507100637263410-1","HOT202507100637263410",2,150000,4500000,1,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-2","HOT202507100637263410",2,150000,4500000,2,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-3","HOT202507100637263410",2,150000,4500000,3,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-4","HOT202507100637263410",2,150000,4500000,4,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-5","HOT202507100637263410",2,150000,4500000,5,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-6","HOT202507100637263410",2,150000,4500000,6,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-7","HOT202507100637263410",2,150000,4500000,7,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-8","HOT202507100637263410",2,150000,4500000,8,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-9","HOT202507100637263410",2,150000,4500000,9,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-10","HOT202507100637263410",2,150000,4500000,10,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-11","HOT202507100637263410",2,150000,4500000,11,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-12","HOT202507100637263410",2,150000,4500000,12,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-13","HOT202507100637263410",2,150000,4500000,13,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-14","HOT202507100637263410",2,150000,4500000,14,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-15","HOT202507100637263410",2,190000,5700000,15,"TYPHOT202507100637263410-2","Kosong"),
("KMHOT202507100637263410-16","HOT202507100637263410",4,220000,6600000,16,"TYPHOT202507100637263410-3","Kosong"),
("KMHOT20250710063726343-1","HOT20250710063726343",2,150000,4500000,1,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-2","HOT20250710063726343",2,150000,4500000,2,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-3","HOT20250710063726343",2,150000,4500000,3,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-4","HOT20250710063726343",2,150000,4500000,4,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-5","HOT20250710063726343",2,150000,4500000,5,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-6","HOT20250710063726343",2,150000,4500000,6,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-7","HOT20250710063726343",2,150000,4500000,7,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-8","HOT20250710063726343",2,150000,4500000,8,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-9","HOT20250710063726343",2,150000,4500000,9,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-10","HOT20250710063726343",2,150000,4500000,10,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-11","HOT20250710063726343",2,150000,4500000,11,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-12","HOT20250710063726343",2,150000,4500000,12,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-13","HOT20250710063726343",2,150000,4500000,13,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-14","HOT20250710063726343",2,150000,4500000,14,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-15","HOT20250710063726343",2,150000,4500000,15,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-16","HOT20250710063726343",2,150000,4500000,16,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-17","HOT20250710063726343",2,150000,4500000,17,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-18","HOT20250710063726343",2,150000,4500000,18,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-19","HOT20250710063726343",2,150000,4500000,19,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-20","HOT20250710063726343",2,150000,4500000,20,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-21","HOT20250710063726343",4,250000,7500000,21,"TYPHOT20250710063726343-2","Kosong"),
("KMHOT20250710063726343-22","HOT20250710063726343",4,250000,7500000,22,"TYPHOT20250710063726343-2","Kosong"),
("KMHOT20250710063726341-1","HOT20250710063726341",1,120000,3600000,1,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-2","HOT20250710063726341",1,120000,3600000,2,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-3","HOT20250710063726341",1,120000,3600000,3,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-4","HOT20250710063726341",1,120000,3600000,4,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-5","HOT20250710063726341",2,150000,4500000,5,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-6","HOT20250710063726341",2,150000,4500000,6,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-7","HOT20250710063726341",2,150000,4500000,7,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-8","HOT20250710063726341",2,150000,4500000,8,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-9","HOT20250710063726341",2,150000,4500000,9,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-10","HOT20250710063726341",2,150000,4500000,10,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-11","HOT20250710063726341",2,150000,4500000,11,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-12","HOT20250710063726341",2,150000,4500000,12,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-13","HOT20250710063726341",2,150000,4500000,13,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-14","HOT20250710063726341",2,150000,4500000,14,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-15","HOT20250710063726341",2,150000,4500000,15,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-16","HOT20250710063726341",2,150000,4500000,16,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-17","HOT20250710063726341",2,150000,4500000,17,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-18","HOT20250710063726341",2,150000,4500000,18,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-19","HOT20250710063726341",2,150000,4500000,19,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-20","HOT20250710063726341",2,150000,4500000,20,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-21","HOT20250710063726341",4,250000,7500000,21,"TYPHOT20250710063726341-3","Kosong"),
("KMHOT20250710063726341-22","HOT20250710063726341",4,250000,7500000,22,"TYPHOT20250710063726341-3","Kosong"),
("KMHOT20250710063726344-1","HOT20250710063726344",2,140000,4200000,1,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-2","HOT20250710063726344",2,140000,4200000,2,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-3","HOT20250710063726344",2,140000,4200000,3,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-4","HOT20250710063726344",2,140000,4200000,4,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-5","HOT20250710063726344",2,140000,4200000,5,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-6","HOT20250710063726344",2,140000,4200000,6,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-7","HOT20250710063726344",2,140000,4200000,7,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-8","HOT20250710063726344",2,140000,4200000,8,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-9","HOT20250710063726344",2,140000,4200000,9,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-10","HOT20250710063726344",2,140000,4200000,10,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-11","HOT20250710063726344",2,140000,4200000,11,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-12","HOT20250710063726344",2,140000,4200000,12,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-13","HOT20250710063726344",2,140000,4200000,13,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-14","HOT20250710063726344",4,180000,5400000,14,"TYPHOT20250710063726344-2","Kosong"),
("KMHOT20250710063726346-1","HOT20250710063726346",2,130000,3900000,1,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-2","HOT20250710063726346",2,130000,3900000,2,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-3","HOT20250710063726346",2,130000,3900000,3,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-4","HOT20250710063726346",2,130000,3900000,4,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-5","HOT20250710063726346",2,130000,3900000,5,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-6","HOT20250710063726346",2,130000,3900000,6,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-7","HOT20250710063726346",2,130000,3900000,7,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-8","HOT20250710063726346",2,130000,3900000,8,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-9","HOT20250710063726346",2,130000,3900000,9,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-10","HOT20250710063726346",2,130000,3900000,10,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-11","HOT20250710063726346",2,130000,3900000,11,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-12","HOT20250710063726346",2,130000,3900000,12,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-13","HOT20250710063726346",2,130000,3900000,13,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-14","HOT20250710063726346",2,130000,3900000,14,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-15","HOT20250710063726346",2,130000,3900000,15,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-16","HOT20250710063726346",2,130000,3900000,16,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-17","HOT20250710063726346",2,130000,3900000,17,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-18","HOT20250710063726346",2,130000,3900000,18,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-19","HOT20250710063726346",4,220000,6600000,19,"TYPHOT20250710063726346-2","Kosong"),
("KMHOT20250710063726347-1","HOT20250710063726347",1,120000,3600000,1,"TYPHOT20250710063726347-1","Kosong"),
("KMHOT20250710063726347-2","HOT20250710063726347",2,150000,4500000,2,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-3","HOT20250710063726347",2,150000,4500000,3,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-4","HOT20250710063726347",2,150000,4500000,4,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-5","HOT20250710063726347",2,150000,4500000,5,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-6","HOT20250710063726347",2,150000,4500000,6,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-7","HOT20250710063726347",2,150000,4500000,7,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-8","HOT20250710063726347",2,150000,4500000,8,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-9","HOT20250710063726347",2,150000,4500000,9,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-10","HOT20250710063726347",2,150000,4500000,10,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-11","HOT20250710063726347",2,150000,4500000,11,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-12","HOT20250710063726347",2,150000,4500000,12,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-13","HOT20250710063726347",2,150000,4500000,13,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-14","HOT20250710063726347",2,150000,4500000,14,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-15","HOT20250710063726347",2,150000,4500000,15,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-16","HOT20250710063726347",2,150000,4500000,16,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-17","HOT20250710063726347",2,150000,4500000,17,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-18","HOT20250710063726347",2,150000,4500000,18,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-19","HOT20250710063726347",2,150000,4500000,19,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-20","HOT20250710063726347",4,250000,7500000,20,"TYPHOT20250710063726347-3","Kosong"),
("KMHOT202507100637263411-1","HOT202507100637263411",2,150000,4500000,1,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-2","HOT202507100637263411",2,150000,4500000,2,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-3","HOT202507100637263411",2,150000,4500000,3,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-4","HOT202507100637263411",2,150000,4500000,4,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-5","HOT202507100637263411",2,150000,4500000,5,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-6","HOT202507100637263411",2,150000,4500000,6,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-7","HOT202507100637263411",2,150000,4500000,7,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-8","HOT202507100637263411",2,150000,4500000,8,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-9","HOT202507100637263411",2,150000,4500000,9,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-10","HOT202507100637263411",2,150000,4500000,10,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-11","HOT202507100637263411",2,150000,4500000,11,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-12","HOT202507100637263411",4,250000,7500000,12,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT202507100637263411-13","HOT202507100637263411",4,250000,7500000,13,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT202507100637263411-14","HOT202507100637263411",4,250000,7500000,14,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT20250710063726345-1","HOT20250710063726345",2,150000,4500000,1,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-2","HOT20250710063726345",2,150000,4500000,2,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-3","HOT20250710063726345",2,150000,4500000,3,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-4","HOT20250710063726345",2,150000,4500000,4,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-5","HOT20250710063726345",2,150000,4500000,5,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-6","HOT20250710063726345",2,150000,4500000,6,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-7","HOT20250710063726345",2,150000,4500000,7,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-8","HOT20250710063726345",2,150000,4500000,8,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-9","HOT20250710063726345",2,150000,4500000,9,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-10","HOT20250710063726345","2-3",180000,5400000,10,"TYPHOT20250710063726345-2","Kosong"),
("KMHOT202507100637263412-1","HOT202507100637263412",2,130000,3900000,1,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-2","HOT202507100637263412",2,130000,3900000,2,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-3","HOT202507100637263412",2,130000,3900000,3,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-4","HOT202507100637263412",2,130000,3900000,4,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-5","HOT202507100637263412",2,130000,3900000,5,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-6","HOT202507100637263412",2,130000,3900000,6,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-7","HOT202507100637263412",2,130000,3900000,7,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-8","HOT202507100637263412",2,130000,3900000,8,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-9","HOT202507100637263412",2,130000,3900000,9,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-10","HOT202507100637263412",2,130000,3900000,10,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-11","HOT202507100637263412",2,130000,3900000,11,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-12","HOT202507100637263412",2,130000,3900000,12,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-13","HOT202507100637263412",2,130000,3900000,13,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-14","HOT202507100637263412",2,130000,3900000,14,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-15","HOT202507100637263412",2,130000,3900000,15,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-16","HOT202507100637263412",2,130000,3900000,16,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-17","HOT202507100637263412",2,130000,3900000,17,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-18","HOT202507100637263412",2,130000,3900000,18,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-19","HOT202507100637263412",2,130000,3900000,19,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-20","HOT202507100637263412",2,130000,3900000,20,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-21","HOT202507100637263412",2,130000,3900000,21,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-22","HOT202507100637263412",2,130000,3900000,22,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-23","HOT202507100637263412",2,130000,3900000,23,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-24","HOT202507100637263412",2,130000,3900000,24,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-25","HOT202507100637263412",2,130000,3900000,25,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-26","HOT202507100637263412",2,130000,3900000,26,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-27","HOT202507100637263412",2,130000,3900000,27,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-28","HOT202507100637263412",2,130000,3900000,28,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-29","HOT202507100637263412",2,130000,3900000,29,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-30","HOT202507100637263412",2,130000,3900000,30,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-31","HOT202507100637263412",2,130000,3900000,31,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-32","HOT202507100637263412",2,130000,3900000,32,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-33","HOT202507100637263412",2,130000,3900000,33,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-34","HOT202507100637263412",2,130000,3900000,34,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-35","HOT202507100637263412",2,130000,3900000,35,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-36","HOT202507100637263412",2,130000,3900000,36,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-37","HOT202507100637263412",2,130000,3900000,37,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-38","HOT202507100637263412",2,130000,3900000,38,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-39","HOT202507100637263412",2,130000,3900000,39,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-40","HOT202507100637263412",2,130000,3900000,40,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-41","HOT202507100637263412",2,130000,3900000,41,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-42","HOT202507100637263412",2,130000,3900000,42,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-43","HOT202507100637263412",2,130000,3900000,43,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-44","HOT202507100637263412",2,130000,3900000,44,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-45","HOT202507100637263412",4,220000,6600000,45,"TYPHOT202507100637263412-2","Kosong"),
("KMHOT202507100637263412-46","HOT202507100637263412",4,220000,6600000,46,"TYPHOT202507100637263412-2","Kosong"),
("KMHOT20250710063626968-30","HOT20250710063626968",2,150000,4500000,30,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-31","HOT20250710063626968",2,150000,4500000,31,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-32","HOT20250710063626968",2,150000,4500000,32,"TYPHOT20250710063626968-2","Kosong");


DROP TABLE IF EXISTS `data_metode_pembayaran`;

CREATE TABLE `data_metode_pembayaran` (
  `id_metode_pembayaran` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `id_bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_metode_pembayaran` VALUES ("MET20250817000005617","HOT20250710063548555","Tunai","BAN20250817000042219"),
("MET20250817000024935","HOT20250710063548555","QRIS","BAN20250817000042219"),
("MET20250817000039604","HOT20250710063548555","Transfer Bank","BAN20250817000026161"),
("MET20250806031305618","HOT20250710063626968","Tunai","BAN20250806031242220"),
("MET20250806031324936","HOT20250710063626968","QRIS","BAN20250806031242220"),
("MET20250806031339605","HOT20250710063626968","Transfer Bank","BAN20250806031226162"),
("MET20250817000005619","HOT202507100637263410","Tunai","BAN20250817000042221"),
("MET20250817000024937","HOT202507100637263410","QRIS","BAN20250817000042221"),
("MET20250817000039606","HOT202507100637263410","Transfer Bank","BAN20250817000026163"),
("MET20250817000005620","HOT20250710063726343","Tunai","BAN20250817000042222"),
("MET20250817000024938","HOT20250710063726343","QRIS","BAN20250817000042222"),
("MET20250817000039607","HOT20250710063726343","Transfer Bank","BAN20250817000026164"),
("MET20250817000005621","HOT20250817000026165","Tunai","BAN20250817000042223"),
("MET20250817000024939","HOT20250817000026165","QRIS","BAN20250817000042223"),
("MET20250817000039608","HOT20250817000026165","Transfer Bank","BAN20250817000026165"),
("MET20250817000005622","HOT20250710063726344","Tunai","BAN20250817000042224"),
("MET20250817000024940","HOT20250710063726344","QRIS","BAN20250817000042224"),
("MET20250817000039609","HOT20250710063726344","Transfer Bank","BAN20250817000026166"),
("MET20250817000005623","HOT20250710063726346","Tunai","BAN20250817000042225"),
("MET20250817000024941","HOT20250710063726346","QRIS","BAN20250817000042225"),
("MET20250817000039610","HOT20250710063726346","Transfer Bank","BAN20250817000026167"),
("MET20250817000005624","HOT20250710063726347","Tunai","BAN20250817000042226"),
("MET20250817000024942","HOT20250710063726347","QRIS","BAN20250817000042226"),
("MET20250817000039611","HOT20250710063726347","Transfer Bank","BAN20250817000026168"),
("MET20250817000005625","HOT202507100637263411","Tunai","BAN20250817000042227"),
("MET20250817000024943","HOT202507100637263411","QRIS","BAN20250817000042227"),
("MET20250817000039612","HOT202507100637263411","Transfer Bank","BAN20250817000026169"),
("MET20250817000005626","HOT20250710063726345","Tunai","BAN20250817000042228"),
("MET20250817000024944","HOT20250710063726345","QRIS","BAN20250817000042228"),
("MET20250817000039613","HOT20250710063726345","Transfer Bank","BAN20250817000026170"),
("MET20250817000005627","HOT202507100637263412","Tunai","BAN20250817000042229"),
("MET20250817000024945","HOT202507100637263412","QRIS","BAN20250817000042229"),
("MET20250817000039614","HOT202507100637263412","Transfer Bank","BAN20250817000026171");


DROP TABLE IF EXISTS `data_operasional`;

CREATE TABLE `data_operasional` (
  `id_operasional` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `operasional` varchar(100) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `keperluan` text NOT NULL,
  `biaya` varchar(30) NOT NULL,
  `id_admin` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_operasional` VALUES ("OPE20250809055903657","HOT20250710063626968","2025-08-09","ATK hotel","10 set","Isi ulang ATK hotel",200000,"ADM20250710063810359"),
("OPE20250817150407219","HOT20250710063548555","2025-08-17","ATK Kantor",2,"Pembelian Buku Tamu",200000,"ADM20250710063548555");


DROP TABLE IF EXISTS `data_pelanggan`;

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pelanggan` VALUES ("PEL20250714082108440","Rianti","perempuan","HOT20250710063626968",8349394234),
("PEL20250715065839276","Rangga Aditya","laki-laki","HOT20250710063626968",876435532),
("PEL20250715070034707","Fatma Fiani","perempuan","HOT20250710063626968",837443722),
("PEL20250717043546608","vioni","perempuan","HOT20250710063626968",8734634),
("PEL20250717045213800","ahmad sarkowi","laki-laki","HOT20250710063626968",9384377433),
("PEL20250722095444394","Rani Samanta","perempuan","HOT20250710063626968",8937473743),
("PEL20250809060403879","ramadhana","laki-laki","HOT20250710063626968",08372626525),
("PEL20250812043404533","Fajaruddin","laki-laki","HOT20250710063626968",08967332233);


DROP TABLE IF EXISTS `data_pengaturan_printer`;

CREATE TABLE `data_pengaturan_printer` (
  `id_pengaturan_printer` varchar(50) NOT NULL DEFAULT '',
  `nama_printer_nota` varchar(100) DEFAULT NULL,
  `ukuran_kertas` enum('32','48','A4') DEFAULT NULL,
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
  `no_wa_sumber` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pengaturan_printer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengaturan_printer` VALUES ("PEN1912001","RP58 Printer",32,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993);


DROP TABLE IF EXISTS `data_pengelola`;

CREATE TABLE `data_pengelola` (
  `id_pengelola` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengelola` VALUES ("PEN2334RTT","pengelola","pengelola","3c7913bc17671596a43dcb4581992bdf");


DROP TABLE IF EXISTS `data_tipe_kamar`;

CREATE TABLE `data_tipe_kamar` (
  `id_tipe_kamar` varchar(50) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `id_hotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_tipe_kamar` VALUES ("TYPHOT20250710063548555-1","DOUBLE","HOT20250710063548555"),
("TYPHOT20250710063548555-2","DELUXE","HOT20250710063548555"),
("TYPHOT20250710063548555-3","FAMILY","HOT20250710063548555"),
("TYPHOT20250710063626968-1","SINGLE","HOT20250710063626968"),
("TYPHOT20250710063626968-2","DOUBLE","HOT20250710063626968"),
("TYPHOT20250710063626968-3","DELUXE","HOT20250710063626968"),
("TYPHOT20250710063626968-4","TWIN","HOT20250710063626968"),
("TYPHOT20250710063626968-5","FAMILY","HOT20250710063626968"),
("TYPHOT20250710063726341-1","SINGLE","HOT20250710063726341"),
("TYPHOT20250710063726341-2","DOUBLE","HOT20250710063726341"),
("TYPHOT20250710063726341-3","FAMILY","HOT20250710063726341"),
("TYPHOT202507100637263410-1","DOUBLE","HOT202507100637263410"),
("TYPHOT202507100637263410-2","TWIN","HOT202507100637263410"),
("TYPHOT202507100637263410-3","FAMILY","HOT202507100637263410"),
("TYPHOT202507100637263411-1","DOUBLE","HOT202507100637263411"),
("TYPHOT202507100637263411-2","FAMILY","HOT202507100637263411"),
("TYPHOT202507100637263412-1","DOUBLE","HOT202507100637263412"),
("TYPHOT202507100637263412-2","FAMILY","HOT202507100637263412"),
("TYPHOT20250710063726343-1","DOUBLE","HOT20250710063726343"),
("TYPHOT20250710063726343-2","FAMILY","HOT20250710063726343"),
("TYPHOT20250710063726344-1","DOUBLE","HOT20250710063726344"),
("TYPHOT20250710063726344-2","FAMILY","HOT20250710063726344"),
("TYPHOT20250710063726345-1","DOUBLE","HOT20250710063726345"),
("TYPHOT20250710063726345-2","DELUXE","HOT20250710063726345"),
("TYPHOT20250710063726346-1","DOUBLE","HOT20250710063726346"),
("TYPHOT20250710063726346-2","FAMILY","HOT20250710063726346"),
("TYPHOT20250710063726347-1","SINGLE","HOT20250710063726347"),
("TYPHOT20250710063726347-2","DOUBLE","HOT20250710063726347"),
("TYPHOT20250710063726347-3","FAMILY","HOT20250710063726347");


DROP TABLE IF EXISTS `data_transaksi`;

CREATE TABLE `data_transaksi` (
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
  `biaya_tambahan_checkout` varchar(60) DEFAULT '',
  `deskripsi_biaya_checkout` varchar(60) DEFAULT '',
  `note` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_transaksi` VALUES ("TRA20250817213017747","PEL20250812043404533","KMHOT20250710063548555-1","2025-08-17","2025-08-18",1234566,160000,"MET20250817000039604",2,1,0,"Selesai","Fajaruddin",08967332233,1,"DOUBLE","21:30:17","21:30:17",1,"harian","ADM20250710063548555","Admin TAC Sipin","HOT20250710063548555","TAC Sipin","2025-08-17 21:30:17","BAN20250817000026161","Bank Mandiri",0,0,0,0,"-",0,NULL,NULL),
("TRA20250817222020835","PEL20250812043404533","KMHOT20250710063626968-1","2025-08-17","2025-08-18","none",120000,"MET20250806031305618",2,1,0,"Selesai","Fajaruddin",08967332233,1,"SINGLE","22:20:20","22:20:20",1,"harian","ADM20250710063626968","Admin Nusa Indah 1","HOT20250710063626968","Nusa Indah 1","2025-08-17 22:20:20","BAN20250806031242220","none",0,0,0,0,"-",0,NULL,NULL);


SET foreign_key_checks = 1;
CREATE DATABASE IF NOT EXISTS `databases_2025_steze_manajemen_hotel`;

USE `databases_2025_steze_manajemen_hotel`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `data_admin`;

CREATE TABLE `data_admin` (
  `id_admin` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_admin` VALUES ("ADM20250710063548555","HOT20250710063548555","Admin TAC Sipin","tac_sipin","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063626968","HOT20250710063626968","Admin Nusa Indah 1","nusa_indah_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263410","HOT202507100637263410","Admin Telanaipura 1","telanaipura_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726343","HOT20250710063726343","Admin Kota Baru","kota_baru","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726341","HOT20250710063726341","Admin Nusa Indah 3","nusa_indah_3","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726344","HOT20250710063726344","Admin Tehok 1","tehok_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726346","HOT20250710063726346","Admin Talang Banjar","talang_banjar","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726347","HOT20250710063726347","Admin Haji Kamil","haji_kamil","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263411","HOT202507100637263411","Admin Telanaipura 2","telanaipura_2","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726345","HOT20250710063726345","Admin Tehok 2","tehok_2","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263412","HOT202507100637263412","Admin Mendalo","mendalo","21232f297a57a5a743894a0e4a801fc3");


DROP TABLE IF EXISTS `data_bank`;

CREATE TABLE `data_bank` (
  `id_bank` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `rekening` varchar(250) DEFAULT NULL,
  `atas_nama` varchar(250) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_bank` VALUES ("BAN20250817000026161","Bank Mandiri",1234566,"Steze Hotel","HOT20250710063548555"),
("BAN20250817000042219","none","none","Steze Hotel","HOT20250710063548555"),
("BAN20250806031226162","Bank Mandiri",1234567,"Steze Hotel","HOT20250710063626968"),
("BAN20250806031242220","none","none","Steze Hotel","HOT20250710063626968"),
("BAN20250817000026163","Bank Mandiri",1234568,"Steze Hotel","HOT202507100637263410"),
("BAN20250817000042221","none","none","Steze Hotel","HOT202507100637263410"),
("BAN20250817000026164","Bank Mandiri",1234569,"Steze Hotel","HOT20250710063726343"),
("BAN20250817000042222","none","none","Steze Hotel","HOT20250710063726343"),
("BAN20250817000026165","Bank Mandiri",1234570,"Steze Hotel","HOT20250817000026165"),
("BAN20250817000042223","none","none","Steze Hotel","HOT20250817000026165"),
("BAN20250817000026166","Bank Mandiri",1234571,"Steze Hotel","HOT20250710063726344"),
("BAN20250817000042224","none","none","Steze Hotel","HOT20250710063726344"),
("BAN20250817000026167","Bank Mandiri",1234572,"Steze Hotel","HOT20250710063726346"),
("BAN20250817000042225","none","none","Steze Hotel","HOT20250710063726346"),
("BAN20250817000026168","Bank Mandiri",1234573,"Steze Hotel","HOT20250710063726347"),
("BAN20250817000042226","none","none","Steze Hotel","HOT20250710063726347"),
("BAN20250817000026169","Bank Mandiri",1234574,"Steze Hotel","HOT202507100637263411"),
("BAN20250817000042227","none","none","Steze Hotel","HOT202507100637263411"),
("BAN20250817000026170","Bank Mandiri",1234575,"Steze Hotel","HOT20250710063726345"),
("BAN20250817000042228","none","none","Steze Hotel","HOT20250710063726345"),
("BAN20250817000026171","Bank Mandiri",1234576,"Steze Hotel","HOT202507100637263412"),
("BAN20250817000042229","none","none","Steze Hotel","HOT202507100637263412");


DROP TABLE IF EXISTS `data_hapus_transaksi`;

CREATE TABLE `data_hapus_transaksi` (
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

INSERT INTO `data_hapus_transaksi` VALUES ("","TRA20250806090324106","PEL20250715065839276","KAM20250710085556471","2025-08-06","2025-08-08",3198837474,300000,"MET20250806031339605",2,0,0,"Selesai","HOT20250710063626968","2025-08-09 11:32:05",""),
("HAP20250811153009662","TRA20250811152640121","PEL20250715065839276","KAM20250715065633581","2025-08-12","2025-08-15","none",540000,"Tunai",2,0,0,"Lunas","","2025-08-11 15:30:09","ADM20250710063810359");


DROP TABLE IF EXISTS `data_hotel`;

CREATE TABLE `data_hotel` (
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(50) DEFAULT NULL,
  `koordinat` varchar(250) DEFAULT NULL,
  `gambar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_hotel` VALUES ("HOT20250710063548555","TAC Sipin","Jl. Syamsu Bahroen No.12, Selamat, Kec. Telanaipura, Kota Jambi, Jambi 36124",2129707600,"-6.198290958000439,106.81770801544191","1754638585-71504-sipin.webp"),
("HOT20250710063626968","Nusa Indah 1","Jl. Nusa Indah I, Rw. Sari, Kec. Kota Baru, Kota Jambi, Jambi 36361",82184614212,"-6.200117527420315,106.81715011596681","1754638334-52363-nusa_indah1.webp"),
("HOT20250710063726341","Nusa Indah 3","Jl. Nusa Indah 3 RT 8, Rawasari Kec. Alam Barajo, Rawasari, Kec. Kota Baru 36124",82173027422,"-6.199946870107371,106.81783676147462","1754638664-74075-nusa indah3.webp"),
("HOT202507100637263410","Telanaipura 1","Jl. Pakis II No.44, Pematang Sulur, Kec. Telanaipura, Kota Jambi, Jambi 36361",82177912506,"-6.200288184678057,106.81766510009767","1754638880-89063-telanai1.jpg"),
("HOT202507100637263411","Telanaipura 2","Jl. RE. Marta Dinata No.47, RT.04, Telanaipura, Kec. Telanaipura, Kota Jambi 36122",82136008756,"-6.199946870107371,106.81715011596681","1754639050-21986-telanai2.webp"),
("HOT202507100637263412","Mendalo","9GVF+W64, Mendalo Darat, Kec. Jambi Luar Kota, Kabupaten Muaro Jambi, Jambi 36361",2129707601,"-6.200117527420315,106.81697845458986","1754639294-63973-mendalo.jpg"),
("HOT20250710063726343","Kota Baru","Jl. Pintu Besi, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129",82177912507,"-6.199946870107371,106.81732177734376","1754639461-28514-kota baru.webp"),
("HOT20250710063726344","Tehok 1","Lrg. Jelita, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36123",82185045406,"-6.200117527420315,106.81697845458986","1754639566-59875-tehok 1.webp"),
("HOT20250710063726345","Tehok 2","Jl. Dr. Mawardi, RT.001/RW.01, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36122",82282103560,"-6.200288184678057,106.81697845458986","1754639730-63959-thehok2.webp"),
("HOT20250710063726346","Talang Banjar","Budiman, Kec. Jambi Tim., Kota Jambi, Jambi 36123",82184548411,"-6.200117527420315,106.81715011596681","1754639814-76851-talangbanjar.jpg"),
("HOT20250710063726347","Haji Kamil","Jl. Angkasa Puri No.74-60, Pasir Putih, Kec. Jambi Sel., Kota Jambi, Jambi 36129",87840695290,"-6.200288184678057,106.81697845458986","1754639971-63728-pasirputih.webp");


DROP TABLE IF EXISTS `data_kamar`;

CREATE TABLE `data_kamar` (
  `id_kamar` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `harga_harian` varchar(100) NOT NULL,
  `harga_bulanan` varchar(30) NOT NULL,
  `no_kamar` varchar(30) NOT NULL,
  `id_tipe_kamar` varchar(50) NOT NULL,
  `status_kamar` enum('Terisi','Kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_kamar` VALUES ("KMHOT20250710063548555-1","HOT20250710063548555",2,160000,4800000,1,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-2","HOT20250710063548555",2,160000,4800000,2,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-3","HOT20250710063548555",2,160000,4800000,3,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-4","HOT20250710063548555",2,160000,4800000,4,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-5","HOT20250710063548555",2,160000,4800000,5,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-6","HOT20250710063548555",2,160000,4800000,6,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-7","HOT20250710063548555",2,160000,4800000,7,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-8","HOT20250710063548555",2,160000,4800000,8,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-9","HOT20250710063548555",2,160000,4800000,9,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-10","HOT20250710063548555",2,160000,4800000,10,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-11","HOT20250710063548555","2-3",180000,5400000,11,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-12","HOT20250710063548555","2-3",180000,5400000,12,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-13","HOT20250710063548555","2-3",180000,5400000,13,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-14","HOT20250710063548555","2-3",180000,5400000,14,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-15","HOT20250710063548555","2-3",180000,5400000,15,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-16","HOT20250710063548555","2-3",180000,5400000,16,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-17","HOT20250710063548555","2-3",180000,5400000,17,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-18","HOT20250710063548555","2-3",180000,5400000,18,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-19","HOT20250710063548555","2-3",180000,5400000,19,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-20","HOT20250710063548555","2-3",180000,5400000,20,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-21","HOT20250710063548555",4,250000,7500000,21,"TYPHOT20250710063548555-3","Kosong"),
("KMHOT20250710063548555-22","HOT20250710063548555",4,250000,7500000,22,"TYPHOT20250710063548555-3","Kosong"),
("KMHOT20250710063626968-1","HOT20250710063626968",1,120000,3600000,1,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-2","HOT20250710063626968",1,120000,3600000,2,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-3","HOT20250710063626968",1,120000,3600000,3,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-4","HOT20250710063626968",2,150000,4500000,4,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-5","HOT20250710063626968",2,150000,4500000,5,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-6","HOT20250710063626968",2,150000,4500000,6,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-7","HOT20250710063626968",2,150000,4500000,7,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-8","HOT20250710063626968",2,150000,4500000,8,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-9","HOT20250710063626968",2,150000,4500000,9,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-10","HOT20250710063626968",2,150000,4500000,10,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-11","HOT20250710063626968",2,150000,4500000,11,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-12","HOT20250710063626968",2,150000,4500000,12,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-13","HOT20250710063626968",2,150000,4500000,13,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-14","HOT20250710063626968",2,150000,4500000,14,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-15","HOT20250710063626968",2,150000,4500000,15,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-16","HOT20250710063626968",2,150000,4500000,16,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-17","HOT20250710063626968",2,150000,4500000,17,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-18","HOT20250710063626968",2,150000,4500000,18,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-19","HOT20250710063626968",2,150000,4500000,19,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-20","HOT20250710063626968",2,150000,4500000,20,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-21","HOT20250710063626968",2,150000,4500000,21,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-22","HOT20250710063626968",2,150000,4500000,22,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-23","HOT20250710063626968",2,150000,4500000,23,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-24","HOT20250710063626968",2,150000,4500000,24,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-25","HOT20250710063626968",2,150000,4500000,25,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-26","HOT20250710063626968",2,150000,4500000,26,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-27","HOT20250710063626968","2-3",160000,4800000,27,"TYPHOT20250710063626968-3","Kosong"),
("KMHOT20250710063626968-28","HOT20250710063626968",2,190000,5700000,28,"TYPHOT20250710063626968-4","Kosong"),
("KMHOT20250710063626968-29","HOT20250710063626968",4,220000,6600000,29,"TYPHOT20250710063626968-5","Kosong"),
("KMHOT202507100637263410-1","HOT202507100637263410",2,150000,4500000,1,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-2","HOT202507100637263410",2,150000,4500000,2,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-3","HOT202507100637263410",2,150000,4500000,3,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-4","HOT202507100637263410",2,150000,4500000,4,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-5","HOT202507100637263410",2,150000,4500000,5,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-6","HOT202507100637263410",2,150000,4500000,6,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-7","HOT202507100637263410",2,150000,4500000,7,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-8","HOT202507100637263410",2,150000,4500000,8,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-9","HOT202507100637263410",2,150000,4500000,9,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-10","HOT202507100637263410",2,150000,4500000,10,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-11","HOT202507100637263410",2,150000,4500000,11,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-12","HOT202507100637263410",2,150000,4500000,12,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-13","HOT202507100637263410",2,150000,4500000,13,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-14","HOT202507100637263410",2,150000,4500000,14,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-15","HOT202507100637263410",2,190000,5700000,15,"TYPHOT202507100637263410-2","Kosong"),
("KMHOT202507100637263410-16","HOT202507100637263410",4,220000,6600000,16,"TYPHOT202507100637263410-3","Kosong"),
("KMHOT20250710063726343-1","HOT20250710063726343",2,150000,4500000,1,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-2","HOT20250710063726343",2,150000,4500000,2,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-3","HOT20250710063726343",2,150000,4500000,3,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-4","HOT20250710063726343",2,150000,4500000,4,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-5","HOT20250710063726343",2,150000,4500000,5,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-6","HOT20250710063726343",2,150000,4500000,6,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-7","HOT20250710063726343",2,150000,4500000,7,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-8","HOT20250710063726343",2,150000,4500000,8,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-9","HOT20250710063726343",2,150000,4500000,9,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-10","HOT20250710063726343",2,150000,4500000,10,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-11","HOT20250710063726343",2,150000,4500000,11,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-12","HOT20250710063726343",2,150000,4500000,12,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-13","HOT20250710063726343",2,150000,4500000,13,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-14","HOT20250710063726343",2,150000,4500000,14,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-15","HOT20250710063726343",2,150000,4500000,15,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-16","HOT20250710063726343",2,150000,4500000,16,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-17","HOT20250710063726343",2,150000,4500000,17,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-18","HOT20250710063726343",2,150000,4500000,18,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-19","HOT20250710063726343",2,150000,4500000,19,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-20","HOT20250710063726343",2,150000,4500000,20,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-21","HOT20250710063726343",4,250000,7500000,21,"TYPHOT20250710063726343-2","Kosong"),
("KMHOT20250710063726343-22","HOT20250710063726343",4,250000,7500000,22,"TYPHOT20250710063726343-2","Kosong"),
("KMHOT20250710063726341-1","HOT20250710063726341",1,120000,3600000,1,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-2","HOT20250710063726341",1,120000,3600000,2,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-3","HOT20250710063726341",1,120000,3600000,3,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-4","HOT20250710063726341",1,120000,3600000,4,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-5","HOT20250710063726341",2,150000,4500000,5,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-6","HOT20250710063726341",2,150000,4500000,6,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-7","HOT20250710063726341",2,150000,4500000,7,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-8","HOT20250710063726341",2,150000,4500000,8,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-9","HOT20250710063726341",2,150000,4500000,9,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-10","HOT20250710063726341",2,150000,4500000,10,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-11","HOT20250710063726341",2,150000,4500000,11,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-12","HOT20250710063726341",2,150000,4500000,12,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-13","HOT20250710063726341",2,150000,4500000,13,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-14","HOT20250710063726341",2,150000,4500000,14,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-15","HOT20250710063726341",2,150000,4500000,15,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-16","HOT20250710063726341",2,150000,4500000,16,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-17","HOT20250710063726341",2,150000,4500000,17,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-18","HOT20250710063726341",2,150000,4500000,18,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-19","HOT20250710063726341",2,150000,4500000,19,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-20","HOT20250710063726341",2,150000,4500000,20,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-21","HOT20250710063726341",4,250000,7500000,21,"TYPHOT20250710063726341-3","Kosong"),
("KMHOT20250710063726341-22","HOT20250710063726341",4,250000,7500000,22,"TYPHOT20250710063726341-3","Kosong"),
("KMHOT20250710063726344-1","HOT20250710063726344",2,140000,4200000,1,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-2","HOT20250710063726344",2,140000,4200000,2,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-3","HOT20250710063726344",2,140000,4200000,3,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-4","HOT20250710063726344",2,140000,4200000,4,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-5","HOT20250710063726344",2,140000,4200000,5,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-6","HOT20250710063726344",2,140000,4200000,6,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-7","HOT20250710063726344",2,140000,4200000,7,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-8","HOT20250710063726344",2,140000,4200000,8,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-9","HOT20250710063726344",2,140000,4200000,9,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-10","HOT20250710063726344",2,140000,4200000,10,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-11","HOT20250710063726344",2,140000,4200000,11,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-12","HOT20250710063726344",2,140000,4200000,12,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-13","HOT20250710063726344",2,140000,4200000,13,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-14","HOT20250710063726344",4,180000,5400000,14,"TYPHOT20250710063726344-2","Kosong"),
("KMHOT20250710063726346-1","HOT20250710063726346",2,130000,3900000,1,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-2","HOT20250710063726346",2,130000,3900000,2,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-3","HOT20250710063726346",2,130000,3900000,3,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-4","HOT20250710063726346",2,130000,3900000,4,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-5","HOT20250710063726346",2,130000,3900000,5,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-6","HOT20250710063726346",2,130000,3900000,6,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-7","HOT20250710063726346",2,130000,3900000,7,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-8","HOT20250710063726346",2,130000,3900000,8,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-9","HOT20250710063726346",2,130000,3900000,9,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-10","HOT20250710063726346",2,130000,3900000,10,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-11","HOT20250710063726346",2,130000,3900000,11,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-12","HOT20250710063726346",2,130000,3900000,12,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-13","HOT20250710063726346",2,130000,3900000,13,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-14","HOT20250710063726346",2,130000,3900000,14,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-15","HOT20250710063726346",2,130000,3900000,15,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-16","HOT20250710063726346",2,130000,3900000,16,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-17","HOT20250710063726346",2,130000,3900000,17,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-18","HOT20250710063726346",2,130000,3900000,18,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-19","HOT20250710063726346",4,220000,6600000,19,"TYPHOT20250710063726346-2","Kosong"),
("KMHOT20250710063726347-1","HOT20250710063726347",1,120000,3600000,1,"TYPHOT20250710063726347-1","Kosong"),
("KMHOT20250710063726347-2","HOT20250710063726347",2,150000,4500000,2,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-3","HOT20250710063726347",2,150000,4500000,3,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-4","HOT20250710063726347",2,150000,4500000,4,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-5","HOT20250710063726347",2,150000,4500000,5,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-6","HOT20250710063726347",2,150000,4500000,6,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-7","HOT20250710063726347",2,150000,4500000,7,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-8","HOT20250710063726347",2,150000,4500000,8,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-9","HOT20250710063726347",2,150000,4500000,9,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-10","HOT20250710063726347",2,150000,4500000,10,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-11","HOT20250710063726347",2,150000,4500000,11,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-12","HOT20250710063726347",2,150000,4500000,12,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-13","HOT20250710063726347",2,150000,4500000,13,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-14","HOT20250710063726347",2,150000,4500000,14,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-15","HOT20250710063726347",2,150000,4500000,15,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-16","HOT20250710063726347",2,150000,4500000,16,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-17","HOT20250710063726347",2,150000,4500000,17,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-18","HOT20250710063726347",2,150000,4500000,18,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-19","HOT20250710063726347",2,150000,4500000,19,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-20","HOT20250710063726347",4,250000,7500000,20,"TYPHOT20250710063726347-3","Kosong"),
("KMHOT202507100637263411-1","HOT202507100637263411",2,150000,4500000,1,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-2","HOT202507100637263411",2,150000,4500000,2,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-3","HOT202507100637263411",2,150000,4500000,3,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-4","HOT202507100637263411",2,150000,4500000,4,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-5","HOT202507100637263411",2,150000,4500000,5,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-6","HOT202507100637263411",2,150000,4500000,6,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-7","HOT202507100637263411",2,150000,4500000,7,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-8","HOT202507100637263411",2,150000,4500000,8,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-9","HOT202507100637263411",2,150000,4500000,9,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-10","HOT202507100637263411",2,150000,4500000,10,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-11","HOT202507100637263411",2,150000,4500000,11,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-12","HOT202507100637263411",4,250000,7500000,12,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT202507100637263411-13","HOT202507100637263411",4,250000,7500000,13,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT202507100637263411-14","HOT202507100637263411",4,250000,7500000,14,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT20250710063726345-1","HOT20250710063726345",2,150000,4500000,1,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-2","HOT20250710063726345",2,150000,4500000,2,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-3","HOT20250710063726345",2,150000,4500000,3,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-4","HOT20250710063726345",2,150000,4500000,4,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-5","HOT20250710063726345",2,150000,4500000,5,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-6","HOT20250710063726345",2,150000,4500000,6,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-7","HOT20250710063726345",2,150000,4500000,7,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-8","HOT20250710063726345",2,150000,4500000,8,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-9","HOT20250710063726345",2,150000,4500000,9,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-10","HOT20250710063726345","2-3",180000,5400000,10,"TYPHOT20250710063726345-2","Kosong"),
("KMHOT202507100637263412-1","HOT202507100637263412",2,130000,3900000,1,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-2","HOT202507100637263412",2,130000,3900000,2,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-3","HOT202507100637263412",2,130000,3900000,3,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-4","HOT202507100637263412",2,130000,3900000,4,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-5","HOT202507100637263412",2,130000,3900000,5,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-6","HOT202507100637263412",2,130000,3900000,6,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-7","HOT202507100637263412",2,130000,3900000,7,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-8","HOT202507100637263412",2,130000,3900000,8,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-9","HOT202507100637263412",2,130000,3900000,9,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-10","HOT202507100637263412",2,130000,3900000,10,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-11","HOT202507100637263412",2,130000,3900000,11,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-12","HOT202507100637263412",2,130000,3900000,12,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-13","HOT202507100637263412",2,130000,3900000,13,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-14","HOT202507100637263412",2,130000,3900000,14,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-15","HOT202507100637263412",2,130000,3900000,15,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-16","HOT202507100637263412",2,130000,3900000,16,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-17","HOT202507100637263412",2,130000,3900000,17,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-18","HOT202507100637263412",2,130000,3900000,18,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-19","HOT202507100637263412",2,130000,3900000,19,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-20","HOT202507100637263412",2,130000,3900000,20,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-21","HOT202507100637263412",2,130000,3900000,21,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-22","HOT202507100637263412",2,130000,3900000,22,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-23","HOT202507100637263412",2,130000,3900000,23,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-24","HOT202507100637263412",2,130000,3900000,24,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-25","HOT202507100637263412",2,130000,3900000,25,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-26","HOT202507100637263412",2,130000,3900000,26,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-27","HOT202507100637263412",2,130000,3900000,27,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-28","HOT202507100637263412",2,130000,3900000,28,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-29","HOT202507100637263412",2,130000,3900000,29,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-30","HOT202507100637263412",2,130000,3900000,30,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-31","HOT202507100637263412",2,130000,3900000,31,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-32","HOT202507100637263412",2,130000,3900000,32,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-33","HOT202507100637263412",2,130000,3900000,33,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-34","HOT202507100637263412",2,130000,3900000,34,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-35","HOT202507100637263412",2,130000,3900000,35,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-36","HOT202507100637263412",2,130000,3900000,36,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-37","HOT202507100637263412",2,130000,3900000,37,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-38","HOT202507100637263412",2,130000,3900000,38,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-39","HOT202507100637263412",2,130000,3900000,39,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-40","HOT202507100637263412",2,130000,3900000,40,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-41","HOT202507100637263412",2,130000,3900000,41,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-42","HOT202507100637263412",2,130000,3900000,42,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-43","HOT202507100637263412",2,130000,3900000,43,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-44","HOT202507100637263412",2,130000,3900000,44,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-45","HOT202507100637263412",4,220000,6600000,45,"TYPHOT202507100637263412-2","Kosong"),
("KMHOT202507100637263412-46","HOT202507100637263412",4,220000,6600000,46,"TYPHOT202507100637263412-2","Kosong"),
("KMHOT20250710063626968-30","HOT20250710063626968",2,150000,4500000,30,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-31","HOT20250710063626968",2,150000,4500000,31,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-32","HOT20250710063626968",2,150000,4500000,32,"TYPHOT20250710063626968-2","Kosong");


DROP TABLE IF EXISTS `data_metode_pembayaran`;

CREATE TABLE `data_metode_pembayaran` (
  `id_metode_pembayaran` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `id_bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_metode_pembayaran` VALUES ("MET20250817000005617","HOT20250710063548555","Tunai","BAN20250817000042219"),
("MET20250817000024935","HOT20250710063548555","QRIS","BAN20250817000042219"),
("MET20250817000039604","HOT20250710063548555","Transfer Bank","BAN20250817000026161"),
("MET20250806031305618","HOT20250710063626968","Tunai","BAN20250806031242220"),
("MET20250806031324936","HOT20250710063626968","QRIS","BAN20250806031242220"),
("MET20250806031339605","HOT20250710063626968","Transfer Bank","BAN20250806031226162"),
("MET20250817000005619","HOT202507100637263410","Tunai","BAN20250817000042221"),
("MET20250817000024937","HOT202507100637263410","QRIS","BAN20250817000042221"),
("MET20250817000039606","HOT202507100637263410","Transfer Bank","BAN20250817000026163"),
("MET20250817000005620","HOT20250710063726343","Tunai","BAN20250817000042222"),
("MET20250817000024938","HOT20250710063726343","QRIS","BAN20250817000042222"),
("MET20250817000039607","HOT20250710063726343","Transfer Bank","BAN20250817000026164"),
("MET20250817000005621","HOT20250817000026165","Tunai","BAN20250817000042223"),
("MET20250817000024939","HOT20250817000026165","QRIS","BAN20250817000042223"),
("MET20250817000039608","HOT20250817000026165","Transfer Bank","BAN20250817000026165"),
("MET20250817000005622","HOT20250710063726344","Tunai","BAN20250817000042224"),
("MET20250817000024940","HOT20250710063726344","QRIS","BAN20250817000042224"),
("MET20250817000039609","HOT20250710063726344","Transfer Bank","BAN20250817000026166"),
("MET20250817000005623","HOT20250710063726346","Tunai","BAN20250817000042225"),
("MET20250817000024941","HOT20250710063726346","QRIS","BAN20250817000042225"),
("MET20250817000039610","HOT20250710063726346","Transfer Bank","BAN20250817000026167"),
("MET20250817000005624","HOT20250710063726347","Tunai","BAN20250817000042226"),
("MET20250817000024942","HOT20250710063726347","QRIS","BAN20250817000042226"),
("MET20250817000039611","HOT20250710063726347","Transfer Bank","BAN20250817000026168"),
("MET20250817000005625","HOT202507100637263411","Tunai","BAN20250817000042227"),
("MET20250817000024943","HOT202507100637263411","QRIS","BAN20250817000042227"),
("MET20250817000039612","HOT202507100637263411","Transfer Bank","BAN20250817000026169"),
("MET20250817000005626","HOT20250710063726345","Tunai","BAN20250817000042228"),
("MET20250817000024944","HOT20250710063726345","QRIS","BAN20250817000042228"),
("MET20250817000039613","HOT20250710063726345","Transfer Bank","BAN20250817000026170"),
("MET20250817000005627","HOT202507100637263412","Tunai","BAN20250817000042229"),
("MET20250817000024945","HOT202507100637263412","QRIS","BAN20250817000042229"),
("MET20250817000039614","HOT202507100637263412","Transfer Bank","BAN20250817000026171");


DROP TABLE IF EXISTS `data_operasional`;

CREATE TABLE `data_operasional` (
  `id_operasional` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `operasional` varchar(100) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `keperluan` text NOT NULL,
  `biaya` varchar(30) NOT NULL,
  `id_admin` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_operasional` VALUES ("OPE20250809055903657","HOT20250710063626968","2025-08-09","ATK hotel","10 set","Isi ulang ATK hotel",200000,"ADM20250710063810359"),
("OPE20250817150407219","HOT20250710063548555","2025-08-17","ATK Kantor",2,"Pembelian Buku Tamu",200000,"ADM20250710063548555");


DROP TABLE IF EXISTS `data_pelanggan`;

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pelanggan` VALUES ("PEL20250714082108440","Rianti","perempuan","HOT20250710063626968",8349394234),
("PEL20250715065839276","Rangga Aditya","laki-laki","HOT20250710063626968",876435532),
("PEL20250715070034707","Fatma Fiani","perempuan","HOT20250710063626968",837443722),
("PEL20250717043546608","vioni","perempuan","HOT20250710063626968",8734634),
("PEL20250717045213800","ahmad sarkowi","laki-laki","HOT20250710063626968",9384377433),
("PEL20250722095444394","Rani Samanta","perempuan","HOT20250710063626968",8937473743),
("PEL20250809060403879","ramadhana","laki-laki","HOT20250710063626968",08372626525),
("PEL20250812043404533","Fajaruddin","laki-laki","HOT20250710063626968",08967332233);


DROP TABLE IF EXISTS `data_pengaturan_aplikasi`;

CREATE TABLE `data_pengaturan_aplikasi` (
  `id_pengaturan_aplikasi` varchar(50) DEFAULT NULL,
  `nama_pengaturan` varchar(250) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_pengaturan_aplikasi` VALUES (1,"transaksi_bulanan","tidak_aktif");


DROP TABLE IF EXISTS `data_pengaturan_printer`;

CREATE TABLE `data_pengaturan_printer` (
  `id_pengaturan_printer` varchar(50) NOT NULL DEFAULT '',
  `nama_printer_nota` varchar(100) DEFAULT NULL,
  `ukuran_kertas` enum('32','48','A4') DEFAULT NULL,
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
  `no_wa_sumber` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pengaturan_printer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengaturan_printer` VALUES ("PEN1912001","RP58 Printer",32,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993);


DROP TABLE IF EXISTS `data_pengelola`;

CREATE TABLE `data_pengelola` (
  `id_pengelola` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengelola` VALUES ("PEN2334RTT","pengelola","super","21232f297a57a5a743894a0e4a801fc3");


DROP TABLE IF EXISTS `data_tipe_kamar`;

CREATE TABLE `data_tipe_kamar` (
  `id_tipe_kamar` varchar(50) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `id_hotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_tipe_kamar` VALUES ("TYPHOT20250710063548555-1","DOUBLE","HOT20250710063548555"),
("TYPHOT20250710063548555-2","DELUXE","HOT20250710063548555"),
("TYPHOT20250710063548555-3","FAMILY","HOT20250710063548555"),
("TYPHOT20250710063626968-1","SINGLE","HOT20250710063626968"),
("TYPHOT20250710063626968-2","DOUBLE","HOT20250710063626968"),
("TYPHOT20250710063626968-3","DELUXE","HOT20250710063626968"),
("TYPHOT20250710063626968-4","TWIN","HOT20250710063626968"),
("TYPHOT20250710063626968-5","FAMILY","HOT20250710063626968"),
("TYPHOT20250710063726341-1","SINGLE","HOT20250710063726341"),
("TYPHOT20250710063726341-2","DOUBLE","HOT20250710063726341"),
("TYPHOT20250710063726341-3","FAMILY","HOT20250710063726341"),
("TYPHOT202507100637263410-1","DOUBLE","HOT202507100637263410"),
("TYPHOT202507100637263410-2","TWIN","HOT202507100637263410"),
("TYPHOT202507100637263410-3","FAMILY","HOT202507100637263410"),
("TYPHOT202507100637263411-1","DOUBLE","HOT202507100637263411"),
("TYPHOT202507100637263411-2","FAMILY","HOT202507100637263411"),
("TYPHOT202507100637263412-1","DOUBLE","HOT202507100637263412"),
("TYPHOT202507100637263412-2","FAMILY","HOT202507100637263412"),
("TYPHOT20250710063726343-1","DOUBLE","HOT20250710063726343"),
("TYPHOT20250710063726343-2","FAMILY","HOT20250710063726343"),
("TYPHOT20250710063726344-1","DOUBLE","HOT20250710063726344"),
("TYPHOT20250710063726344-2","FAMILY","HOT20250710063726344"),
("TYPHOT20250710063726345-1","DOUBLE","HOT20250710063726345"),
("TYPHOT20250710063726345-2","DELUXE","HOT20250710063726345"),
("TYPHOT20250710063726346-1","DOUBLE","HOT20250710063726346"),
("TYPHOT20250710063726346-2","FAMILY","HOT20250710063726346"),
("TYPHOT20250710063726347-1","SINGLE","HOT20250710063726347"),
("TYPHOT20250710063726347-2","DOUBLE","HOT20250710063726347"),
("TYPHOT20250710063726347-3","FAMILY","HOT20250710063726347");


DROP TABLE IF EXISTS `data_transaksi`;

CREATE TABLE `data_transaksi` (
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
  `biaya_tambahan_checkout` varchar(60) DEFAULT '',
  `deskripsi_biaya_checkout` varchar(60) DEFAULT '',
  `note` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_transaksi` VALUES ("TRA20250817213017747","PEL20250812043404533","KMHOT20250710063548555-1","2025-08-17","2025-08-18",1234566,160000,"MET20250817000039604",2,1,0,"Selesai","Fajaruddin",08967332233,1,"DOUBLE","21:30:17","21:30:17",1,"harian","ADM20250710063548555","Admin TAC Sipin","HOT20250710063548555","TAC Sipin","2025-08-17 21:30:17","BAN20250817000026161","Bank Mandiri",0,0,0,0,"-",0,NULL,NULL),
("TRA20250817222020835","PEL20250812043404533","KMHOT20250710063626968-1","2025-08-17","2025-08-18","none",120000,"MET20250806031305618",2,1,0,"Selesai","Fajaruddin",08967332233,1,"SINGLE","22:20:20","22:20:20",1,"harian","ADM20250710063626968","Admin Nusa Indah 1","HOT20250710063626968","Nusa Indah 1","2025-08-17 22:20:20","BAN20250806031242220","none",0,0,0,0,"-",0,NULL,NULL);


SET foreign_key_checks = 1;
CREATE DATABASE IF NOT EXISTS `databases_2025_steze_manajemen_hotel`;

USE `databases_2025_steze_manajemen_hotel`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `data_admin`;

CREATE TABLE `data_admin` (
  `id_admin` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_admin` VALUES ("ADM20250710063548555","HOT20250710063548555","Admin TAC Sipin","tac_sipin","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063626968","HOT20250710063626968","Admin Nusa Indah 1","nusa_indah_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263410","HOT202507100637263410","Admin Telanaipura 1","telanaipura_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726343","HOT20250710063726343","Admin Kota Baru","kota_baru","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726341","HOT20250710063726341","Admin Nusa Indah 3","nusa_indah_3","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726344","HOT20250710063726344","Admin Tehok 1","tehok_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726346","HOT20250710063726346","Admin Talang Banjar","talang_banjar","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726347","HOT20250710063726347","Admin Haji Kamil","haji_kamil","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263411","HOT202507100637263411","Admin Telanaipura 2","telanaipura_2","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726345","HOT20250710063726345","Admin Tehok 2","tehok_2","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263412","HOT202507100637263412","Admin Mendalo","mendalo","21232f297a57a5a743894a0e4a801fc3");


DROP TABLE IF EXISTS `data_bank`;

CREATE TABLE `data_bank` (
  `id_bank` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `rekening` varchar(250) DEFAULT NULL,
  `atas_nama` varchar(250) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_bank` VALUES ("BAN20250817000026161","Bank Mandiri",1234566,"Steze Hotel","HOT20250710063548555"),
("BAN20250817000042219","none","none","Steze Hotel","HOT20250710063548555"),
("BAN20250806031226162","Bank Mandiri",1234567,"Steze Hotel","HOT20250710063626968"),
("BAN20250806031242220","none","none","Steze Hotel","HOT20250710063626968"),
("BAN20250817000026163","Bank Mandiri",1234568,"Steze Hotel","HOT202507100637263410"),
("BAN20250817000042221","none","none","Steze Hotel","HOT202507100637263410"),
("BAN20250817000026164","Bank Mandiri",1234569,"Steze Hotel","HOT20250710063726343"),
("BAN20250817000042222","none","none","Steze Hotel","HOT20250710063726343"),
("BAN20250817000026165","Bank Mandiri",1234570,"Steze Hotel","HOT20250817000026165"),
("BAN20250817000042223","none","none","Steze Hotel","HOT20250817000026165"),
("BAN20250817000026166","Bank Mandiri",1234571,"Steze Hotel","HOT20250710063726344"),
("BAN20250817000042224","none","none","Steze Hotel","HOT20250710063726344"),
("BAN20250817000026167","Bank Mandiri",1234572,"Steze Hotel","HOT20250710063726346"),
("BAN20250817000042225","none","none","Steze Hotel","HOT20250710063726346"),
("BAN20250817000026168","Bank Mandiri",1234573,"Steze Hotel","HOT20250710063726347"),
("BAN20250817000042226","none","none","Steze Hotel","HOT20250710063726347"),
("BAN20250817000026169","Bank Mandiri",1234574,"Steze Hotel","HOT202507100637263411"),
("BAN20250817000042227","none","none","Steze Hotel","HOT202507100637263411"),
("BAN20250817000026170","Bank Mandiri",1234575,"Steze Hotel","HOT20250710063726345"),
("BAN20250817000042228","none","none","Steze Hotel","HOT20250710063726345"),
("BAN20250817000026171","Bank Mandiri",1234576,"Steze Hotel","HOT202507100637263412"),
("BAN20250817000042229","none","none","Steze Hotel","HOT202507100637263412");


DROP TABLE IF EXISTS `data_hapus_transaksi`;

CREATE TABLE `data_hapus_transaksi` (
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

INSERT INTO `data_hapus_transaksi` VALUES ("","TRA20250806090324106","PEL20250715065839276","KAM20250710085556471","2025-08-06","2025-08-08",3198837474,300000,"MET20250806031339605",2,0,0,"Selesai","HOT20250710063626968","2025-08-09 11:32:05",""),
("HAP20250811153009662","TRA20250811152640121","PEL20250715065839276","KAM20250715065633581","2025-08-12","2025-08-15","none",540000,"Tunai",2,0,0,"Lunas","","2025-08-11 15:30:09","ADM20250710063810359");


DROP TABLE IF EXISTS `data_hotel`;

CREATE TABLE `data_hotel` (
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(50) DEFAULT NULL,
  `koordinat` varchar(250) DEFAULT NULL,
  `gambar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_hotel` VALUES ("HOT20250710063548555","TAC Sipin","Jl. Syamsu Bahroen No.12, Selamat, Kec. Telanaipura, Kota Jambi, Jambi 36124",2129707600,"-6.198290958000439,106.81770801544191","1754638585-71504-sipin.webp"),
("HOT20250710063626968","Nusa Indah 1","Jl. Nusa Indah I, Rw. Sari, Kec. Kota Baru, Kota Jambi, Jambi 36361",82184614212,"-6.200117527420315,106.81715011596681","1754638334-52363-nusa_indah1.webp"),
("HOT20250710063726341","Nusa Indah 3","Jl. Nusa Indah 3 RT 8, Rawasari Kec. Alam Barajo, Rawasari, Kec. Kota Baru 36124",82173027422,"-6.199946870107371,106.81783676147462","1754638664-74075-nusa indah3.webp"),
("HOT202507100637263410","Telanaipura 1","Jl. Pakis II No.44, Pematang Sulur, Kec. Telanaipura, Kota Jambi, Jambi 36361",82177912506,"-6.200288184678057,106.81766510009767","1754638880-89063-telanai1.jpg"),
("HOT202507100637263411","Telanaipura 2","Jl. RE. Marta Dinata No.47, RT.04, Telanaipura, Kec. Telanaipura, Kota Jambi 36122",82136008756,"-6.199946870107371,106.81715011596681","1754639050-21986-telanai2.webp"),
("HOT202507100637263412","Mendalo","9GVF+W64, Mendalo Darat, Kec. Jambi Luar Kota, Kabupaten Muaro Jambi, Jambi 36361",2129707601,"-6.200117527420315,106.81697845458986","1754639294-63973-mendalo.jpg"),
("HOT20250710063726343","Kota Baru","Jl. Pintu Besi, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129",82177912507,"-6.199946870107371,106.81732177734376","1754639461-28514-kota baru.webp"),
("HOT20250710063726344","Tehok 1","Lrg. Jelita, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36123",82185045406,"-6.200117527420315,106.81697845458986","1754639566-59875-tehok 1.webp"),
("HOT20250710063726345","Tehok 2","Jl. Dr. Mawardi, RT.001/RW.01, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36122",82282103560,"-6.200288184678057,106.81697845458986","1754639730-63959-thehok2.webp"),
("HOT20250710063726346","Talang Banjar","Budiman, Kec. Jambi Tim., Kota Jambi, Jambi 36123",82184548411,"-6.200117527420315,106.81715011596681","1754639814-76851-talangbanjar.jpg"),
("HOT20250710063726347","Haji Kamil","Jl. Angkasa Puri No.74-60, Pasir Putih, Kec. Jambi Sel., Kota Jambi, Jambi 36129",87840695290,"-6.200288184678057,106.81697845458986","1754639971-63728-pasirputih.webp");


DROP TABLE IF EXISTS `data_kamar`;

CREATE TABLE `data_kamar` (
  `id_kamar` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `harga_harian` varchar(100) NOT NULL,
  `harga_bulanan` varchar(30) NOT NULL,
  `no_kamar` varchar(30) NOT NULL,
  `id_tipe_kamar` varchar(50) NOT NULL,
  `status_kamar` enum('Terisi','Kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_kamar` VALUES ("KMHOT20250710063548555-1","HOT20250710063548555",2,160000,4800000,1,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-2","HOT20250710063548555",2,160000,4800000,2,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-3","HOT20250710063548555",2,160000,4800000,3,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-4","HOT20250710063548555",2,160000,4800000,4,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-5","HOT20250710063548555",2,160000,4800000,5,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-6","HOT20250710063548555",2,160000,4800000,6,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-7","HOT20250710063548555",2,160000,4800000,7,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-8","HOT20250710063548555",2,160000,4800000,8,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-9","HOT20250710063548555",2,160000,4800000,9,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-10","HOT20250710063548555",2,160000,4800000,10,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-11","HOT20250710063548555","2-3",180000,5400000,11,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-12","HOT20250710063548555","2-3",180000,5400000,12,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-13","HOT20250710063548555","2-3",180000,5400000,13,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-14","HOT20250710063548555","2-3",180000,5400000,14,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-15","HOT20250710063548555","2-3",180000,5400000,15,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-16","HOT20250710063548555","2-3",180000,5400000,16,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-17","HOT20250710063548555","2-3",180000,5400000,17,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-18","HOT20250710063548555","2-3",180000,5400000,18,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-19","HOT20250710063548555","2-3",180000,5400000,19,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-20","HOT20250710063548555","2-3",180000,5400000,20,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-21","HOT20250710063548555",4,250000,7500000,21,"TYPHOT20250710063548555-3","Kosong"),
("KMHOT20250710063548555-22","HOT20250710063548555",4,250000,7500000,22,"TYPHOT20250710063548555-3","Kosong"),
("KMHOT20250710063626968-1","HOT20250710063626968",1,120000,3600000,1,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-2","HOT20250710063626968",1,120000,3600000,2,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-3","HOT20250710063626968",1,120000,3600000,3,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-4","HOT20250710063626968",2,150000,4500000,4,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-5","HOT20250710063626968",2,150000,4500000,5,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-6","HOT20250710063626968",2,150000,4500000,6,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-7","HOT20250710063626968",2,150000,4500000,7,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-8","HOT20250710063626968",2,150000,4500000,8,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-9","HOT20250710063626968",2,150000,4500000,9,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-10","HOT20250710063626968",2,150000,4500000,10,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-11","HOT20250710063626968",2,150000,4500000,11,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-12","HOT20250710063626968",2,150000,4500000,12,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-13","HOT20250710063626968",2,150000,4500000,13,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-14","HOT20250710063626968",2,150000,4500000,14,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-15","HOT20250710063626968",2,150000,4500000,15,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-16","HOT20250710063626968",2,150000,4500000,16,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-17","HOT20250710063626968",2,150000,4500000,17,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-18","HOT20250710063626968",2,150000,4500000,18,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-19","HOT20250710063626968",2,150000,4500000,19,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-20","HOT20250710063626968",2,150000,4500000,20,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-21","HOT20250710063626968",2,150000,4500000,21,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-22","HOT20250710063626968",2,150000,4500000,22,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-23","HOT20250710063626968",2,150000,4500000,23,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-24","HOT20250710063626968",2,150000,4500000,24,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-25","HOT20250710063626968",2,150000,4500000,25,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-26","HOT20250710063626968",2,150000,4500000,26,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-27","HOT20250710063626968","2-3",160000,4800000,27,"TYPHOT20250710063626968-3","Kosong"),
("KMHOT20250710063626968-28","HOT20250710063626968",2,190000,5700000,28,"TYPHOT20250710063626968-4","Kosong"),
("KMHOT20250710063626968-29","HOT20250710063626968",4,220000,6600000,29,"TYPHOT20250710063626968-5","Kosong"),
("KMHOT202507100637263410-1","HOT202507100637263410",2,150000,4500000,1,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-2","HOT202507100637263410",2,150000,4500000,2,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-3","HOT202507100637263410",2,150000,4500000,3,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-4","HOT202507100637263410",2,150000,4500000,4,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-5","HOT202507100637263410",2,150000,4500000,5,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-6","HOT202507100637263410",2,150000,4500000,6,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-7","HOT202507100637263410",2,150000,4500000,7,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-8","HOT202507100637263410",2,150000,4500000,8,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-9","HOT202507100637263410",2,150000,4500000,9,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-10","HOT202507100637263410",2,150000,4500000,10,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-11","HOT202507100637263410",2,150000,4500000,11,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-12","HOT202507100637263410",2,150000,4500000,12,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-13","HOT202507100637263410",2,150000,4500000,13,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-14","HOT202507100637263410",2,150000,4500000,14,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-15","HOT202507100637263410",2,190000,5700000,15,"TYPHOT202507100637263410-2","Kosong"),
("KMHOT202507100637263410-16","HOT202507100637263410",4,220000,6600000,16,"TYPHOT202507100637263410-3","Kosong"),
("KMHOT20250710063726343-1","HOT20250710063726343",2,150000,4500000,1,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-2","HOT20250710063726343",2,150000,4500000,2,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-3","HOT20250710063726343",2,150000,4500000,3,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-4","HOT20250710063726343",2,150000,4500000,4,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-5","HOT20250710063726343",2,150000,4500000,5,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-6","HOT20250710063726343",2,150000,4500000,6,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-7","HOT20250710063726343",2,150000,4500000,7,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-8","HOT20250710063726343",2,150000,4500000,8,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-9","HOT20250710063726343",2,150000,4500000,9,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-10","HOT20250710063726343",2,150000,4500000,10,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-11","HOT20250710063726343",2,150000,4500000,11,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-12","HOT20250710063726343",2,150000,4500000,12,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-13","HOT20250710063726343",2,150000,4500000,13,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-14","HOT20250710063726343",2,150000,4500000,14,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-15","HOT20250710063726343",2,150000,4500000,15,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-16","HOT20250710063726343",2,150000,4500000,16,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-17","HOT20250710063726343",2,150000,4500000,17,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-18","HOT20250710063726343",2,150000,4500000,18,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-19","HOT20250710063726343",2,150000,4500000,19,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-20","HOT20250710063726343",2,150000,4500000,20,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-21","HOT20250710063726343",4,250000,7500000,21,"TYPHOT20250710063726343-2","Kosong"),
("KMHOT20250710063726343-22","HOT20250710063726343",4,250000,7500000,22,"TYPHOT20250710063726343-2","Kosong"),
("KMHOT20250710063726341-1","HOT20250710063726341",1,120000,3600000,1,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-2","HOT20250710063726341",1,120000,3600000,2,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-3","HOT20250710063726341",1,120000,3600000,3,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-4","HOT20250710063726341",1,120000,3600000,4,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-5","HOT20250710063726341",2,150000,4500000,5,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-6","HOT20250710063726341",2,150000,4500000,6,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-7","HOT20250710063726341",2,150000,4500000,7,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-8","HOT20250710063726341",2,150000,4500000,8,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-9","HOT20250710063726341",2,150000,4500000,9,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-10","HOT20250710063726341",2,150000,4500000,10,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-11","HOT20250710063726341",2,150000,4500000,11,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-12","HOT20250710063726341",2,150000,4500000,12,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-13","HOT20250710063726341",2,150000,4500000,13,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-14","HOT20250710063726341",2,150000,4500000,14,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-15","HOT20250710063726341",2,150000,4500000,15,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-16","HOT20250710063726341",2,150000,4500000,16,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-17","HOT20250710063726341",2,150000,4500000,17,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-18","HOT20250710063726341",2,150000,4500000,18,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-19","HOT20250710063726341",2,150000,4500000,19,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-20","HOT20250710063726341",2,150000,4500000,20,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-21","HOT20250710063726341",4,250000,7500000,21,"TYPHOT20250710063726341-3","Kosong"),
("KMHOT20250710063726341-22","HOT20250710063726341",4,250000,7500000,22,"TYPHOT20250710063726341-3","Kosong"),
("KMHOT20250710063726344-1","HOT20250710063726344",2,140000,4200000,1,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-2","HOT20250710063726344",2,140000,4200000,2,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-3","HOT20250710063726344",2,140000,4200000,3,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-4","HOT20250710063726344",2,140000,4200000,4,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-5","HOT20250710063726344",2,140000,4200000,5,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-6","HOT20250710063726344",2,140000,4200000,6,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-7","HOT20250710063726344",2,140000,4200000,7,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-8","HOT20250710063726344",2,140000,4200000,8,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-9","HOT20250710063726344",2,140000,4200000,9,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-10","HOT20250710063726344",2,140000,4200000,10,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-11","HOT20250710063726344",2,140000,4200000,11,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-12","HOT20250710063726344",2,140000,4200000,12,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-13","HOT20250710063726344",2,140000,4200000,13,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-14","HOT20250710063726344",4,180000,5400000,14,"TYPHOT20250710063726344-2","Kosong"),
("KMHOT20250710063726346-1","HOT20250710063726346",2,130000,3900000,1,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-2","HOT20250710063726346",2,130000,3900000,2,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-3","HOT20250710063726346",2,130000,3900000,3,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-4","HOT20250710063726346",2,130000,3900000,4,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-5","HOT20250710063726346",2,130000,3900000,5,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-6","HOT20250710063726346",2,130000,3900000,6,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-7","HOT20250710063726346",2,130000,3900000,7,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-8","HOT20250710063726346",2,130000,3900000,8,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-9","HOT20250710063726346",2,130000,3900000,9,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-10","HOT20250710063726346",2,130000,3900000,10,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-11","HOT20250710063726346",2,130000,3900000,11,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-12","HOT20250710063726346",2,130000,3900000,12,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-13","HOT20250710063726346",2,130000,3900000,13,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-14","HOT20250710063726346",2,130000,3900000,14,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-15","HOT20250710063726346",2,130000,3900000,15,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-16","HOT20250710063726346",2,130000,3900000,16,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-17","HOT20250710063726346",2,130000,3900000,17,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-18","HOT20250710063726346",2,130000,3900000,18,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-19","HOT20250710063726346",4,220000,6600000,19,"TYPHOT20250710063726346-2","Kosong"),
("KMHOT20250710063726347-1","HOT20250710063726347",1,120000,3600000,1,"TYPHOT20250710063726347-1","Kosong"),
("KMHOT20250710063726347-2","HOT20250710063726347",2,150000,4500000,2,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-3","HOT20250710063726347",2,150000,4500000,3,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-4","HOT20250710063726347",2,150000,4500000,4,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-5","HOT20250710063726347",2,150000,4500000,5,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-6","HOT20250710063726347",2,150000,4500000,6,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-7","HOT20250710063726347",2,150000,4500000,7,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-8","HOT20250710063726347",2,150000,4500000,8,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-9","HOT20250710063726347",2,150000,4500000,9,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-10","HOT20250710063726347",2,150000,4500000,10,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-11","HOT20250710063726347",2,150000,4500000,11,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-12","HOT20250710063726347",2,150000,4500000,12,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-13","HOT20250710063726347",2,150000,4500000,13,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-14","HOT20250710063726347",2,150000,4500000,14,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-15","HOT20250710063726347",2,150000,4500000,15,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-16","HOT20250710063726347",2,150000,4500000,16,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-17","HOT20250710063726347",2,150000,4500000,17,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-18","HOT20250710063726347",2,150000,4500000,18,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-19","HOT20250710063726347",2,150000,4500000,19,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-20","HOT20250710063726347",4,250000,7500000,20,"TYPHOT20250710063726347-3","Kosong"),
("KMHOT202507100637263411-1","HOT202507100637263411",2,150000,4500000,1,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-2","HOT202507100637263411",2,150000,4500000,2,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-3","HOT202507100637263411",2,150000,4500000,3,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-4","HOT202507100637263411",2,150000,4500000,4,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-5","HOT202507100637263411",2,150000,4500000,5,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-6","HOT202507100637263411",2,150000,4500000,6,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-7","HOT202507100637263411",2,150000,4500000,7,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-8","HOT202507100637263411",2,150000,4500000,8,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-9","HOT202507100637263411",2,150000,4500000,9,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-10","HOT202507100637263411",2,150000,4500000,10,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-11","HOT202507100637263411",2,150000,4500000,11,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-12","HOT202507100637263411",4,250000,7500000,12,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT202507100637263411-13","HOT202507100637263411",4,250000,7500000,13,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT202507100637263411-14","HOT202507100637263411",4,250000,7500000,14,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT20250710063726345-1","HOT20250710063726345",2,150000,4500000,1,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-2","HOT20250710063726345",2,150000,4500000,2,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-3","HOT20250710063726345",2,150000,4500000,3,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-4","HOT20250710063726345",2,150000,4500000,4,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-5","HOT20250710063726345",2,150000,4500000,5,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-6","HOT20250710063726345",2,150000,4500000,6,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-7","HOT20250710063726345",2,150000,4500000,7,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-8","HOT20250710063726345",2,150000,4500000,8,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-9","HOT20250710063726345",2,150000,4500000,9,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-10","HOT20250710063726345","2-3",180000,5400000,10,"TYPHOT20250710063726345-2","Kosong"),
("KMHOT202507100637263412-1","HOT202507100637263412",2,130000,3900000,1,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-2","HOT202507100637263412",2,130000,3900000,2,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-3","HOT202507100637263412",2,130000,3900000,3,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-4","HOT202507100637263412",2,130000,3900000,4,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-5","HOT202507100637263412",2,130000,3900000,5,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-6","HOT202507100637263412",2,130000,3900000,6,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-7","HOT202507100637263412",2,130000,3900000,7,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-8","HOT202507100637263412",2,130000,3900000,8,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-9","HOT202507100637263412",2,130000,3900000,9,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-10","HOT202507100637263412",2,130000,3900000,10,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-11","HOT202507100637263412",2,130000,3900000,11,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-12","HOT202507100637263412",2,130000,3900000,12,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-13","HOT202507100637263412",2,130000,3900000,13,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-14","HOT202507100637263412",2,130000,3900000,14,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-15","HOT202507100637263412",2,130000,3900000,15,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-16","HOT202507100637263412",2,130000,3900000,16,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-17","HOT202507100637263412",2,130000,3900000,17,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-18","HOT202507100637263412",2,130000,3900000,18,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-19","HOT202507100637263412",2,130000,3900000,19,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-20","HOT202507100637263412",2,130000,3900000,20,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-21","HOT202507100637263412",2,130000,3900000,21,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-22","HOT202507100637263412",2,130000,3900000,22,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-23","HOT202507100637263412",2,130000,3900000,23,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-24","HOT202507100637263412",2,130000,3900000,24,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-25","HOT202507100637263412",2,130000,3900000,25,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-26","HOT202507100637263412",2,130000,3900000,26,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-27","HOT202507100637263412",2,130000,3900000,27,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-28","HOT202507100637263412",2,130000,3900000,28,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-29","HOT202507100637263412",2,130000,3900000,29,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-30","HOT202507100637263412",2,130000,3900000,30,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-31","HOT202507100637263412",2,130000,3900000,31,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-32","HOT202507100637263412",2,130000,3900000,32,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-33","HOT202507100637263412",2,130000,3900000,33,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-34","HOT202507100637263412",2,130000,3900000,34,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-35","HOT202507100637263412",2,130000,3900000,35,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-36","HOT202507100637263412",2,130000,3900000,36,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-37","HOT202507100637263412",2,130000,3900000,37,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-38","HOT202507100637263412",2,130000,3900000,38,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-39","HOT202507100637263412",2,130000,3900000,39,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-40","HOT202507100637263412",2,130000,3900000,40,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-41","HOT202507100637263412",2,130000,3900000,41,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-42","HOT202507100637263412",2,130000,3900000,42,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-43","HOT202507100637263412",2,130000,3900000,43,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-44","HOT202507100637263412",2,130000,3900000,44,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-45","HOT202507100637263412",4,220000,6600000,45,"TYPHOT202507100637263412-2","Kosong"),
("KMHOT202507100637263412-46","HOT202507100637263412",4,220000,6600000,46,"TYPHOT202507100637263412-2","Kosong"),
("KMHOT20250710063626968-30","HOT20250710063626968",2,150000,4500000,30,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-31","HOT20250710063626968",2,150000,4500000,31,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-32","HOT20250710063626968",2,150000,4500000,32,"TYPHOT20250710063626968-2","Kosong");


DROP TABLE IF EXISTS `data_metode_pembayaran`;

CREATE TABLE `data_metode_pembayaran` (
  `id_metode_pembayaran` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `id_bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_metode_pembayaran` VALUES ("MET20250817000005617","HOT20250710063548555","Tunai","BAN20250817000042219"),
("MET20250817000024935","HOT20250710063548555","QRIS","BAN20250817000042219"),
("MET20250817000039604","HOT20250710063548555","Transfer Bank","BAN20250817000026161"),
("MET20250806031305618","HOT20250710063626968","Tunai","BAN20250806031242220"),
("MET20250806031324936","HOT20250710063626968","QRIS","BAN20250806031242220"),
("MET20250806031339605","HOT20250710063626968","Transfer Bank","BAN20250806031226162"),
("MET20250817000005619","HOT202507100637263410","Tunai","BAN20250817000042221"),
("MET20250817000024937","HOT202507100637263410","QRIS","BAN20250817000042221"),
("MET20250817000039606","HOT202507100637263410","Transfer Bank","BAN20250817000026163"),
("MET20250817000005620","HOT20250710063726343","Tunai","BAN20250817000042222"),
("MET20250817000024938","HOT20250710063726343","QRIS","BAN20250817000042222"),
("MET20250817000039607","HOT20250710063726343","Transfer Bank","BAN20250817000026164"),
("MET20250817000005621","HOT20250817000026165","Tunai","BAN20250817000042223"),
("MET20250817000024939","HOT20250817000026165","QRIS","BAN20250817000042223"),
("MET20250817000039608","HOT20250817000026165","Transfer Bank","BAN20250817000026165"),
("MET20250817000005622","HOT20250710063726344","Tunai","BAN20250817000042224"),
("MET20250817000024940","HOT20250710063726344","QRIS","BAN20250817000042224"),
("MET20250817000039609","HOT20250710063726344","Transfer Bank","BAN20250817000026166"),
("MET20250817000005623","HOT20250710063726346","Tunai","BAN20250817000042225"),
("MET20250817000024941","HOT20250710063726346","QRIS","BAN20250817000042225"),
("MET20250817000039610","HOT20250710063726346","Transfer Bank","BAN20250817000026167"),
("MET20250817000005624","HOT20250710063726347","Tunai","BAN20250817000042226"),
("MET20250817000024942","HOT20250710063726347","QRIS","BAN20250817000042226"),
("MET20250817000039611","HOT20250710063726347","Transfer Bank","BAN20250817000026168"),
("MET20250817000005625","HOT202507100637263411","Tunai","BAN20250817000042227"),
("MET20250817000024943","HOT202507100637263411","QRIS","BAN20250817000042227"),
("MET20250817000039612","HOT202507100637263411","Transfer Bank","BAN20250817000026169"),
("MET20250817000005626","HOT20250710063726345","Tunai","BAN20250817000042228"),
("MET20250817000024944","HOT20250710063726345","QRIS","BAN20250817000042228"),
("MET20250817000039613","HOT20250710063726345","Transfer Bank","BAN20250817000026170"),
("MET20250817000005627","HOT202507100637263412","Tunai","BAN20250817000042229"),
("MET20250817000024945","HOT202507100637263412","QRIS","BAN20250817000042229"),
("MET20250817000039614","HOT202507100637263412","Transfer Bank","BAN20250817000026171");


DROP TABLE IF EXISTS `data_operasional`;

CREATE TABLE `data_operasional` (
  `id_operasional` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `operasional` varchar(100) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `keperluan` text NOT NULL,
  `biaya` varchar(30) NOT NULL,
  `id_admin` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_operasional` VALUES ("OPE20250809055903657","HOT20250710063626968","2025-08-09","ATK hotel","10 set","Isi ulang ATK hotel",200000,"ADM20250710063810359"),
("OPE20250817150407219","HOT20250710063548555","2025-08-17","ATK Kantor",2,"Pembelian Buku Tamu",200000,"ADM20250710063548555");


DROP TABLE IF EXISTS `data_pelanggan`;

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pelanggan` VALUES ("PEL20250714082108440","Rianti","perempuan","HOT20250710063626968",8349394234),
("PEL20250715065839276","Rangga Aditya","laki-laki","HOT20250710063626968",876435532),
("PEL20250715070034707","Fatma Fiani","perempuan","HOT20250710063626968",837443722),
("PEL20250717043546608","vioni","perempuan","HOT20250710063626968",8734634),
("PEL20250717045213800","ahmad sarkowi","laki-laki","HOT20250710063626968",9384377433),
("PEL20250722095444394","Rani Samanta","perempuan","HOT20250710063626968",8937473743),
("PEL20250809060403879","ramadhana","laki-laki","HOT20250710063626968",08372626525),
("PEL20250812043404533","Fajaruddin","laki-laki","HOT20250710063626968",08967332233);


DROP TABLE IF EXISTS `data_pengaturan_aplikasi`;

CREATE TABLE `data_pengaturan_aplikasi` (
  `id_pengaturan_aplikasi` varchar(50) DEFAULT NULL,
  `nama_pengaturan` varchar(250) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_pengaturan_aplikasi` VALUES (1,"transaksi_bulanan","tidak_aktif");


DROP TABLE IF EXISTS `data_pengaturan_printer`;

CREATE TABLE `data_pengaturan_printer` (
  `id_pengaturan_printer` varchar(50) NOT NULL DEFAULT '',
  `nama_printer_nota` varchar(100) DEFAULT NULL,
  `ukuran_kertas` enum('32','48','A4') DEFAULT NULL,
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
  `no_wa_sumber` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pengaturan_printer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengaturan_printer` VALUES ("PEN1912001","RP58 Printer",32,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993);


DROP TABLE IF EXISTS `data_pengelola`;

CREATE TABLE `data_pengelola` (
  `id_pengelola` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengelola` VALUES ("PEN2334RTT","pengelola","super","21232f297a57a5a743894a0e4a801fc3");


DROP TABLE IF EXISTS `data_tipe_kamar`;

CREATE TABLE `data_tipe_kamar` (
  `id_tipe_kamar` varchar(50) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `id_hotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_tipe_kamar` VALUES ("TYPHOT20250710063548555-1","DOUBLE","HOT20250710063548555"),
("TYPHOT20250710063548555-2","DELUXE","HOT20250710063548555"),
("TYPHOT20250710063548555-3","FAMILY","HOT20250710063548555"),
("TYPHOT20250710063626968-1","SINGLE","HOT20250710063626968"),
("TYPHOT20250710063626968-2","DOUBLE","HOT20250710063626968"),
("TYPHOT20250710063626968-3","DELUXE","HOT20250710063626968"),
("TYPHOT20250710063626968-4","TWIN","HOT20250710063626968"),
("TYPHOT20250710063626968-5","FAMILY","HOT20250710063626968"),
("TYPHOT20250710063726341-1","SINGLE","HOT20250710063726341"),
("TYPHOT20250710063726341-2","DOUBLE","HOT20250710063726341"),
("TYPHOT20250710063726341-3","FAMILY","HOT20250710063726341"),
("TYPHOT202507100637263410-1","DOUBLE","HOT202507100637263410"),
("TYPHOT202507100637263410-2","TWIN","HOT202507100637263410"),
("TYPHOT202507100637263410-3","FAMILY","HOT202507100637263410"),
("TYPHOT202507100637263411-1","DOUBLE","HOT202507100637263411"),
("TYPHOT202507100637263411-2","FAMILY","HOT202507100637263411"),
("TYPHOT202507100637263412-1","DOUBLE","HOT202507100637263412"),
("TYPHOT202507100637263412-2","FAMILY","HOT202507100637263412"),
("TYPHOT20250710063726343-1","DOUBLE","HOT20250710063726343"),
("TYPHOT20250710063726343-2","FAMILY","HOT20250710063726343"),
("TYPHOT20250710063726344-1","DOUBLE","HOT20250710063726344"),
("TYPHOT20250710063726344-2","FAMILY","HOT20250710063726344"),
("TYPHOT20250710063726345-1","DOUBLE","HOT20250710063726345"),
("TYPHOT20250710063726345-2","DELUXE","HOT20250710063726345"),
("TYPHOT20250710063726346-1","DOUBLE","HOT20250710063726346"),
("TYPHOT20250710063726346-2","FAMILY","HOT20250710063726346"),
("TYPHOT20250710063726347-1","SINGLE","HOT20250710063726347"),
("TYPHOT20250710063726347-2","DOUBLE","HOT20250710063726347"),
("TYPHOT20250710063726347-3","FAMILY","HOT20250710063726347");


DROP TABLE IF EXISTS `data_transaksi`;

CREATE TABLE `data_transaksi` (
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
  `biaya_tambahan_checkout` varchar(60) DEFAULT '',
  `deskripsi_biaya_checkout` varchar(60) DEFAULT '',
  `note` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_transaksi` VALUES ("TRA20250817213017747","PEL20250812043404533","KMHOT20250710063548555-1","2025-08-17","2025-08-18",1234566,160000,"MET20250817000039604",2,1,0,"Selesai","Fajaruddin",08967332233,1,"DOUBLE","21:30:17","21:30:17",1,"harian","ADM20250710063548555","Admin TAC Sipin","HOT20250710063548555","TAC Sipin","2025-08-17 21:30:17","BAN20250817000026161","Bank Mandiri",0,0,0,0,"-",0,NULL,NULL),
("TRA20250817222020835","PEL20250812043404533","KMHOT20250710063626968-1","2025-08-17","2025-08-18","none",120000,"MET20250806031305618",2,1,0,"Selesai","Fajaruddin",08967332233,1,"SINGLE","22:20:20","22:20:20",1,"harian","ADM20250710063626968","Admin Nusa Indah 1","HOT20250710063626968","Nusa Indah 1","2025-08-17 22:20:20","BAN20250806031242220","none",0,0,0,0,"-",0,NULL,NULL);


SET foreign_key_checks = 1;
CREATE DATABASE IF NOT EXISTS `databases_2025_steze_manajemen_hotel`;

USE `databases_2025_steze_manajemen_hotel`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `data_admin`;

CREATE TABLE `data_admin` (
  `id_admin` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_admin` VALUES ("ADM20250710063548555","HOT20250710063548555","Admin TAC Sipin","tac_sipin","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063626968","HOT20250710063626968","Admin Nusa Indah 1","nusa_indah_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263410","HOT202507100637263410","Admin Telanaipura 1","telanaipura_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726343","HOT20250710063726343","Admin Kota Baru","kota_baru","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726341","HOT20250710063726341","Admin Nusa Indah 3","nusa_indah_3","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726344","HOT20250710063726344","Admin Tehok 1","tehok_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726346","HOT20250710063726346","Admin Talang Banjar","talang_banjar","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726347","HOT20250710063726347","Admin Haji Kamil","haji_kamil","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263411","HOT202507100637263411","Admin Telanaipura 2","telanaipura_2","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726345","HOT20250710063726345","Admin Tehok 2","tehok_2","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263412","HOT202507100637263412","Admin Mendalo","mendalo","21232f297a57a5a743894a0e4a801fc3");


DROP TABLE IF EXISTS `data_bank`;

CREATE TABLE `data_bank` (
  `id_bank` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `rekening` varchar(250) DEFAULT NULL,
  `atas_nama` varchar(250) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_bank` VALUES ("BAN20250817000026161","Bank Mandiri",1234566,"Steze Hotel","HOT20250710063548555"),
("BAN20250817000042219","none","none","Steze Hotel","HOT20250710063548555"),
("BAN20250806031226162","Bank Mandiri",1234567,"Steze Hotel","HOT20250710063626968"),
("BAN20250806031242220","none","none","Steze Hotel","HOT20250710063626968"),
("BAN20250817000026163","Bank Mandiri",1234568,"Steze Hotel","HOT202507100637263410"),
("BAN20250817000042221","none","none","Steze Hotel","HOT202507100637263410"),
("BAN20250817000026164","Bank Mandiri",1234569,"Steze Hotel","HOT20250710063726343"),
("BAN20250817000042222","none","none","Steze Hotel","HOT20250710063726343"),
("BAN20250817000026165","Bank Mandiri",1234570,"Steze Hotel","HOT20250817000026165"),
("BAN20250817000042223","none","none","Steze Hotel","HOT20250817000026165"),
("BAN20250817000026166","Bank Mandiri",1234571,"Steze Hotel","HOT20250710063726344"),
("BAN20250817000042224","none","none","Steze Hotel","HOT20250710063726344"),
("BAN20250817000026167","Bank Mandiri",1234572,"Steze Hotel","HOT20250710063726346"),
("BAN20250817000042225","none","none","Steze Hotel","HOT20250710063726346"),
("BAN20250817000026168","Bank Mandiri",1234573,"Steze Hotel","HOT20250710063726347"),
("BAN20250817000042226","none","none","Steze Hotel","HOT20250710063726347"),
("BAN20250817000026169","Bank Mandiri",1234574,"Steze Hotel","HOT202507100637263411"),
("BAN20250817000042227","none","none","Steze Hotel","HOT202507100637263411"),
("BAN20250817000026170","Bank Mandiri",1234575,"Steze Hotel","HOT20250710063726345"),
("BAN20250817000042228","none","none","Steze Hotel","HOT20250710063726345"),
("BAN20250817000026171","Bank Mandiri",1234576,"Steze Hotel","HOT202507100637263412"),
("BAN20250817000042229","none","none","Steze Hotel","HOT202507100637263412");


DROP TABLE IF EXISTS `data_hapus_transaksi`;

CREATE TABLE `data_hapus_transaksi` (
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

INSERT INTO `data_hapus_transaksi` VALUES ("","TRA20250806090324106","PEL20250715065839276","KAM20250710085556471","2025-08-06","2025-08-08",3198837474,300000,"MET20250806031339605",2,0,0,"Selesai","HOT20250710063626968","2025-08-09 11:32:05",""),
("HAP20250811153009662","TRA20250811152640121","PEL20250715065839276","KAM20250715065633581","2025-08-12","2025-08-15","none",540000,"Tunai",2,0,0,"Lunas","","2025-08-11 15:30:09","ADM20250710063810359");


DROP TABLE IF EXISTS `data_hotel`;

CREATE TABLE `data_hotel` (
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(50) DEFAULT NULL,
  `koordinat` varchar(250) DEFAULT NULL,
  `gambar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_hotel` VALUES ("HOT20250710063548555","TAC Sipin","Jl. Syamsu Bahroen No.12, Selamat, Kec. Telanaipura, Kota Jambi, Jambi 36124",2129707600,"-6.198290958000439,106.81770801544191","1754638585-71504-sipin.webp"),
("HOT20250710063626968","Nusa Indah 1","Jl. Nusa Indah I, Rw. Sari, Kec. Kota Baru, Kota Jambi, Jambi 36361",82184614212,"-6.200117527420315,106.81715011596681","1754638334-52363-nusa_indah1.webp"),
("HOT20250710063726341","Nusa Indah 3","Jl. Nusa Indah 3 RT 8, Rawasari Kec. Alam Barajo, Rawasari, Kec. Kota Baru 36124",82173027422,"-6.199946870107371,106.81783676147462","1754638664-74075-nusa indah3.webp"),
("HOT202507100637263410","Telanaipura 1","Jl. Pakis II No.44, Pematang Sulur, Kec. Telanaipura, Kota Jambi, Jambi 36361",82177912506,"-6.200288184678057,106.81766510009767","1754638880-89063-telanai1.jpg"),
("HOT202507100637263411","Telanaipura 2","Jl. RE. Marta Dinata No.47, RT.04, Telanaipura, Kec. Telanaipura, Kota Jambi 36122",82136008756,"-6.199946870107371,106.81715011596681","1754639050-21986-telanai2.webp"),
("HOT202507100637263412","Mendalo","9GVF+W64, Mendalo Darat, Kec. Jambi Luar Kota, Kabupaten Muaro Jambi, Jambi 36361",2129707601,"-6.200117527420315,106.81697845458986","1754639294-63973-mendalo.jpg"),
("HOT20250710063726343","Kota Baru","Jl. Pintu Besi, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129",82177912507,"-6.199946870107371,106.81732177734376","1754639461-28514-kota baru.webp"),
("HOT20250710063726344","Tehok 1","Lrg. Jelita, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36123",82185045406,"-6.200117527420315,106.81697845458986","1754639566-59875-tehok 1.webp"),
("HOT20250710063726345","Tehok 2","Jl. Dr. Mawardi, RT.001/RW.01, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36122",82282103560,"-6.200288184678057,106.81697845458986","1754639730-63959-thehok2.webp"),
("HOT20250710063726346","Talang Banjar","Budiman, Kec. Jambi Tim., Kota Jambi, Jambi 36123",82184548411,"-6.200117527420315,106.81715011596681","1754639814-76851-talangbanjar.jpg"),
("HOT20250710063726347","Haji Kamil","Jl. Angkasa Puri No.74-60, Pasir Putih, Kec. Jambi Sel., Kota Jambi, Jambi 36129",87840695290,"-6.200288184678057,106.81697845458986","1754639971-63728-pasirputih.webp");


DROP TABLE IF EXISTS `data_kamar`;

CREATE TABLE `data_kamar` (
  `id_kamar` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `harga_harian` varchar(100) NOT NULL,
  `harga_bulanan` varchar(30) NOT NULL,
  `no_kamar` varchar(30) NOT NULL,
  `id_tipe_kamar` varchar(50) NOT NULL,
  `status_kamar` enum('Terisi','Kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_kamar` VALUES ("KMHOT20250710063548555-1","HOT20250710063548555",2,160000,4800000,1,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-2","HOT20250710063548555",2,160000,4800000,2,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-3","HOT20250710063548555",2,160000,4800000,3,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-4","HOT20250710063548555",2,160000,4800000,4,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-5","HOT20250710063548555",2,160000,4800000,5,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-6","HOT20250710063548555",2,160000,4800000,6,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-7","HOT20250710063548555",2,160000,4800000,7,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-8","HOT20250710063548555",2,160000,4800000,8,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-9","HOT20250710063548555",2,160000,4800000,9,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-10","HOT20250710063548555",2,160000,4800000,10,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-11","HOT20250710063548555","2-3",180000,5400000,11,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-12","HOT20250710063548555","2-3",180000,5400000,12,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-13","HOT20250710063548555","2-3",180000,5400000,13,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-14","HOT20250710063548555","2-3",180000,5400000,14,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-15","HOT20250710063548555","2-3",180000,5400000,15,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-16","HOT20250710063548555","2-3",180000,5400000,16,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-17","HOT20250710063548555","2-3",180000,5400000,17,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-18","HOT20250710063548555","2-3",180000,5400000,18,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-19","HOT20250710063548555","2-3",180000,5400000,19,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-20","HOT20250710063548555","2-3",180000,5400000,20,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-21","HOT20250710063548555",4,250000,7500000,21,"TYPHOT20250710063548555-3","Kosong"),
("KMHOT20250710063548555-22","HOT20250710063548555",4,250000,7500000,22,"TYPHOT20250710063548555-3","Kosong"),
("KMHOT20250710063626968-1","HOT20250710063626968",1,120000,3600000,1,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-2","HOT20250710063626968",1,120000,3600000,2,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-3","HOT20250710063626968",1,120000,3600000,3,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-4","HOT20250710063626968",2,150000,4500000,4,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-5","HOT20250710063626968",2,150000,4500000,5,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-6","HOT20250710063626968",2,150000,4500000,6,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-7","HOT20250710063626968",2,150000,4500000,7,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-8","HOT20250710063626968",2,150000,4500000,8,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-9","HOT20250710063626968",2,150000,4500000,9,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-10","HOT20250710063626968",2,150000,4500000,10,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-11","HOT20250710063626968",2,150000,4500000,11,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-12","HOT20250710063626968",2,150000,4500000,12,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-13","HOT20250710063626968",2,150000,4500000,13,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-14","HOT20250710063626968",2,150000,4500000,14,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-15","HOT20250710063626968",2,150000,4500000,15,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-16","HOT20250710063626968",2,150000,4500000,16,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-17","HOT20250710063626968",2,150000,4500000,17,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-18","HOT20250710063626968",2,150000,4500000,18,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-19","HOT20250710063626968",2,150000,4500000,19,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-20","HOT20250710063626968",2,150000,4500000,20,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-21","HOT20250710063626968",2,150000,4500000,21,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-22","HOT20250710063626968",2,150000,4500000,22,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-23","HOT20250710063626968",2,150000,4500000,23,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-24","HOT20250710063626968",2,150000,4500000,24,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-25","HOT20250710063626968",2,150000,4500000,25,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-26","HOT20250710063626968",2,150000,4500000,26,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-27","HOT20250710063626968","2-3",160000,4800000,27,"TYPHOT20250710063626968-3","Kosong"),
("KMHOT20250710063626968-28","HOT20250710063626968",2,190000,5700000,28,"TYPHOT20250710063626968-4","Kosong"),
("KMHOT20250710063626968-29","HOT20250710063626968",4,220000,6600000,29,"TYPHOT20250710063626968-5","Kosong"),
("KMHOT202507100637263410-1","HOT202507100637263410",2,150000,4500000,1,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-2","HOT202507100637263410",2,150000,4500000,2,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-3","HOT202507100637263410",2,150000,4500000,3,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-4","HOT202507100637263410",2,150000,4500000,4,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-5","HOT202507100637263410",2,150000,4500000,5,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-6","HOT202507100637263410",2,150000,4500000,6,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-7","HOT202507100637263410",2,150000,4500000,7,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-8","HOT202507100637263410",2,150000,4500000,8,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-9","HOT202507100637263410",2,150000,4500000,9,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-10","HOT202507100637263410",2,150000,4500000,10,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-11","HOT202507100637263410",2,150000,4500000,11,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-12","HOT202507100637263410",2,150000,4500000,12,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-13","HOT202507100637263410",2,150000,4500000,13,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-14","HOT202507100637263410",2,150000,4500000,14,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-15","HOT202507100637263410",2,190000,5700000,15,"TYPHOT202507100637263410-2","Kosong"),
("KMHOT202507100637263410-16","HOT202507100637263410",4,220000,6600000,16,"TYPHOT202507100637263410-3","Kosong"),
("KMHOT20250710063726343-1","HOT20250710063726343",2,150000,4500000,1,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-2","HOT20250710063726343",2,150000,4500000,2,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-3","HOT20250710063726343",2,150000,4500000,3,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-4","HOT20250710063726343",2,150000,4500000,4,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-5","HOT20250710063726343",2,150000,4500000,5,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-6","HOT20250710063726343",2,150000,4500000,6,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-7","HOT20250710063726343",2,150000,4500000,7,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-8","HOT20250710063726343",2,150000,4500000,8,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-9","HOT20250710063726343",2,150000,4500000,9,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-10","HOT20250710063726343",2,150000,4500000,10,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-11","HOT20250710063726343",2,150000,4500000,11,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-12","HOT20250710063726343",2,150000,4500000,12,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-13","HOT20250710063726343",2,150000,4500000,13,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-14","HOT20250710063726343",2,150000,4500000,14,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-15","HOT20250710063726343",2,150000,4500000,15,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-16","HOT20250710063726343",2,150000,4500000,16,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-17","HOT20250710063726343",2,150000,4500000,17,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-18","HOT20250710063726343",2,150000,4500000,18,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-19","HOT20250710063726343",2,150000,4500000,19,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-20","HOT20250710063726343",2,150000,4500000,20,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-21","HOT20250710063726343",4,250000,7500000,21,"TYPHOT20250710063726343-2","Kosong"),
("KMHOT20250710063726343-22","HOT20250710063726343",4,250000,7500000,22,"TYPHOT20250710063726343-2","Kosong"),
("KMHOT20250710063726341-1","HOT20250710063726341",1,120000,3600000,1,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-2","HOT20250710063726341",1,120000,3600000,2,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-3","HOT20250710063726341",1,120000,3600000,3,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-4","HOT20250710063726341",1,120000,3600000,4,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-5","HOT20250710063726341",2,150000,4500000,5,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-6","HOT20250710063726341",2,150000,4500000,6,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-7","HOT20250710063726341",2,150000,4500000,7,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-8","HOT20250710063726341",2,150000,4500000,8,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-9","HOT20250710063726341",2,150000,4500000,9,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-10","HOT20250710063726341",2,150000,4500000,10,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-11","HOT20250710063726341",2,150000,4500000,11,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-12","HOT20250710063726341",2,150000,4500000,12,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-13","HOT20250710063726341",2,150000,4500000,13,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-14","HOT20250710063726341",2,150000,4500000,14,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-15","HOT20250710063726341",2,150000,4500000,15,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-16","HOT20250710063726341",2,150000,4500000,16,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-17","HOT20250710063726341",2,150000,4500000,17,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-18","HOT20250710063726341",2,150000,4500000,18,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-19","HOT20250710063726341",2,150000,4500000,19,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-20","HOT20250710063726341",2,150000,4500000,20,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-21","HOT20250710063726341",4,250000,7500000,21,"TYPHOT20250710063726341-3","Kosong"),
("KMHOT20250710063726341-22","HOT20250710063726341",4,250000,7500000,22,"TYPHOT20250710063726341-3","Kosong"),
("KMHOT20250710063726344-1","HOT20250710063726344",2,140000,4200000,1,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-2","HOT20250710063726344",2,140000,4200000,2,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-3","HOT20250710063726344",2,140000,4200000,3,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-4","HOT20250710063726344",2,140000,4200000,4,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-5","HOT20250710063726344",2,140000,4200000,5,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-6","HOT20250710063726344",2,140000,4200000,6,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-7","HOT20250710063726344",2,140000,4200000,7,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-8","HOT20250710063726344",2,140000,4200000,8,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-9","HOT20250710063726344",2,140000,4200000,9,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-10","HOT20250710063726344",2,140000,4200000,10,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-11","HOT20250710063726344",2,140000,4200000,11,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-12","HOT20250710063726344",2,140000,4200000,12,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-13","HOT20250710063726344",2,140000,4200000,13,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-14","HOT20250710063726344",4,180000,5400000,14,"TYPHOT20250710063726344-2","Kosong"),
("KMHOT20250710063726346-1","HOT20250710063726346",2,130000,3900000,1,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-2","HOT20250710063726346",2,130000,3900000,2,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-3","HOT20250710063726346",2,130000,3900000,3,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-4","HOT20250710063726346",2,130000,3900000,4,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-5","HOT20250710063726346",2,130000,3900000,5,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-6","HOT20250710063726346",2,130000,3900000,6,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-7","HOT20250710063726346",2,130000,3900000,7,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-8","HOT20250710063726346",2,130000,3900000,8,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-9","HOT20250710063726346",2,130000,3900000,9,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-10","HOT20250710063726346",2,130000,3900000,10,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-11","HOT20250710063726346",2,130000,3900000,11,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-12","HOT20250710063726346",2,130000,3900000,12,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-13","HOT20250710063726346",2,130000,3900000,13,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-14","HOT20250710063726346",2,130000,3900000,14,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-15","HOT20250710063726346",2,130000,3900000,15,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-16","HOT20250710063726346",2,130000,3900000,16,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-17","HOT20250710063726346",2,130000,3900000,17,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-18","HOT20250710063726346",2,130000,3900000,18,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-19","HOT20250710063726346",4,220000,6600000,19,"TYPHOT20250710063726346-2","Kosong"),
("KMHOT20250710063726347-1","HOT20250710063726347",1,120000,3600000,1,"TYPHOT20250710063726347-1","Kosong"),
("KMHOT20250710063726347-2","HOT20250710063726347",2,150000,4500000,2,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-3","HOT20250710063726347",2,150000,4500000,3,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-4","HOT20250710063726347",2,150000,4500000,4,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-5","HOT20250710063726347",2,150000,4500000,5,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-6","HOT20250710063726347",2,150000,4500000,6,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-7","HOT20250710063726347",2,150000,4500000,7,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-8","HOT20250710063726347",2,150000,4500000,8,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-9","HOT20250710063726347",2,150000,4500000,9,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-10","HOT20250710063726347",2,150000,4500000,10,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-11","HOT20250710063726347",2,150000,4500000,11,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-12","HOT20250710063726347",2,150000,4500000,12,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-13","HOT20250710063726347",2,150000,4500000,13,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-14","HOT20250710063726347",2,150000,4500000,14,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-15","HOT20250710063726347",2,150000,4500000,15,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-16","HOT20250710063726347",2,150000,4500000,16,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-17","HOT20250710063726347",2,150000,4500000,17,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-18","HOT20250710063726347",2,150000,4500000,18,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-19","HOT20250710063726347",2,150000,4500000,19,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-20","HOT20250710063726347",4,250000,7500000,20,"TYPHOT20250710063726347-3","Kosong"),
("KMHOT202507100637263411-1","HOT202507100637263411",2,150000,4500000,1,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-2","HOT202507100637263411",2,150000,4500000,2,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-3","HOT202507100637263411",2,150000,4500000,3,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-4","HOT202507100637263411",2,150000,4500000,4,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-5","HOT202507100637263411",2,150000,4500000,5,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-6","HOT202507100637263411",2,150000,4500000,6,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-7","HOT202507100637263411",2,150000,4500000,7,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-8","HOT202507100637263411",2,150000,4500000,8,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-9","HOT202507100637263411",2,150000,4500000,9,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-10","HOT202507100637263411",2,150000,4500000,10,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-11","HOT202507100637263411",2,150000,4500000,11,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-12","HOT202507100637263411",4,250000,7500000,12,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT202507100637263411-13","HOT202507100637263411",4,250000,7500000,13,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT202507100637263411-14","HOT202507100637263411",4,250000,7500000,14,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT20250710063726345-1","HOT20250710063726345",2,150000,4500000,1,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-2","HOT20250710063726345",2,150000,4500000,2,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-3","HOT20250710063726345",2,150000,4500000,3,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-4","HOT20250710063726345",2,150000,4500000,4,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-5","HOT20250710063726345",2,150000,4500000,5,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-6","HOT20250710063726345",2,150000,4500000,6,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-7","HOT20250710063726345",2,150000,4500000,7,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-8","HOT20250710063726345",2,150000,4500000,8,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-9","HOT20250710063726345",2,150000,4500000,9,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-10","HOT20250710063726345","2-3",180000,5400000,10,"TYPHOT20250710063726345-2","Kosong"),
("KMHOT202507100637263412-1","HOT202507100637263412",2,130000,3900000,1,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-2","HOT202507100637263412",2,130000,3900000,2,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-3","HOT202507100637263412",2,130000,3900000,3,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-4","HOT202507100637263412",2,130000,3900000,4,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-5","HOT202507100637263412",2,130000,3900000,5,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-6","HOT202507100637263412",2,130000,3900000,6,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-7","HOT202507100637263412",2,130000,3900000,7,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-8","HOT202507100637263412",2,130000,3900000,8,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-9","HOT202507100637263412",2,130000,3900000,9,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-10","HOT202507100637263412",2,130000,3900000,10,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-11","HOT202507100637263412",2,130000,3900000,11,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-12","HOT202507100637263412",2,130000,3900000,12,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-13","HOT202507100637263412",2,130000,3900000,13,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-14","HOT202507100637263412",2,130000,3900000,14,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-15","HOT202507100637263412",2,130000,3900000,15,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-16","HOT202507100637263412",2,130000,3900000,16,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-17","HOT202507100637263412",2,130000,3900000,17,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-18","HOT202507100637263412",2,130000,3900000,18,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-19","HOT202507100637263412",2,130000,3900000,19,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-20","HOT202507100637263412",2,130000,3900000,20,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-21","HOT202507100637263412",2,130000,3900000,21,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-22","HOT202507100637263412",2,130000,3900000,22,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-23","HOT202507100637263412",2,130000,3900000,23,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-24","HOT202507100637263412",2,130000,3900000,24,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-25","HOT202507100637263412",2,130000,3900000,25,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-26","HOT202507100637263412",2,130000,3900000,26,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-27","HOT202507100637263412",2,130000,3900000,27,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-28","HOT202507100637263412",2,130000,3900000,28,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-29","HOT202507100637263412",2,130000,3900000,29,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-30","HOT202507100637263412",2,130000,3900000,30,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-31","HOT202507100637263412",2,130000,3900000,31,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-32","HOT202507100637263412",2,130000,3900000,32,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-33","HOT202507100637263412",2,130000,3900000,33,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-34","HOT202507100637263412",2,130000,3900000,34,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-35","HOT202507100637263412",2,130000,3900000,35,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-36","HOT202507100637263412",2,130000,3900000,36,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-37","HOT202507100637263412",2,130000,3900000,37,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-38","HOT202507100637263412",2,130000,3900000,38,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-39","HOT202507100637263412",2,130000,3900000,39,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-40","HOT202507100637263412",2,130000,3900000,40,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-41","HOT202507100637263412",2,130000,3900000,41,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-42","HOT202507100637263412",2,130000,3900000,42,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-43","HOT202507100637263412",2,130000,3900000,43,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-44","HOT202507100637263412",2,130000,3900000,44,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-45","HOT202507100637263412",4,220000,6600000,45,"TYPHOT202507100637263412-2","Kosong"),
("KMHOT202507100637263412-46","HOT202507100637263412",4,220000,6600000,46,"TYPHOT202507100637263412-2","Kosong"),
("KMHOT20250710063626968-30","HOT20250710063626968",2,150000,4500000,30,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-31","HOT20250710063626968",2,150000,4500000,31,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-32","HOT20250710063626968",2,150000,4500000,32,"TYPHOT20250710063626968-2","Kosong");


DROP TABLE IF EXISTS `data_metode_pembayaran`;

CREATE TABLE `data_metode_pembayaran` (
  `id_metode_pembayaran` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `id_bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_metode_pembayaran` VALUES ("MET20250817000005617","HOT20250710063548555","Tunai","BAN20250817000042219"),
("MET20250817000024935","HOT20250710063548555","QRIS","BAN20250817000042219"),
("MET20250817000039604","HOT20250710063548555","Transfer Bank","BAN20250817000026161"),
("MET20250806031305618","HOT20250710063626968","Tunai","BAN20250806031242220"),
("MET20250806031324936","HOT20250710063626968","QRIS","BAN20250806031242220"),
("MET20250806031339605","HOT20250710063626968","Transfer Bank","BAN20250806031226162"),
("MET20250817000005619","HOT202507100637263410","Tunai","BAN20250817000042221"),
("MET20250817000024937","HOT202507100637263410","QRIS","BAN20250817000042221"),
("MET20250817000039606","HOT202507100637263410","Transfer Bank","BAN20250817000026163"),
("MET20250817000005620","HOT20250710063726343","Tunai","BAN20250817000042222"),
("MET20250817000024938","HOT20250710063726343","QRIS","BAN20250817000042222"),
("MET20250817000039607","HOT20250710063726343","Transfer Bank","BAN20250817000026164"),
("MET20250817000005621","HOT20250817000026165","Tunai","BAN20250817000042223"),
("MET20250817000024939","HOT20250817000026165","QRIS","BAN20250817000042223"),
("MET20250817000039608","HOT20250817000026165","Transfer Bank","BAN20250817000026165"),
("MET20250817000005622","HOT20250710063726344","Tunai","BAN20250817000042224"),
("MET20250817000024940","HOT20250710063726344","QRIS","BAN20250817000042224"),
("MET20250817000039609","HOT20250710063726344","Transfer Bank","BAN20250817000026166"),
("MET20250817000005623","HOT20250710063726346","Tunai","BAN20250817000042225"),
("MET20250817000024941","HOT20250710063726346","QRIS","BAN20250817000042225"),
("MET20250817000039610","HOT20250710063726346","Transfer Bank","BAN20250817000026167"),
("MET20250817000005624","HOT20250710063726347","Tunai","BAN20250817000042226"),
("MET20250817000024942","HOT20250710063726347","QRIS","BAN20250817000042226"),
("MET20250817000039611","HOT20250710063726347","Transfer Bank","BAN20250817000026168"),
("MET20250817000005625","HOT202507100637263411","Tunai","BAN20250817000042227"),
("MET20250817000024943","HOT202507100637263411","QRIS","BAN20250817000042227"),
("MET20250817000039612","HOT202507100637263411","Transfer Bank","BAN20250817000026169"),
("MET20250817000005626","HOT20250710063726345","Tunai","BAN20250817000042228"),
("MET20250817000024944","HOT20250710063726345","QRIS","BAN20250817000042228"),
("MET20250817000039613","HOT20250710063726345","Transfer Bank","BAN20250817000026170"),
("MET20250817000005627","HOT202507100637263412","Tunai","BAN20250817000042229"),
("MET20250817000024945","HOT202507100637263412","QRIS","BAN20250817000042229"),
("MET20250817000039614","HOT202507100637263412","Transfer Bank","BAN20250817000026171");


DROP TABLE IF EXISTS `data_operasional`;

CREATE TABLE `data_operasional` (
  `id_operasional` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  `operasional` varchar(100) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `keperluan` text NOT NULL,
  `biaya` varchar(30) NOT NULL,
  `id_admin` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_operasional` VALUES ("OPE20250818154038682","HOT20250710063548555","2025-08-18 15:40:00","ATK",1,"Pembelian Kertas printer",50000,"ADM20250710063548555");


DROP TABLE IF EXISTS `data_pajak`;

CREATE TABLE `data_pajak` (
  `id_pajak` varchar(50) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `id_transaksi` varchar(50) DEFAULT NULL,
  `jenis_pajak` varchar(250) DEFAULT NULL,
  `persentase_pajak` int(10) DEFAULT NULL,
  `pajak` int(50) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_pajak` VALUES ("PAJ20250818160000548","2025-08-18 16:03:03","TRA20250818160000923","PPN",11,16940,"HOT20250710063548555");


DROP TABLE IF EXISTS `data_pelanggan`;

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pelanggan` VALUES ("PEL20250714082108440","Rianti","perempuan","HOT20250710063626968",8349394234),
("PEL20250715065839276","Rangga Aditya","laki-laki","HOT20250710063626968",876435532),
("PEL20250715070034707","Fatma Fiani","perempuan","HOT20250710063626968",837443722),
("PEL20250717043546608","vioni","perempuan","HOT20250710063626968",8734634),
("PEL20250717045213800","ahmad sarkowi","laki-laki","HOT20250710063626968",9384377433),
("PEL20250722095444394","Rani Samanta","perempuan","HOT20250710063626968",8937473743),
("PEL20250809060403879","ramadhana","laki-laki","HOT20250710063626968",08372626525),
("PEL20250812043404533","Fajaruddin","laki-laki","HOT20250710063626968",08967332233);


DROP TABLE IF EXISTS `data_pemasukan`;

CREATE TABLE `data_pemasukan` (
  `id_pemasukan` varchar(50) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `id_transaksi` varchar(50) DEFAULT NULL,
  `jumlah_bayar` int(10) DEFAULT NULL,
  `metode` varchar(250) DEFAULT NULL,
  `nama_bank` varchar(250) DEFAULT NULL,
  `rekening` varchar(250) DEFAULT NULL,
  `atas_nama` varchar(250) DEFAULT NULL,
  `keterangan` text,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_pemasukan` VALUES ("PEM20250818152011775","2025-08-18 15:20:11","TRA20250818152011836",144000,"","","-","Fajaruddin","Pembayaran Checkin A.n Fajaruddin, Kamar Nomor 1 (DOUBLE)","HOT20250710063548555"),
("PEM20250818152025150","2025-08-18 15:20:25","TRA20250818152011836",10000,"","","-","Fajaruddin","Pembayaran Checkout A.n Fajaruddin, Kamar Nomor 1 (DOUBLE) denda pecah gelas","HOT20250710063548555"),
("PEM20250818154714137","2025-08-18 15:47:14","TRA20250818154714679",320000,"","","-","Fajaruddin","Pembayaran Checkin A.n Fajaruddin, Kamar Nomor 2 (DOUBLE)","HOT20250710063548555"),
("PEM20250818154754207","2025-08-18 15:47:54","TRA20250818154714679",100000,"","","-","Fajaruddin","Pembayaran Checkout A.n Fajaruddin, Kamar Nomor 2 (DOUBLE) denda","HOT20250710063548555"),
("PEM20250818160000951","2025-08-18 16:00:00","TRA20250818160000923",159840,"","","-","Fajaruddin","Pembayaran Checkin A.n Fajaruddin, Kamar Nomor 1 (DOUBLE)","HOT20250710063548555"),
("PEM20250818160303813","2025-08-18 16:03:03","TRA20250818160000923",10000,"","","-","Fajaruddin","Pembayaran Checkout A.n Fajaruddin, Kamar Nomor 1 (DOUBLE) -","HOT20250710063548555");


DROP TABLE IF EXISTS `data_pengaturan_aplikasi`;

CREATE TABLE `data_pengaturan_aplikasi` (
  `id_pengaturan_aplikasi` varchar(50) DEFAULT NULL,
  `nama_pengaturan` varchar(250) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_pengaturan_aplikasi` VALUES (1,"transaksi_bulanan","tidak_aktif"),
(2,"persentase_pajak",11),
(3,"type_pajak","PPN");


DROP TABLE IF EXISTS `data_pengaturan_printer`;

CREATE TABLE `data_pengaturan_printer` (
  `id_pengaturan_printer` varchar(50) NOT NULL DEFAULT '',
  `nama_printer_nota` varchar(100) DEFAULT NULL,
  `ukuran_kertas` enum('32','48','A4') DEFAULT NULL,
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
  `no_wa_sumber` varchar(100) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pengaturan_printer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengaturan_printer` VALUES ("PEN202508170001","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063548555"),
("PEN202508170002","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063626968"),
("PEN202508170003","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726341"),
("PEN202508170004","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT202507100637263410"),
("PEN202508170005","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT202507100637263411"),
("PEN202508170006","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT202507100637263412"),
("PEN202508170007","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726343"),
("PEN202508170008","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726344"),
("PEN202508170009","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726345"),
("PEN202508170010","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726346"),
("PEN202508170011","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726347");


DROP TABLE IF EXISTS `data_pengelola`;

CREATE TABLE `data_pengelola` (
  `id_pengelola` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengelola` VALUES ("PEN2334RTT","pengelola","super","21232f297a57a5a743894a0e4a801fc3");


DROP TABLE IF EXISTS `data_tipe_kamar`;

CREATE TABLE `data_tipe_kamar` (
  `id_tipe_kamar` varchar(50) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `id_hotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_tipe_kamar` VALUES ("TYPHOT20250710063548555-1","DOUBLE","HOT20250710063548555"),
("TYPHOT20250710063548555-2","DELUXE","HOT20250710063548555"),
("TYPHOT20250710063548555-3","FAMILY","HOT20250710063548555"),
("TYPHOT20250710063626968-1","SINGLE","HOT20250710063626968"),
("TYPHOT20250710063626968-2","DOUBLE","HOT20250710063626968"),
("TYPHOT20250710063626968-3","DELUXE","HOT20250710063626968"),
("TYPHOT20250710063626968-4","TWIN","HOT20250710063626968"),
("TYPHOT20250710063626968-5","FAMILY","HOT20250710063626968"),
("TYPHOT20250710063726341-1","SINGLE","HOT20250710063726341"),
("TYPHOT20250710063726341-2","DOUBLE","HOT20250710063726341"),
("TYPHOT20250710063726341-3","FAMILY","HOT20250710063726341"),
("TYPHOT202507100637263410-1","DOUBLE","HOT202507100637263410"),
("TYPHOT202507100637263410-2","TWIN","HOT202507100637263410"),
("TYPHOT202507100637263410-3","FAMILY","HOT202507100637263410"),
("TYPHOT202507100637263411-1","DOUBLE","HOT202507100637263411"),
("TYPHOT202507100637263411-2","FAMILY","HOT202507100637263411"),
("TYPHOT202507100637263412-1","DOUBLE","HOT202507100637263412"),
("TYPHOT202507100637263412-2","FAMILY","HOT202507100637263412"),
("TYPHOT20250710063726343-1","DOUBLE","HOT20250710063726343"),
("TYPHOT20250710063726343-2","FAMILY","HOT20250710063726343"),
("TYPHOT20250710063726344-1","DOUBLE","HOT20250710063726344"),
("TYPHOT20250710063726344-2","FAMILY","HOT20250710063726344"),
("TYPHOT20250710063726345-1","DOUBLE","HOT20250710063726345"),
("TYPHOT20250710063726345-2","DELUXE","HOT20250710063726345"),
("TYPHOT20250710063726346-1","DOUBLE","HOT20250710063726346"),
("TYPHOT20250710063726346-2","FAMILY","HOT20250710063726346"),
("TYPHOT20250710063726347-1","SINGLE","HOT20250710063726347"),
("TYPHOT20250710063726347-2","DOUBLE","HOT20250710063726347"),
("TYPHOT20250710063726347-3","FAMILY","HOT20250710063726347");


DROP TABLE IF EXISTS `data_transaksi`;

CREATE TABLE `data_transaksi` (
  `id_transaksi` varchar(50) NOT NULL,
  `id_pelanggan` varchar(50) NOT NULL,
  `id_kamar` varchar(50) NOT NULL,
  `waktu_checkin` date NOT NULL,
  `waktu_checkout` date NOT NULL,
  `no_rekening` varchar(300) NOT NULL,
  `total_harga_kamar` varchar(300) NOT NULL DEFAULT '',
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
  `biaya_tambahan_checkin` varchar(60) NOT NULL,
  `deskripsi_biaya_checkin` text NOT NULL,
  `biaya_tambahan_checkout` varchar(60) DEFAULT '',
  `deskripsi_biaya_checkout` varchar(60) DEFAULT '',
  `catatan` varchar(60) DEFAULT NULL,
  `harga_kamar_harian` int(100) DEFAULT NULL,
  `harga_kamar_bulanan` int(100) DEFAULT NULL,
  `potongan_harga` int(100) DEFAULT NULL,
  `persentase_pajak` int(11) DEFAULT NULL,
  `pajak` int(10) DEFAULT NULL,
  `harga_sebelum_pajak` int(10) DEFAULT NULL,
  `total_bayar` int(100) DEFAULT NULL,
  `nominal_bayar` int(50) DEFAULT NULL,
  `jumlah_kembalian` int(60) DEFAULT NULL,
  `sisa_pembayaran` int(60) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_transaksi` VALUES ("TRA20250818152011836","PEL20250812043404533","KMHOT20250710063548555-1","2025-08-18","2025-08-19","-",160000,"",1,0,10,"Selesai","Fajaruddin",08967332233,1,"DOUBLE","15:20:11","15:20:11",1,"harian","ADM20250710063548555","Admin TAC Sipin","HOT20250710063548555","TAC Sipin","2025-08-18 15:20:11","","",10000,"-",10000,"denda pecah gelas","",160000,4800000,10000,0,0,144000,154000,0,0,144000),
("TRA20250818154714679","PEL20250812043404533","KMHOT20250710063548555-2","2025-08-18","2025-08-20","-",320000,"",1,0,0,"Selesai","Fajaruddin",08967332233,2,"DOUBLE","15:47:14","15:47:14",2,"harian","ADM20250710063548555","Admin TAC Sipin","HOT20250710063548555","TAC Sipin","2025-08-18 15:47:14","","",0,"-",100000,"denda","",160000,4800000,0,0,0,320000,420000,0,0,320000),
("TRA20250818160000923","PEL20250812043404533","KMHOT20250710063548555-1","2025-08-18","2025-08-19","-",160000,"",1,0,10,"Selesai","Fajaruddin",08967332233,1,"DOUBLE","16:00:00","16:00:00",1,"harian","ADM20250710063548555","Admin TAC Sipin","HOT20250710063548555","TAC Sipin","2025-08-18 16:00:00","","",10000,"-",10000,"-","",160000,4800000,10000,11,16940,144000,170940,0,0,159840);


SET foreign_key_checks = 1;
CREATE DATABASE IF NOT EXISTS `databases_2025_steze_manajemen_hotel`;

USE `databases_2025_steze_manajemen_hotel`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `data_admin`;

CREATE TABLE `data_admin` (
  `id_admin` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_admin` VALUES ("ADM20250710063548555","HOT20250710063548555","Admin TAC Sipin","tac_sipin","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063626968","HOT20250710063626968","Admin Nusa Indah 1","nusa_indah_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263410","HOT202507100637263410","Admin Telanaipura 1","telanaipura_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726343","HOT20250710063726343","Admin Kota Baru","kota_baru","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726341","HOT20250710063726341","Admin Nusa Indah 3","nusa_indah_3","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726344","HOT20250710063726344","Admin Tehok 1","tehok_1","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726346","HOT20250710063726346","Admin Talang Banjar","talang_banjar","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726347","HOT20250710063726347","Admin Haji Kamil","haji_kamil","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263411","HOT202507100637263411","Admin Telanaipura 2","telanaipura_2","21232f297a57a5a743894a0e4a801fc3"),
("ADM20250710063726345","HOT20250710063726345","Admin Tehok 2","tehok_2","21232f297a57a5a743894a0e4a801fc3"),
("ADM202507100637263412","HOT202507100637263412","Admin Mendalo","mendalo","21232f297a57a5a743894a0e4a801fc3");


DROP TABLE IF EXISTS `data_bank`;

CREATE TABLE `data_bank` (
  `id_bank` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `rekening` varchar(250) DEFAULT NULL,
  `atas_nama` varchar(250) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_bank` VALUES ("BAN20250817000026161","Bank Mandiri",1234566,"Steze Hotel","HOT20250710063548555"),
("BAN20250817000042219","none","none","Steze Hotel","HOT20250710063548555"),
("BAN20250806031226162","Bank Mandiri",1234567,"Steze Hotel","HOT20250710063626968"),
("BAN20250806031242220","none","none","Steze Hotel","HOT20250710063626968"),
("BAN20250817000026163","Bank Mandiri",1234568,"Steze Hotel","HOT202507100637263410"),
("BAN20250817000042221","none","none","Steze Hotel","HOT202507100637263410"),
("BAN20250817000026164","Bank Mandiri",1234569,"Steze Hotel","HOT20250710063726343"),
("BAN20250817000042222","none","none","Steze Hotel","HOT20250710063726343"),
("BAN20250817000026165","Bank Mandiri",1234570,"Steze Hotel","HOT20250817000026165"),
("BAN20250817000042223","none","none","Steze Hotel","HOT20250817000026165"),
("BAN20250817000026166","Bank Mandiri",1234571,"Steze Hotel","HOT20250710063726344"),
("BAN20250817000042224","none","none","Steze Hotel","HOT20250710063726344"),
("BAN20250817000026167","Bank Mandiri",1234572,"Steze Hotel","HOT20250710063726346"),
("BAN20250817000042225","none","none","Steze Hotel","HOT20250710063726346"),
("BAN20250817000026168","Bank Mandiri",1234573,"Steze Hotel","HOT20250710063726347"),
("BAN20250817000042226","none","none","Steze Hotel","HOT20250710063726347"),
("BAN20250817000026169","Bank Mandiri",1234574,"Steze Hotel","HOT202507100637263411"),
("BAN20250817000042227","none","none","Steze Hotel","HOT202507100637263411"),
("BAN20250817000026170","Bank Mandiri",1234575,"Steze Hotel","HOT20250710063726345"),
("BAN20250817000042228","none","none","Steze Hotel","HOT20250710063726345"),
("BAN20250817000026171","Bank Mandiri",1234576,"Steze Hotel","HOT202507100637263412"),
("BAN20250817000042229","none","none","Steze Hotel","HOT202507100637263412");


DROP TABLE IF EXISTS `data_channel`;

CREATE TABLE `data_channel` (
  `id_channel` varchar(50) DEFAULT NULL,
  `channel` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_channel` VALUES (1,"Walk-In Guest"),
(2,"Google Maps"),
(3,"Telepon"),
(4,"Website"),
(5,"Traveloka"),
(6,"Tiket.com"),
(7,"Pegipegi"),
(8,"RedDoorz"),
(9,"OYO Rooms"),
(10,"Airy Rooms"),
(11,"Agoda"),
(12,"Booking.com"),
(13,"Corporate"),
(14,"Government"),
(15,"Travel Agent"),
(16,"Group / Event"),
(17,"Marketing"),
(18,"Tiktok"),
(19,"Instagram"),
(20,"Lainnnya");


DROP TABLE IF EXISTS `data_hapus_transaksi`;

CREATE TABLE `data_hapus_transaksi` (
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

INSERT INTO `data_hapus_transaksi` VALUES ("","TRA20250806090324106","PEL20250715065839276","KAM20250710085556471","2025-08-06","2025-08-08",3198837474,300000,"MET20250806031339605",2,0,0,"Selesai","HOT20250710063626968","2025-08-09 11:32:05",""),
("HAP20250811153009662","TRA20250811152640121","PEL20250715065839276","KAM20250715065633581","2025-08-12","2025-08-15","none",540000,"Tunai",2,0,0,"Lunas","","2025-08-11 15:30:09","ADM20250710063810359");


DROP TABLE IF EXISTS `data_hotel`;

CREATE TABLE `data_hotel` (
  `id_hotel` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(50) DEFAULT NULL,
  `koordinat` varchar(250) DEFAULT NULL,
  `gambar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_hotel` VALUES ("HOT20250710063548555","TAC Sipin","Jl. Syamsu Bahroen No.12, Selamat, Kec. Telanaipura, Kota Jambi, Jambi 36124",2129707600,"-6.198290958000439,106.81770801544191","1754638585-71504-sipin.webp"),
("HOT20250710063626968","Nusa Indah 1","Jl. Nusa Indah I, Rw. Sari, Kec. Kota Baru, Kota Jambi, Jambi 36361",82184614212,"-6.200117527420315,106.81715011596681","1754638334-52363-nusa_indah1.webp"),
("HOT20250710063726341","Nusa Indah 3","Jl. Nusa Indah 3 RT 8, Rawasari Kec. Alam Barajo, Rawasari, Kec. Kota Baru 36124",82173027422,"-6.199946870107371,106.81783676147462","1754638664-74075-nusa indah3.webp"),
("HOT202507100637263410","Telanaipura 1","Jl. Pakis II No.44, Pematang Sulur, Kec. Telanaipura, Kota Jambi, Jambi 36361",82177912506,"-6.200288184678057,106.81766510009767","1754638880-89063-telanai1.jpg"),
("HOT202507100637263411","Telanaipura 2","Jl. RE. Marta Dinata No.47, RT.04, Telanaipura, Kec. Telanaipura, Kota Jambi 36122",82136008756,"-6.199946870107371,106.81715011596681","1754639050-21986-telanai2.webp"),
("HOT202507100637263412","Mendalo","9GVF+W64, Mendalo Darat, Kec. Jambi Luar Kota, Kabupaten Muaro Jambi, Jambi 36361",2129707601,"-6.200117527420315,106.81697845458986","1754639294-63973-mendalo.jpg"),
("HOT20250710063726343","Kota Baru","Jl. Pintu Besi, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129",82177912507,"-6.199946870107371,106.81732177734376","1754639461-28514-kota baru.webp"),
("HOT20250710063726344","Tehok 1","Lrg. Jelita, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36123",82185045406,"-6.200117527420315,106.81697845458986","1754639566-59875-tehok 1.webp"),
("HOT20250710063726345","Tehok 2","Jl. Dr. Mawardi, RT.001/RW.01, Tambak Sari, Kec. Jambi Sel., Kota Jambi, Jambi 36122",82282103560,"-6.200288184678057,106.81697845458986","1754639730-63959-thehok2.webp"),
("HOT20250710063726346","Talang Banjar","Budiman, Kec. Jambi Tim., Kota Jambi, Jambi 36123",82184548411,"-6.200117527420315,106.81715011596681","1754639814-76851-talangbanjar.jpg"),
("HOT20250710063726347","Haji Kamil","Jl. Angkasa Puri No.74-60, Pasir Putih, Kec. Jambi Sel., Kota Jambi, Jambi 36129",87840695290,"-6.200288184678057,106.81697845458986","1754639971-63728-pasirputih.webp");


DROP TABLE IF EXISTS `data_kamar`;

CREATE TABLE `data_kamar` (
  `id_kamar` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `kapasitas` varchar(30) NOT NULL,
  `harga_harian` varchar(100) NOT NULL,
  `harga_bulanan` varchar(30) NOT NULL,
  `no_kamar` varchar(30) NOT NULL,
  `id_tipe_kamar` varchar(50) NOT NULL,
  `status_kamar` enum('Terisi','Kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_kamar` VALUES ("KMHOT20250710063548555-1","HOT20250710063548555",2,160000,4800000,1,"TYPHOT20250710063548555-1","Terisi"),
("KMHOT20250710063548555-2","HOT20250710063548555",2,160000,4800000,2,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-3","HOT20250710063548555",2,160000,4800000,3,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-4","HOT20250710063548555",2,160000,4800000,4,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-5","HOT20250710063548555",2,160000,4800000,5,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-6","HOT20250710063548555",2,160000,4800000,6,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-7","HOT20250710063548555",2,160000,4800000,7,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-8","HOT20250710063548555",2,160000,4800000,8,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-9","HOT20250710063548555",2,160000,4800000,9,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-10","HOT20250710063548555",2,160000,4800000,10,"TYPHOT20250710063548555-1","Kosong"),
("KMHOT20250710063548555-11","HOT20250710063548555","2-3",180000,5400000,11,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-12","HOT20250710063548555","2-3",180000,5400000,12,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-13","HOT20250710063548555","2-3",180000,5400000,13,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-14","HOT20250710063548555","2-3",180000,5400000,14,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-15","HOT20250710063548555","2-3",180000,5400000,15,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-16","HOT20250710063548555","2-3",180000,5400000,16,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-17","HOT20250710063548555","2-3",180000,5400000,17,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-18","HOT20250710063548555","2-3",180000,5400000,18,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-19","HOT20250710063548555","2-3",180000,5400000,19,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-20","HOT20250710063548555","2-3",180000,5400000,20,"TYPHOT20250710063548555-2","Kosong"),
("KMHOT20250710063548555-21","HOT20250710063548555",4,250000,7500000,21,"TYPHOT20250710063548555-3","Kosong"),
("KMHOT20250710063548555-22","HOT20250710063548555",4,250000,7500000,22,"TYPHOT20250710063548555-3","Kosong"),
("KMHOT20250710063626968-1","HOT20250710063626968",1,120000,3600000,1,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-2","HOT20250710063626968",1,120000,3600000,2,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-3","HOT20250710063626968",1,120000,3600000,3,"TYPHOT20250710063626968-1","Kosong"),
("KMHOT20250710063626968-4","HOT20250710063626968",2,150000,4500000,4,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-5","HOT20250710063626968",2,150000,4500000,5,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-6","HOT20250710063626968",2,150000,4500000,6,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-7","HOT20250710063626968",2,150000,4500000,7,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-8","HOT20250710063626968",2,150000,4500000,8,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-9","HOT20250710063626968",2,150000,4500000,9,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-10","HOT20250710063626968",2,150000,4500000,10,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-11","HOT20250710063626968",2,150000,4500000,11,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-12","HOT20250710063626968",2,150000,4500000,12,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-13","HOT20250710063626968",2,150000,4500000,13,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-14","HOT20250710063626968",2,150000,4500000,14,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-15","HOT20250710063626968",2,150000,4500000,15,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-16","HOT20250710063626968",2,150000,4500000,16,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-17","HOT20250710063626968",2,150000,4500000,17,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-18","HOT20250710063626968",2,150000,4500000,18,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-19","HOT20250710063626968",2,150000,4500000,19,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-20","HOT20250710063626968",2,150000,4500000,20,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-21","HOT20250710063626968",2,150000,4500000,21,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-22","HOT20250710063626968",2,150000,4500000,22,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-23","HOT20250710063626968",2,150000,4500000,23,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-24","HOT20250710063626968",2,150000,4500000,24,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-25","HOT20250710063626968",2,150000,4500000,25,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-26","HOT20250710063626968",2,150000,4500000,26,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-27","HOT20250710063626968","2-3",160000,4800000,27,"TYPHOT20250710063626968-3","Kosong"),
("KMHOT20250710063626968-28","HOT20250710063626968",2,190000,5700000,28,"TYPHOT20250710063626968-4","Kosong"),
("KMHOT20250710063626968-29","HOT20250710063626968",4,220000,6600000,29,"TYPHOT20250710063626968-5","Kosong"),
("KMHOT202507100637263410-1","HOT202507100637263410",2,150000,4500000,1,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-2","HOT202507100637263410",2,150000,4500000,2,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-3","HOT202507100637263410",2,150000,4500000,3,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-4","HOT202507100637263410",2,150000,4500000,4,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-5","HOT202507100637263410",2,150000,4500000,5,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-6","HOT202507100637263410",2,150000,4500000,6,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-7","HOT202507100637263410",2,150000,4500000,7,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-8","HOT202507100637263410",2,150000,4500000,8,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-9","HOT202507100637263410",2,150000,4500000,9,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-10","HOT202507100637263410",2,150000,4500000,10,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-11","HOT202507100637263410",2,150000,4500000,11,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-12","HOT202507100637263410",2,150000,4500000,12,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-13","HOT202507100637263410",2,150000,4500000,13,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-14","HOT202507100637263410",2,150000,4500000,14,"TYPHOT202507100637263410-1","Kosong"),
("KMHOT202507100637263410-15","HOT202507100637263410",2,190000,5700000,15,"TYPHOT202507100637263410-2","Kosong"),
("KMHOT202507100637263410-16","HOT202507100637263410",4,220000,6600000,16,"TYPHOT202507100637263410-3","Kosong"),
("KMHOT20250710063726343-1","HOT20250710063726343",2,150000,4500000,1,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-2","HOT20250710063726343",2,150000,4500000,2,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-3","HOT20250710063726343",2,150000,4500000,3,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-4","HOT20250710063726343",2,150000,4500000,4,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-5","HOT20250710063726343",2,150000,4500000,5,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-6","HOT20250710063726343",2,150000,4500000,6,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-7","HOT20250710063726343",2,150000,4500000,7,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-8","HOT20250710063726343",2,150000,4500000,8,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-9","HOT20250710063726343",2,150000,4500000,9,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-10","HOT20250710063726343",2,150000,4500000,10,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-11","HOT20250710063726343",2,150000,4500000,11,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-12","HOT20250710063726343",2,150000,4500000,12,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-13","HOT20250710063726343",2,150000,4500000,13,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-14","HOT20250710063726343",2,150000,4500000,14,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-15","HOT20250710063726343",2,150000,4500000,15,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-16","HOT20250710063726343",2,150000,4500000,16,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-17","HOT20250710063726343",2,150000,4500000,17,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-18","HOT20250710063726343",2,150000,4500000,18,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-19","HOT20250710063726343",2,150000,4500000,19,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-20","HOT20250710063726343",2,150000,4500000,20,"TYPHOT20250710063726343-1","Kosong"),
("KMHOT20250710063726343-21","HOT20250710063726343",4,250000,7500000,21,"TYPHOT20250710063726343-2","Kosong"),
("KMHOT20250710063726343-22","HOT20250710063726343",4,250000,7500000,22,"TYPHOT20250710063726343-2","Kosong"),
("KMHOT20250710063726341-1","HOT20250710063726341",1,120000,3600000,1,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-2","HOT20250710063726341",1,120000,3600000,2,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-3","HOT20250710063726341",1,120000,3600000,3,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-4","HOT20250710063726341",1,120000,3600000,4,"TYPHOT20250710063726341-1","Kosong"),
("KMHOT20250710063726341-5","HOT20250710063726341",2,150000,4500000,5,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-6","HOT20250710063726341",2,150000,4500000,6,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-7","HOT20250710063726341",2,150000,4500000,7,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-8","HOT20250710063726341",2,150000,4500000,8,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-9","HOT20250710063726341",2,150000,4500000,9,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-10","HOT20250710063726341",2,150000,4500000,10,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-11","HOT20250710063726341",2,150000,4500000,11,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-12","HOT20250710063726341",2,150000,4500000,12,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-13","HOT20250710063726341",2,150000,4500000,13,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-14","HOT20250710063726341",2,150000,4500000,14,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-15","HOT20250710063726341",2,150000,4500000,15,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-16","HOT20250710063726341",2,150000,4500000,16,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-17","HOT20250710063726341",2,150000,4500000,17,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-18","HOT20250710063726341",2,150000,4500000,18,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-19","HOT20250710063726341",2,150000,4500000,19,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-20","HOT20250710063726341",2,150000,4500000,20,"TYPHOT20250710063726341-2","Kosong"),
("KMHOT20250710063726341-21","HOT20250710063726341",4,250000,7500000,21,"TYPHOT20250710063726341-3","Kosong"),
("KMHOT20250710063726341-22","HOT20250710063726341",4,250000,7500000,22,"TYPHOT20250710063726341-3","Kosong"),
("KMHOT20250710063726344-1","HOT20250710063726344",2,140000,4200000,1,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-2","HOT20250710063726344",2,140000,4200000,2,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-3","HOT20250710063726344",2,140000,4200000,3,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-4","HOT20250710063726344",2,140000,4200000,4,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-5","HOT20250710063726344",2,140000,4200000,5,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-6","HOT20250710063726344",2,140000,4200000,6,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-7","HOT20250710063726344",2,140000,4200000,7,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-8","HOT20250710063726344",2,140000,4200000,8,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-9","HOT20250710063726344",2,140000,4200000,9,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-10","HOT20250710063726344",2,140000,4200000,10,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-11","HOT20250710063726344",2,140000,4200000,11,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-12","HOT20250710063726344",2,140000,4200000,12,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-13","HOT20250710063726344",2,140000,4200000,13,"TYPHOT20250710063726344-1","Kosong"),
("KMHOT20250710063726344-14","HOT20250710063726344",4,180000,5400000,14,"TYPHOT20250710063726344-2","Kosong"),
("KMHOT20250710063726346-1","HOT20250710063726346",2,130000,3900000,1,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-2","HOT20250710063726346",2,130000,3900000,2,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-3","HOT20250710063726346",2,130000,3900000,3,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-4","HOT20250710063726346",2,130000,3900000,4,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-5","HOT20250710063726346",2,130000,3900000,5,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-6","HOT20250710063726346",2,130000,3900000,6,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-7","HOT20250710063726346",2,130000,3900000,7,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-8","HOT20250710063726346",2,130000,3900000,8,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-9","HOT20250710063726346",2,130000,3900000,9,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-10","HOT20250710063726346",2,130000,3900000,10,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-11","HOT20250710063726346",2,130000,3900000,11,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-12","HOT20250710063726346",2,130000,3900000,12,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-13","HOT20250710063726346",2,130000,3900000,13,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-14","HOT20250710063726346",2,130000,3900000,14,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-15","HOT20250710063726346",2,130000,3900000,15,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-16","HOT20250710063726346",2,130000,3900000,16,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-17","HOT20250710063726346",2,130000,3900000,17,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-18","HOT20250710063726346",2,130000,3900000,18,"TYPHOT20250710063726346-1","Kosong"),
("KMHOT20250710063726346-19","HOT20250710063726346",4,220000,6600000,19,"TYPHOT20250710063726346-2","Kosong"),
("KMHOT20250710063726347-1","HOT20250710063726347",1,120000,3600000,1,"TYPHOT20250710063726347-1","Kosong"),
("KMHOT20250710063726347-2","HOT20250710063726347",2,150000,4500000,2,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-3","HOT20250710063726347",2,150000,4500000,3,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-4","HOT20250710063726347",2,150000,4500000,4,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-5","HOT20250710063726347",2,150000,4500000,5,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-6","HOT20250710063726347",2,150000,4500000,6,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-7","HOT20250710063726347",2,150000,4500000,7,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-8","HOT20250710063726347",2,150000,4500000,8,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-9","HOT20250710063726347",2,150000,4500000,9,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-10","HOT20250710063726347",2,150000,4500000,10,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-11","HOT20250710063726347",2,150000,4500000,11,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-12","HOT20250710063726347",2,150000,4500000,12,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-13","HOT20250710063726347",2,150000,4500000,13,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-14","HOT20250710063726347",2,150000,4500000,14,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-15","HOT20250710063726347",2,150000,4500000,15,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-16","HOT20250710063726347",2,150000,4500000,16,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-17","HOT20250710063726347",2,150000,4500000,17,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-18","HOT20250710063726347",2,150000,4500000,18,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-19","HOT20250710063726347",2,150000,4500000,19,"TYPHOT20250710063726347-2","Kosong"),
("KMHOT20250710063726347-20","HOT20250710063726347",4,250000,7500000,20,"TYPHOT20250710063726347-3","Kosong"),
("KMHOT202507100637263411-1","HOT202507100637263411",2,150000,4500000,1,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-2","HOT202507100637263411",2,150000,4500000,2,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-3","HOT202507100637263411",2,150000,4500000,3,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-4","HOT202507100637263411",2,150000,4500000,4,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-5","HOT202507100637263411",2,150000,4500000,5,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-6","HOT202507100637263411",2,150000,4500000,6,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-7","HOT202507100637263411",2,150000,4500000,7,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-8","HOT202507100637263411",2,150000,4500000,8,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-9","HOT202507100637263411",2,150000,4500000,9,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-10","HOT202507100637263411",2,150000,4500000,10,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-11","HOT202507100637263411",2,150000,4500000,11,"TYPHOT202507100637263411-1","Kosong"),
("KMHOT202507100637263411-12","HOT202507100637263411",4,250000,7500000,12,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT202507100637263411-13","HOT202507100637263411",4,250000,7500000,13,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT202507100637263411-14","HOT202507100637263411",4,250000,7500000,14,"TYPHOT202507100637263411-2","Kosong"),
("KMHOT20250710063726345-1","HOT20250710063726345",2,150000,4500000,1,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-2","HOT20250710063726345",2,150000,4500000,2,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-3","HOT20250710063726345",2,150000,4500000,3,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-4","HOT20250710063726345",2,150000,4500000,4,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-5","HOT20250710063726345",2,150000,4500000,5,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-6","HOT20250710063726345",2,150000,4500000,6,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-7","HOT20250710063726345",2,150000,4500000,7,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-8","HOT20250710063726345",2,150000,4500000,8,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-9","HOT20250710063726345",2,150000,4500000,9,"TYPHOT20250710063726345-1","Kosong"),
("KMHOT20250710063726345-10","HOT20250710063726345","2-3",180000,5400000,10,"TYPHOT20250710063726345-2","Kosong"),
("KMHOT202507100637263412-1","HOT202507100637263412",2,130000,3900000,1,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-2","HOT202507100637263412",2,130000,3900000,2,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-3","HOT202507100637263412",2,130000,3900000,3,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-4","HOT202507100637263412",2,130000,3900000,4,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-5","HOT202507100637263412",2,130000,3900000,5,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-6","HOT202507100637263412",2,130000,3900000,6,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-7","HOT202507100637263412",2,130000,3900000,7,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-8","HOT202507100637263412",2,130000,3900000,8,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-9","HOT202507100637263412",2,130000,3900000,9,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-10","HOT202507100637263412",2,130000,3900000,10,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-11","HOT202507100637263412",2,130000,3900000,11,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-12","HOT202507100637263412",2,130000,3900000,12,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-13","HOT202507100637263412",2,130000,3900000,13,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-14","HOT202507100637263412",2,130000,3900000,14,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-15","HOT202507100637263412",2,130000,3900000,15,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-16","HOT202507100637263412",2,130000,3900000,16,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-17","HOT202507100637263412",2,130000,3900000,17,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-18","HOT202507100637263412",2,130000,3900000,18,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-19","HOT202507100637263412",2,130000,3900000,19,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-20","HOT202507100637263412",2,130000,3900000,20,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-21","HOT202507100637263412",2,130000,3900000,21,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-22","HOT202507100637263412",2,130000,3900000,22,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-23","HOT202507100637263412",2,130000,3900000,23,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-24","HOT202507100637263412",2,130000,3900000,24,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-25","HOT202507100637263412",2,130000,3900000,25,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-26","HOT202507100637263412",2,130000,3900000,26,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-27","HOT202507100637263412",2,130000,3900000,27,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-28","HOT202507100637263412",2,130000,3900000,28,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-29","HOT202507100637263412",2,130000,3900000,29,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-30","HOT202507100637263412",2,130000,3900000,30,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-31","HOT202507100637263412",2,130000,3900000,31,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-32","HOT202507100637263412",2,130000,3900000,32,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-33","HOT202507100637263412",2,130000,3900000,33,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-34","HOT202507100637263412",2,130000,3900000,34,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-35","HOT202507100637263412",2,130000,3900000,35,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-36","HOT202507100637263412",2,130000,3900000,36,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-37","HOT202507100637263412",2,130000,3900000,37,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-38","HOT202507100637263412",2,130000,3900000,38,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-39","HOT202507100637263412",2,130000,3900000,39,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-40","HOT202507100637263412",2,130000,3900000,40,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-41","HOT202507100637263412",2,130000,3900000,41,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-42","HOT202507100637263412",2,130000,3900000,42,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-43","HOT202507100637263412",2,130000,3900000,43,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-44","HOT202507100637263412",2,130000,3900000,44,"TYPHOT202507100637263412-1","Kosong"),
("KMHOT202507100637263412-45","HOT202507100637263412",4,220000,6600000,45,"TYPHOT202507100637263412-2","Kosong"),
("KMHOT202507100637263412-46","HOT202507100637263412",4,220000,6600000,46,"TYPHOT202507100637263412-2","Kosong"),
("KMHOT20250710063626968-30","HOT20250710063626968",2,150000,4500000,30,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-31","HOT20250710063626968",2,150000,4500000,31,"TYPHOT20250710063626968-2","Kosong"),
("KMHOT20250710063626968-32","HOT20250710063626968",2,150000,4500000,32,"TYPHOT20250710063626968-2","Kosong");


DROP TABLE IF EXISTS `data_metode_pembayaran`;

CREATE TABLE `data_metode_pembayaran` (
  `id_metode_pembayaran` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `id_bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_metode_pembayaran` VALUES ("MET20250817000005617","HOT20250710063548555","Tunai","BAN20250817000042219"),
("MET20250817000024935","HOT20250710063548555","QRIS","BAN20250817000042219"),
("MET20250817000039604","HOT20250710063548555","Transfer Bank","BAN20250817000026161"),
("MET20250806031305618","HOT20250710063626968","Tunai","BAN20250806031242220"),
("MET20250806031324936","HOT20250710063626968","QRIS","BAN20250806031242220"),
("MET20250806031339605","HOT20250710063626968","Transfer Bank","BAN20250806031226162"),
("MET20250817000005619","HOT202507100637263410","Tunai","BAN20250817000042221"),
("MET20250817000024937","HOT202507100637263410","QRIS","BAN20250817000042221"),
("MET20250817000039606","HOT202507100637263410","Transfer Bank","BAN20250817000026163"),
("MET20250817000005620","HOT20250710063726343","Tunai","BAN20250817000042222"),
("MET20250817000024938","HOT20250710063726343","QRIS","BAN20250817000042222"),
("MET20250817000039607","HOT20250710063726343","Transfer Bank","BAN20250817000026164"),
("MET20250817000005621","HOT20250817000026165","Tunai","BAN20250817000042223"),
("MET20250817000024939","HOT20250817000026165","QRIS","BAN20250817000042223"),
("MET20250817000039608","HOT20250817000026165","Transfer Bank","BAN20250817000026165"),
("MET20250817000005622","HOT20250710063726344","Tunai","BAN20250817000042224"),
("MET20250817000024940","HOT20250710063726344","QRIS","BAN20250817000042224"),
("MET20250817000039609","HOT20250710063726344","Transfer Bank","BAN20250817000026166"),
("MET20250817000005623","HOT20250710063726346","Tunai","BAN20250817000042225"),
("MET20250817000024941","HOT20250710063726346","QRIS","BAN20250817000042225"),
("MET20250817000039610","HOT20250710063726346","Transfer Bank","BAN20250817000026167"),
("MET20250817000005624","HOT20250710063726347","Tunai","BAN20250817000042226"),
("MET20250817000024942","HOT20250710063726347","QRIS","BAN20250817000042226"),
("MET20250817000039611","HOT20250710063726347","Transfer Bank","BAN20250817000026168"),
("MET20250817000005625","HOT202507100637263411","Tunai","BAN20250817000042227"),
("MET20250817000024943","HOT202507100637263411","QRIS","BAN20250817000042227"),
("MET20250817000039612","HOT202507100637263411","Transfer Bank","BAN20250817000026169"),
("MET20250817000005626","HOT20250710063726345","Tunai","BAN20250817000042228"),
("MET20250817000024944","HOT20250710063726345","QRIS","BAN20250817000042228"),
("MET20250817000039613","HOT20250710063726345","Transfer Bank","BAN20250817000026170"),
("MET20250817000005627","HOT202507100637263412","Tunai","BAN20250817000042229"),
("MET20250817000024945","HOT202507100637263412","QRIS","BAN20250817000042229"),
("MET20250817000039614","HOT202507100637263412","Transfer Bank","BAN20250817000026171");


DROP TABLE IF EXISTS `data_operasional`;

CREATE TABLE `data_operasional` (
  `id_operasional` varchar(50) NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  `operasional` varchar(100) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `keperluan` text NOT NULL,
  `biaya` varchar(30) NOT NULL,
  `id_admin` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_operasional` VALUES ("OPE20250819153948146","HOT20250710063548555","2025-08-19 15:39:00","ATK",1,"Kertas Printer",50000,"ADM20250710063548555");


DROP TABLE IF EXISTS `data_pajak`;

CREATE TABLE `data_pajak` (
  `id_pajak` varchar(50) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `id_transaksi` varchar(50) DEFAULT NULL,
  `jenis_pajak` varchar(250) DEFAULT NULL,
  `persentase_pajak` int(10) DEFAULT NULL,
  `pajak` int(50) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_pajak` VALUES ("PAJ20250819154145301","2025-08-19 15:41:45","TRA20250819154145916","PPN",11,35200,"HOT20250710063548555");


DROP TABLE IF EXISTS `data_pelanggan`;

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `identitas` varchar(250) DEFAULT NULL,
  `no_identitas` varchar(250) DEFAULT NULL,
  `alamat` text,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_hotel` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pelanggan` VALUES ("PEL20250714082108440","Rianti Maga","KTP",1234567890,"Jambi","perempuan","HOT20250710063626968",085369237896),
("PEL20250715065839276","Rangga Aditya","KTP",1234567890,"Jambi","laki-laki","HOT20250710063626968",085369237896),
("PEL20250715070034707","Fatma Fiani","KTP",1234567890,"Jambi","perempuan","HOT20250710063626968",085369237896),
("PEL20250717043546608","vioni Andini","KTP",1234567890,"Jambi","perempuan","HOT20250710063626968",085369237896),
("PEL20250717045213800","ahmad sarkowi","KTP",1234567890,"Jambi","laki-laki","HOT20250710063626968",085369237896),
("PEL20250722095444394","Rani Samanta","KTP",1234567890,"Jambi","perempuan","HOT20250710063626968",085369237896),
("PEL20250809060403879","ramadhana","KTP",1234567890,"Jambi","laki-laki","HOT20250710063626968",085369237896),
("PEL20250812043404533","Agus Mahardika","KTP",1234567890,"Jambi","laki-laki","HOT20250710063626968",085369237896),
("PEL20250819140131770","Ardiansyah","KTP",1234567890,"Jambi","laki-laki","HOT20250710063626968",085369237896);


DROP TABLE IF EXISTS `data_pemasukan`;

CREATE TABLE `data_pemasukan` (
  `id_pemasukan` varchar(50) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `id_transaksi` varchar(50) DEFAULT NULL,
  `jumlah_bayar` int(10) DEFAULT NULL,
  `metode` varchar(250) DEFAULT NULL,
  `nama_bank` varchar(250) DEFAULT NULL,
  `rekening` varchar(250) DEFAULT NULL,
  `atas_nama` varchar(250) DEFAULT NULL,
  `keterangan` text,
  `id_hotel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_pemasukan` VALUES ("PEM20250819152953412","2025-08-19 15:29:53","TRA20250819152953633",160000,"MET20250817000005617","none","none","Ardiansyah","Pembayaran Checkin A.n Ardiansyah, Kamar Nomor 1 (DOUBLE)","HOT20250710063548555"),
("PEM20250819153135937","2025-08-19 15:31:35","TRA20250819152953633",10000,"MET20250817000005617","none","none","Ardiansyah","Pembayaran Checkout A.n Ardiansyah, Kamar Nomor 1 (DOUBLE) -","HOT20250710063548555"),
("PEM20250819153208696","2025-08-19 15:32:08","TRA20250819153208610",160000,"MET20250817000005617","none","none","Ardiansyah","Pembayaran Checkin A.n Ardiansyah, Kamar Nomor 1 (DOUBLE)","HOT20250710063548555"),
("PEM20250819154145968","2025-08-19 15:41:45","TRA20250819154145916",355200,"MET20250817000005617","none","none","Agus Mahardika","Pembayaran Checkin A.n Agus Mahardika, Kamar Nomor 2 (DOUBLE)","HOT20250710063548555"),
("PEM20250819160642585","2025-08-19 16:06:42","TRA20250819160642229",160000,"MET20250817000005617","none","none","Ardiansyah","Pembayaran Checkin A.n Ardiansyah, Kamar Nomor 1 (DOUBLE)","HOT20250710063548555");


DROP TABLE IF EXISTS `data_pengaturan_aplikasi`;

CREATE TABLE `data_pengaturan_aplikasi` (
  `id_pengaturan_aplikasi` varchar(50) DEFAULT NULL,
  `nama_pengaturan` varchar(250) DEFAULT NULL,
  `value` text,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `data_pengaturan_aplikasi` VALUES (1,"transaksi_bulanan","tidak_aktif",NULL),
(2,"persentase_pajak",11,NULL),
(3,"type_pajak","PPN",NULL),
(4,"default_checklist_pajak",0,"isi Nilai dengan 0 dan 1");


DROP TABLE IF EXISTS `data_pengaturan_printer`;

CREATE TABLE `data_pengaturan_printer` (
  `id_pengaturan_printer` varchar(50) NOT NULL DEFAULT '',
  `nama_printer_nota` varchar(100) DEFAULT NULL,
  `ukuran_kertas` enum('32','48','A4') DEFAULT NULL,
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
  `no_wa_sumber` varchar(100) DEFAULT NULL,
  `id_hotel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pengaturan_printer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengaturan_printer` VALUES ("PEN202508170001","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063548555"),
("PEN202508170002","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063626968"),
("PEN202508170003","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726341"),
("PEN202508170004","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT202507100637263410"),
("PEN202508170005","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT202507100637263411"),
("PEN202508170006","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT202507100637263412"),
("PEN202508170007","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726343"),
("PEN202508170008","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726344"),
("PEN202508170009","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726345"),
("PEN202508170010","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726346"),
("PEN202508170011","RP58 Printer",48,"sebelum cetak","-","1754447802-36347-steze-2.png","SteZe","Jambi","Telp - (021) 29707600","Terima Kasih","-","SteZe Syariah Jambi","ya","fajarudinsidik@gmail.com","tidak",85266383993,"HOT20250710063726347");


DROP TABLE IF EXISTS `data_pengelola`;

CREATE TABLE `data_pengelola` (
  `id_pengelola` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_pengelola` VALUES ("PEN2334RTT","pengelola","super","21232f297a57a5a743894a0e4a801fc3");


DROP TABLE IF EXISTS `data_tipe_kamar`;

CREATE TABLE `data_tipe_kamar` (
  `id_tipe_kamar` varchar(50) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `id_hotel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_tipe_kamar` VALUES ("TYPHOT20250710063548555-1","DOUBLE","HOT20250710063548555"),
("TYPHOT20250710063548555-2","DELUXE","HOT20250710063548555"),
("TYPHOT20250710063548555-3","FAMILY","HOT20250710063548555"),
("TYPHOT20250710063626968-1","SINGLE","HOT20250710063626968"),
("TYPHOT20250710063626968-2","DOUBLE","HOT20250710063626968"),
("TYPHOT20250710063626968-3","DELUXE","HOT20250710063626968"),
("TYPHOT20250710063626968-4","TWIN","HOT20250710063626968"),
("TYPHOT20250710063626968-5","FAMILY","HOT20250710063626968"),
("TYPHOT20250710063726341-1","SINGLE","HOT20250710063726341"),
("TYPHOT20250710063726341-2","DOUBLE","HOT20250710063726341"),
("TYPHOT20250710063726341-3","FAMILY","HOT20250710063726341"),
("TYPHOT202507100637263410-1","DOUBLE","HOT202507100637263410"),
("TYPHOT202507100637263410-2","TWIN","HOT202507100637263410"),
("TYPHOT202507100637263410-3","FAMILY","HOT202507100637263410"),
("TYPHOT202507100637263411-1","DOUBLE","HOT202507100637263411"),
("TYPHOT202507100637263411-2","FAMILY","HOT202507100637263411"),
("TYPHOT202507100637263412-1","DOUBLE","HOT202507100637263412"),
("TYPHOT202507100637263412-2","FAMILY","HOT202507100637263412"),
("TYPHOT20250710063726343-1","DOUBLE","HOT20250710063726343"),
("TYPHOT20250710063726343-2","FAMILY","HOT20250710063726343"),
("TYPHOT20250710063726344-1","DOUBLE","HOT20250710063726344"),
("TYPHOT20250710063726344-2","FAMILY","HOT20250710063726344"),
("TYPHOT20250710063726345-1","DOUBLE","HOT20250710063726345"),
("TYPHOT20250710063726345-2","DELUXE","HOT20250710063726345"),
("TYPHOT20250710063726346-1","DOUBLE","HOT20250710063726346"),
("TYPHOT20250710063726346-2","FAMILY","HOT20250710063726346"),
("TYPHOT20250710063726347-1","SINGLE","HOT20250710063726347"),
("TYPHOT20250710063726347-2","DOUBLE","HOT20250710063726347"),
("TYPHOT20250710063726347-3","FAMILY","HOT20250710063726347");


DROP TABLE IF EXISTS `data_transaksi`;

CREATE TABLE `data_transaksi` (
  `id_transaksi` varchar(50) NOT NULL,
  `id_pelanggan` varchar(50) NOT NULL,
  `id_kamar` varchar(50) NOT NULL,
  `waktu_checkin` date NOT NULL,
  `waktu_checkout` date NOT NULL,
  `no_rekening` varchar(300) NOT NULL,
  `total_harga_kamar` varchar(300) NOT NULL DEFAULT '',
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
  `biaya_tambahan_checkin` varchar(60) NOT NULL,
  `deskripsi_biaya_checkin` text NOT NULL,
  `biaya_tambahan_checkout` varchar(60) DEFAULT '',
  `deskripsi_biaya_checkout` varchar(60) DEFAULT '',
  `catatan` varchar(60) DEFAULT NULL,
  `harga_kamar_harian` int(100) DEFAULT NULL,
  `harga_kamar_bulanan` int(100) DEFAULT NULL,
  `potongan_harga` int(100) DEFAULT NULL,
  `persentase_pajak` int(11) DEFAULT NULL,
  `pajak` int(10) DEFAULT NULL,
  `harga_sebelum_pajak` int(10) DEFAULT NULL,
  `total_bayar` int(100) DEFAULT NULL,
  `nominal_bayar` int(50) DEFAULT NULL,
  `jumlah_kembalian` int(60) DEFAULT NULL,
  `sisa_pembayaran` int(60) NOT NULL,
  `id_channel` varchar(50) DEFAULT NULL,
  `channel` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_transaksi` VALUES ("TRA20250819152953633","PEL20250819140131770","KMHOT20250710063548555-1","2025-08-19","2025-08-20","none",160000,"MET20250817000005617",1,0,0,"Selesai","Ardiansyah",085369237896,1,"DOUBLE","15:29:53","15:29:53",1,"harian","ADM20250710063548555","Admin TAC Sipin","HOT20250710063548555","TAC Sipin","2025-08-19 15:29:53","BAN20250817000042219","none",0,"",10000,"-","",160000,4800000,0,0,0,160000,170000,0,0,0,1,"Walk-In Guest"),
("TRA20250819153208610","PEL20250819140131770","KMHOT20250710063548555-1","2025-08-19","2025-08-20","none",160000,"MET20250817000005617",1,0,0,"Selesai","Ardiansyah",085369237896,1,"DOUBLE","15:32:08","15:32:08",1,"harian","ADM20250710063548555","Admin TAC Sipin","HOT20250710063548555","TAC Sipin","2025-08-19 15:32:08","BAN20250817000042219","none",0,"",0,"","",160000,4800000,0,0,0,160000,160000,0,0,0,1,"Walk-In Guest"),
("TRA20250819154145916","PEL20250812043404533","KMHOT20250710063548555-2","2025-08-19","2025-08-21","none",320000,"MET20250817000005617",1,0,0,"Selesai","Agus Mahardika",085369237896,2,"DOUBLE","15:41:45","15:41:45",2,"harian","ADM20250710063548555","Admin TAC Sipin","HOT20250710063548555","TAC Sipin","2025-08-19 15:41:45","BAN20250817000042219","none",0,"",0,"","",160000,4800000,0,11,35200,320000,355200,0,0,0,1,"Walk-In Guest"),
("TRA20250819160642229","PEL20250819140131770","KMHOT20250710063548555-1","2025-08-19","2025-08-20","none",160000,"MET20250817000005617",1,0,0,"Lunas","Ardiansyah",085369237896,1,"DOUBLE","16:06:42","16:06:42",1,"harian","ADM20250710063548555","Admin TAC Sipin","HOT20250710063548555","TAC Sipin","2025-08-19 16:06:42","BAN20250817000042219","none",0,"",0,"","",160000,4800000,0,0,0,160000,160000,160000,0,0,1,"Walk-In Guest");


SET foreign_key_checks = 1;
