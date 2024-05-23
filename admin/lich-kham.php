<?php
include ("../myclass/cls-lichkham.php");
$p = new lichkham();

// Handle adding an appointment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_lichkham"])) {
    $khoa = $_POST["khoa"];
    $ngay = $_POST["ngay"];
    $gio = $_POST["gio"];
    $bacsi = $_POST["bacsi"];
    
    $result = $p->addLichKham($khoa, $ngay, $gio, $bacsi);
    echo "<script>alert('$result');</script>";
}

// Handle deleting an appointment
if (isset($_POST['delete_lichkham'])) {
    $delete_id = $_POST['delete_id'];
    $result = $p->deleteLichKham($delete_id);
    echo "<script>alert('$result');</script>";
}

// Handle editing an appointment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_lichkham"])) {
    $edit_id = $_POST["edit_id"];
    $edit_khoa = $_POST["edit_khoa"];
    $edit_ngay = $_POST["edit_ngay"];
    $edit_gio = $_POST["edit_gio"];
    $edit_bacsi = $_POST["edit_bacsi"];
    
    $result = $p->updateLichKham($edit_id, $edit_khoa, $edit_ngay, $edit_gio, $edit_bacsi);
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
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mb-3">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLichKham">
                    Thêm lịch khám
                </button>
            </div>
            <div class="col-md-6">
                <form action="" method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="search_date" class="mr-2">Chọn ngày:</label>
                        <input type="date" class="form-control mr-2" id="search_date" name="search_date">
                    </div>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive pt-3">
                        <table class="table table-striped project-orders-table">
                            <thead>
                                <tr>
                                    <th>Ngày</th>
                                    <th>Bác sĩ</th>
                                    <th>Khoa</th>
                                    <th>Giờ</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                // Lấy ngày tìm kiếm nếu có 
                                $search_date = isset($_GET['search_date']) ? $_GET['search_date'] : null;
                                $query = "SELECT * FROM tbl_lichkham";
                                if ($search_date) {
                                    $query .= " WHERE ngay = '$search_date'";
                                }
                                $query .= " ORDER BY id ASC";
                                $data = $p->xemlichkham($query);
                                
                                foreach ($data as $lh) {
                                    echo '<tr>';
                                    echo '<td>' . $lh['ngay'] . '</td>';
                                    echo '<td>' . $lh['bacsi'] . '</td>';
                                    echo '<td>' . $lh['khoa'] . '</td>';
                                    echo '<td>' . $lh['gio'] . '</td>';
                                    echo '<td>
                                            <div class="d-flex align-items-center">
                                                <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3 btn-edit" data-toggle="modal" data-target="#editLichKham" data-id="' . $lh['id'] . '" data-khoa="' . $lh['khoa'] . '" data-ngay="' . $lh['ngay'] . '" data-gio="' . $lh['gio'] . '" data-bacsi="' . $lh['bacsi'] . '">
                                                        Sửa
                                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                                </button>
                                                <form method="post" onsubmit="return confirm(\'Bạn có chắc chắn muốn xóa lịch ngày: ' . $lh['ngay'] . ' không?\')">
                                                    <input type="hidden" name="delete_id" value="' . $lh['id'] . '">
                                                    <button type="submit" name="delete_lichkham" class="btn btn-danger btn-sm btn-icon-text">
                                                        Xóa
                                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            </td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End content -->

<!-- footer -->
<?php include("master-view/footer.php"); ?>
<!-- end footer -->

<!-- Modal thêm lịch khám -->
<div class="modal fade" id="addLichKham" tabindex="-1" role="dialog" aria-labelledby="addLichKhamModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLichKhamLabel">Thêm Lịch Khám</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addLichKhamForm" method="post" action="">
                    <div class="form-group">
                        <label for="ngay">Ngày</label>
                        <input type="date" class="form-control mr-2" id="ngay" name="ngay" required>
                    </div>
                    <div class="form-group">
                        <label for="bacsi">Bác sĩ</label>
                        <input type="text" class="form-control border-primary" id="bacsi" name="bacsi" placeholder="Nhập bác sĩ" required>
                    </div>
                    <div class="form-group">
                        <label for="khoa">Khoa</label>
                        <select class="form-control border-primary" id="khoa" name="khoa" required>
                            <option value="Thần kinh">Thần kinh</option>
                            <option value="Răng hàm mặt">Răng hàm mặt</option>
                            <option value="X quang">X quang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gio">Giờ</label>
                        <select class="form-control border-primary" id="gio" name="gio" required>
                            <option value="8AM - 11AM">8AM - 11AM</option>
                            <option value="2PM - 5PM">2PM - 5PM</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" name="add_lichkham">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Kết thúc modal thêm lịch khám -->

<!-- Modal sửa lịch khám -->
<div class="modal fade" id="editLichKham" tabindex="-1" role="dialog" aria-labelledby="editLichKhamLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLichKhamLabel">Cập Nhật Lịch Khám</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editLichKhamForm" method="post" action="">
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="form-group">
                        <label for="edit_ngay">Ngày</label>
                        <input type="date" class="form-control mr-2" id="edit_ngay" name="edit_ngay" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_bacsi">Bác sĩ</label>
                        <input type="text" class="form-control border-primary" id="edit_bacsi" name="edit_bacsi" placeholder="Nhập bác sĩ" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_khoa">Khoa</label>
                        <select class="form-control border-primary" id="edit_khoa" name="edit_khoa" required>
                            <option value="Thần kinh">Thần kinh</option>
                            <option value="Răng hàm mặt">Răng hàm mặt</option>
                            <option value="X quang">X quang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_gio">Giờ</label>
                        <select class="form-control border-primary" id="edit_gio" name="edit_gio" required>
                            <option value="8AM - 11AM">8AM - 11AM</option>
                            <option value="2PM - 5PM">2PM - 5PM</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" name="edit_lichkham">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Kết thúc modal sửa lịch khám -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    $('#editLichKham').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var khoa = button.data('khoa');
        var ngay = button.data('ngay');
        var gio = button.data('gio');
        var bacsi = button.data('bacsi');
        
        var modal = $(this);
        modal.find('#edit_id').val(id);
        modal.find('#edit_khoa').val(khoa);
        modal.find('#edit_ngay').val(ngay);
        modal.find('#edit_gio').val(gio);
        modal.find('#edit_bacsi').val(bacsi);
    });
});
</script>
