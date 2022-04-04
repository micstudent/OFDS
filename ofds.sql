-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2021 at 07:48 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ofds`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Burgers', 'category_21_04_19_064821.jpeg', 'Yes', 'Yes'),
(2, 'Sandwiches', 'category_21_04_19_132339.jpeg', 'Yes', 'Yes'),
(3, 'Desserts', 'category_21_04_19_130904.jpeg', 'Yes', 'Yes'),
(4, 'Appetizers', 'category_21_04_19_160250.jpeg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(1, 'Perfect Veggie Burger', 'Bite into a burger that\'s stuffed with a veg patty, onion, tomato and lettuce in soft fluffy burger buns spread with kasundi mirch spread. Comes with wedges on the side. Indulge. Served along with Potato wedges', '3000.00', 'food_21_04_19_114826.jpeg', 1, 'Yes', 'Yes'),
(2, 'Peri-Peri Paneer Burger', 'A twist in itself, this delicious burger is loaded with ingredients to count on. Marinated cottage cheese steak is grilled to perfection, placed on a bed of fresh lettuce, onion, topped with ranch spread and cole slaw. Served with potato Crisps. Must-have. Served along with Potato wedges', '3000.00', 'food_21_04_19_123101.jpeg', 1, 'Yes', 'Yes'),
(3, 'Bun Omelette', 'Feeling lazy to head out? Stay in and order this hearty breakfast/snack. It comes with a fluffy masala omelette with chipotle mayo sandwiched between a fresh soft bun. Time to kick off!', '2500.00', 'food_21_04_19_123300.jpeg', 1, 'Yes', 'Yes'),
(4, 'BBQ-Chicken & Cheese Sandwich', 'Shredded chicken, seasoned with sauces, seasonings and cheese, between toasted, chipotle mayo spread brown bread slices is all that you would need for a scrumptious anytime-meal. Trust us, you\'ll love it.', '2700.00', 'food_21_04_19_125039.jpeg', 2, 'Yes', 'Yes'),
(5, 'Spinach Corn Sandwich', 'This sandwich has fresh spinach and sweet corn which are cooked in a cheesy sauce, stuffed between toasted brown bread with cheese slices giving you the best snack option anytime of the day!', '2500.00', 'food_21_04_19_125905.jpeg', 2, 'Yes', 'Yes'),
(6, 'Chicken Tikka Sandwich', 'Enjoy the best of fusion flavours in this flavoursome sandwich. Chicken pieces are flavoured with a in-house tikka masala and layered in a toasted brown bread with chipotle-mayo, purple cabbage, green peppers and carrot.', '2700.00', 'food_21_04_19_130041.jpeg', 2, 'Yes', 'Yes'),
(7, 'Black Forest Cake Slice', 'A bestseller and unique too, as our chef prepares it with traditional devilâ€™s food cake sponge, with layers of soft vanilla cream and barks of hand shaved Couverture chocolate for the best taste. Can be enjoyed as a lunch dessert, a perfect evening dessert or a late night dessert!!', '1900.00', 'food_21_04_19_154944.jpeg', 3, 'Yes', 'Yes'),
(8, 'Coffee Walnut Cake Slice', 'Freshly-ground coffee and crushed walnuts are folded into a creamy vanilla-flavored cake batter, topped with more walnuts for a crusty crown and baked until the comforting aromas from the oven come calling.', '1500.00', 'food_21_04_19_155233.jpeg', 3, 'Yes', 'Yes'),
(9, 'Red-Velvet Swiss Roll', 'Red-Velvet sponge smothered with Italian cream-cheese, whipped cream and white chocolate, rolled and packed in a box thatâ€™s simply YOURS for the taking.', '1500.00', 'food_21_04_19_155515.jpeg', 3, 'Yes', 'Yes'),
(10, 'Veg Spring Rolls', 'Experience a mouthful of fresh veggies and juicy cottage cheese rolled in wonton sheets as you bite into this hot and crunchy Appetizer. It is served with an Asian hot garlic sauce on the side.', '3500.00', 'food_21_04_19_160524.jpeg', 4, 'Yes', 'Yes'),
(11, 'Garlic Bread Supreme', 'This savoury snack has olives, chili peppers and oozy mozzarella cheese spread generously on toasted bread and baked. Simply finger-licking we say!', '3200.00', 'food_21_04_19_160716.jpeg', 4, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_address`) VALUES
(1, 'Coffee Walnut Cake Slice', '1500.00', 1, '1500.00', '2021-04-20 14:05:23', 'Delivered', 'John', '09774270432', 'insein, pauktaw gate'),
(2, 'Perfect Veggie Burger', '3000.00', 2, '6000.00', '2021-04-20 14:06:07', 'Delivering', 'Aung Min', '09774251358', 'Hlaing Tar Yar'),
(3, 'Spinach Corn Sandwich', '2500.00', 3, '7500.00', '2021-04-20 14:10:55', 'Ordered', 'Brang Seng', '09774201458', 'Hlaing Tar Yar, 1 hteik'),
(4, 'Veg Spring Rolls', '3500.00', 2, '7000.00', '2021-04-20 14:12:28', 'Cancelled', 'Tun Tun', '09757445785', 'Pazung Taung');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
