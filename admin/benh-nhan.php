<?php 
include ("../myclass/cls-benhnhan.php");
$p = new benhnhan();

// Xử lý xóa bệnh nhân nếu có yêu cầu POST
if(isset($_POST['delete_user'])){
  $delete_id = $_POST['delete_id'];
  $result = $p->deleteBenhNhan($delete_id);
  echo "<script>alert('$result');</script>";
}

// Kiểm tra nếu có yêu cầu thêm bệnh nhân từ form modal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
    
    // Lấy dữ liệu từ form modal
    $hoten = $_POST["hoten"];
    $gioitinh = $_POST["gioitinh"];
    $namsinh = $_POST["namsinh"];
    $tuoi = $_POST["tuoi"];
    $sdt = $_POST["sdt"];
    $ngaykham = $_POST["ngaykham"];
    
    $result = $p->addBenhNhan($hoten, $gioitinh, $namsinh, $tuoi, $sdt, $ngaykham);
    
    echo "<script>alert('$result');</script>";
}

// Kiểm tra nếu có yêu cầu cập nhật bệnh nhân từ form modal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_user"])) {
    // Lấy dữ liệu từ form modal
    $userId = $_POST["userId"];
    $hoten = $_POST["hoten"];
    $gioitinh = $_POST["gioitinh"];
    $namsinh = $_POST["namsinh"];
    $tuoi = $_POST["tuoi"];
    $sdt = $_POST["sdt"];
    $ngaykham = $_POST["ngaykham"];
    
    $result = $p->updateBenhNhan($userId, $hoten, $gioitinh, $namsinh, $tuoi, $sdt, $ngaykham);
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
    <div class="col-md-6">
        <form method="get" action="" class="form-inline float-right">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" name="search_name" placeholder="Tìm theo tên">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="date" class="form-control" name="search_date">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Tìm kiếm</button>
        </form>
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
                // Xử lý tìm kiếm bệnh nhân
                $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : null;
                $search_date = isset($_GET['search_date']) ? $_GET['search_date'] : null;

                $query = "SELECT * FROM tbl_benhnhan";
                $conditions = [];

                if ($search_name) {
                    $conditions[] = "hoten LIKE '%$search_name%'";
                }

                if ($search_date) {
                    $conditions[] = "ngaykham = '$search_date'";
                }

                if (count($conditions) > 0) {
                    $query .= " WHERE " . implode(' AND ', $conditions);
                }

                $query .= " ORDER BY id ASC";
                $userData = $p->xembenhnhan($query);
                
                // $userData = $p->xembenhnhan("SELECT * FROM tbl_benhnhan ORDER BY id ASC");
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
                                <form method="post" onsubmit="return confirm(\'Bạn có chắc chắn muốn xóa bệnh nhân có tên ' . $user['hoten'] . ' không?\')">
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
    </div>
  </div>
  <!-- Kết thúc hiển thị thông tin bệnh nhân -->
  
</div>
</div>

<!-- Modal thêm bệnh nhân mới -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Thêm bệnh nhân mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="hoten">Họ Tên</label>
                        <input type="text" class="form-control" id="hoten" name="hoten" required>
                    </div>
                    <div class="form-group">
                        <label for="gioitinh">Giới tính</label>
                        <select class="form-control" id="gioitinh" name="gioitinh" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="namsinh">Năm sinh</label>
                        <input type="number" class="form-control" id="namsinh" name="namsinh" required>
                    </div>
                    <div class="form-group">
                        <label for="tuoi">Tuổi</label>
                        <input type="number" class="form-control" id="tuoi" name="tuoi" required>
                    </div>
                    <div class="form-group">
                        <label for="sdt">Số điện thoại</label>
                        <input type="text" class="form-control" id="sdt" name="sdt" required>
                    </div>
                    <div class="form-group">
                        <label for="ngaykham">Ngày khám</label>
                        <input type="date" class="form-control" id="ngaykham" name="ngaykham" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="add_user" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal chỉnh sửa bệnh nhân -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Chỉnh sửa bệnh nhân</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editUserId" name="userId">
                    <div class="form-group">
                        <label for="editHoten">Họ Tên</label>
                        <input type="text" class="form-control" id="editHoten" name="hoten" required>
                    </div>
                    <div class="form-group">
                        <label for="editGioitinh">Giới tính</label>
                        <select class="form-control" id="editGioitinh" name="gioitinh" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editNamsinh">Năm sinh</label>
                        <input type="number" class="form-control" id="editNamsinh" name="namsinh" required>
                    </div>
                    <div class="form-group">
                        <label for="editTuoi">Tuổi</label>
                        <input type="number" class="form-control" id="editTuoi" name="tuoi" required>
                    </div>
                    <div class="form-group">
                        <label for="editSdt">Số điện thoại</label>
                        <input type="text" class="form-control" id="editSdt" name="sdt" required>
                    </div>
                    <div class="form-group">
                        <label for="editNgaykham">Ngày khám</label>
                        <input type="date" class="form-control" id="editNgaykham" name="ngaykham" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="edit_user" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JavaScript để điền thông tin vào form chỉnh sửa khi mở modal -->
<script>
$(document).ready(function() {
    $('.btn-edit').on('click', function() {
        var row = $(this).closest('tr');
        var id = row.data('id');
        var hoten = row.data('hoten');
        var gioitinh = row.data('gioitinh');
        var namsinh = row.data('namsinh');
        var tuoi = row.data('tuoi');
        var sdt = row.data('sdt');
        var ngaykham = row.data('ngaykham');
        
        $('#editUserId').val(id);
        $('#editHoten').val(hoten);
        $('#editGioitinh').val(gioitinh);
        $('#editNamsinh').val(namsinh);
        $('#editTuoi').val(tuoi);
        $('#editSdt').val(sdt);
        $('#editNgaykham').val(ngaykham);
    });
});
</script>

<!-- end content -->

<!-- footer -->
<?php include("master-view/footer.php"); ?>
<!-- end footer -->
