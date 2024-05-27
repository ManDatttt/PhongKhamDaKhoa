<?php
require_once 'cls-admin.php';
class khothuoc extends admin 
{
    public function xemkhothuoc($sql)
    {
        $link = $this->connect(); 
        $ketqua = mysqli_query($link,$sql);
        $data = []; 
        if($ketqua && mysqli_num_rows($ketqua) > 0)
        {
            while($row = mysqli_fetch_assoc($ketqua))
            {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function addThuoc($tenThuoc, $ngayHetHan, $giaVon, $giaBan, $soLuongTon, $dongGoi, $loai)
	{
		$link = $this->connect(); 
		$addThuocQuery = "INSERT INTO tbl_khothuoc (tenThuoc, ngayHetHan, giaVon, giaBan, soLuongTon, dongGoi, loai) 
						VALUES ('$tenThuoc', '$ngayHetHan', '$giaVon', '$giaBan', '$soLuongTon', '$dongGoi', '$loai')";
		if (mysqli_query($link, $addThuocQuery)) 
		{
			return "Thêm thuốc thành công.";
			header("Location:admin/kho-thuoc.php");
		} 
		else 
		{
			return "Thêm thuốc thất bại: " . mysqli_error($link);
		}
	}

    public function deleteThuoc($id)
    {
        $link = $this->connect();
        $sql = "DELETE FROM tbl_khothuoc WHERE id = $id";
        if (mysqli_query($link, $sql)) {
            return "Dữ liệu đã được xóa thành công";
			header("Location:admin/kho-thuoc.php");
        } else {
            return "Xảy ra lỗi khi xóa thuốc: " . mysqli_error($link);
        }
    }

    public function updateThuoc($id, $tenThuoc, $ngayHetHan, $giaVon, $giaBan, $soLuongTon, $dongGoi, $loai) 
	{
        $link = $this->connect();
        $editThuocQuery = "UPDATE tbl_khothuoc SET tenThuoc='$tenThuoc', ngayHetHan='$ngayHetHan', giaVon='$giaVon', giaBan='$giaBan', soLuongTon='$soLuongTon', dongGoi='$dongGoi', loai='$loai' WHERE id='$id'";
		if(mysqli_query($link, $editThuocQuery))
		{
			return "Sửa thông tin thuốc thành công.";
		}
		else 
		{
			return "Sửa thông tin thuốc thất bại: " . mysqli_error($link);
		}
	}

}
?>