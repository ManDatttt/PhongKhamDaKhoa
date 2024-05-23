<!-- header -->
<?php include("master-view/header.php"); ?>
<!-- end header -->

<!-- sidebar -->
<?php include("master-view/sidebar.php"); ?>
<!-- end sidebar -->

<!-- Content -->

<div class="main-panel">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Tiếp nhận thông tin bệnh nhân
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="ten">Họ tên:</label>
                                    <input type="text" class="form-control" id="ten" placeholder="Họ tên">
                                </div>
                                <div class="form-group">
                                    <label for="namsinh">Năm sinh:</label>
                                    <input type="text" class="form-control" id="namsinh" placeholder="Năm sinh">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox">
                                    <label for="namsinh">Bệnh nhân cũ </label>
                                </div>
                                <div class="form-group">
                                    <label for="tuổi">Tuổi:</label>
                                    <input type="text" class="form-control" id="tuổi" placeholder="Tuổi">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Giới tính:</label>
                                    <select class="form-control" id="gender">
                                        <option>Nam</option>
                                        <option>Nữ</option>
                                        <!-- <option>LGBT</option> -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="diachi">Địa chỉ:</label>
                                    <input type="text" class="form-control" id="diachi" placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label for="tinh">Tỉnh/Thành Phố:</label>
                                    <input type="text" class="form-control" id="tinh" placeholder="Tỉnh/Thành phố">
                                </div>
                                <div class="form-group">
                                    <label for="sdt">Điện thoại:</label>
                                    <input type="text" class="form-control" id="sdt" placeholder="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label for="giamho">Người giám hộ:</label>
                                    <input type="text" class="form-control" id="giamho" placeholder="Người giám hộ">
                                </div>
                                <!-- Các trường thông tin khác -->
                                <button type="submit" class="btn btn-primary">Lưu và In phiếu thứ tự</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            Danh sách bệnh nhân đang chờ
                        </div>
                        <div class="card-body p-0">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Họ tên</th>
                                        <th>Giới tính</th>
                                        <th>Năm sinh</th>
                                        <th>STT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Huỳnh Mẫn Đạt</td>
                                        <td>Nam</td>
                                        <td>2002</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white">
                            In phiếu số thứ tự
                        </div>
                        <div class="card-body">
                            <div class="card-number">0001</div>
                            <p>Quý khách vui lòng chờ, số phiếu của quý khách sẽ được gọi khi đến lượt.</p>
                            <small>Ngày in: 29/10/2020 08:27:57</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- End content -->

<!-- footer -->
<?php include("master-view/footer.php"); ?>
<!-- end footer  -->