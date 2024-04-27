<?php 
include ("../myclass/cls-admin.php");
$p = new admin();

// Xử lý xóa người dùng nếu có yêu cầu POST
if(isset($_POST['delete_user'])){
  $delete_id = $_POST['delete_id'];
  $result = $p->deleteUser($delete_id);
  // Hiển thị thông báo sau khi xóa
  echo "<script>alert('$result');</script>";
}

// Kiểm tra nếu có yêu cầu thêm người dùng từ form modal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
    
    // Lấy dữ liệu từ form modal
    $hodem = $_POST["hodem"];
    $ten = $_POST["ten"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    
    // Thực hiện thêm người dùng
    $result = $p->addUser($hodem, $ten, $email, $username, $password, $role);
    
    // Hiển thị thông báo sau khi thêm người dùng
    echo "<script>alert('$result');</script>";
}

?>
<!-- header -->
<?php include("master-view/header.php"); ?>
<!-- end header -->

<!-- sidebar -->
<?php include("master-view/sidebar.php"); ?>
<!-- end sidebar -->

<!-- Content -->

<!-- Hiển thị thông tin người dùng  -->
<div class="main-panel">
<div class="content-wrapper">

<!-- Thêm nút "Thêm tài khoản" -->

<div class="row mb-3">
    <div class="col-md-6">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            Thêm tài khoản
        </button>
    </div>
</div>
<!-- Kết thúc phần thêm nút -->

<!-- Hiển thị thông tin người dùng  -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="table-responsive pt-3">
          <table class="table table-striped project-orders-table">
            <thead>
                <tr>
                    <th class="ml-5">STT</th>
                    <th>Họ Đệm</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>UserName</th>
                    <th>PassWord</th>
                    <th>Vai trò</th>
                    <th>Thao tác</th> 
                </tr>
            </thead>
            <tbody>
                <?php 
                $userData = $p->xemUser("SELECT * FROM tbl_user ORDER BY id ASC");
                $dem = 1;
                foreach ($userData as $user) {
                    echo '<tr>';
                    echo '<td>'.$dem.'</td>';
                    echo '<td>'.$user['hodem'].'</td>';
                    echo '<td>'.$user['ten'].'</td>';
                    echo '<td>'.$user['email'].'</td>';
                    echo '<td>'.$user['username'].'</td>';
                    echo '<td>'.$user['password'].'</td>';
                    echo '<td>'.$user['role'].'</td>';
                    echo '<td>
                              <div class="d-flex align-items-center">
                                 <button type="submit" class="btn btn-success btn-sm btn-icon-text mr-3 btn-edit" data-toggle="modal" data-target="#editUserModal">
                                        Sửa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                </button>
                                <form method="post" onsubmit="return confirm(\'Bạn có chắc chắn muốn xóa tài khoản có username ' . $user['username'] . ' không?\')">
                                    <input type="hidden" name="delete_id" value="' . $user['id'] . '">
                                    <button type="submit" name="delete_user" class="btn btn-danger btn-sm btn-icon-text">
                                        Xóa
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </button>
                                  </form>
                              </div>
                            </td>';
                    echo '</tr>';
                    $dem++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
<!-- Kết thúc hiển thị thông tin người dùng  -->
    </div>
  </div>
</div>

<!-- End content -->

<!-- footer -->
<?php include ("master-view/footer.php");?>
<!-- end footer  -->

<!-- Modal thêm tài khoản -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Thêm tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" method="post" action="">
                    <div class="form-group">
                        <label for="hodem">Họ Đệm</label>
                        <input type="text" class="form-control border-primary" id="hodem" name="hodem" placeholder="Nhập họ đệm" required>
                    </div>
                    <div class="form-group">
                        <label for="ten">Tên</label>
                        <input type="text" class="form-control border-primary" id="ten" name="ten" placeholder="Nhập tên" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control border-primary" id="email" name="email" placeholder="Nhập Email" required>
                    </div>
                    <div class="form-group">
                        <label for="username">UserName</label>
                        <input type="text" class="form-control border-primary" id="username" name="username" placeholder="Nhập UserName" required>
                        <div id="usernameError" class="text-danger"></div> <!-- Thêm phần hiển thị lỗi -->
                    </div>
                    <div class="form-group">
                        <label for="password">PassWord</label>
                        <input type="password" class="form-control border-primary" id="password" name="password" placeholder="Nhập PassWord" required>
                        <div id="passwordError" class="text-danger"></div> <!-- Thêm phần hiển thị lỗi -->
                    </div>
                    <div class="form-group">
                        <label for="role">Vai trò</label>
                        <select class="form-control border-primary" id="role" name="role" required>
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                            <option value="2">Bác sĩ</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" name="add_user">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Kết thúc modal thêm tài khoản -->

<!-- JavaScript -->
<script>
    // Kiểm tra form thêm user
    function validateForm() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var usernameError = document.getElementById("usernameError");
        var passwordError = document.getElementById("passwordError");

        // Kiểm tra nếu username hoặc password trống
        if (username.trim() == "") {
            usernameError.innerHTML = "UserName không được để trống";
        } else {
            usernameError.innerHTML = "";
        }

        if (password.trim() == "") {
            passwordError.innerHTML = "Password không được để trống";
        } else {
            passwordError.innerHTML = "";
        }

        // Nếu cả hai trường đều không trống thì submit form
        if (username.trim() != "" && password.trim() != "") {
            document.getElementById("addUserForm").submit();
        }
    }

    document.getElementById("addUserForm").onsubmit = function() {
        return validateForm();
    };

</script>
