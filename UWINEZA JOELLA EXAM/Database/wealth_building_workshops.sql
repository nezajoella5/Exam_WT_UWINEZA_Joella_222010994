-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wealth_building_workshops`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tracking`
--

CREATE TABLE `attendance_tracking` (
  `AttendanceID` int(11) NOT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `AttendeeID` int(11) DEFAULT NULL,
  `Duration` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance_tracking`
--

INSERT INTO `attendance_tracking` (`AttendanceID`, `WorkshopID`, `AttendeeID`, `Duration`) VALUES
(1, 1, 2, '23:00:00'),
(2, 1, 2, '23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `AttendeesID` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `Occupation` varchar(255) DEFAULT NULL,
  `RegistrationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`AttendeesID`, `id`, `Occupation`, `RegistrationDate`) VALUES
(2, 3, 'Teacher', '2021-04-03'),
(3, 4, 'Doctor', '2023-02-22'),
(4, 1, 'Nurse', '2023-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `CertificateID` int(11) NOT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `AttendeeID` int(11) DEFAULT NULL,
  `DateOfCompletion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`CertificateID`, `WorkshopID`, `AttendeeID`, `DateOfCompletion`) VALUES
(1, 2, 3, '2024-05-22'),
(2, 3, 4, '2024-05-20'),
(3, 3, 3, '2021-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `AttendeeID` int(11) DEFAULT NULL,
  `Comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `WorkshopID`, `AttendeeID`, `Comments`) VALUES
(1, 2, 3, 'Thanks'),
(2, 3, 4, 'welcome'),
(3, 3, 3, 'good service');

-- --------------------------------------------------------

--
-- Table structure for table `instuctor`
--

CREATE TABLE `instuctor` (
  `InstructorID` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `Bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `instuctor`
--

INSERT INTO `instuctor` (`InstructorID`, `id`, `Bio`) VALUES
(1, 1, 'what is instructor'),
(2, 2, 'what is wealth'),
(3, 3, 'what is workshop');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `id`, `WorkshopID`, `Amount`) VALUES
(2, NULL, NULL, 2800.00),
(3, 4, 5, 4700.00),
(4, 3, 2, 3444.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'TACHA', 'umuhoza', 'Natacha', 'nshuti@gmail.com', '09856783', '$2y$10$jUS/2/OvdW4yH6E/wAq0wepmYL7jOh.0opg8gsqg0iB79qRnwLa7S', '2024-05-22 16:30:36', '123345', 0),
(3, 'loulou', 'Abijuru', 'louange', 'louange@gmail.com', '765432', '$2y$10$XhT.0JH0l1n5o7xx8iRliOwadhjvbAPd3t1pxwbP/V7U8AOxdMhOu', '2024-05-22 17:30:37', '67890', 0),
(4, 'bebe', 'Ntakirutimana', 'louange@gmail.com', 'beula@gmail.com', '87654', '$2y$10$PGkLaPCoRracylb3i6TA.uwbCixVT15PKo/bweTJqwpcd3WnmvxJ6', '2024-05-22 17:32:14', '7890', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wealth_building_resources`
--

CREATE TABLE `wealth_building_resources` (
  `ResourceID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wealth_building_resources`
--

INSERT INTO `wealth_building_resources` (`ResourceID`, `Title`, `Description`, `Type`) VALUES
(1, 'Statistics', 'Mathematics', 'Building resource'),
(2, 'Web Program', 'Web technology', 'Wealth resource'),
(3, 'Law', 'Wealth resources', 'Building resource'),
(4, 'Law', 'Wealth resources', 'Building resource');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `WorkshopID` int(11) NOT NULL,
  `InstructorID` int(11) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`WorkshopID`, `InstructorID`, `Title`, `Date`) VALUES
(1, 1, 'Web Program', '2020-01-03'),
(2, 2, 'Statistics', '2024-05-23'),
(3, 2, 'Statistics', '2024-05-23'),
(4, 2, 'Statistics', '2024-05-23'),
(5, 2, 'Statistics', '2024-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_material`
--

CREATE TABLE `workshop_material` (
  `MaterialID` int(11) NOT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `MaterialType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `workshop_material`
--

INSERT INTO `workshop_material` (`MaterialID`, `WorkshopID`, `MaterialType`) VALUES
(1, 2, 'Audio'),
(2, 2, 'Video'),
(3, 3, 'Audio');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_tracking`
--
ALTER TABLE `attendance_tracking`
  ADD PRIMARY KEY (`AttendanceID`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`AttendeesID`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`CertificateID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`);

--
-- Indexes for table `instuctor`
--
ALTER TABLE `instuctor`
  ADD PRIMARY KEY (`InstructorID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wealth_building_resources`
--
ALTER TABLE `wealth_building_resources`
  ADD PRIMARY KEY (`ResourceID`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`WorkshopID`);

--
-- Indexes for table `workshop_material`
--
ALTER TABLE `workshop_material`
  ADD PRIMARY KEY (`MaterialID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_tracking`
--
ALTER TABLE `attendance_tracking`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `AttendeesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `CertificateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `instuctor`
--
ALTER TABLE `instuctor`
  MODIFY `InstructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wealth_building_resources`
--
ALTER TABLE `wealth_building_resources`
  MODIFY `ResourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `WorkshopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workshop_material`
--
ALTER TABLE `workshop_material`
  MODIFY `MaterialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
