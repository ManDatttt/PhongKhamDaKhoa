<?php 
include ("../myclass/cls-benhnhan.php");
$p = new benhnhan();

// // Xử lý xóa người dùng nếu có yêu cầu POST
// if(isset($_POST['delete_user'])){
//   $delete_id = $_POST['delete_id'];
//   $result = $p->deleteUser($delete_id);
//   // Hiển thị thông báo sau khi xóa
//   echo "<script>alert('$result');</script>";
// }

// // Kiểm tra nếu có yêu cầu thêm người dùng từ form modal
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
    
//     // Lấy dữ liệu từ form modal
//     $hodem = $_POST["hodem"];
//     $ten = $_POST["ten"];
//     $email = $_POST["email"];
//     $username = $_POST["username"];
//     $password = $_POST["password"];
//     $role = $_POST["role"];
    
//     // Thực hiện thêm người dùng
//     $result = $p->addUser($hodem, $ten, $email, $username, $password, $role);
    
//     // Hiển thị thông báo sau khi thêm người dùng
//     echo "<script>alert('$result');</script>";
// }

// // Kiểm tra nếu có yêu cầu cập nhật người dùng từ form modal
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_user"])) {
//     // Lấy dữ liệu từ form modal
//     $userId = $_POST["userId"];
//     $hodem = $_POST["hodem"];
//     $ten = $_POST["ten"];
//     $email = $_POST["email"];
//     $username = $_POST["username"];
//     $password = $_POST["password"];
//     $role = $_POST["role"];
    
//     // Thực hiện cập nhật người dùng
//     $result = $p->updateUser($userId, $hodem, $ten, $email, $username, $password, $role);
    
//     // Hiển thị thông báo sau khi cập nhật người dùng
//     echo "<script>alert('$result');</script>";
// }

?>
<!-- header -->
<?php include("master-view/header.php"); ?>
<!-- end header -->

<!-- sidebar -->
<?php include("master-view/sidebar.php"); ?>
<!-- end sidebar -->

<!-- Content -->

<!-- Hiển thị thông tin bệnh nhân  -->
<div class="main-panel">
<div class="content-wrapper">

<!-- Thêm nút "Thêm bệnh nhân mới" -->

<div class="row mb-3">
    <div class="col-md-6">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            Thêm bệnh nhân mới
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
                    <th>Họ Tên</th>
                    <th>Giới tính</th>
                    <th>Năm sinh</th>
                    <th>Tuổi</th>
                    <th>Điện thoại</th>
                    <th>Ngày khám</th>
                    <th>Thao tác</th> 
                </tr>
            </thead>
            <tbody>
                <?php 
                $userData = $p->xembenhnhan("SELECT * FROM tbl_benhnhan ORDER BY id ASC");
                $dem = 1;
                foreach ($userData as $user) {
                    echo '<tr data-id="'.$user['id'].'" data-hoten="'.$user['hoten'].'" data-gioitinh="'.$user['gioitinh'].'" data-namsinh="'.$user['namsinh'].'" data-tuoi="'.$user['tuoi'].'" data-sdt="'.$user['sdt'].'" data-ngaykham="'.$user['ngaykham'].'">';
                    echo '<td>'.$dem.'</td>';
                    echo '<td>'.$user['hoten'].'</td>';
                    echo '<td>'.$user['gioitinh'].'</td>';
                    echo '<td>'.$user['namsinh'].'</td>';
                    echo '<td>'.$user['tuoi'].'</td>';
                    echo '<td>'.$user['sdt'].'</td>';
                    echo '<td>'.$user['ngaykham'].'</td>';
                    echo '<td>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3 btn-edit" data-toggle="modal" data-target="#editUserModal">
                                    Sửa
                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                </button>
                                <form method="post" onsubmit="return confirm(\'Bạn có chắc chắn muốn xóa tài khoản có username ' . $user['hoten'] . ' không?\')">
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
                        <div id="usernameError" class="text-danger"></div> 
                    </div>
                    <div class="form-group">
                        <label for="password">PassWord</label>
                        <input type="password" class="form-control border-primary" id="password" name="password" placeholder="Nhập PassWord" required>
                        <div id="passwordError" class="text-danger"></div> 
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


<!-- Modal sửa tài khoản -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Sửa tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="post" action="">
                    <input type="hidden" name="userId" id="editUserId" value="">
                    <div class="form-group">
                        <label for="editHodem">Họ Đệm</label>
                        <input type="text" class="form-control border-primary" id="editHodem" name="hodem" placeholder="Nhập họ đệm" required>
                    </div>
                    <div class="form-group">
                        <label for="editTen">Tên</label>
                        <input type="text" class="form-control border-primary" id="editTen" name="ten" placeholder="Nhập tên" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control border-primary" id="editEmail" name="email" placeholder="Nhập Email" required>
                    </div>
                    <div class="form-group">
                        <label for="editUsername">UserName</label>
                        <input type="text" class="form-control border-primary" id="editUsername" name="username" placeholder="Nhập UserName" required>
                    </div>
                    <div class="form-group">
                        <label for="editPassword">PassWord</label>
                        <input type="password" class="form-control border-primary" id="editPassword" name="password" placeholder="Nhập PassWord" required>
                    </div>
                    <div class="form-group">
                        <label for="editRole">Vai trò</label>
                        <select class="form-control border-primary" id="editRole" name="role" required>
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                            <option value="2">Bác sĩ</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" name="edit_user">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Kết thúc modal sửa tài khoản -->

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


    // Khi modal sửa hiện lên, điền thông tin người dùng vào các trường
    $('#editUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var row = button.closest('tr');

            var id = row.data('id');
            var hodem = row.data('hodem');
            var ten = row.data('ten');
            var email = row.data('email');
            var username = row.data('username');
            var password = row.data('password');
            var role = row.data('role');

            var modal = $(this);
            modal.find('#editUserId').val(id);
            modal.find('#editHodem').val(hodem);
            modal.find('#editTen').val(ten);
            modal.find('#editEmail').val(email);
            modal.find('#editUsername').val(username);
            modal.find('#editPassword').val(password);
            modal.find('#editRole').val(role);
        });
</script>






