-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2021 at 08:00 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ketabkhana`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `id` int(5) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `conPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`firstName`, `lastName`, `gender`, `dob`, `email`, `id`, `userName`, `password`, `conPassword`) VALUES
('adm1', 'aaa', 'male', '2021-03-28', 'a1@gmail.com', 1, 'admin1', '1111', '1111'),
('adm2', 'aaa', 'female', '2021-04-06', 'a2@gmail.com', 2, 'admin2', '2222', '2222'),
('adm3', 'aaa33', 'male', '2021-04-06', 'a3@gmail.com', 3, 'admin3', '3333', '3333'),
('admin8', 'admin', 'male', '2021-04-05', 'admin8@gmail.com', 21, 'admin8', '8888', '8888'),
('adm4', 'aaa', 'male', '2021-04-06', 'a4@gmail.com', 22, 'admin4', '4444', '4444'),
('a5', 'aa', 'female', '2021-03-30', 'a5@gmail.com', 23, 'admin5', '5555', '5555');

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `id` int(5) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `salary` float NOT NULL,
  `bonus` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approval`
--

INSERT INTO `approval` (`id`, `userName`, `salary`, `bonus`) VALUES
(1, 'user3', 60000, 6000),
(2, 'emp1', 23000, 1200),
(3, 'emp2', 75000, 4000),
(4, 'emp3', 75000, 200),
(5, 'emp4', 25000, 200),
(7, 'emp5', 250000, 999),
(8, 'emp16', 50000, 500),
(9, 'emp20', 90000, 800),
(10, 'emp19', 70000, 800),
(11, 'emp23', 70000, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `bookdata`
--

CREATE TABLE `bookdata` (
  `thumbnail` varchar(50) NOT NULL,
  `id` int(5) NOT NULL,
  `booktitle` varchar(50) NOT NULL,
  `bookauthor` varchar(50) NOT NULL,
  `bookpublisher` varchar(50) NOT NULL,
  `bookedition` varchar(50) NOT NULL,
  `bookprice` varchar(20) NOT NULL,
  `sUname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookdata`
--

INSERT INTO `bookdata` (`thumbnail`, `id`, `booktitle`, `bookauthor`, `bookpublisher`, `bookedition`, `bookprice`, `sUname`) VALUES
('1.jpg', 1, 'Book1', 'Mufrad', 'Shatin', '3rd', '850', 'shop1'),
('2.jpg', 2, 'Book2', 'Shatin', 'Momojo', '1st', '385', 'shop2'),
('3.jpeg', 4, 'Memory', 'ratin', 'Shatin', '4th', '850', 'shop1');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Bid` int(5) NOT NULL,
  `userUName` varchar(50) NOT NULL,
  `shopUName` varchar(50) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Bid`, `userUName`, `shopUName`, `price`) VALUES
(2, 'user2', 'shop2', '385'),
(1, 'user2', 'shop1', '850'),
(4, 'user2', 'shop1', '850'),
(1, 'user1', 'shop1', '850');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `id` int(5) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `conPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`firstName`, `lastName`, `gender`, `dob`, `email`, `id`, `userName`, `password`, `conPassword`) VALUES
('emp1', 'eee', 'male', '2021-04-06', 'emp1@gmail.com', 1, 'emp1', '1111', '1111'),
('emp2', 'eee', 'female', '2021-04-06', 'e2@gmail.com', 2, 'emp2', '2222', '2222'),
('emp3', 'emp', 'female', '2021-04-05', 'emp3@gmail.com', 3, 'emp3', '3333', '3333'),
('e4', 'ee44', 'female', '2021-04-05', 'emp4@gmail.com', 4, 'emp4', '4444', '4444');

-- --------------------------------------------------------

--
-- Table structure for table `refund`
--

CREATE TABLE `refund` (
  `id` int(5) NOT NULL,
  `userUName` varchar(15) NOT NULL,
  `shopUName` varchar(15) NOT NULL,
  `bookId` varchar(15) NOT NULL,
  `bankInfo` varchar(80) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `refund`
--

INSERT INTO `refund` (`id`, `userUName`, `shopUName`, `bookId`, `bankInfo`, `amount`) VALUES
(4, 'user2', 'shop2', '1', 'ab bank, ac no 42222', 450),
(5, 'user2', 'shop2', '2', 'ab bank, ac no 4345', 450),
(6, 'user1', 'shop1', '1', 'bkash 012345', 450);

-- --------------------------------------------------------

--
-- Table structure for table `refundapproved`
--

CREATE TABLE `refundapproved` (
  `userUName` varchar(15) NOT NULL,
  `shopUName` varchar(15) NOT NULL,
  `bookId` varchar(15) NOT NULL,
  `bankInfo` varchar(80) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `refundapproved`
--

INSERT INTO `refundapproved` (`userUName`, `shopUName`, `bookId`, `bankInfo`, `amount`) VALUES
('user1', 'shop2', '3', 'ab bank, ac no 420', 500),
('user2', 'shop2', '1', 'bkash 01234567890', 500),
('user2', 'shop1', '8', 'bkash 01234567890', 270),
('user2', 'shop2', '5', 'Dutch bangla Bank ac no 111111', 345);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `userName` varchar(50) NOT NULL,
  `salary` float NOT NULL,
  `bonus` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`userName`, `salary`, `bonus`) VALUES
('emp1', 25000, 2500),
('emp2', 40000, 4000),
('emp8', 50000, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `shopdata`
--

CREATE TABLE `shopdata` (
  `shopName` varchar(50) NOT NULL,
  `shopAddress` varchar(50) NOT NULL,
  `id` int(5) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `confirmpass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopdata`
--

INSERT INTO `shopdata` (`shopName`, `shopAddress`, `id`, `userName`, `email`, `password`, `confirmpass`) VALUES
('s1', 'Nikunja', 1, 'shop1', 'shop1@Ggmail.com', '1111', '1111'),
('s2', 'Mohammadpur', 2, 'shop2', 's2@Ggmail.com', '2222', '2222');

-- --------------------------------------------------------

--
-- Table structure for table `statement`
--

CREATE TABLE `statement` (
  `date` date NOT NULL,
  `expenditure` varchar(50) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statement`
--

INSERT INTO `statement` (`date`, `expenditure`, `amount`) VALUES
('2021-04-06', 'Buying office chairs', 46000),
('2021-03-21', 'Repairning office door', 2200),
('2021-04-18', 'Buying new books', -12000),
('2021-04-18', 'Selling Books', 20000),
('2021-04-19', 'Salary of Emp2', -3500),
('2021-04-19', 'Salary of Akkas', 340000);

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `name` varchar(50) NOT NULL,
  `number` int(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`name`, `number`, `email`, `subject`) VALUES
('Ratin', 1757314931, 'ratin@gmail.com', 'Hi! I need some information.'),
('Arosh', 1521408973, 'arosh@gmail.com', 'Hi vaia! Basay aso taratari.'),
('Mufrad', 1591196404, 'nobobi.shatin@gmail.com', '	kire\r\n		'),
('Tanveer', 1591196404, '18-38712-3@student.aiub.edu', '	dostooo		'),
('asfasf', 1591196404, 'hjkh@gmail.com', '		bhlilbhasfijsai				');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `productId` int(5) NOT NULL,
  `shopUName` varchar(50) NOT NULL,
  `userUName` varchar(50) NOT NULL,
  `amount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`productId`, `shopUName`, `userUName`, `amount`) VALUES
(1, 'shop1', 'user1', '350'),
(2, 'shop2', 'user3', '850'),
(3, 'shop3', 'user3', '650'),
(4, 'shop4', 'user2', '500'),
(5, 'shop4', 'user2', '280'),
(1, 'shop2', 'user1', '500'),
(4, 'shop5', 'user2', '990'),
(6, 'shop2', 'user33', '500');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `id` int(5) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `conPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstName`, `lastName`, `gender`, `dob`, `email`, `id`, `userName`, `password`, `conPassword`) VALUES
('u1', 'uuu', 'female', '2009-02-09', 'user1@gmail.com', 1, 'user1', '1111', '1111'),
('u2', 'uu', 'female', '2001-10-10', 'u2@gmail.com', 2, 'user2', '2222', '2222'),
('asf', 'asf', 'male', '2021-04-08', 'shatin.hasan73@gmail.com', 3, 'saf', 'saf', 'asfasf'),
('u3', 'uu', 'male', '2021-04-12', 'u3@gmail.com', 5, 'user3', '33333', '33333'),
('u4', 'uu', 'male', '2021-04-12', 'u4@gmail.com', 6, 'user4', '4444', '4444');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`,`userName`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookdata`
--
ALTER TABLE `bookdata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`,`userName`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `refund`
--
ALTER TABLE `refund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopdata`
--
ALTER TABLE `shopdata`
  ADD PRIMARY KEY (`id`,`userName`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`userName`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bookdata`
--
ALTER TABLE `bookdata`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `refund`
--
ALTER TABLE `refund`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shopdata`
--
ALTER TABLE `shopdata`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
