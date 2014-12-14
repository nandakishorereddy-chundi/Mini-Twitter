-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2014 at 05:47 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ambitionbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `username` varchar(50) NOT NULL,
  `friend` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`username`, `friend`) VALUES
('t1', 't2'),
('t2', 't1'),
('t4', 't3'),
('t3', 't4'),
('t3', 't1'),
('t1', 't3'),
('t1', 't4'),
('t4', 't1'),
('test', 't1'),
('t1', 'test'),
('final', 'test'),
('test', 'final');

-- --------------------------------------------------------

--
-- Table structure for table `request_pending`
--

CREATE TABLE IF NOT EXISTS `request_pending` (
  `username` varchar(50) NOT NULL,
  `friend` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE IF NOT EXISTS `tweets` (
  `username` varchar(50) NOT NULL,
  `tweet` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`username`, `tweet`) VALUES
('t2', 'test for t2'),
('t3', 'test for t3'),
('t4', 'test for t4'),
('t3', 'new update for t3'),
('test', 'new update from test'),
('t1', 'old update from t1'),
('t1', 'new update from t1'),
('final', 'post from final test'),
('final', 'again testing for final tweet'),
('final', '3rd testing for final tweet');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`) VALUES
('final', 'final@gmail.com', '202cb962ac59075b964b07152d234b70'),
('t1', 't1@gmail.com', '202cb962ac59075b964b07152d234b70'),
('t2', 't2@gmail.com', '202cb962ac59075b964b07152d234b70'),
('t3', 't3@gmail.com', '202cb962ac59075b964b07152d234b70'),
('t4', 't4@gmail.com', '202cb962ac59075b964b07152d234b70'),
('test', 'test@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD UNIQUE KEY `username` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
