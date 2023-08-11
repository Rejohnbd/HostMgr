-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 08, 2023 at 11:17 AM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coderive_hosting`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_account_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: users',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: users',
  `customer_first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'company/individual',
  `customer_gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Male/Female',
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_details` text COLLATE utf8mb4_unicode_ci,
  `customer_address` text COLLATE utf8mb4_unicode_ci,
  `customer_join_date` date DEFAULT NULL,
  `customer_join_year` int(11) DEFAULT NULL,
  `customer_reference` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: users',
  `updated_by` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `customer_first_name`, `customer_last_name`, `customer_type`, `customer_gender`, `company_name`, `company_website`, `company_details`, `customer_address`, `customer_join_date`, `customer_join_year`, `customer_reference`, `customer_mobile`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Mazharul', 'Haque', 'individual', 'male', NULL, NULL, NULL, 'Bashabo, Dhaka.', '2022-04-04', 2022, NULL, '01818950369', 1, 0, '2022-04-04 15:25:47', '2022-04-05 14:58:19'),
(2, 3, 'Md. Sanjid', 'Hasan Firoz', 'individual', 'male', NULL, NULL, NULL, 'Dhaka', '2022-04-03', 2022, 'Atik', '01815142000', 1, 0, '2022-04-09 06:38:53', '2022-04-09 06:38:53'),
(3, 4, 'Md. Mofazzal', 'Hossain', 'individual', 'male', NULL, NULL, NULL, 'Dhaka', '2022-03-17', 2022, 'Atik', '01712595699', 1, 0, '2022-04-09 20:17:46', '2022-04-09 20:17:46'),
(4, 5, 'Jahidul', 'Islam', 'individual', 'male', NULL, NULL, NULL, 'Khilgaon', '2022-03-10', 2022, NULL, '01716624505', 1, 0, '2022-04-10 22:05:54', '2022-04-10 22:05:54'),
(5, 6, NULL, NULL, 'company', NULL, 'BSCIC', 'https://bscic.gov.bd', 'Mayor Anisul Haque Road, 398, Tejgaon Industrial Area, Dhaka 1208', 'Dhaka', '2022-01-01', 2022, NULL, NULL, 1, 0, '2022-04-19 15:37:23', '2023-07-20 13:35:28'),
(6, 7, NULL, NULL, 'company', NULL, 'SSIT-Foundation', 'https://www.ssitfoundationbd.org', NULL, 'Dhaka', '2022-04-28', 2022, NULL, NULL, 1, 0, '2022-05-01 10:33:15', '2022-05-01 10:33:15'),
(7, 8, 'Mr.', 'Mahtab', 'individual', 'male', NULL, NULL, NULL, 'Dhanmondi, Dhaka', '2022-05-26', 2022, NULL, '01711152155', 1, 0, '2022-05-31 16:33:31', '2022-05-31 16:33:31'),
(8, 9, 'A.B.M. Shofiur', 'Rahman Akanda', 'individual', 'male', NULL, NULL, NULL, 'Mymensingh', '2022-06-02', 2022, NULL, '01714448396', 1, 0, '2022-06-27 03:03:55', '2022-06-27 03:03:55'),
(9, 10, 'Atikur', 'Rahman', 'individual', 'male', NULL, NULL, NULL, 'Dhaka', '2022-08-01', 2022, NULL, '01717546533', 1, 0, '2022-09-12 16:17:45', '2022-09-12 16:17:45'),
(10, 11, 'Bappy', 'Raihan', 'individual', 'male', NULL, NULL, NULL, 'Dhanmondi', '2022-10-12', 2022, 'Atik', '01792221174', 1, 0, '2022-10-12 19:50:08', '2022-10-12 19:50:08'),
(11, 12, 'Johny', 'Basak', 'individual', 'male', NULL, NULL, NULL, 'Tangail', '2022-10-17', 2022, NULL, '01715670049', 1, 0, '2022-10-17 18:03:56', '2022-10-17 18:03:56'),
(12, 13, NULL, NULL, 'company', NULL, 'Makeup Elysium', 'https://makeupelysium.com', NULL, 'Hongkong', '2022-11-01', 2022, 'Ashik', NULL, 1, 0, '2022-11-01 17:02:18', '2022-11-01 17:02:18'),
(13, 14, NULL, NULL, 'company', NULL, 'NZS Forum', 'https://nzsforum.net', NULL, 'Dhaka', '2022-11-01', 2022, NULL, NULL, 1, 0, '2022-11-01 17:04:22', '2022-11-01 17:04:22'),
(14, 15, 'Mominul', 'Islam', 'individual', 'male', NULL, NULL, NULL, 'Pabna', '2022-11-03', 2022, NULL, '01756525146', 1, 0, '2022-11-04 00:38:16', '2022-11-04 00:38:16'),
(15, 16, 'Mahrup', 'Hossain Chowdhury', 'individual', 'male', NULL, NULL, NULL, 'Paltan, Dhaka', '2022-11-04', 2022, 'Ashik', '01819840456', 1, 0, '2022-11-05 03:21:07', '2022-11-05 03:21:07'),
(16, 17, 'Masud', 'Ahmed', 'individual', 'male', NULL, NULL, NULL, 'Dhanmondi, Dhaka', '2022-11-09', 2022, NULL, '01716218287', 1, 0, '2022-11-27 19:22:10', '2022-11-27 19:22:10'),
(17, 18, 'Hashen', 'Ahmed', 'individual', 'male', NULL, NULL, NULL, 'Tangail', '2022-10-23', 2022, 'Jony Vai, Tangail', '01711870666', 1, 0, '2022-12-04 15:52:52', '2022-12-04 15:52:52'),
(18, 19, 'Asif', 'Rahman', 'individual', 'male', NULL, NULL, NULL, 'Mirpur', '2022-12-05', 2022, NULL, '01302562613', 1, 0, '2022-12-06 17:18:19', '2022-12-06 17:18:19'),
(19, 20, 'Razib', 'Al Mamun', 'individual', 'male', NULL, NULL, NULL, 'Dhaka', '2022-12-13', 2022, NULL, '01716868036', 1, 0, '2022-12-13 17:15:07', '2022-12-13 17:15:07'),
(20, 21, NULL, NULL, 'company', NULL, 'Bangladesh Engineering Service Limited', 'https://beslbd.com', NULL, '309/1/2, East Nakhalpara, Tejgaon, Dhaka', '2022-02-25', 2022, NULL, NULL, 1, 0, '2023-04-09 17:05:09', '2023-04-09 17:05:09'),
(21, 22, 'Md Faisal', 'Alam', 'individual', 'male', NULL, NULL, NULL, 'Bheramara, Dhaka, Bangladesh', '2023-06-01', 2023, NULL, '01761770797', 1, 0, '2023-06-06 17:46:25', '2023-06-06 17:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `customer_contact_people`
--

CREATE TABLE `customer_contact_people` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: customers',
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_mobile` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: users',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_contact_people`
--

INSERT INTO `customer_contact_people` (`id`, `customer_id`, `full_name`, `contact_email`, `contact_mobile`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 12, 'Ishtiak Hasan', 'ishtiak_hasan@yahoo.com', '01712701977', 1, '2022-11-01 17:02:18', '2022-11-01 17:02:18'),
(3, 13, 'Masud Ahmed', 'masudfnfbd@gmail.com', '01716218287', 1, '2022-11-01 17:04:22', '2022-11-01 17:04:22'),
(4, 20, 'Anisur Rahman', NULL, '01843444254', 1, '2023-04-09 17:05:09', '2023-04-09 17:05:09'),
(5, 5, 'Sattar', 'lavasn2010@gmail.com', '01715547542', 1, '2023-07-20 13:35:28', '2023-07-20 13:35:28');

-- --------------------------------------------------------

--
-- Table structure for table `domain_resellers`
--

CREATE TABLE `domain_resellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domain_resellers`
--

INSERT INTO `domain_resellers` (`id`, `name`, `email`, `website`, `details`, `created_at`, `updated_at`) VALUES
(1, 'E-Nom', 'enom@mail.com', 'https://enom.com', 'Jamul Hasan know the details.', '2022-03-03 14:53:14', '2022-03-03 14:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `domain_reseller_renew_logs`
--

CREATE TABLE `domain_reseller_renew_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `domain_reseller_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: domain_reseller',
  `domain_reseller_renew_date` date NOT NULL,
  `domain_reseller_renew_for` int(11) NOT NULL,
  `domain_reseller_renew_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `template_name`, `email_subject`, `email_body`, `created_at`, `updated_at`) VALUES
(1, 'cPanel info Email', 'cPanel Information', '<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Dear Client,</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Hope you are doing great. Here is the cPanel information of your domain:</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">{service_cpanel_info}</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Thanks for availing our services.</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Thanks and Regards,</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Hosting Team</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Email: hosting@coderiver.com</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Mobile: 01710826403</p>', '2022-06-09 19:19:28', '2022-06-09 21:05:05'),
(2, 'Due Payment Email', 'Payment Due', '<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Dear Client,</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Hope you are doing great. Thanks for availing our service. Kindly make the payment for the following services:</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">{service_info}</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Kindly check out the attached invoice for details.</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Thanks and Regards,</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Hosting Team</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Email: hosting@coderiver.com</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Mobile: 01710826403</p>', '2022-06-09 19:19:59', '2022-06-09 21:05:14'),
(3, 'Expiration Reminder Email', 'Expiration Reminder', '<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Dear Client,</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Hope you are doing great. Your following services will expire soon:</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">{service_info}</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Kindly renew the services soon to avoid losing your valuable domain and data.</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Thanks for availing our service.</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Thanks and Regards,</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Hosting Team</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Email: hosting@coderiver.com</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Mobile: 01710826403</p>', '2022-06-09 19:20:47', '2022-06-09 21:05:28'),
(4, 'Post Payment Email', 'Payment Received', '<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Dear Client,</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Hope you are doing great. We have received your payment for the following services:</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">{service_info}</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Thanks for availing our services</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Thanks and Regards,</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Hosting Team</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Email: hosting@coderiver.com</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: .0001pt;\">Mobile: 01710826403</p>', '2022-06-09 19:22:00', '2022-06-09 21:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expenses_amount` decimal(10,2) NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expenses_amount`, `details`, `created_at`, `updated_at`) VALUES
(1, 4350.00, 'Enom Refill of $50 from Jamiul Hasan\'s credit card', '2022-05-31 16:45:17', '2022-05-31 16:45:17'),
(2, 9500.00, 'Enom Refill of $50 from Jamiul Hasan\'s credit card', '2022-08-30 23:17:59', '2022-08-30 23:17:59'),
(3, 22700.00, 'Hosting Renew by Ashik during first week of June and September, 2022', '2022-09-19 20:31:38', '2022-09-19 20:31:38'),
(4, 11700.00, '$115 refill in enom on November 04, 2022', '2022-11-05 03:34:22', '2022-11-05 03:34:22'),
(5, 12915.00, 'Hosting Renew ($126) on December 4 by Ashik', '2022-12-08 00:12:49', '2022-12-08 00:12:49'),
(6, 10650.00, '$100 refill in Enom by Jami on February 1, 2023', '2023-02-01 22:58:50', '2023-02-01 22:58:50'),
(7, 13230.00, 'Hosting Renewal by Jami on March 06, 2023', '2023-03-09 06:25:46', '2023-03-09 06:25:46'),
(8, 6900.00, 'Enom Refill ($65) by Jami on May 03, 2023', '2023-05-04 03:44:28', '2023-05-04 03:44:28'),
(9, 15730.00, 'Hosting Renew ($147) by Jami on June 02, 2023', '2023-06-06 17:52:19', '2023-06-06 17:52:19'),
(10, 6420.00, 'Enom Refill of $60 from Jamiul Hasan\'s credit card on June 03, 2023', '2023-06-06 18:19:36', '2023-06-06 18:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hosting_packages`
--

CREATE TABLE `hosting_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `space` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'in MB',
  `bandwidth` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'in MB',
  `db_qty` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emails_qty` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subdomain_qty` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ftp_qty` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `park_domain_qty` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addon_domain_qty` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hosting_packages`
--

INSERT INTO `hosting_packages` (`id`, `name`, `space`, `bandwidth`, `db_qty`, `emails_qty`, `subdomain_qty`, `ftp_qty`, `park_domain_qty`, `addon_domain_qty`, `created_at`, `updated_at`) VALUES
(1, 'ab5099_WebRiver 500 MB Basic', '500', '5000', '0', '0', '0', '0', '0', '0', '2022-03-02 20:56:40', '2022-03-02 20:56:40'),
(2, 'ab5099_500MB Regular', '512', '5120', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', '0', '0', '2022-03-02 21:00:06', '2022-03-02 21:00:06'),
(3, 'ab5099_WebRiver 1 GB Basic', '1024', '10240', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', '2022-03-02 21:02:06', '2022-03-02 21:02:06'),
(4, 'ab5099_WebRiver 2 GB Basic', '2048', '20480', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', '2022-03-02 21:03:01', '2022-03-02 21:03:01'),
(5, 'ab5099_WebRiver 3 GB Basic', '3096', '30960', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', '2022-03-02 21:04:29', '2022-03-02 21:04:29'),
(6, 'ab5099_WebRiver 4 GB Basic', '4096', '40960', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', '2022-03-02 21:05:27', '2022-03-02 21:05:27'),
(7, 'ab5099_WebRiver 5 GB Basic', '5120', '51200', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', '2022-03-02 21:06:35', '2022-03-02 21:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_resellers`
--

CREATE TABLE `hosting_resellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hosting_resellers`
--

INSERT INTO `hosting_resellers` (`id`, `name`, `email`, `website`, `details`, `created_at`, `updated_at`) VALUES
(1, 'HostGator', 'hostgator@mail.com', 'https://www.hostgator.com/', 'Jamiul Hasan Know the details', '2022-03-03 14:54:33', '2022-03-03 14:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `hosting_reseller_renew_logs`
--

CREATE TABLE `hosting_reseller_renew_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hosting_reseller_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: hosting_reseller',
  `hosting_reseller_renew_date` date NOT NULL,
  `hosting_reseller_renew_for` int(11) NOT NULL,
  `hosting_reseller_renew_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `initial_balance`
--

CREATE TABLE `initial_balance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `initial_balance` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `initial_balance`
--

INSERT INTO `initial_balance` (`id`, `initial_balance`, `created_at`, `updated_at`) VALUES
(1, 5150.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: users',
  `service_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: services',
  `invoice_year` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_serial` int(10) UNSIGNED NOT NULL,
  `invoice_number` int(10) UNSIGNED NOT NULL,
  `invoice_gross_total` decimal(10,2) NOT NULL,
  `invoice_discount` decimal(10,2) NOT NULL,
  `invoice_total` decimal(10,2) NOT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = Not Paid, 1 = Paid, 2 = Partial Paid',
  `created_by` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: users',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `service_id`, `invoice_year`, `invoice_serial`, `invoice_number`, `invoice_gross_total`, `invoice_discount`, `invoice_total`, `payment_status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2022', 1, 220400001, 2500.00, 0.00, 2500.00, 1, 1, '2022-04-04 15:33:56', '2022-04-04 15:47:47'),
(2, 3, 2, '2022', 2, 220400002, 3500.00, 0.00, 3500.00, 1, 1, '2022-04-09 06:42:40', '2022-04-09 06:46:46'),
(3, 4, 3, '2022', 3, 220400003, 2500.00, 0.00, 2500.00, 1, 1, '2022-04-09 21:02:21', '2022-04-09 21:05:00'),
(4, 5, 4, '2022', 4, 220400004, 1750.00, 90.00, 1660.00, 1, 1, '2022-04-10 22:12:02', '2022-04-10 22:14:19'),
(5, 6, 5, '2022', 5, 220400005, 15000.00, 2500.00, 12500.00, 1, 1, '2022-04-19 17:09:13', '2022-04-19 17:11:50'),
(6, 7, 6, '2022', 6, 220500006, 2700.00, 0.00, 2700.00, 1, 1, '2022-05-01 10:36:14', '2022-05-01 10:38:32'),
(7, 5, 7, '2022', 7, 220500007, 1950.00, 200.00, 1750.00, 1, 1, '2022-05-12 15:15:12', '2022-05-12 15:26:13'),
(8, 8, 8, '2022', 8, 220500008, 5500.00, 500.00, 5000.00, 1, 1, '2022-05-31 16:37:08', '2022-05-31 16:40:22'),
(9, 9, 9, '2022', 9, 220600009, 1850.00, 0.00, 1850.00, 1, 1, '2022-06-27 18:00:54', '2022-06-27 18:06:20'),
(10, 10, 10, '2022', 10, 220900010, 3000.00, 0.00, 3000.00, 1, 1, '2022-09-12 16:47:53', '2022-09-12 16:50:17'),
(11, 6, 5, '2022', 11, 220900011, 12500.00, 0.00, 12500.00, 1, 1, '2022-09-19 15:17:33', '2022-09-19 15:20:46'),
(12, 10, 11, '2022', 12, 220900012, 3000.00, 0.00, 3000.00, 1, 1, '2022-09-19 20:13:51', '2022-09-19 20:16:28'),
(13, 12, 12, '2022', 13, 221000013, 750.00, 0.00, 750.00, 0, 1, '2022-10-17 18:22:14', '2022-10-17 18:22:14'),
(14, 13, 13, '2022', 14, 221100014, 5500.00, 0.00, 5500.00, 1, 1, '2022-11-01 17:24:21', '2023-06-06 17:47:46'),
(15, 14, 14, '2022', 15, 221100015, 6000.00, 0.00, 6000.00, 0, 1, '2022-11-01 17:26:29', '2022-11-01 17:26:29'),
(16, 15, 15, '2022', 16, 221100016, 3000.00, 800.00, 2200.00, 1, 1, '2022-11-05 02:52:43', '2022-11-05 02:56:48'),
(17, 16, 16, '2022', 17, 221100017, 9000.00, 1000.00, 8000.00, 1, 1, '2022-11-05 03:50:28', '2022-11-05 03:51:17'),
(18, 17, 17, '2022', 18, 221100018, 2250.00, 0.00, 2250.00, 1, 1, '2022-11-27 20:11:24', '2022-11-27 20:12:32'),
(19, 10, 18, '2022', 19, 221200019, 3000.00, 0.00, 3000.00, 1, 1, '2022-12-04 15:42:34', '2022-12-04 15:44:31'),
(20, 18, 19, '2022', 20, 221200020, 1500.00, 0.00, 1500.00, 1, 1, '2022-12-04 15:57:39', '2022-12-04 15:59:10'),
(21, 19, 20, '2022', 21, 221200021, 2250.00, 0.00, 2250.00, 1, 1, '2022-12-06 17:22:34', '2022-12-06 17:25:29'),
(22, 20, 21, '2022', 22, 221200022, 4500.00, 500.00, 4000.00, 1, 1, '2022-12-13 17:44:15', '2022-12-27 15:11:44'),
(23, 19, 22, '2023', 23, 230300023, 2250.00, 0.00, 2250.00, 1, 1, '2023-03-07 00:33:07', '2023-03-07 00:34:40'),
(24, 5, 4, '2023', 24, 230300024, 2250.00, 50.00, 2200.00, 1, 1, '2023-03-09 04:53:34', '2023-03-09 06:18:41'),
(25, 10, 23, '2023', 25, 230300025, 3200.00, 0.00, 3200.00, 1, 1, '2023-03-09 05:07:30', '2023-03-09 05:09:41'),
(26, 4, 3, '2023', 26, 230300026, 3000.00, 0.00, 3000.00, 1, 1, '2023-03-22 02:55:41', '2023-03-22 02:59:14'),
(27, 21, 24, '2022', 27, 230400027, 8500.00, 500.00, 8000.00, 1, 1, '2023-04-09 18:09:54', '2023-06-03 13:42:10'),
(28, 5, 7, '2023', 28, 230500028, 2500.00, 0.00, 2500.00, 1, 1, '2023-05-04 03:18:04', '2023-05-04 03:23:15'),
(29, 7, 6, '2023', 29, 230500029, 3200.00, 0.00, 3200.00, 1, 1, '2023-05-04 03:31:58', '2023-05-04 03:33:34'),
(30, 22, 25, '2023', 30, 230600030, 1700.00, 0.00, 1700.00, 1, 1, '2023-06-06 17:55:53', '2023-06-06 17:59:53'),
(31, 22, 26, '2023', 31, 230600031, 1700.00, 0.00, 1700.00, 1, 1, '2023-06-06 18:04:43', '2023-06-06 18:13:19'),
(32, 22, 27, '2023', 32, 230600032, 1700.00, 0.00, 1700.00, 1, 1, '2023-06-06 18:15:55', '2023-06-06 18:16:39'),
(33, 13, 13, '2023', 33, 230600033, 6900.00, 400.00, 6500.00, 1, 1, '2023-06-06 18:27:08', '2023-07-18 17:11:56'),
(34, 21, 24, '2023', 34, 230600034, 8700.00, 700.00, 8000.00, 0, 1, '2023-06-06 18:55:41', '2023-06-06 18:55:41'),
(35, 8, 8, '2023', 35, 230700035, 1500.00, 20.00, 1480.00, 1, 1, '2023-07-18 17:19:53', '2023-07-18 17:22:30'),
(36, 6, 5, '2023', 36, 230800036, 12500.00, 0.00, 12500.00, 0, 1, '2023-08-07 15:09:23', '2023-08-07 15:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FR from table: invoice',
  `invoice_number` int(10) UNSIGNED NOT NULL COMMENT 'FR from table: invoices',
  `service_type_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FR from table: service_types',
  `invoice_item_for` tinyint(4) NOT NULL COMMENT 'new service/renew service/others',
  `invoice_item_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_item_subtotal` decimal(10,2) NOT NULL,
  `invoice_item_discount` decimal(10,2) NOT NULL,
  `invoice_item_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `invoice_number`, `service_type_id`, `invoice_item_for`, `invoice_item_details`, `invoice_item_subtotal`, `invoice_item_discount`, `invoice_item_total`, `created_at`, `updated_at`) VALUES
(1, 1, 220400001, 1, 1, 'Domain and Hosting of humanity24.com from 25-01-2022 to 25-01-2023', 1000.00, 0.00, 1000.00, '2022-04-04 15:33:56', '2022-04-04 15:33:56'),
(2, 1, 220400001, 2, 1, 'Domain and Hosting of humanity24.com from 25-01-2022 to 25-01-2023', 1500.00, 0.00, 1500.00, '2022-04-04 15:33:56', '2022-04-04 15:33:56'),
(3, 2, 220400002, 1, 1, 'Domain with 2GB hosting', 1000.00, 0.00, 1000.00, '2022-04-09 06:42:40', '2022-04-09 06:42:40'),
(4, 2, 220400002, 2, 1, 'Domain with 2GB hosting', 2500.00, 0.00, 2500.00, '2022-04-09 06:42:40', '2022-04-09 06:42:40'),
(5, 3, 220400003, 1, 1, 'domain and hosting of curvybd.com', 1000.00, 0.00, 1000.00, '2022-04-09 21:02:21', '2022-04-09 21:02:21'),
(6, 3, 220400003, 2, 1, 'domain and hosting of curvybd.com', 1500.00, 0.00, 1500.00, '2022-04-09 21:02:21', '2022-04-09 21:02:21'),
(7, 4, 220400004, 1, 1, 'Domain and hosting of ictsoftbd.com', 1000.00, 0.00, 1000.00, '2022-04-10 22:12:02', '2022-04-10 22:12:02'),
(8, 4, 220400004, 2, 1, 'Domain and hosting of ictsoftbd.com', 750.00, 90.00, 660.00, '2022-04-10 22:12:02', '2022-04-10 22:12:02'),
(9, 5, 220400005, 2, 1, 'hosting space only', 15000.00, 2500.00, 12500.00, '2022-04-19 17:09:13', '2022-04-19 17:09:13'),
(10, 6, 220500006, 1, 1, 'domain hosting fee of ssitfoundationbd.org', 1200.00, 0.00, 1200.00, '2022-05-01 10:36:14', '2022-05-01 10:36:14'),
(11, 6, 220500006, 2, 1, 'domain hosting fee of ssitfoundationbd.org', 1500.00, 0.00, 1500.00, '2022-05-01 10:36:14', '2022-05-01 10:36:14'),
(12, 7, 220500007, 1, 1, 'domain and hosting of aabegbd.org', 1200.00, 200.00, 1000.00, '2022-05-12 15:15:12', '2022-05-12 15:15:12'),
(13, 7, 220500007, 2, 1, 'domain and hosting of aabegbd.org', 750.00, 0.00, 750.00, '2022-05-12 15:15:12', '2022-05-12 15:15:12'),
(14, 8, 220500008, 1, 1, 'Domain hosting for mmrcbd.com', 1000.00, 0.00, 1000.00, '2022-05-31 16:37:08', '2022-05-31 16:37:08'),
(15, 8, 220500008, 2, 1, 'Domain hosting for mmrcbd.com', 4500.00, 500.00, 4000.00, '2022-05-31 16:37:08', '2022-05-31 16:37:08'),
(16, 9, 220600009, 1, 1, 'domain hosting fee for realestatesbd.com', 1100.00, 0.00, 1100.00, '2022-06-27 18:00:54', '2022-06-27 18:00:54'),
(17, 9, 220600009, 2, 1, 'domain hosting fee for realestatesbd.com', 750.00, 0.00, 750.00, '2022-06-27 18:00:54', '2022-06-27 18:00:54'),
(18, 10, 220900010, 1, 1, 'domain and hosting of sweetsseller.com', 1200.00, 0.00, 1200.00, '2022-09-12 16:47:53', '2022-09-12 16:47:53'),
(19, 10, 220900010, 2, 1, 'domain and hosting of sweetsseller.com', 1800.00, 0.00, 1800.00, '2022-09-12 16:47:53', '2022-09-12 16:47:53'),
(20, 11, 220900011, 2, 2, 'hosting of 30gb', 12500.00, 0.00, 12500.00, '2022-09-19 15:17:33', '2022-09-19 15:17:33'),
(21, 12, 220900012, 1, 1, 'domain fee for meghbangladesh.com', 3000.00, 0.00, 3000.00, '2022-09-19 20:13:51', '2022-09-19 20:13:51'),
(22, 13, 221000013, 2, 1, 'Hosting of tangailonlinebd.com (500 MB)', 750.00, 0.00, 750.00, '2022-10-17 18:22:14', '2022-10-17 18:22:14'),
(23, 14, 221100014, 1, 1, 'Domain/Hosting for makeupelysium.com', 1000.00, 0.00, 1000.00, '2022-11-01 17:24:21', '2022-11-01 17:24:21'),
(24, 14, 221100014, 2, 1, 'Domain/Hosting for makeupelysium.com', 4500.00, 0.00, 4500.00, '2022-11-01 17:24:21', '2022-11-01 17:24:21'),
(25, 15, 221100015, 1, 1, 'Domain/Hosting price for nzsforum.net', 1500.00, 0.00, 1500.00, '2022-11-01 17:26:29', '2022-11-01 17:26:29'),
(26, 15, 221100015, 2, 1, 'Domain/Hosting price for nzsforum.net', 4500.00, 0.00, 4500.00, '2022-11-01 17:26:29', '2022-11-01 17:26:29'),
(27, 16, 221100016, 1, 1, 'Domain Hosting for webdesignguideline.com', 1500.00, 0.00, 1500.00, '2022-11-05 02:52:43', '2022-11-05 02:52:43'),
(28, 16, 221100016, 2, 1, 'Domain Hosting for webdesignguideline.com', 1500.00, 800.00, 700.00, '2022-11-05 02:52:43', '2022-11-05 02:52:43'),
(29, 17, 221100017, 1, 1, 'domain hosting for dressidale.com for 3 years', 4500.00, 500.00, 4000.00, '2022-11-05 03:50:28', '2022-11-05 03:50:28'),
(30, 17, 221100017, 2, 1, 'domain hosting for dressidale.com for 3 years', 4500.00, 500.00, 4000.00, '2022-11-05 03:50:28', '2022-11-05 03:50:28'),
(31, 18, 221100018, 1, 1, 'domain hosting of binqbd.com', 1500.00, 0.00, 1500.00, '2022-11-27 20:11:24', '2022-11-27 20:11:24'),
(32, 18, 221100018, 2, 1, 'domain hosting of binqbd.com', 750.00, 0.00, 750.00, '2022-11-27 20:11:24', '2022-11-27 20:11:24'),
(33, 19, 221200019, 1, 1, 'domain hosting for roo1bd.com', 1500.00, 0.00, 1500.00, '2022-12-04 15:42:34', '2022-12-04 15:42:34'),
(34, 19, 221200019, 2, 1, 'domain hosting for roo1bd.com', 1500.00, 0.00, 1500.00, '2022-12-04 15:42:34', '2022-12-04 15:42:34'),
(35, 20, 221200020, 2, 1, 'hosting for aerotrip.com.bd', 1500.00, 0.00, 1500.00, '2022-12-04 15:57:39', '2022-12-04 15:57:39'),
(36, 21, 221200021, 1, 1, 'domain hosting for saplasticindustries.com', 1500.00, 0.00, 1500.00, '2022-12-06 17:22:34', '2022-12-06 17:22:34'),
(37, 21, 221200021, 2, 1, 'domain hosting for saplasticindustries.com', 750.00, 0.00, 750.00, '2022-12-06 17:22:34', '2022-12-06 17:22:34'),
(38, 22, 221200022, 1, 1, 'domain hosting for abonytradelink.com', 1500.00, 0.00, 1500.00, '2022-12-13 17:44:15', '2022-12-13 17:44:15'),
(39, 22, 221200022, 2, 1, 'domain hosting for abonytradelink.com', 3000.00, 500.00, 2500.00, '2022-12-13 17:44:15', '2022-12-13 17:44:15'),
(40, 23, 230300023, 1, 1, 'domain and 500mb hosting of annurenterprise.com', 1500.00, 0.00, 1500.00, '2023-03-07 00:33:07', '2023-03-07 00:33:07'),
(41, 23, 230300023, 2, 1, 'domain and 500mb hosting of annurenterprise.com', 750.00, 0.00, 750.00, '2023-03-07 00:33:07', '2023-03-07 00:33:07'),
(42, 24, 230300024, 1, 2, 'domain ictsoftbd.com with 500mb hosting', 1500.00, 0.00, 1500.00, '2023-03-09 04:53:34', '2023-03-09 04:53:34'),
(43, 24, 230300024, 2, 2, 'domain ictsoftbd.com with 500mb hosting', 750.00, 50.00, 700.00, '2023-03-09 04:53:34', '2023-03-09 04:53:34'),
(44, 25, 230300025, 1, 1, 'Domain deshseba.org with 1gb hosting', 1700.00, 0.00, 1700.00, '2023-03-09 05:07:30', '2023-03-09 05:07:30'),
(45, 25, 230300025, 2, 1, 'Domain deshseba.org with 1gb hosting', 1500.00, 0.00, 1500.00, '2023-03-09 05:07:30', '2023-03-09 05:07:30'),
(46, 26, 230300026, 1, 2, 'curvybd.com with 1 gb hosting', 1500.00, 0.00, 1500.00, '2023-03-22 02:55:42', '2023-03-22 02:55:42'),
(47, 26, 230300026, 2, 2, 'curvybd.com with 1 gb hosting', 1500.00, 0.00, 1500.00, '2023-03-22 02:55:42', '2023-03-22 02:55:42'),
(48, 27, 230400027, 1, 1, 'Domain hosting (5 gb) of beslbd.com', 1000.00, 0.00, 1000.00, '2023-04-09 18:09:54', '2023-04-09 18:09:54'),
(49, 27, 230400027, 2, 1, 'Domain hosting (5 gb) of beslbd.com', 7500.00, 500.00, 7000.00, '2023-04-09 18:09:54', '2023-04-09 18:09:54'),
(50, 28, 230500028, 1, 2, 'domain hosting fee', 1700.00, 0.00, 1700.00, '2023-05-04 03:18:04', '2023-05-04 03:18:04'),
(51, 28, 230500028, 2, 2, 'domain hosting fee', 800.00, 0.00, 800.00, '2023-05-04 03:18:04', '2023-05-04 03:18:04'),
(52, 29, 230500029, 1, 2, 'Domain Hosting Fee', 1700.00, 0.00, 1700.00, '2023-05-04 03:31:58', '2023-05-04 03:31:58'),
(53, 29, 230500029, 2, 2, 'Domain Hosting Fee', 1500.00, 0.00, 1500.00, '2023-05-04 03:31:58', '2023-05-04 03:31:58'),
(54, 30, 230600030, 1, 1, 'Domain registration of cbslgroupbd.com', 1700.00, 0.00, 1700.00, '2023-06-06 17:55:53', '2023-06-06 17:55:53'),
(55, 31, 230600031, 1, 1, 'Domain Registration of cbsltrading.com', 1700.00, 0.00, 1700.00, '2023-06-06 18:04:43', '2023-06-06 18:04:43'),
(56, 32, 230600032, 1, 1, 'Domain registration of cbslconsulting.com', 1700.00, 0.00, 1700.00, '2023-06-06 18:15:55', '2023-06-06 18:15:55'),
(57, 33, 230600033, 1, 2, 'Domain Hosting of makeupelysium.com', 1500.00, 0.00, 1500.00, '2023-06-06 18:27:08', '2023-06-06 18:27:08'),
(58, 33, 230600033, 2, 2, 'Domain Hosting of makeupelysium.com', 5400.00, 400.00, 5000.00, '2023-06-06 18:27:08', '2023-06-06 18:27:08'),
(59, 34, 230600034, 1, 2, 'Domain hosting fee of beslbd.com', 1500.00, 0.00, 1500.00, '2023-06-06 18:55:41', '2023-06-06 18:55:41'),
(60, 34, 230600034, 2, 2, 'Domain hosting fee of beslbd.com', 7200.00, 700.00, 6500.00, '2023-06-06 18:55:41', '2023-06-06 18:55:41'),
(61, 35, 230700035, 1, 2, 'only domain renew', 1500.00, 20.00, 1480.00, '2023-07-18 17:19:53', '2023-07-18 17:19:53'),
(62, 36, 230800036, 2, 2, 'Email Hosting for bscic.gov.bd', 12500.00, 0.00, 12500.00, '2023-08-07 15:09:23', '2023-08-07 15:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: users',
  `service_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: services',
  `invoice_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: invoices',
  `total_amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `due_amount` decimal(10,2) NOT NULL,
  `invoice_total` decimal(10,2) NOT NULL,
  `payment_method` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'cash/bkash/bank',
  `bkash_mobile_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bkash_transaction_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK from table: bank_accounts',
  `payment_date` date NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: users',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `service_id`, `invoice_id`, `total_amount`, `paid_amount`, `due_amount`, `invoice_total`, `payment_method`, `bkash_mobile_number`, `bkash_transaction_no`, `bank_account_id`, `payment_date`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 2500.00, 750.00, 1750.00, 2500.00, 'bkash', '01818950369', '9CR9QWTP61', NULL, '2022-03-27', 1, '2022-04-04 15:46:17', '2022-04-04 15:46:17'),
(2, 2, 1, 1, 1750.00, 1750.00, 0.00, 2500.00, 'cash', NULL, NULL, NULL, '2022-01-26', 1, '2022-04-04 15:47:47', '2022-04-04 15:47:47'),
(3, 3, 2, 2, 3500.00, 3500.00, 0.00, 3500.00, 'bkash', '01552607608', '9D36WZMMFA', NULL, '2022-04-03', 1, '2022-04-09 06:46:46', '2022-04-09 06:46:46'),
(4, 4, 3, 3, 2500.00, 2500.00, 0.00, 2500.00, 'cash', NULL, NULL, NULL, '2022-03-17', 1, '2022-04-09 21:05:00', '2022-04-09 21:05:00'),
(5, 5, 4, 4, 1660.00, 1660.00, 0.00, 1660.00, 'bkash', '01716624505', '9D9955J7BH', NULL, '2022-04-09', 1, '2022-04-10 22:14:19', '2022-04-10 22:14:19'),
(6, 6, 5, 5, 12500.00, 12500.00, 0.00, 12500.00, 'bkash', '01715547542', '9DH6BALVYO', NULL, '2022-04-17', 1, '2022-04-19 17:11:50', '2022-04-19 17:11:50'),
(7, 7, 6, 6, 2700.00, 2700.00, 0.00, 2700.00, 'bkash', '01960584536', '9DU5OGSE5N', NULL, '2022-04-30', 1, '2022-05-01 10:38:32', '2022-05-01 10:38:32'),
(8, 5, 7, 7, 1750.00, 1750.00, 0.00, 1750.00, 'bkash', '01716624505', '9E35RE7QDN', NULL, '2022-05-03', 1, '2022-05-12 15:26:13', '2022-05-12 15:26:13'),
(9, 8, 8, 8, 5000.00, 5000.00, 0.00, 5000.00, 'bkash', '01727057755', '9ES0DKJCJC', NULL, '2022-05-28', 1, '2022-05-31 16:40:22', '2022-05-31 16:40:22'),
(10, 9, 9, 9, 1850.00, 1850.00, 0.00, 1850.00, 'bkash', '01714448396', '9F29HN41KT', NULL, '2022-06-02', 1, '2022-06-27 18:06:20', '2022-06-27 18:06:20'),
(11, 10, 10, 10, 3000.00, 3000.00, 0.00, 3000.00, 'bkash', '01552607608', '9196548WBQ', NULL, '2022-09-08', 1, '2022-09-12 16:50:17', '2022-09-12 16:50:17'),
(12, 6, 5, 11, 12500.00, 12500.00, 0.00, 12500.00, 'bkash', '01715547542', '9IC57GYCID', NULL, '2022-09-12', 1, '2022-09-19 15:20:46', '2022-09-19 15:20:46'),
(13, 10, 11, 12, 3000.00, 3000.00, 0.00, 3000.00, 'bkash', '01552607608', '9II2DBMNG2', NULL, '2022-09-18', 1, '2022-09-19 20:16:28', '2022-09-19 20:16:28'),
(14, 15, 15, 16, 2200.00, 2200.00, 0.00, 2200.00, 'cash', NULL, NULL, NULL, '2022-11-03', 1, '2022-11-05 02:56:48', '2022-11-05 02:56:48'),
(15, 16, 16, 17, 8000.00, 8000.00, 0.00, 8000.00, 'cash', NULL, NULL, NULL, '2022-11-01', 1, '2022-11-05 03:51:17', '2022-11-05 03:51:17'),
(16, 17, 17, 18, 2250.00, 2250.00, 0.00, 2250.00, 'cash', NULL, NULL, NULL, '2022-11-27', 1, '2022-11-27 20:12:32', '2022-11-27 20:12:32'),
(17, 10, 18, 19, 3000.00, 3000.00, 0.00, 3000.00, 'bkash', '01910065990', '9L37G5HU9P', NULL, '2022-12-03', 1, '2022-12-04 15:44:31', '2022-12-04 15:44:31'),
(18, 18, 19, 20, 1500.00, 1500.00, 0.00, 1500.00, 'bkash', '01711870666', '9JO5C2TPS9', NULL, '2022-10-24', 1, '2022-12-04 15:59:10', '2022-12-04 15:59:10'),
(19, 19, 20, 21, 2250.00, 2250.00, 0.00, 2250.00, 'bkash', '01828176019', '9L51HFK8QF', NULL, '2022-12-05', 1, '2022-12-06 17:25:29', '2022-12-06 17:25:29'),
(20, 20, 21, 22, 4000.00, 4000.00, 0.00, 4000.00, 'bkash', '01624605696', '9LP62YV9HI', NULL, '2022-12-25', 1, '2022-12-27 15:11:44', '2022-12-27 15:11:44'),
(21, 19, 22, 23, 2250.00, 2250.00, 0.00, 2250.00, 'bkash', '01714906737', 'ABG5MWH6XP', NULL, '2023-02-16', 1, '2023-03-07 00:34:40', '2023-03-07 00:34:40'),
(22, 10, 23, 25, 3200.00, 3200.00, 0.00, 3200.00, 'bkash', '01815142000', 'ABL4RLX5RQ', NULL, '2023-02-21', 1, '2023-03-09 05:09:41', '2023-03-09 05:09:41'),
(23, 5, 4, 24, 2200.00, 2200.00, 0.00, 2200.00, 'cash', NULL, NULL, NULL, '2023-03-07', 1, '2023-03-09 06:18:41', '2023-03-09 06:18:41'),
(24, 4, 3, 26, 3000.00, 3000.00, 0.00, 3000.00, 'bkash', '01721578574', 'ACL2NUIQEG', NULL, '2023-03-21', 1, '2023-03-22 02:59:14', '2023-03-22 02:59:14'),
(25, 5, 7, 28, 2500.00, 2500.00, 0.00, 2500.00, 'bkash', '01716624505', 'AE2830H1NY', NULL, '2023-05-02', 1, '2023-05-04 03:23:15', '2023-05-04 03:23:15'),
(26, 7, 6, 29, 3200.00, 3200.00, 0.00, 3200.00, 'bkash', '01783636453', 'ADU60Z70CW', NULL, '2023-04-30', 1, '2023-05-04 03:33:34', '2023-05-04 03:33:34'),
(27, 21, 24, 27, 8000.00, 7999.00, 1.00, 8000.00, 'bkash', '01785000002', 'AEU1UI3M5D', NULL, '2023-05-30', 1, '2023-06-03 13:23:42', '2023-06-03 13:23:42'),
(28, 21, 24, 27, 1.00, 1.00, 0.00, 8000.00, 'cash', NULL, NULL, NULL, '2023-06-30', 1, '2023-06-03 13:42:10', '2023-06-03 13:42:10'),
(29, 13, 13, 14, 5500.00, 5500.00, 0.00, 5500.00, 'cash', NULL, NULL, NULL, '2023-06-05', 1, '2023-06-06 17:47:46', '2023-06-06 17:47:46'),
(30, 22, 25, 30, 1700.00, 1700.00, 0.00, 1700.00, 'bkash', '01761770797', 'AF5838LQQY', NULL, '2023-06-05', 1, '2023-06-06 17:59:53', '2023-06-06 17:59:53'),
(31, 22, 26, 31, 1700.00, 1700.00, 0.00, 1700.00, 'bkash', '01761770797', 'AF5838LQQY', NULL, '2023-06-05', 1, '2023-06-06 18:13:19', '2023-06-06 18:13:19'),
(32, 22, 27, 32, 1700.00, 1700.00, 0.00, 1700.00, 'bkash', '01761770797', 'AF5838LQQY', NULL, '2023-06-05', 1, '2023-06-06 18:16:39', '2023-06-06 18:16:39'),
(33, 13, 13, 33, 6500.00, 6500.00, 0.00, 6500.00, 'bkash', '1000000000', 'AFP5QC2RG7', NULL, '2023-06-25', 1, '2023-07-18 17:11:56', '2023-07-18 17:11:56'),
(34, 8, 8, 35, 1480.00, 1480.00, 0.00, 1480.00, 'bkash', '01774969490', 'AGG7EGIBVR', NULL, '2023-07-17', 1, '2023-07-18 17:22:30', '2023-07-18 17:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: users',
  `customer_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: customers',
  `domain_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain_reseller_id` bigint(20) UNSIGNED DEFAULT '0' COMMENT 'FK from table: domain_reseller',
  `hosting_reseller_id` bigint(20) UNSIGNED DEFAULT '0' COMMENT 'FK from table: hosting_reseller',
  `hosting_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'package/custom',
  `hosting_package_id` int(11) DEFAULT '0',
  `hosting_space` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'in MB',
  `hosting_bandwidth` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'in MB',
  `hosting_db_qty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hosting_emails_qty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hosting_subdomain_qty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hosting_ftp_qty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hosting_park_domain_qty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hosting_addon_domain_qty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_start_date` date NOT NULL,
  `service_expire_date` date NOT NULL,
  `service_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'active/suspended/discontinued',
  `invoice_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = Invoice Not Ready, 1 = Invoice Ready',
  `payment_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = Not Paid, 1 = Paid, 2 = Partial Paid',
  `service_discontinued_from` date DEFAULT NULL,
  `cpanel_username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpanel_password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `user_id`, `customer_id`, `domain_name`, `domain_reseller_id`, `hosting_reseller_id`, `hosting_type`, `hosting_package_id`, `hosting_space`, `hosting_bandwidth`, `hosting_db_qty`, `hosting_emails_qty`, `hosting_subdomain_qty`, `hosting_ftp_qty`, `hosting_park_domain_qty`, `hosting_addon_domain_qty`, `service_start_date`, `service_expire_date`, `service_status`, `invoice_status`, `payment_status`, `service_discontinued_from`, `cpanel_username`, `cpanel_password`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'humanity24.com', 1, 1, 'package', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-25', '2023-01-25', 'active', 1, 1, NULL, NULL, NULL, 1, 0, '2022-04-04 15:31:27', '2022-04-04 15:47:47'),
(2, 3, 2, 'thrivebangla.com', 1, 1, 'package', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03', '2023-04-03', 'active', 1, 1, NULL, NULL, NULL, 1, 0, '2022-04-09 06:41:14', '2022-04-09 06:46:46'),
(3, 4, 3, 'curvybd.com', 1, 1, 'package', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-17', '2024-03-17', 'active', 1, 1, NULL, NULL, NULL, 1, 0, '2022-04-09 21:01:18', '2023-03-22 02:59:14'),
(4, 5, 4, 'ictsoftbd.com', 1, 1, 'package', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-10', '2024-03-10', 'active', 1, 1, NULL, NULL, NULL, 1, 0, '2022-04-10 22:07:25', '2023-03-09 06:18:41'),
(5, 6, 5, 'bscic.gov.bd', 0, 1, 'custom', 0, '30 GB', '300 GB', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', '1', '1', '2023-01-01', '2023-06-30', 'active', 1, 0, NULL, NULL, NULL, 1, 0, '2022-04-19 17:07:43', '2023-08-07 15:09:23'),
(6, 7, 6, 'ssitfoundationbd.org', 1, 1, 'package', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-28', '2024-04-28', 'active', 1, 1, NULL, NULL, NULL, 1, 0, '2022-05-01 10:35:11', '2023-05-04 03:33:34'),
(7, 5, 4, 'aabegbd.org', 1, 1, 'package', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12', '2024-05-12', 'active', 1, 1, NULL, NULL, NULL, 1, 0, '2022-05-12 15:03:56', '2023-05-04 03:23:15'),
(8, 8, 7, 'mmrcbd.com', 1, 1, 'package', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-26', '2024-05-26', 'active', 1, 1, NULL, NULL, NULL, 1, 0, '2022-05-31 16:35:12', '2023-07-18 17:22:30'),
(9, 9, 8, 'realestatesbd.com', 1, 1, 'package', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-02', '2023-06-02', 'active', 1, 1, NULL, 'realestatesbd', 'ZAQ123xsw!', 1, 0, '2022-06-27 03:05:44', '2022-06-27 18:06:20'),
(10, 10, 9, 'sweetsseller.com', 1, 1, 'package', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-11', '2023-09-11', 'active', 1, 1, NULL, 'sweetsseller', 'ZAQ123xsw!', 1, 0, '2022-09-12 16:45:43', '2022-09-12 16:50:17'),
(11, 10, 9, 'meghbangladesh.com', 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-18', '2024-09-18', 'active', 1, 1, NULL, NULL, NULL, 1, 0, '2022-09-19 15:25:50', '2022-09-19 20:16:28'),
(12, 12, 11, 'tangailonlinebd.com', 0, 1, 'package', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-17', '2023-10-17', 'active', 1, 0, NULL, 'tangailonlinebd', 'ZAQ123xsw!', 1, 0, '2022-10-17 18:19:55', '2022-10-17 18:22:14'),
(13, 13, 12, 'makeupelysium.com', 1, 1, 'package', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-18', '2024-04-18', 'active', 1, 1, NULL, 'makeup', '8&lEF5D^3n7c', 1, 0, '2022-11-01 17:17:46', '2023-07-18 17:11:56'),
(14, 14, 13, 'nzsforum.net', 1, 1, 'package', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-11', '2023-10-11', 'active', 1, 0, NULL, 'nzsforum', '1XBa$Qmz2Sup', 1, 0, '2022-11-01 17:21:24', '2022-11-01 17:26:29'),
(15, 15, 14, 'www.webdesignguideline.com', 1, 1, 'package', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-03', '2023-11-03', 'active', 1, 1, NULL, 'designguideline', 'ZAQ123xsw!', 1, 0, '2022-11-04 00:40:11', '2022-11-05 02:56:48'),
(16, 16, 15, 'dressidale.com', 1, 1, 'package', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-02', '2025-08-02', 'active', 1, 1, NULL, 'dressidale', 'ZAQ123xsw!', 1, 0, '2022-11-05 03:46:16', '2022-11-05 03:51:17'),
(17, 17, 16, 'binqbd.com', 1, 1, 'package', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-09', '2023-11-09', 'active', 1, 1, NULL, 'binqbd', 'ZAQ123xsw!', 1, 0, '2022-11-27 20:05:58', '2022-11-27 20:12:32'),
(18, 10, 9, 'roo1bd.com', 1, 1, 'package', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-05', '2023-11-05', 'active', 1, 1, NULL, 'root1bd', 'ZAQ123xsw!', 1, 0, '2022-12-04 15:41:27', '2022-12-04 15:44:31'),
(19, 18, 17, 'aerotrip.com', 0, 1, 'package', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-23', '2023-10-23', 'active', 1, 1, NULL, 'aerotrip', 'ZAQ123xsw!', 1, 0, '2022-12-04 15:56:07', '2022-12-04 15:59:10'),
(20, 19, 18, 'saplasticindustries.com', 1, 1, 'package', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-05', '2023-12-05', 'active', 1, 1, NULL, 'saplasticindustr', 'ZAQ123xsw!', 1, 0, '2022-12-06 17:21:04', '2022-12-06 17:25:29'),
(21, 20, 19, 'abonytradelink.com', 1, 1, 'package', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-13', '2023-12-13', 'active', 1, 1, NULL, 'abonytradelink', 'ZAQ123xsw!', 1, 0, '2022-12-13 17:42:45', '2022-12-27 15:11:44'),
(22, 19, 18, 'annurenterprise.com', 1, 1, 'package', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-16', '2024-02-16', 'active', 1, 1, NULL, 'annurenterprise', 'ZAQ123xsw!', 1, 0, '2023-03-07 00:31:40', '2023-03-07 00:34:40'),
(23, 10, 9, 'deshseba.org', 1, 1, 'package', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-21', '2024-02-21', 'active', 1, 1, NULL, 'deshseba', 'ZAQ123xsw!', 1, 0, '2023-03-09 05:05:09', '2023-03-09 05:09:41'),
(24, 21, 20, 'beslbd.com', 1, 1, 'package', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-03', '2024-03-03', 'active', 1, 0, NULL, 'beslbd', 'ZAQ123xsw!', 1, 0, '2023-04-09 18:07:15', '2023-06-06 18:55:41'),
(25, 22, 21, 'cbslgroupbd.com', 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02', '2024-06-02', 'active', 1, 1, NULL, NULL, NULL, 1, 0, '2023-06-06 17:54:34', '2023-06-06 17:59:53'),
(26, 22, 21, 'cbsltrading.com', 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02', '2024-06-02', 'active', 1, 1, NULL, NULL, NULL, 1, 0, '2023-06-06 18:03:46', '2023-06-06 18:13:19'),
(27, 22, 21, 'cbslconsulting.com', 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02', '2024-06-02', 'active', 1, 1, NULL, NULL, NULL, 1, 0, '2023-06-06 18:14:53', '2023-06-06 18:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `service_items`
--

CREATE TABLE `service_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: services',
  `service_type_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FR from table: service_types',
  `item_details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_items`
--

INSERT INTO `service_items` (`id`, `service_id`, `service_type_id`, `item_details`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2022-04-04 15:31:27', '2022-04-04 15:31:27'),
(2, 1, 2, NULL, '2022-04-04 15:31:27', '2022-04-04 15:31:27'),
(3, 2, 1, NULL, '2022-04-09 06:41:14', '2022-04-09 06:41:14'),
(4, 2, 2, NULL, '2022-04-09 06:41:14', '2022-04-09 06:41:14'),
(18, 9, 1, NULL, '2022-06-27 17:54:06', '2022-06-27 17:54:06'),
(19, 9, 2, NULL, '2022-06-27 17:54:06', '2022-06-27 17:54:06'),
(20, 10, 1, NULL, '2022-09-12 16:45:43', '2022-09-12 16:45:43'),
(21, 10, 2, NULL, '2022-09-12 16:45:43', '2022-09-12 16:45:43'),
(23, 11, 1, NULL, '2022-09-19 15:25:50', '2022-09-19 15:25:50'),
(24, 12, 2, NULL, '2022-10-17 18:19:55', '2022-10-17 18:19:55'),
(27, 14, 1, NULL, '2022-11-01 17:21:24', '2022-11-01 17:21:24'),
(28, 14, 2, NULL, '2022-11-01 17:21:24', '2022-11-01 17:21:24'),
(29, 15, 1, NULL, '2022-11-04 00:40:11', '2022-11-04 00:40:11'),
(30, 15, 2, NULL, '2022-11-04 00:40:11', '2022-11-04 00:40:11'),
(31, 16, 1, NULL, '2022-11-05 03:46:16', '2022-11-05 03:46:16'),
(32, 16, 2, NULL, '2022-11-05 03:46:16', '2022-11-05 03:46:16'),
(33, 17, 1, NULL, '2022-11-27 20:05:58', '2022-11-27 20:05:58'),
(34, 17, 2, NULL, '2022-11-27 20:05:58', '2022-11-27 20:05:58'),
(35, 18, 1, NULL, '2022-12-04 15:41:27', '2022-12-04 15:41:27'),
(36, 18, 2, NULL, '2022-12-04 15:41:27', '2022-12-04 15:41:27'),
(37, 19, 2, NULL, '2022-12-04 15:56:07', '2022-12-04 15:56:07'),
(38, 20, 1, NULL, '2022-12-06 17:21:04', '2022-12-06 17:21:04'),
(39, 20, 2, NULL, '2022-12-06 17:21:04', '2022-12-06 17:21:04'),
(40, 21, 1, NULL, '2022-12-13 17:42:45', '2022-12-13 17:42:45'),
(41, 21, 2, NULL, '2022-12-13 17:42:45', '2022-12-13 17:42:45'),
(42, 22, 1, NULL, '2023-03-07 00:31:40', '2023-03-07 00:31:40'),
(43, 22, 2, NULL, '2023-03-07 00:31:40', '2023-03-07 00:31:40'),
(44, 4, 1, NULL, '2023-03-08 03:35:08', '2023-03-08 03:35:08'),
(45, 4, 2, NULL, '2023-03-08 03:35:08', '2023-03-08 03:35:08'),
(46, 23, 1, NULL, '2023-03-09 05:05:09', '2023-03-09 05:05:09'),
(47, 23, 2, NULL, '2023-03-09 05:05:09', '2023-03-09 05:05:09'),
(48, 3, 1, NULL, '2023-03-22 02:54:25', '2023-03-22 02:54:25'),
(49, 3, 2, NULL, '2023-03-22 02:54:25', '2023-03-22 02:54:25'),
(52, 7, 1, NULL, '2023-05-04 02:57:36', '2023-05-04 02:57:36'),
(53, 7, 2, NULL, '2023-05-04 02:57:36', '2023-05-04 02:57:36'),
(54, 6, 1, NULL, '2023-05-04 03:27:44', '2023-05-04 03:27:44'),
(55, 6, 2, NULL, '2023-05-04 03:27:44', '2023-05-04 03:27:44'),
(56, 25, 1, NULL, '2023-06-06 17:54:34', '2023-06-06 17:54:34'),
(57, 26, 1, NULL, '2023-06-06 18:03:46', '2023-06-06 18:03:46'),
(58, 27, 1, NULL, '2023-06-06 18:14:53', '2023-06-06 18:14:53'),
(59, 13, 1, NULL, '2023-06-06 18:25:00', '2023-06-06 18:25:00'),
(60, 13, 2, NULL, '2023-06-06 18:25:00', '2023-06-06 18:25:00'),
(61, 24, 1, NULL, '2023-06-06 18:52:35', '2023-06-06 18:52:35'),
(62, 24, 2, NULL, '2023-06-06 18:52:35', '2023-06-06 18:52:35'),
(63, 8, 1, NULL, '2023-07-18 17:17:24', '2023-07-18 17:17:24'),
(64, 5, 2, NULL, '2023-07-20 13:28:30', '2023-07-20 13:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `service_logs`
--

CREATE TABLE `service_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: customers',
  `service_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK from table: services',
  `service_type_ids` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'FR array from table: service_items',
  `service_log_for` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'new/renewal',
  `service_start_date` date NOT NULL,
  `service_expire_date` date NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `invoice_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = Invoice Not Ready, 1 = Invoice Ready',
  `invoice_number` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_logs`
--

INSERT INTO `service_logs` (`id`, `customer_id`, `service_id`, `service_type_ids`, `service_log_for`, `service_start_date`, `service_expire_date`, `comment`, `invoice_status`, `invoice_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1,2', 'new', '2022-01-25', '2023-01-25', NULL, 1, 220400001, '2022-04-04 15:31:27', '2022-04-04 15:33:56'),
(2, 2, 2, '1,2', 'new', '2022-04-03', '2023-04-03', NULL, 1, 220400002, '2022-04-09 06:41:14', '2022-04-09 06:42:40'),
(3, 3, 3, '1,2', 'new', '2022-03-17', '2023-03-17', NULL, 1, 220400003, '2022-04-09 21:01:18', '2022-04-09 21:02:21'),
(4, 4, 4, '1,2', 'new', '2022-03-10', '2023-03-10', NULL, 1, 220400004, '2022-04-10 22:07:25', '2022-04-10 22:12:02'),
(5, 5, 5, '2', 'new', '2022-01-01', '2022-06-30', NULL, 1, 220400005, '2022-04-19 17:07:43', '2022-04-19 17:09:13'),
(6, 6, 6, '1,2', 'new', '2022-04-28', '2023-04-28', NULL, 1, 220500006, '2022-05-01 10:35:11', '2022-05-01 10:36:14'),
(7, 4, 7, '1,2', 'new', '2022-05-12', '2023-05-12', NULL, 1, 220500007, '2022-05-12 15:03:56', '2022-05-12 15:15:12'),
(8, 7, 8, '1,2', 'new', '2022-05-26', '2023-05-26', NULL, 1, 220500008, '2022-05-31 16:35:12', '2022-05-31 16:37:08'),
(10, 8, 9, '1,2', 'new', '2022-06-02', '2023-06-02', NULL, 1, 220600009, '2022-06-27 17:54:06', '2022-06-27 18:00:54'),
(11, 9, 10, '1,2', 'new', '2022-09-11', '2023-09-11', NULL, 1, 220900010, '2022-09-12 16:45:43', '2022-09-12 16:47:53'),
(12, 5, 5, '2', 'renewal', '2022-01-01', '2022-12-31', NULL, 1, 220900011, '2022-09-19 15:16:17', '2022-09-19 15:17:33'),
(13, 9, 11, '1', 'new', '2022-09-18', '2024-09-18', NULL, 1, 220900012, '2022-09-19 15:25:50', '2022-09-19 20:13:51'),
(14, 11, 12, '2', 'new', '2022-10-17', '2023-10-17', NULL, 1, 221000013, '2022-10-17 18:19:55', '2022-10-17 18:22:14'),
(15, 12, 13, '1,2', 'new', '2022-04-18', '2023-04-18', NULL, 1, 221100014, '2022-11-01 17:17:46', '2022-11-01 17:24:21'),
(16, 13, 14, '1,2', 'new', '2022-10-11', '2023-10-11', NULL, 1, 221100015, '2022-11-01 17:21:24', '2022-11-01 17:26:29'),
(17, 14, 15, '1,2', 'new', '2022-11-03', '2023-11-03', NULL, 1, 221100016, '2022-11-04 00:40:11', '2022-11-05 02:52:43'),
(18, 15, 16, '1,2', 'new', '2022-08-02', '2025-08-02', NULL, 1, 221100017, '2022-11-05 03:46:16', '2022-11-05 03:50:28'),
(19, 16, 17, '1,2', 'new', '2022-11-09', '2023-11-09', NULL, 1, 221100018, '2022-11-27 20:05:58', '2022-11-27 20:11:24'),
(20, 9, 18, '1,2', 'new', '2022-11-05', '2023-11-05', NULL, 1, 221200019, '2022-12-04 15:41:27', '2022-12-04 15:42:34'),
(21, 17, 19, '2', 'new', '2022-10-23', '2023-10-23', NULL, 1, 221200020, '2022-12-04 15:56:07', '2022-12-04 15:57:39'),
(22, 18, 20, '1,2', 'new', '2022-12-05', '2023-12-05', NULL, 1, 221200021, '2022-12-06 17:21:04', '2022-12-06 17:22:34'),
(23, 19, 21, '1,2', 'new', '2022-12-13', '2023-12-13', NULL, 1, 221200022, '2022-12-13 17:42:45', '2022-12-13 17:44:15'),
(24, 18, 22, '1,2', 'new', '2023-02-16', '2024-02-16', NULL, 1, 230300023, '2023-03-07 00:31:40', '2023-03-07 00:33:07'),
(25, 4, 4, '1,2', 'renewal', '2023-03-10', '2024-03-10', NULL, 1, 230300024, '2023-03-08 03:35:08', '2023-03-09 04:53:34'),
(26, 9, 23, '1,2', 'new', '2023-02-21', '2024-02-21', NULL, 1, 230300025, '2023-03-09 05:05:09', '2023-03-09 05:07:30'),
(27, 3, 3, '1,2', 'renewal', '2023-03-17', '2024-03-17', NULL, 1, 230300026, '2023-03-22 02:54:25', '2023-03-22 02:55:42'),
(28, 20, 24, '1,2', 'new', '2022-03-03', '2023-03-03', NULL, 1, 230400027, '2023-04-09 18:07:15', '2023-04-09 18:09:54'),
(29, 4, 7, '1,2', 'renewal', '2023-05-12', '2024-05-12', NULL, 1, 230500028, '2023-05-04 02:57:36', '2023-05-04 03:18:04'),
(30, 6, 6, '1,2', 'renewal', '2023-04-28', '2024-04-28', NULL, 1, 230500029, '2023-05-04 03:27:44', '2023-05-04 03:31:58'),
(31, 21, 25, '1', 'new', '2023-06-02', '2024-06-02', NULL, 1, 230600030, '2023-06-06 17:54:34', '2023-06-06 17:55:53'),
(32, 21, 26, '1', 'new', '2023-06-02', '2024-06-02', NULL, 1, 230600031, '2023-06-06 18:03:46', '2023-06-06 18:04:43'),
(33, 21, 27, '1', 'new', '2023-06-02', '2024-06-02', NULL, 1, 230600032, '2023-06-06 18:14:53', '2023-06-06 18:15:55'),
(34, 12, 13, '1,2', 'renewal', '2023-04-18', '2024-04-18', NULL, 1, 230600033, '2023-06-06 18:25:00', '2023-06-06 18:27:08'),
(35, 20, 24, '1,2', 'renewal', '2023-03-03', '2024-03-03', NULL, 1, 230600034, '2023-06-06 18:52:35', '2023-06-06 18:55:41'),
(36, 7, 8, '1', 'renewal', '2023-05-26', '2024-05-26', NULL, 1, 230700035, '2023-07-18 17:17:24', '2023-07-18 17:19:53'),
(37, 5, 5, '2', 'renewal', '2023-01-01', '2023-06-30', NULL, 1, 230800036, '2023-07-20 13:28:30', '2023-08-07 15:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `name`, `details`, `created_at`, `updated_at`) VALUES
(1, 'Domain', 'Domain Name Provide', '2022-03-03 05:52:17', '2022-03-03 14:49:56'),
(2, 'Hosting', 'Hosting Space Provide', '2022-03-03 05:52:40', '2022-03-03 14:49:35'),
(3, 'Other Services', 'Provide Other Services', '2022-03-03 05:55:07', '2022-03-03 14:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK from table: users',
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK from table: payment',
  `domain_reseller_renew_logs_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK from table: domain_reseller_renew_logs',
  `hosting_reseller_renew_logs_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK from table: hosting_reseller_renew_logs',
  `expenses` decimal(10,2) DEFAULT NULL,
  `income` decimal(10,2) DEFAULT NULL,
  `previous_balance` decimal(10,2) NOT NULL,
  `present_balance` decimal(10,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `expense_id`, `payment_id`, `domain_reseller_renew_logs_id`, `hosting_reseller_renew_logs_id`, `expenses`, `income`, `previous_balance`, `present_balance`, `description`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, NULL, NULL, 750.00, 5150.00, 5900.00, 'Paid Taka 750 for service domain humanity24.com. Total Taka 2500. Due Taka 1750', '2022-04-04 15:46:17', '2022-04-04 15:46:17'),
(2, NULL, 2, NULL, NULL, NULL, 1750.00, 5900.00, 7650.00, 'Paid Taka 1750 for service domain humanity24.com. Total Taka 1750. Due Taka 0', '2022-04-04 15:47:47', '2022-04-04 15:47:47'),
(3, NULL, 3, NULL, NULL, NULL, 3500.00, 7650.00, 11150.00, 'Paid Taka 3500 for service domain thrivebangla.com. Total Taka 3500. Due Taka 0', '2022-04-09 06:46:46', '2022-04-09 06:46:46'),
(4, NULL, 4, NULL, NULL, NULL, 2500.00, 11150.00, 13650.00, 'Paid Taka 2500 for service domain curvybd.com. Total Taka 2500. Due Taka 0', '2022-04-09 21:05:00', '2022-04-09 21:05:00'),
(5, NULL, 5, NULL, NULL, NULL, 1660.00, 13650.00, 15310.00, 'Paid Taka 1660 for service domain ictsoftbd.com. Total Taka 1660. Due Taka 0', '2022-04-10 22:14:19', '2022-04-10 22:14:19'),
(6, NULL, 6, NULL, NULL, NULL, 12500.00, 15310.00, 27810.00, 'Paid Taka 12500 for service domain bscic.gov.bd. Total Taka 12500. Due Taka 0', '2022-04-19 17:11:50', '2022-04-19 17:11:50'),
(7, NULL, 7, NULL, NULL, NULL, 2700.00, 27810.00, 30510.00, 'Paid Taka 2700 for service domain ssitfoundationbd.org. Total Taka 2700. Due Taka 0', '2022-05-01 10:38:32', '2022-05-01 10:38:32'),
(8, NULL, 8, NULL, NULL, NULL, 1750.00, 30510.00, 32260.00, 'Paid Taka 1750 for service domain aabegbd.org. Total Taka 1750. Due Taka 0', '2022-05-12 15:26:13', '2022-05-12 15:26:13'),
(9, NULL, 9, NULL, NULL, NULL, 5000.00, 32260.00, 37260.00, 'Paid Taka 5000 for service domain mmrcbd.com. Total Taka 5000. Due Taka 0', '2022-05-31 16:40:22', '2022-05-31 16:40:22'),
(10, 1, NULL, NULL, NULL, 4350.00, NULL, 37260.00, 32910.00, 'Expense Taka 4350 for Enom Refill of $50 from Jamiul Hasan\'s credit card', '2022-05-31 16:45:17', '2022-05-31 16:45:17'),
(11, NULL, 10, NULL, NULL, NULL, 1850.00, 32910.00, 34760.00, 'Paid Taka 1850 for service domain realestatesbd.com. Total Taka 1850. Due Taka 0', '2022-06-27 18:06:20', '2022-06-27 18:06:20'),
(12, 2, NULL, NULL, NULL, 9500.00, NULL, 34760.00, 25260.00, 'Expense Taka 9500 for Enom Refill of $50 from Jamiul Hasan\'s credit card', '2022-08-30 23:17:59', '2022-08-30 23:17:59'),
(13, NULL, 11, NULL, NULL, NULL, 3000.00, 25260.00, 28260.00, 'Paid Taka 3000 for service domain sweetsseller.com. Total Taka 3000. Due Taka 0', '2022-09-12 16:50:17', '2022-09-12 16:50:17'),
(14, NULL, 12, NULL, NULL, NULL, 12500.00, 28260.00, 40760.00, 'Paid Taka 12500 for service domain bscic.gov.bd. Total Taka 12500. Due Taka 0', '2022-09-19 15:20:46', '2022-09-19 15:20:46'),
(15, NULL, 13, NULL, NULL, NULL, 3000.00, 40760.00, 43760.00, 'Paid Taka 3000 for service domain meghbangladesh.com. Total Taka 3000. Due Taka 0', '2022-09-19 20:16:28', '2022-09-19 20:16:28'),
(16, 3, NULL, NULL, NULL, 22700.00, NULL, 43760.00, 21060.00, 'Expense Taka 22700 for Hosting Renew by Ashik during first week of June and September, 2022', '2022-09-19 20:31:38', '2022-09-19 20:31:38'),
(17, NULL, 14, NULL, NULL, NULL, 2200.00, 21060.00, 23260.00, 'Paid Taka 2200 for service domain www.webdesignguideline.com. Total Taka 2200. Due Taka 0', '2022-11-05 02:56:48', '2022-11-05 02:56:48'),
(18, 4, NULL, NULL, NULL, 11700.00, NULL, 23260.00, 11560.00, 'Expense Taka 11700 for $115 refill in enom on November 04, 2022', '2022-11-05 03:34:22', '2022-11-05 03:34:22'),
(19, NULL, 15, NULL, NULL, NULL, 8000.00, 11560.00, 19560.00, 'Paid Taka 8000 for service domain dressidale.com. Total Taka 8000. Due Taka 0', '2022-11-05 03:51:17', '2022-11-05 03:51:17'),
(20, NULL, 16, NULL, NULL, NULL, 2250.00, 19560.00, 21810.00, 'Paid Taka 2250 for service domain binqbd.com. Total Taka 2250. Due Taka 0', '2022-11-27 20:12:32', '2022-11-27 20:12:32'),
(21, NULL, 17, NULL, NULL, NULL, 3000.00, 21810.00, 24810.00, 'Paid Taka 3000 for service domain roo1bd.com. Total Taka 3000. Due Taka 0', '2022-12-04 15:44:31', '2022-12-04 15:44:31'),
(22, NULL, 18, NULL, NULL, NULL, 1500.00, 24810.00, 26310.00, 'Paid Taka 1500 for service domain aerotrip.com. Total Taka 1500. Due Taka 0', '2022-12-04 15:59:10', '2022-12-04 15:59:10'),
(23, NULL, 19, NULL, NULL, NULL, 2250.00, 26310.00, 28560.00, 'Paid Taka 2250 for service domain saplasticindustries.com. Total Taka 2250. Due Taka 0', '2022-12-06 17:25:29', '2022-12-06 17:25:29'),
(24, 5, NULL, NULL, NULL, 12915.00, NULL, 28560.00, 15645.00, 'Expense Taka 12915 for Hosting Renew ($126) on December 4 by Ashik', '2022-12-08 00:12:49', '2022-12-08 00:12:49'),
(25, NULL, 20, NULL, NULL, NULL, 4000.00, 15645.00, 19645.00, 'Paid Taka 4000 for service domain abonytradelink.com. Total Taka 4000. Due Taka 0', '2022-12-27 15:11:44', '2022-12-27 15:11:44'),
(26, 6, NULL, NULL, NULL, 10650.00, NULL, 19645.00, 8995.00, 'Expense Taka 10650 for $100 refill in Enom by Jami on February 1, 2023', '2023-02-01 22:58:50', '2023-02-01 22:58:50'),
(27, NULL, 21, NULL, NULL, NULL, 2250.00, 8995.00, 11245.00, 'Paid Taka 2250 for service domain annurenterprise.com. Total Taka 2250. Due Taka 0', '2023-03-07 00:34:40', '2023-03-07 00:34:40'),
(28, NULL, 22, NULL, NULL, NULL, 3200.00, 11245.00, 14445.00, 'Paid Taka 3200 for service domain deshseba.org. Total Taka 3200. Due Taka 0', '2023-03-09 05:09:41', '2023-03-09 05:09:41'),
(29, NULL, 23, NULL, NULL, NULL, 2200.00, 14445.00, 16645.00, 'Paid Taka 2200 for service domain ictsoftbd.com. Total Taka 2200. Due Taka 0', '2023-03-09 06:18:41', '2023-03-09 06:18:41'),
(30, 7, NULL, NULL, NULL, 13230.00, NULL, 16645.00, 3415.00, 'Expense Taka 13230 for Hosting Renewal by Jami on March 06, 2023', '2023-03-09 06:25:46', '2023-03-09 06:25:46'),
(31, NULL, 24, NULL, NULL, NULL, 3000.00, 3415.00, 6415.00, 'Paid Taka 3000 for service domain curvybd.com. Total Taka 3000. Due Taka 0', '2023-03-22 02:59:14', '2023-03-22 02:59:14'),
(32, NULL, 25, NULL, NULL, NULL, 2500.00, 6415.00, 8915.00, 'Paid Taka 2500 for service domain aabegbd.org. Total Taka 2500. Due Taka 0', '2023-05-04 03:23:15', '2023-05-04 03:23:15'),
(33, NULL, 26, NULL, NULL, NULL, 3200.00, 8915.00, 12115.00, 'Paid Taka 3200 for service domain ssitfoundationbd.org. Total Taka 3200. Due Taka 0', '2023-05-04 03:33:34', '2023-05-04 03:33:34'),
(34, 8, NULL, NULL, NULL, 6900.00, NULL, 12115.00, 5215.00, 'Expense Taka 6900 for Enom Refill ($65) by Jami on May 03, 2023', '2023-05-04 03:44:28', '2023-05-04 03:44:28'),
(35, NULL, 27, NULL, NULL, NULL, 7999.00, 5215.00, 13214.00, 'Paid Taka 7999 for service domain beslbd.com. Total Taka 8000. Due Taka 1', '2023-06-03 13:23:42', '2023-06-03 13:23:42'),
(36, NULL, 28, NULL, NULL, NULL, 1.00, 13214.00, 13215.00, 'Paid Taka 1 for service domain beslbd.com. Total Taka 1. Due Taka 0', '2023-06-03 13:42:10', '2023-06-03 13:42:10'),
(37, NULL, 29, NULL, NULL, NULL, 5500.00, 13215.00, 18715.00, 'Paid Taka 5500 for service domain makeupelysium.com. Total Taka 5500. Due Taka 0', '2023-06-06 17:47:46', '2023-06-06 17:47:46'),
(38, 9, NULL, NULL, NULL, 15730.00, NULL, 18715.00, 2985.00, 'Expense Taka 15730 for Hosting Renew ($147) by Jami on June 02, 2023', '2023-06-06 17:52:19', '2023-06-06 17:52:19'),
(39, NULL, 30, NULL, NULL, NULL, 1700.00, 2985.00, 4685.00, 'Paid Taka 1700 for service domain cbslgroupbd.com. Total Taka 1700. Due Taka 0', '2023-06-06 17:59:53', '2023-06-06 17:59:53'),
(40, NULL, 31, NULL, NULL, NULL, 1700.00, 4685.00, 6385.00, 'Paid Taka 1700 for service domain cbsltrading.com. Total Taka 1700. Due Taka 0', '2023-06-06 18:13:19', '2023-06-06 18:13:19'),
(41, NULL, 32, NULL, NULL, NULL, 1700.00, 6385.00, 8085.00, 'Paid Taka 1700 for service domain cbslconsulting.com. Total Taka 1700. Due Taka 0', '2023-06-06 18:16:39', '2023-06-06 18:16:39'),
(42, 10, NULL, NULL, NULL, 6420.00, NULL, 8085.00, 1665.00, 'Expense Taka 6420 for Enom Refill of $60 from Jamiul Hasan\'s credit card on June 03, 2023', '2023-06-06 18:19:36', '2023-06-06 18:19:36'),
(43, NULL, 33, NULL, NULL, NULL, 6500.00, 1665.00, 8165.00, 'Paid Taka 6500 for service domain makeupelysium.com. Total Taka 6500. Due Taka 0', '2023-07-18 17:11:56', '2023-07-18 17:11:56'),
(44, NULL, 34, NULL, NULL, NULL, 1480.00, 8165.00, 9645.00, 'Paid Taka 1480 for service domain mmrcbd.com. Total Taka 1480. Due Taka 0', '2023-07-18 17:22:30', '2023-07-18 17:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer' COMMENT 'admin/customer/executive',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `email`, `mobile`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mail.com', NULL, NULL, '$2y$10$PqQh6WdZOPjr1QrGYY/b7O.kfHxpc5dm49fH86dc05W07LbARlFce', 1, NULL, NULL, NULL),
(2, 'customer', 'mazharul_13@yahoo.com', NULL, NULL, '$2y$10$YkM3MMuKooO4Bv.X95QY5uMrsFswSdfixgaIWL7K7mt5W10H/uzpO', 0, NULL, '2022-04-04 15:25:47', '2022-04-04 15:25:47'),
(3, 'customer', 'thrivebangla@gmail.com', NULL, NULL, '$2y$10$bhwWnfgPo18LHMkjgMBa3OqkG.0jHpQwAec5doV64OZzNVwpCMZ4a', 0, NULL, '2022-04-09 06:38:53', '2022-04-09 06:38:53'),
(4, 'customer', 's.yasmin1990@yahoo.com', NULL, NULL, '$2y$10$ViwBi.TTfYRgUci1/WEY2Oofkier7HjROQFIbh2rLRMe0PYgWLov2', 0, NULL, '2022-04-09 20:17:46', '2022-04-09 20:17:46'),
(5, 'customer', 'jahid.bds@gmail.com', NULL, NULL, '$2y$10$wgHEWlKITeEFmPg6rmlrXu8L.3fXai5PkJrEZ/MiPPnxw.jXblula', 0, NULL, '2022-04-10 22:05:54', '2022-04-10 22:05:54'),
(6, 'customer', 'lavasn2010@gmail.com', NULL, NULL, '$2y$10$3VunfKbYJwJnXGBH2pqlr.EEJ6.TJBC6ojGUj9TpCm94S1y.DGB3K', 0, NULL, '2022-04-19 15:37:23', '2022-04-19 15:37:23'),
(7, 'customer', 'rejohnbd@gmail.com', NULL, NULL, '$2y$10$ospa.vj6EXV7.IKL533xkOjvxLiewsxdiGy9SkWz1iIJ6jw18ZK1q', 0, NULL, '2022-05-01 10:33:15', '2022-05-01 10:33:15'),
(8, 'customer', 'mahtabpointdk@gmail.com', NULL, NULL, '$2y$10$R5IBkvNx3NJ9vYmMV8MbzOjLKATISgPr4QA3fF4JESSprMhPfyjx2', 0, NULL, '2022-05-31 16:33:31', '2022-05-31 16:33:31'),
(9, 'customer', 'shofiur.akanda@gmail.com', NULL, NULL, '$2y$10$RBrlQo0R0U0dlgmlRVr7vOH6.vA5FCfSHVlW1BTjHkrW9UFjtzFyS', 0, NULL, '2022-06-27 03:03:55', '2022-06-27 03:03:55'),
(10, 'customer', 'rejohn.cse@outlook.com', NULL, NULL, '$2y$10$pQmiwb2aSfY92OVUuWNyme2URakYsiz6RyfAOh/2JNqtyHmRCrQBG', 0, NULL, '2022-09-12 16:17:45', '2023-03-09 05:01:21'),
(11, 'customer', 'bappy.raihan@outlook.com', NULL, NULL, '$2y$10$BsEsco.u/9XOQatiEcmlq.GO31IGq8DNRY0jdHV7qEcIaVvoyf17K', 0, NULL, '2022-10-12 19:50:08', '2022-10-12 19:50:08'),
(12, 'customer', 'tangailonline.bd@gmail.com', NULL, NULL, '$2y$10$yOFaQJn5ZAE93DqcSz9RKOTmPwqOo55vSlSCDjo2l08omojS2fvhe', 0, NULL, '2022-10-17 18:03:56', '2022-10-17 18:03:56'),
(13, 'customer', 'ishtiak_hasan@yahoo.com', NULL, NULL, '$2y$10$NIyjucZN8EcGfhkUK7chaOzFQUezs2xduFdSvS/GPJQ/2zOwtly0W', 0, NULL, '2022-11-01 17:02:18', '2022-11-01 17:02:18'),
(14, 'customer', 'info@nzsforum.net', NULL, NULL, '$2y$10$S2nOYyDevid/gwd0WYaXKuHCJoHjjy7.fDZFmDqJTOW7IneIo9nU6', 0, NULL, '2022-11-01 17:04:22', '2022-11-01 17:04:22'),
(15, 'customer', 'webevenbd@gmail.com', NULL, NULL, '$2y$10$fD6JOH9.ASqx08mDgPVrAeDqiM24izyRQQfAciu4un8R6erDbX2Xq', 0, NULL, '2022-11-04 00:38:16', '2022-11-04 00:38:16'),
(16, 'customer', 'mahrupnsu@gmail.com', NULL, NULL, '$2y$10$h2boTxA6HXhqeKzceAAp5uhnsd3SyfjaB3IYrqeW8.5g.1/YlsI4O', 0, NULL, '2022-11-05 03:21:07', '2022-11-05 03:21:07'),
(17, 'customer', 'masudfnfbd@gmail.com', NULL, NULL, '$2y$10$5c3Iiz.AbgK1Xw18KiatgeiGIB4uHuJU8sGP27JLnW1AeaHEhV3eG', 0, NULL, '2022-11-27 19:22:10', '2022-11-27 19:22:10'),
(18, 'customer', 'hashem.ahmed@outlook.com', NULL, NULL, '$2y$10$WZqca/ZB8SLNp61NWsXVxeRD/42Lt5BcGGwM.lkuJAPRjb3BBRt8m', 0, NULL, '2022-12-04 15:52:52', '2022-12-04 15:52:52'),
(19, 'customer', 'rahmanasif05004@gmail.com', NULL, NULL, '$2y$10$iPAMOMInEEr62DB673515.y0ucCWd/uE1FNlX8FLcmBVO7.h.vXku', 0, NULL, '2022-12-06 17:18:19', '2022-12-06 17:18:19'),
(20, 'customer', 'razib.al@gmail.com', NULL, NULL, '$2y$10$DBgYhY3DXi4yMHbLKayrRufG0EyACi7.cmzzVkHEfyg8us4enN7vq', 0, NULL, '2022-12-13 17:15:07', '2022-12-13 17:52:12'),
(21, 'customer', 'info@beslbd.com', NULL, NULL, '$2y$10$cBXZWklRb//G2/2mopqa4.H4dgPL5fo5auVJEFVhC3xxvzCG7Xbiq', 0, NULL, '2023-04-09 17:05:09', '2023-04-09 17:05:09'),
(22, 'customer', 'inboxlions@gmail.com', NULL, NULL, '$2y$10$fF0XOADKlSKZ8/5FbKiieuP5vi5u/BJwC..sOv6P8KX9Yh5Y79JI.', 0, NULL, '2023-06-06 17:46:25', '2023-06-06 17:46:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_accounts_created_by_foreign` (`created_by`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`),
  ADD KEY `customers_created_by_foreign` (`created_by`);

--
-- Indexes for table `customer_contact_people`
--
ALTER TABLE `customer_contact_people`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_contact_people_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_contact_people_created_by_foreign` (`created_by`);

--
-- Indexes for table `domain_resellers`
--
ALTER TABLE `domain_resellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain_reseller_renew_logs`
--
ALTER TABLE `domain_reseller_renew_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domain_reseller_renew_logs_domain_reseller_id_foreign` (`domain_reseller_id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hosting_packages`
--
ALTER TABLE `hosting_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hosting_resellers`
--
ALTER TABLE `hosting_resellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hosting_reseller_renew_logs`
--
ALTER TABLE `hosting_reseller_renew_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hosting_reseller_renew_logs_hosting_reseller_id_foreign` (`hosting_reseller_id`);

--
-- Indexes for table `initial_balance`
--
ALTER TABLE `initial_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`),
  ADD KEY `invoices_service_id_foreign` (`service_id`),
  ADD KEY `invoices_created_by_foreign` (`created_by`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_items_service_type_id_foreign` (`service_type_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_service_id_foreign` (`service_id`),
  ADD KEY `payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `payments_bank_account_id_foreign` (`bank_account_id`),
  ADD KEY `payments_created_by_foreign` (`created_by`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_user_id_foreign` (`user_id`),
  ADD KEY `services_customer_id_foreign` (`customer_id`),
  ADD KEY `services_created_by_foreign` (`created_by`);

--
-- Indexes for table `service_items`
--
ALTER TABLE `service_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_items_service_id_foreign` (`service_id`),
  ADD KEY `service_items_service_type_id_foreign` (`service_type_id`);

--
-- Indexes for table `service_logs`
--
ALTER TABLE `service_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_logs_service_id_foreign` (`service_id`),
  ADD KEY `service_logs_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customer_contact_people`
--
ALTER TABLE `customer_contact_people`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `domain_resellers`
--
ALTER TABLE `domain_resellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `domain_reseller_renew_logs`
--
ALTER TABLE `domain_reseller_renew_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hosting_packages`
--
ALTER TABLE `hosting_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hosting_resellers`
--
ALTER TABLE `hosting_resellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hosting_reseller_renew_logs`
--
ALTER TABLE `hosting_reseller_renew_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `initial_balance`
--
ALTER TABLE `initial_balance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `service_items`
--
ALTER TABLE `service_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `service_logs`
--
ALTER TABLE `service_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `customer_contact_people`
--
ALTER TABLE `customer_contact_people`
  ADD CONSTRAINT `customer_contact_people_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `customer_contact_people_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `domain_reseller_renew_logs`
--
ALTER TABLE `domain_reseller_renew_logs`
  ADD CONSTRAINT `domain_reseller_renew_logs_domain_reseller_id_foreign` FOREIGN KEY (`domain_reseller_id`) REFERENCES `domain_resellers` (`id`);

--
-- Constraints for table `hosting_reseller_renew_logs`
--
ALTER TABLE `hosting_reseller_renew_logs`
  ADD CONSTRAINT `hosting_reseller_renew_logs_hosting_reseller_id_foreign` FOREIGN KEY (`hosting_reseller_id`) REFERENCES `hosting_resellers` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `invoices_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `invoice_items_service_type_id_foreign` FOREIGN KEY (`service_type_id`) REFERENCES `service_types` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_bank_account_id_foreign` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_accounts` (`id`),
  ADD CONSTRAINT `payments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `payments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `services_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
