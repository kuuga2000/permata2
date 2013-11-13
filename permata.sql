-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 21. Oktober 2013 jam 04:38
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `permata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_bank_account`
--

CREATE TABLE IF NOT EXISTS `zpxf_bank_account` (
  `id_bank_acc` mediumint(8) NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(50) NOT NULL COMMENT 'Bank Account name',
  `name_account` varchar(50) NOT NULL,
  `id_account` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bank_acc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `zpxf_bank_account`
--

INSERT INTO `zpxf_bank_account` (`id_bank_acc`, `payment_method`, `name_account`, `id_account`) VALUES
(1, 'BCA', 'Pauli', '541345614');

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_city`
--

CREATE TABLE IF NOT EXISTS `zpxf_city` (
  `id_city` mediumint(5) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(35) NOT NULL,
  PRIMARY KEY (`id_city`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `zpxf_city`
--

INSERT INTO `zpxf_city` (`id_city`, `city_name`) VALUES
(1, 'DKI Jakarta'),
(2, 'Daerah Istimewa Yogyakarta (DIY)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_customer`
--

CREATE TABLE IF NOT EXISTS `zpxf_customer` (
  `id_customer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(35) NOT NULL,
  `postcode` varchar(15) NOT NULL,
  `email` varchar(128) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `newsletter` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `newsletter_date_add` datetime DEFAULT NULL,
  `account_balance` int(18) NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_customer`),
  KEY `customer_email` (`email`),
  KEY `customer_login` (`email`,`passwd`),
  KEY `id_customer_passwd` (`id_customer`,`passwd`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `zpxf_customer`
--

INSERT INTO `zpxf_customer` (`id_customer`, `firstname`, `lastname`, `phone`, `address`, `city`, `postcode`, `email`, `passwd`, `newsletter`, `newsletter_date_add`, `account_balance`, `enable`) VALUES
(1, '', '', '', '', '', '', 'andy@pixaal.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, NULL, 0, 0),
(2, '', '', '', '', '', '', 'andi@pixaal.com', '5aff8fdee9cfda08bca90f134f4dbd2f7277ce19', 0, NULL, 0, 0),
(3, 'M', 'M', '1541651', 'testrtgeart', 'Jkt', '15645', 'marcia@pixaal.com', '56cf3c36e640c5d936079621b2814fc33973d7d7', 0, NULL, 0, 0),
(4, '', '', '', '', '', '', 'chilimanjatroh@yahoo.co.id', '15a11154c974bfcee188e1f64d92f72a99e84761', 0, NULL, 0, 0),
(5, '', '', '', '', '', '', 'test@test.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 0, NULL, 0, 0),
(6, 'jes', 'jes', '3186123', 'dasgdahsgdajsd', 'gfjagfjhgff', '2134142', 'jessica@pixaal.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, NULL, 100, 0),
(7, 'Raidy', 'Kurniawan', '6285624632255', 'Jalan Soekarno htta', 'Jakarta', '402135', 'rai_zzzz@yahoo.co.id', '220c49455a75534b29ffb6e5ab422c6e821e43f4', 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_customer_address`
--

CREATE TABLE IF NOT EXISTS `zpxf_customer_address` (
  `id_address` mediumint(8) NOT NULL AUTO_INCREMENT,
  `id_customer` int(10) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(35) NOT NULL,
  `postcode` varchar(15) NOT NULL,
  PRIMARY KEY (`id_address`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `zpxf_customer_address`
--

INSERT INTO `zpxf_customer_address` (`id_address`, `id_customer`, `fname`, `lname`, `phone`, `address`, `city`, `country`, `postcode`) VALUES
(1, 1, 'Andy', 'Kenc', '555', '555', 'Tangerang', 'Indonesia', '555'),
(2, 2, 'alamat1', 'last alamat', '0123891238', 'Jl. Kucing Garong 100', 'Jakarta', 'Indonesia', '10029'),
(3, 3, 'm', 'm', '32465473', 'sfgnfzsgnj', 'hadfg', 'cxn', '14234'),
(4, 2, 'Kambing', 'Guling', '9923891238', 'Alamatnya si kambing guling', 'Jakarta', 'Indonesia', '100239'),
(5, 3, 'test', 'test', 'test', 'test', 'test', 'test', 'test'),
(6, 4, 'Philip', 'Richard', '415213153', 'Jakarta', 'jakarta', 'adsa', '1651'),
(7, 6, 'Pixaal', '1', '622158905917', 'dasdasasdasd', 'jakarta', 'Indonesia', '11620'),
(8, 6, 'asdad', 'asdda', '642374', 'meruya', 'afasifg', 'afafd', 'adfdaf'),
(9, 7, 'raidy', 'kurniawan', '6285624632255', 'asdcvcvxv', 'bandung', 'Indonesia', '231058');

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_customer_message`
--

CREATE TABLE IF NOT EXISTS `zpxf_customer_message` (
  `id_customer_message` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) DEFAULT NULL,
  `id_employee` int(10) unsigned DEFAULT NULL,
  `message` text NOT NULL,
  `file_name` varchar(18) DEFAULT NULL,
  `ip_address` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL,
  `private` tinyint(4) NOT NULL DEFAULT '0',
  `read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_customer_message`),
  KEY `id_customer_thread` (`id_customer`),
  KEY `id_employee` (`id_employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_customer_notif`
--

CREATE TABLE IF NOT EXISTS `zpxf_customer_notif` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_gallery`
--

CREATE TABLE IF NOT EXISTS `zpxf_gallery` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL DEFAULT '0',
  `post_id` bigint(20) NOT NULL DEFAULT '0',
  `size_id` tinyint(1) NOT NULL DEFAULT '1',
  `img` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `tx` text,
  `url` varchar(255) DEFAULT '',
  `position` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data untuk tabel `zpxf_gallery`
--

INSERT INTO `zpxf_gallery` (`id`, `page_id`, `post_id`, `size_id`, `img`, `title`, `tx`, `url`, `position`, `status`) VALUES
(24, 11, 26, 1, 'clearance.jpg', 'SALE', NULL, 'http://demopi.com/permata/product/featured/sale', 1, 1),
(25, 11, 27, 1, 'toto.jpg', 'TOTO', NULL, 'http://toto.com', 0, 1),
(26, 11, 27, 1, 'san-ei.jpg', 'San Ei', NULL, 'http://san-ei.com', 0, 1),
(27, 11, 27, 1, 'stiebel-eltron.jpg', 'Stiebel Eltron', NULL, 'http://stiebel-eltron.com', 0, 1),
(28, 11, 27, 1, 'tebisa.jpg', 'Tebisa', NULL, 'http://tebisa.com', 0, 1),
(29, 11, 27, 1, 'toto.jpg', NULL, NULL, '', 0, 1),
(31, 11, 26, 1, 'sale.jpg', 'PAKET', NULL, 'http://demopi.com/permata/product/featured/paket', 2, 1),
(32, 11, 26, 1, 'sale.jpg', 'PROMOTIONS', NULL, 'http://demopi.com/permata/product/featured/promotion', 3, 1),
(33, 11, 26, 1, 'sale.jpg', 'CLEARANCE', NULL, 'http://demopi.com/permata/product/featured/clearance', 4, 1),
(34, 11, 26, 1, 'sale.jpg', 'NEW', NULL, 'http://demopi.com/permata/product/featured/new', 5, 1),
(35, 11, 26, 1, 'clearance.jpg', NULL, NULL, 'http://demopi.com/permata/product/featured/clearance', 0, 1),
(36, 11, 26, 1, 'paket.jpg', '', NULL, '', 0, 1),
(37, 11, 27, 1, '', '', NULL, '', 0, 1),
(38, 11, 27, 1, '', '', NULL, '', 0, 1),
(39, 11, 27, 1, 'Cirrus-icon.png', NULL, NULL, '', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_gallery_size`
--

CREATE TABLE IF NOT EXISTS `zpxf_gallery_size` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `width` smallint(6) NOT NULL,
  `height` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `zpxf_gallery_size`
--

INSERT INTO `zpxf_gallery_size` (`id`, `width`, `height`) VALUES
(1, 941, 321),
(2, 62, 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_manufacturer`
--

CREATE TABLE IF NOT EXISTS `zpxf_manufacturer` (
  `id_manufacturer` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `logo` varchar(75) NOT NULL,
  `manuf_name` varchar(35) NOT NULL,
  `deskripsi` text NOT NULL,
  `deskripsi_enable` tinyint(1) NOT NULL,
  `meta_title` varchar(50) NOT NULL,
  `meta_description` varchar(75) NOT NULL,
  `meta_keyword` varchar(25) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  KEY `id_manufacturer` (`id_manufacturer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data untuk tabel `zpxf_manufacturer`
--

INSERT INTO `zpxf_manufacturer` (`id_manufacturer`, `alias`, `logo`, `manuf_name`, `deskripsi`, `deskripsi_enable`, `meta_title`, `meta_description`, `meta_keyword`, `enable`) VALUES
(1, 'toto', 'toto1.jpg', 'Toto', 'Desc of Toto', 0, '', '', '', 1),
(2, 'san-ei', 'san-ei.jpg', 'San Ei', 'Desc of San Ei', 0, '', '', '', 1),
(3, 'stiebel-eltron', 'stiebel-eltron.jpg', 'Steibel Eltron', 'Desc of Stiebel', 0, '', '', '', 1),
(4, 'tebisa', 'tebisa.jpg', 'Tebisa', 'Desc of Tebisa', 0, '', '', '', 1),
(8, 'ferolli', '', 'Ferolli', '0', 0, '', '', '', 1),
(9, 'watelier', '', 'Watelier', '0', 0, '', '', '', 1),
(10, 'eco', '', 'Eco', '0', 0, '', '', '', 1),
(11, 'inti-solar', '', 'Inti Solar', '0', 0, '', '', '', 1),
(12, 'ariston', '', 'Ariston', '0', 0, '', '', '', 1),
(13, 'nell', '', 'Nell', '0', 0, '', '', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_menus`
--

CREATE TABLE IF NOT EXISTS `zpxf_menus` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `owner` tinyint(4) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `position` int(11) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data untuk tabel `zpxf_menus`
--

INSERT INTO `zpxf_menus` (`id`, `owner`, `alias`, `name`, `icon`, `position`, `level`, `enable`) VALUES
(1, 0, 'catalog', 'Catalog', 'pages', 2, 0, 1),
(2, 0, 'home', 'Dashboard', 'home', 1, 0, 1),
(3, 0, 'pages', 'Pages', 'pages', 5, 0, 1),
(4, 0, 'report', 'Report', 'users', 4, 0, 0),
(5, 0, 'users', 'Users', 'users', 6, 0, 0),
(6, 0, 'transactions', 'Transactions', 'pages', 3, 0, 1),
(7, 1, 'product', 'Product', '', 1, 1, 1),
(8, 1, 'category', 'Category', '', 2, 1, 1),
(9, 1, 'brand', 'Brand', '', 3, 1, 1),
(10, 1, 'attribute', 'Attribute', '', 4, 1, 0),
(11, 6, 'transactions', 'Orders', '', 1, 1, 1),
(12, 6, 'vouchers', 'Vouchers', '', 2, 1, 0),
(13, 6, 'shipping_area', 'Shipping Area', '', 6, 1, 1),
(14, 6, 'customers', 'Customers', '', 4, 1, 1),
(15, 6, 'bank_account', 'Bank Account', '', 5, 1, 1),
(16, 3, 'pages', 'Pages', '', 1, 1, 1),
(18, 3, 'company_profile', 'Company Profile', '', 3, 1, 1),
(19, 3, 'cover', 'Cover', '', 4, 1, 1),
(20, 4, 'monthly_report', 'Monthly Report', '', 1, 1, 1),
(21, 5, 'users', 'Users', '', 1, 1, 1),
(22, 1, 'tag', 'Tag', '', 5, 1, 0),
(23, 7, 'information', 'Information', '', 1, 2, 1),
(24, 7, 'picture', 'Picture', '', 2, 2, 1),
(25, 7, 'product_attribute', 'Product Attribute', '', 3, 2, 0),
(26, 7, 'product_category', 'Product Category', '', 4, 2, 1),
(27, 7, 'price', 'Price & Tax', '', 5, 2, 1),
(28, 7, 'stock', 'Stock', '', 6, 2, 1),
(29, 5, 'users', 'Users', '', 1, 1, 0),
(30, 5, 'user_group', 'User Group', '', 2, 1, 0),
(31, 6, 'rewards', 'Rewards', '', 3, 1, 1),
(32, 0, 'settings', 'Settings', 'settings', 7, 0, 1),
(33, 32, 'newsletter', 'Newsletter', '', 1, 1, 1),
(34, 6, 'voucher', 'Vouchers', '', 2, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_order`
--

CREATE TABLE IF NOT EXISTS `zpxf_order` (
  `invoice_number` varchar(17) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `shipping_cost` int(11) NOT NULL,
  `total_orders` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `voucher_code` varchar(30) DEFAULT NULL,
  `credit_balance_used` int(11) DEFAULT NULL,
  `payment_value` int(11) DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_date` date NOT NULL,
  `bank_account` varchar(50) DEFAULT NULL,
  `name_account` varchar(50) NOT NULL,
  `id_account` varchar(50) NOT NULL,
  `shipping_date` date NOT NULL,
  `id_address` mediumint(8) NOT NULL,
  `waiting` tinyint(1) NOT NULL,
  `accept` tinyint(1) NOT NULL,
  `error` tinyint(1) NOT NULL,
  `deliver` tinyint(1) NOT NULL,
  `cancel` tinyint(1) NOT NULL,
  `flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`invoice_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `zpxf_order`
--

INSERT INTO `zpxf_order` (`invoice_number`, `id_customer`, `date`, `shipping_cost`, `total_orders`, `value`, `voucher_code`, `credit_balance_used`, `payment_value`, `payment_method`, `payment_date`, `bank_account`, `name_account`, `id_account`, `shipping_date`, `id_address`, `waiting`, `accept`, `error`, `deliver`, `cancel`, `flag`) VALUES
('13021217', 4, '2013-02-27 00:00:00', 0, 195000, 0, '', 0, 80000, 'transfer', '2013-02-27', 'dada', 'abcdef', 'sddad', '0000-00-00', 6, 1, 1, 0, 0, 0, 0),
('13021611', 2, '2013-02-26 00:00:00', 0, 292500, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 4, 0, 0, 0, 0, 0, 0),
('13022774', 3, '2013-02-26 00:00:00', 0, 2242500, 0, '', 0, 54364576, 'transfer', '2013-02-26', 'test', 'test', '324537658709', '0000-00-00', 5, 1, 0, 0, 0, 0, 0),
('13023271', 2, '2013-02-26 00:00:00', 0, 292500, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 4, 0, 0, 0, 0, 0, 0),
('13023285', 2, '2013-02-26 00:00:00', 0, 292500, 0, '', 0, NULL, 'paypal', '2013-02-26', '', '', '', '0000-00-00', 4, 1, 0, 0, 0, 0, 0),
('13023530', 2, '2013-02-26 00:00:00', 0, 292500, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 4, 0, 0, 0, 0, 0, 0),
('13023866', 2, '2013-02-20 00:00:00', 0, 97500, 0, '', 0, 9990000, 'transfer', '2013-02-20', 'nama bank', 'acc name', 'acc num', '0000-00-00', 2, 1, 1, 0, 0, 0, 0),
('13024893', 1, '2013-02-20 00:00:00', 0, 97500, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 1, 0, 0, 0, 0, 0, 0),
('13024939', 2, '2013-02-26 00:00:00', 0, 292500, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 4, 0, 0, 0, 0, 0, 0),
('13025273', 2, '2013-02-26 00:00:00', 0, 292500, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 4, 0, 0, 0, 0, 0, 0),
('13025620', 2, '2013-02-26 00:00:00', 0, 292500, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 4, 0, 0, 0, 0, 0, 0),
('13026353', 4, '2013-02-27 19:14:32', 0, 97500, 0, '', 0, 0, '0', '2013-02-27', 'fdgdfg', 'fdgd', 'dfgdf', '0000-00-00', 6, 1, 1, 0, 0, 0, 0),
('13027695', 3, '2013-02-26 00:00:00', 0, 487500, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 3, 0, 0, 0, 0, 0, 0),
('13031508', 7, '2013-03-04 15:45:32', 0, 390000, 0, '', 0, 54940, 'transfer', '2013-03-04', 'sczc', 'ra', '654084', '0000-00-00', 9, 1, 0, 0, 0, 0, 0),
('13031755', 2, '2013-03-04 13:46:22', 0, 97400, 0, '', 100, NULL, 'paypal', '0000-00-00', '', '', '', '0000-00-00', 2, 0, 0, 0, 0, 0, 0),
('13032336', 7, '2013-03-01 15:44:34', 0, 97500, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 9, 0, 0, 0, 0, 0, 0),
('13032779', 6, '2013-03-04 15:51:23', 0, 105000, 0, '', 0, NULL, 'paypal', '0000-00-00', '', '', '', '0000-00-00', 8, 0, 0, 0, 0, 0, 0),
('13032944', 2, '2013-03-01 12:41:33', 0, 97500, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 2, 0, 0, 0, 0, 0, 0),
('13033903', 7, '2013-03-04 15:51:42', 0, 105000, 0, '', 0, NULL, 'paypal', '0000-00-00', '', '', '', '0000-00-00', 9, 0, 0, 0, 0, 0, 0),
('13033906', 6, '2013-03-04 15:51:01', 0, 105000, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 7, 0, 0, 0, 0, 0, 0),
('13033912', 6, '2013-03-01 15:37:20', 0, 97500, 0, '', 0, 0, 'paypal', '2013-03-01', 'dsadad', 'asdsad', 'asda', '0000-00-00', 7, 1, 0, 0, 0, 0, 0),
('13033971', 2, '2013-03-01 12:45:36', 0, 97400, 0, '', 100, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 2, 0, 0, 0, 0, 0, 0),
('13034749', 6, '2013-03-01 15:57:02', 0, 105000, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 7, 0, 0, 0, 0, 0, 0),
('13035097', 6, '0000-00-00 00:00:00', 0, 97500, 0, '', 0, NULL, 'paypal', '0000-00-00', '', '', '', '2013-03-08', 7, 0, 1, 0, 0, 0, 0),
('13035374', 2, '2013-03-04 19:08:06', 0, 105000, 0, '', 0, 125000, 'transfer', '2013-03-04', 'payfrom', 'accname', 'accnum', '0000-00-00', 2, 1, 1, 0, 0, 0, 0),
('13035664', 6, '2013-03-05 09:22:22', 0, 209800, 0, 'E9F44946A60F733D1261FBC4A', 200, 0, 'transfer', '2013-03-05', 'ba', 'jes', 'jos', '2013-03-06', 7, 1, 1, 0, 0, 0, 0),
('13036679', 7, '2013-03-04 15:53:13', 0, 105000, 0, '', 0, NULL, 'paypal', '0000-00-00', '', '', '', '0000-00-00', 9, 0, 0, 0, 0, 0, 0),
('13036812', 6, '2013-03-04 15:49:02', 0, 105000, 0, '', 0, NULL, 'paypal', '0000-00-00', '', '', '', '0000-00-00', 7, 0, 0, 0, 0, 0, 0),
('13036902', 7, '2013-03-04 16:13:01', 0, 105000, 0, '', 0, NULL, 'paypal', '2013-03-04', '', '', '', '0000-00-00', 9, 1, 0, 0, 0, 0, 0),
('13037381', 7, '2013-03-04 15:49:44', 0, 105000, 0, '', 0, NULL, 'paypal', '0000-00-00', '', '', '', '0000-00-00', 9, 0, 0, 0, 0, 0, 0),
('13037713', 7, '2013-03-04 15:44:28', 0, 487500, 0, '', 0, 123123123, 'transfer', '2013-03-04', 'adasd', 'assd', '12312', '0000-00-00', 9, 1, 0, 0, 0, 0, 0),
('13037739', 6, '2013-03-01 15:36:18', 0, 97500, 0, '', 0, NULL, 'paypal', '0000-00-00', '', '', '', '0000-00-00', 7, 0, 0, 0, 0, 0, 0),
('13037875', 7, '2013-03-01 15:49:49', 0, 975000, 0, '', 0, NULL, 'paypal', '0000-00-00', '', '', '', '0000-00-00', 9, 0, 0, 0, 0, 0, 0),
('13037957', 6, '2013-03-01 15:35:30', 0, 390000, 0, '', 0, NULL, 'transfer', '0000-00-00', '', '', '', '0000-00-00', 7, 0, 0, 0, 0, 0, 0),
('13038165', 6, '2013-03-01 15:36:13', 0, 97500, 0, '', 0, NULL, 'paypal', '0000-00-00', '', '', '', '0000-00-00', 7, 0, 0, 0, 0, 0, 0),
('13038482', 7, '2013-03-01 15:53:56', 0, 975000, 0, '', 0, NULL, 'paypal', '0000-00-00', '', '', '', '0000-00-00', 9, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_order_item`
--

CREATE TABLE IF NOT EXISTS `zpxf_order_item` (
  `id_order_item` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(17) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_prod_stock` mediumint(9) NOT NULL,
  `base_price` int(18) NOT NULL,
  `tax` smallint(3) NOT NULL,
  `disc` int(15) NOT NULL,
  `disc_type` varchar(15) NOT NULL,
  `qty` smallint(5) NOT NULL,
  PRIMARY KEY (`id_order_item`),
  KEY `order` (`invoice_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data untuk tabel `zpxf_order_item`
--

INSERT INTO `zpxf_order_item` (`id_order_item`, `invoice_number`, `id_product`, `id_prod_stock`, `base_price`, `tax`, `disc`, `disc_type`, `qty`) VALUES
(1, '13024893', 5, 0, 195000, 0, 50, 'Percent', 1),
(2, '13023866', 1, 0, 195000, 0, 50, 'Percent', 1),
(3, '13027695', 5, 0, 195000, 0, 50, 'Percent', 5),
(4, '13022774', 1, 0, 195000, 0, 50, 'Percent', 19),
(5, '13022774', 5, 0, 195000, 0, 50, 'Percent', 4),
(6, '13021611', 4, 0, 195000, 0, 50, 'Percent', 3),
(7, '13023530', 4, 0, 195000, 0, 50, 'Percent', 3),
(8, '13025620', 4, 0, 195000, 0, 50, 'Percent', 3),
(9, '13023271', 4, 0, 195000, 0, 50, 'Percent', 3),
(10, '13024939', 4, 0, 195000, 0, 50, 'Percent', 3),
(11, '13023285', 4, 0, 195000, 0, 50, 'Percent', 3),
(12, '13021217', 4, 0, 195000, 0, 50, 'Percent', 2),
(13, '13026353', 2, 0, 195000, 0, 50, 'Percent', 1),
(14, '13032944', 2, 0, 195000, 0, 50, 'Percent', 1),
(15, '13033971', 2, 0, 195000, 0, 50, 'Percent', 1),
(16, '13037957', 1, 0, 195000, 0, 50, 'Percent', 1),
(17, '13037957', 5, 0, 195000, 0, 50, 'Percent', 3),
(18, '13038165', 1, 0, 195000, 0, 50, 'Percent', 1),
(19, '13035097', 1, 0, 195000, 0, 50, 'Percent', 1),
(20, '13037739', 1, 0, 195000, 0, 50, 'Percent', 1),
(21, '13033912', 1, 0, 195000, 0, 50, 'Percent', 1),
(22, '13032336', 1, 0, 195000, 0, 50, 'Percent', 1),
(23, '13037875', 1, 0, 195000, 0, 50, 'Percent', 1),
(24, '13037875', 2, 0, 195000, 0, 50, 'Percent', 9),
(25, '13038482', 1, 0, 195000, 0, 50, 'Percent', 1),
(26, '13038482', 2, 0, 195000, 0, 50, 'Percent', 9),
(27, '13034749', 10, 0, 150000, 10, 30, 'Percent', 1),
(28, '13031755', 5, 0, 195000, 0, 50, 'Percent', 1),
(29, '13037713', 1, 0, 195000, 0, 50, 'Percent', 2),
(30, '13037713', 5, 0, 195000, 0, 50, 'Percent', 3),
(31, '13031508', 5, 0, 195000, 0, 50, 'Percent', 4),
(32, '13036812', 10, 0, 150000, 10, 30, 'Percent', 1),
(33, '13037381', 10, 0, 150000, 10, 30, 'Percent', 1),
(34, '13033906', 10, 0, 150000, 10, 30, 'Percent', 1),
(35, '13032779', 10, 0, 150000, 10, 30, 'Percent', 1),
(36, '13033903', 10, 0, 150000, 10, 30, 'Percent', 1),
(37, '13036679', 10, 0, 150000, 10, 30, 'Percent', 1),
(38, '13036902', 10, 0, 150000, 10, 30, 'Percent', 1),
(39, '13035374', 10, 0, 150000, 10, 30, 'Percent', 1),
(40, '13035664', 11, 0, 200000, 0, 10, 'Percent', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_pages`
--

CREATE TABLE IF NOT EXISTS `zpxf_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL DEFAULT '0',
  `alias` varchar(100) NOT NULL COMMENT 'al',
  `title` varchar(100) NOT NULL COMMENT 'ti',
  `icon` varchar(255) DEFAULT NULL COMMENT 'ic',
  `image` varchar(75) NOT NULL COMMENT 'im',
  `tx` text COMMENT 'tx',
  `meta_title` varchar(150) DEFAULT NULL COMMENT 'mt',
  `meta_keywords` varchar(150) DEFAULT NULL COMMENT 'mk',
  `meta_description` varchar(150) DEFAULT NULL COMMENT 'md',
  `template` varchar(100) NOT NULL,
  `edit` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'view on backend',
  `position` int(11) NOT NULL,
  `navigation` varchar(10) DEFAULT '',
  `latitude` varchar(100) DEFAULT NULL COMMENT 'lt',
  `form_enable` varchar(75) NOT NULL,
  `status_lock` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'use for backend for edit and add new image',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `zpxf_pages`
--

INSERT INTO `zpxf_pages` (`id`, `owner`, `alias`, `title`, `icon`, `image`, `tx`, `meta_title`, `meta_keywords`, `meta_description`, `template`, `edit`, `position`, `navigation`, `latitude`, `form_enable`, `status_lock`, `status`) VALUES
(11, 0, 'home', 'Home', '', '.', '0', '', 'Permata keywords for homepage', 'Permata description for homepage', 'home', 2, 1, 'top,bottom', '0', 'list,ti,ic,mt,mk,md', 0, 1),
(12, 0, 'product', 'Product', 'Product', '.', '0', 'Permata - Product', 'Permata keywords for Product Page', 'Permata description for Product Page', 'product', 0, 2, 'top,bottom', '0', 'list,ti,ic,mt,mk,md,im', 1, 1),
(13, 0, 'faq', 'FAQ', NULL, '', NULL, 'Permata - FAQ', 'Permata keywords for FAQ Page', 'Permata description for FAQ Page', 'faq', 1, 3, 'top,bottom', '', 'list,ti,ic,mt,mk,md', 1, 1),
(14, 0, 'contact', 'Contact Us', 'CONTACT US', '.', '<p>Jalan Panglima Polim Raya no 93</p>\n<p>Kebayoran Baru - Jakarta Selatan</p>\n<p>DKI Jakarta - Indonesia 12160</p>\n<p>&nbsp;</p>\n<p>E-mail: sales@permata.co.id</p>\n<p>Phone: +62 21 725 6076</p>\n<p>Fax: +62 21 739 2656</p>', 'Permata - Contact', 'Permata keywords for Contact Page', 'Permata description for Contact Page', 'contact', 0, 6, 'top,bottom', '-6.25167,106.79745', 'list,ti,ic,mt,mk,md,lt,tx', 1, 1),
(15, 0, 'account', 'Account', '0', '.', '0', 'Permata - Account', 'Permata keywords for Account Page', 'Permata keywords for Account Page', 'account', 0, 5, 'bottom', '', 'list,mt,mk,md', 0, 0),
(16, 0, 'tnc', 'Syarat & Ketentuan', NULL, '', 'Shu Uemura has adopted this Privacy Statement in order to inform you of its policies with respect to information collected from this website. Your use of this website constitutes your acceptance of this Privacy Statement and your consent to the practices it describes.<br />\r\n			<br />\r\n			Automatic Collection of Anonymous Information<br />\r\n			When you visit the Shu Uemura website, like when you visit most other websites, certain anonymous information about your visit is automatically logged, which may include information about the type of browser you use, the server name and IP address through which you access the internet (such as \\"aol.com\\" or \\"earthlink.net\\"), the date and time you access the site, the pages you access while at the Shu Uemura website, and the internet address of the website, if any, from which you linked directly to the Shu Uemura site. This information is not personally identifiable.<br />\r\n			<br />\r\n			Personally Identifiable Information<br />\r\n			Personally Identifiable Information is any information that concerns you individually and would permit someone to contact you, for example, your name, address, telephone/fax number, social security number, email address or any information you submitted to shuuemura-usa.com that identifies you individually. shuuemura-usa.com will not collect any personally identifiable information about you unless you provide it. Therefore, if you do not want shuuemura-usa.com to obtain any personally identifiable information about you, do not submit it. You can visit and browse the Shu Uemura website without revealing personally identifiable information about yourself. You may also choose to disclose personally identifiable information about yourself, which may be maintained as described below. shuuemura-usa.com may collect personally identifiable information about you from its website by methods such as the following:<br />\r\n			<br />\r\n			Registration Forms - If you are offered the opportunity to enter a promotion, to become a registered user of the Shu Uemura website, or to opt-in to receive Shu Uemura information through another site, you must apply by filling out the registration form on the site. This form requires certain personally identifiable information that may include, without limitation, your name, email address, postal address, telephone number, areas of interest, product usage, and/or a unique individual password.<br />\r\n			<br />\r\n			Transactions and Activity - If you become a registered user or if you conduct transactions through the Shu Uemura website, shuuemura-usa.com collects information about the transactions you engage in while on the website and your other activity on the site. This information may include, without limitation, areas of the website that you visit, transaction type, content that you view, download or submit, transaction amount, payment, shipping and billing information as well as the nature, quantity and price of the goods or services you exchange and the individuals or entities with whom you communicate or transact business.<br />\r\n			<br />\r\n			Email and Other Voluntary Communications - You may also choose to communicate with shuuemura-usa.com through email, via our website, by telephone, in writing, or though other means. We collect the information in these communications, and such information may be personally identifiable.<br />', 'Permata - Syarat & Ketentuan', 'Permata keywords for TNC Page', 'Permata keywords for TNC Page', 'tnc', 0, 4, 'top,bottom', '', 'list,ti,ic,mt,mk,md,tx', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_pcomment`
--

CREATE TABLE IF NOT EXISTS `zpxf_pcomment` (
  `id_comment` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `id_customer` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `enable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_posts`
--

CREATE TABLE IF NOT EXISTS `zpxf_posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `owner` bigint(20) NOT NULL DEFAULT '0',
  `alias` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `dt` datetime DEFAULT NULL,
  `tx` text,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_keywords` varchar(150) DEFAULT NULL,
  `meta_description` varchar(150) DEFAULT NULL,
  `orderby` varchar(10) NOT NULL DEFAULT 'position',
  `position` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data untuk tabel `zpxf_posts`
--

INSERT INTO `zpxf_posts` (`id`, `page_id`, `owner`, `alias`, `title`, `img`, `dt`, `tx`, `meta_title`, `meta_keywords`, `meta_description`, `orderby`, `position`, `status`) VALUES
(7, 13, 0, 'when-can-i-expect-to-get-my-jewelry', 'When can I expect to get my jewelry?', '', '2013-02-21 16:12:07', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>', '0', '0', '0', 'dt', 4, 1),
(9, 13, 0, 'what-are-my-shipping-options', 'What are my shipping options?', NULL, '2013-02-12 10:35:05', '<p><span style="color: #8b8b8b; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px;">Currently, all orders are shipped Priority Mail through the United States Postal Service. Once your order has shipped, you''ll be notified by email with a shipment confirmation and tracking number. If you need faster service, contact info@rfrmjewelry.com before placing your order. A $10 service fee will be applied to any orders needing a speedy delivery.</span></p>', '0', '0', '0', 'position', 1, 1),
(14, 13, 0, 'can-you-make-it-again', 'Can you make it again?', NULL, '2013-02-12 10:30:58', '<p><span>Because the materials used are found in the most random places and come by the handful, most of the jewelry cannot be reproduced. However, Kim can make something similar using different materials and set up a custom order. Contact info@rfrmjewelry.com and include a link to reference the jewelry you like.</span></p>', '0', '0', '0', 'position', NULL, 1),
(15, 13, 0, 'when-can-i-expect-to-get-my-jewelry', 'When can I expect to get my jewelry?', NULL, '2013-02-12 10:32:55', '<p><span style="color: #8b8b8b; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px;">Once your payment has been received, your jewelry will be shipped within 1-2 business days via USPS Priority Mail. Orders within the United States should be received within 2-7 business days after it''s been shipped.</span></p>', '0', '0', '0', 'position', NULL, 1),
(16, 13, 0, 'can-you-make-it-again_', 'What are my shipping options?', NULL, '2013-02-12 10:35:40', '<p><span style="color: #8b8b8b; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px;">Because the materials used are found in the most random places and come by the handful, most of the jewelry cannot be reproduced. However, Kim can make something similar using different materials and set up a custom order. Contact info@rfrmjewelry.com and include a link to reference the jewelry you like.</span></p>', '0', '0', '0', 'position', NULL, 0),
(26, 11, 0, 'home-slider', 'Home Slider', NULL, NULL, NULL, NULL, NULL, NULL, 'position', NULL, 0),
(27, 11, 0, 'home-distributor', 'Distributor', NULL, NULL, NULL, NULL, NULL, NULL, 'position', NULL, 1),
(30, 13, 0, 'new-question', 'new question ', NULL, '2013-02-26 15:26:50', '<p>new answer&nbsp;</p>', '0', '0', '0', 'position', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_product`
--

CREATE TABLE IF NOT EXISTS `zpxf_product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `id_manufacturer` int(11) NOT NULL,
  `alias` varchar(35) NOT NULL,
  `code` varchar(15) NOT NULL,
  `name` varchar(25) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_disc` smallint(3) NOT NULL,
  `brand_name` varchar(25) NOT NULL,
  `date_release` date NOT NULL,
  `hotdeal` tinyint(1) NOT NULL,
  `paket` tinyint(1) NOT NULL,
  `promotion` tinyint(1) NOT NULL,
  `clearance` tinyint(1) NOT NULL,
  `new` tinyint(1) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_product`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=189 ;

--
-- Dumping data untuk tabel `zpxf_product`
--

INSERT INTO `zpxf_product` (`id_product`, `id_manufacturer`, `alias`, `code`, `name`, `deskripsi`, `id_disc`, `brand_name`, `date_release`, `hotdeal`, `paket`, `promotion`, `clearance`, `new`, `enable`) VALUES
(1, 3, 'closet-1', '19219', 'Closet 1', '<p>Lorem ipsum dolor sit amet, consectetur scing elit. Vestibulum sem risus, fermentum eu, semper at nisi. Etiam elementum condimentum nisl nec accumsan. In vel porttitor mauris. Mermentum eu, semper at nisi. <br /> <br /> &nbsp;<br /> &bull; &nbsp; &nbsp;Material: Lorem Ipsum<br /> &bull; &nbsp; &nbsp;Features includes<br /> &bull; &nbsp; &nbsp;Measurements - Bust: 100cm | Waist: 82cm<br /> &bull; &nbsp; &nbsp;Model''s height is 177cm, 53 kg<br /><br />&nbsp;</p>', 50, 'Steibel Eltron', '0000-00-00', 1, 1, 1, 1, 1, 1),
(2, 1, 'bathub-1', '19220', 'Bathub 1', '<p>Lorem ipsum dolor sit amet, consectetur scing elit. Vestibulum sem risus, fermentum eu, semper at nisi. Etiam elementum condimentum nisl nec accumsan. In vel porttitor mauris. Mermentum eu, semper at nisi. <br /> <br /> &nbsp;<br /> &bull; &nbsp; &nbsp;Material: Lorem Ipsum<br /> &bull; &nbsp; &nbsp;Features includes<br /> &bull; &nbsp; &nbsp;Measurements - Bust: 100cm | Waist: 82cm<br /> &bull; &nbsp; &nbsp;Model''s height is 177cm, 53 kg<br /><br />&nbsp;</p>', 50, 'Toto', '0000-00-00', 1, 0, 1, 1, 0, 1),
(3, 0, 'closet-2', '19221', 'Closet 2', '<p>Lorem ipsum dolor sit amet, consectetur scing elit. Vestibulum sem risus, fermentum eu, semper at nisi. Etiam elementum condimentum nisl nec accumsan. In vel porttitor mauris. Mermentum eu, semper at nisi. <br /> <br /> &nbsp;<br /> &bull; &nbsp; &nbsp;Material: Lorem Ipsum<br /> &bull; &nbsp; &nbsp;Features includes<br /> &bull; &nbsp; &nbsp;Measurements - Bust: 100cm | Waist: 82cm<br /> &bull; &nbsp; &nbsp;Model''s height is 177cm, 53 kg<br /><br />&nbsp;</p>', 50, '', '2013-01-01', 1, 0, 1, 1, 1, 1),
(4, 4, 'hanger-1', '19222', 'Hanger 1', 'Lorem ipsum dolor sit amet, consectetur scing elit. Vestibulum sem risus, fermentum eu, semper at nisi. Etiam elementum condimentum nisl nec accumsan. In vel porttitor mauris. Mermentum eu, semper at nisi.\n<br/>\n<br/>\n&nbsp;<br/>\n&bull; &nbsp; &nbsp;Material: Lorem Ipsum<br/>\n&bull; &nbsp; &nbsp;Features includes<br/>\n&bull; &nbsp; &nbsp;Measurements - Bust: 100cm | Waist: 82cm<br/>\n&bull; &nbsp; &nbsp;Model&#39;s height is 177cm, 53 kg', 50, '', '2013-01-01', 0, 1, 0, 1, 0, 1),
(5, 3, 'keran-1-1', '19223', 'Keran 1', '<p>Lorem ipsum dolor sit amet, consectetur scing elit. Vestibulum sem risus, fermentum eu, semper at nisi. Etiam elementum condimentum nisl nec accumsan. In vel porttitor mauris. Mermentum eu, semper at nisi. <br /> <br /> &nbsp;<br /> &bull; &nbsp; &nbsp;Material: Lorem Ipsum<br /> &bull; &nbsp; &nbsp;Features includes<br /> &bull; &nbsp; &nbsp;Measurements - Bust: 100cm | Waist: 82cm<br /> &bull; &nbsp; &nbsp;Model''s height is 177cm, 53 kg</p>', 50, 'Steibel Eltron', '2013-01-01', 0, 0, 1, 1, 1, 1),
(6, 0, 'washtafel-1', '19224', 'Washtafel 1', '<p>Lorem ipsum dolor sit amet, consectetur scing elit. Vestibulum sem risus, fermentum eu, semper at nisi. Etiam elementum condimentum nisl nec accumsan. In vel porttitor mauris. Mermentum eu, semper at nisi. <br /> <br /> &nbsp;<br /> &bull; &nbsp; &nbsp;Material: Lorem Ipsum<br /> &bull; &nbsp; &nbsp;Features includes<br /> &bull; &nbsp; &nbsp;Measurements - Bust: 100cm | Waist: 82cm<br /> &bull; &nbsp; &nbsp;Model''s height is 177cm, 53 kg<br /><br />&nbsp;</p>', 50, '', '2013-01-01', 0, 0, 0, 1, 1, 1),
(7, 1, 'test', '1856924', 'test', '<p>test descp</p>', 0, 'Toto', '2013-02-21', 0, 0, 0, 0, 1, 1),
(8, 1, 'watch-nike', 'TWSTGCC', 'Watch Nike', '<p>adaer</p>', 0, 'Toto', '0000-00-00', 1, 1, 1, 0, 0, 1),
(9, 1, 'watch-nike-1', '19212112', 'Watch Nike', '<p>eeq</p>', 0, 'Toto', '0000-00-00', 1, 1, 1, 0, 0, 1),
(10, 2, 'test-jes', '1234567', 'Test jes', '<p><strong style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Lorem Ipsum</strong><span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 0, 'San Ei', '0000-00-00', 1, 0, 0, 0, 0, 1),
(11, 1, 'rubbermaid-1', '12345678', 'Rubbermaid', '<p><strong style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Lorem Ipsum</strong><span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 1, 0, 1),
(12, 1, 'wqeqweq', 'rertyy', 'wqeqweq', '<p>weqweqwe</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(13, 1, 'r4r235', 'erw45', 'r4r235', '<p>afafd</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(14, 1, 'cw825j-1', 'CW825JW/FZ-W', 'CW825J', '<p>The "Vision" low silhouette full-sized, one-piece toilet is equipped with the J-Max flushing system. This revolutionary flush is&nbsp;capable of 6-liters per flush with a Tornado II Siphonic Flush that perfectly cleans the bowl with&nbsp;every flush. It''s rapid flushing capable, so there is no need to wait for the&nbsp;tank to refill after every flush. Sleek contemporary design with flush chrome&nbsp;button, and a fully covered trapway makes cleaning simple. It comes standard with a generously sized solid Duroplast Seat &amp; Cover.</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(15, 1, 'c436', 'C436W/FT-W', 'C436', '<div id="product_content_description" style="padding-top: 10px;">The "Superior" toilet has the classic iconic low silhouette one piece toilet shape that is instantly recognizable by interior designers everywhere The efficient 13 liter siphon vortex flush is whisper quiet while generating a cleaning vortex that perfectly cleans the bowl with every flush.</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(16, 1, 'cw823j', 'CW823JW/FZ-W', 'CW823J', '<p>This "Avante" one piece toilet is equipped with a compact and efficient eco friendly 6L gravity flush system Combined with the uniquely designed bowl and trapway it generates a Tornado Siphonic Flush that perfectly cleans the bowl every flush. Sleek contemporary design with a fully covered trapway makes cleaning simple. It comes standard with a solid Duroplast Seat &amp; Cover.</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(17, 1, 'cw823nj', 'cw823nj/823-81w', 'CW823NJ', '<p>This "Avante" one piece toilet is equipped with a compact and efficient eco friendly 6L gravity flush system Combined with the uniquely designed bowl and trapway it generates a Tornado Siphonic Flush that perfectly cleans the bowl every flush. Sleek contemporary design with a fully covered trapway makes cleaning simple. It comes standard with a solid Duroplast Seat &amp; Cover.</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(18, 1, 'cw914j-1', 'CW914J/296W/FZ-', 'CW914J', '<p>This one piece toilet is the contemporary compact water saving toilet in our range, equipped with 6L G-Max gravity flush system. Sleek contemporary design with a fully covered trapway makes cleaning simple. Standard elongated Solid Duroplast Seat and Cover.</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(19, 1, 'cw840j-1', 'CW840JW/F-W', 'CW840J', '<p>The fruit of our collaboration with renowned&nbsp;Indonesian product designer Alvin Tjitrowirjo is this sleek modern one piece toilet. &nbsp; Smooth flowing lines which is Alvin''s signature look is artfully translated into ceramic form creating this masterpiece of one piece toilet design.</p>\n<p>This generously sized&nbsp;toilet&nbsp;is equipped with TOTO''s latest water saving Eco Flush 4.5litres and 3 litres flushing system. &nbsp;A pneumatic flush valve with buttons on the side for a more comfortable, ergonomic operation,&nbsp;</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(20, 1, 'cw894j-1', 'CW894J/295W/FT-', 'CW894J', '<p>The "Prominence" one piece toilet with its smooth flowing lines exudes the charm of a classic contemporary furniture. It is equipped with a 6L G-Max gravity flush system.</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(21, 1, 'cw868nj', 'CW868NJW/FZ-W', 'CW868NJ', '<p>The design of the "Omni" toilet is dominated by clean smooth geometric line, it''s a simple compact versatile form that blends with any interior be it classic or modern. It''s equipped with a water saving 6/3L dual flush that can save you thousands of liters of water annually.</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(22, 1, 'cw868npj-1', 'CW868NPJW/FZ-W', 'CW868NPJ', '<p>The design of the "Omni" toilet is dominated by clean smooth geometric line, it''s a simple compact versatile form that blends with any interior be it classic or modern. It''s equipped with a water saving 6/3L dual flush that can save you thousands of liters of water annually.</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(23, 1, 'cw867nj-1', 'CW867NJ/241W/FZ', 'CW867NJ', '<p>The design of the "Omni" toilet is dominated by clean smooth geometric line, it''s a simple compact versatile form that blends with any interior be it classic or modern. It''s equipped with a water saving 6/3L dual flush that can save you thousands of liters of water annually.</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(24, 1, 'cw630j', 'CW630JW/F-W', 'CW630J', '<p>Dual Flush One Piece Toilet (4,5/3 liters)</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(25, 1, 'cw811pj-sw811jp-2', 'CW811PJWS-W', 'CW811PJ / SW811JP ', '<p>"Le Muse"?&nbsp;Close Coupled?&nbsp;Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(26, 1, 'cw811pj-sw811jp-1', 'CW811PJW/F-W', 'CW811PJ / SW811JP ', '<p>"Le Muse"?&nbsp;Close Coupled?&nbsp;Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(27, 1, 'cw826j-sw826jp-1', 'CW826JW/F-W', 'CW826J / SW826JP', '<p>The "Vision" close coupled toilet inherits the contemporary design of the series, and the generous proportions will create a statuesque presence in the bathroom. Fully covered trapway and a tank that is flush with the body, makes cleaning simple.</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(28, 1, 'cw821j-sw821jp-1', 'CW821JW/F-W', 'CW821J / SW821JP', '<p>"Avante" Toilet</p>\n<p>6/3 L Dual Flush*.</p>\n<p>Solid Duroplast Seat &amp; Cover.</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(29, 1, 'cw801pj-sw801jp-1', 'CW801PJWS-W', 'CW801PJ / SW801JP', '<div id="product_content_description" style="padding-top: 10px;">Dual Flush Toilet</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(30, 1, 'cw801pj-sw801jp', 'CW801PJWS-W / S', 'CW801PJ / SW801JP', '<div id="product_content_description" style="padding-top: 10px;">Dual Flush Toilet</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(31, 1, 'cw880pj-sw880jp', 'CW880PJW/F-W', 'CW880PJ / SW880JP', '<div id="product_content_description" style="padding-top: 10px;">Dual Flush Toilet</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(32, 1, 'cw880pj-sw880jp-1', 'CW880PJWS-W', 'CW880PJ / SW880JP ', '<div id="product_content_description" style="padding-top: 10px;">Dual Flush Toilet</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(33, 1, 'cw632pj-sw632jp', 'CW632PJW/F-V3', 'CW632PJ / SW632JP', '<p>Dual Flush Toilet (6/3 liters)</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(34, 1, 'cw862nj-sw862jp', 'CW862NJW/F-W', 'CW862NJ / SW862JP', '<p>"Omni" Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(35, 1, 'cw862npj-sw862jp', 'CW862NPJW/F-W', 'CW862NPJ / SW862JP', '<p>"Omni" Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(36, 1, 'cw860nj-sw861jp', 'CW860NJW/F-W', 'CW860NJ / SW861JP', '<p>Omni Toilet</p>\n<p>6/3 L Dual Flush</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(37, 1, 'cw631j-sw631jp', 'CW631JW/F-W', 'CW631J / SW631JP', '<p>Dual Flush Toilet (4,5/3 liters)</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(38, 1, 'cw668j-sw668j', 'CW668JW/F-W', 'CW668J / SW668J', '<p>"Memory" Toilet (6 liters Single Flush)</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(39, 1, 'c704l-sw784jp', 'C704LW/F-W', 'C704L / SW784JP ', '<p>6 L Siphonic Flush</p>\n<p>For The Disabled</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(40, 1, 'cw704j-sw784jp', 'CW704JW/F-W', 'CW704J / SW784JP ', '<p>Single Flush Toilet (6 liters)</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(41, 1, 'cw661jt1-sw784', 'CW661JT1W/F-W', 'CW661JT1 / SW784', '<p>Dual Flush Toilet (6/3 liters)</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(42, 1, 'cw661jt1-sw661jp', 'CW661JT1W/F-W /', 'CW661JT1 / SW661JP ', '<p>Dual Flush Toilet (6/3 liters)</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(43, 1, 'cw702j-sw784jp', 'CW702JW/F-W', 'CW702J / SW784JP ', '<p>Single Flush Toilet (6 liters)</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(44, 1, 'cw421j-sw420jp-1', 'CW421JW/F-W', 'CW421J / SW420JP', '<p>Dual Flush Toilet (4,5/3 liters)</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(45, 1, 'cw660nj-sw660j', 'CW660NJW/F-W', 'CW660NJ / SW660J', '<p>Dual Flush Toilet (4.5/3 liters)</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(46, 1, 'cw812j', 'CW812JW/F-W', 'CW812J ', '<p>"Le Muse" Wall Hung Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(47, 1, 'cw800j', 'CW800JW/F-W', 'CW800J', '<p>Wall Hung Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(48, 1, 'cw800j-1', 'CW800 JW/F-W', 'CW800J', '<p>Wall Hung Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(49, 1, 'cw813pj', 'CW813PJW/F-W', 'CW813PJ ', '<p>"Le Muse" Wall Faced Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(50, 1, 'cw822nj', 'CW822NJWS-W', 'CW822NJ', '<p>"Avante" Wall Hung Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(51, 1, 'cw875nj', 'CW875NJ-W', 'CW875NJ', '<p>"Omni" Wall Hung Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(52, 1, 'cw620j', 'CW620J-W', 'CW620J', '<p>6 L Single Flush</p>\n<p>Solid Duroplast Seat &amp; Cover</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(53, 1, 'cw620j-1', 'CW620J- W', 'CW620J', '<p>6 L Single Flush</p>\n<p>Solid Duroplast Seat &amp; Cover</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(54, 1, 'cw824pj', 'CW824PJW/F-W', 'CW824PJ', '<p>"Avante" Wall Faced Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(55, 1, 'cw863npj', 'CW863NPJW/F-W', 'CW863NPJ', '<p>"Omni" Wall Faced Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(56, 1, 'cw863npj-1', 'CW863NPJW/F- W', 'CW863NPJ', '', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(57, 1, 'cw822njt1-tv150nrnv2', 'CW822NJT1W/F-W', 'CW822NJT1 / TV150NRNV2', '<div id="product_content_description" style="padding-top: 10px;">"Avante" Wall Hung Toilet</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(58, 1, 'cw824pjt1-tv-150nrnv2', 'CW824PJT1W/F-W', 'CW824PJT1 / TV 150NRNV2', '<p>"Avante" Wall Faced Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(59, 1, 'cw708nhj-tv150nrnv2', 'CW708NHJW/F-W', 'CW708NHJ / TV150NRNV2', '<p>Wall Hung Toilet</p>\n<p>6 L Siphon-Jet Flush</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(60, 1, 'cw875njt1-tv150nrnv2', 'CW875NJT1W/F-W', 'CW875NJT1 / TV150NRNV2', '<p>"Omni" Wall Hung Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(61, 1, 'cw863npjt1-tv150nrnv2', 'CW863NPJT1-W', 'CW863NPJT1 / TV150NRNV2', '<p>"Omni" Wall Faced Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(62, 1, 'cw620jt2-tv150nrnv2', 'CW620JT2W/F-W', 'CW620JT2 / TV150NRNV2', '<p>6 L Single Flush</p>\n<p>Solid Duroplast Seat &amp; Cover</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(63, 1, 'cw708nj-tv150nsv6j', 'CW708NJW/F-W', 'CW708NJ / TV150NSV6J', '<p>Wall Hung Toilet</p>\n<p>6 L Siphon-Jet Flush</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(64, 1, 'cu714v-tv150nsv1j', 'CU714VW/F-W', 'CU714V / TV150NSV1J', '<p>8 L Siphon-Jet Flush</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(65, 1, 'cw705l-tv150nsv7j', 'CW705LW/F-W', 'CW705L / TV150NSV7J', '<div id="product_content_description" style="padding-top: 10px;">Single Bowl Toilet 6 L Siphon-Jet Flush</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(66, 1, 'cw705-tv150nsv7j', 'CW705W/F-W', 'CW705 / TV150NSV7J', '<p>Single Bowl Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(67, 1, 'c51-t150nl', 'C51W/F-W', 'C51 / T150NL', '<p>6 L Flush</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(68, 1, 'cw425j-tv150nlj', 'CW425JW/F-W', 'CW425J / TV150NLJ', '<p>Children Toilet</p>\n<p>6 Liter Flush</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(69, 1, 'ce9-tv150nwv12j', 'CE9W/F-W', 'CE9 / TV150NWV12J', '<p>6 L Single Flush</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(70, 1, 'uw447hjnm-due106ua', 'UW447HJNMW/F-W', 'UW447HJNM / DUE106UA', '<p>Moslem Type Wall Hung Urinal w/ Concealed Sensor System</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(71, 1, 'uw447hjnm-due106uea-1', 'UW447HJNMW/F- W', 'UW447HJNM / DUE106UEA', '<p>Moslem Type Wall Hung Urinal w/ Concealed Sensor System</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(72, 1, 'uw447hjt1-due106ua', 'UW447HJT1W/F-W', 'UW447HJT1 / DUE106UA', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(73, 1, 'uw447hjt1-due106uea-1', 'UW447HJT1W/F- W', 'UW447HJT1 / DUE106UEA', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(74, 1, 'uw350hjt1m-due106ua', 'UW350HJTIMW/F-W', 'UW350HJT1M / DUE106UA', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(75, 1, 'uw350hjt1m-due106uea', 'UW350HJTIMW/F- ', 'UW350HJT1M / DUE106UEA', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(76, 1, 'uw350hjt1-due106ua', 'UW350HJT1W/F-W', 'UW350HJT1 / DUE106UA', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(77, 1, 'uw350hjt1-due106uea', 'UW350HJT1W/F- W', 'UW350HJT1 / DUE106UEA', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(78, 1, 'u57k-due106ua', 'U57KW/F-W', 'U57K / DUE106UA', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(79, 1, 'u57k-due106uea', 'U57KW/F- W', 'U57K / DUE106UEA', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(80, 1, 'uw811hj-due106ua', 'UW811HJW/F-W', 'UW811HJ / DUE106UA', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(81, 1, 'uw811hj-due106uea-1', 'UW811HJW/F- W', 'UW811HJ / DUE106UEA', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(82, 1, 'uw930j', 'UW930JW/F-2-W', 'UW930J', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(83, 1, 'u370m', 'U370MW/F-W', 'U370M', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(84, 1, 'u370w', 'U370W/F-W', 'U370W', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(85, 1, 'uw447jnmw', 'UW447JNMW/F-W', 'UW447JNMW', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(86, 1, 'uw447jt1', 'UW447JT1W/F-W', 'UW447JT1', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(87, 1, 'u57m', 'U57MW/F-W', 'U57M', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(88, 1, 'u57w', 'U57W/F-W', 'U57W', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(89, 1, 'u104', 'U104W/F-W', 'U104', '<p>Urinal</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(90, 1, 'sk33', 'S33-W', 'SK33', '<p>Slop Sink</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(91, 1, 'sk508', 'SK508-W', 'SK508', '<p>Laundry Sink</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(92, 1, 'ce6', 'CE6-W', 'CE6', '<p>Squatting Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(93, 1, 'ce7', 'CE7-W', 'CE7', '<p>Squatting Toilet</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(94, 1, 'lw816j-1', 'LW816JW/F-W', 'LW816J', '<p>"Le Muse" Twin Vessel Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(95, 1, 'lw542j', 'LW542JW/F-2-W', 'LW542J', '<div id="product_content_description" style="padding-top: 10px;">Console Lavatory</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(96, 1, 'lw316j', 'LW316JW/F-W', 'LW316J', '<p>"Hako" Counter Top Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(97, 1, 'lw643j', 'LW643JW/F-W', 'LW643J', '<div id="product_content_description" style="padding-top: 10px;">Console Square Lavatory</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(98, 1, 'lw819j', 'LW819JW/F-W', 'LW819J', '<p>"Le Muse" Vessel Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(99, 1, 'lw818j', 'LW818JW/F-W', 'LW818J', '<p>"Le Muse"?&nbsp;Vessel Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(100, 1, 'lw814cj', 'LW814CJW/F-W', 'LW814CJ', '<p>"Le Muse" Vessel Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(101, 1, 'lw813cj', 'LW813CJW/F-W', 'LW813CJ', '<p>"Le Muse" Vessel Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(102, 1, 'lw631j', 'LW631JW/F-W', 'LW631J', '<div id="product_content_description" style="padding-top: 10px;">Console Lavatory</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(103, 1, 'lw630j', 'LW630JW/F-W', 'LW630J', '<div id="product_content_description" style="padding-top: 10px;">Console Lavatory</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(104, 1, 'lw648cj', 'LW648CJW/F-W', 'LW648CJ', '<p>Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(105, 1, 'lw648cjt1', 'LW648CJT1-W', 'LW648CJT1', '<p>Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(106, 1, 'lw645j-1', 'LW645JW/F-1-W', 'LW645J', '<p>Console Square Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(107, 1, 'lw640j', 'LW640JW/F-W', 'LW640J', '<p>Console Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(108, 1, 'lw640cj', 'LW640CJW/F-W', 'LW640CJ', '<p>Console Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(109, 1, 'lw953j', 'LW953JW/F-W', 'LW953J', '<div id="product_content_description" style="padding-top: 10px;">Console Lavatory (700 x 350 x 109 mm)</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(110, 1, 'lw340j', 'LW340JW/F-W ', 'LW340J', '<p>Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(111, 1, 'lw537cj', 'LW537CJW/F-W', 'LW537CJ', '<div id="product_content_description" style="padding-top: 10px;">Round Console Lavatory</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(112, 1, 'lw536cj', 'LW536CJW/F-W', 'LW536CJ', '<div id="product_content_description" style="padding-top: 10px;">Round Console Lavatory</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(113, 1, 'lw535j', 'LW535JW/F-W', 'LW535J', '<p>"Ceradis" Console Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(114, 1, 'lw532j', 'LW532JW/F-W', 'LW532J', '<div id="product_content_description" style="padding-top: 10px;">Console Lavatory</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(115, 1, 'lw523j', 'LW523JW/F-W', 'LW523J', '<p>"Cerabo" Console Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(116, 1, 'lw524j', 'LW524JW/F-W', 'LW524J', '<p>"Ceravas" Console Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(117, 1, 'l652d', 'L652DW/F-W', 'L652D', '<p>Console Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(118, 1, 'lw647cj', 'LW647CJW/F-W', 'LW647CJ', '<div id="product_content_description" style="padding-top: 10px;">Semi Recessed</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(119, 1, 'lw646j', 'LW646JW/F-W', 'LW646J', '<div id="product_content_description" style="padding-top: 10px;">Semi Recessed</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(120, 1, 'lw641j', 'LW641JW/F-W', 'LW641J', '<p>Semi Recessed Counter Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(121, 1, 'lw528j', 'LW528-W', 'LW528J', '<p>"Ceradon" Semi Recessed Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(122, 1, 'lw526j', 'LW526J-W', 'LW526J', '<p>Cerabo" Semi Recessed Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(123, 1, 'l521v1a', 'L521V1A-W', 'L521V1A', '<p>Counter Top Lavatory 2 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(124, 1, 'l521v3', 'L521V3-W', 'L521V3', '<p>Counter Top Lavatory 2 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(125, 1, 'l546w', 'L546W/F-W', 'L546W', '<p>Under Counter Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(126, 1, 'l548', 'L548W/F-W', 'L548', '<p>Under Counter Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(127, 1, 'l568v3', 'L568V3-W', 'L568V3', '<p>Counter Top Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(128, 1, 'l650', 'L650DW/F-W', 'L650', '<p>Wall Hung Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(129, 1, 'l830v3', 'L830V3-W', 'L830V3', '<p>Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(130, 1, 'lw103', 'LW103JT1W/F-W', 'LW103', '<p>Wall Hung Square Lavatory 1 Tap Hole (for The Disabled)</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(131, 1, 'lw236cj', 'LW236CJ/F-W', 'LW236CJ', '<p>Wall Hung Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(132, 1, 'lw239fj', 'LW239FJW/F-W', 'LW239FJ', '<p>Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(133, 1, 'lw241cj', 'LW241CJW/F-2', 'LW241CJ', '<p>Pedestal Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(134, 1, 'lw241j', 'LW241JW/F-W', 'LW241J', '<p>Pedestal Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(135, 1, 'lw242cj', 'LW242CJW/-F-W', 'LW242CJ', '<p>Half Pedestal Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(136, 1, 'lw242hf', 'LW242HFJW/FS-W', 'LW242HF', '<p>Half Pedestal Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(137, 1, 'lw242j', 'LW242JW/F-W', 'LW242J', '<p>Half Pedestal Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(138, 1, 'lw248jt', 'LW248JT1W/F-W', 'LW248JT', '<div id="product_content_description" style="padding-top: 10px;">Also available : LW248JR</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(139, 1, 'lw315cj', 'LW315CJW/F-W', 'LW315CJ', '<p>Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(140, 1, 'lw315hf', 'LW315HFJW/F-W', 'LW315HF', '<p>Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(141, 1, 'lw315fj', 'LW315FJW/F-W', 'LW315FJ', '<p>Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(142, 1, 'lw315j', 'LW315JW/F-W', 'LW315J', '<p>Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(143, 1, 'lw316cj', 'LW316CJW/F-W', 'LW316CJ', '<p>Hako" Counter Top Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(144, 1, 'lw340cj', 'LW340CJW/F-W', 'LW340CJ', '<p>Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(145, 1, 'lw501cj', 'LW501CJ-W', 'LW501CJ', '<p>Counter Top Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(146, 1, 'lw501j', 'LW501J-W', 'LW501J', '<p>Counter Top Lavatory 3 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(147, 1, 'lw527j', 'LW527J-W', 'LW527J', '<p>"Ceravas" Semi Recessed Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(148, 1, 'lw530j', 'LW530J-W', 'LW530J', '<p>Counter Top Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(149, 1, 'lw533j', 'LW533JW/F-W', 'LW533J', '<p>Semi Recessed Counter Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(150, 1, 'lw539cj', 'LW539CJW/F-W', 'LW539CJ', '<div id="product_content_description" style="padding-top: 10px;">Under Counter Lavatory 1 Tap Hole</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(151, 1, 'lw539jt1', 'LW539JT1W/F-W', 'LW539JT1', '<div id="product_content_description" style="padding-top: 10px;">Under Counter Lavatory 2 Tap Holes</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(152, 1, 'lw540j', 'LW540JW/F-W', 'LW540J', '<p>Square Under Counter Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(153, 1, 'lw549j', 'LW549JW/F-W', 'LW549J', '<p>Under Counter Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(154, 1, 'lw565', 'LW565-W', 'LW565', '<div id="product_content_description" style="padding-top: 10px;">Counter Top Lavatory</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(155, 1, 'lw587j', 'LW587JW/F-W', 'LW587J', '<p>Under Counter Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(156, 1, 'lw595j', 'LW595JW/F-W', 'LW595J', '<div id="product_content_description" style="padding-top: 10px;">Square Under Counter Lavatory</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(157, 1, 'lw640cj-1', 'LW640CJW/F-2-W', 'LW640CJ', '<p>Console Lavatory&nbsp;1 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(158, 1, 'lw640j-1', 'LW640JW/F-2-W', 'LW640J', '<p>Console Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(159, 1, 'lw641cj', 'LW641CJW/F-W', 'LW641CJ', '<p>Semi Recessed Counter Lavatory 1 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(160, 1, 'lw642cj', 'LW642CJW/F-W', 'LW642CJ', '<p>Semi Recessed Counter Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(161, 1, 'lw642j', 'LW642JW/F-W', 'LW642J', '<p>Semi Recessed Counter Lavatory&nbsp;3 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(162, 1, 'lw645j', 'LW645JW/F-W', 'LW645J', '<p>Console Square Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(163, 1, 'lw647j', 'LW647JW/F-W', 'LW647J', '<div id="product_content_description" style="padding-top: 10px;">Semi Recessed</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(164, 1, 'lw648jt1', 'LW648JTI-W', 'LW648JT1', '<p>Lavatory Self Rimming Square 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(165, 1, 'lw648j', 'LW648JW/F-W', 'LW648J', '<p>Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(166, 1, 'lw651j', 'LW651JW/F-W', 'LW651J', '<p>Under Counter Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(167, 1, 'lw660cj', 'LW660CJW/F-W', 'LW660CJ', '<p>Semi Recessed Counter Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(168, 1, 'lw660j', 'LW660JW/F-W', 'LW660J', '<p>Semi Recessed Counter Lavatory&nbsp;3 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(169, 1, 'lw661cj', 'LW661CJW/F-W', 'LW661CJ', '<div id="product_content_description" style="padding-top: 10px;">Semi Recessed Counter Lavatory 1 Tap Hole</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(170, 1, 'lw661j', 'LW661J-W', 'LW661J', '<div id="product_content_description" style="padding-top: 10px;">Semi Recessed Counter Lavatory&nbsp;3 Tap Hole</div>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(171, 1, 'lw662cj', 'LW662CJW/F-W', 'LW662CJ', '<p>Semi Recessed Counter Lavatory 1 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(172, 1, 'lw662j-1', 'LW662JW/F-W', 'LW662J', '<p>Semi Recessed Counter Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(173, 1, 'lw665cjt1', 'LW665CJT1W/F-2-', 'LW665CJT1', '<p>Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(174, 1, 'lw665fj', 'LW665FJW/F-W', 'LW665FJ', '<p>Pedestal for LW665JT1</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(175, 1, 'lw667jw-1', 'LW667JW/F-2-W', 'LW667JW', '<p>"Memory" Pedestal Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(176, 1, 'lw668fj', 'LW668FJ-W', 'LW668FJ', '<p>"Memory" Pedestal Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(177, 1, 'lw668fjt1', 'LW668FJT1W/F-W', 'LW668FJT1', '<p>"Memory" Pedestal Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(178, 1, 'lw668j', 'LW668JW/F-2-W', 'LW668J', '<p>"Memory" Pedestal Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(179, 1, 'lw780cj', 'LW780CJW/F-W', 'LW780CJ', '<p>"Clayton" Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(180, 1, 'lw780fj', 'LW780FJW/F-2-W', 'LW780FJ', '<p>"Clayton" Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(181, 1, 'lw780j', 'LW780JW/F-W', 'LW780J', '<p>"Clayton" Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(182, 1, 'lw781cj', 'LW781CJ-W', 'LW781CJ', '<p>Clayton" Counter Top Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(183, 1, 'lw781j', 'LW781J-W', 'LW781J', '<p>Clayton" Counter Top Lavatory 3 Tap Holes</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(184, 1, 'lw7cj', 'LW7CJW/F-W', 'LW7CJ', '<p>Corner Lavatory 1 Tap Hole</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(185, 1, 'lw810cj', 'LW810CJW/F-W', 'LW810CJ', '<p>"Le Muse" Wall Hung Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(186, 1, 'lw811cj', 'LW811CJW/F-W', 'LW811CJ', '<p>"Le Muse" Wall Hung Lavatory</p>', 0, 'Toto', '0000-00-00', 0, 0, 0, 0, 0, 1),
(187, 1, 'pixaal', '2134567', 'Pixaal', '<p>asdasdad</p>', 0, 'Toto', '0000-00-00', 1, 1, 1, 1, 1, 1),
(188, 1, 'asdasdasdasd', '213123', 'asdasdasdasd', '<p>sadasd</p>', 0, 'Toto', '0000-00-00', 1, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_product_cat`
--

CREATE TABLE IF NOT EXISTS `zpxf_product_cat` (
  `id_prod_cat` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `cat_name` varchar(30) NOT NULL,
  `position` int(4) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_prod_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=247 ;

--
-- Dumping data untuk tabel `zpxf_product_cat`
--

INSERT INTO `zpxf_product_cat` (`id_prod_cat`, `id_cat`, `id_product`, `cat_name`, `position`, `enable`) VALUES
(7, 3, 0, '0', 1, 1),
(40, 4, 1, 'Hanger', 9, 1),
(53, 3, 5, 'Keran Air', 11, 1),
(55, 2, 2, 'Bathub', 12, 1),
(56, 1, 3, 'Closet', 13, 1),
(57, 4, 4, 'Hanger', 14, 1),
(58, 5, 6, 'Washtafel', 15, 1),
(59, 3, 7, 'Keran Air', 16, 1),
(60, 1, 8, 'Closet', 17, 1),
(61, 1, 2, 'Closet', 18, 1),
(62, 5, 2, 'Washtafel', 19, 1),
(63, 3, 1, 'Keran Air', 20, 1),
(64, 2, 10, 'Bathub', 21, 1),
(65, 1, 11, 'Closet', 22, 1),
(66, 2, 11, 'Bathub', 23, 1),
(67, 1, 14, 'Toilet', 24, 1),
(68, 1, 15, 'Toilet', 25, 1),
(69, 1, 16, 'Toilet', 26, 1),
(70, 1, 17, 'Toilet', 27, 1),
(71, 1, 18, 'Toilet', 28, 1),
(72, 1, 19, 'Toilet', 29, 1),
(73, 1, 20, 'Toilet', 30, 1),
(74, 1, 21, 'Toilet', 31, 1),
(75, 1, 22, 'Toilet', 32, 1),
(76, 1, 23, 'Toilet', 33, 1),
(77, 1, 24, 'Toilet', 34, 1),
(78, 1, 26, 'Toilet', 35, 1),
(79, 1, 27, 'Toilet', 36, 1),
(80, 1, 28, 'Toilet', 37, 1),
(81, 1, 29, 'Toilet', 38, 1),
(82, 1, 30, 'Toilet', 39, 1),
(83, 1, 31, 'Toilet', 40, 1),
(84, 1, 33, 'Toilet', 41, 1),
(85, 1, 34, 'Toilet', 42, 1),
(86, 1, 35, 'Toilet', 43, 1),
(87, 1, 36, 'Toilet', 44, 1),
(88, 1, 37, 'Toilet', 45, 1),
(89, 1, 38, 'Toilet', 46, 1),
(90, 1, 39, 'Toilet', 47, 1),
(91, 1, 40, 'Toilet', 48, 1),
(92, 1, 41, 'Toilet', 49, 1),
(93, 1, 42, 'Toilet', 50, 1),
(94, 1, 43, 'Toilet', 51, 1),
(95, 1, 44, 'Toilet', 52, 1),
(96, 1, 45, 'Toilet', 53, 1),
(97, 1, 46, 'Toilet', 54, 1),
(98, 1, 47, 'Toilet', 55, 1),
(99, 1, 48, 'Toilet', 56, 1),
(100, 1, 49, 'Toilet', 57, 1),
(101, 1, 50, 'Toilet', 58, 1),
(102, 1, 51, 'Toilet', 59, 1),
(103, 1, 52, 'Toilet', 60, 1),
(104, 1, 53, 'Toilet', 61, 1),
(105, 1, 54, 'Toilet', 62, 1),
(106, 1, 55, 'Toilet', 63, 1),
(107, 1, 56, 'Toilet', 64, 1),
(108, 1, 57, 'Toilet', 65, 1),
(109, 1, 58, 'Toilet', 66, 1),
(110, 1, 60, 'Toilet', 67, 1),
(111, 1, 61, 'Toilet', 68, 1),
(112, 1, 62, 'Toilet', 69, 1),
(113, 1, 63, 'Toilet', 70, 1),
(114, 1, 64, 'Toilet', 71, 1),
(115, 1, 65, 'Toilet', 72, 1),
(116, 1, 66, 'Toilet', 73, 1),
(117, 1, 67, 'Toilet', 74, 1),
(118, 1, 68, 'Toilet', 75, 1),
(119, 1, 69, 'Toilet', 76, 1),
(133, 3, 82, 'Urinal', 90, 1),
(134, 3, 80, 'Urinal', 91, 1),
(135, 3, 81, 'Urinal', 92, 1),
(136, 3, 78, 'Urinal', 93, 1),
(137, 3, 79, 'Urinal', 94, 1),
(138, 3, 74, 'Urinal', 95, 1),
(139, 3, 75, 'Urinal', 96, 1),
(140, 3, 83, 'Urinal', 97, 1),
(141, 3, 84, 'Urinal', 98, 1),
(142, 3, 85, 'Urinal', 99, 1),
(143, 3, 86, 'Urinal', 100, 1),
(144, 3, 87, 'Urinal', 101, 1),
(145, 3, 88, 'Urinal', 102, 1),
(146, 3, 89, 'Urinal', 103, 1),
(147, 8, 90, 'Sink', 104, 1),
(148, 8, 91, 'Sink', 105, 1),
(149, 3, 70, 'Urinal', 106, 1),
(150, 3, 71, 'Urinal', 107, 1),
(151, 3, 72, 'Urinal', 108, 1),
(152, 3, 73, 'Urinal', 109, 1),
(154, 3, 77, 'Urinal', 111, 1),
(155, 3, 76, 'Urinal', 112, 1),
(156, 1, 92, 'Toilet', 113, 1),
(157, 1, 93, 'Toilet', 114, 1),
(158, 2, 94, 'Lavatory', 115, 1),
(159, 2, 95, 'Lavatory', 116, 1),
(160, 2, 96, 'Lavatory', 117, 1),
(161, 2, 97, 'Lavatory', 118, 1),
(162, 2, 98, 'Lavatory', 119, 1),
(163, 2, 100, 'Lavatory', 120, 1),
(164, 2, 101, 'Lavatory', 121, 1),
(165, 2, 102, 'Lavatory', 122, 1),
(166, 2, 103, 'Lavatory', 123, 1),
(167, 2, 104, 'Lavatory', 124, 1),
(168, 2, 106, 'Lavatory', 125, 1),
(169, 2, 107, 'Lavatory', 126, 1),
(170, 2, 108, 'Lavatory', 127, 1),
(171, 2, 109, 'Lavatory', 128, 1),
(172, 2, 110, 'Lavatory', 129, 1),
(173, 2, 111, 'Lavatory', 130, 1),
(174, 2, 112, 'Lavatory', 131, 1),
(175, 2, 113, 'Lavatory', 132, 1),
(176, 2, 114, 'Lavatory', 133, 1),
(177, 2, 115, 'Lavatory', 134, 1),
(178, 2, 116, 'Lavatory', 135, 1),
(179, 2, 117, 'Lavatory', 136, 1),
(180, 2, 118, 'Lavatory', 137, 1),
(181, 2, 119, 'Lavatory', 138, 1),
(182, 2, 120, 'Lavatory', 139, 1),
(183, 2, 121, 'Lavatory', 140, 1),
(184, 2, 122, 'Lavatory', 141, 1),
(185, 2, 124, 'Lavatory', 142, 1),
(186, 2, 125, 'Lavatory', 143, 1),
(187, 2, 126, 'Lavatory', 144, 1),
(188, 2, 127, 'Lavatory', 145, 1),
(189, 2, 128, 'Lavatory', 146, 1),
(190, 2, 129, 'Lavatory', 147, 1),
(191, 2, 130, 'Lavatory', 148, 1),
(192, 2, 131, 'Lavatory', 149, 1),
(193, 2, 132, 'Lavatory', 150, 1),
(194, 2, 133, 'Lavatory', 151, 1),
(195, 2, 135, 'Lavatory', 152, 1),
(196, 2, 136, 'Lavatory', 153, 1),
(197, 2, 137, 'Lavatory', 154, 1),
(198, 2, 138, 'Lavatory', 155, 1),
(199, 2, 139, 'Lavatory', 156, 1),
(200, 2, 140, 'Lavatory', 157, 1),
(201, 2, 141, 'Lavatory', 158, 1),
(202, 2, 142, 'Lavatory', 159, 1),
(203, 2, 143, 'Lavatory', 160, 1),
(204, 2, 144, 'Lavatory', 161, 1),
(205, 2, 145, 'Lavatory', 162, 1),
(206, 2, 146, 'Lavatory', 163, 1),
(207, 2, 147, 'Lavatory', 164, 1),
(208, 2, 148, 'Lavatory', 165, 1),
(209, 2, 149, 'Lavatory', 166, 1),
(210, 2, 150, 'Lavatory', 167, 1),
(211, 2, 151, 'Lavatory', 168, 1),
(212, 2, 152, 'Lavatory', 169, 1),
(213, 2, 153, 'Lavatory', 170, 1),
(214, 2, 154, 'Lavatory', 171, 1),
(215, 2, 155, 'Lavatory', 172, 1),
(216, 2, 156, 'Lavatory', 173, 1),
(217, 2, 157, 'Lavatory', 174, 1),
(218, 2, 158, 'Lavatory', 175, 1),
(219, 2, 159, 'Lavatory', 176, 1),
(220, 2, 160, 'Lavatory', 177, 1),
(221, 2, 161, 'Lavatory', 178, 1),
(222, 2, 162, 'Lavatory', 179, 1),
(223, 2, 163, 'Lavatory', 180, 1),
(224, 2, 105, 'Lavatory', 181, 1),
(225, 2, 164, 'Lavatory', 182, 1),
(226, 2, 165, 'Lavatory', 183, 1),
(227, 2, 166, 'Lavatory', 184, 1),
(228, 2, 167, 'Lavatory', 185, 1),
(229, 2, 168, 'Lavatory', 186, 1),
(230, 2, 170, 'Lavatory', 187, 1),
(231, 2, 171, 'Lavatory', 188, 1),
(232, 2, 172, 'Lavatory', 189, 1),
(233, 2, 173, 'Lavatory', 190, 1),
(234, 2, 174, 'Lavatory', 191, 1),
(235, 2, 175, 'Lavatory', 192, 1),
(236, 2, 176, 'Lavatory', 193, 1),
(237, 2, 177, 'Lavatory', 194, 1),
(238, 2, 178, 'Lavatory', 195, 1),
(239, 2, 179, 'Lavatory', 196, 1),
(240, 2, 180, 'Lavatory', 197, 1),
(241, 2, 181, 'Lavatory', 198, 1),
(242, 2, 182, 'Lavatory', 199, 1),
(243, 2, 183, 'Lavatory', 200, 1),
(244, 2, 184, 'Lavatory', 201, 1),
(245, 2, 185, 'Lavatory', 202, 1),
(246, 2, 186, 'Lavatory', 203, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_product_feat`
--

CREATE TABLE IF NOT EXISTS `zpxf_product_feat` (
  `id_prod_feat` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `idp_feature` int(11) NOT NULL,
  `feature_prodname` varchar(35) NOT NULL,
  PRIMARY KEY (`id_prod_feat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_product_pic`
--

CREATE TABLE IF NOT EXISTS `zpxf_product_pic` (
  `idproduct_pic` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `photo` varchar(75) NOT NULL,
  `thumb25` varchar(75) NOT NULL,
  `thumb135` varchar(75) NOT NULL,
  `thumb347` varchar(75) NOT NULL,
  `caption` varchar(20) NOT NULL,
  `position` smallint(2) NOT NULL,
  `cover` tinyint(1) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`idproduct_pic`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=363 ;

--
-- Dumping data untuk tabel `zpxf_product_pic`
--

INSERT INTO `zpxf_product_pic` (`idproduct_pic`, `id_product`, `photo`, `thumb25`, `thumb135`, `thumb347`, `caption`, `position`, `cover`, `enable`) VALUES
(14, 1, 'closet-11.jpg', 'closet-11_px25.jpg', 'closet-11_px135.jpg', 'closet-11_px347.jpg', 'Closet Toto ', 2, 1, 1),
(15, 3, 'closet-2_medium.jpg', 'closet-2_medium_px25.jpg', 'closet-2_medium_px135.jpg', 'closet-2_medium_px347.jpg', 'closet-2_medium.jpg', 2, 1, 1),
(16, 4, 'hang-1_medium.jpg', 'hang-1_medium_px25.jpg', 'hang-1_medium_px135.jpg', 'hang-1_medium_px347.jpg', 'hang-1_medium.jpg', 2, 1, 1),
(17, 5, 'keran-1_medium.jpg', 'keran-1_medium_px25.jpg', 'keran-1_medium_px135.jpg', 'keran-1_medium_px347.jpg', 'keran-1_medium.jpg', 2, 1, 1),
(18, 6, 'washtafel_medium.jpg', 'washtafel_medium_px25.jpg', 'washtafel_medium_px135.jpg', 'washtafel_medium_px347.jpg', 'washtafel_medium.jpg', 2, 1, 1),
(19, 0, 'Desert.jpg', 'Desert_px25.jpg', 'Desert_px135.jpg', 'Desert_px347.jpg', 'Desert', 1, 0, 1),
(22, 7, 'candycane.jpg', 'candycane_px25.jpg', 'candycane_px135.jpg', 'candycane_px347.jpg', 'egrteh', 1, 0, 1),
(23, 8, 'Desert.jpg', 'Desert_px25.jpg', 'Desert_px135.jpg', 'Desert_px347.jpg', '', 1, 0, 1),
(24, 10, '2a73667e586580b6c7de66e0f41d812f.png', '2a73667e586580b6c7de66e0f41d812f_px25.png', '2a73667e586580b6c7de66e0f41d812f_px135.png', '2a73667e586580b6c7de66e0f41d812f_px347.png', 'Test loh', 1, 1, 1),
(25, 10, '2e55ad5a4ae3283a11bf89c16a5f3114.jpg', '2e55ad5a4ae3283a11bf89c16a5f3114_px25.jpg', '2e55ad5a4ae3283a11bf89c16a5f3114_px135.jpg', '2e55ad5a4ae3283a11bf89c16a5f3114_px347.jpg', 'coba lagi', 2, 0, 1),
(26, 11, '4c398bedca4da7244b92c9ff4e1ac94c.png', '4c398bedca4da7244b92c9ff4e1ac94c_px25.png', '4c398bedca4da7244b92c9ff4e1ac94c_px135.png', '4c398bedca4da7244b92c9ff4e1ac94c_px347.png', 'New Shoes', 1, 1, 1),
(27, 11, '7afd382f5b5b4a35346026e1cc420aca.jpg', '7afd382f5b5b4a35346026e1cc420aca_px25.jpg', '7afd382f5b5b4a35346026e1cc420aca_px135.jpg', '7afd382f5b5b4a35346026e1cc420aca_px347.jpg', '123', 2, 0, 1),
(28, 2, 'bravo.png', 'bravo_px25.png', 'bravo_px135.png', 'bravo_px347.png', 'Bravo', 1, 1, 1),
(29, 14, 'CW825J.jpg', 'CW825J_px25.jpg', 'CW825J_px135.jpg', 'CW825J_px347.jpg', 'CW825J', 1, 1, 1),
(30, 15, 'C436.jpg', 'C436_px25.jpg', 'C436_px135.jpg', 'C436_px347.jpg', 'C436', 1, 1, 1),
(31, 15, 'C436-TS436SRXNWS.jpg', 'C436-TS436SRXNWS_px25.jpg', 'C436-TS436SRXNWS_px135.jpg', 'C436-TS436SRXNWS_px347.jpg', 'C436 - Technical Dra', 2, 0, 1),
(32, 14, 'CW825J-TX825C1WS.jpg', 'CW825J-TX825C1WS_px25.jpg', 'CW825J-TX825C1WS_px135.jpg', 'CW825J-TX825C1WS_px347.jpg', 'CW825J - Technical D', 2, 0, 1),
(35, 16, 'CW823J.jpg', 'CW823J_px25.jpg', 'CW823J_px135.jpg', 'CW823J_px347.jpg', 'CW823J', 1, 1, 1),
(36, 16, 'CW823J-TX823C1WS.jpg', 'CW823J-TX823C1WS_px25.jpg', 'CW823J-TX823C1WS_px135.jpg', 'CW823J-TX823C1WS_px347.jpg', 'CW823J - Technical D', 2, 0, 1),
(38, 17, 'CW823J.jpg', 'CW823J_px25.jpg', 'CW823J_px135.jpg', 'CW823J_px347.jpg', 'CW823NJ', 1, 1, 1),
(39, 17, 'CW823J-TX823C1WS.jpg', 'CW823J-TX823C1WS_px25.jpg', 'CW823J-TX823C1WS_px135.jpg', 'CW823J-TX823C1WS_px347.jpg', 'CW823NJ - Technical ', 2, 0, 1),
(40, 18, 'CW914J.jpg', 'CW914J_px25.jpg', 'CW914J_px135.jpg', 'CW914J_px347.jpg', 'CW914J', 1, 1, 1),
(41, 18, 'CW914J-TX296CWS.jpg', 'CW914J-TX296CWS_px25.jpg', 'CW914J-TX296CWS_px135.jpg', 'CW914J-TX296CWS_px347.jpg', 'CW914J - Technical D', 2, 0, 1),
(42, 19, 'CW840J.jpg', 'CW840J_px25.jpg', 'CW840J_px135.jpg', 'CW840J_px347.jpg', 'CW840J', 1, 1, 1),
(43, 19, 'CW840J-TX840C81WS.jpg', 'CW840J-TX840C81WS_px25.jpg', 'CW840J-TX840C81WS_px135.jpg', 'CW840J-TX840C81WS_px347.jpg', 'CW840J - Technical D', 2, 0, 1),
(44, 20, 'CW894J.jpg', 'CW894J_px25.jpg', 'CW894J_px135.jpg', 'CW894J_px347.jpg', 'CW894J', 1, 1, 1),
(45, 20, 'CW894J-TX295CWS.jpg', 'CW894J-TX295CWS_px25.jpg', 'CW894J-TX295CWS_px135.jpg', 'CW894J-TX295CWS_px347.jpg', 'CW894J - Technical D', 2, 0, 1),
(46, 21, 'CW868NJ.jpg', 'CW868NJ_px25.jpg', 'CW868NJ_px135.jpg', 'CW868NJ_px347.jpg', 'CW868NJ', 1, 1, 1),
(47, 21, 'CW868NJ-TX868CWS.jpg', 'CW868NJ-TX868CWS_px25.jpg', 'CW868NJ-TX868CWS_px135.jpg', 'CW868NJ-TX868CWS_px347.jpg', 'CW868NJ - Technical ', 2, 0, 1),
(48, 22, 'CW868NJ.jpg', 'CW868NJ_px25.jpg', 'CW868NJ_px135.jpg', 'CW868NJ_px347.jpg', 'CW868NPJ', 1, 1, 1),
(49, 22, 'CW868NPJ-TX868CWS.jpg', 'CW868NPJ-TX868CWS_px25.jpg', 'CW868NPJ-TX868CWS_px135.jpg', 'CW868NPJ-TX868CWS_px347.jpg', 'CW868NPJ - Technical', 2, 0, 1),
(50, 23, 'CW867NJ.jpg', 'CW867NJ_px25.jpg', 'CW867NJ_px135.jpg', 'CW867NJ_px347.jpg', 'CW867NJ', 1, 1, 1),
(51, 23, 'CW867NJ-TX241CWS.jpg', 'CW867NJ-TX241CWS_px25.jpg', 'CW867NJ-TX241CWS_px135.jpg', 'CW867NJ-TX241CWS_px347.jpg', 'CW867NJ - Technical ', 2, 0, 1),
(52, 24, 'CW630J.jpg', 'CW630J_px25.jpg', 'CW630J_px135.jpg', 'CW630J_px347.jpg', 'CW630J', 1, 1, 1),
(53, 24, 'CW630J-TX630C8WS.jpg', 'CW630J-TX630C8WS_px25.jpg', 'CW630J-TX630C8WS_px135.jpg', 'CW630J-TX630C8WS_px347.jpg', 'CW630J - Technical D', 2, 0, 1),
(54, 25, 'CW811PJ_SW811JP.jpg', 'CW811PJ_SW811JP_px25.jpg', 'CW811PJ_SW811JP_px135.jpg', 'CW811PJ_SW811JP_px347.jpg', 'CW811PJ', 1, 1, 1),
(55, 25, 'CW811PJ-SW811JP-IMPULS_720_L400-THX918.jpg', 'CW811PJ-SW811JP-IMPULS_720_L400-THX918_px25.jpg', 'CW811PJ-SW811JP-IMPULS_720_L400-THX918_px135.jpg', 'CW811PJ-SW811JP-IMPULS_720_L400-THX918_px347.jpg', 'CW811PJ - Technical ', 2, 0, 1),
(56, 26, 'CW811PJ_SW811JP.jpg', 'CW811PJ_SW811JP_px25.jpg', 'CW811PJ_SW811JP_px135.jpg', 'CW811PJ_SW811JP_px347.jpg', 'CW811PJW', 1, 1, 1),
(57, 26, 'CW811PJ-SW811JP-IMPULS_720_L400-THX917.jpg', 'CW811PJ-SW811JP-IMPULS_720_L400-THX917_px25.jpg', 'CW811PJ-SW811JP-IMPULS_720_L400-THX917_px135.jpg', 'CW811PJ-SW811JP-IMPULS_720_L400-THX917_px347.jpg', 'CW811PJW - Technical', 2, 0, 1),
(58, 27, 'CW826J_SW826JP.jpg', 'CW826J_SW826JP_px25.jpg', 'CW826J_SW826JP_px135.jpg', 'CW826J_SW826JP_px347.jpg', 'CW826J ', 1, 1, 1),
(59, 27, 'CW826J-SW826JP-TX826CWS.jpg', 'CW826J-SW826JP-TX826CWS_px25.jpg', 'CW826J-SW826JP-TX826CWS_px135.jpg', 'CW826J-SW826JP-TX826CWS_px347.jpg', 'CW826J - Technical D', 2, 0, 1),
(61, 29, 'CW801PJ.jpg', 'CW801PJ_px25.jpg', 'CW801PJ_px135.jpg', 'CW801PJ_px347.jpg', 'CW801PJ', 1, 1, 1),
(62, 29, 'CW801PJ-SW801JP-IMPULS_720.jpg', 'CW801PJ-SW801JP-IMPULS_720_px25.jpg', 'CW801PJ-SW801JP-IMPULS_720_px135.jpg', 'CW801PJ-SW801JP-IMPULS_720_px347.jpg', 'CW801PJ - Technical ', 2, 0, 1),
(63, 28, 'CW821J.jpg', 'CW821J_px25.jpg', 'CW821J_px135.jpg', 'CW821J_px347.jpg', 'CW821J ', 1, 1, 1),
(64, 28, 'CW821J-SW821JP-TX821CWS.jpg', 'CW821J-SW821JP-TX821CWS_px25.jpg', 'CW821J-SW821JP-TX821CWS_px135.jpg', 'CW821J-SW821JP-TX821CWS_px347.jpg', 'CW821J - Technical D', 2, 0, 1),
(65, 30, 'CW801PJ.jpg', 'CW801PJ_px25.jpg', 'CW801PJ_px135.jpg', 'CW801PJ_px347.jpg', 'CW801PJ', 1, 1, 1),
(66, 30, 'CW801PJ-SW801JP-IMPULS_720.jpg', 'CW801PJ-SW801JP-IMPULS_720_px25.jpg', 'CW801PJ-SW801JP-IMPULS_720_px135.jpg', 'CW801PJ-SW801JP-IMPULS_720_px347.jpg', 'CW801PJ - Technical ', 2, 0, 1),
(67, 31, 'CW880PJ.jpg', 'CW880PJ_px25.jpg', 'CW880PJ_px135.jpg', 'CW880PJ_px347.jpg', 'CW880PJ ', 1, 1, 1),
(69, 31, 'CW880PJ-SW880JP-273.705_.KG_.1_.jpg', 'CW880PJ-SW880JP-273_px25.705_', 'CW880PJ-SW880JP-273_px135.705_', 'CW880PJ-SW880JP-273_px347.705_', 'CW880PJ - Technical ', 2, 0, 1),
(70, 32, 'CW880PJ.jpg', 'CW880PJ_px25.jpg', 'CW880PJ_px135.jpg', 'CW880PJ_px347.jpg', 'CW880PJ ', 1, 1, 1),
(72, 32, 'CW880PJ-SW880JP-273.705_.KG_.1_.jpg', 'CW880PJ-SW880JP-273_px25.705_', 'CW880PJ-SW880JP-273_px135.705_', 'CW880PJ-SW880JP-273_px347.705_', 'CW821J - Technical D', 2, 0, 1),
(73, 33, 'CW632PJ.jpg', 'CW632PJ_px25.jpg', 'CW632PJ_px135.jpg', 'CW632PJ_px347.jpg', 'CW632PJ ', 1, 1, 1),
(74, 33, 'CW632PJ-SW632JP-TX632C8WS.jpg', 'CW632PJ-SW632JP-TX632C8WS_px25.jpg', 'CW632PJ-SW632JP-TX632C8WS_px135.jpg', 'CW632PJ-SW632JP-TX632C8WS_px347.jpg', 'CW632PJ - Technical ', 2, 0, 1),
(75, 34, 'CW862NJ.jpg', 'CW862NJ_px25.jpg', 'CW862NJ_px135.jpg', 'CW862NJ_px347.jpg', 'CW862NJ', 1, 1, 1),
(76, 34, 'CW862NJ-SW862JP-TX862CWS.jpg', 'CW862NJ-SW862JP-TX862CWS_px25.jpg', 'CW862NJ-SW862JP-TX862CWS_px135.jpg', 'CW862NJ-SW862JP-TX862CWS_px347.jpg', 'CW862NJ - Technical ', 2, 0, 1),
(77, 35, 'CW862NJ.jpg', 'CW862NJ_px25.jpg', 'CW862NJ_px135.jpg', 'CW862NJ_px347.jpg', 'CW862NPJ', 1, 1, 1),
(78, 35, 'CW862NPJ-SW862JP-TX862CWS.jpg', 'CW862NPJ-SW862JP-TX862CWS_px25.jpg', 'CW862NPJ-SW862JP-TX862CWS_px135.jpg', 'CW862NPJ-SW862JP-TX862CWS_px347.jpg', 'CW862NPJ - Technical', 2, 0, 1),
(79, 36, 'CW860NJ.jpg', 'CW860NJ_px25.jpg', 'CW860NJ_px135.jpg', 'CW860NJ_px347.jpg', 'CW860NJ', 1, 1, 1),
(80, 36, 'CW860NJ-SW861JP-TX240CWS.jpg', 'CW860NJ-SW861JP-TX240CWS_px25.jpg', 'CW860NJ-SW861JP-TX240CWS_px135.jpg', 'CW860NJ-SW861JP-TX240CWS_px347.jpg', 'CW860NJ - Technical ', 2, 0, 1),
(81, 37, 'CW631J.jpg', 'CW631J_px25.jpg', 'CW631J_px135.jpg', 'CW631J_px347.jpg', 'CW631J', 1, 1, 1),
(82, 37, 'CW631J_SW631JP-TX631C8WS.jpg', 'CW631J_SW631JP-TX631C8WS_px25.jpg', 'CW631J_SW631JP-TX631C8WS_px135.jpg', 'CW631J_SW631JP-TX631C8WS_px347.jpg', 'CW631J - Technical D', 2, 0, 1),
(83, 38, 'CW668J.jpg', 'CW668J_px25.jpg', 'CW668J_px135.jpg', 'CW668J_px347.jpg', 'CW668J', 1, 1, 1),
(84, 38, 'CW668J-SW668JP-TX668CWS.jpg', 'CW668J-SW668JP-TX668CWS_px25.jpg', 'CW668J-SW668JP-TX668CWS_px135.jpg', 'CW668J-SW668JP-TX668CWS_px347.jpg', 'CW668J - Technical D', 2, 0, 1),
(85, 38, 'CW668J-SW668J-TX214CWS.jpg', 'CW668J-SW668J-TX214CWS_px25.jpg', 'CW668J-SW668J-TX214CWS_px135.jpg', 'CW668J-SW668J-TX214CWS_px347.jpg', 'CW668J - Technical D', 2, 0, 1),
(86, 39, 'C704L.jpg', 'C704L_px25.jpg', 'C704L_px135.jpg', 'C704L_px347.jpg', 'C704L ', 1, 1, 1),
(87, 39, 'C704L_SW784JP-TX248CWS.jpg', 'C704L_SW784JP-TX248CWS_px25.jpg', 'C704L_SW784JP-TX248CWS_px135.jpg', 'C704L_SW784JP-TX248CWS_px347.jpg', 'C704L - Technical Dr', 2, 0, 1),
(88, 40, 'CW704J.jpg', 'CW704J_px25.jpg', 'CW704J_px135.jpg', 'CW704J_px347.jpg', 'CW704J', 1, 1, 1),
(89, 40, 'CW704J-SW784JP-TX248CWS.jpg', 'CW704J-SW784JP-TX248CWS_px25.jpg', 'CW704J-SW784JP-TX248CWS_px135.jpg', 'CW704J-SW784JP-TX248CWS_px347.jpg', 'CW704J - Technical D', 2, 0, 1),
(90, 41, 'CW661JT1.jpg', 'CW661JT1_px25.jpg', 'CW661JT1_px135.jpg', 'CW661JT1_px347.jpg', 'CW661JT1', 1, 1, 1),
(91, 41, 'CW661JT1-SW784JP-TX212CWS.jpg', 'CW661JT1-SW784JP-TX212CWS_px25.jpg', 'CW661JT1-SW784JP-TX212CWS_px135.jpg', 'CW661JT1-SW784JP-TX212CWS_px347.jpg', 'CW661JT1 - Technical', 2, 0, 1),
(92, 42, 'CW661JT1.jpg', 'CW661JT1_px25.jpg', 'CW661JT1_px135.jpg', 'CW661JT1_px347.jpg', 'CW661JT1', 1, 1, 1),
(93, 42, 'CW661JT1-SW661JP-TX212CWS.jpg', 'CW661JT1-SW661JP-TX212CWS_px25.jpg', 'CW661JT1-SW661JP-TX212CWS_px135.jpg', 'CW661JT1-SW661JP-TX212CWS_px347.jpg', 'CW661JT1 - Technical', 2, 0, 1),
(94, 43, 'CW702J.jpg', 'CW702J_px25.jpg', 'CW702J_px135.jpg', 'CW702J_px347.jpg', 'CW702J', 1, 1, 1),
(95, 43, 'CW702J-SW784JP-TX248CWS.jpg', 'CW702J-SW784JP-TX248CWS_px25.jpg', 'CW702J-SW784JP-TX248CWS_px135.jpg', 'CW702J-SW784JP-TX248CWS_px347.jpg', 'CW702J - Technical D', 2, 0, 1),
(97, 44, 'CW421J.jpg', 'CW421J_px25.jpg', 'CW421J_px135.jpg', 'CW421J_px347.jpg', 'CW421J', 1, 1, 1),
(98, 44, 'CW420J_SW420JP-TX212CWS.jpg', 'CW420J_SW420JP-TX212CWS_px25.jpg', 'CW420J_SW420JP-TX212CWS_px135.jpg', 'CW420J_SW420JP-TX212CWS_px347.jpg', 'CW421J - Technical D', 2, 0, 1),
(99, 45, 'CW660NJ.jpg', 'CW660NJ_px25.jpg', 'CW660NJ_px135.jpg', 'CW660NJ_px347.jpg', 'CW660NJ', 1, 1, 1),
(100, 45, 'CW660NJ-SW660J-TX660C8WS.jpg', 'CW660NJ-SW660J-TX660C8WS_px25.jpg', 'CW660NJ-SW660J-TX660C8WS_px135.jpg', 'CW660NJ-SW660J-TX660C8WS_px347.jpg', 'CW660NJ - Technical ', 2, 0, 1),
(101, 46, 'CW812J.jpg', 'CW812J_px25.jpg', 'CW812J_px135.jpg', 'CW812J_px347.jpg', 'CW812J', 1, 1, 1),
(102, 46, 'CW812J-224.356_.00_.1-Kappa_20_.jpg', 'CW812J-224_px25.356_', 'CW812J-224_px135.356_', 'CW812J-224_px347.356_', 'CW812J - Technical D', 2, 0, 1),
(103, 47, 'CW800J.jpg', 'CW800J_px25.jpg', 'CW800J_px135.jpg', 'CW800J_px347.jpg', 'CW800J ', 1, 1, 1),
(104, 47, 'CW800J-224.321_.00_.1-Sigma_50_.jpg', 'CW800J-224_px25.321_', 'CW800J-224_px135.321_', 'CW800J-224_px347.321_', 'CW800J - Technical D', 2, 0, 1),
(105, 48, 'CW800J.jpg', 'CW800J_px25.jpg', 'CW800J_px135.jpg', 'CW800J_px347.jpg', 'CW800J ', 1, 1, 1),
(106, 48, 'CW800J-224.321_.00_.1-Samba_.jpg', 'CW800J-224_px25.321_', 'CW800J-224_px135.321_', 'CW800J-224_px347.321_', 'CW800J - Technical D', 2, 0, 1),
(107, 49, 'CW813PJ.jpg', 'CW813PJ_px25.jpg', 'CW813PJ_px135.jpg', 'CW813PJ_px347.jpg', 'CW813PJ', 1, 1, 1),
(108, 49, 'CW813PJ-224.356_.00_.1-Kappa_20_.jpg', 'CW813PJ-224_px25.356_', 'CW813PJ-224_px135.356_', 'CW813PJ-224_px347.356_', 'CW813PJ - Technical ', 2, 0, 1),
(109, 50, 'CW822NJ.jpg', 'CW822NJ_px25.jpg', 'CW822NJ_px135.jpg', 'CW822NJ_px347.jpg', 'CW822NJ', 1, 1, 1),
(110, 50, 'CW822NJ-170.063_.00_.2_.jpg', 'CW822NJ-170_px25.063_', 'CW822NJ-170_px135.063_', 'CW822NJ-170_px347.063_', 'CW822NJ - Technical ', 2, 0, 1),
(111, 51, 'CW875NJ.jpg', 'CW875NJ_px25.jpg', 'CW875NJ_px135.jpg', 'CW875NJ_px347.jpg', 'CW875NJ', 1, 1, 1),
(112, 51, 'CW875NJ-Standard_Fix.jpg', 'CW875NJ-Standard_Fix_px25.jpg', 'CW875NJ-Standard_Fix_px135.jpg', 'CW875NJ-Standard_Fix_px347.jpg', 'CW875NJ - Technical ', 2, 0, 1),
(113, 52, 'CW620J.jpg', 'CW620J_px25.jpg', 'CW620J_px135.jpg', 'CW620J_px347.jpg', 'CW620J', 1, 1, 1),
(114, 52, 'CW620J-Standard_Fix.jpg', 'CW620J-Standard_Fix_px25.jpg', 'CW620J-Standard_Fix_px135.jpg', 'CW620J-Standard_Fix_px347.jpg', 'CW620J - Technical D', 2, 0, 1),
(115, 53, 'CW620J.jpg', 'CW620J_px25.jpg', 'CW620J_px135.jpg', 'CW620J_px347.jpg', 'CW620J', 1, 1, 1),
(116, 53, 'CW620J-Standard_Fix.jpg', 'CW620J-Standard_Fix_px25.jpg', 'CW620J-Standard_Fix_px135.jpg', 'CW620J-Standard_Fix_px347.jpg', 'CW620J - Technical D', 2, 0, 1),
(117, 54, 'CW824PJ.jpg', 'CW824PJ_px25.jpg', 'CW824PJ_px135.jpg', 'CW824PJ_px347.jpg', 'CW824PJ', 1, 1, 1),
(118, 54, 'CW824PJ-Concealed_Cistern.jpg', 'CW824PJ-Concealed_Cistern_px25.jpg', 'CW824PJ-Concealed_Cistern_px135.jpg', 'CW824PJ-Concealed_Cistern_px347.jpg', 'CW824PJ - Technical ', 2, 0, 1),
(119, 55, 'CW863NPJ.jpg', 'CW863NPJ_px25.jpg', 'CW863NPJ_px135.jpg', 'CW863NPJ_px347.jpg', 'CW863NPJ', 1, 1, 1),
(120, 55, 'CW863NPJ-Concealed_Cistern.jpg', 'CW863NPJ-Concealed_Cistern_px25.jpg', 'CW863NPJ-Concealed_Cistern_px135.jpg', 'CW863NPJ-Concealed_Cistern_px347.jpg', 'CW863NPJ - Technical', 2, 0, 1),
(121, 56, 'CW863NPJ.jpg', 'CW863NPJ_px25.jpg', 'CW863NPJ_px135.jpg', 'CW863NPJ_px347.jpg', 'CW863NPJ', 1, 1, 1),
(122, 56, 'CW863NPJ-Concealed_Cistern.jpg', 'CW863NPJ-Concealed_Cistern_px25.jpg', 'CW863NPJ-Concealed_Cistern_px135.jpg', 'CW863NPJ-Concealed_Cistern_px347.jpg', 'CW863NPJ - Technical', 2, 0, 1),
(123, 57, 'CW822NJT1.jpg', 'CW822NJT1_px25.jpg', 'CW822NJT1_px135.jpg', 'CW822NJT1_px347.jpg', 'CW822NJT1', 1, 1, 1),
(124, 57, 'CW822NJT1-TV150NRNV3.jpg', 'CW822NJT1-TV150NRNV3_px25.jpg', 'CW822NJT1-TV150NRNV3_px135.jpg', 'CW822NJT1-TV150NRNV3_px347.jpg', 'CW822NJT1 - Technica', 2, 0, 1),
(125, 58, 'CW824PJT1.jpg', 'CW824PJT1_px25.jpg', 'CW824PJT1_px135.jpg', 'CW824PJT1_px347.jpg', 'CW824PJT1', 1, 1, 1),
(126, 58, 'CW824PJT1-TV150NRNV2.jpg', 'CW824PJT1-TV150NRNV2_px25.jpg', 'CW824PJT1-TV150NRNV2_px135.jpg', 'CW824PJT1-TV150NRNV2_px347.jpg', 'CW824PJT1 - Technica', 2, 0, 1),
(127, 59, 'CW708NHJ.jpg', 'CW708NHJ_px25.jpg', 'CW708NHJ_px135.jpg', 'CW708NHJ_px347.jpg', 'CW708NHJ', 1, 1, 1),
(128, 59, 'CW708NHJ-TV150NRNV2.jpg', 'CW708NHJ-TV150NRNV2_px25.jpg', 'CW708NHJ-TV150NRNV2_px135.jpg', 'CW708NHJ-TV150NRNV2_px347.jpg', 'CW708NHJ - Technical', 2, 0, 1),
(129, 60, 'CW875NJT1.jpg', 'CW875NJT1_px25.jpg', 'CW875NJT1_px135.jpg', 'CW875NJT1_px347.jpg', 'CW875NJT1', 1, 1, 1),
(130, 60, 'CW875NJT1-TV150NRNV2.jpg', 'CW875NJT1-TV150NRNV2_px25.jpg', 'CW875NJT1-TV150NRNV2_px135.jpg', 'CW875NJT1-TV150NRNV2_px347.jpg', 'CW875NJT1 - Technica', 2, 0, 1),
(131, 61, 'CW863NPJT1.jpg', 'CW863NPJT1_px25.jpg', 'CW863NPJT1_px135.jpg', 'CW863NPJT1_px347.jpg', 'CW863NPJT1', 1, 1, 1),
(132, 61, 'CW863NPJT1-TV150NRNV2.jpg', 'CW863NPJT1-TV150NRNV2_px25.jpg', 'CW863NPJT1-TV150NRNV2_px135.jpg', 'CW863NPJT1-TV150NRNV2_px347.jpg', 'CW863NPJT1 - Technic', 2, 0, 1),
(133, 62, 'CW620JT2.jpg', 'CW620JT2_px25.jpg', 'CW620JT2_px135.jpg', 'CW620JT2_px347.jpg', 'CW620JT2', 1, 1, 1),
(134, 62, 'CW620JT2-TV150NRNV2.jpg', 'CW620JT2-TV150NRNV2_px25.jpg', 'CW620JT2-TV150NRNV2_px135.jpg', 'CW620JT2-TV150NRNV2_px347.jpg', 'CW620JT2 - Technical', 2, 0, 1),
(135, 63, 'CW708NJ_TV150NSV6.jpg', 'CW708NJ_TV150NSV6_px25.jpg', 'CW708NJ_TV150NSV6_px135.jpg', 'CW708NJ_TV150NSV6_px347.jpg', 'CW708NJ', 1, 1, 1),
(136, 63, 'CW708NJ-TV150NSV6.jpg', 'CW708NJ-TV150NSV6_px25.jpg', 'CW708NJ-TV150NSV6_px135.jpg', 'CW708NJ-TV150NSV6_px347.jpg', 'CW708NJ - Technical ', 2, 0, 1),
(137, 64, 'CU714V_TV150NSV1.jpg', 'CU714V_TV150NSV1_px25.jpg', 'CU714V_TV150NSV1_px135.jpg', 'CU714V_TV150NSV1_px347.jpg', 'CU714VW', 1, 1, 1),
(138, 64, 'CU714V-TV150NSV1.jpg', 'CU714V-TV150NSV1_px25.jpg', 'CU714V-TV150NSV1_px135.jpg', 'CU714V-TV150NSV1_px347.jpg', 'CU714VW - Technical ', 2, 0, 1),
(139, 65, 'CW705L_TV150NS.jpg', 'CW705L_TV150NS_px25.jpg', 'CW705L_TV150NS_px135.jpg', 'CW705L_TV150NS_px347.jpg', 'CW705L', 1, 1, 1),
(140, 65, 'CW705L-TV150NSV7.jpg', 'CW705L-TV150NSV7_px25.jpg', 'CW705L-TV150NSV7_px135.jpg', 'CW705L-TV150NSV7_px347.jpg', 'CW705L - Technical D', 2, 0, 1),
(141, 66, 'CW705_TV150NSV7.jpg', 'CW705_TV150NSV7_px25.jpg', 'CW705_TV150NSV7_px135.jpg', 'CW705_TV150NSV7_px347.jpg', 'CW705', 1, 1, 1),
(142, 66, 'CW705-TV150NSV7.jpg', 'CW705-TV150NSV7_px25.jpg', 'CW705-TV150NSV7_px135.jpg', 'CW705-TV150NSV7_px347.jpg', 'CW705 - Technical Dr', 2, 0, 1),
(146, 67, 'C51_TV150NL.jpg', 'C51_TV150NL_px25.jpg', 'C51_TV150NL_px135.jpg', 'C51_TV150NL_px347.jpg', 'C51', 1, 1, 1),
(147, 67, 'C51-T150NL.jpg', 'C51-T150NL_px25.jpg', 'C51-T150NL_px135.jpg', 'C51-T150NL_px347.jpg', 'C51 - Technical Draw', 2, 0, 1),
(148, 68, 'CW425J.jpg', 'CW425J_px25.jpg', 'CW425J_px135.jpg', 'CW425J_px347.jpg', 'CW425J', 1, 1, 1),
(149, 68, 'CW425J-TV150NL.jpg', 'CW425J-TV150NL_px25.jpg', 'CW425J-TV150NL_px135.jpg', 'CW425J-TV150NL_px347.jpg', 'CW425J - Technical D', 2, 0, 1),
(150, 69, 'CE9.jpg', 'CE9_px25.jpg', 'CE9_px135.jpg', 'CE9_px347.jpg', 'CE9', 1, 1, 1),
(151, 70, 'UW447HJNM.jpg', 'UW447HJNM_px25.jpg', 'UW447HJNM_px135.jpg', 'UW447HJNM_px347.jpg', 'UW447HJNM', 1, 1, 1),
(152, 70, 'UW447HJNM-DUE106UEA.jpg', 'UW447HJNM-DUE106UEA_px25.jpg', 'UW447HJNM-DUE106UEA_px135.jpg', 'UW447HJNM-DUE106UEA_px347.jpg', 'UW447HJNM - Technica', 2, 0, 1),
(153, 71, 'UW447HJNM.jpg', 'UW447HJNM_px25.jpg', 'UW447HJNM_px135.jpg', 'UW447HJNM_px347.jpg', 'UW447HJNM', 1, 1, 1),
(154, 71, 'UW447HJNM-DUE106UEA.jpg', 'UW447HJNM-DUE106UEA_px25.jpg', 'UW447HJNM-DUE106UEA_px135.jpg', 'UW447HJNM-DUE106UEA_px347.jpg', 'UW447HJNM - Technica', 2, 0, 1),
(155, 72, 'UW447HJT1.jpg', 'UW447HJT1_px25.jpg', 'UW447HJT1_px135.jpg', 'UW447HJT1_px347.jpg', 'UW447HJT1', 1, 1, 1),
(156, 73, 'UW447HJT1.jpg', 'UW447HJT1_px25.jpg', 'UW447HJT1_px135.jpg', 'UW447HJT1_px347.jpg', 'UW447 HJT1', 1, 1, 1),
(157, 74, 'UW350HJT1M.jpg', 'UW350HJT1M_px25.jpg', 'UW350HJT1M_px135.jpg', 'UW350HJT1M_px347.jpg', 'UW350HJT1M', 1, 1, 1),
(158, 74, 'UW350HJT1-TEA99DV1.jpg', 'UW350HJT1-TEA99DV1_px25.jpg', 'UW350HJT1-TEA99DV1_px135.jpg', 'UW350HJT1-TEA99DV1_px347.jpg', 'UW350HJT1M - Technic', 2, 0, 1),
(159, 75, 'UW350HJT1M.jpg', 'UW350HJT1M_px25.jpg', 'UW350HJT1M_px135.jpg', 'UW350HJT1M_px347.jpg', 'UW350HJT1M', 1, 1, 1),
(160, 75, 'UW350HJT1-TEA99DV1.jpg', 'UW350HJT1-TEA99DV1_px25.jpg', 'UW350HJT1-TEA99DV1_px135.jpg', 'UW350HJT1-TEA99DV1_px347.jpg', 'UW350HJT1M - Technic', 2, 0, 1),
(161, 76, 'UW350HJT1.jpg', 'UW350HJT1_px25.jpg', 'UW350HJT1_px135.jpg', 'UW350HJT1_px347.jpg', 'UW350HJT1', 1, 1, 1),
(162, 76, 'UW350HJT1-TEA99DV1.jpg', 'UW350HJT1-TEA99DV1_px25.jpg', 'UW350HJT1-TEA99DV1_px135.jpg', 'UW350HJT1-TEA99DV1_px347.jpg', 'UW350HJT1 - Technica', 2, 0, 1),
(163, 77, 'UW350HJT1.jpg', 'UW350HJT1_px25.jpg', 'UW350HJT1_px135.jpg', 'UW350HJT1_px347.jpg', 'UW350HJT1', 1, 1, 1),
(164, 77, 'UW350HJT1-TEA99DV1.jpg', 'UW350HJT1-TEA99DV1_px25.jpg', 'UW350HJT1-TEA99DV1_px135.jpg', 'UW350HJT1-TEA99DV1_px347.jpg', 'UW350HJT1 - Technica', 2, 0, 1),
(165, 78, 'U57K.jpg', 'U57K_px25.jpg', 'U57K_px135.jpg', 'U57K_px347.jpg', 'U57K', 1, 1, 1),
(166, 78, 'U57K-TEA99DV1.jpg', 'U57K-TEA99DV1_px25.jpg', 'U57K-TEA99DV1_px135.jpg', 'U57K-TEA99DV1_px347.jpg', 'U57K - Technical Dra', 2, 0, 1),
(167, 79, 'U57K.jpg', 'U57K_px25.jpg', 'U57K_px135.jpg', 'U57K_px347.jpg', 'U57K', 1, 1, 1),
(168, 79, 'U57K-TEA99DV1.jpg', 'U57K-TEA99DV1_px25.jpg', 'U57K-TEA99DV1_px135.jpg', 'U57K-TEA99DV1_px347.jpg', 'U57K - Technical Dra', 2, 0, 1),
(169, 80, 'UW811HJ.jpg', 'UW811HJ_px25.jpg', 'UW811HJ_px135.jpg', 'UW811HJ_px347.jpg', 'UW811HJ', 1, 1, 1),
(170, 81, 'UW811HJ.jpg', 'UW811HJ_px25.jpg', 'UW811HJ_px135.jpg', 'UW811HJ_px347.jpg', 'UW811HJ', 1, 1, 1),
(171, 81, 'UW811HJ-DUE106UEA.jpg', 'UW811HJ-DUE106UEA_px25.jpg', 'UW811HJ-DUE106UEA_px135.jpg', 'UW811HJ-DUE106UEA_px347.jpg', 'UW811HJ - Technical ', 2, 0, 1),
(172, 82, 'UW930J.jpg', 'UW930J_px25.jpg', 'UW930J_px135.jpg', 'UW930J_px347.jpg', 'UW930J', 1, 1, 1),
(173, 82, 'UW930J-TX501U.jpg', 'UW930J-TX501U_px25.jpg', 'UW930J-TX501U_px135.jpg', 'UW930J-TX501U_px347.jpg', 'UW930J - Technical D', 2, 0, 1),
(174, 83, 'U370M.jpg', 'U370M_px25.jpg', 'U370M_px135.jpg', 'U370M_px347.jpg', 'U370M', 1, 1, 1),
(175, 83, 'U370M-T60S.jpg', 'U370M-T60S_px25.jpg', 'U370M-T60S_px135.jpg', 'U370M-T60S_px347.jpg', 'U370M - Technical Dr', 2, 0, 1),
(176, 84, 'U370.jpg', 'U370_px25.jpg', 'U370_px135.jpg', 'U370_px347.jpg', 'U370W', 1, 1, 1),
(177, 84, 'U370-T60S.jpg', 'U370-T60S_px25.jpg', 'U370-T60S_px135.jpg', 'U370-T60S_px347.jpg', 'U370W - Technical Dr', 2, 0, 1),
(178, 85, 'UW447JNM.jpg', 'UW447JNM_px25.jpg', 'UW447JNM_px135.jpg', 'UW447JNM_px347.jpg', 'UW447JNM', 1, 1, 1),
(179, 85, 'UW447JNM-TX501U.jpg', 'UW447JNM-TX501U_px25.jpg', 'UW447JNM-TX501U_px135.jpg', 'UW447JNM-TX501U_px347.jpg', 'UW447M - Technical D', 2, 0, 1),
(180, 86, 'UW447JT1.jpg', 'UW447JT1_px25.jpg', 'UW447JT1_px135.jpg', 'UW447JT1_px347.jpg', 'UW447JT1', 1, 1, 1),
(181, 86, 'UW447JT1-TX501U.jpg', 'UW447JT1-TX501U_px25.jpg', 'UW447JT1-TX501U_px135.jpg', 'UW447JT1-TX501U_px347.jpg', 'UW447JT1 - Technical', 2, 0, 1),
(182, 87, 'U57M.jpg', 'U57M_px25.jpg', 'U57M_px135.jpg', 'U57M_px347.jpg', 'U57M', 1, 1, 1),
(183, 87, 'U57M-T60P.jpg', 'U57M-T60P_px25.jpg', 'U57M-T60P_px135.jpg', 'U57M-T60P_px347.jpg', 'U57M - Technical Dra', 2, 0, 1),
(184, 88, 'U57.jpg', 'U57_px25.jpg', 'U57_px135.jpg', 'U57_px347.jpg', 'U57W', 1, 1, 1),
(185, 88, 'U57-T60P.jpg', 'U57-T60P_px25.jpg', 'U57-T60P_px135.jpg', 'U57-T60P_px347.jpg', 'U57W - Technical Dra', 2, 0, 1),
(186, 89, 'U104.jpg', 'U104_px25.jpg', 'U104_px135.jpg', 'U104_px347.jpg', 'U104', 1, 1, 1),
(187, 89, 'U104-T60RN.jpg', 'U104-T60RN_px25.jpg', 'U104-T60RN_px135.jpg', 'U104-T60RN_px347.jpg', 'U104 - Technical Dra', 2, 0, 1),
(188, 90, 'SK33.jpg', 'SK33_px25.jpg', 'SK33_px135.jpg', 'SK33_px347.jpg', 'SK33', 1, 1, 1),
(189, 90, 'SK33-TV150NS.jpg', 'SK33-TV150NS_px25.jpg', 'SK33-TV150NS_px135.jpg', 'SK33-TV150NS_px347.jpg', 'SK33 - Technical Dra', 2, 0, 1),
(190, 91, 'SK508.jpg', 'SK508_px25.jpg', 'SK508_px135.jpg', 'SK508_px347.jpg', 'SK508', 1, 1, 1),
(191, 91, 'SK508-T30ARQ13N.jpg', 'SK508-T30ARQ13N_px25.jpg', 'SK508-T30ARQ13N_px135.jpg', 'SK508-T30ARQ13N_px347.jpg', 'SK508 - Technical Dr', 2, 0, 1),
(192, 92, 'CE6.jpg', 'CE6_px25.jpg', 'CE6_px135.jpg', 'CE6_px347.jpg', 'CE6', 1, 1, 1),
(193, 93, 'CE7.jpg', 'CE7_px25.jpg', 'CE7_px135.jpg', 'CE7_px347.jpg', 'CE7', 1, 1, 1),
(194, 94, 'LW816.jpg', 'LW816_px25.jpg', 'LW816_px135.jpg', 'LW816_px347.jpg', 'LW816J', 1, 1, 1),
(195, 94, 'LW816J-TX116LQBR.jpg', 'LW816J-TX116LQBR_px25.jpg', 'LW816J-TX116LQBR_px135.jpg', 'LW816J-TX116LQBR_px347.jpg', 'LW816J - Tehnical Dr', 2, 0, 1),
(196, 95, 'LW542J.jpg', 'LW542J_px25.jpg', 'LW542J_px135.jpg', 'LW542J_px347.jpg', 'LW542J ', 1, 1, 1),
(197, 95, 'LW542J-TX125LESV2.jpg', 'LW542J-TX125LESV2_px25.jpg', 'LW542J-TX125LESV2_px135.jpg', 'LW542J-TX125LESV2_px347.jpg', 'LW542J - Technical D', 2, 0, 1),
(198, 96, 'LW316J.jpg', 'LW316J_px25.jpg', 'LW316J_px135.jpg', 'LW316J_px347.jpg', 'LW316J', 1, 1, 1),
(199, 96, 'LW316J-TX119LEL.jpg', 'LW316J-TX119LEL_px25.jpg', 'LW316J-TX119LEL_px135.jpg', 'LW316J-TX119LEL_px347.jpg', 'LW316J - Technical D', 2, 0, 1),
(200, 97, 'LW643J.jpg', 'LW643J_px25.jpg', 'LW643J_px135.jpg', 'LW643J_px347.jpg', 'LW643J', 1, 1, 1),
(201, 97, 'LW643J-TX116LL.jpg', 'LW643J-TX116LL_px25.jpg', 'LW643J-TX116LL_px135.jpg', 'LW643J-TX116LL_px347.jpg', 'LW643J - Technical D', 2, 0, 1),
(202, 98, 'LW819J.jpg', 'LW819J_px25.jpg', 'LW819J_px135.jpg', 'LW819J_px347.jpg', 'LW819J', 1, 1, 1),
(203, 98, 'LW819J-TX120LQBR.jpg', 'LW819J-TX120LQBR_px25.jpg', 'LW819J-TX120LQBR_px135.jpg', 'LW819J-TX120LQBR_px347.jpg', 'LW819J - Technical D', 2, 0, 1),
(204, 99, 'LW818J.jpg', 'LW818J_px25.jpg', 'LW818J_px135.jpg', 'LW818J_px347.jpg', 'LW818J', 1, 1, 1),
(205, 99, 'LW818J-TX116LQBR.jpg', 'LW818J-TX116LQBR_px25.jpg', 'LW818J-TX116LQBR_px135.jpg', 'LW818J-TX116LQBR_px347.jpg', 'LW818J - Technical D', 2, 0, 1),
(206, 100, 'LW814CJ.jpg', 'LW814CJ_px25.jpg', 'LW814CJ_px135.jpg', 'LW814CJ_px347.jpg', 'LW814CJ', 1, 1, 1),
(207, 100, 'LW814CJ-TX115LQBR.jpg', 'LW814CJ-TX115LQBR_px25.jpg', 'LW814CJ-TX115LQBR_px135.jpg', 'LW814CJ-TX115LQBR_px347.jpg', 'LW814CJ - Technical ', 2, 0, 1),
(208, 101, 'LW813CJ.jpg', 'LW813CJ_px25.jpg', 'LW813CJ_px135.jpg', 'LW813CJ_px347.jpg', 'LW813CJ', 1, 1, 1),
(209, 102, 'LW631J.jpg', 'LW631J_px25.jpg', 'LW631J_px135.jpg', 'LW631J_px347.jpg', 'LW631J', 1, 1, 1),
(210, 102, 'LW631J-TX116LEBR.jpg', 'LW631J-TX116LEBR_px25.jpg', 'LW631J-TX116LEBR_px135.jpg', 'LW631J-TX116LEBR_px347.jpg', 'LW631J - Technical D', 2, 0, 1),
(211, 103, 'LW630J.jpg', 'LW630J_px25.jpg', 'LW630J_px135.jpg', 'LW630J_px347.jpg', 'LW630J', 1, 1, 1),
(212, 103, 'LW630J-TX116LL.jpg', 'LW630J-TX116LL_px25.jpg', 'LW630J-TX116LL_px135.jpg', 'LW630J-TX116LL_px347.jpg', 'LW630J - Technical D', 2, 0, 1),
(213, 104, 'LW648CJ.jpg', 'LW648CJ_px25.jpg', 'LW648CJ_px135.jpg', 'LW648CJ_px347.jpg', 'LW648CJ', 1, 1, 1),
(214, 106, 'LW645J.jpg', 'LW645J_px25.jpg', 'LW645J_px135.jpg', 'LW645J_px347.jpg', 'LW645J', 1, 1, 1),
(215, 106, 'LW645J-TX123LESV4.jpg', 'LW645J-TX123LESV4_px25.jpg', 'LW645J-TX123LESV4_px135.jpg', 'LW645J-TX123LESV4_px347.jpg', 'LW645J - Technical D', 2, 0, 1),
(216, 107, 'LW640J.jpg', 'LW640J_px25.jpg', 'LW640J_px135.jpg', 'LW640J_px347.jpg', 'LW640J', 1, 1, 1),
(217, 107, 'LW640J-TX119LECBR.jpg', 'LW640J-TX119LECBR_px25.jpg', 'LW640J-TX119LECBR_px135.jpg', 'LW640J-TX119LECBR_px347.jpg', 'LW640J - Technical D', 2, 0, 1),
(218, 108, 'LW640J.jpg', 'LW640J_px25.jpg', 'LW640J_px135.jpg', 'LW640J_px347.jpg', 'LW640CJ', 1, 1, 1),
(219, 108, 'LW640CJ-TX115LESBR.jpg', 'LW640CJ-TX115LESBR_px25.jpg', 'LW640CJ-TX115LESBR_px135.jpg', 'LW640CJ-TX115LESBR_px347.jpg', 'LW640CJ - Technical ', 2, 0, 1),
(220, 109, 'LW953J.jpg', 'LW953J_px25.jpg', 'LW953J_px135.jpg', 'LW953J_px347.jpg', 'LW953J', 1, 1, 1),
(221, 111, 'LW537CJ.jpg', 'LW537CJ_px25.jpg', 'LW537CJ_px135.jpg', 'LW537CJ_px347.jpg', 'LW537CJ', 1, 1, 1),
(222, 111, 'LW537CJ-TX115LNBR.jpg', 'LW537CJ-TX115LNBR_px25.jpg', 'LW537CJ-TX115LNBR_px135.jpg', 'LW537CJ-TX115LNBR_px347.jpg', 'LW537CJ Technical Dr', 2, 0, 1),
(223, 112, 'LW536CJ.jpg', 'LW536CJ_px25.jpg', 'LW536CJ_px135.jpg', 'LW536CJ_px347.jpg', 'LW536CJ', 1, 1, 1),
(224, 112, 'LW536CJ-TX115LEJBR.jpg', 'LW536CJ-TX115LEJBR_px25.jpg', 'LW536CJ-TX115LEJBR_px135.jpg', 'LW536CJ-TX115LEJBR_px347.jpg', 'LW536CJ - Technical ', 2, 0, 1),
(225, 113, 'LW535J.jpg', 'LW535J_px25.jpg', 'LW535J_px135.jpg', 'LW535J_px347.jpg', 'LW535J', 1, 1, 1),
(226, 113, 'LW535J-TX125LESV2.jpg', 'LW535J-TX125LESV2_px25.jpg', 'LW535J-TX125LESV2_px135.jpg', 'LW535J-TX125LESV2_px347.jpg', 'LW535J - Technical D', 2, 0, 1),
(227, 114, 'LW532J.jpg', 'LW532J_px25.jpg', 'LW532J_px135.jpg', 'LW532J_px347.jpg', 'LW532J', 1, 1, 1),
(228, 115, 'LW523J.jpg', 'LW523J_px25.jpg', 'LW523J_px135.jpg', 'LW523J_px347.jpg', 'LW523J', 1, 1, 1),
(229, 115, 'LW523J-TX116LEBR.jpg', 'LW523J-TX116LEBR_px25.jpg', 'LW523J-TX116LEBR_px135.jpg', 'LW523J-TX116LEBR_px347.jpg', 'LW523J - Technical D', 2, 0, 1),
(230, 116, 'LW524J.jpg', 'LW524J_px25.jpg', 'LW524J_px135.jpg', 'LW524J_px347.jpg', 'LW524J', 1, 1, 1),
(231, 116, 'LW524J-TX118LEBR.jpg', 'LW524J-TX118LEBR_px25.jpg', 'LW524J-TX118LEBR_px135.jpg', 'LW524J-TX118LEBR_px347.jpg', 'LW524J - Technical D', 2, 0, 1),
(232, 117, 'L652D.jpg', 'L652D_px25.jpg', 'L652D_px135.jpg', 'L652D_px347.jpg', 'L652D', 1, 1, 1),
(233, 117, 'L652D-T205MC.jpg', 'L652D-T205MC_px25.jpg', 'L652D-T205MC_px135.jpg', 'L652D-T205MC_px347.jpg', 'L652D - Technical Dr', 2, 0, 1),
(234, 118, 'LW647CJ.jpg', 'LW647CJ_px25.jpg', 'LW647CJ_px135.jpg', 'LW647CJ_px347.jpg', 'LW647CJ', 1, 1, 1),
(235, 118, 'LW647CJ-TX115LNBR.jpg', 'LW647CJ-TX115LNBR_px25.jpg', 'LW647CJ-TX115LNBR_px135.jpg', 'LW647CJ-TX115LNBR_px347.jpg', 'LW647CJ - Technical ', 2, 0, 1),
(236, 119, 'LW646J.jpg', 'LW646J_px25.jpg', 'LW646J_px135.jpg', 'LW646J_px347.jpg', 'LW646J', 1, 1, 1),
(237, 119, 'LW646J-TX115LMBR.jpg', 'LW646J-TX115LMBR_px25.jpg', 'LW646J-TX115LMBR_px135.jpg', 'LW646J-TX115LMBR_px347.jpg', 'LW646J - Technical D', 2, 0, 1),
(238, 120, 'LW641J.jpg', 'LW641J_px25.jpg', 'LW641J_px135.jpg', 'LW641J_px347.jpg', 'LW641J', 1, 1, 1),
(239, 120, 'LW641J-TX119LI.jpg', 'LW641J-TX119LI_px25.jpg', 'LW641J-TX119LI_px135.jpg', 'LW641J-TX119LI_px347.jpg', 'LW641J - Technical D', 2, 0, 1),
(241, 121, 'LW528J.jpg', 'LW528J_px25.jpg', 'LW528J_px135.jpg', 'LW528J_px347.jpg', 'LW528J', 1, 1, 1),
(242, 121, 'LW528J-TX118LEBR.jpg', 'LW528J-TX118LEBR_px25.jpg', 'LW528J-TX118LEBR_px135.jpg', 'LW528J-TX118LEBR_px347.jpg', 'LW528J - Technical D', 2, 0, 1),
(243, 122, 'LW526J.jpg', 'LW526J_px25.jpg', 'LW526J_px135.jpg', 'LW526J_px347.jpg', 'LW526J', 1, 1, 1),
(244, 123, 'L521V1A.jpg', 'L521V1A_px25.jpg', 'L521V1A_px135.jpg', 'L521V1A_px347.jpg', 'L521V1A', 1, 1, 1),
(245, 123, 'L521V1A-TX111LRYR.jpg', 'L521V1A-TX111LRYR_px25.jpg', 'L521V1A-TX111LRYR_px135.jpg', 'L521V1A-TX111LRYR_px347.jpg', 'L521V1A - Technical ', 2, 0, 1),
(246, 124, 'L521V3.jpg', 'L521V3_px25.jpg', 'L521V3_px135.jpg', 'L521V3_px347.jpg', 'L521V3', 1, 1, 1),
(247, 125, 'L546.jpg', 'L546_px25.jpg', 'L546_px135.jpg', 'L546_px347.jpg', 'L546', 1, 1, 1),
(249, 125, 'L546-TX101LB.jpg', 'L546-TX101LB_px25.jpg', 'L546-TX101LB_px135.jpg', 'L546-TX101LB_px347.jpg', 'L546 - Technical Dra', 2, 0, 1),
(250, 126, 'L548.jpg', 'L548_px25.jpg', 'L548_px135.jpg', 'L548_px347.jpg', 'L548', 1, 1, 1),
(251, 126, 'L548-TX101LB.jpg', 'L548-TX101LB_px25.jpg', 'L548-TX101LB_px135.jpg', 'L548-TX101LB_px347.jpg', 'L548 - Technical Dra', 2, 0, 1),
(252, 127, 'L568V3.jpg', 'L568V3_px25.jpg', 'L568V3_px135.jpg', 'L568V3_px347.jpg', 'L568V3', 1, 1, 1),
(253, 127, 'L568V3-TX101LB.jpg', 'L568V3-TX101LB_px25.jpg', 'L568V3-TX101LB_px135.jpg', 'L568V3-TX101LB_px347.jpg', 'L568V3 - Technical D', 2, 0, 1),
(254, 128, 'L650D.jpg', 'L650D_px25.jpg', 'L650D_px135.jpg', 'L650D_px347.jpg', 'L650D', 1, 1, 1),
(255, 130, 'LW103JT1.jpg', 'LW103JT1_px25.jpg', 'LW103JT1_px135.jpg', 'LW103JT1_px347.jpg', 'LW103JT1', 1, 1, 1),
(257, 130, 'LW103JT1-T205QN.jpg', 'LW103JT1-T205QN_px25.jpg', 'LW103JT1-T205QN_px135.jpg', 'LW103JT1-T205QN_px347.jpg', 'LW103JT1 - Technical', 2, 0, 1),
(258, 131, 'LW536CJ.jpg', 'LW536CJ_px25.jpg', 'LW536CJ_px135.jpg', 'LW536CJ_px347.jpg', 'LW536CJ', 1, 1, 1),
(259, 131, 'LW536CJ-TX115LOBR.jpg', 'LW536CJ-TX115LOBR_px25.jpg', 'LW536CJ-TX115LOBR_px135.jpg', 'LW536CJ-TX115LOBR_px347.jpg', 'LW536CJ - Technical ', 2, 0, 1),
(260, 132, 'LW239FJ.jpg', 'LW239FJ_px25.jpg', 'LW239FJ_px135.jpg', 'LW239FJ_px347.jpg', 'LW239FJ', 1, 1, 1),
(261, 133, 'LW241CJ.jpg', 'LW241CJ_px25.jpg', 'LW241CJ_px135.jpg', 'LW241CJ_px347.jpg', 'LW241CJ', 1, 1, 1),
(262, 134, 'LW241CJ.jpg', 'LW241CJ_px25.jpg', 'LW241CJ_px135.jpg', 'LW241CJ_px347.jpg', 'LW241J', 1, 1, 1),
(263, 135, 'LW242CJ.jpg', 'LW242CJ_px25.jpg', 'LW242CJ_px135.jpg', 'LW242CJ_px347.jpg', 'LW242CJ', 1, 1, 1),
(264, 135, 'LW242CJ-LW242HFJ-TX109LD.jpg', 'LW242CJ-LW242HFJ-TX109LD_px25.jpg', 'LW242CJ-LW242HFJ-TX109LD_px135.jpg', 'LW242CJ-LW242HFJ-TX109LD_px347.jpg', 'LW242CJ - Technical ', 2, 0, 1),
(265, 136, 'LW242CJ.jpg', 'LW242CJ_px25.jpg', 'LW242CJ_px135.jpg', 'LW242CJ_px347.jpg', 'LW242HFJ', 1, 1, 1),
(266, 136, 'LW242J_LW242HFJ.jpg', 'LW242J_LW242HFJ_px25.jpg', 'LW242J_LW242HFJ_px135.jpg', 'LW242J_LW242HFJ_px347.jpg', 'LW242HFJ - Technical', 2, 0, 1),
(267, 137, 'LW242CJ.jpg', 'LW242CJ_px25.jpg', 'LW242CJ_px135.jpg', 'LW242CJ_px347.jpg', 'LW242J', 1, 1, 1),
(268, 137, 'LW242J_LW242HFJ.jpg', 'LW242J_LW242HFJ_px25.jpg', 'LW242J_LW242HFJ_px135.jpg', 'LW242J_LW242HFJ_px347.jpg', 'LW242J - Technical D', 2, 0, 1),
(269, 138, 'LW248JT1.jpg', 'LW248JT1_px25.jpg', 'LW248JT1_px135.jpg', 'LW248JT1_px347.jpg', 'LW248JT1', 1, 1, 1),
(270, 138, 'LW248JR-TX109LH.jpg', 'LW248JR-TX109LH_px25.jpg', 'LW248JR-TX109LH_px135.jpg', 'LW248JR-TX109LH_px347.jpg', 'LW248JT1 - Technical', 2, 0, 1),
(271, 139, 'LW315CJ.jpg', 'LW315CJ_px25.jpg', 'LW315CJ_px135.jpg', 'LW315CJ_px347.jpg', 'LW315CJ', 1, 1, 1),
(272, 140, 'LW315CJ.jpg', 'LW315CJ_px25.jpg', 'LW315CJ_px135.jpg', 'LW315CJ_px347.jpg', 'LW315HFJ', 1, 1, 1),
(274, 142, 'LW315J.jpg', 'LW315J_px25.jpg', 'LW315J_px135.jpg', 'LW315J_px347.jpg', 'LW315J', 1, 1, 1),
(275, 143, 'LW316J.jpg', 'LW316J_px25.jpg', 'LW316J_px135.jpg', 'LW316J_px347.jpg', 'LW316J', 1, 1, 1),
(276, 145, 'LW501CJ.jpg', 'LW501CJ_px25.jpg', 'LW501CJ_px135.jpg', 'LW501CJ_px347.jpg', 'LW501CJ', 1, 1, 1),
(277, 146, 'LW501CJ.jpg', 'LW501CJ_px25.jpg', 'LW501CJ_px135.jpg', 'LW501CJ_px347.jpg', 'LW501J', 1, 1, 1),
(278, 146, 'LW501J-TGL600RYRV1N.jpg', 'LW501J-TGL600RYRV1N_px25.jpg', 'LW501J-TGL600RYRV1N_px135.jpg', 'LW501J-TGL600RYRV1N_px347.jpg', 'LW501J - Technical D', 2, 0, 1),
(279, 147, 'LW527J.jpg', 'LW527J_px25.jpg', 'LW527J_px135.jpg', 'LW527J_px347.jpg', 'LW527J', 1, 1, 1),
(280, 147, 'LW527J-TX118LEBR.jpg', 'LW527J-TX118LEBR_px25.jpg', 'LW527J-TX118LEBR_px135.jpg', 'LW527J-TX118LEBR_px347.jpg', 'LW527J - technical D', 2, 0, 1),
(281, 148, 'LW530J.jpg', 'LW530J_px25.jpg', 'LW530J_px135.jpg', 'LW530J_px347.jpg', 'LW530J', 1, 1, 1),
(282, 148, 'LW530J-TX122LES.jpg', 'LW530J-TX122LES_px25.jpg', 'LW530J-TX122LES_px135.jpg', 'LW530J-TX122LES_px347.jpg', 'LW530J - Technical D', 2, 0, 1),
(283, 149, 'LW533J.jpg', 'LW533J_px25.jpg', 'LW533J_px135.jpg', 'LW533J_px347.jpg', 'LW533J', 1, 1, 1),
(284, 149, 'LW533J-TX116LEV4BR.jpg', 'LW533J-TX116LEV4BR_px25.jpg', 'LW533J-TX116LEV4BR_px135.jpg', 'LW533J-TX116LEV4BR_px347.jpg', 'LW533J - Technical D', 2, 0, 1),
(285, 150, 'LW539CJ.jpg', 'LW539CJ_px25.jpg', 'LW539CJ_px135.jpg', 'LW539CJ_px347.jpg', 'LW539CJ', 1, 1, 1),
(286, 151, 'LW539JT1.jpg', 'LW539JT1_px25.jpg', 'LW539JT1_px135.jpg', 'LW539JT1_px347.jpg', 'LW539JT1', 1, 1, 1),
(287, 151, 'LW539JT1-TX101LB-TX728AEN.jpg', 'LW539JT1-TX101LB-TX728AEN_px25.jpg', 'LW539JT1-TX101LB-TX728AEN_px135.jpg', 'LW539JT1-TX101LB-TX728AEN_px347.jpg', 'LW539JT1 - Technical', 2, 0, 1),
(288, 151, 'LW539JT1-TEN40AWV500-TX728AEN.jpg', 'LW539JT1-TEN40AWV500-TX728AEN_px25.jpg', 'LW539JT1-TEN40AWV500-TX728AEN_px135.jpg', 'LW539JT1-TEN40AWV500-TX728AEN_px347.jpg', 'LW539JT1 - Technical', 2, 0, 1),
(289, 152, 'LW540J.jpg', 'LW540J_px25.jpg', 'LW540J_px135.jpg', 'LW540J_px347.jpg', 'LW540J', 1, 1, 1),
(291, 152, 'LW540J-TX115LOBR.jpg', 'LW540J-TX115LOBR_px25.jpg', 'LW540J-TX115LOBR_px135.jpg', 'LW540J-TX115LOBR_px347.jpg', 'LW540J - Technical D', 2, 0, 1),
(292, 152, 'LW540J-TX115LI.jpg', 'LW540J-TX115LI_px25.jpg', 'LW540J-TX115LI_px135.jpg', 'LW540J-TX115LI_px347.jpg', 'LW540J - Technical D', 2, 0, 1),
(293, 153, 'LW549J.jpg', 'LW549J_px25.jpg', 'LW549J_px135.jpg', 'LW549J_px347.jpg', 'LW549J', 1, 1, 1),
(294, 153, 'LW549J-TX108LJ.jpg', 'LW549J-TX108LJ_px25.jpg', 'LW549J-TX108LJ_px135.jpg', 'LW549J-TX108LJ_px347.jpg', 'LW549J - Technical D', 2, 0, 1),
(295, 154, 'LW565.jpg', 'LW565_px25.jpg', 'LW565_px135.jpg', 'LW565_px347.jpg', 'LW565', 1, 1, 1),
(296, 154, 'LW565-TX109LD.jpg', 'LW565-TX109LD_px25.jpg', 'LW565-TX109LD_px135.jpg', 'LW565-TX109LD_px347.jpg', 'LW565 - Technical Dr', 2, 0, 1),
(297, 155, 'LW587J.jpg', 'LW587J_px25.jpg', 'LW587J_px135.jpg', 'LW587J_px347.jpg', 'LW587J', 1, 1, 1),
(298, 155, 'LW587J-TX103LG.jpg', 'LW587J-TX103LG_px25.jpg', 'LW587J-TX103LG_px135.jpg', 'LW587J-TX103LG_px347.jpg', 'LW587J - Technical D', 2, 0, 1),
(299, 156, 'LW595J.jpg', 'LW595J_px25.jpg', 'LW595J_px135.jpg', 'LW595J_px347.jpg', 'LW595J', 1, 1, 1),
(300, 156, 'LW595J-TX115LMBR.jpg', 'LW595J-TX115LMBR_px25.jpg', 'LW595J-TX115LMBR_px135.jpg', 'LW595J-TX115LMBR_px347.jpg', 'LW595J - Technical D', 2, 0, 1),
(301, 157, 'LW640CJ.jpg', 'LW640CJ_px25.jpg', 'LW640CJ_px135.jpg', 'LW640CJ_px347.jpg', 'LW640CJ', 1, 1, 1),
(302, 157, 'LW640CJ-TX115LESBR.jpg', 'LW640CJ-TX115LESBR_px25.jpg', 'LW640CJ-TX115LESBR_px135.jpg', 'LW640CJ-TX115LESBR_px347.jpg', 'LW640CJ - Technical ', 2, 0, 1),
(303, 158, 'LW640J.jpg', 'LW640J_px25.jpg', 'LW640J_px135.jpg', 'LW640J_px347.jpg', 'LW640J', 1, 1, 1),
(304, 158, 'LW640J-TX119LECBR.jpg', 'LW640J-TX119LECBR_px25.jpg', 'LW640J-TX119LECBR_px135.jpg', 'LW640J-TX119LECBR_px347.jpg', 'LW640J - Technical D', 2, 0, 1),
(305, 159, 'LW641CJ.jpg', 'LW641CJ_px25.jpg', 'LW641CJ_px135.jpg', 'LW641CJ_px347.jpg', 'LW641CJ', 1, 1, 1),
(306, 159, 'LW641CJ-TX115LESBR.jpg', 'LW641CJ-TX115LESBR_px25.jpg', 'LW641CJ-TX115LESBR_px135.jpg', 'LW641CJ-TX115LESBR_px347.jpg', 'LW641CJ - Technical ', 2, 0, 1),
(307, 160, 'LW642CJ.jpg', 'LW642CJ_px25.jpg', 'LW642CJ_px135.jpg', 'LW642CJ_px347.jpg', 'LW642CJ', 1, 1, 1),
(308, 160, 'LW642CJ-TX115LESBR.jpg', 'LW642CJ-TX115LESBR_px25.jpg', 'LW642CJ-TX115LESBR_px135.jpg', 'LW642CJ-TX115LESBR_px347.jpg', 'LW642CJ - Technical ', 2, 0, 1),
(309, 161, 'LW642CJ.jpg', 'LW642CJ_px25.jpg', 'LW642CJ_px135.jpg', 'LW642CJ_px347.jpg', 'LW642J', 1, 1, 1),
(310, 161, 'LW642J-TX119LECBR.jpg', 'LW642J-TX119LECBR_px25.jpg', 'LW642J-TX119LECBR_px135.jpg', 'LW642J-TX119LECBR_px347.jpg', 'LW642J - Technical D', 2, 0, 1),
(311, 162, 'LW645J.jpg', 'LW645J_px25.jpg', 'LW645J_px135.jpg', 'LW645J_px347.jpg', 'LW645J', 1, 1, 1),
(312, 162, 'LW645J-TX123LESV4.jpg', 'LW645J-TX123LESV4_px25.jpg', 'LW645J-TX123LESV4_px135.jpg', 'LW645J-TX123LESV4_px347.jpg', 'LW645J - Technical D', 2, 0, 1),
(313, 163, 'LW647CJ.jpg', 'LW647CJ_px25.jpg', 'LW647CJ_px135.jpg', 'LW647CJ_px347.jpg', 'LW647CJ', 1, 1, 1),
(314, 163, 'LW647CJ-TX115LNBR.jpg', 'LW647CJ-TX115LNBR_px25.jpg', 'LW647CJ-TX115LNBR_px135.jpg', 'LW647CJ-TX115LNBR_px347.jpg', 'LW647J - Technical D', 2, 0, 1),
(315, 105, 'LW648CJT1.jpg', 'LW648CJT1_px25.jpg', 'LW648CJT1_px135.jpg', 'LW648CJT1_px347.jpg', 'LW648CJT1', 1, 1, 1),
(316, 164, 'LW648CJT1.jpg', 'LW648CJT1_px25.jpg', 'LW648CJT1_px135.jpg', 'LW648CJT1_px347.jpg', 'LW648JT1', 1, 1, 1),
(317, 164, 'LW648JT1-TX119LNBR.jpg', 'LW648JT1-TX119LNBR_px25.jpg', 'LW648JT1-TX119LNBR_px135.jpg', 'LW648JT1-TX119LNBR_px347.jpg', 'LW648JT1 - Technical', 2, 0, 1),
(318, 165, 'LW648CJT1.jpg', 'LW648CJT1_px25.jpg', 'LW648CJT1_px135.jpg', 'LW648CJT1_px347.jpg', 'LW648J', 1, 1, 1),
(319, 166, 'LW651J.jpg', 'LW651J_px25.jpg', 'LW651J_px135.jpg', 'LW651J_px347.jpg', 'LW651J', 1, 1, 1),
(320, 166, 'LW651J-TX101LB.jpg', 'LW651J-TX101LB_px25.jpg', 'LW651J-TX101LB_px135.jpg', 'LW651J-TX101LB_px347.jpg', 'LW651J - Technical D', 2, 0, 1),
(321, 167, 'LW660CJ.jpg', 'LW660CJ_px25.jpg', 'LW660CJ_px135.jpg', 'LW660CJ_px347.jpg', 'LW660CJ', 1, 1, 1),
(322, 167, 'LW660CJ-TX101LB.jpg', 'LW660CJ-TX101LB_px25.jpg', 'LW660CJ-TX101LB_px135.jpg', 'LW660CJ-TX101LB_px347.jpg', 'LW660CJ - Technical ', 2, 0, 1),
(323, 168, 'LW660CJ.jpg', 'LW660CJ_px25.jpg', 'LW660CJ_px135.jpg', 'LW660CJ_px347.jpg', 'LW660J', 1, 1, 1),
(324, 168, 'LW660J-TGL600RYRV1N.jpg', 'LW660J-TGL600RYRV1N_px25.jpg', 'LW660J-TGL600RYRV1N_px135.jpg', 'LW660J-TGL600RYRV1N_px347.jpg', 'LW660J - Technical D', 2, 0, 1),
(325, 169, 'LW661CJ.jpg', 'LW661CJ_px25.jpg', 'LW661CJ_px135.jpg', 'LW661CJ_px347.jpg', 'LW661CJ', 1, 1, 1),
(326, 169, 'LW661CJ-TX101LB.jpg', 'LW661CJ-TX101LB_px25.jpg', 'LW661CJ-TX101LB_px135.jpg', 'LW661CJ-TX101LB_px347.jpg', 'LW661CJ - Technical ', 2, 0, 1),
(327, 170, 'LW661CJ.jpg', 'LW661CJ_px25.jpg', 'LW661CJ_px135.jpg', 'LW661CJ_px347.jpg', 'LW661J', 1, 1, 1),
(328, 170, 'LW661J-TGL600RYRV1N.jpg', 'LW661J-TGL600RYRV1N_px25.jpg', 'LW661J-TGL600RYRV1N_px135.jpg', 'LW661J-TGL600RYRV1N_px347.jpg', 'LW661J - Technical D', 2, 0, 1),
(329, 171, 'LW662CJ.jpg', 'LW662CJ_px25.jpg', 'LW662CJ_px135.jpg', 'LW662CJ_px347.jpg', 'LW662CJ', 1, 1, 1),
(330, 171, 'LW662CJ-TX101LB.jpg', 'LW662CJ-TX101LB_px25.jpg', 'LW662CJ-TX101LB_px135.jpg', 'LW662CJ-TX101LB_px347.jpg', 'LW662CJ - Technical ', 2, 0, 1),
(331, 172, 'LW662CJ.jpg', 'LW662CJ_px25.jpg', 'LW662CJ_px135.jpg', 'LW662CJ_px347.jpg', 'LW662J ', 1, 1, 1),
(332, 172, 'LW662J-TGL600RYRV1N.jpg', 'LW662J-TGL600RYRV1N_px25.jpg', 'LW662J-TGL600RYRV1N_px135.jpg', 'LW662J-TGL600RYRV1N_px347.jpg', 'LW662J  - Technical ', 2, 0, 1),
(333, 173, 'LW665CJT1.jpg', 'LW665CJT1_px25.jpg', 'LW665CJT1_px135.jpg', 'LW665CJT1_px347.jpg', 'LW665CJT1', 1, 1, 1),
(334, 173, 'LW665CJT1-LW665FJ-TX101LB.jpg', 'LW665CJT1-LW665FJ-TX101LB_px25.jpg', 'LW665CJT1-LW665FJ-TX101LB_px135.jpg', 'LW665CJT1-LW665FJ-TX101LB_px347.jpg', 'LW665CJT1 - Technica', 2, 0, 1),
(335, 174, 'LW665FJ.jpg', 'LW665FJ_px25.jpg', 'LW665FJ_px135.jpg', 'LW665FJ_px347.jpg', 'LW665FJ', 1, 1, 1),
(336, 174, 'LW665CJT1-LW665FJ-TX101LB.jpg', 'LW665CJT1-LW665FJ-TX101LB_px25.jpg', 'LW665CJT1-LW665FJ-TX101LB_px135.jpg', 'LW665CJT1-LW665FJ-TX101LB_px347.jpg', 'LW665FJ - Technical ', 2, 0, 1),
(337, 175, 'LW667JW.jpg', 'LW667JW_px25.jpg', 'LW667JW_px135.jpg', 'LW667JW_px347.jpg', 'LW667JW', 1, 1, 1),
(338, 175, 'LW667J-LW668FJT1-TX103LCSBRGC.jpg', 'LW667J-LW668FJT1-TX103LCSBRGC_px25.jpg', 'LW667J-LW668FJT1-TX103LCSBRGC_px135.jpg', 'LW667J-LW668FJT1-TX103LCSBRGC_px347.jpg', 'LW667JW - Technical ', 2, 0, 1),
(339, 176, 'LW668J.jpg', 'LW668J_px25.jpg', 'LW668J_px135.jpg', 'LW668J_px347.jpg', 'LW668J', 1, 1, 1),
(340, 176, 'LW668J-LW668FJ-TX103LCSBRGC.jpg', 'LW668J-LW668FJ-TX103LCSBRGC_px25.jpg', 'LW668J-LW668FJ-TX103LCSBRGC_px135.jpg', 'LW668J-LW668FJ-TX103LCSBRGC_px347.jpg', 'LW668J - Technical D', 2, 0, 1),
(341, 176, 'LW668J-LW668FJ-TX103LCBRGC.jpg', 'LW668J-LW668FJ-TX103LCBRGC_px25.jpg', 'LW668J-LW668FJ-TX103LCBRGC_px135.jpg', 'LW668J-LW668FJ-TX103LCBRGC_px347.jpg', 'LW668J - Technical D', 2, 0, 1),
(342, 177, 'LW668J.jpg', 'LW668J_px25.jpg', 'LW668J_px135.jpg', 'LW668J_px347.jpg', 'LW668FJT1', 1, 1, 1),
(343, 177, 'LW668J-LW668FJ-TX103LCBRGC.jpg', 'LW668J-LW668FJ-TX103LCBRGC_px25.jpg', 'LW668J-LW668FJ-TX103LCBRGC_px135.jpg', 'LW668J-LW668FJ-TX103LCBRGC_px347.jpg', 'LW668FJT1 - Technica', 2, 0, 1),
(344, 178, 'LW668J.jpg', 'LW668J_px25.jpg', 'LW668J_px135.jpg', 'LW668J_px347.jpg', 'LW668J', 1, 1, 1),
(345, 178, 'LW668J-LW668FJ-TX103LCSBRGC.jpg', 'LW668J-LW668FJ-TX103LCSBRGC_px25.jpg', 'LW668J-LW668FJ-TX103LCSBRGC_px135.jpg', 'LW668J-LW668FJ-TX103LCSBRGC_px347.jpg', 'LW668J - Technical D', 2, 0, 1),
(346, 179, 'LW780J.jpg', 'LW780J_px25.jpg', 'LW780J_px135.jpg', 'LW780J_px347.jpg', 'LW780J', 1, 1, 1),
(347, 179, 'LW780J-LW780FJ-TX103LG.jpg', 'LW780J-LW780FJ-TX103LG_px25.jpg', 'LW780J-LW780FJ-TX103LG_px135.jpg', 'LW780J-LW780FJ-TX103LG_px347.jpg', 'LW780J - Technical D', 2, 0, 1),
(348, 180, 'LW780J.jpg', 'LW780J_px25.jpg', 'LW780J_px135.jpg', 'LW780J_px347.jpg', 'LW780FJ', 1, 1, 1),
(349, 180, 'LW780J-LW780FJ-TX103LG.jpg', 'LW780J-LW780FJ-TX103LG_px25.jpg', 'LW780J-LW780FJ-TX103LG_px135.jpg', 'LW780J-LW780FJ-TX103LG_px347.jpg', 'LW780FJ - Technical ', 2, 0, 1),
(350, 181, 'LW780J.jpg', 'LW780J_px25.jpg', 'LW780J_px135.jpg', 'LW780J_px347.jpg', 'LW780J', 1, 1, 1),
(352, 181, 'LW780J-LW780FJ-TX103LG.jpg', 'LW780J-LW780FJ-TX103LG_px25.jpg', 'LW780J-LW780FJ-TX103LG_px135.jpg', 'LW780J-LW780FJ-TX103LG_px347.jpg', 'LW780J - Technical D', 2, 0, 1),
(353, 182, 'LW781CJ.jpg', 'LW781CJ_px25.jpg', 'LW781CJ_px135.jpg', 'LW781CJ_px347.jpg', 'LW781CJ', 1, 1, 1),
(354, 182, 'LW781CJ-TX108LG.jpg', 'LW781CJ-TX108LG_px25.jpg', 'LW781CJ-TX108LG_px135.jpg', 'LW781CJ-TX108LG_px347.jpg', 'LW781CJ - Technical ', 2, 0, 1),
(355, 183, 'LW781CJ.jpg', 'LW781CJ_px25.jpg', 'LW781CJ_px135.jpg', 'LW781CJ_px347.jpg', 'LW781J', 1, 1, 1),
(356, 183, 'LW781J-TX103LG.jpg', 'LW781J-TX103LG_px25.jpg', 'LW781J-TX103LG_px135.jpg', 'LW781J-TX103LG_px347.jpg', 'LW781J - Technical D', 2, 0, 1),
(357, 184, 'LW7CJ.jpg', 'LW7CJ_px25.jpg', 'LW7CJ_px135.jpg', 'LW7CJ_px347.jpg', 'LW7CJ', 1, 1, 1),
(358, 185, 'LW810CJ.jpg', 'LW810CJ_px25.jpg', 'LW810CJ_px135.jpg', 'LW810CJ_px347.jpg', 'LW810CJ', 1, 1, 1),
(359, 185, 'LW810CJ-TX115LQBR.jpg', 'LW810CJ-TX115LQBR_px25.jpg', 'LW810CJ-TX115LQBR_px135.jpg', 'LW810CJ-TX115LQBR_px347.jpg', 'LW810CJ - Technical ', 2, 0, 1),
(360, 186, 'LW811CJ.jpg', 'LW811CJ_px25.jpg', 'LW811CJ_px135.jpg', 'LW811CJ_px347.jpg', 'LW811CJ', 1, 1, 1),
(361, 186, 'LW811CJ-TX115LQBR.jpg', 'LW811CJ-TX115LQBR_px25.jpg', 'LW811CJ-TX115LQBR_px135.jpg', 'LW811CJ-TX115LQBR_px347.jpg', 'LW811CJ - Technical ', 2, 0, 1),
(362, 188, 'hd_scenery_4323.JPG', 'hd_scenery_4323_px25.JPG', 'hd_scenery_4323_px135.JPG', 'hd_scenery_4323_px347.JPG', 'asdasdasd', 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_product_pic_setting`
--

CREATE TABLE IF NOT EXISTS `zpxf_product_pic_setting` (
  `id_prodpic_setting` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(25) NOT NULL,
  `name` varchar(5) NOT NULL,
  `width` mediumint(5) NOT NULL,
  `height` mediumint(5) NOT NULL,
  PRIMARY KEY (`id_prodpic_setting`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `zpxf_product_pic_setting`
--

INSERT INTO `zpxf_product_pic_setting` (`id_prodpic_setting`, `section`, `name`, `width`, `height`) VALUES
(1, 'product', 's', 25, 25),
(2, 'product', 'm', 135, 135),
(3, 'product', 'l', 347, 347);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_product_price`
--

CREATE TABLE IF NOT EXISTS `zpxf_product_price` (
  `id_product_price` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `whole_price` int(18) NOT NULL,
  `base_price` int(18) NOT NULL,
  `tax` smallint(3) NOT NULL,
  `disc` int(15) NOT NULL,
  `disc_type` varchar(15) NOT NULL,
  PRIMARY KEY (`id_product_price`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=184 ;

--
-- Dumping data untuk tabel `zpxf_product_price`
--

INSERT INTO `zpxf_product_price` (`id_product_price`, `id_product`, `whole_price`, `base_price`, `tax`, `disc`, `disc_type`) VALUES
(1, 1, 195000, 195000, 0, 50, 'Percent'),
(2, 2, 0, 2200000, 0, 40, 'Percent'),
(3, 3, 195000, 195000, 0, 50, 'Percent'),
(4, 4, 195000, 195000, 0, 50, 'Percent'),
(5, 5, 195000, 195000, 0, 50, 'Percent'),
(6, 6, 195000, 195000, 0, 50, 'Percent'),
(7, 8, 213, 5435, 0, 0, 'Percent'),
(8, 10, 200000, 150000, 10, 30, 'Percent'),
(9, 11, 0, 200000, 0, 10, 'Percent'),
(10, 13, 0, 100000, 0, 10, 'Percent'),
(11, 14, 0, 10500000, 0, 31, 'Percent'),
(12, 15, 0, 7500000, 0, 31, 'Percent'),
(13, 16, 0, 6990000, 0, 31, 'Percent'),
(14, 17, 0, 6990000, 0, 31, 'Percent'),
(15, 18, 0, 6400000, 0, 31, 'Percent'),
(16, 19, 0, 6350000, 0, 31, 'Percent'),
(17, 20, 0, 5480000, 0, 31, 'Percent'),
(18, 21, 0, 4700000, 0, 31, 'Percent'),
(19, 22, 0, 4700000, 0, 31, 'Percent'),
(20, 23, 0, 4700000, 0, 31, 'Percent'),
(21, 24, 0, 4200000, 0, 31, 'Percent'),
(22, 25, 0, 6300000, 0, 31, 'Percent'),
(23, 26, 0, 6200000, 0, 31, 'Percent'),
(24, 27, 0, 6000000, 0, 31, 'Percent'),
(25, 28, 0, 4710000, 0, 31, 'Percent'),
(26, 29, 0, 4980000, 0, 31, 'Percent'),
(27, 30, 0, 4880000, 0, 31, 'Percent'),
(28, 31, 0, 5100000, 0, 31, 'Percent'),
(29, 32, 0, 5000000, 0, 31, 'Percent'),
(30, 33, 0, 4300000, 0, 31, 'Percent'),
(31, 34, 0, 4100000, 0, 31, 'Percent'),
(32, 35, 0, 4100000, 0, 31, 'Percent'),
(33, 36, 0, 4100000, 0, 31, 'Percent'),
(34, 37, 0, 3620000, 0, 31, 'Percent'),
(35, 38, 0, 3600000, 0, 31, 'Percent'),
(36, 39, 0, 3490000, 0, 31, 'Percent'),
(37, 40, 0, 3260000, 0, 31, 'Percent'),
(38, 41, 0, 3230000, 0, 31, 'Percent'),
(39, 42, 0, 3110000, 0, 31, 'Percent'),
(40, 43, 0, 2830000, 0, 31, 'Percent'),
(41, 44, 0, 2360000, 0, 31, 'Percent'),
(42, 45, 0, 2360000, 0, 31, 'Percent'),
(43, 46, 0, 7740000, 0, 31, 'Percent'),
(44, 47, 0, 9700000, 0, 31, 'Percent'),
(45, 48, 0, 6590000, 0, 31, 'Percent'),
(46, 49, 0, 6900000, 0, 31, 'Percent'),
(47, 50, 0, 6880000, 0, 31, 'Percent'),
(48, 51, 0, 6010000, 0, 31, 'Percent'),
(49, 52, 0, 5481000, 0, 31, 'Percent'),
(50, 53, 0, 4580000, 0, 31, 'Percent'),
(51, 54, 0, 5550000, 0, 31, 'Percent'),
(52, 55, 0, 4810000, 0, 31, 'Percent'),
(53, 56, 0, 4130000, 0, 31, 'Percent'),
(54, 57, 0, 9220000, 0, 31, 'Percent'),
(55, 58, 0, 8950000, 0, 31, 'Percent'),
(56, 59, 0, 8990000, 0, 31, 'Percent'),
(57, 60, 0, 8810000, 0, 31, 'Percent'),
(58, 61, 0, 8570000, 0, 31, 'Percent'),
(59, 62, 0, 8190000, 0, 31, 'Percent'),
(60, 63, 0, 5540000, 0, 31, 'Percent'),
(61, 64, 0, 4660000, 0, 31, 'Percent'),
(62, 65, 0, 4610000, 0, 31, 'Percent'),
(63, 66, 0, 4460000, 0, 31, 'Percent'),
(64, 67, 0, 3190000, 0, 31, 'Percent'),
(65, 68, 0, 6080000, 0, 31, 'Percent'),
(66, 69, 0, 3130000, 0, 31, 'Percent'),
(67, 70, 0, 7100000, 0, 31, 'Percent'),
(68, 71, 0, 7670000, 0, 31, 'Percent'),
(69, 72, 0, 6860000, 0, 31, 'Percent'),
(70, 73, 0, 7430000, 0, 31, 'Percent'),
(71, 74, 0, 6940000, 0, 31, 'Percent'),
(72, 75, 0, 7510000, 0, 31, 'Percent'),
(73, 76, 0, 6700000, 0, 31, 'Percent'),
(74, 77, 0, 7270000, 0, 31, 'Percent'),
(75, 78, 0, 5550000, 0, 31, 'Percent'),
(76, 79, 0, 6120000, 0, 31, 'Percent'),
(77, 80, 0, 5700000, 0, 31, 'Percent'),
(78, 81, 0, 6270000, 0, 31, 'Percent'),
(79, 82, 0, 4970000, 0, 31, 'Percent'),
(80, 83, 0, 4300000, 0, 31, 'Percent'),
(81, 84, 0, 4110000, 0, 31, 'Percent'),
(82, 85, 0, 4100000, 0, 31, 'Percent'),
(83, 86, 0, 3920000, 0, 31, 'Percent'),
(84, 87, 0, 2400000, 0, 31, 'Percent'),
(85, 88, 0, 2160000, 0, 31, 'Percent'),
(86, 89, 0, 1970000, 0, 31, 'Percent'),
(87, 90, 0, 6110000, 0, 31, 'Percent'),
(88, 91, 0, 3380000, 0, 31, 'Percent'),
(89, 92, 0, 433000, 0, 31, 'Percent'),
(90, 93, 0, 249000, 0, 31, 'Percent'),
(91, 94, 0, 5211000, 0, 31, 'Percent'),
(92, 95, 0, 1285000, 0, 31, 'Percent'),
(93, 96, 0, 2167000, 0, 31, 'Percent'),
(94, 97, 0, 1046000, 0, 31, 'Percent'),
(95, 98, 0, 4464000, 0, 31, 'Percent'),
(96, 99, 0, 5886000, 0, 31, 'Percent'),
(97, 100, 0, 5408000, 0, 31, 'Percent'),
(98, 101, 0, 4925000, 0, 31, 'Percent'),
(99, 102, 0, 1431000, 0, 31, 'Percent'),
(100, 103, 0, 1039000, 0, 31, 'Percent'),
(101, 104, 0, 2355000, 0, 31, 'Percent'),
(102, 106, 0, 1214000, 0, 31, 'Percent'),
(103, 107, 0, 1151000, 0, 31, 'Percent'),
(104, 108, 0, 1151000, 0, 31, 'Percent'),
(105, 109, 0, 2695000, 0, 31, 'Percent'),
(106, 110, 0, 2355000, 0, 31, 'Percent'),
(107, 111, 0, 1086000, 0, 31, 'Percent'),
(108, 112, 0, 1046000, 0, 31, 'Percent'),
(109, 113, 0, 1044000, 0, 31, 'Percent'),
(110, 114, 0, 1046000, 0, 31, 'Percent'),
(111, 115, 0, 953000, 0, 31, 'Percent'),
(112, 116, 0, 953000, 0, 31, 'Percent'),
(113, 117, 0, 556000, 0, 31, 'Percent'),
(114, 118, 0, 1026000, 0, 31, 'Percent'),
(115, 119, 0, 956000, 0, 31, 'Percent'),
(116, 120, 0, 1070000, 0, 31, 'Percent'),
(117, 121, 0, 965000, 0, 31, 'Percent'),
(118, 122, 0, 886000, 0, 31, 'Percent'),
(119, 123, 0, 540000, 0, 31, 'Percent'),
(120, 124, 0, 540000, 0, 31, 'Percent'),
(121, 125, 0, 878000, 0, 31, 'Percent'),
(122, 126, 0, 950000, 0, 31, 'Percent'),
(123, 127, 0, 439000, 0, 31, 'Percent'),
(124, 128, 0, 883000, 0, 31, 'Percent'),
(125, 129, 0, 778000, 0, 31, 'Percent'),
(126, 130, 0, 1431000, 0, 31, 'Percent'),
(127, 131, 0, 543000, 0, 31, 'Percent'),
(128, 132, 0, 489000, 0, 31, 'Percent'),
(129, 133, 0, 850000, 0, 31, 'Percent'),
(130, 134, 0, 850000, 0, 31, 'Percent'),
(131, 135, 0, 1181000, 0, 31, 'Percent'),
(132, 136, 0, 325000, 0, 31, 'Percent'),
(133, 137, 0, 1181000, 0, 31, 'Percent'),
(134, 138, 0, 402000, 0, 31, 'Percent'),
(135, 139, 0, 1969000, 0, 31, 'Percent'),
(136, 140, 0, 702000, 0, 31, 'Percent'),
(137, 141, 0, 871000, 0, 31, 'Percent'),
(138, 142, 0, 1969000, 0, 31, 'Percent'),
(139, 143, 0, 2167000, 0, 31, 'Percent'),
(140, 144, 0, 2355000, 0, 31, 'Percent'),
(141, 145, 0, 502000, 0, 31, 'Percent'),
(142, 146, 0, 502000, 0, 31, 'Percent'),
(143, 147, 0, 886000, 0, 31, 'Percent'),
(144, 148, 0, 523000, 0, 31, 'Percent'),
(145, 149, 0, 982000, 0, 31, 'Percent'),
(146, 150, 0, 794000, 0, 31, 'Percent'),
(147, 151, 0, 794000, 0, 31, 'Percent'),
(148, 152, 0, 797000, 0, 31, 'Percent'),
(149, 153, 0, 916000, 0, 31, 'Percent'),
(150, 154, 0, 422000, 0, 31, 'Percent'),
(151, 155, 0, 608000, 0, 31, 'Percent'),
(152, 156, 0, 1094000, 0, 31, 'Percent'),
(153, 157, 0, 1087000, 0, 31, 'Percent'),
(154, 158, 0, 1087000, 0, 31, 'Percent'),
(155, 159, 0, 1070000, 0, 31, 'Percent'),
(156, 160, 0, 1041000, 0, 31, 'Percent'),
(157, 161, 0, 1041000, 0, 31, 'Percent'),
(158, 162, 0, 1622000, 0, 31, 'Percent'),
(159, 163, 0, 1026000, 0, 31, 'Percent'),
(160, 105, 0, 2310000, 0, 31, 'Percent'),
(161, 164, 0, 2310000, 0, 31, 'Percent'),
(162, 165, 0, 2355000, 0, 31, 'Percent'),
(163, 166, 0, 692000, 0, 31, 'Percent'),
(164, 167, 0, 777000, 0, 31, 'Percent'),
(165, 168, 0, 777000, 0, 31, 'Percent'),
(166, 169, 0, 654000, 0, 31, 'Percent'),
(167, 170, 0, 654000, 0, 31, 'Percent'),
(168, 171, 0, 807000, 0, 31, 'Percent'),
(169, 172, 0, 807000, 0, 31, 'Percent'),
(170, 173, 0, 547000, 0, 31, 'Percent'),
(171, 174, 0, 489000, 0, 31, 'Percent'),
(172, 175, 0, 1223000, 0, 31, 'Percent'),
(173, 176, 0, 824000, 0, 31, 'Percent'),
(174, 177, 0, 760000, 0, 31, 'Percent'),
(175, 178, 0, 1790000, 0, 31, 'Percent'),
(176, 179, 0, 1979000, 0, 31, 'Percent'),
(177, 180, 0, 934000, 0, 31, 'Percent'),
(178, 181, 0, 1979000, 0, 31, 'Percent'),
(179, 182, 0, 1313000, 0, 31, 'Percent'),
(180, 183, 0, 1313000, 0, 31, 'Percent'),
(181, 184, 0, 516000, 0, 31, 'Percent'),
(182, 185, 0, 763000, 0, 31, 'Percent'),
(183, 186, 0, 1202000, 0, 31, 'Percent');

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_product_stock`
--

CREATE TABLE IF NOT EXISTS `zpxf_product_stock` (
  `id_prod_stock` mediumint(9) NOT NULL AUTO_INCREMENT,
  `id_product` mediumint(9) NOT NULL,
  `qty` mediumint(9) NOT NULL,
  `deskripsi` text NOT NULL,
  `whole_price` int(18) DEFAULT NULL,
  `base_price` int(18) NOT NULL,
  `tax` smallint(3) NOT NULL,
  `disc` smallint(3) NOT NULL,
  `disc_type` varchar(15) NOT NULL,
  `actual_price` int(18) DEFAULT NULL,
  `re_order` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_prod_stock`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=190 ;

--
-- Dumping data untuk tabel `zpxf_product_stock`
--

INSERT INTO `zpxf_product_stock` (`id_prod_stock`, `id_product`, `qty`, `deskripsi`, `whole_price`, `base_price`, `tax`, `disc`, `disc_type`, `actual_price`, `re_order`) VALUES
(1, 1, 0, '', 0, 195000, 0, 50, 'Percent', 0, 1),
(2, 2, 25, '', 0, 0, 0, 0, 'Percent', 0, 1),
(3, 3, 0, '', 0, 0, 0, 0, 'Percent', 0, 1),
(4, 4, 0, '', 0, 0, 0, 0, 'Percent', 0, 1),
(5, 5, 0, '', 0, 0, 0, 0, 'Percent', 0, 1),
(6, 6, 20, '', 0, 0, 0, 0, 'Percent', 0, 1),
(7, 7, 50, 'General', NULL, 0, 0, 0, '', NULL, 1),
(8, 8, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(10, 9, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(11, 10, 4, 'General', NULL, 0, 0, 0, '', NULL, 1),
(12, 11, 18, 'General', NULL, 0, 0, 0, '', NULL, 1),
(13, 12, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(14, 13, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(15, 14, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(16, 15, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(17, 16, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(18, 17, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(19, 18, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(20, 19, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(21, 20, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(22, 21, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(23, 22, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(24, 23, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(25, 24, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(26, 25, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(27, 26, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(28, 27, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(29, 28, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(30, 29, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(31, 30, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(32, 31, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(33, 32, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(34, 33, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(35, 34, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(36, 35, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(37, 36, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(38, 37, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(39, 38, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(40, 39, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(41, 40, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(42, 41, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(43, 42, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(44, 43, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(45, 44, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(46, 45, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(47, 46, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(48, 47, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(49, 48, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(50, 49, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(51, 50, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(52, 51, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(53, 52, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(54, 53, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(55, 54, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(56, 55, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(57, 56, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(58, 57, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(59, 58, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(60, 59, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(61, 60, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(62, 61, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(63, 62, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(64, 63, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(65, 64, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(66, 65, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(67, 66, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(68, 67, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(69, 68, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(70, 69, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(71, 70, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(72, 71, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(73, 72, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(74, 73, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(75, 74, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(76, 75, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(77, 76, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(78, 77, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(79, 78, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(80, 79, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(81, 80, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(82, 81, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(83, 82, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(84, 83, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(85, 84, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(86, 85, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(87, 86, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(88, 87, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(89, 88, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(90, 89, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(91, 90, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(92, 91, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(93, 92, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(94, 93, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(95, 94, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(96, 95, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(97, 96, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(98, 97, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(99, 98, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(100, 99, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(101, 100, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(102, 101, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(103, 102, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(104, 103, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(105, 104, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(106, 105, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(107, 106, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(108, 107, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(109, 108, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(110, 109, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(111, 110, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(112, 111, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(113, 112, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(114, 113, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(115, 114, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(116, 115, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(117, 116, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(118, 117, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(119, 118, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(120, 119, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(121, 120, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(122, 121, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(123, 122, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(124, 123, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(125, 124, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(126, 125, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(127, 126, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(128, 127, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(129, 128, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(130, 129, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(131, 130, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(132, 131, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(133, 132, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(134, 133, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(135, 134, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(136, 135, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(137, 136, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(138, 137, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(139, 138, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(140, 139, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(141, 140, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(142, 141, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(143, 142, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(144, 143, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(145, 144, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(146, 145, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(147, 146, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(148, 147, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(149, 148, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(150, 149, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(151, 150, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(152, 151, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(153, 152, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(154, 153, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(155, 154, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(156, 155, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(157, 156, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(158, 157, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(159, 158, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(160, 159, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(161, 160, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(162, 161, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(163, 162, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(164, 163, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(165, 164, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(166, 165, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(167, 166, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(168, 167, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(169, 168, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(170, 169, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(171, 170, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(172, 171, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(173, 172, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(174, 173, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(175, 174, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(176, 175, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(177, 176, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(178, 177, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(179, 178, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(180, 179, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(181, 180, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(182, 181, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(183, 182, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(184, 183, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(185, 184, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(186, 185, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(187, 186, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(188, 187, 0, 'General', NULL, 0, 0, 0, '', NULL, 1),
(189, 188, 0, 'General', NULL, 0, 0, 0, '', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_product_stock_pic`
--

CREATE TABLE IF NOT EXISTS `zpxf_product_stock_pic` (
  `idprod_stock_pic` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `idproduct_pic` int(11) NOT NULL,
  `id_prod_stock` int(11) NOT NULL,
  PRIMARY KEY (`idprod_stock_pic`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_product_tag_stock`
--

CREATE TABLE IF NOT EXISTS `zpxf_product_tag_stock` (
  `id_tag_stock` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod_stock` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `alias` varchar(40) NOT NULL,
  `tag` text NOT NULL,
  PRIMARY KEY (`id_tag_stock`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_product_val_attr`
--

CREATE TABLE IF NOT EXISTS `zpxf_product_val_attr` (
  `idp_val_attr` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_prod_att` int(11) NOT NULL,
  `id_prod_stock` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`idp_val_attr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_prod_category`
--

CREATE TABLE IF NOT EXISTS `zpxf_prod_category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `alias` varchar(35) NOT NULL,
  `parent` int(11) NOT NULL,
  `level` smallint(3) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `zpxf_prod_category`
--

INSERT INTO `zpxf_prod_category` (`id_category`, `name`, `alias`, `parent`, `level`, `position`, `enable`) VALUES
(1, 'Toilet', 'toilet', 0, 1, 1, 1),
(2, 'Lavatory', 'lavatory', 0, 1, 2, 1),
(3, 'Urinal', 'urinal', 0, 1, 3, 1),
(4, 'Bidet', 'bidet', 0, 1, 4, 1),
(5, 'Fitting', 'fitting', 0, 1, 5, 1),
(6, 'Bathroom Accessories', 'bathroom-accessories', 0, 1, NULL, 1),
(7, 'Others', 'others', 0, 1, NULL, 1),
(8, 'Sink', 'sink', 0, 1, NULL, 1),
(9, 'Bathtubs', 'bathtubs', 0, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_p_attribute`
--

CREATE TABLE IF NOT EXISTS `zpxf_p_attribute` (
  `id_prod_att` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_prod_att`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_p_feature`
--

CREATE TABLE IF NOT EXISTS `zpxf_p_feature` (
  `idp_feature` int(11) NOT NULL AUTO_INCREMENT,
  `feature_name` varchar(25) NOT NULL,
  `position` tinyint(1) NOT NULL,
  PRIMARY KEY (`idp_feature`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `zpxf_p_feature`
--

INSERT INTO `zpxf_p_feature` (`idp_feature`, `feature_name`, `position`) VALUES
(1, 'Size', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_p_val_attr`
--

CREATE TABLE IF NOT EXISTS `zpxf_p_val_attr` (
  `idp_val_attr` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod_att` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`idp_val_attr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `zpxf_p_val_attr`
--

INSERT INTO `zpxf_p_val_attr` (`idp_val_attr`, `id_prod_att`, `name`) VALUES
(1, 1, 'Red'),
(2, 1, 'Yellow'),
(3, 1, 'Yellow-Red-Black'),
(4, 2, 'S'),
(5, 2, 'M');

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_reward_list`
--

CREATE TABLE IF NOT EXISTS `zpxf_reward_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `value` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `used_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data untuk tabel `zpxf_reward_list`
--

INSERT INTO `zpxf_reward_list` (`id`, `code`, `value`, `customer_id`, `dt`, `used`, `used_dt`) VALUES
(1, '1234567', 150000, 1, '2013-02-15 00:00:00', 1, '0000-00-00 00:00:00'),
(2, '13039472', 100, 2, '2013-03-01 12:41:33', 1, '0000-00-00 00:00:00'),
(3, '13037184', 100, 2, '2013-03-01 12:45:36', 1, '0000-00-00 00:00:00'),
(4, '13039009', 100, 6, '2013-03-01 15:35:30', 0, '0000-00-00 00:00:00'),
(5, '13031579', 100, 6, '2013-03-01 15:36:13', 0, '0000-00-00 00:00:00'),
(6, '13037775', 100, 6, '2013-03-01 15:36:15', 0, '0000-00-00 00:00:00'),
(7, '13031080', 100, 6, '2013-03-01 15:36:18', 0, '0000-00-00 00:00:00'),
(8, '13039317', 100, 6, '2013-03-01 15:37:20', 0, '0000-00-00 00:00:00'),
(9, '13035345', 100, 7, '2013-03-01 15:44:34', 0, '0000-00-00 00:00:00'),
(10, '13035569', 100, 7, '2013-03-01 15:49:49', 0, '0000-00-00 00:00:00'),
(11, '13036520', 100, 7, '2013-03-01 15:53:56', 0, '0000-00-00 00:00:00'),
(12, '13031904', 100, 6, '2013-03-01 15:57:02', 0, '0000-00-00 00:00:00'),
(13, '13036432', 100, 2, '2013-03-04 13:46:22', 0, '0000-00-00 00:00:00'),
(14, '13035546', 100, 7, '2013-03-04 15:44:28', 0, '0000-00-00 00:00:00'),
(15, '13033555', 100, 7, '2013-03-04 15:45:32', 0, '0000-00-00 00:00:00'),
(16, '13035885', 100, 6, '2013-03-04 15:49:02', 0, '0000-00-00 00:00:00'),
(17, '13039986', 100, 7, '2013-03-04 15:49:44', 0, '0000-00-00 00:00:00'),
(18, '13031866', 100, 6, '2013-03-04 15:51:01', 1, '0000-00-00 00:00:00'),
(19, '13035017', 100, 6, '2013-03-04 15:51:23', 1, '0000-00-00 00:00:00'),
(20, '13037590', 100, 7, '2013-03-04 15:51:42', 0, '0000-00-00 00:00:00'),
(21, '13032083', 100, 7, '2013-03-04 15:53:13', 0, '0000-00-00 00:00:00'),
(22, '13034303', 100, 2, '2013-03-04 19:49:44', 0, '0000-00-00 00:00:00'),
(23, '13038835', 100, 6, '2013-03-05 14:40:18', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_reward_setting`
--

CREATE TABLE IF NOT EXISTS `zpxf_reward_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(18) NOT NULL,
  `reward` int(18) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `zpxf_reward_setting`
--

INSERT INTO `zpxf_reward_setting` (`id`, `value`, `reward`, `enable`) VALUES
(5, 80000, 100, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_settings`
--

CREATE TABLE IF NOT EXISTS `zpxf_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `zpxf_settings`
--

INSERT INTO `zpxf_settings` (`id`, `name`, `value`) VALUES
(1, 'base_url', 'http://localhost/cms-master/'),
(2, 'site_name', 'permata.com'),
(3, 'site_year', '2013'),
(4, 'currency', '10000'),
(5, 'import', 'test.xls');

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_shipping`
--

CREATE TABLE IF NOT EXISTS `zpxf_shipping` (
  `id_shipping` mediumint(8) NOT NULL AUTO_INCREMENT,
  `id_region` mediumint(8) NOT NULL,
  `name` varchar(35) NOT NULL,
  `cost` int(18) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_shipping`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `zpxf_shipping`
--

INSERT INTO `zpxf_shipping` (`id_shipping`, `id_region`, `name`, `cost`, `enable`) VALUES
(8, 6, 'Dago', 25000, 1),
(9, 6, 'Outside Jabodetabek', 25000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_shipping_region`
--

CREATE TABLE IF NOT EXISTS `zpxf_shipping_region` (
  `id_region` mediumint(8) NOT NULL AUTO_INCREMENT,
  `region_name` varchar(45) NOT NULL,
  `flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `zpxf_shipping_region`
--

INSERT INTO `zpxf_shipping_region` (`id_region`, `region_name`, `flag`) VALUES
(6, 'Indonesia', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_site_newsletter`
--

CREATE TABLE IF NOT EXISTS `zpxf_site_newsletter` (
  `id_newsletter` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(75) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_newsletter`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `zpxf_site_newsletter`
--

INSERT INTO `zpxf_site_newsletter` (`id_newsletter`, `email`, `enable`) VALUES
(2, 'andy@pixaal.com', 0),
(3, 'philip@pixaal.com', 1),
(4, 'aaa@bbbb.com', 0),
(5, 'chilimanjatroh@yahoo.co.id', 1),
(6, 'philipsagala82@gmail.com', 1),
(7, 'marcia@pixaal.com', 0),
(8, 'test@test.com', 0),
(9, 'jessica@pixaal.com', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_tag`
--

CREATE TABLE IF NOT EXISTS `zpxf_tag` (
  `id_tag` mediumint(8) NOT NULL AUTO_INCREMENT,
  `alias` varchar(40) NOT NULL,
  `tag` varchar(35) NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_users`
--

CREATE TABLE IF NOT EXISTS `zpxf_users` (
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `salt` varchar(16) NOT NULL,
  `registered` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `user_group` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `address` text,
  `phone` varchar(50) DEFAULT NULL,
  `note` text,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`),
  KEY `user_group` (`user_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `zpxf_users`
--

INSERT INTO `zpxf_users` (`username`, `email`, `password`, `salt`, `registered`, `last_login`, `user_group`, `firstname`, `lastname`, `gender`, `address`, `phone`, `note`, `status`) VALUES
('demo', 'andy@pixaal.com', '0520c604807a56204a28724d4b5505819d91aff3', 'demodemodemodemo', '2012-12-15 18:00:00', '2012-12-17 23:00:00', 'administrator', 'Andy', 'Kencana', 'male', 'Tangerang', '0858 9000 8023', '', '1'),
('user', 'depan@pixaal.com', '0520c604807a56204a28724d4b5505819d91aff3', 'demodemodemodemo', '2012-12-15 00:00:00', NULL, 'user', 'Depan', 'Belakang', 'female', 'Jakarta', '555', '', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_users_group`
--

CREATE TABLE IF NOT EXISTS `zpxf_users_group` (
  `alias` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `add` enum('0','1') NOT NULL,
  `edit` enum('0','1') NOT NULL,
  `delete` enum('0','1') NOT NULL,
  `menus` text NOT NULL,
  `pages` text NOT NULL,
  PRIMARY KEY (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `zpxf_users_group`
--

INSERT INTO `zpxf_users_group` (`alias`, `name`, `add`, `edit`, `delete`, `menus`, `pages`) VALUES
('administrator', 'Administrator', '1', '1', '1', 'all', 'all'),
('user', 'User', '1', '0', '0', 'dashboard,pages', 'product,services');

-- --------------------------------------------------------

--
-- Struktur dari tabel `zpxf_voucher`
--

CREATE TABLE IF NOT EXISTS `zpxf_voucher` (
  `id_voucher` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `vcr_value` int(15) NOT NULL,
  `date_issue` date NOT NULL,
  `date_start` date NOT NULL,
  `date_expired` date NOT NULL,
  `qty` mediumint(8) NOT NULL,
  `vcr_caption` varchar(75) NOT NULL,
  PRIMARY KEY (`id_voucher`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data untuk tabel `zpxf_voucher`
--

INSERT INTO `zpxf_voucher` (`id_voucher`, `code`, `vcr_value`, `date_issue`, `date_start`, `date_expired`, `qty`, `vcr_caption`) VALUES
(16, 'tttgasdadakjnadjarrr', 150000, '2013-02-06', '2013-02-13', '2013-02-20', 25, 'diskon'),
(21, 'DKLFDKLDSKLFKL', 250000, '2013-02-01', '0000-00-00', '2013-02-28', 100, 'Coucher'),
(23, 'B1E342F27C25C48F2E9A45388', 1500000, '2013-02-21', '0000-00-00', '2013-02-27', 15, 'Fluit'),
(25, '88745DCE8D72A9779A3E1F5EA', 150000, '2013-02-08', '2013-02-15', '2013-02-28', 15, 'Toilet Bayi'),
(26, '030E6C149D79623014AC8B13B', 150000, '2013-02-01', '2013-02-15', '2013-02-28', 15, 'F4D6Fokey'),
(27, 'E9F44946A60F733D1261FBC4A', 150000, '2013-02-13', '2013-02-27', '2013-03-14', 14, 'Promo Toilet Bayi'),
(28, '91DADC12B522361CE6DB25DDA', 100000, '0000-00-00', '2013-03-03', '2013-03-05', 1, 'Test loh');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `zpxf_users`
--
ALTER TABLE `zpxf_users`
  ADD CONSTRAINT `zpxf_users_ibfk_1` FOREIGN KEY (`user_group`) REFERENCES `zpxf_users_group` (`alias`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
