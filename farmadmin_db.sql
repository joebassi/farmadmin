SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `farmadmin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `farmadmin_picks`
--

CREATE TABLE IF NOT EXISTS `farmadmin_picks` (
  `pick_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `pick_date` date NOT NULL,
  `pick_weight` float NOT NULL,
  `pick_flats` smallint(3) NOT NULL,
  `pick_user_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`pick_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `farmadmin_picks`
--

INSERT INTO `farmadmin_picks` (`pick_id`, `pick_date`, `pick_weight`, `pick_flats`, `pick_user_id`) VALUES
(1, '2016-05-01', 100, 10, 101),
(2, '2016-05-01', 200, 20, 102);

-- --------------------------------------------------------

--
-- Table structure for table `farmadmin_users`
--

CREATE TABLE IF NOT EXISTS `farmadmin_users` (
  `user_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `user_active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=103 ;

--
-- Dumping data for table `farmadmin_users`
--

INSERT INTO `farmadmin_users` (`user_id`, `user_name`, `user_active`) VALUES
(101, 'John Smith', 'yes'),
(102, 'Jane Doe', 'yes');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
