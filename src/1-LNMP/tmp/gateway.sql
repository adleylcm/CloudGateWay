-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 10 月 23 日 17:54
-- 服务器版本: 5.5.28
-- PHP 版本: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `gateway`
--

-- --------------------------------------------------------

--
-- 表的结构 `analyse`
--

CREATE TABLE IF NOT EXISTS `analyse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cloudUsed` int(11) NOT NULL,
  `cloudTotal` int(11) NOT NULL,
  `localUsed` int(11) NOT NULL,
  `localTotal` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `analyse`
--

INSERT INTO `analyse` (`id`, `cloudUsed`, `cloudTotal`, `localUsed`, `localTotal`) VALUES
(1, 276, 1024, 339, 1024);

-- --------------------------------------------------------

--
-- 表的结构 `fileinfo`
--

CREATE TABLE IF NOT EXISTS `fileinfo` (
  `fid` bigint(20) NOT NULL AUTO_INCREMENT,
  `fname` varchar(500) NOT NULL,
  `fpath` varchar(500) NOT NULL,
  `fpid` bigint(20) NOT NULL,
  `fstatus` char(1) NOT NULL,
  `ftype` char(1) NOT NULL,
  `curl` varchar(500) DEFAULT NULL,
  `fdev` bigint(20) DEFAULT NULL,
  `fino` bigint(20) DEFAULT NULL,
  `fmode` bigint(20) NOT NULL,
  `fnlinks` bigint(20) DEFAULT NULL,
  `fuid` bigint(20) NOT NULL,
  `fgid` bigint(20) NOT NULL,
  `frdev` bigint(20) DEFAULT NULL,
  `fsize` bigint(20) NOT NULL,
  `dsize` bigint(20) DEFAULT NULL,
  `faddr` varchar(60) DEFAULT NULL,
  `fgen` bigint(20) DEFAULT NULL,
  `atime` bigint(20) NOT NULL,
  `mtime` bigint(20) NOT NULL,
  `ctime` bigint(20) NOT NULL,
  `dblks` bigint(20) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `fileinfo`
--

INSERT INTO `fileinfo` (`fid`, `fname`, `fpath`, `fpid`, `fstatus`, `ftype`, `curl`, `fdev`, `fino`, `fmode`, `fnlinks`, `fuid`, `fgid`, `frdev`, `fsize`, `dsize`, `faddr`, `fgen`, `atime`, `mtime`, `ctime`, `dblks`) VALUES
(1, 'nfsdir', '/home/gateway/nfsdir', 0, 'l', 'd', 'NULL', 64512, 1050404, 16893, 3, 1000, 1000, 0, 4096, 4096, 'NULL', 0, 1381197089, 1380275458, 1380275458, 8),
(2, 'test3', '/home/gateway/nfsdir/test3', 1, 'l', 'd', 'NULL', 64512, 1058953, 16893, 2, 1000, 1000, 0, 4096, 4096, 'NULL', 0, 1381197089, 1380178873, 1380274102, 8),
(3, 'c', '/home/gateway/nfsdir/c', 1, 'l', 'r', 'NULL', 64512, 1050312, 33204, 1, 1000, 1000, 0, 0, 4096, 'NULL', 0, 1380274644, 1380274644, 1380274644, 0),
(4, 'b', '/home/gateway/nfsdir/b', 1, 'l', 'r', 'NULL', 64512, 1050310, 33204, 1, 1000, 1000, 0, 0, 4096, 'NULL', 0, 1380267189, 1380267189, 1380267189, 0);

-- --------------------------------------------------------

--
-- 表的结构 `frequency`
--

CREATE TABLE IF NOT EXISTS `frequency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `uploadCNT` int(11) NOT NULL,
  `uploadSize` int(11) NOT NULL,
  `downloadCNT` int(11) NOT NULL,
  `downloadSize` int(11) NOT NULL,
  `totalCNT` int(11) NOT NULL,
  `totalSize` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `frequency`
--

INSERT INTO `frequency` (`id`, `date`, `uploadCNT`, `uploadSize`, `downloadCNT`, `downloadSize`, `totalCNT`, `totalSize`) VALUES
(1, '2013-10-23', 7, 110, 8, 100, 15, 210),
(2, '2013-10-22', 9, 70, 7, 230, 16, 300),
(3, '2013-10-21', 5, 50, 9, 200, 14, 250),
(4, '2013-10-20', 4, 300, 3, 70, 7, 370),
(5, '2013-10-19', 10, 210, 6, 80, 16, 290);

-- --------------------------------------------------------

--
-- 表的结构 `mapping`
--

CREATE TABLE IF NOT EXISTS `mapping` (
  `fid` bigint(20) NOT NULL,
  `fpath` varchar(500) NOT NULL,
  `fpid` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mapping`
--

INSERT INTO `mapping` (`fid`, `fpath`, `fpid`) VALUES
(0, '/home/gateway', 0),
(1, '/home/gateway/nfsdir', 0),
(2, '/home/gateway/nfsdir/test3', 1);

-- --------------------------------------------------------

--
-- 表的结构 `policy`
--

CREATE TABLE IF NOT EXISTS `policy` (
  `id` int(11) NOT NULL,
  `flag` int(11) NOT NULL,
  `fileSizeth` int(11) NOT NULL DEFAULT '1024',
  `fileType` varchar(1024) NOT NULL DEFAULT 'conf|emil|tmp',
  `expires` bigint(20) NOT NULL DEFAULT '30',
  `freq` int(11) NOT NULL DEFAULT '4',
  `ipaddr` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL DEFAULT 'swift',
  `passwd` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `policy`
--

INSERT INTO `policy` (`id`, `flag`, `fileSizeth`, `fileType`, `expires`, `freq`, `ipaddr`, `user`, `passwd`) VALUES
(0, 1111, 1024, 'conf|emil|tmp', 20, 4, '192.168.3.9:5000/v2.0', 'swift', '111111');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
