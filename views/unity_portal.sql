-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 05:34 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unity_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `profile_display` text DEFAULT NULL,
  `pass` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `profile_display`, `pass`, `createdAt`) VALUES
(1, 'Abdul Sahabi', 'abdul@google.com', '', '$2y$10$7.yPYLuw17moM1lxCAbYa.8MrlY1hcrJX4224Cn1KWqjyGQ5Q42Wy', '2024-05-05 10:23:38'),
(2, 'abdultc', 'avdhultc@gmail.com', 'Unity_Admin_1716142609_7313.jpg', '$2y$10$jbsinjo1FZw9bj4iIX3Idu5AP32oHlLCpw1jx386wVZofFxyvb6ja', '2024-05-18 19:45:23'),
(3, 'cutiepie', 'summy@google.com', NULL, '$2y$10$2joYk/OFr6iQh/jkhfBlVuJoQ1W8qpN0ZIR5DJNwesAIcSGp8B3Aq', '2024-05-19 10:23:42'),
(4, 'cutiepie', 'summy1@google.com', NULL, '$2y$10$M5XoZc2VpCVVK9xmz03yweymfbncsSvecOPYSHO.PSjfFp.cCSDzO', '2024-05-19 10:23:53'),
(5, 'cutiepie', 'summ@google.com', NULL, '$2y$10$i7BQpzgr1r35rC64lluIIe0InHI9M0EuvdgUsSR2SJcC.YARRKL8u', '2024-05-19 10:24:04'),
(6, 'Avdhultc', 'abdulrahmansahabi559@gmail.com', NULL, '$2y$10$Tuh.GFMRwdHnk8aSIrMOqej20SakD/SanpjloasOJqm0/GRZ.ZpaW', '2024-05-19 10:26:31'),
(7, 'Avdhultc', 'abdulrahmansahabi55@gmail.com', NULL, '$2y$10$iu4cub4cwRsKz4Sgedy.1.bHN0tXbSRBnDR2VP6dwQm/HB9ys03S2', '2024-05-19 10:28:41'),
(8, 'summiey', 'sumayya@gmail.com', NULL, '$2y$10$qlklY6C9iFJrep02sEvBK.4D5yDw36IUGtiCmz92J5QATSIIZE226', '2024-05-19 10:29:41'),
(9, 'zubairu', 'zubairugzange@gmail.com', 'Unity_Admin_1717882536_5701.png', '$2y$10$qMjqIxbpxDx24AJTL/XseOm1tjLV/Swraqa.HMMlhHgLP3AzWSgnO', '2024-06-08 22:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_additional_info`
--

CREATE TABLE `candidate_additional_info` (
  `id` int(11) NOT NULL,
  `school_fee` decimal(9,2) NOT NULL,
  `isPaid` tinyint(1) NOT NULL DEFAULT 0,
  `isVerify` tinyint(1) NOT NULL DEFAULT 0,
  `verify_digit` int(6) DEFAULT NULL,
  `can_id` int(11) NOT NULL,
  `isAccept` tinyint(1) DEFAULT 0,
  `isClick` tinyint(1) DEFAULT 0,
  `isApproved` tinyint(1) NOT NULL DEFAULT 0,
  `isDeclined` tinyint(1) NOT NULL DEFAULT 0,
  `decision_message` text NOT NULL DEFAULT '\r\nWe are pleased to announce that your admission request has been accepted! Your personal qualities have impressed us, and we are confident that you will make a positive impact in the Unity Girls College, Birnin Kebbi. Your application has been reviewed.',
  `expiredAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate_additional_info`
--

INSERT INTO `candidate_additional_info` (`id`, `school_fee`, `isPaid`, `isVerify`, `verify_digit`, `can_id`, `isAccept`, `isClick`, `isApproved`, `isDeclined`, `decision_message`, `expiredAt`) VALUES
(152, '7500.00', 1, 1, 943657, 77, 0, 0, 0, 0, '\r\nWe are pleased to announce that your admission request has been accepted! Your personal qualities have impressed us, and we are confident that you will make a positive impact in the Unity Girls College, Birnin Kebbi. Your application has been reviewed.', '2024-08-18 17:27:16');

--
-- Triggers `candidate_additional_info`
--
DELIMITER $$
CREATE TRIGGER `add_paid` AFTER INSERT ON `candidate_additional_info` FOR EACH ROW BEGIN 

 IF NEW.isPAID = 1
 
 THEN

 UPDATE School_insight

 SET paid_balance =  paid_balance + NEW.school_fee;

 END IF;

 

 END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `remove_paid` AFTER DELETE ON `candidate_additional_info` FOR EACH ROW BEGIN 

 IF OLD.isPAID = 1
 
 THEN

 UPDATE School_insight

 SET paid_balance =  paid_balance - OLD.school_fee;

 END IF;

 

 END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `remove_paid_after_update` AFTER UPDATE ON `candidate_additional_info` FOR EACH ROW BEGIN 

 IF NEW.isPAID = 0
 
 THEN

 UPDATE School_insight

 SET paid_balance =  paid_balance - NEW.school_fee;

 END IF;

 

 END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `school_fee_trigger` BEFORE INSERT ON `candidate_additional_info` FOR EACH ROW BEGIN
DECLARE class VARCHAR(50);

SELECT admission_class
INTO class FROM 
candidate_personal_info
WHERE can_id = NEW.can_id;


CASE class 
 WHEN 'JSS 1' THEN

 SET NEW.school_fee = 7500;
 WHEN 'JSS 2' THEN 
 SET NEW.school_fee =
 8000;
 WHEN 'JSS 3' THEN 
 SET NEW.school_fee =
 8500;
 WHEN 'SS 1' THEN
 SET NEW.school_fee =
 11000;
 WHEN 'SS 2' THEN 
 SET NEW.school_fee =
 11500;
 WHEN 'SS 3' THEN 
 SET NEW.school_fee =
 13000;
 ELSE 
 SET NEW.school_fee = 3500;
 END CASE;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_paid` AFTER UPDATE ON `candidate_additional_info` FOR EACH ROW BEGIN 

 IF NEW.isPAID = 1
 
 THEN

 UPDATE School_insight

 SET paid_balance =  paid_balance + NEW.school_fee;

 END IF;

 

 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_contact_details`
--

CREATE TABLE `candidate_contact_details` (
  `id` int(11) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `localG` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `previous_school` varchar(100) NOT NULL,
  `year_of_passing` int(4) NOT NULL,
  `guardian` varchar(100) NOT NULL,
  `guardian_relationship` varchar(50) NOT NULL,
  `guardian_contact` varchar(20) NOT NULL,
  `can_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate_contact_details`
--

INSERT INTO `candidate_contact_details` (`id`, `nationality`, `state`, `localG`, `address`, `previous_school`, `year_of_passing`, `guardian`, `guardian_relationship`, `guardian_contact`, `can_id`) VALUES
(155, 'Afghanistan', 'Abia', 'Aba North', 'Tudun Wada', 'Andi gomo', 2012, 'Umar Bala', 'Father', '09002234132', 77);

-- --------------------------------------------------------

--
-- Table structure for table `candidate_personal_info`
--

CREATE TABLE `candidate_personal_info` (
  `can_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `admission_no` int(4) NOT NULL,
  `admission_type` varchar(50) NOT NULL,
  `admission_class` varchar(50) NOT NULL,
  `display_image` varchar(200) NOT NULL,
  `pass` text NOT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate_personal_info`
--

INSERT INTO `candidate_personal_info` (`can_id`, `fullname`, `email`, `dob`, `phone_no`, `admission_no`, `admission_type`, `admission_class`, `display_image`, `pass`, `createdAt`) VALUES
(77, 'Abdul Sahabi', 'avdhultc@gmail.com', '2024-08-18', '09023013619', 1008, 'Transfer Student', 'JSS 1', 'Unity_img_1723943713_7553.jpg', '$2y$10$GpxzAIlZ8K1mqae3U0a1.O/p9ZgyyPIpz17FqiXkYd7wZ2KEEXjTu', '2024-08-18 03:15:13');

--
-- Triggers `candidate_personal_info`
--
DELIMITER $$
CREATE TRIGGER `generate_admission_no` BEFORE INSERT ON `candidate_personal_info` FOR EACH ROW BEGIN 

DECLARE
max_admission_no INT(4);

SELECT MAX(admission_no)
INTO max_admission_no FROM

candidate_personal_info;

IF max_admission_no IS NULL

THEN
SET NEW.admission_no = 1000;
ELSE 
SET NEW.admission_no = max_admission_no + 1;
END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `id` int(4) NOT NULL,
  `nature` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `can_id` int(4) NOT NULL,
  `followUp` varchar(20) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `isOpened` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT 'No title',
  `body` text NOT NULL DEFAULT 'No content',
  `feature_img` text NOT NULL,
  `admin_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `total_views` int(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `body`, `feature_img`, `admin_id`, `createdAt`, `total_views`) VALUES
(14, 'Labaran duniya: Yadda zaks koya programming cikin sauki', 'Shawarari daba-daban kamar haka:', 'Unity_post_img_1715879032_7360.png', 1, '2024-05-16 05:03:52', 9);

-- --------------------------------------------------------

--
-- Table structure for table `school_insight`
--

CREATE TABLE `school_insight` (
  `id` int(11) NOT NULL,
  `paid_balance` decimal(11,2) NOT NULL DEFAULT 0.00,
  `unpaid_balance` decimal(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_insight`
--

INSERT INTO `school_insight` (`id`, `paid_balance`, `unpaid_balance`) VALUES
(1, '-741500.00', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `candidate_additional_info`
--
ALTER TABLE `candidate_additional_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `additional_info_fk` (`can_id`);

--
-- Indexes for table `candidate_contact_details`
--
ALTER TABLE `candidate_contact_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `can_fk_1` (`can_id`);

--
-- Indexes for table `candidate_personal_info`
--
ALTER TABLE `candidate_personal_info`
  ADD PRIMARY KEY (`can_id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `unique_admission_no` (`email`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `can_complaint_fk` (`can_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_fk` (`admin_id`);

--
-- Indexes for table `school_insight`
--
ALTER TABLE `school_insight`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `candidate_additional_info`
--
ALTER TABLE `candidate_additional_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `candidate_contact_details`
--
ALTER TABLE `candidate_contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `candidate_personal_info`
--
ALTER TABLE `candidate_personal_info`
  MODIFY `can_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `school_insight`
--
ALTER TABLE `school_insight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate_additional_info`
--
ALTER TABLE `candidate_additional_info`
  ADD CONSTRAINT `additional_info_fk` FOREIGN KEY (`can_id`) REFERENCES `candidate_personal_info` (`can_id`) ON DELETE CASCADE;

--
-- Constraints for table `candidate_contact_details`
--
ALTER TABLE `candidate_contact_details`
  ADD CONSTRAINT `can_fk_1` FOREIGN KEY (`can_id`) REFERENCES `candidate_personal_info` (`can_id`) ON DELETE CASCADE;

--
-- Constraints for table `complain`
--
ALTER TABLE `complain`
  ADD CONSTRAINT `can_complaint_fk` FOREIGN KEY (`can_id`) REFERENCES `candidate_personal_info` (`can_id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `post_fk` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
