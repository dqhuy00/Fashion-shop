-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 20, 2023 lúc 02:41 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duanmau`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute`
--

CREATE TABLE `attribute` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `static_path` varchar(600) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT 0,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(40) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute`
--

INSERT INTO `attribute` (`id`, `name`, `value`, `static_path`, `parent_id`, `description`, `type`, `user_id`, `created_at`, `update_at`) VALUES
(10, 'màu', 'chọn màu sắt', '', 0, '', 'text', 84, '2023-11-23 02:48:22', '2023-11-23 02:48:22'),
(11, 'đỏ', '#FF0000', '', 10, '', 'color', 84, '2023-11-23 02:49:28', '2023-11-23 02:49:28'),
(12, 'đen', '#000000', '', 10, '', 'color', 84, '2023-11-23 02:50:01', '2023-11-23 02:50:01'),
(13, 'kích thước', 'chọn ký cở', '', 0, '', 'text', 84, '2023-11-23 03:17:18', '2023-11-23 03:17:18'),
(14, 'S', 'S', '', 13, '', 'text', 84, '2023-11-23 03:17:40', '2023-11-23 03:17:40'),
(15, 'M', 'M', '', 13, '', 'text', 84, '2023-11-23 07:49:36', '2023-11-23 07:49:36'),
(16, 'XL', 'XL', '', 13, '', 'text', 84, '2023-11-23 07:49:52', '2023-11-23 07:49:52'),
(17, 'XXL', 'XXL', '', 13, '', 'text', 84, '2023-11-23 07:50:08', '2023-11-23 07:50:08'),
(18, 'vàng', '#FFFF00', '', 10, '', 'color', 84, '2023-11-23 07:50:55', '2023-11-23 07:50:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_customization`
--

CREATE TABLE `attribute_customization` (
  `id` int(11) NOT NULL,
  `customization_id` bigint(20) NOT NULL,
  `attribute_id` bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_customization`
--

INSERT INTO `attribute_customization` (`id`, `customization_id`, `attribute_id`, `parent_id`) VALUES
(64, 55, 11, 10),
(65, 55, 14, 13),
(66, 56, 11, 10),
(67, 56, 15, 13),
(68, 57, 12, 10),
(69, 57, 15, 13),
(70, 58, 12, 10),
(71, 58, 16, 13),
(72, 59, 18, 10),
(73, 59, 15, 13),
(74, 60, 11, 10),
(75, 60, 15, 13),
(76, 61, 12, 10),
(77, 61, 15, 13),
(78, 62, 12, 10),
(79, 62, 17, 13),
(80, 63, 11, 10),
(81, 63, 14, 13),
(82, 64, 11, 10),
(83, 64, 14, 13),
(84, 65, 11, 10),
(85, 65, 15, 13),
(86, 66, 12, 10),
(87, 66, 15, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `banner_group_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp(),
  `sub_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id`, `name`, `url`, `images`, `user_id`, `banner_group_id`, `created_at`, `update_at`, `sub_title`) VALUES
(33, 'Thời trang nam', '', 'store/images/105a84c7c759a640fdff1b3857432d0d.jpg', 84, 13, '2023-12-04 10:27:47', '2023-12-04 10:27:47', ' Spring 2023'),
(34, 'thời trang nữ', 'http://localhost/php/SUNFLOWER/?controller=shop&page=1&category=27', 'store/images/8aec5f03b833822806d721ded2ba2639.jpg', 84, 13, '2023-12-04 10:28:25', '2023-12-04 10:28:25', 'Mua xuân 2023'),
(35, 'phụ kiện thời trang', '', 'store/images/d032426cc8039c8d9d49bdc7edb491dd.jpg', 84, 13, '2023-12-04 10:29:18', '2023-12-04 10:29:18', 'xu hướng mới');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner_group`
--

CREATE TABLE `banner_group` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner_group`
--

INSERT INTO `banner_group` (`id`, `name`, `user_id`, `description`) VALUES
(13, 'home-panner', 84, 'trang hôm banner\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint(20) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `parent_id`, `created_at`, `update_at`, `deleted_at`, `user_id`) VALUES
(25, 'áo khoác nam', 26, '2023-11-17 23:52:17', '2023-11-17 23:52:17', NULL, 84),
(26, 'thời trang nam', 0, '2023-11-21 16:12:51', '2023-11-21 16:12:51', NULL, 84),
(27, 'thời trang nữ', 0, '2023-11-21 16:13:08', '2023-11-21 16:13:08', NULL, 84),
(29, 'áo sơ mi nam', 26, '2023-11-21 16:18:15', '2023-11-21 16:18:15', NULL, 84),
(30, 'quần tay nam', 26, '2023-11-21 16:18:28', '2023-11-21 16:18:28', NULL, 84),
(47, 'Phụ kiện thời trang', 0, '2023-12-04 22:13:42', '2023-12-04 22:13:42', NULL, 84),
(48, 'Túi Sách', 47, '2023-12-04 22:14:08', '2023-12-04 22:14:08', NULL, 84),
(49, 'Giày&dép', 47, '2023-12-04 22:14:28', '2023-12-04 22:14:28', NULL, 84),
(50, 'Áo khoác nữ', 27, '2023-12-04 22:14:58', '2023-12-04 22:14:58', NULL, 84),
(51, 'Đồng hồ ', 47, '2023-12-04 22:17:12', '2023-12-04 22:17:12', NULL, 84);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `text` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `paren_id` bigint(20) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` bigint(11) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `detail_address` varchar(255) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provincial_city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `wards` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `id_user`, `detail_address`, `name`, `phone_number`, `email`, `created_at`, `updated_at`, `provincial_city`, `district`, `wards`) VALUES
(33, 84, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Trúc Bạch'),
(34, 84, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Hoàn Kiếm', 'Phường Đồng Xuân'),
(35, 84, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Hoàn Kiếm', 'Phường Đồng Xuân'),
(36, 84, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Hoàn Kiếm', 'Phường Đồng Xuân'),
(37, 84, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Hoàn Kiếm', 'Phường Đồng Xuân'),
(38, 84, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Hoàn Kiếm', 'Phường Đồng Xuân'),
(52, 84, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Hoàn Kiếm', 'Phường Đồng Xuân'),
(56, NULL, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Trúc Bạch'),
(57, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Trúc Bạch'),
(58, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Trúc Bạch'),
(59, NULL, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Trúc Bạch'),
(61, NULL, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Trúc Bạch'),
(62, NULL, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Vĩnh Phúc'),
(63, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Hà Giang', 'Huyện Mèo Vạc', 'Xã Thượng Phùng'),
(64, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Hà Giang', 'Huyện Mèo Vạc', 'Xã Thượng Phùng'),
(65, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Hà Giang', 'Huyện Mèo Vạc', 'Xã Thượng Phùng'),
(66, NULL, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Cao Bằng', 'Thành phố Cao Bằng', 'Phường Sông Bằng'),
(67, NULL, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Trúc Bạch'),
(68, NULL, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Hà Giang', 'Huyện Đồng Văn', 'Xã Lũng Cú'),
(69, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Cao Bằng', 'Huyện Bảo Lâm', 'Xã Lý Bôn'),
(70, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Hà Giang', 'Huyện Đồng Văn', 'Xã Lũng Cú'),
(71, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Cao Bằng', 'Huyện Bảo Lạc', 'Xã Cốc Pàng'),
(72, NULL, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Hà Giang', 'Huyện Đồng Văn', 'Xã Lũng Cú'),
(73, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Hà Giang', 'Huyện Mèo Vạc', 'Xã Thượng Phùng'),
(74, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Cao Bằng', 'Huyện Bảo Lạc', 'Xã Thượng Hà'),
(75, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Hà Giang', 'Huyện Đồng Văn', 'Thị trấn Phó Bảng'),
(76, NULL, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Hoàn Kiếm', 'Phường Hàng Buồm'),
(77, 84, '', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Hoàn Kiếm', 'Phường Hàng Mã'),
(78, 84, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Vĩnh Phúc'),
(79, 84, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Hà Giang', 'Huyện Mèo Vạc', 'Xã Pải Lủng'),
(80, 84, '', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Trúc Bạch'),
(81, 84, '123123', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Tỉnh Hà Giang', 'Thành phố Hà Giang', 'Phường Trần Phú'),
(82, 84, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Trúc Bạch'),
(83, 84, '', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Hoàn Kiếm', 'Phường Đồng Xuân'),
(84, NULL, '1231', 'Phúc Nuyễn Hoàng', '8477757510', 'nguyenhoangphuc201122@gmail.com', NULL, NULL, 'Thành phố Hà Nội', 'Quận Hoàn Kiếm', 'Phường Hàng Mã');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `update_at` timestamp NULL DEFAULT current_timestamp(),
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `image`
--

INSERT INTO `image` (`id`, `alt`, `image_url`, `product_id`, `update_at`, `create_at`, `deleted_at`) VALUES
(78, 'description image Square Neck Back', 'store/images/03b291362d8a4eebe16ca65d3a7529b1.jpg', 53, '2023-12-15 00:53:23', '2023-12-15 00:53:23', NULL),
(79, 'description image Square Neck Back', 'store/images/c27283538e970de620a685c2c6fa368d.jpg', 53, '2023-12-15 00:53:23', '2023-12-15 00:53:23', NULL),
(80, 'description image Square Neck Back', 'store/images/dc2a7d3bfe60852e9b4e384977dc8190.jpg', 53, '2023-12-15 00:53:23', '2023-12-15 00:53:23', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT 0,
  `description` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `name`, `url`, `parent_id`, `description`, `user_id`, `created_at`, `update_at`) VALUES
(13, 'Trang chủ', '?controller=site', 0, '', 84, '2023-12-04 02:48:26', '2023-12-04 02:48:26'),
(14, 'Cửa hàng', '?controller=shop&page=1', 0, '', 84, '2023-12-04 02:50:12', '2023-12-04 02:50:12'),
(15, 'Thời trang nam', '?controller=shop&page=1&category=26', 14, '', 84, '2023-12-04 03:03:22', '2023-12-04 03:03:22'),
(17, ' thời trang nữ', '?controller=shop&page=1&category=27', 14, '', 84, '2023-12-04 03:20:55', '2023-12-04 03:20:55'),
(18, 'về chúng tôi', '?controller=site&action=about', 0, ' about page', 84, '2023-12-07 16:00:33', '2023-12-07 16:00:33'),
(19, 'liên hệ', '?controller=site&action=concat', 0, ' concat page', 84, '2023-12-07 16:06:37', '2023-12-07 16:06:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `text` varchar(255) NOT NULL,
  `watched_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  `customers_id` bigint(20) NOT NULL,
  `status_id` bigint(20) DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT 0,
  `note` varchar(255) NOT NULL,
  `shipper` varchar(1) NOT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `order_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `update_at`, `customers_id`, `status_id`, `is_paid`, `note`, `shipper`, `payment`, `order_code`) VALUES
(50, '2023-12-09 18:09:39', NULL, 72, 1, 0, '', 'G', 'default', 1702145379),
(51, '2023-12-09 18:09:57', NULL, 73, 1, 0, '', 'G', 'default', 1702145397),
(52, '2023-12-09 18:10:05', NULL, 74, 1, 0, '', 'G', 'momo', 1702145405),
(53, '2023-12-09 18:36:58', NULL, 75, 2, 1, '', 'G', 'momo', 1702147018),
(54, '2023-12-09 18:39:35', NULL, 76, 4, 1, '', 'G', 'momo', 1702147175),
(55, '2023-12-09 18:52:25', NULL, 77, 3, 1, '', 'G', '', 1702147945),
(56, '2023-12-14 13:46:38', NULL, 78, 1, 0, '', 'G', '', 1702561598),
(57, '2023-12-14 13:47:06', NULL, 79, 2, 1, '', 'G', 'momo', 1702561626),
(58, '2023-12-15 00:28:55', NULL, 80, 1, 0, '23', 'G', '', 1702600135),
(59, '2023-12-15 00:29:18', NULL, 81, 1, 1, '', 'G', 'momo', 1702600158),
(60, '2023-12-15 00:31:21', NULL, 82, 1, 1, '', 'G', 'momo', 1702600281),
(61, '2023-12-15 01:25:09', NULL, 83, 3, 0, '', 'G', '', 1702603509),
(62, '2023-12-19 07:34:20', NULL, 84, 1, 0, '', 'G', '', 1702971260);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_item`
--

CREATE TABLE `order_item` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_customization_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `price`, `quantity`, `created_at`, `updated_at`, `product_customization_id`) VALUES
(64, 50, 20000, 1, '2023-12-09 18:09:39', '2023-12-09 18:09:39', 57),
(65, 51, 20000, 1, '2023-12-09 18:09:57', '2023-12-09 18:09:57', 57),
(66, 52, 20000, 1, '2023-12-09 18:10:05', '2023-12-09 18:10:05', 57),
(67, 53, 20000, 1, '2023-12-09 18:36:58', '2023-12-09 18:36:58', 57),
(68, 54, 20000, 1, '2023-12-09 18:39:35', '2023-12-09 18:39:35', 57),
(72, 55, 805500, 3, '2023-12-14 02:14:31', '2023-12-14 02:14:31', 63),
(74, 55, 20000, 3, '2023-12-14 02:20:58', '2023-12-14 02:20:58', 59),
(77, 56, 20000, 1, '2023-12-14 13:46:38', '2023-12-14 13:46:38', 56),
(78, 57, 20000, 1, '2023-12-14 13:47:06', '2023-12-14 13:47:06', 56),
(79, 58, 20000, 2, '2023-12-15 00:28:55', '2023-12-15 00:28:55', 58),
(80, 59, 20000, 2, '2023-12-15 00:29:18', '2023-12-15 00:29:18', 58),
(81, 60, 20000, 2, '2023-12-15 00:31:21', '2023-12-15 00:31:21', 58),
(82, 61, 20000, 2, '2023-12-15 01:25:09', '2023-12-15 01:25:09', 58),
(83, 61, 20000, 2, '2023-12-15 01:25:09', '2023-12-15 01:25:09', 56),
(84, 61, 20000, 1, '2023-12-15 01:25:09', '2023-12-15 01:25:09', 57),
(85, 62, 20000, 1, '2023-12-19 07:34:20', '2023-12-19 07:34:20', 57);

--
-- Bẫy `order_item`
--
DELIMITER $$
CREATE TRIGGER `update_quantity_product_customization` AFTER INSERT ON `order_item` FOR EACH ROW UPDATE product_customization
    SET quantity = quantity - NEW.quantity
WHERE id = NEW.product_customization_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_quantity_products` BEFORE INSERT ON `order_item` FOR EACH ROW UPDATE products SET quantity = quantity - NEW.quantity WHERE id in (SELECT product_id FROM product_customization WHERE id = NEW.product_customization_id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission`
--

CREATE TABLE `permission` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `parent_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permission`
--

INSERT INTO `permission` (`id`, `name`, `code`, `parent_id`) VALUES
(1, 'users', '', 0),
(2, 'thêm users', 'POST_USER', 1),
(3, 'sữa', 'PUT_USER', 1),
(4, 'xóa user', 'DELETE_USER', 1),
(5, 'xem user', 'GET_USER', 1),
(7, 'sản phẩm', '', 0),
(8, 'thêm', 'POST_PRODUCTS', 7),
(9, 'sửa ', 'PUT_PRODUCTS', 7),
(10, 'xóa', 'DELETE_PRODUCTS', 7),
(11, 'xem', 'GET_PRODUCTS', 7),
(12, 'banner', '', 0),
(13, 'thêm', 'POST_BANNER', 12),
(14, 'sữa', 'PUT_BANNER', 12),
(15, 'xóa', 'DELETE_BANNER', 12),
(16, 'xem', 'GET_BANNER', 12),
(17, 'slider', '', 0),
(18, 'thêm', 'POST_SLIDER', 17),
(19, 'sữa', 'PUT_SLIDER', 17),
(20, 'xóa', 'DELETE_SLIDER', 17),
(21, 'xem', 'GET_SLIDER', 17),
(22, 'hóa đơn', '', 0),
(23, 'thêm', 'POST_ORDERS', 22),
(24, 'sửa', 'PUT_ORDERS', 22),
(25, 'xóa', 'DELETE_ORDERS', 22),
(26, 'hiển thị', 'GET_ORDERS', 22),
(27, 'menu', '', 0),
(28, 'tạo', 'POST_MENUS', 27),
(29, 'sữa', 'PUT_MENUS', 27),
(30, 'xóa', 'DELETE_MENUS', 27),
(31, 'xem', 'GET_MENUS', 27),
(32, 'quền', '', 0),
(33, 'phân quyền', 'POST_ROLES', 32),
(34, 'sữa', 'PUT_CREATE', 32),
(35, 'xóa', 'DELETE_ROLES', 32),
(36, 'xem', 'GET_ROLES', 32),
(37, 'nhóm banner', '', 0),
(38, 'tạo', 'CREATE_GROUP_BANNER', 37),
(39, 'sữa', 'UPDATE_GROUP_BANNER', 37),
(40, 'xóa', 'DELETE_GROUP_BANNER', 37),
(41, 'xem', 'GET_GROUP_BANNER', 37),
(42, 'trạng thái đơn hàng', '', 0),
(43, 'thêm', 'POST_STATUS', 42),
(44, 'sữa', 'PUT_STATUS', 42),
(45, 'xóa ', 'DELETE_STATUS', 42),
(46, 'xem', 'GET_STATUS', 42),
(47, 'thuộc tính sản phẩm', '', 0),
(48, 'thêm', 'POST_ATTRIBUTE_PRODUCTS', 47),
(49, 'sữa', 'PUT_ATTRIBUTE_PRODUCTS', 47),
(50, 'xóa', 'DELETE_ATTRIBUTE_PRODUCTS', 47),
(51, 'xem', 'GET_ATTRIBUTE_PRODUCTS', 47);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `count_likes` bigint(20) DEFAULT 0,
  `count_comments` bigint(20) DEFAULT 0,
  `category_id` bigint(20) NOT NULL,
  `count_views` bigint(20) DEFAULT 0,
  `count_buy` bigint(20) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `delete_at` int(11) DEFAULT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT 0,
  `discount` bigint(20) NOT NULL,
  `count_reviews` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `user_id`, `description`, `price`, `count_likes`, `count_comments`, `category_id`, `count_views`, `count_buy`, `created_at`, `updated_at`, `delete_at`, `feature_image`, `quantity`, `discount`, `count_reviews`) VALUES
(38, 'Esprit Ruffle Shirt', 84, '', 20000, 0, 0, 27, 46, 0, '2023-12-04 22:10:37', '2023-12-05 05:10:37', NULL, 'store/images/dc2a7d3bfe60852e9b4e384977dc8190.jpg', 12322, 0, 0),
(39, 'Herschel supply', 84, '', 123000, 0, 0, 27, 24, 0, '2023-12-04 22:11:04', '2023-12-05 05:11:04', NULL, 'store/images/0706cfbf018a3729c6d100aa39ee0ca9.jpg', 123, 0, 0),
(40, 'Only Check Trouser', 84, '', 805500, 0, 0, 29, 28, 0, '2023-12-04 22:11:37', '2023-12-05 05:11:37', NULL, 'store/images/7ed62080a22c45017392f903ac91d84d.jpg', 0, 0, 0),
(41, 'Classic Trench Coat', 84, '123123123', 20000, 0, 0, 50, 56, 0, '2023-12-04 22:12:16', '2023-12-05 05:12:16', NULL, 'store/images/625dc18d6216e3c173aaf05be7555d42.jpg', 12, 0, 0),
(42, 'Front Pocket Jumper', 84, '', 20000, 0, 0, 27, 28, 0, '2023-12-04 22:12:59', '2023-12-05 05:12:59', NULL, 'store/images/2b4c6c957fc7230e996a5f02a28ddf2e.jpg', 123, 0, 0),
(43, 'Vintage Inspired Classic', 84, '', 805500, 0, 0, 51, 31, 0, '2023-12-04 22:16:37', '2023-12-05 05:16:37', NULL, 'store/images/519b0cd92fb2a9e2722119cb822ecf1f.jpg', 123, 0, 0),
(44, 'Shirt in Stretch Cotton', 84, '', 1000000, 0, 0, 27, 26, 0, '2023-12-04 22:18:40', '2023-12-05 05:18:40', NULL, 'store/images/03b291362d8a4eebe16ca65d3a7529b1.jpg', 123, 0, 0),
(45, 'Pieces Metallic Printed', 84, '', 20000, 0, 0, 27, 21, 0, '2023-12-04 22:19:14', '2023-12-05 05:19:14', NULL, 'store/images/f0a419474db95f0e67639100df3eaedd.jpg', 123, 0, 0),
(46, 'Converse All Star Hi Plimsolls', 84, '', 700000, 0, 0, 49, 21, 0, '2023-12-04 22:19:48', '2023-12-05 05:19:48', NULL, 'store/images/0e5b8a4751f82f739a5b6dafa8573301.jpg', 70, 0, 0),
(47, 'Femme T-Shirt In Stripe', 84, '', 200000, 0, 0, 27, 21, 0, '2023-12-04 22:20:26', '2023-12-05 05:20:26', NULL, 'store/images/9e1fcf5761ec552db6bda1bea17332c7.jpg', 123, 0, 0),
(48, 'Herschel supply', 84, '', 805500, 0, 0, 29, 26, 0, '2023-12-04 22:20:42', '2023-12-05 05:20:42', NULL, 'store/images/0e4cd5e26f25ef33d6d28431da43858b.jpg', 12, 0, 0),
(49, 'Herschel supply', 84, '', 123333, 0, 0, 47, 21, 0, '2023-12-04 22:21:00', '2023-12-05 05:21:00', NULL, 'store/images/0c18e1a3fd4c8b34b5122eec3314546c.jpg', 12, 0, 0),
(50, 'T-Shirt with Sleeve', 84, '', 200000, 0, 0, 27, 36, 0, '2023-12-04 22:22:13', '2023-12-05 05:22:13', NULL, 'store/images/1f3d5d5b3b014471bc39cbe036f63103.jpg', 1233, 0, 0),
(51, 'Pretty Little Thing', 84, '', 200001, 0, 0, 27, 64, 0, '2023-12-04 22:22:41', '2023-12-05 05:22:41', NULL, 'store/images/f4217da00daa3fdf6b8318af83f8f91f.jpg', 123, 10000, 0),
(52, 'Mini Silver Mesh Watch', 84, '', 23123123, 0, 0, 51, 124, 0, '2023-12-04 22:24:22', '2023-12-05 05:24:22', NULL, 'store/images/dd46f6b227cae370fedb0349b82ce67a.jpg', 123, 0, 111),
(53, 'Square Neck Back', 84, '', 20000, 0, 0, 27, 480, 0, '2023-12-04 22:25:31', '2023-12-05 05:25:31', NULL, 'store/images/c27283538e970de620a685c2c6fa368d.jpg', 73, 0, 470);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_customization`
--

CREATE TABLE `product_customization` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `weight` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_customization`
--

INSERT INTO `product_customization` (`id`, `product_id`, `weight`, `price`, `quantity`) VALUES
(55, 53, 0, 20000, 10),
(56, 53, 0, 20000, 117),
(57, 53, 0, 20000, 76),
(58, 53, 0, 20000, 92),
(59, 53, 0, 20000, 99),
(60, 40, 0, 805500, 2),
(61, 40, 0, 805500, -1),
(62, 40, 0, 805500, 0),
(63, 40, 0, 805500, -1),
(64, 40, 0, 805500, 0),
(65, 47, 0, 200000, 0),
(66, 48, 0, 805500, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `email` varchar(10) NOT NULL,
  `text` varchar(255) NOT NULL,
  `scores` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `email`, `text`, `scores`, `created_at`, `updated_at`, `name`) VALUES
(41, 52, NULL, '123', '12312', 3, NULL, NULL, '1231'),
(42, 53, 84, '123', '123', 0, NULL, NULL, '123'),
(43, 53, 84, '123', '123', 5, NULL, NULL, '123'),
(44, 53, 84, 'nguyenhoan', '123', 0, NULL, NULL, '123'),
(45, 53, NULL, 'nguyenhoan', '.mn', 0, NULL, NULL, 'asdfasdf');

--
-- Bẫy `product_reviews`
--
DELIMITER $$
CREATE TRIGGER `update_count_reviews` AFTER INSERT ON `product_reviews` FOR EACH ROW UPDATE products SET count_reviews = (count_views + 1) WHERE id = NEW.product_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` bigint(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'khách hàng', '', '2023-12-12 06:02:18'),
(2, 'khách hàng VIP', '', '2023-12-12 06:02:18'),
(3, 'quản lý', NULL, '2023-12-12 06:02:18'),
(8, 'nhân viên', NULL, '2023-12-12 07:15:36'),
(9, 'ádasd', NULL, '2023-12-13 10:44:49'),
(10, 'ádasd', NULL, '2023-12-13 11:39:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_permission`
--

CREATE TABLE `role_permission` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `permission_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_permission`
--

INSERT INTO `role_permission` (`id`, `role_id`, `permission_id`) VALUES
(9, 3, 5),
(10, 3, 4),
(12, 10, 2),
(77, 3, 2),
(78, 3, 4),
(79, 3, 5),
(211, 8, 3),
(212, 8, 2),
(214, 8, 4),
(215, 8, 5),
(216, 8, 8),
(217, 8, 9),
(218, 8, 10),
(219, 8, 11),
(220, 8, 13),
(221, 8, 14),
(222, 8, 15),
(223, 8, 16),
(224, 8, 18),
(225, 8, 19),
(226, 8, 20),
(227, 8, 21),
(228, 8, 23),
(229, 8, 24),
(230, 8, 25),
(231, 8, 26),
(232, 8, 28),
(233, 8, 29),
(234, 8, 30),
(235, 8, 31),
(236, 8, 33),
(237, 8, 34),
(238, 8, 35),
(239, 8, 36),
(240, 3, 3),
(241, 3, 8),
(242, 3, 9),
(243, 3, 10),
(244, 3, 11),
(245, 3, 13),
(246, 3, 14),
(247, 3, 15),
(248, 3, 16),
(249, 3, 18),
(250, 3, 19),
(251, 3, 20),
(252, 3, 21),
(253, 3, 23),
(254, 3, 24),
(255, 3, 25),
(256, 3, 26),
(257, 3, 28),
(258, 3, 29),
(259, 3, 30),
(260, 3, 31),
(261, 3, 33),
(262, 3, 34),
(263, 3, 35),
(264, 3, 36),
(265, 3, 38),
(266, 3, 39),
(267, 3, 40),
(268, 3, 41),
(269, 3, 43),
(270, 3, 44),
(271, 3, 45),
(272, 3, 46),
(273, 3, 48),
(274, 3, 49),
(275, 3, 50),
(276, 3, 51);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sub_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slider`
--

INSERT INTO `slider` (`id`, `name`, `url`, `images`, `user_id`, `created_at`, `update_at`, `sub_title`) VALUES
(17, 'Jackets & Coats', '', 'store/images/1e16fb9f4bc202560e252603e90520ea.jpg', 84, '2023-12-04 22:04:56', '2023-12-04 22:04:56', 'Men New-Season 								'),
(18, 'NEW SEASON ', '', 'store/images/a186f04277d5759aa14f5ee5480bb88c.jpg', 84, '2023-12-04 22:05:55', '2023-12-04 22:05:55', 'Women Collection 2023						'),
(19, 'New arrivals 								', '', 'store/images/0ade37ca58a601f6539ec8a89b50a619.jpg', 84, '2023-12-04 22:06:48', '2023-12-04 22:06:48', 'Men Collection 2018 ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status`
--

CREATE TABLE `status` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(40) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `type` varchar(50) NOT NULL DEFAULT '0',
  `icon` varchar(255) DEFAULT NULL,
  `total_bill` tinyint(1) DEFAULT 1,
  `is_paid` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `status`
--

INSERT INTO `status` (`id`, `name`, `description`, `user_id`, `is_default`, `created_at`, `type`, `icon`, `total_bill`, `is_paid`) VALUES
(1, 'chưa xử lý', '', 84, 1, '2023-11-27 04:04:19', 'warning', '', 1, NULL),
(2, 'đã xữ lý', '', 84, 0, '2023-11-27 04:17:18', 'info', '', 1, NULL),
(3, 'đang vẫn chuyển', '', 84, 0, '2023-11-27 04:17:46', 'info', '', 0, NULL),
(4, 'thành công', '', 84, 0, '2023-11-27 04:18:09', 'success', '', 1, 1),
(5, 'thât bại', '', 84, 0, '2023-11-27 04:39:06', 'danger', '', 1, NULL),
(10, 'ádasd', '', 84, 0, '2023-12-14 06:21:00', 'warning', '', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `photo_url` varchar(255) DEFAULT 'public/assets/img/avatars/5166769102803e3d2df578980e76017c.png',
  `role_id` tinyint(1) NOT NULL,
  `email_vaildate` varchar(255) DEFAULT NULL,
  `google_id` varchar(250) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `logged_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `locked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `photo_url`, `role_id`, `email_vaildate`, `google_id`, `facebook_id`, `logged_at`, `created_at`, `updated_at`, `locked`) VALUES
(84, 'admin1', 'admin01', '$2y$10$Xn1AnWnuh45g1vi07WVGcOoXAC3eZ.mBIpj3va2fkmHD5C0O9jjyy', 'store/avatar/5166769102803e3d2df578980e76017c.png', 3, NULL, NULL, NULL, NULL, '2023-11-17 11:54:53', '2023-11-17 11:54:53', 0),
(85, 'admin2', 'admin2', '$2y$10$IH.GhpjYTHcJkm0wuCjOXO/lBiIpbk8usuEGnOEiYJVD.b07Z5W.e', 'store/avatar/3fa3000faff90e7f8262e44adb1a462e.png', 4, NULL, NULL, NULL, NULL, '2023-11-24 14:36:44', '2023-11-24 14:36:44', 1),
(88, 'admin3', 'admin3', '$2y$10$y69bmiVFx60KLhUFrRI/G.rVsuTpT9HjnayTPvVT22/YIsVEuxB1m', 'store/avatar/c78173996f7de90a13df2c425710859a.jpeg', 1, NULL, NULL, NULL, NULL, '2023-11-25 09:21:16', '2023-11-25 09:21:16', 1),
(89, 'nguyen hoang phuc222', 'admin011633', '$2y$10$b4Jv56D4/fpTxzEmY1bKIOW4n5WpYJV3FX94x.cBMvvBJTTyGS8xO', 'store/avatar/e10c404760146cf2a8e85191b0258c41.jpeg', 1, NULL, NULL, NULL, NULL, '2023-11-26 12:49:57', '2023-11-26 12:49:57', 1),
(90, 'Phúc Nuyễn Hoàng', 'khachhang1', '$2y$10$I/pscB2JY8..IB2X.AleCeHidMDnc85PEzRndQqJVuELDI4DCYz.a', NULL, 1, NULL, NULL, NULL, NULL, '2023-12-11 23:55:52', '2023-12-11 23:55:52', 0),
(91, 'Phúc Nuyễn Hoàng', '123123ádf', '$2y$10$tox5rJAHodHjNfU1Lbh...y1lP7zA2S6HgKKHbyii3P7Jv1a0mGbG', 'public/assets/iconImages/user.png', 1, NULL, NULL, NULL, NULL, '2023-12-11 23:58:45', '2023-12-11 23:58:45', 0),
(92, 'Phúc Nuyễn Hoàng', 'admin011', '$2y$10$gOqimb32pXYTBm5zd38UouGBlP4AFTkHgqtcebqP38mCKE48KxSQu', 'public/assets/iconImages/user.png', 1, NULL, NULL, NULL, NULL, '2023-12-12 07:44:46', '2023-12-12 07:44:46', 0),
(93, '', '', '$2y$10$M82RSlN5Q7W0dJJqL6zwI.7TrgHITqdg0we4.L4Oy.xIKfQK06x/6', 'public/assets/iconImages/user.png', 0, NULL, NULL, NULL, NULL, '2023-12-19 11:38:03', '2023-12-19 11:38:03', 0),
(94, '123', 'admin01123123', '$2y$10$H/EBqoMGUZLuHxHeiBvWWuYuFT7VprcnvwxIh7WLYBoK8GNfSjFwu', 'public/assets/iconImages/user.png', 0, NULL, NULL, NULL, NULL, '2023-12-19 11:38:14', '2023-12-19 11:38:14', 0),
(95, '123', 'admin011633333', '$2y$10$EjGqkR/dEkaGWOm8LV/tUuHThWRkxB0gYjsF18i63aMBx9m79lqZu', 'public/assets/iconImages/user.png', 0, NULL, NULL, NULL, NULL, '2023-12-19 11:40:07', '2023-12-19 11:40:07', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attribute_customization`
--
ALTER TABLE `attribute_customization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_id` (`attribute_id`),
  ADD KEY `attribute_customization_ibfk_2` (`customization_id`);

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `banner_group_id` (`banner_group_id`) USING BTREE;

--
-- Chỉ mục cho bảng `banner_group`
--
ALTER TABLE `banner_group`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_ibfk_1` (`id_user`);

--
-- Chỉ mục cho bảng `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_ibfk_1` (`product_id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `orders_ibfk_1` (`customers_id`);

--
-- Chỉ mục cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `product_customization_id` (`product_customization_id`),
  ADD KEY `order_item_ibfk_1` (`order_id`);

--
-- Chỉ mục cho bảng `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_customization`
--
ALTER TABLE `product_customization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_customization_ibfk_1` (`product_id`);

--
-- Chỉ mục cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`product_id`),
  ADD KEY `product_reviews_ibfk_2` (`user_id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Chỉ mục cho bảng `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_ibfk_1` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `attribute_customization`
--
ALTER TABLE `attribute_customization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `banner_group`
--
ALTER TABLE `banner_group`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT cho bảng `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `permission`
--
ALTER TABLE `permission`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `product_customization`
--
ALTER TABLE `product_customization`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT cho bảng `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `status`
--
ALTER TABLE `status`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attribute`
--
ALTER TABLE `attribute`
  ADD CONSTRAINT `attribute_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `attribute_customization`
--
ALTER TABLE `attribute_customization`
  ADD CONSTRAINT `attribute_customization_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`id`),
  ADD CONSTRAINT `attribute_customization_ibfk_2` FOREIGN KEY (`customization_id`) REFERENCES `product_customization` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `banner_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `banner_ibfk_2` FOREIGN KEY (`banner_group_id`) REFERENCES `banner_group` (`id`);

--
-- Các ràng buộc cho bảng `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON UPDATE SET NULL;

--
-- Các ràng buộc cho bảng `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Các ràng buộc cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_3` FOREIGN KEY (`product_customization_id`) REFERENCES `product_customization` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `product_customization`
--
ALTER TABLE `product_customization`
  ADD CONSTRAINT `product_customization_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`),
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Các ràng buộc cho bảng `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `slider_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
