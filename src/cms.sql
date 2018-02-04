SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `admin` (`id`, `uname`, `password`) VALUES
(1, 'admin', 'admin');

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `author` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

INSERT INTO `comment` (`id`, `post_id`, `author`, `comment`, `timestamp`) VALUES
(1, 9, 't.pearlgirl@gmail.com', 'Hello there!\r\ntesting \r\n123', 1414343478),
(2, 9, 'mujtaba.ahmad91@gmail.com', 'Hi!', 1414343601),
(9, 16, 'sdfdf@sdds.csdfsdf ', 'zs', 1414610178),
(8, 16, 'sdfdf@sdds.csdfsdf', 'sdfdf', 1414610140),
(10, 16, 'sdfdf@sdds.cs', 's', 1414610209);

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) NOT NULL,
  `content` text NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

INSERT INTO `post` (`id`, `title`, `content`, `timestamp`) VALUES
(9, 'hello', 'yello\r\nbla bla\r\n', 1414590375),
(16, 'Hello World', 'hddsghisdhgsdifg', 1414590418),
(15, 'Image', '<img src="Balloon.jpg" height="300" width="500">', 1414395423);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
