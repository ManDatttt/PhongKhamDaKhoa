<?php
require_once 'cls-admin.php';
class lichhen extends admin 
{

    //Xem lịch hẹn 
    public function xemlichhen($sql)
    {
        $link = $this->connect(); 
        $ketqua = mysqli_query($link,$sql);
        $i = mysqli_num_rows($ketqua);
        $data = []; 
        if($i > 0)
        {
            while($row = mysqli_fetch_array($ketqua))
            {
                $makh = $row['makh'];
                $tenkh = $row['tenkh'];
                $sdt = $row['sdt'];
                $email = $row['email'];
                $ngay = $row['ngay'];
                $gio = $row['gio'];
                $bacsi = $row['bacsi'];
                $tieude = $row['tieude'];

                $data[] = [
                    'makh' => $makh,
                    'tenkh' => $tenkh,
                    'sdt' => $sdt,
                    'email' => $email,
                    'ngay' => $ngay,
                    'gio' => $gio,
                    'bacsi' => $bacsi,
                    'tieude' => $tieude
                ];
            }
        }
        return $data;
    }

   //Thêm lịch hẹn 
    public function themlichhen($ten, $sdt, $email, $ngay, $gio, $bacsi, $tieude) 
    {
        $link = $this->connect(); 
        
        // Chuyển đổi dữ liệu để tránh lỗ hổng SQL injection
        $ten = mysqli_real_escape_string($link, $ten);
        $sdt = mysqli_real_escape_string($link, $sdt);
        $email = mysqli_real_escape_string($link, $email);
        $ngay = mysqli_real_escape_string($link, $ngay);
        $gio = mysqli_real_escape_string($link, $gio);
        $bacsi = mysqli_real_escape_string($link, $bacsi);
        $tieude = mysqli_real_escape_string($link, $tieude);
        
        $sql = "INSERT INTO tbl_lichhen(tenkh,sdt,email,ngay,gio,bacsi,tieude) VALUES ('$ten','$sdt','$email','$ngay','$gio','$bacsi','$tieude')";
        
        $ketqua = mysqli_query($link, $sql);
            
        // Kiểm tra kết quả thực thi
        if ($ketqua) {
            return true; // Trả về true nếu thêm thành công
        } else {
            return false; // Trả về false nếu thêm thất bại
        }

        // Đóng kết nối
        mysqli_close($link);
    }
    
}

?>