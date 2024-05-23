<?php
class admin
{
    public function connect()
	{
        $sever = 'localhost';
        $user = 'root';
        $pass = '';
        $database = 'phongkhamhd_db';

        $conn = new mysqli($sever, $user, $pass, $database);
        if(!$conn)
        {
			echo 'Không kết nối được CSDL';
			exit();
        }
        else
        {
            mysqli_query($conn,"SET NAMES 'UTF8' ");
			mysqli_select_db($conn,$database);
			return $conn;
        }
    }
	
	public function assignRole($role)
	{
	    switch ($role)
		{
			case 0:
				return 'User';
			case 1:
				return 'Admin';
			case 2:
				return 'Bác sĩ';
			default:
				return 'Unknown';
    	}
	}

	public function xemUser($sql)
	{
		$link = $this->connect();
		$ketqua = mysqli_query($link,$sql);
		$i = mysqli_num_rows($ketqua);
		$data = []; // Khởi tạo mảng dữ liệu
		if($i > 0)
		{
			while($row = mysqli_fetch_array($ketqua))
			{
				$id = $row['id'];
				$hodem = $row['hodem'];
				$ten = $row['ten'];
				$email = $row['email'];
				$username = $row['username'];
				$password = $row['password'];
				$role = $this->assignRole($row['role']);
				// Thêm dữ liệu vào mảng
				$data[] = [
					'id' => $id,
					'hodem' => $hodem,
					'ten' => $ten,
					'email' => $email,
					'username' => $username,
					'password' => $password,
					'role' => $role
				];
			}
		}
		return $data; // Trả về mảng dữ liệu
	}

	public function deleteUser($id)
    {
        $link = $this->connect();
        $sql = "DELETE FROM tbl_user WHERE id = $id";
        if (mysqli_query($link, $sql)) {
            return "Dữ liệu đã được xóa thành công";
			header("Location:admin/tai-khoan.php");
        } else {
            return "Xảy ra lỗi khi xóa dữ liệu: " . mysqli_error($link);
        }
    }

	public function addUser($hodem, $ten, $email, $username, $password, $role)
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
		if (mysqli_query($conn, $addUserQuery)) 
		{
			return "Thêm người dùng thành công.";
		} 
		else 
		{
			return "Thêm người dùng thất bại: " . mysqli_error($conn);
		}
	}

	public function updateUser($id, $hodem, $ten, $email, $username, $password, $role) 
	{
        // Kết nối cơ sở dữ liệu
        $conn = $this->connect();

        // Tạo câu lệnh SQL để cập nhật người dùng
        $editUserQuery = "UPDATE tbl_user SET hodem='$hodem', ten='$ten', email='$email', username='$username', password='$password', role='$role' WHERE id='$id'";
		if(mysqli_query($conn, $editUserQuery))
		{
			return "Sửa người dùng thành công.";
		}
		else 
		{
			return "Sửa người dùng thất bại: " . mysqli_error($conn);
		}
	}
}
?>
