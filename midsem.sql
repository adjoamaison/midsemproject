-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2015 at 05:46 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `midsem`
--

-- --------------------------------------------------------

--
-- Table structure for table `mwproduct`
--

CREATE TABLE IF NOT EXISTS `mwproduct` (
  `pid` int(20) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mwproduct`
--

INSERT INTO `mwproduct` (`pid`, `pname`, `price`, `qty`, `image`) VALUES
(0, '', 27.5, 23, ''),
(1, 'first product', 20, 20, ''),
(1234, 'fanta', 1.2, 8, ''),
(4321, 'box', 11, 34, '');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
`sid` int(11) NOT NULL,
  `transid` varchar(10) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`sid`, `transid`, `pname`, `price`, `qty`) VALUES
(1, '1', 'coke', 27.5, 0),
(2, '0', 'undefined', 0, 3),
(3, '0', 'undefined', 0, 2),
(4, '0', '', 0, 5),
(5, '0', 'first product', 20, 0),
(6, '0STPF', 'first product', 20, 0),
(7, '0STPF', 'first product', 20, 0),
(8, 'TD.HT', 'first product', 20, 0),
(9, 'JU7O3', 'first product', 20, 0),
(10, 'W6.5C', 'first product', 20, 13),
(11, '0EX6V', 'first product', 20, 6),
(12, 'WRE5D', 'first product', 20, 1),
(13, 'NMSGO', 'first product', 20, 7),
(14, 'RC181', 'first product', 20, 3),
(26, '8HSBB', '', 0, 0),
(27, 'RG.58', '', 0, 0),
(28, '0EX6V', '', 0, 0),
(29, 'CBBQD', '', 0, 12),
(30, 'AHABA', '', 0, 12),
(31, '4O3C4', '', 0, 0),
(32, 'EV6WK', '', 0, 567),
(33, 'EV6WK', '', 0, 567),
(34, 'EV6WK', '', 0, 5678),
(35, 'G_4E3', '', 0, 23),
(36, 'G_4E3', '', 0, 22),
(37, 'RYAUF', '', 0, 2),
(38, '1NLFN', '', 0, 1),
(39, '1NLFN', '', 0, 12),
(40, '1NLFN', '', 0, 34),
(41, '1NLFN', '', 0, 345),
(42, '8IYEQ', '', 0, 12),
(43, '8IYEQ', '', 0, 124),
(44, 'G9KL8', '', 0, 22),
(45, 'G9KL8', '', 0, 226),
(46, 'swe3', 'fanta', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transid` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `pnumber` varchar(15) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transid`, `date`, `time`, `pnumber`, `total`) VALUES
('0', '2015-10-28', '14:25:16', '233241271434', 550),
('1', '0000-00-00', '00:00:27', '22', 0),
('10', '2015-10-28', '10:41:01', '', 0),
('11', '2015-10-28', '10:42:10', '', 79),
('12', '2015-10-28', '10:43:51', '', 0),
('12s', '0000-00-00', '00:00:00', '2334234232', 0),
('13', '2015-10-28', '10:48:29', '', 0),
('14', '2015-10-28', '10:50:07', '', 0),
('15', '2015-10-28', '10:50:07', '', 8),
('16', '2015-10-28', '10:50:07', '', 0),
('17', '2015-10-28', '10:52:27', '', 0),
('172s', '0000-00-00', '00:00:00', '2334234232', 0),
('2', '0000-00-00', '00:00:27', '22', 0),
('2015', '0000-00-00', '00:00:00', '', 0),
('3', '0000-00-00', '00:00:23', '2147483647', 20),
('4', '2015-10-28', '10:31:20', '233260884406', 30),
('5', '2015-10-28', '10:33:27', '233260884406', 0),
('6', '2015-10-28', '10:35:00', '233260884406', 0),
('7', '2015-10-28', '10:36:44', '233260884406', 0),
('8', '2015-10-28', '10:37:01', '233260884406', 0),
('9', '2015-10-28', '10:39:44', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` int(11) NOT NULL,
  `pswd` varchar(50) NOT NULL DEFAULT '',
  `userType` enum('owner','teller') NOT NULL,
  `permission` set('add','delete','view','update') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mwproduct`
--
ALTER TABLE `mwproduct`
 ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
 ADD PRIMARY KEY (`sid`), ADD KEY `transid` (`transid`), ADD KEY `transid_2` (`transid`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
 ADD PRIMARY KEY (`transid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
