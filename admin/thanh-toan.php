<?php
require_once '../myclass/cls-thanhtoan.php';

$thanhtoan = new thanhtoan();
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
                    <th>Điện thoại</th>
                    <th>Tổng tiền</th>
                    <th>Mã đơn hàng</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM tbl_thanhtoan";
                $hoaDons = $thanhtoan->xemHoaDon($sql);
                $dem = 1;
                foreach ($hoaDons as $hoaDon) {
                    echo '<td>'.$dem.'</td>';
                    echo '<td>' . $hoaDon['hoTen'] . '</td>';
                    echo '<td>' . $hoaDon['dienThoai'] . '</td>';
                    echo '<td>' . $hoaDon['tongTien'] . '</td>';
                    echo '<td>' . $hoaDon['maDonHang'] . '</td>';
                    echo '<td>' . $hoaDon['trangThai'] . '</td>';
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

<!-- End content -->

<!-- footer -->
<?php include("master-view/footer.php"); ?>
<!-- end footer  -->