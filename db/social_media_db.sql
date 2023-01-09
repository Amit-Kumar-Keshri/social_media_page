-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 07:22 AM
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
  `media_path` varchar(255) NOT NULL,
  `date_added` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_post`
--

INSERT INTO `tb_post` (`id`, `user_id`, `media_path`, `date_added`, `file_type`) VALUES
(1, '1', 'MV5BZDk1ZmU0NGYtMzQ2Yi00N2NjLTkyNWEtZWE2NTU4NTJiZGUzXkEyXkFqcGdeQXVyMTExNDQ2MTI@._V1_.jpg', 'Thursday 5th of January 2023 12:28:32 PM', 'image'),
(2, '1', 'SampleVideo_640x360_1mb.mp4', 'Thursday 5th of January 2023 12:28:44 PM', 'video'),
(3, '1', 'video.mp4', 'Thursday 5th of January 2023 12:39:57 PM', 'video');

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
(2, 1, 3, 'requested', 'Friday 6th of January 2023 10:56:47 AM'),
(3, 1, 4, 'requested', 'Friday 6th of January 2023 10:56:48 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_post`
--
ALTER TABLE `tb_post`
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_registration`
--
ALTER TABLE `tb_registration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_request`
--
ALTER TABLE `tb_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
