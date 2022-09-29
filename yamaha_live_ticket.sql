-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2022 at 02:52 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yamaha_live_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `import_user_temp`
--

CREATE TABLE `import_user_temp` (
  `ID_User_Temp` int(11) NOT NULL,
  `NikUser_Temp` varchar(255) DEFAULT NULL,
  `NamaUser_Temp` varchar(255) DEFAULT NULL,
  `DeptUser_Temp` varchar(255) DEFAULT NULL,
  `Username_Temp` varchar(255) DEFAULT NULL,
  `PassUser_Temp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `import_user_temp`
--

INSERT INTO `import_user_temp` (`ID_User_Temp`, `NikUser_Temp`, `NamaUser_Temp`, `DeptUser_Temp`, `Username_Temp`, `PassUser_Temp`) VALUES
(284, '65375', 'Rohman Nur', 'Packing', 'Rohman 1', 'adcd7048512e64b48da55b027577886ee5a36350'),
(285, '65376', 'Rohman Nur', 'Packing', 'Rohman 2', 'adcd7048512e64b48da55b027577886ee5a36350'),
(286, '65377', 'Rohman Nur', 'Packing', 'Rohman 3', 'adcd7048512e64b48da55b027577886ee5a36350'),
(287, '65378', 'Rohman Nur', 'Packing', 'Rohman 4', 'adcd7048512e64b48da55b027577886ee5a36350'),
(288, '65379', 'Rohman Nur', 'Packing', 'Rohman 5', 'adcd7048512e64b48da55b027577886ee5a36350'),
(289, '65380', 'Rohman Nur', 'Packing', 'Rohman 6', 'adcd7048512e64b48da55b027577886ee5a36350'),
(290, '65381', 'Rohman Nur', 'Packing', 'Rohman 7', 'adcd7048512e64b48da55b027577886ee5a36350'),
(291, '543003', 'herman', 'PPS', 'herman', 'adcd7048512e64b48da55b027577886ee5a36350');

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `ID_Kategori` int(11) NOT NULL,
  `Ticket` varchar(255) DEFAULT NULL,
  `Kategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`ID_Kategori`, `Ticket`, `Kategori`) VALUES
(1, 'Ticket 1', 'Loker'),
(2, 'Ticket 2', 'Toilet'),
(3, 'Ticket 3', 'Kantin'),
(4, 'Ticket 4', 'Musholla'),
(5, 'Ticket 5', 'Parkiran'),
(6, 'Ticket 6', 'Rest Area'),
(7, 'Ticket 7', 'Other'),
(9, 'Ticket 8', 'Kamar Mandi Pria'),
(10, 'Ticket 10', 'kamar mandi wanita');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `ID_User` int(11) NOT NULL,
  `NikUser` varchar(255) DEFAULT NULL,
  `NamaUser` varchar(255) DEFAULT NULL,
  `DeptUser` varchar(255) DEFAULT NULL,
  `StatusUser` int(11) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `PassUser` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`ID_User`, `NikUser`, `NamaUser`, `DeptUser`, `StatusUser`, `Username`, `PassUser`) VALUES
(1, '12345', 'administrator', 'administrator', 0, 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad'),
(5, NULL, 'sandra dewi', NULL, 0, 'sandra', '218f80e362cfbdbc886c205a7684f7826de9774e'),
(6, '23456', 'adi imadudin', 'OMG', 1, 'adi', '145c32d7b75b3c1e347e5e8c2a5611c116857009'),
(7, '543003', 'herman', 'PPS', 1, 'herman', 'adcd7048512e64b48da55b027577886ee5a36350'),
(8, '12345', 'siti zulaikha', 'PPS', 1, 'siti', 'b48d66e55c41b0abb8c540b518f2e25d21a2ee2a'),
(25, NULL, 'citra', NULL, 0, 'citra', 'adcd7048512e64b48da55b027577886ee5a36350'),
(65, '65375', 'Rohman Nur', 'Packing', 1, 'Rohman 1', 'adcd7048512e64b48da55b027577886ee5a36350'),
(66, '65376', 'Rohman Nur', 'Packing', 1, 'Rohman 2', 'adcd7048512e64b48da55b027577886ee5a36350'),
(67, '65377', 'Rohman Nur', 'Packing', 1, 'Rohman 3', 'adcd7048512e64b48da55b027577886ee5a36350'),
(68, '65378', 'Rohman Nur', 'Packing', 1, 'Rohman 4', 'adcd7048512e64b48da55b027577886ee5a36350'),
(69, '65379', 'Rohman Nur', 'Packing', 1, 'Rohman 5', 'adcd7048512e64b48da55b027577886ee5a36350'),
(70, '65380', 'Rohman Nur', 'Packing', 1, 'Rohman 6', 'adcd7048512e64b48da55b027577886ee5a36350'),
(71, '65381', 'Rohman Nur', 'Packing', 1, 'Rohman 7', 'adcd7048512e64b48da55b027577886ee5a36350');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `ID_Transaksi` int(11) NOT NULL,
  `Trans_TglJam` date DEFAULT NULL,
  `Trans_IDKaryawan` varchar(255) DEFAULT NULL,
  `Trans_Ticket` int(11) DEFAULT NULL,
  `Trans_Deskripsi` text,
  `Trans_Status` int(11) DEFAULT NULL,
  `Trans_Action` text,
  `Trans_img_before` text,
  `Trans_img_after` text,
  `Trans_TglJam_Action` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`ID_Transaksi`, `Trans_TglJam`, `Trans_IDKaryawan`, `Trans_Ticket`, `Trans_Deskripsi`, `Trans_Status`, `Trans_Action`, `Trans_img_before`, `Trans_img_after`, `Trans_TglJam_Action`) VALUES
(6, '2022-09-10', '8', 4, 'belum di bersihkan', 0, NULL, '50068156b9d463f871a8723d06824c28.jpg', NULL, NULL),
(7, '2022-09-10', '7', 3, 'SABUN', 0, NULL, 'b7546ceda20a68a4fc486fe7158fb5af.jpg', NULL, NULL),
(8, '2022-09-10', '6', 5, 'belum di sapu', 1, 'sudah di sapu', 'e7de6b33abe2ed5cb97ab3fb1083e47f.jpg', 'a6438ff13213608c9f6ce2818c671a51.jpg', '2022-09-10'),
(15, '2022-09-12', '7', 5, 'terlalu kotor', 0, NULL, 'a2bc1f2ffc677f8526b38a3b1e9076f3.jpg', NULL, NULL),
(17, '2022-09-13', '7', 6, 'ya gitu deh', 1, 'fsdf', '7457f750281a6e1e1c940c15a4407f8a.jpg', '2fa3bd80ce10e513d6c0663613851756.jpg', '2022-09-12'),
(18, '2022-09-07', '6', 5, 'Kurang tertata', 0, NULL, 'a64fd1ee1fb64a7fee8b4a969ca939a3.jpg', NULL, NULL),
(19, '2022-09-15', '7', 5, 'parkiran sempit', 0, NULL, '0254d3a0509748221152b41935965c18.jpeg', NULL, NULL),
(20, '2022-09-13', '7', NULL, 'Area mati', 0, NULL, '65fd9875f4d6db84f68fb971cf871a7f.jpg', NULL, NULL),
(21, '2022-09-13', '7', 5, 'parkiran kotor', 1, 'wes di sapu', 'c053c98ddc73e27630526e0a5d288559.jpeg', 'b5761917db9084ac49d3d290db55645a.jpg', '2022-09-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `import_user_temp`
--
ALTER TABLE `import_user_temp`
  ADD PRIMARY KEY (`ID_User_Temp`);

--
-- Indexes for table `m_kategori`
--
ALTER TABLE `m_kategori`
  ADD PRIMARY KEY (`ID_Kategori`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`ID_User`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`ID_Transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `import_user_temp`
--
ALTER TABLE `import_user_temp`
  MODIFY `ID_User_Temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;
--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `ID_Kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `ID_Transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
