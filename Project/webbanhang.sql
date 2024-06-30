-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 10, 2024 lúc 10:39 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webbanhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(5) NOT NULL,
  `loai` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `loai`) VALUES
(1, 'Trà sữa'),
(2, 'Trà trái cây'),
(3, 'Ăn vặt'),
(4, 'Tô tượng'),
(5, 'Bánh bía');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id` int(5) NOT NULL,
  `tenKhach` varchar(255) NOT NULL,
  `sdt` int(10) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `soSP` int(11) NOT NULL,
  `tongGiaTri` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id`, `tenKhach`, `sdt`, `diachi`, `soSP`, `tongGiaTri`) VALUES
(1, 'chouchou', 1275, ' An Minh, Kiên Giang', 0, 65000),
(2, 'chouchou', 1275, 'ấp 7 xáng, xã Đông Hòa, An Minh, Kiên Giang', 0, 65000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` double(10,0) NOT NULL DEFAULT 0,
  `idcate` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `price`, `idcate`) VALUES
(3, 'Trà sữa trân châu', 'trasua.jpg', 15000, 1),
(4, 'Trà sữa xanh', 'trasua2.jpg', 25000, 1),
(5, 'Trà sữa full topping', 'trasua3.jpg', 30000, 1),
(6, 'Trà trái cây', 'traicay1.jpg', 15000, 2),
(7, 'Trà đào', 'traicay2.jpg', 20000, 2),
(8, 'Bánh tráng cuộn', 'anvat1.jpg', 15000, 3),
(9, 'Bánh tráng trộn', 'anvat2.jpg', 15000, 3),
(10, 'Khoai tây lốc xoáy', 'anvat3.jpg', 15000, 3),
(11, 'Bún đậu mắm tôm', 'bundau.jpg', 45000, 3),
(12, 'Chân gà sả tắc', 'changa.jpg', 40000, 3),
(13, 'Cá viên chiên', 'chaca.jpg', 30000, 3),
(14, 'Trứng nướng', 'nuong.jpg', 10000, 3),
(15, 'Xúc xích nướng đá', 'anvat4.jpg', 15000, 3),
(16, 'Bánh tráng', 'anvat5.jpg', 10000, 3),
(17, 'Bánh flan', 'banhflan.jpg', 8000, 3),
(20, 'Tượng nhỏ', 'tuongnho.jpg', 25000, 4),
(21, 'Tượng lớn', 'tuonglon.jpg', 40000, 4),
(22, 'Trà dâu', 'traicay3.jpg', 20000, 2),
(23, 'Trà mãng cầu', 'traicay4.jpg', 20000, 2),
(24, 'Trà me', 'traicay5.jpg', 20000, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(5) NOT NULL,
  `tenSanPham` varchar(30) NOT NULL,
  `soLuong` int(5) NOT NULL DEFAULT 0,
  `giaSanPham` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `tenSanPham`, `soLuong`, `giaSanPham`) VALUES
(20, 'Trà sữa trân châu', 1, 15000),
(21, 'Bánh tráng trộn', 1, 15000),
(22, 'Bún đậu mắm tôm', 1, 45000),
(23, 'Tượng nhỏ', 9, 25000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` int(30) NOT NULL,
  `sdt` int(10) NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `sdt`, `admin`) VALUES
(2, 'chou1', 12345678, 363828190, 0),
(3, 'chou2', 123456789, 123456789, 0),
(4, 'chouchou22', 11111111, 123456789, 0),
(5, 'admin', 12345678, 3626282, 1),
(6, 'chouthu', 12345678, 123456789, 0),
(7, 'chouchou1', 11111111, 123456789, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcate` (`idcate`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`idcate`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
