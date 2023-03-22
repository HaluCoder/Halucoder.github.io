-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2022 at 07:44 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `farmID` int(11) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `district` int(11) DEFAULT NULL,
  `council` int(11) DEFAULT NULL,
  `ward` varchar(255) DEFAULT NULL,
  `village` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `road` varchar(255) DEFAULT NULL,
  `postcode` int(11) DEFAULT NULL,
  `plotNo` varchar(255) DEFAULT NULL,
  `houseNo` varchar(255) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `usage` varchar(100) DEFAULT 'personal',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `userID`, `farmID`, `region`, `district`, `council`, `ward`, `village`, `street`, `road`, `postcode`, `plotNo`, `houseNo`, `status`, `usage`, `date_added`, `date_updated`) VALUES
(1, 2, NULL, 11, 54, 67, 'ARRI', 'DUDIYE', 'DUDIYE', NULL, NULL, NULL, NULL, NULL, 'personal', '2022-02-14 23:59:35', NULL),
(2, NULL, 3, 1, 3, 4, 'KARATU', 'KARATU', 'KARATU', NULL, NULL, NULL, NULL, NULL, 'personal', '2022-02-15 00:04:54', NULL),
(3, 3, NULL, 1, 2, 3, 'KALOLENI', 'KALOLENI', 'PANGANI', NULL, NULL, NULL, NULL, NULL, 'personal', '2022-02-15 18:43:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `blockID` int(11) NOT NULL,
  `farmID` int(11) NOT NULL,
  `blockNo` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `size` decimal(10,2) DEFAULT NULL,
  `rent` decimal(10,2) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `blockPicture` varchar(100) DEFAULT NULL,
  `blockStatus` varchar(11) DEFAULT 'vacant',
  `blockToken` varchar(100) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`blockID`, `farmID`, `blockNo`, `description`, `size`, `rent`, `category`, `blockPicture`, `blockStatus`, `blockToken`, `added_by`, `date_added`, `updated_by`, `date_updated`) VALUES
(9, 3, 'BlockA1', 'Good Block', '4.00', '50000.00', 'clay', 'Block-arusha estate-3-blocka1-1b5ba8ea.png', 'vacant', '1b5ba8ea', 2, '2022-02-15 00:06:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `farmID` int(11) DEFAULT NULL,
  `blockID` int(11) DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `status` varchar(11) DEFAULT 'pending',
  `date_added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contactID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `whatsapp` varchar(15) DEFAULT NULL,
  `instagramID` varchar(255) DEFAULT NULL,
  `twitterID` varchar(255) DEFAULT NULL,
  `fbID` varchar(255) DEFAULT NULL,
  `LinkedInID` varchar(255) DEFAULT NULL,
  `skypeID` varchar(255) DEFAULT NULL,
  `officeEmail` varchar(255) DEFAULT NULL,
  `personalEmail` varchar(255) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contactID`, `userID`, `phone`, `whatsapp`, `instagramID`, `twitterID`, `fbID`, `LinkedInID`, `skypeID`, `officeEmail`, `personalEmail`, `date_added`, `date_updated`) VALUES
(1, 2, '255687482855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'landlord@fms.com', '2022-02-14 23:59:35', NULL),
(2, 3, '255687482855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tenant@fms.com', '2022-02-15 18:43:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `councils`
--

CREATE TABLE `councils` (
  `id` int(11) NOT NULL,
  `council` varchar(255) NOT NULL,
  `dist_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `councils`
--

INSERT INTO `councils` (`id`, `council`, `dist_id`, `reg_id`) VALUES
(1, 'Arusha District Council ', 1, 1),
(2, 'Meru District Council ', 1, 1),
(3, 'Arusha City Council ', 2, 1),
(4, 'Karatu District Council ', 3, 1),
(5, 'Longido District Council ', 4, 1),
(6, 'Monduli District Council ', 5, 1),
(7, 'Ngorongoro District Council ', 6, 1),
(8, 'Ilala Municipal Council ', 7, 2),
(9, 'Dar es salaam City Council', 7, 2),
(10, 'Kinondoni Municipal Council ', 8, 2),
(11, 'Temeke Municipal Council ', 9, 2),
(12, 'Kigamboni Municipal Council', 10, 2),
(13, 'Ubungo Municipal Council', 11, 2),
(14, 'Bahi District Council ', 12, 3),
(15, 'Chamwino District Council ', 13, 3),
(16, 'Chemba District Council ', 14, 3),
(17, 'Dodoma Municipal Council ', 15, 3),
(18, 'Kondoa town Council', 16, 3),
(19, 'Kondoa District Council ', 16, 3),
(20, 'Kongwa District Council ', 17, 3),
(21, 'Mpwapwa District Council ', 18, 3),
(22, 'Bukombe District Council ', 19, 4),
(23, 'Chato District Council ', 20, 4),
(24, 'Geita Town Council', 21, 4),
(25, 'Geita District Council ', 21, 4),
(26, 'Mbongwe District Council ', 22, 4),
(27, 'Nyang\\\'hwale District Council ', 23, 4),
(28, 'Iringa District Council ', 24, 5),
(29, 'Iringa Municipal Council ', 24, 5),
(30, 'Kilolo District Council ', 25, 5),
(31, 'Mafinga Town Council ', 26, 5),
(32, 'Mufindi District Council ', 26, 5),
(33, 'Biharamulo District Council ', 27, 6),
(34, 'Bukoba District Council ', 28, 6),
(35, 'Bukoba Municipal Council ', 28, 6),
(36, 'Karagwe District Council ', 29, 6),
(37, 'Kyerwa District Council ', 30, 6),
(38, 'Missenyi District Council ', 31, 6),
(39, 'Muleba District Council ', 32, 6),
(40, 'Ngara District Council ', 33, 6),
(41, 'Mlele District Council ', 34, 7),
(42, 'Mpimbwe District Council', 34, 7),
(43, 'Mpanda Municipal Council ', 35, 7),
(44, 'Nsimbo District Council', 35, 7),
(45, 'Mpanda District Council ', 36, 7),
(46, 'Buhigwe District Council ', 37, 8),
(47, 'Kakonko District Council ', 38, 8),
(48, 'Kasulu District Council ', 39, 8),
(49, 'Kasulu Town Council ', 39, 8),
(50, 'Kibondo District Council ', 40, 8),
(51, 'Kigoma District Council ', 41, 8),
(52, 'Kigoma-Ujiji Municipal Council ', 41, 8),
(53, 'Uvinza District Council ', 42, 8),
(54, 'Hai District Council ', 43, 9),
(55, 'Moshi District Council ', 44, 9),
(56, 'Moshi Municipal Council ', 44, 9),
(57, 'Mwanga District Council ', 45, 9),
(58, 'Rombo District Council ', 46, 9),
(59, 'Same District Council ', 47, 9),
(60, 'Siha District Council ', 48, 9),
(61, 'Kilwa District Council ', 49, 10),
(62, 'Lindi District Council ', 50, 10),
(63, 'Lindi Municipal Council ', 50, 10),
(64, 'Liwale District Council ', 51, 10),
(65, 'Nachingwea District Council ', 52, 10),
(66, 'Ruangwa District Council ', 53, 10),
(67, 'Babati District Council ', 54, 11),
(68, 'Babati Town Council ', 54, 11),
(69, 'Hanang District Council ', 55, 11),
(70, 'Kiteto District Council ', 56, 11),
(71, 'Mbulu District Council ', 57, 11),
(72, 'Mbulu Town Council ', 57, 11),
(73, 'Simanjiro District Council ', 58, 11),
(74, 'Bunda District Council ', 59, 12),
(75, 'Bunda Town Council ', 59, 12),
(76, 'Butiama District Council ', 60, 12),
(77, 'Musoma District Council ', 61, 12),
(78, 'Musoma Municipal Council ', 61, 12),
(79, 'Rorya District Council ', 62, 12),
(80, 'Serengeti District Council ', 63, 12),
(81, 'Tarime District Council ', 64, 12),
(82, 'Tarime Town Council ', 64, 12),
(83, 'Chunya District Council ', 65, 13),
(84, 'Kyela District Council ', 66, 13),
(85, 'Mbarali District Council ', 67, 13),
(86, 'Mbeya City Council ', 68, 13),
(87, 'Mbeya District Council ', 68, 13),
(88, 'Rungwe District Council ', 69, 13),
(89, 'Busokelo District Council', 69, 13),
(90, 'Gairo District Council ', 70, 14),
(91, 'Kilombero District Council ', 71, 14),
(92, 'Ifakara Town Council', 71, 14),
(93, 'Kilosa District Council ', 72, 14),
(94, 'Malinyi District Council', 73, 14),
(95, 'Morogoro District Council ', 74, 14),
(96, 'Morogoro Municipal Council ', 74, 14),
(97, 'Mvomero District Council ', 75, 14),
(98, 'Ulanga District Council ', 76, 14),
(99, 'Masasi District Council ', 77, 15),
(100, 'Masasi Town Council ', 77, 15),
(101, 'Nanyamba Town Council', 78, 15),
(102, 'Mtwara District Council ', 78, 15),
(103, 'Mtwara Municipal Council ', 78, 15),
(104, 'Nanyumbu District Council ', 79, 15),
(105, 'Newala District Council ', 80, 15),
(106, 'Newala Town Council ', 80, 15),
(107, 'Tandahimba District Council ', 81, 15),
(108, 'Ilemela Municipal Council ', 82, 16),
(109, 'Kwimba District Council ', 83, 16),
(110, 'Magu District Council ', 84, 16),
(111, 'Misungwi District Council ', 85, 16),
(112, 'Mwanza City Council', 86, 16),
(113, 'Buchosa District Council', 87, 16),
(114, 'Sengerema District Council ', 87, 16),
(115, 'Ukerewe District Council ', 88, 16),
(116, 'Ludewa District Council ', 89, 17),
(117, 'Makete District Council ', 90, 17),
(118, 'Njombe District Council ', 91, 17),
(119, 'Njombe Town Council ', 91, 17),
(120, 'Makambako Town Council ', 91, 17),
(121, 'Wanging\\\'ombe District Council ', 92, 17),
(122, 'Bagamoyo District Council ', 93, 18),
(123, 'Chalinze District Council', 93, 18),
(124, 'Kibaha District Council ', 94, 18),
(125, 'Kibaha Town Council ', 94, 18),
(126, 'Kibiti District Council', 95, 18),
(127, 'Kisarawe District Council ', 96, 18),
(128, 'Mafia District Council ', 97, 18),
(129, 'Mkuranga District Council ', 98, 18),
(130, 'Rufiji District Council ', 99, 18),
(131, 'Kalambo District Council ', 100, 19),
(132, 'Nkasi District Council ', 101, 19),
(133, 'Sumbawanga District Council ', 102, 19),
(134, 'Sumbawanga Municipal Council ', 102, 19),
(135, 'Mbinga District Council ', 103, 20),
(136, 'Mbinga Town Council ', 103, 20),
(137, 'Namtumbo District Council ', 104, 20),
(138, 'Nyasa District Council ', 105, 20),
(139, 'Songea District Council ', 106, 20),
(140, 'Songea Municipal Council ', 106, 20),
(141, 'Madaba District Council', 106, 20),
(142, 'Tunduru District Council ', 107, 20),
(143, 'Kahama Town Council ', 108, 21),
(144, 'Ushetu District Council', 108, 21),
(145, 'Msalala District Council', 108, 21),
(146, 'Kishapu District Council ', 109, 21),
(147, 'Shinyanga District Council ', 110, 21),
(148, 'Shinyanga Municipal Council ', 110, 21),
(149, 'Bariadi District Council ', 111, 22),
(150, 'Bariadi Town Council ', 111, 22),
(151, 'Busega District Council ', 112, 22),
(152, 'Itilima District Council ', 113, 22),
(153, 'Maswa District Council ', 114, 22),
(154, 'Meatu District Council ', 115, 22),
(155, 'Ikungi District Council ', 116, 23),
(156, 'Iramba District Council ', 117, 23),
(157, 'Manyoni District Council ', 118, 23),
(158, 'Itigi District Council', 118, 23),
(159, 'Mkalama District Council ', 119, 23),
(160, 'Singida District Council ', 120, 23),
(161, 'Singida Municipal Council ', 120, 23),
(162, 'Ileje District Council', 121, 24),
(163, 'Mbozi District Council', 122, 24),
(164, 'Tunduma Town Council', 123, 24),
(165, 'Momba District Council', 123, 24),
(166, 'Songwe District Council', 124, 24),
(167, 'Igunga District Council ', 125, 25),
(168, 'Kaliua District Council ', 126, 25),
(169, 'Nzega District Council ', 127, 25),
(170, 'Nzega Town Council ', 127, 25),
(171, 'Sikonge District Council ', 128, 25),
(172, 'Tabora Municipal Council ', 129, 25),
(173, 'Urambo District Council ', 130, 25),
(174, 'Tabora-Uyui District Council ', 131, 25),
(175, 'Handeni District Council ', 132, 26),
(176, 'Handeni Town Council ', 132, 26),
(177, 'Kilindi District Council ', 133, 26),
(178, 'Korogwe District Council ', 134, 26),
(179, 'Korogwe Town Council ', 134, 26),
(180, 'Lushoto District Council ', 135, 26),
(181, 'Bumbuli District Council', 135, 26),
(182, 'Mkinga District Council ', 136, 26),
(183, 'Muheza District Council ', 137, 26),
(184, 'Pangani District Council ', 138, 26),
(185, 'Tanga City Council ', 139, 26),
(186, 'Micheweni District Council', 146, 27),
(187, 'Wete District Council', 149, 27),
(188, 'Central District Council', 143, 30),
(189, 'Chake Chake District Council', 140, 29),
(190, 'Chake Chake Town Council', 140, 29),
(191, 'Mkoani District Council', 148, 29),
(192, 'Mkoani Town Council', 148, 29),
(193, 'North A District Council', 141, 28),
(194, 'North B District Council', 142, 28),
(195, 'South District Council', 144, 30),
(196, 'West District Council', 145, 31),
(197, 'Wete Town Council', 149, 27),
(198, 'Zanzibar City Council', 147, 31);

-- --------------------------------------------------------

--
-- Table structure for table `customer_comments`
--

CREATE TABLE `customer_comments` (
  `commentID` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT 'new',
  `doc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `district` varchar(255) NOT NULL,
  `reg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `district`, `reg_id`) VALUES
(1, 'Arumeru District', 1),
(2, 'Arusha District', 1),
(3, 'Karatu District', 1),
(4, 'Longido District', 1),
(5, 'Monduli District', 1),
(6, 'Ngorongoro District', 1),
(7, 'Ilala District', 2),
(8, 'Kinondoni District', 2),
(9, 'Temeke District', 2),
(10, 'Kigamboni District', 2),
(11, 'Ubungo District', 2),
(12, 'Bahi District', 3),
(13, 'Chamwino District', 3),
(14, 'Chemba District', 3),
(15, 'Dodoma District', 3),
(16, 'Kondoa District', 3),
(17, 'Kongwa District', 3),
(18, 'Mpwapwa District', 3),
(19, 'Bukombe District', 4),
(20, 'Chato District', 4),
(21, 'Geita District', 4),
(22, 'Mbongwe District', 4),
(23, 'Nyang\\\'hwale District', 4),
(24, 'Iringa District', 5),
(25, 'Kilolo District', 5),
(26, 'Mufindi District', 5),
(27, 'Biharamulo District', 6),
(28, 'Bukoba District', 6),
(29, 'Karagwe District', 6),
(30, 'Kyerwa District', 6),
(31, 'Missenyi District', 6),
(32, 'Muleba District', 6),
(33, 'Ngara District', 6),
(34, 'Mlele District', 7),
(35, 'Mpanda Disrrict', 7),
(36, 'Tanganyika District', 7),
(37, 'Buhigwe District', 8),
(38, 'Kakonko District', 8),
(39, 'Kasulu District', 8),
(40, 'Kibondo District', 8),
(41, 'Kigoma District', 8),
(42, 'Uvinza District', 8),
(43, 'Hai District', 9),
(44, 'Moshi District', 9),
(45, 'Mwanga District', 9),
(46, 'Rombo District', 9),
(47, 'Same District', 9),
(48, 'Siha District', 9),
(49, 'Kilwa District', 10),
(50, 'Lindi District', 10),
(51, 'Liwale District', 10),
(52, 'Nachingwea District', 10),
(53, 'Ruangwa District', 10),
(54, 'Babati District', 11),
(55, 'Hanang District', 11),
(56, 'Kiteto District', 11),
(57, 'Mbulu District', 11),
(58, 'Simanjiro District', 11),
(59, 'Bunda District', 12),
(60, 'Butiama District', 12),
(61, 'Musoma District', 12),
(62, 'Rorya District', 12),
(63, 'Serengeti District', 12),
(64, 'Tarime District', 12),
(65, 'Chunya District', 13),
(66, 'Kyela District', 13),
(67, 'Mbarali District', 13),
(68, 'Mbeya District', 13),
(69, 'Rungwe District', 13),
(70, 'Gairo District', 14),
(71, 'Kilombero District', 14),
(72, 'Kilosa District', 14),
(73, 'Malinyi District', 14),
(74, 'Morogoro District', 14),
(75, 'Mvomero District', 14),
(76, 'Ulanga District', 14),
(77, 'Masasi District', 15),
(78, 'Mtwara District', 15),
(79, 'Nanyumbu District', 15),
(80, 'Newala District', 15),
(81, 'Tandahimba District', 15),
(82, 'Ilemela District', 16),
(83, 'Kwimba District', 16),
(84, 'Magu District', 16),
(85, 'Misungwi District', 16),
(86, 'Nyamagana District', 16),
(87, 'Sengerema District', 16),
(88, 'Ukerewe District', 16),
(89, 'Ludewa District', 17),
(90, 'Makete District', 17),
(91, 'Njombe District', 17),
(92, 'Wanging\\\'ombe District', 17),
(93, 'Bagamoyo District', 18),
(94, 'Kibaha District', 18),
(95, 'Kibiti District', 18),
(96, 'Kisarawe District', 18),
(97, 'Mafia District', 18),
(98, 'Mkuranga District', 18),
(99, 'Rufiji District', 18),
(100, 'Kalambo District', 19),
(101, 'Nkasi District', 19),
(102, 'Sumbawanga District', 19),
(103, 'Mbinga District', 20),
(104, 'Namtumbo District', 20),
(105, 'Nyasa District', 20),
(106, 'Songea District', 20),
(107, 'Tunduru District', 20),
(108, 'Kahama District', 21),
(109, 'Kishapu District', 21),
(110, 'Shinyanga District', 21),
(111, 'Bariadi District', 22),
(112, 'Busega District', 22),
(113, 'Itilima District', 22),
(114, 'Maswa District', 22),
(115, 'Meatu District', 22),
(116, 'Ikungi District', 23),
(117, 'Iramba District', 23),
(118, 'Manyoni District', 23),
(119, 'Mkalama District', 23),
(120, 'Singida District', 23),
(121, 'Ileje District', 24),
(122, 'Mbozi District', 24),
(123, 'Momba District', 24),
(124, 'Songwe District', 24),
(125, 'Igunga District', 25),
(126, 'Kaliua District', 25),
(127, 'Nzega District', 25),
(128, 'Sikonge District', 25),
(129, 'Tabora District', 25),
(130, 'Urambo District', 25),
(131, 'Uyui District', 25),
(132, 'Handeni District', 26),
(133, 'Kilindi District', 26),
(134, 'Korogwe District', 26),
(135, 'Lushoto District', 26),
(136, 'Mkinga District', 26),
(137, 'Muheza District', 26),
(138, 'Pangani District', 26),
(139, 'Tanga District', 26),
(140, 'Chake Chake District', 29),
(141, 'Kaskazini-A District', 28),
(142, 'Kaskazini-B District', 28),
(143, 'Kati District', 30),
(144, 'Kusini District', 30),
(145, 'Magharibi District', 31),
(146, 'Micheweni District', 27),
(147, 'Mjini District', 31),
(148, 'Mkoani District', 29),
(149, 'Wete District', 27);

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `farmID` int(11) NOT NULL,
  `farmNo` varchar(100) DEFAULT NULL,
  `farmName` varchar(100) DEFAULT NULL,
  `ownerID` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `farmPicture` varchar(255) DEFAULT NULL,
  `farmToken` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'renting',
  `added_by` int(11) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farms`
--

INSERT INTO `farms` (`farmID`, `farmNo`, `farmName`, `ownerID`, `description`, `category`, `farmPicture`, `farmToken`, `status`, `added_by`, `date_added`, `updated_by`, `date_updated`) VALUES
(3, 'farm No. 123QA', 'ARUSHA ESTATE', 2, 'well fertile and in location nearby river, so suports irrigation farming.', 'clay', 'Farm-arusha estate-khalifa_mchinja-ce6ead6a.jpg', 'ce6ead6a', 'renting', 2, '2022-02-15 00:04:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `invoiceID` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `blockID` int(11) NOT NULL,
  `farmID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rent` decimal(10,2) NOT NULL,
  `accres` decimal(10,2) NOT NULL,
  `total_rent_before_tax` decimal(10,2) DEFAULT NULL,
  `tax_rate` decimal(10,2) DEFAULT NULL,
  `totalRent` decimal(10,2) NOT NULL,
  `status` varchar(100) DEFAULT 'not paid',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `paid` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payID` int(11) NOT NULL,
  `blockID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `farmID` int(11) NOT NULL,
  `paid` decimal(10,2) DEFAULT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `pay_status` varchar(11) DEFAULT 'pending',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved_by` int(11) DEFAULT NULL,
  `date_approved` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `receiptID` int(11) NOT NULL,
  `paid` decimal(10,0) DEFAULT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(255) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `payID` int(11) DEFAULT NULL,
  `invoiceID` int(11) DEFAULT NULL,
  `bookingID` int(11) DEFAULT NULL,
  `blockID` int(11) DEFAULT NULL,
  `farmID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `reg_id` int(11) NOT NULL,
  `region` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`reg_id`, `region`) VALUES
(1, 'Arusha Region'),
(2, 'Dar es Salaam Region'),
(3, 'Dodoma Region'),
(4, 'Geita Region'),
(5, 'Iringa Region'),
(6, 'Kagera Region'),
(7, 'Katavi Region'),
(8, 'Kigoma Region'),
(9, 'Kilimanjaro Region'),
(10, 'Lindi Region'),
(11, 'Manyara Region'),
(12, 'Mara Region'),
(13, 'Mbeya Region'),
(14, 'Morogoro Region'),
(15, 'Mtwara Region'),
(16, 'Mwanza Region'),
(17, 'Njombe Region'),
(18, 'Pwani Region'),
(19, 'Rukwa Region'),
(20, 'Ruvuma Region'),
(21, 'Shinyanga Region'),
(22, 'Simiyu Region'),
(23, 'Singida Region'),
(24, 'Songwe Region'),
(25, 'Tabora Region'),
(26, 'Tanga Region'),
(27, 'Kaskazini Pemba Region'),
(28, 'Kaskazini Unguja Region'),
(29, 'Kusini Pemba Region'),
(30, 'Kusini Region '),
(31, 'Mjini Magharibi Region');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenantID` int(11) NOT NULL,
  `contractID` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `blockID` int(11) NOT NULL,
  `farmID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rent` decimal(10,2) NOT NULL,
  `accres` int(11) NOT NULL,
  `totalRent` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `status` varchar(100) DEFAULT 'active',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `TIN` varchar(255) DEFAULT NULL,
  `NIDA` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(11) DEFAULT 'active',
  `photo` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `fname`, `mname`, `lname`, `gender`, `password`, `email`, `phone`, `dob`, `TIN`, `NIDA`, `role`, `status`, `photo`, `token`, `added_by`, `date_added`, `updated_by`, `date_updated`) VALUES
(1, 'KHALIFA', 'ABDILLAH', 'MCHINJA', 'male', 'e10adc3949ba59abbe56e057f20f883e', 'admin@fms.com', '255687482855', '2022-02-15 00:53:18', NULL, NULL, 'admin', 'active', 'user.jpg', NULL, NULL, '2022-02-15 02:55:33', NULL, '2022-02-15 00:53:18'),
(2, 'KHALIFA', 'ABDILLAH', 'MCHINJA', 'male', 'e10adc3949ba59abbe56e057f20f883e', 'landlord@fms.com', '255687482855', '1990-01-01 00:00:00', NULL, NULL, 'landlord', 'active', 'DP-Khalifa-mchinja-e7935296df00d30a9dff.jpg', 'e7935296df00d30a9dff', '1', '2022-02-15 02:59:35', NULL, NULL),
(3, 'KHALIFA', 'ABDILLAH', 'MCHINJA', 'male', 'e10adc3949ba59abbe56e057f20f883e', 'tenant@fms.com', '255687482855', '1990-01-01 00:00:00', NULL, NULL, 'tenant', 'active', 'DP-Khalifa-mchinja-b1d43b6ab971a736276d.jpg', 'b1d43b6ab971a736276d', '1', '2022-02-15 21:43:58', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region` (`region`),
  ADD KEY `district` (`district`),
  ADD KEY `council` (`council`),
  ADD KEY `userID` (`userID`),
  ADD KEY `farmID` (`farmID`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`blockID`),
  ADD KEY `farmID` (`farmID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `farmID` (`farmID`),
  ADD KEY `blockID` (`blockID`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contactID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `councils`
--
ALTER TABLE `councils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dist_id` (`dist_id`),
  ADD KEY `reg_id` (`reg_id`);

--
-- Indexes for table `customer_comments`
--
ALTER TABLE `customer_comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reg_id` (`reg_id`);

--
-- Indexes for table `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`farmID`),
  ADD KEY `ownerID` (`ownerID`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`invoiceID`),
  ADD KEY `bookingID` (`bookingID`),
  ADD KEY `blockID` (`blockID`),
  ADD KEY `farmID` (`farmID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `invoiceID` (`invoiceID`),
  ADD KEY `bookingID` (`bookingID`),
  ADD KEY `blockID` (`blockID`),
  ADD KEY `farmID` (`farmID`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`receiptID`),
  ADD KEY `farmID` (`farmID`),
  ADD KEY `blockID` (`blockID`),
  ADD KEY `bookingID` (`bookingID`),
  ADD KEY `invoiceID` (`invoiceID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `payID` (`payID`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenantID`),
  ADD KEY `invoiceID` (`invoiceID`),
  ADD KEY `bookingID` (`bookingID`),
  ADD KEY `blockID` (`blockID`),
  ADD KEY `farmID` (`farmID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `contractID` (`contractID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `blockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `councils`
--
ALTER TABLE `councils`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `customer_comments`
--
ALTER TABLE `customer_comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `farmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `receiptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `tenantID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blocks`
--
ALTER TABLE `blocks`
  ADD CONSTRAINT `block_ibfk_1` FOREIGN KEY (`farmID`) REFERENCES `farms` (`farmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`blockID`) REFERENCES `blocks` (`blockID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `councils`
--
ALTER TABLE `councils`
  ADD CONSTRAINT `councils_ibfk_1` FOREIGN KEY (`reg_id`) REFERENCES `regions` (`reg_id`),
  ADD CONSTRAINT `councils_ibfk_2` FOREIGN KEY (`dist_id`) REFERENCES `districts` (`id`);

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`reg_id`) REFERENCES `regions` (`reg_id`);

--
-- Constraints for table `farms`
--
ALTER TABLE `farms`
  ADD CONSTRAINT `farms_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_ibfk_1` FOREIGN KEY (`blockID`) REFERENCES `blocks` (`blockID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_items_ibfk_4` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_items_ibfk_5` FOREIGN KEY (`farmID`) REFERENCES `farms` (`farmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_items_ibfk_6` FOREIGN KEY (`bookingID`) REFERENCES `bookings` (`bookingID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`blockID`) REFERENCES `blocks` (`blockID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`invoiceID`) REFERENCES `invoice_items` (`invoiceID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`farmID`) REFERENCES `farms` (`farmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_4` FOREIGN KEY (`bookingID`) REFERENCES `bookings` (`bookingID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_5` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_ibfk_1` FOREIGN KEY (`farmID`) REFERENCES `farms` (`farmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receipts_ibfk_2` FOREIGN KEY (`blockID`) REFERENCES `blocks` (`blockID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receipts_ibfk_4` FOREIGN KEY (`invoiceID`) REFERENCES `invoice_items` (`invoiceID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receipts_ibfk_5` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `tenants_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
