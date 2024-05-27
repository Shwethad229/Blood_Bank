-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2023 at 02:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank2`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Test` (IN `bid` INT(10) UNSIGNED)   BEGIN
SELECT Blood1.Avl_units as a1 FROM Blood1
WHERE Blood1.Bb_id=bid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Unit_checking` (IN `B_Id` INT, IN `Blood_Type` VARCHAR(11), IN `Req_Packet` INT, IN `Pid` INT)   BEGIN


SELECT Blood1.Avl_units as a1 FROM Blood1
WHERE Blood1.Bb_id=B_Id AND Blood1.Blood_type=Blood_Type;

SELECT request.Required_Packets as r1
FROM request
WHERE request.Required_Packets=Req_Packet
AND request.P_id=Pid
AND request.Bb_id=B_Id;
 END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `Unit_check` () RETURNS INT(11)  BEGIN
IF EXISTS(select b1.Avl_units,r1.Required_Packets,b1.Blood_type
          FROM Blood1 b1,request r1, Patient p1
          WHERE b1.Bb_id=r1.Bb_id
          AND b1.Blood_type=p1.Blood_type
          AND b1.Avl_units>= r1.Required_Packets) THEN
        return 1;
ELSE
	return 2;
END IF;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blood1`
--

CREATE TABLE `blood1` (
  `Bb_id` int(4) NOT NULL,
  `Blood_type` varchar(7) NOT NULL,
  `Avl_units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood1`
--

INSERT INTO `blood1` (`Bb_id`, `Blood_type`, `Avl_units`) VALUES
(1, 'A+ve', 37),
(1, 'A-ve', 9),
(2, 'A+ve', 7),
(2, 'A-ve', 5);

-- --------------------------------------------------------

--
-- Table structure for table `blood_bank`
--

CREATE TABLE `blood_bank` (
  `Bb_id` int(4) NOT NULL,
  `Bb_name` varchar(20) DEFAULT NULL,
  `Address` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_bank`
--

INSERT INTO `blood_bank` (`Bb_id`, `Bb_name`, `Address`) VALUES
(1, 'Apollo', 'BML Layout'),
(2, 'FORTIS', 'Airport road');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `d_id` int(4) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `d_ph` bigint(10) DEFAULT NULL,
  `d_add` varchar(25) DEFAULT NULL,
  `hospital_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`d_id`, `name`, `d_ph`, `d_add`, `hospital_name`) VALUES
(1, 'Dr.Anish Pandey', 9983209823, 'Bengaluru', 'FORTIS'),
(2, 'Dr.Arun S', 1922189472, 'Bengaluru', 'APOLLO');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `Do_id` int(11) NOT NULL,
  `Name` varchar(20) DEFAULT NULL,
  `B_type` varchar(7) NOT NULL,
  `Gender` char(1) DEFAULT NULL,
  `Weight` int(2) DEFAULT NULL,
  `Address` varchar(20) DEFAULT NULL,
  `BP` varchar(10) DEFAULT NULL,
  `Phno` varchar(12) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Registered_date` date DEFAULT NULL,
  `d_id` int(4) NOT NULL,
  `Bb_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`Do_id`, `Name`, `B_type`, `Gender`, `Weight`, `Address`, `BP`, `Phno`, `DOB`, `Registered_date`, `d_id`, `Bb_id`) VALUES
(76, 'Sanjana', 'B-ve', 'F', 60, 'J P Nagar', '120/80', '784561287', '1998-02-15', '2023-01-20', 1, 2),
(77, 'Suguna', 'A+ve', 'F', 60, 'BS colony', '120/80', '9900176529', '1999-05-05', '2023-01-05', 1, 1),
(78, 'Ananya', 'A-ve', 'F', 60, 'Airport Road', '120/80', '8795478965', '1987-01-17', '2023-01-21', 1, 1),
(79, 'Veena', 'O+ve', 'F', 59, 'Yelahanka', '127/84', '8197987133', '1990-02-12', '2023-01-01', 1, 1),
(80, 'Rakshitha', 'AB+ve', 'F', 55, 'Electronic city', '150/90', '9875478974', '1993-06-24', '2023-01-04', 2, 2);

--
-- Triggers `donor`
--
DELIMITER $$
CREATE TRIGGER `Displaying` AFTER INSERT ON `donor` FOR EACH ROW BEGIN
  UPDATE Blood1
  SET Avl_units=Avl_units+1  
  WHERE  Blood1.Bb_id=NEW.Bb_id AND Blood1.Blood_type=New.B_type;
  end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `P_id` int(11) NOT NULL,
  `P_name` varchar(500) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `Hospital_address` varchar(5000) DEFAULT NULL,
  `Phno` varchar(10) NOT NULL,
  `P_address` varchar(500) DEFAULT NULL,
  `Blood_type` varchar(7) DEFAULT NULL,
  `Bb_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`P_id`, `P_name`, `Gender`, `Hospital_address`, `Phno`, `P_address`, `Blood_type`, `Bb_id`) VALUES
(129, 'Test', 'M', 'Banashankari', '7789457125', 'Jaynagar', 'A-ve', 2),
(130, 'Asss', 'M', 'Bangalore', '123-4567-8', 'BS colony', 'A+ve', 2),
(131, 'Test', 'F', 'Banashankari', '7845692136', 'Jaynagar', 'A+ve', 1),
(132, 'Suguna', 'F', 'Mangalore', '7845692136', 'Jaynagar', 'A+ve', 1),
(133, 'Suguna', 'F', 'Banashankari', '9902331071', 'BS colony', 'A+ve', 1),
(134, 'jack', 'M', 'Banashankari', '8179547894', 'BS colony', 'A+ve', 1),
(135, 'test', 'F', 'Banashankari', '7789457125', 'Jaynagar', 'A+ve', 1),
(136, 'Test', 'M', 'Banashankari', '9902331071', 'Jaynagar', 'A+ve', 1),
(137, 'Test', 'M', 'Banashankari', '7845692136', 'BS colony', 'A+ve', 1),
(138, 'arya', 'F', 'Banashankari', '7845692136', 'BS colony', 'A+ve', 2),
(139, 'arya', 'F', 'Banashankari', '7845692136', 'BS colony', 'A+ve', 2),
(140, 'Test', 'F', 'J P Nagar', '7845692136', 'Jaynagar', 'A+ve', 1),
(141, 'Test', 'F', 'Banashankari', '9880696529', 'Jaynagar', 'A-ve', 1),
(142, 'Test', 'F', 'Banashankari', '7845692136', 'BS colony', 'A-ve', 1),
(143, 'Suguna', 'F', 'Banashankari', '9880696529', 'Jaynagar', 'A-ve', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `P_id` int(11) NOT NULL,
  `Bb_id` int(4) NOT NULL,
  `Required_Packets` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`P_id`, `Bb_id`, `Required_Packets`) VALUES
(129, 2, 5),
(130, 2, 1),
(131, 1, 3),
(132, 1, 3),
(133, 1, 3),
(134, 1, 3),
(135, 1, 3),
(136, 1, 3),
(137, 1, 3),
(138, 2, 2),
(139, 2, 2),
(140, 1, 3),
(141, 1, 3),
(142, 1, 10),
(143, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood1`
--
ALTER TABLE `blood1`
  ADD PRIMARY KEY (`Bb_id`,`Blood_type`) USING BTREE,
  ADD KEY `blood1_ibfk_1` (`Bb_id`) USING BTREE;

--
-- Indexes for table `blood_bank`
--
ALTER TABLE `blood_bank`
  ADD PRIMARY KEY (`Bb_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`Do_id`),
  ADD KEY `donor_ibfk_1` (`d_id`) USING BTREE,
  ADD KEY `donor_ibfk_2` (`Bb_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`P_id`),
  ADD KEY `patient_ibfk_1` (`Bb_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`P_id`,`Bb_id`),
  ADD KEY `request_ibfk_2` (`Bb_id`) USING BTREE,
  ADD KEY `request_ibfk_1` (`P_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `Do_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood1`
--
ALTER TABLE `blood1`
  ADD CONSTRAINT `blood1_ibfk_1` FOREIGN KEY (`Bb_id`) REFERENCES `blood_bank` (`Bb_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donor`
--
ALTER TABLE `donor`
  ADD CONSTRAINT `donor_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `doctor` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donor_ibfk_2` FOREIGN KEY (`Bb_id`) REFERENCES `blood_bank` (`Bb_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`Bb_id`) REFERENCES `blood_bank` (`Bb_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`P_id`) REFERENCES `patient` (`P_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`Bb_id`) REFERENCES `blood_bank` (`Bb_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
