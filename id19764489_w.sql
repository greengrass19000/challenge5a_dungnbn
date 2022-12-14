-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2022 at 06:01 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `w`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc`
--

CREATE TABLE `acc` (
  `id` int(5) UNSIGNED NOT NULL,
  `un` varchar(50) NOT NULL COMMENT 'username',
  `pw` varchar(50) NOT NULL COMMENT 'password',
  `name` varchar(25) NOT NULL COMMENT 'fullname',
  `role` int(1) NOT NULL COMMENT '1 : teacher\r\n0 : student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc`
--

INSERT INTO `acc` (`id`, `un`, `pw`, `name`, `role`) VALUES
(1, 'teacher1', '123456a@A', 'Giáo viên 1', 1),
(2, 'teacher2', '123456a@A', 'Giáo viên 2', 1),
(3, 'student1', '123456a@A', 'Học sinh 1', 0),
(4, 'student2', '123456a@A', 'Học sinh 2', 0),
(5, 'p', 'p', 'p', 1),
(38, 'l', 'l', 'l', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mess`
--

CREATE TABLE `mess` (
  `id` int(5) UNSIGNED NOT NULL,
  `content` text DEFAULT NULL,
  `sender` int(1) UNSIGNED NOT NULL COMMENT 'id người gửi',
  `receiver` int(1) UNSIGNED NOT NULL COMMENT 'id người nhận',
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'thời gian gửi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mess`
--

INSERT INTO `mess` (`id`, `content`, `sender`, `receiver`, `time`) VALUES
(37, 'dasd', 5, 3, '2022-10-20 02:54:09'),
(38, 'asdasd', 5, 1, '2022-10-23 15:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` int(1) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `file` varchar(40) NOT NULL,
  `hint` text DEFAULT NULL,
  `time` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `author`, `name`, `file`, `hint`, `time`) VALUES
(8, 5, '1 + 1 = 2', 'uploads/challenge/2.txt', 'HAI', 'Thursday 27th October 2022 09:42:20 AM'),
(9, 5, '1 + 2 + 3 + ... + 39 = ?', 'uploads/challenge/780.txt', 'bay tram tam muoi', 'Thursday 27th October 2022 10:07:43 AM');

-- --------------------------------------------------------

--
-- Table structure for table `sub`
--

CREATE TABLE `sub` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` int(5) UNSIGNED NOT NULL COMMENT 'id học sinh nộp bài',
  `assignmentid` int(5) UNSIGNED NOT NULL COMMENT 'id của task',
  `title` varchar(256) NOT NULL,
  `file` text NOT NULL,
  `time` varchar(100) NOT NULL DEFAULT current_timestamp() COMMENT 'thời gian nộp bài'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` int(1) UNSIGNED DEFAULT NULL,
  `name` varchar(40) NOT NULL COMMENT 'tên bài tập',
  `file` varchar(100) NOT NULL COMMENT 'link file bài tập',
  `deadline` datetime DEFAULT NULL COMMENT 'hạn nộp',
  `time` varchar(100) NOT NULL COMMENT 'ngày tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `author`, `name`, `file`, `deadline`, `time`) VALUES
(14, 5, 'task.pdf', 'uploads/teacher_assignment/task.pdf', NULL, 'Thursday 27th October 2022 07:25:49 AM'),
(15, 5, 'task2.pdf', 'uploads/teacher_assignment/task2.pdf', NULL, 'Thursday 27th October 2022 07:35:45 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc`
--
ALTER TABLE `acc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_unique` (`un`);

--
-- Indexes for table `mess`
--
ALTER TABLE `mess`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_fk_user_idsend` (`sender`),
  ADD KEY `messages_fk_user_idrec` (`receiver`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorid` (`author`);

--
-- Indexes for table `sub`
--
ALTER TABLE `sub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignmentid` (`assignmentid`),
  ADD KEY `submits_ibfk_1` (`author`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_teacher` (`author`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc`
--
ALTER TABLE `acc`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `mess`
--
ALTER TABLE `mess`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub`
--
ALTER TABLE `sub`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mess`
--
ALTER TABLE `mess`
  ADD CONSTRAINT `messages_fk_user_idrec` FOREIGN KEY (`receiver`) REFERENCES `acc` (`id`),
  ADD CONSTRAINT `messages_fk_user_idsend` FOREIGN KEY (`sender`) REFERENCES `acc` (`id`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`author`) REFERENCES `acc` (`id`);

--
-- Constraints for table `sub`
--
ALTER TABLE `sub`
  ADD CONSTRAINT `sub_ibfk_1` FOREIGN KEY (`author`) REFERENCES `acc` (`id`),
  ADD CONSTRAINT `sub_ibfk_2` FOREIGN KEY (`assignmentid`) REFERENCES `task` (`id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`author`) REFERENCES `acc` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
