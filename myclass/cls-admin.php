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
			$conn = $this->connect();

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

		// public function login($username, $password)
		// {
		// 	$conn = $this->connect();
		// 	$sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
		// 	$result = mysqli_query($conn, $sql);
		// 	if (mysqli_num_rows($result) == 1) {
		// 		$user = mysqli_fetch_assoc($result);
		// 		if ($user['role'] == 1) { // Kiểm tra nếu role bằng 1 (Admin)
		// 			$_SESSION['user'] = $user;
		// 			$_SESSION['fullname'] = $user['hodem'] . ' ' . $user['ten'];
		// 			$_SESSION['role'] = $user['role'];

					
		// 			return 'success'; // Trả về 'success' khi đăng nhập thành công
		// 		} else {
		// 			return 'Bạn không có quyền truy cập vào trang quản trị.';
		// 		}
		// 	} else {
		// 		return 'Tên đăng nhập hoặc mật khẩu không đúng.';
		// 	}
		// }

		public function login($username, $password)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user'] = $user;
            $_SESSION['fullname'] = $user['hodem'] . ' ' . $user['ten'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 1) { 
                return 'admin'; 
            } else {
                return 'Bạn không có quyền truy cập vào trang này.';
            }
        } else {
            return 'Tên đăng nhập hoặc mật khẩu không đúng.';
        }
    }




		// Hàm xác thực đăng nhập
		public function isAuthenticated()
		{
			if(isset($_SESSION['user']))
			{
				return true;
			}
			else
			{
				return false;
			}
	}

	}
	?>
