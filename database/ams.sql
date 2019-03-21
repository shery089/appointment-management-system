-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2019 at 04:15 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `joined_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `token` varchar(64) NOT NULL,
  `type` varchar(30) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `middle_name`, `last_name`, `address`, `mobile_number`, `email`, `password`, `salt`, `joined_date`, `updated_date`, `is_active`, `token`, `type`, `permissions`) VALUES
(22, 'john', '', 'doe', 'lorem ipsum lorem ipsum', '12345678910', 'john.doe@example.com', '0f5b53ea2e11fbd9a0dd520b659561ba2f7f44a17ab5a82e59b318b313a67b29b83ece8e63f91ee00af6bab7610755978b936fb2036f708bb74a7f1492fc596c', '5c93aa3c23b3c2.31586952', '2019-03-21 20:14:04', '2019-03-21 20:14:04', 1, '', '', '{\"admin\": 1}');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `visit_purpose` text NOT NULL,
  `date` date NOT NULL,
  `morning_shift` varchar(5) DEFAULT 'N/A',
  `evening_shift` text NOT NULL,
  `inserted_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `admin_id`, `patient_id`, `doctor_id`, `visit_purpose`, `date`, `morning_shift`, `evening_shift`, `inserted_date`, `updated_date`, `updated_admin`) VALUES
(1, 18, 12, 50, 'czxxxxxxxxxxxxxx', '2019-03-15', '0', '16:00', '2019-03-14 21:48:02', '2019-03-14 21:48:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`id`, `name`, `detail`) VALUES
(2, 'AIDS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae lorem enim. Morbi ut quam quis diam blandit ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(4, 'Cancer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae lorem enim. Morbi ut quam quis diam blandit ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(5, 'Cholera', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae lorem enim. Morbi ut quam quis diam blandit ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(6, 'Typhoid Fever', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae lorem enim. Morbi ut quam quis diam blandit ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(7, 'Dysentry', ''),
(8, 'Food Poisoning', ''),
(9, 'Diarrhoea', ''),
(10, 'Chicken Pox', ''),
(11, 'Small Pox', ''),
(12, 'Bones and Joints', ''),
(13, 'Whooping Cough', ''),
(14, 'Asthma', '&lt;p&gt;Asthma Is A Disease That Affects Your Lungs. It Causes Repeated Episodes Of Wheezing, Breathlessness, Chest Tightness, And Nighttime Or Early Morning Coughing&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `fee` mediumint(8) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `joined_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `first_name`, `middle_name`, `last_name`, `mobile_number`, `fee`, `password`, `salt`, `image`, `description`, `joined_date`, `updated_date`) VALUES
(50, 'fazal', 'ali', 'khan', '03335412547', 1000, '1620f5661f4fda9140b00faea051ebd86b11106261af5190c603b909a9410c974c1005362ee4c7a2d415342b5d6b55064dacde99446ee66202ea538778d66fbc', '58abe24e7de9a1.36837680', 'no_image_600.png', 'best regarded as trained medical specialists who deliver non- surgical treatment to patients. a general physician is the one who treats sensitive and chronic illnesses and give awareness about preventive care and health education to patients. the major responsibilities of general physician are to look after the overall complex health issues of any age and gender. the gp in pakistan has to go through 5 years of mbbs, one year internship, and after completion of that pmdc approves the permanent registration. then a candidate is eligible to choose his/ her career. either he/ she can opt for general physician or any other specialty. \\r\\n\\r\\nwelcome to general physicians in islamabad section. you will find the list of top & best general physicians in islamabad. get the contact details, address, location, reviews, rating & ranking. you can post your comments on general physicians in islamabad. if you are a practicing general physician and want to get listed here for free.', '2017-02-21 11:46:38', '2017-02-21 11:46:38'),
(51, 'ammara', '', 'rasul', '03332451789', 800, 'a46106d95309d370dd4e1f406358dc2827505b6391ffa80667d2603274229fa54632ed74021b26b4e31637c978aa25a7a5461ffaf492fa438166bd6a3caa3535', '58abe30ace7dd4.78246572', 'no_image_600.png', 'm.b.b.s qualified \\r\\nammara rasul - general physician in private . access the complete contact details of dr ammara rasul along with the relevant information. you can get appointment of doctor by a phone call or you can visit hospital or clinic on given address. it can facilitate you through to the accurate diagnosis and treatment of the disease. you can get hold of the contact details and consultation timings of dr ammara rasul in private . you can also find here other general physician doctors and consultants of the city &amp; hospital.', '2017-02-21 11:49:46', '2017-02-21 11:49:46'),
(52, 'shafeenaz', 'bibi', 'moosajee', '03334587968', 800, '22b3701197bdbb3842dc2f26cb1a0bfc591c9acb7e9aaf9fc844355fec0226c49efc2fc594f80bbebc705cf9dcc22a519049834d530510f0c3907d0b9117ac47', '58abe3dce23703.80187201', 'no_image_600.png', 'shafeenaz bibi moosajee - general physician in private . access the complete contact details of dr shafeenaz bibi moosajee along with the relevant information. you can get appointment of doctor by a phone call or you can visit hospital or clinic on given address. it can facilitate you through to the accurate diagnosis and treatment of the disease. you can get hold of the contact details and consultation timings of dr shafeenaz bibi moosajee in private . you can also find here other general physician doctors and consultants of the city & hospital.', '2017-02-21 11:53:16', '2017-02-21 11:53:16'),
(53, 'munir', 'iqbal', 'malik', '03335124961', 1500, 'dd84de2de6059392fccb9246efab46ccf3c04beb940b7d9f2143a72d2ae90a5a5fb70e40ff074695c23d3dc7278c25f0ac971cbf17efad549552dfae9d520754', '58abe454060105.39039842', 'no_image_600.png', 'dr. munir iqbal malik - pediatrician in shifa medical center . access the complete contact details of dr. munir iqbal malik along with the relevant information. you can get appointment of doctor by a phone call or you can visit hospital or clinic on given address. it can facilitate you through to the accurate diagnosis and treatment of the disease. you can get hold of the contact details and consultation timings of dr. munir iqbal malik in shifa medical center . you can also find here other pediatrician doctors and consultants of the city &amp; hospital.\\r\\n\\r\\naddress1: savoy arcade (next to standard chartered bank), f-11 markaz, islamabad,islamabad, islamabad, pakistan', '2017-02-21 11:55:16', '2017-02-21 11:55:16'),
(54, 'mulazim', 'h', 'khara', '03332457896', 1500, '23192055474487eba9c39a54cfc6addd7115eeac914a4e0c1b3e56f6732e7902ce441b63c5abda700f7b44aa35ca82a486ddadcd1670b1f68682f435c24a897c', '58abe4b03db6e6.26783909', 'MY_1487660208.jpeg', 'dr mulazim h khara - pediatrician in ali medical center . access the complete contact details of dr mulazim h khara along with the relevant information. you can get appointment of doctor by a phone call or you can visit hospital or clinic on given address. it can facilitate you through to the accurate diagnosis and treatment of the disease. you can get hold of the contact details and consultation timings of dr mulazim h khara in ali medical center . you can also find here other pediatrician doctors and consultants of the city & hospital.\\r\\n\\r\\naddress1: pakistan institute of medical sciences islamabad', '2017-02-21 11:56:48', '2017-02-21 11:56:48'),
(55, 'yawar', 'hayat', 'khan', '03214578965', 1000, '234e38034583d235884e82770073c8ea1db3ca296c1c17bdd2bf90fb9727b04938a77013a1cef49a353d1e70e35bf7747944108a336b6cbaf6716b4427f3f521', '58abe4eb1b98e8.38921304', 'no_image_600.png', 'dr. yawar hayat khan - dentist in islamabad private hospital . access the complete contact details of dr. yawar hayat khan along with the relevant information. you can get appointment of doctor by a phone call or you can visit hospital or clinic on given address. it can facilitate you through to the accurate diagnosis and treatment of the disease. you can get hold of the contact details and consultation timings of dr. yawar hayat khan in islamabad private hospital . you can also find here other dentist doctors and consultants of the city & hospital.\\r\\n\\r\\naddress1: islamabad private hospital 38-e zahore plaza blue area islambad', '2017-02-21 11:57:47', '2017-02-21 11:57:47'),
(56, 'nabia', '', 'tariq', '03334512789', 1200, '205a359ab603bc071b5745d9843db5efb0e0efcc24b0d287b2cc46180fac0afe93c40b614831cf95e53b8fed084e8c4e92434d1db40ddd9867a7cda6e2053570', '58abe54d032d58.20602483', 'no_image_600.png', 'qualifications mbbs, dgo, fcps - gynecologist\\r\\n\\r\\ndr. nabia tariq - gynecologist in shifa international hospital . access the complete contact details of dr. nabia tariq along with the relevant information. you can get appointment of doctor by a phone call or you can visit hospital or clinic on given address. it can facilitate you through to the accurate diagnosis and treatment of the disease. you can get hold of the contact details and consultation timings of dr. nabia tariq in shifa international hospital . you can also find here other gynecologist doctors and consultants of the city & hospital.\\r\\n\\r\\naddress1: sector h8/4,islamabad', '2017-02-21 11:59:25', '2017-02-21 11:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_details`
--

CREATE TABLE `doctor_details` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor_details`
--

INSERT INTO `doctor_details` (`id`, `doctor_id`, `specialization_id`) VALUES
(65, 50, 45),
(66, 51, 45),
(67, 52, 45),
(68, 53, 46),
(69, 54, 46),
(70, 55, 44),
(71, 56, 43);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_specialization`
--

CREATE TABLE `doctor_specialization` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor_specialization`
--

INSERT INTO `doctor_specialization` (`id`, `name`, `detail`) VALUES
(34, 'plastic surgery', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae lorem enim. Morbi ut quam quis diam blandit ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(36, 'allergist (immunologist)', 'lorem ipsum dolor sit amet, consectetur adipiscing elit. curabitur vitae lorem enim. morbi ut quam quis diam blandit ornare. pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(37, 'heart specialist', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae lorem enim. Morbi ut quam quis diam blandit ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(38, 'urology', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae lorem enim. Morbi ut quam quis diam blandit ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(39, 'child specialist', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae lorem enim. Morbi ut quam quis diam blandit ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(43, 'gynaecologist', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae lorem enim. Morbi ut quam quis diam blandit ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(44, 'dentist', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae lorem enim. Morbi ut quam quis diam blandit ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
(45, 'general surgeon', 'general surgeon'),
(46, 'pediatrician', 'pediatrician');

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `id` int(11) NOT NULL,
  `dose` text NOT NULL,
  `disease_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `mr_number` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `birthday` date NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `joined_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `mr_number`, `first_name`, `middle_name`, `last_name`, `email`, `mobile_number`, `father_name`, `gender`, `birthday`, `cnic`, `joined_date`, `updated_date`) VALUES
(12, '1470m383037o', 'john', '', 'doe', 'john@example.com', '03335798685', 'jackson', 'male', '1997-08-19', '37201-1454545-1', '2016-08-05 12:43:57', '2016-08-09 09:58:08'),
(14, '1470s721096o', 'muhammad', '', 'umair', 'harry@gmail.com', '03335789658', 'muhammad umair', 'male', '2016-08-02', '37201-1454545-2', '2016-08-09 10:38:16', '2016-08-09 10:38:16'),
(15, '1470z721246i', 'sharjeel', '', 'faisal', 'jeeli@gmail.com', '03335246897', 'faisal bhutta', 'male', '2016-08-03', '37201-1454545-3', '2016-08-09 10:40:46', '2016-08-09 10:40:46'),
(32, '1470m732856g', 'sheryar', '', 'ahmed', 'sheryarahmed007@gmail.com', '03256465845', 'null', 'male', '2016-08-03', '37201-1454545-6', '2016-08-09 13:54:16', '2016-08-09 13:54:16'),
(33, '1470m733982j', 'ali', '', 'khan', 'alikhan@gmail.com', '03256465845', 'null', 'male', '2016-08-09', '37201-1454545-8', '2016-08-09 14:13:02', '2016-08-09 14:13:02'),
(34, '1470m734060y', 'wasif', '', 'nisar', 'wasif@gmail.com', '03256465845', 'null', 'male', '2016-08-03', '37201-1454545-9', '2016-08-09 14:14:20', '2016-08-09 14:14:20'),
(35, '1470x734855g', 'umar', 'javed', 'bhatti', 'bhatti@gmail.com', '03335487962', 'null', 'male', '1970-08-19', '37201-1454525-5', '2016-08-09 14:27:35', '2016-08-09 14:27:35'),
(36, '1470k735088n', 'najam', '', 'butt', 'najam_butt@gmail.com', '03335487965', 'null', 'male', '2016-08-03', '37101-1454545-2', '2016-08-09 14:31:28', '2016-08-09 14:31:28'),
(37, '1470h735189p', 'saqib ', '', 'warich', 'saqib@gmail.com', '03335479856', 'null', 'male', '2016-08-02', '37201-1454545-4', '2016-08-09 14:33:09', '2016-08-09 14:33:09'),
(38, '1470h735368h', 'haider', '', 'zaman', 'haider@gmail.com', '03325478596', 'null', 'male', '1999-08-12', '37201-1454542-1', '2016-08-09 14:36:08', '2016-08-09 14:36:08'),
(41, '1471y239846y', 'ahmed', '', 'khan', 'ahmed@gmail.com', '03335487965', 'null', 'male', '1999-08-09', '31201-1454545-5', '2016-08-15 10:44:06', '2016-08-15 10:44:06'),
(42, '1471o240280t', 'hdgashdgashd', '', 'sadbjasdbhas', 'sheryarahmed007@gmail.com', '03335478512', 'null', 'male', '2016-08-02', '37201-1454145-1', '2016-08-15 10:51:20', '2016-08-15 10:51:20'),
(43, '1471z244071n', 'sheryar', 'sdas', 'dsadas', 'sheryarahmed007@gmail.com', '03335478512', 'null', 'male', '2016-08-15', '37201-1454545-5', '2016-08-15 11:54:31', '2016-08-15 11:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `disease_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `visited_date` date NOT NULL,
  `visited_time` text NOT NULL,
  `prescription` text NOT NULL,
  `next_visit_date` date NOT NULL,
  `food` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `admin_id`, `patient_id`, `doctor_id`, `visited_date`, `visited_time`, `prescription`, `next_visit_date`, `food`) VALUES
(1, 18, 12, 50, '2019-03-15', '16:00', 'yadjsbdjabsjd', '0000-00-00', 'bjdbasjdjasdb');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `day` varchar(9) NOT NULL,
  `date` date NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `first_shift_start` text NOT NULL,
  `first_shift_end` text NOT NULL,
  `second_shift_start` text NOT NULL,
  `second_shift_end` text NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `day`, `date`, `doctor_id`, `first_shift_start`, `first_shift_end`, `second_shift_start`, `second_shift_end`, `insert_date`, `update_date`) VALUES
(1, 'Tuesday', '2017-02-21', 50, '9:00', '13:00', '16:00', '19:00', '2017-02-21 12:00:55', '2017-02-21 12:00:55'),
(2, 'Thursday', '2017-02-23', 50, '9:00', '13:00', '16:00', '19:00', '2017-02-21 12:00:55', '2017-02-21 12:00:55'),
(3, 'Friday', '2017-02-24', 50, '9:00', '13:00', '16:00', '19:00', '2017-02-21 12:00:55', '2017-02-21 12:00:55'),
(4, 'Saturday', '2017-02-25', 50, '9:00', '13:00', '16:00', '19:00', '2017-02-21 12:00:55', '2017-02-21 12:00:55'),
(5, 'Sunday', '2017-02-26', 50, '9:00', '13:00', '16:00', '19:00', '2017-02-21 12:00:55', '2017-02-21 12:00:55'),
(6, 'Monday', '2017-02-27', 50, '9:00', '13:00', '16:00', '19:00', '2017-02-21 12:00:55', '2017-02-21 12:00:55'),
(7, 'Tuesday', '2017-02-21', 51, '9:00', '12:00', '18:00', '23:00', '2017-02-21 12:01:21', '2017-02-21 12:01:21'),
(8, 'Wednesday', '2017-02-22', 51, '9:00', '12:00', '18:00', '23:00', '2017-02-21 12:01:21', '2017-02-21 12:01:21'),
(9, 'Thursday', '2017-02-23', 51, '9:00', '12:00', '18:00', '23:00', '2017-02-21 12:01:21', '2017-02-21 12:01:21'),
(10, 'Friday', '2017-02-24', 51, '9:00', '12:00', '18:00', '23:00', '2017-02-21 12:01:21', '2017-02-21 12:01:21'),
(11, 'Saturday', '2017-02-25', 51, '9:00', '12:00', '18:00', '23:00', '2017-02-21 12:01:21', '2017-02-21 12:01:21'),
(12, 'Sunday', '2017-02-26', 51, '9:00', '12:00', '18:00', '23:00', '2017-02-21 12:01:21', '2017-02-21 12:01:21'),
(13, 'Monday', '2017-02-27', 51, '9:00', '12:00', '18:00', '23:00', '2017-02-21 12:01:21', '2017-02-21 12:01:21'),
(14, 'Tuesday', '2017-02-21', 52, '10:00', '13:00', '16:00', '20:00', '2017-02-21 12:01:50', '2017-02-21 12:01:50'),
(15, 'Wednesday', '2017-02-22', 52, '10:00', '13:00', '16:00', '20:00', '2017-02-21 12:01:50', '2017-02-21 12:01:50'),
(16, 'Thursday', '2017-02-23', 52, '10:00', '13:00', '16:00', '20:00', '2017-02-21 12:01:50', '2017-02-21 12:01:50'),
(17, 'Friday', '2017-02-24', 52, '10:00', '13:00', '16:00', '20:00', '2017-02-21 12:01:50', '2017-02-21 12:01:50'),
(18, 'Saturday', '2017-02-25', 52, '10:00', '13:00', '16:00', '20:00', '2017-02-21 12:01:50', '2017-02-21 12:01:50'),
(19, 'Sunday', '2017-02-26', 52, '10:00', '13:00', '16:00', '20:00', '2017-02-21 12:01:50', '2017-02-21 12:01:50'),
(20, 'Monday', '2017-02-27', 52, '10:00', '13:00', '16:00', '20:00', '2017-02-21 12:01:50', '2017-02-21 12:01:50'),
(21, 'Wednesday', '2017-02-22', 53, '8:00', '12:00', '16:00', '20:00', '2017-02-21 12:02:07', '2017-02-21 12:02:07'),
(22, 'Thursday', '2017-02-23', 53, '8:00', '12:00', '16:00', '20:00', '2017-02-21 12:02:07', '2017-02-21 12:02:07'),
(23, 'Friday', '2017-02-24', 53, '8:00', '12:00', '16:00', '20:00', '2017-02-21 12:02:07', '2017-02-21 12:02:07'),
(24, 'Friday', '2017-02-24', 54, '7:00', '10:00', '16:00', '20:00', '2017-02-21 12:02:27', '2017-02-21 12:02:27'),
(25, 'Saturday', '2017-02-25', 54, '7:00', '10:00', '16:00', '20:00', '2017-02-21 12:02:27', '2017-02-21 12:02:27'),
(26, 'Monday', '2017-02-27', 54, '7:00', '10:00', '16:00', '20:00', '2017-02-21 12:02:27', '2017-02-21 12:02:27'),
(27, 'Wednesday', '2017-02-22', 55, '7:00', '11:00', '16:00', '20:00', '2017-02-21 12:02:42', '2017-02-21 12:02:42'),
(28, 'Thursday', '2017-02-23', 55, '7:00', '11:00', '16:00', '20:00', '2017-02-21 12:02:42', '2017-02-21 12:02:42'),
(29, 'Friday', '2017-02-24', 55, '7:00', '11:00', '16:00', '20:00', '2017-02-21 12:02:42', '2017-02-21 12:02:42'),
(30, 'Wednesday', '2017-02-22', 56, '11:00', '15:00', '18:00', '22:00', '2017-02-21 12:03:03', '2017-02-21 12:03:03'),
(31, 'Thursday', '2017-02-23', 56, '11:00', '15:00', '18:00', '22:00', '2017-02-21 12:03:03', '2017-02-21 12:03:03'),
(32, 'Friday', '2017-02-24', 56, '11:00', '15:00', '18:00', '22:00', '2017-02-21 12:03:03', '2017-02-21 12:03:03'),
(33, 'Thursday', '2019-03-14', 50, '7:00', '11:00', '16:00', '19:00', '2019-03-14 21:42:06', '2019-03-14 21:42:06'),
(34, 'Friday', '2019-03-15', 50, '7:00', '11:00', '16:00', '19:00', '2019-03-14 21:42:06', '2019-03-14 21:42:06'),
(35, 'Saturday', '2019-03-16', 50, '7:00', '11:00', '16:00', '19:00', '2019-03-14 21:42:06', '2019-03-14 21:42:06'),
(36, 'Sunday', '2019-03-17', 50, '7:00', '11:00', '16:00', '19:00', '2019-03-14 21:42:06', '2019-03-14 21:42:06'),
(37, 'Monday', '2019-03-18', 50, '7:00', '11:00', '16:00', '19:00', '2019-03-14 21:42:06', '2019-03-14 21:42:06'),
(38, 'Tuesday', '2019-03-19', 50, '7:00', '11:00', '16:00', '19:00', '2019-03-14 21:42:06', '2019-03-14 21:42:06'),
(39, 'Wednesday', '2019-03-20', 50, '7:00', '11:00', '16:00', '19:00', '2019-03-14 21:42:06', '2019-03-14 21:42:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialization_id` (`specialization_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_specialization`
--
ALTER TABLE `doctor_specialization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `doctor_details`
--
ALTER TABLE `doctor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `doctor_specialization`
--
ALTER TABLE `doctor_specialization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appt_fk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appt_fk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD CONSTRAINT `doctor_details_ibfk_1` FOREIGN KEY (`specialization_id`) REFERENCES `doctor_specialization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_details_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `sch_fk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
