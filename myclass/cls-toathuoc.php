<?php
require_once 'cls-admin.php';

class toathuoc extends admin 
{
    public function xemToaThuoc($sql)
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
                $namSinh = $row['namSinh'];
                $dienThoai = $row['dienThoai'];
                $gioiTinh = $row['gioiTinh'];
                $diaChi = $row['diaChi'];
                $chanDoan = $row['chanDoan'];
                $ngayKeDon = $row['ngayKeDon'];
                $loiDan = $row['loiDan'];
                $tenBacSi = $row['tenBacSi'];

                $data[] = [
                    'id' => $id,
                    'hoTen' => $hoTen,
                    'namSinh' => $namSinh,
                    'dienThoai' => $dienThoai,
                    'gioiTinh' => $gioiTinh,
                    'diaChi' => $diaChi,
                    'chanDoan' => $chanDoan,
                    'ngayKeDon' => $ngayKeDon,
                    'loiDan' => $loiDan,
                    'tenBacSi' => $tenBacSi
                ];
            }
        }
        return $data;
    }

    public function addToaThuoc($hoTen, $namSinh, $dienThoai, $gioiTinh, $diaChi, $chanDoan, $ngayKeDon, $loiDan, $tenBacSi)
    {
        $link = $this->connect(); 
        $addToaThuocQuery = "INSERT INTO tbl_toathuoc (hoTen, namSinh, dienThoai, gioiTinh, diaChi, chanDoan, ngayKeDon, loiDan, tenBacSi) 
                        VALUES ('$hoTen', '$namSinh', '$dienThoai', '$gioiTinh', '$diaChi', '$chanDoan', '$ngayKeDon', '$loiDan', '$tenBacSi')";
        if (mysqli_query($link, $addToaThuocQuery)) 
        {
            return "Thêm toa thuốc thành công.";
        } 
        else 
        {
            return "Thêm toa thuốc thất bại: " . mysqli_error($link);
        }
    }

    public function deleteToaThuoc($id)
    {
        $link = $this->connect();
        $sql = "DELETE FROM tbl_toathuoc WHERE id = $id";
        if (mysqli_query($link, $sql)) {
            return "Toa thuốc đã được xóa thành công";
        } else {
            return "Xảy ra lỗi khi xóa toa thuốc: " . mysqli_error($link);
        }
    }

    public function updateToaThuoc($id, $hoTen, $namSinh, $dienThoai, $gioiTinh, $diaChi, $chanDoan, $ngayKeDon, $loiDan, $tenBacSi) 
    {
        $link = $this->connect();
        $updateToaThuocQuery = "UPDATE tbl_toathuoc SET hoTen='$hoTen', namSinh='$namSinh', dienThoai='$dienThoai', gioiTinh='$gioiTinh', diaChi='$diaChi', chanDoan='$chanDoan', ngayKeDon='$ngayKeDon', loiDan='$loiDan', tenBacSi='$tenBacSi' WHERE id='$id'";
        if (mysqli_query($link, $updateToaThuocQuery)) {
            return "Cập nhật toa thuốc thành công.";
        } else {
            return "Cập nhật toa thuốc thất bại: " . mysqli_error($link);
        }
    }
    
    public function prescribeMedicine($toaThuocId, $tenThuoc, $soLuong, $lieuDung, $gia)
    {
    $link = $this->connect();
    $sql = "INSERT INTO tbl_thuoc (toaThuocId, tenThuoc, soLuong, lieuDung, gia) VALUES ('$toaThuocId', '$tenThuoc', '$soLuong', '$lieuDung', '$gia')";
    if (mysqli_query($link, $sql)) {
        return "Kê toa thuốc thành công.";
    } else {
        return "Kê toa thuốc thất bại: " . mysqli_error($link);
    }
    }

}
?>
