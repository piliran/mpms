-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2022 at 05:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `procure`
--
CREATE DATABASE IF NOT EXISTS `procure` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `procure`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'zimba', 'ad0b2807ef64e0332b654240c29b524097093afa');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `departmentName` varchar(255) NOT NULL,
  `budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `departmentName`, `budget`) VALUES
(11, 'ict', 5700000);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `requestID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `uid`, `type`, `message`, `createdAt`, `requestID`) VALUES
(10, 1, 'departmentalHead', 'Your request has been approved by the Head of department now it is in the Dean`s office', '2021-04-12 13:49:36', 72),
(11, 1, 'dean', 'Your request has been approved by the Dean now it is in the office of the Registrar', '2021-04-12 13:51:47', 72),
(12, 1, 'registrar', 'Your request has been approved by the Registrar now it is in the office of the Vice Chancellor', '2021-04-12 13:52:59', 72),
(13, 1, 'viceChancellor', 'Your request has been approved by the Vice Chancellor now it is in the office of the procurement', '2021-04-12 13:53:34', 72),
(14, 1, 'procurementOfficer', 'Your items have been procured, please go and collect to the stores ', '2021-04-12 13:55:05', 72);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `requestID` int(11) NOT NULL,
  `resourceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `uid`, `type`, `message`, `createdAt`, `requestID`, `resourceID`) VALUES
(111, 19, 'procurementOfficer', 'deliver your resource', '2021-04-12 13:57:58', 0, 27);

-- --------------------------------------------------------

--
-- Table structure for table `receivedmessages`
--

CREATE TABLE `receivedmessages` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receivedmessages`
--

INSERT INTO `receivedmessages` (`id`, `date`, `sender`, `receiver`, `text`) VALUES
(15, '2021-03-10 09:58:17', '+265992998262', '+2652331463', 'Trans.ID :  PP220309.1404.H55996. Dear customer, you have received MK 8000.00 from 995826667,Goshen Betha . Your available balance is MK 2022.43.'),
(23, '2021-03-11 06:07:21', 'Airtel', '+2652331463', 'Your Call back request has been sent.Dial *135*1# to join Airtel Zone and get up to 99 percent discount on Calls'),
(24, '2021-03-11 06:13:30', '+265994645303', '+2652331463', 'Dear Customer, money transfer to 991321811, Emmanuel chipeta is successful, Trans Id: PP210221.1054.H76410,Trans Amt: MK60000.00. Your available balance MK149.27');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `itemQuantity` int(11) NOT NULL,
  `itemQuality` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `hod_comment` varchar(255) NOT NULL,
  `hod_commentBy` varchar(255) NOT NULL,
  `dean_comment` varchar(255) NOT NULL,
  `dean_commentBy` varchar(255) NOT NULL,
  `registrar_comment` varchar(255) NOT NULL,
  `registrar_commentBy` varchar(255) NOT NULL,
  `viceChancellor_comment` varchar(255) NOT NULL,
  `viceChancellor_commentBy` varchar(255) NOT NULL,
  `procurementOfficer_comment` varchar(255) NOT NULL,
  `procurementOfficer_commentBy` varchar(255) NOT NULL,
  `directorOfFinance_comment` varchar(255) NOT NULL,
  `directorOfFinance_commentBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `uid`, `itemName`, `itemQuantity`, `itemQuality`, `createdAt`, `hod_comment`, `hod_commentBy`, `dean_comment`, `dean_commentBy`, `registrar_comment`, `registrar_commentBy`, `viceChancellor_comment`, `viceChancellor_commentBy`, `procurementOfficer_comment`, `procurementOfficer_commentBy`, `directorOfFinance_comment`, `directorOfFinance_commentBy`) VALUES
(72, 1, '2 HP laptops', 0, '', '2021-04-12 13:48:15', 'approved', 'Misheck Nyirenda', 'approved', 'Jaward Zimba', 'approved', 'madalitso nakai', 'approved', 'henry phiri', 'approved', 'lackson banda', 'approved', 'lucious dindi');

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `resourceName` varchar(255) NOT NULL,
  `resourceQuantity` int(11) NOT NULL,
  `resourceQuality` varchar(255) NOT NULL,
  `resourceCost` int(11) NOT NULL,
  `dateSent` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `procurementOfficer_commentBy` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `directorOfFinance_commentBy` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id`, `uid`, `resourceName`, `resourceQuantity`, `resourceQuality`, `resourceCost`, `dateSent`, `status`, `procurementOfficer_commentBy`, `department`, `directorOfFinance_commentBy`, `photo`) VALUES
(27, 19, '2 HP laptops', 0, '', 300000, '2021-04-12 13:56:42', 'selected', 'lackson banda', 'ict', 'lucious dindi', '');

-- --------------------------------------------------------

--
-- Table structure for table `sentmessages`
--

CREATE TABLE `sentmessages` (
  `id` int(11) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 1,
  `verified` int(11) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `email`, `department`, `deleted`, `verified`, `role`, `password`, `phone`, `photo`, `createdAt`) VALUES
(1, 'piliran zimba', 'Male', 'piliran@gmail.com', 'ict', 1, 0, 'student', '12345', '0992331463', 'uploads/_DSC9265.jpg', '2021-01-16 18:53:11'),
(2, 'Misheck Nyirenda', 'Male', 'misheck@gmail.com', 'ict', 1, 0, 'departmentalHead', 'qwerty', '0999343568', '', '2021-01-17 05:29:55'),
(3, 'reuben moyo', 'Male', 'reuben@gmail.com', 'ict', 1, 0, 'departmentalHead', 'qwerty', '0883456788', '', '2021-01-17 08:32:34'),
(4, 'mayabanga', 'Male', 'maya@gmail.com', 'ict', 1, 0, 'departmentalHead', 'qwerty', '0888834567', '', '2021-01-17 14:11:37'),
(5, 'man', 'Male', 'man@gmail.com', '', 1, 0, 'dean', '12345', '0993245676', '', '2021-01-17 17:01:13'),
(6, 'kabola', 'Male', 'kabola@gmail.com', 'land', 1, 0, 'departmentalHead', '12345', '014567656', '', '2021-01-17 18:11:17'),
(7, 'jack sparow', 'Male', 'jack@gmail.com', 'land', 1, 0, 'departmentalHead', 'qwerty', '01647483', '', '2021-01-18 12:17:03'),
(8, 'jane kamanga', 'Female', 'jane@gmail.com', 'communication', 1, 0, 'departmentalHead', '123456', '0992764726', '', '2021-01-19 05:05:42'),
(9, 'stacia kosam', 'Male', 'stecia@gmail.com', 'ict', 1, 0, 'departmentalHead', 'qwerty', '0881324342', '', '2021-01-19 07:28:46'),
(10, 'emily banda', 'Female', 'emily@gmail.com', 'tourism', 1, 0, 'departmentalHead', 'zxcvb', '054263737', '', '2021-01-20 06:07:28'),
(11, 'brandon gama', 'Male', 'brandon@gmail.com', 'tourism', 1, 0, 'student', 'asdfg', '0999345646', '', '2021-01-20 06:09:39'),
(12, 'Jaward Zimba', 'Male', 'jaward@gmail.com', '', 1, 0, 'dean', '12345', '0888865635', '', '2021-01-20 07:45:25'),
(13, 'madalitso nakai', 'Female', 'madalitso@gmail.com', '', 1, 0, 'registrar', '12345', '0999343568', '', '2021-01-21 21:51:40'),
(14, 'wiliam zimba', 'Male', 'widy@gmail.com', 'nursing', 1, 0, 'student', 'qwerty', '0999376257', '', '2021-01-21 22:21:24'),
(15, 'shylin shaba', 'Female', 'shylin@gmail.com', 'optometry', 1, 0, 'departmentalHead', 'zxcvb', '09993874365', '', '2021-01-22 07:04:50'),
(16, 'Gift Nyirenda', 'Male', 'gibo@gmail.com', 'forestry', 1, 0, 'departmentalHead', 'asdfg', '09996537647', '', '2021-01-22 14:19:08'),
(17, 'henry phiri', 'Male', 'henry@gmail.com', '', 1, 0, 'viceChancellor', 'asdfg', '088865768', '', '2021-01-24 06:31:17'),
(18, 'lackson banda', 'Male', 'lack@gmail.com', '', 1, 0, 'procurementOfficer', '00000', '0994747483', '', '2021-01-24 09:21:11'),
(19, 'agnes majunga', 'Female', 'agnes@gmail.com', '', 1, 0, 'supplier', '12345', '0886754726', '', '2021-01-25 07:56:37'),
(20, 'Joel Manda', 'Male', 'joel@gmail.com', '', 1, 0, 'dean', 'UH4mTp', '09936763763', '', '2021-01-26 16:29:26'),
(21, 'diana phiri', 'Female', 'diana@gmail.com', 'ict', 1, 0, 'student', 'wzC6us', '05656456', '', '2021-01-27 11:55:34'),
(22, 'manuel banda', 'Male', 'manuel@gmail.com', '', 1, 0, 'registrar', 'rGJHyB', '0999287482', '', '2021-01-27 11:58:08'),
(23, 'esther singah', 'Female', 'esther@gmail.com', 'languages', 1, 0, 'student', '2ixec6', '0996723856', 'uploads/IMG-20210116-WA0005.jpg', '2021-02-03 11:24:23'),
(24, 'dennis maseko', 'Male', 'dennis@gmail.com', 'land', 1, 0, 'student', 'xekSpg', '099934456', '', '2021-03-03 08:17:52'),
(25, 'lucious dindi', 'Male', 'luci@gmail.com', '', 1, 0, 'financeDirector', 'NbVp3m', '0995532446', '', '2021-03-10 06:31:51'),
(26, 'mirriam chipeta', 'Female', 'mirriam@gmail.com', '', 1, 0, 'supplier', 'rn9DzI', '0994645303', '', '2021-03-11 07:15:40'),
(27, 'frank zimba', 'Male', 'gav@gmail.com', '', 1, 0, 'supplier', '$2y$10$fAQ8vmd7.1yGo9e2AjvokOPBYNcya4Wg1ku0cWC1/QvutLZ75lXw6', '0999986t', '', '2021-03-11 07:35:54'),
(28, 'malumbo banda', 'Male', 'malumbo@gmail.com', '', 1, 0, 'dean', 'CzlGF8', '0999374676', '', '2021-03-11 07:39:41'),
(29, 'pemphero thangalimodzi', 'Male', 'thanga@gmail.com', 'ict', 1, 0, 'departmentalHead', 'qwerty', '099783746', '', '2021-03-11 07:51:50'),
(30, 'marita phiri', 'Female', 'marita@gmail.com', 'forestry', 1, 0, 'student', 'Mn1z5y', '099925278', '', '2021-03-11 08:59:51'),
(31, 'lilian jait', 'female', 'jait@gmail.com', '', 1, 0, 'supplier', 'qwerty', '0991334781', '', '2021-03-11 09:30:06'),
(32, 'vincent kandoje', 'Male', 'vincent@gmail.com', '', 1, 0, 'financeDirector', '00000', '09996745766', '', '2021-03-17 18:14:09'),
(33, 'oscar kameta', 'Male', 'oscar@gmail.com', '', 1, 0, 'supplier', 'Y@R3lq', '099161677', '', '2021-04-08 23:27:51'),
(34, 'John Saka', 'Male', 'saka@gmail.com', '', 1, 0, 'viceChancellor', 'fLClKZ', '088827655', '', '2021-04-08 23:31:08'),
(35, 'Wezi Shaba', 'Male', 'wezi@gmail.com', '', 1, 0, 'registrar', 'nRcdlT', '099965643', '', '2021-04-08 23:34:14'),
(36, 'Fiskani Ngwira', 'Male', 'fiskan@gmail.com', '', 1, 0, 'dean', '4QTREp', '0888237688', '', '2021-04-08 23:35:42'),
(37, 'Reuben Moyo', 'Female', 'reuben1@gmail.com', 'ict', 1, 0, 'departmentalHead', 'RfJmB3', '099342876', '', '2021-04-08 23:37:17'),
(38, 'Dangote Phiri', 'Male', 'dango@gmail.com', '', 1, 0, 'procurementOfficer', '4Pbnl#', '099976773', '', '2021-04-08 23:38:41'),
(39, 'eric chinsime', 'Male', 'eric@gmail.com', 'tourism', 1, 0, 'student', 'tIu08G', '0998672632', '', '2021-04-08 23:40:40'),
(40, 'chifuniro enzan', 'Female', 'chifu@gmail.com', '', 1, 0, 'financeDirector', 'qER@Ak', '099936772', '', '2021-04-08 23:41:36'),
(42, 'mary manda', 'female', 'jane@gmail.com', 'ict', 1, 0, 'student', '324334', '099934433', '13rfwerf', '2021-09-14 11:12:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `requestID` (`requestID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `requestID` (`requestID`),
  ADD KEY `resourceID` (`resourceID`),
  ADD KEY `requestID_2` (`requestID`);

--
-- Indexes for table `receivedmessages`
--
ALTER TABLE `receivedmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `sentmessages`
--
ALTER TABLE `sentmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `receivedmessages`
--
ALTER TABLE `receivedmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sentmessages`
--
ALTER TABLE `sentmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`requestID`) REFERENCES `request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`resourceID`) REFERENCES `resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resource`
--
ALTER TABLE `resource`
  ADD CONSTRAINT `resource_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
