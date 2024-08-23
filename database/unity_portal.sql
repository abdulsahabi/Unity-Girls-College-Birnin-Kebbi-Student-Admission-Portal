-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 08:48 PM
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
(2, 'abdultc', 'avdhultc@gmail.com', 'Unity_Admin_1724006009_2342.jpg', '$2y$10$jbsinjo1FZw9bj4iIX3Idu5AP32oHlLCpw1jx386wVZofFxyvb6ja', '2024-05-18 19:45:23');

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
(152, '7500.00', 1, 1, 686119, 77, 0, 0, 0, 0, '\r\nWe are pleased to announce that your admission request has been accepted! Your personal qualities have impressed us, and we are confident that you will make a positive impact in the Unity Girls College, Birnin Kebbi. Your application has been reviewed.', '2024-08-18 18:52:47'),
(153, '7500.00', 1, 1, 797695, 78, 1, 1, 1, 0, 'We are pleased to announce that your admission request has been accepted! Your personal qualities have impressed us, and we are confident that you will make a positive impact in the Unity Girls College, Birnin Kebbi. Your application has been reviewed.', '2024-08-18 20:40:55');

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
(155, 'Afghanistan', 'Abia', 'Aba North', 'Tudun Wada', 'Andi gomo', 2012, 'Umar Bala', 'Father', '09002234132', 77),
(156, 'Nigeria', 'Kebbi', 'Zuru', 'Tudun Wada', 'Andi Gomo Primary School, Zuru', 2012, 'Umar Balarabe', 'Step-parent', '09023013619', 78);

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
(77, 'Abdul Sahabi', 'avdhultc@gmail.com', '2024-08-18', '09023013619', 1008, 'Transfer Student', 'JSS 1', 'Unity_Admin_1724006009_2342.jpg', '$2y$10$Sgnierf6PFDIQZJQtU82ieMC.nJvGQRPg9EjjwmtxE.FZ8Tuot5ai', '2024-08-18 03:15:13'),
(78, 'Abdulrahaman Sahabi', 'tcstudio6542@gmail.com', '2024-08-18', '09023013618', 1009, 'New Admission (Fresh Student)', 'JSS 1', 'Unity_img_1724006454_8993.jpg', '$2y$10$9Z7EcrQRj1J81uu0eFsWk.82kmJml/pZiYKRnvij2rvPIeu3xry3i', '2024-08-18 08:40:54');

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
(24, 'Admissions Now Open', '&lt;div style=&quot;max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);&quot;&gt;\r\n        &lt;h1 style=&quot;font-size: 2em; color: #2c3e50; margin-bottom: 10px;&quot;&gt;Admissions Now Open for 2024!&lt;/h1&gt;\r\n        &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla magna at metus convallis, id aliquet orci ultrices. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nulla facilisi. Sed euismod, nisi ac scelerisque auctor, nisi libero efficitur urna, in dignissim urna libero eget nisi.&lt;/p&gt;\r\n        \r\n        &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Why Choose Us?&lt;/p&gt;\r\n        &lt;ul style=&quot;list-style-type: disc; margin-left: 20px; margin-bottom: 15px;&quot;&gt;\r\n            &lt;li&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit.&lt;/li&gt;\r\n            &lt;li&gt;Praesent commodo cursus magna, vel scelerisque nisl.&lt;/li&gt;\r\n            &lt;li&gt;Nulla vitae elit libero, a pharetra augue.&lt;/li&gt;\r\n            &lt;li&gt;Etiam porta sem malesuada magna mollis euismod.&lt;/li&gt;\r\n        &lt;/ul&gt;\r\n\r\n        &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Morbi mattis risus vitae urna sollicitudin, quis ultricies sem interdum. Vivamus consequat libero vitae neque malesuada, nec tempus justo vestibulum. Suspendisse et felis lorem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.&lt;/p&gt;\r\n        \r\n        &lt;a href=&quot;#&quot; style=&quot;display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;&quot;&gt;Apply Now&lt;/a&gt;\r\n    &lt;/div&gt;', 'Unity_post_img_1724003561_3921.jpg', 2, '2024-08-18 19:52:41', 2),
(25, 'Achieve Your Academic Goals: Apply for Admission Today!', '&lt;div style=&quot;max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);&quot;&gt;\r\n    &lt;h1 style=&quot;font-size: 2em; color: #2c3e50; margin-bottom: 10px;&quot;&gt;Discover Our World-Class Programs&lt;/h1&gt;\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim lacus ac justo fermentum, non fermentum libero consequat. Donec dapibus tellus in nisi bibendum, at pretium lorem tincidunt. Vivamus fringilla turpis non felis volutpat, nec cursus sapien sollicitudin.&lt;/p&gt;\r\n    \r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;What We Offer:&lt;/p&gt;\r\n    &lt;ul style=&quot;list-style-type: disc; margin-left: 20px; margin-bottom: 15px;&quot;&gt;\r\n        &lt;li&gt;Innovative and up-to-date curriculum&lt;/li&gt;\r\n        &lt;li&gt;Highly qualified faculty members&lt;/li&gt;\r\n        &lt;li&gt;State-of-the-art research facilities&lt;/li&gt;\r\n        &lt;li&gt;Diverse and inclusive campus community&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum eget ante eros. Cras ut quam eu nulla venenatis vulputate non id lacus. Donec id urna vitae magna bibendum euismod a eget enim.&lt;/p&gt;\r\n    \r\n    &lt;a href=&quot;#&quot; style=&quot;display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #e67e22; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;&quot;&gt;Learn More&lt;/a&gt;\r\n&lt;/div&gt;', 'Unity_post_img_1724003759_9949.jpg', 2, '2024-08-18 19:55:59', 0),
(26, 'Join a Thriving Academic Community', '&lt;div style=&quot;max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);&quot;&gt;\r\n    &lt;h1 style=&quot;font-size: 2em; color: #2c3e50; margin-bottom: 10px;&quot;&gt;Join a Thriving Academic Community&lt;/h1&gt;\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vitae risus quam. Praesent quis justo ut nisl iaculis vulputate. Aenean vitae justo quis purus venenatis facilisis et id turpis. Nulla ac nulla vitae quam tempor congue. Curabitur euismod dolor id massa laoreet, sed fermentum erat bibendum.&lt;/p&gt;\r\n    \r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Why Join Us?&lt;/p&gt;\r\n    &lt;ul style=&quot;list-style-type: disc; margin-left: 20px; margin-bottom: 15px;&quot;&gt;\r\n        &lt;li&gt;Extensive alumni network for global opportunities&lt;/li&gt;\r\n        &lt;li&gt;Vibrant campus life with diverse extracurricular activities&lt;/li&gt;\r\n        &lt;li&gt;Personalized academic advising and support&lt;/li&gt;\r\n        &lt;li&gt;Comprehensive career services and internships&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Etiam ac erat suscipit, volutpat eros id, ultricies nulla. In ac magna ex. Cras vulputate sapien ac lorem vulputate, at lobortis nunc vulputate. Aliquam erat volutpat. Nunc varius eros id ligula aliquam, sed posuere orci gravida.&lt;/p&gt;\r\n    \r\n    &lt;a href=&quot;#&quot; style=&quot;display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #2ecc71; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;&quot;&gt;Get Started&lt;/a&gt;\r\n&lt;/div&gt;', 'Unity_post_img_1724003812_4035.jpg', 2, '2024-08-18 19:56:52', 1),
(27, 'Admissions Open at Unity Girls College, Birnin Kebbi', '&lt;div style=&quot;max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);&quot;&gt;\r\n    &lt;h1 style=&quot;font-size: 2em; color: #2c3e50; margin-bottom: 10px;&quot;&gt;Admissions Open at Unity Girls College, Birnin Kebbi!&lt;/h1&gt;\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Unity Girls College, Birnin Kebbi, invites ambitious young women to join our vibrant academic community. Our mission is to empower girls through quality education, fostering the next generation of leaders, innovators, and change-makers.&lt;/p&gt;\r\n    \r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Why Unity Girls College?&lt;/p&gt;\r\n    &lt;ul style=&quot;list-style-type: disc; margin-left: 20px; margin-bottom: 15px;&quot;&gt;\r\n        &lt;li&gt;High academic standards with a focus on excellence&lt;/li&gt;\r\n        &lt;li&gt;Safe and supportive learning environment&lt;/li&gt;\r\n        &lt;li&gt;Experienced faculty committed to student success&lt;/li&gt;\r\n        &lt;li&gt;Diverse extracurricular programs that build character and leadership&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Join us at Unity Girls College, where education goes beyond the classroom. Our holistic approach ensures that each student not only excels academically but also develops the skills needed to thrive in the world.&lt;/p&gt;\r\n    \r\n    &lt;a href=&quot;#&quot; style=&quot;display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;&quot;&gt;Apply Now&lt;/a&gt;\r\n&lt;/div&gt;', 'Unity_post_img_1724005258_9224.jpg', 2, '2024-08-18 20:20:58', 1),
(28, 'Empowering the Next Generation of Female Leaders html', '&lt;div style=&quot;max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);&quot;&gt;\r\n    &lt;h1 style=&quot;font-size: 2em; color: #2c3e50; margin-bottom: 10px;&quot;&gt;Empowering the Next Generation of Female Leaders&lt;/h1&gt;\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;At Unity Girls College, Birnin Kebbi, we believe in nurturing the potential of every student. Our tailored curriculum and dedicated staff ensure that each girl develops the confidence and skills to lead in her chosen field.&lt;/p&gt;\r\n    \r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Why Choose Us?&lt;/p&gt;\r\n    &lt;ul style=&quot;list-style-type: disc; margin-left: 20px; margin-bottom: 15px;&quot;&gt;\r\n        &lt;li&gt;Leadership programs that inspire and empower&lt;/li&gt;\r\n        &lt;li&gt;Comprehensive academic and personal development support&lt;/li&gt;\r\n        &lt;li&gt;Access to state-of-the-art learning resources&lt;/li&gt;\r\n        &lt;li&gt;Engaging community service and outreach initiatives&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Our commitment to excellence goes beyond academics. We strive to create a nurturing environment where girls can grow, excel, and make a positive impact on the world.&lt;/p&gt;\r\n    \r\n    &lt;a href=&quot;#&quot; style=&quot;display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #27ae60; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;&quot;&gt;Learn More&lt;/a&gt;\r\n&lt;/div&gt;', 'Unity_post_img_1724005363_7050.jpg', 2, '2024-08-18 20:22:43', 1),
(29, 'A Tradition of Excellence in Education', '&lt;div style=&quot;max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);&quot;&gt;\r\n    &lt;h1 style=&quot;font-size: 2em; color: #2c3e50; margin-bottom: 10px;&quot;&gt;A Tradition of Excellence in Education&lt;/h1&gt;\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Unity Girls College, Birnin Kebbi, is proud of its longstanding tradition of academic excellence. Our students consistently achieve outstanding results, paving the way for bright futures in higher education and beyond.&lt;/p&gt;\r\n    \r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Highlights:&lt;/p&gt;\r\n    &lt;ul style=&quot;list-style-type: disc; margin-left: 20px; margin-bottom: 15px;&quot;&gt;\r\n        &lt;li&gt;Experienced and passionate educators&lt;/li&gt;\r\n        &lt;li&gt;Strong emphasis on science, technology, and the arts&lt;/li&gt;\r\n        &lt;li&gt;Comprehensive guidance and counseling services&lt;/li&gt;\r\n        &lt;li&gt;Supportive and inclusive school culture&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Join us at Unity Girls College, where your academic journey is supported every step of the way, ensuring that you reach your fullest potential.&lt;/p&gt;\r\n    \r\n    &lt;a href=&quot;#&quot; style=&quot;display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;&quot;&gt;Apply Now&lt;/a&gt;\r\n&lt;/div&gt;', 'Unity_post_img_1724005405_7967.jpg', 2, '2024-08-18 20:23:25', 0),
(30, 'Building a Bright Future for Every Girl', '&lt;div style=&quot;max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);&quot;&gt;\r\n    &lt;h1 style=&quot;font-size: 2em; color: #2c3e50; margin-bottom: 10px;&quot;&gt;Building a Bright Future for Every Girl&lt;/h1&gt;\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;At Unity Girls College, Birnin Kebbi, we are dedicated to building a bright and successful future for every student. Our comprehensive programs are designed to equip girls with the knowledge, skills, and values they need to thrive in today’s world.&lt;/p&gt;\r\n    \r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Our Offerings:&lt;/p&gt;\r\n    &lt;ul style=&quot;list-style-type: disc; margin-left: 20px; margin-bottom: 15px;&quot;&gt;\r\n        &lt;li&gt;Holistic education that nurtures mind, body, and spirit&lt;/li&gt;\r\n        &lt;li&gt;Rich extracurricular activities to develop diverse talents&lt;/li&gt;\r\n        &lt;li&gt;Strong focus on moral and ethical development&lt;/li&gt;\r\n        &lt;li&gt;Partnerships with leading organizations for real-world experience&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Our students graduate with confidence, ready to take on challenges and make a positive difference in their communities and beyond.&lt;/p&gt;\r\n    \r\n    &lt;a href=&quot;#&quot; style=&quot;display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #8e44ad; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;&quot;&gt;Join Us Today&lt;/a&gt;\r\n&lt;/div&gt;', 'Unity_post_img_1724005450_5414.jpg', 2, '2024-08-18 20:24:10', 0),
(31, 'Where Education Meets Inspiration', '&lt;div style=&quot;max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);&quot;&gt;\r\n    &lt;h1 style=&quot;font-size: 2em; color: #2c3e50; margin-bottom: 10px;&quot;&gt;Where Education Meets Inspiration&lt;/h1&gt;\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Unity Girls College, Birnin Kebbi, is more than just a school—it’s a place where girls are inspired to dream big and achieve their goals. Our innovative teaching methods and supportive environment encourage creativity, critical thinking, and a lifelong love of learning.&lt;/p&gt;\r\n    \r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;What Sets Us Apart:&lt;/p&gt;\r\n    &lt;ul style=&quot;list-style-type: disc; margin-left: 20px; margin-bottom: 15px;&quot;&gt;\r\n        &lt;li&gt;Interactive and engaging classroom experiences&lt;/li&gt;\r\n        &lt;li&gt;Focus on creativity, innovation, and problem-solving&lt;/li&gt;\r\n        &lt;li&gt;Opportunities for leadership and personal growth&lt;/li&gt;\r\n        &lt;li&gt;Inclusive community that celebrates diversity&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Discover a school where education is more than just academics—where it’s about inspiring the leaders and innovators of tomorrow.&lt;/p&gt;\r\n    \r\n    &lt;a href=&quot;#&quot; style=&quot;display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #16a085; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;&quot;&gt;Explore Now&lt;/a&gt;\r\n&lt;/div&gt;', 'Unity_post_img_1724005490_5913.jpg', 2, '2024-08-18 20:24:50', 0),
(32, 'A Pathway to Success for Every Student', '&lt;div style=&quot;max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);&quot;&gt;\r\n    &lt;h1 style=&quot;font-size: 2em; color: #2c3e50; margin-bottom: 10px;&quot;&gt;A Pathway to Success for Every Student&lt;/h1&gt;\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Unity Girls College, Birnin Kebbi, is dedicated to guiding each student on a path to success. With a focus on academic excellence, personal development, and community engagement, our students are prepared to achieve their dreams and make a difference.&lt;/p&gt;\r\n    \r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;Why Unity Girls College?&lt;/p&gt;\r\n    &lt;ul style=&quot;list-style-type: disc; margin-left: 20px; margin-bottom: 15px;&quot;&gt;\r\n        &lt;li&gt;Rigorous academic programs that challenge and inspire&lt;/li&gt;\r\n        &lt;li&gt;Personalized learning experiences tailored to each student’s needs&lt;/li&gt;\r\n        &lt;li&gt;Strong emphasis on character building and ethics&lt;/li&gt;\r\n        &lt;li&gt;Supportive environment that fosters collaboration and teamwork&lt;/li&gt;\r\n    &lt;/ul&gt;\r\n\r\n    &lt;p style=&quot;margin-bottom: 15px;&quot;&gt;At Unity Girls College, we believe every girl has the potential to succeed. Our mission is to provide the education, tools, and encouragement needed to turn that potential into reality.&lt;/p&gt;\r\n    \r\n    &lt;a href=&quot;#&quot; style=&quot;display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #2980b9; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;&quot;&gt;Start Your Journey&lt;/a&gt;\r\n&lt;/div&gt;', 'Unity_post_img_1724005527_4114.jpg', 2, '2024-08-18 20:25:27', 0);

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
(1, '-726500.00', '0.00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `candidate_contact_details`
--
ALTER TABLE `candidate_contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `candidate_personal_info`
--
ALTER TABLE `candidate_personal_info`
  MODIFY `can_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
