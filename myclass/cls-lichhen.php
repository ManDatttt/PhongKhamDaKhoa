<?php
require_once 'cls-admin.php';
class lichhen extends admin // Kế thừa từ class admin
{

    public function xemlichhen($sql)
    {
        $link = $this->connect(); // Gọi phương thức connect từ class admin
        $ketqua = mysqli_query($link,$sql);
        $i = mysqli_num_rows($ketqua);
        $data = []; // Khởi tạo mảng dữ liệu
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

                // Thêm dữ liệu vào mảng
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
        return $data; // Trả về mảng dữ liệu
    }

    // Xóa lịch hẹn 
    public function delete_lichhen($id)
    {
        $link = $this->connect();
        $sql = "DELETE FROM tbl_lichhen WHERE id = $id";
        if (mysqli_query($link, $sql)) {
            return "Dữ liệu đã được xóa thành công";
			header("Location:admin/lich-hen.php");
        } else {
            return "Xảy ra lỗi khi xóa dữ liệu: " . mysqli_error($link);
        }
    }

    public function add_lichhen($hodem, $ten, $email, $username, $password, $role)
	{
		$conn = $this->connect(); // Kết nối đến CSDL

		// Kiểm tra xem username đã tồn tại chưa
		$checkUsernameQuery = "SELECT * FROM tbl_user WHERE username = '$username'";
		$checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);
		if (mysqli_num_rows($checkUsernameResult) > 0) {
			return "Username đã tồn tại. Vui lòng chọn username khác.";
		}

		// Tiến hành thêm người dùng vào CSDL
		$addUserQuery = "INSERT INTO tbl_user (hodem, ten, email, username, password, role) 
						VALUES ('$hodem', '$ten', '$email', '$username', '$password', '$role')";
		if (mysqli_query($conn, $addUserQuery)) {
			return "Thêm người dùng thành công.";
		} else {
			return "Thêm người dùng thất bại: " . mysqli_error($conn);
		}
	}
}

?>