-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 07:53 AM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.2.8

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
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `profile_display` text DEFAULT NULL,
  `pass` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`admin_id`, `username`, `email`, `profile_display`, `pass`, `createdAt`) VALUES
(1, 'Abdul Sahabi', 'abdul@google.com', '', '$2y$10$7.yPYLuw17moM1lxCAbYa.8MrlY1hcrJX4224Cn1KWqjyGQ5Q42Wy', '2024-05-05 10:23:38'),
(2, 'abdultc', 'avdhultc@gmail.com', 'Unity_Admin_1716142609_7313.jpg', '$2y$10$jbsinjo1FZw9bj4iIX3Idu5AP32oHlLCpw1jx386wVZofFxyvb6ja', '2024-05-18 19:45:23'),
(3, 'cutiepie', 'summy@google.com', NULL, '$2y$10$2joYk/OFr6iQh/jkhfBlVuJoQ1W8qpN0ZIR5DJNwesAIcSGp8B3Aq', '2024-05-19 10:23:42'),
(4, 'cutiepie', 'summy1@google.com', NULL, '$2y$10$M5XoZc2VpCVVK9xmz03yweymfbncsSvecOPYSHO.PSjfFp.cCSDzO', '2024-05-19 10:23:53'),
(5, 'cutiepie', 'summ@google.com', NULL, '$2y$10$i7BQpzgr1r35rC64lluIIe0InHI9M0EuvdgUsSR2SJcC.YARRKL8u', '2024-05-19 10:24:04'),
(6, 'Avdhultc', 'abdulrahmansahabi559@gmail.com', NULL, '$2y$10$Tuh.GFMRwdHnk8aSIrMOqej20SakD/SanpjloasOJqm0/GRZ.ZpaW', '2024-05-19 10:26:31'),
(7, 'Avdhultc', 'abdulrahmansahabi55@gmail.com', NULL, '$2y$10$iu4cub4cwRsKz4Sgedy.1.bHN0tXbSRBnDR2VP6dwQm/HB9ys03S2', '2024-05-19 10:28:41'),
(8, 'summiey', 'sumayya@gmail.com', NULL, '$2y$10$cApIWgmxK4q.aLZGDcKFHOkSWzQhVahXqIjVsn1us1dZY6pQ/e.CO', '2024-05-19 10:29:41'),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidate_additional_info`
--

INSERT INTO `candidate_additional_info` (`id`, `school_fee`, `isPaid`, `isVerify`, `verify_digit`, `can_id`, `isAccept`, `isClick`, `isApproved`, `isDeclined`, `decision_message`, `expiredAt`) VALUES
(115, 7500.00, 0, 0, 677653, 28, 0, 0, 1, 0, '\r\nWe are pleased to announce that your admission request has been accepted! Your personal qualities have impressed us, and we are confident that you will make a positive impact in the Unity Girls College, Birnin Kebbi. Your application has been reviewed.', NULL),
(125, 8500.00, 0, 0, NULL, 48, 0, 0, 1, 0, 'We understand that choosing the right school is an important decision, and we respect your choice. If you have any questions or need further assistance, please don\'t hesitate to reach out to our admissions team. We wish you all the best in your academic journey and hope you find the perfect fit for your educational goals.', NULL),
(144, 8000.00, 0, 1, 790227, 69, 0, 0, 0, 0, '\r\nWe are pleased to announce that your admission request has been accepted! Your personal qualities have impressed us, and we are confident that you will make a positive impact in the Unity Girls College, Birnin Kebbi. Your application has been reviewed.', '2024-05-22 20:29:24'),
(145, 7500.00, 0, 1, 826643, 70, 0, 0, 0, 0, '\r\nWe are pleased to announce that your admission request has been accepted! Your personal qualities have impressed us, and we are confident that you will make a positive impact in the Unity Girls College, Birnin Kebbi. Your application has been reviewed.', '2024-05-24 19:48:05'),
(146, 7500.00, 0, 0, 959938, 71, 0, 0, 0, 0, '\r\nWe are pleased to announce that your admission request has been accepted! Your personal qualities have impressed us, and we are confident that you will make a positive impact in the Unity Girls College, Birnin Kebbi. Your application has been reviewed.', '2024-05-22 20:48:10'),
(147, 7500.00, 0, 1, 924330, 72, 1, 1, 1, 0, 'We are pleased to announce that your admission request has been accepted! Your personal qualities have impressed us, and we are confident that you will make a positive impact in the Unity Girls College, Birnin Kebbi. Your application has been reviewed.', '2024-06-08 21:23:10');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidate_contact_details`
--

INSERT INTO `candidate_contact_details` (`id`, `nationality`, `state`, `localG`, `address`, `previous_school`, `year_of_passing`, `guardian`, `guardian_relationship`, `guardian_contact`, `can_id`) VALUES
(116, 'Nigeria', 'Kebbi', 'Arewa Dandi', 'Zuru', 'Avdhul Tc', 2012, 'Garba Abubakar', 'Father', '09023013619', 28),
(126, 'Nigeria', 'Kebbi', 'Zuru', 'Diggi', 'Unity Girls College, Birnin kebbi', 2012, 'Garba Abubakar', 'Father', '09023013619', 48),
(147, 'Nigeria', 'Kebbi', 'Zuru', 'Zuru, Zuru', 'Andi gomo model school', 2012, 'Sahabi Abubakar', 'Father', '09023013619', 69),
(148, 'Nigeria', 'Kebbi', 'Zuru', 'Tudun wada', 'Andi gomo model school', 2012, 'Sahabi Abubakar', 'Father', '09023013619', 70),
(149, 'Ecuador', 'Adamawa', 'Fufore', 'Tudun wada', 'Andi gomo model school', 2012, 'Sahabi Abubakar', 'Father', '09023013619', 71),
(150, 'Nigeria', 'Kwara', 'Sakaba', 'Gelwasa', 'Gelwasa primary school', 2012, 'Hafsat Sani', 'Mother', '08143731982', 72);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidate_personal_info`
--

INSERT INTO `candidate_personal_info` (`can_id`, `fullname`, `email`, `dob`, `phone_no`, `admission_no`, `admission_type`, `admission_class`, `display_image`, `pass`, `createdAt`) VALUES
(28, 'Sumayya Garba', 'summy1@google.com', '2024-05-10', '09023013619', 1002, 'Transfer Student', 'JSS 1', 'Unity_img_1715640021_8524.jpeg', '$2y$10$GA0.M4wj/APLR9WRsZKg/.Q7j2RqUUUmXK/u/my3t58qcouZbOZdy', '2024-05-10 12:27:17'),
(48, 'Sumayya Garba Diggie', 'summy@google.com', '2003-05-17', '09023013619', 1003, 'Transfer Student', 'JSS 3', 'Unity_img_1716143642_9761.jpg', '$2y$10$mhwlv.99.fipGjGysNV2uOwf8LwHPFvdsqnkg7neS1o490CbjBMwa', '2024-05-17 07:54:28'),
(69, 'Sahabi Abdularahaman', 'avdhultc@gmail.com', '2001-05-01', '09023013619', 1004, 'Transfer Student', 'JSS 2', 'Unity_img_1716407471_1158.jpg', '$2y$10$HnSFWtm1xzHV0ncZZ/fZVu97ZFKL2oTfA/YdnAdM3hHwLV4EKviWC', '2024-05-22 07:51:11'),
(70, 'Nafisa Abubakar', 'skyhausa@gmail.com', '2024-05-01', '09023013619', 1005, 'Transfer Student', 'JSS 1', 'Unity_img_1716410700_7059.jpg', '$2y$10$ASG6THmIqdse0Kd3H10s6.J6dlbmHce9HzqWLHgd5XVLHdok4BUoy', '2024-05-22 08:45:00'),
(71, 'Nafisa Abubakar', 'north24hausa@gmail.com', '2024-05-01', '09023013619', 1006, 'Transfer Student', 'JSS 1', 'Unity_img_1716410890_9018.jpg', '$2y$10$9NFPF5oxv5A.WtI68T6W8uM2WRd7D4Z8BolqqIbV0hlI2Nfv1hf7W', '2024-05-22 08:48:10'),
(72, 'Zubairu Gambo', 'zubairugzange@gmail.com', '2024-06-08', '08089131423', 1007, 'New Admission (Fresh Student)', 'JSS 1', 'Unity_img_1717882238_9798.jpg', '$2y$10$m.iop5IGZlXjhIZj6SSWZucgZs1DCL2J/t2OvsAX3n.zgi/CNa6ZO', '2024-06-08 09:23:10');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`id`, `nature`, `body`, `can_id`, `followUp`, `createdAt`, `isOpened`) VALUES
(8, 'Technical issues', 'Problem one', 48, 'Yes', '2024-05-17 07:55:39', 1),
(9, 'Technical issues', 'Problem two', 48, 'Yes', '2024-05-17 07:55:48', 1),
(10, 'Application inquiry', 'Hhhv', 48, 'Yes', '2024-05-19 06:36:15', 1),
(11, 'other', 'Ugh\r\nFhb\r\nHj', 72, 'Yes', '2024-06-08 09:28:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE `Posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT 'No title',
  `body` text NOT NULL DEFAULT 'No content',
  `feature_img` text NOT NULL,
  `admin_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `total_views` int(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Posts`
--

INSERT INTO `Posts` (`post_id`, `title`, `body`, `feature_img`, `admin_id`, `createdAt`, `total_views`) VALUES
(12, 'First blogpost from while developing this blog section!', 'This is the fisrt post, after the blog post feature is error-free! Just wow.', 'Unity_post_img_1715772536_3584.jpg', 1, '2024-05-15 11:28:56', 3),
(13, 'Last test mode post!', 'Hello there world, my name is SAHABI ABDUL. I am junior developer eager to explore more advanced coding skills and creativity in the future inshallah', 'Unity_post_img_1715772733_4915.jpg', 1, '2024-05-15 11:32:13', 3),
(14, 'Labaran duniya: Yadda zaks koya programming cikin sauki', 'Shawarari daba-daban kamar haka:', 'Unity_post_img_1715879032_7360.png', 1, '2024-05-16 05:03:52', 8);

-- --------------------------------------------------------

--
-- Table structure for table `School_insight`
--

CREATE TABLE `School_insight` (
  `id` int(11) NOT NULL,
  `paid_balance` decimal(11,2) NOT NULL DEFAULT 0.00,
  `unpaid_balance` decimal(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `School_insight`
--

INSERT INTO `School_insight` (`id`, `paid_balance`, `unpaid_balance`) VALUES
(1, -756500.00, 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
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
-- Indexes for table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_fk` (`admin_id`);

--
-- Indexes for table `School_insight`
--
ALTER TABLE `School_insight`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `candidate_additional_info`
--
ALTER TABLE `candidate_additional_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `candidate_contact_details`
--
ALTER TABLE `candidate_contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `candidate_personal_info`
--
ALTER TABLE `candidate_personal_info`
  MODIFY `can_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `School_insight`
--
ALTER TABLE `School_insight`
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
-- Constraints for table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `post_fk` FOREIGN KEY (`admin_id`) REFERENCES `Admin` (`admin_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
