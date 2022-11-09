-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 11:10 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `futsal`
--
CREATE DATABASE IF NOT EXISTS `futsal` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `futsal`;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `actId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `actDatetime` date NOT NULL,
  `description` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`actId`, `title`, `actDatetime`, `description`) VALUES
(1, 'จิตอาสาทำความสะอาดสนาม', '2022-06-19', '(ทุน 100)จัดเตรียมอุปกรณ์มาเอง'),
(2, 'จิตอาสารักษ์ม.', '2022-07-04', '(ทุน 50)ตัดกิ่งไม้ที่มหาวิทยาลัย '),
(3, 'จิตอาสาจัดโต๊ะหมู่', '2022-06-30', '(ทุน 100 & 50)จัดเตรียมอุปกรณ์ มาเช็ดถู'),
(4, 'สัมมนากีฬาฟุตซอล', '2022-06-23', 'นักกีฬาทุกคน ทั้งตัวจริงและสำรอง'),
(5, 'ล้างโรงอาหาร', '2022-07-13', 'จัดเตรียมอุปกรณ์มาเอง');

-- --------------------------------------------------------

--
-- Table structure for table `act_register`
--

CREATE TABLE `act_register` (
  `registerId` int(11) NOT NULL,
  `actId` int(11) NOT NULL,
  `stId` int(11) NOT NULL,
  `registerDate` date NOT NULL DEFAULT current_timestamp(),
  `result` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `act_register`
--

INSERT INTO `act_register` (`registerId`, `actId`, `stId`, `registerDate`, `result`) VALUES
(1, 4, 5, '2022-05-17', 'ยกเลิก'),
(2, 2, 5, '2022-05-17', 'ไม่ผ่าน'),
(3, 1, 3, '2022-05-17', 'ผ่าน'),
(4, 2, 3, '2022-05-17', 'ผ่าน'),
(5, 2, 2, '2022-05-17', 'รอแก้ไข'),
(6, 3, 2, '2022-05-17', 'ยกเลิก'),
(7, 1, 2, '2022-05-17', 'ไม่ผ่าน'),
(8, 4, 4, '2022-05-17', 'รอแก้ไข'),
(9, 4, 6, '2022-05-17', 'ลงทะเบียนเรียบร้อยแล้ว'),
(10, 3, 6, '2022-05-17', 'ลงทะเบียนเรียบร้อยแล้ว'),
(11, 1, 7, '2022-05-17', 'ลงทะเบียนเรียบร้อยแล้ว'),
(12, 5, 3, '2022-06-08', 'ผ่าน'),
(13, 2, 3, '2022-06-08', 'ลงทะเบียนเรียบร้อยแล้ว'),
(14, 4, 3, '2022-06-14', 'ลงทะเบียนเรียบร้อยแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `all_awards`
--

CREATE TABLE `all_awards` (
  `awardId` int(11) NOT NULL,
  `awardName` varchar(255) NOT NULL,
  `league` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `awardDate` date NOT NULL,
  `coach` varchar(255) DEFAULT NULL,
  `player` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `all_awards`
--

INSERT INTO `all_awards` (`awardId`, `awardName`, `league`, `rank`, `awardDate`, `coach`, `player`, `img`) VALUES
(1, 'แชมเปี้ยนส์ลีก', 'ลีกระดับประเทศ', 'อันดับที่ 1', '2021-06-08', 'เจนณรงค์ มากกำเนิด', 'ดิษฐพงษ์ สุขทรัทย์', '2041191258.jpg'),
(2, 'ถ้วยรางวัล ฤดูกาล', 'สโมสร', 'รองอันดับที่ 2', '2021-11-25', 'สุภกิจ แช่มโชติ', 'รัชพล พันชารี', '1725681415.jpg'),
(3, 'ถ้วยรางวัล ต้านยาเสพติด', 'จังหวัด', 'รอบก่อนรองชนะเลิส', '2021-06-08', 'กริช ไชยโย', 'สมชาย ใจดี', '1526473111.jpg'),
(4, 'แชมเปี้ยนส์สโมสร', 'ลีกระดับประเทศ', 'รองอันดับที่ 3', '2022-05-10', 'เจนณรงค์ มากกำเนิด', 'วีระยุทธ พันชารี', '933311989.jpg'),
(5, 'The Best Player', 'สโมสร', 'อันดับที่ 1', '2021-12-07', 'กริช ไชยโย', 'สมพงษ์ รักดี', '345220201.jpg'),
(6, 'แชมเปี้ยนส์ภูมิภาค', 'ลีกภูมิภาค', 'รอบก่อนรองชนะเลิส', '2022-06-07', 'สุภกิจ แช่มโชติ', 'ดนุพล คงดีงาม', '339500564.jpg'),
(7, 'ถ้วยรางวัล ฤดูกาล', 'จังหวัด', 'รองอันดับที่ 2', '2021-09-07', 'กริช ไชยโย', 'กรวิทย์ งามจิต', '2042129792.jpg'),
(8, 'แชมเปี้ยนส์สโมสร', 'สโมสร', '1', '2022-06-24', 'FWfe', 'รัชพล พันชารี', '1158010778.jpeg'),
(9, 'แชมเปี้ยนส์สโมสร', 'สโมสร', 'รองอันดับที่ 3', '2022-06-14', 'สุภกิจ แช่มโชติ', 'วีระยุทธ พันชารี', '40076996.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `facultyId` int(11) NOT NULL,
  `facultyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`facultyId`, `facultyName`) VALUES
(1, 'คณะวิทยาศาสตร์และเทคโนโลยีu'),
(2, 'คณะวิศวกรรมศาสตร์'),
(3, 'คณะบริหารธุรกิจ'),
(4, 'คณะบัญชี'),
(5, 'บันฑิตวิทยาลัย');

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `majorId` int(11) NOT NULL,
  `majorName` varchar(255) NOT NULL,
  `facultyId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`majorId`, `majorName`, `facultyId`) VALUES
(1, 'สาขาเทคโนโลยีสารสนเทศ', 1),
(2, 'สาขาวิชาวิทยาการข้อมูลและเทคโนโลยีสารสนเทศ', 1),
(3, 'สาขาวิชาเทคโนโลยีดิจิทัลมีเดีย', 1),
(4, 'สาขาวิชาวิศวกรรมไฟฟ้า', 2),
(5, 'สาขาวิชาวิศวกรรมเครื่องกล', 2),
(6, 'สาขาวิชาวิศวกรรมอุตสาหการ', 2),
(7, 'สาขาเทคโนโลยีการจัดการอุตสาหกรรม', 2),
(8, 'สาขาวิชาการบัญชี', 4),
(9, 'หลักสูตรบัญชีมหาบัณฑิต', 4),
(10, 'หลักสูตรศึกษาศาสตร์มหาบัญฑิต', 5),
(11, 'หลักสูตรประกาศณียบัตรบัณฑิต(วิชาชีพครู)', 5),
(12, 'สาขาการจัดการ', 3),
(13, 'สาขาคอมพิวเตอร์ธุรกิจ', 3),
(14, 'สาขาการตลาด', 3),
(15, 'สาขาการจัดการโลจิสติกส์และธุรกิจพาณิชย์นาวี', 3),
(16, 'สาขาการจัดการธุรกิจระหว่างประเทศ', 3),
(17, 'การจัดการธุรกิจท่องเที่ยว', 3),
(18, 'หลักสูตรบริหารธุรกิจมหาบัณฑิต', 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `roleType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleId`, `roleType`) VALUES
(1, 'ตัวจริง'),
(2, 'ตัวสำรอง'),
(3, 'พักรักษา/เจ็บ');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `title`, `start`, `end`) VALUES
(10, 'ซ้อมแข่งรอบรองชนะเลิศ', '2022-05-18 06:30:00', '2022-05-19 00:00:00'),
(11, 'ซ้อมใหญ่ก่อนแข่งจริง', '2022-05-22 09:00:00', '2022-05-26 13:00:00'),
(19, 'ซ้อมตัวสำรอง', '2022-05-29 06:00:00', '2022-06-01 19:00:00'),
(22, 'แข่งรอบชิงชนะเลิศ', '2022-06-17 07:00:00', '2022-06-17 19:00:00'),
(23, 'แข่ง', '2022-06-22 05:00:00', '2022-06-23 00:30:00'),
(24, 'ำดำไดฎ\"โ', '2022-06-30 00:00:00', '2022-07-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_details`
--

CREATE TABLE `schedule_details` (
  `id` int(11) NOT NULL,
  `planId` int(11) NOT NULL,
  `stId` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule_details`
--

INSERT INTO `schedule_details` (`id`, `planId`, `stId`, `status`) VALUES
(1, 3, 3, 'ลงชื่อซ้อม/แข่ง'),
(2, 2, 3, 'ลงชื่อซ้อม/แข่ง'),
(3, 2, 5, 'ลงชื่อซ้อม/แข่ง'),
(4, 1, 7, 'ตรวจเช็คเรียบร้อย'),
(5, 3, 7, 'ลงชื่อซ้อม/แข่ง'),
(6, 2, 6, 'ลงชื่อซ้อม/แข่ง'),
(7, 1, 4, 'ตรวจเช็คเรียบร้อย'),
(8, 3, 4, 'ตรวจเช็คเรียบร้อย'),
(9, 2, 2, 'ตรวจเช็คเรียบร้อย');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_plan`
--

CREATE TABLE `schedule_plan` (
  `planId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `planDate` date NOT NULL,
  `planTime` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule_plan`
--

INSERT INTO `schedule_plan` (`planId`, `title`, `planDate`, `planTime`, `location`, `details`) VALUES
(1, 'ซ้อมแข่งรอบชิง', '2022-06-29', '10:28:00', 'สนามสโมสร', 'ซ้อมแข่งใหญ่เฉพาะตัวจริง'),
(2, 'ซ้อมตัวสำรอง', '2022-06-16', '11:00:00', 'สนามม.ธนบุรี', 'ซ้อมตัวสำรอง '),
(3, 'แข่งจริง', '2022-06-30', '09:31:00', 'สนามสโมสร', 'แข่ง');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship`
--

CREATE TABLE `scholarship` (
  `scholarshipId` int(11) NOT NULL,
  `schType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`scholarshipId`, `schType`) VALUES
(1, 'ทุน 100 %'),
(2, 'ทุน 50 %'),
(3, 'ไม่มีทุนการศึกษา');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stId` int(11) NOT NULL,
  `studentId` varchar(13) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `personId` varchar(13) NOT NULL,
  `birthDate` date DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `scholarshipId` int(11) NOT NULL,
  `statusId` int(11) NOT NULL,
  `awards` varchar(255) DEFAULT NULL,
  `study` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `majorId` int(11) NOT NULL,
  `fatherName` varchar(255) DEFAULT NULL,
  `fPhone` varchar(10) DEFAULT NULL,
  `motherName` varchar(255) DEFAULT NULL,
  `mPhone` varchar(10) DEFAULT NULL,
  `clubName` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `number` varchar(4) DEFAULT NULL,
  `userRole` varchar(10) NOT NULL,
  `roleId` int(11) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stId`, `studentId`, `firstName`, `lastName`, `personId`, `birthDate`, `phone`, `address`, `scholarshipId`, `statusId`, `awards`, `study`, `class`, `majorId`, `fatherName`, `fPhone`, `motherName`, `mPhone`, `clubName`, `position`, `size`, `number`, `userRole`, `roleId`, `password`, `image`) VALUES
(1, '6301103137058', 'วีระยุทธ', 'พันชารี', '1459900260389', '1991-09-27', '0630909797', '123/1 กทม', 1, 1, '', 'ปริญญาตรี 2 ปี', 'ปี 4', 13, '', '', '', '', '', 'กองกลาง', 'XL', '4', 'admin', 1, 'P@ssword1', '1950275896.jpg'),
(2, '6301103077017', 'กรวิทย์', 'งามจิต', '1234567894758', '1997-08-15', '', '12/7 นครปฐม', 2, 1, '', 'ปริญญาตรี 2 ปี', 'ปี 4', 8, '', '', '', '', '', 'กองกลาง', 'XXL', '8', 'user', 2, '6301103077017', '591904751.jpg'),
(3, '6301103077064', 'ดิษฐพงษ์', 'สุขทรัพย์', '1235896895026', '1992-12-11', '', '44/12 ชลบุรี', 2, 1, '', 'ปริญญาตรี 2 ปี', 'ปี 4', 2, '', '', '', '', '', 'กองกลาง', 'XXL', '10', 'user', 2, '6301103077064', '692031967.jpg'),
(4, '6301103075012', 'ดนุพล', 'คงดีงาม', '1234567895421', '1995-01-24', '', '10 หมู่8 สมุทรสาคร', 2, 1, '', 'ปริญญาตรี 2 ปี', 'ปี 4', 1, '', '', '', '', '', 'กองกลาง', 'XXL', '13', 'user', 2, '6301103075012', '700845819.jpg'),
(5, '6301103137053', 'รัชพล', 'พันชารี', '1254858523655', '1994-12-06', '', '80/140 หนองแขม กทม.', 2, 1, '', 'ปริญญาตรี 2 ปี', 'ปี 4', 3, '', '', '', '', '', 'ศุนย์หน้า', 'M', '9', 'user', 2, '6301103137053', '341329289.jpg'),
(6, '6301103136210', 'สมชาย', 'ใจดี', '1234567895145', '1994-06-16', '', 'นนทบุรี', 3, 3, '', 'ปริญญาตรี 4 ปี', 'ปี 4', 4, '', '', '', '', '', 'กองหลัง', 'XL', '2', 'user', 1, '6301103136210', '779057505.jpg'),
(7, '6301103137065', 'สมพงษ์', 'รักดี', '1459455260758', '1992-06-15', '', 'กทม.', 1, 1, '', 'ปริญญาตรี 2 ปี', 'ปี 3', 12, '', '', '', '', '', 'ผู้รักษาประตู', 'L', '1', 'user', 1, '6301103137065', '1399926119.jpg'),
(8, '6301103077063', 'ชาญชัย', 'เค้าแก้ว', '1459900260000', '2022-06-07', '', 'สมุทรปราการ', 2, 2, '', 'ปริญญาตรี 2 ปี', 'ปี 3', 2, '', '', '', '', '', 'กองหลัง', 'L', '11', 'user', 1, '6301103077063', '1752751207.jpg'),
(9, '6301103075035', 'คุณากร', 'สุขเกษม', '1234567890000', '2019-06-17', '', 'นครปฐม', 3, 1, '', 'ปริญญาตรี 4 ปี', 'ปี 3', 16, '', '', '', '', '', 'ริมเส้น', 'S', '7', 'user', 1, '6301103075035', '460285912.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `st_status`
--

CREATE TABLE `st_status` (
  `statusId` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `st_status`
--

INSERT INTO `st_status` (`statusId`, `status`, `description`) VALUES
(1, 'ปกติ', 'นักศึกษาที่มีสถานะปกติ'),
(2, 'จบการศึกษา', 'นักศึกษาที่จบการศึกษาแล้ว'),
(3, 'พ้นสภาพ', 'ไม่มีสถานะการเป็นนักศึกษา'),
(4, 'พักการเรียน', 'หยุดพักการเรียนชั่วคราว');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`actId`);

--
-- Indexes for table `act_register`
--
ALTER TABLE `act_register`
  ADD PRIMARY KEY (`registerId`);

--
-- Indexes for table `all_awards`
--
ALTER TABLE `all_awards`
  ADD PRIMARY KEY (`awardId`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`facultyId`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`majorId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_details`
--
ALTER TABLE `schedule_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_plan`
--
ALTER TABLE `schedule_plan`
  ADD PRIMARY KEY (`planId`);

--
-- Indexes for table `scholarship`
--
ALTER TABLE `scholarship`
  ADD PRIMARY KEY (`scholarshipId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stId`),
  ADD UNIQUE KEY `myUnuque` (`studentId`,`personId`);

--
-- Indexes for table `st_status`
--
ALTER TABLE `st_status`
  ADD PRIMARY KEY (`statusId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `actId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `act_register`
--
ALTER TABLE `act_register`
  MODIFY `registerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `all_awards`
--
ALTER TABLE `all_awards`
  MODIFY `awardId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `facultyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `majorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `schedule_details`
--
ALTER TABLE `schedule_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedule_plan`
--
ALTER TABLE `schedule_plan`
  MODIFY `planId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `scholarshipId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `st_status`
--
ALTER TABLE `st_status`
  MODIFY `statusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
