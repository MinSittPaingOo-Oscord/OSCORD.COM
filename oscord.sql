-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2025 at 11:37 AM
-- Server version: 8.0.33
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oscord`
--

-- --------------------------------------------------------

--
-- Table structure for table `coursecategory`
--

CREATE TABLE `coursecategory` (
  `categoryID` int NOT NULL,
  `categoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursecategory`
--

INSERT INTO `coursecategory` (`categoryID`, `categoryName`) VALUES
(1, 'Popular'),
(2, 'Web Development'),
(3, 'Beginner'),
(4, 'Intermediate'),
(5, 'Advanced');

-- --------------------------------------------------------

--
-- Table structure for table `coursexcategory`
--

CREATE TABLE `coursexcategory` (
  `coursexcategoryID` int NOT NULL,
  `courseID` int NOT NULL,
  `categoryID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursexcategory`
--

INSERT INTO `coursexcategory` (`coursexcategoryID`, `courseID`, `categoryID`) VALUES
(1, 9, 2),
(2, 4, 2),
(3, 5, 2),
(4, 1, 3),
(5, 2, 3),
(6, 7, 3),
(7, 1, 1),
(8, 2, 1),
(9, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `fileID` int NOT NULL,
  `fileName` varchar(500) NOT NULL,
  `fileData` longblob NOT NULL,
  `courseID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oscord_course`
--

CREATE TABLE `oscord_course` (
  `courseID` int NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `courseDescription` varchar(500) NOT NULL,
  `courseFee` varchar(100) NOT NULL,
  `coursePeriod` varchar(100) NOT NULL,
  `courseFbLink` varchar(300) NOT NULL,
  `sort` int DEFAULT NULL,
  `coursePhoto` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oscord_course`
--

INSERT INTO `oscord_course` (`courseID`, `courseName`, `courseDescription`, `courseFee`, `coursePeriod`, `courseFbLink`, `sort`, `coursePhoto`) VALUES
(1, 'Java Programming (Basic to Advanced)', 'Kick off your Java programming adventure with our engaging course! Master core Java (J2SE) to craft robust programs, design sleek user interfaces with Java Swing, and build a real-world CRUD (Create, Read, Update, Delete) project using MySQL. Through hands-on projects, you’ll gain skills to develop dynamic applications and for creating your own software.', '500000 MMK', '4 months to 5 months', 'https://www.facebook.com/share/p/1FaCuNq5Ry/', 1, 'java.png'),
(2, 'Python Programming (Basic to Advanced)', 'Dive into Python programming with our engaging course, spanning from basics to advanced skills! Master Python’s syntax, data structures, and advanced concepts like object-oriented programming, while building a real-world CRUD (Create, Read, Update, Delete) project with a database.', '450,000 MMK', '4 months to 5 months', 'https://www.facebook.com/share/p/1BqQw7hadQ/', 2, 'python.png'),
(3, 'Database Systems and Design(MY SQL)', 'Learn how the database management system works , how to design a physical database starting from Conceptual database design and Logical database design, using it in application', '280000 MMK', '3 months', 'https://www.facebook.com/share/p/1KHJnBkWwA/', 5, 'database.png'),
(4, 'Frontend Web Development', 'Kickstart your front-end web development journey with our beginner-friendly course! Learn to create stunning, interactive websites using HTML, CSS, Bootstrap and JavaScript. Through hands-on projects, you’ll build responsive web pages that shine on any device, gaining skills to launch a tech career or bring your ideas to life. All you need is basic computer knowledge and a passion for design!', '280000 MMK', '3 months', 'https://www.facebook.com/share/p/179GHoiCVL/', NULL, 'frontend.png'),
(5, 'Backend Web Development', 'Launch your backend web development career with our beginner-friendly course! Learn to build powerful, secure server-side applications using tools like PHP and databases like MY SQL. Through hands-on projects, you’ll  manage data to power dynamic websites, gaining skills for a tech job or your own projects. As for the requirement you will need frontend web skills and a curiosity for how websites work behind the scenes!', '400000 MMK', '3 months', 'https://www.facebook.com/share/p/179GHoiCVL/', NULL, 'backend.png'),
(6, 'Desktop Application Developmet with C#.Net(Basic to Advanced)', 'Join Our C#.NET Fundamentals Course!  Master C# programming from scratch and build practical desktop apps for businesses, like POS or inventory systems, in just 3-4 months! With one-on-one Zoom or in-person classes, hands-on projects, this course is perfect for beginners and aspiring developers.', '399000 MMK', '3 months to 4 months', 'https://www.facebook.com/share/p/1AQNx1RBEt/', 6, 'chref.png'),
(7, 'C Programming', 'Learning programming with C from basic easily and focusing on basic programming concepts', '250000 MMK', '2 months', 'https://www.facebook.com/share/p/1D5W1k541w/', NULL, 'c.png'),
(8, 'C ++ Programming', 'In this course, you will learn the basic programming concepts with C++ Programming', '200000 MMK', '2 months', 'https://www.facebook.com/share/p/1D5W1k541w/', NULL, 'c++.png'),
(9, 'Full Stack Web Developer Class', 'Web Development ကိုအခြေခံ Frontend Level မှစ၍ Backend Development Level မှာ Database ဖြင့် လုပ်ငန်းခွင်မှာအသုံးပြုနေတဲ့ Web Project များရေးသားနိုင်သည်အထိ Core Theory များနှင့်တကွ လက်တွေ့သင်ခန်းစာများကိုပါထည့်သွင်းသင်ကြားသွားမှာဖြစ်ပါတယ်', '570000 MMK', '6 months', 'https://www.facebook.com/share/p/179GHoiCVL/', 3, 'fullStack.png'),
(28, 'Data Structure and algorithms', 'Explore coding with our beginner-friendly Data Structures and Algorithms course! Learn to organize data, solve problems, and write efficient code through hands-on projects. Perfect for landing tech jobs or acing coding interviews. All you need is basic programming knowledge!', '270000 MMK', '3 months', 'https://web.facebook.com/permalink.php?story_fbid=pfbid02mUS2Vn7ABUoaYEp6pnPrxbcaZaJoJxJ1UoTSKorxisBVp5SzWiiE1a3vuPCF58fl&id=100088520077343', 5, 'dsa.png'),
(29, 'Applied Mathematics for Data Science & Machine Learning with Python', 'Data Science/ Machine Learning နှင့် AI နည်းပညာတွေကို အဓိက ကူညီပံ့ပို့းပေးနေတဲ့ သင်္ချာပညာ Theoryတွေကို Computer Science ရူထောင့်ကနေ သင်ကြားမှာဖြစ်ပါတယ်\r\nModule တစ်ခုပြီးတိုင်း theory များကို Python Programming ကိုအသုံးပြုပြီးတော့ လက်တွေ့အသုံးချသွားမှာဖြစ်ပါတယ်\r\nဒီ Course မှာ သင်္ချာပညာရပ်ဟာ Computer Science နယ်ပယ်မှာဘယ်လောက်ထိအရေးပါလဲဆိုတာကို လက်တွေ့ Code ရေးပြီးသင်ကြားသွားမှာဖြစ်ပါတယ်', '330000 MMK', '4 months to 5 months', 'https://www.facebook.com/share/p/1ZGd7qTMAR/', 4, 'math.png'),
(30, 'Full Stack Revolution with React & Laravel', 'Master full-stack development with React and Laravel in this hands-on course. Learn React fundamentals, hooks, Redux, and API integration, paired with Laravel’s MVC, Eloquent ORM, and RESTful APIs. Build a task management system while exploring security with Sanctum, JWT, and role-based access. Ideal for advanced learners aiming to create modern, scalable web applications.', '440000 MMK', '3 months', 'https://www.facebook.com/share/p/1EsM6VaMvQ/', 4, 'revolution.png'),
(31, 'Data Science Essential', 'Data Science ကိုစတင်လေ့လာမည့်သူများအတွက် Data Science ကိုအခြေခံမှစ၍ သိသင့်သိထိုက်သော Foundational Core Theory များကို ဒီ Course မှာသင်ကြားသွားမှာဖြစ်ပါတယ်\r\n Machine Learning / Aritificial Intelligence သင်ယူမယ့်သူတွေအနေနဲ့လည်းအထူးသင့်တော်ပါတယ်', '270000 MMK', '3 months', 'https://www.facebook.com/share/p/1DHff8nssF/', 4, 'dataScience.png');

-- --------------------------------------------------------

--
-- Table structure for table `oscord_coursedetail`
--

CREATE TABLE `oscord_coursedetail` (
  `coursedetailID` int NOT NULL,
  `coursedetailName` varchar(200) NOT NULL,
  `courseID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oscord_coursedetail`
--

INSERT INTO `oscord_coursedetail` (`coursedetailID`, `coursedetailName`, `courseID`) VALUES
(1, 'Introduction to Java Programming', 1),
(2, 'Variable and datatypes', 1),
(3, 'Datatype Conversion', 1),
(4, 'Operators in Java', 1),
(5, 'User Input in Java', 1),
(6, 'Decision Making and Conditional Statement', 1),
(7, 'Loopings in Java', 1),
(8, 'Functions in Java', 1),
(9, 'Object Orientend Programming in Java', 1),
(10, 'Character, String & StringBuffer Class', 1),
(11, 'Exception Handling', 1),
(12, 'File Handling in Java(IO)', 1),
(13, 'Utility and collection classes', 1),
(14, 'GUI with Java AWT', 1),
(15, 'GUI with Java Swing', 1),
(16, 'Database Systems and Design', 1),
(18, 'Introduction to Python Programming', 2),
(19, 'Variables and Datatypes', 2),
(20, 'Type Conversion', 2),
(21, 'Operators in Python', 2),
(22, 'Python String', 2),
(23, 'Turtle Graphics - Illustration simple graphic of Python', 2),
(24, 'Conditional Statments', 2),
(25, 'Loopings in Python', 2),
(26, 'Python core datatypes - Tuple, List, Set, Dictionary', 2),
(27, 'File Handling in Python', 2),
(28, 'Object Oriented Programming', 2),
(29, 'Exception Handling & Multithreading', 2),
(30, 'GUI Toolkit Libraries for Python - tkinter', 2),
(31, 'Conceptual Database Design', 3),
(32, 'Logical Database Design', 3),
(33, 'Normalization Project', 3),
(34, 'Physical Database Design', 3),
(35, 'Structure query language(DML, DDL, DCL, TCL)', 3),
(36, 'Calculating Statement in query language', 3),
(37, 'MY SQL Functions', 3),
(38, 'Querying Multiple tables', 3),
(39, 'Database System Environment using AWARDSPACE', 3),
(40, 'CRUD Control Flow with PHP', 3),
(41, 'CRUD Web Application Project', 3),
(42, 'HTML', 4),
(43, 'CSS', 4),
(44, 'JavaScript', 4),
(45, 'JQuery', 4),
(46, 'Bootstrap', 4),
(47, 'Introduction to PHP Programming', 5),
(48, 'Variable And Datatypes in PHP', 5),
(49, 'Datatype Conversion', 5),
(50, 'Operators', 5),
(51, 'Use of $_GET and $_POST in PHP', 5),
(52, 'Conditional Statment & Decision Making in PHP', 5),
(53, 'Loopings', 5),
(54, 'Array in PHP', 5),
(55, 'Function in PHP', 5),
(56, 'OOP', 5),
(57, 'Exception Handling', 5),
(59, 'Database Systems and Design (MY SQL)', 5),
(60, 'Laravel Framework', 5),
(61, 'Complete C# Language', 6),
(62, 'Introduction to C#.Net Framework - adding control to a blank form', 6),
(63, 'Adding C# code to a button', 6),
(64, 'A C# Messgage Box', 6),
(65, 'Assigning Text to a string variable', 6),
(66, 'Getting Numbers from text boxes', 6),
(67, 'Conditional Logic in C#.Net', 6),
(68, 'Checking blank text boxes in C#', 6),
(69, 'Adding menus to window forms', 6),
(70, 'File Dialogue Boxes in C#.Net', 6),
(71, 'Checkboxes and Radio Buttons', 6),
(72, 'Creating Multiple Forms in C#.Net', 6),
(73, 'Dates and Times in C#', 6),
(74, 'Final Desktop Application Project', 6),
(75, 'Basic Knowledge with C Programming', 7),
(76, 'Vraibles and Datatypes', 7),
(77, 'User Input and Operators in C', 7),
(78, 'Conditional Statments', 7),
(79, 'Looping and Functions', 7),
(80, 'Arrays & Pointers', 7),
(81, 'C String', 7),
(82, 'Basic Knowledge with C++', 8),
(83, 'Variables and Datatypes', 8),
(84, 'User Input & Operators', 8),
(85, 'Conditional Statements', 8),
(86, 'Loopings', 8),
(87, 'Arrays', 8),
(88, 'C++ Structure', 8),
(89, 'C++ Enums', 8),
(90, 'C++ Functions', 8),
(100, 'OOP in C++', 8),
(101, 'HTML', 9),
(102, 'CSS', 9),
(103, 'JavaScript (Basic to Advanced)', 9),
(104, 'Boostrap', 9),
(105, 'Database Systems and Design (MY SQL) - complete course', 9),
(106, 'PHP Programming (Basic to Advanced)', 9),
(114, 'CRUD Final Project', 1),
(115, 'CRUD Final Project', 2),
(117, 'Introduction to DSA', 28),
(118, 'Array and Linked List', 28),
(119, 'Stack and Queues', 28),
(120, 'Binary Trees and Binary Search Trees', 28),
(121, 'AVL and B-Trees', 28),
(122, 'Graph Algorithms', 28),
(123, 'Algorithm Design Techniques', 28),
(124, 'Sorting and Searching Algorithms', 28),
(125, 'Hash Table', 28),
(127, 'Final CRUD Web Application Project', 5),
(128, 'Introduction to Laravel Framework', 9),
(129, 'Physical Database Design', 6),
(130, 'CRUD Project with Database', 6),
(131, 'Introduction - How Math can shape Multiverse', 29),
(132, 'Boolean Logic & Propositional Calculus', 29),
(133, 'Set Theory & Relations', 29),
(134, 'Proof Techniques', 29),
(135, 'Graph Representation', 29),
(136, 'Trees', 29),
(137, 'Graph Processing Techniques', 29),
(138, 'Modular Arithmetic', 29),
(139, 'Prime Numbers & GCD', 29),
(140, 'Cryptography', 29),
(141, 'Hash Functions', 29),
(142, 'Algorithms Basics', 29),
(143, 'Sorting & Searching Algorithms', 29),
(144, 'Recursion & Divide & Conquer', 29),
(145, 'Vectors & Matrices', 29),
(146, 'Systems of Linear Equations', 29),
(147, 'Eigenvalues & Eigenvectors', 29),
(148, 'Singular Value Decomposition (SVD)', 29),
(149, 'Probability Basics', 29),
(150, 'Distributions', 29),
(151, 'Basic of Counting', 29),
(152, 'Permutations & Combinations', 29),
(153, 'Advanced Counting Technique', 29),
(154, 'Final Math in Action Project', 29),
(155, 'Introduction to React', 30),
(156, 'React ES6', 30),
(157, 'JSX basics', 30),
(158, 'Functions and Classes', 30),
(159, 'State and Events', 30),
(160, 'Lists and Keys', 30),
(161, 'Forms and Controlled Components', 30),
(162, 'React Router', 30),
(163, 'React Hooks', 30),
(164, 'use Effect and API calls', 30),
(165, 'Context API', 30),
(166, 'Custom Hooks', 30),
(167, 'Advanced Hooks', 30),
(168, 'Tools : Redux or Zustand', 30),
(169, 'Security Features', 30),
(170, 'Introduction to Laravel', 30),
(171, 'Routing and Controllers', 30),
(172, 'Models and Migrations', 30),
(173, 'Basic CRUD Operations', 30),
(174, 'Query Builder Introduction', 30),
(175, 'Advanced Query Builder', 30),
(176, 'Eloquent ORM Introduction', 30),
(177, 'Advanced Eloquent', 30),
(178, 'Building RESTful APIs', 30),
(179, 'API Resources and Transformers', 30),
(180, 'Authentication with Sanctum', 30),
(181, 'JWT Authentication', 30),
(182, 'Middleware Basics', 30),
(183, 'Advanced Middleware and Security', 30),
(184, 'Roles and Permissions', 30),
(185, 'Role-Based Access', 30),
(186, 'Introduction to Data Science', 31),
(187, 'Distance & Similarity', 31),
(188, 'Data', 31),
(189, 'Finding Missing Value in Data Cleaning', 31),
(190, 'Standardization & Normalization', 31),
(191, 'Distance in Clustering', 31),
(192, 'Hierarchical Clustering', 31),
(193, 'K-Means Clustering', 31),
(194, 'DB Scan Clustering', 31),
(195, 'Clustering Evaluation', 31),
(196, 'Associative Rule Mining', 31),
(197, 'Supervised Machine Learning', 31),
(198, 'ID3, Outlook, C4.5 Classifier, Gini Index', 31),
(199, 'Correlation Coefficient', 31),
(200, 'Simple CRUD Project', 9),
(201, 'How to do website deployment', 9),
(202, 'Final Web Application Project', 9);

-- --------------------------------------------------------

--
-- Table structure for table `oscord_instructor`
--

CREATE TABLE `oscord_instructor` (
  `instructorID` int NOT NULL,
  `instructorName` varchar(50) NOT NULL,
  `instructorEmail` varchar(50) NOT NULL,
  `instructorPassword` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `instructorApprove` tinyint NOT NULL,
  `instructorBirthday` date NOT NULL,
  `instructorPhone` varchar(15) NOT NULL,
  `instructorPin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oscord_instructor`
--

INSERT INTO `oscord_instructor` (`instructorID`, `instructorName`, `instructorEmail`, `instructorPassword`, `instructorApprove`, `instructorBirthday`, `instructorPhone`, `instructorPin`) VALUES
(12, 'Min Sitt Paing Oo', 'minsittmandalay137@gmail.com', '$2y$10$JFRNzEuByXBDKXDh8cSTb.AyoUTk99ApZlk0AzamSqh/sY88q3zaO', 1, '2004-06-30', '0823059272', 198989),
(15, 'Lin Khant', 'linkhant1092003@gmail.com', '$2y$10$vXw8lPL7dN4jXub5An54dOHULNuFdlfDxSTh6SYrtIc8oaIHuxq4W', 1, '2003-09-10', '09259662272', 112233),
(16, 'Iris Everly', 'asheijidaiharuwin@gmail.com', '$2y$10$x/ihHjYCInXLWb5Jqe1KYuiIRXbnP9L/Ws9ukdU8kkIOeDde1sO.a', 1, '2002-09-27', '09757220152', 272799),
(17, 'Kaung Si Thu', 'kst2022@icloud.com', '$2y$10$QYOxy3x9avTDjGUXHSpTpe8ltW5K0iXRIUtQccbZODmiYQ.1AZlzG', 1, '2003-11-06', '0641385441', 666666);

-- --------------------------------------------------------

--
-- Table structure for table `oscord_instructorxcourse`
--

CREATE TABLE `oscord_instructorxcourse` (
  `instrucorxcourseID` int NOT NULL,
  `instructorID` int NOT NULL,
  `courseID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oscord_instructorxcourse`
--

INSERT INTO `oscord_instructorxcourse` (`instrucorxcourseID`, `instructorID`, `courseID`) VALUES
(28, 12, 1),
(29, 12, 2),
(30, 12, 3),
(31, 12, 5),
(32, 12, 6),
(35, 12, 9),
(36, 12, 7),
(37, 12, 8),
(48, 15, 4),
(49, 15, 9),
(53, 16, 28),
(54, 16, 6),
(55, 17, 5),
(56, 17, 9),
(58, 12, 29),
(60, 12, 31),
(62, 12, 4),
(63, 12, 28),
(64, 12, 30);

-- --------------------------------------------------------

--
-- Table structure for table `oscord_student`
--

CREATE TABLE `oscord_student` (
  `studentID` int NOT NULL,
  `studentName` varchar(50) NOT NULL,
  `studentCountry` varchar(50) NOT NULL,
  `studentBirthday` date NOT NULL,
  `studentEmail` varchar(100) NOT NULL,
  `studentPassword` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `studentTelegram` varchar(100) NOT NULL,
  `studentPhone` varchar(50) NOT NULL,
  `studentApprove` tinyint(1) NOT NULL,
  `question1` longtext NOT NULL,
  `question2` longtext NOT NULL,
  `registrationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oscord_student`
--

INSERT INTO `oscord_student` (`studentID`, `studentName`, `studentCountry`, `studentBirthday`, `studentEmail`, `studentPassword`, `studentTelegram`, `studentPhone`, `studentApprove`, `question1`, `question2`, `registrationDate`) VALUES
(10, 'Aeint', 'Myanmar', '2005-04-10', 'aeintthinzarzawmyint@gmail.com', '$2y$10$OR7K/U3EdP/BOcbx7vsGqOCa9UQkq1wKXwFYgslF/mJfMVIEMg7Hq', '@n_iaeintmm', '09408811141', 1, 'No', 'I want to be a software developer', '2025-05-28'),
(15, 'Phyu Phyu Thant', 'Myanmar', '2004-09-29', 'phyuphyut119@gmail.com', '$2y$10$kEpauazSkHHm0FYnxPrfFukUWt5AMTxZRSR9vqn4MYgL.T1Rw3dyG', '@t92nt', '09886058500', 1, 'Java & web development course', 'Aimed to understand the basic knowledge in computer science.', '2025-06-12'),
(16, 'NAING NINE', 'Japan', '2002-05-25', 'naingosaka121212@gmail.com', '$2y$10$9.5xgNBS4nr6c6.gTMHm/uoWAkUkWNTiQ1Nh/mMONe5BA/IAtD5Am', 'eccnn9898', '07091423223', 0, 'No', 'I’m going to an IT college next year.', '2025-06-14'),
(17, 'Merry Moe', 'Thailand', '1984-01-13', 'merrymoe345@gmail.com', '$2y$10$CTtp2X.F/aQc0KnODzs5Ju5.0RjHqRlHEjzD/o/hXs1wtnr7itypG', '@merrymoe', '9952090401', 1, 'No', 'For my job', '2025-06-14'),
(18, 'Naw The\' Phyu', 'Thailand', '1994-02-14', 'nawthephyu@gmail.com', '$2y$10$OFxjZtRj5Jj8IaMFU.WVwejJw47/MCaU4UZcp5zirLwhXQ8LPdY22', '@Charoen_Rasamee', '+66613607287', 1, 'No experience of learning the program', 'I intent to create or build up the pharamacy database and application for pharmacy management system of my organization.', '2025-06-14'),
(19, 'Phoo Myat Thwe', 'Myanmar', '2004-06-14', 'phoomyatthwe@gmail.com', '$2y$10$Po4ZFqJqSL4AzgBG7K8GR.9OeRvD.cTitNE/r4gWlMosDHQUJJfR6', '@H_ffe9ef', '09778654804', 1, 'I used to learn C Programming', 'I am interested in software engineering I guess. Programming is a part of it and another fact is I like to code.', '2025-06-14'),
(20, 'Janet', 'Sweden', '1996-09-06', 'nawjanet16@gmail.com', '$2y$10$w4kGsEvF0tLFk/lrnbNM/uEsSetwmMuyjvmh7zeLzF0yh4esw3HzG', 'NJ', '+46733620774', 1, 'Java basic', 'For career change', '2025-06-14'),
(21, 'Phyo Zin May', 'Japan', '1996-01-15', 'phyozinmay@gmail.com', '$2y$10$LVKCg6moivg0J/4RogZVleq3qu29OlKeb2OtYpLIpHHs8V8.xQmiK', '@Snowie_e', '+959250269248', 1, 'No experience about learning java', 'Because want to get job', '2025-06-15'),
(22, 'San Lin Bay', 'Thailand', '1995-06-15', 'sanlinbay@gmail.com', '$2y$10$KoKC6Gdw7YGXCIR6Wo2qoONbyxljlDX8bfmaxGcDTBgdsp8kQWQO6', '@Sanlinbay', '0656506242', 1, 'Never learned program before', 'To improve my IT skill. To promote my skills working with organization. Because I interest in IT programing.', '2025-06-15'),
(23, 'Nyi Nyi Htet', 'Singapore', '1988-06-15', 'nyinyihtet@gmail.com', '$2y$10$QohiVYZ4XjRfg/gEvOXbkOCDXtaovmNfPCpi2S7cDASWM8EZnnfay', '@nyinyihtet', '+6581618011', 1, 'No', 'Interested in Programming', '2025-06-15'),
(24, 'Hein Htet', 'Singapore', '1998-02-15', 'heinhtet@gmail.com', '$2y$10$pvFSLq2LF8jc65FbWxl7keYgnmT1NHPkGuE5WB0YVI5rddurEjYyO', '@henry845879', '+66824762618', 1, 'No', 'Interested and Want to try', '2025-06-15'),
(25, 'Phoo Myat Thwe', 'Myanmar', '2004-06-15', 'phoomyatthwe@gmail.com', '$2y$10$jLoimAswxCcA0tt32Mo75OY0UsLApONF7ardePExYr47XFyJ8RHMS', '@H_ffe9ef', '09778654804', 1, 'I used to learn C Programming', 'I am interested in software engineering I guess. Programming is a part of it and another fact is I like to code.', '2025-06-15'),
(26, 'Nay Lin Thar', 'Myanmar', '1998-06-10', 'naylinthar@gmail.com', '$2y$10$Z2USUVsB9ukyUjxV8iODGO1F/D45v4KGEuBkdaQhDgdIQDGUwb4wy', '@ellegigle', '09785925304', 1, 'No', 'Because I am interested', '2025-06-15'),
(27, 'Nan May OO Myint', 'Singapore', '1990-06-15', 'naymayoomyint@gmail.com', '$2y$10$665I1P8ZBm5IPPHT0jmW4.bgnxzNNQUpyXgqJChpp0iR.bpPaqP42', '@nanmayoomyint', '+6591455714', 1, 'Totally Zero', 'wanna learn about the coding and recommended by friend', '2025-06-15'),
(28, 'So Pyay', 'Singapore', '1990-06-22', 'sopyay@gmail.com', '$2y$10$eLXm0hyrzB0FyJOQAZRpUugRm/k1jR7LYi8bFYEcVMWGequBE0aSG', '@sopyay', '+6598613482', 1, 'No', 'Application for script programming automation machines', '2025-06-15'),
(29, 'Zayar Oo', 'Singapore', '1979-06-18', 'zayaroo@gmail.com', '$2y$10$RlKD7Y1S03zEMnAs9a15JO3q.3puJfe.ecBnWC4Ts9XScenvN6/6y', '@zayaroo', '+6597247756', 1, 'not learn before programming.', 'null', '2025-06-15'),
(30, 'Thaw Zin Latt', 'Myanmar', '2008-06-15', 'thawzinlatt@gmail.com', '$2y$10$SWfe3YE3sLzfQBhqpS8Fs.TCkJuldbas2WPd7OlyohFQQRCtDd53e', '@thawzinlatt', '+959967993562', 1, 'Programming not learn before', 'null', '2025-06-15'),
(31, 'Pyae Hein', 'Kuweit', '1984-02-15', 'pyaehein@gmail.com', '$2y$10$6gzCqOxRfoMzECby8ANfXu4PuZQOj4ka5xxNxZQ/65bQslYCLma7W', '@pyaehein', '+96596645418', 1, 'Programming အတန်းတွေ တက်ဖူးပါတယ်။ Group အတန်းတွေမှာ စာမလိုက်နိုင်လို့ အစပိုင်းပဲတက်ပြီး ရေရှည် မတက်ဖြစ်ခဲ့ပါဘူး ဆရာ။ သင်တန်းတွေ Join ခဲ့ပေမဲ့ သေချာမလေ့လာခဲ့ပါဘူး ဆရာ။ အခြေခံတောင် နားမလည်သေးပါဘူး ဆရာ။', 'Programming ကို သေချာနားလည် တတ်ကျွမ်းဖို့ လိုအပ်နေလို့ပါ ဆရာ။', '2025-06-15'),
(32, 'Aye Nadi Kyaw', 'Myanmar', '1984-06-15', 'ayenadikyaw@gmail.com', '$2y$10$s7KNa08u6SJ.RYVBpTW//uHSzIincQThpS1CyFHRgmaXYW2CHvxV.', '@ayenadikyaw', '09428939200', 1, 'Yes', 'I would like to work in Japan. I would like to know Java Advanced lavel and want one by one class.', '2025-06-15'),
(33, 'Zaw Thura Soe', 'Myanmar', '2007-02-15', 'zawthurasoe@gmail.com', '$2y$10$waykhJsleh6cDFM1jNHTTe3tPZg3sBOz73tGYn1/YLqgSydyT0AOO', '@zatthuras', '09449536467', 1, 'Python Basic တွေ အကုန် သင်ဖူးပါတယ်ဗျ Jupyterနဲ့ပါ VsCode ကို မကျွမ်းကျင်သေးပါဘူး', 'စိတ်ဝင်စားလိုပါဗျ လုပ်နေရရင် မပျင်းတော့ဘူး GCSE ဖြေရင်လည်း Computer sci ယူမှာမလိုဗျ ခု လောလောဆယ် သင်နေတဲ့ Class က 4 လလောက် နားမှာမို တခြား အသစ်တွေ သင်ချင်လိုတက်တာပါဗျ', '2025-06-15'),
(34, 'Christopher', 'America', '1989-06-21', 'christopher@gmail.com', '$2y$10$OhER14Ugyj9VBCErMParAuvE5gWGgf9VRJ4xfaRx.yl2EiJwjD/Ty', '@christopher', '+14435099545', 1, 'null', 'null', '2025-06-15'),
(35, 'Bhone Wai Yan Moe', 'Vietnam', '2004-01-15', 'bhonewaiyan@gmail.com', '$2y$10$7dghyoC0UghyVcW56Yixbe6.Ik9XnYkx3HFR2a4XCkAAMkqWzQqU.', '@bhonewaiyan', '09420065505', 1, 'Programming fundamental with javaသင်ဖူးပါတယ်', 'ITနဲ့ပါတ်သတ်တဲ့ career နဲ့ ရှေ့ဆက်ချင်တာရယ် ဝါသနာပါတာရယ်ကြောင့်ပါ', '2025-06-15'),
(36, 'Myat Min Thu', 'Myanmar', '1995-02-15', 'myatminthu@gmail.com', '$2y$10$2qznObz36sEN8lHfTQb9n.6nMgbH31dHnc09f0wu3eKrSVQ0jec.q', '@myatminthu', '09974102510', 1, 'Programming ကို YouTubeက  အခုမှလေ့လာခါစပဲ ရှိပါသေးတယ် တလတောင်မပြည့်သေးပါ', 'ငယ်ငယ်ထဲက IT ကို အရမ်းစိတ်ဝင်စားခဲ့တာပါ 10 တန်းအောင်တော့လဲ အမှတ်မမှီခဲ့လို POL က  Cyber City တက်ချင်ခဲ့တဲ့အိမ်မက်က မပြည့်ဝခဲ့ပါဘူး ကိုယ့်ဘဝ ရဲ့ Carrier ကိုလဲ IT နယ်ပယ်ထဲမာပဲ ဖြတ်သန်းချင်လိုပါဗျ', '2025-06-15'),
(37, 'Hnin Kabyar Tun', 'Thailand', '2000-06-15', 'hninkabyartun@gmail.com', '$2y$10$CYwyfZIp5n6LnUXtQ6ePuOTZVIPj2GrIRDdBUw7exIM9ydVei.9RC', '@hninkabyartun', '+66949611269', 1, 'null', 'null', '2025-06-15'),
(38, 'YaMin', 'Japan', '1989-06-15', 'yamin@gmail.com', '$2y$10$vsWNAmQ5RffcO9HanJgB.OfN8tGesIr9Qadw7ge9LLCPTxM/ZgUBi', '@yamin', '+817041269937', 1, 'null', 'null', '2025-06-15'),
(39, 'Htoo Aung Cho', 'Korea', '1998-06-15', 'htooaungcho@gmail.com', '$2y$10$gBK9z6mGPKwxGAaa4DAVruCL6OU6iiqabvQnbzKGIRsPujByyu4Uq', '@HAungC', '+821073929907', 1, 'Yes', 'For school', '2025-06-15'),
(40, 'Moe Theigi Kyaw', 'Myanmar', '2005-06-15', 'moetheigikyaw@gmail.com', '$2y$10$OJ1TC7Q2pfCLbt3VTriMau5mH3gyK7lcyFIFpfVkdEXkYMykYq08G', '@moetheigikyaw', '09954872198', 1, 'yes', 'ဒဂုံတက္ကသိုလ်မှာ computer science majorဖြင့်  2nd yearကျောင်းသူဖြစ်ပြီး javaကို ပိုမိုသေချာနားလည်သဘောပေါက်စေရန်', '2025-06-15'),
(42, 'Naing Soe Ag', 'Thailand', '1997-06-15', 'naingsoeag@gmail.com', '$2y$10$SXnbkNJ0298I9SNTaI4gpOvBE89Gxn0NlshuDoKRt3PRqSW/8ZV9.', '@naingsoeag', '07091779006', 1, 'null', 'null', '2025-06-15'),
(43, 'Thiha Min Htin', 'Myanmar', '2000-06-15', 'thiha@gmail.com', '$2y$10$jf9PUFiEPDkedTpkB6ze1OwriRoisxDineT4rpKaF1qxalm3M7uE6', '@thiha', '09957316840', 1, 'null', 'null', '2025-06-15'),
(44, 'Aye Myat Mon', 'Myanmar', '2002-02-15', 'ayemyatmon@gmail.com', '$2y$10$blA40.5K7zAd1mwgHQIrqOdrHbIpYGaHCDjUt2B1XndMBrjoqYZkS', '@ayemyatmon', '09790341692', 1, 'I have learned the Programming Language', 'To become a professional programmer', '2025-06-15'),
(45, 'Khin LaPyae Won', 'Thailand', '2003-02-15', 'khinlapyawwon@gmail.com', '$2y$10$B3bLvK7Qcy1uBKh2cWdXuuc9NaVM3Dg1E/UzVsgb4cloMSIaNwrNi', '@khinlapyae', 'null', 1, 'Yes', 'Want to study Java Programming well', '2025-06-15'),
(46, 'YaMin Oo', 'Thailand', '2003-02-15', 'yaminoo@gmail.com', '$2y$10$.MUq0ju0Ls5t7U1Md9/5ze6nkTZQJ8/QvxTeqtHBH.3KZ.6MvJduC', '@yaminoo', 'null', 1, 'yes', 'Interested in Programming', '2025-06-15'),
(47, 'Shwe Zin', 'Myanmar', '1997-06-15', 'shwezin@gmail.com', '$2y$10$8auo.corWoFJSPQlfZxxcO23hR3Glvs1Qw7BA01JIUQf4yGesDFIS', '@shwezin', 'null', 1, 'null', 'null', '2025-06-15'),
(48, 'Sandah Aung', 'Thailand', '1977-06-15', 'sandahaung@gmail.com', '$2y$10$HR.zUV95M1Bq6QVAG0X7leVv8xsKa0uiPpoO47o4KP67NfyWRbX8C', '@sahdahaung', 'null', 1, 'yes', 'for job', '2025-06-15'),
(49, 'Min Thant Wai', 'Thailand', '1999-06-15', 'minthantwai@gmail.com', '$2y$10$AMFvWSeR7o45lnmRbQX5SuD8dWVihIXTKxLaQMlwUyfcpqDL8RAHm', '@minthantwait', 'null', 1, 'null', 'null', '2025-06-15'),
(50, 'Myat Min Thu', 'Singapore', '1986-02-15', 'myatminthu@gmail.com', '$2y$10$V4wkUiavP12GDxLl4mwb6ueYD4taIiBh2SbBs3X5IrBjKla.GhIfG', '@myatminthu2', '+65908773784', 1, 'a little', 'java programming ကို ပိုပီး နားလည်ပီး ရေးတတ်ချင်လိုပါ', '2025-06-15'),
(51, 'N Seng', 'Thailand', '1989-06-15', 'nseng@gmail.com', '$2y$10$mcsvHXfEUWudqgn6vTlWWeZ4V8/cyVnwmlTHIu4jprtDfHiWHCLiS', '@nseng', 'null', 1, 'null', 'null', '2025-06-15'),
(52, 'Thun Thiri Khin', 'Thailand', '2006-06-15', 'thunthirikhaing@gmail.com', '$2y$10$qZoJTPXLb6wOBk4xg36V1.3X23XywLeci5MDtKj3wFMcjAUli55O6', '@thunthirikhaing', '09769889233', 1, 'Has experienced in C and Java Programming', 'Want to be professional in JAva', '2025-06-15'),
(53, 'Okkar Min', 'Thailand', '2001-02-15', 'okkarmin@gmail.com', '$2y$10$j/1nEq9/FtUbZGBgkU7ISOL21TAM5Henx9BAXSoKBzjxMTBGzkl..', '@okkarmin', '0960564932', 1, 'No', 'To know python very well/ to know basics of programming and to prepare for exam', '2025-06-15'),
(54, 'Khon LaYaung Win', 'Myanmar', '2000-01-15', 'khonlayaungwin@gmail.com', '$2y$10$TVqvja46gxUgUZJgOcOMee0msFTSwhSTbqhUHiz/pMmrllORZFYFi', '@LeonLY7', 'null', 1, 'null', 'null', '2025-06-15'),
(55, 'Honey Aye', 'Japan', '1993-06-15', 'honeyaye@gmail.com', '$2y$10$sqNEs5hRgrypSDSDaJUeRetst7jnGf2atYh47mcdZCIO/zzQ96iH2', '@honeyaye', '+817084522233', 1, 'no', 'အလုပ်အတွက်အထောက်အကူပြုရန်', '2025-06-15'),
(56, 'Thet Oo Ag', 'Thailand', '2001-01-15', 'thetooag@gmail.com', '$2y$10$Vpx3/yDWeh1lgIXdjBdt1uvanp3SQ9VwXDFO63.E.JVy7bx9/jLlK', '@thetooag', '+959698949363', 1, 'no', 'for new career', '2025-06-15'),
(57, 'Min Khant', 'Japan', '2004-01-15', 'minkhant@gmail.com', '$2y$10$REDPng1Ph2QDOx.FX59r/edwpnyosII6rZ/a0WycxZE.1F7AUjkoW', '@minkhant', '09070057005', 1, 'အရင်ကprogramming မလေ့လာဘူးပါဖူးခင်ဗျ', 'College ၄လပိုင်းစတက်ရတော့မှာမလိုprogramming အထိတွေ့မရှိတာကြောင့်သင်တန်းကောင်းကောင်းနဲ့ကြိုသင်ထားချင်တာနဲ့ဆရာ့ဆီရောက်လာတာပါ', '2025-06-15'),
(58, 'Htay Linn Kyaw', 'Myanmar', '2002-03-30', 'htaylinaung.wka@gmail.com', '$2y$10$yPlt5v5p4sL2Zw25d.Zr3eLtQ2zFHpkcXwqBtIRfb7AFsUEtYqMZe', '경수', '01084209991', 1, 'Yes', 'Python', '2025-06-18'),
(59, 'Wai Yan Htet Naing', 'Thailand', '1990-02-05', 'waiyanhtetnaing2020@gmail.com', '$2y$10$jRtQaxpYKjBJnA0EAFHVc.LIvbqBLH9DtNWEeVN2D9ItV0Oqp4nV.', 'RhythmR_Kee Nolan', '09420015800', 1, 'I haven\'t learned any programming languages before.I\'m someone interested in teachnology and just starting to learn the basics.', 'Firstly, I\'m interested in technology. Secondly, I want to have better career opportunities in the future. Thirdly, I\'d like to master it as a subject.', '2025-07-05'),
(60, 'San San Aye', 'Finland', '1990-02-06', 'sansanaye@gmail.com', '$2y$10$ZLhbolllVQ99ipE.z2oulOPm18/Kr8j5bo9dATegaWQi4b6GxWPha', '@sansanaye', '+358469653868', 1, 'Yes. Web Development', 'Want to be data scientist', '2025-07-06'),
(61, 'Yan Paing Oo', 'Thailand', '1990-04-06', 'yanpaingoo@gmail.com', '$2y$10$i26MAa4mniq0XUNYdA5k9e.wYr33FOQf18pqqBhuj9MTGZ0Z/701C', '@igzy_yan', '+66813151888', 1, 'No', 'I want to develop software and applications by myself.', '2025-07-06'),
(62, 'Ma Kyi Lin Thant', 'Myanmar', '2012-04-30', 'kylo.lalista2022@gmail.com', '$2y$10$L//LfCb.SiP4mD32Nn7I3essDbP70gdb000KunclzFGac4AxuHXxS', 'Elowen Hayes', '09650597711', 1, 'No', 'Interested in this course', '2025-07-06'),
(63, 'Tayaw Pai Ko', 'Myanmar', '2001-09-29', 'tayawpaiko379@gmail.com', '$2y$10$8aes276OUrz8sKowD8I8/.yY.nYKo2F/gYdv2EfjgoJu2P9Pbxmhq', 'Htayaw', '0948023200', 1, 'No', 'wanna switch my career', '2025-07-07'),
(65, 'Hein Min Htet', 'Myanmar', '2000-12-29', 'htetheinmin132@gmail.com', '$2y$10$/2GHuOlmDOJm5D7myegb3eOMsxdFz/PEzwBgDPGgSjQQxNHfln//.', '@hein25555', '09966731804', 1, 'နည်းနည်းတတ်ပါတယ်', 'Skillfulဖစ်အောင်လို့ပါ', '2025-07-12'),
(66, 'Yoon Yati Htut', 'Myanmar', '2004-06-11', 'yoon41105@gmail.com', '$2y$10$e5gmRvoz1Le5V62v9LEyFeW8YKSeGMzqCZpzMSeavSodAbwlSBzcG', 'Oliva Yoon', '09965559689', 1, 'HTML,CSS,PHP', 'I need knowledge.', '2025-07-12'),
(67, 'Ma Yamin Khaing', 'Myanmar', '2003-10-22', 'yaminkhaing2210@gmail.com', '$2y$10$IHTFnr/UPkkwc/IjTINyJOoO75kXl9Gk98XI7.hU2kvz0oaacexMO', 'Yamin_75', '09785567496', 1, 'web development', 'I want to do projects with my teacher first, and later I want to move into building web applications with java', '2025-07-12'),
(68, 'Swe Lae Nandar', 'Myanmar', '2005-04-15', 'swelaenandar0415@gmail.com', '$2y$10$bbWO8zAvGAXrIsItE/waWe0TRXd90AYoRYR0n9XqL.RpTKEDDMryi', 'swelae0415', '09672740155', 1, 'Web Development', 'I want to make projects with java', '2025-07-12'),
(69, 'Htay Linn Kyaw', 'Korea', '2002-03-30', 'htaylinaung.wka@gmail.com', '$2y$10$v9YEpfTdmzTfnsbbP8asZe/N7gQpCc9pijalh718ISBvjI7hvhUhO', '태활', '01084209991', 1, 'Web programming', 'Yes', '2025-07-15'),
(70, 'Yin Myat Theint', 'Japan', '1996-05-27', 'yinmyattheint.ymt@gmail.com', '$2y$10$cEjj9kkr13/c88FDVjmJn.HpHnbad3MksTd0Je.BZgVaXlG2VaKZm', 'Kaw kaw', '09977170596', 1, 'No', 'I watched some java basic  free video in YouTube.', '2025-07-19'),
(71, 'Leon', 'Thailand', '2007-10-13', 'mrlonely1711ken@gmail.com', '$2y$10$WA70dGqemsfFDTh2ptxnYed87R0R5JfaETT7u4v56jkxKrbxacNiq', '@Leowiet_ken', '0809234510', 1, 'I am Beginner', 'I\'m really passionate about writing codes and I interest in building website and implent them using the codes. So I hope this course would help me to build and level up my coding skills in web development.', '2025-07-25'),
(72, 'Khwann', 'Thailand', '2002-06-13', 'khawnn@gmail.com', '$2y$10$RkWuDMdNnLzU7kljkVEuaO.v09HZWrfmionOMWSD6RSslWiodYwum', '@Khawnn', '09762885331', 1, 'မရှိ', 'Uniတက်ရင် Computer Science တက်မှာဖြစ်တဲ့အတွက်ကြိုလေ့လာထားချင်လို', '2025-07-28'),
(73, 'Htin Aung Moe', 'Qatar', '1998-06-28', 'htinaungmoe@gmail.com', '$2y$10$zf6LnBCM2ztSaLy3Lkb5t.JXC9eczCihA57ImWMuSq.qfmNhOKDA.', '@HtinAungMoe', '+97433202360', 1, 'No', 'To change the career', '2025-07-28'),
(74, 'Zwe Lin Htut', 'Singapore', '1999-06-15', 'zwelinhtut@gmail.com', '$2y$10$td0jxyq1TXBJcYD6Jopg1e4dQf0y2YYg2LFeUt1bOEkb0dOTfUCnq', '@zwelinhtut', '09454450419', 1, 'basic Html', 'ဒီသင်တန်းက web development သမားတွေတွက်အကောင်းဆုံးဖြစ်ဖြစ်ပြီးကျွန်တောိ့ဘဝတက်လမ်းတွက်ပါအထောက်ကူဖြစ်နိုင်တာမိုလိုပါ', '2025-07-28'),
(75, 'Hsu Myat San', 'America', '2005-02-28', 'hsumyatsan@gmail.com', '$2y$10$aL.T6cBQbibd.U0XsVYYo.FabzzWYu396DPCQPC0R7MO7QZhQ8Hgm', '@hsumyatsan', '440-876-4294', 1, 'ပထမဦးဆုံးအကြိမ်စလေ့လာမှာပါရှင့်', 'Website တစ်ခုကို ကိုယ့်ရဲ့ စိတ်ကူးစိတ်သန်းအတိုင်း အကောင်အထည်ဖော်ချင်တာကြောင့်ပါ', '2025-07-28'),
(76, 'Mya Thet Mon', 'Singapore', '2005-01-12', 'myathetmon@gmai.com', '$2y$10$PYRVAofOvUv9hpewd/mcx.4jSsR47bRr5w1.bIOiFSRY16eQgoBr.', '@myatthetmon', '00000000001', 1, 'Yes', 'To be professional python', '2025-07-28'),
(77, 'Hnin Nu', 'Singapore', '1992-06-28', 'hninnu@gmail.com', '$2y$10$kCoGWiKYEOjvHVLbm9.3xORUFj56pzT8vJ9EMTuDO0LUmj8LUZJr2', '@hninnu', '98577726', 1, 'Yes', 'interested in backend software developer', '2025-07-28'),
(78, 'AUNG AUNG LWIN', 'Myanmar', '1999-06-20', 'aungaunglwin2061999@gmail.com', '$2y$10$yRbfO7uA0kX2GM4s4XWdq.lzbKj4VaAY60bkb2fNl.g5tkO9.aLOO', 'AUNG AUNG LWIN', '090-8328-7025', 1, 'Java', 'Want to know Java to Advance level', '2025-08-03'),
(79, 'Phone Myat Ko', 'Malysia', '2006-10-19', 'phonemyat2k16@gmail.com', '$2y$10$3A0uooTF.pB4ShK.u1lR3.KPsuYj/BELZWL9JLsSme6b.yojMWWwy', 'PMK', '+60 11 4065 5191', 0, 'no', 'want to learn', '2025-08-21'),
(80, 'Linn Lett Eain', 'Myanmar', '2025-12-17', 'linnletteain7@gmail.com', '$2y$10$FI3V35uejZJ4vHvA4ea8hOoKtK89syphmXOK8rrdEFtdkcD956q0q', 'linnlett_7', '09 892474744', 0, 'No,I have never studied yet.', 'I would like to improve programming and learn to know more about what fields I truly interested in and knowfurther horizons in IT industry', '2025-10-06');

-- --------------------------------------------------------

--
-- Table structure for table `oscord_studentreview`
--

CREATE TABLE `oscord_studentreview` (
  `studentreviewID` int NOT NULL,
  `studentreview` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `courseID` int NOT NULL,
  `studentID` int NOT NULL,
  `isShown` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oscord_studentreview`
--

INSERT INTO `oscord_studentreview` (`studentreviewID`, `studentreview`, `courseID`, `studentID`, `isShown`) VALUES
(11, 'ဆရာက စေတနာပါပါနဲ့ အားလုံးကို နားလည်လွယ်‌အောင် ရှင်းပြပေးပါတယ်\r\nExercise တွေနဲ့ နားမလည်တာတွေကို စိတ်ရှည်ရှည်နဲ့ရှင်းပြပြီး ရှင်းပြထားတဲ့notes တွေကို\r\nအမြဲပိုပေးတဲ့အတွက် စာပြန်ကြည့်တဲ့အခါအရမ်းကို အထောက်အကူဖြစ်စေပီး အဆင်ပြေပါတယ်', 1, 10, 1),
(20, 'သင်တန်းကို Facebook ကနေတွေ့ခဲ့တာပါ one by one သင်ပေးတာရယ် ၊ သင်တန်းကြေးက သင့်တင့်တာရယ် ၊ အချိန်လည်း သေချာလေး ညှိနှိင်းသင်ပေးတာရယ်ကြောင့်တက်ရောက်ဖြစ်ခဲ့ပါတယ်။ အရင်က ဘာမှမရေးတတ်ဘူး၊ အဓိကက ဆရာနဲ့ တက်လိုက်တာ တွေးတတ်သွားတယ်။ program/coding ရဲ့ အသွားအလာကို တွေးတတ်လာတယ်၊ ဒီနေရာမှာ ဒါလေး မရဘူးလား၊ ဒီအကြောင်း ဖြုတ်လိုက်ရင်ရော၊ အပေါ်အောက်ချိန်းလိုက်ရင်ရော အစရှိသဖြင့် အတွေးတွေက coding ကို သပ်သပ်ရပ်ရပ် ရေးတတ်လာစေတယ်။', 1, 21, 1),
(21, 'ဆရာ့ သင်တန်းတက်ပီးတော့မှ Java programming နဲ့ ပတ်သတ်ပီး class, function တွေကို သေချာ ရှင်းလင်း နားလည်အောင် သိရှိလာရတဲ့ အတွက် အရမ်းကို အဆင်ပြေပါတယ်။ exercise တွေ နဲ့သေချာ လေ့ကျင့်ရတဲ့ အတွက်\r\njava ကိုပိုပီး အကျွမ်းတဝင်ရှိလာစေပါတယ်။ java နဲ့ပတ်သတ်ရင် Oscord ကို recommends ပေးပါတယ်။', 1, 50, 1),
(22, 'To my dear Java programing tutor Saya, I am thrilled to share my experience with the programming training provided by you (a talented tutor from Myanmar) to those who interested in programing language. You have a remarkable ability to assess the student\'s level and tailor the teaching materials accordingly even I\'m a starter. I truly appreciate your kindness, passion, time management skills, and commitment to your work. One thing that stood out to me was the reasonable fee that charged for your programming tutorial even you don\'t get enough electronic service all the time. The tutor provided me with plenty of teaching tools,making it easy for me to comprehend the lessons. Furthermore, when I faced any difficulties in understanding a concept, you patiently revised the lesson until I fully grasped it. Thanks to the programming training provided by Saya MS. I am confident that my dream of becoming proficient in programming will soon come true. I would highly recommend anyone interested in programming to join this training program. Once again, thank you, for your invaluable guidance and support.', 1, 22, 1),
(23, 'စာသင်တဲ့အခါ တစ်ယောက်ချင်း ရှင်းရှင်းလင်းလင်းနဲ့ သင်ပေးတဲ့အပြင် သင်တန်းချိန်ကို အဆင်ပြေအောင်ညှိပေးတာကို သဘောကျပါတယ် နားမလည်တာတွေကို သေချာပြန်ရှင်းပြတဲ့အပြင်သတ်မှတ်ထားတဲ့ Course တွေများတာကိုလည်းသဘောကျပါတယ် အစက ဒီအတိုင်းအချိန်ပိုနေလိုတတ်မယ် စဉ်းစားထားရာကနေ Programming ကိုအမှန်တကယ်တတ်ကျွမ်းချင်လာပါတယ်', 1, 26, 1),
(24, 'Programming ကိုအခြေခံကနေစပြီးလေ့လာချင်လို ခု  Programming သင်ပေးနေတဲ့ဆရာလေးဆီမှာတက်ဖြစ်ပါတယ် သင်ကြားပေးတဲ့စနစ်က စနစ်တကျရှိတော့သင်ယူရတာအဆင်ပြေပါတယ် သင်ခန်းစာအခန်းတိုင်းအတွက် မေးခွန်းလေးတွေလေ့ကျင့်ခန်းတွေနဲ့မိုစာပြန်လုပ်ဖြစ်စေပါတယ်နားလည်လွယ်အောင်စိတ်ရှည်ရှည်နဲ့ရှင်းပြပေးလ်ု နားလည်လွယ်စေပါတယ် ပြီးတော့ additional resources တွေနဲ့ recommended books တွေကိုဝေမျှပေးတဲ့အတွက်လည်းတော်တော်အဆင်ပြေပါတယ်OOP ကိုလည်းရှင်းပြပေးတဲ့အတွက်လည်းတော်တော်လေးအကျိုးရှိပါတယ်', 1, 23, 1),
(25, 'ကျောင်းတက်တုန်းက Programming ကိုသင်ရပေမယ့် ဘာမှန်းမသိသလို ဘာမှလဲမလုပ်ဖူးခဲ့ပါဖူး အိမ်ကသားကိုတက်စေချင်တာရယ် ကိုယ်တိုင်လည်း သိချင်စိတ်ရှိသေးတာရယ်နဲ့ ခု Programming သင်ပေးနေတဲ့ဆရာလေးဆီမှာတက်ဖြစ်ခဲ့ပါတယ် သူ့ကိုစင်ကာပူမှာအလုပ်လုပ်နေတဲ့ ညီလေးတစ်ယောက်ဆီကသိခွင့်ရတာပါ ငယ်သေးပေမယ့်တော်တော် တော်ပါတယ် သင်ကြားပေးတဲ့စနစ်ကစနစ်တကျရှိတော့သင်ယူရတာအဆင်ပြေပါတယ် သင်ခန်းစာအခန်းတိုင်းအတွက် မေးခွန်းလေးတွေလေ့ကျင့်ခန်းတွေနဲ့မိုစာပြန်လုပ်ဖြစ်စေပါတယ် နားလည်လွယ်အောင်စိတ်ရှည်ရှည်နဲ့ရှင်းပြပေးလိုကျွန်တော်လိုအသက်ကြီးသူရော သားငယ်လိုအသက်ငယ်သေးသူရောအတွက်အဆင်ပြေပါတယ်', 1, 29, 1),
(26, 'ဆရာနဲ့သင်ရတာတော်တော်အားရပါတယ် ပြီးတော့ ဆရာကနားမလည်တဲ့စာတွေကိုလဲသေသေချာချာပြန်ရှင်းပြပါတယ်\r\nအရင်တုန်းကကျွန်တော် computer programming skill ကတော်တော်ဆိုးပါတယ် ဆိုးတယ်ဆိုလုပ်ကိုမလုပ်တတ်တာပါ ခုတော့ဆရာ့ကျေးဇူးနဲ့ကျွမ်းကျွမ်းကျင်ကျင်လုပ်တတ်သွားပါပြီ ဒါကြောင့်ဆရာ့ကိုတော်တော်ကျေးဇူးတင်ပါတယ်ဆရာရေ', 1, 30, 1),
(27, 'Oscord က ဆရာတွေက စိတ်ရှည်ပြီးတော့ စာရှင်းရင်လည်း နားလည်လွယ်ပါတယ်။ Course တစ်ခုပြီးတိုင်း mini project လေးတွေလုပ်ရတာတော့ သဘောအကျဆုံးပါပဲ။ အချိန်တိုအတွင်းထိထိရောက်ရောက်နဲ့ programming ကို သင်ယူချင်ရင်တော့ Oscord ကို highly recommend ပါနော်', 9, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `oscord_studentxcourse`
--

CREATE TABLE `oscord_studentxcourse` (
  `studentxcourseID` int NOT NULL,
  `studentID` int NOT NULL,
  `courseID` int NOT NULL,
  `enrollDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oscord_studentxcourse`
--

INSERT INTO `oscord_studentxcourse` (`studentxcourseID`, `studentID`, `courseID`, `enrollDate`) VALUES
(1, 10, 1, '2025-05-31'),
(2, 10, 9, '2025-05-31'),
(35, 15, 1, '2025-06-12'),
(36, 15, 9, '2025-06-12'),
(37, 16, 1, '2025-06-14'),
(38, 17, 6, '2025-06-14'),
(39, 18, 1, '2025-06-14'),
(40, 19, 1, '2025-06-14'),
(41, 20, 1, '2025-06-14'),
(42, 21, 1, '2025-06-15'),
(43, 22, 1, '2025-06-15'),
(44, 22, 4, '2025-06-15'),
(45, 23, 1, '2025-06-15'),
(46, 24, 1, '2025-06-15'),
(47, 25, 1, '2025-06-15'),
(48, 26, 1, '2025-06-15'),
(49, 27, 1, '2025-06-15'),
(50, 28, 7, '2025-06-15'),
(51, 29, 1, '2025-06-15'),
(52, 30, 1, '2025-06-15'),
(53, 31, 1, '2025-06-15'),
(54, 32, 1, '2025-06-15'),
(55, 33, 1, '2025-06-15'),
(56, 34, 1, '2025-06-15'),
(57, 35, 1, '2025-06-15'),
(58, 36, 1, '2025-06-15'),
(59, 37, 1, '2025-06-15'),
(60, 38, 1, '2025-06-15'),
(61, 39, 7, '2025-06-15'),
(62, 40, 1, '2025-06-15'),
(64, 42, 1, '2025-06-15'),
(65, 43, 1, '2025-06-15'),
(66, 44, 1, '2025-06-15'),
(67, 45, 1, '2025-06-15'),
(68, 46, 1, '2025-06-15'),
(69, 47, 1, '2025-06-15'),
(70, 48, 4, '2025-06-15'),
(71, 49, 1, '2025-06-15'),
(72, 49, 9, '2025-06-15'),
(73, 50, 1, '2025-06-15'),
(74, 51, 9, '2025-06-15'),
(75, 52, 1, '2025-06-15'),
(76, 53, 2, '2025-06-15'),
(77, 54, 1, '2025-06-15'),
(78, 55, 2, '2025-06-15'),
(79, 56, 1, '2025-06-15'),
(80, 57, 1, '2025-06-15'),
(81, 58, 2, '2025-06-18'),
(82, 59, 2, '2025-07-05'),
(83, 60, 2, '2025-07-06'),
(84, 61, 2, '2025-07-06'),
(85, 62, 9, '2025-07-06'),
(88, 63, 9, '2025-07-07'),
(90, 65, 9, '2025-07-12'),
(91, 66, 1, '2025-07-12'),
(92, 67, 1, '2025-07-12'),
(93, 68, 1, '2025-07-12'),
(94, 69, 2, '2025-07-15'),
(95, 70, 1, '2025-07-19'),
(96, 71, 9, '2025-07-25'),
(97, 72, 4, '2025-07-28'),
(98, 73, 9, '2025-07-28'),
(99, 74, 4, '2025-07-28'),
(100, 75, 9, '2025-07-28'),
(101, 76, 2, '2025-07-28'),
(102, 77, 2, '2025-07-28'),
(103, 78, 1, '2025-08-03'),
(104, 10, 30, '2025-08-05'),
(106, 80, 1, '2025-10-06');

-- --------------------------------------------------------

--
-- Table structure for table `oscord_vidlec`
--

CREATE TABLE `oscord_vidlec` (
  `videoID` int NOT NULL,
  `videoName` varchar(100) NOT NULL,
  `videoLink` varchar(200) NOT NULL,
  `courseID` int NOT NULL,
  `videoFree` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oscord_vidlec`
--

INSERT INTO `oscord_vidlec` (`videoID`, `videoName`, `videoLink`, `courseID`, `videoFree`) VALUES
(1, '2. Variables and Datatypes - Part 1', 'https://youtu.be/jlHiIO7x9HI', 1, 1),
(10, '3. Variables and Datatypes - Part 2', 'https://youtu.be/jnhRq-_QXCg', 1, 1),
(11, '14. Utility & Collection Class in Java', 'https://youtu.be/RcBFKwTF3BI', 1, 1),
(12, '6. User Input in Java', 'https://youtu.be/AMw6_h0EFF0', 1, 1),
(14, '8. Loopings in Java - Part 1', 'https://youtu.be/HbVgRRyF_eE', 1, 1),
(15, '9. Loopings in Java - Part 2', 'https://youtu.be/Vt01n8jv4JY', 1, 0),
(16, '2. Introduction to Python Programming', 'https://youtu.be/6RSaT6Qr5NM', 2, 1),
(17, '8. List, Tuple and Set - Part 1', 'https://youtu.be/yNTOE92OLb4', 2, 1),
(19, '5. Conditional Statement & Decision Making in Python', 'https://youtu.be/-yqKMJDcw9E', 2, 1),
(20, '9. List, Tuple and Set - Part 2', 'https://youtu.be/lUj6GrtgMnc', 2, 1),
(21, '1. Introduction to Database Design', 'https://youtu.be/Z4QG6skyk9Y', 3, 1),
(22, '5. Normalization Project', 'https://youtu.be/rVOsK_aM6T4', 3, 1),
(23, '10. Querying Multiple Tables in SQL', 'https://youtu.be/Rjd52zne6I8', 3, 1),
(24, '1. Introduction to PHP Programming', 'https://youtu.be/kmu1MlCZj2E?list=PLunggmB-HckVbtTf38oo9Oi1M1BnFz0Ke', 5, 1),
(25, '10. Introduction to Database Design', 'https://youtu.be/Z4QG6skyk9Y', 5, 1),
(26, '14. Normalization Project', 'https://youtu.be/rVOsK_aM6T4', 5, 1),
(27, '19. Querying Multiple Tables', 'https://youtu.be/Rjd52zne6I8?si=ohn4B2OvTf5sw7o4', 5, 1),
(28, '3. Use of $_GET and $_POST in PHP', 'https://youtu.be/ZjJFiFfQqP0', 5, 1),
(29, '1. Introduction to Web Design', 'https://youtu.be/e6FvYOLC1Ak', 4, 1),
(30, '7. CSS Episode - 1', 'https://youtu.be/xmw8Fr28m84', 4, 1),
(31, '13. Javascript Episode - 1', 'https://youtu.be/WF_7SnfFZ98', 4, 1),
(32, '1. Introduction to Web Design', 'https://youtu.be/e6FvYOLC1Ak?si=yPgkto6sS_L2PlZ6', 9, 1),
(33, '7. CSS Episode - 1', 'https://youtu.be/xmw8Fr28m84?si=Hz-XnBGKEmXb1c18', 9, 1),
(34, '13. Javascript Episode - 1', 'https://youtu.be/WF_7SnfFZ98?si=If5lJ6T1nHacs20i', 9, 1),
(35, '33. Introduction to PHP Programming', 'https://youtu.be/kmu1MlCZj2E?si=yEI77VCjn4fjxfUg', 9, 1),
(36, '35. Use of $_GET and $_POST in PHP', 'https://youtu.be/ZjJFiFfQqP0?si=8W7wpX6mOlH7EoRn', 9, 1),
(37, '42. Introduction to Database Design', 'https://youtu.be/Z4QG6skyk9Y', 9, 1),
(38, '46. Normalization Project', 'https://youtu.be/rVOsK_aM6T4', 9, 1),
(39, '51. Querying Multiple Tables', 'https://youtu.be/Rjd52zne6I8?si=uab8JimTjdezWXCQ', 9, 1),
(41, '23. Introduction to Laravel Framework', 'https://youtu.be/6vIq_lRlIco', 5, 1),
(42, '1. Introduction to Laravel Framework', 'https://youtu.be/6vIq_lRlIco', 30, 1),
(43, '1. Introduction to Data Science', 'https://youtu.be/bFrxtKiFcww', 31, 1),
(44, '2. Distance and Similarity', 'https://youtu.be/MXVLu5nN-mg', 31, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coursecategory`
--
ALTER TABLE `coursecategory`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `coursexcategory`
--
ALTER TABLE `coursexcategory`
  ADD PRIMARY KEY (`coursexcategoryID`),
  ADD KEY `courseID` (`courseID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`fileID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `oscord_course`
--
ALTER TABLE `oscord_course`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `oscord_coursedetail`
--
ALTER TABLE `oscord_coursedetail`
  ADD PRIMARY KEY (`coursedetailID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `oscord_instructor`
--
ALTER TABLE `oscord_instructor`
  ADD PRIMARY KEY (`instructorID`);

--
-- Indexes for table `oscord_instructorxcourse`
--
ALTER TABLE `oscord_instructorxcourse`
  ADD PRIMARY KEY (`instrucorxcourseID`),
  ADD KEY `couseID` (`courseID`),
  ADD KEY `instructorID` (`instructorID`);

--
-- Indexes for table `oscord_student`
--
ALTER TABLE `oscord_student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `oscord_studentreview`
--
ALTER TABLE `oscord_studentreview`
  ADD PRIMARY KEY (`studentreviewID`),
  ADD KEY `courseID` (`courseID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `oscord_studentxcourse`
--
ALTER TABLE `oscord_studentxcourse`
  ADD PRIMARY KEY (`studentxcourseID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `oscord_vidlec`
--
ALTER TABLE `oscord_vidlec`
  ADD PRIMARY KEY (`videoID`),
  ADD KEY `courseID` (`courseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coursecategory`
--
ALTER TABLE `coursecategory`
  MODIFY `categoryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coursexcategory`
--
ALTER TABLE `coursexcategory`
  MODIFY `coursexcategoryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `fileID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `oscord_course`
--
ALTER TABLE `oscord_course`
  MODIFY `courseID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `oscord_coursedetail`
--
ALTER TABLE `oscord_coursedetail`
  MODIFY `coursedetailID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `oscord_instructor`
--
ALTER TABLE `oscord_instructor`
  MODIFY `instructorID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `oscord_instructorxcourse`
--
ALTER TABLE `oscord_instructorxcourse`
  MODIFY `instrucorxcourseID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `oscord_student`
--
ALTER TABLE `oscord_student`
  MODIFY `studentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `oscord_studentreview`
--
ALTER TABLE `oscord_studentreview`
  MODIFY `studentreviewID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `oscord_studentxcourse`
--
ALTER TABLE `oscord_studentxcourse`
  MODIFY `studentxcourseID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `oscord_vidlec`
--
ALTER TABLE `oscord_vidlec`
  MODIFY `videoID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coursexcategory`
--
ALTER TABLE `coursexcategory`
  ADD CONSTRAINT `coursexcategory_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `oscord_course` (`courseID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `coursexcategory_ibfk_2` FOREIGN KEY (`categoryID`) REFERENCES `coursecategory` (`categoryID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `oscord_course` (`courseID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `oscord_coursedetail`
--
ALTER TABLE `oscord_coursedetail`
  ADD CONSTRAINT `oscord_coursedetail_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `oscord_course` (`courseID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `oscord_instructorxcourse`
--
ALTER TABLE `oscord_instructorxcourse`
  ADD CONSTRAINT `oscord_instructorxcourse_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `oscord_course` (`courseID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `oscord_instructorxcourse_ibfk_2` FOREIGN KEY (`instructorID`) REFERENCES `oscord_instructor` (`instructorID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `oscord_studentreview`
--
ALTER TABLE `oscord_studentreview`
  ADD CONSTRAINT `oscord_studentreview_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `oscord_course` (`courseID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `oscord_studentreview_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `oscord_student` (`studentID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `oscord_studentxcourse`
--
ALTER TABLE `oscord_studentxcourse`
  ADD CONSTRAINT `oscord_studentxcourse_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `oscord_student` (`studentID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `oscord_studentxcourse_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `oscord_course` (`courseID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `oscord_vidlec`
--
ALTER TABLE `oscord_vidlec`
  ADD CONSTRAINT `oscord_vidlec_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `oscord_course` (`courseID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
