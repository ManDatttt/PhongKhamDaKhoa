<?php
require_once 'cls-admin.php';

class thanhtoan extends admin 
{
    public function xemHoaDon($sql)
    {
        $link = $this->connect(); 
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        $data = []; 
        if ($i > 0)
        {
            while ($row = mysqli_fetch_array($ketqua))
            {
                $id = $row['id'];
                $hoTen = $row['hoTen'];
                $dienThoai = $row['dienThoai'];
                $tongTien = $row['tongTien'];
                $maDonHang = $row['maDonHang'];
                $trangThai = $row['trangThai'];


                $data[] = [
                    'id' => $id,
                    'hoTen' => $hoTen,
                    'dienThoai' => $dienThoai,
                    'tongTien' => $tongTien,
                    'maDonHang' => $maDonHang,
                    'trangThai' => $trangThai
                ];
            }
        }
        return $data;
    }
    
    // Thêm hàm hoaDonDaThanhToan
    public function hoaDonDaThanhToan($dienThoai)
    {
        $link = $this->connect();
        $sql = "SELECT * FROM tbl_thanhtoan WHERE dienThoai = '$dienThoai' AND trangThai = 'Đã thanh toán'";
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);

        // Nếu tìm thấy ít nhất một kết quả, hóa đơn đã được thanh toán
        return $i > 0;
    }
}
?>
