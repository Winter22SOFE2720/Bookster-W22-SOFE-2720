-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 14, 2022 at 08:25 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookster`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Year` int(4) NOT NULL,
  `Description` text NOT NULL,
  `Publisher` varchar(50) NOT NULL,
  `HardPrice` decimal(4,2) NOT NULL,
  `HardQuantity` int(4) NOT NULL,
  `DiscountRate` double NOT NULL,
  `AverageRating` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL,
  `Format` varchar(15) NOT NULL,
  `Languages` varchar(100) NOT NULL,
  `img_URL` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ID`, `Name`, `Author`, `Year`, `Description`, `Publisher`, `HardPrice`, `HardQuantity`, `DiscountRate`, `AverageRating`, `ISBN`, `Format`, `Languages`, `img_URL`) VALUES
(1, 'How to Bake a Cake', 'Nana Mimi', 2014, 'After the success of How to Cook a Chicken, Nana Mimi is back with her expert tips on how to make the best dishes for you and your family. It doesn\'t get better than Nana Mimi!', 'Good Books Ltd.', '23.54', 10, 0.1, 3, 199535566, 'Hard Copy', 'English\r\nSpanish', 'https://images-na.ssl-images-amazon.com/images/I/91qF-MgSJ9L.jpg'),
(2, 'Cleaning Up After Kids', 'Sarah J.', 2011, 'Cleaning Up After Kids is a New York Times bestseller. Sarah J. gives tips on how to raise healthy, clean kids.', 'Karna Ltd.', '30.99', 4, 0.2, 4, 1604501480, 'Hard', 'English\r\nPortuguese\r\nTurkish', 'https://happinessishereblog.com/wp-content/uploads/2017/09/parentingbooks01.jpg'),
(3, 'Harry Potter', 'J.K Rowling', 1996, 'The famous book! The best book! Read it here! The boy who lived!', 'Random House Inc.', '13.55', 6, 0, 5, 11, 'Hard', 'English\r\nSpanish', 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1470082995l/29056083._SY475_.jpg'),
(4, 'Grannie\'s Diary', 'Granny May', 1852, 'Her very very old diary... Read at your own risk.', 'Books Inc.', '98.32', 8, 0, 3, 0, 'Digital', 'Spanish\r\nEnglish', 'https://images-na.ssl-images-amazon.com/images/I/71e6GOdrTeL.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
