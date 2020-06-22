-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2016 at 04:12 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `brand_buzz`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `Action_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'exist in case of the view action to show the name of Permission Group',
  `Action_Icon` varchar(255) DEFAULT NULL,
  `Action_Name` varchar(255) NOT NULL,
  `Action_GroupName` varchar(255) DEFAULT NULL,
  `Action_IsMenuItem` bit(1) NOT NULL DEFAULT b'0',
  `Action_IsActive` bit(1) NOT NULL DEFAULT b'1',
  `Action_MenuOrder` int(10) unsigned NOT NULL,
  `Action_PredecesorActionID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Action_ID`),
  KEY `FK_Action_PredecesorActionID__Action_ID` (`Action_PredecesorActionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`Action_ID`, `Action_Icon`, `Action_Name`, `Action_GroupName`, `Action_IsMenuItem`, `Action_IsActive`, `Action_MenuOrder`, `Action_PredecesorActionID`) VALUES
(1, 'fa fa-cog', 'Update Settings', 'Setting Management', b'1', b'1', 1, NULL),
(2, 'flaticon-load', 'View Role List', 'System Role Management', b'1', b'1', 2, NULL),
(3, NULL, 'Change Role Status', NULL, b'0', b'1', 0, 2),
(4, NULL, 'Create New Role', NULL, b'0', b'1', 0, 2),
(5, '', 'Edit Role', NULL, b'0', b'1', 0, 2),
(6, 'flaticon-avatar19', 'View User List', 'System User Management', b'1', b'1', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `action_route`
--

CREATE TABLE IF NOT EXISTS `action_route` (
  `ActRoute_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ActRoute_ActionID` int(10) unsigned NOT NULL,
  `ActRoute_RouteName` varchar(255) NOT NULL,
  `ActRoute_IsLogging` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ActRoute_IsLoggingDetails` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ActRoute_ID`),
  KEY `FK_ActRoute_ActionID__Action_ID` (`ActRoute_ActionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `action_route`
--

INSERT INTO `action_route` (`ActRoute_ID`, `ActRoute_ActionID`, `ActRoute_RouteName`, `ActRoute_IsLogging`, `ActRoute_IsLoggingDetails`) VALUES
(1, 1, 'edit_setting', 1, 1),
(2, 1, 'update_setting', 1, 1),
(3, 2, 'role_view', 0, 0),
(4, 2, 'role_list', 0, 0),
(5, 3, 'change_role_status', 1, 1),
(6, 3, 'create_role', 0, 0),
(7, 3, 'store_role', 1, 1),
(8, 5, 'edit_role', 0, 0),
(9, 4, 'update_role', 1, 1),
(10, 6, 'user_view', 0, 0),
(11, 6, 'user_list', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `Article_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Article_Type` int(10) unsigned NOT NULL,
  `Article_Status` int(10) unsigned NOT NULL,
  `Article_ThumpImage` varchar(255) NOT NULL,
  `Article_GalleryID` int(10) unsigned DEFAULT NULL,
  `Article_IsHighlighted` bit(1) NOT NULL DEFAULT b'0',
  `Article_HighlightDate` datetime DEFAULT NULL,
  `Article_PublishDate` datetime DEFAULT NULL,
  `Article_Tags` varchar(500) DEFAULT NULL,
  `Article_SystemUserID` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Article_ID`),
  KEY `FK_Article_Type__SysLkp_ID` (`Article_Type`),
  KEY `FK_Article_GalleryID__Gall_ID` (`Article_GalleryID`),
  KEY `FK_Article_SystemUserID__SysUsr_ID` (`Article_SystemUserID`),
  KEY `FK_Article_Status__SysLkp_ID` (`Article_Status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `article_language`
--

CREATE TABLE IF NOT EXISTS `article_language` (
  `ArtLang_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ArtLang_ArticleID` int(10) unsigned NOT NULL,
  `ArtLang_LanguageType` enum('AR','EN') NOT NULL,
  `ArtLang_ArticleTitle` varchar(255) NOT NULL,
  `ArtLang_ArticleTextBody` text,
  `ArtLang_ArticleDescription` text,
  PRIMARY KEY (`ArtLang_ID`),
  KEY `FK_ArtLang_ArticleID__Article_ID` (`ArtLang_ArticleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blocker`
--

CREATE TABLE IF NOT EXISTS `blocker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(30) CHARACTER SET utf8 NOT NULL,
  `open_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clienttestimonial_language`
--

CREATE TABLE IF NOT EXISTS `clienttestimonial_language` (
  `CTL_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CTL_ClientTestimonialID` int(10) unsigned NOT NULL,
  `CTL_LanguageType` enum('AR','EN') NOT NULL,
  `CTL_TestimonialBody` varchar(1000) NOT NULL,
  PRIMARY KEY (`CTL_ID`),
  KEY `FK_CTL_ClientTestimonialID__CTest_ID` (`CTL_ClientTestimonialID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_testimonial`
--

CREATE TABLE IF NOT EXISTS `client_testimonial` (
  `CTest_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CTest_StakeholderID` int(10) unsigned NOT NULL,
  `CTest_PersonalImage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`CTest_ID`),
  KEY `FK_CTest_StakeholderID__Stake_ID` (`CTest_StakeholderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `value` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(2, 'is_open', '1'),
(3, 'close_message', 'Hey Baher'),
(4, 'news_letter', '1'),
(5, 'slider_images', '4'),
(6, 'facebook', 'attartravel.sa'),
(7, 'twitter', 'attartravel'),
(8, 'youtube', 'user/attartravelTV'),
(10, 'instagram', 'attartravel'),
(13, 'sign_social', '1'),
(16, 'add_blog', '1'),
(18, 'add_comment', '1'),
(19, 'like', '1'),
(20, 'booking', '1'),
(22, 'add_reply', '1'),
(23, 'google_code', ''),
(24, 'meta_description', 'Attar Travel is one of the largest travel agency on Saudi Arabia and middle east, it organize a lot of travel packages kinds to a lot of destinations, in addition, it make flight trips and you can make booking on it'),
(25, 'tags', 'Attar Travel,travel agency,honymoon,travel packages,travel,trips'),
(26, 'phone', '00970221343'),
(27, 'facebook_share', '1'),
(28, 'twitter_share', '1'),
(29, 'google_share', '1'),
(30, 'show_notification', '0'),
(31, 'message_notification_en', 'Login by social media Stop \r\n'),
(32, 'date_notification', '2016-03-12'),
(33, 'message_notification_ar', 'تم أيقاف تسجيل الدخول بواسطة مواقع التواصل الاجتماعي ');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_en` text CHARACTER SET utf8 NOT NULL,
  `details_en` text CHARACTER SET utf8 NOT NULL,
  `dateAdded` int(11) NOT NULL,
  `question_ar` text CHARACTER SET utf8 NOT NULL,
  `details_ar` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `Gall_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Gall_Status` int(10) unsigned NOT NULL,
  `Gall_AddedBy` int(10) unsigned DEFAULT NULL COMMENT 'if null -> blog Gallery',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Gall_ID`),
  KEY `FK_Album_AddedBy__SysUsr_ID` (`Gall_AddedBy`),
  KEY `FK_Gall_Status__SysLkp_ID` (`Gall_Status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gallerymedia_language`
--

CREATE TABLE IF NOT EXISTS `gallerymedia_language` (
  `GMLang_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `GMLang_GalleryMediaID` int(10) unsigned NOT NULL,
  `GalLang_LanguageType` enum('AR','EN') NOT NULL,
  `GalLang_GalleryMediaTitle` varchar(255) NOT NULL,
  `GalLang_GalleryMediaDescription` text NOT NULL,
  PRIMARY KEY (`GMLang_ID`),
  KEY `FK_GMLang_GalleryMediaID__GallMed_ID` (`GMLang_GalleryMediaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_language`
--

CREATE TABLE IF NOT EXISTS `gallery_language` (
  `GalLang_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `GalLang_GalleryID` int(10) unsigned NOT NULL,
  `GalLang_LanguageType` enum('AR','EN') NOT NULL,
  `GalLang_GalleryTitle` varchar(255) NOT NULL,
  `GalLang_GallerySubtitle` varchar(255) NOT NULL,
  PRIMARY KEY (`GalLang_ID`),
  KEY `FK_GalLang_GalleryID__Gall_ID` (`GalLang_GalleryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_media`
--

CREATE TABLE IF NOT EXISTS `gallery_media` (
  `GallMed_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `GallMed_GalleryID` int(10) unsigned NOT NULL,
  `GallMed_IsHighlighted` bit(1) NOT NULL DEFAULT b'0' COMMENT 'For images:\r\n0=> Normal Image\r\n1 => for select image as Gallery Cover  Image\r\nFor Video:\r\n0=> Normal Video\r\n1=> Viewed in the Home Page',
  `GallMed_MediaType` int(10) unsigned NOT NULL,
  `GallMed_Link` varchar(255) NOT NULL,
  `GallMed_Order` int(10) unsigned NOT NULL,
  PRIMARY KEY (`GallMed_ID`),
  KEY `FK_GallMed_GalleryID__Gall_ID` (`GallMed_GalleryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `google_place_language`
--

CREATE TABLE IF NOT EXISTS `google_place_language` (
  `GPL_GooglePlaceID` varchar(255) NOT NULL,
  `GPL_GooglePlaceType` int(10) unsigned NOT NULL,
  `GPL_LanguageType` enum('AR','EN') NOT NULL,
  `GPL_LandmarkName` varchar(255) NOT NULL,
  PRIMARY KEY (`GPL_GooglePlaceID`,`GPL_LanguageType`),
  KEY `FK_GPL_GooglePlaceType__SysLkp_ID` (`GPL_GooglePlaceType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE IF NOT EXISTS `inquiry` (
  `Inq_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Inq_First Name` varchar(255) NOT NULL,
  `Inq_LastName` varchar(255) NOT NULL,
  `Inq_MobileNo` varchar(255) NOT NULL,
  `Inq_Email` varchar(255) NOT NULL,
  `Inq_Message` text CHARACTER SET utf8 NOT NULL,
  `Inq_IsNewInquiry` bit(1) NOT NULL DEFAULT b'1',
  `Inq_SendingDate` int(11) NOT NULL,
  `Inq_SeenBy` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Inq_ID`),
  KEY `FK_Inq_SeenBy__SysUsr_ID` (`Inq_SeenBy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_response`
--

CREATE TABLE IF NOT EXISTS `inquiry_response` (
  `InqRes_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `InqRes_InquiryID` int(10) unsigned NOT NULL,
  `InqRes_Message` text CHARACTER SET utf8 NOT NULL,
  `InqRes_ResponseDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InqRes_SystemUserID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`InqRes_ID`),
  KEY `FK_InqRes_InquiryID__Inq_ID` (`InqRes_InquiryID`),
  KEY `FK_InqRes_SystemUserID__SysUsr_ID` (`InqRes_SystemUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logging_details`
--

CREATE TABLE IF NOT EXISTS `logging_details` (
  `LogDet_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `LogDet_MasterID` int(10) unsigned NOT NULL,
  `LogDet_ReferencedTableName` varchar(50) NOT NULL,
  `LogDet_ReferencedFieldName` varchar(50) NOT NULL,
  `LogDet_OldValue` text,
  `LogDet_NewValue` text,
  PRIMARY KEY (`LogDet_ID`),
  KEY `FK_LogDet_MasterID__Log_ID` (`LogDet_MasterID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logging_masters`
--

CREATE TABLE IF NOT EXISTS `logging_masters` (
  `Log_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Log_UserID` int(10) unsigned NOT NULL,
  `Log_ActionDate` datetime NOT NULL,
  `Log_IPAddress` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Log_ActionName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Log_AffectedRecordTableName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Log_RecordReferenceName` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`Log_ID`),
  KEY `FK_Log_UserID__SysUsr_ID` (`Log_UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `logging_masters`
--

INSERT INTO `logging_masters` (`Log_ID`, `Log_UserID`, `Log_ActionDate`, `Log_IPAddress`, `Log_ActionName`, `Log_AffectedRecordTableName`, `Log_RecordReferenceName`) VALUES
(1, 1, '2016-02-23 16:16:02', '::1', 'Login', 'System_User', 'admin'),
(2, 1, '2016-02-23 16:19:02', '::1', 'Login', 'System_User', 'admin'),
(3, 1, '2016-02-23 16:20:02', '::1', 'Login', 'System_User', 'admin'),
(4, 1, '2016-02-23 16:26:02', '::1', 'Login', 'System_User', 'admin'),
(5, 1, '2016-02-23 16:51:02', '::1', 'Login', 'System_User', 'admin'),
(6, 1, '2016-02-23 17:02:02', '::1', 'Login', 'System_User', 'admin'),
(7, 1, '2016-02-23 17:07:02', '::1', 'Login', 'System_User', 'admin'),
(8, 1, '2016-02-23 17:41:02', '1', '::1', 'Logout', 'System_User'),
(9, 1, '2016-02-23 17:41:02', '::1', 'Login', 'System_User', 'admin'),
(10, 1, '2016-02-23 17:41:02', '1', '::1', 'Logout', 'System_User'),
(11, 1, '2016-02-23 17:41:02', '::1', 'Login', 'System_User', 'admin'),
(12, 1, '2016-02-23 17:51:02', '1', '::1', 'Logout', 'System_User'),
(13, 1, '2016-02-23 17:51:02', '::1', 'Login', 'System_User', 'admin'),
(14, 1, '2016-02-23 17:54:02', '::1', 'Login', 'System_User', 'admin'),
(15, 1, '2016-02-23 18:00:02', '::1', 'Login', 'System_User', 'admin'),
(16, 1, '2016-02-23 18:24:02', '1', '::1', 'Logout', 'System_User'),
(17, 1, '2016-02-23 18:26:02', '::1', 'Login', 'System_User', 'admin'),
(18, 1, '2016-02-23 18:58:02', '1', '::1', 'Logout', 'System_User'),
(19, 1, '2016-02-23 18:58:02', '::1', 'Login', 'System_User', 'admin'),
(20, 1, '2016-02-23 19:05:02', '1', '::1', 'Logout', 'System_User'),
(21, 1, '2016-02-23 19:05:02', '::1', 'Login', 'System_User', 'admin'),
(22, 1, '2016-02-23 19:41:02', '1', '::1', 'Logout', 'System_User'),
(23, 1, '2016-02-23 19:41:02', '::1', 'Login', 'System_User', 'admin'),
(24, 1, '2016-02-24 13:01:02', '::1', 'Login', 'System_User', 'admin'),
(25, 1, '2016-02-24 15:50:02', '::1', 'Login', 'System_User', 'admin'),
(26, 1, '2016-02-24 18:34:02', '::1', 'Login', 'System_User', 'admin'),
(27, 1, '2016-02-24 18:35:02', '1', '::1', 'Logout', 'System_User'),
(28, 1, '2016-02-24 18:36:02', '::1', 'Login', 'System_User', 'admin'),
(29, 1, '2016-02-24 18:38:02', '::1', 'Login', 'System_User', 'admin'),
(30, 1, '2016-02-24 18:38:02', '1', '::1', 'Logout', 'System_User'),
(31, 1, '2016-02-24 18:55:02', '::1', 'Login', 'System_User', 'admin'),
(32, 1, '2016-02-24 18:55:02', '1', '::1', 'Logout', 'System_User'),
(33, 1, '2016-02-24 18:56:02', '::1', 'Login', 'System_User', 'admin'),
(34, 1, '2016-02-24 18:57:02', '1', '::1', 'Logout', 'System_User'),
(35, 1, '2016-02-24 18:57:02', '::1', 'Login', 'System_User', 'admin'),
(36, 1, '2016-02-24 18:58:02', '1', '::1', 'Logout', 'System_User'),
(37, 1, '2016-02-24 18:58:02', '::1', 'Login', 'System_User', 'admin'),
(38, 1, '2016-02-24 19:01:02', '1', '::1', 'Logout', 'System_User'),
(39, 1, '2016-02-24 19:02:02', '::1', 'Login', 'System_User', 'admin'),
(40, 1, '2016-02-24 19:07:02', '1', '::1', 'Logout', 'System_User'),
(41, 1, '2016-02-24 19:12:02', '::1', 'Login', 'System_User', 'admin'),
(42, 1, '2016-02-24 19:21:02', '1', '::1', 'Logout', 'System_User'),
(43, 1, '2016-02-24 19:23:02', '::1', 'Login', 'System_User', 'admin'),
(44, 1, '2016-02-24 19:23:02', '1', '::1', 'Logout', 'System_User'),
(45, 1, '2016-02-24 19:23:02', '::1', 'Login', 'System_User', 'admin'),
(46, 1, '2016-02-24 19:24:02', '1', '::1', 'Logout', 'System_User'),
(47, 1, '2016-02-24 19:24:02', '::1', 'Login', 'System_User', 'admin'),
(48, 1, '2016-02-24 19:27:02', '1', '::1', 'Logout', 'System_User'),
(49, 1, '2016-02-24 19:27:02', '::1', 'Login', 'System_User', 'admin'),
(50, 1, '2016-02-24 23:54:02', '::1', 'Login', 'System_User', 'admin'),
(51, 1, '2016-02-25 00:00:02', '1', '::1', 'Logout', 'System_User'),
(52, 1, '2016-02-25 00:04:02', '1', '::1', 'Logout', 'System_User'),
(53, 1, '2016-02-25 00:10:02', '1', '::1', 'Logout', 'System_User'),
(54, 1, '2016-02-25 00:18:02', '1', '::1', 'Logout', 'System_User'),
(55, 1, '2016-02-25 00:18:02', '1', '::1', 'Logout', 'System_User'),
(56, 1, '2016-02-25 00:18:02', '1', '::1', 'Logout', 'System_User'),
(57, 1, '2016-02-25 00:19:02', '1', '::1', 'Logout', 'System_User'),
(58, 1, '2016-02-25 00:19:02', '::1', 'Login', 'System_User', 'admin'),
(59, 1, '2016-02-25 00:19:02', '1', '::1', 'Logout', 'System_User'),
(60, 1, '2016-02-25 00:23:02', '::1', 'Login', 'System_User', 'admin'),
(61, 1, '2016-02-25 00:23:02', '1', '::1', 'Logout', 'System_User'),
(62, 1, '2016-02-25 00:23:02', '::1', 'Login', 'System_User', 'admin'),
(63, 1, '2016-02-25 00:23:02', '1', '::1', 'Logout', 'System_User'),
(64, 1, '2016-02-25 00:32:02', '::1', 'Login', 'System_User', 'admin'),
(65, 1, '2016-02-25 00:32:02', '1', '::1', 'Logout', 'System_User'),
(66, 1, '2016-02-25 00:39:02', '::1', 'Login', 'System_User', 'admin'),
(67, 1, '2016-02-25 00:39:02', '1', '::1', 'Logout', 'System_User'),
(68, 1, '2016-02-25 00:51:02', '::1', 'Login', 'System_User', 'admin'),
(69, 1, '2016-02-25 00:53:02', '1', '::1', 'Logout', 'System_User'),
(70, 1, '2016-02-25 00:53:02', '::1', 'Login', 'System_User', 'admin'),
(71, 1, '2016-02-26 11:52:02', '::1', 'Login', 'System_User', 'admin'),
(76, 1, '2016-02-26 12:36:02', '::1', 'Login', 'System_User', 'admin'),
(80, 1, '2016-02-26 14:04:02', '::1', 'Login', 'System_User', 'admin'),
(81, 1, '2016-02-27 14:46:02', '::1', 'Login', 'System_User', 'admin'),
(82, 1, '2016-02-27 20:59:02', '::1', 'Login', 'System_User', 'admin'),
(83, 1, '2016-02-28 00:23:02', '::1', 'Login', 'System_User', 'admin'),
(84, 1, '2016-02-28 13:05:02', '::1', 'Login', 'System_User', 'admin'),
(85, 1, '2016-02-28 13:13:02', '::1', 'Login', 'System_User', 'admin'),
(86, 1, '2016-02-28 13:22:02', '1', '::1', 'Logout', 'System_User'),
(87, 1, '2016-02-28 13:22:02', '::1', 'Login', 'System_User', 'admin'),
(88, 1, '2016-02-28 14:32:02', '1', '::1', 'Create New Role', 'Role'),
(89, 1, '2016-02-28 14:33:02', '1', '::1', 'Logout', 'System_User'),
(90, 1, '2016-02-28 14:33:02', '::1', 'Login', 'System_User', 'admin'),
(91, 1, '2016-02-28 17:00:02', '::1', 'Login', 'System_User', 'admin'),
(92, 1, '2016-02-28 17:01:02', '::1', 'Login', 'System_User', 'admin'),
(93, 1, '2016-02-28 17:02:02', '::1', 'Login', 'System_User', 'admin'),
(94, 1, '2016-02-28 17:13:02', '::1', 'Login', 'System_User', 'admin'),
(95, 1, '2016-02-28 17:15:02', '::1', 'Login', 'System_User', 'admin'),
(96, 1, '2016-02-28 17:15:02', '::1', 'Login', 'System_User', 'admin'),
(97, 1, '2016-02-28 17:15:02', '::1', 'Login', 'System_User', 'admin'),
(98, 1, '2016-02-28 18:03:02', '::1', 'Login', 'System_User', 'admin'),
(99, 1, '2016-02-28 18:03:02', '::1', 'Login', 'System_User', 'admin'),
(100, 1, '2016-02-28 18:04:02', '::1', 'Login', 'System_User', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `logging_recordpk`
--

CREATE TABLE IF NOT EXISTS `logging_recordpk` (
  `LogPK_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `LogPK_MasterID` int(10) unsigned NOT NULL,
  `LogPK_FieldName` varchar(255) NOT NULL,
  PRIMARY KEY (`LogPK_ID`),
  KEY `FK_LogPK_MasterID__Log_ID` (`LogPK_MasterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `logging_recordpk`
--

INSERT INTO `logging_recordpk` (`LogPK_ID`, `LogPK_MasterID`, `LogPK_FieldName`) VALUES
(1, 3, 'SysUsr_ID'),
(2, 4, 'SysUsr_ID'),
(3, 5, 'SysUsr_ID'),
(4, 6, 'SysUsr_ID'),
(5, 7, 'SysUsr_ID'),
(6, 8, 'admin'),
(7, 9, 'SysUsr_ID'),
(8, 10, 'admin'),
(9, 11, 'SysUsr_ID'),
(10, 12, 'admin'),
(11, 13, 'SysUsr_ID'),
(12, 14, 'SysUsr_ID'),
(13, 15, 'SysUsr_ID'),
(14, 16, 'admin'),
(15, 17, 'SysUsr_ID'),
(16, 18, 'admin'),
(17, 19, 'SysUsr_ID'),
(18, 20, 'admin'),
(19, 21, 'SysUsr_ID'),
(20, 22, 'admin'),
(21, 23, 'SysUsr_ID'),
(22, 24, 'SysUsr_ID'),
(23, 25, 'SysUsr_ID'),
(24, 26, 'SysUsr_ID'),
(25, 27, 'admin'),
(26, 28, 'SysUsr_ID'),
(27, 29, 'SysUsr_ID'),
(28, 30, 'admin'),
(29, 31, 'SysUsr_ID'),
(30, 32, 'admin'),
(31, 33, 'SysUsr_ID'),
(32, 34, 'admin'),
(33, 35, 'SysUsr_ID'),
(34, 36, 'admin'),
(35, 37, 'SysUsr_ID'),
(36, 38, 'admin'),
(37, 39, 'SysUsr_ID'),
(38, 40, 'admin'),
(39, 41, 'SysUsr_ID'),
(40, 42, 'admin'),
(41, 43, 'SysUsr_ID'),
(42, 44, 'admin'),
(43, 45, 'SysUsr_ID'),
(44, 46, 'admin'),
(45, 47, 'SysUsr_ID'),
(46, 48, 'admin'),
(47, 49, 'SysUsr_ID'),
(48, 50, 'SysUsr_ID'),
(49, 51, 'admin'),
(50, 52, 'admin'),
(51, 53, 'admin'),
(52, 54, 'admin'),
(53, 55, 'admin'),
(54, 56, 'admin'),
(55, 57, 'admin'),
(56, 58, 'SysUsr_ID'),
(57, 59, 'admin'),
(58, 60, 'SysUsr_ID'),
(59, 61, 'admin'),
(60, 62, 'SysUsr_ID'),
(61, 63, 'admin'),
(62, 64, 'SysUsr_ID'),
(63, 65, 'admin'),
(64, 66, 'SysUsr_ID'),
(65, 67, 'admin'),
(66, 68, 'SysUsr_ID'),
(67, 69, 'admin'),
(68, 70, 'SysUsr_ID'),
(69, 71, 'SysUsr_ID'),
(70, 76, 'SysUsr_ID'),
(71, 80, 'SysUsr_ID'),
(72, 81, 'SysUsr_ID'),
(73, 82, 'SysUsr_ID'),
(74, 83, 'SysUsr_ID'),
(75, 84, 'SysUsr_ID'),
(76, 85, 'SysUsr_ID'),
(77, 86, 'admin'),
(78, 87, 'SysUsr_ID'),
(79, 88, 'Admin'),
(80, 89, 'admin'),
(81, 90, 'SysUsr_ID'),
(82, 91, 'SysUsr_ID'),
(83, 92, 'SysUsr_ID'),
(84, 93, 'SysUsr_ID'),
(85, 94, 'SysUsr_ID'),
(86, 95, 'SysUsr_ID'),
(87, 96, 'SysUsr_ID'),
(88, 97, 'SysUsr_ID'),
(89, 98, 'SysUsr_ID'),
(90, 99, 'SysUsr_ID'),
(91, 100, 'SysUsr_ID');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `Role_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Role_Name` varchar(255) NOT NULL,
  `Role_CreatedBy` int(10) unsigned NOT NULL,
  `Role_Status` int(10) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Role_ID`),
  KEY `FK_Role_Status__SysLkp_ID` (`Role_Status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`Role_ID`, `Role_Name`, `Role_CreatedBy`, `Role_Status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, 2, '2016-02-16 22:00:00', '2016-02-23 22:00:00'),
(2, 'test', 1, 1, '2016-02-18 22:00:00', '2016-02-28 22:00:00'),
(3, 'test roleaa', 1, 3, '2016-02-28 12:10:53', '2016-02-28 12:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_action`
--

CREATE TABLE IF NOT EXISTS `role_action` (
  `RolAct_RoleID` int(10) unsigned NOT NULL,
  `RolAct_ActionID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`RolAct_RoleID`,`RolAct_ActionID`),
  KEY `FK_RolAct_ActionID__Action_ID` (`RolAct_ActionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_action`
--

INSERT INTO `role_action` (`RolAct_RoleID`, `RolAct_ActionID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `stakeholder`
--

CREATE TABLE IF NOT EXISTS `stakeholder` (
  `Stake_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Stake_Type` int(10) unsigned NOT NULL,
  `Stake_Logo` varchar(255) NOT NULL,
  `Stake_Website` varchar(255) NOT NULL,
  `Stake_AddedBy` int(10) unsigned NOT NULL,
  `Stake_Status` int(10) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Stake_ID`),
  KEY `FK_Stake_Type_Type__SysLkp_ID` (`Stake_Type`),
  KEY `FK_Stake_AddedBy__SysUsr_ID` (`Stake_AddedBy`),
  KEY `FK_Stake_Status__SysLkp_ID` (`Stake_Status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stakeholder_language`
--

CREATE TABLE IF NOT EXISTS `stakeholder_language` (
  `StakeLang_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `StakeLang_StakeholderID` int(10) unsigned NOT NULL,
  `StakeLang_LanguageType` enum('AR','EN') NOT NULL,
  `StakeLang_Name` varchar(255) NOT NULL,
  `StakeLang_Description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`StakeLang_ID`),
  KEY `FK_StakeLang_StakeholderID__Stake_ID` (`StakeLang_StakeholderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `systemlookup_language`
--

CREATE TABLE IF NOT EXISTS `systemlookup_language` (
  `SysLkpLang_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SysLkpLang_SystemLookupID` int(10) unsigned NOT NULL,
  `SysLkpLang_Type` enum('AR','EN') NOT NULL,
  `SysLkpLang_Text` varchar(255) NOT NULL,
  PRIMARY KEY (`SysLkpLang_ID`),
  KEY `FK_LkpLang_SystemLookupID__SysLkp_ID` (`SysLkpLang_SystemLookupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `systemlookup_language`
--

INSERT INTO `systemlookup_language` (`SysLkpLang_ID`, `SysLkpLang_SystemLookupID`, `SysLkpLang_Type`, `SysLkpLang_Text`) VALUES
(1, 1, 'EN', 'Role Status'),
(2, 2, 'EN', '	\r\nActive'),
(3, 3, 'EN', 'Inactive'),
(4, 7, 'EN', 'User Status'),
(5, 8, 'EN', 'Active'),
(6, 9, 'EN', 'Deactive');

-- --------------------------------------------------------

--
-- Table structure for table `systemuser_action`
--

CREATE TABLE IF NOT EXISTS `systemuser_action` (
  `UsrAct_SystemUserID` int(10) unsigned NOT NULL,
  `UsrAct_ActionID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UsrAct_SystemUserID`,`UsrAct_ActionID`),
  KEY `FK_UsrAct_ActionID__Action_ID` (`UsrAct_ActionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemuser_action`
--

INSERT INTO `systemuser_action` (`UsrAct_SystemUserID`, `UsrAct_ActionID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `systemuser_role`
--

CREATE TABLE IF NOT EXISTS `systemuser_role` (
  `UsrRol_SystemUserID` int(10) unsigned NOT NULL,
  `UsrRol_RoleID` int(10) unsigned NOT NULL,
  `UsrRol_IsCustomized` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`UsrRol_SystemUserID`,`UsrRol_RoleID`),
  KEY `FK_UsrRol_RoleID__Role_ID` (`UsrRol_RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemuser_role`
--

INSERT INTO `systemuser_role` (`UsrRol_SystemUserID`, `UsrRol_RoleID`, `UsrRol_IsCustomized`) VALUES
(1, 1, b'0'),
(2, 3, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `system_lookup`
--

CREATE TABLE IF NOT EXISTS `system_lookup` (
  `SysLkp_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SysLkp_HTMLID` varchar(50) NOT NULL,
  `SysLkp_ParentID` int(10) unsigned DEFAULT NULL,
  `SysLkp_Order` int(11) DEFAULT NULL,
  `SysLkp_IsActive` bit(1) NOT NULL,
  PRIMARY KEY (`SysLkp_ID`),
  KEY `FK_SysLkp_ParentID__SysLkp_ID` (`SysLkp_ParentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `system_lookup`
--

INSERT INTO `system_lookup` (`SysLkp_ID`, `SysLkp_HTMLID`, `SysLkp_ParentID`, `SysLkp_Order`, `SysLkp_IsActive`) VALUES
(1, 'ROLE_STATUS', NULL, NULL, b'1'),
(2, 'ROLE_STATUS_ACTIVE', 1, NULL, b'1'),
(3, 'ROLE_STATUS_INACTIVE', 1, NULL, b'1'),
(4, 'SYSTEM_USER_STATUS', NULL, NULL, b'1'),
(5, 'SYSTEM_USER_STATUS_ACTIVE', 4, NULL, b'1'),
(6, 'SYSTEM_USER_STATUS_DEACTIVE', 4, NULL, b'1'),
(7, 'SYSTEM_USER_STATUS', NULL, NULL, b'1'),
(8, 'SYSTEM_USER_STATUS_ACTIVE', 7, 1, b'1'),
(9, 'SYSTEM_USER_STATUS_DEACTIVE', 7, 2, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `system_user`
--

CREATE TABLE IF NOT EXISTS `system_user` (
  `SysUsr_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SysUsr_ThumbImage` varchar(255) DEFAULT NULL,
  `SysUsr_FullName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `SysUsr_UserName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `SysUsr_Password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `SysUsr_DoB` date NOT NULL,
  `SysUsr_Email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `SysUsr_Mobile` varchar(14) CHARACTER SET utf8 NOT NULL,
  `SysUsr_LastLoginDate` timestamp NULL DEFAULT NULL,
  `SysUsr_LastIPAddress` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `SysUsr_Status` int(10) unsigned NOT NULL DEFAULT '1',
  `SysUsr_CreatedBy` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SysUsr_ID`),
  KEY `FK_SysUsr_Status__SysLkp_ID` (`SysUsr_Status`),
  KEY `FK_SysUsr_CreatedBy__SysUsr_ID` (`SysUsr_CreatedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `system_user`
--

INSERT INTO `system_user` (`SysUsr_ID`, `SysUsr_ThumbImage`, `SysUsr_FullName`, `SysUsr_UserName`, `SysUsr_Password`, `SysUsr_DoB`, `SysUsr_Email`, `SysUsr_Mobile`, `SysUsr_LastLoginDate`, `SysUsr_LastIPAddress`, `SysUsr_Status`, `SysUsr_CreatedBy`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, '1453100436lUkNhSWgVFvtIaVpw7VQh15rI.jpeg', 'admin', 'admin', '$2y$10$SA7rkTzzKgm2vJrwMTPfquxuHxuRsUusoZzlueGVxvvlUsvq5b3D.', '2016-02-11', 'admin', '3246', '2016-02-28 16:04:58', '::1', 8, 1, '2016-02-08 22:00:00', '2016-02-28 16:04:58', 'W4INusV08Zuqp8eOb8fKNbQbW9pMC7y4ECfPe9bNHpOpZltY1KbNnLMHBYWJ'),
(2, '1453100436lUkNhSWgVFvtIaVpw7VQh15rI.jpeg', 'ali', 'ali', '$2y$10$SA7rkTzzKgm2vJrwMTPfquxuHxuRsUusoZzlueGVxvvlUsvq5b3D.', '2016-02-04', 'aa', '', '2016-02-23 22:00:00', '::1', 9, 1, '2016-02-10 22:00:00', '2016-02-24 22:00:00', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `FK_Action_PredecesorActionID__Action_ID` FOREIGN KEY (`Action_PredecesorActionID`) REFERENCES `action` (`Action_ID`);

--
-- Constraints for table `action_route`
--
ALTER TABLE `action_route`
  ADD CONSTRAINT `FK_ActRoute_ActionID__Action_ID` FOREIGN KEY (`ActRoute_ActionID`) REFERENCES `action` (`Action_ID`);

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_Article_GalleryID__Gall_ID` FOREIGN KEY (`Article_GalleryID`) REFERENCES `gallery` (`Gall_ID`),
  ADD CONSTRAINT `FK_Article_Status__SysLkp_ID` FOREIGN KEY (`Article_Status`) REFERENCES `system_lookup` (`SysLkp_ID`),
  ADD CONSTRAINT `FK_Article_SystemUserID__SysUsr_ID` FOREIGN KEY (`Article_SystemUserID`) REFERENCES `system_user` (`SysUsr_ID`),
  ADD CONSTRAINT `FK_Article_Type__SysLkp_ID` FOREIGN KEY (`Article_Type`) REFERENCES `system_lookup` (`SysLkp_ID`);

--
-- Constraints for table `article_language`
--
ALTER TABLE `article_language`
  ADD CONSTRAINT `FK_ArtLang_ArticleID__Article_ID` FOREIGN KEY (`ArtLang_ArticleID`) REFERENCES `article` (`Article_ID`);

--
-- Constraints for table `clienttestimonial_language`
--
ALTER TABLE `clienttestimonial_language`
  ADD CONSTRAINT `FK_CTL_ClientTestimonialID__CTest_ID` FOREIGN KEY (`CTL_ClientTestimonialID`) REFERENCES `client_testimonial` (`CTest_ID`);

--
-- Constraints for table `client_testimonial`
--
ALTER TABLE `client_testimonial`
  ADD CONSTRAINT `FK_CTest_StakeholderID__Stake_ID` FOREIGN KEY (`CTest_StakeholderID`) REFERENCES `stakeholder` (`Stake_ID`);

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `FK_Album_AddedBy__SysUsr_ID` FOREIGN KEY (`Gall_AddedBy`) REFERENCES `system_user` (`SysUsr_ID`),
  ADD CONSTRAINT `FK_Gall_Status__SysLkp_ID` FOREIGN KEY (`Gall_Status`) REFERENCES `system_lookup` (`SysLkp_ID`);

--
-- Constraints for table `gallerymedia_language`
--
ALTER TABLE `gallerymedia_language`
  ADD CONSTRAINT `FK_GMLang_GalleryMediaID__GallMed_ID` FOREIGN KEY (`GMLang_GalleryMediaID`) REFERENCES `gallery_media` (`GallMed_ID`);

--
-- Constraints for table `gallery_language`
--
ALTER TABLE `gallery_language`
  ADD CONSTRAINT `FK_GalLang_GalleryID__Gall_ID` FOREIGN KEY (`GalLang_GalleryID`) REFERENCES `gallery` (`Gall_ID`);

--
-- Constraints for table `gallery_media`
--
ALTER TABLE `gallery_media`
  ADD CONSTRAINT `FK_GallMed_GalleryID__Gall_ID` FOREIGN KEY (`GallMed_GalleryID`) REFERENCES `gallery` (`Gall_ID`);

--
-- Constraints for table `google_place_language`
--
ALTER TABLE `google_place_language`
  ADD CONSTRAINT `FK_GPL_GooglePlaceType__SysLkp_ID` FOREIGN KEY (`GPL_GooglePlaceType`) REFERENCES `system_lookup` (`SysLkp_ID`);

--
-- Constraints for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD CONSTRAINT `FK_Inq_SeenBy__SysUsr_ID` FOREIGN KEY (`Inq_SeenBy`) REFERENCES `system_user` (`SysUsr_ID`);

--
-- Constraints for table `inquiry_response`
--
ALTER TABLE `inquiry_response`
  ADD CONSTRAINT `FK_InqRes_InquiryID__Inq_ID` FOREIGN KEY (`InqRes_InquiryID`) REFERENCES `inquiry` (`Inq_ID`),
  ADD CONSTRAINT `FK_InqRes_SystemUserID__SysUsr_ID` FOREIGN KEY (`InqRes_SystemUserID`) REFERENCES `system_user` (`SysUsr_ID`);

--
-- Constraints for table `logging_details`
--
ALTER TABLE `logging_details`
  ADD CONSTRAINT `FK_LogDet_MasterID__Log_ID` FOREIGN KEY (`LogDet_MasterID`) REFERENCES `logging_masters` (`Log_ID`);

--
-- Constraints for table `logging_masters`
--
ALTER TABLE `logging_masters`
  ADD CONSTRAINT `FK_Log_UserID__SysUsr_ID` FOREIGN KEY (`Log_UserID`) REFERENCES `system_user` (`SysUsr_ID`);

--
-- Constraints for table `logging_recordpk`
--
ALTER TABLE `logging_recordpk`
  ADD CONSTRAINT `FK_LogPK_MasterID__Log_ID` FOREIGN KEY (`LogPK_MasterID`) REFERENCES `logging_masters` (`Log_ID`);

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `FK_Role_Status__SysLkp_ID` FOREIGN KEY (`Role_Status`) REFERENCES `system_lookup` (`SysLkp_ID`);

--
-- Constraints for table `role_action`
--
ALTER TABLE `role_action`
  ADD CONSTRAINT `FK_RolAct_ActionID__Action_ID` FOREIGN KEY (`RolAct_ActionID`) REFERENCES `action` (`Action_ID`),
  ADD CONSTRAINT `FK_RolAct_RoleID__Role_ID` FOREIGN KEY (`RolAct_RoleID`) REFERENCES `role` (`Role_ID`);

--
-- Constraints for table `stakeholder`
--
ALTER TABLE `stakeholder`
  ADD CONSTRAINT `FK_Stake_AddedBy__SysUsr_ID` FOREIGN KEY (`Stake_AddedBy`) REFERENCES `system_user` (`SysUsr_ID`),
  ADD CONSTRAINT `FK_Stake_Status__SysLkp_ID` FOREIGN KEY (`Stake_Status`) REFERENCES `system_lookup` (`SysLkp_ID`),
  ADD CONSTRAINT `FK_Stake_Type_Type__SysLkp_ID` FOREIGN KEY (`Stake_Type`) REFERENCES `system_lookup` (`SysLkp_ID`);

--
-- Constraints for table `stakeholder_language`
--
ALTER TABLE `stakeholder_language`
  ADD CONSTRAINT `FK_StakeLang_StakeholderID__Stake_ID` FOREIGN KEY (`StakeLang_StakeholderID`) REFERENCES `stakeholder` (`Stake_ID`);

--
-- Constraints for table `systemlookup_language`
--
ALTER TABLE `systemlookup_language`
  ADD CONSTRAINT `FK_LkpLang_SystemLookupID__SysLkp_ID` FOREIGN KEY (`SysLkpLang_SystemLookupID`) REFERENCES `system_lookup` (`SysLkp_ID`);

--
-- Constraints for table `systemuser_action`
--
ALTER TABLE `systemuser_action`
  ADD CONSTRAINT `FK_UsrAct_ActionID__Action_ID` FOREIGN KEY (`UsrAct_ActionID`) REFERENCES `action` (`Action_ID`),
  ADD CONSTRAINT `FK_UsrAct_SystemUserID__SysUsr_ID` FOREIGN KEY (`UsrAct_SystemUserID`) REFERENCES `system_user` (`SysUsr_ID`);

--
-- Constraints for table `systemuser_role`
--
ALTER TABLE `systemuser_role`
  ADD CONSTRAINT `FK_UsrRol_RoleID__Role_ID` FOREIGN KEY (`UsrRol_RoleID`) REFERENCES `role` (`Role_ID`),
  ADD CONSTRAINT `FK_UsrRol_SystemUserID__SysUsr_ID` FOREIGN KEY (`UsrRol_SystemUserID`) REFERENCES `system_user` (`SysUsr_ID`);

--
-- Constraints for table `system_lookup`
--
ALTER TABLE `system_lookup`
  ADD CONSTRAINT `FK_SysLkp_ParentID__SysLkp_ID` FOREIGN KEY (`SysLkp_ParentID`) REFERENCES `system_lookup` (`SysLkp_ID`);

--
-- Constraints for table `system_user`
--
ALTER TABLE `system_user`
  ADD CONSTRAINT `FK_SysUsr_CreatedBy__SysUsr_ID` FOREIGN KEY (`SysUsr_CreatedBy`) REFERENCES `system_user` (`SysUsr_ID`),
  ADD CONSTRAINT `FK_SysUsr_Status__SysLkp_ID` FOREIGN KEY (`SysUsr_Status`) REFERENCES `system_lookup` (`SysLkp_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
