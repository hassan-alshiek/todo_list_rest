--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo_list`
--
DROP DATABASE IF EXISTS `todo_list`;
CREATE DATABASE IF NOT EXISTS `todo_list` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `todo_list`;

-- --------------------------------------------------------

--
-- Table structure for table `list_items`
--

DROP TABLE IF EXISTS `list_items`;
CREATE TABLE IF NOT EXISTS `list_items` (
  `list_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `done` enum('0','1') NOT NULL DEFAULT '0',
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`list_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `list_items` (`label`) VALUES
('Sample Item 1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
