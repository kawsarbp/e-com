-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2022 at 09:55 AM
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
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `mobile`, `email`, `email_verified_at`, `password`, `photo`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'admin', 'subadmin', '01746755225', 'admin@gmail.com', NULL, '$2y$10$Y6by8vCSif7cyS0NzKAveubWeXQI0IqAd3YOX3MIpNVr9OeYgK3b2', '', 1, NULL, NULL, NULL),
(10, 'kawsar', 'admin', '01746755225', 'kawsarfaz100@gmail.com', NULL, '$2y$10$OmIERhckKZoBh9Js2QOYt.qRX26DK0oLhwWidANyPZVwLakrq4qsm', '889834442140522090619.png', 1, NULL, NULL, '2022-05-14 03:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `link`, `title`, `alt`, `status`, `created_at`, `updated_at`) VALUES
(1, '1.png', '', 'Black Jacket', 'Black Jacket', 1, NULL, '2022-05-12 01:59:19'),
(3, '3.png', '', 'Full Sleeve T-Shirt', 'Full Sleeve T-Shirt', 1, NULL, NULL),
(5, '799723645140522083058.png', NULL, 'Half Sleeve T-Shirt', 'Half Sleeve T-Shirt', 1, NULL, '2022-05-14 02:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Arrow', 1, NULL, '2022-05-12 01:55:49'),
(2, 'Gap', 1, NULL, NULL),
(3, 'Lee', 1, NULL, NULL),
(4, 'Monte', 1, NULL, NULL),
(5, 'Peter England', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `session_id`, `user_id`, `product_id`, `size`, `quantity`, `created_at`, `updated_at`) VALUES
(52, 'x3balhumVJnCRVuZ0A34UghEyUjBnJrv1a7yz7Jn', 1, 4, 'small', 2, '2022-05-18 04:42:03', '2022-05-18 09:06:13'),
(53, 'IYBUjZpoy9ATosix2t0wY1v6ZQG2jCTiNt5Wlhxl', 0, 2, 'small', 1, '2022-05-23 03:34:51', '2022-05-23 03:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_discount` double(8,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `category_name`, `category_images`, `category_discount`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'T-Shirts', '', 0.00, '', 't-shirt', '', '', '', 1, NULL, NULL),
(2, 1, 1, 'Casual T-Shirts', '', 0.00, '', 'casual-t-shirt', '', '', '', 1, NULL, NULL),
(3, 1, 1, 'Forman T-Shirt', NULL, NULL, NULL, 'formal-t-shirt', NULL, NULL, NULL, 1, '2022-05-11 22:44:32', '2022-05-11 22:44:32'),
(4, 0, 2, 'denims', NULL, NULL, NULL, 'denims', NULL, NULL, NULL, 1, '2022-05-11 22:44:51', '2022-05-11 22:44:51'),
(5, 0, 3, 'T-shirt', NULL, NULL, NULL, 't-shirt', NULL, NULL, NULL, 1, '2022-05-11 22:45:08', '2022-05-11 22:45:08'),
(6, 0, 1, 'T-Shirts', '', 0.00, '', 't-shirt', '', '', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `status`) VALUES
(1, 'AF', 'Afghanistan', 1),
(2, 'AL', 'Albania', 1),
(3, 'DZ', 'Algeria', 1),
(4, 'DS', 'American Samoa', 1),
(5, 'AD', 'Andorra', 1),
(6, 'AO', 'Angola', 1),
(7, 'AI', 'Anguilla', 1),
(8, 'AQ', 'Antarctica', 1),
(9, 'AG', 'Antigua and Barbuda', 1),
(10, 'AR', 'Argentina', 1),
(11, 'AM', 'Armenia', 1),
(12, 'AW', 'Aruba', 1),
(13, 'AU', 'Australia', 1),
(14, 'AT', 'Austria', 1),
(15, 'AZ', 'Azerbaijan', 1),
(16, 'BS', 'Bahamas', 1),
(17, 'BH', 'Bahrain', 1),
(18, 'BD', 'Bangladesh', 1),
(19, 'BB', 'Barbados', 1),
(20, 'BY', 'Belarus', 1),
(21, 'BE', 'Belgium', 1),
(22, 'BZ', 'Belize', 1),
(23, 'BJ', 'Benin', 1),
(24, 'BM', 'Bermuda', 1),
(25, 'BT', 'Bhutan', 1),
(26, 'BO', 'Bolivia', 1),
(27, 'BA', 'Bosnia and Herzegovina', 1),
(28, 'BW', 'Botswana', 1),
(29, 'BV', 'Bouvet Island', 1),
(30, 'BR', 'Brazil', 1),
(31, 'IO', 'British Indian Ocean Territory', 1),
(32, 'BN', 'Brunei Darussalam', 1),
(33, 'BG', 'Bulgaria', 1),
(34, 'BF', 'Burkina Faso', 1),
(35, 'BI', 'Burundi', 1),
(36, 'KH', 'Cambodia', 1),
(37, 'CM', 'Cameroon', 1),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 1),
(40, 'KY', 'Cayman Islands', 1),
(41, 'CF', 'Central African Republic', 1),
(42, 'TD', 'Chad', 1),
(43, 'CL', 'Chile', 1),
(44, 'CN', 'China', 1),
(45, 'CX', 'Christmas Island', 1),
(46, 'CC', 'Cocos (Keeling) Islands', 1),
(47, 'CO', 'Colombia', 1),
(48, 'KM', 'Comoros', 1),
(49, 'CD', 'Democratic Republic of the Congo', 1),
(50, 'CG', 'Republic of Congo', 1),
(51, 'CK', 'Cook Islands', 1),
(52, 'CR', 'Costa Rica', 1),
(53, 'HR', 'Croatia (Hrvatska)', 1),
(54, 'CU', 'Cuba', 1),
(55, 'CY', 'Cyprus', 1),
(56, 'CZ', 'Czech Republic', 1),
(57, 'DK', 'Denmark', 1),
(58, 'DJ', 'Djibouti', 1),
(59, 'DM', 'Dominica', 1),
(60, 'DO', 'Dominican Republic', 1),
(61, 'TP', 'East Timor', 1),
(62, 'EC', 'Ecuador', 1),
(63, 'EG', 'Egypt', 1),
(64, 'SV', 'El Salvador', 1),
(65, 'GQ', 'Equatorial Guinea', 1),
(66, 'ER', 'Eritrea', 1),
(67, 'EE', 'Estonia', 1),
(68, 'ET', 'Ethiopia', 1),
(69, 'FK', 'Falkland Islands (Malvinas)', 1),
(70, 'FO', 'Faroe Islands', 1),
(71, 'FJ', 'Fiji', 1),
(72, 'FI', 'Finland', 1),
(73, 'FR', 'France', 1),
(74, 'FX', 'France, Metropolitan', 1),
(75, 'GF', 'French Guiana', 1),
(76, 'PF', 'French Polynesia', 1),
(77, 'TF', 'French Southern Territories', 1),
(78, 'GA', 'Gabon', 1),
(79, 'GM', 'Gambia', 1),
(80, 'GE', 'Georgia', 1),
(81, 'DE', 'Germany', 1),
(82, 'GH', 'Ghana', 1),
(83, 'GI', 'Gibraltar', 1),
(84, 'GK', 'Guernsey', 1),
(85, 'GR', 'Greece', 1),
(86, 'GL', 'Greenland', 1),
(87, 'GD', 'Grenada', 1),
(88, 'GP', 'Guadeloupe', 1),
(89, 'GU', 'Guam', 1),
(90, 'GT', 'Guatemala', 1),
(91, 'GN', 'Guinea', 1),
(92, 'GW', 'Guinea-Bissau', 1),
(93, 'GY', 'Guyana', 1),
(94, 'HT', 'Haiti', 1),
(95, 'HM', 'Heard and Mc Donald Islands', 1),
(96, 'HN', 'Honduras', 1),
(97, 'HK', 'Hong Kong', 1),
(98, 'HU', 'Hungary', 1),
(99, 'IS', 'Iceland', 1),
(100, 'IN', 'India', 1),
(101, 'IM', 'Isle of Man', 1),
(102, 'ID', 'Indonesia', 1),
(103, 'IR', 'Iran (Islamic Republic of)', 1),
(104, 'IQ', 'Iraq', 1),
(105, 'IE', 'Ireland', 1),
(106, 'IL', 'Israel', 1),
(107, 'IT', 'Italy', 1),
(108, 'CI', 'Ivory Coast', 1),
(109, 'JE', 'Jersey', 1),
(110, 'JM', 'Jamaica', 1),
(111, 'JP', 'Japan', 1),
(112, 'JO', 'Jordan', 1),
(113, 'KZ', 'Kazakhstan', 1),
(114, 'KE', 'Kenya', 1),
(115, 'KI', 'Kiribati', 1),
(116, 'KP', 'Korea, Democratic People\'s Republic of', 1),
(117, 'KR', 'Korea, Republic of', 1),
(118, 'XK', 'Kosovo', 1),
(119, 'KW', 'Kuwait', 1),
(120, 'KG', 'Kyrgyzstan', 1),
(121, 'LA', 'Lao People\'s Democratic Republic', 1),
(122, 'LV', 'Latvia', 1),
(123, 'LB', 'Lebanon', 1),
(124, 'LS', 'Lesotho', 1),
(125, 'LR', 'Liberia', 1),
(126, 'LY', 'Libyan Arab Jamahiriya', 1),
(127, 'LI', 'Liechtenstein', 1),
(128, 'LT', 'Lithuania', 1),
(129, 'LU', 'Luxembourg', 1),
(130, 'MO', 'Macau', 1),
(131, 'MK', 'North Macedonia', 1),
(132, 'MG', 'Madagascar', 1),
(133, 'MW', 'Malawi', 1),
(134, 'MY', 'Malaysia', 1),
(135, 'MV', 'Maldives', 1),
(136, 'ML', 'Mali', 1),
(137, 'MT', 'Malta', 1),
(138, 'MH', 'Marshall Islands', 1),
(139, 'MQ', 'Martinique', 1),
(140, 'MR', 'Mauritania', 1),
(141, 'MU', 'Mauritius', 1),
(142, 'TY', 'Mayotte', 1),
(143, 'MX', 'Mexico', 1),
(144, 'FM', 'Micronesia, Federated States of', 1),
(145, 'MD', 'Moldova, Republic of', 1),
(146, 'MC', 'Monaco', 1),
(147, 'MN', 'Mongolia', 1),
(148, 'ME', 'Montenegro', 1),
(149, 'MS', 'Montserrat', 1),
(150, 'MA', 'Morocco', 1),
(151, 'MZ', 'Mozambique', 1),
(152, 'MM', 'Myanmar', 1),
(153, 'NA', 'Namibia', 1),
(154, 'NR', 'Nauru', 1),
(155, 'NP', 'Nepal', 1),
(156, 'NL', 'Netherlands', 1),
(157, 'AN', 'Netherlands Antilles', 1),
(158, 'NC', 'New Caledonia', 1),
(159, 'NZ', 'New Zealand', 1),
(160, 'NI', 'Nicaragua', 1),
(161, 'NE', 'Niger', 1),
(162, 'NG', 'Nigeria', 1),
(163, 'NU', 'Niue', 1),
(164, 'NF', 'Norfolk Island', 1),
(165, 'MP', 'Northern Mariana Islands', 1),
(166, 'NO', 'Norway', 1),
(167, 'OM', 'Oman', 1),
(168, 'PK', 'Pakistan', 1),
(169, 'PW', 'Palau', 1),
(170, 'PS', 'Palestine', 1),
(171, 'PA', 'Panama', 1),
(172, 'PG', 'Papua New Guinea', 1),
(173, 'PY', 'Paraguay', 1),
(174, 'PE', 'Peru', 1),
(175, 'PH', 'Philippines', 1),
(176, 'PN', 'Pitcairn', 1),
(177, 'PL', 'Poland', 1),
(178, 'PT', 'Portugal', 1),
(179, 'PR', 'Puerto Rico', 1),
(180, 'QA', 'Qatar', 1),
(181, 'RE', 'Reunion', 1),
(182, 'RO', 'Romania', 1),
(183, 'RU', 'Russian Federation', 1),
(184, 'RW', 'Rwanda', 1),
(185, 'KN', 'Saint Kitts and Nevis', 1),
(186, 'LC', 'Saint Lucia', 1),
(187, 'VC', 'Saint Vincent and the Grenadines', 1),
(188, 'WS', 'Samoa', 1),
(189, 'SM', 'San Marino', 1),
(190, 'ST', 'Sao Tome and Principe', 1),
(191, 'SA', 'Saudi Arabia', 1),
(192, 'SN', 'Senegal', 1),
(193, 'RS', 'Serbia', 1),
(194, 'SC', 'Seychelles', 1),
(195, 'SL', 'Sierra Leone', 1),
(196, 'SG', 'Singapore', 1),
(197, 'SK', 'Slovakia', 1),
(198, 'SI', 'Slovenia', 1),
(199, 'SB', 'Solomon Islands', 1),
(200, 'SO', 'Somalia', 1),
(201, 'ZA', 'South Africa', 1),
(202, 'GS', 'South Georgia South Sandwich Islands', 1),
(203, 'SS', 'South Sudan', 1),
(204, 'ES', 'Spain', 1),
(205, 'LK', 'Sri Lanka', 1),
(206, 'SH', 'St. Helena', 1),
(207, 'PM', 'St. Pierre and Miquelon', 1),
(208, 'SD', 'Sudan', 1),
(209, 'SR', 'Suriname', 1),
(210, 'SJ', 'Svalbard and Jan Mayen Islands', 1),
(211, 'SZ', 'Swaziland', 1),
(212, 'SE', 'Sweden', 1),
(213, 'CH', 'Switzerland', 1),
(214, 'SY', 'Syrian Arab Republic', 1),
(215, 'TW', 'Taiwan', 1),
(216, 'TJ', 'Tajikistan', 1),
(217, 'TZ', 'Tanzania, United Republic of', 1),
(218, 'TH', 'Thailand', 1),
(219, 'TG', 'Togo', 1),
(220, 'TK', 'Tokelau', 1),
(221, 'TO', 'Tonga', 1),
(222, 'TT', 'Trinidad and Tobago', 1),
(223, 'TN', 'Tunisia', 1),
(224, 'TR', 'Turkey', 1),
(225, 'TM', 'Turkmenistan', 1),
(226, 'TC', 'Turks and Caicos Islands', 1),
(227, 'TV', 'Tuvalu', 1),
(228, 'UG', 'Uganda', 1),
(229, 'UA', 'Ukraine', 1),
(230, 'AE', 'United Arab Emirates', 1),
(231, 'GB', 'United Kingdom', 1),
(232, 'US', 'United States', 1),
(233, 'UM', 'United States minor outlying islands', 1),
(234, 'UY', 'Uruguay', 1),
(235, 'UZ', 'Uzbekistan', 1),
(236, 'VU', 'Vanuatu', 1),
(237, 'VA', 'Vatican City State', 1),
(238, 'VE', 'Venezuela', 1),
(239, 'VN', 'Vietnam', 1),
(240, 'VG', 'Virgin Islands (British)', 1),
(241, 'VI', 'Virgin Islands (U.S.)', 1),
(242, 'WF', 'Wallis and Futuna Islands', 1),
(243, 'EH', 'Western Sahara', 1),
(244, 'YE', 'Yemen', 1),
(245, 'ZM', 'Zambia', 1),
(246, 'ZW', 'Zimbabwe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categories` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_option`, `coupon_code`, `categories`, `users`, `coupon_type`, `amount_type`, `amount`, `expire_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Automatic', 'pn54g0mT', '1,2', 'kawsarfaz100@gmail.com,kawsarahmed1512@gmail.com', 'Multiple Times', 'Percentage', 10.00, '2022-12-12', 1, '2022-05-12 22:13:47', '2022-05-14 00:49:38'),
(2, 'Manual', '12542365', '3', 'kawsarfaz100@gmail.com,kawsarahmed1512@gmail.com', 'Single Times', 'Fixed', 15.00, '2022-12-12', 1, '2022-05-12 22:14:19', '2022-05-12 22:25:31'),
(3, 'Automatic', 'ZJUO3OCB', '2', NULL, 'Multiple Times', 'Percentage', 12.00, '2022-12-12', 1, '2022-05-12 22:19:35', '2022-05-13 08:54:05'),
(7, 'Automatic', 'tshraVyM', '1,2,3', 'kawsarfaz100@gmail.com,kawsarahmed1512@gmail.com', 'Single Times', 'Percentage', 0.00, '2022-12-12', 1, '2022-05-15 02:03:52', '2022-05-17 05:31:20');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_addresses`
--

CREATE TABLE `delivery_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_addresses`
--

INSERT INTO `delivery_addresses` (`id`, `user_id`, `name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'kawsar ahmed', 'Nazirpur Gangpara', 'B P Nazirpur', 'pabna', 'Bangladesh', '6600', '01746755225', NULL, '2022-05-14 23:28:12', '2022-05-14 23:28:12'),
(2, 1, 'ashif hossain', 'pabna sader', 'pabna', 'sirajganj', 'Argentina', '6600', '01746755225', NULL, '2022-05-14 23:45:36', '2022-05-18 03:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_03_07_093706_create_sessions_table', 1),
(7, '2022_03_08_030603_create_admins_table', 1),
(8, '2022_03_20_040648_create_sections_table', 1),
(9, '2022_03_23_051007_create_products_table', 1),
(10, '2022_03_24_090913_create_products_attributes_table', 1),
(11, '2022_03_25_034900_create_products_images_table', 1),
(12, '2022_03_25_083245_create_brands_table', 1),
(13, '2022_03_25_131345_add_column_to_products', 1),
(14, '2022_03_28_031240_create_banners_table', 1),
(15, '2022_04_13_152432_create_carts_table', 1),
(16, '2022_04_15_112614_create_categories_table', 1),
(17, '2022_05_10_061928_add_columns_to_users_table', 1),
(18, '2022_05_12_035912_create_coupons_table', 1),
(19, '2022_05_14_083518_create_delivery_addresses_table', 2),
(22, '2022_05_15_081341_create_orders_table', 3),
(23, '2022_05_15_082015_create_orders_products_table', 3),
(25, '2022_05_16_094301_create_order_statuses_table', 4),
(27, '2022_05_16_150928_create_orders_logs_table', 5),
(29, '2022_05_17_035434_update_orders_table', 6),
(30, '2022_05_17_152043_create_shipping_charges_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_charges` double(8,2) DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_amount` double(8,2) DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_geteway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` double(8,2) DEFAULT NULL,
  `courier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `email`, `shipping_charges`, `coupon_code`, `coupon_amount`, `order_status`, `payment_method`, `payment_geteway`, `grand_total`, `courier_name`, `tracking_number`, `created_at`, `updated_at`) VALUES
(4, 1, 'kawsar ahmed', 'pabna', 'pabna', 'pabna', 'Bangladesh', '6600', '01746755225', 'kawsarfaz100@gmail.com', 0.00, NULL, NULL, 'Shipped', 'COD', 'COD', 450.00, 'Fedex', '5647645', '2022-05-17 01:20:01', '2022-05-17 01:20:19'),
(5, 1, 'kawsar ahmed', 'Nazirpur Gangpara', 'B P Nazirpur', 'pabna', 'Bangladesh', '6600', '01746755225', 'kawsarfaz100@gmail.com', 0.00, NULL, NULL, 'Shipped', 'COD', 'COD', 900.00, 'Fedex', '5647645', '2022-05-17 01:21:44', '2022-05-17 01:22:05'),
(6, 1, 'kawsar ahmed', 'Nazirpur Gangpara', 'B P Nazirpur', 'pabna', 'Bangladesh', '6600', '01746755225', 'kawsarfaz100@gmail.com', 0.00, NULL, NULL, 'Shipped', 'COD', 'COD', 5700.00, 'Fedex', '5647645', '2022-05-17 03:02:43', '2022-05-17 03:03:03'),
(7, 1, 'kawsar ahmed', 'pabna', 'pabna', 'pabna', 'Bangladesh', '6600', '01746755225', 'kawsarfaz100@gmail.com', 0.00, NULL, NULL, 'Shipped', 'COD', 'COD', 1350.00, 'Fedex', '5647645', '2022-05-17 03:06:17', '2022-05-17 03:21:54'),
(8, 1, 'kawsar ahmed', 'Nazirpur Gangpara', 'B P Nazirpur', 'pabna', 'Bangladesh', '6600', '01746755225', 'kawsarfaz100@gmail.com', 0.00, NULL, NULL, 'New', 'COD', 'COD', 1440.00, NULL, NULL, '2022-05-17 03:19:25', '2022-05-17 03:19:25'),
(9, 1, 'kawsar ahmed', 'pabna', 'pabna', 'pabna', 'Bangladesh', '6600', '01746755225', 'kawsarfaz100@gmail.com', 0.00, 'tshraVyM', 0.00, 'New', 'COD', 'COD', 450.00, NULL, NULL, '2022-05-17 05:42:35', '2022-05-17 05:42:35'),
(10, 1, 'ashif hossain', 'pabna sader', 'pabna', 'sirajganj', 'Argentina', '6600', '01746755225', 'kawsarfaz100@gmail.com', 0.00, NULL, NULL, 'New', 'COD', 'COD', 3690.00, NULL, NULL, '2022-05-18 03:55:50', '2022-05-18 03:55:50'),
(11, 1, 'ashif hossain', 'pabna sader', 'pabna', 'sirajganj', 'Argentina', '6600', '01746755225', 'kawsarfaz100@gmail.com', 0.00, NULL, NULL, 'New', 'COD', 'COD', 3690.00, NULL, NULL, '2022-05-18 04:16:50', '2022-05-18 04:16:50'),
(12, 1, 'ashif hossain', 'pabna sader', 'pabna', 'sirajganj', 'Argentina', '6600', '01746755225', 'kawsarfaz100@gmail.com', 0.00, NULL, NULL, 'New', 'COD', 'COD', 3690.00, NULL, NULL, '2022-05-18 04:18:07', '2022-05-18 04:18:07'),
(13, 1, 'kawsar ahmed', 'Nazirpur Gangpara', 'B P Nazirpur', 'pabna', 'Bangladesh', '6600', '01746755225', 'kawsarfaz100@gmail.com', 0.00, NULL, NULL, 'New', 'COD', 'COD', 2160.00, NULL, NULL, '2022-05-18 04:18:50', '2022-05-18 04:18:50'),
(14, 1, 'kawsar ahmed', 'Nazirpur Gangpara', 'B P Nazirpur', 'pabna', 'Bangladesh', '6600', '01746755225', 'kawsarfaz100@gmail.com', 0.00, 'ZJUO3OCB', 604.80, 'New', 'COD', 'COD', 4435.20, NULL, NULL, '2022-05-18 04:22:59', '2022-05-18 04:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `orders_logs`
--

CREATE TABLE `orders_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_logs`
--

INSERT INTO `orders_logs` (`id`, `order_id`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Shipped', '2022-05-17 01:20:22', '2022-05-17 01:20:22'),
(2, 5, 'Shipped', '2022-05-17 01:22:09', '2022-05-17 01:22:09'),
(3, 6, 'Shipped', '2022-05-17 03:03:06', '2022-05-17 03:03:06'),
(4, 7, 'Shipped', '2022-05-17 03:21:57', '2022-05-17 03:21:57');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` double(8,2) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `user_id`, `product_id`, `product_code`, `product_name`, `product_color`, `product_size`, `product_price`, `product_qty`, `created_at`, `updated_at`) VALUES
(4, 4, 1, 2, 'BT001', 'Red Casual T-Shirt', 'Red', NULL, 450.00, 1, '2022-05-17 01:20:01', '2022-05-17 01:20:01'),
(5, 5, 1, 1, 'BT001', 'Blue Casual T-Shirt', 'blue', 'Small', 450.00, 2, '2022-05-17 01:21:44', '2022-05-17 01:21:44'),
(6, 6, 1, 1, 'BT001', 'Blue Casual T-Shirt', 'blue', 'Large', 1350.00, 2, '2022-05-17 03:02:43', '2022-05-17 03:02:43'),
(7, 6, 1, 3, 'BT001-M', 'T-shirt', 'Blacks', 'large', 1500.00, 2, '2022-05-17 03:02:43', '2022-05-17 03:02:43'),
(8, 7, 1, 1, 'BT001', 'Blue Casual T-Shirt', 'blue', 'Large', 1350.00, 1, '2022-05-17 03:06:17', '2022-05-17 03:06:17'),
(9, 8, 1, 2, 'BT001', 'Red Casual T-Shirt', 'Red', 'large', 1440.00, 1, '2022-05-17 03:19:25', '2022-05-17 03:19:25'),
(10, 9, 1, 1, 'BT001', 'Blue Casual T-Shirt', 'blue', 'Small', 450.00, 1, '2022-05-17 05:42:35', '2022-05-17 05:42:35'),
(11, 10, 1, 2, 'BT001', 'Red Casual T-Shirt', 'Red', 'small', 450.00, 1, '2022-05-18 03:55:50', '2022-05-18 03:55:50'),
(12, 10, 1, 1, 'BT001', 'Blue Casual T-Shirt', 'blue', 'Medium', 1080.00, 3, '2022-05-18 03:55:50', '2022-05-18 03:55:50'),
(13, 11, 1, 2, 'BT001', 'Red Casual T-Shirt', 'Red', 'small', 450.00, 1, '2022-05-18 04:16:50', '2022-05-18 04:16:50'),
(14, 11, 1, 1, 'BT001', 'Blue Casual T-Shirt', 'blue', 'Medium', 1080.00, 3, '2022-05-18 04:16:50', '2022-05-18 04:16:50'),
(15, 12, 1, 2, 'BT001', 'Red Casual T-Shirt', 'Red', 'small', 450.00, 1, '2022-05-18 04:18:07', '2022-05-18 04:18:07'),
(16, 12, 1, 1, 'BT001', 'Blue Casual T-Shirt', 'blue', 'Medium', 1080.00, 3, '2022-05-18 04:18:07', '2022-05-18 04:18:07'),
(17, 13, 1, 1, 'BT001', 'Blue Casual T-Shirt', 'blue', 'Medium', 1080.00, 2, '2022-05-18 04:18:50', '2022-05-18 04:18:50'),
(18, 14, 1, 1, 'BT001', 'Blue Casual T-Shirt', 'blue', 'Medium', 1080.00, 2, '2022-05-18 04:22:59', '2022-05-18 04:22:59'),
(19, 14, 1, 2, 'BT001', 'Red Casual T-Shirt', 'Red', 'large', 1440.00, 2, '2022-05-18 04:22:59', '2022-05-18 04:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New', 1, NULL, NULL),
(2, 'Pending', 1, NULL, NULL),
(3, 'Hold', 1, NULL, NULL),
(4, 'Cancelled', 1, NULL, NULL),
(5, 'In Process', 1, NULL, NULL),
(6, 'Paid', 1, NULL, NULL),
(7, 'Shipped', 1, NULL, NULL),
(8, 'Delivered', 1, NULL, NULL);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` double(8,2) DEFAULT NULL,
  `product_discount` double(8,2) DEFAULT NULL,
  `product_weight` double(8,2) DEFAULT NULL,
  `product_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wash_care` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabric` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pattern` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sleeve` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occasion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` enum('No','Yes') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `section_id`, `brand_id`, `product_name`, `product_code`, `product_color`, `product_price`, `product_discount`, `product_weight`, `product_video`, `main_image`, `description`, `wash_care`, `fabric`, `pattern`, `sleeve`, `fit`, `occasion`, `meta_title`, `meta_description`, `meta_keywords`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'Blue Casual T-Shirt', 'BT001', 'blue', 500.00, 10.00, 200.00, '', '308434884120522044541.png', 'Test Products', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2022-05-11 22:45:41'),
(2, 2, 1, 2, 'Red Casual T-Shirt', 'BT001', 'Red', 500.00, 10.00, 200.00, '', '356450652120522044609.jpg', 'Test Products', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2022-05-11 22:46:09'),
(3, 1, 1, 1, 'T-shirt', 'BT001-M', 'Blacks', 500.00, NULL, NULL, NULL, '865838074120522044718.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, '2022-05-11 22:47:18', '2022-05-11 22:47:18'),
(4, 4, 2, 1, 'denims', 'BT001-L', 'Gray', 500.00, NULL, NULL, NULL, '527906929120522044752.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, '2022-05-11 22:47:52', '2022-05-11 22:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `products_attributes`
--

CREATE TABLE `products_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_attributes`
--

INSERT INTO `products_attributes` (`id`, `product_id`, `size`, `price`, `stock`, `sku`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Small', 500.00, 10, 'BT001-S', 1, NULL, '2022-05-15 02:08:30'),
(2, 1, 'Medium', 1200.00, 10, 'BT002-M', 1, NULL, '2022-05-15 02:08:30'),
(3, 1, 'Large', 1500.00, 15, 'BT003-L', 1, NULL, '2022-05-15 02:08:30'),
(4, 2, 'small', 500.00, 21, 'BT001-S', 1, '2022-05-11 22:50:36', '2022-05-11 22:50:36'),
(5, 2, 'medium', 1300.00, 22, 'BT001-M', 1, '2022-05-11 22:50:36', '2022-05-11 22:50:36'),
(6, 2, 'large', 1600.00, 20, 'BT001-L', 1, '2022-05-11 22:50:36', '2022-05-11 22:50:36'),
(7, 3, 'small', 500.00, 10, 'BT001-S', 1, '2022-05-11 22:51:43', '2022-05-11 22:51:43'),
(8, 3, 'medium', 1300.00, 12, 'BT001-M', 1, '2022-05-11 22:51:43', '2022-05-11 22:51:43'),
(9, 3, 'large', 1500.00, 22, 'BT001-L', 1, '2022-05-11 22:51:43', '2022-05-11 22:51:43'),
(10, 4, 'small', 500.00, 12, 'BT001-S', 1, '2022-05-11 22:52:33', '2022-05-11 22:52:33'),
(11, 4, 'medium', 1300.00, 22, 'BT001-M', 1, '2022-05-11 22:52:33', '2022-05-11 22:52:33'),
(12, 4, 'large', 1500.00, 10, 'BT001-L', 1, '2022-05-11 22:52:33', '2022-05-11 22:52:33');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '727906948240322102220.png', 1, NULL, NULL),
(2, 1, '664936784120522044825.jpg', 1, '2022-05-11 22:48:25', '2022-05-11 22:48:25'),
(3, 1, '262147156120522044825.jpg', 1, '2022-05-11 22:48:25', '2022-05-11 22:48:25'),
(4, 2, '737878757120522045052.jpg', 1, '2022-05-11 22:50:52', '2022-05-11 22:50:52'),
(5, 2, '317965035120522045052.png', 1, '2022-05-11 22:50:52', '2022-05-11 22:50:52'),
(6, 2, '656711994120522045052.jpg', 1, '2022-05-11 22:50:52', '2022-05-11 22:50:52'),
(7, 3, '318819356120522045110.jpg', 1, '2022-05-11 22:51:10', '2022-05-11 22:51:10'),
(8, 3, '838732334120522045110.png', 1, '2022-05-11 22:51:10', '2022-05-11 22:51:10'),
(9, 3, '409969280120522045110.jpg', 1, '2022-05-11 22:51:10', '2022-05-11 22:51:10'),
(10, 4, '915357351120522045159.jpg', 1, '2022-05-11 22:51:59', '2022-05-11 22:51:59'),
(11, 4, '299544885120522045159.jpg', 1, '2022-05-11 22:51:59', '2022-05-11 22:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Man', 1, NULL, '2022-05-12 01:53:34'),
(2, 'Woman', 1, NULL, NULL),
(3, 'Kids', 1, NULL, NULL),
(4, 'Man', 1, NULL, NULL),
(5, 'Woman', 1, NULL, NULL),
(6, 'Kids', 1, NULL, NULL),
(7, 'Man', 1, NULL, NULL),
(8, 'Woman', 1, NULL, NULL),
(9, 'Kids', 1, NULL, NULL),
(10, 'Man', 1, NULL, NULL),
(11, 'Woman', 1, NULL, NULL),
(12, 'Kids', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6wZHlHXdx16fJRu24Vr0W3KmKUxNBUnK7yrb9aZ6', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidnhlMlQ0RkdTZ21yeXJQNnM0N3JtZ0JFRlMzbVV1cDloNXIyMnlYciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFBVd0dSbEJFWEFHbjM5dmZYNFJ6bS44TXdQZ21TaEtNd0FNT2FPSDR5UFFKMHNXeS5zckh5Ijt9', 1652886373),
('DAukpcYrHSBgnsZ6Xznk41ZLVYFefZfexTsD9EBu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic0gxNXJVa2RscGUybVVWb3FhZGdmVXQ3bTJTR2FkbzBTYWgxMEJqZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbi1yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1653299349),
('IYBUjZpoy9ATosix2t0wY1v6ZQG2jCTiNt5Wlhxl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN3BvZmdHcVkzbW9DRVE3bnU5RFhCcHJlV2dtRUFrNkJ4Q0dLaGVBNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbi1yZWdpc3RlciI7fXM6MTA6InNlc3Npb25faWQiO3M6NDA6IklZQlVqWnBveTlBVG9zaXgydDB3WTF2NlpRRzJqQ1RpTnQ1V2xoeGwiO3M6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGVja291dCI7fX0=', 1653299335),
('TXHDMBl1SRSIqykaiQNL15cIaMpSoaEBjJIWTVMz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibEZtcXltaTlGVm9WdFNjSFVxVzdJRVozb3BCbk1CNnIxQUtNTWVyVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbi1yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1653299342),
('x3balhumVJnCRVuZ0A34UghEyUjBnJrv1a7yz7Jn', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Safari/537.36', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6IkRnM0Z5SXBRZDBaaHJkaW5WSkNySjhkQ2VwZXFzSXJ3bXNpMERTOHYiO3M6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7czo0OiJwYWdlIjtzOjk6ImRhc2hib2FyZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFBVd0dSbEJFWEFHbjM5dmZYNFJ6bS44TXdQZ21TaEtNd0FNT2FPSDR5UFFKMHNXeS5zckh5IjtzOjEwOiJzZXNzaW9uX2lkIjtzOjQwOiJ4M2JhbGh1bVZKbkNSVnVaMEEzNFVnaEV5VWpCbkpydjFhN3l6N0puIjtzOjEwOiJjb3Vwb25Db2RlIjtzOjg6IlpKVU8zT0NCIjtzOjExOiJncmFuZF90b3RhbCI7ZDo1MDA7czo4OiJvcmRlcl9pZCI7Tjt9', 1652870800);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopping_charges` double(8,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country`, `shopping_charges`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 150.00, 1, '2022-05-31 15:27:09', '2022-05-18 03:37:45'),
(2, 'Albania', 250.00, 1, '2022-05-31 15:27:09', '2022-05-18 03:37:44'),
(3, 'Algeria', 150.00, 1, '2022-05-31 15:27:09', '2022-05-17 10:50:02'),
(4, 'American Samoa', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(5, 'Andorra', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(6, 'Angola', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(7, 'Anguilla', 100.00, 1, '2022-05-31 15:27:09', '2022-05-17 11:01:38'),
(8, 'Antarctica', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(9, 'Antigua and Barbuda', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(10, 'Argentina', 300.00, 1, '2022-05-31 15:27:09', '2022-05-18 03:42:52'),
(11, 'Armenia', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(12, 'Aruba', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(13, 'Australia', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(14, 'Austria', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(15, 'Azerbaijan', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(16, 'Bahamas', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(17, 'Bahrain', 100.00, 1, '2022-05-31 15:27:09', '2022-05-31 15:27:09'),
(18, 'Bangladesh', 130.00, 1, '2022-05-31 15:27:09', '2022-05-18 03:43:08'),
(19, 'Barbados', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24'),
(20, 'Belarus', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24'),
(21, 'Belgium', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24'),
(22, 'Belize', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24'),
(23, 'Benin', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24'),
(24, 'Bermuda', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24'),
(25, 'Bhutan', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24'),
(26, 'Bolivia', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24'),
(27, 'Bosnia and Herzegovina', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24'),
(28, 'Botswana', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24'),
(29, 'Bouvet Island', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24'),
(30, 'Brazil', 80.00, 1, '2022-05-24 15:36:24', '2022-05-31 15:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `email`, `email_verified_at`, `password`, `status`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'kawsar ahmed', 'pabna', 'pabna', 'pabna', 'Bangladesh', NULL, '01746755225', 'kawsarfaz100@gmail.com', NULL, '$2y$10$PUwGRlBEXAGn39vfX4Rzm.8MwPgmShKMwAMOaOH4yPQJ0sWy.srHy', 1, NULL, NULL, NULL, NULL, NULL, '2022-05-11 22:41:37', '2022-05-14 09:15:25'),
(2, 'kawsar ahmed', NULL, NULL, NULL, NULL, NULL, '01746755225', 'kawsarahmed1512@gmail.com', NULL, '$2y$10$9.qvzje7RBWjza9.8Uf5ned5/2EniAHYkm0jXA0T9bjrOxdMJh3Gq', 1, NULL, NULL, NULL, NULL, NULL, '2022-05-12 02:07:54', '2022-05-12 02:08:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_logs`
--
ALTER TABLE `orders_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders_logs`
--
ALTER TABLE `orders_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products_attributes`
--
ALTER TABLE `products_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
