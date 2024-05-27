<?php 
include('../myclass/cls-khothuoc.php');
$p = new khothuoc();

// Xử lý xóa thuốc nếu có yêu cầu POST
if(isset($_POST['delete_thuoc'])){
    $delete_id = $_POST['delete_id'];
    $result = $p->deleteThuoc($delete_id);
    echo "<script>alert('$result');</script>";
}
  
// Kiểm tra nếu có yêu cầu thêm thuốc mới từ form modal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_thuoc"])) {
    // Lấy dữ liệu từ form modal
    $tenThuoc = $_POST["tenThuoc"];
    $ngayHetHan = $_POST["ngayHetHan"];
    $giaVon = $_POST["giaVon"];
    $giaBan = $_POST["giaBan"];
    $soLuongTon = $_POST["soLuongTon"];
    $dongGoi = $_POST["dongGoi"];
    $loai = $_POST["loai"];
    
    $result = $p->addThuoc($tenThuoc, $ngayHetHan, $giaVon, $giaBan, $soLuongTon, $dongGoi, $loai);
    
    echo "<script>alert('$result');</script>";
}

// Kiểm tra nếu có yêu cầu cập nhật từ form modal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_thuoc"])) {
    $thuocId = $_POST["thuocId"];
    $tenThuoc = $_POST["tenThuoc"];
    $ngayHetHan = $_POST["ngayHetHan"];
    $giaVon = $_POST["giaVon"];
    $giaBan = $_POST["giaBan"];
    $soLuongTon = $_POST["soLuongTon"];
    $dongGoi = $_POST["dongGoi"];
    $loai = $_POST["loai"];

    $result = $p->updateThuoc($thuocId, $tenThuoc, $ngayHetHan, $giaVon, $giaBan, $soLuongTon, $dongGoi, $loai);
    
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

<!-- Main content -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="add-button">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addThuocModal">Thêm thuốc mới</button>
        </div>
        <div class="search-form">
            <form method="get" action="" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" name="search_name" placeholder="Tìm theo tên">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Tìm kiếm</button>
            </form>
        </div>
    </div>
            <div class="card-body">
                <div class="form-row">
                    <!-- Form tìm kiếm -->
                </div>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Thuốc</th>
                            <th>Ngày hết hạn</th>
                            <th>Giá vốn</th>
                            <th>Giá bán</th>
                            <th>SL tồn</th>
                            <th>Đóng gói</th>
                            <th>Loại</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Xử lý tìm kiếm theo tên thuốc
                        $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : null;

                        $query = "SELECT * FROM tbl_khothuoc";
                        $conditions = [];

                        if ($search_name) {
                            $conditions[] = "tenThuoc LIKE '%$search_name%'";
                        }


                        if (count($conditions) > 0) {
                            $query .= " WHERE " . implode(' AND ', $conditions);
                        }

                        $query .= " ORDER BY id ASC";
                        $userData = $p->xemkhothuoc($query);

                        // $userData = $p->xemkhothuoc("SELECT * FROM tbl_khothuoc ORDER BY id ASC");
                        $dem = 1;
                        foreach ($userData as $thuoc) {
                            echo '<tr>';
                            echo '<td>'.$dem.'</td>';
                            echo '<td>'.$thuoc['tenThuoc'].'</td>';
                            echo '<td>'.$thuoc['ngayHetHan'].'</td>';
                            echo '<td>'.$thuoc['giaVon'].'</td>';
                            echo '<td>'.$thuoc['giaBan'].'</td>';
                            echo '<td>'.$thuoc['soLuongTon'].'</td>';
                            echo '<td>'.$thuoc['dongGoi'].'</td>';
                            echo '<td>'.$thuoc['loai'].'</td>';
                            echo '<td>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3 btn-edit-thuoc" data-toggle="modal" data-target="#editThuocModal" 
                                            data-id="'.$thuoc['id'].'" 
                                            data-ten="'.$thuoc['tenThuoc'].'"
                                            data-ngayhethan="'.$thuoc['ngayHetHan'].'"
                                            data-giavon="'.$thuoc['giaVon'].'"
                                            data-giaban="'.$thuoc['giaBan'].'"
                                            data-soluongton="'.$thuoc['soLuongTon'].'"
                                            data-donggoi="'.$thuoc['dongGoi'].'"
                                            data-loai="'.$thuoc['loai'].'"
                                        >
                                            Sửa
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </button>
                                        <form method="post" onsubmit="return confirm(\'Bạn có chắc chắn muốn xóa thuốc ' . $thuoc['tenThuoc'] . ' không?\')">
                                            <input type="hidden" name="delete_id" value="' . $thuoc['id'] . '">
                                            <button type="submit" name="delete_thuoc" class="btn btn-danger btn-sm btn-icon-text">
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

<!-- Modal thêm thuốc mới -->
<div class="modal fade" id="addThuocModal" tabindex="-1" role="dialog" aria-labelledby="addThuocModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="addThuocModalLabel">Thêm thuốc mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tenThuoc">Tên thuốc</label>
                        <input type="text" class="form-control" id="tenThuoc" name="tenThuoc" required>
                    </div>
                    <div class="form-group">
                        <label for="ngayHetHan">Ngày hết hạn</label>
                        <input type="date" class="form-control" id="ngayHetHan" name="ngayHetHan" required>
                    </div>
                    <div class="form-group">
                        <label for="giaVon">Giá vốn</label>
                        <input type="text" class="form-control" id="giaVon" name="giaVon" required>
                    </div>
                    <div class="form-group">
                        <label for="giaBan">Giá bán</label>
                        <input type="text" class="form-control" id="giaBan" name="giaBan" required>
                    </div>
                    <div class="form-group">
                        <label for="soLuongTon">Số lượng tồn</label>
                        <input type="text" class="form-control" id="soLuongTon" name="soLuongTon" required>
                    </div>
                    <div class="form-group">
                        <label for="dongGoi">Đóng gói</label>
                        <input type="text" class="form-control" id="dongGoi" name="dongGoi" required>
                    </div>
                    <div class="form-group">
                        <label for="loai">Loại</label>
                        <input type="text" class="form-control" id="loai" name="loai" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="add_thuoc" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal chỉnh sửa thông tin thuốc -->
<div class="modal fade" id="editThuocModal" tabindex="-1" role="dialog" aria-labelledby="editThuocModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="editThuocModalLabel">Chỉnh sửa thông tin thuốc</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="thuocId" id="edit-thuoc-id">
                    <div class="form-group">
                        <label for="edit-ten-thuoc">Tên thuốc</label>
                        <input type="text" class="form-control" id="edit-ten-thuoc" name="tenThuoc" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-ngay-het-han">Ngày hết hạn</label>
                        <input type="date" class="form-control" id="edit-ngay-het-han" name="ngayHetHan" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-gia-von">Giá vốn</label>
                        <input type="text" class="form-control" id="edit-gia-von" name="giaVon" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-gia-ban">Giá bán</label>
                        <input type="text" class="form-control" id="edit-gia-ban" name="giaBan" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-so-luong-ton">Số lượng tồn</label>
                        <input type="text" class="form-control" id="edit-so-luong-ton" name="soLuongTon" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-dong-goi">Đóng gói</label>
                        <input type="text" class="form-control" id="edit-dong-goi" name="dongGoi" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-loai">Loại</label>
                        <input type="text" class="form-control" id="edit-loai" name="loai" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="edit_thuoc" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- footer -->
<?php include ("master-view/footer.php");?>
<!-- end footer  -->

<!-- JavaScript để điền thông tin vào form chỉnh sửa khi mở modal -->
<script>
$('#addThuocModal').on('show.bs.modal', function () {
    // Clear form fields when modal is opened
    $(this).find('form').trigger('reset');
});
    
    $('.btn-edit-thuoc').on('click', function() {
        var id = $(this).data('id');
        var tenThuoc = $(this).data('ten');
        var ngayHetHan = $(this).data('ngayhethan');
        var giaVon = $(this).data('giavon');
        var giaBan = $(this).data('giaban');
        var soLuongTon = $(this).data('soluongton');
        var dongGoi = $(this).data('donggoi');
        var loai = $(this).data('loai');
        
        // Fill in the form fields with the data of the selected thuoc
        $('#editThuocModal').find('#edit-thuoc-id').val(id);
        $('#editThuocModal').find('#edit-ten-thuoc').val(tenThuoc);
        $('#editThuocModal').find('#edit-ngay-het-han').val(ngayHetHan);
        $('#editThuocModal').find('#edit-gia-von').val(giaVon);
        $('#editThuocModal').find('#edit-gia-ban').val(giaBan);
        $('#editThuocModal').find('#edit-so-luong-ton').val(soLuongTon);
        $('#editThuocModal').find('#edit-dong-goi').val(dongGoi);
        $('#editThuocModal').find('#edit-loai').val(loai);
    });
</script>
