<?php include("master-view/header.php"); ?>

<section class="contact_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>ĐẶT LỊCH KHÁM BỆNH</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form_container contact-form">
                    <form method="POST" action="../admin/lich-hen.php">
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div>
                                    <input type="text" name="ten" placeholder="Nhập tên" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <input type="text" name="sdt" placeholder="Số điện thoại" required>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <div>
                            <input type="date" name="date" placeholder="Ngày khám" required>
                        </div>
                        <div>
                            <input type="time" name="time" placeholder="Giờ khám" required>
                        </div>
                        <div>
                            <input type="text" name="option" placeholder="Chọn bác sĩ" required>
                        </div>
                        <div>
                            <input type="text" name="tieude" placeholder="Tiêu đề" required>
                        </div>
                        <div class="btn_box">
                            <button type="submit">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="map_container">
                    <div class="map">
                        <div id="googleMap"></div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>

<?php include("master-view/footer.php"); ?>
