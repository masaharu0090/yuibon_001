-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-08-04 12:47:53
-- サーバのバージョン： 10.4.25-MariaDB
-- PHP のバージョン: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `imageposting`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `image_id` int(11) NOT NULL COMMENT '画像ID',
  `comment` varchar(255) NOT NULL COMMENT 'コメント',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `comments`
--

INSERT INTO `comments` (`id`, `image_id`, `comment`, `create_date`) VALUES
(1, 24, 'AAAAA', '2023-08-04 01:25:55');

-- --------------------------------------------------------

--
-- テーブルの構造 `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL COMMENT '画像ID',
  `file_name` varchar(255) NOT NULL COMMENT '画像名',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日',
  `comments` varchar(255) NOT NULL COMMENT 'コメント',
  `title` varchar(255) NOT NULL COMMENT 'タイトル'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `images`
--

INSERT INTO `images` (`id`, `file_name`, `create_date`, `comments`, `title`) VALUES
(24, '1501039.jpg', '2023-08-01 08:41:04', '', ''),
(25, 'living1.jpg', '2023-08-04 01:25:27', '', '');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '画像ID', AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
