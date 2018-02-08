-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-10-31 16:43:42
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raspi`
--

-- --------------------------------------------------------

--
-- 表的结构 `device`
--

CREATE TABLE `device` (
  `device_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `device_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `device`
--

INSERT INTO `device` (`device_id`, `user_id`, `device_name`) VALUES
(1, 1, '客厅'),
(2, 1, 'test');

-- --------------------------------------------------------

--
-- 表的结构 `state`
--

CREATE TABLE `state` (
  `id` bigint(20) NOT NULL,
  `device_id` bigint(20) NOT NULL,
  `port` int(11) NOT NULL,
  `io` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `port_name` text NOT NULL,
  `time_ctrl` int(11) NOT NULL,
  `time_loop` int(11) NOT NULL,
  `open_time` int(11) DEFAULT NULL,
  `close_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `state`
--

INSERT INTO `state` (`id`, `device_id`, `port`, `io`, `state`, `port_name`, `time_ctrl`, `time_loop`, `open_time`, `close_time`) VALUES
(1, 1, 1, 0, 0, '开关1', 1, 1, 1848, 1849),
(2, 1, 2, 0, 0, '开关2', 0, 0, NULL, NULL),
(3, 1, 3, 0, 0, '开关3', 0, 0, NULL, NULL),
(4, 1, 4, 0, 0, '开关4', 0, 0, NULL, NULL),
(5, 1, 5, 0, 0, '开关5', 0, 0, NULL, NULL),
(6, 1, 6, 0, 0, '开关6', 0, 0, NULL, NULL),
(7, 1, 7, 0, 0, '开关7', 0, 0, NULL, NULL),
(8, 1, 8, 0, 0, '开关8', 0, 0, NULL, NULL),
(9, 1, 9, 0, 0, '开关9', 0, 0, NULL, NULL),
(10, 1, 10, 0, 0, '开关10', 0, 0, NULL, NULL),
(11, 1, 11, 0, 0, '开关11', 0, 0, NULL, NULL),
(12, 1, 12, 0, 0, '开关12', 0, 0, NULL, NULL),
(13, 1, 13, 0, 0, '开关13', 0, 0, NULL, NULL),
(14, 1, 14, 0, 0, '开关14', 0, 0, NULL, NULL),
(15, 1, 15, 0, 0, '开关15', 0, 0, NULL, NULL),
(16, 1, 16, 0, 0, '开关16', 0, 0, NULL, NULL),
(17, 2, 1, 0, 0, '开关1', 0, 0, NULL, NULL),
(18, 2, 2, 0, 0, '开关2', 0, 0, NULL, NULL),
(19, 2, 3, 0, 0, '开关3', 0, 0, NULL, NULL),
(20, 2, 4, 0, 0, '开关4', 0, 0, NULL, NULL),
(21, 2, 5, 0, 0, '开关5', 0, 0, NULL, NULL),
(22, 2, 6, 0, 0, '开关6', 0, 0, NULL, NULL),
(23, 2, 7, 0, 0, '开关7', 0, 0, NULL, NULL),
(24, 2, 8, 0, 0, '开关8', 0, 0, NULL, NULL),
(25, 2, 9, 0, 1, '开关9', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `vname` text NOT NULL,
  `pw` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  `mail` text NOT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `vname`, `pw`, `phone`, `mail`, `data`) VALUES
(1, '廉晟', '123456', 17625002404, '1456457523@qq.com', NULL),
(2, 'kirito', '123456', 13914157983, '1456457524@qq.com', NULL),
(3, 'admin', 'kirito', 12345678910, 'k@g', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `phone_2` (`phone`),
  ADD KEY `phone_3` (`phone`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `device`
--
ALTER TABLE `device`
  MODIFY `device_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `state`
--
ALTER TABLE `state`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
