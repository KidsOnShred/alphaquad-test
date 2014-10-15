# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 159.253.212.27 (MySQL 5.5.37-cll)
# Database: angeltes_main
# Generation Time: 2014-10-15 15:00:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table htmlOptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `htmlOptions`;

CREATE TABLE `htmlOptions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `linkId` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `htmlOptions` WRITE;
/*!40000 ALTER TABLE `htmlOptions` DISABLE KEYS */;

INSERT INTO `htmlOptions` (`id`, `linkId`, `type`, `value`)
VALUES
	(1,3,'class','active'),
	(2,6,'class','active');

/*!40000 ALTER TABLE `htmlOptions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table linkOptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `linkOptions`;

CREATE TABLE `linkOptions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `linkId` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `linkOptions` WRITE;
/*!40000 ALTER TABLE `linkOptions` DISABLE KEYS */;

INSERT INTO `linkOptions` (`id`, `linkId`, `type`, `value`)
VALUES
	(1,9,'rel','nofollow');

/*!40000 ALTER TABLE `linkOptions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table links
# ------------------------------------------------------------

DROP TABLE IF EXISTS `links`;

CREATE TABLE `links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;

INSERT INTO `links` (`id`, `parentId`, `label`, `url`, `enabled`)
VALUES
	(1,NULL,'First menu item','/',1),
	(2,NULL,'Second menu item','/second',1),
	(3,2,'Second-level menu item','/second/deeper-page',1),
	(4,2,'Special offers','/second/offers',1),
	(5,4,'Accessory 123 - was £9.95 now £7.50','/accessories/123',1),
	(6,4,'Product 456 - only £22.99','/products/456',1),
	(7,4,'Product 789 - only £37.99 (was £50)','/products/456',1),
	(8,4,'Save £5 on all products','/offers/expired',0),
	(9,NULL,'External link','http://www.google.co.uk',1),
	(10,NULL,'Last item',NULL,1);

/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
