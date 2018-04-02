-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2018 at 03:36 PM
-- Server version: 5.7.10
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(90) NOT NULL,
  `password` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('deepanjank', 'shubham95');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(90) NOT NULL,
  `empno` int(100) NOT NULL,
  `pay` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `dayswork` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `otrate` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `othrs` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `allow` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `advances` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `insurance` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `empno`, `pay`, `dayswork`, `otrate`, `othrs`, `allow`, `advances`, `insurance`, `time`) VALUES
(8, 420, '10000.00', 21, '500.00', 8, '1000.00', '1000.00', '1000.00', '2016-02-06'),
(9, 108, '10000.00', 20, '100.00', 5, '1000.00', '500.00', '100.00', '2016-08-06'),
(10, 420, '10000.00', 20, '1.00', 200, '1000.00', '1900.00', '1900.00', '2016-10-06'),
(11, 1098, '10000.00', 21, '200.00', 1000, '1200.00', '500.00', '800.00', '2017-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `emp_info`
--

CREATE TABLE `emp_info` (
  `id` int(90) NOT NULL,
  `empno` int(90) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `init` varchar(1) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `bdate` date NOT NULL,
  `dept` varchar(15) NOT NULL,
  `position` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_info`
--

INSERT INTO `emp_info` (`id`, `empno`, `photo`, `lname`, `fname`, `init`, `gender`, `bdate`, `dept`, `position`) VALUES
(5, 420, '10479938_1040552309304661_5626545784013102309_o.jpg', 'Kowar', 'Deepanjan', '', 'Male', '1996-11-11', 'Accounting', 'Accountant'),
(6, 108, 'DSC_0255.JPG', 'Kowar', 'Deepalika', 'M', 'Female', '1994-08-11', 'Production', 'Manager'),
(7, 100, '0', 'Agrawal', 'Abhay', 'S', 'Male', '1995-05-12', 'R&D', 'Head'),
(8, 1098, '0', 'DK', 'DK', 'M', 'Male', '1995-07-11', 'R&D', 'Intern'),
(9, 101, '0', 'Kowar', 'Jharna', 'J', 'Female', '1967-01-06', 'IT', 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `other_info`
--

CREATE TABLE `other_info` (
  `empno` int(90) NOT NULL,
  `address` varchar(90) NOT NULL,
  `contact` bigint(50) NOT NULL,
  `post` int(90) NOT NULL,
  `gender` varchar(90) NOT NULL,
  `stat` varchar(90) NOT NULL,
  `bdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_info`
--

INSERT INTO `other_info` (`empno`, `address`, `contact`, `post`, `gender`, `stat`, `bdate`) VALUES
(420, 'Bhilai', 7828805543, 490006, 'Male', 'Single', '1995-08-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_info`
--
ALTER TABLE `emp_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_info`
--
ALTER TABLE `other_info`
  ADD PRIMARY KEY (`empno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `emp_info`
--
ALTER TABLE `emp_info`
  MODIFY `id` int(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `other_info`
--
ALTER TABLE `other_info`
  MODIFY `empno` int(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
