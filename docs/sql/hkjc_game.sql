-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-26 10:41:51
-- 伺服器版本： 10.4.18-MariaDB
-- PHP 版本： 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `hkjc_game`
--

CREATE TABLE `hkjc_game` (
  `id` int(11) NOT NULL,
  `uid` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_group` varchar(15) DEFAULT NULL,
  `phone` varchar(9) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `game1` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`game1`)),
  `game2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`game2`)),
  `prize1` tinyint(1) NOT NULL DEFAULT 0,
  `prize1_redeem_at` datetime DEFAULT NULL,
  `prize2` tinyint(1) NOT NULL DEFAULT 0,
  `prize2_redeem_at` datetime DEFAULT NULL,
  `prizeg` tinyint(1) NOT NULL DEFAULT 0,
  `prizeg_redeem_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `hkjc_game`
--
ALTER TABLE `hkjc_game`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `hkjc_game`
--
ALTER TABLE `hkjc_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
