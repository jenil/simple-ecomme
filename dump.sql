# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.29)
# Database: idukan
# Generation Time: 2013-10-24 15:01:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tbl_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_category`;

CREATE TABLE `tbl_category` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL DEFAULT '',
  `cat_description` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`cat_id`),
  KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;



# Dump of table tbl_order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_order`;

CREATE TABLE `tbl_order` (
  `od_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `od_date` date NOT NULL,
  `od_status` enum('New','Shipped','Completed','Cancelled') NOT NULL DEFAULT 'New',
  `od_name` varchar(50) NOT NULL DEFAULT '',
  `od_address` varchar(100) NOT NULL DEFAULT '',
  `od_city` varchar(100) NOT NULL DEFAULT '',
  `od_postal_code` varchar(10) NOT NULL DEFAULT '',
  `od_cost` varchar(10) DEFAULT '0.00',
  PRIMARY KEY (`od_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_order` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;



# Dump of table tbl_order_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_order_item`;

CREATE TABLE `tbl_order_item` (
  `od_id` int(10) unsigned NOT NULL,
  `pd_id` int(10) unsigned NOT NULL,
  `od_qty` int(10) unsigned NOT NULL,
  PRIMARY KEY (`od_id`,`pd_id`),
  KEY `pd_id` (`pd_id`),
  CONSTRAINT `tbl_order_item_ibfk_1` FOREIGN KEY (`od_id`) REFERENCES `tbl_order` (`od_id`),
  CONSTRAINT `tbl_order_item_ibfk_2` FOREIGN KEY (`pd_id`) REFERENCES `tbl_product` (`pd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


# Dump of table tbl_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_product`;

CREATE TABLE `tbl_product` (
  `pd_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(10) unsigned NOT NULL,
  `pd_name` varchar(99) NOT NULL DEFAULT '',
  `pd_description` text NOT NULL,
  `pd_price` decimal(7,2) NOT NULL DEFAULT '0.00',
  `pd_qty` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pd_image` varchar(99) DEFAULT NULL,
  PRIMARY KEY (`pd_id`),
  KEY `cat_id` (`cat_id`),
  KEY `pd_name` (`pd_name`),
  CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;


# Dump of table tbl_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `user_email` varchar(25) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
