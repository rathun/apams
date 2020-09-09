-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2020 at 11:53 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ap_feedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_task`
--

CREATE TABLE `assign_task` (
  `id` int(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `district` varchar(50) DEFAULT NULL,
  `date` varchar(20) NOT NULL,
  `academic_year` varchar(10) DEFAULT NULL,
  `visiting_officer` varchar(30) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `feedback` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_task`
--

INSERT INTO `assign_task` (`id`, `institution`, `district`, `date`, `academic_year`, `visiting_officer`, `status`, `feedback`) VALUES
(2, 'Ap Model School', 'Chittoor', '2020-08-02', '2020-2021', 'hari29harran@gmail.com', 'Visited', '1'),
(5, 'KNMS School', 'Guntur', '2020-08-03', '2020-2021', 'hari29harran@gmail.com', 'Visited', '1'),
(4, 'The Peepal Grove School', 'Anantapur', '2020-08-03', '2020-2021', 'hari29harran@gmail.com', 'Visited', '1');

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `criteria_id` int(11) NOT NULL,
  `criteria_name` varchar(255) DEFAULT NULL,
  `criteria_questions` text DEFAULT NULL,
  `criteria_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`criteria_id`, `criteria_name`, `criteria_questions`, `criteria_type`) VALUES
(1, 'Well Developed Timetable Exists', '[{\"question\":\"Are Class-wise and Teacher-wise Timetable readily available in HM office?\"},{\"question\":\"Is the timetable as per Academic calendar?\"},{\"question\":\"Has the HM prepared a Tentative Calender for those situations when teacher(s) is absent?\"},{\"question\":\"Do teachers go take extra classes according to the Tentative Calendar? Check a class according to the tentative timetable to verify?\"},{\"question\":\"Is a copy of the Timetable pasted in all Classrooms?\"}]', 'O'),
(2, 'Students Requiring Extra Support', '[{\"question\":\"Does HM have a list of students requiring extra support?\"},{\"question\":\"Does HM have a list of subject areas in which students require extra support?\"},{\"question\":\"Has the HM prepared a detailed plan for helping students requiring extra support?\"},{\"question\":\"Is the plan for helping students being implemented? Check with a few students who have been identified as extra support\"}]', 'O'),
(3, 'School Management Committee Meetings', '[{\"question\":\"Does the school maintain a Social Management Committee register?\"},{\"question\":\"Select the Number of School Management Committee (SMC) meetings conducted this academic year?\"},{\"question\":\"Record the attendance of parents in SMC?\"},{\"question\":\"Does the SMC see a majority of all parents (50%+) participating as per the SMC Register?\"},{\"question\":\"Are the decisions and the minutes of SMC meetings written down in the SMC register/book?\"},{\"question\":\"Does a School Development Plan exist that is jointly prepared  by SMC and Headmasters/Teachers?\"},{\"question\":\"Are SMC contact details displayed prominently in the school?\"}]', 'O'),
(4, 'The Library is Well Maintained and is Regularly Utilized', '[{\"question\":\"Is there a library period in the school?\"},{\"question\":\"Are the books in the library well organized according to Class,Language and Topic?\"},{\"question\":\"Are there books of different languages in the library?\"},{\"question\":\"Are there fiction and non-fiction books in the library?\"},{\"question\":\"Does the library issue books regularly to students?\"},{\"question\":\"Is the library period used by students to share book reviews,in either written or oral form?\"}]', 'O'),
(5, 'The Science Labs are Well Maintained and are Regularly Utilized', '[{\"question\":\"Does the school have a functional science lab?\"},{\"question\":\"Do students of all classes use the Lab/Lab equipment?\"},{\"question\":\"Do students use the lab regularly to do the experiments prescribed in the textbook?\"},{\"question\":\"Are students maintaining a lab record written in their own words?\"}]', 'O'),
(6, 'CCE (Continuous and Comprehensive Evaluation) is Being Followed Strictly in the School', '[{\"question\":\"Have within chapter textbook exercises been written by students?\"},{\"question\":\"Are end of chapter exercises being done by students?\"},{\"question\":\"Are students writing all textbook exercises in their own words?\"},{\"question\":\"Are FA(Formative Assessment) notebooks being written by students in their own words?\"},{\"question\":\"Are teachers preparing their own FA Question Papers?\"},{\"question\":\"Do teachers provide written feedback to students in the notebooks?\"}]', 'O'),
(7, 'Attendance', '[{\"question\":\"Are all teachers who are supposed to be in school actually present?\"},{\"question\":\"Are all students who are supposed to be in school actually present?\"}]', 'O'),
(8, 'Classroom Basics', '[{\"question\":\"Is Teacher in the Classroom before the start of the period?\"},{\"question\":\"Is Teacher starting the class on time?\"},{\"question\":\"Is the teacher teaching the appropriate subject as per timetable?\"}]', 'O'),
(9, 'Communication', '[{\"question\":\"Does the teacher convey (verbally or otherwise) that studying the subject is not very useful?\"},{\"question\":\"Does the teacher engage in one-sided communication through most parts of the period?\"},{\"question\":\"Does the teacher convey to students what Learning Outcomes they will be learning at somepoint during the lesson?\"}]', 'O'),
(10, 'Lesson Plan and Learning Material', '[{\"question\":\"Is Teaching Learning Material being used in the classroom?\"},{\"question\":\"Has the teacher prepared a lesson plan?\"},{\"question\":\"Does the lesson plan have special notes for slow learners?\"}]', 'O'),
(20, 'General', '[{\"question\":\".Usage of ICT tools to support teaching and learning process in school.\"},{\"question\":\"Availability of library resources\"},{\"question\":\"Maintenance of necessities of the classrooms(desk, blackboard)\"},{\"question\":\"Proportionality of facutly to students is maintained\"},{\"question\":\"Funtionality of parent - teachers association.\\r\\n\"},{\"question\":\"Importance given to maintain hygiene of the school campus\"},{\"question\":\"Motivation towards co curricular activities.\\r\\n\"},{\"question\":\"School approach to student discipline and safety\"},{\"question\":\"Motivation towards extra curricular activities.\\r\\n\"},{\"question\":\"Satisfaction of Canteen facilities of the school\"}]', 'G');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district_name`) VALUES
(1, 'Anantapur'),
(2, 'Chittoor'),
(3, 'East Godavari'),
(4, 'Guntur'),
(5, 'Kadapa'),
(6, 'Machilipatnam'),
(7, 'Kurnool'),
(8, 'Nellore'),
(9, 'Ongole'),
(10, 'Srikakulam'),
(11, 'Visakhapatnam'),
(12, 'Vizianagaram'),
(13, 'West Godavari');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(255) NOT NULL,
  `date` varchar(20) NOT NULL,
  `institution_id` varchar(255) NOT NULL,
  `institution` varchar(100) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `visiter_id` varchar(50) NOT NULL,
  `criteria_id` varchar(255) NOT NULL,
  `question1` varchar(5) DEFAULT NULL,
  `question2` varchar(5) DEFAULT NULL,
  `question3` varchar(5) DEFAULT NULL,
  `question4` varchar(5) DEFAULT NULL,
  `question5` varchar(5) DEFAULT NULL,
  `question6` varchar(5) DEFAULT NULL,
  `question7` varchar(5) DEFAULT NULL,
  `question8` varchar(5) DEFAULT NULL,
  `question9` varchar(5) DEFAULT NULL,
  `question10` varchar(5) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_data` varchar(255) DEFAULT NULL,
  `rating` varchar(11) DEFAULT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `date`, `institution_id`, `institution`, `district`, `year`, `visiter_id`, `criteria_id`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `question10`, `location`, `photo`, `photo_data`, `rating`, `comments`) VALUES
(1, '2020-08-02', '4', 'Ap Model School', 'Chittoor', '2020-2021', 'hari29harran@gmail.com', '1', '5', '4', '4', '4', '4', '', '', '', '', '', '11.3433646,77.7331025', '142020-08-02hari29harran@gmail.com.jpg', 'ea70945430000b650dd881313d67da04', '4.2', 'Nil'),
(10, '2020-08-02', '4', 'Ap Model School', 'Chittoor', '2020-2021', 'hari29harran@gmail.com', '10', '5', '5', '4', '', '', '', '', '', '', '', '11.3433646,77.7331025', '1042020-08-02hari29harran@gmail.com.jpg', '0a83635343de70b7068fb4abbaeb7386', '4.558139534', 'Nil'),
(2, '2020-08-02', '4', 'Ap Model School', 'Chittoor', '2020-2021', 'hari29harran@gmail.com', '2', '5', '5', '4', '5', '', '', '', '', '', '', '11.3433646,77.7331025', '242020-08-02hari29harran@gmail.com.jpg', 'a0fb1dedf4b21d7b00252b4d30e1b7af', '4.444444444', 'Nil'),
(3, '2020-08-02', '4', 'Ap Model School', 'Chittoor', '2020-2021', 'hari29harran@gmail.com', '3', '5', '5', '5', '5', '5', '5', '5', '', '', '', '11.3433646,77.7331025', '342020-08-02hari29harran@gmail.com.jpg', 'a9214637d72a91785a287c795b9b0c52', '4.6875', 'Nil'),
(4, '2020-08-02', '4', 'Ap Model School', 'Chittoor', '2020-2021', 'hari29harran@gmail.com', '4', '5', '5', '5', '5', '4', '4', '', '', '', '', '11.3433646,77.7331025', '442020-08-02hari29harran@gmail.com.jpg', '3c458615a3e8504c52dccf10f67d3e52', '4.681818181', 'Nil'),
(5, '2020-08-02', '4', 'Ap Model School', 'Chittoor', '2020-2021', 'hari29harran@gmail.com', '5', '5', '4', '4', '4', '', '', '', '', '', '', '11.3433646,77.7331025', '542020-08-02hari29harran@gmail.com.jpg', 'd46871e4c553aaacd747e2095925b9e4', '4.615384615', 'Nil'),
(6, '2020-08-02', '4', 'Ap Model School', 'Chittoor', '2020-2021', 'hari29harran@gmail.com', '6', '5', '5', '5', '5', '4', '3', '', '', '', '', '11.3433646,77.7331025', '642020-08-02hari29harran@gmail.com.jpg', '1bddecfe4349e1a4d9d8c3324ee1a846', '4.59375', 'Nil'),
(7, '2020-08-02', '4', 'Ap Model School', 'Chittoor', '2020-2021', 'hari29harran@gmail.com', '7', '5', '4', '', '', '', '', '', '', '', '', '11.3433646,77.7331025', '742020-08-02hari29harran@gmail.com.jpg', '4f62fec83c7b53292ca9c8f8ebf99ecd', '4.588235294', 'Nil'),
(8, '2020-08-02', '4', 'Ap Model School', 'Chittoor', '2020-2021', 'hari29harran@gmail.com', '8', '5', '3', '3', '', '', '', '', '', '', '', '11.3433646,77.7331025', '842020-08-02hari29harran@gmail.com.jpg', '4f62fec83c7b53292ca9c8f8ebf99ecd', '4.513513513', 'Nil'),
(9, '2020-08-02', '4', 'Ap Model School', 'Chittoor', '2020-2021', 'hari29harran@gmail.com', '9', '5', '5', '5', '', '', '', '', '', '', '', '11.3433646,77.7331025', '942020-08-02hari29harran@gmail.com.jpg', '301df0acc958dc2ac0940df4191c61df', '4.55', 'Nil'),
(21, '2020-08-03', '3', 'The Peepal Grove School', 'Anantapur', '2020-2021', 'hari29harran@gmail.com', '1', '5', '4', '4', '4', '4', '', '', '', '', '', '11.127122499999999,78.6568942', '132020-08-03hari29harran@gmail.com.jpg', '2ac524e508076a9e8c3e2fbc71e5fc1f', '4.2', 'Nil'),
(30, '2020-08-03', '3', 'The Peepal Grove School', 'Anantapur', '2020-2021', 'hari29harran@gmail.com', '10', '3', '3', '2', '', '', '', '', '', '', '', '11.127122499999999,78.6568942', '1032020-08-03hari29harran@gmail.com.jpg', '3c458615a3e8504c52dccf10f67d3e52', '3.348837209', 'Nil'),
(22, '2020-08-03', '3', 'The Peepal Grove School', 'Anantapur', '2020-2021', 'hari29harran@gmail.com', '2', '5', '4', '4', '2', '', '', '', '', '', '', '11.127122499999999,78.6568942', '232020-08-03hari29harran@gmail.com.jpg', '0723fcff3fd204602d374b02e2eb541f', '4', 'Nil'),
(23, '2020-08-03', '3', 'The Peepal Grove School', 'Anantapur', '2020-2021', 'hari29harran@gmail.com', '3', '3', '3', '4', '3', '2', '2', '2', '', '', '', '11.127122499999999,78.6568942', '332020-08-03hari29harran@gmail.com.jpg', 'ee977b3ace879dbcb815dc3f7e88deba', '3.4375', 'Nil'),
(24, '2020-08-03', '3', 'The Peepal Grove School', 'Anantapur', '2020-2021', 'hari29harran@gmail.com', '4', '4', '4', '4', '4', '4', '4', '', '', '', '', '11.127122499999999,78.6568942', '432020-08-03hari29harran@gmail.com.jpg', 'facfad852a49e2e0394c383bf3398be3', '3.590909090', 'Nil'),
(25, '2020-08-03', '3', 'The Peepal Grove School', 'Anantapur', '2020-2021', 'hari29harran@gmail.com', '5', '4', '4', '4', '4', '', '', '', '', '', '', '11.127122499999999,78.6568942', '532020-08-03hari29harran@gmail.com.jpg', '4fe3ea47e921b48c4e97066992f459fb', '3.653846153', 'Nil'),
(26, '2020-08-03', '3', 'The Peepal Grove School', 'Anantapur', '2020-2021', 'hari29harran@gmail.com', '6', '4', '4', '4', '4', '3', '1', '', '', '', '', '11.127122499999999,78.6568942', '632020-08-03hari29harran@gmail.com.jpg', 'f95c9d603e91e2b3213017ca2f6bb325', '3.59375', 'Nil'),
(27, '2020-08-03', '3', 'The Peepal Grove School', 'Anantapur', '2020-2021', 'hari29harran@gmail.com', '7', '4', '1', '', '', '', '', '', '', '', '', '11.127122499999999,78.6568942', '732020-08-03hari29harran@gmail.com.jpg', 'd37726b234fb21734bbb13b232fe5feb', '3.529411764', 'Nil'),
(28, '2020-08-03', '3', 'The Peepal Grove School', 'Anantapur', '2020-2021', 'hari29harran@gmail.com', '8', '4', '2', '2', '', '', '', '', '', '', '', '11.127122499999999,78.6568942', '832020-08-03hari29harran@gmail.com.jpg', 'd46871e4c553aaacd747e2095925b9e4', '3.459459459', 'Nil'),
(29, '2020-08-03', '3', 'The Peepal Grove School', 'Anantapur', '2020-2021', 'hari29harran@gmail.com', '9', '2', '3', '3', '', '', '', '', '', '', '', '11.127122499999999,78.6568942', '932020-08-03hari29harran@gmail.com.jpg', 'a9214637d72a91785a287c795b9b0c52', '3.4', 'Nil'),
(11, '2020-08-03', '5', 'KNMS School', 'Guntur', '2020-2021', 'hari29harran@gmail.com', '1', '4', '4', '4', '4', '4', '', '', '', '', '', '11.3434399,77.7332', '152020-08-03hari29harran@gmail.com.jpg', 'ea70945430000b650dd881313d67da04', '4', 'Nil'),
(20, '2020-08-03', '5', 'KNMS School', 'Guntur', '2020-2021', 'hari29harran@gmail.com', '10', '4', '3', '2', '', '', '', '', '', '', '', '11.3434399,77.7332', '1052020-08-03hari29harran@gmail.com.jpg', '4f62fec83c7b53292ca9c8f8ebf99ecd', '3.744186046', 'Nil'),
(12, '2020-08-03', '5', 'KNMS School', 'Guntur', '2020-2021', 'hari29harran@gmail.com', '2', '4', '4', '4', '4', '', '', '', '', '', '', '11.3434399,77.7332', '252020-08-03hari29harran@gmail.com.jpg', 'a0fb1dedf4b21d7b00252b4d30e1b7af', '4', 'Nil'),
(13, '2020-08-03', '5', 'KNMS School', 'Guntur', '2020-2021', 'hari29harran@gmail.com', '3', '5', '5', '5', '5', '4', '3', '3', '', '', '', '11.3434399,77.7332', '352020-08-03hari29harran@gmail.com.jpg', 'a9214637d72a91785a287c795b9b0c52', '4.125', 'Nil'),
(14, '2020-08-03', '5', 'KNMS School', 'Guntur', '2020-2021', 'hari29harran@gmail.com', '4', '4', '4', '3', '4', '4', '4', '', '', '', '', '11.3434399,77.7332', '452020-08-03hari29harran@gmail.com.jpg', '3c458615a3e8504c52dccf10f67d3e52', '4.045454545', 'Nil'),
(15, '2020-08-03', '5', 'KNMS School', 'Guntur', '2020-2021', 'hari29harran@gmail.com', '5', '4', '3', '3', '3', '', '', '', '', '', '', '11.3434399,77.7332', '552020-08-03hari29harran@gmail.com.jpg', 'd0e1959f7cb40f32e9cc88315920fb2b', '3.923076923', 'Nil'),
(16, '2020-08-03', '5', 'KNMS School', 'Guntur', '2020-2021', 'hari29harran@gmail.com', '6', '4', '3', '3', '4', '4', '2', '', '', '', '', '11.3434399,77.7332', '652020-08-03hari29harran@gmail.com.jpg', '61348c2700e2d1dcd4c3f7f58f250fc0', '3.8125', 'Nil'),
(17, '2020-08-03', '5', 'KNMS School', 'Guntur', '2020-2021', 'hari29harran@gmail.com', '7', '5', '3', '', '', '', '', '', '', '', '', '11.3434399,77.7332', '752020-08-03hari29harran@gmail.com.jpg', '66241bc233725aee89ddb9f22b571668', '3.823529411', 'Nil'),
(18, '2020-08-03', '5', 'KNMS School', 'Guntur', '2020-2021', 'hari29harran@gmail.com', '8', '3', '4', '3', '', '', '', '', '', '', '', '11.3434399,77.7332', '852020-08-03hari29harran@gmail.com.jpg', '4f62fec83c7b53292ca9c8f8ebf99ecd', '3.783783783', 'Nil'),
(19, '2020-08-03', '5', 'KNMS School', 'Guntur', '2020-2021', 'hari29harran@gmail.com', '9', '4', '4', '4', '', '', '', '', '', '', '', '11.3434399,77.7332', '952020-08-03hari29harran@gmail.com.jpg', '61348c2700e2d1dcd4c3f7f58f250fc0', '3.8', 'Nil');

-- --------------------------------------------------------

--
-- Table structure for table `general_feedback`
--

CREATE TABLE `general_feedback` (
  `id` int(11) NOT NULL,
  `district_name` varchar(50) DEFAULT NULL,
  `institution` varchar(100) DEFAULT NULL,
  `designation` varchar(10) DEFAULT NULL,
  `question1` varchar(2) DEFAULT NULL,
  `question2` varchar(2) DEFAULT NULL,
  `question3` varchar(2) DEFAULT NULL,
  `question4` varchar(2) DEFAULT NULL,
  `question5` varchar(2) DEFAULT NULL,
  `question6` varchar(2) NOT NULL,
  `question7` varchar(2) DEFAULT NULL,
  `question8` varchar(2) DEFAULT NULL,
  `question9` varchar(2) DEFAULT NULL,
  `question10` varchar(2) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_feedback`
--

INSERT INTO `general_feedback` (`id`, `district_name`, `institution`, `designation`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `question10`, `comments`, `rating`, `name`, `mobile`, `email`) VALUES
(1, 'Anantapur', 'The Peepal Grove School', 'Parent', '5', '4', '5', '5', '5', '5', '5', '5', '5', '5', 'Nil', '4.9', 'Hari', NULL, NULL),
(2, 'Anantapur', 'The Peepal Grove School', 'Teacher', '4', '4', '5', '3', '5', '5', '5', '4', '5', '5', 'Nil', '4.5', 'Hari', NULL, NULL),
(3, 'Anantapur', 'The Peepal Grove School', 'Student', '4', '3', '4', '3', '3', '3', '4', '4', '3', '1', 'Nil', '3.2', 'Hari', NULL, NULL),
(4, 'Anantapur', 'The Peepal Grove School', 'Parent', '5', '4', '5', '4', '5', '5', '4', '5', '5', '4', 'Nil', '4.6', 'Hari', NULL, NULL),
(5, 'Chittoor', 'Ap Model School', 'Parent', '5', '5', '5', '3', '5', '2', '5', '5', '1', '5', 'Nil', '4.1', 'Hari', NULL, NULL),
(6, 'Chittoor', 'Ap Model School', 'Teacher', '3', '3', '3', '3', '2', '2', '2', '5', '4', '4', 'nil', '3.1', 'Hari', NULL, NULL),
(7, 'Guntur', 'KNMS School', 'Parent', '3', '2', '5', '5', '4', '5', '2', '5', '5', '4', 'Nil', '4', 'Hari', NULL, NULL),
(8, 'Chittoor', 'Ap Model School', 'Student', '5', '5', '4', '3', '4', '4', '4', '4', '5', '4', 'Nil', '4.2', 'Hari', NULL, NULL),
(9, 'Guntur', 'KNMS School', 'Teacher', '5', '5', '5', '5', '5', '5', '5', '5', '4', '4', 'Nil', '4.8', 'Hari', NULL, NULL),
(10, 'Guntur', 'KNMS School', 'Student', '5', '5', '5', '5', '5', '4', '4', '4', '4', '4', 'Nil', '4.5', 'Hari', NULL, NULL),
(11, 'Guntur', 'KNMS School', 'Alumni', '5', '5', '5', '5', '5', '5', '2', '3', '4', '4', 'Nil', '4.3', 'Hari', NULL, NULL),
(12, 'Anantapur', 'The Peepal Grove School', 'Alumni', '5', '5', '5', '1', '1', '5', '3', '2', '3', '4', 'Nil', '3.4', 'Hari', NULL, NULL),
(13, 'Chittoor', 'Ap Model School', 'Alumni', '5', '5', '5', '5', '3', '5', '3', '5', '3', '3', 'Nil', '4.2', 'Hari', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `institution_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `certificate` varchar(100) DEFAULT NULL,
  `radius` varchar(11) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`institution_id`, `username`, `name`, `location`, `latitude`, `longitude`, `certificate`, `radius`, `district`) VALUES
(3, 'sample@gmail.com', 'The Peepal Grove School', 'Sadum', '11.127122499999999', '78.6568942', '1341423fe214', '0.5', 'Anantapur'),
(4, 'sample1@gmail.com', 'Ap Model School', 'Agaram', '11.3432374', '77.7329637', 'asd1232', '0.5', 'Chittoor'),
(5, 'sampleknms@gmail.com', 'KNMS School', 'Guntur', '11.3433686', '77.7331077', '26272jj288', '0.5', 'Guntur');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `institution_name` varchar(255) DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `academic_year` varchar(10) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `institution_name`, `rating`, `academic_year`, `district`) VALUES
(1, 'Ap Model School', '4.5432785584162', '2020-2021', 'Chittoor'),
(2, 'KNMS School', '3.9057530710592', '2020-2021', 'Guntur'),
(3, 'The Peepal Grove School', '3.6213713678223', '2020-2021', 'Anantapur');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `login_count` int(255) DEFAULT 0,
  `last_login` varchar(255) DEFAULT 'Not Yet Logged in',
  `login` varchar(255) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `type`, `name`, `login_count`, `last_login`, `login`, `photo`, `status`) VALUES
('hari29harran@gmail.com', '$2y$10$8b6Nacpl1xx09rJ82QN9vuBaJnb.QSS8gVN0nGB1gbn0Dz7ysNccK', 'Visiting Officer', 'Sri Hari Harran B', 72, 'Mon Aug 03 2020 13:26:32 GMT+0530 (India Standard Time)', 'Mon Aug 03 2020 13:59:47 GMT+0530 (India Standard Time)', 'hari29harran@gmail.com.jpg', 1),
('hoe', '$2y$10$BpZDTjNLUHl5fkuXzYuip.dFtmetlPEBRPwV/OyHIuEcHdeTBqRXq', 'Head of Education', 'Muruga', 118, 'Mon Aug 03 2020 13:09:22 GMT+0530 (India Standard Time)', 'Mon Aug 03 2020 14:21:25 GMT+0530 (India Standard Time)', 'hoe.jpg', 1),
('sample1@gmail.com', '$2y$10$tb0vGn/k10fnDfL8ZAA9yukbzyEl81iae0j6oV1O2p5htnhFSSNiu', 'Institution', 'Ap Model School', 5, 'Mon Aug 03 2020 00:14:11 GMT+0530 (India Standard Time)', 'Mon Aug 03 2020 08:28:24 GMT+0530 (India Standard Time)', 'sample1@gmail.com.jpg', 1),
('sample@gmail.com', '$2y$10$tb0vGn/k10fnDfL8ZAA9yukbzyEl81iae0j6oV1O2p5htnhFSSNiu', 'Institution', 'The Peepal Grove School', 7, 'Mon Aug 03 2020 14:07:51 GMT+0530 (India Standard Time)', 'Mon Aug 03 2020 15:05:29 GMT+0530 (India Standard Time)', 'sample@gmail.com.jpg', 1),
('sampleknms@gmail.com', '$2y$10$0N84UE.FUAJRfquNOZ50guOrlX.oV3CvJ48kzzucIsXoi1ult6h6S', 'Institution', 'KNMS School', 0, 'Not Yet Logged in', NULL, 'sampleknms@gmail.com.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_task`
--
ALTER TABLE `assign_task`
  ADD PRIMARY KEY (`institution`,`date`,`visiting_officer`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD UNIQUE KEY `criteria_id` (`criteria_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD UNIQUE KEY `district_id` (`district_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`date`,`institution_id`,`visiter_id`,`criteria_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `general_feedback`
--
ALTER TABLE `general_feedback`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`institution_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `certificate` (`certificate`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD UNIQUE KEY `rating_id` (`rating_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_task`
--
ALTER TABLE `assign_task`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `criteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `general_feedback`
--
ALTER TABLE `general_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `institution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
