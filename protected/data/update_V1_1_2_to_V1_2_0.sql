--
-- Database: `postimer`
--

-- --------------------------------------------------------

-- Use this file to update your existing POSTimer database to version 1_2_0

ALTER TABLE `pos` CHANGE `location` `location` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL; 
ALTER TABLE `pos` ADD `friendly` ENUM( 'No', 'Yes' ) NOT NULL DEFAULT 'No';