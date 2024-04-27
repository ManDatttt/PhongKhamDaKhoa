<?php 
include ("../myclass/cls-lichhen.php");
$p = new lichhen();

?>
<!-- header -->
<?php include("master-view/header.php"); ?>
<!-- end header -->

<!-- sidebar -->
<?php include("master-view/sidebar.php"); ?>
<!-- end sidebar -->

<!-- Content -->


<!-- Hiển thị thông tin lịch hẹn  -->
<div class="main-panel">
<div class="content-wrapper">

<!-- Thêm nút "Thêm lịch hẹn" -->

<div class="row mb-3">
    <div class="col-md-6">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            Thêm lịch hẹn
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
                    <th>Mã KH</th>
                    <th>Tên KH</th>
                    <th>SDT</th>
                    <th>Email</th>
                    <th>Ngày</th>
                    <th>Giờ</th>
                    <th>Bác sĩ</th>
                    <th>Tiêu đề</th> 
                    <th>Thao tác</th> 
                </tr>
            </thead>
            <tbody>
                <?php 
                $userData = $p->xemlichhen("SELECT * FROM tbl_lichhen ORDER BY makh ASC");
                $dem = 1;
                foreach ($userData as $user) {
                    echo '<tr>';
                    echo '<td>'.$dem.'</td>';
                    echo '<td>'.$user['makh'].'</td>';
                    echo '<td>'.$user['tenkh'].'</td>';
                    echo '<td>0'.$user['sdt'].'</td>';
                    echo '<td>'.$user['email'].'</td>';
                    echo '<td>'.$user['ngay'].'</td>';
                    echo '<td>'.$user['gio'].'</td>';
                    echo '<td>'.$user['bacsi'].'</td>';
                    echo '<td>'.$user['tieude'].'</td>';
                    echo '<td>
                              <div class="d-flex align-items-center">
                                 <button type="submit" class="btn btn-success btn-sm btn-icon-text mr-3 btn-edit" data-toggle="modal" data-target="#editUserModal">
                                        Sửa
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                </button>
                                <form method="post" onsubmit="return confirm(\'Bạn có chắc chắn muốn xóa tài khoản có username ' . $user['tenkh'] . ' không?\')">
                                    <input type="hidden" name="delete_id" value="' . $user['makh'] . '">
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
<?php include("master-view/footer.php"); ?>
<!-- end footer  -->