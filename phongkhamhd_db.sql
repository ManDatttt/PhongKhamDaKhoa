-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 23, 2024 lúc 06:43 PM
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
-- Cơ sở dữ liệu: `phongkhamhd_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_benhnhan`
--

CREATE TABLE `tbl_benhnhan` (
  `id` int(11) NOT NULL,
  `hoten` varchar(100) NOT NULL,
  `namsinh` year(4) NOT NULL,
  `tuoi` int(11) NOT NULL,
  `sdt` varchar(15) DEFAULT NULL,
  `gioitinh` enum('Nam','Nữ') NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `benhnhancu` tinyint(1) NOT NULL,
  `nguoibaoho` varchar(100) DEFAULT NULL,
  `ngaykham` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_benhnhan`
--

INSERT INTO `tbl_benhnhan` (`id`, `hoten`, `namsinh`, `tuoi`, `sdt`, `gioitinh`, `diachi`, `benhnhancu`, `nguoibaoho`, `ngaykham`) VALUES
(1, 'Nguyễn Văn A', '1985', 39, NULL, 'Nam', '123 Đường ABC, TP. Hồ Chí Minh', 0, NULL, '2024-05-23'),
(2, 'Trần Thị B', '1990', 34, NULL, 'Nữ', '456 Đường DEF, TP. Hà Nội', 1, NULL, '2024-05-23'),
(3, 'Lê Văn C', '1978', 46, NULL, 'Nam', '789 Đường GHI, TP. Đà Nẵng', 0, NULL, '2024-05-23'),
(4, 'Phạm Thị D', '2000', 24, NULL, 'Nữ', '101 Đường JKL, TP. Cần Thơ', 1, NULL, '2024-05-23'),
(5, 'Hoàng Văn E', '1983', 41, NULL, 'Nam', '202 Đường MNO, TP. Hải Phòng', 0, NULL, '2024-05-23'),
(6, 'Vũ Thị F', '1995', 29, NULL, 'Nữ', '303 Đường PQR, TP. Nha Trang', 1, NULL, '2024-05-23'),
(7, 'Đinh Văn G', '1988', 36, NULL, 'Nam', '404 Đường STU, TP. Vũng Tàu', 0, NULL, '2024-05-23'),
(8, 'Ngô Thị H', '1992', 32, NULL, 'Nữ', '505 Đường VWX, TP. Quy Nhơn', 1, NULL, '2024-05-23'),
(9, 'Bùi Văn I', '1980', 44, NULL, 'Nam', '606 Đường YZ, TP. Huế', 0, NULL, '2024-05-23'),
(10, 'Đỗ Thị K', '1998', 26, NULL, 'Nữ', '707 Đường 123, TP. Phan Thiết', 1, NULL, '2024-05-23'),
(11, 'Nguyễn Văn A', '1985', 39, '0901234567', 'Nam', '123 Đường ABC, TP. Hồ Chí Minh', 0, 'Nguyễn Thị L', '2024-05-23'),
(12, 'Trần Thị B', '1990', 34, '0912345678', 'Nữ', '456 Đường DEF, TP. Hà Nội', 1, 'Trần Văn M', '2024-05-23'),
(13, 'Lê Văn C', '1978', 46, '0923456789', 'Nam', '789 Đường GHI, TP. Đà Nẵng', 0, 'Lê Thị N', '2024-05-23'),
(14, 'Phạm Thị D', '2000', 24, '0934567890', 'Nữ', '101 Đường JKL, TP. Cần Thơ', 1, 'Phạm Văn O', '2024-05-23'),
(15, 'Hoàng Văn E', '1983', 41, '0945678901', 'Nam', '202 Đường MNO, TP. Hải Phòng', 0, 'Hoàng Thị P', '2024-05-23'),
(16, 'Vũ Thị F', '1995', 29, '0956789012', 'Nữ', '303 Đường PQR, TP. Nha Trang', 1, 'Vũ Văn Q', '2024-05-23'),
(17, 'Đinh Văn G', '1988', 36, '0967890123', 'Nam', '404 Đường STU, TP. Vũng Tàu', 0, 'Đinh Thị R', '2024-05-23'),
(18, 'Ngô Thị H', '1992', 32, '0978901234', 'Nữ', '505 Đường VWX, TP. Quy Nhơn', 1, 'Ngô Văn S', '2024-05-23'),
(19, 'Bùi Văn I', '1980', 44, '0989012345', 'Nam', '606 Đường YZ, TP. Huế', 0, 'Bùi Thị T', '2024-05-23'),
(20, 'Đỗ Thị K', '1998', 26, '0990123456', 'Nữ', '707 Đường 123, TP. Phan Thiết', 1, 'Đỗ Văn U', '2024-05-23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_lichhen`
--

CREATE TABLE `tbl_lichhen` (
  `makh` int(10) UNSIGNED NOT NULL,
  `tenkh` varchar(50) NOT NULL,
  `sdt` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ngay` date NOT NULL,
  `gio` time(6) NOT NULL,
  `bacsi` varchar(50) NOT NULL,
  `tieude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_lichhen`
--

INSERT INTO `tbl_lichhen` (`makh`, `tenkh`, `sdt`, `email`, `ngay`, `gio`, `bacsi`, `tieude`) VALUES
(1, 'Mẫn Đạt', 374346168, 'man.dat.22097@gmail.com', '2024-04-24', '00:00:08.000000', 'Trâm Anh', 'Đau bụng'),
(2, 'Đạt ĐZ', 374346168, 'man.dat.22097@gmail.com', '2024-04-25', '00:00:08.000000', 'Trâm Anh', 'Chóng mặt'),
(3, 'Mẫn Đạt', 374346168, 'man.dat.22097@gmail.com', '2024-04-24', '00:00:08.000000', 'Trâm Anh', 'Đau bụng'),
(4, 'Mẫn Đạt', 374346168, 'man.dat.22097@gmail.com', '2024-04-24', '00:00:08.000000', 'Trâm Anh', 'Đau bụng'),
(5, 'Mẫn Đạt', 374346168, 'man.dat.22097@gmail.com', '2024-04-24', '00:00:08.000000', 'Trâm Anh', 'Đau bụng'),
(7, 'Đạt', 123123, 'man.dat.22097@gmail.com', '2022-12-08', '14:06:00.000000', '', 'abc'),
(8, 'Đạt', 123123, 'man.dat.22097@gmail.com', '2022-12-08', '14:06:00.000000', '', 'abc'),
(9, 'Đạt', 123123, 'man.dat.22097@gmail.com', '2022-12-08', '14:06:00.000000', '', 'abc'),
(10, '', 0, '', '0000-00-00', '00:00:00.000000', '', ''),
(11, '', 0, '', '0000-00-00', '00:00:00.000000', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_lichkham`
--

CREATE TABLE `tbl_lichkham` (
  `id` int(10) UNSIGNED NOT NULL,
  `khoa` varchar(50) NOT NULL,
  `ngay` date NOT NULL,
  `gio` varchar(50) NOT NULL,
  `bacsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_lichkham`
--

INSERT INTO `tbl_lichkham` (`id`, `khoa`, `ngay`, `gio`, `bacsi`) VALUES
(2, 'Ngoại Thần Kinh', '2024-05-23', '8AM - 11AM', 'Hiếu '),
(8, 'Thần kinh', '2024-06-01', '8AM - 11AM', 'Hiếu thứ tha');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `hodem` varchar(50) DEFAULT NULL,
  `ten` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `hodem`, `ten`, `email`, `username`, `password`, `role`) VALUES
(7, 'Anh Đạt', 'aaaa', 'man.dat.22097@gmail.com', 'datmanhuynh', '123456', 0),
(8, 'Huỳnh Mẫn', 'Đạtt', 'man.dat.22097@gmail.com', 'mandat1', '123123', 0),
(11, 'Hiếu ', 'Đẹp Trai', 'admin@gmail.com', '20025701', '123', 0),
(14, 'Đạt', 'Đạt', 'man.dat.22099@gmail.com', 'datttt', 'dattt', 2),
(16, 'abc', 'test1', 'admin@gmail.com', 'mandattq', '321654', 0),
(17, 'Huỳnh Mẫn', 'test1', 'datmanhuynh0812@gmail.com', 'mandatt', 'aâSâSâSs', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_benhnhan`
--
ALTER TABLE `tbl_benhnhan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_lichhen`
--
ALTER TABLE `tbl_lichhen`
  ADD PRIMARY KEY (`makh`);

--
-- Chỉ mục cho bảng `tbl_lichkham`
--
ALTER TABLE `tbl_lichkham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_benhnhan`
--
ALTER TABLE `tbl_benhnhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbl_lichhen`
--
ALTER TABLE `tbl_lichhen`
  MODIFY `makh` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_lichkham`
--
ALTER TABLE `tbl_lichkham`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
