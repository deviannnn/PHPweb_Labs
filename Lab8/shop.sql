-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 23, 2017 at 09:10 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `shop`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `product`
-- 

CREATE TABLE `product` (
  `id` varchar(15) collate utf8_unicode_ci NOT NULL,
  `name` varchar(40) collate utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(300) collate utf8_unicode_ci NOT NULL,
  `description` varchar(300) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `product`
-- 

INSERT INTO `product` (`id`, `name`, `price`, `image`, `description`) VALUES 
('0001', 'Samsung Galaxy J7', 8690000, 'images/samsung-galaxy-j7-plus-1-400x460.png', ''),
('0002', 'iPhone 7 Plus 128GB', 20990000, 'images/iphone-7-plus-128gb-de-400x460.png', ''),
('0003', 'Samsung Galaxy J3 Pro', 4490, 'images/samsung-galaxy-j3-2017-2-400x460.png', ''),
('0004', 'Samsung Galaxy Note 5', 9990000, 'images/samsung-galaxy-note-5-2-400x460.png', '');
