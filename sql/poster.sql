-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2018 at 02:33 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poster`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `script` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `name`, `type`, `position`, `script`, `image`, `link`, `sort_order`, `update_time`, `update_by`) VALUES
(1, '', 'Image', '212 Poster', '', '1531565141867.jpg', '', 1, '2018-07-14 00:45:41', 1),
(2, '', 'Image', '212 Poster', '', '1528175806355.jpg', '', 2, '2018-06-04 19:16:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `album_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `billing_info`
--

CREATE TABLE `billing_info` (
  `id` int(11) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `street_address` varchar(300) NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` int(11) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billing_info`
--

INSERT INTO `billing_info` (`id`, `user_id_fk`, `name`, `street_address`, `landmark`, `city`, `state`, `country`, `pincode`, `phone`, `update_time`, `update_by`) VALUES
(1, 1, 'Two One Two', 'USA', '', 'NY', 'AL', 1, '12345', '12345678', '2017-10-25 15:56:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `metatag_title` varchar(255) NOT NULL,
  `metatag_description` varchar(255) NOT NULL,
  `metatag_keywords` varchar(255) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `category_banner` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `update_by` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `description`, `metatag_title`, `metatag_description`, `metatag_keywords`, `parent`, `image`, `category_banner`, `sort_order`, `status`, `update_by`, `update_time`) VALUES
(4, 'Digital Signage', 'digital-signage', '', '', '', '', NULL, '1507525288613.png', '1507523451501.jpg', 1, 1, 1, '2017-12-09 12:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `category_service`
--

CREATE TABLE `category_service` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_service`
--

INSERT INTO `category_service` (`id`, `product_id`, `category_id`) VALUES
(1, 3, 5),
(7, 4, 5),
(17, 5, 5),
(11, 6, 5),
(14, 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `code`, `name`) VALUES
(1, 'US', 'United State'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'UM', 'United States minor outlying islands'),
(231, 'UY', 'Uruguay'),
(232, 'UZ', 'Uzbekistan'),
(233, 'VU', 'Vanuatu'),
(234, 'VA', 'Vatican City State'),
(235, 'VE', 'Venezuela'),
(236, 'VN', 'Vietnam'),
(237, 'VG', 'Virgin Islands (British)'),
(238, 'VI', 'Virgin Islands (U.S.)'),
(239, 'WF', 'Wallis and Futuna Islands'),
(240, 'EH', 'Western Sahara'),
(241, 'YE', 'Yemen'),
(242, 'ZR', 'Zaire'),
(243, 'ZM', 'Zambia'),
(244, 'ZW', 'Zimbabwe'),
(245, 'AF', 'Afghanistan');

-- --------------------------------------------------------

--
-- Table structure for table `eposter_image`
--

CREATE TABLE `eposter_image` (
  `id` int(11) NOT NULL,
  `eposter_id` int(11) NOT NULL,
  `speaker_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `sub_title` text NOT NULL,
  `footer_text` text NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `template_type` varchar(255) NOT NULL,
  `template1` longtext NOT NULL,
  `template2` longtext NOT NULL,
  `template3` longtext NOT NULL,
  `template4` longtext NOT NULL,
  `template5` text NOT NULL,
  `template6` text NOT NULL,
  `template7` text NOT NULL,
  `template8` text NOT NULL,
  `template1_title` varchar(255) NOT NULL,
  `template2_title` varchar(255) NOT NULL,
  `template3_title` varchar(255) NOT NULL,
  `template4_title` varchar(255) NOT NULL,
  `template5_title` varchar(255) NOT NULL,
  `template6_title` varchar(255) NOT NULL,
  `template7_title` varchar(255) NOT NULL,
  `template8_title` varchar(255) NOT NULL,
  `template1_video` text NOT NULL,
  `template2_video` text NOT NULL,
  `template3_video` text NOT NULL,
  `template4_video` text NOT NULL,
  `template5_video` text NOT NULL,
  `template6_video` text NOT NULL,
  `template7_video` text NOT NULL,
  `template8_video` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `template1_bgcolor` varchar(255) NOT NULL,
  `template2_bgcolor` varchar(255) NOT NULL,
  `template3_bgcolor` varchar(255) NOT NULL,
  `template4_bgcolor` varchar(255) NOT NULL,
  `template_background_type` varchar(255) NOT NULL,
  `template_bg_image` varchar(255) NOT NULL,
  `template_box_font_color` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eposter_image`
--

INSERT INTO `eposter_image` (`id`, `eposter_id`, `speaker_id`, `date_time`, `image`, `title`, `sub_title`, `footer_text`, `document_type`, `template_type`, `template1`, `template2`, `template3`, `template4`, `template5`, `template6`, `template7`, `template8`, `template1_title`, `template2_title`, `template3_title`, `template4_title`, `template5_title`, `template6_title`, `template7_title`, `template8_title`, `template1_video`, `template2_video`, `template3_video`, `template4_video`, `template5_video`, `template6_video`, `template7_video`, `template8_video`, `sort_order`, `template1_bgcolor`, `template2_bgcolor`, `template3_bgcolor`, `template4_bgcolor`, `template_background_type`, `template_bg_image`, `template_box_font_color`, `status`) VALUES
(9, 15, 16, '2018-04-26 18:26:00', '1525524774559.png', 'dsfdsf', '', 'sdfsdf sdfsdfsdf', 'Choose Template', '3', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '<p>sdf sdf dsfsd sdf sdf sd</p>\r\n', '<p>sdf sdf sdf dsfsd fdsf sdf sdf sdf</p>\r\n', '<p>sdf dsf sdf sdfsd fsd fdsf dsf sdfdsf</p>\r\n', '', '', '', '', '', 'Box 4 Title', 'Box 5 Title', 'Box 6 Title', '', '', '', '', '', '', '', '', '', '', 45, '#00aabb', '#00aabb', '#00aabb', '#00aabb', 'Background Color', '', '#ffffff', 'Yes'),
(17, 14, 16, '2018-05-25 17:30:00', '1526385765974.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry  printing and typesetting industry', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'What is Lorem Ipsum?', 'Choose Template', '2', '<p><img alt=\"\" src=\"http://192.168.0.201/arold/212/mediaLibrary/speaker16/2_Aloha_Aina_with_text_2.jpg\" style=\"width: 719px; height: 593px;\" />Box 1 <strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '<ol>\r\n	<li>sdfsdfsd</li>\r\n	<li>sdfsdsdf</li>\r\n	<li>sdfsdfsdf</li>\r\n	<li>sdfsdfsdf</li>\r\n	<li>sdfsdfsdfsf</li>\r\n	<li>sdfsdfsdfsdf</li>\r\n</ol>\r\n', '<p><img alt=\"\" src=\"http://192.168.0.201/arold/212/mediaLibrary/speaker16/Species_Survival_Partnership_Pro.jpg\" style=\"width: 692px; height: 1000px;\" />Box 3 Title <strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '<p>Box 4 Title <strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '<p>Box 5 Title <strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '<p>Box 6 Title <strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '<p>Box 7 Title <strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '', 'Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title', 'Box 2 Title Box 2 Title Box 2 Title Box 2 Title Box 2 Title Box 2 Title Box 2 Title Box 2 Title Box 2 Title', 'Box 3 Title Box 3 Title Box 3 Title Box 3 Title Box 3 Title Box 3 Title Box 3 Title Box 3 Title', 'Box 4 Title', 'Box 5 Title', 'Box 6 Title', 'Box 7 Title', '', '', 'https://www.youtube.com/watch?v=E4GVtFAQVAs', 'https://www.youtube.com/watch?v=E4GVtFAQVAs', 'https://www.youtube.com/watch?v=E4GVtFAQVAs', 'https://www.youtube.com/watch?v=E4GVtFAQVAs', 'https://www.youtube.com/watch?v=E4GVtFAQVAs', 'https://www.youtube.com/watch?v=E4GVtFAQVAs', '', 50, '#03dc90', '#ffffff', '#15ebe1', '#ceebe1', 'Background Color', '', '#403939', 'Yes'),
(18, 14, 15, '2018-05-26 19:00:00', 'N/A', 'Testing Title', 'Testing Sub Title', 'Footer Text Footer Text Footer Text Footer Text', 'Choose Template', '4', '<p>Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title&nbsp; Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title Box 1 Title</p>\r\n', '<p>Box 2 Title&nbsp; Box 2 Title&nbsp; Box 2 Title&nbsp; Box 2 Title</p>\r\n', '<p>Box 3 Title&nbsp; Box 3 Title&nbsp; Box 3 Title</p>\r\n', '<p>Box 4 Title Box 4 Title Box 4 Title Box 4 Title</p>\r\n', '<p>Box 5 Title&nbsp; Box 5 Title&nbsp; Box 5 Title&nbsp; Box 5 Title</p>\r\n', '<p>Box 6 Title&nbsp; Box 6 Title&nbsp; Box 6 Title</p>\r\n', '<p>Box 7 Title Box 7 Title Box 7 Title Box 7 Title Box 7 Title Box 7 Title Box 7 Title</p>\r\n', '', 'Box 1 Title', 'Box 2 Title', 'Box 3 Title', 'Box 4 Title', 'Box 5 Title', 'Box 6 Title', 'Box 7 Title', '', '', '', '', '', '', '', '', '', 38, '#00aabb', '#ffffff', '#10ca95', '#c1e7ee', 'Background Image', '1526471720756.jpg', '#000000', 'No'),
(19, 14, 16, '2018-07-31 15:00:00', '1531560486378.png', 'Testing Title', 'Testing Sub Title', 'sdfsdf sdfsdfsdfsdf', 'Choose Template', '1', '<p>Testing Title Testing Title Testing Title Testing Title Testing Title Testing Title Testing Title Testing Title Testing Title Testing Title Testing Title</p>\r\n', '<p>sdfdsf sdfdsf</p>\r\n', '<p>sdfsd sdfds dsfsd dsf</p>\r\n', '<p>sdf sdfds fdsfsd dsfdsf</p>\r\n', '<p>sdf dsfsd dsf dsfdsfdsf sdfsd sdf sdfsdf</p>\r\n', '', '', '', 'Box 1 Title', 'Box 2 Title', 'Box 3 Title', 'Box 4 Title', 'Box 5 Title', '', '', '', '', '', '', '', '', '', '', '', 44, '#3f4849', '#f4eded', '#1cea75', '#d60202', 'Background Color', '', '#000000', 'Yes'),
(20, 14, 16, '2018-07-28 17:00:00', '1531562023857.png', 'Testing Title', 'Hawaii Volcano  -  John Smith PhD.', 'Lorem Ipsum is simply dummy', 'Choose Template', '3', '<p>Lorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummy Lorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummy Lorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummy</p>\r\n', '<p>Lorem Ipsum is simply dummy</p>\r\n', '<p>Lorem Ipsum is simply dummy</p>\r\n', '<p>Lorem Ipsum is simply dummy</p>\r\n', '<p>Lorem Ipsum is simply dummy</p>\r\n', '<p>Lorem Ipsum is simply dummy</p>\r\n', '', '', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy', '', '', '', '', '', '', '', '', '', '', 46, '#00aabb', '#ffffff', '#87c666', '#ffffff', 'Background Color', '', '#000000', 'Yes'),
(22, 15, 16, '2018-09-30 11:39:00', '1537249205286.png', 'sdfdsf sdfsdfsdf', 'sdfsdf sdfsdf sdfsdf', 'sdfsdf sdfsdfsdf sdfsdf', 'Choose Template', '1', '<p>sdf sdf sdf sdf sdf sdf sdfs dfs fsdf</p>\r\n', '<p>sdfsd sdf sf ssdf sdfsdf sdf sf sfs fsdf</p>\r\n', '<p>sdf sdf sdf sdf sdf sdf sdf sdfsdfsdf sd fsd fs s sf s fsd fsd fsdfsdfsdf</p>\r\n', '<p>sdfsdfsdf</p>\r\n', '<p>sdfsdf sdfsdfsdf</p>\r\n', '', '', '', 'sdfsdf sdfsdf', 'sdf sdfsd fsdfsdfs', 'sdfs fsd fsdfsd sdf sdfsdf sdfs df', 'sdfsdfsdf ', 'sdfsdf sdfsdf', '', '', '', '', '', '', '', '', '', '', '', 53, '#00aabb', '#ffffff', '#ffffff', '#8f1b1b', 'Background Image', '1537249205361.jpg', '#000000', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `eposter_list`
--

CREATE TABLE `eposter_list` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `expire_date` datetime NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entry_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eposter_list`
--

INSERT INTO `eposter_list` (`id`, `slug`, `user_id`, `name`, `description`, `expire_date`, `entry_date`, `entry_by`, `status`, `image`) VALUES
(14, 'national-seminars-training', 14, 'National Seminars Training', '<p>And only National <em>Seminars</em> Training provides you with such a wide array of topics covering the problems you&#39;re facing every day.</p>\r\n\r\n<p>And only National <em>Seminars</em> Training provides you with such a wide array of topics covering the problems you&#39;re facing every day.</p>\r\n\r\n<p>And only National <em>Seminars</em> Training provides you with such a wide array of topics covering the problems you&#39;re facing every day.</p>\r\n', '2017-11-23 19:17:00', '2017-11-22 19:07:30', 14, 1, ''),
(15, 'national-seminars-training-new', 14, 'National Seminars Training New', '<p>And only National <em>Seminars</em> Training provides you with such a wide array of topics covering the problems you&#39;re facing every day.</p>\r\n\r\n<p>And only National <em>Seminars</em> Training provides you with such a wide array of topics covering the problems you&#39;re facing every day.</p>\r\n\r\n<p>And only National <em>Seminars</em> Training provides you with such a wide array of topics covering the problems you&#39;re facing every day.</p>\r\n', '2017-11-23 19:17:00', '2017-11-22 19:07:30', 14, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `albumId` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `job_applied_list`
--

CREATE TABLE `job_applied_list` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cv_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_applied_list`
--

INSERT INTO `job_applied_list` (`id`, `job_id`, `name`, `phone`, `email`, `cv_file`) VALUES
(3, 7, 'sdfsdf', '324234', 'sdf@ssdfsdf.com', '1509628644231.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE `job_category` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`id`, `slug`, `name`, `sort_order`, `status`) VALUES
(6, 'marketing-212', 'Marketing', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_list`
--

CREATE TABLE `job_list` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `expire_date` date NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_list`
--

INSERT INTO `job_list` (`id`, `slug`, `category_id`, `name`, `description`, `expire_date`, `entry_date`, `status`) VALUES
(7, 'marketing-manager-2', 6, 'Marketing Manager', '<p><strong>SALARY:</strong>&nbsp;&nbsp;&nbsp;&nbsp; $95,864.00 per year</p>\r\n\r\n<p><strong>DUTIES:&nbsp;&nbsp; </strong></p>\r\n\r\n<p style=\"margin-left:80px\"><strong>Primary Function</strong>:</p>\r\n\r\n<p style=\"margin-left:80px\">Develop and implement this Company&rsquo;s marketing and business strategy.</p>\r\n\r\n<p style=\"margin-left:80px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:80px\"><strong>Specific Duties</strong>:</p>\r\n\r\n<p style=\"margin-left:80px\">- Develop marketing projects for digital signage and interactive media solutions, with an emphasis on digital signage management and player applications, networking design and implementation, direct and e-mail campaigns, advertising, Web marketing, U.S. and International seminars, trade shows and special events, marketing communications, exhibit promotions, building directory, product catalog, mall information, and sales collateral development.</p>\r\n\r\n<p style=\"margin-left:80px\">- Identify potential e-marketing opportunities and interactive advertising solutions, including partner with Service Providers, IT&nbsp;Integrators, Ad and PR agencies, and media companies for mobile solutions, Kiosk solutions, Interactive media for a wide exposure of company&rsquo;s brand and value in the U.S. and globally and to design the best solution or create a revenue stream through the use of the digital signage solutions.</p>\r\n\r\n<p style=\"margin-left:80px\">- Develop automated programs including Website development for desktop and mobile and to achieve company&rsquo;s long-term marketing goals through the process of planning and executing the conception of fixed and mobile applications including display of advertisements using the touchscreen and non-touchscreen</p>\r\n\r\n<p style=\"margin-left:80px\">- Monitor trends for the need for new products both in the U.S. and International markets while increasing the revenue stream from base customers</p>\r\n\r\n<p style=\"margin-left:80px\">- Advertise, promote and market company&rsquo;s products and services with the collaboration of e-commerce solutions and attract new accounts via the Internet (includes working with independent contractors, marketing agencies, and web-developers) and social media.</p>\r\n\r\n<p style=\"margin-left:80px\">- Develop and analyze research material from various sources including Internet to provide statistical support for marketing and sales efforts in general and in specific industry categories as needed.</p>\r\n\r\n<p style=\"margin-left:80px\">- Develop market and technological intelligence and maintain close cooperation with U.S. and international manufacturers, suppliers and distributors.</p>\r\n\r\n<p style=\"margin-left:80px\">- Maintain existing client/customer relationships and develop new customers.</p>\r\n\r\n<p style=\"margin-left:80px\">- Develop and sustain competitive pricing strategies with a goal of maximizing company&rsquo;s market share.</p>\r\n\r\n<p style=\"margin-left:80px\">- Maximize company&rsquo;s profit margins through consulting, solution and technology partners and agents.</p>\r\n\r\n<p style=\"margin-left:80px\">- Expected to travel approx. 3 times a year for 2-3 weeks per trip within the US and globally to represent company at trade shows.</p>\r\n\r\n<p style=\"margin-left:80px\">&nbsp;</p>\r\n\r\n<p><strong>MIN. REQ&rsquo;TS:</strong></p>\r\n\r\n<p style=\"margin-left:80px\">- Master of Business Administration/International Business, Marketing or related field</p>\r\n\r\n<p style=\"margin-left:80px\">- 3 years&rsquo; experience in Marketing.</p>\r\n\r\n<p style=\"margin-left:80px\">- 3 years&rsquo; experience working directly with customers and suppliers.</p>\r\n\r\n<p style=\"margin-left:80px\">- 2 years&rsquo; experience managing or leading a team</p>\r\n\r\n<p style=\"margin-left:80px\">- 2 years&rsquo; experience with procurement and budgeting</p>\r\n\r\n<p style=\"margin-left:80px\">- 2 years&rsquo; of web and software experience with. Adobe Photoshop and Illustrator, media player, Media Software Application, and Office software packages.</p>\r\n\r\n<p style=\"margin-left:80px\">- 2 years&rsquo; experience with computer applications &amp; equipment (PC and Hardware)</p>\r\n\r\n<p style=\"margin-left:80px\">- 2 years&rsquo; experience with Analytics and Business Intelligence.</p>\r\n\r\n<p style=\"margin-left:80px\">- Willing to Travel</p>\r\n\r\n<p style=\"margin-left:80px\">- Experience representing companies/products at trade shows &ndash; minimum four (4) U.S. and/or International Trade Shows.</p>\r\n\r\n<p style=\"margin-left:80px\">&nbsp;</p>\r\n\r\n<p><strong>Hrs. per week</strong></p>\r\n\r\n<p style=\"margin-left:80px\">40 hours.&nbsp;</p>\r\n\r\n<p style=\"margin-left:80px\">&nbsp;</p>\r\n\r\n<p><strong>Contact:</strong></p>\r\n\r\n<p style=\"margin-left:80px\">Red Briou</p>\r\n\r\n<p style=\"margin-left:80px\">President</p>\r\n\r\n<p style=\"margin-left:80px\">212 Communications LLC</p>\r\n\r\n<p style=\"margin-left:80px\">1110 University Avenue, Suite 404</p>\r\n\r\n<p style=\"margin-left:80px\">Honolulu, HI 96826</p>\r\n\r\n<p style=\"margin-left:80px\">&nbsp;</p>\r\n\r\n<p>This notice is provided as a result of the filing of an application for permanent alien labor certification for the position mentioned above.&nbsp; Any person may provide documentary evidence bearing on the application to the Atlanta Processing Center -- U.S. Department of Labor, ETA, 233 Peachtree Street, Suite 410, Atlanta GA 30303</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Please submit your resume and cover letter to <a href=\"mailto:info@212com.com\">info@212com.com</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"margin-left:40px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:80px\">&nbsp;</p>\r\n', '2023-01-01', '2017-11-01 11:25:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `link_lable` varchar(50) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `additional_id` varchar(200) NOT NULL,
  `position` varchar(20) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `update_by` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `icon`, `link_lable`, `parent`, `type`, `additional_id`, `position`, `sort_order`, `status`, `update_by`, `update_time`) VALUES
(2, 'Features', '', '', NULL, 'page', '2', 'Top Menu', 2, 0, 1, '2017-11-01 01:46:26'),
(3, 'About Us', '', '', NULL, 'page', '1', 'Top Menu', 3, 1, 1, '2017-10-18 01:06:45'),
(4, 'Services', '', '', NULL, 'custom', 'http://coder71.com/projects/212/serviceCategory/all.html', 'Top Menu', 4, 0, 1, '2018-09-14 23:30:15'),
(5, 'Products', '', '', NULL, 'custom', 'http://coder71.com/projects/212/category/all.html', 'Top Menu', 5, 0, 1, '2018-09-14 23:30:07'),
(6, 'Contact Us', '', '', NULL, 'custom', 'http://coder71.com/projects/212/site/contactUs', 'Top Menu', 7, 1, 1, '2017-11-01 02:23:23'),
(7, 'Career', '', '', NULL, 'custom', 'http://coder71.com/projects/212/jobList', 'Top Menu', 6, 0, 1, '2018-09-14 23:30:35'),
(8, 'Gallery', '', '', NULL, 'custom', 'http://coder71.com/projects/212/site/album', 'Top Menu', 5, 1, 1, '2017-11-01 02:26:15'),
(9, 'Posters212', '', '', NULL, 'custom', 'http://192.168.0.201/arold/poster/posters212', 'Top Menu', 6, 1, 1, '2018-09-13 04:46:45'),
(10, 'Features', '', '', NULL, 'page', '2', 'Footer Menu Left', 2, 0, 1, '2017-11-01 01:46:26'),
(11, 'About Us', '', '', NULL, 'page', '1', 'Footer Menu Left', 3, 1, 1, '2017-10-18 01:06:45'),
(12, 'Services', '', '', NULL, 'custom', 'http://coder71.com/projects/212/serviceCategory/all.html', 'Footer Menu Left', 4, 1, 1, '2017-10-18 12:06:10'),
(13, 'Products', '', '', NULL, 'custom', 'http://coder71.com/projects/212/category/all.html', 'Footer Menu Left', 5, 1, 1, '2017-10-18 12:06:19'),
(14, 'Contact Us', '', '', NULL, 'custom', 'http://coder71.com/projects/212/site/contactUs', 'Footer Menu Left', 7, 1, 1, '2017-11-01 02:23:23'),
(15, 'Career', '', '', NULL, 'custom', 'http://coder71.com/projects/212/jobList', 'Footer Menu Left', 6, 1, 1, '2017-11-01 02:23:36'),
(16, 'Gallery', '', '', NULL, 'custom', 'http://coder71.com/projects/212/site/album', 'Footer Menu Left', 5, 1, 1, '2017-11-01 02:26:15'),
(17, '212Poster', '', '', NULL, 'custom', 'http://coder71.com/projects/212/212poster', 'Footer Menu Left', 6, 1, 1, '2017-11-22 12:43:37'),
(18, 'Features', '', '', NULL, 'page', '2', 'Footer Menu Right', 2, 0, 1, '2017-11-01 01:46:26'),
(19, 'About Us', '', '', NULL, 'page', '1', 'Footer Menu Right', 3, 1, 1, '2017-10-18 01:06:45'),
(20, 'Services', '', '', NULL, 'custom', 'http://coder71.com/projects/212/serviceCategory/all.html', 'Footer Menu Right', 4, 1, 1, '2017-10-18 12:06:10'),
(21, 'Products', '', '', NULL, 'custom', 'http://coder71.com/projects/212/category/all.html', 'Footer Menu Right', 5, 1, 1, '2017-10-18 12:06:19'),
(22, 'Contact Us', '', '', NULL, 'custom', 'http://coder71.com/projects/212/site/contactUs', 'Footer Menu Right', 7, 1, 1, '2017-11-01 02:23:23'),
(23, 'Career', '', '', NULL, 'custom', 'http://coder71.com/projects/212/jobList', 'Footer Menu Right', 6, 1, 1, '2017-11-01 02:23:36'),
(24, 'Gallery', '', '', NULL, 'custom', 'http://coder71.com/projects/212/site/album', 'Footer Menu Right', 5, 1, 1, '2017-11-01 02:26:15'),
(25, '212Poster', '', '', NULL, 'custom', 'http://coder71.com/projects/212/212poster', 'Footer Menu Right', 6, 1, 1, '2017-11-22 12:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `delivery_charge` decimal(11,2) NOT NULL,
  `vat` decimal(11,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(11,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(11,2) NOT NULL,
  `grand_total` decimal(11,2) NOT NULL,
  `billing_info` varchar(1000) NOT NULL,
  `delivery_info` varchar(1000) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `identity_text` varchar(20) NOT NULL,
  `flag_id` int(11) NOT NULL DEFAULT '0',
  `made_by` varchar(10) NOT NULL DEFAULT 'Self',
  `order_note` text NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'Due',
  `artwork_approved_status` varchar(255) NOT NULL,
  `confirmed_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `production_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `received_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `shipped_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `canceled_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bank_id` int(11) DEFAULT NULL,
  `currency` varchar(50) NOT NULL DEFAULT 'sgd'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_number`, `user_id_fk`, `total`, `delivery_charge`, `vat`, `tax`, `discount`, `grand_total`, `billing_info`, `delivery_info`, `payment_method`, `shipping_method`, `order_date`, `update_time`, `update_by`, `status`, `identity_text`, `flag_id`, `made_by`, `order_note`, `payment_status`, `artwork_approved_status`, `confirmed_date`, `production_date`, `received_date`, `shipped_date`, `canceled_date`, `bank_id`, `currency`) VALUES
(11, 'TOT18011', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '{\"id\":\"1\",\"user_id_fk\":\"1\",\"name\":\"Two One Two\",\"street_address\":\"USA\",\"landmark\":\"\",\"city\":\"NY\",\"state\":\"AL\",\"country\":\"1\",\"pincode\":\"12345\",\"phone\":\"12345678\",\"update_time\":\"2017-10-26 15:56:59\",\"update_by\":\"1\"}', '{\"id\":\"1\",\"user_id_fk\":\"1\",\"name\":\"Two One Two\",\"street_address\":\"USA\",\"landmark\":\"\",\"city\":\"NY\",\"state\":\"AL\",\"country\":\"1\",\"pincode\":\"12345\",\"phone\":\"12345678\",\"update_time\":\"2017-10-24 08:24:35\",\"update_by\":\"1\"}', 0, 1, '2018-01-03 12:29:32', '2018-01-03 06:29:32', 1, 'Pending', 'S', 0, 'Self', '', 'Due', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'usd');

-- --------------------------------------------------------

--
-- Table structure for table `order_invoice`
--

CREATE TABLE `order_invoice` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `users_id_fk` int(11) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_amount` decimal(11,2) NOT NULL,
  `due_date` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `payment_status` varchar(255) NOT NULL DEFAULT 'Due',
  `payment_method` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `note` text NOT NULL,
  `product_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_invoice`
--

INSERT INTO `order_invoice` (`id`, `order_id`, `users_id_fk`, `invoice_number`, `invoice_date`, `invoice_amount`, `due_date`, `status`, `payment_status`, `payment_method`, `payment_date`, `note`, `product_info`) VALUES
(1, 11, 1, 'INV18011', '2018-01-04', '0.00', '2018-01-04 00:00:00', 'Pending', 'Due', '', '0000-00-00', '', '[{\"id\":\"13\",\"price\":0}]'),
(2, 11, 1, 'INV18012', '2018-02-03', '0.00', '2018-02-08 00:00:00', 'Pending', 'Due', '', '0000-00-00', '', '[{\"id\":\"13\",\"price\":0}]'),
(3, 11, 1, 'INV18013', '2018-03-05', '0.00', '2018-03-10 00:00:00', 'Pending', 'Due', '', '0000-00-00', '', '[{\"id\":\"13\",\"price\":0}]');

-- --------------------------------------------------------

--
-- Table structure for table `order_payment_history`
--

CREATE TABLE `order_payment_history` (
  `id` int(11) NOT NULL,
  `gateway` varchar(20) NOT NULL,
  `order_id_fk` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `others` text,
  `others2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_proccessing_history`
--

CREATE TABLE `order_proccessing_history` (
  `id` int(11) NOT NULL,
  `order_id_fk` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_proccessing_history`
--

INSERT INTO `order_proccessing_history` (`id`, `order_id_fk`, `status`, `update_time`, `update_by`) VALUES
(1, 1, 'Pending', '2017-10-23 08:26:54', 1),
(2, 2, 'Pending', '2017-10-23 08:31:02', 1),
(3, 3, 'Pending', '2017-10-23 08:57:15', 1),
(4, 4, 'Pending', '2017-10-24 08:28:55', 1),
(5, 5, 'Pending', '2017-10-24 10:36:48', 1),
(6, 5, 'Confirmed', '2017-10-25 05:00:47', 1),
(7, 4, 'Confirmed', '2017-10-25 05:31:42', 1),
(8, 3, 'Confirmed', '2017-10-25 05:32:39', 1),
(9, 3, 'Canceled', '2017-10-25 05:58:32', 1),
(10, 4, 'Shipped', '2017-10-25 06:17:34', 1),
(11, 5, 'Shipped', '2017-10-25 06:19:24', 1),
(12, 3, 'Pending', '2017-10-25 06:25:34', 1),
(13, 3, 'Canceled', '2017-10-25 06:25:43', 1),
(14, 3, 'Confirmed', '2017-10-25 06:25:48', 1),
(15, 6, 'Pending', '2017-10-25 08:57:37', 1),
(16, 7, 'Pending', '2017-10-25 15:56:59', 1),
(17, 7, 'Canceled', '2017-10-25 16:24:29', 1),
(18, 6, 'Canceled', '2017-10-25 16:24:30', 1),
(19, 2, 'Canceled', '2017-10-25 16:24:30', 1),
(20, 1, 'Canceled', '2017-10-25 16:24:30', 1),
(21, 8, 'Pending', '2017-11-01 19:49:13', 1),
(22, 9, 'Pending', '2017-11-01 19:51:00', 1),
(23, 10, 'Pending', '2017-12-17 15:14:41', 1),
(24, 11, 'Pending', '2018-01-03 12:29:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id_fk` int(11) NOT NULL,
  `products_id_fk` int(11) NOT NULL,
  `options` varchar(300) NOT NULL,
  `item_from` varchar(255) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `special_instruction` varchar(300) NOT NULL,
  `subscribtion_month` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id_fk`, `products_id_fk`, `options`, `item_from`, `price`, `qty`, `total`, `special_instruction`, `subscribtion_month`) VALUES
(1, 2, 10, 'N/A', '', '23.00', 3, '69.00', '', 0),
(2, 3, 9, 'N/A', '', '2000.00', 1, '2000.00', '', 0),
(3, 3, 29, 'N/A', '', '2.50', 1, '2.50', '', 0),
(4, 4, 8, 'N/A', '', '120.00', 1, '120.00', '', 0),
(5, 5, 8, 'N/A', '', '120.00', 1, '120.00', '', 0),
(6, 6, 8, 'N/A', '', '120.00', 1, '120.00', '', 0),
(7, 6, 29, 'N/A', '', '2.50', 1, '2.50', '', 0),
(8, 7, 8, 'N/A', '', '120.00', 1, '120.00', '', 0),
(9, 8, 8, 'N/A', '', '120.00', 1, '120.00', '', 0),
(10, 9, 9, 'N/A', '', '2000.00', 1, '2000.00', '', 0),
(11, 10, 8, '[\"5\",\"6\"]', 'Product', '11.00', 1, '11.00', '', 0),
(12, 10, 5, 'null', 'Service', '0.00', 1, '0.00', '', 0),
(13, 11, 5, 'null', 'Service', '0.00', 1, '0.00', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` longtext NOT NULL,
  `slug` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `meta_keyword` varchar(500) NOT NULL,
  `meta_description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `entry_by` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `title`, `description`, `slug`, `image`, `meta_keyword`, `meta_description`, `status`, `entry_by`, `entry_date`, `update_by`, `update_time`) VALUES
(1, 'About Us', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '', '', '', '', 1, 0, '2017-10-18 13:06:21', 1, '2017-11-08 10:55:13'),
(2, 'Features', '<h1 class=\"section-title\">Features</h1>\r\n<hr class=\"lines\">\r\n\r\n  <div class=\"row margin-bottom-50\">\r\n    <div class=\"col-md-3\"> <img src=\"http://coder71.com/projects/212/mediaLibrary/f01.jpg\"> </div>\r\n    <div class=\"col-md-9\">\r\n      <h4>Any Screen Type or Size</h4>\r\n      <p>The service works on a simple scalable network securely controlled through an existing broadband internet connection. Your network can be easily up-sized to include new screens of any size or type as and when you need them. One screen can be part of as many groups as you like, so you need never send the same item more than once.</p>\r\n    </div>\r\n  </div>\r\n  \r\n  \r\n  <div class=\"row margin-bottom-50\">\r\n  	<div class=\"col-md-9\">\r\n      <h4>Powered by the Cloud</h4>\r\n      <p>The service works on a simple scalable network securely controlled through an existing broadband internet connection. Your network can be easily up-sized to include new screens of any size or type as and when you need them. One screen can be part of as many groups as you like, so you need never send the same item more than once.</p>\r\n    </div>\r\n    <div class=\"col-md-3\"> <img src=\"http://coder71.com/projects/212/mediaLibrary/02.jpg\"> </div>    \r\n  </div>\r\n  \r\n  \r\n  \r\n  <div class=\"row margin-bottom-50\">\r\n    <div class=\"col-md-3\"> <img src=\"http://coder71.com/projects/212/mediaLibrary/03.jpg\"> </div>\r\n    <div class=\"col-md-9\">\r\n      <h4>Easy to Edit or Reschedule</h4>\r\n      <p>The service works on a simple scalable network securely controlled through an existing broadband internet connection. Your network can be easily up-sized to include new screens of any size or type as and when you need them. One screen can be part of as many groups as you like, so you need never send the same item more than once.</p>\r\n    </div>\r\n  </div>\r\n  \r\n  <div class=\"row margin-bottom-50\">\r\n  	<div class=\"col-md-9\">\r\n      <h4>Group Multiple Screens</h4>\r\n      <p>The service works on a simple scalable network securely controlled through an existing broadband internet connection. Your network can be easily up-sized to include new screens of any size or type as and when you need them. One screen can be part of as many groups as you like, so you need never send the same item more than once.</p>\r\n    </div>\r\n    <div class=\"col-md-3\"> <img src=\"http://coder71.com/projects/212/mediaLibrary/04.jpg\"> </div>    \r\n  </div>\r\n  ', '', '', '', '', 1, 0, '2017-10-18 14:18:42', 1, '2017-10-20 10:36:03'),
(3, 'Welcome to 212 Communication', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '', '', '', '', 1, 0, '2017-10-20 09:59:38', 1, '2017-11-08 11:13:33'),
(4, 'Features', '  <div class=\"row margin-bottom-50\">\r\n    <div class=\"col-md-3\"> <img src=\"http://coder71.com/projects/212/mediaLibrary/f01.jpg\"> </div>\r\n    <div class=\"col-md-9\">\r\n      <h4>Any Screen Type or Size</h4>\r\n      <p>The service works on a simple scalable network securely controlled through an existing broadband internet connection. Your network can be easily up-sized to include new screens of any size or type as and when you need them. One screen can be part of as many groups as you like, so you need never send the same item more than once.</p>\r\n    </div>\r\n  </div>\r\n  \r\n  \r\n  <div class=\"row margin-bottom-50\">\r\n  	<div class=\"col-md-9\">\r\n      <h4>Powered by the Cloud</h4>\r\n      <p>The service works on a simple scalable network securely controlled through an existing broadband internet connection. Your network can be easily up-sized to include new screens of any size or type as and when you need them. One screen can be part of as many groups as you like, so you need never send the same item more than once.</p>\r\n    </div>\r\n    <div class=\"col-md-3\"> <img src=\"http://coder71.com/projects/212/mediaLibrary/02.jpg\"> </div>    \r\n  </div>\r\n  \r\n  \r\n  \r\n  <div class=\"row margin-bottom-50\">\r\n    <div class=\"col-md-3\"> <img src=\"http://coder71.com/projects/212/mediaLibrary/03.jpg\"> </div>\r\n    <div class=\"col-md-9\">\r\n      <h4>Easy to Edit or Reschedule</h4>\r\n      <p>The service works on a simple scalable network securely controlled through an existing broadband internet connection. Your network can be easily up-sized to include new screens of any size or type as and when you need them. One screen can be part of as many groups as you like, so you need never send the same item more than once.</p>\r\n    </div>\r\n  </div>\r\n  \r\n  <div class=\"row margin-bottom-50\">\r\n  	<div class=\"col-md-9\">\r\n      <h4>Group Multiple Screens</h4>\r\n      <p>The service works on a simple scalable network securely controlled through an existing broadband internet connection. Your network can be easily up-sized to include new screens of any size or type as and when you need them. One screen can be part of as many groups as you like, so you need never send the same item more than once.</p>\r\n    </div>\r\n    <div class=\"col-md-3\"> <img src=\"http://coder71.com/projects/212/mediaLibrary/04.jpg\"> </div>    \r\n  </div>\r\n  \r\n', '', '', '', '', 1, 0, '2017-10-20 10:37:57', 1, '2017-10-20 10:37:57'),
(5, 'Industries that apply our services', '  \r\n  \r\n  <div class=\"\">\r\n  	<a href=\"#\">\r\n    	<div class=\"col-md-3 airport\">\r\n    		<div class=\"service_box\">\r\n            	<div><img src=\"http://coder71.com/projects/212/mediaLibrary/airplane.png\"></div>\r\n                <div>Airplane</div>                \r\n            </div>\r\n    	</div>\r\n    </a>\r\n    \r\n    <a href=\"#\">\r\n        <div class=\"col-md-3 banking\">\r\n            <div class=\"service_box\">\r\n            	<div><img src=\"http://coder71.com/projects/212/mediaLibrary/banking.png\"></div>\r\n                <div>Banking</div> \r\n            </div>\r\n        </div>\r\n    </a>\r\n    \r\n    <a href=\"#\">\r\n        <div class=\"col-md-3 education\">\r\n            <div class=\"service_box\">\r\n            	<div><img src=\"http://coder71.com/projects/212/mediaLibrary/education.png\"></div>\r\n                <div>Education</div> \r\n            </div>\r\n        </div>\r\n    </a>\r\n    \r\n    <a href=\"#\">\r\n        <div class=\"col-md-3 government\">\r\n            <div class=\"service_box\">\r\n            	<div><img src=\"http://coder71.com/projects/212/mediaLibrary/government.png\"></div>\r\n                <div>Government</div> \r\n            </div>\r\n        </div>\r\n    </a>    \r\n    \r\n    <a href=\"#\">\r\n        <div class=\"col-md-3 healcare\">\r\n            <div class=\"service_box\">\r\n            	<div><img src=\"http://coder71.com/projects/212/mediaLibrary/healcare.png\"></div>\r\n                <div>Healcare</div> \r\n            </div>\r\n        </div>\r\n    </a>\r\n    \r\n    <a href=\"#\">\r\n    <div class=\"col-md-3 telecom\">\r\n    	<div class=\"service_box\">\r\n        	<div><img src=\"http://coder71.com/projects/212/mediaLibrary/telecom.png\"></div>\r\n                <div>Telecom</div> \r\n        </div>\r\n    </div>\r\n    </a>\r\n    \r\n    <a href=\"#\">\r\n     <div class=\"col-md-3 stockexchange\">\r\n    	<div class=\"service_box\">\r\n        	<div><img src=\"http://coder71.com/projects/212/mediaLibrary/stock_exchange.png\"></div>\r\n                <div>Stock Exchange</div> \r\n        </div>\r\n    </div>\r\n    </a>\r\n    \r\n    <a href=\"#\">\r\n    <div class=\"col-md-3 retail\">\r\n    	<div class=\"service_box\">\r\n        	<div><img src=\"http://coder71.com/projects/212/mediaLibrary/retail.png\"></div>\r\n                <div>Retail</div> \r\n        </div>\r\n    </div>\r\n    </a>\r\n    \r\n  </div>\r\n  \r\n', '', '', '', '', 1, 0, '2017-10-20 10:57:42', 1, '2017-10-20 10:57:42'),
(6, 'Contact Us', '<ul class=\"contact-list\">\r\n                <li><i class=\"icon-home\"></i> <span>212 Communications\r\n1110 University Ave. Suite 404\r\nHonolulu, HI 96826 USA</span></li>\r\n                <li><i class=\"icon-call-out\"></i> <span>808-520-0124</span></li>\r\n                <li><i class=\"icon-envelope\"></i> <span>info@212com.com</span></li>\r\n              </ul>', '', '', '', '', 1, 0, '2017-11-01 20:32:55', 1, '2017-11-01 02:35:16'),
(7, 'Terms and Conditions', '<p>Terms and Conditions</p>\r\n', '', '', '', '', 1, 0, '2018-07-18 23:26:16', 1, '2018-07-18 19:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=enable,2=disable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `name`, `status`) VALUES
(1, 'Top Menu', 1),
(2, 'Footer Menu Left', 1),
(3, 'Footer Menu Right', 1);

-- --------------------------------------------------------

--
-- Table structure for table `poster_rating`
--

CREATE TABLE `poster_rating` (
  `id` int(11) NOT NULL,
  `poster_id` int(11) NOT NULL,
  `rating_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poster_rating`
--

INSERT INTO `poster_rating` (`id`, `poster_id`, `rating_point`) VALUES
(1, 17, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `specification` text NOT NULL,
  `feature` text NOT NULL,
  `benifits` text NOT NULL,
  `quick_view` text NOT NULL,
  `metatag_title` varchar(255) NOT NULL,
  `metatag_description` varchar(255) NOT NULL,
  `metatag_keywords` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `reseller_price` decimal(11,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `seo_keyword` varchar(255) NOT NULL,
  `featured` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `specification`, `feature`, `benifits`, `quick_view`, `metatag_title`, `metatag_description`, `metatag_keywords`, `image`, `model`, `sku`, `price`, `reseller_price`, `quantity`, `seo_keyword`, `featured`, `status`, `sort_order`, `update_by`, `update_time`) VALUES
(8, 'Hardware Solution Packages', 'hardware-solution-packages', '<ul>\r\n	<li>All in one digital signage solution from 212 Communications is a turnkey package including display (touch or non touchscreen), high performance media player (Windows, Linux, or Android OS), and high performance enclosure.</li>\r\n</ul>\r\n\r\n<p><strong>Options:</strong></p>\r\n\r\n<ul>\r\n	<li>Wall mounted displays</li>\r\n	<li>Floor mounted displays</li>\r\n	<li>Single sided and double sided displays</li>\r\n	<li>Table Horizontal display</li>\r\n	<li>Standing small screen display</li>\r\n</ul>\r\n', '<p>Videowall<br />\r\n2x2, 3x3, 4x4<br />\r\n47&rdquo;, 55&rdquo;<br />\r\nAvailable 2ith 3.5mm bezel width<br />\r\nUltra-narrow bezels<br />\r\nSuperior brightness<br />\r\nAnti-reflective glass</p>\r\n', '<p>All in one Wall Display<br />\r\nAvailable in touch and non touchscreen<br />\r\nSizes: 15 to 65 inch</p>\r\n\r\n<p>All in one Wall and Ceiling<br />\r\nAvailable in non touchscreen<br />\r\nSizes: 15 to 22 inch</p>\r\n\r\n<p>All in one Floor<br />\r\nAvailable in touch and non touchscreen<br />\r\nSizes: 15 to 65 inch</p>\r\n\r\n<p>All in one Floor<br />\r\nAvailable in touch and non touchscreen<br />\r\nSizes: 15 to 65 inch</p>\r\n\r\n<p>All in one Table<br />\r\nAvailable in touch and non touchscreen<br />\r\nSizes: 15 to 42 inch</p>\r\n\r\n<p>All in one Standing<br />\r\nAvailable in touch and non touchscreen<br />\r\nSizes: 17 &amp; 19 inch</p>\r\n', '', 'All in one digital signage solution from 212 Communications is a turnkey package including display (touch or non touchscreen), high performance media player (Windows, Linux, or Android OS), and high performance enclosure.', 'Test', '', '', '1512908565570.png', 'Test', 'Test', '0.00', '0.00', 5, '', 1, 1, 1, 1, '2017-12-09 12:24:26'),
(9, '212 Communications Signage Package', '212-communications-signage-package', '<ul>\r\n	<li>Complete &amp; Turnkey solution</li>\r\n	<li>All in one floor or wall mounted model</li>\r\n	<li>Sizes: 42, 46 or 55 inch</li>\r\n	<li>Standard design for touch or non touchscreen application</li>\r\n	<li>1 year of Signage SaaS</li>\r\n	<li>1 year of tech support</li>\r\n	<li>1 year of warranty</li>\r\n	<li>Training</li>\r\n</ul>\r\n', '', '', '', 'Complete & Turnkey solution All in one floor or wall mounted model Sizes: 42, 46 or 55 inch Standard design for touch or non touchscreen application 1 year of Signage SaaS  1 year of tech support 1 year of warranty Training.', 'sdfsdfsdf', '', '', '1512910106153.png', 'Test', 'Test', '0.00', '0.00', 33, '', 1, 1, 2, 1, '2017-12-09 12:48:26'),
(10, 'Mobile Digital Signage Station Package', 'mobile-digital-signage-station-package', '<p><strong>Description:</strong></p>\r\n\r\n<ul>\r\n	<li>All in one mobile digital signage solution from 212 Communications is a turnkey package including display high performance media player with windows OS, and high performance mobile stand.</li>\r\n</ul>\r\n\r\n<p><strong>Package Information:</strong></p>\r\n\r\n<ul>\r\n	<li>Standard i3 processor, options i5 or i7</li>\r\n	<li>Standard 32 inch, options 42 inch and 50 inch &ndash; LED</li>\r\n	<li>Standard non touchscreen, option touchscreen</li>\r\n	<li>Portrait or Landscape configurable mounting</li>\r\n	<li>1080 x 1920 portrait or 1920 x 1080 landscape</li>\r\n	<li>Ethernet and WiFi included</li>\r\n	<li>1 Year of Digital Signage SaaS included</li>\r\n	<li>4 hours of digital signage application training</li>\r\n	<li>1 Year Tech Support</li>\r\n	<li>1 Year warranty</li>\r\n</ul>\r\n', '', '', '', 'All in one mobile digital signage solution from 212 Communications is a turnkey package including display high performance media player with windows OS, and high performance mobile stand.', 'sdfsdfsdf', '', '', '1512910732426.png', 'Test', 'Test', '0.00', '0.00', 5, '', 0, 1, 3, 1, '2017-12-09 12:58:52'),
(11, 'Mobile Digital Signage Station', 'mobile-digital-signage-station', '<p><strong>Description:</strong><br />\r\nAll in one mobile digital signage solution from 212 Communications is a turnkey package including display high performance media player with windows OS, and high performance mobile stand.<br />\r\n<strong>Package Information:</strong></p>\r\n\r\n<ul>\r\n	<li>Standard i3 processor, options i5 or i7</li>\r\n	<li>Standard 32 inch, options 42 inch and 50 inch &ndash; LED</li>\r\n	<li>Standard non touchscreen, option touchscreen</li>\r\n	<li>Portrait or Landscape configurable mounting</li>\r\n	<li>1080 x 1920 portrait or 1920 x 1080 landscape</li>\r\n	<li>Ethernet and WiFi included</li>\r\n	<li>1 Year warranty</li>\r\n</ul>\r\n\r\n<p><strong>Optional Services:</strong></p>\r\n\r\n<ul>\r\n	<li>Digital Signage SaaS (Application and storage)</li>\r\n	<li>Training and Support</li>\r\n</ul>\r\n', '', '', '', 'All in one mobile digital signage solution from 212 Communications is a turnkey package including display high performance media player with windows OS, and high performance mobile stand.', 'Test', '', '', '1512911182347.png', 'Test', 'Test', '0.00', '0.00', 0, '', 1, 1, 0, 1, '2017-12-09 01:06:22'),
(12, 'Digital Event Management', 'digital-event-management', '<ul>\r\n	<li>Digital Signage Touchscreen</li>\r\n	<li>Schedule Digital Signage</li>\r\n	<li>Advertising</li>\r\n	<li>Session Digital Signage</li>\r\n	<li>Poster &amp; Abstract display</li>\r\n	<li>Videowall</li>\r\n	<li>Digital Signage Application</li>\r\n	<li>Consulting</li>\r\n</ul>\r\n', '', '', '', 'Digital Signage Touchscreen Schedule Digital Signage Advertising Session Digital Signage Poster & Abstract display Video wall Digital Signage Application Consulting ', 'Test', '', '', '1512911440941.png', 'Test', 'Test', '0.00', '0.00', 0, '', 1, 1, 0, 1, '2017-12-09 01:10:40'),
(13, 'Video Walls', 'video-walls', '<ul>\r\n	<li>Supersize your message</li>\r\n	<li>Perfect for applications with large displays</li>\r\n	<li>Narrow bezel width</li>\r\n	<li>Mounting or floor option</li>\r\n	<li>Slim depth</li>\r\n	<li>Ultra brightness</li>\r\n	<li>Anti-reflective glass</li>\r\n	<li>47 and 55 inches</li>\r\n	<li>2x2, 3x3, &amp; 4x4</li>\r\n	<li>Bigger sizes also available</li>\r\n</ul>\r\n', '', '', '', 'Supersize your message Perfect for applications with large displays Narrow bezel width Mounting or floor option Slim depth Ultra brightness Anti-reflective glass 47 and 55 inches 2x2, 3x3, & 4x4 Bigger sizes also available', 'Test', '', '', '1512912818481.png', 'Test', 'Test', '0.00', '0.00', 0, '', 1, 1, 0, 1, '2017-12-09 01:33:38'),
(14, 'IoT Integration', 'iot-integration', '<ul>\r\n	<li>Intelligent Digital Signage</li>\r\n	<li>Integrate sensors and change content automatically</li>\r\n	<li>Trigger based content</li>\r\n	<li>Trigger messages from sensors</li>\r\n	<li>Motion, light, temperature, smoke, temperatures, &amp; others</li>\r\n	<li>Innovative and smart solutions</li>\r\n</ul>\r\n', '', '', '', 'Intelligent Digital Signage Integrate sensors and change content automatically Trigger based content Trigger messages from sensors Motion, light, temperature, smoke, temperatures, & others Innovative and smart solutions', 'Test', '', '', '151291299699.png', 'Test', 'Test', '0.00', '0.00', 0, '', 1, 1, 0, 1, '2017-12-09 01:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `products_category`
--

CREATE TABLE `products_category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_category`
--

INSERT INTO `products_category` (`id`, `product_id`, `category_id`) VALUES
(17, 8, 4),
(18, 9, 4),
(19, 10, 4),
(20, 11, 4),
(21, 12, 4),
(22, 13, 4),
(23, 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products_download`
--

CREATE TABLE `products_download` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_download`
--

INSERT INTO `products_download` (`id`, `product_id`, `image`, `sort_order`) VALUES
(1, 4, '1507721307279.png', 1),
(2, 5, '1507721650632.png', 2),
(3, 6, '1507721911115.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products_image`
--

CREATE TABLE `products_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `isArtwork` tinyint(4) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_image`
--

INSERT INTO `products_image` (`id`, `product_id`, `image`, `isArtwork`, `sort_order`) VALUES
(1, 8, '1512908565835.png', 0, 2),
(6, 9, '1512910106116.png', 0, 6),
(11, 10, '1512910733988.png', 0, 11),
(12, 8, '1512908565871.png', 0, 12),
(13, 9, '1512910106504.png', 0, 13),
(14, 11, '1512911183310.png', 0, 14),
(15, 12, '151291144067.png', 0, 15),
(16, 12, '1512911440156.png', 0, 16),
(17, 12, '1512911440836.png', 0, 17),
(18, 12, '1512911440412.png', 0, 18),
(19, 14, '1512912996376.png', 0, 19);

-- --------------------------------------------------------

--
-- Table structure for table `product_option`
--

CREATE TABLE `product_option` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_option`
--

INSERT INTO `product_option` (`id`, `product_id`, `name`, `sort_description`, `image`, `price`, `sort_order`) VALUES
(1, 8, 'All in one Wall Display', 'All in one Wall Display', '1513588319214.jpg', '1.00', 1),
(2, 8, 'All in one Wall and Ceiling', 'All in one Wall and Ceiling', '1513588319741.jpg', '2.00', 2),
(3, 8, 'All in one Floor', 'All in one Floor', '1513588319177.jpg', '3.00', 3),
(4, 8, 'All in one Floor', 'All in one Floor', '1513588319643.jpg', '4.00', 4),
(5, 8, 'All in one Table', 'All in one Table', '1513588319822.jpg', '5.00', 5),
(6, 8, 'All in one Standing', 'All in one Standing', '151358832079.jpg', '6.00', 6),
(7, 9, 'Application Cloud', 'Application Cloud', '1513747686944.png', '1.00', 7),
(8, 9, 'Hardware', 'Hardware', '1513747686786.png', '2.00', 8),
(9, 9, 'Design, Training, &  Consulting ', 'Design, Training, & \r\nConsulting ', '1513747686713.png', '3.00', 9),
(10, 12, 'Option 1', 'Option 1', '1513748930585.png', '1.00', 10),
(11, 12, 'Option 2', 'Option 2', '15137489308.png', '2.00', 11),
(12, 12, 'Option 3', 'Option 3', '1513748930698.png', '3.00', 12),
(13, 12, 'Option 4', 'Option 4', '151374893079.png', '4.00', 13),
(14, 12, 'Option 5', 'Option 5', '1513748930265.png', '5.00', 14),
(15, 12, 'Option 6', 'Option 6', '1513748930956.png', '6.00', 15);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address1` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `first_name`, `last_name`, `birth_date`, `gender`, `address1`, `photo`, `phone`, `country`) VALUES
(1, 15, 'Mehedi', 'Hasan', '2017-11-23', 'Male', 'Dhaka', '', '01911774866', 18),
(2, 15, 'Mehedi', 'Hasan', '2017-11-23', 'Male', 'Dhaka', '', '01911774866', 18),
(3, 16, 'Anup', 'Kumar', '1988-12-14', 'Male', 'Dhaka', '1512977182727.jpg', '123456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review_type` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `rating_point` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `entry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user_id`, `product_id`, `review_type`, `details`, `rating_point`, `status`, `entry_date`) VALUES
(1, 11, 8, 'Product', 'Test Review', 1, 'Confirmed', '2017-11-14'),
(2, 11, 5, 'Service', 'test', 1, 'Confirmed', '2017-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `sort_order`) VALUES
(1, 'Admin', 1),
(2, 'Reseller', 2),
(3, 'Customer', 3),
(4, 'ePosterAdmin', 4),
(5, 'Speaker', 5);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `quick_view` text NOT NULL,
  `specification` text NOT NULL,
  `feature` text NOT NULL,
  `benifits` text NOT NULL,
  `metatag_title` varchar(255) NOT NULL,
  `metatag_description` varchar(255) NOT NULL,
  `metatag_keywords` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `reseller_price` decimal(11,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `seo_keyword` varchar(255) NOT NULL,
  `featured` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `subscription` varchar(50) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `slug`, `description`, `quick_view`, `specification`, `feature`, `benifits`, `metatag_title`, `metatag_description`, `metatag_keywords`, `image`, `model`, `sku`, `price`, `reseller_price`, `quantity`, `seo_keyword`, `featured`, `status`, `sort_order`, `update_by`, `update_time`, `subscription`) VALUES
(5, 'Digital Signage Service', 'digital-signage-service-2', '<ul>\r\n	<li>Centralized management &amp; control</li>\r\n	<li>Remote and web access for display and</li>\r\n	<li>content management</li>\r\n	<li>Different layouts and schedules</li>\r\n	<li>Hosted or private design</li>\r\n	<li>Multi OS support (Windows, Linux, MacOS, Android, iOS)</li>\r\n	<li>Support for non touchscreen, touchscreen, and mobile devices</li>\r\n	<li>Feature rich Digital Signage solution</li>\r\n	<li>&nbsp;Multi-features: text, images, videos, social media (Facebook, Instagram, Twitter, Google+, YouTube), Interactive/Touchscreen, weather, stock, RSS, Podcast, Chat, camera, LiveTV, HTML5, Flash, Google (Calendar, Drive, Sheets), Browser, XML, Countdown, QR Code, Yelp, PDF, Location Based (GPS), and others.</li>\r\n	<li>Pre-designed Themes, Templates, and Screen Layouts</li>\r\n	<li>Customer managed and controlled displays and content</li>\r\n	<li>Training and consulting</li>\r\n	<li>Analytics and Advertising Engines</li>\r\n	<li>Design and Build content with easy to use application and easy to configure tools and features.&nbsp; Click and drag components and features to make your content active and ready for display</li>\r\n	<li>Contact us for more information,</li>\r\n	<li>a presentation, and for a quote</li>\r\n	<li>Combine the service with our hardware</li>\r\n	<li>Solutions for a turnkey solution</li>\r\n	<li>Training and Tech support</li>\r\n	<li>Try &amp; Buy option available</li>\r\n</ul>\r\n', 'Centralized management & control\r\nRemote and web access for display and\r\ncontent management\r\nDifferent layouts and schedules\r\nHosted or private design\r\nMulti OS support (Windows, Linux, MacOS, Android, iOS)\r\nSupport for non touchscreen, touchscreen, and mobile devices\r\nFeature rich Digital Signage solution', '', '', '', 'sdfsdfsdf', '', '', '1512909277380.png', 'Test', 'Test', '50.00', '40.00', 1, '', 0, 1, 0, 1, '2018-01-03 06:32:42', 'Yes'),
(6, '212Posters', '212posters-212', '<ul>\r\n	<li>Online library and repository of document posters and abstracts</li>\r\n	<li>Expand the reach of the event content online and promote the event and conference to global readers</li>\r\n	<li>Empower speakers to present their topics in and out of session</li>\r\n	<li>Promote more discussions and forums</li>\r\n</ul>\r\n', 'Online library and repository of document posters and abstracts Expand the reach of the event content online and promote the event and conference to global readers Empower speakers to present their topics in and out of session Promote more discussions and forums', '', '', '', 'Test', '', '', '151291204184.png', 'Test', 'Test', '0.00', '0.00', 0, '', 0, 1, 0, 1, '2017-12-09 01:20:41', 'No'),
(7, 'Charging Stations', 'charging-stations-2', '<ul>\r\n	<li>Mobile standing charging station</li>\r\n	<li>Lightening, Micro USB, standard USB</li>\r\n	<li>For iPhones, iPads, Android smartphones, &amp; Tablets</li>\r\n	<li>Personalized logo, colors, and branding</li>\r\n	<li>Durable base and pole</li>\r\n	<li>Add your logo or slogan</li>\r\n	<li>Wireless Fast charging available</li>\r\n	<li>Battery bank available</li>\r\n</ul>\r\n', 'Mobile standing charging station Lightening, Micro USB, standard USB For iPhones, iPads, Android smartphones, & Tablets\r\nPersonalized logo, colors, and branding Durable base and pole Add your logo or slogan Wireless Fast charging available Battery bank available', '', '', '', 'Test', '', '', '1512912558222.png', 'Test', 'Test', '0.00', '0.00', 0, '', 0, 1, 0, 1, '2018-01-03 05:39:22', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `service_category`
--

CREATE TABLE `service_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `metatag_title` varchar(255) NOT NULL,
  `metatag_description` varchar(255) NOT NULL,
  `metatag_keywords` varchar(255) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `category_banner` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `update_by` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_category`
--

INSERT INTO `service_category` (`id`, `name`, `slug`, `description`, `metatag_title`, `metatag_description`, `metatag_keywords`, `parent`, `image`, `category_banner`, `sort_order`, `status`, `update_by`, `update_time`) VALUES
(5, 'Digital Signage', 'digital-signage', '', '', '', '', NULL, '1507529620283.png', '1507529620586.png', 2, 1, 1, '2017-12-09 12:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `service_download`
--

CREATE TABLE `service_download` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_download`
--

INSERT INTO `service_download` (`id`, `product_id`, `image`, `sort_order`) VALUES
(5, 4, '150779285236.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_image`
--

CREATE TABLE `service_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `isArtwork` tinyint(4) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_image`
--

INSERT INTO `service_image` (`id`, `product_id`, `image`, `isArtwork`, `sort_order`) VALUES
(4, 4, '1507792852870.png', 0, 1),
(9, 5, '1512909277907.png', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_info`
--

CREATE TABLE `shipping_info` (
  `id` int(11) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `street_address` varchar(300) NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` int(11) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_info`
--

INSERT INTO `shipping_info` (`id`, `user_id_fk`, `name`, `street_address`, `landmark`, `city`, `state`, `country`, `pincode`, `phone`, `update_time`, `update_by`) VALUES
(1, 1, 'Two One Two', 'USA', '', 'NY', 'AL', 1, '12345', '12345678', '2017-10-23 08:24:35', 1),
(3, 17, 'sdfsdf', 'sdfsdf', '', 'dsfsdf', 'AL', 1, '3r234', '34234', '2017-10-24 10:36:48', 17);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_settings`
--

CREATE TABLE `shipping_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `oparetor` varchar(1) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_settings`
--

INSERT INTO `shipping_settings` (`id`, `name`, `oparetor`, `price`, `sort_order`, `status`) VALUES
(2, 'Free Shipping', '+', '0.00', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `login_banner` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(400) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `paypal_id` varchar(255) NOT NULL,
  `paypal_mode` varchar(255) NOT NULL,
  `entry_by` int(11) NOT NULL,
  `entry_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `name`, `logo`, `site_logo`, `login_banner`, `email`, `address`, `phone`, `paypal_id`, `paypal_mode`, `entry_by`, `entry_time`, `update_by`, `update_time`) VALUES
(1, 'Posters212', '153744400649.png', '1537443969757.png', '1508732355415.jpg', 'info@posters212.com', 'USA', '123456', 'info@posters212.com', 'Live', 1, '2018-09-20 07:46:46', 1, '2018-09-20 07:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL,
  `button_label` varchar(500) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `position` varchar(255) NOT NULL DEFAULT 'Photo Gallery'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `title`, `image`, `button_label`, `link`, `sort_order`, `status`, `position`) VALUES
(2, 'Create Awesome Designs with <br> Our Custom Poster', '1537348330681.jpg', 'Watch Over View Video', '#', 1, 1, 'Home Slider'),
(3, 'The global market leader in digital <br> signage ', '150963201221.jpg', 'Watch Over View Video', '#', 2, 1, 'Home Slider'),
(4, 'New Slider', '1531568506686.jpg', 'Open Video', 'https://www.youtube.com/watch?v=uqF2Xt_RWSM', 3, 1, 'Home Slider');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `code`, `name`) VALUES
(1, 'AL', 'Alabama'),
(2, 'AK', 'Alaska'),
(3, 'AS', 'American Samoa'),
(4, 'AZ', 'Arizona'),
(5, 'AR', 'Arkansas'),
(6, 'CA', 'California'),
(7, 'CO', 'Colorado'),
(8, 'CT', 'Connecticut'),
(9, 'DE', 'Delaware'),
(10, 'DC', 'District of Columbia'),
(11, 'FM', 'Federated States of Micronesia'),
(12, 'FL', 'Florida'),
(13, 'GA', 'Georgia'),
(14, 'GU', 'Guam'),
(15, 'HI', 'Hawaii'),
(16, 'ID', 'Idaho'),
(17, 'IL', 'Illinois'),
(18, 'IN', 'Indiana'),
(19, 'IA', 'Iowa'),
(20, 'KS', 'Kansas'),
(21, 'KY', 'Kentucky'),
(22, 'LA', 'Louisiana'),
(23, 'ME', 'Maine'),
(24, 'MH', 'Marshall Islands'),
(25, 'MD', 'Maryland'),
(26, 'MA', 'Massachusetts'),
(27, 'MI', 'Michigan'),
(28, 'MN', 'Minnesota'),
(29, 'MS', 'Mississippi'),
(30, 'MO', 'Missouri'),
(31, 'MT', 'Montana'),
(32, 'NE', 'Nebraska'),
(33, 'NV', 'Nevada'),
(34, 'NH', 'New Hampshire'),
(35, 'NJ', 'New Jersey'),
(36, 'NM', 'New Mexico'),
(37, 'NY', 'New York'),
(38, 'NC', 'North Carolina'),
(39, 'ND', 'North Dakota'),
(40, 'MP', 'Northern Mariana Islands'),
(41, 'OH', 'Ohio'),
(42, 'OK', 'Oklahoma'),
(43, 'OR', 'Oregon'),
(44, 'PW', 'Palau'),
(45, 'PA', 'Pennsylvania'),
(46, 'PR', 'Puerto Rico'),
(47, 'RI', 'Rhode Island'),
(48, 'SC', 'South Carolina'),
(49, 'SD', 'South Dakota'),
(50, 'TN', 'Tennessee'),
(51, 'TX', 'Texas'),
(52, 'UT', 'Utah'),
(53, 'VT', 'Vermont'),
(54, 'VI', 'Virgin Islands'),
(55, 'VA', 'Virginia'),
(56, 'WA', 'Washington'),
(57, 'WV', 'West Virginia'),
(58, 'WI', 'Wisconsin'),
(59, 'WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_month` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `name`, `total_month`) VALUES
(4, '3 Months', 3),
(5, '6 Months', 6),
(6, '12 Months', 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `email_verified` tinyint(4) NOT NULL DEFAULT '0',
  `verification_code` varchar(400) DEFAULT NULL,
  `forgot_pass_code` varchar(300) NOT NULL,
  `date_of_registration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(11) NOT NULL,
  `parrent` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `active`, `email`, `first_name`, `last_name`, `role`, `email_verified`, `verification_code`, `forgot_pass_code`, `date_of_registration`, `added_by`, `parrent`, `event_id`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'info@posters212.com', 'Posters212', '', 1, 1, NULL, 'f72d82b42fa8f5de8d0d4970f3f02b9d', '2017-09-29 18:00:00', 0, 0, 0),
(8, 'mehedi@mehedibd.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'mehedi@mehedibd.com', 'Mehedi', '', 3, 1, '62f8eb0f16872356d3a5add165155afe', '', '2017-10-23 12:04:09', 0, 0, 0),
(10, 'red@212com.com', '21542b204fc509c6772ac553e20ca31b', 1, 'red@212com.com', 'Red Briou', '', 3, 1, 'ac018bcf8c59e3c35a5179d2de0c45b7', '', '2017-11-10 04:06:06', 0, 0, 0),
(14, 'info@coder71.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'info@coder71.com', 'Coder71', 'Ltd', 4, 1, '3a6d35dceedeeaaf930f8d4624631e0e', '', '2017-11-22 18:58:42', 0, 0, 0),
(15, 'mehedi@bdwebsolution', 'e10adc3949ba59abbe56e057f20f883e', 1, 'mehedi@bdwebsolutions.com', 'Mehedi', 'Hasan', 5, 1, NULL, '', '2017-11-22 19:07:55', 0, 14, 14),
(16, 'anupist726@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'anupist726@gmail.com', 'Anup Roy', 'Kumar', 5, 1, NULL, '', '2017-11-22 19:11:43', 0, 14, 14),
(17, 'rtenterprisebd@gmail', 'e10adc3949ba59abbe56e057f20f883e', 0, 'rtenterprisebd@gmail.com', 'Test', '', 4, 0, '9a81f07ac1ac794d64408289b7eb8de8', '9a81f07ac1ac794d64408289b7eb8de8', '2017-11-23 00:12:20', 0, 0, 0),
(19, 'reza@coder71.com', '0c8eafd6ea46e2c16818e00a2355ad96', 0, 'reza@coder71.com', 'Rezaul', 'Karim', 5, 1, NULL, '', '2018-06-08 22:02:10', 0, 14, 14),
(20, 'dsfdsf@sfdsf.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 'dsfdsf@sfdsf.com', 'Setara', 'M. A', 5, 1, NULL, '', '2018-06-08 22:03:10', 0, 14, 14),
(21, 'safi@coder71.com', '0c8eafd6ea46e2c16818e00a2355ad96', 1, 'safi@coder71.com', 'safi', 'safi', 4, 1, NULL, '', '2018-09-10 10:57:37', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_login_history`
--

CREATE TABLE `user_login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login_history`
--

INSERT INTO `user_login_history` (`id`, `user_id`, `ip_address`, `login_time`) VALUES
(1, 16, '192.168.0.103', '2018-09-15 01:20:25'),
(2, 14, '192.168.0.103', '2018-09-15 04:00:52'),
(3, 16, '192.168.0.104', '2018-09-18 01:02:22'),
(4, 14, '192.168.0.104', '2018-09-18 01:03:49'),
(5, 16, '192.168.0.104', '2018-09-18 02:38:04'),
(6, 1, '192.168.0.105', '2018-09-19 01:55:54'),
(7, 1, '192.168.0.202', '2018-09-19 05:11:20'),
(8, 16, '192.168.0.105', '2018-09-19 05:58:27'),
(9, 1, '192.168.0.202', '2018-09-20 07:45:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_info`
--
ALTER TABLE `billing_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id_fk`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_service`
--
ALTER TABLE `category_service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_cat_unique_key` (`product_id`,`category_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eposter_image`
--
ALTER TABLE `eposter_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`eposter_id`);

--
-- Indexes for table `eposter_list`
--
ALTER TABLE `eposter_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applied_list`
--
ALTER TABLE `job_applied_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `job_category`
--
ALTER TABLE `job_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_list`
--
ALTER TABLE `job_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_invoice`
--
ALTER TABLE `order_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_payment_history`
--
ALTER TABLE `order_payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_proccessing_history`
--
ALTER TABLE `order_proccessing_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id_fk` (`order_id_fk`,`products_id_fk`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poster_rating`
--
ALTER TABLE `poster_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_category`
--
ALTER TABLE `products_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_cat_unique_key` (`product_id`,`category_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `products_download`
--
ALTER TABLE `products_download`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products_image`
--
ALTER TABLE `products_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_option`
--
ALTER TABLE `product_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_category`
--
ALTER TABLE `service_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_download`
--
ALTER TABLE `service_download`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `service_image`
--
ALTER TABLE `service_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `shipping_info`
--
ALTER TABLE `shipping_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id_fk`);

--
-- Indexes for table `shipping_settings`
--
ALTER TABLE `shipping_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login_history`
--
ALTER TABLE `user_login_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `billing_info`
--
ALTER TABLE `billing_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `category_service`
--
ALTER TABLE `category_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `eposter_image`
--
ALTER TABLE `eposter_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `eposter_list`
--
ALTER TABLE `eposter_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_applied_list`
--
ALTER TABLE `job_applied_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `job_list`
--
ALTER TABLE `job_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `order_invoice`
--
ALTER TABLE `order_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order_payment_history`
--
ALTER TABLE `order_payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_proccessing_history`
--
ALTER TABLE `order_proccessing_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `poster_rating`
--
ALTER TABLE `poster_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `products_category`
--
ALTER TABLE `products_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `products_download`
--
ALTER TABLE `products_download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products_image`
--
ALTER TABLE `products_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `product_option`
--
ALTER TABLE `product_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `service_category`
--
ALTER TABLE `service_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `service_download`
--
ALTER TABLE `service_download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `service_image`
--
ALTER TABLE `service_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `shipping_info`
--
ALTER TABLE `shipping_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shipping_settings`
--
ALTER TABLE `shipping_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user_login_history`
--
ALTER TABLE `user_login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_applied_list`
--
ALTER TABLE `job_applied_list`
  ADD CONSTRAINT `job_applied_list_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_list`
--
ALTER TABLE `job_list`
  ADD CONSTRAINT `job_list_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `job_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_category`
--
ALTER TABLE `products_category`
  ADD CONSTRAINT `products_category_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_image`
--
ALTER TABLE `products_image`
  ADD CONSTRAINT `products_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_option`
--
ALTER TABLE `product_option`
  ADD CONSTRAINT `product_option_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
