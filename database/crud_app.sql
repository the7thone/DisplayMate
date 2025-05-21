-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 16, 2024 at 04:55 PM
-- Server version: 11.4.2-MariaDB
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `exam_date` date NOT NULL,
  `start_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_name`, `faculty`, `exam_date`, `start_time`) VALUES
(1, 'Mathematics', 'BCA', '2024-09-10', '09:00:00'),
(2, 'Database Systems', 'BCCA', '2024-09-11', '10:00:00'),
(3, 'Computer Networks', 'BCA', '2024-09-12', '11:00:00'),
(4, 'Operating Systems', 'BCCA', '2024-09-13', '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `extra_curricular`
--

CREATE TABLE `extra_curricular` (
  `id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `faculty_department` varchar(255) NOT NULL,
  `activity_date` date NOT NULL,
  `start_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_curricular`
--

INSERT INTO `extra_curricular` (`id`, `activity_name`, `faculty_department`, `activity_date`, `start_time`) VALUES
(1, 'Sports Day', 'Sports Department', '2024-09-15', '08:00:00'),
(2, 'Cultural Fest', 'Cultural Committee', '2024-09-20', '10:00:00'),
(3, 'Debate Competition', 'BCA', '2024-09-25', '14:00:00'),
(4, 'Art Exhibition', 'Fine Arts Department', '2024-09-30', '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `friday`
--

CREATE TABLE `friday` (
  `id` int(11) NOT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `class_room` varchar(50) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `class_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friday`
--

INSERT INTO `friday` (`id`, `teacher_name`, `subject`, `class_room`, `start_time`, `end_time`, `class_name`) VALUES
(1, 'UPDATED', 'Philosophy', 'Room 501', '09:00:00', '10:30:00', 'Philosophy 101'),
(2, 'Megan Harris', 'Philosophy', 'Room 501', '10:45:00', '12:15:00', 'Philosophy 102'),
(3, 'Nathan Clark', 'Sociology', 'Room 502', '13:00:00', '14:30:00', 'Sociology 101'),
(4, 'Nathan Clark', 'Sociology', 'Room 502', '14:45:00', '16:15:00', 'Sociology 102'),
(5, 'Olivia Lewis', 'Statistics', 'Room 503', '09:00:00', '10:30:00', 'Statistics 101'),
(6, 'Olivia Lewis', 'Statistics', 'Room 503', '10:45:00', '12:15:00', 'Statistics 102');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `date`, `description`, `name`) VALUES
(1, '2024-08-10', 'Summer Festival', 'Summer Festival'),
(2, '2024-08-15', 'National Holiday', 'Independence Day'),
(3, '2024-08-20', 'Community Event', 'Community Event');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monday`
--

CREATE TABLE `monday` (
  `id` int(11) NOT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `class_room` varchar(50) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `class_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monday`
--

INSERT INTO `monday` (`id`, `teacher_name`, `subject`, `class_room`, `start_time`, `end_time`, `class_name`) VALUES
(1, 'Alice Smith', 'Mathematics', 'Room 101', '09:00:00', '10:30:00', 'Math 101'),
(2, 'Alice Smith', 'Mathematics', 'Room 101', '10:45:00', '12:15:00', 'Math 102'),
(3, 'Bob Johnson', 'History', 'Room 102', '13:00:00', '14:30:00', 'History 101'),
(4, 'Bob Johnson', 'History', 'Room 102', '14:45:00', '16:15:00', 'History 102'),
(5, 'Carol Williams', 'Biology', 'Room 103', '09:00:00', '10:30:00', 'Biology 101'),
(6, 'Carol Williams', 'Biology', 'Room 103', '10:45:00', '12:15:00', 'Biology 102');

-- --------------------------------------------------------

--
-- Table structure for table `saturday`
--

CREATE TABLE `saturday` (
  `id` int(11) NOT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `class_room` varchar(50) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `class_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saturday`
--

INSERT INTO `saturday` (`id`, `teacher_name`, `subject`, `class_room`, `start_time`, `end_time`, `class_name`) VALUES
(1, 'Paul Walker', 'Astronomy', 'Room 601', '09:00:00', '10:30:00', 'Astronomy 101'),
(2, 'Paul Walker', 'Astronomy', 'Room 601', '10:45:00', '12:15:00', 'Astronomy 102'),
(3, 'Quincy Hall', 'Music', 'Room 602', '13:00:00', '14:30:00', 'Music 101'),
(4, 'Quincy Hall', 'Music', 'Room 602', '14:45:00', '16:15:00', 'Music 102'),
(5, 'Rita Allen', 'Physical Education', 'Room 603', '09:00:00', '10:30:00', 'PE 101'),
(6, 'Rita Allen', 'Physical Education', 'Room 603', '10:45:00', '12:15:00', 'PE 102');

-- --------------------------------------------------------

--
-- Table structure for table `special_events`
--

CREATE TABLE `special_events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `organizing_department` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `special_events`
--

INSERT INTO `special_events` (`id`, `event_name`, `organizing_department`, `event_date`, `start_time`) VALUES
(1, 'Annual Convocation', 'Administration', '2024-10-01', '10:00:00'),
(2, 'Alumni Meet', 'Alumni Relations', '2024-10-05', '18:00:00'),
(3, 'Founder\'s Day', 'Management', '2024-10-10', '09:00:00'),
(4, 'Charity Gala', 'Social Work Department', '2024-10-15', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sunday`
--

CREATE TABLE `sunday` (
  `id` int(11) NOT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `class_room` varchar(50) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `class_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sunday`
--

INSERT INTO `sunday` (`id`, `teacher_name`, `subject`, `class_room`, `start_time`, `end_time`, `class_name`) VALUES
(1, 'Sam King', 'Drama', 'Room 701', '09:00:00', '10:30:00', 'Drama 101'),
(2, 'Sam King', 'Drama', 'Room 701', '10:45:00', '12:15:00', 'Drama 102'),
(3, 'Tina Scott', 'Health Education', 'Room 702', '13:00:00', '14:30:00', 'Health 101'),
(4, 'Tina Scott', 'Health Education', 'Room 702', '14:45:00', '16:15:00', 'Health 102'),
(5, 'Ursula Young', 'French', 'Room 703', '09:00:00', '10:30:00', 'French 101'),
(6, 'Ursula Young', 'French', 'Room 703', '10:45:00', '12:15:00', 'French 102');

-- --------------------------------------------------------

--
-- Table structure for table `thursday`
--

CREATE TABLE `thursday` (
  `id` int(11) NOT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `class_room` varchar(50) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `class_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thursday`
--

INSERT INTO `thursday` (`id`, `teacher_name`, `subject`, `class_room`, `start_time`, `end_time`, `class_name`) VALUES
(1, 'Jack Anderson', 'Economics', 'Room 401', '09:00:00', '10:30:00', 'Econ 101'),
(2, 'Jack Anderson', 'Economics', 'Room 401', '10:45:00', '12:15:00', 'Econ 102'),
(3, 'Kathy Thomas', 'Psychology', 'Room 402', '13:00:00', '14:30:00', 'Psychology 101'),
(4, 'Kathy Thomas', 'Psychology', 'Room 402', '14:45:00', '16:15:00', 'Psychology 102'),
(5, 'Larry White', 'Engineering', 'Room 403', '09:00:00', '10:30:00', 'Engineering 101'),
(6, 'Larry White', 'Engineering', 'Room 403', '10:45:00', '12:15:00', 'Engineering 102');

-- --------------------------------------------------------

--
-- Table structure for table `tuesday`
--

CREATE TABLE `tuesday` (
  `id` int(11) NOT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `class_room` varchar(50) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `class_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tuesday`
--

INSERT INTO `tuesday` (`id`, `teacher_name`, `subject`, `class_room`, `start_time`, `end_time`, `class_name`) VALUES
(1, 'David Brown', 'Chemistry', 'Room 201', '09:00:00', '10:30:00', 'Chemistry 101'),
(2, 'David Brown', 'Chemistry', 'Room 201', '10:45:00', '12:15:00', 'Chemistry 102'),
(3, 'Eve Davis', 'Literature', 'Room 202', '13:00:00', '14:30:00', 'Lit 101'),
(4, 'Eve Davis', 'Literature', 'Room 202', '14:45:00', '16:15:00', 'Lit 102'),
(5, 'Frank Miller', 'Physics', 'Room 203', '09:00:00', '10:30:00', 'Physics 101'),
(6, 'Frank Miller', 'Physics', 'Room 203', '10:45:00', '12:15:00', 'Physics 102');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'basit', '$2y$10$h3HtYRBq4LyIkXEZm5RxnuTuca0aErYKU8ekywbDaV7dBfqwceapm'),
(5, 'rishi2', '$2y$10$nKrPKKDGBKiggGKOjIMGJuGD5zdWxiMt4pYZXE8Js4ITeEzYtzXzK');

-- --------------------------------------------------------

--
-- Table structure for table `wednesday`
--

CREATE TABLE `wednesday` (
  `id` int(11) NOT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `class_room` varchar(50) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `class_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wednesday`
--

INSERT INTO `wednesday` (`id`, `teacher_name`, `subject`, `class_room`, `start_time`, `end_time`, `class_name`) VALUES
(1, 'Grace Wilson', 'Art', 'Room 301', '09:00:00', '10:30:00', 'Art 101'),
(2, 'Grace Wilson', 'Art', 'Room 301', '10:45:00', '12:15:00', 'Art 102'),
(3, 'Hank Moore', 'Geography', 'Room 302', '13:00:00', '14:30:00', 'Geography 101'),
(4, 'Hank Moore', 'Geography', 'Room 302', '14:45:00', '16:15:00', 'Geography 102'),
(5, 'Ivy Taylor', 'Computer Science', 'Room 303', '09:00:00', '10:30:00', 'CS 101'),
(6, 'Ivy Taylor', 'Computer Science', 'Room 303', '10:45:00', '12:15:00', 'CS 102');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_curricular`
--
ALTER TABLE `extra_curricular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friday`
--
ALTER TABLE `friday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monday`
--
ALTER TABLE `monday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saturday`
--
ALTER TABLE `saturday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_events`
--
ALTER TABLE `special_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sunday`
--
ALTER TABLE `sunday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thursday`
--
ALTER TABLE `thursday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tuesday`
--
ALTER TABLE `tuesday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wednesday`
--
ALTER TABLE `wednesday`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `extra_curricular`
--
ALTER TABLE `extra_curricular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `friday`
--
ALTER TABLE `friday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `monday`
--
ALTER TABLE `monday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `saturday`
--
ALTER TABLE `saturday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `special_events`
--
ALTER TABLE `special_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sunday`
--
ALTER TABLE `sunday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `thursday`
--
ALTER TABLE `thursday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tuesday`
--
ALTER TABLE `tuesday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wednesday`
--
ALTER TABLE `wednesday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
