-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2017 at 01:49 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tickets`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `fill_date_dimension` (IN `startdate` DATE, IN `stopdate` DATE)  BEGIN
    DECLARE currentdate DATE;
    SET currentdate = startdate;
    WHILE currentdate < stopdate DO
        INSERT INTO time_dimension VALUES (
                        YEAR(currentdate)*10000+MONTH(currentdate)*100 + DAY(currentdate),
                        currentdate,
                        YEAR(currentdate),
                        MONTH(currentdate),
                        DAY(currentdate),
                        QUARTER(currentdate),
                        WEEKOFYEAR(currentdate),
                        DATE_FORMAT(currentdate,'%W'),
                        DATE_FORMAT(currentdate,'%M'),
                        'f',
                        CASE DAYOFWEEK(currentdate) WHEN 1 THEN 't' WHEN 7 then 't' ELSE 'f' END,
                        NULL);
        SET currentdate = ADDDATE(currentdate,INTERVAL 1 DAY);
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `app_id` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `settings_id` varchar(20) NOT NULL,
  `acct_id` varchar(20) NOT NULL,
  `dt_created` varchar(20) NOT NULL,
  `dt_modified` varchar(20) NOT NULL,
  `parent_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter';

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `app_id`, `username`, `password`, `settings_id`, `acct_id`, `dt_created`, `dt_modified`, `parent_id`) VALUES
(5, 'bforte', '', 'bforte', 'bforte', '', '', '', '', ''),
(9, 'go', '', 'go', 'go', '', '', '2016-09-27 17:40:49', '', ''),
(10, 'Bryan  Spearman', '', 'bspearman', 'bspearman', '', '', '2016-12-02 21:33:43', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) NOT NULL,
  `parent_id` tinytext NOT NULL,
  `name` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `url` tinytext NOT NULL,
  `date_created` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter';

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `parent_id`, `name`, `type`, `url`, `date_created`) VALUES
(12, '4', 'candy barsz', '', '', ''),
(13, '4', 'soda', '', '', ''),
(14, '4', 'sports', 'generic', '', '2016-09-27 16:16:08'),
(15, '8', 'cars', '', '', '2016-09-27 17:35:43'),
(20, '9', 'house', '', 'http://localhost:8888/00_CommunityWall/REMOTE/CommunityWall//includes/docs/admin_9/doc_20.json.php', '2016-09-27 17:57:39'),
(21, '9', 'adult drinks', '', 'http://localhost:8888/00_CommunityWall/REMOTE/CommunityWall//includes/docs/admin_9/doc_21.json.php', '2016-09-27 19:58:11'),
(22, '10', 'jacks stuff', '', 'http://shout.gocodigo.net//communitywall//includes/docs/admin_10/doc_22.json.php', '2016-09-28 20:11:58'),
(23, '9', 'Meetings', '', 'http://shout.gocodigo.net//communitywall//includes/docs/admin_9/doc_23.json.php', '2016-09-29 15:51:51'),
(24, '5', 'BIG DOC', '', 'http://localhost:8989/jppa/tickets//includes/docs/admin_5/doc_24.json.php', '2016-12-16 18:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) NOT NULL,
  `title` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `created` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter';

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `description`, `created`) VALUES
(1, 'Brand Managers', 'Jackson and Perkins: Mike Connelly Wayside Gardens: Melissa Hayden Park Seed: Ginger Long', ''),
(2, 'fontawesome version kalio', ' //maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', ''),
(3, 'Deployment Order', 'ORDER OF OPERATIONS: 			CSS and JAVA 			HEADERS(may need version change) 			CONTROLS 				children first  				then up the ancestry tree 			PAGE', ''),
(4, 'Deployment Process', 'Display- Deploy - Deploy To Production  		- see the files that changed. 		-search Modified by "bf" first initial and last name.', ''),
(5, 'Basecamp bayon.forte@parkseed.com', 'Bas3camp!', ''),
(6, 'BrowserStack c.colon@parkseed.com', 'ParkSeed2016', ''),
(7, 'Kalio Navigation', 'MainNavLink_X Category_Href_Generator', ''),
(8, 'time sheets timesheet', 'X:Department FilesECommerceTimeSheets', ''),
(9, 'FEUG', 'Free Express UpGrade', ''),
(10, 'BSD', 'Berkeley Software Distribution License', ''),
(11, 'GNU GSL', 'General Use License', ''),
(12, 'OSL', 'Open Software License', ''),
(13, 'FTPkalio', 'Host: client.ftp.dminsite.com Protocol: FTP - File Transfer Protocol Encryption: Require explicit FTP over TLS Logon Type: Normal Account name: park_ftp Password: kaliopark2!', ''),
(14, 'ACR', 'ACR stands for acquire, convert, retain.  ', ''),
(15, 'Morning Sticky Pad ', ' ///////////////////////////////////////////////////////////////// DAILY: MORNING:     check email - log appropriately in Basecamp.     charge phone     plan day on calendar   CHANGE REQUESTS:     SEED mobile fixes PROJECTS:     Mix and Match : desktop an', '');

-- --------------------------------------------------------

--
-- Table structure for table `publish`
--

CREATE TABLE `publish` (
  `id` bigint(20) NOT NULL,
  `name` tinytext NOT NULL,
  `admin_id` tinytext NOT NULL,
  `doc_id` tinytext NOT NULL,
  `published` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter';

--
-- Dumping data for table `publish`
--

INSERT INTO `publish` (`id`, `name`, `admin_id`, `doc_id`, `published`) VALUES
(1, '', '9', '21', '2016-09-27 19:50:30'),
(2, '', '9', '21', '2016-09-27 19:51:40'),
(3, '', '9', '21', '2016-09-27 20:02:43'),
(17, '', '9', '21', '2016-09-27 20:16:41'),
(18, '', '9', '21', '2016-09-27 20:24:10'),
(19, '', '9', '21', '2016-09-27 20:27:29'),
(20, '', '9', '21', '2016-09-27 20:39:42'),
(21, '', '9', '21', '2016-09-27 20:53:49'),
(22, '', '9', '21', '2016-09-27 20:54:22'),
(23, '', '9', '21', '2016-09-27 21:13:11'),
(24, '', '9', '21', '2016-09-28 15:29:33'),
(25, '', '9', '21', '2016-09-28 15:34:58'),
(26, '', '9', '21', '2016-09-28 15:50:51'),
(27, '', '9', '21', '2016-09-28 17:04:39'),
(28, '', '9', '21', '2016-09-28 17:47:22'),
(29, '', '9', '21', '2016-09-28 18:49:17'),
(30, '', '9', '21', '2016-09-28 19:09:52'),
(31, '', '9', '21', '2016-09-28 19:27:15'),
(32, '', '9', '21', '2016-09-28 19:30:46'),
(33, '', '9', '21', '2016-09-28 19:32:34'),
(34, '', '10', '22', '2016-09-28 20:13:14'),
(35, '', '9', '21', '2016-09-28 20:28:03'),
(36, '', '9', '21', '2016-09-28 20:30:01'),
(37, '', '9', '21', '2016-09-28 20:30:36'),
(38, '', '9', '21', '2016-09-28 20:36:24'),
(39, '', '9', '21', '2016-09-28 21:10:43'),
(40, '', '9', '21', '2016-09-28 21:11:18'),
(41, '', '9', '21', '2016-09-28 21:14:22'),
(42, '', '9', '21', '2016-09-28 21:17:27'),
(43, '', '9', '21', '2016-09-28 21:20:54'),
(44, '', '9', '23', '2016-09-29 15:55:15'),
(45, '', '9', '20', '2016-09-29 15:58:44'),
(46, '', '9', '23', '2016-09-29 16:31:00'),
(47, '', '9', '23', '2016-09-29 16:31:29'),
(48, '', '9', '21', '2016-09-29 16:41:38'),
(49, '', '9', '23', '2016-09-29 16:43:32'),
(50, '', '5', '24', '2016-12-16 18:13:52'),
(51, '', '5', '24', '2016-12-16 18:14:59'),
(52, '', '5', '24', '2016-12-16 18:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `id` bigint(20) NOT NULL,
  `name` tinytext NOT NULL,
  `parent_id` tinytext NOT NULL,
  `doc_id` tinytext NOT NULL,
  `title` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `updated` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter';

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`id`, `name`, `parent_id`, `doc_id`, `title`, `description`, `updated`) VALUES
(1, '', '4', '13', 'coke', '', ''),
(2, '', '4', '13', 'pepsiz', '', ''),
(3, '', '4', '12', 'milky way', '', ''),
(4, '', '4', '12', 'mars bar', '', ''),
(5, '', '4', '14', 'football america', '', '2016-09-27 16:16:43'),
(6, '', '4', '14', 'soccer', '', '2016-09-27 16:17:14'),
(7, 'camaro', '8', '15', '', '', '2016-09-27 17:35:56'),
(8, 'F-150', '8', '15', '', '', '2016-09-27 17:36:04'),
(9, 'model-t', '8', '15', '', '', '2016-09-27 17:36:18'),
(10, 'motorcycle', '9', '16', '', '', '2016-09-27 17:41:35'),
(11, 'tricycle', '9', '16', '', '', '2016-09-27 17:41:48'),
(12, 'bicycle', '9', '16', '', '', '2016-09-27 17:42:02'),
(13, 'tandem cycle', '9', '16', '', '', '2016-09-27 17:45:14'),
(14, 'abode', '9', '20', 'Abode', 'A modest little home.', '2016-09-27 18:11:33'),
(15, 'casa', '9', '20', 'Casa', 'A hispanic home.', '2016-09-27 18:11:49'),
(16, 'mansion', '9', '20', 'Mansion', 'A very grand home.', '2016-09-27 18:12:07'),
(17, 'wine', '9', '21', 'Red Wine', 'red red wine...keep me rockin all of the time', '2016-09-29 16:41:26'),
(18, 'White Wine', '9', '21', 'White Wine', 'white lightning thunder claps of sophistication!', '2016-09-28 21:17:18'),
(19, 'soda', '9', '21', 'soda pop', 'Pure Carbonated Joy!', '2016-09-28 21:09:02'),
(20, 'fine cider', '9', '21', 'spring style', 'From SOme Old Guys SPring', '2016-09-28 19:31:56'),
(21, 'iced tea', '9', '21', 'Iced Tea', 'with a squeze of lemon', '2016-09-28 21:09:29'),
(22, 'Coffee', '9', '21', 'Coffee', 'No morning is complete without this brew.', '2016-09-28 21:09:51'),
(23, 'Beer', '9', '21', 'B E E R ', 'The king of adult beverages.', '2016-09-27 20:47:00'),
(24, '', '9', '21', 'Coca Cola', 'Id like to teach the world to sing... ', '2016-09-28 21:10:24'),
(25, 'socks', '10', '22', 'white socks', 'knee hi baby!', '2016-09-28 20:12:36'),
(26, 'underwear', '10', '22', 'tighty', 'whiteys', '2016-09-28 20:13:01'),
(27, 'funky cold madina', '9', '21', 'funky cold madina', 'all good !!!', '2016-09-28 20:35:49'),
(28, '', '9', '23', 'Joe Inc. Project', 'Sales team  9:15am  corner room', '2016-09-29 15:53:17'),
(29, '', '9', '23', 'Bank XYZ  Kickoff ', '11:30am Marks Office', '2016-09-29 16:43:24'),
(30, '', '9', '23', 'Softball Team', '5:30pm  Riggley Field ', '2016-09-29 15:55:02'),
(31, '', '9', '20', 'Ranch', 'one story spread ', '2016-09-29 15:58:16'),
(32, '', '9', '20', 'tent', 'close to nature', '2016-09-29 15:58:31'),
(33, '', '9', '23', 'KITCHEN', 'Will someone please claim the SCIENCE EXPERIMENT in the fridge!', '2016-09-29 16:30:38'),
(34, 'asdf junior', '5', '24', '', '', '2016-12-16 18:13:11'),
(35, 'small doc', '5', '24', '', '', '2016-12-16 18:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `snapshot`
--

CREATE TABLE `snapshot` (
  `id` bigint(20) NOT NULL,
  `name` tinytext NOT NULL,
  `description` longtext NOT NULL,
  `created_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter';

--
-- Dumping data for table `snapshot`
--

INSERT INTO `snapshot` (`id`, `name`, `description`, `created_dt`) VALUES
(5, 'snapshot_2016-12-27 15:23:15', '[{"id":"106","name":"JP Checkout Summary Confirmation Layout","description":"Basecamp--U/UIX Change Requests--Bugs \nJP:Order Confirmation Page Layout...","notes":"layout was heavy on the right and had text and images overlaying.\nreview with Christian and deploy","completed":"2016-12-16 14:50:37"},{"id":"107","name":"SEED &amp; GRDN : video with unwanted text","description":"tested ready for sign off","notes":"","completed":""},{"id":"108","name":"PERK: Main Nav changes to Amaryllis submenu","description":"&#039;buy&#039; and &#039;care&#039; links. &#039;care&#039; link to WP blog article &#039;All about Amaryllis&#039;","notes":"Christian did this...ready for signoff.","completed":""},{"id":"109","name":"e-commerce research","description":"additions to the power point \nfound a dozen or so matrices on wikipedia.","notes":" format should be:\n1.	The issues we face\n2.	Why they matter\n3.	Data to support a solution (platform change)\n4.	The solution choices and pros/cons of each\n5.	The winning recommendation\nSaaS vs OpenSource ","completed":"2016-12-20 22:58:25"},{"id":"110","name":"PERK: time range header ","description":"add a link to the time range header on MainNavView ie. Home Page ","notes":"","completed":""},{"id":"111","name":"JPPA:","description":"Abandoned Cart Emails: These we sending out emails with default info from Kalio.","notes":"Christia, figured this out and deactivated the emails.","completed":""},{"id":"112","name":"PERK: &#039;sold out&#039; flag","description":"Needed a slight layout tweak to give it some space.","notes":"","completed":""},{"id":"113","name":"Holiday Post Mortem Report","description":"see email","notes":"1.	Gains 2.	Losses 3.	Lessons Learned 4.	Go Forward Strategy","completed":""},{"id":"139","name":"Mix and Match","description":"Christian is working on the Mix and match project. He is using the jquery and jquery-ui libraries to code the functionality.","notes":"Bryan wants mobile and desktop to behave differently.","completed":"2016-12-21 14:37:41"},{"id":"140","name":"Sandbox Server For E-Com Analysis","description":"Christian has requested these params:VM server 2-4 GB ram, HighData Processor `5 or 7 , 100GB RAM, Admin priviledges for installs(sudo), dual user ability if possible, Ubuntu LTS server as terminal only install.","notes":"Since we should have admin priviledges on the virtual server we should be able to install any of the following platforms: Magento Community, Spree, PrestaShop, Reaction","completed":"2016-12-21 14:36:57"},{"id":"141","name":"Ardalan and Kalio Live Files Status","description":"","notes":"","completed":""},{"id":"142","name":"Shipping Tables Meeting","description":"overview with Chinna on go to meeting","notes":"took notes in basecamp...","completed":""},{"id":"143","name":"Research Shipping Calendar","description":"I have to do some research to find and understand a &#039;Shipping Calendar&#039; that jgarcia had started on.","notes":"Need to report findings back to Scott A. on 1-4-16","completed":""},{"id":"144","name":"","description":"","notes":"","completed":""},{"id":"145","name":"","description":"","notes":"","completed":""},{"id":"146","name":"","description":"","notes":"","completed":""}]', '2016-12-27 20:23:15'),
(6, 'snapshot_2016-12-30 15:44:53', '[{"id":"106","name":"JP Checkout Summary Confirmation Layout","description":"Basecamp--U/UIX Change Requests--Bugs \nJP:Order Confirmation Page Layout...","notes":"layout was heavy on the right and had text and images overlaying.\nreview with Christian and deploy","completed":"2016-12-16 14:50:37"},{"id":"107","name":"SEED &amp; GRDN : video with unwanted text","description":"tested ready for sign off","notes":"","completed":""},{"id":"108","name":"PERK: Main Nav changes to Amaryllis submenu","description":"&#039;buy&#039; and &#039;care&#039; links. &#039;care&#039; link to WP blog article &#039;All about Amaryllis&#039;","notes":"Christian did this...ready for signoff.","completed":""},{"id":"113","name":"Holiday Post Mortem Report","description":"see email","notes":"1.	Gains 2.	Losses 3.	Lessons Learned 4.	Go Forward Strategy","completed":""},{"id":"139","name":"Mix and Match","description":"Christian is working on the Mix and match project. He is using the jquery and jquery-ui libraries to code the functionality.","notes":"Bryan wants mobile and desktop to behave differently. Christian has been working on this from home due to car trouble.","completed":"2016-12-29 14:27:30"},{"id":"147","name":"Shipping Calendar Research","description":"c Desktop QUICK_IMGS overview_shippingCalendar","notes":"show to Scott on 4th","completed":"2016-12-30 15:18:01"},{"id":"148","name":"push out garden video changes on ProductPageImageView ","description":"","notes":"","completed":""}]', '2016-12-30 20:44:53'),
(7, 'snapshot_2017-01-09 14:12:14', '[{"id":"113","name":"Holiday Post Mortem Report","description":"see email","notes":"1.	Gains 2.	Losses 3.	Lessons Learned 4.	Go Forward Strategy","completed":""},{"id":"139","name":"Mix and Match","description":"Christian is working on the Mix and match project. He is using the jquery and jquery-ui libraries to code the functionality.","notes":"prototype 1-6-17\nfunctionality and logic 1-13-17","completed":"2017-01-04 15:41:38"},{"id":"147","name":"Shipping Calendar Research","description":"c Desktop QUICK_IMGS overview_shippingCalendar","notes":"show to Scott on 4th","completed":"2016-12-30 15:18:01"},{"id":"149","name":"Health Benefit Signup","description":"mytotalsource.com","notes":"","completed":"2017-01-03 14:20:30"},{"id":"150","name":"Custom Shipping Table","description":"Compare Custom table vs Existing Table and give Customer best deal.","notes":"custom table with seed on the end of the name\noffer with SHIPSEED as the promo code.\nCurrently video exists to our Kalio FTP location.. \nFolder name: /PARK/Video \nFile name: 2016-12-21 14.12 PERK Custom shipping Setup Demo.mp4 \n","completed":"2017-01-04 16:53:52"},{"id":"151","name":"FTP Credentials","description":"Host: client.ftp.dminsite.com Protocol: FTP - File Transfer Protocol Encryption: Require explicit FTP over TLS Logon Type: Normal Account name: park_ftp Password: kaliopark2!","notes":"","completed":""},{"id":"152","name":"Gift Shipping Calendar","description":"Requirements:","notes":"Scope:","completed":""},{"id":"153","name":"Slideshow","description":"PERK: deployed hot fix to show slideshow navigation buttons and correct padding below.","notes":"","completed":""},{"id":"154","name":"RAI fix","description":"Christian was recruited to do some work for Van Dykes regarding the layout of their category page and a botched deployment.","notes":"1 hour +","completed":"2017-01-05 21:39:31"},{"id":"155","name":"Physical Inventory","description":"A day plus an hour or so of counting seed packets.","notes":"","completed":""}]', '2017-01-09 19:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `snips`
--

CREATE TABLE `snips` (
  `id` bigint(20) NOT NULL,
  `name` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `code` longtext NOT NULL,
  `language` tinytext NOT NULL,
  `created` tinytext NOT NULL,
  `modified` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter';

--
-- Dumping data for table `snips`
--

INSERT INTO `snips` (`id`, `name`, `description`, `code`, `language`, `created`, `modified`) VALUES
(1, 'write', 'log or echo out in kalio', 'Response.Write(cart_item_count.ToString());', 'csharp', '2016-12-12 19:03:28', '2016-12-12 19:04:04'),
(2, 'loop', 'loop through an object', 'foreach(Cart validCart in validate_cart) {  		//Reset/Set product variables 		is_cart_valid = true; 		cart_item_count = validCart.ItemCount; 	}', 'csharp', '2016-12-12 19:04:46', '2016-12-12 19:05:09'),
(3, 'querystring', 'get query string parameter', 'string productNumber = Request.QueryString[&quot;p&quot;];', '', '2016-12-12 19:08:31', '2016-12-12 19:08:31'),
(4, 'string to integer', 'convert string to a number', 'int productQuantity = Convert.ToInt32(productQuantity_string);', '', '2016-12-12 19:09:09', '2016-12-12 19:09:09'),
(5, 'array length or count', '', 'productNumber_array.Length', '', '2016-12-12 19:10:04', '2016-12-12 19:10:04'),
(6, 'Product', 'getProductByNumber', 'Product[] products = Core.GetProductByProductNumber(productNumber_single.Trim());', '', '2016-12-12 19:11:23', '2016-12-12 19:11:23'),
(7, 'string builder', 'build html or string', 'StringBuilder stringBuilderProduct = new StringBuilder();', '', '2016-12-12 19:12:30', '2016-12-12 19:12:30'),
(8, 'ln', 'listName', '', '', '2016-12-12 19:20:17', '2016-12-12 19:26:57'),
(9, 'lt', 'listType', '', '', '2016-12-12 19:20:27', '2016-12-12 19:20:27'),
(10, 'lid', 'list Item ID', '', '', '2016-12-12 19:20:42', '2016-12-12 19:20:42'),
(11, 'action', 'list action', '', '', '2016-12-12 19:20:53', '2016-12-12 19:20:53'),
(12, 'string builder example', '', 'stringBuilderListItem.Append(&quot;{&quot;);', '', '2016-12-12 19:23:03', '2016-12-12 19:23:03'),
(13, 'Cart and Cart Items', '', 'Cart cart = Core.GetCartObject(); 	CartItemCollection items = new CartItemCollection();', '', '2016-12-12 19:28:33', '2016-12-12 19:28:33'),
(14, 'dictionary', '', 'Dictionary&lt;int, string&gt; GrowingZoneByZip_Dictionary = (Dictionary&lt;int, string&gt;)Cache[&quot;GrowingZoneByZip&quot;];', '', '2016-12-12 19:34:14', '2016-12-12 19:34:14'),
(15, 'eid', 'entry id string', '', '', '2016-12-12 19:37:41', '2016-12-12 19:37:41'),
(16, 'citem', 'cart item', '', '', '2016-12-12 19:39:49', '2016-12-12 19:39:49'),
(17, 'nname', 'nick name', '', '', '2016-12-12 19:40:00', '2016-12-12 19:40:00'),
(18, 'rlist', 'recipient list', '', '', '2016-12-12 19:40:19', '2016-12-12 19:40:19'),
(19, 'string replace', '', 'string recipient = primeArray[i].Replace(&quot; &quot;,&quot;-&quot;);', '', '2016-12-12 19:40:43', '2016-12-12 19:40:43'),
(20, 'clist', 'comma list', '', '', '2016-12-12 19:41:16', '2016-12-12 19:41:16'),
(21, 'ProductCollection', '', 'ProductCollection all_products = Core.GetAllProducts(&quot;NAME&quot;, &quot;Asc&quot;);', '', '2016-12-12 19:43:22', '2016-12-12 19:43:22'),
(22, 'split', 'split string into an array', 'string[] list_items = comma_list.Split(&#039;,&#039;);', '', '2016-12-12 19:44:08', '2016-12-12 19:44:08'),
(23, 'Category Collection', '', 'CategoryCollection all_categories = Core.GetAllCategories();', '', '2016-12-12 19:45:17', '2016-12-12 19:45:17'),
(24, 'Append Header to response', 'also CORS ', 'Response.AppendHeader(&quot;Access-Control-Allow-Origin&quot;, &quot;*&quot;);', '', '2016-12-12 19:46:00', '2016-12-12 19:46:00'),
(25, 'ciid', 'cart item ID', '', '', '2016-12-12 19:54:48', '2016-12-12 19:54:48'),
(26, 'DateTime', 'get date for today', 'DateTime firstDate = DateTime.Today;', '', '2016-12-12 19:56:09', '2016-12-12 19:56:09'),
(27, 'date time', 'a year from now', 'DateTime lastDate = DateTime.Today.AddYears(1);', '', '2016-12-12 19:56:28', '2016-12-12 19:56:28'),
(28, 'Product Attribute exists', 'Does this attribute exist for this product.', 'thisProduct.DoesSpecificationAttributeExist(&quot;AirRestriction&quot;)', '', '2016-12-12 19:57:39', '2016-12-12 19:57:39'),
(29, 'Http Request', '', 'DmiHttpRequest httpWebRequest = new DmiHttpRequest(uri);', '', '2016-12-12 20:03:14', '2016-12-12 20:03:14'),
(30, 'http request and add header', '', 'httpWebRequest.Headers.Add(&quot;Content-Type&quot;, &quot;text/xml; charset=utf-8&quot;);', '', '2016-12-12 20:04:13', '2016-12-12 20:04:13'),
(32, 'time range text banner', '', '&lt;script runat=&quot;server&quot;&gt; protected String Get_HTML_ForTimeRange_Start_End() { /* IN: starting date, ending date, and html. OUT: a string of HTML enclosed in a bootstrap &#039;container&#039;,&#039;row&#039;, and &#039;full width column&#039; */			 	String STARTING = &quot;12/13/2016 12:00:01 PM&quot;; 	String ENDING = &quot;12/21/2016 12:00:01 AM&quot;; 	String HTML = &quot;&lt;span style=&quot;color:#b92626 !important;font-family:times;margin:3px 3px 3px 3px ;font-size:1.7em; &quot;&gt;Order Now For Guaranteed Christmas Delivery&lt;/span&gt;&quot;;  	StringBuilder html_markup = new StringBuilder(); 	html_markup.Append(&quot;&lt;div class=&quot;container&quot;&gt;&lt;div class=&quot;row&quot;&gt;&quot;); 	html_markup.Append(&quot;&lt;div class=&quot;col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center &quot;  &gt; &quot;); 	DateTime TimeNow = DateTime.Now; 	if (TimeNow &gt; Convert.ToDateTime(STARTING) &amp;&amp; TimeNow &lt; Convert.ToDateTime(ENDING)) { 		html_markup.Append(HTML); 	} else { 		html_markup.Append(&quot;&quot;);	  	} 	html_markup.Append(&quot;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;!-- end container --&gt; &quot;); 	return  html_markup.ToString(); } &lt;/script&gt; &lt;% =Get_HTML_ForTimeRange_Start_End()%&gt;', '', '2016-12-13 22:32:39', '2016-12-13 22:32:39'),
(33, 'SOA', 'Service Oriented Architecture', '', '', '2016-12-14 18:50:38', '2016-12-14 18:50:38'),
(34, 'DMI:Expression', '', '[[DMI:Expression value=&#039;SetInViewState&lt;string&gt;(&quot;cart_item_id&quot;, Core.GetQueryStringValue(&quot;ciid&quot;))&#039;]][[/DMI:Expression]]', '', '2016-12-22 15:15:35', '2016-12-22 15:15:35'),
(35, 'PROMO CODE NOTES', '', ' on  the cart view &gt; click on the &quot;Have an offer? &quot; &gt; #cart-offer-link it opens a Promo Code: &lt;input&gt; &lt;btn apply &gt;  &lt;&lt; cart_js.js  //CLICK: Show Promo Code Box 	jQuery(&#039;#cart-summary&#039;).on(&#039;click&#039;, &#039;#cart-offer-link&#039;, function(e){ 		jQuery(&#039;#cart-offer&#039;).slideDown(); 		jQuery(this).slideUp(); 		e.preventDefault(); 	}); &gt;&gt;  &lt;div id=&quot;cart-offer&quot; style=&quot;display:none;&quot;&gt;     &lt;form id=&quot;CouponKeycode&quot; method=&quot;post&quot;&gt;         &lt;input type=&quot;hidden&quot; name=&quot;formName&quot; value=&quot;dmiformCouponKeycodeHandler&quot;&gt;         &lt;input type=&quot;hidden&quot; name=&quot;pageURL&quot; value=&quot;cart.aspx&quot;&gt;         &lt;p&gt;&lt;strong&gt;Do you have a special promo code?&lt;/strong&gt;             &lt;br /&gt;Please enter your Promo Code below to activate your special offer. Only 1 promo code per order may be used.&lt;/p&gt;         &lt;p&gt;             &lt;label&gt;Promo Code:&lt;/label&gt;             &lt;input type=&quot;text&quot; placeholder=&quot;Enter Promo Code&quot; name=&quot;keycode&quot; maxlength=&quot;50&quot; /&gt;             &lt;input type=&quot;submit&quot; value=&quot;Apply&quot; /&gt;         &lt;/p&gt;          &lt;!-- validation of keycode begin--&gt;         &lt;p&gt;     &lt;!-- validation of keycode end --&gt;     &lt;/form&gt; &lt;/div&gt;  FORM: name = dmiformCouponKeycodeHandler       pageURL = cart.aspx        form submits -&gt; form drivers -&gt; control: CouponKeycodeHandler  CouponKeycodeHandler.cs  UserFormElement element = form.GetElement(&quot;keycode&quot;);  ...  CustomerCtxt.SetupOffer(element.GetValue().Trim(), string.Empty);  ...   cart.RePrice();     form.Redirect(pageURL + &quot;?keycode=success&quot;);', '', '2016-12-22 18:23:10', '2016-12-22 18:23:10'),
(36, 'dmi getFromViewState', '', '&lt;dmi:expression value=&#039;GetFromViewState&lt;String&gt;(&quot;MyVariableName&quot;)&#039;&gt;&lt;/dmi:expression&gt; ', '', '2016-12-22 21:39:31', '2016-12-22 21:39:31'),
(37, 'ViewState  variables', 'the set code was converted from [[]] syntax', '&lt;%-- Set A DMI Variable --%&gt; &lt;dmi:Expression value=&#039;SetInViewState&lt;string&gt;(&quot;MyVarVar&quot;, &quot;myDynamicVarNOT&quot;)&#039;&gt;&lt;/dmi:Expression&gt; &lt;div class=&quot;row&quot;&gt; 	 &lt;div class=&quot;col-lg-12&quot;&gt; 	 &lt;%-- GET and OUTPUT A DMI Variable --%&gt;   	 	&lt;dmi:expression value=&#039;GetFromViewState&lt;String&gt;(&quot;MyVarVar&quot;)&#039;&gt;&lt;/dmi:expression&gt; 	 &lt;/div&gt;  &lt;/div&gt;', '', '2016-12-22 21:44:57', '2016-12-22 21:44:57'),
(38, 'Databound Control DMI Tag', 'include another contro and data', '[[DMI:Control name=&#039;(controlName)&#039;  dmisource=&#039;(datasource)&#039; ]][[/DMI:Control]]&lt;/pre&gt;', '', '2016-12-29 20:43:47', '2016-12-29 20:43:47'),
(39, 'Expresssion DMI Tag', 'evaluates an expression', '[[DMI:Expression value=&#039;(# expression )&#039; ]][[/DMI:Expression]]', '', '2016-12-29 20:45:20', '2016-12-29 20:45:20'),
(40, 'Include DMI Tag', 'include files in the HEAD section', '[[DMI:Include type=&#039;(type of include)&#039; name=&#039;(name of the include file)&#039;]][[/DMI:Include]]', '', '2016-12-29 20:46:00', '2016-12-29 20:46:00'),
(41, 'Placeholder DMI Tag', 'a placeholder in a &#039;layout&#039; file associated with a control.', '[[DMI:Placeholder name=&#039;&lt;PlaceholderName&gt;&#039;]][[/DMI:Placeholder]]', '', '2016-12-29 20:47:15', '2016-12-29 20:47:15'),
(42, 'Property DMI Tag', 'evaluates a property  Usually inside a &#039;loop&#039; or &#039;Use&#039; tag.', '[[DMI:Property name=&#039;(PropertyName)&#039;]][[/[DMI:Property]]', '', '2016-12-29 20:49:01', '2016-12-29 20:49:01'),
(43, 'Static Control DMI Tag', 'statically place a control in another control.', '[[DMI:Control name=&#039;(controlName)&#039;  ]][[/DMI:Control]]', '', '2016-12-29 20:49:47', '2016-12-29 20:49:47'),
(44, 'Use DMI Tag', 'inline tag to iterate on a &#039;Container&#039; or datasource', '[[DMI:Use dmisource=&#039;(# expression )&#039;]][[/DMI:Use]]', '', '2016-12-29 20:51:15', '2016-12-29 20:51:15'),
(45, 'GetDataSource', 'no documentation?', '[[DMI:Control name=&#039;ProductSingle&#039; dmisource=&#039;Core.GetDataSource(Product)((Product)Container.DataItem)&#039;]][[/DMI:Control]]', '', '2016-12-29 21:15:53', '2016-12-29 21:15:53'),
(46, 'List', 'csharp list', 'List&lt;MyType&gt; myList = new ArrayList&lt;MyType&gt;();', '', '2016-12-29 21:46:24', '2016-12-29 21:46:24'),
(47, 'Dictionary', 'csharp Dictionary', 'Dictionary&lt;string, decimal&gt; dictionary = null; Person oPerson = null; string key = &quot;SomeValue&quot;;  if (dictionary.ContainsKey(key)) {     oPerson = dictionary[key]; } Dictionary&lt;string, decimal&gt; dictionary = null; Person oPerson = null; string key = &quot;SomeValue&quot;;  if (dictionary.ContainsKey(key)) { oPerson = dictionary[key]; }', '', '2016-12-29 21:48:03', '2016-12-29 21:48:03'),
(48, 'IF DMI TAG', 'condition', '[[DMI:If expression=&#039;(expression)&#039; dmisource=&#039;(data source)&quot; ]] 			[[DMI:Then]] 				..Handle true case.. 			[[/DMI:Then]] 			[[DMI:Else]] 				..Handle else case .. 			[[/DMI:Else]] 			[[/DMI:If]]', '', '2016-12-30 16:22:19', '2016-12-30 16:22:19'),
(49, 'ASP and Csharp', 'function and call', '&lt;%-- START --%&gt;   &lt;script runat=&quot;server&quot;&gt; protected String HTML_stringBuilder() {  	StringBuilder html = new StringBuilder(); 	html.Append(&quot;&lt;div class=&#039;row&#039;&gt;&quot;); 	html.Append(&quot;&lt;div class=&#039;col-lg-12&#039;&gt;&quot;); 	html.Append(&quot;asp and dmi and csharp &quot;); 	html.Append(&quot;&lt;/div&gt;&quot;); 	html.Append(&quot;&lt;/div&gt;&quot;); 	return  html.ToString();  } &lt;/script&gt; &lt;% =HTML_stringBuilder()%&gt; &lt;% response.write(&#039;straight text&#039;) %&gt;  &lt;%-- STOP --%&gt; ', '', '2016-12-30 17:16:55', '2016-12-30 17:16:55'),
(50, 'asp and HTML', '', '&lt;%  =&quot;&lt;div class=&#039;row&#039;&gt;&lt;div class=&#039;col-lg-12&#039;&gt;a-s-p&lt;/div&gt;&lt;/div&gt;&quot; %&gt;', '', '2016-12-30 17:21:42', '2016-12-30 17:21:42'),
(51, 'asp and javascript', '', ' &lt;%  =&quot;&lt;script  type=&#039;text/javascript&#039; &gt;console.log(&#039;javascript and asp&#039;);&lt;/script&gt;&quot; %&gt;', '', '2016-12-30 17:28:01', '2016-12-30 17:28:01'),
(52, 'build javascript with csharp and asp', '', '&lt;script runat=&quot;server&quot;&gt;  protected String JAVASCRIPT_builder(){ 	StringBuilder html = new StringBuilder(); 	  	  	html.Append(&quot;&lt;script  type=&#039;text/javascript&#039; &gt;&quot;); 	html.Append(&quot;console.log(&#039;building javascript with asp and csharp&#039; );&quot;); 	html.Append(&quot;&lt;/&quot;);  	html.Append(&quot;script&gt;&quot;); 	  	  	return  html.ToString(); } &lt;/script&gt;   &lt;% =JAVASCRIPT_builder()%&gt;', '', '2016-12-30 17:46:23', '2016-12-30 17:46:23'),
(53, 'anchor navigation to CONTROL with dmi', '', ' &lt;a href=&quot;[[DMI:Control Name=&#039;FriendlyURLProduct&#039; dmisource=&#039;Core.GetDataSource&lt;Product&gt;(((Product)(Container.DataItem)))&#039;]][[/DMI:Control]]&quot;&gt;', '', '2016-12-30 18:52:19', '2016-12-30 18:52:19'),
(54, 'HTML dmi expression with CORE. call', '', ' &lt;div class=&quot;row&quot;&gt;  		&lt;div class=&quot;col-lg-12&quot;&gt;  		&lt;dmi:expression value=&#039;Core.GetImageBaseUrl(&quot;ART&quot;)&#039;&gt;&lt;/dmi:expression&gt;  		&lt;/div&gt;  	&lt;/div&gt;', '', '2016-12-30 19:28:54', '2016-12-30 19:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `description` tinytext NOT NULL,
  `notes` tinytext NOT NULL,
  `completed` varchar(20) NOT NULL,
  `percent` tinytext NOT NULL,
  `due` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter';

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `name`, `description`, `notes`, `completed`, `percent`, `due`) VALUES
(113, 'Holiday Recap Report', ' where is main document to be stored.\n1) https://basecamp.com/2868789/projects/11652911/todos/287647155', ' ALSO :\nhttps://docs.google.com/document/d/14Kpr7xZaoaV3AfrKRFC7xCMOfk-Lvjc7GNiCaojR8uw/edit\n', '2017-01-09 23:00:53', '', ''),
(139, 'Mix and Match', ' work url: http://rsatestseed.kaliocommerce.com/mixnmatch.aspx', 'prototype 1-6-17\nfunctionality and logic 1-13-17\nBayon and Christian working on desktop and mobile versions of this. Did our first demo of functionality on 1-11-17.', '2017-01-13 13:33:01', '100% for testing', '1-12-17'),
(147, 'Shipping Calendar Research Meeting', ' look back at Scotts Email and create a meeting if necessary', 'show to Scott on 4th', '2017-01-09 14:14:28', '', ''),
(150, 'Custom Shipping Table', 'Compare Custom table vs Existing Table and give Customer best deal.', 'custom table with seed on the end of the name\noffer with SHIPSEED as the promo code.\nWe can NOT access the Handler. File.\nCurrently video exists to our Kalio FTP location.. \nFolder name: /PARK/Video \nFile name: 2016-12-21 14.12 PERK Custom shipping Setup ', '2017-01-09 14:15:37', '', ''),
(152, 'Gift Shipping Calendar', 'Requirements: and Scope: documents created.  by Bayon.', 'We have a meeting 1-11-17 to discuss this project.', '2017-01-11 18:43:26', '1%', 'TBD'),
(156, 'PARK: Bug : email not recognized as valid ? ', 'several chats: keeps telling them that their email addresses are invalid', 'I was able to order fine as a GUEST: WEBPS2312216', '2017-01-11 18:44:01', '100%', '1-10-17'),
(157, 'REPORT', 'Per Paulâ€™s request, please issue the full listing of UX/UI projects, status, due date, and ecommerce team member assigned where appropriate. ', 'by 12 noon to Bryan', '2017-01-11 18:44:41', '100%', '1-9-17'),
(158, 'UI/UX High Level Bucket Organization', 'add latest projects to High Level project and fleash them out in Itemized.', 'add e-commerce research as well and link to Brand Management  where/if necessary.', '2017-01-09 16:47:37', '', ''),
(159, 'Add fields to Weekly Report', 'Percent Comlete  and Due Date ', '', '2017-01-11 18:58:08', '100%', '1-11-17'),
(160, 'ACR Research', 'Create 3 or 4 items every week and implement if possible.', '', '2017-01-11 18:51:52', '', ''),
(161, 'KPI meeting', 'Zip Widget -set up meeting with Haley. zip code to tell frost date and harvest date...more?', '3 hours taken away from Mix and Match development.', '', '', ''),
(162, 'Zip Widget', 'Added this to Hi-Level and Itemized', ' ', '2017-01-11 18:40:38', '0%', 'TBD'),
(163, 'Shipping Table Testing', 'checked that shipping table with code SHIPSEED applied $2.99 to any amount of seeds, and kept default shipping costs for other items.', '', '2017-01-11 18:41:22', '100%', '1-10-17'),
(164, 'prepare kpi report', 'put together some report items for Bryan.', '', '2017-01-11 18:54:52', '100%', '1-9-17'),
(165, 'PERK:Product Page-Take out Gift advisor banner', 'basecamp ticket. Needs to be finished and deployed', '', '2017-01-11 18:55:29', '100%', '1-11-17'),
(166, 'Recap Outlines', 'Please complete your outlines in this doc before the end of the day.  We have a discussion with Paul tomorrow.  https://docs.google.com/document/d/14Kpr7xZaoaV3AfrKRFC7xCMOfk-Lvjc7GNiCaojR8uw/edit', '', '2017-01-11 18:59:45', '100%', '1-11-17'),
(167, '', '', '', '', 'complete:100%', 'due:1-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `ux_emails`
--

CREATE TABLE `ux_emails` (
  `id` bigint(20) NOT NULL,
  `name` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `assigned` tinytext NOT NULL,
  `created` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter';

--
-- Dumping data for table `ux_emails`
--

INSERT INTO `ux_emails` (`id`, `name`, `description`, `assigned`, `created`) VALUES
(1, 'chandra', 'MGP00016496...Jack Gray zip code 24006 The above MGP has 77 recipients and when we try to bring over the addresses it goes blank.  Can someone look into this asap? ', 'handled by Casey', ''),
(3, 'Whitney', 'I just had a chat from a lady that has spent an hour on the website trying to checkout however every time she would add items to her cart, once she tried to checkout, her cart would say 0 items.  I asked her to call in to place the order.', '', ''),
(4, '', '*I had a lady to call to place her order because she had been trying to add new recipients however it would not let her put any spaces between the first name for a few friends she had with 2 first names and it wouldn&#039;t let her add last names at all.', '', ''),
(5, '', 'I had another lady that said she could not delete or add any names to her Address Book.', '', ''),
(6, '', 'I had another lady call to place an order and after she added her items and chose to proceed to checkout and it just kept processing, would never let her get to checkout.', '', ''),
(7, '', 'Last but certainly not least, I had a man call just to tell me how horrible and user in-friendly our website is. (I have actually had several of those calls this week but wanted to keep the negativity to myself)! ', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publish`
--
ALTER TABLE `publish`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snapshot`
--
ALTER TABLE `snapshot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snips`
--
ALTER TABLE `snips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ux_emails`
--
ALTER TABLE `ux_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `publish`
--
ALTER TABLE `publish`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `snapshot`
--
ALTER TABLE `snapshot`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `snips`
--
ALTER TABLE `snips`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT for table `ux_emails`
--
ALTER TABLE `ux_emails`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
