-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2020 at 07:32 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `user_id` int(10) NOT NULL,
  `follower_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`user_id`, `follower_id`) VALUES
(4, 2),
(6, 4),
(1, 5),
(4, 3),
(1, 2),
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `G-ID` int(5) NOT NULL,
  `group_name` varchar(15) NOT NULL,
  `description` varchar(30) NOT NULL,
  `createdby` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`G-ID`, `group_name`, `description`, `createdby`) VALUES
(1, 'even', 'even numbers', 'eneners'),
(2, 'odd', 'odd numbers', 'odd Ones');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `g_id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `role` varchar(1) NOT NULL DEFAULT 'm'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`g_id`, `member_id`, `role`) VALUES
(1, 2, 'm'),
(1, 4, 'm'),
(2, 1, 'm'),
(2, 3, 'm'),
(2, 5, 'm');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `body` varchar(120) NOT NULL,
  `create_on` date NOT NULL,
  `group_id` int(10) DEFAULT NULL,
  `privacy` int(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `body`, `create_on`, `group_id`, `privacy`) VALUES
(1, 1, 'body: post by one', '2020-03-09', NULL, 2),
(2, 2, 'body: post by two', '2020-03-09', NULL, 2),
(3, 4, 'body: post of four', '2020-03-10', NULL, 2),
(4, 3, 'body: post of three', '2020-03-10', NULL, 2),
(5, 5, 'body: post by Fiveeeee', '2020-03-09', 2, 2),
(6, 6, 'body: post by six : friend of 1,2: six', '2020-03-09', 1, 2),
(7, 1, 'body: post by one only friends', '2020-03-24', NULL, 1),
(8, 3, 'this is second post by Three', '0000-00-00', NULL, 2),
(9, 4, 'this is second post by ThFourree', '2020-03-09', NULL, 2),
(10, 4, 'this is third post by ThFourree', '2020-03-09', NULL, 2),
(11, 4, 'this is forth post by ThFourree', '2020-03-09', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(20) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `dob`) VALUES
(1, 'one', '11', 'one one', '2019-06-12'),
(2, 'two', '11', 'two two', '2019-06-12'),
(3, 'three', '33', 'three three', '2020-03-11'),
(4, 'four', '44', 'four four', '2020-03-10'),
(5, 'five', '55', 'five five', '2020-03-10'),
(6, 'six', '66', 'six six', '2020-03-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`G-ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `G-ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
