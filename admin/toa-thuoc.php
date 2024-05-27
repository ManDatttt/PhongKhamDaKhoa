<?php 
include ("../myclass/cls-toathuoc.php");
$p = new toathuoc();

// Xử lý xóa toa thuốc nếu có yêu cầu POST
if(isset($_POST['delete_user'])){
  $delete_id = $_POST['delete_id'];
  $result = $p->deleteToaThuoc($delete_id);
  echo "<script>alert('$result');</script>";
}

// Kiểm tra nếu có yêu cầu thêm toa thuốc từ form modal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
    
    // Lấy dữ liệu từ form modal
    $hoTen = $_POST["hoTen"];
    $namSinh = $_POST["namSinh"];
    $dienThoai = $_POST["dienThoai"];
    $gioiTinh = $_POST["gioiTinh"];
    $diaChi = $_POST["diaChi"];
    $chuanDoan = $_POST["chuanDoan"];
    $ngayKeDon = $_POST["ngayKeDon"];
    $loiDan = $_POST["loiDan"];
    $tenBacSi = $_POST["tenBacSi"];
    
    $result = $p->addToaThuoc($hoTen, $namSinh, $dienThoai, $gioiTinh, $diaChi, $chuanDoan, $ngayKeDon, $loiDan, $tenBacSi);
    
    echo "<script>alert('$result');</script>";
}

// Kiểm tra nếu có yêu cầu cập nhật toa thuốc từ form modal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_user"])) {
    // Lấy dữ liệu từ form modal
    $userId = $_POST["userId"];
    $hoTen = $_POST["hoTen"];
    $namSinh = $_POST["namSinh"];
    $dienThoai = $_POST["dienThoai"];
    $gioiTinh = $_POST["gioiTinh"];
    $diaChi = $_POST["diaChi"];
    $chuanDoan = $_POST["chuanDoan"];
    $ngayKeDon = $_POST["ngayKeDon"];
    $loiDan = $_POST["loiDan"];
    $tenBacSi = $_POST["tenBacSi"];
    
    $result = $p->updateToaThuoc($userId, $hoTen, $namSinh, $dienThoai, $gioiTinh, $diaChi, $chuanDoan, $ngayKeDon, $loiDan, $tenBacSi);
    echo "<script>alert('$result');</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["prescribe_medicine"])) {
    $toaThuocId = $_POST["toaThuocId"];
    $tenThuoc = $_POST["tenThuoc"];
    $soLuong = $_POST["soLuong"];
    $lieuDung = $_POST["lieuDung"];
    $gia = $_POST["gia"];

    $result = $p->prescribeMedicine($toaThuocId, $tenThuoc, $soLuong, $lieuDung, $gia);
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

<!-- Hiển thị thông tin toa thuốc  -->
<div class="main-panel">
<div class="content-wrapper">

<!-- Thêm nút "Thêm toa thuốc mới" -->
<div class="row mb-3">
    <div class="col-md-6">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            Thêm toa thuốc mới
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

<!-- Hiển thị thông tin toa thuốc -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="table-responsive pt-3">
          <table class="table table-striped project-orders-table">
            <thead>
                <tr>
                    <th class="ml-5">STT</th>
                    <th>Họ Tên</th>
                    <th>Năm sinh</th>
                    <th>Điện thoại</th>
                    <th>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>Chẩn đoán</th>
                    <th>Ngày kê đơn</th>
                    <th>Lời dặn</th>
                    <th>Tên bác sĩ</th>
                    <th>Thao tác</th> 
                </tr>
            </thead>
            <tbody>
                <?php 
                // Xử lý tìm kiếm toa thuốc
                $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : null;
                $search_date = isset($_GET['search_date']) ? $_GET['search_date'] : null;

                $query = "SELECT * FROM tbl_toathuoc";
                $conditions = [];

                if ($search_name) {
                    $conditions[] = "hoTen LIKE '%$search_name%'";
                }

                if ($search_date) {
                    $conditions[] = "ngayKeDon = '$search_date'";
                }

                if (count($conditions) > 0) {
                    $query .= " WHERE " . implode(' AND ', $conditions);
                }

                $query .= " ORDER BY id ASC";
                $userData = $p->xemToaThuoc($query);
                
                $dem = 1;
                foreach ($userData as $user) {
                    echo '<tr data-id="'.$user['id'].'" data-hoTen="'.$user['hoTen'].'" data-namSinh="'.$user['namSinh'].'" data-dienThoai="'.$user['dienThoai'].'" data-gioiTinh="'.$user['gioiTinh'].'" data-diaChi="'.$user['diaChi'].'" data-chanDoan="'.$user['chanDoan'].'" data-ngayKeDon="'.$user['ngayKeDon'].'" data-loiDan="'.$user['loiDan'].'" data-tenBacSi="'.$user['tenBacSi'].'">';
                    echo '<td>'.$dem.'</td>';
                    echo '<td>'.$user['hoTen'].'</td>';
                    echo '<td>'.$user['namSinh'].'</td>';
                    echo '<td>'.$user['dienThoai'].'</td>';
                    echo '<td>'.$user['gioiTinh'].'</td>';
                    echo '<td>'.$user['diaChi'].'</td>';
                    echo '<td>'.$user['chanDoan'].'</td>';
                    echo '<td>'.$user['ngayKeDon'].'</td>';
                    echo '<td>'.$user['loiDan'].'</td>';
                    echo '<td>'.$user['tenBacSi'].'</td>';
                    echo '<td>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3 btn-edit" data-toggle="modal" data-target="#editUserModal">
                                    Sửa
                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                </button>
                                <form method="post" onsubmit="return confirm(\'Bạn có chắc chắn muốn xóa toa thuốc của bệnh nhân có tên ' . $user['hoTen'] . ' không?\')">
                                    <input type="hidden" name="delete_id" value="' . $user['id'] . '">
                                    <button type="submit" name="delete_user" class="btn btn-danger btn-sm btn-icon-text">
                                        Xóa
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm btn-icon-text mr-3 btn-prescribe" data-id="' . $user['id'] . '" data-hoTen="' . $user['hoTen'] . '" data-toggle="modal" data-target="#prescribeModal">
                                        Kê toa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
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
  <!-- Kết thúc hiển thị thông tin toa thuốc -->
  
</div>
</div>

<!-- Modal thêm toa thuốc mới -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Thêm toa thuốc mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="hoTen">Họ Tên</label>
                        <input type="text" class="form-control" id="hoTen" name="hoTen" required>
                    </div>
                    <div class="form-group">
                        <label for="namSinh">Năm sinh</label>
                        <input type="number" class="form-control" id="namSinh" name="namSinh" required>
                    </div>
                    <div class="form-group">
                        <label for="dienThoai">Số điện thoại</label>
                        <input type="text" class="form-control" id="dienThoai" name="dienThoai" required>
                    </div>
                    <div class="form-group">
                        <label for="gioiTinh">Giới tính</label>
                        <select class="form-control" id="gioiTinh" name="gioiTinh" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="diaChi">Địa chỉ</label>
                        <input type="text" class="form-control" id="diaChi" name="diaChi" required>
                    </div>
                    <div class="form-group">
                        <label for="chuanDoan">Chẩn đoán</label>
                        <input type="text" class="form-control" id="chuanDoan" name="chuanDoan" required>
                    </div>
                    <div class="form-group">
                        <label for="ngayKeDon">Ngày kê đơn</label>
                        <input type="date" class="form-control" id="ngayKeDon" name="ngayKeDon" required>
                    </div>
                    <div class="form-group">
                        <label for="loiDan">Lời dặn</label>
                        <input type="text" class="form-control" id="loiDan" name="loiDan" required>
                    </div>
                    <div class="form-group">
                        <label for="tenBacSi">Tên bác sĩ</label>
                        <input type="text" class="form-control" id="tenBacSi" name="tenBacSi" required>
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

<!-- Modal chỉnh sửa toa thuốc -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Chỉnh sửa toa thuốc</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editUserId" name="userId">
                    <div class="form-group">
                        <label for="editHoTen">Họ Tên</label>
                        <input type="text" class="form-control" id="editHoTen" name="hoTen" required>
                    </div>
                    <div class="form-group">
                        <label for="editNamSinh">Năm sinh</label>
                        <input type="number" class="form-control" id="editNamSinh" name="namSinh" required>
                    </div>
                    <div class="form-group">
                        <label for="editDienThoai">Số điện thoại</label>
                        <input type="text" class="form-control" id="editDienThoai" name="dienThoai" required>
                    </div>
                    <div class="form-group">
                        <label for="editGioiTinh">Giới tính</label>
                        <select class="form-control" id="editGioiTinh" name="gioiTinh" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editDiaChi">Địa chỉ</label>
                        <input type="text" class="form-control" id="editDiaChi" name="diaChi" required>
                    </div>
                    <div class="form-group">
                        <label for="editChuanDoan">Chẩn đoán</label>
                        <input type="text" class="form-control" id="editChuanDoan" name="chuanDoan" required>
                    </div>
                    <div class="form-group">
                        <label for="editNgayKeDon">Ngày kê đơn</label>
                        <input type="date" class="form-control" id="editNgayKeDon" name="ngayKeDon" required>
                    </div>
                    <div class="form-group">
                        <label for="editLoiDan">Lời dặn</label>
                        <input type="text" class="form-control" id="editLoiDan" name="loiDan" required>
                    </div>
                    <div class="form-group">
                        <label for="editTenBacSi">Tên bác sĩ</label>
                        <input type="text" class="form-control" id="editTenBacSi" name="tenBacSi" required>
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


<!-- Modal kê toa thuốc -->
<div class="modal fade" id="prescribeModal" tabindex="-1" role="dialog" aria-labelledby="prescribeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="prescribeModalLabel">Kê toa thuốc</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="prescribeToaThuocId" name="toaThuocId">
                    <div class="form-group">
                        <label for="prescribeTenThuoc">Tên thuốc</label>
                        <input type="text" class="form-control" id="prescribeTenThuoc" name="tenThuoc" required>
                    </div>
                    <div class="form-group">
                        <label for="prescribeSoLuong">Số lượng</label>
                        <input type="number" class="form-control" id="prescribeSoLuong" name="soLuong" required>
                    </div>
                    <div class="form-group">
                        <label for="prescribeLieuDung">Liều dùng</label>
                        <input type="text" class="form-control" id="prescribeLieuDung" name="lieuDung" required>
                    </div>
                    <div class="form-group">
                        <label for="prescribeGia">Giá</label>
                        <input type="number" class="form-control" id="prescribeGia" name="gia" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="prescribe_medicine" class="btn btn-primary">Kê toa</button>
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
        var hoTen = row.data('hoTen');
        var namSinh = row.data('namSinh');
        var dienThoai = row.data('dienThoai');
        var gioiTinh = row.data('gioiTinh');
        var diaChi = row.data('diaChi');
        var chuanDoan = row.data('chuanDoan');
        var ngayKeDon = row.data('ngayKeDon');
        var loiDan = row.data('loiDan');
        var tenBacSi = row.data('tenBacSi');
        
        $('#editUserId').val(id);
        $('#editHoTen').val(hoTen);
        $('#editNamSinh').val(namSinh);
        $('#editDienThoai').val(dienThoai);
        $('#editGioiTinh').val(gioiTinh);
        $('#editDiaChi').val(diaChi);
        $('#editChuanDoan').val(chuanDoan);
        $('#editNgayKeDon').val(ngayKeDon);
        $('#editLoiDan').val(loiDan);
        $('#editTenBacSi').val(tenBacSi);
    });
});
$(document).ready(function() {
    $('.btn-prescribe').on('click', function() {
        var row = $(this).closest('tr');
        var id = row.data('id');
        var hoTen = row.data('hoten');

        $('#prescribeToaThuocId').val(id);
        $('#prescribeTenThuoc').val('');
        $('#prescribeSoLuong').val('');
        $('#prescribeLieuDung').val('');
        $('#prescribeGia').val('');
    });
});

</script>

<!-- end content -->

<!-- footer -->
<?php include("master-view/footer.php"); ?>
<!-- end footer -->

