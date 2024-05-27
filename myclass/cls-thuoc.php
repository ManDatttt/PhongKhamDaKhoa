<?php
require_once 'cls-admin.php';

class toathuoc extends admin 
{
    public function xemToaThuoc($dienThoai)
    {
        $link = $this->connect(); 
        $sql = "SELECT tt.*, t.tenThuoc, t.soLuong, t.lieuDung,t.gia 
                FROM tbl_toathuoc tt
                LEFT JOIN tbl_thuoc t ON tt.id = t.toaThuocId
                WHERE tt.dienThoai='$dienThoai'";
        $ketqua = mysqli_query($link, $sql);
        $data = []; 
        while ($row = mysqli_fetch_assoc($ketqua))
        {
            $id = $row['id'];
            if (!isset($data[$id])) {
                $data[$id] = [
                    'id' => $id,
                    'hoTen' => $row['hoTen'],
                    'gioiTinh' => $row['gioiTinh'],
                    'namSinh' => $row['namSinh'],
                    'dienThoai' => $row['dienThoai'],
                    'diaChi' => $row['diaChi'],
                    'chanDoan' => $row['chanDoan'],
                    'ngayKeDon' => $row['ngayKeDon'],
                    'loiDan' => $row['loiDan'],
                    'tenBacSi' => $row['tenBacSi'],
                    'thuoc' => []
                ];
            }
            if ($row['tenThuoc']) {
                $data[$id]['thuoc'][] = [
                    'tenThuoc' => $row['tenThuoc'],
                    'soLuong' => $row['soLuong'],
                    'lieuDung' => $row['lieuDung'],
                    'gia' => $row['gia']
                ];
            }
        }
        return $data;
    }
}
?>
