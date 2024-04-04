-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 04, 2024 at 06:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `royal_event`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(255) CHARACTER SET latin1 NOT NULL,
  `createuser` varchar(255) DEFAULT NULL,
  `deleteuser` varchar(255) DEFAULT NULL,
  `createbid` varchar(255) DEFAULT NULL,
  `updatebid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `createuser`, `deleteuser`, `createbid`, `updatebid`) VALUES
(1, 'Superuser', '1', '1', '1', '1'),
(2, 'Admin', '1', NULL, '1', '1'),
(3, 'User', NULL, NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbeventparticipants`
--

CREATE TABLE `tbeventparticipants` (
  `id` int(100) NOT NULL,
  `eventtype_id` varchar(100) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `other_names` varchar(150) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(100) DEFAULT NULL,
  `gender` varchar(500) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `next_of_kin_full_name` varchar(100) DEFAULT NULL,
  `next_of_kin_email` varchar(50) DEFAULT NULL,
  `next_of_kin_telephone` varchar(50) DEFAULT NULL,
  `next_of_kin_address` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `date_registered_for_event` datetime NOT NULL DEFAULT current_timestamp(),
  `passport_photo` varchar(500) DEFAULT NULL,
  `barcode_id` varchar(500) DEFAULT NULL,
  `registration_officer_id` varchar(100) DEFAULT NULL,
  `additional_column_1` text DEFAULT NULL,
  `additional_column_2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbeventparticipants`
--

INSERT INTO `tbeventparticipants` (`id`, `eventtype_id`, `last_name`, `other_names`, `email`, `telephone`, `gender`, `dob`, `next_of_kin_full_name`, `next_of_kin_email`, `next_of_kin_telephone`, `next_of_kin_address`, `address`, `date_registered_for_event`, `passport_photo`, `barcode_id`, `registration_officer_id`, `additional_column_1`, `additional_column_2`) VALUES
(2, '1', 'Geofrey', 'Apollos', NULL, NULL, 'male', NULL, 'Israel Geofrey', NULL, NULL, NULL, NULL, '2024-04-03 15:14:05', NULL, NULL, '2', NULL, NULL),
(3, '1', 'Geofrey', 'Apollos', NULL, NULL, 'female', NULL, 'Israel Geofrey', NULL, NULL, NULL, NULL, '2024-04-03 15:14:34', NULL, NULL, '2', NULL, NULL),
(4, '1', 'Apollos', 'Apollos Picture', 'apollosgeofrey@gmail.com', '08106338037', 'male', '2024-01-28 00:00:00', 'Israel Geofrey', 'israelgeofrey@gmail.com', '08106337077', 'Masaka, Nasarawa State', 'Masaka, Nasarawa State', '2024-04-03 15:16:23', NULL, NULL, '2', NULL, NULL),
(5, '1', 'Tete', 'TEste TEsa', 'aass@dasa.com', '0900049', 'female', NULL, 'IS Geo', 'isge@rrr.com', '090596', 'msk', 'Mask', '2024-04-03 15:21:15', 'sql-apt.png', NULL, '2', NULL, NULL),
(6, '29', 'Geofrey', 'Ayock ISreal', 'isreal@gmail.com', '09000999987', 'male', NULL, 'Geofrey Apollos', NULL, '08099999', 'Masaka', NULL, '2024-04-04 17:04:33', NULL, NULL, '2', NULL, NULL),
(7, '29', 'test', 'user naME', NULL, NULL, 'female', NULL, 'TESRTET KIN', NULL, NULL, NULL, NULL, '2024-04-04 17:06:02', NULL, NULL, '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `Staffid` varchar(255) DEFAULT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `Photo` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'avatar15.jpg',
  `Password` varchar(120) DEFAULT NULL,
  `permissions_id` varchar(190) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `Staffid`, `AdminName`, `UserName`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Status`, `Photo`, `Password`, `permissions_id`, `AdminRegdate`) VALUES
(2, 'U002', 'Admin', 'admin@royalevents.com', 'App', 'Admin', 942397933, 'admin@royalevents.com', 1, 'IMG_20220708_170638_972.jpg', '21232f297a57a5a743894a0e4a801fc3', NULL, '2022-07-21 10:18:39'),
(30, 'DCLM/2024/04', 'Admin', 'johnvakute', 'John', 'Vakute', 8031322256, 'john.vakute@yahoo.com', 1, 'avatar15.jpg', 'c0adda8e76397d530bb00bfb5433c0fa', NULL, '2024-04-04 15:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `id` int(11) NOT NULL,
  `regno` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `companyname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `companyemail` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `country` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `companyphone` text NOT NULL,
  `companyaddress` varchar(255) CHARACTER SET latin1 NOT NULL,
  `companylogo` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'avatar15.jpg',
  `status` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`id`, `regno`, `companyname`, `companyemail`, `country`, `companyphone`, `companyaddress`, `companylogo`, `status`, `creationdate`) VALUES
(4, '43422332', 'Royal Events NG', 'support@royalevents.com', 'Nigeria', '+2348106337038', 'FCT Abuja, NIG', 'logo.jpg', '1', '2022-03-22 12:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbleventtype`
--

CREATE TABLE `tbleventtype` (
  `ID` int(10) NOT NULL,
  `EventType` varchar(200) DEFAULT NULL,
  `eventDescription` text DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbleventtype`
--

INSERT INTO `tbleventtype` (`ID`, `EventType`, `eventDescription`, `start_date`, `end_date`, `CreationDate`) VALUES
(1, 'Birthday Party', NULL, '2024-04-03 18:44:19', '2024-04-06 00:00:00', '2022-01-22 07:02:34'),
(3, 'Concert', NULL, '2024-04-05 00:00:00', '2024-04-08 00:00:00', '2022-01-22 07:03:35'),
(4, 'Get Together', NULL, '2024-03-04 00:00:00', '2024-03-06 00:00:00', '2022-01-22 07:04:04'),
(5, 'Night Club', NULL, '2024-03-05 00:00:00', '2024-03-07 00:00:00', '2022-01-22 07:04:26'),
(6, 'Religious', NULL, '2024-03-06 00:00:00', '2024-03-08 00:00:00', '2022-01-22 07:05:27'),
(7, 'Wedding', NULL, '2024-03-31 00:00:00', '2024-04-04 00:00:00', '2022-01-22 07:06:07'),
(8, 'December Retreat 2024', NULL, '2024-04-01 00:00:00', '2024-04-05 00:00:00', '2024-03-29 11:37:15'),
(29, 'DCLM Youth Success Camp', 'For young men and women', '2024-04-08 17:00:00', '2024-04-12 10:00:00', '2024-04-04 15:42:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbeventparticipants`
--
ALTER TABLE `tbeventparticipants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbleventtype`
--
ALTER TABLE `tbleventtype`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EventType` (`EventType`(191));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbeventparticipants`
--
ALTER TABLE `tbeventparticipants`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbleventtype`
--
ALTER TABLE `tbleventtype`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
