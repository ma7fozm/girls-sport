-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2019 at 08:53 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `girls_sport`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'user who create article',
  `superadmin_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'superadmin id',
  `public` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for superadmin 2 for user',
  `article_type` enum('فريق','جروب','شحصى') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'this determine where article will apear',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `intro`, `content`, `image`, `category_id`, `team_id`, `group_id`, `user_id`, `superadmin_id`, `public`, `article_type`, `status`, `created_at`, `updated_at`) VALUES
(5, 'أسيل الحمد.. سيدة سعودية تقود سيارة فورمولا 1 قبل جائزة فرنسا الكبرى', 'ستعطي أسيل الحمد دفعة أخرى للنساء السعوديات، اليوم الأحد، عن طريق قيادة إحدى سيارات فورمولا 1 قبل سباق جائزة فرنسا الكبرى.  وتأتي هذه اللفة على حلبة لوكاستيليه في اليوم الذي تم فيه رفع الحظر عن قيادة النساء للسيارات في شوارع المملكة.  وقال فريق رينو، إن أسيل ستقود سيارة من العام 2012 ضمن مسيرة لسيارات الشركة الفرنسية احتفالًا بعودة السباق الفرنسي إلى جدول سباقات بطولة العالم بعد غياب عشر سنوات.', 'ستعطي أسيل الحمد دفعة أخرى للنساء السعوديات، اليوم الأحد، عن طريق قيادة إحدى سيارات فورمولا 1 قبل سباق جائزة فرنسا الكبرى.\r\n\r\nوتأتي هذه اللفة على حلبة لوكاستيليه في اليوم الذي تم فيه رفع الحظر عن قيادة النساء للسيارات في شوارع المملكة.\r\n\r\nوقال فريق رينو، إن أسيل ستقود سيارة من العام 2012 ضمن مسيرة لسيارات الشركة الفرنسية احتفالًا بعودة السباق الفرنسي إلى جدول سباقات بطولة العالم بعد غياب عشر سنوات.\r\n\r\nومنحت سيارة لوتس رينو ئي20 السائق الفنلندي كيمي رايكونن بطل العالم 2007 الفوز في سباق أبوظبي في ذلك العام.\r\n\r\nوأسيل هي -بالفعل- أول سيدة تنال عضوية الاتحاد السعودي للسيارات والدراجات النارية، وهي عضو أيضًا في اللجنة النسائية لرياضة السيارات التي أنشأها الاتحاد الدولي للسيارات.', 'uploads/images/articleImages/img_1555088702.jpg', 2, NULL, NULL, 74, 69, 1, 'شحصى', 1, '2019-04-12 23:05:02', '2019-04-12 23:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `articles_comments`
--

CREATE TABLE `articles_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '0 if it is comment id if it is reply of comment',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'superadmin id who create sport',
  `position` enum('هيدر','فوتور') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'superadmin id who create category',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'صحة', 35, 1, '2019-03-09 00:35:12', '2019-03-25 21:26:17'),
(2, 'رياضه', 35, 1, '2019-03-11 15:13:58', '2019-03-11 15:13:58'),
(4, 'توعية', 35, 1, '2019-03-25 21:26:49', '2019-03-25 21:27:07'),
(5, 'قسم 1', 69, 1, '2019-04-12 23:59:41', '2019-04-12 23:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `govarea_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `status`, `govarea_id`, `created_at`, `updated_at`) VALUES
(1, 'مكة المكرمة', 1, 1, '2019-04-08 13:19:12', NULL),
(2, 'المدينة المنورة', 1, 1, '2019-04-08 13:19:27', NULL),
(7, 'الرين', 0, 14, NULL, NULL),
(8, 'محافظة الرياض ', 0, 14, NULL, NULL),
(9, 'الدرعية ', 0, 14, NULL, NULL),
(10, 'الخرج ', 0, 14, NULL, NULL),
(11, 'الدوادمي', 0, 14, NULL, NULL),
(12, 'المجمعة ', 0, 14, NULL, NULL),
(13, 'القويعية', 0, 14, NULL, NULL),
(14, 'الأفلاج ', 0, 14, NULL, NULL),
(15, 'وادي الدواسر ', 0, 14, NULL, NULL),
(16, 'الزلفي', 0, 14, NULL, NULL),
(17, 'شقراء ', 0, 14, NULL, NULL),
(18, 'حوطة بني تميم', 0, 14, NULL, NULL),
(19, 'عفيف\r\n', 0, 14, NULL, NULL),
(20, 'الغاط ', 0, 14, NULL, NULL),
(21, 'السليل', 0, 14, NULL, NULL),
(22, 'ضرما ', 0, 14, NULL, NULL),
(23, 'المزاحمية', 0, 14, NULL, NULL),
(24, 'رماح ثادق \r\n', 0, 14, NULL, NULL),
(25, 'حريملاء ', 0, 14, NULL, NULL),
(26, 'الحريق ', 0, 14, NULL, NULL),
(27, 'مرات', 0, 14, NULL, NULL),
(28, 'مكة المكرمة', 0, 13, NULL, NULL),
(29, 'جدة', 0, 13, NULL, NULL),
(30, 'الطائف', 0, 13, NULL, NULL),
(31, 'القنفذة ', 0, 13, NULL, NULL),
(32, 'الليث\r\n', 0, 13, NULL, NULL),
(33, 'رابغ\r\n', 0, 13, NULL, NULL),
(34, 'خليص', 0, 13, NULL, NULL),
(35, 'الخرمة ', 0, 13, NULL, NULL),
(36, 'رنية', 0, 13, NULL, NULL),
(37, 'تربة', 0, 13, NULL, NULL),
(38, 'الكامل ', 0, 13, NULL, NULL),
(39, 'الجموم', 0, 13, NULL, NULL),
(40, 'المويه', 0, 13, NULL, NULL),
(41, 'ميسان', 0, 13, NULL, NULL),
(42, 'أضم', 0, 13, NULL, NULL),
(43, 'العرضيات', 0, 13, NULL, NULL),
(44, 'بحرة', 0, 13, NULL, NULL),
(45, 'المذنب', 0, 11, NULL, NULL),
(46, 'البكيرية', 0, 11, NULL, NULL),
(47, 'عنيزة', 0, 11, NULL, NULL),
(48, 'الرس ', 0, 11, NULL, NULL),
(49, 'البدائع', 0, 11, NULL, NULL),
(50, 'الأسياح', 0, 11, NULL, NULL),
(51, 'النبهانية ', 0, 11, NULL, NULL),
(52, 'الشماسية', 0, 11, NULL, NULL),
(53, 'ضرية', 0, 11, NULL, NULL),
(54, 'عيون الجواء ', 0, 11, NULL, NULL),
(55, 'رياض الخبراء', 0, 11, NULL, NULL),
(56, 'عقلة الصقور', 0, 11, NULL, NULL),
(57, 'بريدة', 0, 11, NULL, NULL),
(58, 'المدينة المنورة', 0, 12, NULL, NULL),
(59, 'ينبع', 0, 12, NULL, NULL),
(60, 'العلا', 0, 12, NULL, NULL),
(61, 'مهد الذهب ', 0, 12, NULL, NULL),
(62, 'الحناكية', 0, 12, NULL, NULL),
(63, 'بدر', 0, 12, NULL, NULL),
(64, 'خيبر ', 0, 12, NULL, NULL),
(65, 'العيص', 0, 12, NULL, NULL),
(66, 'وادي الفرع\r\n', 0, 12, NULL, NULL),
(67, 'الدمام', 0, 10, NULL, NULL),
(68, 'الأحسام', 0, 10, NULL, NULL),
(69, ' حفر الباطن', 0, 10, NULL, NULL),
(70, 'الجبيل ', 0, 10, NULL, NULL),
(71, 'القطيف', 0, 10, NULL, NULL),
(72, 'الخبر', 0, 10, NULL, NULL),
(73, 'الخفجي ', 0, 10, NULL, NULL),
(74, 'رأس تنورة', 0, 10, NULL, NULL),
(75, 'بقيق\r\n', 0, 10, NULL, NULL),
(76, 'النعيرية ', 0, 10, NULL, NULL),
(77, 'قرية العليا', 0, 10, NULL, NULL),
(78, 'الحرجة', 0, 9, NULL, NULL),
(79, 'أبها', 0, 9, NULL, NULL),
(80, '  \r\nخميس مشيط', 0, 9, NULL, NULL),
(81, 'بيشة ', 0, 9, NULL, NULL),
(82, 'النماص', 0, 9, NULL, NULL),
(83, 'محايل عسير', 0, 9, NULL, NULL),
(84, 'ظهران الجنوب ', 0, 9, NULL, NULL),
(85, 'تثليت', 0, 9, NULL, NULL),
(86, 'سراة العبيد', 0, 9, NULL, NULL),
(87, 'رجال ألمع ', 0, 9, NULL, NULL),
(88, 'بلقرن', 0, 9, NULL, NULL),
(89, 'أحد رفيدة', 0, 9, NULL, NULL),
(90, 'المجاردة', 0, 9, NULL, NULL),
(91, 'البرك', 0, 9, NULL, NULL),
(92, 'بارق', 0, 9, NULL, NULL),
(93, 'تنومة', 0, 9, NULL, NULL),
(94, 'طريب', 0, 9, NULL, NULL),
(95, 'الحرجة', 0, 9, NULL, NULL),
(96, 'تبوك', 0, 8, NULL, NULL),
(97, 'الوجه', 0, 8, NULL, NULL),
(98, '  \r\nضبا', 0, 8, NULL, NULL),
(99, 'بيشة ', 0, 8, NULL, NULL),
(100, 'تيماء', 0, 8, NULL, NULL),
(101, 'أملج', 0, 8, NULL, NULL),
(102, 'حقل ', 0, 8, NULL, NULL),
(103, 'البدع', 0, 8, NULL, NULL),
(104, 'حائل', 0, 7, NULL, NULL),
(105, 'بقعاء', 0, 7, NULL, NULL),
(106, '  \r\nالغزالة', 0, 7, NULL, NULL),
(107, 'الشنان ', 0, 7, NULL, NULL),
(108, 'الحائط', 0, 7, NULL, NULL),
(109, 'السليمي', 0, 7, NULL, NULL),
(110, 'الشملي ', 0, 7, NULL, NULL),
(111, 'موقق', 0, 7, NULL, NULL),
(112, 'سميراء', 0, 7, NULL, NULL),
(113, 'عرعر', 0, 1, NULL, NULL),
(114, 'رفحاء', 0, 1, NULL, NULL),
(115, '  \r\nطريف', 0, 1, NULL, NULL),
(116, 'العويقية ', 0, 1, NULL, NULL),
(117, 'جازان', 0, 6, NULL, NULL),
(118, 'صبيا', 0, 6, NULL, NULL),
(119, '  \r\nأبو العريش', 0, 6, NULL, NULL),
(120, 'صامطة ', 0, 6, NULL, NULL),
(121, 'بيش', 0, 6, NULL, NULL),
(122, 'الدرب', 0, 6, NULL, NULL),
(123, 'الحرث ', 0, 6, NULL, NULL),
(124, 'ضمد', 0, 6, NULL, NULL),
(125, 'الريث', 0, 6, NULL, NULL),
(126, 'جزر فرسان', 0, 6, NULL, NULL),
(127, 'الدائر', 0, 6, NULL, NULL),
(128, 'العارضة', 0, 6, NULL, NULL),
(129, 'أحد المسارحة', 0, 6, NULL, NULL),
(130, 'العيدابي', 0, 6, NULL, NULL),
(131, 'فيفاء', 0, 6, NULL, NULL),
(132, 'الطوال', 0, 6, NULL, NULL),
(133, 'هروب', 0, 6, NULL, NULL),
(134, 'نجران', 0, 5, NULL, NULL),
(135, 'شرورة', 0, 5, NULL, NULL),
(136, '  \r\nحبونا', 0, 5, NULL, NULL),
(137, 'بدر الجنوب ', 0, 5, NULL, NULL),
(138, 'يدمه', 0, 5, NULL, NULL),
(139, 'ثار', 0, 5, NULL, NULL),
(140, 'خباش ', 0, 5, NULL, NULL),
(141, 'الخرخير', 0, 5, NULL, NULL),
(142, 'الباحة', 0, 4, NULL, NULL),
(143, 'بلجرشي', 0, 4, NULL, NULL),
(144, '  \r\nالمندق', 0, 4, NULL, NULL),
(145, 'المخواة ', 0, 4, NULL, NULL),
(146, 'قلوة', 0, 4, NULL, NULL),
(147, 'العقيق', 0, 4, NULL, NULL),
(148, 'القرى ', 0, 4, NULL, NULL),
(149, 'غامد الزناد', 0, 4, NULL, NULL),
(150, 'الحجرة', 0, 4, NULL, NULL),
(151, 'بنى حسن', 0, 4, NULL, NULL),
(152, 'سكاكا', 0, 3, NULL, NULL),
(153, 'القريات', 0, 3, NULL, NULL),
(154, '  \r\nدومة الجندل', 0, 3, NULL, NULL),
(155, 'طبرجل ', 0, 3, NULL, NULL),
(156, 'الوراق', 1, 25, NULL, NULL),
(157, 'بولاق الدكرور', 1, 25, NULL, NULL),
(158, 'الدقي', 1, 25, NULL, NULL),
(159, 'العجوزة', 1, 25, NULL, NULL),
(160, 'العمرانية', 1, 25, NULL, NULL),
(161, 'الهرم', 1, 25, NULL, NULL),
(162, 'السادس من اكتوبر', 1, 25, NULL, NULL),
(163, 'الشيخ زايد', 1, 25, NULL, NULL),
(164, 'الحوامدية', 1, 25, NULL, NULL),
(165, 'البدرشين', 1, 25, NULL, NULL),
(166, 'الصف', 1, 25, NULL, NULL),
(167, 'أطفيح', 1, 25, NULL, NULL),
(168, 'العياط', 1, 25, NULL, NULL),
(169, 'الباويطي', 1, 25, NULL, NULL),
(170, 'منشأة القناطر', 1, 25, NULL, NULL),
(171, 'أوسيم', 1, 25, NULL, NULL),
(172, 'كرداسة', 1, 25, NULL, NULL),
(173, 'أبو نمرس', 1, 25, NULL, NULL),
(174, 'المنتزه', 1, 15, NULL, NULL),
(175, 'الجمرك', 1, 15, NULL, NULL),
(176, 'العجمي', 1, 15, NULL, NULL),
(177, 'العامرية', 1, 15, NULL, NULL),
(178, 'برج العرب', 1, 15, NULL, NULL),
(179, 'العرب الجديدة', 1, 15, NULL, NULL),
(180, 'الزيتون ', 1, 2, NULL, NULL),
(181, 'الزاوية الحمراء ', 1, 2, NULL, NULL),
(184, 'الإسماعيلية', 1, 16, NULL, NULL),
(185, 'فايد', 1, 16, NULL, NULL),
(186, 'حدائق القبة', 1, 2, NULL, NULL),
(187, 'الشرابية', 1, 2, NULL, NULL),
(188, 'القنطرة', 1, 16, NULL, NULL),
(189, 'التل الكبير', 1, 16, NULL, NULL),
(190, 'أبو صوير المحطة', 1, 16, NULL, NULL),
(191, 'الفصاصين الجديدة', 1, 16, NULL, NULL),
(192, 'أسوان', 1, 17, NULL, NULL),
(193, 'أسوان الجديدة', 1, 17, NULL, NULL),
(194, 'دراو', 1, 17, NULL, NULL),
(195, 'كوم أمبو', 1, 17, NULL, NULL),
(196, 'الساحل ', 1, 2, NULL, NULL),
(197, 'شبرا', 1, 26, NULL, NULL),
(198, 'نصر النوية', 1, 17, NULL, NULL),
(199, 'كلابشة', 1, 17, NULL, NULL),
(200, 'الرديسية', 1, 17, NULL, NULL),
(201, 'السباعية', 1, 17, NULL, NULL),
(202, 'روض الفرج', 1, 26, NULL, NULL),
(203, 'الأميرية', 1, 2, NULL, NULL),
(204, 'السلام', 1, 2, NULL, NULL),
(205, 'المرج', 1, 26, NULL, NULL),
(206, 'المطرية', 1, 2, NULL, NULL),
(207, 'عين شمس', 1, 2, NULL, NULL),
(208, 'المنصورة', 1, 28, '2019-02-03 07:00:00', '2019-02-18 23:21:49'),
(209, 'النزهة ', 1, 2, NULL, NULL),
(210, 'مصر الجديدة', 1, 2, NULL, NULL),
(211, 'أبو سمبل', 1, 17, NULL, NULL),
(212, 'أسيوط', 1, 18, NULL, NULL),
(213, 'مدينة نصر ', 1, 2, NULL, NULL),
(214, 'الوايلي', 1, 2, NULL, NULL),
(215, 'أسيوط الجديدة', 1, 18, NULL, NULL),
(216, 'منفلوط', 1, 18, NULL, NULL),
(217, 'منشأة ناصر باب الشعرية\r\n', 1, 2, NULL, NULL),
(218, 'الأزبكية', 1, 2, NULL, NULL),
(219, 'ديروط', 1, 18, NULL, NULL),
(220, 'القوصية', 1, 18, NULL, NULL),
(221, 'أبنوب', 1, 18, NULL, NULL),
(222, 'أبو تيج', 1, 18, NULL, NULL),
(223, 'بولاق ', 1, 26, NULL, NULL),
(224, 'الموسكي', 1, 2, NULL, NULL),
(225, 'ساحل سليم', 1, 18, NULL, NULL),
(226, 'البداري', 1, 18, NULL, NULL),
(227, 'عابدين', 1, 2, NULL, NULL),
(228, 'المقطم', 1, 2, NULL, NULL),
(229, 'طلخا ', 1, 28, '2019-02-03 07:00:00', '2019-02-18 23:21:49'),
(230, 'صدفا', 1, 18, NULL, NULL),
(231, 'الأقصر', 1, 19, NULL, NULL),
(232, 'الخليفة', 1, 2, NULL, NULL),
(233, 'السيدة زينب', 1, 2, NULL, NULL),
(234, 'ميت غمر ', 1, 28, '2019-02-03 07:00:00', '2019-02-18 23:21:49'),
(235, 'الأقصر الجديدة', 1, 19, NULL, NULL),
(236, 'طيبة الجديدة', 1, 19, NULL, NULL),
(237, 'دكرنس', 1, 28, '2019-02-03 07:00:00', '2019-02-18 23:21:49'),
(238, 'البياضية', 1, 19, NULL, NULL),
(239, 'الزينية', 1, 19, NULL, NULL),
(240, 'مصر القديمة', 1, 2, NULL, NULL),
(241, 'دار السلام', 1, 2, NULL, NULL),
(242, 'أجا', 1, 28, '2019-02-03 07:00:00', '2019-02-18 23:21:49'),
(243, 'القرنة', 1, 19, NULL, NULL),
(244, 'أرمنت', 1, 19, NULL, NULL),
(245, 'منية النصر ', 1, 28, '2019-02-03 07:00:00', '2019-02-18 23:21:49'),
(246, 'البساتين', 1, 2, NULL, NULL),
(247, 'المعادى', 1, 2, NULL, NULL),
(248, 'السنبلاوين', 1, 28, '2019-02-03 07:00:00', NULL),
(249, 'الطود', 1, 19, NULL, NULL),
(250, 'إسنا', 1, 19, NULL, NULL),
(251, 'طرة', 1, 2, NULL, NULL),
(252, 'المعصرة', 1, 2, NULL, NULL),
(253, 'الغردقة', 1, 20, NULL, NULL),
(254, 'رأس غارب', 1, 20, NULL, NULL),
(255, 'الكردي ', 1, 28, '2019-02-03 07:00:00', NULL),
(256, '15 مايو', 1, 2, NULL, NULL),
(257, 'حلوان', 1, 2, NULL, NULL),
(258, 'سفاجا', 1, 20, NULL, NULL),
(259, 'مرسى علم', 1, 20, NULL, NULL),
(260, 'التنين', 1, 2, NULL, NULL),
(261, 'القاهرة الجديدة', 1, 2, NULL, NULL),
(262, 'بني عبيد', 1, 28, '2019-02-03 07:00:00', NULL),
(263, 'القصير', 1, 20, NULL, NULL),
(264, 'الشلاتين', 1, 20, NULL, NULL),
(265, 'بدر', 1, 2, NULL, NULL),
(266, 'الشروق', 1, 2, NULL, NULL),
(267, 'المنزلة', 1, 28, '2019-02-03 07:00:00', NULL),
(268, 'حلايب', 1, 20, NULL, NULL),
(269, 'دمنهور', 1, 21, NULL, NULL),
(270, 'تمي الأمديد', 1, 28, '2019-02-03 07:00:00', NULL),
(271, 'كفر الدوار', 1, 21, NULL, NULL),
(272, 'رشيد', 1, 21, NULL, NULL),
(273, 'الجمالية', 1, 28, NULL, NULL),
(274, 'شربين', 1, 28, NULL, NULL),
(275, 'المطرية', 1, 28, NULL, NULL),
(276, 'إدكو', 1, 21, NULL, NULL),
(277, 'أبو المطامير', 1, 21, NULL, NULL),
(278, 'بلقاس ', 1, 28, NULL, NULL),
(279, 'أبو حمص', 1, 21, NULL, NULL),
(280, 'الدلنجات', 1, 21, NULL, NULL),
(281, 'ميت سلسيل', 1, 28, NULL, NULL),
(282, 'جمصة', 1, 28, NULL, NULL),
(283, 'المحمودية', 1, 21, NULL, NULL),
(284, 'الرحمانية', 1, 21, NULL, NULL),
(285, 'محلة دمنة', 1, 28, NULL, NULL),
(286, 'نبروه', 1, 28, NULL, NULL),
(287, 'إيتاي البارود', 1, 21, NULL, NULL),
(288, 'حوش عيسى', 1, 21, NULL, NULL),
(289, 'شبراخيت', 1, 21, NULL, NULL),
(290, 'كوم حمادة', 1, 21, NULL, NULL),
(291, 'بدر', 1, 21, NULL, NULL),
(292, 'وادي النطرون', 1, 21, NULL, NULL),
(293, 'كفر الشيخ', 1, 35, NULL, NULL),
(294, 'دسوق ', 1, 35, NULL, NULL),
(295, 'فوه', 1, 35, NULL, NULL),
(296, 'مطوبس', 1, 35, NULL, NULL),
(297, 'بلطيم', 1, 35, NULL, NULL),
(298, 'الحامول', 1, 35, NULL, NULL),
(299, 'بني سويف', 1, 22, NULL, NULL),
(300, 'بني سويف', 1, 22, NULL, NULL),
(301, 'بنها ', 1, 27, NULL, NULL),
(302, 'قليوب', 1, 27, NULL, NULL),
(303, 'بيلا ', 1, 35, NULL, NULL),
(304, 'الواسطي', 1, 22, NULL, NULL),
(305, 'ناصر', 1, 22, NULL, NULL),
(306, 'الرياض', 1, 35, NULL, NULL),
(307, 'شبرا الخيمة', 1, 27, NULL, NULL),
(308, 'القناطر الخيرية', 1, 27, NULL, NULL),
(309, 'سيدي سالم', 1, 35, NULL, NULL),
(310, 'إهناسيا', 1, 22, NULL, NULL),
(311, 'ببا', 1, 22, NULL, NULL),
(312, 'قلين', 1, 35, NULL, NULL),
(313, 'الخانكة ', 1, 27, NULL, NULL),
(314, 'كفر شكر', 1, 27, NULL, NULL),
(315, 'سمسطا', 1, 22, NULL, NULL),
(316, 'الفشن', 1, 22, NULL, NULL),
(317, 'سيدي غازي ', 1, 35, NULL, NULL),
(318, 'طوخ', 1, 27, NULL, NULL),
(319, 'قها', 1, 27, NULL, NULL),
(320, 'برج البرلس', 1, 35, NULL, NULL),
(321, 'العبور', 1, 27, NULL, NULL),
(322, 'الخصوص', 1, 27, NULL, NULL),
(323, 'شبين القناطر', 1, 27, NULL, NULL),
(324, 'بورسعيد', 1, 23, NULL, NULL),
(325, 'الضواحي', 1, 23, NULL, NULL),
(326, 'طنطا', 1, 36, NULL, NULL),
(327, 'المحلة الكبري', 1, 36, NULL, NULL),
(328, 'الزهور', 1, 23, NULL, NULL),
(329, 'المناخ', 1, 23, NULL, NULL),
(330, 'كفر الزيات ', 1, 36, NULL, NULL),
(331, 'زفتى', 1, 36, NULL, NULL),
(332, 'السنطة', 1, 36, NULL, NULL),
(333, 'قطور', 1, 36, NULL, NULL),
(334, 'بور فؤاد', 1, 23, NULL, NULL),
(335, 'الطور', 1, 24, NULL, NULL),
(336, 'بسيون', 1, 36, NULL, NULL),
(337, 'سمنود', 1, 36, NULL, NULL),
(338, 'شرم الشيخ', 1, 24, NULL, NULL),
(339, 'دهب', 1, 24, NULL, NULL),
(340, 'نويبع', 1, 24, NULL, NULL),
(341, 'طابا', 1, 24, NULL, NULL),
(342, 'سانت كاترين', 1, 24, NULL, NULL),
(343, 'أبو دريس', 1, 24, NULL, NULL),
(344, 'شبين الكوم', 1, 37, NULL, NULL),
(345, 'مدينة السادات', 1, 37, NULL, NULL),
(346, 'أبو زنيمة', 1, 24, NULL, NULL),
(347, 'رأس سدر', 1, 24, NULL, NULL),
(348, 'منوف', 1, 37, NULL, NULL),
(349, 'سرس الليان', 1, 37, NULL, NULL),
(350, 'أشمون', 1, 37, NULL, NULL),
(351, 'الباجور', 1, 37, NULL, NULL),
(352, 'قويسنا', 1, 37, NULL, NULL),
(353, 'بركة السبع', 1, 37, NULL, NULL),
(354, 'تلا', 1, 37, NULL, NULL),
(355, 'الشهداء', 1, 37, NULL, NULL),
(357, 'سوهاج', 1, 38, NULL, NULL),
(358, 'سوهاج الجديدة', 1, 38, NULL, NULL),
(359, 'أخميم', 1, 38, NULL, NULL),
(360, 'أخميم الجديدة', 1, 38, NULL, NULL),
(361, 'البلينا', 1, 38, NULL, NULL),
(362, 'المراغة', 1, 38, NULL, NULL),
(363, 'المنشأة ', 1, 38, NULL, NULL),
(364, 'دار السلام', 1, 38, NULL, NULL),
(365, 'جرجا', 1, 38, NULL, NULL),
(366, '\r\nجهينة الغربية', 1, 38, NULL, NULL),
(367, 'ساقتلة', 1, 38, NULL, NULL),
(368, 'طما', 1, 38, NULL, NULL),
(369, 'طهطا', 1, 38, NULL, NULL),
(370, 'السويس', 1, 39, NULL, NULL),
(371, 'الأربعين', 1, 39, NULL, NULL),
(372, 'عتاقة', 1, 39, NULL, NULL),
(373, 'عتاقة', 1, 39, NULL, NULL),
(374, 'فيصل', 1, 39, NULL, NULL),
(375, 'الزقازيق', 1, 40, NULL, NULL),
(376, 'العاشر من رمضان', 1, 40, NULL, NULL),
(377, 'منيا القمح', 1, 40, NULL, NULL),
(378, 'بلبيس', 1, 40, NULL, NULL),
(379, 'قنا', 1, 29, NULL, NULL),
(380, 'قنا الجديدة', 1, 29, NULL, NULL),
(381, 'أبو تشت', 1, 35, NULL, NULL),
(382, 'نجع حمادي', 1, 29, NULL, NULL),
(383, 'دشنا ', 1, 29, NULL, NULL),
(384, 'الوقف', 1, 29, NULL, NULL),
(385, 'قفط', 1, 29, NULL, NULL),
(386, 'نقادة', 1, 29, NULL, NULL),
(387, 'فرشوط', 1, 29, NULL, NULL),
(388, 'الحمام', 1, 31, NULL, NULL),
(389, 'العلمين', 1, 31, NULL, NULL),
(390, 'الضبعة', 1, 31, NULL, NULL),
(391, 'النجيلة', 1, 31, NULL, NULL),
(392, 'سيدي براني', 1, 31, NULL, NULL),
(393, 'السلوم', 1, 31, NULL, NULL),
(394, 'سيوة', 1, 31, NULL, NULL),
(395, 'القنايات', 1, 40, NULL, NULL),
(396, 'أبو حماد', 1, 40, NULL, NULL),
(397, 'القرين', 1, 40, NULL, NULL),
(398, 'ههيا', 1, 40, NULL, NULL),
(399, 'أبو كبير', 1, 40, NULL, NULL),
(400, 'فاقوس', 1, 40, NULL, NULL),
(401, 'الصالحية الجديدة', 1, 40, NULL, NULL),
(402, 'الإبراهيمية', 1, 40, NULL, NULL),
(403, 'كفر صقر ', 1, 40, NULL, NULL),
(404, 'الفيوم', 1, 41, NULL, NULL),
(405, 'الفيوم الجديدة', 1, 41, NULL, NULL),
(406, 'طامية', 1, 41, NULL, NULL),
(407, 'سنورس', 1, 41, NULL, NULL),
(408, 'أولاد صقر', 1, 40, NULL, NULL),
(409, 'الحسينية', 1, 40, NULL, NULL),
(410, 'صان الحجر القبلية', 1, 40, NULL, NULL),
(411, 'منشأة أبو عمر', 1, 40, NULL, NULL),
(412, 'إطسا', 1, 41, NULL, NULL),
(413, 'إبشوى', 1, 41, NULL, NULL),
(414, 'يوسف الصديق', 1, 41, NULL, NULL),
(415, 'دمياط ', 1, 44, NULL, NULL),
(416, 'المنيا', 1, 33, NULL, NULL),
(417, 'المنيا الجديدة', 1, 33, NULL, NULL),
(418, 'دمياط الجديدة', 1, 44, NULL, NULL),
(419, 'رأس البر ', 1, 44, NULL, NULL),
(420, 'العدوة', 1, 33, NULL, NULL),
(421, 'مغاغة', 1, 33, NULL, NULL),
(422, 'فارسكور', 1, 44, NULL, NULL),
(423, 'كفر سعد', 1, 44, NULL, NULL),
(424, 'بني مزار', 1, 33, NULL, NULL),
(425, 'مطاى', 1, 33, NULL, NULL),
(426, 'الزرقا', 1, 44, NULL, NULL),
(427, 'سمالوط', 1, 33, NULL, NULL),
(428, 'المدينة الفكرية', 1, 33, NULL, NULL),
(429, 'السرو', 1, 44, NULL, NULL),
(430, 'الروضة', 1, 44, NULL, NULL),
(431, 'ملوى', 1, 33, NULL, NULL),
(432, 'دير مواس', 1, 33, NULL, NULL),
(433, 'كفر البطيخ', 1, 44, NULL, NULL),
(434, 'عزبة البرج', 1, 44, NULL, NULL),
(435, 'ميت أبو غالب', 1, 44, NULL, NULL),
(436, 'العريش', 1, 42, NULL, NULL),
(437, 'الشيخ زايد', 1, 42, NULL, NULL),
(438, 'رفح ', 1, 42, NULL, NULL),
(439, 'بئر العبد', 1, 42, NULL, NULL),
(440, 'الحسنة', 1, 42, NULL, NULL),
(441, 'نخل', 1, 42, NULL, NULL),
(442, 'الخارجة', 1, 43, NULL, NULL),
(443, 'باريس', 1, 43, NULL, NULL),
(444, 'موط', 1, 43, NULL, NULL),
(445, 'الفرافرة', 1, 43, NULL, NULL),
(446, 'بلاط', 1, 43, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('area','gov','','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `type`, `created_at`, `updated_at`) VALUES
(1, 'مصر', '20', 'gov', NULL, NULL),
(5, 'المملكة العربية السعودية', '', 'area', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'superadmin id who create event or admin according to public feild if public 1 superadmin creat event',
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for superadmin 2 for user',
  `event_type` enum('عام','لا للفراغ','صحه','مباريات','فريق','جروب') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'this determine where event will apear',
  `num_of_attendees` int(11) NOT NULL,
  `from_datetime` datetime NOT NULL,
  `to_datetime` datetime NOT NULL,
  `agenda` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `place_id`, `user_id`, `team_id`, `group_id`, `image`, `public`, `event_type`, `num_of_attendees`, `from_datetime`, `to_datetime`, `agenda`, `status`, `created_at`, `updated_at`) VALUES
(13, 'بطولة العالم لسباقات \"الفورمولا 1\"', 10, 69, NULL, NULL, 'uploads/images/eventImages/img_1555091694.png', 1, 'لا للفراغ', 50, '2019-04-12 20:54:00', '2019-05-15 20:54:00', 'بطولة العالم لسباقات \"الفورمولا 1\"', 1, '2019-04-12 23:54:54', '2019-04-12 23:54:54'),
(14, 'مبارة كرة سلة', 9, 69, NULL, NULL, 'uploads/images/eventImages/img_1555091817.jpg', 1, 'لا للفراغ', 300, '2019-04-19 20:56:00', '2019-04-24 20:56:00', 'مبارة كرة سلة', 1, '2019-04-12 23:56:57', '2019-04-12 23:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `event_albums`
--

CREATE TABLE `event_albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_album_media`
--

CREATE TABLE `event_album_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_album_id` int(10) UNSIGNED NOT NULL,
  `media_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_comments`
--

CREATE TABLE `event_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '0 if it is comment id if it is reply of comment',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_sponsers`
--

CREATE TABLE `event_sponsers` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED DEFAULT NULL,
  `sponser_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_users`
--

CREATE TABLE `event_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `govareas`
--

CREATE TABLE `govareas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `govareas`
--

INSERT INTO `govareas` (`id`, `name`, `status`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'المنطقة الشمالية', 1, 5, NULL, NULL),
(2, 'القاهرة', 1, 1, NULL, NULL),
(3, 'منطقة الجوف', 0, 5, NULL, NULL),
(4, 'منطقة الباحة \r\n', 0, 5, NULL, NULL),
(5, 'منطقة نجران \r\n', 0, 5, NULL, NULL),
(6, 'منطقة جازان ', 0, 5, NULL, NULL),
(7, 'منطقة حائل', 0, 5, NULL, NULL),
(8, 'منطقة تبوك', 0, 5, NULL, NULL),
(9, 'منطقة عسير \r\n', 0, 5, NULL, NULL),
(10, 'منطقة الشرقية ', 0, 5, NULL, NULL),
(11, 'منطقة القصيم', 0, 5, NULL, NULL),
(12, 'منطقة المدينة المنورة', 0, 5, NULL, NULL),
(13, 'منطقة مكة المكرمة', 0, 5, NULL, NULL),
(14, 'منطقة الرياض', 0, 5, NULL, NULL),
(15, 'الإسكندرية', 1, 1, NULL, NULL),
(16, 'الإسماعيلية', 1, 1, NULL, NULL),
(17, 'أسوان', 1, 1, NULL, NULL),
(18, 'أسيوط', 1, 1, NULL, NULL),
(19, 'الأقصر', 1, 1, NULL, NULL),
(20, 'البحر الاحمر', 1, 1, NULL, NULL),
(21, 'البحيرة', 1, 1, NULL, NULL),
(22, 'بني سويف', 1, 1, NULL, NULL),
(23, 'بورسعيد', 1, 1, NULL, NULL),
(24, 'جنوب سيناء', 1, 1, NULL, NULL),
(25, 'الجيزة', 1, 1, NULL, NULL),
(26, 'القاهرة', 1, 1, NULL, NULL),
(27, 'القليوبية', 1, 1, NULL, NULL),
(28, 'الدقهلية', 1, 1, '2019-02-03 07:00:00', '2019-02-18 23:21:49'),
(29, 'قنا', 1, 1, NULL, NULL),
(31, 'مطروح ', 1, 1, NULL, NULL),
(33, 'المنيا', 1, 1, NULL, NULL),
(34, 'الوادي الجديد', 1, 1, NULL, NULL),
(35, ' كفر الشيخ', 1, 1, NULL, NULL),
(36, 'الغربية', 1, 1, NULL, NULL),
(37, 'المنوفية', 1, 1, NULL, NULL),
(38, ' سوهاج', 1, 1, NULL, NULL),
(39, 'السويس', 1, 1, NULL, NULL),
(40, 'الشرقية', 1, 1, NULL, NULL),
(41, 'الفيوم', 1, 1, NULL, NULL),
(42, 'شمال سيناء', 1, 1, NULL, NULL),
(43, 'الوادي الجديد', 1, 1, NULL, NULL),
(44, 'دمياط', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'superadmin id if create group',
  `admin_id` int(10) UNSIGNED NOT NULL COMMENT 'admin of group must have role 5',
  `sport_id` int(10) UNSIGNED DEFAULT NULL,
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE `group_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leagues`
--

CREATE TABLE `leagues` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'superadmin id who create category',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`id`, `name`, `description`, `user_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'دورى اول', 'لم تُصدق البريطانية \"جوان رادكليف\" أن نشرها لفيديو يظهر فيه طفلها الصغير \"جاكسون لال\" أثناء مُداعبته لكرة القدم في الفناء الخلفي لمنزلها الشخصي، سيقربه من الانضمام لأحد أكبر أندية البريميرليج.\r\n\r\nوبعدما قامت جوان بنشر هذا الفيديو علىصفحتها الشخصية بموقع التواصل الاجتماعي فيس بوك، انتشر سريعاً على العديد من الصفحات، قبل أن تلتقطه عين أحد كشافة السيتيزينس، ليقوم بالاتصال بوالدة الطفل الذي لا يتعدّ عمره الـ3 أعوام فقط، ليخبرها برغبة مُدربي أكاديمية النادي في رؤيته من أجل ضمه لمدرسة الناشئين.\r\n\r\nومن جانبها، علقَّت الأم التي تشجع الفريق الآخر للمدينة \"مانشستر يونايتد\" قائلةً في تصريحاتٍ لصحيفة مانشستر إيفينينج نيوز \"لم أتخيل ان يحدث كل هذا. كنت أعلم أن جاكسون يمتلك موهبةً في لعبة كرة القدم، فقد بدأ بركل الكرة فور تعلمه للمشي في عامه الأول، وازداد شغفه بها بعدما رأى شقيقه الأكبر ريلي -4 أعوام- يُمارسها بنادي ميدلوك جونيورز للهواة قبل 5 اشهر\".', 35, 'uploads/images/leaguesImages/img_1552063608.jpg', 1, '2019-03-08 04:58:22', '2019-03-12 17:42:39'),
(3, 'دوري الابطال', 'لم تُصدق البريطانية \"جوان رادكليف\" أن نشرها لفيديو يظهر فيه طفلها الصغير \"جاكسون لال\" أثناء مُداعبته لكرة القدم في الفناء الخلفي لمنزلها الشخصي، سيقربه من الانضمام لأحد أكبر أندية البريميرليج.\r\n\r\nوبعدما قامت جوان بنشر هذا الفيديو علىصفحتها الشخصية بموقع التواصل الاجتماعي فيس بوك، انتشر سريعاً على العديد من الصفحات، قبل أن تلتقطه عين أحد كشافة السيتيزينس، ليقوم بالاتصال بوالدة الطفل الذي لا يتعدّ عمره الـ3 أعوام فقط، ليخبرها برغبة مُدربي أكاديمية النادي في رؤيته من أجل ضمه لمدرسة الناشئين.\r\n\r\nومن جانبها، علقَّت الأم التي تشجع الفريق الآخر للمدينة \"مانشستر يونايتد\" قائلةً في تصريحاتٍ لصحيفة مانشستر إيفينينج نيوز \"لم أتخيل ان يحدث كل هذا. كنت أعلم أن جاكسون يمتلك موهبةً في لعبة كرة القدم، فقد بدأ بركل الكرة فور تعلمه للمشي في عامه الأول، وازداد شغفه بها بعدما رأى شقيقه الأكبر ريلي -4 أعوام- يُمارسها بنادي ميدلوك جونيورز للهواة قبل 5 اشهر\".', 35, 'uploads/images/leaguesImages/img_1552063590.jpg', 1, '2019-03-08 23:46:30', '2019-03-12 17:42:48'),
(5, 'الدوري المصرى', 'لم تُصدق البريطانية \"جوان رادكليف\" أن نشرها لفيديو يظهر فيه طفلها الصغير \"جاكسون لال\" أثناء مُداعبته لكرة القدم في الفناء الخلفي لمنزلها الشخصي، سيقربه من الانضمام لأحد أكبر أندية البريميرليج.\r\n\r\nوبعدما قامت جوان بنشر هذا الفيديو علىصفحتها الشخصية بموقع التواصل الاجتماعي فيس بوك، انتشر سريعاً على العديد من الصفحات، قبل أن تلتقطه عين أحد كشافة السيتيزينس، ليقوم بالاتصال بوالدة الطفل الذي لا يتعدّ عمره الـ3 أعوام فقط، ليخبرها برغبة مُدربي أكاديمية النادي في رؤيته من أجل ضمه لمدرسة الناشئين.\r\n\r\nومن جانبها، علقَّت الأم التي تشجع الفريق الآخر للمدينة \"مانشستر يونايتد\" قائلةً في تصريحاتٍ لصحيفة مانشستر إيفينينج نيوز \"لم أتخيل ان يحدث كل هذا. كنت أعلم أن جاكسون يمتلك موهبةً في لعبة كرة القدم، فقد بدأ بركل الكرة فور تعلمه للمشي في عامه الأول، وازداد شغفه بها بعدما رأى شقيقه الأكبر ريلي -4 أعوام- يُمارسها بنادي ميدلوك جونيورز للهواة قبل 5 اشهر\".', 35, 'uploads/images/leaguesImages/img_1553165212.jpg', 1, '2019-03-12 17:42:13', '2019-03-21 16:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `league_comments`
--

CREATE TABLE `league_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `leagues_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'league_id',
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '0 if it is comment id if it is reply of comment',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `league_comments`
--

INSERT INTO `league_comments` (`id`, `leagues_id`, `user_id`, `comment`, `parent`, `status`, `created_at`, `updated_at`) VALUES
(4, NULL, 35, 'tessssssssssssssssssssssst', 0, 1, '2019-03-08 23:58:37', '2019-03-08 23:58:37'),
(5, NULL, 35, 'test2', 0, 1, '2019-03-09 00:09:41', '2019-03-09 00:09:41'),
(6, 2, 35, 'test', 0, 1, '2019-03-09 00:25:31', '2019-03-09 00:25:56'),
(7, 5, 100, 'kjhbdzukgyg', 0, 1, '2019-04-17 15:17:27', '2019-04-17 15:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'superadmin id who create match',
  `league_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'league_id',
  `place_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `match_type` enum('team','single') COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `title`, `description`, `user_id`, `league_id`, `place_id`, `date`, `start_time`, `end_time`, `match_type`, `result`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'الكلاسيكو', 'مبارة كبيرة', 35, 3, 7, '2019-04-18', '19:00:00', '21:00:00', 'team', NULL, 'uploads/images/matchImages/img_1555522119.jpg', 1, '2019-04-17 15:28:39', '2019-04-17 15:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `match_comments`
--

CREATE TABLE `match_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `match_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '0 if it is comment id if it is reply of comment',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `match_sponsers`
--

CREATE TABLE `match_sponsers` (
  `id` int(10) UNSIGNED NOT NULL,
  `match_id` int(10) UNSIGNED DEFAULT NULL,
  `sponser_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `match_sponsers`
--

INSERT INTO `match_sponsers` (`id`, `match_id`, `sponser_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2019-04-17 15:28:39', '2019-04-17 15:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `match_team`
--

CREATE TABLE `match_team` (
  `id` int(10) UNSIGNED NOT NULL,
  `match_id` int(10) UNSIGNED DEFAULT NULL,
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `match_team`
--

INSERT INTO `match_team` (`id`, `match_id`, `team_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 1, NULL, NULL),
(2, 1, 8, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `match_user`
--

CREATE TABLE `match_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `match_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('صورة','ملف صوت','فيديو') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'type of uploaded file',
  `media_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'may be user id  or superadmin id according to public feild',
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `public` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for public 2 for private',
  `added_by` int(10) UNSIGNED DEFAULT NULL COMMENT 'id of person who add this media',
  `media_type` enum('فاعليه','رياضه','لا للفراغ','صحه','جروب','فريق','عضو','عام') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'this determine where media will apear',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `name`, `title`, `description`, `type`, `media_link`, `user_id`, `team_id`, `group_id`, `status`, `public`, `added_by`, `media_type`, `created_at`, `updated_at`) VALUES
(3, '4.jpg', 'mmuuuuumm', 'mmmpp', 'صورة', 'uploads/media/public/images/img_1551306823.jpg', NULL, NULL, NULL, 0, 1, 35, 'صحه', '2019-02-13 17:05:49', '2019-04-12 21:41:19'),
(16, 'Capture.PNG', 'ىةةةةةةةةةةةةةةةةة', 'ىةةةةةةةةةةةةةةةةةةةة', 'صورة', 'uploads/media/private/teams/images/img_1550151874.png', NULL, NULL, NULL, 0, 0, 35, 'فريق', '2019-02-14 16:44:34', '2019-02-14 16:44:34'),
(20, '1519659767865384700.jpg', 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.', 'صورة', 'uploads/media/public/images/img_1550255746.jpg', NULL, NULL, NULL, 0, 1, 35, 'عام', '2019-02-14 17:48:40', '2019-04-12 21:41:26'),
(28, 'sh.PNG', 'اى حاجة00', '00اى وصف', 'صورة', 'uploads/media/private/events/images/img_1550756808.png', NULL, NULL, NULL, 1, 0, 35, 'فاعليه', '2019-02-21 15:22:21', '2019-02-21 16:47:23'),
(33, '1.jpg', 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.', 'صورة', 'uploads/media/public/images/img_1554886570.jpg', NULL, NULL, NULL, 0, 1, 35, 'عام', '2019-03-02 04:24:54', '2019-04-12 21:26:44'),
(38, '6.jpg', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit ametLorem ipsum dolor sit amet', 'صورة', 'uploads/media/public/images/img_1554886592.jpg', NULL, NULL, NULL, 0, 1, 35, 'عام', '2019-03-13 17:36:31', '2019-04-12 21:41:32'),
(39, 'Lorem Ipsum14', 'Lorem Ipsum14', 'Lorem Ipsum14Lorem Ipsum14Lorem Ipsum14Lorem Ipsum14', 'فيديو', 'ldL2pmiqXhQ', NULL, NULL, NULL, 0, 1, 35, 'عام', '2019-03-15 17:27:34', '2019-04-12 21:26:58'),
(40, 'Lorem Ipsum1', 'Lorem Ipsum', 'is simply dummy text of the printing and typesetting industry', 'فيديو', 'qCn4o1X-2Bk', NULL, NULL, NULL, 0, 1, 35, 'عام', '2019-03-17 19:31:36', '2019-04-12 21:27:06'),
(41, 'Lorem Ipsum2', 'Lorem Ipsum2', 'Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum', 'فيديو', '1z9mfn5DqOU', NULL, NULL, NULL, 0, 1, 35, 'عام', '2019-03-17 19:33:42', '2019-04-12 21:27:12'),
(45, '22Test', 'Test', 'TestTestTestTest Test', 'فيديو', 'PNiTB4tmt78', NULL, NULL, NULL, 0, 1, 35, 'عام', '2019-03-19 14:53:33', '2019-04-12 21:26:38'),
(50, 'Xxxxxxyyyyyy', 'Test', 'TestTestTestTest', 'فيديو', 'PNiTB4tmt78', NULL, NULL, NULL, 1, 0, 35, 'فاعليه', '2019-03-19 15:00:53', '2019-03-19 15:01:26'),
(57, '3.jpg', 'amina', 'ahmed hamed', 'صورة', 'uploads/media/public/images/img_1554886636.jpg', NULL, NULL, NULL, 0, 1, 35, 'صحه', '2019-03-25 23:08:41', '2019-04-12 21:41:44'),
(60, 'n1.jpg', '111', '11', 'صورة', 'uploads/media/private/users/images/img_1555079177.jpg', 74, NULL, NULL, 1, 2, 74, 'عضو', '2019-04-12 20:26:17', '2019-04-12 20:26:17'),
(61, 'n2.jpg', 'تجربة الصورة للموقع', 'تجربة الصورة للموقع', 'صورة', 'uploads/media/public/images/img_1555081233.jpg', NULL, NULL, NULL, 0, 1, 69, 'عام', '2019-04-12 21:00:33', '2019-04-12 21:41:55'),
(62, 'أسيل الحمد أول سعودية تمثل المملكة في بطولة العالم لسباقات \"الفورمولا 1\"', 'أسيل الحمد أول سعودية تمثل المملكة في بطولة العالم لسباقات \"الفورمولا 1\"', 'تعتزم أسيل الحمد تحقيقَ إنجاز آخر للمرأة السعودية، عندما تقود لأول مرة إحدى سيارات الفورمولا 1 قبل بدء جولة جديدة من منافسات السيارات في فرنسا اليوم الأحد.\r\n\r\nوبحسب ما ذكرته وكالة أنباء رويترز الدولية، فإن الحمد ستقود سيارة الفورمولا 1 على حلبة سباق لو كاستيليت، وذلك بالتزامن مع السماح للمرأة بقيادة السيارات في المملكة.', 'فيديو', 'bLGP5jkW_nE', NULL, NULL, NULL, 1, 1, 69, 'عام', '2019-04-12 21:12:37', '2019-04-12 21:12:37'),
(63, 'ريما بنت بندر تروي حكايا سعودية رياضية عن جيل 2030', 'ريما بنت بندر تروي حكايا سعودية رياضية عن جيل 2030', 'تتحدث الأميرة ريما بنت بندر وكيل رئيس الهيئة العامة للرياضة للقسم النسائي  ورئيس الاتحاد السعودي للرياضة المجتمعية خلال هذا الفيديو عن أهمية التوعية بالدور الحيوي الذي تلعبه الرياضية في المحافظة على الصحة وتعزيز هذا المفهوم لدى الأجيال الجديدة. يأتي هذا المجهود التوعوي لتفعيل رؤية 2030 في التركيز على الأنشطة البدنية سواء من خلال المناهج التعليمية أو على صعيد المجتمع بشكل عام والتي يصفها البعض بأنها تمثل حقبة ذهبية للرياضة السعودية للجنسين بمختلف الأعمار سواء كانت احترافية أو مجتمعية. يظهر في الفيديو مداخلات من شخصيات مهتمة بالرياضة مثل لينا آل معينا و هالة الحمراني أو أسماء رياضية مثل لمى الفوزان عضو المنتخب السعودي للمبارزة بسلاح الشيش.', 'فيديو', 'RG5dNfW9xw8', NULL, NULL, NULL, 1, 1, 69, 'عام', '2019-04-12 21:17:18', '2019-04-12 21:17:18'),
(64, 'لين تغلق الباب أم السيدات.. لا أعذار من ممارسة الرياضة', 'لين تغلق الباب أم السيدات.. لا أعذار من ممارسة الرياضة', 'لا أعذار من ممارسة الرياضة', 'فيديو', 'tBsQGm_v_6A', NULL, NULL, NULL, 1, 1, 69, 'عام', '2019-04-12 21:21:38', '2019-04-12 21:21:38'),
(65, 'Lina AlMaeena مسيرة لينا المعينة', 'Lina AlMaeena مسيرة لينا المعينة', 'لينا المعينة كانت دائما حول الرياضة وتلعب كرة السلة من سن مبكر. أسست لينا شركة جدة المتحدة للرياضة لدعم الفتيات لمتابعة هذه الرياضة. في عام 2016 تم تعيين لينا كعضو في مجلس الشورى. كما أن لينا عضو في لجنة الأعمال السعودية الشابة ولجنة الاستثمار الرياضي في غرفة تجارة جدة، والمجلس النسائي للأعمال الشابات بالمملكة. وهي مدرجة ضمن قائمة أفضل 200 امرأة في الشرق الأوسط من مجلة فوربس 2014. شاركت لينا بعدة نشاطات في تعزيز الرياضة في المملكة.', 'فيديو', 'RoMQM3OzTI8', NULL, NULL, NULL, 1, 1, 69, 'عام', '2019-04-12 21:26:10', '2019-04-12 21:26:10'),
(66, 'WhatsApp Image 2019-04-12 at 1.01.03 AM (1).jpeg', 'فريق wolves', 'فريق Wolves Basketball  هو احد الفرق للطالبات بالجامعه العربية المفتوحه بالرياض لكرة السله \r\nالصوره ل شعار و لباس الفريق', 'صورة', 'uploads/media/public/images/img_1555084048.jpeg', NULL, NULL, NULL, 1, 1, 69, 'عام', '2019-04-12 21:47:28', '2019-04-12 21:47:28'),
(67, 'WhatsApp Image 2019-04-12 at 1.01.00 AM.png', 'اعلان المباراه النهائيه لكرة السلة', 'اعلان المباراه النهائيه لكرة السلة في الجامعه العربيه المفتوحه بالرياض بين \r\nWolvesbasket - CrossFire', 'صورة', 'uploads/media/public/images/img_1555084444.png', NULL, NULL, NULL, 1, 1, 69, 'عام', '2019-04-12 21:52:38', '2019-04-12 21:58:24'),
(68, 'aseel-540x268.jpg', 'أسيل الحمد.. سيدة سعودية تقود سيارة فورمولا 1 قبل جائزة فرنسا الكبرى', 'ستعطي أسيل الحمد دفعة أخرى للنساء السعوديات، اليوم الأحد، عن طريق قيادة إحدى سيارات فورمولا 1 قبل سباق جائزة فرنسا الكبرى.\r\n\r\nوتأتي هذه اللفة على حلبة لوكاستيليه في اليوم الذي تم فيه رفع الحظر عن قيادة النساء للسيارات في شوارع المملكة.\r\n\r\nوقال فريق رينو، إن أسيل ستقود سيارة من العام 2012 ضمن مسيرة لسيارات الشركة الفرنسية احتفالًا بعودة السباق الفرنسي إلى جدول سباقات بطولة العالم بعد غياب عشر سنوات.', 'صورة', 'uploads/media/public/images/img_1555088014.jpg', NULL, NULL, NULL, 1, 1, 69, 'عام', '2019-04-12 22:53:34', '2019-04-12 22:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `media_comments`
--

CREATE TABLE `media_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `media_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '0 if it is comment id if it is reply of comment',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `superadmin_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'superadmin id',
  `event_id` int(10) UNSIGNED DEFAULT NULL,
  `match_id` int(10) UNSIGNED DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '0 if it is message - id if it is reply of mwssage',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_02_04_190043_create_countries_table', 1),
(2, '2019_02_05_184345_create_roles_table', 1),
(3, '2019_02_06_000000_create_users_table', 1),
(4, '2019_02_06_100000_create_password_resets_table', 1),
(5, '2019_02_07_000000_create_sport_table', 1),
(6, '2019_02_07_100000_create_team_table', 1),
(7, '2019_02_07_110458_create_group_table', 1),
(8, '2019_02_07_110458_create_media_table', 1),
(9, '2019_02_07_190530_create_places_table', 1),
(10, '2019_02_07_191530_create_sponsers_table', 1),
(11, '2019_02_07_194411_create_events_table', 1),
(12, '2019_02_07_194430_create_event_albums_table', 1),
(13, '2019_02_07_194455_create_event_album_media_table', 1),
(14, '2019_02_07_194541_create_event_sponsers_table', 1),
(15, '2019_02_07_194548_create_event_users_table', 1),
(16, '2019_02_07_205952_create_team_user_table', 1),
(17, '2019_02_07_214007_create_group_user_table', 1),
(18, '2019_02_07_214009_create_categories_table', 1),
(19, '2019_02_07_214644_create_news_table', 1),
(20, '2019_02_07_214731_create_news_comments_table', 1),
(21, '2019_02_07_214747_create_articles_table', 1),
(22, '2019_02_07_214803_create_articles_comments_table', 1),
(23, '2019_02_07_215803_create_leagues_table', 1),
(24, '2019_02_07_223150_create_matches_table', 1),
(25, '2019_02_07_223216_create_match_team_table', 1),
(26, '2019_02_07_223230_create_match_user_table', 1),
(27, '2019_02_07_223257_create_match_comments_table', 1),
(28, '2019_02_07_224441_create_messages_table', 1),
(29, '2019_02_07_225605_create_event_comments_table', 1),
(30, '2019_02_07_230000_create_match_sponser_table', 1),
(31, '2019_02_15_134226_create_sport_users_table', 1),
(32, '2019_02_21_201757_create_banners_table', 1),
(33, '2019_03_03_205638_create_media_comments_table', 1),
(34, '2019_03_07_121332_create_league_comments_table', 1),
(35, '2019_03_19_214734_create_notifications_table', 2),
(36, '2019_03_20_135409_create_notifications_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'superadmin id who create news',
  `category_id` int(10) UNSIGNED NOT NULL,
  `news_type` enum('عام','لا للفراغ','صحه','رياضه') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'this determine where news will apear',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `intro`, `content`, `image`, `user_id`, `category_id`, `news_type`, `status`, `created_at`, `updated_at`) VALUES
(19, 'مع رؤية 2030 التي كانت لها الدور البارز وتذليل كل ً العقبات والتحديات التي تقف عائقا أمام تطوير رياضة المرأة السعودية التنافسية', 'في السعودية مؤخرا، إعادة هيكلة وتطوير وتنمية غير مسبوقة، بما يخدم تنافسية الرياضة في السعودية على مختلف األصعدة، لتصبح صناعة قائمة بذاتها، تنافس فيما بينها، والتي بدأت مع تعيين أول سيدة بمنصب رياضي، ً مرورا بمشاركة المرأة السعودية ً بالمحافل الدولية، وصول لتبني أنشطة رياضية نسائية تقام ألول مرة بالمملكة، لتتربع المرأة السعودية على عرش الرياضة، بعد أن كانت تمارسها بشكل بسيط، ما ترتب عليه كثير من األمراض الصحية، وسجلت المملكة نسباً عالية من أمراض السمنة بسبب قلة ممارسة الرياضة البدنية للنساء. كذلك أشارت إلى اهتمام رؤية 2030 ،بشأن وواقع الرياضة النسائية بالمملكة، كان داعماً لهذا التوجه، وهو التأكيد على أهمية وجود األندية الصحية والرياضية معاً في حياة المرأة السعودية، مشيرة في الوقت ذاته إلى مطالبات مجلس الشورى وتوصياته لوزارة التعليم بدراسة إضافة برامج اللياقة البدنية مع اآلخذ في اإلعتبار الضوابط الشرعية، وطبيعتهن، والتنسيق لوضع برامج التأهيل المناسب للمعلمات، معللين بازدياد السمنة في المجتمع، خاصة في األوساط النسائية وهو أمر من شأنه يوجب الهتمام ببرامج اللياقة البدنية والصحية.', 'في السعودية مؤخرا، إعادة هيكلة وتطوير وتنمية غير مسبوقة، بما يخدم تنافسية الرياضة في السعودية على مختلف األصعدة، لتصبح صناعة قائمة بذاتها، تنافس فيما بينها، والتي بدأت مع تعيين أول سيدة بمنصب رياضي، ً مرورا بمشاركة المرأة السعودية ً بالمحافل الدولية، وصول لتبني أنشطة رياضية نسائية تقام ألول مرة بالمملكة، لتتربع المرأة السعودية على عرش الرياضة، بعد أن كانت تمارسها بشكل بسيط، ما ترتب عليه كثير من األمراض الصحية، وسجلت المملكة نسباً عالية من أمراض السمنة بسبب قلة ممارسة الرياضة البدنية للنساء. كذلك أشارت إلى اهتمام رؤية 2030 ،بشأن وواقع الرياضة النسائية بالمملكة، كان داعماً لهذا التوجه، وهو التأكيد على أهمية وجود األندية الصحية والرياضية معاً في حياة المرأة السعودية، مشيرة في الوقت ذاته إلى مطالبات مجلس الشورى وتوصياته لوزارة التعليم بدراسة إضافة برامج اللياقة البدنية مع اآلخذ في اإلعتبار الضوابط الشرعية، وطبيعتهن، والتنسيق لوضع برامج التأهيل المناسب للمعلمات، معللين بازدياد السمنة في المجتمع، خاصة في األوساط النسائية وهو أمر من شأنه يوجب الهتمام ببرامج اللياقة البدنية والصحية.\r\nمن الجدل والنقاش حول المنع، للمنافسة وتحقيق البطوالت وعن تجربتها التي هي شاهدة على تطور الهتمام بالرياضة النسائية بالسعودية تقول »روما الرشيدي، كابتن لفريق كرة السلة النسائي بالرياض«، لقد عانيت في السابق، قبل أن ننشئ الفريق، ولم نكن نجد الدعم ول الترحيب بتلك الممارسات بسبب قلة الهتمام بالرياضة النسائية وعدم تقبل المجتمع لها، األمر الذي تغير مع رؤية 2030 ،وتم تسليط الضوء على الرياضة النسائية وأصبح هناك دوريات للرياضة النسائية المختلفة ككرة اليد، وكرة القدم، والبولينج وغيرها تقيمها الجامعات وبعض الجهات المختصة بين الحين واآلخر، مشيرة إلى تكريمها كأول فريق لعبات كرة السلة في الجامعة العربية المفتوحة، بعد أن استطعن الفوز بالكأس والميدالية، في دوري الجامعة مرتين على التوالي لعام 2017 و2018 ،األمر الذي لن يكون األخير وسيتكرر، وستنافس المرأة السعودية في دوريات عدة، في ظل الدعم الذي تقدمه هيئة الرياضة للسعوديين بشكل عام وللمرأة السعودية بشكل خاص. وترى »إلهام الضبيبى، خبيرة مكياج«، أن الرياضة النسائية بالمملكة كانت ً من القضايا التي شهدت كثيرا من الطرح والنقاش فمنهم من كان يرى أن تفعيل الرياضة النسائية في المدارس والجامعات واألماكن الخاصة من الضروريات بينما البعض اآلخر كان يرى عدم ضرورة لذلك، حتى جاءت رؤية المملكة 2030 ،والتي أطلقت برعاية خادم الحرمين الشريفين الملك سلمان بن عبدالعزيز آل سعود - حفظه اهلل- في 25 أبريل 2016م، إذ جاء منها أن الدولة ستشجع الرياضات ٍ بأنواعها من أجل تحقيق تميز رياضي على الصعيدين المحلّي والعالمي، والوصول إلى مراتب عالمية متقدمة في عدد منها بمتابعة دؤوبة من صاحب السمو الملكي األمير محمد بن سلمان بن عبدالعزيز آل سعود، ولي العهد، األمر الذي تجسد في توصية مجلس الشورى بإضافة التربية البدنية في مدارس البنات، والذي لقي بدوره أصداء جيدة في المجتمع بشكل عام، واألوساط النسائية خاصة، األمر الذي تجلت صورته في تهيئة أماكن خاصة للنساء لممارسة رياضة المشي. وأشارت »الضبيبي«، إلى أنه في السابق كانت هناك بعض المعوقات أمام المرأة السعودية لممارسة الرياضة أبرزها أسعار االشتراكات النسائية التي وصفتها ً بالمرتفعة جدا مقارنة باألندية الرجالية، إضافة لعدم توافر مدربات متمكنات ذوات خبرة في المجال الرياضي من ً ناحيتي التدريب والتغذية، وأيضا آلية إدارة الحصص التدريبية واالحتياج الغذائي، وانتشار كثير من المعلومات المغلوطة التي تؤدي إلى عدم االستمرارية في النشاط الرياضي واالبتعاد عنه، األمر الذي وضعته رؤية المملكة 2030 في االعتبار وذهبت لتنمية القطاع الرياضي النسائي، والعمل على تحقيق الرفاهية لحياة أبناء المملكة ومن يقيم على أرضها، فعملت على تفعيل الشراكة مع القطاع الخاص، لبناء مزيد من المرافق والمنشآت الرياضية، ليكون بمقدور الجميع ممارسة رياضاتهم المفضلة في بيئة مثالية في إطار منظومة عمل تواكب كل جديد على الساحة الرياضية وفيه المنفعة للوطن ومواطنيه.\r\nتغيير ثقافة المجتمع، ودعم حكومي غير مسبوق وبدورها ترى »البندري السمحان، الصحفية بمجلة القيادة والمدربة المعتمدة «، أن المرأة السعودية ظلت لعقود طويلة تعاني من التهميش لكونها فقط امرأة وذلك في المجال الرياضي، وذلك بسبب ثقافة المجتمع، والتي كانت ترى أن ممارسة المرأة السعودية للرياضة من العيب ألنهم وبحسب رؤيتهم التي وصفتها بالضيقة يرون أن الرياضة للرجال فقط، أو أن ممارسة الرياضة ليست من الدين وال تتماشى مع كون المجتمع السعودي له طبيعة دينية خاصة، متجاهلين وعن عمد أن الرياضة لها دور فعال في التطوير التربوى والتعليمي على المدى البعيد، وتحسن من جودة الحياة لألفراد سواء امرأة أم رجل. وتستطرد قائلة »السمحان«، مع رؤية 2030 التي كانت لها الدور البارز وتذليل كل العقبات والتحديات التي تقف عائقاً أمام تطوير رياضة المرأة السعودية التنافسية، وزيادة الوعي لممارسة الرياضة الترويحية لتمكين المرأة من التغلب على التحديات االجتماعية والنفسية والدفع بعجلة االرتقاء بالممارسات الحياتية الصحية للنساء والفرص المتاحة لها في هذا المجال، وتمكينها من المشاركة في المحافل الدولية، ويصبح الحلم حقيقة ويخرج من نطاق الممارسة المدرسية للرياضة للمنافسة في البطوالت الدولية. وبحسب رؤيتها ترى أن هذا القرار كان في الوقت المناسب، خاصة فيما نعيشه في العصر الحالي من التقدم التكنولوجي، والذي أسهم بشكل كبير في هدم الصحة العامة لألفراد نتيجة اعتمادهم وتعامالتهم التكنولوجية في كل المجاالت، ما نتج عنه قلة الحركة البدنية، ومن ثم فالحاجة إلى ممارسة الرياضة ضرورية وليست للرفاهية، كما كان البعض يتعامل معها، بحسب قولها. ً وأشادت بدور هيئة الرياضة ممثلة في النائبة السابقة لرئيس هيئة الرياضه األميرة ريما بنت بندر بن سلطان بن عبد العزيز آل سعود التي حرصت أشد الحرص على انطالق المرأة السعوديه للرياضة وبنائها على أساس قويم وتوعيتها بثقافة الرياضة المجتمعية. 2019\r\n\r\nمجلة اليمامة: http://alyamamahonline.com/repo/pdf/2551/2551.pdf', 'uploads/images/newsImages/img_1555090461.png', 69, 2, 'عام', 1, '2019-04-12 22:25:34', '2019-04-12 23:34:21'),
(20, 'لينا المعينا لـ(البلاد ): بالرياضة النسائية … نهدف لتغيير الصورة النمطية عن المرأة السعودية', 'ستطاعت عضو مجلس الشورى لينا آل معينا، أن تثبت نفسها في مجال الرياضة السعودية النسائية، لتؤسس فريق كرة سلة في عام 2003 ، أطلقت عليه (جدة يونايتد) وهو أكاديمية متكاملة لكرة السلة، تتولى لينا، بنفسها رئاستها. وفي حوار خاص لـ(البلاد)، أكدت عضو مجلس الشورى، والشريك المؤسس لأكاديمية نادي”جدة يونايتد” لكرة السلة لينا المعينا، أنه وفي البداية، لم يكن نادي جدة يونايتد يهدف للربح، بل كان رياديا اجتماعيا، لكنه تحول بحكم الوقت والمجهود الذي نبذله في الملاعب، وأصبح مشروع رياضيا تطلب تفرغا كاملا ، فأنشأنا أكاديمية للفتيات والشباب على مستوى مدينة جدة، وفي العاصمة الرياض.', 'أضافت المعينا: في البداية لم يكن الاهتمام بالرياضة لهذه الدرجة ، وأردنا أن يكون هذه النادي بابا آخر للاستثمار، وليس فقط لقضاء وقت الفراغ، فيما يعود علينا بالنفع، وخاصة في الألعاب الجماعية، وهذه الالعاب الجماعية مهمة جدا، فهي ليست كأي رياضة أخرى، لأنها تعلم الكثير من القيم؛ منها احترام قيمة الوقت، واحترام المنافس، والعمل الجماعي، وغيرها من الأمور الكثيرة التي لا تعد ولا تحصى، ومن خلال لغة الرياضة الجماعية، أردنا نشر هذا الفكر، وهذه الثقافة محليا على مستوى المملكة العربية السعودية، ولكن كان لنا هدف آخر، وهو الدولي أو الخارجي؛ لتغيير الصورة النمطية عن المرأة السعودية، وفي كل عام، كنا ننظم مباراة ودية في دولة معينة، كالأردن، وماليزيا، والمالديف، وفرنسا، والولايات المتحدة الأمريكية، وكانت المباريات لها واقع جدا جميل، خاصة ما قبل إعلان رؤية 2030 في المملكة العربية السعودية، ولله الحمد، مع وجود هذه الرؤية العظيمة تغيرت مفاهيم كثيرة، ونحن الآن نعيش السعودية الجديدة؛ كوننا عشنا ما قبل الاهتمام بالرياضة بهذا الشكل، وخاصة للفتيات؛ ومنها دخول المرأة للملاعب، وفتح تصاريح الأندية النسائية، والكثير من المتغيرات التي نعيشها اليوم، لكن هناك جيل عاش ما قبل إعلان الرؤية، التي من أهم أهدافها زيادة عدد الممارسين من %13 إلى 40%، فأصبحت المرأة الآن تشارك بمعظم الاتحادات الرياضية، وبمجالس إداراتها. وأشارت لينا إلى أننا قد شاركنا هذه السنة في بطولة الأندية العربية النسائية بالشارقة، وكنا أول فريق سعودي تحت مظلة الاتحاد السعودي لكرة السلة، يشارك في هذه البطولة، وكانت من أجمل المشاركات التي خضناها، وتعتبر تجربة فريدة، واستطاع الفريق أن يكتسب العديد من الخبرات، و توجنا بجائزة اللعب النظيف، والحمد لله، لكن أود أن أشير لشيء مهم جدا، وهو أننا كإدارة” جدة يونايتد” نهتم جدا بهويتنا الوطنية، وهي الشيء الأساس في النادي؛ كون الرياضة لا تمنع الفتاة أن تعتز بقيمها الوطنية، والدينية، وهذه من أهم الأمور التي نهتم بها كتربويين وعلماء نفس؛ لنغرس من خلال هذه الرياضة كثيرا من القيم الجميلة؛ سواء الوطنية والاجتماعية والصحية والنفسية للفتيات والشباب، من خلال الكثير من الفعاليات التي نقيمها على مستوى مدينة جدة، و الرياض، ونحاول أن نحارب وننهي آفة التعصب الرياضي.\r\nوعن تفاعل المجتمع مع رياضة كرة السلة، وخصوصا النساء، أكدت المعينا أن التفاعل بازدياد ،وعند انطلاقنا عام 2003 لم يهتم الإعلام الرياضي بأي نشاط لرياضة البنات، وكان شبه مستحيل أن نعلن خبرا في إحدى الصحف، أو المجلات، ولكن مع توجه المملكة العربية السعودية الآن اختلف الأمر تماما، فالرياضة لم تعد شيئا ثانويا، بل شيء أساس في حياة الفرد؛ سواء للفتيات أو للشباب، وكل فئات المجتمع، حتى من ذوي الاحتياجات الخاصة وكبار السن؛ لذلك مواقع التواصل الاجتماعي تدعم دائما وتشجع، وفي رأيي يجب أن نوجه مواقع التواصل الاجتماعي أن تلتزم بهويتنا الدينية والوطنية من خلالها.\r\nوأضافت المعينا: إنه ومنذ انطلاق وتكوين فريق جدة يونايتد، واجهتنا الكثير من الانتقادات، والتشكيك، وأسبابه في رأيي ترجع لعدم المعرفة، وربما من التخوف من أن هذه الرياضة ستؤدي لشيء خارج عن المألوف، وعن القيم، ولكن، الحمد لله، مع استمراريتنا وأمانتنا استطعنا أن نستثمر هذه الطاقة في شيء إيجابي؛ كون الفراغ أكبر عدو.\r\nوعن شروط الاشتراكات في النادي، قالت لينا: لا يوجد له أي شروط؛ كون الفتاه تصنف على حسب عمرها، ومستواها الرياضي، وأضافت: نشارك في العديد من الفعاليات؛ منها اليوم الوطني وكل مناسبة في المملكة، نحاول قدر المستطاع أن نتواجد بها، عبر تنظيم مباريات أو بطولات معينة؛ لتعزيز هذه الفكر، وفي الفترة الأخيرة، كانت لدينا بطولة للشباب، تحت شعار” لا للتدخين”، وبطولة يوم المرأة العالمي، وبطولة لا للتعصب الرياضي، وبطولات خاصة بالأطفال.\r\nوأكدت المعينا في ختام حديثها أن الهيئة العامة للرياضة، هي شريك أساس، وفي السابق كانت مرجعيتنا لوزارة التجارة، والتي مازالت قائمة، لكن الآن مرجعيتنا للهيئة العامة للرياضة.\r\n\r\nالمصدر:  https://albiladdaily.com/2018/12/18/لينا-المعينا-لـالبلاد-بالرياضة-النسا/', 'uploads/images/newsImages/img_1555086902.jpg', 69, 2, 'عام', 1, '2019-04-12 22:35:02', '2019-04-12 23:31:52'),
(21, 'أول حكم دولي نسائي سعودي للشطرنج العنود إسحاق لـ هي   اتحاد الفريق النسائي كان سبب نجاح أول نادي شطرنج في السعودية - مجلة هي', 'استطاعت المرأة السعودية فرض وجودها في كثير من المجالات الرياضية خصوصا بعد مشاركتها في الألعاب الأولمبية الأخيرة ، إلا أن السيدة السعودية لم تتوقف عند ذلك فحسب بل استطاعت مجموعة منهن على تأسيس أول نادي شطرنج نسائي في مدينة جدة ، موقع \"هي\" استضاف أول حكم دولي نسائي سعودي للشطرنج الأستاذة العنود إسحاق التي حدثتنا عن تفاصيل أكثر في ما خص نادي الشطرنج الأول في المملكة .', 'استطاعت المرأة السعودية فرض وجودها في كثير من المجالات الرياضية خصوصا بعد مشاركتها في الألعاب الأولمبية الأخيرة ، إلا أن السيدة السعودية لم تتوقف عند ذلك فحسب بل استطاعت مجموعة منهن على تأسيس أول نادي شطرنج نسائي في مدينة جدة ، موقع \"هي\" استضاف أول حكم دولي نسائي سعودي للشطرنج الأستاذة العنود إسحاق التي حدثتنا عن تفاصيل أكثر في ما خص نادي الشطرنج الأول في المملكة .\r\nمتى تأسس فريق الشطرنج النسائي وكيف بدأت الفكرة ؟\r\nتأسس الفريق مع أول بطولة دولية للشطرنج النسائي على شرف سفيرة الشطرنج النسائي صاحبة السمو الأميرة لاما بنت خالد السديري في مدينة جدة - 24 مارس 2017 وهو الفريق الأول للشطرنج النسائي بالمملكة العربية السعودية.\r\nماهي الطريقة التي بدأتم فيها الفريق ؟\r\nجاء ذلك بعد انضمام اللاعبة السعودية ورئيسة الفريق عضو لجنة المسابقات الحكم النسائي السعودي أ. الجوهرة بنت محمد الحسن إلى اللجنة السعودية للرياضات الذهنية ، وقد أثبتت حبها وشغفها لهذه اللعبة بحصولها على المركز الثاني في البطولة الدولية الأولى وكان لها الفضل الكبير في في تكثيف البطولات الدولية والمحلية وأنشأت بذلك فريقا دوليا مكونا من 28 لاعبة ومنتخبا محليا من 30 لاعبة من المملكة العربية السعودية.\r\nهل ساهم ذلك في تطوير اللعبة  ؟\r\nنعم بالتأكيد ساهم في ذلك في تطوير لاعبات المنتخب السعودي للشطرنج حيث توجهن للمشاركة في تحكيم البطولات بأخذ دورة مكثفة للتحكيم من اللجنة السعودية للرياضات الذهنية لمدة 3 أيام 30 مايو الى 1 يونيو 2017 وبذلك نشأ فريق متكامل من التحكيم والتنظيم النسائي مكون من 13 عضو تحكيم.. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .\r\nمن هن المحكمات والمشتركات في الفريق ؟\r\nسيدات لجنة التحكيم السعودي هن:\r\nأ. الجوهرة الحسن\r\nأ. وفاء العمودي\r\nأ. ايمان فلاته\r\nأ. حنان المالكي\r\nأ. دالية السميري\r\nأ. كريمة سندي\r\nأ. نوال الفليت\r\nد. زينب البلالي\r\nأ. خديجة الشنقيطي\r\nأ. نادية العبدلي\r\nأ. سارة المالكي\r\nأ. اشواق جميل\r\nأ. سندس بن ثابت\r\n كنتِ أبرز المحكمات السعوديات حدثينا عن ذلك؟ \r\nنعم فأنا أول حكم دولي نسائي سعودي للشطرنج الحكم الدولي وذلك من خلال تحكيمي لثلاث بطولات متتالية الاولى محلية 9 يونيو 2017 والأخرى دولية في 25 يوليو 2017 في مدينة جدة، وبطولة دولية 18 أغسطس 2017 بمدينة الرياض ، وحصلت المملكة على المركز الثاني والمركز الثالث والرابع في البطولات الدولية للشطرنج النسائي.\r\nهل هناك مقر رئيسي لكم ؟\r\nحتى الان ليس لدينا مقر رئيسي ولكن و على الرغم من عدم وجود المقر الرئيسي للبطولات والتدريب للشطرنج إلا أنه باتحاد الفريق النسائي تم التعاون على إقامة البطولات بشكل ممتاز في أماكن مختلفة ، و توجهنا المأمول أن يتم فتح أكاديمية الشطرنج النسائي في المملكة وذلك بوجود الفريق المتكامل من اللاعبات والمنظمات ولجنة التحكيم.\r\nAddThis', 'uploads/images/newsImages/img_1555087628.jpg', 69, 2, 'عام', 1, '2019-04-12 22:47:08', '2019-04-12 23:01:29'),
(22, 'السعودية: ارتفاع ممارسي الرياضة في المجتمع إلى 23 % هيئة الرياضة أكدت تحقيقها مستهدفات 2020 في فترة وجيزة', 'تركي آل الشيخ («الشرق الأوسط») - إقبال كبير شهده العام الحالي من السعوديين على الرياضة («الشرق الأوسط») أعلنت الهيئة العامة للرياضة في السعودية يوم أمس ارتفاع نسبة الممارسين للرياضة في البلاد من 13 في المائة إلى 23 في المائة وفقاً لما أظهره استبيان أجري خلال الربع الأول من عام 2018 أظهرت النتائج أن المواطنين السعوديين أصبحوا يمارسون الرياضة بشكل أكبر من عام 2015.', 'لرياض: «الشرق الأوسط»\r\nأعلنت الهيئة العامة للرياضة في السعودية يوم أمس ارتفاع نسبة الممارسين للرياضة في البلاد من 13 في المائة إلى 23 في المائة وفقاً لما أظهره استبيان أجري خلال الربع الأول من عام 2018 أظهرت النتائج أن المواطنين السعوديين أصبحوا يمارسون الرياضة بشكل أكبر من عام 2015.\r\nورفع تركي آل الشيخ رئيس مجلس إدارة الهيئة العامة للرياضة، شكره وتقديره لخادم الحرمين الشريفين الملك سلمان بن عبد العزيز ولولي العهد الأمين نائب رئيس مجلس الوزراء وزير الدفاع، الأمير محمد بن سلمان بن عبد العزيز، على الرعاية والدعم الكبيرين اللذين يحظى بهما قطاع الرياضة في المملكة؛ ما أسهم في تحقيق خطوات تطويرية ناجحة في مختلف المجالات الرياضية لما فيه مصلحة الرياضة والمجتمع.\r\nوثمن رئيس الهيئة العامة للرياضة الدعم والاهتمام الكبيرين، مؤكداً نجاح الهيئة عبر مختلف البرامج والفعاليات الرياضية المتنوعة، في السعي نحو تحقيق أحد أهداف رؤية 2030. والمتمثل في زيادة عدد ممارسي الرياضة في المجتمع، حيث أعلن ارتفاع نسبة الممارسين للرياضة من 13 في المائة إلى 23 في المائة.\r\nوقال تركي آل الشيخ: «أجرت الهيئة العامة للرياضة في عام 2015م أول استبيان وطني للرياضة، وتم تعريف الأشخاص النشطين الذين يمارسون الرياضة بأنهم أشخاص يمارسون نوعاً محدداً من النشاط البدني بشكل منتظم ومتكرر، على الأقل مرة واحدة في الأسبوع؛ لغرض أساسي وهو تحسين الصحة العامة والحفاظ على اللياقة، وقد أظهرت نتائج الاستبيان وضعاً سلبيّاً يجب تحسينه، حيث يمارس الرياضة فقط 13 في المائة من المواطنين السعوديين الذين تزيد أعمارهم على 15 سنة، وكانت تلك النتائج بمثابة نداء استيقاظ للهيئة للمضي قدماً نحو إطلاق عدة برامج وفعاليات رياضية متنوعة تسهم في زيادة تلك النسبة والبدء في تنفيذ استراتيجية الرياضة المجتمعية وبرامجها تجاه المجتمع».\r\nوأضاف: «خلال الربع الأول من عام 2018م تم إجراء استبيان وطني آخر للرياضة وتنفيذه بذات الآلية، إذ أظهرت النتائج أن المواطنين السعوديين أصبحوا يمارسون الرياضة بشكل أكبر من عام 2015م حيث ارتفعت نسبة ممارسي الرياضة بصفة دورية من 13 في المائة إلى 23 في المائة، وبذلك حققت الهيئة العامة للرياضة مستهدفات عام 2020م التي كانت محددة بنسبة 20 في المائة».\r\nوأكد آل الشيخ، أن هذه النتيجة محفز كبير ودافع قوي لبذل المزيد من العمل والعطاء في مختلف الألعاب الرياضية وكذلك الفعاليات المصاحبة في الملاعب، مضيفاً: «تحقيق هذا الإنجاز جاء نتيجة عمل متكامل في تحقيق الرؤية بين كافة الإدارات داخل الهيئة وبين القطاعات الحكومية المشاركة، وأن هذا التكامل أثّر في المواطنين إيجابيّاً لتحسين جودة الحياة، حيث أدركوا فوائد ممارسة الرياضة لهم ولكافة أفراد المجتمع».\r\nإلى ذلك، كشف الأمير فهد بن جلوي مدير العلاقات الدولية باللجنة الأولمبية السعودية أن الاتحادات الرياضية لها الحق الكامل في الحصول على الدعم الفني والمالي المقدم عبر برنامج التضامن الأولمبي أحد برامج اللجنة الأولمبية الدولية المقدمة للاتحادات الوطنية.\r\nجاء ذلك خلال ورشة عمل التضامن الأولمبي للاتحادات الأولمبية والنوعية التي أقامتها اللجنة الأولمبية العربية السعودية ممثلة بإدارة العلاقات الدولية أمس الثلاثاء في قاعة الاجتماعات الكبرى بمجمع الأمير فيصل بن فهد الأولمبي بالرياض بحضور مسؤولي 24 اتحادا أولمبيا إضافة لاتحاد الرياضة المجتمعية والذي يمثل الاتحادات النوعية وجميل فاي خبير اللجنة الأولمبية الدولية خبير شركة سبورت آند باتنر.\r\nوقال الأمير فهد بن جلوي إن الورشة تهدف إلى تعريف الاتحادات ببرامج الدعم الفني والمالي التي يقدمها التضامن الأولمبي الدولي ضمن الخطة الدولية 2017 - 2020م وتمكينها الاستفادة من هذه البرامج، مشيرا إلى أن الدعم يتضمن إمداد الاتحادات الأولمبية بالمدربين والمستشارين في المجالات الرياضية وإقامة الدورات المتنوعة.\r\nفيما قدم مصطفى إدريس خبير اللجنة الأولمبية السعودية نبذة عن تاريخ التضامن الأولمبي والتطور الذي صاحب البرنامج منذ إنشائه وحتى يومنا الحاضر، مضيفاً أن اللجنة الأولمبية الدولية حريصة كل الحرص على إتاحة الفرصة لجميع اللجان الأولمبية الوطنية للاستفادة من هذا البرنامج.\r\nمن جهته بين مدير التضامن الأولمبي باللجنة الأولمبية سعيد الغامدي آلية حصول الاتحادات على الدعم، مضيفاً أن الدعم المقدم من خلال هذا البرنامج شاملة للمدربين واللاعبين والإداريين إضافة إلى المنح الأولمبية.', 'uploads/images/newsImages/img_1555089549.jpg', 69, 1, 'صحه', 1, '2019-04-12 23:19:09', '2019-04-12 23:20:20'),
(23, 'إحصائيات أمراض الخمول والسكر والسمنة «مخيفة».. والقرار ينتظر التفعيل الجاد الرياضة النسائية.. المجتمع تجاوز قيود المعارضين !', 'لرياضة النسائية من القضايا التي شهدت الكثير من الطرح والنقاش فمنهم من يرى أن تفعيل الرياضة النسائية في المدارس والجامعات والاماكن الخاصة من الضروريات بينما يرى البعض الآخر عدم ضرورة لذلك، حتى إستقبلت الأوساط النسائية مؤخراً توصية مجلس الشورى بإضافة التربية البدنية في مدارس البنات، والذي لقي بدوره أصداء جيده في المجتمع وتأييد لهذه الخطوة.', 'الرياضة النسائية من القضايا التي شهدت الكثير من الطرح والنقاش فمنهم من يرى أن تفعيل الرياضة النسائية في المدارس والجامعات والاماكن الخاصة من الضروريات بينما يرى البعض الآخر عدم ضرورة لذلك، حتى إستقبلت الأوساط النسائية مؤخراً توصية مجلس الشورى بإضافة التربية البدنية في مدارس البنات، والذي لقي بدوره أصداء جيده في المجتمع وتأييد لهذه الخطوة.\r\n\r\nوشاركت أربع رياضيات سعوديات في دورة الألعاب الأولمبية الاخيرة في ريو دي جانيرو بالبرازيل هن: سارة العطار- سباق ماراثون، لبنى العمير- المبارزة، كاريمان أبو الجدايل- سباق الجري 100 م، وجود فهمي- الجودو في وزن تحت 52 كلغ، كما شاركات رياضيتان سعوديتان للمرة الأولى في تاريخ الرياضة السعودية في دورة الألعاب الأولمبية الماضية في لندن عام 2012 هما سارة العطار في سباق 800 م للجري ووجدان شهرخاني في منافسات الجودو.\r\n\r\nوبدأت الرياضة النسائية تأخذ منحنى جديا بعد أن تم السماح بترخيص أندية رياضية خاصة للنساء في المملكة، حيث تم افتتاح عدد من الاندية ثم باتت النوادي النسائية تتنافس من حيث الأداء والحرص على تهيئه الأجواء الرياضية المناسبة للسيدات فشملت العديد من الأقسام الرياضية التي تناسب المرأه وتلبي حاجتها.\r\n\r\nالقيود الاجتماعية\r\n\r\nالباحثة التربوية ريم محمد بقولها: الهوايات الرياضية والميول الرياضية موجود لدى الكثير من الفتيات وربما قد يكون البعض منهن قد وهبها الله التميز في إحداها ولكن العادات والقيود الاجتماعية قد تكون عائق كبير للوصول للهدف فثقافة الرياضة النسائية لم تصل للكثيرين بسبب ثقافة العيب والتحفظ وأحيانا لبعض المعتقدات بأن الرياضة تضر بالمرأه من الناحية الجسمية والنفسية، فالمجتمع قبل فتره كانت نظرتهم سلبيه تجاه ذلك وذلك يعود الى اعتقادهم بأنها تسبب الكثير من المشاكل الجسدية وأيضا قد تكون سبباً في تلقي اللوم من المجتمع والناس ولازال هناك الكثير من الأسر تعتبر الرياضة ممنوعة على الفتاه، فبات هذا سبباً وراء عدم تقدم بعض الفتيات لها واقتصر ذلك على بعض الهوايات الشخصية التي تزاولها الفتاه في منزلها أو مع زميلاتها.\r\n\r\nفوائد صحية\r\n\r\nمن جهتها توضح سلمى احمد-الاخصائيه بمستشفى الملك خالد بنجران- مدى أهميه الرياضة للمراه قائله: فوائد الرياضة للمرأة التخلص من الوزن الزائد والقضاء على الترهلات، إكساب الجسم المرونة، وتقوية العضلات والعظام والمفاصل والحصول على جسم رياضيّ متناسق، ومحاربة مظاهر الشيخوخة وتَقدُم العُمُر، وتحسين الدورة الدموية، والتخلص من أمراض القلب والشرايين والأوردة، مشيرة الى ان ممارسة الرياضة ضرورية للمرأة الحامل فهي تُساعد على تسهيل عملية الولادة كما انها تفيد المرأة بعد الولادة الطبيعية أو القيصرية لشدّ منطقة البطن، وتحسين ضخ الدم، وزيادة إفراز الحليب، ممارسة الرياضة للمرأة الحامل يعمل على تقليل الإصابة بضغط الدم وسكر الحمل، ويقلّل من حدوث تسمم الحمل وزلال الحمل، كما تساعد على تحسين مزاج المرأة وتقليل الشعور بالوحدة والاكتئاب من خلال النشاط البدني، وكذلك من خلال ممارسة الرياضة في الهواء الطلق، أو في مجموعات، كما ان الرياضة ضرورية للمرأة في سن اليأس وبعد انقطاع الطمث للتخفيف من آثار انقطاعها السلبية من ناحية جسدية ونفسية، اضافة الى ان ممارسة الرياضة للمرأة في فترة الحيض تساعد على نزول الدم والتخلص من آلام الظهر، وتعمل على تحسن مزاج ونفسية المرأة.\r\n\r\nبرنامج توعوي صحي\r\n\r\nمن جهتها تؤكد رند بدوي -أخصائية التغذية- إلى حاجه المجتمع النسائي للرياضة لأن النساء أكثر بدانة من الرجال وأكثر عرضه للاصابه بالسرطان الثدي بسبب السمنة الرياضة تساهم في انخفاض الوزن ولها أيضا تأثير على الإمراض فهي تقلل من ارتفاع السكر بالدم عند مرضى السكري وتأثر على ضغط الدم وتساهم في انخفاض الوزن وتساهم في التخلص من الكابه والتوتر وتساهم في الحفاظ على صحة الرئتين الرياضة ليست حركه عضلات وحسب الرياضة حركه الرياضة تساعد في تحسين أداء الدماغ ونشاطه وصحته بسبب دفع الدم إليه بشكل كبير أغلب النساء اللاتي يعانون من البدانة ترافقهم مشاكل في الركبتين وذلك لقلة النشاط البدني أيضا ننوه مدى أهميه الوجبات الصحية المتكاملة والتي بدورها تساعد في إنقاص الوزن بشكل طبيعي وتمد الجسم بالاحتياجات الغذائية ويحافظ على صحتنا ويساهم في التخلص من السموم المتراكمة على الكبد والقولون والكلى ويجدد الخلايا ويحميها.\r\n\r\nويقول مؤسس نكهات مبتعث( برنامج توعوي صحي يهتم بالرياضة والاطعمه الصحية من خلال برنامج نكهات مبتعث - عبد الرحمن الخلف-\r\n\r\n:من خلال المبادرات التطوعية التوعويه الثقافية هدفت إلى الوعي الصحي وتوضيح مدى أهميه الرياضة والتعامل معها بشكل يومي لتصبح عادة ضمن برنامج يومي للفرد، فكانت هناك عده مبادرات كتخصيص يوم للرياضة العامة أو العمل من خلال التواصل مع الانديه الرياضية وعمل مشاركه مجتمعيه كإقامة مارثون للجري أو الرياضة التي لها علاقة وإرتباط بالمرأه .\r\n\r\nالاندية الرياضية النسائية\r\n\r\nتقول لينا محمد -سيده أعمال- نظرا لعدم تمكن البعض من مزاوله بعض انشتطها بحريه تامة أتتني فكره عمل نادي رياضي يستقبل السيدات والفتيات وتوفير لهن الأجواء الرياضية التي يرغبن في التواجد من خلالها وأيضا حرصت على وجود مدربات يقدمن التدريبات والمساعدات الرياضية ولاحظت أن الإقبال عليه شديد وخاصة من الفتيات مما شجعني للتقدم وفتح عده صالات رياضيه.\r\n\r\nوتضيف خديجه اليامي بقولها امتلك مشغل خاص بالسيدات وفتحت جزء صغير منه وخصصته كنادي رياضي يهتم بجسم المراه ورشاقتها من خلال التدريبات الرياضية والحمية الرياضية التي يقدمها النادي وقد لقيت هذه الخطوة استحسانهم وإقبالا كبيرا من السيدات.\r\n\r\nتحرك رسمي لدعم الرياضة النسائية\r\n\r\nيشهد قطاع الرياضة النسائية في الآونة الأخيرة نقلة نوعية واهتماماً كبيراً على مختلف الأصعدة، فمن قرار تعيين وكيل للقسم النسائي في الهيئة العامة للرياضة الذي يعد مؤشراً على الاهتمام بتفعيل الرياضة النسائية بما يحقق طموح العديد من بنات الوطن سواء كان ذلك في المدارس والجامعات او في المشاركات النسائية في المحافل الرياضية الدولية كما حصل في المشاركات النسائية في الاولمبياد او غيرها، وسينعكس ايضاً على البرامج والمبادرات الرياضية، بما يشجع ويحفز على الاستثمار في هذا القطاع، إضافة الى ذلك، جاء اهتمام مجلس الشورى ومناقشاته الأخيرة بشأن واقع الرياضة النسائية داعما هو الاخر لهذا التوجه، وتأكيد عضوات المجلس على أهمية الأندية الصحية والرياضية معاً في حياة المرأة، وطالب مجلس الشورى في توصية وزارة التعليم بدراسة إضافة برامج اللياقة البدنية والصحية لمدارس البنات، بما يتفق مع الضوابط الشرعية، وطبيعتهن، والتنسيق لوضع برامج التأهيل المناسب للمعلمات، معللين بازدياد السمنة في المجتمع ، خصوصاً وسط النساء، وهو أمر من شأنه يوجب الاهتمام ببرامج اللياقة البدنية والصحية.\r\n\r\nويدعم هذا الخط التوجه لمنح تراخيص أكثر تنظيماً، للأندية الرياضية النسائية والتوسع في فتح صالات رياضية للنساء والاستثمار فيها، لممارسة النشاط البدني بما يدعم صحة المواطن، كما تحركت جهات حكومية أخرى لوضع ضوابط للأندية النسائية الصحية في المناطق، وبحث منح تراخيص خاصة بالأندية النسائية الصحية تمارس وفق أنظمة وضوابط شرعية.\r\n\r\n\r\nالمصدر: http://www.alriyadh.com/1542581', 'uploads/images/newsImages/img_1555090016.jpg', 69, 1, 'صحه', 1, '2019-04-12 23:26:56', '2019-04-12 23:28:10'),
(24, '«التربية» تعتمد «الصحية والنسوية» لتعليم الفتيات «الرشاقة» وأهمية «الرياضة»', 'يترقّب الوسط التعليمي الأسبوع المقبل، استلام مقررات النظام الفصلي لطلبة الثانوية العامة، وبينها مقرر «التربية الصحية والنسوية للبنات»، بحسب توقعات لمسؤولات في القطاع التربوي، أكدن لـ «الحياة» أن «الكتاب لا يتعلق بالرياضة وإنما بكيفية الحفاظ على الصحة العامة، ويهتم بالتربية البدنية والصحية».', 'لدمام – رحمة ذياب | منذ 20 مايو 2014 / 20:57\r\n\r\nيترقّب الوسط التعليمي الأسبوع المقبل، استلام مقررات النظام الفصلي لطلبة الثانوية العامة، وبينها مقرر «التربية الصحية والنسوية للبنات»، بحسب توقعات لمسؤولات في القطاع التربوي، أكدن لـ «الحياة» أن «الكتاب لا يتعلق بالرياضة وإنما بكيفية الحفاظ على الصحة العامة، ويهتم بالتربية البدنية والصحية».\r\n\r\nفيما علمت «الحياة» من مصادر مطلعة في وزارة التربية والتعليم، أن وزيرها الأمير خالد الفيصل «وافق على كتاب التربية الصحية والبدنية للبنين، وكتاب التربية الصحية والنسوية للبنات، ضمن الخطة الجديدة للمقررات». وأوضحت المصادر أن «المقرر لا يتعلق بالرياضة، وإنما يتناول أبرز الأساليب الصحية التي تهمّ المرأة في حياتها العامة واعتُمِدَ من الوزارة، وما زال القرار داخلياً ولم يعمم على إدارات ومكاتب التربية والتعليم، إلا أنه تم وضع المقررات على قرص مضغوط لأجل بدء التدريب وإعداد الكوادر التعليمية التي ستُقدم المنهج».\r\n\r\nبدوره، أوضح المتحدث باسم الإدارة العامة للتربية والتعليم في المنطقة الشرقية خالد الحماد، لـ «الحياة»، أنه «لم يتم البت في الموضوع، ولم يصدر قرار من الوزارة حول اعتماد كتابي التربية البدنية للبنين والصحية للبنات، علماً بأنه تم اعتماده للبنين في النظام الفصلي». فيما رفض المتحدث باسم وزارة التربية والتعليم مبارك العصيمي، الرد على استفسار «الحياة»، على رغم طرح السؤال مرات عدة، إلا أنه أبدى عدم رغبته في الرد. من جانبهن ذكرت مديرات مدارس في تصريحات إلى «الحياة»، أن «الأسبوع المقبل سيتم استلام المقررات، وما زال مقرر التربية البدنية والنسوية قيد البحث والدرس لاعتماده. وعندما تواصلنا مع مكاتب التربية والتعليم في المنطقة، تم إبلاغنا بأن الأمر لا يزال قيد البحث»، لافتات إلى «تدريب مشرفات تربويات على المنهج الذي يوضح كيفية التخلص من السمنة والحفاظ على الوزن المناسب في عمر مبكر، وغيرها من الشؤون التي تهمُّ الفتاة للحفاظ على رشاقتها»، إلا أنهن استدركن بالقول: «توجد بعض الفصول في الكتاب تؤكد على أهمية ممارسة الرياضة بشكل مستمر مع ذكر الفوائد والإثباتات العلمية لذلك».وقالت مشرفة تربوية (تحتفظ «الحياة» باسمها): «إن التدريب يشمل مسارات التربية الصحية، ولا علاقة له بالرياضة إطلاقاً ولم يتم تسلّم المقرر، وإنما كان التدريب من خلال قرص مضغوط داخله مقررات النظام الفصلي لطلبة الثانوية العامة»، مؤكدة أهمية المقرر وما سيحققه من «فائدة تربوية وصحية في حال اعتماده».\r\n\r\nإلى ذلك، أقام مكتب التربية والتعليم في محافظة القطيف أخيراً، لقاء حضره مشرفون تربويون، للتعريف بمشروع «تطوير النظام السنوي في المدارس الثانوية إلى النظام الفصلي الجديد»، المزمع تطبيقه في المدارس الثانوية للعام الدراسي المقبل. فيما يتم حالياً تهيئة الطلبة للتعرّف على النظام الجديد، الذي يهدف إلى «تحسين بنية النظام التعليمي من خلال خفض عدد المواد ومواءمة الكتب الدراسية، بما يكفل جودة المخرجات التربوية». وتقوم آلية النظام الفصلي، الذي يشمل ستة مستويات فصلية دراسية، وستُطبق للبنين والبنات، على «مراعاة وقت الطالب». ويشمل النظام الفصلي ثلاثة أقسام هي: العلمي ويشمل العلوم طبيعية، والأدبي ويشمل العلوم الشرعية والعربية، والإداري ويشمل العلوم الإدارية والاجتماعية، موزعة على 18 أسبوعاً دراسياً.\r\n\r\nوتشمل مزايا النظام الفصلي أن لكل فصل دراسي اختباراً خاصاً للدور الثاني للمكملين، ويُعدّ فرصة كبيرة للمتعثرين دراسياً مع وجود الفصل الصيفي. وأما عن الفرق بين النظام الفصلي ونظام المقررات، فيتيح الأخير الفرصة لوضع خطة مستقلة لكل مدرسة. بينما النظام الفصلي فهو موحّد على جميع مناطق المملكة ويهيئ الطلاب للنظام الجامعي، عبر المسار العام بالسنة الأولى وصولاً للمسارات التخصصية المختلفة بالسنة الثانية والثالثة للمرحلة الثانوية.', 'uploads/images/newsImages/img_1555090273.jpg', 69, 1, 'صحه', 1, '2019-04-12 23:31:13', '2019-04-12 23:31:13'),
(25, 'تطور رياضة المرأة في السعودية في 2016', 'وصلت الرياضة النسائية في السعودية مراحل متطورة خلال نهاية عام 2016 بعد أن كانت تمارس بشكل بسيط مما ترتب عليها الكثير من الأمراض الصحية وسجلت نسب عالية من مرض السمنة في السعودية بسبب قلة الرياضة البدنية للنساء ، وتأتي السعودية ثالث دول العالم في قلة الحركة و واحدة من الدول المتقدمة في ترتيب أكثر الدول في نسبة السمنة على مستوى العالم، مع الكويت وأميركا.', 'عبير العمودي الإثنين, 12/26/2016 - 16:17 \r\nAddThis Sharing Buttons\r\nShare to WhatsAppShare to MessengerShare to FacebookShare to TwitterShare to TelegramShare to المزيد1\r\nوصلت الرياضة النسائية في السعودية مراحل متطورة خلال نهاية عام 2016 بعد أن كانت تمارس بشكل بسيط مما ترتب عليها الكثير من الأمراض الصحية وسجلت نسب عالية من مرض السمنة في السعودية بسبب قلة الرياضة البدنية للنساء ، وتأتي السعودية ثالث دول العالم في قلة الحركة و واحدة من الدول المتقدمة في ترتيب أكثر الدول في نسبة السمنة على مستوى العالم، مع الكويت وأميركا.\r\nالرياضة النسائية في السعودية قبل 2016\r\nكانت البداية في تطور الرياضة السعودية حينما أصبحت أروى المطبقاني في عام 2008، أول امرأة سعودية يتم تعيينها إدارية رئيسية في اتحاد الفروسية ، و في عام 2010 كانت أول امرأة سعودية تنافس في أولمبياد الشباب في سنغافورة وهي الفارسة دلما رشدي ملحس ، و في عام 2012 شارك الوفد النسائي السعودي في أولمبياد لندن و المؤلفة من سارة العطار وزميلتها لاعبة الجودو وجدان شهرخاني ، والذي كان ضمن اللجنة الأولمبية السعودية كأول بعثة نسائية ، أما أول نادي كرة سله فأسسته عضوة مجلس الشورى الجديدة لينة آل معينا التي أحبت ممارسة الرياضة منذ الصغر من خلال فريق جدة يونايتد كما قامت بافتتاح متجر رياضي بعد 10 سنوات من التدريب لأكاديمية كرة السلة للفتيات و كرة القدم للشباب ، وشاركت آل معينا في العديد من الفعاليات الرياضية مثل رحلتها لتسلق المخيم الرئيسي في قمة إيفرست عام 2012م ضمن حملة التوعية حول سرطان الثدي ، و في عام 2013 دخلت رها محرق 27 عاما التاريخ كأصغر عربية تصل إلى قمة جبل إيفرست أيضا .\r\nتطور الرياضة النسائية في السعودية في عام 2016\r\nاستطاعت النساء في السعودية تحقيق الكثير من التقدم فيما يتعلق بالرياضة النسائية خصوصا بعد مشاركتهن في الألعاب الرياضية المختلفة داخل و خارج السعودية وممارسة الرياضة في الأندية و المدارس والجامعات لتصبح الرياضة النسائية أمر مألوف و مجال تنافسي بين سيدات المجتمع .\r\nو برزت أسماء النساء السعوديات في عالم الرياضة وذلك بعد تسلقهن أعالي الجبال والغوص ومشاركتهن في افتتاح الألعاب الأولمبية في ريو ضمن اللجنة الأولمبية الوطنية السعودية  .. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .\r\nو تضمنت رؤية 2030 السعودية تحسين مشاركة النساء والفتيات في الرياضة وذلك بعد تعيين صاحبة السمو الملكي الأميرة ريما بنت بندر آل سعود وكيلة لرئيس هيئة الرياضة في القسم النسائي وهي رائدة أعمال ومناصرة للصحة العامة واللياقة و التي سيساهم تواجدها في وضع ترخيص صالات رياضية نسائية ووضع مناهج التربية البدنية في المدارس الحكومية للبنات ، هذا وشاركت 6 سيدات سعوديات في أولمبياد ريو - 2016 منهن العداءة سارة العطار و لبنى العمير وكاريمان أبو الجدايل ووجود فهمي.\r\nوأوضحت نائبة وكيل الرئيس للهيئة العامة للرياضة للقسم النسائي هيفاء الصباب أن الهيئة وقعت اتفاقات مع جامعات سعودية بهدف إقرار برامج تدريبية لتخريج مدربات لياقة بدنية من ضمنها جامعة الأميرة نورة. ومن أهم فوائد الاتفاق وضع برامج تدريبية لتخريج مدربات لياقة بدنية، وفتح منشآت الجامعة لعامة النساء، وتفعيل برنامج الرياضة للجامعات من خلال البرنامج التجريبي في الجامعة المذكورة، وتفعيل البرامج والبطولات والفعاليات الرياضية والمجتمعية النسائية .', 'uploads/images/newsImages/img_1555090871.jpg', 69, 2, 'رياضه', 1, '2019-04-12 23:41:11', '2019-04-12 23:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE `news_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `news_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '0 if it is comment id if it is reply of comment',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_comments`
--

INSERT INTO `news_comments` (`id`, `news_id`, `user_id`, `comment`, `parent`, `status`, `created_at`, `updated_at`) VALUES
(2, 21, 100, 'نربغعتبؤفي', 0, 1, '2019-04-17 13:57:04', '2019-04-17 13:57:04'),
(3, 21, 100, 'نتروتغاؤ', 2, 1, '2019-04-17 13:57:11', '2019-04-17 13:57:11'),
(4, 24, 100, 'iugdsuyfsd', 0, 1, '2019-04-17 14:29:44', '2019-04-17 14:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8 NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `clicked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `clicked`, `created_at`, `updated_at`) VALUES
('0396cf8e-c653-42c6-85b4-8c3d4e6f33af', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":65,\"name\":\"\\u0623\\u0645\\u064a\\u0646\\u0629 \\u0623\\u062d\\u0645\\u062f \\u062d\\u0627\\u0645\\u062f\",\"email\":\"eng.aminaahmed@yahoo.com\",\"username\":\"\\u0623\\u0645\\u064a\\u0646\\u0629 \\u0623\\u062d\\u0645\\u062f\",\"email_verified_at\":null,\"password\":\"$2y$10$ccaUoIEciJW9TPdAt0qjwe96o7wiQsi6F2A6hXrRhhaxx\\/wwwT4o.\",\"plain_password\":\"123456\",\"image\":\"design\\/frontEnd\\/images\\/players_girl.png\",\"countries_id\":1,\"govarea_id\":25,\"city_id\":156,\"status\":1,\"cv_link\":null,\"roles_id\":4,\"type\":\"\\u0627\\u0646\\u062b\\u0649\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":null,\"created_at\":\"2019-04-10 09:01:21\",\"updated_at\":\"2019-04-10 09:03:59\"},\"joined\":{\"id\":7,\"name\":\"\\u062a\\u062f\\u0639\\u064a\\u0645 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\\u0629\",\"place_id\":7,\"user_id\":45,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/eventImages\\/img_1554886463.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":10,\"from_datetime\":\"2019-03-18 00:00:00\",\"to_datetime\":\"2019-03-21 00:00:00\",\"agenda\":\"\\u064a\\u0646\\u0638\\u0645 \\u0645\\u0631\\u0643\\u0632 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u0641\\u0631\\u0646\\u0633\\u064a\\u0629 \\u064a\\u0648\\u0645 24 \\u064a\\u0646\\u0627\\u064a\\u0631 \\u0627\\u0644\\u062c\\u0627\\u0631\\u0649 - \\u0648\\u0644\\u0644\\u0639\\u0627\\u0645 \\u0627\\u0644\\u062b\\u0627\\u0646\\u0649 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0644\\u0649 - \\u062d\\u0645\\u0644\\u0629 \\u0628\\u0639\\u0646\\u0648\\u0627\\u0646 \\\"24 \\u0633\\u0627\\u0639\\u0629 \\u0631\\u064a\\u0627\\u0636\\u0629 \\u0646\\u0633\\u0627\\u0626\\u064a\\u0629\\\"\\u060c \\u0644\\u062a\\u062d\\u0641\\u064a\\u0632 \\u0627\\u0644\\u0645\\u0631\\u0623\\u0629 \\u0627\\u0644\\u0641\\u0631\\u0646\\u0633\\u064a\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u062d\\u0631\\u0643\\u0629 \\u0648\\u0627\\u0644\\u0646\\u0634\\u0627\\u0637.\\r\\n\\r\\n\\u0648\\u062a\\u0634\\u0645\\u0644 \\u0627\\u0644\\u062d\\u0645\\u0644\\u0629\\u060c \\u0627\\u0644\\u062a\\u0649 \\u062a\\u0642\\u0648\\u062f\\u0647\\u0627 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\\u064a\\u0629 \\u0644\\u0648\\u0631\\u0627 \\u062c\\u0648\\u0631\\u062c\\u060c \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0646\\u0634\\u0637\\u0629 \\u0648\\u0627\\u0644\\u0644\\u0642\\u0627\\u0621\\u0627\\u062a \\u0648\\u0627\\u0644\\u062a\\u062f\\u0631\\u064a\\u0628\\u0627\\u062a \\u0627\\u0644\\u062a\\u0649 \\u062a\\u062d\\u0641\\u0632 \\u0627\\u0644\\u0645\\u0631\\u0623\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u062d\\u0631\\u0643\\u0629 \\u0648\\u0645\\u0645\\u0627\\u0631\\u0633\\u0629 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u062a\\u0649 \\u062a\\u0641\\u064a\\u062f\\u0647\\u0627 \\u0635\\u062d\\u064a\\u0627 \\u0648\\u062c\\u0633\\u0645\\u0627\\u0646\\u064a\\u0627\\u060c \\u0648\\u062a\\u0633\\u0627\\u0639\\u062f\\u0647\\u0627 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u062a\\u062e\\u0644\\u0635 \\u0645\\u0646 \\u0627\\u0644\\u0636\\u063a\\u0648\\u0637 \\u0627\\u0644\\u062a\\u0649 \\u062a\\u062a\\u0639\\u0631\\u0636 \\u0644\\u0647\\u0627 \\u064a\\u0648\\u0645\\u064a\\u0627 \\u0641\\u0649 \\u0627\\u0644\\u062d\\u064a\\u0627\\u0629 \\u0633\\u0648\\u0627\\u0621 \\u0641\\u0649 \\u0627\\u0644\\u0639\\u0645\\u0644 \\u0623\\u0648 \\u0627\\u0644\\u0628\\u064a\\u062a.\",\"status\":1,\"created_at\":null,\"updated_at\":\"2019-04-10 08:54:23\",\"event_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"govarea_id\":1,\"city_id\":2,\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"type\":\"\",\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"upgrade\":0,\"remember_token\":\"Phra1HXXBhDkLoBaEIB03ZkurM4XIxyA0SYWsty81E4p3aOec19YHl0DT6jP\",\"created_at\":null,\"updated_at\":null}},\"type\":\"event\"}', '2019-04-10 15:59:06', 0, '2019-04-10 15:58:37', '2019-04-10 15:59:06'),
('11d4eaf0-6d48-4e28-8d55-b1e683ee544a', 'App\\Notifications\\joinRequest', 'App\\User', 35, '{\"user\":{\"id\":64,\"name\":\"ahmed ali\",\"email\":\"badr@disbox.net\",\"username\":\"ahmed ali\",\"email_verified_at\":null,\"password\":\"$2y$10$kgoewyZm2GWzojf5kVkpnuK8qRNBUeo3d9wgt.ACQ8LRPpNR.tX\\/e\",\"plain_password\":\"123456\",\"image\":\"design\\/frontEnd\\/images\\/fans man.png\",\"countries_id\":5,\"govarea_id\":1,\"city_id\":1,\"status\":1,\"cv_link\":null,\"roles_id\":2,\"type\":\"\\u0630\\u0643\\u0631\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":null,\"created_at\":\"2019-04-09 08:19:23\",\"updated_at\":\"2019-04-09 08:21:22\"},\"joined\":{\"id\":10,\"name\":\"\\u0627\\u0644\\u0645\\u0644\\u0639\\u0628 \\u0627\\u0644\\u062e\\u0645\\u0627\\u0633\\u064a\",\"place_id\":8,\"user_id\":35,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/eventImages\\/img_1554807063.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":102,\"from_datetime\":\"2019-04-09 13:48:00\",\"to_datetime\":\"2019-04-09 14:00:00\",\"agenda\":\"\\u0645\\u0628\\u0627\\u0631\\u0627\\u0647 \\u0648\\u062f\\u064a\\u0647 \\u0628\\u064a\\u0646 \\u0641\\u0631\\u062b\\u0642\\u0649 .......\",\"status\":1,\"created_at\":\"2019-04-09 10:51:03\",\"updated_at\":\"2019-04-09 10:51:03\",\"event_admin\":{\"id\":35,\"name\":\"ahmed\",\"email\":\"ahmed@gmail.com\",\"username\":\"ahmedMa7fouz\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549988684.jpg\",\"countries_id\":1,\"govarea_id\":2,\"city_id\":2,\"status\":1,\"cv_link\":null,\"roles_id\":1,\"type\":\"\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":\"Rb2w2J2XXwBKtzqitfUANNIzmCGK75YjqsB06S61rrWlnufKeasD2mLyVEOS\",\"created_at\":null,\"updated_at\":\"2019-02-12 03:24:44\"}},\"type\":\"event\"}', '2019-04-09 23:28:36', 1, '2019-04-09 19:07:50', '2019-04-11 15:49:00'),
('150a665d-98d3-4f95-89ba-7bd268962608', 'App\\Notifications\\upgradeProfile', 'App\\User', 69, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"govarea_id\":1,\"city_id\":2,\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":4,\"type\":\"\",\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"upgrade\":0,\"remember_token\":\"YjKjygaUeW8dCH8AZuuHu5Qs4ams9fhwX7Wg2lEYsjcElOp7vWkY6I1SctPB\",\"created_at\":null,\"updated_at\":null}}', '2019-04-11 19:53:36', 1, '2019-04-11 19:11:46', '2019-04-11 19:54:02'),
('1e3a251c-c617-4b4c-ac6e-ccab142b0354', 'App\\Notifications\\joinAccept', 'App\\User', 46, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null},\"joined\":{\"id\":3,\"name\":\"\\u0627\\u0644\\u0645\\u062c\\u0645\\u0648\\u0639\\u0647 \\u0627\\u0644\\u062b\\u0627\\u0644\\u062b\\u0647\",\"description\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book\",\"image_url\":\"uploads\\/images\\/groupImages\\/img_1552837114.jpg\",\"user_id\":35,\"admin_id\":45,\"sport_id\":1,\"team_id\":1,\"status\":1,\"created_at\":\"2019-03-17 23:38:34\",\"updated_at\":\"2019-03-17 23:39:09\"},\"type\":\"group\"}', '2019-03-20 20:09:24', 1, '2019-03-20 20:09:03', '2019-03-20 20:09:29'),
('264dadf1-568f-440a-96c2-bb5c2f9381c0', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"govarea_id\":1,\"city_id\":2,\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"type\":\"\",\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"upgrade\":0,\"remember_token\":\"UTD3D00uHhZQLyAR5z9xiAFbZEsA9QQaeFWEJQb9xYgkLoNN1lqeWz8rSRRc\",\"created_at\":null,\"updated_at\":null},\"joined\":{\"id\":3,\"name\":\"\\u0627\\u0644\\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u062b\\u0627\\u0644\\u062b\",\"description\":\"\\u0642\\u0641\\u0632 \\u0628\\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0647\\u064a \\u0625\\u062d\\u062f\\u0649 \\u0631\\u064a\\u0627\\u0636\\u0627\\u062a \\u0623\\u0644\\u0639\\u0627\\u0628 \\u0627\\u0644\\u0642\\u0648\\u0649 \\u0648\\u0647\\u0648 \\u0645\\u0634\\u062a\\u0642 \\u0645\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0628\\u0627\\u0632, \\u0648\\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0639\\u0628 \\u0645\\u0646 \\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u0642\\u0641\\u0632, \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0645\\u062a\\u0633\\u0627\\u0628\\u0642 \\u0628\\u0627\\u0646\\u062f\\u0641\\u0627\\u0639 \\u0633\\u0631\\u064a\\u0639 \\u062c\\u062f\\u0627\\u060c \\u0648\\u0647\\u0648 \\u064a\\u062d\\u0645\\u0644 \\u0641\\u064a \\u064a\\u062f\\u0647 \\u0632\\u0627\\u0646\\u0629 \\u0637\\u0648\\u064a\\u0644\\u0629, \\u0648\\u0639\\u0646\\u062f\\u0645\\u0627 \\u064a\\u0635\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0627\\u0631\\u064a \\u064a\\u063a\\u0631\\u0632 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0623\\u0631\\u0636 \\u0639\\u0644\\u0649 \\u0634\\u0643\\u0644 \\u0631\\u0643\\u064a\\u0632\\u0629\\u060c \\u0648\\u064a\\u062d\\u0648\\u0644 \\u0633\\u0631\\u0639\\u062a\\u0647 \\u0625\\u0644\\u0649 \\u0642\\u0648\\u0629 \\u0635\\u0639\\u0648\\u062f, \\u0628\\u0623\\u0646 \\u064a\\u0634\\u062f \\u0639\\u0636\\u0644\\u0627\\u062a\\u0647 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629\\u060c \\u0648\\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u064a\\u0637\\u0648\\u062d \\u0628\\u0633\\u0627\\u0642\\u064a\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0647\\u0648\\u0627\\u0621, \\u0644\\u0643\\u064a \\u064a\\u0631\\u062a\\u0641\\u0639 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u062d\\u0627\\u062c\\u0632,\\u0642\\u0641\\u0632 \\u0628\\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0647\\u064a \\u0625\\u062d\\u062f\\u0649 \\u0631\\u064a\\u0627\\u0636\\u0627\\u062a \\u0623\\u0644\\u0639\\u0627\\u0628 \\u0627\\u0644\\u0642\\u0648\\u0649 \\u0648\\u0647\\u0648 \\u0645\\u0634\\u062a\\u0642 \\u0645\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0628\\u0627\\u0632, \\u0648\\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0639\\u0628 \\u0645\\u0646 \\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u0642\\u0641\\u0632, \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0645\\u062a\\u0633\\u0627\\u0628\\u0642 \\u0628\\u0627\\u0646\\u062f\\u0641\\u0627\\u0639 \\u0633\\u0631\\u064a\\u0639 \\u062c\\u062f\\u0627\\u060c \\u0648\\u0647\\u0648 \\u064a\\u062d\\u0645\\u0644 \\u0641\\u064a \\u064a\\u062f\\u0647 \\u0632\\u0627\\u0646\\u0629 \\u0637\\u0648\\u064a\\u0644\\u0629, \\u0648\\u0639\\u0646\\u062f\\u0645\\u0627 \\u064a\\u0635\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0627\\u0631\\u064a \\u064a\\u063a\\u0631\\u0632 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0623\\u0631\\u0636 \\u0639\\u0644\\u0649 \\u0634\\u0643\\u0644 \\u0631\\u0643\\u064a\\u0632\\u0629\\u060c \\u0648\\u064a\\u062d\\u0648\\u0644 \\u0633\\u0631\\u0639\\u062a\\u0647 \\u0625\\u0644\\u0649 \\u0642\\u0648\\u0629 \\u0635\\u0639\\u0648\\u062f, \\u0628\\u0623\\u0646 \\u064a\\u0634\\u062f \\u0639\\u0636\\u0644\\u0627\\u062a\\u0647 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629\\u060c \\u0648\\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u064a\\u0637\\u0648\\u062d \\u0628\\u0633\\u0627\\u0642\\u064a\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0647\\u0648\\u0627\\u0621, \\u0644\\u0643\\u064a \\u064a\\u0631\\u062a\\u0641\\u0639 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u062d\\u0627\\u062c\\u0632\",\"slogan\":\"uploads\\/images\\/teamSlogans\\/slogan_1554888911.jpg\",\"user_id\":35,\"sport_id\":1,\"admin_id\":45,\"status\":1,\"created_at\":\"2019-03-17 15:41:49\",\"updated_at\":\"2019-04-10 09:35:11\",\"team_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"govarea_id\":1,\"city_id\":2,\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"type\":\"\",\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"upgrade\":0,\"remember_token\":\"UTD3D00uHhZQLyAR5z9xiAFbZEsA9QQaeFWEJQb9xYgkLoNN1lqeWz8rSRRc\",\"created_at\":null,\"updated_at\":null}},\"type\":\"team\"}', '2019-04-10 19:05:46', 1, '2019-04-10 17:47:43', '2019-04-10 19:06:43'),
('326f3af0-4b1a-481b-b737-0efcbe51d508', 'App\\Notifications\\joinAccept', 'App\\User', 45, '{\"user\":{\"id\":35,\"name\":\"ahmed\",\"email\":\"ahmed@gmail.com\",\"username\":\"ahmedMa7fouz\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549988684.jpg\",\"countries_id\":1,\"govarea_id\":2,\"city_id\":2,\"status\":1,\"cv_link\":null,\"roles_id\":1,\"type\":\"\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":\"tL4od9ZQoLLTNO72JOMh8BbYCjdBbwmRF4n5izVHJ4QQybjoLJcerd1JJPAb\",\"created_at\":null,\"updated_at\":\"2019-02-12 03:24:44\"},\"joined\":{\"id\":10,\"name\":\"\\u0627\\u0644\\u0645\\u0644\\u0639\\u0628 \\u0627\\u0644\\u062e\\u0645\\u0627\\u0633\\u064a\",\"place_id\":8,\"user_id\":35,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/eventImages\\/img_1554886520.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":102,\"from_datetime\":\"2019-04-09 13:48:00\",\"to_datetime\":\"2019-04-09 14:00:00\",\"agenda\":\"\\u0645\\u0628\\u0627\\u0631\\u0627\\u0647 \\u0648\\u062f\\u064a\\u0647 \\u0628\\u064a\\u0646 \\u0641\\u0631\\u062b\\u0642\\u0649 .......\",\"status\":1,\"created_at\":\"2019-04-09 10:51:03\",\"updated_at\":\"2019-04-10 08:55:20\"},\"type\":\"event\"}', '2019-04-11 19:09:37', 1, '2019-04-11 19:09:23', '2019-04-11 19:09:40'),
('3c8128ed-61ff-4e64-b6d2-bede761b3209', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":48,\"name\":\"\\u0639\\u0645\\u0631 \\u062c\\u0645\\u0627\\u0644\",\"email\":\"mm@01143271505.com\",\"username\":\"mmmmmmm\",\"email_verified_at\":null,\"password\":\"$2y$10$X74MZQt0wFizzteGfk0h3OIfAU1WnaDJnZDuXljgTDj7iLygyI68.\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1551172607.png\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":null,\"roles_id\":4,\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"Ye2RqIJfhKPBZKWi7oRokLNcWLRjGzmu9H3cQRjQx3UFE3GI06b0PZp5XZrL\",\"created_at\":\"2019-02-12 12:17:14\",\"updated_at\":\"2019-03-21 15:12:14\"},\"joined\":{\"id\":7,\"name\":\"\\u062a\\u062f\\u0639\\u064a\\u0645 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\\u0629\",\"place_id\":3,\"user_id\":45,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/groupImages\\/img_1549977256.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":10,\"from_datetime\":\"2019-03-18 00:00:00\",\"to_datetime\":\"2019-03-21 00:00:00\",\"agenda\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a\",\"status\":1,\"created_at\":null,\"updated_at\":\"2019-03-21 12:59:30\",\"event_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"jH0CLcT1uHYPyo6AuayL0C8hHOIe8I6v4dF6ZhDwhgHSlu7x4gfJclFH9a7a\",\"created_at\":null,\"updated_at\":null}},\"type\":\"event\"}', '2019-04-03 23:12:22', 0, '2019-03-21 21:13:36', '2019-04-03 23:12:22'),
('486c8c4a-b6a9-4940-9bd8-6655e071a558', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":59,\"name\":\"ali\",\"email\":\"ali@disbox.net\",\"username\":\"ali\",\"email_verified_at\":null,\"password\":\"$2y$10$MBE3zB8aO2GCcSy38Xr3J.EY2BJOs6P.gVjo8KHxPiaTeBnwWGhfa\",\"plain_password\":\"258963\",\"image\":\"uploads\\/images\\/profileImages\\/img_1552138476.jpg\",\"countries_id\":1,\"city\":\"cairo\",\"status\":1,\"cv_link\":null,\"roles_id\":2,\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":\"dKj4Fsuhs1FSSTcJlzX2dY519RGZYsnmCdOWuUcUYOSpjTOHUmhAcA5zTpDV\",\"created_at\":\"2019-03-09 13:34:36\",\"updated_at\":\"2019-03-09 13:35:28\"},\"joined\":{\"id\":8,\"name\":\"100 \\u0645\\u0644\\u064a\\u0648\\u0646 \\u0635\\u062d\\u0629\",\"place_id\":2,\"user_id\":45,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/groupImages\\/img_1549977256.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":22,\"from_datetime\":\"2019-03-18 00:00:00\",\"to_datetime\":\"2019-03-30 00:00:00\",\"agenda\":\"\\u0641\\u0627\\u0639\\u0644\\u064a\\u0629  \\u0643\\u0648\\u064a\\u0633\\u0629\",\"status\":1,\"created_at\":null,\"updated_at\":null,\"event_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"upgrade\":0,\"remember_token\":\"jH0CLcT1uHYPyo6AuayL0C8hHOIe8I6v4dF6ZhDwhgHSlu7x4gfJclFH9a7a\",\"created_at\":null,\"updated_at\":null}},\"type\":\"event\"}', '2019-04-03 23:12:22', 0, '2019-03-25 14:53:51', '2019-04-03 23:12:22'),
('4efa7dfa-040e-4cda-b689-ad221b36a9d3', 'App\\Notifications\\upgradeProfile', 'App\\User', 69, '{\"user\":{\"id\":74,\"name\":\"\\u0645\\u0646\\u062a\\u0645\\u064a \\u062a\\u0633\\u062a\",\"email\":\"mohsin_017@hotmail.com\",\"username\":\"\\u0645\\u0646\\u062a\\u0645\\u064a \\u0627\\u062f\\u0645\\u0646\",\"email_verified_at\":null,\"password\":\"$2y$10$xYPLUJeniuSqOR7Rs9e29eD5EY.D\\/MYzd82Bg\\/\\/1W8Po0hoLHWRpe\",\"plain_password\":\"123456\",\"image\":\"design\\/frontEnd\\/images\\/players.png\",\"countries_id\":5,\"govarea_id\":1,\"city_id\":1,\"status\":1,\"cv_link\":null,\"roles_id\":4,\"type\":\"\\u0630\\u0643\\u0631\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":null,\"created_at\":\"2019-04-12 13:30:12\",\"updated_at\":\"2019-04-12 13:32:24\"}}', '2019-04-12 20:14:22', 1, '2019-04-12 19:39:02', '2019-04-12 20:14:22'),
('5159aeb5-35eb-4d6a-a81d-9764f70d84e3', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"upgrade\":0,\"remember_token\":\"jH0CLcT1uHYPyo6AuayL0C8hHOIe8I6v4dF6ZhDwhgHSlu7x4gfJclFH9a7a\",\"created_at\":null,\"updated_at\":null},\"joined\":{\"id\":4,\"name\":\"\\u0627\\u0644\\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u062f\\u0648\\u0644\\u064a \\u0627\\u0644\\u0645\\u0635\\u0631\\u064a\",\"description\":\"\\u0627\\u0644\\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u062f\\u0648\\u0644\\u064a \\u0627\\u0644\\u0645\\u0635\\u0631\\u064a \\u0647\\u0648 \\u0641\\u0631\\u064a\\u0642 \\u0628\\u0631\\u0626\\u0627\\u0633\\u0629 \\u0627\\u0644\\u062d\\u064a \\u0627\\u0644\\u0633\\u0627\\u0628\\u0639 \\u0645\\u062f\\u064a\\u0646\\u0629 \\u0646\\u0635\\u0631 \\u064a\\u062a\\u0643\\u0648\\u0646 \\u0645\\u0646 20 \\u0644\\u0627\\u0639\\u0628 \\u0645\\u062d\\u062a\\u0631\\u0641\",\"slogan\":\"uploads\\/images\\/teamSlogans\\/slogan_1553506192.png\",\"user_id\":35,\"sport_id\":1,\"admin_id\":45,\"status\":1,\"created_at\":\"2019-03-25 09:29:52\",\"updated_at\":\"2019-03-25 09:29:52\",\"team_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"upgrade\":0,\"remember_token\":\"jH0CLcT1uHYPyo6AuayL0C8hHOIe8I6v4dF6ZhDwhgHSlu7x4gfJclFH9a7a\",\"created_at\":null,\"updated_at\":null}},\"type\":\"team\"}', '2019-04-03 23:12:22', 1, '2019-04-03 23:11:46', '2019-04-03 23:12:28'),
('55392412-0fa8-407d-b9b0-a675feadfad6', 'App\\Notifications\\joinAccept', 'App\\User', 46, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null},\"joined\":null,\"type\":\"team\"}', '2019-03-20 20:19:02', 1, '2019-03-20 20:18:49', '2019-03-20 20:19:05'),
('5a55a5ff-0243-4386-a7f6-075590668834', 'App\\Notifications\\joinAccept', 'App\\User', 46, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null},\"joined\":null,\"type\":\"team\"}', '2019-03-20 20:12:36', 1, '2019-03-20 20:12:20', '2019-03-20 20:12:39'),
('5b57ec06-50e2-41d0-a18a-f05335fc6851', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":48,\"name\":\"\\u0639\\u0645\\u0631 \\u062c\\u0645\\u0627\\u0644\",\"email\":\"mm@01143271505.com\",\"username\":\"mmmmmmm\",\"email_verified_at\":null,\"password\":\"$2y$10$X74MZQt0wFizzteGfk0h3OIfAU1WnaDJnZDuXljgTDj7iLygyI68.\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1551172607.png\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":null,\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1553171858.jpg\",\"guarantor_name\":\"test\",\"guarantor_email\":\"x22@yahoo.com\",\"guarantor_phone\":\"12345678901\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"YswSZJb4UbozhiCEuRD8eeGyx7GN23zRaFGACsTh3rn4xjhzloCTxTxtuABC\",\"created_at\":\"2019-02-12 12:17:14\",\"updated_at\":\"2019-03-21 12:37:38\"},\"joined\":{\"id\":8,\"name\":\"100 \\u0645\\u0644\\u064a\\u0648\\u0646 \\u0635\\u062d\\u0629\",\"place_id\":2,\"user_id\":45,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/groupImages\\/img_1549977256.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":22,\"from_datetime\":\"2019-03-18 00:00:00\",\"to_datetime\":\"2019-03-30 00:00:00\",\"agenda\":\"\\u0641\\u0627\\u0639\\u0644\\u064a\\u0629  \\u0643\\u0648\\u064a\\u0633\\u0629\",\"status\":1,\"created_at\":null,\"updated_at\":null,\"event_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"jH0CLcT1uHYPyo6AuayL0C8hHOIe8I6v4dF6ZhDwhgHSlu7x4gfJclFH9a7a\",\"created_at\":null,\"updated_at\":null}},\"type\":\"event\"}', '2019-04-03 23:12:22', 0, '2019-03-21 18:40:53', '2019-04-03 23:12:22'),
('5c1469f1-44d6-4755-a9c4-f4b1b852f67d', 'App\\Notifications\\upgradeProfile', 'App\\User', 69, '{\"user\":{\"id\":73,\"name\":\"\\u0645\\u0646\\u062a\\u0645\\u064a \\u0627\\u062f\\u0645\\u0646\",\"email\":\"mohsin_017@hotmail.com\",\"username\":\"\\u0645\\u0646\\u062a\\u0645\\u064a \\u0627\\u062f\\u0645\\u0646\",\"email_verified_at\":null,\"password\":\"$2y$10$bQqBq4Egh65ZFzE63jh9CueTKbtWtsMPc227sOFGVsE0d8iKnGS0u\",\"plain_password\":\"123456\",\"image\":\"design\\/frontEnd\\/images\\/players.png\",\"countries_id\":5,\"govarea_id\":14,\"city_id\":8,\"status\":1,\"cv_link\":null,\"roles_id\":4,\"type\":\"\\u0630\\u0643\\u0631\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":null,\"created_at\":\"2019-04-11 11:22:01\",\"updated_at\":\"2019-04-11 11:27:12\"}}', '2019-04-11 17:37:37', 1, '2019-04-11 17:36:53', '2019-04-11 17:37:56'),
('6d371032-9e1b-4463-90be-93120bd342bc', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":46,\"name\":\"\\u0627\\u062d\\u0645\\u062f \\u062e\\u0644\\u064a\\u0641\\u0629\",\"email\":\"mom@gmail.com\",\"username\":\"m\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549814083.jpg\",\"countries_id\":3,\"city\":\"\\u0627\\u0644\\u062c\\u064a\\u0632\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549814144.docx\",\"roles_id\":4,\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":null,\"remember_token\":null,\"created_at\":null,\"updated_at\":\"2019-02-23 18:18:26\"},\"joined\":{\"id\":8,\"name\":\"100 \\u0645\\u0644\\u064a\\u0648\\u0646 \\u0635\\u062d\\u0629\",\"place_id\":2,\"user_id\":45,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/groupImages\\/img_1549977256.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":22,\"from_datetime\":\"2019-03-18 00:00:00\",\"to_datetime\":\"2019-03-30 00:00:00\",\"agenda\":\"\\u0641\\u0627\\u0639\\u0644\\u064a\\u0629  \\u0643\\u0648\\u064a\\u0633\\u0629\",\"status\":1,\"created_at\":null,\"updated_at\":null,\"event_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null}},\"type\":\"event\"}', '2019-03-20 18:19:42', 1, '2019-03-20 18:19:36', '2019-03-20 18:39:50'),
('6f0cc139-b81e-4d75-8cc3-b5c8689239e8', 'App\\Notifications\\joinAccept', 'App\\User', 46, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null},\"joined\":{\"id\":8,\"name\":\"100 \\u0645\\u0644\\u064a\\u0648\\u0646 \\u0635\\u062d\\u0629\",\"place_id\":2,\"user_id\":45,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/groupImages\\/img_1549977256.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":22,\"from_datetime\":\"2019-03-18 00:00:00\",\"to_datetime\":\"2019-03-30 00:00:00\",\"agenda\":\"\\u0641\\u0627\\u0639\\u0644\\u064a\\u0629  \\u0643\\u0648\\u064a\\u0633\\u0629\",\"status\":1,\"created_at\":null,\"updated_at\":null},\"type\":\"event\"}', '2019-03-20 20:12:36', 1, '2019-03-20 20:12:26', '2019-03-20 20:13:01'),
('77734555-5bec-4e06-8bb6-f9dcec54dbe6', 'App\\Notifications\\joinRequest', 'App\\User', 35, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"govarea_id\":1,\"city_id\":2,\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"type\":\"\",\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"upgrade\":0,\"remember_token\":\"px7AeJ9YjVHDNSOFdpDfgnHOWZkxIcpjHv3CCajHgJQwSRbV4veFpPE55svi\",\"created_at\":null,\"updated_at\":null},\"joined\":{\"id\":12,\"name\":\"\\u0627\\u0644\\u0631\\u064a\\u0645\\u0648\\u0648\\u0646\\u062a\\u0627\\u062f\\u0627\",\"place_id\":4,\"user_id\":35,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/eventImages\\/img_1554807971.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":30000,\"from_datetime\":\"2019-04-09 17:00:00\",\"to_datetime\":\"2019-04-09 19:00:00\",\"agenda\":\"\\u0645\\u0628\\u0627\\u0631\\u0627\\u0647 \\u0627\\u0644\\u0639\\u0648\\u062f\\u0647 \\u0644\\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0627..\",\"status\":1,\"created_at\":\"2019-04-09 11:06:11\",\"updated_at\":\"2019-04-09 11:06:11\",\"event_admin\":{\"id\":35,\"name\":\"ahmed\",\"email\":\"ahmed@gmail.com\",\"username\":\"ahmedMa7fouz\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549988684.jpg\",\"countries_id\":1,\"govarea_id\":2,\"city_id\":2,\"status\":1,\"cv_link\":null,\"roles_id\":1,\"type\":\"\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":\"qjoh4rdsiv4IP0bvm494Y6TYib2otcMv6OYGWwlYQNjRjTIyCbzCUSvSBYxv\",\"created_at\":null,\"updated_at\":\"2019-02-12 03:24:44\"}},\"type\":\"event\"}', '2019-04-10 14:55:29', 1, '2019-04-09 23:32:56', '2019-04-11 15:47:42'),
('8111483b-dc11-4811-84bc-9b46d503e039', 'App\\Notifications\\upgradeProfile', 'App\\User', 35, '{\"user\":{\"id\":73,\"name\":\"\\u0645\\u0646\\u062a\\u0645\\u064a \\u0627\\u062f\\u0645\\u0646\",\"email\":\"mohsin_017@hotmail.com\",\"username\":\"\\u0645\\u0646\\u062a\\u0645\\u064a \\u0627\\u062f\\u0645\\u0646\",\"email_verified_at\":null,\"password\":\"$2y$10$bQqBq4Egh65ZFzE63jh9CueTKbtWtsMPc227sOFGVsE0d8iKnGS0u\",\"plain_password\":\"123456\",\"image\":\"design\\/frontEnd\\/images\\/players.png\",\"countries_id\":5,\"govarea_id\":14,\"city_id\":8,\"status\":1,\"cv_link\":null,\"roles_id\":4,\"type\":\"\\u0630\\u0643\\u0631\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":null,\"created_at\":\"2019-04-11 11:22:01\",\"updated_at\":\"2019-04-11 11:27:12\"}}', '2019-04-11 19:08:23', 1, '2019-04-11 17:36:53', '2019-04-11 19:08:40'),
('862d32c7-b618-4fb3-aed0-00b6b32dccf0', 'App\\Notifications\\joinRequest', 'App\\User', 35, '{\"user\":{\"id\":66,\"name\":\"\\u062a\\u0633\\u062a1\",\"email\":\"mbka888@gmail.com\",\"username\":\"test1\",\"email_verified_at\":null,\"password\":\"$2y$10$6Rqw8GM9avr1gRXwlWF33.6oQleyeg3hdlzvvAOi7w5ez7AcrZjkK\",\"plain_password\":\"123456\",\"image\":\"design\\/frontEnd\\/images\\/fans man.png\",\"countries_id\":5,\"govarea_id\":14,\"city_id\":8,\"status\":1,\"cv_link\":null,\"roles_id\":2,\"type\":\"\\u0630\\u0643\\u0631\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":null,\"created_at\":\"2019-04-10 13:21:36\",\"updated_at\":\"2019-04-10 13:24:28\"},\"joined\":{\"id\":11,\"name\":\"Al Seddiq\",\"place_id\":4,\"user_id\":35,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/eventImages\\/img_1554887095.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":90,\"from_datetime\":\"2019-04-09 14:00:00\",\"to_datetime\":\"2019-04-09 15:00:00\",\"agenda\":\"\\u0645\\u0628\\u0627\\u0631\\u0627\\u0647 \\u0648\\u062f\\u064a\\u0647 \\u062a\\u062d\\u062f\\u062b....\",\"status\":1,\"created_at\":\"2019-04-09 11:00:56\",\"updated_at\":\"2019-04-10 09:04:55\",\"event_admin\":{\"id\":35,\"name\":\"ahmed\",\"email\":\"ahmed@gmail.com\",\"username\":\"ahmedMa7fouz\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549988684.jpg\",\"countries_id\":1,\"govarea_id\":2,\"city_id\":2,\"status\":1,\"cv_link\":null,\"roles_id\":1,\"type\":\"\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":\"OQREYEqiTqat2JXjLE7hu8nQLiMyrui2yrNalRKjngyND9COXeeg9pUZVC5G\",\"created_at\":null,\"updated_at\":\"2019-02-12 03:24:44\"}},\"type\":\"event\"}', '2019-04-10 22:45:39', 1, '2019-04-10 19:43:31', '2019-04-11 06:37:51'),
('86f27b10-2e6d-47ee-84ff-4481eb600ee7', 'App\\Notifications\\joinAccept', 'App\\User', 46, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null},\"joined\":{\"id\":7,\"name\":\"\\u062a\\u062f\\u0639\\u064a\\u0645 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\\u0629\",\"place_id\":3,\"user_id\":45,\"team_id\":1,\"group_id\":null,\"image\":\"uploads\\/images\\/groupImages\\/img_1549977256.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":10,\"from_datetime\":\"2019-03-18 00:00:00\",\"to_datetime\":\"2019-03-21 00:00:00\",\"agenda\":\"\",\"status\":1,\"created_at\":null,\"updated_at\":null},\"type\":\"event\"}', '2019-03-20 20:16:55', 1, '2019-03-20 20:16:47', '2019-03-20 20:16:57'),
('87a23b09-81e7-415e-9974-1b82d29a057f', 'App\\Notifications\\upgradeProfile', 'App\\User', 35, '{\"user\":{\"id\":74,\"name\":\"\\u0645\\u0646\\u062a\\u0645\\u064a \\u062a\\u0633\\u062a\",\"email\":\"mohsin_017@hotmail.com\",\"username\":\"\\u0645\\u0646\\u062a\\u0645\\u064a \\u0627\\u062f\\u0645\\u0646\",\"email_verified_at\":null,\"password\":\"$2y$10$xYPLUJeniuSqOR7Rs9e29eD5EY.D\\/MYzd82Bg\\/\\/1W8Po0hoLHWRpe\",\"plain_password\":\"123456\",\"image\":\"design\\/frontEnd\\/images\\/players.png\",\"countries_id\":5,\"govarea_id\":1,\"city_id\":1,\"status\":1,\"cv_link\":null,\"roles_id\":4,\"type\":\"\\u0630\\u0643\\u0631\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":null,\"created_at\":\"2019-04-12 13:30:12\",\"updated_at\":\"2019-04-12 13:32:24\"}}', '2019-04-17 15:20:28', 1, '2019-04-12 19:39:02', '2019-04-17 15:21:58'),
('96fe1083-d2dd-429b-91c6-ad04e60f7da4', 'App\\Notifications\\joinAccept', 'App\\User', 46, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null},\"joined\":null,\"type\":\"team\"}', '2019-03-20 20:16:29', 1, '2019-03-20 20:16:25', '2019-03-20 20:16:31'),
('ae15bddc-d31a-4728-b23c-3fd46b053cf9', 'App\\Notifications\\upgradeProfile', 'App\\User', 35, '{\"user\":{\"id\":69,\"name\":\"\\u0645\\u062d\\u0633\\u0646\",\"email\":\"mbka888@gmail.com\",\"username\":\"\\u0627\\u0644\\u0627\\u0633\\u062a\\u0627\\u0630 \\u0645\\u062d\\u0633\\u0646\",\"email_verified_at\":null,\"password\":\"$2y$10$cm0doolL24baEIGP8PJhHuZ9pVEDUpgWE\\/geTuCZ7FCwwKjBlSwtq\",\"plain_password\":\"123456\",\"image\":\"design\\/frontEnd\\/images\\/fans man.png\",\"countries_id\":5,\"govarea_id\":14,\"city_id\":8,\"status\":1,\"cv_link\":null,\"roles_id\":4,\"type\":\"\\u0630\\u0643\\u0631\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":null,\"created_at\":\"2019-04-10 15:58:03\",\"updated_at\":\"2019-04-10 17:37:17\"}}', '2019-04-10 23:42:17', 1, '2019-04-10 23:41:42', '2019-04-10 23:42:26');
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `clicked`, `created_at`, `updated_at`) VALUES
('b2d9c7c4-970c-4782-b083-7f136afbf098', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":46,\"name\":\"\\u0627\\u062d\\u0645\\u062f \\u062e\\u0644\\u064a\\u0641\\u0629\",\"email\":\"mom@gmail.com\",\"username\":\"m\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549814083.jpg\",\"countries_id\":3,\"city\":\"\\u0627\\u0644\\u062c\\u064a\\u0632\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549814144.docx\",\"roles_id\":4,\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":null,\"remember_token\":null,\"created_at\":null,\"updated_at\":\"2019-02-23 18:18:26\"},\"joined\":{\"id\":3,\"name\":\"\\u0627\\u0644\\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u062b\\u0627\\u0644\\u062b\",\"description\":\"\\u0642\\u0641\\u0632 \\u0628\\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0647\\u064a \\u0625\\u062d\\u062f\\u0649 \\u0631\\u064a\\u0627\\u0636\\u0627\\u062a \\u0623\\u0644\\u0639\\u0627\\u0628 \\u0627\\u0644\\u0642\\u0648\\u0649 \\u0648\\u0647\\u0648 \\u0645\\u0634\\u062a\\u0642 \\u0645\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0628\\u0627\\u0632, \\u0648\\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0639\\u0628 \\u0645\\u0646 \\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u0642\\u0641\\u0632, \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0645\\u062a\\u0633\\u0627\\u0628\\u0642 \\u0628\\u0627\\u0646\\u062f\\u0641\\u0627\\u0639 \\u0633\\u0631\\u064a\\u0639 \\u062c\\u062f\\u0627\\u060c \\u0648\\u0647\\u0648 \\u064a\\u062d\\u0645\\u0644 \\u0641\\u064a \\u064a\\u062f\\u0647 \\u0632\\u0627\\u0646\\u0629 \\u0637\\u0648\\u064a\\u0644\\u0629, \\u0648\\u0639\\u0646\\u062f\\u0645\\u0627 \\u064a\\u0635\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0627\\u0631\\u064a \\u064a\\u063a\\u0631\\u0632 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0623\\u0631\\u0636 \\u0639\\u0644\\u0649 \\u0634\\u0643\\u0644 \\u0631\\u0643\\u064a\\u0632\\u0629\\u060c \\u0648\\u064a\\u062d\\u0648\\u0644 \\u0633\\u0631\\u0639\\u062a\\u0647 \\u0625\\u0644\\u0649 \\u0642\\u0648\\u0629 \\u0635\\u0639\\u0648\\u062f, \\u0628\\u0623\\u0646 \\u064a\\u0634\\u062f \\u0639\\u0636\\u0644\\u0627\\u062a\\u0647 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629\\u060c \\u0648\\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u064a\\u0637\\u0648\\u062d \\u0628\\u0633\\u0627\\u0642\\u064a\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0647\\u0648\\u0627\\u0621, \\u0644\\u0643\\u064a \\u064a\\u0631\\u062a\\u0641\\u0639 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u062d\\u0627\\u062c\\u0632,\\u0642\\u0641\\u0632 \\u0628\\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0647\\u064a \\u0625\\u062d\\u062f\\u0649 \\u0631\\u064a\\u0627\\u0636\\u0627\\u062a \\u0623\\u0644\\u0639\\u0627\\u0628 \\u0627\\u0644\\u0642\\u0648\\u0649 \\u0648\\u0647\\u0648 \\u0645\\u0634\\u062a\\u0642 \\u0645\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0628\\u0627\\u0632, \\u0648\\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0639\\u0628 \\u0645\\u0646 \\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u0642\\u0641\\u0632, \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0645\\u062a\\u0633\\u0627\\u0628\\u0642 \\u0628\\u0627\\u0646\\u062f\\u0641\\u0627\\u0639 \\u0633\\u0631\\u064a\\u0639 \\u062c\\u062f\\u0627\\u060c \\u0648\\u0647\\u0648 \\u064a\\u062d\\u0645\\u0644 \\u0641\\u064a \\u064a\\u062f\\u0647 \\u0632\\u0627\\u0646\\u0629 \\u0637\\u0648\\u064a\\u0644\\u0629, \\u0648\\u0639\\u0646\\u062f\\u0645\\u0627 \\u064a\\u0635\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0627\\u0631\\u064a \\u064a\\u063a\\u0631\\u0632 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0623\\u0631\\u0636 \\u0639\\u0644\\u0649 \\u0634\\u0643\\u0644 \\u0631\\u0643\\u064a\\u0632\\u0629\\u060c \\u0648\\u064a\\u062d\\u0648\\u0644 \\u0633\\u0631\\u0639\\u062a\\u0647 \\u0625\\u0644\\u0649 \\u0642\\u0648\\u0629 \\u0635\\u0639\\u0648\\u062f, \\u0628\\u0623\\u0646 \\u064a\\u0634\\u062f \\u0639\\u0636\\u0644\\u0627\\u062a\\u0647 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629\\u060c \\u0648\\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u064a\\u0637\\u0648\\u062d \\u0628\\u0633\\u0627\\u0642\\u064a\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0647\\u0648\\u0627\\u0621, \\u0644\\u0643\\u064a \\u064a\\u0631\\u062a\\u0641\\u0639 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u062d\\u0627\\u062c\\u0632\",\"slogan\":\"uploads\\/images\\/teamSlogans\\/slogan_1552837309.jpg\",\"user_id\":35,\"sport_id\":1,\"admin_id\":45,\"status\":1,\"created_at\":\"2019-03-17 23:41:49\",\"updated_at\":\"2019-03-17 23:44:17\",\"team_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null}},\"type\":\"team\"}', '2019-04-03 23:12:22', 0, '2019-03-20 20:19:50', '2019-04-03 23:12:22'),
('b93af892-0dd3-48a2-ae6b-a4e7ded9ec70', 'App\\Notifications\\upgradeProfile', 'App\\User', 35, '{\"user\":{\"id\":65,\"name\":\"ahmed ali\",\"email\":\"7mm@disbox.net\",\"username\":\"ali ahmed\",\"email_verified_at\":null,\"password\":\"$2y$10$5OeIAwgXB0Uc6ltZ8vg06ucgTQqQ7jbNpmQrSLcjLuyoMX6pthDya\",\"plain_password\":\"789456\",\"image\":\"design\\/frontEnd\\/images\\/players.png\",\"countries_id\":1,\"govarea_id\":2,\"city_id\":6,\"status\":1,\"cv_link\":null,\"roles_id\":4,\"type\":\"\\u0630\\u0643\\u0631\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":null,\"created_at\":\"2019-04-09 13:13:32\",\"updated_at\":\"2019-04-09 13:13:55\"}}', '2019-04-09 23:28:36', 1, '2019-04-09 19:16:31', '2019-04-10 17:43:00'),
('bc310bba-49f7-4ec3-bf1f-2bc0ab9306a0', 'App\\Notifications\\joinRequest', 'App\\User', 35, '{\"user\":{\"id\":65,\"name\":\"\\u0623\\u0645\\u064a\\u0646\\u0629 \\u0623\\u062d\\u0645\\u062f \\u062d\\u0627\\u0645\\u062f\",\"email\":\"eng.aminaahmed@yahoo.com\",\"username\":\"\\u0623\\u0645\\u064a\\u0646\\u0629 \\u0623\\u062d\\u0645\\u062f\",\"email_verified_at\":null,\"password\":\"$2y$10$ccaUoIEciJW9TPdAt0qjwe96o7wiQsi6F2A6hXrRhhaxx\\/wwwT4o.\",\"plain_password\":\"123456\",\"image\":\"design\\/frontEnd\\/images\\/players_girl.png\",\"countries_id\":1,\"govarea_id\":25,\"city_id\":156,\"status\":1,\"cv_link\":null,\"roles_id\":4,\"type\":\"\\u0627\\u0646\\u062b\\u0649\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":null,\"created_at\":\"2019-04-10 09:01:21\",\"updated_at\":\"2019-04-10 09:03:59\"},\"joined\":{\"id\":12,\"name\":\"\\u0627\\u0644\\u0631\\u064a\\u0645\\u0648\\u0648\\u0646\\u062a\\u0627\\u062f\\u0627\",\"place_id\":4,\"user_id\":35,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/eventImages\\/img_1554887040.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":30000,\"from_datetime\":\"2019-04-09 17:00:00\",\"to_datetime\":\"2019-04-09 19:00:00\",\"agenda\":\"\\u0645\\u0628\\u0627\\u0631\\u0627\\u0647 \\u0627\\u0644\\u0639\\u0648\\u062f\\u0647 \\u0644\\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0627..\",\"status\":1,\"created_at\":\"2019-04-09 11:06:11\",\"updated_at\":\"2019-04-10 09:04:00\",\"event_admin\":{\"id\":35,\"name\":\"ahmed\",\"email\":\"ahmed@gmail.com\",\"username\":\"ahmedMa7fouz\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549988684.jpg\",\"countries_id\":1,\"govarea_id\":2,\"city_id\":2,\"status\":1,\"cv_link\":null,\"roles_id\":1,\"type\":\"\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":\"AMFTEUZeIpV5elbIShzedOIfZrkbbVpR6zuh0E6g7G0EK6ZbbmABLQe5x1RO\",\"created_at\":null,\"updated_at\":\"2019-02-12 03:24:44\"}},\"type\":\"event\"}', '2019-04-10 15:57:48', 1, '2019-04-10 15:53:09', '2019-04-11 06:38:00'),
('becf40db-9124-4a85-b36c-a78a2d9c01c9', 'App\\Notifications\\joinAccept', 'App\\User', 46, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null},\"joined\":null,\"type\":\"team\"}', '2019-03-20 20:17:31', 1, '2019-03-20 20:17:17', '2019-03-20 20:17:33'),
('bfaa0ca3-1d73-4dec-94b9-5364e0d8dae7', 'App\\Notifications\\joinAccept', 'App\\User', 46, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null},\"joined\":null,\"type\":\"team\"}', '2019-03-20 20:17:31', 1, '2019-03-20 20:17:05', '2019-03-26 19:23:09'),
('c7b14804-6049-4b60-bed9-902cfdfe443a', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":46,\"name\":\"\\u0627\\u062d\\u0645\\u062f \\u062e\\u0644\\u064a\\u0641\\u0629\",\"email\":\"mom@gmail.com\",\"username\":\"m\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549814083.jpg\",\"countries_id\":3,\"city\":\"\\u0627\\u0644\\u062c\\u064a\\u0632\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549814144.docx\",\"roles_id\":4,\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":null,\"remember_token\":null,\"created_at\":null,\"updated_at\":\"2019-02-23 18:18:26\"},\"joined\":{\"id\":1,\"name\":\"\\u0627\\u0644\\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0627\\u0648\\u0644\",\"description\":\"\\u0642\\u0641\\u0632 \\u0628\\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0647\\u064a \\u0625\\u062d\\u062f\\u0649 \\u0631\\u064a\\u0627\\u0636\\u0627\\u062a \\u0623\\u0644\\u0639\\u0627\\u0628 \\u0627\\u0644\\u0642\\u0648\\u0649 \\u0648\\u0647\\u0648 \\u0645\\u0634\\u062a\\u0642 \\u0645\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0628\\u0627\\u0632, \\u0648\\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0639\\u0628 \\u0645\\u0646 \\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u0642\\u0641\\u0632, \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0645\\u062a\\u0633\\u0627\\u0628\\u0642 \\u0628\\u0627\\u0646\\u062f\\u0641\\u0627\\u0639 \\u0633\\u0631\\u064a\\u0639 \\u062c\\u062f\\u0627\\u060c \\u0648\\u0647\\u0648 \\u064a\\u062d\\u0645\\u0644 \\u0641\\u064a \\u064a\\u062f\\u0647 \\u0632\\u0627\\u0646\\u0629 \\u0637\\u0648\\u064a\\u0644\\u0629, \\u0648\\u0639\\u0646\\u062f\\u0645\\u0627 \\u064a\\u0635\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0627\\u0631\\u064a \\u064a\\u063a\\u0631\\u0632 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0623\\u0631\\u0636 \\u0639\\u0644\\u0649 \\u0634\\u0643\\u0644 \\u0631\\u0643\\u064a\\u0632\\u0629\\u060c \\u0648\\u064a\\u062d\\u0648\\u0644 \\u0633\\u0631\\u0639\\u062a\\u0647 \\u0625\\u0644\\u0649 \\u0642\\u0648\\u0629 \\u0635\\u0639\\u0648\\u062f, \\u0628\\u0623\\u0646 \\u064a\\u0634\\u062f \\u0639\\u0636\\u0644\\u0627\\u062a\\u0647 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629\\u060c \\u0648\\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u064a\\u0637\\u0648\\u062d \\u0628\\u0633\\u0627\\u0642\\u064a\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0647\\u0648\\u0627\\u0621, \\u0644\\u0643\\u064a \\u064a\\u0631\\u062a\\u0641\\u0639 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u062d\\u0627\\u062c\\u0632,\\u0642\\u0641\\u0632 \\u0628\\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0647\\u064a \\u0625\\u062d\\u062f\\u0649 \\u0631\\u064a\\u0627\\u0636\\u0627\\u062a \\u0623\\u0644\\u0639\\u0627\\u0628 \\u0627\\u0644\\u0642\\u0648\\u0649 \\u0648\\u0647\\u0648 \\u0645\\u0634\\u062a\\u0642 \\u0645\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0628\\u0627\\u0632, \\u0648\\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0639\\u0628 \\u0645\\u0646 \\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u0642\\u0641\\u0632, \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0645\\u062a\\u0633\\u0627\\u0628\\u0642 \\u0628\\u0627\\u0646\\u062f\\u0641\\u0627\\u0639 \\u0633\\u0631\\u064a\\u0639 \\u062c\\u062f\\u0627\\u060c \\u0648\\u0647\\u0648 \\u064a\\u062d\\u0645\\u0644 \\u0641\\u064a \\u064a\\u062f\\u0647 \\u0632\\u0627\\u0646\\u0629 \\u0637\\u0648\\u064a\\u0644\\u0629, \\u0648\\u0639\\u0646\\u062f\\u0645\\u0627 \\u064a\\u0635\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0627\\u0631\\u064a \\u064a\\u063a\\u0631\\u0632 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0623\\u0631\\u0636 \\u0639\\u0644\\u0649 \\u0634\\u0643\\u0644 \\u0631\\u0643\\u064a\\u0632\\u0629\\u060c \\u0648\\u064a\\u062d\\u0648\\u0644 \\u0633\\u0631\\u0639\\u062a\\u0647 \\u0625\\u0644\\u0649 \\u0642\\u0648\\u0629 \\u0635\\u0639\\u0648\\u062f, \\u0628\\u0623\\u0646 \\u064a\\u0634\\u062f \\u0639\\u0636\\u0644\\u0627\\u062a\\u0647 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629\\u060c \\u0648\\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u064a\\u0637\\u0648\\u062d \\u0628\\u0633\\u0627\\u0642\\u064a\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0647\\u0648\\u0627\\u0621, \\u0644\\u0643\\u064a \\u064a\\u0631\\u062a\\u0641\\u0639 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u062d\\u0627\\u062c\\u0632,\",\"slogan\":\"uploads\\/images\\/teamSlogans\\/slogan_1550495369.jpg\",\"user_id\":35,\"sport_id\":1,\"admin_id\":45,\"status\":1,\"created_at\":\"2019-02-11 17:35:15\",\"updated_at\":\"2019-03-12 21:02:12\",\"team_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null}},\"type\":\"team\"}', '2019-03-20 19:03:44', 1, '2019-03-20 19:03:32', '2019-03-20 19:07:01'),
('c8868f6d-03c1-47dc-b0cb-0b39ad9d14ba', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":48,\"name\":\"\\u0639\\u0645\\u0631 \\u062c\\u0645\\u0627\\u0644\",\"email\":\"mm@01143271505.com\",\"username\":\"mmmmmmm\",\"email_verified_at\":null,\"password\":\"$2y$10$X74MZQt0wFizzteGfk0h3OIfAU1WnaDJnZDuXljgTDj7iLygyI68.\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1551172607.png\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":null,\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1553171858.jpg\",\"guarantor_name\":\"test\",\"guarantor_email\":\"x22@yahoo.com\",\"guarantor_phone\":\"12345678901\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"YswSZJb4UbozhiCEuRD8eeGyx7GN23zRaFGACsTh3rn4xjhzloCTxTxtuABC\",\"created_at\":\"2019-02-12 12:17:14\",\"updated_at\":\"2019-03-21 12:37:38\"},\"joined\":{\"id\":3,\"name\":\"\\u0627\\u0644\\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u062b\\u0627\\u0644\\u062b\",\"description\":\"\\u0642\\u0641\\u0632 \\u0628\\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0647\\u064a \\u0625\\u062d\\u062f\\u0649 \\u0631\\u064a\\u0627\\u0636\\u0627\\u062a \\u0623\\u0644\\u0639\\u0627\\u0628 \\u0627\\u0644\\u0642\\u0648\\u0649 \\u0648\\u0647\\u0648 \\u0645\\u0634\\u062a\\u0642 \\u0645\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0628\\u0627\\u0632, \\u0648\\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0639\\u0628 \\u0645\\u0646 \\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u0642\\u0641\\u0632, \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0645\\u062a\\u0633\\u0627\\u0628\\u0642 \\u0628\\u0627\\u0646\\u062f\\u0641\\u0627\\u0639 \\u0633\\u0631\\u064a\\u0639 \\u062c\\u062f\\u0627\\u060c \\u0648\\u0647\\u0648 \\u064a\\u062d\\u0645\\u0644 \\u0641\\u064a \\u064a\\u062f\\u0647 \\u0632\\u0627\\u0646\\u0629 \\u0637\\u0648\\u064a\\u0644\\u0629, \\u0648\\u0639\\u0646\\u062f\\u0645\\u0627 \\u064a\\u0635\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0627\\u0631\\u064a \\u064a\\u063a\\u0631\\u0632 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0623\\u0631\\u0636 \\u0639\\u0644\\u0649 \\u0634\\u0643\\u0644 \\u0631\\u0643\\u064a\\u0632\\u0629\\u060c \\u0648\\u064a\\u062d\\u0648\\u0644 \\u0633\\u0631\\u0639\\u062a\\u0647 \\u0625\\u0644\\u0649 \\u0642\\u0648\\u0629 \\u0635\\u0639\\u0648\\u062f, \\u0628\\u0623\\u0646 \\u064a\\u0634\\u062f \\u0639\\u0636\\u0644\\u0627\\u062a\\u0647 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629\\u060c \\u0648\\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u064a\\u0637\\u0648\\u062d \\u0628\\u0633\\u0627\\u0642\\u064a\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0647\\u0648\\u0627\\u0621, \\u0644\\u0643\\u064a \\u064a\\u0631\\u062a\\u0641\\u0639 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u062d\\u0627\\u062c\\u0632,\\u0642\\u0641\\u0632 \\u0628\\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0647\\u064a \\u0625\\u062d\\u062f\\u0649 \\u0631\\u064a\\u0627\\u0636\\u0627\\u062a \\u0623\\u0644\\u0639\\u0627\\u0628 \\u0627\\u0644\\u0642\\u0648\\u0649 \\u0648\\u0647\\u0648 \\u0645\\u0634\\u062a\\u0642 \\u0645\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0628\\u0627\\u0632, \\u0648\\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0639\\u0628 \\u0645\\u0646 \\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u0642\\u0641\\u0632, \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0645\\u062a\\u0633\\u0627\\u0628\\u0642 \\u0628\\u0627\\u0646\\u062f\\u0641\\u0627\\u0639 \\u0633\\u0631\\u064a\\u0639 \\u062c\\u062f\\u0627\\u060c \\u0648\\u0647\\u0648 \\u064a\\u062d\\u0645\\u0644 \\u0641\\u064a \\u064a\\u062f\\u0647 \\u0632\\u0627\\u0646\\u0629 \\u0637\\u0648\\u064a\\u0644\\u0629, \\u0648\\u0639\\u0646\\u062f\\u0645\\u0627 \\u064a\\u0635\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0627\\u0631\\u064a \\u064a\\u063a\\u0631\\u0632 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0623\\u0631\\u0636 \\u0639\\u0644\\u0649 \\u0634\\u0643\\u0644 \\u0631\\u0643\\u064a\\u0632\\u0629\\u060c \\u0648\\u064a\\u062d\\u0648\\u0644 \\u0633\\u0631\\u0639\\u062a\\u0647 \\u0625\\u0644\\u0649 \\u0642\\u0648\\u0629 \\u0635\\u0639\\u0648\\u062f, \\u0628\\u0623\\u0646 \\u064a\\u0634\\u062f \\u0639\\u0636\\u0644\\u0627\\u062a\\u0647 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629\\u060c \\u0648\\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u064a\\u0637\\u0648\\u062d \\u0628\\u0633\\u0627\\u0642\\u064a\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0647\\u0648\\u0627\\u0621, \\u0644\\u0643\\u064a \\u064a\\u0631\\u062a\\u0641\\u0639 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u062d\\u0627\\u062c\\u0632\",\"slogan\":\"uploads\\/images\\/teamSlogans\\/slogan_1552837309.jpg\",\"user_id\":35,\"sport_id\":1,\"admin_id\":45,\"status\":1,\"created_at\":\"2019-03-17 15:41:49\",\"updated_at\":\"2019-03-17 15:44:17\",\"team_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"jH0CLcT1uHYPyo6AuayL0C8hHOIe8I6v4dF6ZhDwhgHSlu7x4gfJclFH9a7a\",\"created_at\":null,\"updated_at\":null}},\"type\":\"team\"}', '2019-04-03 23:12:22', 0, '2019-03-21 18:42:03', '2019-04-03 23:12:22'),
('cf79785a-0eb7-4362-91da-b5a56d426293', 'App\\Notifications\\upgradeProfile', 'App\\User', 35, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"govarea_id\":1,\"city_id\":2,\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":4,\"type\":\"\",\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"upgrade\":0,\"remember_token\":\"YjKjygaUeW8dCH8AZuuHu5Qs4ams9fhwX7Wg2lEYsjcElOp7vWkY6I1SctPB\",\"created_at\":null,\"updated_at\":null}}', '2019-04-11 19:13:57', 1, '2019-04-11 19:11:46', '2019-04-11 19:13:57'),
('d3f2be4c-edd6-49c4-95c8-5b1c13a8a970', 'App\\Notifications\\joinAccept', 'App\\User', 46, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null},\"joined\":{\"id\":3,\"name\":\"\\u0627\\u0644\\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u062b\\u0627\\u0644\\u062b\",\"description\":\"\\u0642\\u0641\\u0632 \\u0628\\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0647\\u064a \\u0625\\u062d\\u062f\\u0649 \\u0631\\u064a\\u0627\\u0636\\u0627\\u062a \\u0623\\u0644\\u0639\\u0627\\u0628 \\u0627\\u0644\\u0642\\u0648\\u0649 \\u0648\\u0647\\u0648 \\u0645\\u0634\\u062a\\u0642 \\u0645\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0628\\u0627\\u0632, \\u0648\\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0639\\u0628 \\u0645\\u0646 \\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u0642\\u0641\\u0632, \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0645\\u062a\\u0633\\u0627\\u0628\\u0642 \\u0628\\u0627\\u0646\\u062f\\u0641\\u0627\\u0639 \\u0633\\u0631\\u064a\\u0639 \\u062c\\u062f\\u0627\\u060c \\u0648\\u0647\\u0648 \\u064a\\u062d\\u0645\\u0644 \\u0641\\u064a \\u064a\\u062f\\u0647 \\u0632\\u0627\\u0646\\u0629 \\u0637\\u0648\\u064a\\u0644\\u0629, \\u0648\\u0639\\u0646\\u062f\\u0645\\u0627 \\u064a\\u0635\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0627\\u0631\\u064a \\u064a\\u063a\\u0631\\u0632 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0623\\u0631\\u0636 \\u0639\\u0644\\u0649 \\u0634\\u0643\\u0644 \\u0631\\u0643\\u064a\\u0632\\u0629\\u060c \\u0648\\u064a\\u062d\\u0648\\u0644 \\u0633\\u0631\\u0639\\u062a\\u0647 \\u0625\\u0644\\u0649 \\u0642\\u0648\\u0629 \\u0635\\u0639\\u0648\\u062f, \\u0628\\u0623\\u0646 \\u064a\\u0634\\u062f \\u0639\\u0636\\u0644\\u0627\\u062a\\u0647 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629\\u060c \\u0648\\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u064a\\u0637\\u0648\\u062d \\u0628\\u0633\\u0627\\u0642\\u064a\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0647\\u0648\\u0627\\u0621, \\u0644\\u0643\\u064a \\u064a\\u0631\\u062a\\u0641\\u0639 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u062d\\u0627\\u062c\\u0632,\\u0642\\u0641\\u0632 \\u0628\\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0647\\u064a \\u0625\\u062d\\u062f\\u0649 \\u0631\\u064a\\u0627\\u0636\\u0627\\u062a \\u0623\\u0644\\u0639\\u0627\\u0628 \\u0627\\u0644\\u0642\\u0648\\u0649 \\u0648\\u0647\\u0648 \\u0645\\u0634\\u062a\\u0642 \\u0645\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0628\\u0627\\u0632, \\u0648\\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0639\\u0628 \\u0645\\u0646 \\u0631\\u064a\\u0627\\u0636\\u0629 \\u0627\\u0644\\u0642\\u0641\\u0632, \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0645\\u062a\\u0633\\u0627\\u0628\\u0642 \\u0628\\u0627\\u0646\\u062f\\u0641\\u0627\\u0639 \\u0633\\u0631\\u064a\\u0639 \\u062c\\u062f\\u0627\\u060c \\u0648\\u0647\\u0648 \\u064a\\u062d\\u0645\\u0644 \\u0641\\u064a \\u064a\\u062f\\u0647 \\u0632\\u0627\\u0646\\u0629 \\u0637\\u0648\\u064a\\u0644\\u0629, \\u0648\\u0639\\u0646\\u062f\\u0645\\u0627 \\u064a\\u0635\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0635\\u0627\\u0631\\u064a \\u064a\\u063a\\u0631\\u0632 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0623\\u0631\\u0636 \\u0639\\u0644\\u0649 \\u0634\\u0643\\u0644 \\u0631\\u0643\\u064a\\u0632\\u0629\\u060c \\u0648\\u064a\\u062d\\u0648\\u0644 \\u0633\\u0631\\u0639\\u062a\\u0647 \\u0625\\u0644\\u0649 \\u0642\\u0648\\u0629 \\u0635\\u0639\\u0648\\u062f, \\u0628\\u0623\\u0646 \\u064a\\u0634\\u062f \\u0639\\u0636\\u0644\\u0627\\u062a\\u0647 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u0632\\u0627\\u0646\\u0629\\u060c \\u0648\\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u064a\\u0637\\u0648\\u062d \\u0628\\u0633\\u0627\\u0642\\u064a\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0647\\u0648\\u0627\\u0621, \\u0644\\u0643\\u064a \\u064a\\u0631\\u062a\\u0641\\u0639 \\u0641\\u0648\\u0642 \\u0627\\u0644\\u062d\\u0627\\u062c\\u0632\",\"slogan\":\"uploads\\/images\\/teamSlogans\\/slogan_1552837309.jpg\",\"user_id\":35,\"sport_id\":1,\"admin_id\":45,\"status\":1,\"created_at\":\"2019-03-17 23:41:49\",\"updated_at\":\"2019-03-17 23:44:17\"},\"type\":\"team\"}', '2019-03-20 20:20:08', 1, '2019-03-20 20:20:01', '2019-03-20 20:20:11'),
('d6174e25-fa7e-4aad-a061-6f06a5ff2409', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":46,\"name\":\"\\u0627\\u062d\\u0645\\u062f \\u062e\\u0644\\u064a\\u0641\\u0629\",\"email\":\"mom@gmail.com\",\"username\":\"m\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549814083.jpg\",\"countries_id\":3,\"city\":\"\\u0627\\u0644\\u062c\\u064a\\u0632\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549814144.docx\",\"roles_id\":4,\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":null,\"remember_token\":null,\"created_at\":null,\"updated_at\":\"2019-02-23 18:18:26\"},\"joined\":{\"id\":7,\"name\":\"\\u062a\\u062f\\u0639\\u064a\\u0645 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\\u0629\",\"place_id\":3,\"user_id\":45,\"team_id\":1,\"group_id\":null,\"image\":\"uploads\\/images\\/groupImages\\/img_1549977256.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":10,\"from_datetime\":\"2019-03-18 00:00:00\",\"to_datetime\":\"2019-03-21 00:00:00\",\"agenda\":\"\",\"status\":1,\"created_at\":null,\"updated_at\":null,\"event_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null}},\"type\":\"event\"}', '2019-03-20 17:47:39', 1, '2019-03-20 17:47:26', '2019-03-20 17:55:04'),
('d7c1c657-5489-43bf-b6c8-71c74fcfde64', 'App\\Notifications\\upgradeProfile', 'App\\User', 35, '{\"user\":{\"id\":65,\"name\":\"\\u0623\\u0645\\u064a\\u0646\\u0629 \\u0623\\u062d\\u0645\\u062f \\u062d\\u0627\\u0645\\u062f\",\"email\":\"eng.aminaahmed@yahoo.com\",\"username\":\"\\u0623\\u0645\\u064a\\u0646\\u0629 \\u0623\\u062d\\u0645\\u062f\",\"email_verified_at\":null,\"password\":\"$2y$10$3n\\/TcekqF0XCp0gzgAEeG.FcEw5eiIAIybuuh6IaEhItSlfoAZFY2\",\"plain_password\":\"123456\",\"image\":\"design\\/frontEnd\\/images\\/players_girl.png\",\"countries_id\":1,\"govarea_id\":25,\"city_id\":156,\"status\":1,\"cv_link\":null,\"roles_id\":4,\"type\":\"\\u0627\\u0646\\u062b\\u0649\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":null,\"created_at\":\"2019-04-10 09:01:21\",\"updated_at\":\"2019-04-11 00:43:30\"}}', '2019-04-11 15:47:32', 1, '2019-04-11 06:44:54', '2019-04-11 15:47:32'),
('d921b5cc-babc-46b0-a5ec-da910e34e3e5', 'App\\Notifications\\joinRequest', 'App\\User', 35, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"govarea_id\":1,\"city_id\":2,\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"type\":\"\",\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"upgrade\":0,\"remember_token\":\"YjKjygaUeW8dCH8AZuuHu5Qs4ams9fhwX7Wg2lEYsjcElOp7vWkY6I1SctPB\",\"created_at\":null,\"updated_at\":null},\"joined\":{\"id\":10,\"name\":\"\\u0627\\u0644\\u0645\\u0644\\u0639\\u0628 \\u0627\\u0644\\u062e\\u0645\\u0627\\u0633\\u064a\",\"place_id\":8,\"user_id\":35,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/eventImages\\/img_1554886520.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":102,\"from_datetime\":\"2019-04-09 13:48:00\",\"to_datetime\":\"2019-04-09 14:00:00\",\"agenda\":\"\\u0645\\u0628\\u0627\\u0631\\u0627\\u0647 \\u0648\\u062f\\u064a\\u0647 \\u0628\\u064a\\u0646 \\u0641\\u0631\\u062b\\u0642\\u0649 .......\",\"status\":1,\"created_at\":\"2019-04-09 10:51:03\",\"updated_at\":\"2019-04-10 08:55:20\",\"event_admin\":{\"id\":35,\"name\":\"ahmed\",\"email\":\"ahmed@gmail.com\",\"username\":\"ahmedMa7fouz\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549988684.jpg\",\"countries_id\":1,\"govarea_id\":2,\"city_id\":2,\"status\":1,\"cv_link\":null,\"roles_id\":1,\"type\":\"\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":\"tL4od9ZQoLLTNO72JOMh8BbYCjdBbwmRF4n5izVHJ4QQybjoLJcerd1JJPAb\",\"created_at\":null,\"updated_at\":\"2019-02-12 03:24:44\"}},\"type\":\"event\"}', '2019-04-11 19:08:23', 1, '2019-04-11 19:08:09', '2019-04-11 19:08:27'),
('ee8a8ca7-8db1-4e7d-8679-9ab954147ed1', 'App\\Notifications\\joinAccept', 'App\\User', 46, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null},\"joined\":null,\"type\":\"team\"}', '2019-03-20 20:19:02', 1, '2019-03-20 20:17:46', '2019-03-20 20:19:10'),
('fbedf122-a15d-4f49-adc0-7719098842ec', 'App\\Notifications\\joinRequest', 'App\\User', 45, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null},\"joined\":{\"id\":7,\"name\":\"\\u062a\\u062f\\u0639\\u064a\\u0645 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\\u0629\",\"place_id\":3,\"user_id\":45,\"team_id\":1,\"group_id\":null,\"image\":\"uploads\\/images\\/groupImages\\/img_1549977256.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":10,\"from_datetime\":\"2019-03-18 00:00:00\",\"to_datetime\":\"2019-03-21 00:00:00\",\"agenda\":\"\",\"status\":1,\"created_at\":null,\"updated_at\":null,\"event_admin\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"remember_token\":\"AASUa49Fxl251zQHhlHu3R3HqBuSfQcBioX3QiwYFmUG22zIN9GoA0b8c4kn\",\"created_at\":null,\"updated_at\":null}},\"type\":\"event\"}', '2019-04-03 23:12:22', 0, '2019-03-21 16:44:08', '2019-04-03 23:12:22'),
('fd5e1501-54e2-44d7-866e-20c70d86c704', 'App\\Notifications\\joinRequest', 'App\\User', 35, '{\"user\":{\"id\":45,\"name\":\"\\u0645\\u062d\\u0645\\u062f \\u0645\\u062d\\u0641\\u0648\\u0638\",\"email\":\"ma7fozm@gmail.com\",\"username\":\"Maa7fozm\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549804922.jpg\",\"countries_id\":1,\"govarea_id\":1,\"city_id\":2,\"status\":1,\"cv_link\":\"uploads\\/files\\/userCVs\\/cv_1549818142.docx\",\"roles_id\":5,\"type\":\"\",\"personal_proof\":\"uploads\\/images\\/personalProofs\\/img_1549822343.png\",\"guarantor_name\":\"\\u0637\\u0627\\u064a\\u0639 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0631\\u0649\",\"guarantor_email\":\"3@gmail.com\",\"guarantor_phone\":\"01102679911\",\"verify_token\":null,\"frist_log\":null,\"upgrade\":0,\"remember_token\":\"YjKjygaUeW8dCH8AZuuHu5Qs4ams9fhwX7Wg2lEYsjcElOp7vWkY6I1SctPB\",\"created_at\":null,\"updated_at\":null},\"joined\":{\"id\":11,\"name\":\"Al Seddiq\",\"place_id\":4,\"user_id\":35,\"team_id\":null,\"group_id\":null,\"image\":\"uploads\\/images\\/eventImages\\/img_1554887095.jpg\",\"public\":1,\"event_type\":\"\\u0644\\u0627 \\u0644\\u0644\\u0641\\u0631\\u0627\\u063a\",\"num_of_attendees\":90,\"from_datetime\":\"2019-04-09 14:00:00\",\"to_datetime\":\"2019-04-09 15:00:00\",\"agenda\":\"\\u0645\\u0628\\u0627\\u0631\\u0627\\u0647 \\u0648\\u062f\\u064a\\u0647 \\u062a\\u062d\\u062f\\u062b....\",\"status\":1,\"created_at\":\"2019-04-09 11:00:56\",\"updated_at\":\"2019-04-10 09:04:55\",\"event_admin\":{\"id\":35,\"name\":\"ahmed\",\"email\":\"ahmed@gmail.com\",\"username\":\"ahmedMa7fouz\",\"email_verified_at\":null,\"password\":\"$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu\",\"plain_password\":\"123456\",\"image\":\"uploads\\/images\\/profileImages\\/img_1549988684.jpg\",\"countries_id\":1,\"govarea_id\":2,\"city_id\":2,\"status\":1,\"cv_link\":null,\"roles_id\":1,\"type\":\"\",\"personal_proof\":null,\"guarantor_name\":null,\"guarantor_email\":null,\"guarantor_phone\":null,\"verify_token\":null,\"frist_log\":0,\"upgrade\":0,\"remember_token\":\"sngxlvetK1CDSe68hmaXTuOwAZtBAarmxpapXdEjieBdflvmcAplVLbYZFTv\",\"created_at\":null,\"updated_at\":\"2019-02-12 03:24:44\"}},\"type\":\"event\"}', '2019-04-11 15:56:32', 1, '2019-04-11 15:55:36', '2019-04-11 15:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'superadmin id who create place',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `address`, `user_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(7, 'ملعب جامعة الأميره نوره', 'طريق المطار', 35, 'uploads/images/placesImages/img_1554303495.jpg', 1, '2019-04-03 20:58:15', '2019-04-03 20:58:15'),
(9, 'جامعة الملك سعود - بنات', 'العنوان: طريق الأمير تركي بن عبدالعزيز الأول، جامعة الملك سعود، الرياض 12371 الهاتف: 011 805 0000', 69, 'uploads/images/placesImages/img_1555091506.jpg', 1, '2019-04-12 23:51:46', '2019-04-12 23:51:46'),
(10, 'ملعب الجامعة العربية المفتوحة بنات الرياض', 'العنوان: الامير فيصل بن عبدالله بن عبدالرحمن, حطين، الرياض 13517 الهاتف: 011 274 2277 المؤسسة الأم: الجامعة العربية المفتوحة', 69, 'uploads/images/placesImages/img_1555091582.jpg', 1, '2019-04-12 23:53:02', '2019-04-12 23:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'سوبر ادمن', NULL, NULL),
(2, 'المشجعات والمشجعين', NULL, NULL),
(3, 'سيدات ورجال الأعمال', NULL, NULL),
(4, 'المنتميات والمنتميين رياضيا', NULL, NULL),
(5, 'منتمى ادمن', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sponsers`
--

CREATE TABLE `sponsers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'superadmin id who create sponnser',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsers`
--

INSERT INTO `sponsers` (`id`, `name`, `user_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum1', 35, 'uploads/images/sponsorsImages/img_1553172970.jpg', 1, '2019-03-21 18:56:10', '2019-03-21 18:56:10'),
(2, 'Lorem Ipsum12', 35, 'uploads/images/sponsorsImages/img_1553172992.jpg', 1, '2019-03-21 18:56:32', '2019-03-21 18:56:32'),
(3, 'Lorem Ipsum166', 35, 'uploads/images/sponsorsImages/img_1553173011.jpg', 1, '2019-03-21 18:56:51', '2019-03-21 18:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'superadmin id who create sport',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('فرديه','جماعيه') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'sport type individual or onteam',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `name`, `user_id`, `description`, `type`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'كرة القدم', 35, 'تعد رياضة كرة القدم من أكثر الرياضات شعبيةً في العالم، إذ إنّه يوجد أكثر من 250 مليون لاعباً يلعبونها  في أكثر من مائتي دولة حول العالم. وهي رياضة جماعية تُلعب بين فريقين يلعبون في ملعب مستطيل الشكل مع مرميين في جانبيه و يتكون كل منهما من أحد عشر لاعباً بكرة مُكوَّرة.والهدف الأساسي منها هو إحراز الأهداف داخل المرمى، وتحقيق الفوز لأحد الفريقين علماً أنه تمّ وضع قوانينها عام 1863م في إنجلترا  و من المدهش ان لعبت النساء كرة القدم منذ سنة 1895، وهو تاريخ أول مباراة كرة قدم مسجلة للنساء في شمال لندن.', 'جماعيه', 'uploads/images/sportImages/img_1554219962.png', 1, NULL, '2019-04-02 21:46:02'),
(2, 'التنس', 35, 'كرة المضرب (أو التنس الأرضي في الترجمات الحرفية) نوع من رياضات الراح والتي يتبارى فيها لاعبان في مباريات الفردي، أو فريقان مكونان من لاعبين في مباريات الزوجي. كلٌ يحمل مضربا ليستخدمه في ضرب كرة فوق الشبكة لمنطقة الخصم. وعدد الضربات ليس محددا، إنما النتيجة تحدد الرابح.\r\nتنس السيدات هي واحدة من أشهر الرياضات النسائية،ومن الرياضات القليلة التي تطغو النساء فيها أكثر من الرجال، وتنظمها رابطة محترفات التنس\r\nبطولة أستراليا المفتوحة للتنس هي إحدى بطولات الجراند سلام الأربعة الكبرى. وتُقام البطولة سنوياً في آخر أسبوعين من شهر يناير في مدينة ملبورن في أستراليا. إنطلقت البطولة سنة 1905، وأقيمت في ستة مدن مختلفة إلى أن استقرت البطولة في ملبورن سنة 1972.', 'فرديه', 'uploads/images/sportImages/img_1554220022.png', 1, NULL, '2019-04-02 21:47:02'),
(6, 'رياضة السباحة', 35, 'السباحة هي أحد أنواع الرياضة المائية، وهي عبارة عن نشاط يمارسه أشخاصٌ ذوي خبرة وتدريب لغايات التسلية والترفيه أو للمشاركة في السباقات العالمية والأولمبية. السباحة هي وصف لشكل حركة الإنسان أو الكائن الحي بشكلٍ عام في الماء دون أن يثبت قدميه أو جسمه على قاع المسطّح المائي، وهي ترك أعضاء الجسم وتحريكها داخل الماء ضمن أسلوبٍ مُعيّن.\r\nرانيا علواني هي أول سباحة مصرية وعربية وإفريقية تحصل على ميداليتين ذهبيتين في السباحة و بدأت مشوارها الرياضي في سن الست سنوات كان أول انتصار لرانيا في البطولة الإفريقية للسباحة\r\nلسباحة بصورة عامة مفيدة للصغار والكبار، وفيها نوع من المرح، وهي مفيدة لشد عضلات البطن وتفريغ الشحنات النفسية السلبية والشعور بالراحة والانتعاش.\r\nلسباحة بصورة عامة مفيدة للصغار والكبار، وفيها نوع من المرح، وهي مفيدة لشد عضلات البطن وتفريغ الشحنات النفسية السلبية والشعور بالراحة والانتعاش.\r\nلسباحة بصورة عامة مفيدة للصغار والكبار، وفيها نوع من المرح، وهي مفيدة لشد عضلات البطن وتفريغ الشحنات النفسية السلبية والشعور بالراحة والانتعاش.\r\nلسباحة بصورة عامة مفيدة للصغار والكبار، وفيها نوع من المرح، وهي مفيدة لشد عضلات البطن وتفريغ الشحنات النفسية السلبية والشعور بالراحة والانتعاش.', 'فرديه', 'uploads/images/sportImages/img_1554220042.png', 1, '2019-03-12 16:08:31', '2019-04-02 21:47:22'),
(7, 'رياضة الكاراتيه', 35, 'الكاراتيه هي عبارة عن كلمة يابانية مركبة ( كارا ) وتعني قتال ( تيه ) وتعني اليد الخالية أي المجردة من السلاح . أي القتال باليد الخالية . وهو أسلوب حسن التصرف للدفاع عن النفس معتمداً على اللياقة البدنية والقوى الجسمانية والعقلية دون استعمال للأسلحة التقليدية الفتاكة . ومن أبرز صفات ممارس الكاراتيه مرونة وقوة العضلات والتوافق العضلي العصبي وسرعة الاستجابة ، ولا يقف هذا الفن على الحركات الجسمانية بما فيها من عنف وهدوء ، إنما يتعداها إلى الفكر فينميه ويطوره ، وإلى النفس فيربي فيها الثقة والجرأة ، كما يدعم الشجاعة والتحكم في الإحساس والشعور لدى الأفراد .\r\n\r\nومن ميزات فن الكاراتيه أنه ليس مقصوراً على فئة عمرية معينة بل إنه يناسب جميع الأعمار ، ويستطيع أن يمارسه الصغار والكبار . وفن الكاراتيه الحديث يعد فناً للدفاع عن النفس ، وممارس هذا الفن لا يستخدم أي نوع من الأسلحة بل يستخدم يده وقدمه العاريتين عن طريق الضرب باليد ، والركل بالقدم ، ولاعب الكاراتيه الذي اكتسب فيه خبرة طويلة يستطيع أن يدافع عن نفسه ضد عدة أشخاص إذاً الكاراتيه الحقيقة هي بذل الجهد داخلياً لتدريب العقل على تطوير الوعي الصافي الذي يمكّّن الفرد من مواجهة العالم بشكل واقعي، وفي نفس الوقت تطوير القوة العضلية خارجياً. أما التواضع فهو أمر ذو أهمية جوهرية، بل يقال بأن الإنسان المغرور ليس أنساناًً مؤهلاً لتعلّم الكاراتيه. وعلى الطالب أن يكون مستعداً لتقبل النقد من الآخرين ومستعداً كذلك للاعتراف فوراً بأنه تنقصه المعرفة ، بدلاً من التظاهر بأنه يعرف ما لا يعرفه الآخرون.\r\n\r\nفوائد تعلم الكاراتيه:\r\nبقدر ما تعتبر الكاراتيه نظاماً للدفاع عن النفس فهي أيضاً تعمل على تنمية الذات وتطوير العقل والبدن وتحتوي على العديد من الفوائد التي تساعد الفرد في اتخاذ قراره في ممارسة لعبة الكاراتيه وهي كالتالي :\r\n\r\nأهميتها للبالغين :\r\n• التنسيق بين القدرات البدنية والعقلية ( التنفس، حركة الجسم ، الوقفة )\r\n• تحسين القدرة البدنية ، المرونة ، التحمل ، التوازن ، التناسق .\r\n• تقليل التوتر وزيادة الطاقة .\r\n• السيطرة على الجسم .\r\n• تطوير ذهن قوي وذكي يكون هادئاً ومرناً في مواجهة الضغوط .\r\n• تنمية الوعي والحساسية تجاه الآخرين .\r\n• تنمية القوة الداخلية والعزم والانضباط من أجل تحقيق أهداف الشخص في الحياة .\r\n• أنها لا ترتبط بعمر معين فجميع الفئات العمرية تستطيع أن تزاول لعبة الكاراتية بدءً من سن الخامسة مادام أن الشخص قادر على ذلك .\r\n\r\nقامت جده جدة تستضيف بطولة الكاراتيه للسيدات في نوفمبر 2019 برعاية الهيئة العامة الرياضة، وتحت إشراف اتحاد الكاراتيه، واتحاد الرياضات المجتمعية.. يقيم مركز الأبطال الأسطورة الرياضي بطولة الكاراتيه للسيدات بطاقم سعودي نسائي على كفاءة عالية من الاحترافية في تنظيم البطولات الرياضية وتحكيم من حاكمات سعوديات معتمدات من الاتحاد السعودي للكاراتيه، وفي مقدمتهم الكابتن رابية الخضر ود. ندى المشاط\r\nبعض الفتيات يرغبن في تعلم بعض الألعاب القتالية، وهنا تكون الكاراتيه الخيار الأنسب لهن، فهي تعمل على تقوية الجسم، كذلك إكسابه اللياقة البدنية العالية، بالإضافة إلى تمكين الفتاة من الدفاع عن نفسها في حال تعرضها لسوء، وتزيد ثقتها بنفسها، مما يجعلها قادرة على مواجهة المواقف الصعبة دون خوف أو خجل، كما ثبت أن حركات الكاراتيه تعمل على تعزيز القدرات العقلية لدى الفتيات وتحسن المستوى الدراسي.\r\nبعض الفتيات يرغبن في تعلم بعض الألعاب القتالية، وهنا تكون الكاراتيه الخيار الأنسب لهن، فهي تعمل على تقوية الجسم، كذلك إكسابه اللياقة البدنية العالية، بالإضافة إلى تمكين الفتاة من الدفاع عن نفسها في حال تعرضها لسوء، وتزيد ثقتها بنفسها، مما يجعلها قادرة على مواجهة المواقف الصعبة دون خوف أو خجل، كما ثبت أن حركات الكاراتيه تعمل على تعزيز القدرات العقلية لدى الفتيات وتحسن المستوى الدراسي.\r\nبعض الفتيات يرغبن في تعلم بعض الألعاب القتالية، وهنا تكون الكاراتيه الخيار الأنسب لهن، فهي تعمل على تقوية الجسم، كذلك إكسابه اللياقة البدنية العالية، بالإضافة إلى تمكين الفتاة من الدفاع عن نفسها في حال تعرضها لسوء، وتزيد ثقتها بنفسها، مما يجعلها قادرة على مواجهة المواقف الصعبة دون خوف أو خجل، كما ثبت أن حركات الكاراتيه تعمل على تعزيز القدرات العقلية لدى الفتيات وتحسن المستوى الدراسي.', 'فرديه', 'uploads/images/sportImages/img_1554220072.png', 1, '2019-03-12 16:11:34', '2019-04-02 21:47:52'),
(8, 'بلياردو', 35, 'البلياردو  هي مجموعة متنوعة من الألعاب تلعب بالعصا لضرب كرات وتحريكها على طاولة يتخللها بعضها الثقوب. من الصعب جداً تحديد مخترع لعبة البلياردو فتاريخ اللعبة معقّد للغاية.بدأت من جديد، مع تدشين بطولة البلياردو للفتيات التي انطلقت منافساتها عام 2019   لتكون باكورة النشاط النسائي الذي يقوم به الاتحاد بعد انضمام آلاء الفن إلى مجلس الإدارة الجديد لتكون رئيسة لجنة النشاط النسائي. وتعد البطولة هي الأولى من نوعها على مستوى البحرين، إذ يشارك بها 10 فتيات بحرينيات تم تقسيمهن على مجموعتين', 'فرديه', 'uploads/images/sportImages/img_1554220108.png', 1, '2019-03-12 16:17:21', '2019-04-02 21:48:28'),
(11, 'الكرة الطائرة', 35, 'الكرة الطائرة  هي إحدى أكثر الرياضات العالمية شعبية. يلعب فيها فريقان تفصل بينهما شبكة عالية. على الفريق ضرب الكرة فوق الشبكة لمنطقة الخصم. لكل فريق ثلاث محاولات لضرب الكرة فوق الشبكة. تحسب نقطة للفريق حينما تضرب الكرة أرضية الخصم، أو إذا تم ارتكاب خطأ، أو إذا أخفق الفريق في صد الكرة وإرجاعها بشكل صحيح. اذهب إلى التنقلاذهب إلى البحث\r\nأقيمت بطولة العالم لكرة الطائرة للسيدات 1962 في نسختها الرابعة في موسكو في الاتحاد السوفييتي في الفترة من 13 أكتوبر وإلى 25 أكتوبر 1962.', 'جماعيه', 'uploads/images/sportImages/img_1554220149.png', 1, '2019-03-12 16:32:45', '2019-04-02 21:49:09'),
(13, 'كره السلة', 35, 'إنّ لعبة السلة هي إحدى الألعاب التي نشأت في أواخر القرن التاسع عشر وفي التحديد في عام 1891م في سبرينغفيلد. هي رياضة جماعية و شعبية حيث يتنافس فيها فريقان يتألف كل منهما من خمسة لاعبين يحاول كلاهما إدخال الكرة في سلة الخصم و إحراز الأهداف وكسب النقاط. لعبة كرة السلة للسيدات هي واحدة من الرياضات النسائية القليلة التي توسعت بجانب نظيرها من الرياضات الرجالية. حيث أصبحت رائجة فتمتد من الساحل الشرقي للولايات المتحدة إلى الساحل الغربي في جزء كبير بواسطة كليات الفتيات. أُستخدِم مصطلح \"كرة السلة للسيدات\" أيضاً في عام 1895-1970.\r\nيتم إحراز النقاط من خلال إدخال الكرة داخل السلة الموجودة على ارتفاع 3أمتار؛ حيث يفوز الفريق الذي يتمكن من إحراز عدد من النقاط أكبر من تلك التي يحرزها منافسه في نهاية المباراة وهكذا فمن الصعب وقوع نتيجة التعادل بين الفريقين. ويمكن للاعب التقدم بالكرة إلى الأمام عن طريق تنطيطها على أرض الملعب فيما يُعرف باسم (المراوغة) أو تمريرها لزملائه للوصول إلى الهدف. ولا يُسمح بأي احتكاك بدني يعرقل أي لاعب من الفريقين (خطأ) وهناك قيود مفروضة على كيفية التعامل مع الكرة تُعرف باسم (مخالفات قواعد اللعب).\r\n\r\nعند ارتكاب اللاعب لـخمس مخالفات يطرد مباشرة من المباراة ويعوضه لاعب آخر من نفس الفريق.\r\n\r\nوبمرور الوقت، تطورت لعبة كرة السلة لتشتمل على طرق لعب فنية شائعة تتعلق بتصويب الكرة وتمريرها والمراوغة بها، إلى جانب مراكز اللاعبين والخطط الدفاعية والهجومية.فعادة ما يلعب أطول لاعبي الفريق في مركز الوسط أو في أحد مركزي الهجوم، أما اللاعبون الأقصر طولاً أو الذين يتميزون بالسرعة ويمتلكون أفضل مهارات في الإمساك بالكرة والتحكم بها فيلعبون في مراكز الدفاع. وعلى الرغم من الاهتمام البالغ بقواعد وقوانين لعبة كرة السلة عند ممارستها في المسابقات والمنافسات، فقد ظهرت الكثير من الألعاب المشتقة من لعبة كرة السلة والتي تتم ممارستها بشكل غير رسمي.', 'جماعيه', 'uploads/images/sportImages/img_1554220189.png', 1, '2019-03-12 16:38:04', '2019-04-02 21:49:49'),
(18, 'تنس طاولة', 35, 'كرة الطاولة أو تنس الطاولة  هي رياضة يتبارى فيها لاعبان أو أربعة بضرب كرة خفيفة تناوباً باستخدام مضرب لعب صغير. تُقام المباراة على طاولة صلدة تقسّمها شبكة لنصفين. رياضة تنس الطاولة إحدى أكثر الرياضات شعبية من حيث عدد اللاعبين، وهي من أحدث الرياضات الكبرى الحالية. تضرب كرة التنس عند الإرسال بوجه أو ظهر اليد إلى منطقة الخصم، وتُحتسب النتيجة النهائية بناءً على عدد النقاط التي حصل عليها اللاعبين في المسابقة، حيث يفوز من يحقق 11 نقطة أولاً وعند وصول كلا اللاعبين نقطة 10/10 يجب على اللاعب الفوز بنقطتين متتاليتين. تتطلب الرياضة تركيزاً عالياً وسرعة رد الفعل ولياقة بدنية عالية لكونها رياضة سريعة.\r\nبطولة العالم لتنس الطاولة أطلقت سنة 1926 وأصبحت تعقد كل عامين منذ عام 1957. ويتم منح خمسة ألقاب، زوجي الرجال وفردي، فردي السيدات والزوجي، والزوجي المختلط. انفصلت بطولة العالم لفرق الرجال والسيدات لأول مرة عام 2000، وتعقد كل سنة زوجية. ويوجد أيضا منافسات فِرق التي تدور أكثر في نفس الوقت من المنافسة الفردية منذ عام 1999.\r\nفي بدايات المسابقة ساد فريق الرجال المجري فائزا باثنى عشرة بطولة، بداية من ستينات القرن العشرين ظهرت الصين كقوة جديدة مهيمنة في هذه المسابقة واستمرت تفرض قوتها في اللعبة إلى اليوم. أحرز فريق الرجال 18 لقبا. في خمسينات القرن العشرين كان فريق السيدات الياباني من القوة الظاهرة التي مكنته من الفوز بثمانية ألقاب. بدأ فريق السيدات الصيني يحكم قبضته القوية على بطولة الفرق مع بداية السبعينات وما تلاها. حاز فريق السيدات الصينى على 18 لقب. فاز فريق السيدات السنغافوري ببطولة العالم للفرق عام 2010', 'فرديه', 'uploads/images/sportImages/img_1554220217.png', 1, '2019-04-02 17:36:41', '2019-04-02 21:50:17'),
(19, 'الدراجة النارية', 35, 'سباق الدراجات النارية هي رياضة حديثة و خطرة لها ممارسوها و شعبيتها  بين مختلف الاعمار. و قد كانت فرنسا السباقة في هذا المضمار. سباق الجائزة الكبرى للدراجات النارية هو البطولة الرائدة لسباق الدراجات النارية على الطريق وينقسم حاليا إلى ثلاثة فئات وهي موتو جي بي وموتو 2 وموتو 3 وجميع الفئات الثلاث تستخدم محرك رباعي الأشواط.تعتبر رياضة الموتو جي بي من أشهر الرياضات الميكانيكية في العالم, وقد اكتسبت عدد متابعين كبير في السنين الأخيرة. تتكون بطولة الموتو جي بي من 17 سباق تجري في مختلف أنحاء العالم ويتم توزيع النقاط على المتسابقين حسب مراكزهم, حتى انتهاء الموسم وعندها يفوز السائق الذي يملك في جعبته نقاط أكثر. تتنافس الموتو جي بي في مجال رياضتها مع عدة بطولات أخرى مثل السوبر بايك والموتو كروس والسوبر موتو والكثير', 'فرديه', 'uploads/images/sportImages/img_1554220239.png', 1, '2019-04-02 17:42:27', '2019-04-02 21:50:39'),
(20, 'الدراجة الهوائية', 35, 'سباق الدراجات هو مجموعة من الأنواع الرياضية التي تستعمل فيها الدراجات الهوائية للتنافس الرياضي. تدخل في إطار سباق الدراجات التصنيفات التالية:\r\n•	سباق الدراجات على الطريق\r\n•	سباق الدراجات على المضمار\r\n•	سباق الدراجات الجبلية (mountain-bike)\r\n•	سباق دراجات الاختراق (بي إم إكس) (BMX)\r\nالهيئة الدولية الوصية على هذه الأصناف وتنظيم مسابقاتها الدولية، هي الاتحاد الدولي للدراجات، الكائن مقره في سويسرا.\r\nاعتمدت اللجنة التنظيمية للدراجات الهوائية بدول مجلس التعاون لدول الخليج العربية إقامة أول بطولة خليجية نسائية في الدراجات الهوائية خلال نوفمبر/ 2015', 'فرديه', 'uploads/images/sportImages/img_1554220274.png', 1, '2019-04-02 17:43:51', '2019-04-02 21:51:14'),
(21, 'الغوص', 35, 'تعتبر رياضة الغوص من أهم انواع الرياضات في العالم نظرا الى اهميتها في جميع مجالات الحياه فهي ليست مجرد رياضة بل انها رحلة استكشاف للعالم البحري، فالغوص منتشر في جميع انحاء و دول العالم بلا استثناء نظرا لتلك الفائدة المرجوة منها فهي من الرياضات التي ساعدت على اكتشاف عالم البحار، فهي لم تعد رياضة وحسب بل انها اصبحت من الامور التي يجب ان تتوافر في اجهزة الدولة خصوصا تلك التي تعتمد على عمليات البحث و الانقاذ، لذلك رياضة الغوص هي الرياضة التي لا يمكن الاستغناء عنها بأي شكل من الاشكال. كانت سارة البغدادي مدربة سعودية للفتيات الراغبات في تعلم وممارسة رياضة الغوص منذ عام 1991، بعدما قادتها رغبتها إلى الغوص في أعماق البحر عام 1989 واحترفت هذه الرياضة عام 1990، لتحصل على المركز الثاني في السباحة تحت الماء في بطولة الرياضات البحرية التي أقيمت في شرم الشيخ في مصر.', 'فرديه', 'uploads/images/sportImages/img_1554220309.png', 1, '2019-04-02 18:02:40', '2019-04-02 21:51:49'),
(22, 'الفروسية', 35, 'تعتبر رياضة الفروسية من الرياضات الهامة والمحترمة حيث تعلم الفارس قوة الشخصية والحزم والاحترام عن عمر بن الخطاب رضي الله عنه قال (علموا أولادكم الرماية والسباحة وركوب الخيل).\r\nيتعلم لاعبو الأولمبياد الخاص الذين يتسابقون في رياضة الفروسية كيفية ركوب الخيل و تطوير المهارات الرياضية، و اكتساب الثقة بالنفس فيما يتعلق بتوجيه الحصان و السيطرة عليه. و من خلال رياضة الفروسية يستطيع اللاعبون التسابق في مجموعة من المسابقات تشمل أساليب الركوب الإنجليزي و الغربي، و التتابع، و الفرق، و القفز \"جائزة كابريلي\".\r\nكما هو الحال في جميع رياضات الأولمبياد الخاص، يتم تقسيم اللاعبين في مجموعات وفقا لمستويات القدرة، و السن و الجنس.\r\nشهدت السعودية عام 2017  انطلاق أول بطولة نسائية للفروسية في تاريخ المملكة التي قصرت لعقود طويلة المشاركة في هذه الرياضة التي تضرب بعيدًا في جذور المملكة الصحراوية على الرجال.', 'فرديه', 'uploads/images/sportImages/img_1554220342.png', 1, '2019-04-02 18:12:07', '2019-04-02 21:52:22'),
(23, 'الملاكمة', 35, 'هي رياضة يهاجم فيها اثنان من الرياضيين ذوي الوزن المماثل بعضهما البعض بقبضاتهم في سلسلة فترات تتراوح من 1 إلى 3 دقائق تسمى \"الجولات\". في كل من الانقسامات الأوليمبية والمحترفة، المقاتلون (الذين يدعون الملاكمين أو المقاتلين) يتفادون لكمات خصومهم بينما يحاولون تحقيق لكمات بأنفسهم. النقاط ممنوحة للضربات الصلبة النظيفة في المنطقة القانونية على جبهة جسم الخصم فوق الخصر، والضربات إلى الرأس والجذع يعتبران أثمن. إن الملاكم الحاصل على أكثر النقاط بعد العدد المحدد من الجولات يعلن فائزاً. النصر يمكن أن ينجز أيضاً إذا سقط الخصم وأصبح غير قادر على النهوض قبل أن يحسب الحكم إلى عشرة (وتسمى الضربة القاضية، أو KO) أو إذا الخصم كان مصاباً جداً ولا يمكنه أن يستمر (وتسمى الضربة القاضية التقنية، أو TKO).\r\nتأسست رابطة الملاكمة الدولية النسائية (WIBA) المعنية بالملاكمات السيدات المحترفات في يوليو 2000، وسرعان ما نمت لتصبح قوة رئيسية في عالم الرياضة نظمت رابطة الملاكمة الدولية النسائية بطولات في آسيا وأوروبا وأمريكا الجنوبية ومنطقة البحر الكاريبي ، بالإضافة إلى الولايات المتحدة الأمريكية. تعتبر رابطة الملاكمة الدولية النسائية متوازنة جغرافياً جداً، ولديها أبطال وبطولات في العديد من أنحاء العالم، كما تُتيح الفرص لإقامة البطولات في جميع أنحاء العالم، مما يفتح المجال لانتشار رياضة الملاكمة في جميع أنحاء العالم.', 'فرديه', 'uploads/images/sportImages/img_1554220420.png', 1, '2019-04-02 18:13:02', '2019-04-02 21:53:40'),
(24, 'الجمباز', 35, 'الجمباز: رياضة يؤدي فيها كل متنافِس تمارين بهلوانية على أنواع مختلفة من معدات الجمباز . ويتبارى فيها فريقان أو أكثر في منافسة في صالة للألعاب الرياضية. وهناك منافسات منفصلة لكل من فرق الرجال والنساء.[1] يراقب الحكّام أداء اللاعب، ويقررون عدد النقاط التي يحصل عليها. وتؤدي رياضة الجمباز إلى تنمية التوازن والتحمل والمرونة والقوة. وتصل معظم لاعبات الجمباز إلى أعلى المستويات في هذه الرياضة خلال الأعمار من 13 إلى 19 سنة، أما بالنسبة للرجال فيبلغ متوسط عمر أبطال الجمباز 21 سنة.', 'فرديه', 'uploads/images/sportImages/img_1554221801.png', 1, '2019-04-02 18:14:05', '2019-04-02 22:16:41'),
(25, 'المبارزة', 35, 'المبارزة ، هي الرياضة التي يكون اثنين يقاتلون باستخدام السيوف \"السيف العربي أو سيف الشيش أو سيف المبارزة\". يتم إجراء نقاط الفوز من خلال اتصال السيف مع الخصم. كانت المبارزة واحدة من الرياضات الأولى التي ستقام في دورة الألعاب الاولمبية. واستناداً إلى المهارات التقليدية من المبارزة، نشأت الرياضة الحديثة في نهاية القرن التاسع عشر\r\nاقيمت بطولة السعودية الأولى للمبارزة للسيدات تحت 13 و15 و20 عاماً، في أولى بطولات الموسم المحلي للسيدات، في الأسلحة الثلاثة (الشيش والسيف والمبارزة) بمشاركة 30 لاعبة،\r\nوتعد البطولة أول بطولة نسائية للمبارزة في المملكة وتم اعتمادها من اللجنة الأولمبية السعودية وإدراجها ضمن برنامج الموسم الداخلي وبدعم مباشر من الهيئة العامة للرياضة.‎', 'فرديه', 'uploads/images/sportImages/img_1554222723.png', 1, '2019-04-02 18:18:42', '2019-04-02 22:32:03'),
(26, 'الرماية', 35, 'الرماية هي رياضة تعنى بالتصويب إلى هدف وتشمل سبع أنواع مختلفة وهي: البندقية, رماية الأطباق, اسكيت, اسفل الخط, المسدس الحر, والرماية سريعة الطلقات، ويتم فيها جميعاً استخدام أسلحة وذخائر مختلفة. انطلق نادي الرماية للسيدات خلال شهر سبتمبر 2018، الذي يعتبر الأول في المملكة، وسيضم طاقم عمل نسائيا لدعم المرأة في المجال الرياضي.', 'فرديه', 'uploads/images/sportImages/img_1554222760.png', 1, '2019-04-02 18:20:51', '2019-04-02 22:32:40'),
(27, 'المشى', 35, 'تتميز رياضة المشي بإمكانية ممارستها من جانب جميع الأعمار، لأنها سهلة وبسيطة، ويُمكن أن تُمارس في أي مكان، كالشارع أو الحدائق أو على شاطئ البحر، وفي أيّ وقت من اليوم، في الصباح أو المساء.النوع الأول يُسمى بمشي القوة (أو مشي السرعة) و النوع الآخر هو مشي السباقات ، و الأثنان يزيد فيهما طول الخطوة عن المشي الطبيعي لكنهما يختلفان في أن مشي السباقات رياضة أوليمبية لها بعض القواعد التى يجب الالتزام بها ، فمثلاً ينبغي على المتسابق ألا يرفع أصابع قدميه المتأخرة عن الأرض قبل أن يضع كعب قدمه المتقدمة أولاً و هكذا.', 'فرديه', 'uploads/images/sportImages/img_1554242518.png', 1, '2019-04-02 18:21:44', '2019-04-03 04:01:58'),
(28, 'الشطرنج', 35, 'رقعة استراتيجية يلعبها لاعبان على رقعة الشطرنج. وهي رقعة مطعمة ومربعة الشكل مكونة من 64 مربعا، يلعب الشطرنج ملايين الأشخاص في العالم سواء المحترفين أو الهواة ويشكل لاعبو الشطرنج أحد أكبر الفئات الاجتماعية في العالم وتبلغ حوالي 605 مليون شخص بالغ يلعبون لعبة الشطرنج بانتظام. \r\nويبدأ كل لاعب المباراة بـمجموعة قطع عددها 16 قطعة: ملك واحد، ملكة واحدة، قلعتان، حصانان، فيلان وثمانية بيادق حيث تختلف حركة كل قطعة من هذه القطع الستة، وتعتبر الملكة أقوى القطع والبيدق أضعفها، والهدف في هذه اللعبة هو إماتة ملك الخصم بوضعه تحت تهديد بالأسر لا يمكن الفرار منه ولهذه الغاية تستخدم قطع الشطرنج لمهاجمة وأسر قطع الخصم وفي نفس الوقت للدفاع عن بعضها البعض، ويمكن كذلك بلوغ الإماتة بالاستسلام الطوعي للخصم والذي يظهر بعد أن يفقد الكثير من العتاد أو تظهر استحالة تجنب الإماتة، كما يمكن أن تنتهي المباراة بالتعادل بعدة طرق مختلفة.\r\nأقيمت بطولة العالم للشطرنج للسيدات لتحديد بطل العالم للسيدات في لعبة الشطرنج. مثل بطولة العالم للشطرنج، ويدار من قبل الهيئة الدولية المديرة للشطرنج FIDE. وخلافا لمعظم الرياضات، تكون المرأة قادرة على منافسة الرجال في لعبة الشطرنج، وحتى أن بعض النساء لا تتنافسن للفوز بلقب المرأة. والجدير بالذكر أن تصنيف أعلى لاعبة في العالم للسنوات الـ 20 الماضية، (وإلى حد بعيد على أعلى تصنيف FIDE لامرأة في تاريخ الشطرنج)، لم تنافس أبدا للفوز بلقب المرأة.', 'فرديه', 'uploads/images/sportImages/img_1554222824.png', 1, '2019-04-02 18:28:07', '2019-04-02 22:33:44'),
(29, 'الجودو', 35, 'الجودو رياضة يستخدم فيها اللاعب التوازن والفاعلية والتوقيت لتثبيت أو رمي الخصم. تطور الجودو من أسلوب ياباني قديم للقتال الأعزل يسمى جوجوتسو. وتعتبر رياضة الجودو من الألعاب الرئيسية في أوروبا، واليابان، والولايات المتحدة. تُدرس هذه الرياضة في الكليات والمدارس والنوادي. يحتل تدريب الجودو مكانًا بارزاً في صالة الألعاب التي تسمى دوجـو، حيـث تغـطى الأرض ببساط. ويلــبس المتبارون زيًا مكونًا من قطعتين يسمى جودوجي، ويتكون من سترة قطنية وسروال وحزام ملون. وهم يشتركون في المباراة حفاة. تقنيات الجودو. يمكن أن تقسم إلى ثلاث مجموعات: 1- ناجيوازا وهي فنون الرمي 2- كاتاميوازا أي فنون أحكام الشد والمسك 3- أتيميوازا وهي فنون الضرب والهجوم.', 'فرديه', 'uploads/images/sportImages/img_1554242496.png', 1, '2019-04-02 18:30:56', '2019-04-03 04:01:36'),
(30, 'الجوجوتسو', 35, 'الجوجوتسو  بالمعنى الحرفي «فن الليونة» أو «الطريق للخضوع»، هو الاسم الذي يطلق على مجموعة من أنماط الفنون القتالية اليابانية، بما فيها القتال الأعزل أو المسلح.] تطور الجوجوتسو بين الساموراي في اليابان الإقطاعية كطريقة لهزيمة خصم مسلح دون استخدام أسلحة. نظرا لعدم فعالية ضرب الخصم المدرع فقد كان أكثر الأساليب فعالية لهزيمة العدو هو عمليات لي المفاصل والرمي. تم تطوير هذه التقنيات حول مبدأ استخدام طاقة المهاجم ضده بدلا من معارضته.\r\nهناك العديد من الاختلافات في الجوجوتسو، الأمر الذي يؤدي إلى تنوع المناهج.\r\nيمارس الجوجوتسو اليوم على حد سواء كما كان منذ مئات السنين، كما يوجد أيضا أشكال معدلة لممارسة الرياضة. كما تم اشتقاق نموذج رياضي دخل الألعاب الأولمبية هو الجودو، والذي تم تطويره من عدد من الأنماط التقليدية على يد كانو جيغورو في أواخر القرن التاسع عشر.\r\nاحتضنت مدينة جدة أول بطولة نسائية للجوجيتسو في نوفمبر عام 2018.', 'فرديه', 'uploads/images/sportImages/img_1554242718.png', 1, '2019-04-02 18:31:42', '2019-04-03 04:05:18'),
(32, 'التزلج', 35, 'تعتبر رياضة التزلج من أكثر الأنشطة شعبية على مستوى العالم، حيث يقصد البعض الدول السياحية التي تتوافر بها تلك الرياضة، للاستمتاع بالجليد، وبالرغم من أنه نشاط ترفيهي إلا أن بعض الدراسات الحديثة أثبتت فوائده العديدة للجسم، وفيما يلي تستعرض عليكم \"البوابة لايت\" 5 فوائد للتزلج:-\r\n‎1- ضبط توازن الجسم\r\n‎يساعد التزلج على الحفاظ وضبط توازن الجسم وذلك تفاديًا للإنزلاق على الثلج، ومع مرور الوقت، يعتاد الجسم على تلك الوضعية ويصبح مشدودًا دومًا للإبقاء على توازنه.\r\n‎2- تقوية العظام\r\n‎أثناء التزلج تتحمل الركبتان وزن الجسم وضغطه على الثلج، ما يزيد من قوتها وقدرتهما على التحمل كلما ازدادت وتيرة ممارسة التزلج، كما تصبح العظام أقوى بفعل الوزن المفروض على الساقين.\r\n‎3- الحفاظ على صحة القلب والشرايين\r\n‎تعتبر رياضة التزلج نوعًا من أنواع الأيروبيك، وتساعدنا بالتالي على حرق الوحدات الحرارية وخسارة الوزن، مما يصب في مصلحة القلب والشرايين وحسن من أدائهم الوظيفي.\r\n‎4- تعزيز إنتاج فيتامين D\r\n‎لا شك في أن التزلج تحت أشعة الشمس يمنح البشرة لونًا جميلًا، وينسينا ضغوط الحياة، لكن الأهم من ذلك مساهمته في إنتاج الفيتامين D نظرًا لتعرض البشرة بشكل مباشر لأشعة الشمس.\r\n‎5- شدّ عضلات الجسم\r\n‎تتطلب رياضة التزلج وقفة معينة وثباتًا محددًا لعدم الوقوع على المنحدرات، ولبلوغ ذلك الثبات والتوازن، يعمد الشخص بصورة تلقائية إلى شدّ عضلاته الداخلية، ولا سيما عضلات البطن وتلك الموجودة في منطقة الحوض.', 'فرديه', 'uploads/images/sportImages/img_1554242374.png', 1, '2019-04-02 18:45:19', '2019-04-03 03:59:34'),
(33, 'الهايكنج', 35, 'مشي الجبلي (الهايكنج) رياضة ممتعة، وتتطلب لياقة بدنية جيدة. كما أن لها الكثير من الأبعاد التاريخية والتراثية والاجتماعية، وهي رياضة مليئة بالتأمل، تأمل يستوحي من البيئة والطبيعة ومن غرابة المكان، وظروف الطريق، وتحدي الصعود، وبعضاً من المغامرة؛ لذا فإن التأمل فيها أعمق، والمشاعر التي تنتاب الإنسان فيها مشاعر جديدة تتأثر بالمكان وظروفه؛ مما يجعلها رياضة فريدة وتبقى ذكرياتها زمناً طويلاً، وهي رياضة تجعل الإنسان محباً للطبيعة، وصديقاً للبيئة، فمن أسس ممارستها عدم رمي النفايات، أو الإضرار بالبيئة، وشعارها في ذلك “لا تترك أثراً”.\r\nفوائد رياضة الإجبال ( هايكنج ).\r\nزيادة اللياقة البدنية\r\nتحرق ساعة واحدة من الإجبال أكثر من 500 سعرة حرارية، وهذا يعتمد على كمية المتاع الذي تحمله ووضعية جسدك أثناء السير. يؤثر التنزه على القدمين تأثير لطيف على المفاصل مقارنة بالمشي على الإسفلت وما شابهه، فهو أفضل لكاحلك وركبتك من الركض. وإذا أجبلت في منطقة تلال فستخسر وزنك بشكل ملحوظ. عموماً ثبت أن الإجبال في المرتفعات بشكل عام يخفف الوزن بجانب حرقه للسعرات الحرارية.\r\nرياضة تحافظ على مظهرك الجميل\r\nتجعل الاستمرارية على المشي جسدك بأفضل هيئة، ولكن انتبه عند سيرك في المنحدرات، واستخدم العصي التي تساعد على التقدم في السير. تسلق الصخور يغنيك عن كل التمارين الأخرى، فمن نظرة وظيفية، ستحرك كامل جسدك، خصوصاً الجزء السفلي- أي عضلة الورك وأوتار الركبة. وإذا كنت تحمل متاعك، فبذلك تتحدى قوتك ومدى تحمل الجزء العلوي من جسدك، وهذا يُسهم في تحسين مظهرك.\r\nالوقاية من السكري ومراقبته\r\nالاستمرار على الإجبال يساعدك على مراقبة مستوى السكر في الدم أو حتى تجنبه، وذلك بخفض مستويات السكر في دمك. عند إجبالك فأنت بلا شك تمرن عضلاتك، حيث ينتقل الجلوكوز من مجرى الدم ليمدك بالطاقة.\r\nخفض ضغط الدم ومستوى الكولسترول\r\nيقلل الإجبال بشكل منتظم ضغط الدم والكولسترول، وذلك من شأنه أن يقلل من مخاطر الإصابة بأمراض القلب والسكري والسكتة الدماغية لأولئك الأكثر عرضةً لها. في الحقيقة، يؤثر الإجبال في المنحدرات بشكل هائل في القضاء على السكري وتحسين تحمل الجلوكوز.\r\nيعد الإجبال أحد طرق الشفاء الفعالة\r\nعرضت بعض البحوث منافع الإجبال على صحة الإنسان الجسدية مثل الجهاز القلبي الوعائي وأنها أبعد من ذلك، وربما تساعد مرضى السرطان على التماثل للشفاء. نشرت دراسة في الصحيفة الدولية للطب الرياضي أن الإجبال لساعات طويلة قد يحسن من كفاءة الأنتيوكسيداتيفي، والذي يساعد على محاربة المرض في الدم لمرضى الأورام. كذلك أظهرت دراسة أخرى أن مكافحي السرطان المنتظمين في الإجبال أو ما شابهه، يعتقدون أن النشاطات الجسدية ماهي إلا مكملة لشفائهم من السرطان.\r\nتكوين علاقات اجتماعية\r\nينصح محبو الإجبال دائما بوجود الرفقة. تساعدك رحلات الإجبال الطويلة المخطط لها مسبقاً أو حتى القصيرة نهاية الأسبوع على تكوين صداقات أثناء ممارستها. بالإضافة لذلك، يشجعك تفاعلك مع المُجبلين على الانخراط في التمارين كأسلوب حياة، أكثر من كونها رياضة حيث ستركز عليها تركيزا دائما لفترة طويلة.\r\nالإجبال يحفز الإبداع\r\nعرضت دراسة أن قضاء الوقت في الخارج يزيد من اتساع آفاق المرء ومهارات حل المشكلات بنسبة 50٪. ووضح كاتب الدراسة أن قضاء الوقت بعيداً عن التقنية له تأثير كبير. كذلك وجد باحثو كلية التربية للدراسات العليا في جامعة ستانفورد أن الإجبال يضاعف مقدرة الإنسان على الإبداع في محيطه.\r\nالحد من الاكتئاب ومنح سعادة أكثر\r\nأظهرت دراسة أن الإجبال كعلاج إضافي يساهم في علاج الاكتئاب الحاد ويخفف من شعور المرضى باليأس والكمد والانتحار. في النهاية سحر الطبيعة يلهم في الخفاء كل من يعاني من تلك الأعراض بحياة أكثر مرونة وسلاسة.\r\nالانسجام مع الطبيعة\r\nعندما نكون في الطبيعة بعيداً عن فوضى حياتنا اليومية والتقنية أيضاً، فذلك يسمح لنا بالتواصل مع أنفسنا ومع الطبيعة تواصلًا مليئًا بالسلام والسعادة والاطمئنان.', 'فرديه', 'uploads/images/sportImages/img_1554242345.png', 1, '2019-04-02 18:49:04', '2019-04-03 03:59:05'),
(34, 'الجرى', 35, 'رياضة الجري تعدّ رياضة الجري إحدى أنواع الرّياضات السهلة والّتي يستطيع أي شخص أن يقوم بها، فيمكن ممارستها بأيّ وقت دون الحاجة إلى الانتساب إلى أحد النّوادي الرياضيّة، أو شراء أجهزة رياضيّة من أجل ممارسة الجري؛ بل بإمكانك ممارستها من خلال قضاء حوائجك، أو القيام بزيارة شخص ما دون استخدام مركبة، أو أن تخصّص وقتاً معيّنا لها، وتعتبر الهرولة هي المصطلح الّذي يطلق على رياضة الجري، وهو المتعارف عند أغلب النّاس في مجتمعنا. فوائد رياضة الجري للجسم يمكن القول إنّ رياضة الجري مهمّة كثيراً، ولها آثار تنعكس إيجاباً على جسم الإنسان، والتخلّص من بعض الأمراض، وإليك عزيزي القارئ الفوائد الّتي تحقّقها رياضة الجري على جسم الإنسان: تعتبر رياضة الجري علاجاً لمن يعانون من مشاكل في التنفّس؛ حيث إنّها تعمل على مساعدة الرّئة على أداء عملها بالشّكل الطّبيعي والسّليم. تعتبر رياضة الجري حلّاً مناسباً للوقاية والتخلّص من السّمنة الّتي تزعج الكثير في مجتمعنا والوقاية منها أيضاً؛ حيث تعمل على التخلّص من الدّهون الموجودة في الجسم، إضافةً إلى المساعدة في إزالة الترهّلات الّتي تعطي منظراً غير لائقاً للجسم. تنعكس فوائد رياضة الجري على القلب أيضاً؛ حيث إنّ سلامة القلب تكون بسلامة وانتظام دقّاته، وبالفعل هذا ما تمنحه رياضة الجري؛ حيث تعمل على تنظيم دقّات القلب وهو أمر مهم لجسم الإنسان. تعتبر رياضة الجري كغيرها من الرياضات الّتي تعمل على مقاومة الأمراض، والعمل على رفع مناعة الجسم لمقاومة الأمراض بشكلٍ عام، وهذا ما يجعل من الجسم قويّاً وصحيّاً. فوائد أخرى لرياضة الجري رياضة الجري تعطي للإنسان الحيويّة والنّشاط وتقلّل من الكسل. تساعد الإنسان في التخلّص من التوتّر والقلق. تجعل الجسم يتناول كميّات كبيرة من الماء. تعطي للشّخص مظهراً لائقاً، وتمنحه لياقةً بدنيّة جيّدة.', 'فرديه', 'uploads/images/sportImages/img_1554242313.png', 1, '2019-04-02 18:57:40', '2019-04-03 03:58:33'),
(35, 'البلوت', 35, 'البلوت (بالإنجليزية: Baloot)، هي طريقة لعب بأوراق اللعب، وتشتهر في المجتمعات الخليجية، مثل المجتمع السعودي.\r\n\r\nأوراق البلوت\r\nمعلومات اللعبة\r\nاللاعبون\r\n4 لاعبين\r\nوقت الإعداد\r\n1 دقيقة\r\nوقت اللعب\r\n25-30 دقيقة\r\nفرصة الفوز\r\nمتوسطة\r\nالمهارات المطلوبة\r\nالذكاء والفهم\r\nعدد الورق\r\n32', 'جماعيه', 'uploads/images/sportImages/img_1554242292.png', 1, '2019-04-02 18:58:42', '2019-04-03 03:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `sport_user`
--

CREATE TABLE `sport_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `sport_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `type` enum('فرديه','جماعيه','','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sport_user`
--

INSERT INTO `sport_user` (`id`, `sport_id`, `user_id`, `status`, `type`, `created_at`, `updated_at`) VALUES
(185, 23, 100, 1, 'فرديه', '2019-04-17 16:43:58', '2019-04-17 16:43:58'),
(186, 11, 100, 1, 'جماعيه', '2019-04-17 16:43:58', '2019-04-17 16:43:58'),
(187, 13, 100, 1, 'جماعيه', '2019-04-17 16:43:58', '2019-04-17 16:43:58'),
(188, 35, 100, 1, 'جماعيه', '2019-04-17 16:43:58', '2019-04-17 16:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'superadmin id who create team',
  `sport_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL COMMENT 'admin of group must have role 5',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`, `slogan`, `user_id`, `sport_id`, `admin_id`, `status`, `created_at`, `updated_at`) VALUES
(6, 'فريق البلوت', 'وصف الفريق', NULL, 35, 35, 74, 1, NULL, NULL),
(7, 'برشلونة', 'فريق اسبانى', 'uploads/images/teamSlogans/slogan_1555521989.png', 35, 1, 74, 1, '2019-04-17 15:26:29', '2019-04-17 15:26:29'),
(8, 'ريال مدريد', 'فريق جامد جدااا', 'uploads/images/teamSlogans/slogan_1555522017.png', 35, 1, 74, 1, '2019-04-17 15:26:57', '2019-04-17 15:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_user`
--

INSERT INTO `team_user` (`id`, `team_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(65, 6, 100, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plain_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countries_id` int(10) UNSIGNED NOT NULL,
  `govarea_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `cv_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frist_log` tinyint(4) DEFAULT NULL,
  `upgrade` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `plain_password`, `image`, `countries_id`, `govarea_id`, `city_id`, `status`, `cv_link`, `roles_id`, `type`, `personal_proof`, `guarantor_name`, `guarantor_email`, `guarantor_phone`, `verify_token`, `frist_log`, `upgrade`, `remember_token`, `created_at`, `updated_at`) VALUES
(35, 'ahmed', 'ahmed@gmail.com', 'ahmedMa7fouz', NULL, '$2y$10$vq8lvQ2y4EsYueVSg.7Hc.lV9CWfDSsDQ21xxWYj4Ob8dOWtbhRYu', '123456', 'uploads/images/profileImages/img_1549988684.jpg', 1, 2, 2, 1, NULL, 1, '', NULL, NULL, NULL, NULL, NULL, 0, 0, '7j7DNaWXG72jGZlZSUyeLD9yLXGdcxNDWcRUCGnaOVb5uwxYYygl83n753sE', NULL, '2019-02-12 10:24:44'),
(61, 'yasmin', 'yasminyahia57@gmail.vom', 'yasmin', NULL, '$2y$10$d2iO8f8uBqSnzIzgYyj.oOJq.WIiQ38ziU.LbaidNwZv3yIeEV/HG', 'yassino98', 'uploads/images/profileImages/img_1554888222.jpg', 1, 2, 180, 1, NULL, 2, '', NULL, NULL, NULL, NULL, '04wDzZipzsyKl4QAp9ztkCQH9msmN3CpzK5CJamf', 1, 0, NULL, '2019-03-28 17:08:51', '2019-04-10 15:23:42'),
(64, 'ahmed ali', 'badr@disbox.net', 'ahmed ali', NULL, '$2y$10$1CXpvYjCPngG414N1t51B.ufjwJx7lj644EyXCgSHiB9yZK8cL2Oi', '123456', 'uploads/images/profileImages/img_1554888196.jpg', 5, 1, 1, 1, NULL, 2, 'ذكر', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-04-09 14:19:23', '2019-04-10 16:04:22'),
(65, 'أمينة أحمد حامد', 'eng.aminaahmed@yahoo.com', 'أمينة أحمد', NULL, '$2y$10$3n/TcekqF0XCp0gzgAEeG.FcEw5eiIAIybuuh6IaEhItSlfoAZFY2', '123456', 'uploads/images/profileImages/img_1555521759.jpg', 1, 25, 156, 1, NULL, 4, 'انثى', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, '2019-04-10 15:01:21', '2019-04-17 15:22:39'),
(67, 'احمد محمد', 'aminaahmed48@gmail.com', 'احمد محمد', NULL, '$2y$10$ta0JWl5Lyusomo0XpuuAi.Y2Gv1wy8g3fPCeD3s8RO77cJ.yW/vn6', '123456', 'design/frontEnd/images/bussnis man.png', 1, 2, 196, 1, NULL, 3, 'ذكر', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-04-10 21:26:00', '2019-04-10 21:26:52'),
(69, 'محسن', 'mbka888@gmail.com', 'الاستاذ محسن', NULL, '$2y$10$cm0doolL24baEIGP8PJhHuZ9pVEDUpgWE/geTuCZ7FCwwKjBlSwtq', '123456', 'uploads/images/profileImages/img_1555074975.jpg', 5, 14, 8, 1, NULL, 1, 'ذكر', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, '2019-04-10 21:58:03', '2019-04-12 19:16:15'),
(70, 'Shatha Mohammed', 'pumpkinsang9@gmail.com', 'Shampkin', NULL, '$2y$10$x/0Bdx0qlGmaner8p4MKceF7Ox3Xk7n.o8.kTH0/AEdXocy9as6uK', '123456', 'design/frontEnd/images/fans girl.png', 5, 14, 8, 1, NULL, 2, 'انثى', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-04-10 22:35:40', '2019-04-10 22:36:56'),
(71, 'Kareman Atta', 'Ookkaa01@gmail.com', 'Kare', NULL, '$2y$10$YplWEdsouuZiqhyWAxAEn.qoNos1RBG7.nvOK6bWkzgkAKFJ4nyIO', '123456', 'design/frontEnd/images/fans girl.png', 5, 14, 8, 1, NULL, 2, 'انثى', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-04-10 22:48:19', '2019-04-10 22:49:14'),
(72, 't', 'test@test.com', 'hasnaa', NULL, '$2y$10$9Gf5GJpH1eenc9ClOw8b/OuZekhGJNmTiX2pildlSzYWAKTzn7gIa', '123456789', 'uploads/images/profileImages/img_1555521770.png', 1, 22, 315, 0, NULL, 2, 'ذكر', NULL, NULL, NULL, NULL, 'lWGewxGydGvUB4trm5VlWnW40LmvtHlNU5CKKUlj', 1, 0, NULL, '2019-04-11 17:04:39', '2019-04-17 15:22:50'),
(74, 'منتمي تست', 'mohsin_017@hotmail.com', 'منتمي ادمن', NULL, '$2y$10$xYPLUJeniuSqOR7Rs9e29eD5EY.D/MYzd82Bg//1W8Po0hoLHWRpe', '123456', 'design/frontEnd/images/players.png', 5, 1, 1, 1, NULL, 5, 'ذكر', 'uploads/images/personalProofs/img_1555076342.jpg', 'moh', 'mbka888@gmail.com', '12345678910', NULL, 0, 1, NULL, '2019-04-12 19:30:12', '2019-04-12 20:20:05'),
(75, 'حسام سمير محمد', 'hossamsamir04@gmail.com', 'r6125e378y6jbjfndb', NULL, '$2y$10$3ZrOEegKhKrMc3A9zGxyB.NT5D4jI5oV14gCyEltyOhbwNntpq.aG', '123456', 'design/frontEnd/images/fans man.png', 1, 2, 228, 1, NULL, 2, 'ذكر', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-04-12 20:15:04', '2019-04-12 20:30:34'),
(76, 'Mohammad Issa', 'mohsin_0257@hotmail.com', 'mohammad.issa', NULL, '$2y$10$CpGV1WEnQw9oHcaEPS/g1eQMb7iHT8sXRJg7kA7/6HOQuNGhcL6Ri', '123456', 'design/frontEnd/images/fans man.png', 5, 14, 23, 1, NULL, 1, 'ذكر', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-04-12 20:38:18', '2019-04-13 00:17:49'),
(100, ',kugvuyjfc', 'ma7fozm@gmail.com', 'lihilug', NULL, '$2y$10$q7r84QWBNRlZGribAKkxiOqwMu8gWdJAvQ0NVPZLdwpaE1nzBLjrS', '12345678', 'design/frontEnd/images/fans girl.png', 1, 2, 180, 1, NULL, 2, 'ذكر', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-04-17 10:45:35', '2019-04-17 16:43:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_category_id_foreign` (`category_id`),
  ADD KEY `articles_team_id_foreign` (`team_id`),
  ADD KEY `articles_group_id_foreign` (`group_id`),
  ADD KEY `articles_user_id_foreign` (`user_id`),
  ADD KEY `articles_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `articles_comments`
--
ALTER TABLE `articles_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_comments_article_id_foreign` (`article_id`),
  ADD KEY `articles_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`govarea_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_place_id_foreign` (`place_id`),
  ADD KEY `events_user_id_foreign` (`user_id`),
  ADD KEY `events_team_id_foreign` (`team_id`),
  ADD KEY `events_group_id_foreign` (`group_id`);

--
-- Indexes for table `event_albums`
--
ALTER TABLE `event_albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_albums_event_id_foreign` (`event_id`);

--
-- Indexes for table `event_album_media`
--
ALTER TABLE `event_album_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_album_media_event_album_id_foreign` (`event_album_id`),
  ADD KEY `event_album_media_media_id_foreign` (`media_id`);

--
-- Indexes for table `event_comments`
--
ALTER TABLE `event_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_comments_event_id_foreign` (`event_id`),
  ADD KEY `event_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `event_sponsers`
--
ALTER TABLE `event_sponsers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_sponsers_event_id_foreign` (`event_id`),
  ADD KEY `event_sponsers_sponser_id_foreign` (`sponser_id`);

--
-- Indexes for table `event_users`
--
ALTER TABLE `event_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_users_event_id_foreign` (`event_id`),
  ADD KEY `event_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `govareas`
--
ALTER TABLE `govareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_user_id_foreign` (`user_id`),
  ADD KEY `groups_admin_id_foreign` (`admin_id`),
  ADD KEY `groups_sport_id_foreign` (`sport_id`),
  ADD KEY `groups_team_id_foreign` (`team_id`);

--
-- Indexes for table `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_user_group_id_foreign` (`group_id`),
  ADD KEY `group_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `leagues`
--
ALTER TABLE `leagues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leagues_user_id_foreign` (`user_id`);

--
-- Indexes for table `league_comments`
--
ALTER TABLE `league_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `league_comments_league_id_foreign` (`leagues_id`),
  ADD KEY `league_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matches_user_id_foreign` (`user_id`),
  ADD KEY `matches_league_id_foreign` (`league_id`),
  ADD KEY `matches_place_id_foreign` (`place_id`);

--
-- Indexes for table `match_comments`
--
ALTER TABLE `match_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_comments_match_id_foreign` (`match_id`),
  ADD KEY `match_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `match_sponsers`
--
ALTER TABLE `match_sponsers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_sponsers_match_id_foreign` (`match_id`),
  ADD KEY `match_sponsers_sponser_id_foreign` (`sponser_id`);

--
-- Indexes for table `match_team`
--
ALTER TABLE `match_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_team_match_id_foreign` (`match_id`),
  ADD KEY `match_team_team_id_foreign` (`team_id`);

--
-- Indexes for table `match_user`
--
ALTER TABLE `match_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_user_match_id_foreign` (`match_id`),
  ADD KEY `match_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_user_id_foreign` (`user_id`),
  ADD KEY `media_team_id_foreign` (`team_id`),
  ADD KEY `media_group_id_foreign` (`group_id`),
  ADD KEY `media_added_by_foreign` (`added_by`);

--
-- Indexes for table `media_comments`
--
ALTER TABLE `media_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_comments_media_id_foreign` (`media_id`),
  ADD KEY `media_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_superadmin_id_foreign` (`superadmin_id`),
  ADD KEY `messages_event_id_foreign` (`event_id`),
  ADD KEY `messages_match_id_foreign` (`match_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_user_id_foreign` (`user_id`),
  ADD KEY `news_category_id_foreign` (`category_id`);

--
-- Indexes for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_comments_news_id_foreign` (`news_id`),
  ADD KEY `news_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `places_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsers`
--
ALTER TABLE `sponsers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sponsers_user_id_foreign` (`user_id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sports_user_id_foreign` (`user_id`);

--
-- Indexes for table `sport_user`
--
ALTER TABLE `sport_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sport_user_sport_id_foreign` (`sport_id`),
  ADD KEY `sport_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_foreign` (`user_id`),
  ADD KEY `teams_sport_id_foreign` (`sport_id`),
  ADD KEY `teams_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_user_team_id_foreign` (`team_id`),
  ADD KEY `team_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_countries_id_foreign` (`countries_id`),
  ADD KEY `users_roles_id_foreign` (`roles_id`),
  ADD KEY `countries_id` (`countries_id`,`govarea_id`,`city_id`),
  ADD KEY `govarea_id` (`govarea_id`),
  ADD KEY `city_id` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `articles_comments`
--
ALTER TABLE `articles_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `event_albums`
--
ALTER TABLE `event_albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_album_media`
--
ALTER TABLE `event_album_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_comments`
--
ALTER TABLE `event_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_sponsers`
--
ALTER TABLE `event_sponsers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_users`
--
ALTER TABLE `event_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `govareas`
--
ALTER TABLE `govareas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leagues`
--
ALTER TABLE `leagues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `league_comments`
--
ALTER TABLE `league_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `match_comments`
--
ALTER TABLE `match_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_sponsers`
--
ALTER TABLE `match_sponsers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `match_team`
--
ALTER TABLE `match_team`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `match_user`
--
ALTER TABLE `match_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `media_comments`
--
ALTER TABLE `media_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sponsers`
--
ALTER TABLE `sponsers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sport_user`
--
ALTER TABLE `sport_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `articles_comments`
--
ALTER TABLE `articles_comments`
  ADD CONSTRAINT `articles_comments_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`govarea_id`) REFERENCES `govareas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_place_id_foreign` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_albums`
--
ALTER TABLE `event_albums`
  ADD CONSTRAINT `event_albums_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_album_media`
--
ALTER TABLE `event_album_media`
  ADD CONSTRAINT `event_album_media_event_album_id_foreign` FOREIGN KEY (`event_album_id`) REFERENCES `event_albums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_album_media_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_comments`
--
ALTER TABLE `event_comments`
  ADD CONSTRAINT `event_comments_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_sponsers`
--
ALTER TABLE `event_sponsers`
  ADD CONSTRAINT `event_sponsers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_sponsers_sponser_id_foreign` FOREIGN KEY (`sponser_id`) REFERENCES `sponsers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_users`
--
ALTER TABLE `event_users`
  ADD CONSTRAINT `event_users_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `govareas`
--
ALTER TABLE `govareas`
  ADD CONSTRAINT `govareas_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groups_sport_id_foreign` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groups_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `group_user_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leagues`
--
ALTER TABLE `leagues`
  ADD CONSTRAINT `leagues_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `league_comments`
--
ALTER TABLE `league_comments`
  ADD CONSTRAINT `league_comments_league_id_foreign` FOREIGN KEY (`leagues_id`) REFERENCES `leagues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `league_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_league_id_foreign` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matches_place_id_foreign` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matches_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `match_comments`
--
ALTER TABLE `match_comments`
  ADD CONSTRAINT `match_comments_match_id_foreign` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `match_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `match_sponsers`
--
ALTER TABLE `match_sponsers`
  ADD CONSTRAINT `match_sponsers_match_id_foreign` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `match_sponsers_sponser_id_foreign` FOREIGN KEY (`sponser_id`) REFERENCES `sponsers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `match_team`
--
ALTER TABLE `match_team`
  ADD CONSTRAINT `match_team_match_id_foreign` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `match_team_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `match_user`
--
ALTER TABLE `match_user`
  ADD CONSTRAINT `match_user_match_id_foreign` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `match_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media_comments`
--
ALTER TABLE `media_comments`
  ADD CONSTRAINT `media_comments_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_match_id_foreign` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD CONSTRAINT `news_comments_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `places_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sponsers`
--
ALTER TABLE `sponsers`
  ADD CONSTRAINT `sponsers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sports`
--
ALTER TABLE `sports`
  ADD CONSTRAINT `sports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sport_user`
--
ALTER TABLE `sport_user`
  ADD CONSTRAINT `sport_user_sport_id_foreign` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sport_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teams_sport_id_foreign` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_user`
--
ALTER TABLE `team_user`
  ADD CONSTRAINT `team_user_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_countries_id_foreign` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`govarea_id`) REFERENCES `govareas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
