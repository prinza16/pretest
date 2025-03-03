-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 05:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bangkoktest`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id_answers` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id_answers`, `question_id`, `answer_text`, `created_at`) VALUES
(1, 1, 'สีแดง', '2025-03-02 07:21:50'),
(2, 1, 'สีฟ้า', '2025-03-02 07:21:50'),
(3, 1, 'สีเขียว', '2025-03-02 07:21:50'),
(4, 1, 'สีเหลือง', '2025-03-02 07:21:50'),
(5, 2, 'สุนัข', '2025-03-02 07:21:50'),
(6, 2, 'แมว', '2025-03-02 07:21:50'),
(7, 2, 'กระต่าย', '2025-03-02 07:21:50'),
(8, 2, 'นก', '2025-03-02 07:21:50'),
(9, 3, 'ข้าวมันไก่', '2025-03-02 07:21:50'),
(10, 3, 'ส้มตำ', '2025-03-02 07:21:50'),
(11, 3, 'พิซซ่า', '2025-03-02 07:21:50'),
(12, 3, 'ก๋วยเตี๋ยว', '2025-03-02 07:21:50'),
(13, 4, 'กาแฟ', '2025-03-02 07:21:50'),
(14, 4, 'น้ำผลไม้', '2025-03-02 07:21:50'),
(15, 4, 'น้ำอัดลม', '2025-03-02 07:21:50'),
(16, 4, 'ชาเขียว', '2025-03-02 07:21:50'),
(17, 5, 'ภูเขา', '2025-03-02 07:21:50'),
(18, 5, 'ทะเล', '2025-03-02 07:21:50'),
(19, 5, 'เมืองใหญ่', '2025-03-02 07:21:50'),
(20, 5, 'น้ำตก', '2025-03-02 07:21:50'),
(21, 6, 'ป๊อป', '2025-03-02 07:21:50'),
(22, 6, 'ร็อค', '2025-03-02 07:21:50'),
(23, 6, 'แจ๊ส', '2025-03-02 07:21:50'),
(24, 6, 'ฮิปฮอป', '2025-03-02 07:21:50'),
(25, 7, 'ฤดูร้อน', '2025-03-02 07:21:50'),
(26, 7, 'ฤดูฝน', '2025-03-02 07:21:50'),
(27, 7, 'ฤดูหนาว', '2025-03-02 07:21:50'),
(28, 7, 'ฤดูใบไม้ผลิ', '2025-03-02 07:21:50'),
(29, 8, 'หมา', '2025-03-02 07:21:50'),
(30, 8, 'แมว', '2025-03-02 07:21:50'),
(31, 8, 'ปลา', '2025-03-02 07:21:50'),
(32, 8, 'นก', '2025-03-02 07:21:50'),
(33, 9, 'อ่านหนังสือ', '2025-03-02 07:21:50'),
(34, 9, 'ดูหนัง', '2025-03-02 07:21:50'),
(35, 9, 'เล่นกีฬา', '2025-03-02 07:21:50'),
(36, 9, 'เล่นเกม', '2025-03-02 07:21:50'),
(37, 10, 'บินได้', '2025-03-02 07:21:50'),
(38, 10, 'ล่องหน', '2025-03-02 07:21:50'),
(39, 10, 'อ่านใจคนได้', '2025-03-02 07:21:50'),
(40, 10, 'เดินทางข้ามเวลา', '2025-03-02 07:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id_questions` int(11) NOT NULL,
  `question_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id_questions`, `question_text`) VALUES
(1, 'คุณชอบสีอะไรที่สุดในคำตอบนี้?'),
(2, 'คุณชอบสัตว์ชนิดไหนมากที่สุดในคำตอบนี้'),
(3, 'อาหารที่คุณชอบกินเป็นพิเศษคืออะไรในคำตอบนี้?'),
(4, 'คุณชอบดื่มเครื่องดื่มอะไรที่สุดในคำตอบนี้?'),
(5, 'สถานที่ที่คุณอยากไปเที่ยวมากที่สุดคือที่ไหนในคำตอบนี้?'),
(6, 'คุณชอบฟังเพลงแนวไหนในคำตอบนี้?'),
(7, 'ฤดูที่คุณชอบมากที่สุดคือฤดูอะไรในคำตอบนี้?'),
(8, 'ถ้าคุณสามารถเลี้ยงสัตว์ได้ 1 ตัว คุณจะเลือกเลี้ยงอะไรในคำตอบนี้?'),
(9, 'คุณชอบกิจกรรมอะไรในเวลาว่างในคำตอบนี้?'),
(10, 'ถ้าคุณสามารถมีพลังวิเศษได้ 1 อย่าง คุณอยากมีพลังอะไรในคำตอบนี้?');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id_responses` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `answer_text` text NOT NULL,
  `number_test` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id_answers`),
  ADD KEY `fk_answers_questions` (`question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_questions`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id_responses`),
  ADD KEY `fk_responses_questions` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id_answers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_questions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id_responses` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answers_questions` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id_questions`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
