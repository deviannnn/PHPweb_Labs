-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 29, 2017 lúc 11:07 AM
-- Phiên bản máy phục vụ: 5.6.35
-- Phiên bản PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Cơ sở dữ liệu: `online_marketing`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_details`
--

CREATE TABLE `bill_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `note`) VALUES
(1, 'Apple', ''),
(2, 'Samsung', ''),
(3, 'Oppo', ''),
(4, 'Google', ''),
(5, 'Nokia', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vote` int(11) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `vote`, `image`, `type`) VALUES
(1, 'iPhone 7', 10990000, '', 4, 'images/iphone-7-plus-128gb-de-400x460.png', 1),
(2, 'Samsung Galaxy J3', 8490000, '', 3, 'images/samsung-galaxy-j3-2017-2-400x460-1.png', 2),
(3, 'Samsung Galaxy J5', 5490000, '', 4, 'images/samsung-galaxy-j3-2017-2-400x460.png', 2),
(4, 'Samsung Galaxy J7', 3490000, '', 2, 'images/samsung-galaxy-j7-plus-1-400x460.png', 2),
(5, 'Samsung Galaxy Note 5', 6990000, '', 2, 'images/samsung-galaxy-note-5-2-400x460.png', 2),
(6, 'iPhone 6S', 8500000, '', 5, 'images/iphone-6s-128gb-hong-1-400x450.png', 1),
(7, 'Oppo F3 Plus', 2500000, '', 5, 'images/oppo-f3-plus-1-1-400x460.png', 3),
(8, 'Oppo A7', 12500000, '', 3, 'images/oppo-a71-400x460.png', 3),
(9, 'Google Redmi 4X', 10500000, '', 3, 'images/xiaomi-redmi-4x-400-400x460.png', 4),
(10, 'Google Mi A1', 7500000, '', 3, 'images/xiaomi-mi-a12-400x460.png', 4),
(11, 'Nokia 8', 6300000, '', 3, 'images/nokia-8-1-400x460.png', 5),
(12, 'Nokia 3', 4300000, '', 3, 'images/nokia-3-2-400x460.png', 5);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;