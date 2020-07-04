-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 17, 2020 at 07:54 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(10) NOT NULL,
  `work_hour` int(50) NOT NULL DEFAULT 0,
  `check_in` datetime(6) NOT NULL,
  `check_out` datetime(6) DEFAULT NULL,
  `emp_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `work_hour`, `check_in`, `check_out`, `emp_id`) VALUES
(1, 8, '2020-05-08 06:00:00.000000', '2020-05-08 14:00:00.000000', 1),
(13, 8, '2020-05-07 06:00:00.000000', '2020-05-07 14:00:00.000000', 1),
(22, 17, '2020-05-09 06:56:28.000000', '2020-05-09 23:21:02.000000', 1),
(23, 6, '2020-05-09 06:03:47.000000', '2020-05-09 12:10:43.000000', 14),
(25, 6, '2020-05-09 05:39:36.000000', '2020-05-09 12:40:56.000000', 15),
(26, -5, '2020-05-10 01:05:24.000000', '2020-05-10 01:05:42.000000', 1),
(27, 9, '2020-05-10 15:37:14.000000', '2020-05-10 15:38:43.000000', 14),
(28, -4, '2020-05-13 01:01:45.000000', '2020-05-13 02:41:54.000000', 14),
(29, 9, '2020-05-17 13:33:15.000000', '2020-05-17 22:56:50.000000', 14),
(30, 0, '2020-05-17 22:05:43.000000', '2020-05-17 22:07:57.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendancehistory`
--

CREATE TABLE `attendancehistory` (
  `histId` int(11) NOT NULL,
  `Check_In` datetime NOT NULL,
  `Check_Out` datetime NOT NULL,
  `work_time` int(20) NOT NULL,
  `attendance_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(10) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `father_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `postcode` int(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(15) NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `nid` int(20) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `job_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `Username`, `Password`, `first_name`, `last_name`, `father_name`, `dob`, `address`, `postcode`, `email`, `phone`, `marital_status`, `nationality`, `nid`, `religion`, `status`, `job_id`) VALUES
(1, 'Zilqad', '51071196C0000F29DA1A9FF99B1358F4', 'Al', 'Zilqad', 'Sattar32', '1997-03-03', 'fgewgweg32', 141242, 'kfasfj2n@gmail.com', 4286894, 'Married', 'Greek', 721478, 'Islam', 1, 14),
(14, 'yaber', 'c1d74ea871569ad7d8e819627e9d5af8', 'Yaber', 'Hasan', 'Zaman', '2020-04-05', 'Bashundhara R/A', 9283, 'yaberhasan23@gmail.com', 429174907, 'married', 'Bangladeshi', 84217498, 'Islam', 1, 1),
(15, 'tonoy', '7DF635C14C0237828CA668244190DBEB', 'Al', 'Tonoy', 'Sattar', '1997-03-03', 'awg', 1312, 'daksbf@gmail.com', 42179847, 'Single', 'Bangladeshi', 8421742, 'Islam', 1, 8),
(333, 'lasflksdj', '912ec803b2ce49e4a541068d495ab570', 'asdf', 'asdf', 'asdf', '1997-07-23', 'asdf', 9, 'asdfasd@mail.com', 399393, 'UNMARRIED', 'BD', 38333, 'ISLAM', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `holiday_id` int(20) NOT NULL,
  `holiday_name` varchar(20) NOT NULL,
  `day` date NOT NULL,
  `bonus` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`holiday_id`, `holiday_name`, `day`, `bonus`) VALUES
(1, 'Eid-ul-Fitr', '2020-06-28', 20),
(2, 'Eid-ul-Azha', '2020-08-28', 30),
(3, 'Independence Day', '2020-03-26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(10) NOT NULL,
  `type` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `position` varchar(50) NOT NULL,
  `hourly_rate` double(20,2) NOT NULL,
  `over_time_rate` double(20,2) NOT NULL,
  `work_hour` int(50) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `type`, `status`, `position`, `hourly_rate`, `over_time_rate`, `work_hour`, `department`) VALUES
(1, 1, 1, 'Web Developer', 285.00, 250.00, 40, 'Development'),
(6, 1, 1, 'Java Developer', 210.00, 210.00, 50, 'Development'),
(8, 0, 1, 'Project Cordinator', 250.00, 200.00, 30, 'Management'),
(14, 1, 1, 'Business Analyst', 320.00, 300.00, 24, 'Development');

-- --------------------------------------------------------

--
-- Table structure for table `leaveday`
--

CREATE TABLE `leaveday` (
  `leave_id` int(20) NOT NULL,
  `annual_leave` int(20) NOT NULL,
  `emp_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `UserId` int(20) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`UserId`, `Username`, `Password`) VALUES
(1, 'Admin', '26a91342190d515231d7238b0c5438e1'),
(2, 'nexas', 'FDF72838F8C55365C54C523FB0B17B58');

-- --------------------------------------------------------

--
-- Table structure for table `salaryhistory`
--

CREATE TABLE `salaryhistory` (
  `histid` int(20) NOT NULL,
  `work_hour` int(11) NOT NULL DEFAULT 0,
  `over_time_hour` int(20) NOT NULL DEFAULT 0,
  `salary` int(20) NOT NULL DEFAULT 0,
  `month` date NOT NULL,
  `empid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salaryhistory`
--

INSERT INTO `salaryhistory` (`histid`, `work_hour`, `over_time_hour`, `salary`, `month`, `empid`) VALUES
(1, 22, 0, 7040, '2020-05-01', 1),
(2, 6, 0, 1710, '2020-05-01', 14),
(3, 6, 0, 1500, '2020-05-01', 15),
(4, 0, 0, 0, '2020-04-01', 1),
(5, 0, 0, 0, '2020-04-01', 14),
(6, 0, 0, 0, '2020-04-01', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `attendancehistory`
--
ALTER TABLE `attendancehistory`
  ADD PRIMARY KEY (`histId`),
  ADD KEY `att` (`attendance_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nid` (`nid`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`holiday_id`),
  ADD UNIQUE KEY `day` (`day`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `leaveday`
--
ALTER TABLE `leaveday`
  ADD PRIMARY KEY (`leave_id`),
  ADD UNIQUE KEY `emp_id_2` (`emp_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `salaryhistory`
--
ALTER TABLE `salaryhistory`
  ADD PRIMARY KEY (`histid`),
  ADD KEY `ref5` (`empid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `attendancehistory`
--
ALTER TABLE `attendancehistory`
  MODIFY `histId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `holiday_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `leaveday`
--
ALTER TABLE `leaveday`
  MODIFY `leave_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `UserId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salaryhistory`
--
ALTER TABLE `salaryhistory`
  MODIFY `histid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
