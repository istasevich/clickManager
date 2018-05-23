# ************************************************************
# Sequel Pro SQL dump
# Версия 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: 127.0.0.1 (MySQL 5.5.5-10.2.9-MariaDB)
# Схема: clickManager
# Время создания: 2018-05-23 15:12:55 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы bad_domains
# ------------------------------------------------------------

CREATE TABLE `bad_domains` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Дамп таблицы click
# ------------------------------------------------------------

CREATE TABLE `click` (
  `id` char(32) NOT NULL DEFAULT '',
  `ua` varchar(255) NOT NULL DEFAULT '',
  `ip` int(11) NOT NULL,
  `ref` varchar(255) DEFAULT '',
  `param1` varchar(255) DEFAULT '',
  `param2` varchar(255) NOT NULL DEFAULT '',
  `error` int(10) unsigned NOT NULL,
  `bad_domain` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ua` (`ua`),
  KEY `ip` (`ip`),
  KEY `ref` (`ref`),
  KEY `param1` (`param1`),
  KEY `bad_domain` (`bad_domain`),
  KEY `uniqueSearch` (`ua`,`ip`,`ref`,`param1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
