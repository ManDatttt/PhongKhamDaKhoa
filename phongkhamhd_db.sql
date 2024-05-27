-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 26, 2024 lúc 09:44 PM
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
(2, 'Trần Thị Bình', '1990', 35, '123123', 'Nữ', '456 Đường DEF, TP. Hà Nội', 1, NULL, '2024-05-23'),
(3, 'Lê Văn C', '1978', 46, NULL, 'Nam', '789 Đường GHI, TP. Đà Nẵng', 0, NULL, '2024-05-23'),
(4, 'Phạm Thị D', '2000', 24, NULL, 'Nữ', '101 Đường JKL, TP. Cần Thơ', 1, NULL, '2024-05-23'),
(5, 'Hoàng Văn E', '1983', 41, NULL, 'Nam', '202 Đường MNO, TP. Hải Phòng', 0, NULL, '2024-05-23'),
(6, 'Vũ Thị F', '1995', 29, NULL, 'Nữ', '303 Đường PQR, TP. Nha Trang', 1, NULL, '2024-05-23'),
(7, 'Đinh Văn G', '1988', 36, NULL, 'Nam', '404 Đường STU, TP. Vũng Tàu', 0, NULL, '2024-05-23'),
(8, 'Ngô Thị H', '1992', 32, NULL, 'Nữ', '505 Đường VWX, TP. Quy Nhơn', 1, NULL, '2024-05-23'),
(9, 'Bùi Văn I', '1980', 44, NULL, 'Nam', '606 Đường YZ, TP. Huế', 0, NULL, '2024-05-23'),
(11, 'Nguyễn Văn A', '1985', 39, '0901234567', 'Nam', '123 Đường ABC, TP. Hồ Chí Minh', 0, 'Nguyễn Thị L', '2024-05-23'),
(12, 'Trần Thị B', '1990', 34, '0912345678', 'Nữ', '456 Đường DEF, TP. Hà Nội', 1, 'Trần Văn M', '2024-05-23'),
(13, 'Lê Văn C', '1978', 46, '0923456789', 'Nam', '789 Đường GHI, TP. Đà Nẵng', 0, 'Lê Thị N', '2024-05-23'),
(14, 'Phạm Thị D', '2000', 24, '0934567890', 'Nữ', '101 Đường JKL, TP. Cần Thơ', 1, 'Phạm Văn O', '2024-05-23'),
(15, 'Hoàng Văn E', '1983', 41, '0945678901', 'Nam', '202 Đường MNO, TP. Hải Phòng', 0, 'Hoàng Thị P', '2024-05-23'),
(16, 'Vũ Thị F', '1995', 29, '0956789012', 'Nữ', '303 Đường PQR, TP. Nha Trang', 1, 'Vũ Văn Q', '2024-05-23'),
(17, 'Đinh Văn G', '1988', 36, '0967890123', 'Nam', '404 Đường STU, TP. Vũng Tàu', 0, 'Đinh Thị R', '2024-05-23'),
(18, 'Ngô Thị H', '1992', 32, '0978901234', 'Nữ', '505 Đường VWX, TP. Quy Nhơn', 1, 'Ngô Văn S', '2024-05-23'),
(19, 'Bùi Văn I', '1980', 44, '0989012345', 'Nam', '606 Đường YZ, TP. Huế', 0, 'Bùi Thị T', '2024-05-23'),
(20, 'Đỗ Thị K', '1998', 26, '0990123456', 'Nữ', '707 Đường 123, TP. Phan Thiết', 1, 'Đỗ Văn U', '2024-05-23'),
(21, 'Mẫn Đạt', '2002', 22, '0374346168', 'Nam', '', 0, NULL, '2024-05-26'),
(22, 'Test', '2000', 24, '0374346168', 'Nữ', '', 0, NULL, '2024-05-19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_khothuoc`
--

CREATE TABLE `tbl_khothuoc` (
  `id` int(11) NOT NULL,
  `tenThuoc` varchar(255) NOT NULL,
  `ngayHetHan` date NOT NULL,
  `giaVon` decimal(10,2) NOT NULL,
  `giaBan` decimal(10,2) NOT NULL,
  `soLuongTon` int(11) NOT NULL,
  `dongGoi` varchar(100) NOT NULL,
  `loai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_khothuoc`
--

INSERT INTO `tbl_khothuoc` (`id`, `tenThuoc`, `ngayHetHan`, `giaVon`, `giaBan`, `soLuongTon`, `dongGoi`, `loai`) VALUES
(3, 'Efticol', '2023-11-30', 500.00, 2220.00, 75, 'lọ', 'Thuốc'),
(4, 'vensal', '2019-11-30', 200.00, 500.00, 120, 'viên', 'Thuốc'),
(5, 'Paracetamol', '2024-06-15', 500.00, 1000.00, 500, 'viên', 'Thuốc'),
(6, 'Ibuprofen', '2024-07-20', 1000.00, 1500.00, 300, 'lọ', 'Thuốc'),
(7, 'Amoxicillin', '2024-08-30', 2000.00, 2500.00, 150, 'hộp', 'Thuốc'),
(8, 'Ciprofloxacin', '2025-01-15', 3000.00, 3500.00, 200, 'hộp', 'Thuốc'),
(9, 'Azithromycin', '2025-03-10', 2500.00, 3000.00, 400, 'viên', 'Thuốc'),
(10, 'Doxycycline', '2025-05-20', 1500.00, 2000.00, 180, 'lọ', 'Thuốc'),
(13, 'Centirizin 10mg', '2024-06-09', 5000.00, 0.00, 500, 'Hộp', 'Thuốc'),
(14, 'ABC', '2024-05-26', 5000.00, 1000.00, 500, 'Hộp', 'Thuốc'),
(15, 'CDE', '2024-06-09', 123.00, 456.00, 789, 'Hộp', 'Thuốc');

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
(11, '', 0, '', '0000-00-00', '00:00:00.000000', '', ''),
(12, '', 0, '', '0000-00-00', '00:00:00.000000', '', ''),
(13, 'Test', 0, 'test@gmail.com', '2024-05-26', '16:49:00.000000', '', 'Test'),
(14, '', 0, '', '0000-00-00', '00:00:00.000000', '', '');

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
(8, 'Thần kinh', '2024-06-01', '8AM - 11AM', 'Hiếu thứ tha'),
(9, 'X quang', '2024-06-08', '8AM - 11AM', 'Hiếu thứ 2'),
(10, 'Răng hàm mặt', '2024-05-26', '8AM - 11AM', 'Admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_thanhtoan`
--

CREATE TABLE `tbl_thanhtoan` (
  `id` int(11) NOT NULL,
  `hoTen` varchar(255) NOT NULL,
  `dienThoai` varchar(20) NOT NULL,
  `tongTien` decimal(15,2) NOT NULL,
  `maDonHang` varchar(50) NOT NULL,
  `trangThai` varchar(50) DEFAULT 'Đã thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_thanhtoan`
--

INSERT INTO `tbl_thanhtoan` (`id`, `hoTen`, `dienThoai`, `tongTien`, `maDonHang`, `trangThai`) VALUES
(1, 'Nguyen Van A', '0909123456', 1350000.00, '1716732603', 'Đã thanh toán'),
(2, 'Nguyen Van A', '0909123456', 150000.00, '1716734102', 'Đã thanh toán'),
(3, 'Nguyen Van A', '0909123456', 150000.00, '1716734777', 'Đã thanh toán'),
(4, 'Nguyen Van A', '0909123456', 1350000.00, '1716734931', 'Đã thanh toán'),
(5, 'Le Van C', '0987654323', 150000.00, '1716745918', 'Đã thanh toán'),
(6, 'Test', '9876543102', 100000.00, '1716748200', 'Đã thanh toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_thuoc`
--

CREATE TABLE `tbl_thuoc` (
  `id` int(11) NOT NULL,
  `toaThuocId` int(11) NOT NULL,
  `tenThuoc` varchar(255) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `lieuDung` varchar(255) NOT NULL,
  `gia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_thuoc`
--

INSERT INTO `tbl_thuoc` (`id`, `toaThuocId`, `tenThuoc`, `soLuong`, `lieuDung`, `gia`) VALUES
(92, 8, 'Paracetamol', 20, '2 viên/ngày', 5000.00),
(93, 8, 'Amoxicillin', 15, '1 viên/ngày', 10000.00),
(94, 3, 'Ibuprofen', 10, '1 viên/ngày', 15000.00),
(95, 2, 'Omeprazole', 30, '1 viên/ngày', 20000.00),
(96, 15, 'Azithromycin', 5, '1 viên/ngày', 25000.00),
(97, 6, 'Prednisone', 25, '1 viên/ngày', 30000.00),
(98, 7, 'Lamivudine', 10, '2 viên/ngày', 35000.00),
(99, 8, 'Amlodipine', 30, '1 viên/ngày', 40000.00),
(100, 9, 'Levothyroxine', 20, '1 viên/ngày', 45000.00),
(101, 10, 'Ferrous sulfate', 60, '1 viên/ngày', 50000.00),
(102, 11, 'Paracetamol', 10, '2 viên/ngày', 55000.00),
(103, 2, 'Amoxicillin', 10, '1 viên/ngày', 60000.00),
(104, 13, 'Ibuprofen', 10, '1 viên/ngày', 65000.00),
(105, 14, 'Omeprazole', 10, '1 viên/ngày', 70000.00),
(106, 15, 'Azithromycin', 10, '1 viên/ngày', 75000.00),
(107, 16, 'Prednisone', 10, '1 viên/ngày', 80000.00),
(108, 17, 'Lamivudine', 10, '2 viên/ngày', 85000.00),
(109, 18, 'Amlodipine', 10, '1 viên/ngày', 90000.00),
(110, 19, 'Levothyroxine', 10, '1 viên/ngày', 95000.00),
(111, 20, 'Ferrous sulfate', 10, '1 viên/ngày', 100000.00),
(113, 1, 'Centirizin 10mg', 10, '1viên/ngày', 10000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_toathuoc`
--

CREATE TABLE `tbl_toathuoc` (
  `id` int(11) NOT NULL,
  `hoTen` varchar(255) DEFAULT NULL,
  `namSinh` int(11) DEFAULT NULL,
  `dienThoai` varchar(15) DEFAULT NULL,
  `gioiTinh` varchar(10) DEFAULT NULL,
  `diaChi` varchar(255) DEFAULT NULL,
  `chanDoan` text DEFAULT NULL,
  `ngayKeDon` date DEFAULT NULL,
  `loiDan` text DEFAULT NULL,
  `tenBacSi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_toathuoc`
--

INSERT INTO `tbl_toathuoc` (`id`, `hoTen`, `namSinh`, `dienThoai`, `gioiTinh`, `diaChi`, `chanDoan`, `ngayKeDon`, `loiDan`, `tenBacSi`) VALUES
(1, 'Test', 2000, '9876543102', 'Nam', 'Test', 'Test', '2024-05-26', 'Test', 'Test'),
(2, 'Tran Thi B', 2005, '0987654322', 'Nữ', '456 Đường B, Hà Nội', 'Viêm họng', '2024-01-02', 'Hạn chế nói chuyện, uống nước ấm', 'Minh Thanh'),
(3, 'Le Van C', 1990, '0987654323', 'Nam', '789 Đường C, Hà Nội', 'Đau đầu', '2024-01-03', 'Nghỉ ngơi, tránh căng thẳng', 'Minh Thanh'),
(4, 'Pham Thi D', 1985, '0987654324', 'Nữ', '123 Đường D, Hà Nội', 'Đau bụng', '2024-01-04', 'Tránh ăn đồ cay, nghỉ ngơi', 'Minh Thanh'),
(5, 'Nguyen Thi E', 2000, '0987654325', 'Nữ', '456 Đường E, Hà Nội', 'Viêm dạ dày', '2024-01-05', 'Ăn uống điều độ, tránh thức khuya', 'Minh Thanh'),
(6, 'Hoang Van F', 1995, '0987654326', 'Nam', '789 Đường F, Hà Nội', 'Ho khan', '2024-01-06', 'Uống nước ấm, tránh lạnh', 'Minh Thanh'),
(7, 'Pham Van G', 1980, '0987654327', 'Nam', '123 Đường G, Hà Nội', 'Sốt cao', '2024-01-07', 'Nghỉ ngơi, uống thuốc hạ sốt', 'Minh Thanh'),
(8, 'Do Thi H', 1975, '0987654328', 'Nữ', '456 Đường H, Hà Nội', 'Đau ngực', '2024-01-08', 'Đi khám chuyên khoa tim', 'Minh Thanh'),
(9, 'Tran Van I', 1960, '0987654329', 'Nam', '789 Đường I, Hà Nội', 'Tiểu đường', '2024-01-09', 'Kiểm soát đường huyết, uống thuốc đúng giờ', 'Minh Thanh'),
(10, 'Le Thi J', 2005, '0987654330', 'Nữ', '123 Đường J, Hà Nội', 'Viêm phế quản', '2024-01-10', 'Uống thuốc kháng sinh, nghỉ ngơi', 'Minh Thanh'),
(11, 'Nguyen Van K', 1998, '0987654331', 'Nam', '456 Đường K, Hà Nội', 'Viêm mũi dị ứng', '2024-01-11', 'Tránh tiếp xúc với dị nguyên', 'Minh Thanh'),
(12, 'Tran Thi L', 1970, '0987654332', 'Nữ', '789 Đường L, Hà Nội', 'Viêm khớp', '2024-01-12', 'Uống thuốc kháng viêm, tập thể dục nhẹ nhàng', 'Minh Thanh'),
(13, 'Le Van M', 1965, '0987654333', 'Nam', '123 Đường M, Hà Nội', 'Gút', '2024-01-13', 'Tránh ăn đồ có purine, uống thuốc giảm đau', 'Minh Thanh'),
(14, 'Pham Thi N', 1983, '0987654334', 'Nữ', '456 Đường N, Hà Nội', 'Viêm gan', '2024-01-14', 'Uống thuốc theo đơn, tái khám định kỳ', 'Minh Thanh'),
(15, 'Nguyen Thi O', 1993, '0987654335', 'Nữ', '789 Đường O, Hà Nội', 'Viêm xoang', '2024-01-15', 'Xông mũi, uống thuốc kháng sinh', 'Minh Thanh'),
(16, 'Hoang Van P', 1987, '0987654336', 'Nam', '123 Đường P, Hà Nội', 'Tăng huyết áp', '2024-01-16', 'Kiểm soát huyết áp, uống thuốc hàng ngày', 'Minh Thanh'),
(17, 'Pham Van Q', 1992, '0987654337', 'Nam', '456 Đường Q, Hà Nội', 'Viêm đường tiết niệu', '2024-01-17', 'Uống nhiều nước, uống thuốc kháng sinh', 'Minh Thanh'),
(18, 'Do Thi R', 1996, '0987654338', 'Nữ', '789 Đường R, Hà Nội', 'Suy giáp', '2024-01-18', 'Uống thuốc hormon tuyến giáp', 'Minh Thanh'),
(19, 'Tran Van S', 1984, '0987654339', 'Nam', '123 Đường S, Hà Nội', 'Đau lưng', '2024-01-19', 'Tập thể dục, uống thuốc giảm đau', 'Minh Thanh'),
(20, 'Le Thi T', 1991, '0987654340', 'Nữ', '456 Đường T, Hà Nội', 'Thiếu máu', '2024-01-20', 'Uống bổ sung sắt, ăn uống đầy đủ dinh dưỡng', 'Minh Thanh');

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
(11, 'Hiếu ', 'Đẹp Trai', 'admin@gmail.com', '20025701', '123', 0),
(14, 'Đạt', 'Đạt', 'man.dat.22099@gmail.com', 'datttt', 'dattt', 2),
(16, 'abc', 'test1', 'admin@gmail.com', 'mandattq', '321654', 0),
(17, 'Huỳnh Mẫn', 'test1', 'datmanhuynh0812@gmail.com', 'mandatt', 'aâSâSâSs', 0),
(18, 'Trâm', 'Anh', 'tramanh79@gmail.com', 'tramanh', 'tramanh', 2),
(19, 'test', 'test', 'test@gmail.com', 'test', 'test', 1),
(20, 'admin', 'admin', 'admin@gmail.com', 'admin', 'admin', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_benhnhan`
--
ALTER TABLE `tbl_benhnhan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_khothuoc`
--
ALTER TABLE `tbl_khothuoc`
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
-- Chỉ mục cho bảng `tbl_thanhtoan`
--
ALTER TABLE `tbl_thanhtoan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_thuoc`
--
ALTER TABLE `tbl_thuoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `toaThuocId` (`toaThuocId`);

--
-- Chỉ mục cho bảng `tbl_toathuoc`
--
ALTER TABLE `tbl_toathuoc`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tbl_khothuoc`
--
ALTER TABLE `tbl_khothuoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tbl_lichhen`
--
ALTER TABLE `tbl_lichhen`
  MODIFY `makh` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_lichkham`
--
ALTER TABLE `tbl_lichkham`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_thanhtoan`
--
ALTER TABLE `tbl_thanhtoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_thuoc`
--
ALTER TABLE `tbl_thuoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT cho bảng `tbl_toathuoc`
--
ALTER TABLE `tbl_toathuoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_thuoc`
--
ALTER TABLE `tbl_thuoc`
  ADD CONSTRAINT `tbl_thuoc_ibfk_1` FOREIGN KEY (`toaThuocId`) REFERENCES `tbl_toathuoc` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
