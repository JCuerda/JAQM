-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for jaqm_db
CREATE DATABASE IF NOT EXISTS `jaqm_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `jaqm_db`;

-- Dumping structure for table jaqm_db.tbl_administrator
CREATE TABLE IF NOT EXISTS `tbl_administrator` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_administrator: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_administrator` DISABLE KEYS */;
REPLACE INTO `tbl_administrator` (`username`, `password`, `role`) VALUES
	('administrator', '$2y$10$t7wPDvi8BG/DqNXt0FOJH.Gmor4fmLQSGCzqKBAl8SzPa7w10jjMq', 'Administrator');
/*!40000 ALTER TABLE `tbl_administrator` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_applicants
CREATE TABLE IF NOT EXISTS `tbl_applicants` (
  `id` varchar(10) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(40) NOT NULL DEFAULT 'Applicant',
  `is_verified` enum('Y','N') DEFAULT 'N',
  `date_registered` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  CONSTRAINT `FK_tbl_applicant_tbl_applicant_detail` FOREIGN KEY (`id`) REFERENCES `tbl_applicant_details` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_applicants: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_applicants` DISABLE KEYS */;
REPLACE INTO `tbl_applicants` (`id`, `username`, `password`, `role`, `is_verified`, `date_registered`) VALUES
	('2BMKVWUYEG', 'dt_valkyrie@ymail.com', '$2y$10$ToByASwzzdBkZ1FmSp.8rOrg2DUaTWPFrtXuTtu3EziH1fX88IQX6', 'Applicant', 'N', '2019-02-01 16:31:35'),
	('2S3AN7IQPJ', 'jacksantos@yahoo.com', '$2y$10$x4//6XU.2BNUni55JjD5p.KkpcaCYZmcO9W/mvjEw2USb3Yqg.00O', 'Applicant', 'N', '2019-02-24 17:44:26'),
	('91NR4POSTE', 'damon_salvatore@yahoo.com', '$2y$10$iTxLvRFKtng3z671lgINM.xGU6.7jFppoSQt1ovsxDr0rfTk4nfnq', 'Applicant', 'N', '2019-02-01 17:23:41'),
	('BSKXBPOHRY', 'santos.jack2017@yahoo.com', '$2y$10$ToByASwzzdBkZ1FmSp.8rOrg2DUaTWPFrtXuTtu3EziH1fX88IQX6', 'Applicant', 'N', '2019-02-01 16:01:04'),
	('VXPDHGRVT1', 'salvatore.damon@yahoo.com', '$2y$10$ToByASwzzdBkZ1FmSp.8rOrg2DUaTWPFrtXuTtu3EziH1fX88IQX6', 'Applicant', 'N', '2019-02-07 06:40:50');
/*!40000 ALTER TABLE `tbl_applicants` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_applicant_details
CREATE TABLE IF NOT EXISTS `tbl_applicant_details` (
  `id` varchar(10) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `prim_educ` varchar(100) DEFAULT NULL,
  `sec_educ` varchar(100) DEFAULT NULL,
  `ter_educ` varchar(100) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `aq_id` varchar(10),
  `email_address` varchar(50) NOT NULL,
  `verification_code` varchar(255) DEFAULT NULL,
  `contact_number` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aq_id` (`aq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_applicant_details: ~7 rows (approximately)
/*!40000 ALTER TABLE `tbl_applicant_details` DISABLE KEYS */;
REPLACE INTO `tbl_applicant_details` (`id`, `first_name`, `last_name`, `middle_name`, `prim_educ`, `sec_educ`, `ter_educ`, `course`, `aq_id`, `email_address`, `verification_code`, `contact_number`, `address`, `resume`) VALUES
	('0VOAVNYTGH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test@test.com', NULL, NULL, NULL, NULL),
	('2BMKVWUYEG', 'Kobe', 'Bryant', 'Bean', NULL, NULL, NULL, NULL, 'TVEGR8Y13H', 'dt_valkyrie@ymail.com', NULL, '09876534212', 'Los Angeles, California', NULL),
	('2S3AN7IQPJ', 'Damon', 'Alcantara', 'Salvatore', NULL, NULL, NULL, NULL, 'BAQC9CPXKI', 'jacksantos@yahoo.com', NULL, '09871232314', 'Makati City', NULL),
	('91NR4POSTE', 'Damon', 'Salvador', 'Siegfried', 'Tangos Elementary School', 'Malabon National Highschool', 'Interface Computer College', 'BSIT', 'S4LV4T0R3S', 'damon_salvatore@yahoo.com', '', '09554166080', 'Manila City', 'f89a88ab4de774ffd2a1c59987f2ef35.pdf'),
	('BSKXBPOHRY', 'Jackie', 'Chan', 'Santos', NULL, NULL, NULL, NULL, 'YBGQNJMXZC', 'santos.jack2017@yahoo.com', NULL, '09673452312', 'Manila City', NULL),
	('KB24JACKSS', 'Jack', 'Santos', 'Mozart', 'Tangos Elementary School', 'Malabon National High School', 'Interface Computer College', 'BSIT', 'VGSIN47U0Q', 'jack@santos', '', '09554321234', 'Manila City', NULL),
	('VXPDHGRVT1', 'Damon', 'Salvatore', 'Philip', 'Some Elementary School II', 'Some High School II', 'Some University II', '', 'WELC5TDYND', 'salvatore.damon@yahoo.com', NULL, '89123423228', 'Pennsylvania', NULL);
/*!40000 ALTER TABLE `tbl_applicant_details` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_applicant_favorite_jobs
CREATE TABLE IF NOT EXISTS `tbl_applicant_favorite_jobs` (
  `applicant_id` varchar(10) NOT NULL,
  `job_id` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`applicant_id`,`job_id`),
  KEY `FK_tbl_applicant_favorite_jobs_tbl_jobs` (`job_id`),
  CONSTRAINT `FK_tbl_applicant_favorite_jobs_tbl_applicant_details` FOREIGN KEY (`applicant_id`) REFERENCES `tbl_applicant_details` (`id`),
  CONSTRAINT `FK_tbl_applicant_favorite_jobs_tbl_jobs` FOREIGN KEY (`job_id`) REFERENCES `tbl_jobs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_applicant_favorite_jobs: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_applicant_favorite_jobs` DISABLE KEYS */;
REPLACE INTO `tbl_applicant_favorite_jobs` (`applicant_id`, `job_id`, `date_added`) VALUES
	('91NR4POSTE', 'I0PWFFMDCU', '2019-02-03 22:45:45'),
	('91NR4POSTE', 'ISK29TCOW7', '2019-02-14 15:57:22'),
	('91NR4POSTE', 'OPO3QHAM5Z', '2019-02-04 10:16:45');
/*!40000 ALTER TABLE `tbl_applicant_favorite_jobs` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_applicant_qualifications
CREATE TABLE IF NOT EXISTS `tbl_applicant_qualifications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aq_id` varchar(10) NOT NULL,
  `qualification_id` varchar(10) NOT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_applicant_qualification_tbl_applicant_detail` (`aq_id`),
  KEY `FK_tbl_applicant_qualification_tbl_qualification_type` (`type`),
  CONSTRAINT `FK_tbl_applicant_qualification_tbl_applicant_detail` FOREIGN KEY (`aq_id`) REFERENCES `tbl_applicant_details` (`aq_id`),
  CONSTRAINT `FK_tbl_applicant_qualification_tbl_qualification_type` FOREIGN KEY (`type`) REFERENCES `tbl_qualification_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_applicant_qualifications: ~19 rows (approximately)
/*!40000 ALTER TABLE `tbl_applicant_qualifications` DISABLE KEYS */;
REPLACE INTO `tbl_applicant_qualifications` (`id`, `aq_id`, `qualification_id`, `type`) VALUES
	(1, 'S4LV4T0R3S', 'IT-S', 1),
	(4, 'S4LV4T0R3S', 'CSIT', 2),
	(5, 'S4LV4T0R3S', '3', 3),
	(21, 'VGSIN47U0Q', 'IT-S', 1),
	(22, 'VGSIN47U0Q', 'CSIT', 2),
	(23, 'VGSIN47U0Q', '3', 3),
	(24, 'WELC5TDYND', 'HC-P', 1),
	(25, 'WELC5TDYND', 'HC', 2),
	(26, 'WELC5TDYND', '4', 3),
	(27, 'BAQC9CPXKI', 'IT-S', 1),
	(28, 'BAQC9CPXKI', 'CSIT', 2),
	(29, 'BAQC9CPXKI', '3', 3),
	(30, 'BAQC9CPXKI', '1', 4),
	(31, 'BAQC9CPXKI', '1', 6),
	(32, 'TVEGR8Y13H', 'IT-S', 1),
	(33, 'TVEGR8Y13H', 'CSIT', 2),
	(34, 'TVEGR8Y13H', '3', 3),
	(35, 'TVEGR8Y13H', '1', 4),
	(36, 'TVEGR8Y13H', '1', 6);
/*!40000 ALTER TABLE `tbl_applicant_qualifications` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_company
CREATE TABLE IF NOT EXISTS `tbl_company` (
  `id` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Employer',
  `is_verified` enum('Y','N') NOT NULL DEFAULT 'N',
  `date_registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_company: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_company` DISABLE KEYS */;
REPLACE INTO `tbl_company` (`id`, `username`, `password`, `role`, `is_verified`, `date_registered`) VALUES
	('LOSC0HRAWQ', 'dlc.juan13@gmail.com', '$2y$10$iTxLvRFKtng3z671lgINM.xGU6.7jFppoSQt1ovsxDr0rfTk4nfnq', 'Employer', 'Y', '2019-03-01 10:44:44'),
	('TUS0BCJ9OM', 'jasonylanan58@gmail.com', '$2y$10$M7vfEGhm1NtefQxtZVAVIOTKInDWlvBkloxNvpJDLMANIGYvoTYu6', 'Employer', 'Y', '2019-02-18 13:37:37'),
	('V83PFO1ZYT', 'blue.mr0307@gmail.com', '$2y$10$Ng13cF/8o142/syfKbJZe.u1xy51U4Is9ASb80GQlc2t.XsOoxjY2', 'Employer', 'Y', '2019-02-10 10:06:38'),
	('YW4HATNDOW', 'jessie13th@gmail.com', '$2y$10$NL4tlaFKAyc8j14vkiMgAOTjUc6tTq0PVlRtk5GUSDusL7JcbYOtO', 'Employer', 'Y', '2019-02-16 15:27:45');
/*!40000 ALTER TABLE `tbl_company` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_company_details
CREATE TABLE IF NOT EXISTS `tbl_company_details` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `subscription_type` int(2) NOT NULL,
  `ads_position` int(5) DEFAULT '0',
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_registered` datetime DEFAULT CURRENT_TIMESTAMP,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_company_details_tbl_subscription_types` (`subscription_type`),
  CONSTRAINT `FK_tbl_company_details_tbl_subscription_types` FOREIGN KEY (`subscription_type`) REFERENCES `tbl_subscription_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_company_details: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_company_details` DISABLE KEYS */;
REPLACE INTO `tbl_company_details` (`id`, `name`, `description`, `address`, `contact_number`, `verification_code`, `subscription_type`, `ads_position`, `is_active`, `date_registered`, `logo`) VALUES
	('JQINC', 'JQ Incorporated', '<p><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;"><strong>MISSION</strong></span></p><p style="padding-left: 30px;" data-mce-style="padding-left: 30px;"><em>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio nihil corrupti quo ex voluptas similique debitis dolores, reprehenderit, sequi animi molestias. Ad ab debitis doloribus dolores quis, non necessitatibus totam?</em></p><p><span style="color: #000000;" data-mce-style="color: #000000;" mce-data-marked="1"><strong>VISION</strong></span></p><p style="padding-left: 30px;" data-mce-style="padding-left: 30px;"><em>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio nihil corrupti quo ex voluptas similique debitis dolores, reprehenderit, sequi animi molestias. Ad ab debitis doloribus dolores quis, non necessitatibus totam?</em></p>', 'Manila City', '12345678901', '', 1, 5, 'Y', '2019-01-11 15:48:53', NULL),
	('LOSC0HRAWQ', 'Deltek Incorporated', '<p>SOME COMPANY DESCRIPTION!!</p>', 'Makati City', '09765641232', 'LOSC0HRAWQ7073f4495b316a25573c67e42b0f163d', 1, 2, 'Y', '2019-03-01 10:44:44', NULL),
	('TUS0BCJ9OM', '', '', '', '', 'TUS0BCJ9OMb8adf50c622ead8d99ddb64a86cc58ae', 2, 1, 'Y', '2019-02-18 13:37:37', NULL),
	('V83PFO1ZYT', '', '', '', '', 'V83PFO1ZYT1aec9a0f046745a3cf4b34d27f4af21d', 1, 4, 'Y', '2019-02-10 10:06:38', 'e18198320c83ac44125074610c7c48e9.jpg'),
	('YW4HATNDOW', '', '', '', '', 'YW4HATNDOW743aaf10c3aa3cef47a79252d0718334', 3, 3, 'Y', '2019-02-16 15:27:46', NULL);
/*!40000 ALTER TABLE `tbl_company_details` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_company_job_applicants
CREATE TABLE IF NOT EXISTS `tbl_company_job_applicants` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(20) NOT NULL,
  `job_id` varchar(10) NOT NULL,
  `applicant_id` varchar(10) NOT NULL,
  `date_applied` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(30) DEFAULT 'Waiting',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_company_job_applicant_tbl_company_detail` (`company_id`),
  KEY `FK_tbl_company_job_applicant_tbl_job` (`job_id`),
  KEY `FK_tbl_company_job_applicant_tbl_applicant_detail` (`applicant_id`),
  CONSTRAINT `FK_tbl_company_job_applicant_tbl_applicant_detail` FOREIGN KEY (`applicant_id`) REFERENCES `tbl_applicant_details` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_company_job_applicant_tbl_company_detail` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_details` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_company_job_applicant_tbl_job` FOREIGN KEY (`job_id`) REFERENCES `tbl_jobs` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_company_job_applicants: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_company_job_applicants` DISABLE KEYS */;
REPLACE INTO `tbl_company_job_applicants` (`id`, `company_id`, `job_id`, `applicant_id`, `date_applied`, `status`) VALUES
	(1, 'JQINC', 'KSPTORK32J', '91NR4POSTE', '2019-01-22 01:13:23', 'Waiting'),
	(3, 'JQINC', 'OPO3QHAM5Z', 'KB24JACKSS', '2019-01-23 21:18:22', 'Waiting'),
	(4, 'V83PFO1ZYT', 'ISK29TCOW7', '91NR4POSTE', '2019-02-14 16:10:35', 'Waiting');
/*!40000 ALTER TABLE `tbl_company_job_applicants` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_company_qualifications
CREATE TABLE IF NOT EXISTS `tbl_company_qualifications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `jq_id` varchar(10) NOT NULL,
  `qualification_id` varchar(50) NOT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_company_qualification_tbl_qualification_type` (`type`),
  KEY `FK_tbl_company_qualification_tbl_job` (`jq_id`),
  CONSTRAINT `FK_tbl_company_qualification_tbl_job` FOREIGN KEY (`jq_id`) REFERENCES `tbl_jobs` (`jq_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_company_qualification_tbl_qualification_type` FOREIGN KEY (`type`) REFERENCES `tbl_qualification_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_company_qualifications: ~42 rows (approximately)
/*!40000 ALTER TABLE `tbl_company_qualifications` DISABLE KEYS */;
REPLACE INTO `tbl_company_qualifications` (`id`, `jq_id`, `qualification_id`, `type`) VALUES
	(1, 'TUSAXVMSKD', 'IT-S', 1),
	(2, 'TUSAXVMSKD', 'CSIT', 2),
	(5, 'TUSAXVMSKD', '3', 3),
	(6, 'AKICSIDJFI', 'IT-S', 1),
	(7, 'AKICSIDJFI', 'CSIT', 2),
	(8, 'AKICSIDJFI', '4', 3),
	(9, 'ACJSIFSSF2', 'HC-P', 1),
	(10, 'ACJSIFSSF2', '5', 3),
	(11, 'ACJSIFSSF2', 'HC', 2),
	(12, 'FUPRLAH5CY', 'IT-S', 1),
	(13, 'FUPRLAH5CY', 'CSIT', 2),
	(14, 'FUPRLAH5CY', '3', 3),
	(17, 'HF3DX2WPUT', 'HC-P', 1),
	(18, 'HF3DX2WPUT', 'HC', 2),
	(19, 'HF3DX2WPUT', '5', 3),
	(23, 'ADBWQULPWS', 'IT-N', 1),
	(24, 'ADBWQULPWS', 'CSIT', 2),
	(25, 'ADBWQULPWS', '2', 3),
	(32, 'XH4SKWV5GP', 'IT-H', 1),
	(33, 'XH4SKWV5GP', 'CSIT', 2),
	(34, 'XH4SKWV5GP', '1', 3),
	(47, 'JX7N5ZPHFI', 'IT-S', 1),
	(48, 'JX7N5ZPHFI', 'CSIT', 2),
	(49, 'JX7N5ZPHFI', '3', 3),
	(50, 'AG4JVMM3IF', 'HC-P', 1),
	(51, 'AG4JVMM3IF', 'HC', 2),
	(52, 'AG4JVMM3IF', '3', 3),
	(56, 'IYRLMPAN93', 'IT-S', 1),
	(57, 'IYRLMPAN93', 'CSIT', 2),
	(58, 'IYRLMPAN93', '3', 3),
	(59, 'IYRLMPAN93', '6', 4),
	(60, 'IYRLMPAN93', '5', 6),
	(71, 'BZ5XYJL8VT', 'IT-S', 1),
	(72, 'BZ5XYJL8VT', 'CSIT', 2),
	(73, 'BZ5XYJL8VT', '3', 3),
	(74, 'BZ5XYJL8VT', '1', 4),
	(75, 'BZ5XYJL8VT', '1', 6),
	(76, 'YKOPLTN6X9', 'IT-S', 1),
	(77, 'YKOPLTN6X9', 'CSIT', 2),
	(78, 'YKOPLTN6X9', '3', 3),
	(79, 'YKOPLTN6X9', '1', 4),
	(80, 'YKOPLTN6X9', '2', 6);
/*!40000 ALTER TABLE `tbl_company_qualifications` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_degree_levels
CREATE TABLE IF NOT EXISTS `tbl_degree_levels` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_degree_levels: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_degree_levels` DISABLE KEYS */;
REPLACE INTO `tbl_degree_levels` (`id`, `description`) VALUES
	(1, 'High School Diploma'),
	(2, 'Vocational Diploman / Short Course Certificate'),
	(3, 'Bachelor\'s / College Degree'),
	(4, 'Post Graduate Diploma / Master\'s Degree'),
	(5, 'Professional License (Passed Board / Bar / Professional License Exam) Doctorate Degree');
/*!40000 ALTER TABLE `tbl_degree_levels` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_field_of_studies
CREATE TABLE IF NOT EXISTS `tbl_field_of_studies` (
  `id` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_field_of_studies: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_field_of_studies` DISABLE KEYS */;
REPLACE INTO `tbl_field_of_studies` (`id`, `description`) VALUES
	('COM', 'Commerce'),
	('CSIT', 'Computer Science and Information Technology'),
	('HC', 'Health Care');
/*!40000 ALTER TABLE `tbl_field_of_studies` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_jobs
CREATE TABLE IF NOT EXISTS `tbl_jobs` (
  `id` varchar(20) NOT NULL,
  `company_id` varchar(20),
  `jq_id` varchar(10),
  `title` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `date_posted` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_available` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jq_id` (`jq_id`),
  KEY `FK_tbl_job_tbl_company_detail` (`company_id`),
  CONSTRAINT `FK_tbl_job_tbl_company_detail` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_jobs: ~12 rows (approximately)
/*!40000 ALTER TABLE `tbl_jobs` DISABLE KEYS */;
REPLACE INTO `tbl_jobs` (`id`, `company_id`, `jq_id`, `title`, `description`, `date_posted`, `is_available`) VALUES
	('A5SWYUAX8R', 'V83PFO1ZYT', 'IYRLMPAN93', 'IT Managers', '&lt;p&gt;SOME NEW DESCRIPTION&lt;/p&gt;', '2019-02-24 18:39:48', 'Y'),
	('DYSUXY23HS', 'JQINC', 'ACJSIFSSF2', 'Nurse', '&lt;p&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quod, ipsa provident fugit omnis necessitatibus obcaecati minima eos dicta nostrum vitae dolores, amet ut delectus vel numquam exercitationem ex eum?&lt;/p&gt;', '2019-01-15 21:03:46', 'Y'),
	('EXYMWAJ3UL', 'LOSC0HRAWQ', 'BZ5XYJL8VT', 'Software Developer / Programmer', '<p>SOME DESCRIPTION</p>', '2019-03-01 16:28:56', 'Y'),
	('HALSFDE6NK', 'V83PFO1ZYT', 'AG4JVMM3IF', 'Pharmacist Assitant', '<p><strong>Some Description</strong></p>', '2019-02-18 13:31:55', 'Y'),
	('I0PWFFMDCU', 'JQINC', 'ADBWQULPWS', 'Associate Desktop Support Engineer', '&lt;p&gt;TEMP INFORMATION!!&lt;/p&gt;', '2019-01-27 13:03:31', 'Y'),
	('ISK29TCOW7', 'V83PFO1ZYT', 'JX7N5ZPHFI', 'Junior JavaScript Developer', '&lt;h1 style=&quot;color: rgb(255, 0, 0); text-align: center;&quot; data-mce-style=&quot;color: #ff0000; text-align: center;&quot;&gt;&lt;span style=&quot;color: rgb(255, 0, 0);&quot; data-mce-style=&quot;color: #ff0000;&quot;&gt;&lt;strong&gt;&amp;nbsp;SOME DESCRIPTION&lt;/strong&gt;&lt;/span&gt;&lt;br&gt;&lt;/h1&gt;', '2019-02-14 15:52:46', 'Y'),
	('KSPTORK32J', 'JQINC', 'TUSAXVMSKD', 'Web Developer', '&lt;p style=&quot;text-align: justify;&quot; data-mce-style=&quot;text-align: justify;&quot;&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quod, ipsa provident fugit omnis necessitatibus obcaecati minima eos dicta nostrum vitae dolores, amet ut delectus vel numquam exercitationem ex eum?Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quod, ipsa provident fugit omnis necessitatibus obcaecati minima eos dicta nostrum vitae dolores, amet ut delectus vel numquam exercitationem ex eum?Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quod, ipLorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quod, ipsa provident fugit omnis necessitatibus obcaecati minima eos dicta nostrum vitae dolores, amet ut delectus vel numquam exercitationem ex eum?Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quod, ipsa provident fugit omnis necessitatibus obcaecati minima eos dicta nostrum vitae dolores, amet ut delectus vel numquam exercitationem ex eum?Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quod, ip&lt;/p&gt;', '2019-01-11 15:49:38', 'Y'),
	('L8ZCBADFPM', 'LOSC0HRAWQ', 'YKOPLTN6X9', 'C# - Software Engineer', '<p>Some description about the job</p>', '2019-10-20 08:02:31', 'Y'),
	('OPO3QHAM5Z', 'JQINC', 'FUPRLAH5CY', 'Junior Software / Web Developer', '&lt;h1 style=&quot;color: rgb(255, 0, 0);&quot; data-mce-style=&quot;color: #ff0000;&quot;&gt;TEST CONTENTS FOR DEMONSTRATION&lt;/h1&gt;', '2019-01-23 20:26:51', 'Y'),
	('PSOXKSLASD', 'JQINC', 'AKICSIDJFI', 'Programmer', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quod, ipsa provident fugit omnis necessitatibus obcaecati minima eos dicta nostrum vitae dolores, amet ut delectus vel numquam exercitationem ex eum?', '2019-01-13 23:08:42', 'Y'),
	('U9BNYMVJFJ', 'JQINC', 'HF3DX2WPUT', 'Pharmacist Assistant', '<p>TEMP DESCRIPTION</p>', '2019-01-27 12:50:00', 'Y'),
	('UYM4FXKLZX', 'JQINC', 'XH4SKWV5GP', 'Encoder', '<p>TEMP JOB DESCRIPTION</p>', '2019-01-27 13:16:26', 'Y');
/*!40000 ALTER TABLE `tbl_jobs` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_locations
CREATE TABLE IF NOT EXISTS `tbl_locations` (
  `id` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_locations: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_locations` DISABLE KEYS */;
REPLACE INTO `tbl_locations` (`id`, `description`) VALUES
	('MKT', 'Makati City'),
	('MNL', 'Manila City'),
	('QC', 'Quezon City');
/*!40000 ALTER TABLE `tbl_locations` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_qualification_types
CREATE TABLE IF NOT EXISTS `tbl_qualification_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_qualification_types: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_qualification_types` DISABLE KEYS */;
REPLACE INTO `tbl_qualification_types` (`id`, `description`) VALUES
	(1, 'Specialization'),
	(2, 'Field of Study'),
	(3, 'Degree Level'),
	(4, 'Work Experience'),
	(5, 'Location'),
	(6, 'Salary');
/*!40000 ALTER TABLE `tbl_qualification_types` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_salaries
CREATE TABLE IF NOT EXISTS `tbl_salaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(10) NOT NULL DEFAULT '0',
  `to` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_salaries: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_salaries` DISABLE KEYS */;
REPLACE INTO `tbl_salaries` (`id`, `from`, `to`) VALUES
	(1, 10000, 14999),
	(2, 15000, 19999),
	(3, 20000, 24999),
	(4, 25000, 29999),
	(5, 30000, 34999);
/*!40000 ALTER TABLE `tbl_salaries` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_specializations
CREATE TABLE IF NOT EXISTS `tbl_specializations` (
  `id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_specializations: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_specializations` DISABLE KEYS */;
REPLACE INTO `tbl_specializations` (`id`, `description`) VALUES
	('AHR', 'Administrative / Human Resources'),
	('COMP', 'Computer / Information'),
	('EDUC', 'Education / Training'),
	('HC', 'Health Care');
/*!40000 ALTER TABLE `tbl_specializations` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_subscription_types
CREATE TABLE IF NOT EXISTS `tbl_subscription_types` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `max_post` int(2) NOT NULL,
  `pricing` double(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_subscription_types: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_subscription_types` DISABLE KEYS */;
REPLACE INTO `tbl_subscription_types` (`id`, `description`, `max_post`, `pricing`) VALUES
	(1, 'Monthly', 10, 10.00),
	(2, 'Quarterly', 20, 25.00),
	(3, 'Yearly', 50, 70.00),
	(9, 'No Subscriptiom', 0, 0.00);
/*!40000 ALTER TABLE `tbl_subscription_types` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_sub_specializations
CREATE TABLE IF NOT EXISTS `tbl_sub_specializations` (
  `id` varchar(20) NOT NULL,
  `specialization_id` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_sub_specialization_tbl_specialization` (`specialization_id`),
  CONSTRAINT `FK_tbl_sub_specialization_tbl_specialization` FOREIGN KEY (`specialization_id`) REFERENCES `tbl_specializations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_sub_specializations: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_sub_specializations` DISABLE KEYS */;
REPLACE INTO `tbl_sub_specializations` (`id`, `specialization_id`, `description`) VALUES
	('CLECA', 'AHR', 'Clerical / Administrative'),
	('EDUC-TD', 'EDUC', 'Education Training and Development'),
	('HC-P', 'HC', 'Pharmacy'),
	('IT-H', 'COMP', 'IT - Hardware'),
	('IT-N', 'COMP', 'IT - Network / Sys / DB Admin'),
	('IT-S', 'COMP', 'IT - Software');
/*!40000 ALTER TABLE `tbl_sub_specializations` ENABLE KEYS */;

-- Dumping structure for table jaqm_db.tbl_work_exp
CREATE TABLE IF NOT EXISTS `tbl_work_exp` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table jaqm_db.tbl_work_exp: ~15 rows (approximately)
/*!40000 ALTER TABLE `tbl_work_exp` DISABLE KEYS */;
REPLACE INTO `tbl_work_exp` (`id`, `description`) VALUES
	(1, '0 - 1 Year of Experience'),
	(2, '2 Year of Experience'),
	(3, '3 Year of Experience'),
	(4, '4 Year of Experience'),
	(5, '5 Year of Experience'),
	(6, '6 Year of Experience'),
	(7, '7 Year of Experience'),
	(8, '8 Year of Experience'),
	(9, '9 Year of Experience'),
	(10, '10 Year of Experience'),
	(11, '11 Year of Experience'),
	(12, '12 Year of Experience'),
	(13, '13 Year of Experience'),
	(14, '14 Year of Experience'),
	(15, '15 Year of Experience');
/*!40000 ALTER TABLE `tbl_work_exp` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
