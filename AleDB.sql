-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2014 at 02:57 PM
-- Server version: 5.5.35-0ubuntu0.13.10.2
-- PHP Version: 5.5.3-1ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `AleDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Courses`
--

CREATE TABLE IF NOT EXISTS `Courses` (
  `CourseID` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'This is the primary key for the courses table.',
  `Department` varchar(5) NOT NULL COMMENT 'This the department that is teaching the course. For example, the business department would be BUS',
  `CourseNum` smallint(5) unsigned NOT NULL COMMENT 'This is the course number for the course. For example the database systems course that Mario Nakazawa teaches would be 330.',
  PRIMARY KEY (`CourseID`),
  UNIQUE KEY `Department` (`Department`,`CourseNum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Courses`
--

INSERT INTO `Courses` (`CourseID`, `Department`, `CourseNum`) VALUES
(1, 'CSC', 330);

-- --------------------------------------------------------

--
-- Table structure for table `Groups`
--

CREATE TABLE IF NOT EXISTS `Groups` (
  `GroupID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'This is the identifier for groups. Groups represent students who are working together with a community partner',
  `StudentManager` bigint(20) unsigned DEFAULT NULL COMMENT 'This is the student who communicates with the community partner. There will be specific ratings for this student later on down the road.',
  `CommunityPartner` bigint(20) unsigned NOT NULL COMMENT 'This is the community partner that the students are working with.',
  `Course` bigint(20) unsigned DEFAULT NULL COMMENT 'This is the course that all of the students in the group are taking.',
  `Term` varchar(7) NOT NULL COMMENT 'This represents the term that the course was. The longest that a term name can possibly be is 7 letters (Summer1 and Summer2)',
  `Year` year(4) NOT NULL COMMENT 'This is the year that the course offering occurred.',
  PRIMARY KEY (`GroupID`),
  KEY `StudentManager` (`StudentManager`,`CommunityPartner`,`Course`),
  KEY `CommunityPartner` (`CommunityPartner`),
  KEY `Course` (`Course`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `People`
--

CREATE TABLE IF NOT EXISTS `People` (
  `PersonID` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'This is the primary key for the people table.',
  `LoginHash` varchar(32) NOT NULL COMMENT 'This is not the actual password that the user will be using. It is a hash of what that user used. This isn''t the best solution, a better solution would involve a salt using the time of creation of the password, however, I really have no idea how to do this. Length 32 based on the output of the MD5 function. ',
  `UserName` varchar(20) NOT NULL COMMENT 'This is the login name of the user. Determined by the professor (likely to be Berea login, with exception of community partners). 20 was selected because it felt like a good length for a user name.',
  `Role` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT 'This represents the role that the person has in the system. 0 represents professor. 1 represents community partner. 2 represesnts student.',
  `FName` varchar(18) NOT NULL,
  `LName` varchar(18) NOT NULL,
  PRIMARY KEY (`PersonID`),
  UNIQUE KEY `userName` (`UserName`),
  KEY `Role` (`Role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='People represents people who are using the database.' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `People`
--

INSERT INTO `People` (`PersonID`, `LoginHash`, `UserName`, `Role`, `FName`, `LName`) VALUES
(1, 'de2f15d014d40b93578d255e6221fd60', 'nakazawam', 0, 'Mario', 'Nakazawa'),
(2, '30035607ee5bb378c71ab434a6d05410', 'workmanj', 1, 'Jerry', 'Workman');

-- --------------------------------------------------------

--
-- Table structure for table `Professes`
--

CREATE TABLE IF NOT EXISTS `Professes` (
  `ProfessesID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Course` bigint(20) unsigned NOT NULL,
  `Professor` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`ProfessesID`),
  KEY `Course` (`Course`,`Professor`),
  KEY `Professor` (`Professor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Ratings`
--

CREATE TABLE IF NOT EXISTS `Ratings` (
  `RatingID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'This is the identifier for ratings.',
  `GroupID` bigint(20) unsigned NOT NULL COMMENT 'This captures the information about what groups students were in.',
  `Student` bigint(20) unsigned NOT NULL COMMENT 'This captures the information for what groups students were in.',
  `Rating` tinyint(4) NOT NULL DEFAULT '-1' COMMENT 'Negative one represents a rating that has not been given yet.',
  `Comments` varchar(560) NOT NULL COMMENT 'This is a space for community partners to give their explainations for why they gave the rating that they gave.',
  `ReleaseDate` date NOT NULL COMMENT 'This is the date on which the rating will be released to the community partner.',
  PRIMARY KEY (`RatingID`),
  KEY `GroupID` (`GroupID`,`Student`),
  KEY `Student` (`Student`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Groups`
--
ALTER TABLE `Groups`
  ADD CONSTRAINT `Groups_ibfk_1` FOREIGN KEY (`StudentManager`) REFERENCES `People` (`PersonID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Groups_ibfk_2` FOREIGN KEY (`CommunityPartner`) REFERENCES `People` (`PersonID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Groups_ibfk_3` FOREIGN KEY (`Course`) REFERENCES `Courses` (`CourseID`) ON UPDATE CASCADE;

--
-- Constraints for table `Professes`
--
ALTER TABLE `Professes`
  ADD CONSTRAINT `Professes_ibfk_1` FOREIGN KEY (`Course`) REFERENCES `Courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Professes_ibfk_2` FOREIGN KEY (`Professor`) REFERENCES `People` (`PersonID`) ON UPDATE CASCADE;

--
-- Constraints for table `Ratings`
--
ALTER TABLE `Ratings`
  ADD CONSTRAINT `Ratings_ibfk_1` FOREIGN KEY (`GroupID`) REFERENCES `Groups` (`GroupID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ratings_ibfk_2` FOREIGN KEY (`Student`) REFERENCES `People` (`PersonID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
