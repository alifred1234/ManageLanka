-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2022 at 07:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `managelanka`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL,
  `district` varchar(50) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`name`, `email`, `username`, `password`, `usertype`, `role`, `id`, `district`, `company_name`, `group_name`, `contact_number`) VALUES
('John Doe', 'qq@gmail.com', 'admin', '$2y$10$jkn0fha5HTQxEAhxYhwvn.aCG.3YQ/vvHvUa6wcBLXIbEbIsA2FNe', 'admin', 'admin', 'a0001', '', '', '', '###'),
('Adam Devine', 'kj@gmail.com', 'citizen1', '$2y$10$bnI.tDj2Vx9vFVRYtH4nRe/xmlqTVZT0m2T5OrUXOADN9C3kZTlSq', 'citizen', 'citizen', 'qaz1', '1', '', '', '###'),
('Jason Borne', 'jb@gmail.com', 'citizen2', '$2y$10$doxIwSFACd2zJa0CKEY5.OOLMfKsE19Ul2IJjIxakggJvBXJcjWVi', 'citizen', 'citizen', 'qaz2', '2', '', '', '###'),
('Kevin Harold', 'kh@gmail.com', 'citizen3', '$2y$10$IUIwc7nR1vZF8tObSXRIn.qRdg4DkZBfXdLVT5G5qsagxUi5B/3xG', 'citizen', 'citizen', 'qaz3', '3', '', '', '###'),
('Mary Jane', 'mj@gmail.com', 'mcr1', '$2y$10$jIJMd5BRfyLNHlEFYBcUPuNhiH6Iyeq0OZj2FEZRtWgXKDtL0P5tG', 'business', 'municipal', 'qw33', '1', '', '', '###'),
('Martha Swed', 'ms@gmail.com', 'mcr2', '$2y$10$J6brh9hJ3brXVX7ufOOH.u27qRXul.2HRRtmz28VPkceuNXdw7QBu', 'business', 'municipal', 'qa44', '2', '', '', '###'),
('Alice Jardy', 'aj@gmail.com', 'mcr3', '$2y$10$7LblGFERJb6i2vMA09gqJOGPMFMeAei7NF7Jw0jbr6tUnQD5WlnhG', 'business', 'municipal', 'qa55', '3', '', '', '###'),
('Alex Stroll', 'ASD@gmail.com', 'recycle', '$2y$10$ao7MS/1eVOrlE/iCsQuVvuLP/eUokZV7y22hK4wEKQ8KaPEC0u/yK', 'business', 'recycler', '112233', '', 'Trashed', '', '###'),
('Jordan Orme', 'jo@gmail.com', 'restaurant', '$2y$10$Kzi/lZqGiA8vxgXSqwyF7OxjOhfBtqhYN4ppEHCVnqK9.0xn58HdO', 'business', 'restaurant', '1q2w3e', '', 'Eat', '', '###'),
('David Zass', 'dz@gmail.com', 'retail', '$2y$10$h3af49lMEKEop.A55lyxiuSD97saSd4L3i9Hi457YS79MBsWTH91m', 'business', 'retailer', '1qazxsw2', '', 'Keells', '', '###'),
('Cole Stewart', 'ks@gmail.com', 'volunteer', '$2y$10$UuYgKAeVLcFRIpvvp4SxzO.42qquzS43ZEnpcxz0oMFHo4A9ZPSgi', 'business', 'volunteer', '', '', '', 'With Me', '###'),
('Lucy Hale', 'smail@gmail.com', 'citizen4', '$2y$10$uCs8TVGdcMq7QWXx2PEF8On/1RUZbdq4i1n1sZHgR3ZKc39AJky5W', 'citizen', 'citizen', 'qssasd', '4', '', '', '###'),
('Hailey Boe', 'cb009394@students.apiit.lk', 'citizen5', '$2y$10$57V9NvSKXJgV1KZMCOAVzexlZB1BYO2TZhK2vHzsGuw/y72KEfW5W', 'citizen', 'citizen', 'zaq1', '5', '', '', '###'),
('George Jackson', 'gkj@gmail.com', 'mcr4', '$2y$10$Z8mK3J7Ci0Yghu47FGH14OW7TxxslzGRVpJAo5pxJB808SnX/jgp.', 'business', 'municipal', '1qaz2ws', '4', '', '', '###');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
