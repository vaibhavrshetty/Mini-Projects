-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2021 at 10:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `susn` varchar(10) NOT NULL,
  `ecid` varchar(10) NOT NULL,
  `etid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`susn`, `ecid`, `etid`) VALUES
('4nm18cs211', 'CS601', 'CS110'),
('4nm18cs211', 'CS602', ''),
('4nm18cs211', 'CS603', ''),
('4nm18cs211', 'CS604', ''),
('4nm18cs207', 'CS601', ''),
('4nm18cs207', 'CS602', ''),
('4nm18cs207', 'CS603', ''),
('4nm18cs207', 'CS604', '');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `rusn` varchar(10) NOT NULL,
  `rcid` varchar(10) NOT NULL,
  `mse1` float NOT NULL,
  `mse2` float NOT NULL,
  `see` float NOT NULL,
  `total` float NOT NULL,
  `grade` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`rusn`, `rcid`, `mse1`, `mse2`, `see`, `total`, `grade`) VALUES
('4nm18cs211', 'CS601', 25, 25, 50, 100, 'S'),
('4nm18cs211', 'CS602', 25, 25, 50, 100, 'S'),
('4nm18cs211', 'CS603', 25, 25, 50, 100, 'S'),
('4nm18cs211', 'CS604', 25, 19, 50, 94, 'S'),
('4nm18cs209', 'CS301', 20, 22, 47, 89, 'A'),
('4nm18cs207', 'CS601', 20, 19.5, 40, 79.5, 'B'),
('4nm18cs207', 'CS602', 20, 19, 50, 89, 'A'),
('4nm18cs207', 'CS603', 21, 25, 50, 96, 'S'),
('4nm18cs207', 'CS604', 23, 24, 50, 97, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `sgpa`
--

CREATE TABLE `sgpa` (
  `usn` varchar(10) NOT NULL,
  `sgpa1` float NOT NULL,
  `sgpa2` float NOT NULL,
  `sgpa3` float NOT NULL,
  `sgpa4` float NOT NULL,
  `sgpa5` float NOT NULL,
  `sgpa6` float NOT NULL,
  `sgpa7` float NOT NULL,
  `sgpa8` float NOT NULL,
  `cgpa` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sgpa`
--

INSERT INTO `sgpa` (`usn`, `sgpa1`, `sgpa2`, `sgpa3`, `sgpa4`, `sgpa5`, `sgpa6`, `sgpa7`, `sgpa8`, `cgpa`) VALUES
('4nm18cs209', 9.5, 0, 0, 0, 0, 0, 0, 0, 0),
('4nm18cs207', 9.12, 9, 9, 9, 9, 9.25, 0, 0, 9.06167),
('4nm18cs211', 9.5, 9.2, 9, 9.6, 9.3, 10, 0, 0, 9.43333);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `usn` varchar(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `sem` int(11) NOT NULL,
  `branch` varchar(40) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`usn`, `name`, `sem`, `branch`, `password`) VALUES
('4nm18cs207', 'vaibhav', 6, 'Computer Science Engineering(CSE)', 'kaat'),
('4nm18cs209', 'vinayak', 3, 'Computer Science Engineering(CSE)', 'abc'),
('4nm18cs211', 'vinroy', 6, 'Computer Science Engineering(CSE)', 'vnory');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `cid` varchar(10) NOT NULL,
  `cname` varchar(40) NOT NULL,
  `sem` int(11) NOT NULL,
  `branch` varchar(40) NOT NULL,
  `elective` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`cid`, `cname`, `sem`, `branch`, `elective`) VALUES
('CS301', 'Programming with C++', 3, 'Computer Science Engineering(CSE)', 0),
('CS601', 'Machine Learning', 6, 'Computer Science Engineering(CSE)', 0),
('CS602', 'Computer Networks', 6, 'Computer Science Engineering(CSE)', 0),
('CS603', 'Computer Graphics', 6, 'Computer Science Engineering(CSE)', 0),
('CS604', 'FLAT', 6, 'Computer Science Engineering(CSE)', 0),
('CSE81', 'Big data analytics', 6, 'Computer Science Engineering(CSE)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `tid` varchar(5) NOT NULL,
  `tname` varchar(40) NOT NULL,
  `branch` varchar(40) NOT NULL,
  `tpass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`tid`, `tname`, `branch`, `tpass`) VALUES
('1919', 'admin', '', 'adlo420'),
('CS100', 'Sannidhan MS', 'Computer Science Engineering(CSE)', 'sanni100'),
('CS110', 'Keerthana B', 'Computer Science Engineering(CSE)', 'kbc'),
('CS420', 'Pradeep Kanchan', 'Computer Science Engineering(CSE)', 'ilovercb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD KEY `usn_fkey` (`susn`),
  ADD KEY `cid_fkey` (`ecid`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD KEY `usn_fkey2` (`rusn`),
  ADD KEY `cid_fkey2` (`rcid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`usn`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cname` (`cname`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`tid`),
  ADD UNIQUE KEY `tname` (`tname`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `cid_fkey` FOREIGN KEY (`ecid`) REFERENCES `subject` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usn_fkey` FOREIGN KEY (`susn`) REFERENCES `student` (`usn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `cid_fkey2` FOREIGN KEY (`rcid`) REFERENCES `subject` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usn_fkey2` FOREIGN KEY (`rusn`) REFERENCES `student` (`usn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
