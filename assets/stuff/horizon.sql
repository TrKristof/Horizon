-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 04. 18:52
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `horizon`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `assignments`
--

CREATE TABLE `assignments` (
  `Id` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Description` text NOT NULL,
  `DueDate` datetime NOT NULL,
  `CreatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `assignments_files`
--

CREATE TABLE `assignments_files` (
  `Id` int(11) NOT NULL,
  `AssignmentId` int(11) NOT NULL,
  `FilePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `assignments_submissions`
--

CREATE TABLE `assignments_submissions` (
  `Id` int(11) NOT NULL,
  `AssignmentId` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `SubmittedAt` datetime NOT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `classes`
--

CREATE TABLE `classes` (
  `Id` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Subject` varchar(25) NOT NULL,
  `TeacherId` int(11) NOT NULL,
  `SchoolId` int(11) NOT NULL,
  `CreatedAt` date NOT NULL,
  `IsActive` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `class_chat`
--

CREATE TABLE `class_chat` (
  `Id` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `SenderId` int(11) NOT NULL,
  `Message` text NOT NULL,
  `SentAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `class_student`
--

CREATE TABLE `class_student` (
  `ClassId` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `class_teacher`
--

CREATE TABLE `class_teacher` (
  `ClassId` int(11) NOT NULL,
  `TeacherId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `notes`
--

CREATE TABLE `notes` (
  `Id` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Description` text DEFAULT NULL,
  `CreatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `school`
--

CREATE TABLE `schools` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Date` datetime NOT NULL,
  `IsActive` tinyint(1) DEFAULT 0,
  `ExpirationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `school`
--

INSERT INTO `schools` (`Id`, `Name`, `Country`, `Address`, `Email`, `Password`, `Date`, `IsActive`, `ExpirationDate`) VALUES
(1, 'Springfield High', 'USA', '742 Evergreen Terrace', 'admin1@springfield.edu', 'password123', '2025-04-03 09:39:33', 1, '2026-04-03 09:39:33'),
(2, 'Riverdale Academy', 'Canada', '123 River St', 'admin2@riverdale.edu', 'password123', '2025-04-03 09:39:33', 1, '2026-04-03 09:39:33'),
(3, 'Hill Valley Institute', 'UK', '88 Time St', 'admin3@hillvalley.edu', 'password123', '2025-04-03 09:39:33', 1, '2026-04-03 09:39:33');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `students`
--

CREATE TABLE `students` (
  `Id` int(11) NOT NULL,
  `SchoolId` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `StudentCard` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `IsActive` tinyint(1) DEFAULT 0,
  `ExpirationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `students`
--

INSERT INTO `students` (`Id`, `SchoolId`, `Name`, `Email`, `Password`, `StudentCard`, `Date`, `IsActive`, `ExpirationDate`) VALUES
(50, 1, 'Student 31', 'student31@school1.edu', 'pass123', 6121111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(51, 1, 'Student 32', 'student32@school1.edu', 'pass123', 6131111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(52, 1, 'Student 33', 'student33@school1.edu', 'pass123', 6141111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(53, 1, 'Student 34', 'student34@school1.edu', 'pass123', 6151111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(54, 1, 'Student 35', 'student35@school1.edu', 'pass123', 6161111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(55, 1, 'Student 36', 'student36@school1.edu', 'pass123', 6171111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(56, 1, 'Student 37', 'student37@school1.edu', 'pass123', 6181111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(57, 1, 'Student 38', 'student38@school1.edu', 'pass123', 6191111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(58, 1, 'Student 39', 'student39@school1.edu', 'pass123', 6112111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(59, 1, 'Student 40', 'student40@school1.edu', 'pass123', 6113111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(60, 1, 'Student 41', 'student41@school1.edu', 'pass123', 6114111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(61, 1, 'Student 42', 'student42@school1.edu', 'pass123', 6115111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(62, 1, 'Student 43', 'student43@school1.edu', 'pass123', 6116111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(63, 1, 'Student 44', 'student44@school1.edu', 'pass123', 6117111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(64, 1, 'Student 45', 'student45@school1.edu', 'pass123', 6118111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(65, 1, 'Student 46', 'student46@school1.edu', 'pass123', 6119111, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(66, 1, 'Student 47', 'student47@school1.edu', 'pass123', 6111211, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(67, 1, 'Student 48', 'student48@school1.edu', 'pass123', 6111311, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(68, 1, 'Student 49', 'student49@school1.edu', 'pass123', 6111411, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(69, 1, 'Student 50', 'student50@school1.edu', 'pass123', 6111511, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(70, 2, 'Student 61', 'student61@school2.edu', 'pass123', 6111611, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(71, 2, 'Student 62', 'student62@school2.edu', 'pass123', 6111711, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(72, 2, 'Student 63', 'student63@school2.edu', 'pass123', 6111811, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(73, 2, 'Student 64', 'student64@school2.edu', 'pass123', 6111911, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(74, 2, 'Student 65', 'student65@school2.edu', 'pass123', 6111121, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(75, 2, 'Student 66', 'student66@school2.edu', 'pass123', 6111131, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(76, 2, 'Student 67', 'student67@school2.edu', 'pass123', 6111141, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(77, 2, 'Student 68', 'student68@school2.edu', 'pass123', 6111151, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(78, 2, 'Student 69', 'student69@school2.edu', 'pass123', 6111161, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(79, 2, 'Student 70', 'student70@school2.edu', 'pass123', 6111171, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(80, 2, 'Student 71', 'student71@school2.edu', 'pass123', 6111181, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(81, 2, 'Student 72', 'student72@school2.edu', 'pass123', 6111191, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(82, 2, 'Student 73', 'student73@school2.edu', 'pass123', 6111112, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(83, 2, 'Student 74', 'student74@school2.edu', 'pass123', 6111113, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(84, 2, 'Student 75', 'student75@school2.edu', 'pass123', 6111114, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(85, 2, 'Student 76', 'student76@school2.edu', 'pass123', 6111115, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(86, 2, 'Student 77', 'student77@school2.edu', 'pass123', 6111116, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(87, 2, 'Student 78', 'student78@school2.edu', 'pass123', 6111117, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(88, 2, 'Student 79', 'student79@school2.edu', 'pass123', 6111118, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(89, 2, 'Student 80', 'student80@school2.edu', 'pass123', 6111119, '2025-04-03 10:02:21', 1, '2026-04-03 10:02:21'),
(90, 3, 'Student 91', 'student91@school3.edu', 'pass123', 6211111, '2025-04-03 10:02:21', 2, '2026-04-03 10:02:21'),
(91, 3, 'Student 92', 'student92@school3.edu', 'pass123', 6311111, '2025-04-03 10:02:21', 2, '2026-04-03 10:02:21'),
(92, 3, 'Student 93', 'student93@school3.edu', 'pass123', 6411111, '2025-04-03 10:02:21', 2, '2026-04-03 10:02:21'),
(93, 3, 'Student 94', 'student94@school3.edu', 'pass123', 6511111, '2025-04-03 10:02:21', 2, '2026-04-03 10:02:21'),
(94, 3, 'Student 95', 'student95@school3.edu', 'pass123', 6611111, '2025-04-03 10:02:21', 2, '2026-04-03 10:02:21'),
(95, 3, 'Student 96', 'student96@school3.edu', 'pass123', 6711111, '2025-04-03 10:02:21', 2, '2026-04-03 10:02:21'),
(96, 3, 'Student 97', 'student97@school3.edu', 'pass123', 6811111, '2025-04-03 10:02:21', 2, '2026-04-03 10:02:21'),
(97, 3, 'Student 98', 'student98@school3.edu', 'pass123', 6911111, '2025-04-03 10:02:21', 2, '2026-04-03 10:02:21'),
(98, 3, 'Student 99', 'student99@school3.edu', 'pass123', 7111111, '2025-04-03 10:02:21', 2, '2026-04-03 10:02:21');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `submission_files`
--

CREATE TABLE `submission_files` (
  `Id` int(11) NOT NULL,
  `SubmissionId` int(11) NOT NULL,
  `FilePath` varchar(255) DEFAULT NULL,
  `UploadedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `teachers`
--

CREATE TABLE `teachers` (
  `Id` int(11) NOT NULL,
  `SchoolId` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `IdentityCard` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `IsActive` tinyint(1) DEFAULT 0,
  `ExpirationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `teachers`
--

INSERT INTO `teachers` (`Id`, `SchoolId`, `Name`, `Email`, `Password`, `IdentityCard`, `Date`, `IsActive`, `ExpirationDate`) VALUES
(25, 1, 'John Doe', 'johndoe@springfield.edu', 'pass123', 111111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(26, 1, 'Jane Smith', 'janesmith@springfield.edu', 'pass123', 211111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(27, 1, 'Robert Brown', 'robertbrown@springfield.edu', 'pass123', 311111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(28, 1, 'Lisa White', 'lisawhite@springfield.edu', 'pass123', 411111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(29, 1, 'Michael Black', 'michaelblack@springfield.edu', 'pass123', 511111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(30, 1, 'Susan Green', 'susangreen@springfield.edu', 'pass123', 611111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(31, 1, 'David Blue', 'davidblue@springfield.edu', 'pass123', 711111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(32, 1, 'Emily Grey', 'emilygrey@springfield.edu', 'pass123', 811111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(33, 2, 'William King', 'williamking@riverdale.edu', 'pass123', 911111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(34, 2, 'Emma Queen', 'emmaqueen@riverdale.edu', 'pass123', 11111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(35, 2, 'James Knight', 'jamesknight@riverdale.edu', 'pass123', 21111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(36, 2, 'Charlotte Bishop', 'charlottebishop@riverdale.edu', 'pass123', 31111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(37, 2, 'Oliver Duke', 'oliverduke@riverdale.edu', 'pass123', 41111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(38, 2, 'Sophia Prince', 'sophiaprince@riverdale.edu', 'pass123', 51111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(39, 2, 'Lucas Lord', 'lucaslord@riverdale.edu', 'pass123', 61111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(40, 2, 'Mia Lady', 'mialady@riverdale.edu', 'pass123', 71111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(41, 3, 'Daniel Adams', 'danieladams@hillvalley.edu', 'pass123', 81111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(42, 3, 'Olivia Carter', 'oliviacarter@hillvalley.edu', 'pass123', 91111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(43, 3, 'Benjamin Clark', 'benjaminclark@hillvalley.edu', 'pass123', 1111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(44, 3, 'Ava Hall', 'avahall@hillvalley.edu', 'pass123', 2111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(45, 3, 'Henry Wright', 'henrywright@hillvalley.edu', 'pass123', 3111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(46, 3, 'Ella Turner', 'ellaturner@hillvalley.edu', 'pass123', 4111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(47, 3, 'Jacob Harris', 'jacobharris@hillvalley.edu', 'pass123', 5111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42'),
(48, 3, 'Grace Lewis', 'gracelewis@hillvalley.edu', 'pass123', 6111111, '2025-04-03 09:48:42', 1, '2026-04-03 09:48:42');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `teacher_student`
--

CREATE TABLE `teacher_student` (
  `TeacherId` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_assignments_class` (`ClassId`);

--
-- A tábla indexei `assignments_files`
--
ALTER TABLE `assignments_files`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_assignment_files_assignment` (`AssignmentId`);

--
-- A tábla indexei `assignments_submissions`
--
ALTER TABLE `assignments_submissions`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_submission_assignment` (`AssignmentId`),
  ADD KEY `fk_submission_student` (`StudentId`);

--
-- A tábla indexei `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_classes_teacher` (`TeacherId`),
  ADD KEY `fk_classes_school` (`SchoolId`);

--
-- A tábla indexei `class_chat`
--
ALTER TABLE `class_chat`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_class_chat_class` (`ClassId`);

--
-- A tábla indexei `class_student`
--
ALTER TABLE `class_student`
  ADD KEY `fk_class_student_class` (`ClassId`),
  ADD KEY `fk_class_student_student` (`StudentId`);

--
-- A tábla indexei `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD KEY `fk_class_teacher_classes` (`ClassId`),
  ADD KEY `fk_class_teacher_teachers` (`TeacherId`);

--
-- A tábla indexei `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_notes_class` (`ClassId`);

--
-- A tábla indexei `school`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD UNIQUE KEY `Address` (`Address`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- A tábla indexei `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `StudentCard` (`StudentCard`),
  ADD KEY `fk_students_school` (`SchoolId`);

--
-- A tábla indexei `submission_files`
--
ALTER TABLE `submission_files`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_assignment_files_submission` (`SubmissionId`);

--
-- A tábla indexei `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `IdentityCard` (`IdentityCard`),
  ADD KEY `fk_teachers_school` (`SchoolId`);

--
-- A tábla indexei `teacher_student`
--
ALTER TABLE `teacher_student`
  ADD KEY `fk_teacher_student_teacher` (`TeacherId`),
  ADD KEY `fk_teacher_student_student` (`StudentId`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `school`
--
ALTER TABLE `school`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `students`
--
ALTER TABLE `students`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT a táblához `teachers`
--
ALTER TABLE `teachers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `fk_assignments_class` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`Id`);

--
-- Megkötések a táblához `assignments_files`
--
ALTER TABLE `assignments_files`
  ADD CONSTRAINT `fk_assignment_files_assignment` FOREIGN KEY (`AssignmentId`) REFERENCES `assignments` (`Id`);

--
-- Megkötések a táblához `assignments_submissions`
--
ALTER TABLE `assignments_submissions`
  ADD CONSTRAINT `fk_submission_assignment` FOREIGN KEY (`AssignmentId`) REFERENCES `assignments` (`Id`),
  ADD CONSTRAINT `fk_submission_student` FOREIGN KEY (`StudentId`) REFERENCES `students` (`Id`);

--
-- Megkötések a táblához `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `fk_classes_school` FOREIGN KEY (`SchoolId`) REFERENCES `schools` (`Id`),
  ADD CONSTRAINT `fk_classes_teacher` FOREIGN KEY (`TeacherId`) REFERENCES `teachers` (`Id`);

--
-- Megkötések a táblához `class_chat`
--
ALTER TABLE `class_chat`
  ADD CONSTRAINT `fk_class_chat_class` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`Id`);

--
-- Megkötések a táblához `class_student`
--
ALTER TABLE `class_student`
  ADD CONSTRAINT `fk_class_student_class` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`Id`),
  ADD CONSTRAINT `fk_class_student_student` FOREIGN KEY (`StudentId`) REFERENCES `students` (`Id`);

--
-- Megkötések a táblához `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD CONSTRAINT `fk_class_teacher_classes` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`Id`),
  ADD CONSTRAINT `fk_class_teacher_teachers` FOREIGN KEY (`TeacherId`) REFERENCES `teachers` (`Id`);

--
-- Megkötések a táblához `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `fk_notes_class` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`Id`);

--
-- Megkötések a táblához `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_school` FOREIGN KEY (`SchoolId`) REFERENCES `schools` (`Id`);

--
-- Megkötések a táblához `submission_files`
--
ALTER TABLE `submission_files`
  ADD CONSTRAINT `fk_assignment_files_submission` FOREIGN KEY (`SubmissionId`) REFERENCES `assignments_submissions` (`Id`);

--
-- Megkötések a táblához `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `fk_teachers_school` FOREIGN KEY (`SchoolId`) REFERENCES `schools` (`Id`);

--
-- Megkötések a táblához `teacher_student`
--
ALTER TABLE `teacher_student`
  ADD CONSTRAINT `fk_teacher_student_student` FOREIGN KEY (`StudentId`) REFERENCES `students` (`Id`),
  ADD CONSTRAINT `fk_teacher_student_teacher` FOREIGN KEY (`TeacherId`) REFERENCES `teachers` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
