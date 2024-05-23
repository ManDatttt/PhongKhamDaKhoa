<?php
require_once 'cls-admin.php';
class lichkham extends admin 
{
    public function xemlichkham($sql)
    {
        $link = $this->connect(); 
        $ketqua = mysqli_query($link,$sql);
        $i = mysqli_num_rows($ketqua);
        $data = []; 
        if($i > 0)
        {
            while($row = mysqli_fetch_array($ketqua))
            {
                $id = $row['id'];
                $khoa = $row['khoa'];
                $ngay = $row['ngay'];
                $gio = $row['gio'];
                $bacsi = $row['bacsi'];

                $data[] = [
                    'id' => $id,
                    'khoa' => $khoa,
                    'ngay' => $ngay,
                    'gio' => $gio,
                    'bacsi' => $bacsi
                ];
            }
        }
        return $data;
    }

    public function addLichKham($khoa, $ngay, $gio, $bacsi)
	{
		$link = $this->connect(); 
		$addLichKhamQuery = "INSERT INTO tbl_lichkham (khoa, ngay, gio, bacsi) 
						VALUES ('$khoa', '$ngay', '$gio', '$bacsi')";
		if (mysqli_query($link, $addLichKhamQuery)) 
		{
			return "Thêm lịch khám thành công.";
			header("Location:admin/lich-kham.php");
		} 
		else 
		{
			return "Thêm lịch khám thất bại: " . mysqli_error($link);
		}
	}

    public function deleteLichKham($id)
    {
        $link = $this->connect();
        $sql = "DELETE FROM tbl_lichkham WHERE id = $id";
        if (mysqli_query($link, $sql)) {
            return "Dữ liệu đã được xóa thành công";
			header("Location:admin/lich-kham.php");
        } else {
            return "Xảy ra lỗi khi xóa lịch khám: " . mysqli_error($link);
        }
    }

    public function updateLichKham($id, $khoa, $ngay, $gio, $bacsi) 
	{
        $link = $this->connect();
        $editLichKham = "UPDATE tbl_lichkham SET khoa='$khoa', ngay='$ngay', gio='$gio', bacsi='$bacsi' WHERE id='$id'";
		if(mysqli_query($link, $editLichKham))
		{
			return "Sửa lịch khám thành công.";
		}
		else 
		{
			return "Sửa lịch khám thất bại: " . mysqli_error($link);
		}
	}

    public function timTheoNgay($ngay)
    {

    }
}

?>