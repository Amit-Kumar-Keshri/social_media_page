-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2023 at 09:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_media_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_chat`
--

CREATE TABLE `tb_chat` (
  `id` int(10) NOT NULL,
  `user_1` int(10) NOT NULL,
  `user_2` int(10) NOT NULL,
  `message` text NOT NULL,
  `date_added` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_post`
--

CREATE TABLE `tb_post` (
  `id` int(10) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `post_text` text NOT NULL,
  `media_path` varchar(255) NOT NULL,
  `date_added` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_post`
--

INSERT INTO `tb_post` (`id`, `user_id`, `post_text`, `media_path`, `date_added`, `file_type`) VALUES
(1, '1', '', 'MV5BZDk1ZmU0NGYtMzQ2Yi00N2NjLTkyNWEtZWE2NTU4NTJiZGUzXkEyXkFqcGdeQXVyMTExNDQ2MTI@._V1_.jpg', 'Thursday 5th of January 2023 12:28:32 PM', 'image'),
(2, '1', '', 'SampleVideo_640x360_1mb.mp4', 'Thursday 5th of January 2023 12:28:44 PM', 'video'),
(3, '1', '', 'video.mp4', 'Thursday 5th of January 2023 12:39:57 PM', 'video'),
(4, '1', '', 'avatar2.png', 'Monday 9th of January 2023 12:05:29 PM', 'image'),
(5, '3', '', 'avatar2.png', 'Tuesday 10th of January 2023 06:47:55 AM', 'image'),
(6, '3', '', 'avatar6.png', 'Tuesday 10th of January 2023 06:48:56 AM', 'image'),
(7, '3', '', 'avatar7.png', 'Tuesday 10th of January 2023 06:50:10 AM', 'image'),
(8, '1', 'Hello How are you', '2133155.webp', 'Tuesday 10th of January 2023 11:04:05 AM', 'image'),
(9, '1', 'Hello How are you', 'whatsapp dp image6-601.jpg', 'Tuesday 10th of January 2023 11:04:36 AM', 'image'),
(10, '2', 'Hi how are you', 'Smiley-816x1024.jpg', 'Tuesday 10th of January 2023 11:15:15 AM', 'image'),
(11, '19', 'Dummy Post', 'images.jpg', 'Monday 16th of January 2023 10:35:24 AM', 'image'),
(12, '19', 'Hello Test Post', 'images.jpg', 'Monday 16th of January 2023 10:43:23 AM', 'image'),
(13, '19', '', 'images.jpg', 'Monday 16th of January 2023 10:46:34 AM', 'image'),
(14, '20', 'Test', 'hater_fr_mass_murder_3993c69b-f8a7-4ad1-97ff-414d7af5182e.png', 'Monday 16th of January 2023 10:46:56 AM', 'image'),
(15, '21', 'test video', 'video.mp4', 'Monday 16th of January 2023 10:47:16 AM', 'video'),
(16, '21', 'hi', 'avatar1.png', 'Tuesday 17th of January 2023 07:58:43 AM', 'image'),
(17, '21', 'hiiii', 'avatar2.png', 'Tuesday 17th of January 2023 08:01:16 AM', 'image');

-- --------------------------------------------------------

--
-- Table structure for table `tb_reactions`
--

CREATE TABLE `tb_reactions` (
  `id` int(10) NOT NULL,
  `added_by` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `added_comment` varchar(255) NOT NULL,
  `liked` int(10) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_reactions`
--

INSERT INTO `tb_reactions` (`id`, `added_by`, `post_id`, `added_comment`, `liked`, `date_added`) VALUES
(1, 1, 1, '', 1, 'Wednesday 11th of January 2023 03:22:33 PM'),
(2, 1, 2, '', 1, 'Wednesday 11th of January 2023 03:22:36 PM'),
(3, 2, 1, '', 1, 'Thursday 12th of January 2023 11:55:14 AM'),
(4, 2, 2, '', 1, 'Thursday 12th of January 2023 11:55:45 AM'),
(5, 2, 3, '', 1, 'Thursday 12th of January 2023 11:55:51 AM'),
(6, 1, 3, '', 1, 'Thursday 12th of January 2023 11:56:13 AM'),
(7, 19, 1, '', 1, 'Thursday 12th of January 2023 01:13:00 PM'),
(8, 19, 3, '', 1, 'Thursday 12th of January 2023 01:15:25 PM'),
(9, 21, 1, '', 1, 'Thursday 12th of January 2023 01:15:43 PM'),
(10, 20, 1, '', 1, 'Thursday 12th of January 2023 01:15:57 PM'),
(11, 1, 2, '', 0, 'sdgdrsf'),
(12, 19, 3, 'Test Comment', 0, 'Thursday 12th of January 2023 01:26:08 PM'),
(13, 19, 2, 'Hi test 1', 0, 'Thursday 12th of January 2023 01:31:39 PM'),
(14, 19, 2, 'Hi test 2', 0, 'Thursday 12th of January 2023 01:31:47 PM'),
(15, 19, 1, 'Test', 0, 'Thursday 12th of January 2023 01:45:04 PM'),
(16, 19, 1, 'Test comment 2', 0, 'Thursday 12th of January 2023 01:53:39 PM'),
(17, 19, 1, 'Test comment 3', 0, 'Thursday 12th of January 2023 01:53:49 PM'),
(18, 19, 2, '', 1, 'Thursday 12th of January 2023 01:54:56 PM'),
(19, 19, 4, '', 1, 'Thursday 12th of January 2023 01:58:40 PM'),
(20, 20, 10, '', 1, 'Thursday 12th of January 2023 02:01:39 PM'),
(21, 21, 10, '', 1, 'Thursday 12th of January 2023 02:01:45 PM'),
(22, 20, 7, '', 1, 'Thursday 12th of January 2023 02:01:50 PM'),
(23, 21, 7, '', 1, 'Thursday 12th of January 2023 02:01:52 PM'),
(24, 20, 6, '', 1, 'Thursday 12th of January 2023 02:01:53 PM'),
(25, 22, 6, '', 1, 'Thursday 12th of January 2023 02:01:55 PM'),
(26, 22, 7, '', 1, 'Thursday 12th of January 2023 02:02:06 PM'),
(27, 19, 6, '', 1, 'Thursday 12th of January 2023 02:04:20 PM'),
(28, 19, 10, '', 1, 'Thursday 12th of January 2023 02:06:48 PM'),
(29, 22, 8, '', 1, 'Thursday 12th of January 2023 02:07:18 PM'),
(30, 22, 9, '', 1, 'Thursday 12th of January 2023 02:07:46 PM'),
(31, 21, 9, '', 1, 'Thursday 12th of January 2023 02:07:56 PM'),
(32, 19, 8, '', 1, 'Thursday 12th of January 2023 02:08:05 PM'),
(33, 19, 9, '', 1, 'Thursday 12th of January 2023 02:08:56 PM'),
(34, 19, 5, 'Test Comment 2', 0, 'Thursday 12th of January 2023 02:09:18 PM'),
(35, 20, 4, 'Not at all', 0, 'Thursday 12th of January 2023 02:09:41 PM'),
(36, 20, 3, 'yes', 0, 'Thursday 12th of January 2023 02:09:47 PM'),
(37, 21, 1, 'hello', 0, 'Friday 13th of January 2023 05:19:29 AM'),
(38, 21, 1, 'hello', 0, 'Friday 13th of January 2023 05:19:30 AM'),
(39, 19, 7, '', 1, 'Monday 16th of January 2023 02:34:57 PM'),
(40, 19, 5, '', 1, 'Monday 16th of January 2023 02:35:27 PM'),
(41, 1, 1, 'hi', 0, 'Wednesday 18th of January 2023 06:50:03 AM'),
(42, 1, 4, '', 1, 'Wednesday 18th of January 2023 06:52:17 AM'),
(43, 1, 5, '', 1, 'Wednesday 18th of January 2023 06:52:29 AM'),
(44, 1, 6, '', 1, 'Wednesday 18th of January 2023 06:53:53 AM'),
(45, 1, 7, '', 1, 'Wednesday 18th of January 2023 06:53:57 AM'),
(46, 1, 8, '', 1, 'Wednesday 18th of January 2023 06:53:59 AM'),
(47, 1, 9, '', 1, 'Wednesday 18th of January 2023 06:54:02 AM'),
(48, 1, 17, '', 1, 'Wednesday 18th of January 2023 06:54:07 AM');

-- --------------------------------------------------------

--
-- Table structure for table `tb_registration`
--

CREATE TABLE `tb_registration` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `profile_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_registration`
--

INSERT INTO `tb_registration` (`id`, `name`, `email`, `password`, `phone`, `address`, `gender`, `profile_image`) VALUES
(1, 'Bholu Singh', 'bholu@mail.com', '25d55ad283aa400af464c76d713c07ad', '8967120155', 'India', 'Male', 'avatar1.png'),
(2, 'mina', 'mina@gmail.com', '25d55ad283aa400af464c76d713c07ad', '8967120155', 'India', 'Female', 'demo.png'),
(3, 'Sona', 'sona@gmail.com', '25d55ad283aa400af464c76d713c07ad', '8967120155', 'India', 'Female', 'avatar5.png'),
(4, 'Babu', 'babu@gmail.com', '25d55ad283aa400af464c76d713c07ad', '8967120155', 'Australia', 'Male', 'avatar4.png'),
(5, 'Ram', 'ram@mail.com', '25d55ad283aa400af464c76d713c07ad', '7889098909', 'London', 'Male', 'avatar1.png'),
(6, 'Subhas', 'subhas@mail.com', '25d55ad283aa400af464c76d713c07ad', '8967120144', 'America', 'Male', 'demo.png'),
(19, 'Sayantan Das', 'sayantan.das@ewaycorp.com', '25d55ad283aa400af464c76d713c07ad', '7788998877', 'USA', 'Male', 'avatar5.png'),
(20, 'Amit Keshri', 'amit.keshri@ewaycorp.com', '25d55ad283aa400af464c76d713c07ad', '8666679873', 'India', 'Male', 'hater_fr_mass_murder_3993c69b-f8a7-4ad1-97ff-414d7af5182e.png'),
(21, 'Subham Banerjee', 'subham.banerjee@ewaycorp.com', '25d55ad283aa400af464c76d713c07ad', '8967120155', 'India', 'Male', 'brad.jpg'),
(22, 'Nilakshi roy', 'nilakshi.roy@ewaycorp.com', '25f9e794323b453885f5181f1b624d0b', '9382840170', 'sdfbsabaj', 'Female', 'demo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_request`
--

CREATE TABLE `tb_request` (
  `id` int(10) NOT NULL,
  `added_by` int(10) NOT NULL,
  `requested_to` int(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_of_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_request`
--

INSERT INTO `tb_request` (`id`, `added_by`, `requested_to`, `status`, `date_of_added`) VALUES
(1, 1, 2, 'accepted', 'Friday 6th of January 2023 10:56:45 AM'),
(2, 1, 3, 'accepted', 'Friday 6th of January 2023 10:56:47 AM'),
(3, 1, 4, 'accepted', 'Friday 6th of January 2023 10:56:48 AM'),
(4, 2, 1, 'accepted', 'Friday 6th of January 2023 02:05:34 PM'),
(5, 2, 3, 'requested', 'Friday 6th of January 2023 02:05:36 PM'),
(6, 2, 4, 'requested', 'Friday 6th of January 2023 02:05:37 PM'),
(7, 2, 5, 'requested', 'Friday 6th of January 2023 02:05:41 PM'),
(8, 2, 6, 'requested', 'Friday 6th of January 2023 02:05:42 PM'),
(9, 3, 1, 'accepted', 'Friday 6th of January 2023 02:06:46 PM'),
(10, 3, 6, 'requested', 'Friday 6th of January 2023 02:06:48 PM'),
(11, 3, 5, 'requested', 'Friday 6th of January 2023 02:06:49 PM'),
(12, 3, 2, 'accepted', 'Friday 6th of January 2023 02:06:50 PM'),
(13, 3, 4, 'requested', 'Friday 6th of January 2023 02:06:51 PM'),
(14, 4, 1, 'accepted', 'Thursday 12th of January 2023 11:46:40 AM'),
(15, 20, 1, 'accepted', 'Thursday 12th of January 2023 02:01:18 PM'),
(16, 21, 19, 'accepted', 'Friday 13th of January 2023 06:10:07 AM'),
(17, 20, 19, 'accepted', 'Monday 16th of January 2023 10:05:52 AM'),
(18, 19, 22, 'accepted', 'Monday 16th of January 2023 10:15:06 AM'),
(19, 22, 20, 'requested', 'Monday 16th of January 2023 10:45:42 AM'),
(20, 22, 21, 'requested', 'Monday 16th of January 2023 10:45:42 AM'),
(21, 21, 20, 'accepted', 'Monday 16th of January 2023 11:48:59 AM'),
(22, 21, 22, 'accepted', 'Monday 16th of January 2023 11:49:00 AM'),
(23, 1, 5, 'requested', 'Wednesday 18th of January 2023 08:23:51 AM'),
(24, 1, 6, 'requested', 'Wednesday 18th of January 2023 08:49:12 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_chat`
--
ALTER TABLE `tb_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_post`
--
ALTER TABLE `tb_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_reactions`
--
ALTER TABLE `tb_reactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_registration`
--
ALTER TABLE `tb_registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_request`
--
ALTER TABLE `tb_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_chat`
--
ALTER TABLE `tb_chat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_reactions`
--
ALTER TABLE `tb_reactions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tb_registration`
--
ALTER TABLE `tb_registration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_request`
--
ALTER TABLE `tb_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
