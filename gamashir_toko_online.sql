-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 09, 2022 at 09:40 PM
-- Server version: 10.3.35-MariaDB-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamashir_toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 'admin', 1),
(2, 'Surya Mahesa', 'suryamahesa71@gmail.com', 'Surya', '123456', 2),
(4, 'admin2', 'admin2@gmail.com', 'admin2', '12345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE `alamat` (
  `id_alamat` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_penerima` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `id_kota` int(11) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `kode_pos` varchar(20) DEFAULT NULL,
  `is_select` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`id_alamat`, `id_user`, `nama_penerima`, `no_hp`, `id_kota`, `id_provinsi`, `alamat_lengkap`, `kode_pos`, `is_select`) VALUES
(7, 3, 'pelem', '0891234', 419, 5, 'sleman', '15415', 'false'),
(8, 2, 'Surya Mahesa', '085728335513', 419, 5, 'Kos Pak Heru Trini Sinduadi Mlati Sleman, Jalan Belakang Mie Ayam, RT.6/RW.3, Sinduadi, Mlati', '55597', 'true'),
(9, 4, 'Koperasi Kopma UGM', '', 501, 5, 'Jl. Cik Di Tiro No.14, Terban, Kec. Gondokusuman', '55223', 'false'),
(10, 6, 'Jhonny', '', 203, 13, 'Jl. Kapuas No. 24', '6156', 'true'),
(11, 2, 'Puput Kasiadi', '085728335513', 39, 5, 'Bantul', '55267', 'true'),
(12, 3, 'pelem', '089123', 163, 10, 'jepara', '15415', 'true'),
(13, 7, 'Surya Mahesa', '0892882662', 419, 5, 'Kos Pak Heru Trini Sinduadi Mlati Sleman, Jalan Belakang Mie Ayam, RT.6/RW.3, Sinduadi, Mlati', '55597', 'true'),
(14, 7, 'Puput Kasiadi', '085728335513', 0, 0, 'Bantul, Yogyakarta', '', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_user`, `id_produk`, `qty`, `total`) VALUES
(11, 12, 3, 9, 3, 150000),
(12, 12, 3, 7, 2, 16000),
(13, 13, 3, 8, 3, 123000),
(14, 14, 3, 7, 2, 200),
(15, 15, 2, 5, 1, 100),
(16, 16, 2, 6, 2, 200),
(17, 17, 3, 6, 2, 30000),
(18, 17, 3, 10, 2, 200),
(19, 18, 3, 12, 1, 12000),
(20, 19, 2, 12, 1, 12000),
(21, 19, 2, 17, 1, 15000),
(22, 19, 2, 18, 1, 10000),
(23, 20, 2, 17, 0, 0),
(24, 20, 2, 10, 5, 500),
(25, 21, 2, 5, 1, 4950),
(26, 22, 2, 7, 1, 11200),
(27, 23, 2, 9, 1, 40000),
(28, 24, 2, 5, 1, 4950),
(29, 25, 2, 12, 1, 12000),
(30, 25, 2, 17, 1, 15000),
(31, 25, 2, 18, 1, 10000),
(32, 26, 2, 12, 1, 12000),
(33, 26, 2, 17, 1, 15000),
(34, 26, 2, 18, 1, 10000),
(35, 27, 2, 12, 1, 12000),
(36, 27, 2, 17, 1, 15000),
(37, 27, 2, 18, 1, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(3, 'Merchandes'),
(4, 'TOPI');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(5) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `selected` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_produk`, `qty`, `total`, `selected`) VALUES
(33, 4, 9, 1, 100, 1),
(37, 6, 5, 1, 50, 1),
(38, 6, 6, 1, 100, 1),
(39, 6, 7, 1, 100, 1),
(46, 3, 5, 1, 4950, 1),
(53, 7, 5, 1, 4950, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `kurir` varchar(50) DEFAULT NULL,
  `nama_penerima` varchar(30) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `kode_pos` varchar(6) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `resi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_user`, `id_transaksi`, `kurir`, `nama_penerima`, `no_hp`, `alamat_lengkap`, `kode_pos`, `catatan`, `resi`) VALUES
(10, 3, 12, 'CTC', 'pelem', '0891234', 'sleman', '15415', NULL, 'asdasd'),
(11, 3, 13, 'CTC', 'pelem', '0891234', 'sleman', '15415', NULL, NULL),
(12, 3, 14, 'CTC', 'pelem', '0891234', 'sleman', '15415', NULL, ''),
(13, 2, 15, 'CTC', 'Surya Mahesa', '085728335513', 'Kos Pak Heru Trini Sinduadi Mlati Sleman, Jalan Belakang Mie Ayam, RT.6/RW.3, Sinduadi, Mlati', '55597', NULL, NULL),
(14, 2, 16, '', 'Surya Mahesa', '085728335513', 'Kos Pak Heru Trini Sinduadi Mlati Sleman, Jalan Belakang Mie Ayam, RT.6/RW.3, Sinduadi, Mlati', '55597', NULL, ''),
(15, 3, 17, 'CTC', 'pelem', '0891234', 'sleman', '15415', NULL, NULL),
(16, 3, 18, 'CTC', 'pelem', '0891234', 'sleman', '15415', NULL, NULL),
(17, 2, 19, 'ECO', 'Surya Mahesa', '085728335513', 'Kos Pak Heru Trini Sinduadi Mlati Sleman, Jalan Belakang Mie Ayam, RT.6/RW.3, Sinduadi, Mlati', '55597', NULL, NULL),
(18, 2, 20, 'CTC', 'Puput Kasiadi', '085728335513', 'Bantul', '55267', NULL, NULL),
(19, 2, 21, 'CTC', 'Puput Kasiadi', '085728335513', 'Bantul', '55267', NULL, NULL),
(20, 2, 22, 'CTC', 'Puput Kasiadi', '085728335513', 'Bantul', '55267', NULL, NULL),
(21, 2, 23, 'CTC', 'Puput Kasiadi', '085728335513', 'Bantul', '55267', NULL, NULL),
(22, 2, 24, '', 'Puput Kasiadi', '085728335513', 'Bantul', '55267', NULL, NULL),
(23, 2, 25, 'CTC', 'Surya Mahesa', '085728335513', 'Kos Pak Heru Trini Sinduadi Mlati Sleman, Jalan Belakang Mie Ayam, RT.6/RW.3, Sinduadi, Mlati', '55597', NULL, NULL),
(24, 2, 26, 'CTC', 'Surya Mahesa', '085728335513', 'Kos Pak Heru Trini Sinduadi Mlati Sleman, Jalan Belakang Mie Ayam, RT.6/RW.3, Sinduadi, Mlati', '55597', NULL, NULL),
(25, 2, 27, 'ECO', 'Surya Mahesa', '085728335513', 'Kos Pak Heru Trini Sinduadi Mlati Sleman, Jalan Belakang Mie Ayam, RT.6/RW.3, Sinduadi, Mlati', '55597', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `nama_produk` varchar(30) DEFAULT NULL,
  `stock` int(4) DEFAULT NULL,
  `harga` int(8) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `stock`, `harga`, `deskripsi`, `diskon`, `gambar`) VALUES
(5, 3, 'Paper Bag', 55, 5000, 'Paper bag UGM untuk kalian yang enggan menggunakan kantong plastik', 50, 'mar1.png '),
(6, 3, 'Handuk Mini', 18, 15000, 'Handuk kecil untuk starterpack kalian ketika olahraga atau kegiatan yang lainnya', 0, 'mar2.png '),
(7, 3, 'Tempat Pensil', 35, 11200, 'Tempat pensil yang memiliki kapasitas cukup besar terbuat dari bahan puring', 0, 'mar3.png '),
(8, 4, 'Topi', 10, 35000, 'Topi berlogo UGM yang dibordir', 0, 'topi1.png '),
(9, 4, 'Topi Bordir Depan dan Samping', 15, 40000, 'Topi berlogo UGM yang dibordir di depan dan di samping ada tulisan UGM yang dibordir', 0, 'tipi2.png '),
(10, 4, 'Topi Kulit Djogja', 7, 41000, 'Topi Djogja berbahan kulit sintetis dan bordiran tulisan DJOGJA', 0, 'topi3.png '),
(12, 3, 'Kaos Alumni Ugm', 10, 12000, 'Kaos nih gaes', 0, 'Kaos.jpg '),
(17, 3, 'Gelas Besar Logo UGM', 18, 15000, '', 0, 'Gelas UGM.png '),
(18, 3, 'Dasi Panjang', 13, 10000, 'Dasi untuk keperluan formal', 0, 'Dasi Formal.png '),
(20, 3, 'Gantungan Kunci Kulit', 16, 26000, 'Gantungan kunci yang terbuat dari kulit sintetis. Cocok untuk dipakai gantungan kunci motor dan mobil sebagai tempat menyimpan STNK, SIM, atau surat-surat yang lain.', 0, 'Gantunganb_kunci_kulit_26k-removebg-preview.png '),
(21, 3, 'Ganci', 34, 15400, 'Gantungan kunci yang terbuat dari karet atau rubber band. Cocok untuk dibawa ke mana-mana karena ukuran tidak terlalu besar dan kecil', 0, 'Ganci_15_400-removebg-preview.png '),
(22, 3, 'Tas Serut', 12, 52500, 'Tas serut berlogo UGM dan ada julukan blue campus yang menambah kesan UGM banget', 0, 'Tas_Serut-removebg-preview.png '),
(23, 3, 'Tas Rangsel', 10, 375000, 'Tas yang bisa dipakai untuk sekolah, kuliah, atau kerja. Stok tidak banyak, kapasitas lumayan besar.', 0, 'Tas_Ransel-removebg-preview.png ');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `order_id` varchar(20) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `status_transaksi` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `status_pembayaran` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `bank` varchar(20) DEFAULT NULL,
  `va_number` varchar(30) DEFAULT NULL,
  `pdf_url` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `total_bayar`, `order_id`, `tgl_bayar`, `ongkir`, `status_transaksi`, `payment_type`, `status_pembayaran`, `transaction_id`, `bank`, `va_number`, `pdf_url`) VALUES
(12, 3, 166000, '516349657', '2022-08-14', 6000, 'Pesanan Dikirim', 'bank_transfer', 'settlement', 'b2b2cbf8-9271-432d-a82e-31c85adc4cd2', 'bri', '924246363156552464', 'https://app.sandbox.midtrans.com/snap/v1/transactions/379ee7ff-e334-4457-98a2-6eb031e2b25c/pdf'),
(14, 3, 200, '25300456', '2022-08-14', 300, 'Pesanan Dikirim', 'bank_transfer', 'settlement', 'a5529b64-12e7-4bc1-aee2-0a8749406467', 'bri', '124123772750936027', 'https://app.midtrans.com/snap/v1/transactions/bc1574c3-9351-42c7-a8dd-361f860bf446/pdf'),
(17, 3, 30200, '442601050', '2022-08-26', 6000, 'pesanan dikemas', 'bank_transfer', 'settlement', '7a4190f2-aaae-4101-abd8-479fed2cef2b', 'bri', '124120735057846344', 'https://app.midtrans.com/snap/v1/transactions/3e834f98-d669-46df-80bf-69fbbe6f5d8c/pdf'),
(18, 3, 12000, '799059874', '2022-08-26', 6000, 'pesanan dikemas', 'bank_transfer', 'settlement', 'af657f06-0d60-4770-aa08-ce490133c011', 'bri', '124120198019612925', 'https://app.midtrans.com/snap/v1/transactions/3fb0ba96-a0b0-4cec-8946-b20daffd3c2b/pdf'),
(19, 2, 37000, '1085960861', '2022-08-26', 7000, 'pesanan dikemas', 'bank_transfer', 'settlement', '3cddbe5e-8540-497a-8a94-ca27c438f230', 'bni', '8578682095261769', 'https://app.midtrans.com/snap/v1/transactions/049eeb48-2449-4e46-8500-010d3b3d6e5c/pdf'),
(24, 2, 4950, '1403205074', '0000-00-00', 0, 'menunggu pembayaran', 'bank_transfer', 'pending', '5fe37688-aaa0-4b4f-b84b-adc36ff4d65d', 'bri', '124123578493484393', 'https://app.midtrans.com/snap/v1/transactions/f2aa44f1-e7b7-4727-82c8-4aab78f49f00/pdf'),
(25, 2, 37000, '383879361', '0000-00-00', 6000, 'menunggu pembayaran', 'bank_transfer', 'pending', 'dab2b3fe-8f12-430e-9847-08fd7eb65d9d', 'bni', '8578122534376487', 'https://app.midtrans.com/snap/v1/transactions/71b7fba2-1265-4785-abea-525118561b49/pdf'),
(26, 2, 37000, '146023540', '0000-00-00', 6000, 'menunggu pembayaran', 'bank_transfer', 'pending', '114d4393-82b5-4e91-b981-832b0672ac71', 'bni', '8578405368989417', 'https://app.midtrans.com/snap/v1/transactions/f479f7ac-2d7b-4e69-bd21-90bad5b79beb/pdf'),
(27, 2, 37000, '1274753735', '0000-00-00', 7000, 'menunggu pembayaran', 'bank_transfer', 'pending', '2756860b-bf08-4a7f-a10e-2325520a1439', 'bni', '8578625917821736', 'https://app.midtrans.com/snap/v1/transactions/752caf76-a8de-4bfc-8c34-24d17352feec/pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `no_hp`, `email`, `username`, `password`, `image`) VALUES
(1, 'Danik Septianti', '08976348859', 'danikseptianti98@gmail.com', 'danikkkk', 'danik', NULL),
(2, 'Surya Mahesa', '082772638222', 'surya@gmail.com', 'Surya', 'surya123', NULL),
(3, 'pelem', '0891234', 'Pelemmateng00@gmail.com', 'pelem', 'jepara', NULL),
(4, 'eksam', '088233042193', 'ekasamsiati03@mail.ugm.ac.id', 'eksam', 't3st123', NULL),
(5, 'Iqbal muhammad', '082233389976', 'baqilmuhammad2001@gmail.com', 'Masgagah', '030211', NULL),
(6, 'Jhonny', '087645280027', 'dr057435@gmail.com', 'Jhnny30', 'papajhonny', NULL),
(7, 'Surya Mahesa', '0938837727', 'Suryamahesa71@gmail.com', 'Mahesa', '123', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
