-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 11, 2020 at 03:56 PM
-- Server version: 10.4.12-MariaDB-1:10.4.12+maria~bionic
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bcbb`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `name`, `description`) VALUES
(1, 'General', 'General description '),
(2, 'Development', 'Development description'),
(3, 'Smalltalk', 'Smalltalk description'),
(4, 'Events', 'Events description');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `edition_date` datetime NOT NULL,
  `id_topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `content`, `id_user`, `creation_date`, `edition_date`, `id_topic`) VALUES
(2, 'Message 1 of topic 1', 12, '2020-03-03 12:33:49', '2020-03-31 12:33:49', 1),
(3, 'Message 2 of topic 3', 10, '2020-03-31 11:36:13', '2020-03-31 11:36:13', 3),
(4, 'Message 3 of topic 4', 12, '2020-03-31 11:36:13', '2020-03-30 11:36:13', 4),
(5, 'Message 4 of topic 5 ', 10, '2020-03-31 11:37:13', '2020-03-31 11:43:28', 5),
(6, 'Message 5 of topic 2', 13, '2020-03-31 11:37:13', '2020-03-31 11:37:13', 2);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_board` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `creation_date`, `content`, `id_user`, `id_board`) VALUES
(1, 'Topic 1 of board 1', '2020-03-03 12:25:42', 'Topic 1 content', NULL, 1),
(2, 'Topic 2 of board 1', '2020-03-04 12:27:10', 'Topic 2 content', NULL, 1),
(3, 'Topic 3 of board 2', '2020-03-03 12:22:56', '', 13, 2),
(4, 'Topic 4 of board 1', '2020-03-31 11:25:36', '', 10, 1),
(5, 'Topic 5 of board 1', '2020-03-31 11:25:36', '', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nickname`, `avatar`, `signature`) VALUES
(10, 'aaa@hotmail.com', '$2y$10$ajqPzB1zQDULD.lVlk9OgOc3QmAeo7mE.2BZm9LMysd63.5lDZKXW', 'a', NULL, NULL),
(12, 'bbb@hotmail.com', '$2y$10$aAjXfA1GzGj3x5X6xAwEJeHfOSv8zelINblJvZgJmOtKL/tBMba1G', 'bbb', NULL, 'Blabla'),
(13, 'ccc@hotmail.com', '$2y$10$Glq4WTJ1pzzBB..7ugqgX.MaGZLfNDNNhJFc6rWk63cQMZ2UJ9xqm', 'yyy', 'c502efa574bc54ba7e26b296d0504aba', 'yyy   ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_topic` (`id_topic`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_board` (`id_board`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`id_topic`) REFERENCES `topics` (`id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`id_board`) REFERENCES `boards` (`id`),
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
