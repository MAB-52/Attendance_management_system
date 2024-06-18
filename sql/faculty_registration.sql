-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 08:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faculty_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty_registration`
--

CREATE TABLE `faculty_registration` (
  `sr_no` int(9) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `birth_date` date NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_registration`
--

INSERT INTO `faculty_registration` (`sr_no`, `name`, `mobile_no`, `birth_date`, `qualification`, `email`, `password`, `date`) VALUES
(1, 'testname', '1234567890', '2024-06-13', 'B.tech', '123@gmail.com', '123', '2024-06-18'),
(2, 'name', '1234567980', '2024-06-12', 'M.tech', '124@gmail.com', '123', '2024-06-18'),
(15, 'Alex', '9874563210', '2004-05-05', 'MBA', 'alex@gmail.com', '111', '2024-06-18'),
(16, 'Glenn', '9875236415', '2001-06-09', 'MBA', 'glen@gmail.com', '789', '2024-06-18'),
(17, 'Max', '7896541236', '1981-03-06', 'WDC', 'max@gmail.com', '114', '2024-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `student_registration`
--

CREATE TABLE `student_registration` (
  `student_id` int(10) NOT NULL,
  `student_name` varchar(200) NOT NULL,
  `roll_no` int(10) NOT NULL,
  `course` varchar(200) NOT NULL,
  `branch` varchar(200) NOT NULL,
  `semester` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_registration`
--

INSERT INTO `student_registration` (`student_id`, `student_name`, `roll_no`, `course`, `branch`, `semester`, `status`, `faculty_id`, `date`) VALUES
(1, 'Checo', 55, 'BE', 'COMPUTER', '6', 'Absent', 0, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty_registration`
--
ALTER TABLE `faculty_registration`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `student_registration`
--
ALTER TABLE `student_registration`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty_registration`
--
ALTER TABLE `faculty_registration`
  MODIFY `sr_no` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student_registration`
--
ALTER TABLE `student_registration`
  MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
