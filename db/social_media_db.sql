-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2023 at 12:36 PM
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
(10, '2', 'Hi how are you', 'Smiley-816x1024.jpg', 'Tuesday 10th of January 2023 11:15:15 AM', 'image');

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
(6, 1, 3, '', 1, 'Thursday 12th of January 2023 11:56:13 AM');

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
  `views` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `profile_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_registration`
--

INSERT INTO `tb_registration` (`id`, `name`, `email`, `password`, `phone`, `address`, `views`, `gender`, `profile_image`) VALUES
(1, 'Bholu', 'bholu@mail.com', '25d55ad283aa400af464c76d713c07ad', '8967120155', 'India', '', 'Male', 'avatar1.png'),
(2, 'mina', 'mina@gmail.com', '25d55ad283aa400af464c76d713c07ad', '8967120155', 'India', '', 'Female', 'demo.png'),
(3, 'Sona', 'sona@gmail.com', '25d55ad283aa400af464c76d713c07ad', '8967120155', 'India', '', 'Female', 'avatar5.png'),
(4, 'Babu', 'babu@gmail.com', '25d55ad283aa400af464c76d713c07ad', '8967120155', 'Australia', '', 'Male', 'avatar4.png'),
(5, 'Ram', 'ram@mail.com', '25d55ad283aa400af464c76d713c07ad', '7889098909', 'London', '', 'Male', 'avatar1.png'),
(6, 'Subhas', 'subhas@mail.com', '25d55ad283aa400af464c76d713c07ad', '8967120144', 'America', '', 'Male', 'demo.png');

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
(14, 4, 1, 'accepted', 'Thursday 12th of January 2023 11:46:40 AM');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_reactions`
--
ALTER TABLE `tb_reactions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_registration`
--
ALTER TABLE `tb_registration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_request`
--
ALTER TABLE `tb_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
