-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 03, 2025 lúc 03:42 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `knlv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`) VALUES
(1, 'Món chính', 'categories/monchinh.png'),
(2, 'Ăn vặt', 'categories/th1.webp'),
(3, 'Đồ uống', 'categories/th.webp'),
(4, 'Khác', 'categories/khac.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderdate` datetime NOT NULL DEFAULT current_timestamp(),
  `totalprice` int(11) NOT NULL,
  `status` set('Thành công','Thất bại','Chờ xử lý','Đang xử lý') NOT NULL DEFAULT 'Chờ xử lý',
  `id_user` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `orderdate`, `totalprice`, `status`, `id_user`, `note`, `address`, `phone`, `fullname`, `seller_id`) VALUES
(9, '2025-02-11 00:00:00', 30000, 'Thành công', 1, '123', '41/141/25/3 khu phố 7 Đường Trần Đai nghĩa', '', '', 6),
(10, '2025-02-11 00:00:00', 30000, 'Chờ xử lý', 1, 'qưeq', '2thas', '', '', 6),
(11, '2025-02-11 00:00:00', 1148000, 'Thất bại', 4, 'dd', 'dd', '0389330759', 'Nguyễn Thị Thuỷ Tiên', 0),
(12, '2025-03-29 00:00:00', 72000, 'Thất bại', 6, 'd', 'Đường Tô Ký', '0389330759', 'Nguyễn Thị Thuỷ Tiên', 0),
(13, '2025-03-29 00:00:00', 10000, 'Chờ xử lý', 6, 'xxx', 'ddd', '0389330759', 'Nguyễn Thị Thuỷ Tiên', 0),
(14, '2025-03-29 00:00:00', 72000, 'Chờ xử lý', 7, 'â', 'Đường Tô Ký', '0389330759', 'Nguyễn Thị Thuỷ Tiên', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `order_id` int(10) NOT NULL,
  `quantity` int(4) NOT NULL,
  `id_order` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders_detail`
--

INSERT INTO `orders_detail` (`id_product`, `price`, `order_id`, `quantity`, `id_order`) VALUES
(3, 10000, 9, 3, 1),
(3, 10000, 10, 3, 2),
(4, 18000, 11, 113, 3),
(2, 18000, 11, 1, 4),
(2, 18000, 12, 4, 5),
(3, 10000, 13, 1, 6),
(2, 18000, 14, 4, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `id_category`) VALUES
(1, 'Kimbap', 25000, NULL, 'kimbap.webp', 1),
(2, 'Sandwich', 18000, NULL, 'sandwich.webp', 1),
(3, 'Trà tắc', 10000, NULL, 'tratac.webp', 3),
(4, 'Bánh tráng', 10000, NULL, 'banhtrang.webp', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_code` int(11) NOT NULL,
  `reset_expiry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `phone`, `address`, `role`, `password`, `reset_code`, `reset_expiry`) VALUES
(1, 'light81', 'vuilachinhmvp@gmail.com', '946698712', 'đường Quang Trung', 0, 'Ttoan@81', 0, '2025-04-03 12:33:16'),
(4, 'bealonvn', 'vanbao@gmail.com', '0', '', 0, 'Ttoan@81', 0, '2025-04-03 12:33:16'),
(5, 'chanh', 'huychanh01@gmail.com', '09123123123', '123123', 1, '123456', 0, '2025-04-03 12:33:16'),
(6, 'thuytien', 'tiennttps39163@gmail.com', '0389330759', 'sđjd', 1, 'Thuytien965002@', 0, '2025-04-03 12:33:16'),
(7, 'admin1234', 'thuytien1@gmail.com', '', '', 0, 'Thuytien965002@', 0, '2025-04-03 12:33:16'),
(8, 'thuytien12', 'thuytien.hoctap@gmail.com', '0389330759', 'Quận 12', 0, '$2y$10$ONdzyGZXH5sw9MuJEmrn.uybwgeH3yHqJ1YJ27JAWBtun29O1CoxW', 0, '2025-04-03 12:33:16'),
(9, 'thuytien11', 'hiu800hu@gmail.com', '0389330758', 'Quận 12', 0, 'Tien965002@', 0, '2025-04-03 13:06:35');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id_order` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
