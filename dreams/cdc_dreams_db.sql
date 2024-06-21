-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 20, 2024 at 01:35 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cdc_dreams_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

DROP TABLE IF EXISTS `app_users`;
CREATE TABLE IF NOT EXISTS `app_users` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'Customer',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `profile_created` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `username`, `email`, `password`, `role`, `approved`, `profile_created`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@mail.com', '$2y$10$ebFCDcRaZphg6ViP4Dcd1.JkGG5kZ9UvbFXKKFcCQGi9jQ5qcB2XO', 'Administrator', 0, 1, '2024-06-17 18:52:26', '2024-06-17 18:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `education_materials`
--

DROP TABLE IF EXISTS `education_materials`;
CREATE TABLE IF NOT EXISTS `education_materials` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `material_name` varchar(50) NOT NULL,
  `target_age_group` varchar(20) NOT NULL,
  `distribution_date` date NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `return_date` varchar(20) DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education_materials`
--

INSERT INTO `education_materials` (`id`, `material_name`, `target_age_group`, `distribution_date`, `status`, `return_date`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'HIV Awareness Fliers', '10-14yrs', '2024-06-21', 'given-out', '', 'These fliers have information necessary to guide participants on how to avoid HIV.', '2024-06-20 12:26:52', '2024-06-20 12:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `encounters`
--

DROP TABLE IF EXISTS `encounters`;
CREATE TABLE IF NOT EXISTS `encounters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participant_id` int(50) NOT NULL,
  `date` date NOT NULL,
  `event_id` int(11) NOT NULL,
  `lessons_attended` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `service` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `encounters`
--

INSERT INTO `encounters` (`id`, `participant_id`, `date`, `event_id`, `lessons_attended`, `material_id`, `service`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-06-20', 2, 1, 1, 'Hive Testing and Councelling.', '2024-06-20 13:02:14', '2024-06-20 13:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `type` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `learning_outcomes` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `type`, `title`, `description`, `learning_outcomes`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'Educational Workshop.', ' HIV Prevention and Awareness Workshop', '<p>HIV Prevention and Awareness Workshop.</p>', '<ul><li>Increase awareness about HIV transmission and prevention.</li><li>Educate participants on the importance of safe practices.</li><li>Provide resources for further information and support against HIV.</li></ul>', '2024-07-01', '2024-07-02', '2024-06-18 15:42:12', '2024-06-19 18:28:00'),
(2, 'Awareness Campaign', 'HIV/AIDS Awareness and Prevention', '<p>An awareness campaign to educate participants about HIV/AIDS prevention, treatment options, and reducing stigma.</p>', '<ul><li>Understand HIV transmission and prevention methods.</li><li>Learn about treatment options and support services.</li><li>Increase awareness and reduce stigma associated with HIV/AIDS.</li></ul>', '2024-10-15', '2024-10-16', '2024-06-18 15:46:33', '2024-06-18 15:46:33'),
(3, 'Training Session', 'Skills for the Future', '<p>A training session that provides hands-on experience in various vocational skills such as sewing, cooking, and basic computer skills.</p>', '<ul><li>Acquire basic sewing skills.</li><li>Learn cooking techniques and recipes.</li><li>Gain fundamental computer skills.</li></ul>', '2024-09-01', '2024-09-03', '2024-06-18 15:48:34', '2024-06-19 17:15:19'),
(4, 'Seminar', 'Health and Wellness for Adolescents', '<p>A seminar focused on promoting health and wellness among adolescent girls, covering topics such as hygiene, nutrition, and mental health.</p>', '<ul><li>Learn about proper hygiene practices.</li><li>Understand the basics of nutrition and its importance.</li><li>Gain insights into maintaining mental health and well-being.</li></ul>', '2024-08-05', '2024-08-06', '2024-06-18 15:50:30', '2024-06-18 15:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE IF NOT EXISTS `lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_name` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `lesson_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'HIV Prevention Basics.', '<p><strong>Description:</strong> This lesson covers the fundamental concepts of HIV, including transmission methods, prevention strategies, and the importance of safe practices. Participants will learn how to protect themselves and others from HIV infection.</p>', '2024-06-18 11:49:59', '2024-06-19 18:49:59'),
(2, 'Life Skills Development..', '<p><strong>Description:</strong> This lesson focuses on building essential life skills such as communication, decision-making, problem-solving, and critical thinking. These skills help participants navigate daily challenges and make informed decisions..</p>', '2024-06-18 11:57:39', '2024-06-20 13:17:44'),
(3, 'Financial Literacy.', '<p><strong>Description:</strong> This lesson introduces basic financial concepts, including budgeting, saving, and managing money. Participants will learn how to plan for their financial future and make sound financial decisions.</p>', '2024-06-18 11:58:25', '2024-06-19 18:50:19'),
(4, 'Health and Nutrition.', '<p><strong>Description:</strong> This lesson provides information on maintaining a healthy lifestyle through proper nutrition, exercise, and regular medical check-ups. Participants will understand the importance of a balanced diet and physical activity for overall well-being.</p>', '2024-06-18 11:59:03', '2024-06-19 18:50:34'),
(5, 'Digital Literacy.', '<p><strong>Description:</strong> This lesson aims to equip participants with essential digital skills, including using computers, navigating the internet safely, and understanding basic software applications. Participants will gain confidence in using technology for education and personal growth.</p>', '2024-06-18 11:59:51', '2024-06-19 18:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `paticipant`
--

DROP TABLE IF EXISTS `paticipant`;
CREATE TABLE IF NOT EXISTS `paticipant` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `district` varchar(250) NOT NULL,
  `county` varchar(50) NOT NULL,
  `subcounty` varchar(50) NOT NULL,
  `village` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `age_group` varchar(50) NOT NULL,
  `hiv_status` enum('negative','positive') NOT NULL,
  `schooling_status` enum('schooling','not-schooling') NOT NULL,
  `enrolled` enum('enrolled','not-enrolled') NOT NULL DEFAULT 'enrolled',
  `creared_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paticipant`
--

INSERT INTO `paticipant` (`id`, `name`, `gender`, `district`, `county`, `subcounty`, `village`, `dob`, `age_group`, `hiv_status`, `schooling_status`, `enrolled`, `creared_at`, `updated_at`) VALUES
(1, 'Murungi Paul', 'Male', 'Kabarole', 'Burahya', 'Busoro', 'Kasiisi', '2006-06-08', '15-19 yrs', 'positive', 'schooling', 'enrolled', '2024-06-18 10:02:46', '2024-06-20 10:37:43'),
(2, 'Mugasa Evelyne', 'Female', 'Kabarole', 'Burahya', 'Ruteete', 'Kyangabukama', '2008-06-18', '15-19 yrs', 'negative', 'not-schooling', 'enrolled', '2024-06-18 10:05:27', '2024-06-20 10:07:09'),
(3, 'Mugabe Ambrose', 'Male', 'Kabarole', 'East Division', 'East Division', 'Harukoto', '2005-09-08', '15-19 yrs', 'negative', 'schooling', 'enrolled', '2024-06-19 16:07:03', '2024-06-20 10:09:17'),
(4, 'Asiimwe Penina', 'Female', 'Kabarole', 'Burahya', 'Ruteete', 'Kigarama', '2009-06-11', '15-19 yrs', 'negative', 'schooling', 'enrolled', '2024-06-20 09:03:14', '2024-06-20 10:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

DROP TABLE IF EXISTS `progress`;
CREATE TABLE IF NOT EXISTS `progress` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `participant_id` int(50) NOT NULL,
  `event_id` int(50) NOT NULL,
  `lesson_attended` int(50) NOT NULL,
  `skills_attained` text NOT NULL,
  `hiv_status_check` enum('positive','negative') NOT NULL,
  `self_sufficiency_check` enum('allowed','not-allowed') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `participant_id`, `event_id`, `lesson_attended`, `skills_attained`, `hiv_status_check`, `self_sufficiency_check`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '<p>Test</p>', 'negative', 'allowed', '2024-06-19 12:53:28', '2024-06-19 12:53:28'),
(2, 1, 2, 1, '<p>Test</p>', 'positive', 'not-allowed', '2024-06-19 14:09:08', '2024-06-19 14:09:08'),
(3, 3, 1, 1, '<p>Test skills</p><p><br></p>', 'negative', 'allowed', '2024-06-19 16:09:34', '2024-06-19 16:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `nin` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `about` text,
  `company` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `image_url` text NOT NULL,
  `district` varchar(100) NOT NULL,
  `village` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nin` (`nin`),
  KEY `user_profile_ibfk_1` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `name`, `nin`, `dob`, `gender`, `about`, `company`, `job`, `country`, `phone`, `image_url`, `district`, `village`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Administrator', 'CM2301000FLSAD', '1980-02-06', 'male', '', 'MOELS GROUP', 'Self Employed', 'Uganda', '0764165464', 'http://localhost/dreams/uploads/images/6670864fe0f5f.jpg', 'Kabarole', 'Rwengoma', '2024-06-17 21:55:03', '2024-06-17 21:55:03', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
