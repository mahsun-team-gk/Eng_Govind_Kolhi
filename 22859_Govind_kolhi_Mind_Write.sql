/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.32-MariaDB : Database - online_blogging_application
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`22859_Govind_kolhi_Mind_Write` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `22859_Govind_kolhi_Mind_Write`;

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `blog_title` varchar(200) DEFAULT NULL,
  `post_per_page` int(11) DEFAULT NULL,
  `blog_background_image` text DEFAULT NULL,
  `blog_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`blog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `blog` */

insert  into `blog`(`blog_id`,`user_id`,`blog_title`,`post_per_page`,`blog_background_image`,`blog_status`,`created_at`,`updated_at`) values 
(38,83,'CSS Developer and new Tech',3,'1748191011_a (1).jpeg','Active','2025-05-25 18:36:51','2025-05-25 18:36:51'),
(39,83,'Information Technology',3,'1748191176_a (3).jpg','Active','2025-05-25 18:39:36','2025-05-25 18:39:36'),
(40,83,'PHP Developer',3,'1748191212_a (4).png','Active','2025-05-25 18:40:12','2025-05-25 18:40:12'),
(41,83,'Technical Education',3,'1748191237_a (18).png','Active','2025-05-25 18:40:37','2025-05-25 18:40:37'),
(42,83,'CSS Developer New Tools',3,'1748191258_a (2).jpg','Active','2025-05-25 13:03:52','2025-05-25 18:40:58'),
(43,83,'Today News AI',3,'1748191283_a (1).png','Active','2025-05-25 18:41:23','2025-05-25 18:41:23'),
(44,83,'New 10 Tools of AI',3,'1748191303_a (3).png','Active','2025-05-25 13:03:51','2025-05-25 18:41:43'),
(45,83,'Technology',3,'1748191323_a (6).png','Active','2025-05-25 13:03:53','2025-05-25 18:42:03'),
(46,83,'Top New AI Tech Companies',3,'1748191361_a (8).png','Active','2025-05-25 18:42:41','2025-05-25 18:42:41'),
(47,83,'Pakistan All software Houses',3,'1748191428_a (18).png','Active','2025-05-25 13:03:50','2025-05-25 18:43:48'),
(48,83,'New Intership of IT student',3,'1748191456_a (14).png','Active','2025-05-25 18:44:16','2025-05-25 18:44:16');

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  `category_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `category` */

insert  into `category`(`category_id`,`category_title`,`category_description`,`category_status`,`created_at`,`updated_at`) values 
(1,'Technology','Information Technology is boost career','InActive','2025-05-25 04:23:00','2025-05-25 04:23:00'),
(2,'PHP','This is PHP category','InActive','2025-05-25 04:22:58','2025-05-25 04:22:58'),
(3,'PHP','This is PHP category','Active','2025-05-25 04:23:24','2025-05-25 04:23:24'),
(4,'IT','CSS','Active','2025-05-25 04:23:21','2025-05-25 04:23:21'),
(5,'CSS Tools','new Css tools','Active','2025-05-25 04:23:19','2025-05-25 04:23:19'),
(6,'govidn','govindkiohlhs','Active','2025-05-25 04:24:02','2025-05-25 04:24:02');

/*Table structure for table `following_blog` */

DROP TABLE IF EXISTS `following_blog`;

CREATE TABLE `following_blog` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `blog_following_id` int(11) DEFAULT NULL,
  `status` enum('Followed','Unfollowed') DEFAULT 'Followed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `blog_following_id` (`blog_following_id`),
  KEY `follower_id` (`follower_id`),
  CONSTRAINT `following_blog_ibfk_1` FOREIGN KEY (`blog_following_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `following_blog_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `following_blog` */

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_summary` text NOT NULL,
  `post_description` longtext NOT NULL,
  `featured_image` text DEFAULT NULL,
  `post_status` enum('Active','InActive') DEFAULT NULL,
  `is_comment_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post` */

insert  into `post`(`post_id`,`blog_id`,`post_title`,`post_summary`,`post_description`,`featured_image`,`post_status`,`is_comment_allowed`,`created_at`,`updated_at`) values 
(43,38,'A CSS Developer is a front-end specialist responsible for designing and styling the visual elements of websites and web applications using CSS (Cascading Style Sheets). They work closely with HTML and','JavaScript to create responsive, visually appealing, and user-friendly interfaces. CSS developers ensure that websites look consistent across different devices and browsers, and they often collaborate with designers and developers to bring mockups and wireframes to life. Their expertise lies in layout design, animations, transitions, and maintaining a clean, scalable code structure.','','uploads/a (1).png','Active',1,'2025-05-25 09:46:28','2025-05-25 09:45:33'),
(44,40,'A PHP Developer is a backend web developer who specializes','integrating databases, managing user authentication, and ensuring smooth data flow between the server and the user interface. PHP developers often work with MySQL, HTML, CSS, and JavaScript to build full-featured web solutions. Their role is crucial in developing secure, efficient, and scalable web systems.','','uploads/a (7).png','Active',0,'2025-05-25 12:00:51','2025-05-25 11:57:55'),
(45,42,'A CSS Developer focuses on styling and designing the visual layout of websites','(CSS). They work alongside HTML and JavaScript to create responsive, attractive, and user-friendly interfaces. CSS developers are skilled in layouts, animations, themes, and cross-browser compatibility, ensuring the front-end of a website looks polished and functions smoothly across all devices. Their work brings the visual design of a website to life.','','uploads/a (4).jpeg','Active',0,'2025-05-25 12:00:55','2025-05-25 11:58:54'),
(46,46,'Recent Developments: Continues to expand its AI offerings','These companies are at the forefront of AI innovation, each contributing uniquely to the advancement of artificial intelligence across various domains.\r\n\r\nIf you\'re interested in exploring specific areas such as AI startups, hardware providers, or research institutions, feel free to ask for more detailed information!','','uploads/a (2).jpg','Active',1,'2025-05-25 12:06:18','2025-05-25 12:03:31'),
(47,47,'Top Software Houses in Pakistan (2025)','NetSol Technologies\r\nHeadquarters: Lahore\r\n\r\nFounded: 1995\r\n\r\nSpecializations: Finance and leasing software, digital transformation\r\n\r\nGlobal Presence: Offices in the USA, UK, China, Australia\r\n\r\nNotable Clients: Standard Chartered, Wells Fargo','','uploads/software-houses-in-lahore.jpg','Active',0,'2025-05-25 12:06:23','2025-05-25 12:05:24'),
(48,48,'What is an Internship?','✅ Apply coding and technical knowledge in real-world projects.\r\n\r\n✅ Gain experience with tools like Git, databases, and cloud services.\r\n\r\n✅ Build a portfolio of work that can impress future employers.\r\n\r\n✅ Learn workplace communication and teamwork.\r\n\r\n✅ Often lead to full-time job offers after graduation.','Meta vs Verbraucherzentrale NRW\r\nA German court ruled in favor of Meta, allowing the tech giant to continue training its AI models using user data, setting a significant precedent for data usage in AI development. \r\nTaylor Wessing\r\n\r\nArtificial Intelligence Can’t Substitute Judge’s Decision-Making: SC\r\nPakistan\'s Supreme Court emphasized that while AI can assist in legal research, it cannot replace human judgment in decision-making, advocating for the development of comprehensive guidelines for AI integration in the judicial system','uploads/a (14).png','',1,'2025-05-25 12:32:19','2025-05-25 12:32:19'),
(49,43,'Global AI Developments Google\'s $250 AI Ultra Subscription','MindHYVE.ai Brings Agentic Intelligence and AGI Innovation to Africa\'s Premier Tech Summit\r\nMindHYVE.ai showcased its advancements in Agentic Artificial Intelligence and Artificial General Intelligence at Africa\'s leading technology summit, highlighting the continent\'s growing role in AI innovation','','uploads/hacker-news-ai-14-may-2025.jpg','Active',1,'2025-05-25 12:10:21','2025-05-25 12:10:08');

/*Table structure for table `post_atachment` */

DROP TABLE IF EXISTS `post_atachment`;

CREATE TABLE `post_atachment` (
  `post_atachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `post_attachment_title` varchar(200) DEFAULT NULL,
  `post_attachment_path` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_atachment_id`),
  KEY `fk1` (`post_id`),
  CONSTRAINT `fk1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_atachment` */

insert  into `post_atachment`(`post_atachment_id`,`post_id`,`post_attachment_title`,`post_attachment_path`,`is_active`,`created_at`,`updated_at`) values 
(18,43,'a (3).jpeg','uploads/a (3).jpeg','Active','2025-05-25 09:45:33','2025-05-25 09:45:33'),
(19,44,'a (3).png','uploads/a (3).png','Active','2025-05-25 11:57:56','2025-05-25 11:57:56'),
(20,45,'a (4).png','uploads/a (4).png','Active','2025-05-25 11:58:54','2025-05-25 11:58:54'),
(21,46,'a (4).png','uploads/a (4).png','Active','2025-05-25 12:03:31','2025-05-25 12:03:31'),
(22,47,'a (6).png','uploads/a (6).png','Active','2025-05-25 12:05:24','2025-05-25 12:05:24'),
(23,48,'a (7).png','uploads/a (7).png','Active','2025-05-25 12:08:04','2025-05-25 12:08:04'),
(24,49,'software-houses-in-lahore.jpg','uploads/software-houses-in-lahore.jpg','Active','2025-05-25 12:10:08','2025-05-25 12:10:08');

/*Table structure for table `post_category` */

DROP TABLE IF EXISTS `post_category`;

CREATE TABLE `post_category` (
  `post_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_category_id`),
  KEY `post_id` (`post_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_category` */

insert  into `post_category`(`post_category_id`,`post_id`,`category_id`,`created_at`,`updated_at`) values 
(10,43,5,'2025-05-25 09:45:33','2025-05-25 09:45:33'),
(11,44,3,'2025-05-25 11:57:55','2025-05-25 11:57:55'),
(12,45,5,'2025-05-25 11:58:54','2025-05-25 11:58:54'),
(13,46,5,'2025-05-25 12:03:31','2025-05-25 12:03:31'),
(14,47,4,'2025-05-25 12:05:24','2025-05-25 12:05:24'),
(15,48,4,'2025-05-25 12:08:04','2025-05-25 12:08:04'),
(16,48,5,'2025-05-25 12:08:04','2025-05-25 12:08:04'),
(17,49,4,'2025-05-25 12:10:08','2025-05-25 12:10:08');

/*Table structure for table `post_comment` */

DROP TABLE IF EXISTS `post_comment`;

CREATE TABLE `post_comment` (
  `post_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`post_comment_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_comment` */

insert  into `post_comment`(`post_comment_id`,`post_id`,`user_id`,`comment`,`is_active`,`created_at`) values 
(1,NULL,NULL,'Hi dear\r\n','Active','2025-05-18 03:00:18'),
(7,NULL,NULL,'hi dear how are you','Active','2025-05-21 11:05:19'),
(25,43,83,'HI DEAR','Active','2025-05-25 13:04:29');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(50) NOT NULL,
  `is_active` enum('Active','InActive') DEFAULT 'Active',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `role` */

insert  into `role`(`role_id`,`role_type`,`is_active`) values 
(1,'admin','Active'),
(2,'user','Active');

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `setting_key` varchar(100) DEFAULT NULL,
  `setting_value` varchar(100) DEFAULT NULL,
  `setting_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `setting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `setting` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `user_image` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_approved` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `is_active` enum('Active','InActive') DEFAULT 'InActive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`user_id`,`role_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`user_image`,`address`,`is_approved`,`is_active`,`created_at`,`updated_at`) values 
(83,2,'Govind','Govind','govindkolhi2002@gmail.com','Govind000$$$','Male','2025-05-02','uploads/68330bb517cd5_682cb67cc48e1.png','Village Khunhar Dhoronaro Taluka Umerkot Distirct Umerkot','Rejected','Active','2025-05-25 13:31:55',NULL),
(84,1,'Govind','Govind','rajagovindkolhi@gmail.com','Govind000$$$','Male','2025-05-07','uploads/68336edff2470_a (6).png','Village Khunhar Dhoronaro Taluka Umerkot Distirct Umerkot','Rejected','InActive','2025-05-25 13:17:36',NULL);

/*Table structure for table `user_feedback` */

DROP TABLE IF EXISTS `user_feedback`;

CREATE TABLE `user_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`feedback_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_feedback` */

insert  into `user_feedback`(`feedback_id`,`user_id`,`user_name`,`user_email`,`feedback`,`created_at`) values 
(13,NULL,'Govind Govind','sherrysantos@gmail.com','KOlhi si kohi','2025-05-19 10:15:08'),
(14,NULL,'Govind Govind','sherry_santos@gmail.com','This is  Govind form hydreavad','2025-05-19 10:17:07'),
(15,NULL,'Govind Govind','sherrysantos@gmail.com','dsads','2025-05-19 10:21:12'),
(16,NULL,'Govind Govind','govindkolhi2002@gmail.com','cxcZXczx','2025-05-19 10:22:39'),
(17,NULL,'Govind Govind','govindkolhi2002@gmail.com','dsfasdf','2025-05-19 10:25:41'),
(18,NULL,'Govind Govind','govindkolhi2002@gmail.com','dsfasdf','2025-05-19 10:27:53'),
(20,NULL,'Govind Govind','govindkolhi2002@gmail.com','adfd','2025-05-19 10:31:02'),
(21,NULL,'Govind Govind','govindkolhi2002@gmail.com','This is website is most useable around the world system','2025-05-19 10:31:19'),
(22,NULL,'Govind Govind','govindkolhi2002@gmail.com','as','2025-05-19 10:34:54'),
(26,NULL,'Govind Govind','govindkolhi2002@gmail.com','This is website is most useable around the world system','2025-05-19 11:39:51'),
(27,NULL,'','','','2025-05-21 03:03:53'),
(29,NULL,'Dileep kumar','dileep@gmail.com','','2025-05-21 09:40:14'),
(30,NULL,'Govind Govind','govindkolhi2002@gmail.com','Kumarii  This website is were well and good','2025-05-22 09:16:05'),
(31,NULL,'Govind Govind','govindkolhi2002@gmail.com','This website is were well and good','2025-05-22 09:19:20'),
(32,NULL,'Govind Govind','govindkolhi2002@gmail.com','This website is were well and good','2025-05-22 09:20:32'),
(41,NULL,'Govind Govind','piyasikumar@gmail.com','kgkgjhkg','2025-05-25 05:30:05');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
