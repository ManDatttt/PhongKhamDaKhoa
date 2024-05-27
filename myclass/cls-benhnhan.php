<?php
require_once 'cls-admin.php';

class benhnhan extends admin 
{
    public function xembenhnhan($sql)
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
                $hoten = $row['hoten'];
                $gioitinh = $row['gioitinh'];
                $namsinh = $row['namsinh'];
                $tuoi = $row['tuoi'];
                $sdt = $row['sdt'];
                $ngaykham = $row['ngaykham'];

                $data[] = [
                    'id' => $id,
                    'hoten' => $hoten,
                    'gioitinh' => $gioitinh,
                    'namsinh' => $namsinh,
                    'tuoi' => $tuoi,
                    'sdt' => $sdt,
                    'ngaykham' => $ngaykham
                ];
            }
        }
        return $data;
    }

    public function addBenhNhan($hoten, $gioitinh, $namsinh, $tuoi, $sdt, $ngaykham)
    {
        $link = $this->connect(); 
        $addBenhNhanQuery = "INSERT INTO tbl_benhnhan (hoten, gioitinh, namsinh, tuoi, sdt, ngaykham) 
                        VALUES ('$hoten', '$gioitinh', '$namsinh', '$tuoi', '$sdt', '$ngaykham')";
        if (mysqli_query($link, $addBenhNhanQuery)) 
        {
            return "Thêm bệnh nhân thành công.";
        } 
        else 
        {
            return "Thêm bệnh nhân thất bại: " . mysqli_error($link);
        }
    }

    public function deleteBenhNhan($id)
    {
        $link = $this->connect();
        $sql = "DELETE FROM tbl_benhnhan WHERE id = $id";
        if (mysqli_query($link, $sql)) {
            return "Bệnh nhân đã được xóa thành công";
        } else {
            return "Xảy ra lỗi khi xóa bệnh nhân: " . mysqli_error($link);
        }
    }

    public function updateBenhNhan($id, $hoten, $gioitinh, $namsinh, $tuoi, $sdt, $ngaykham) 
    {
        $link = $this->connect();
        $updateBenhNhanQuery = "UPDATE tbl_benhnhan SET hoten='$hoten', gioitinh='$gioitinh', namsinh='$namsinh', tuoi='$tuoi', sdt='$sdt', ngaykham='$ngaykham' WHERE id='$id'";
        if (mysqli_query($link, $updateBenhNhanQuery)) {
            return "Cập nhật bệnh nhân thành công.";
        } else {
            return "Cập nhật bệnh nhân thất bại: " . mysqli_error($link);
        }
    }
}
?>
