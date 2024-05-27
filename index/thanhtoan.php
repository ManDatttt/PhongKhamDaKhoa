<?php include("master-view/header.php"); ?>

<section class="contact_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>TRA CỨU HÓA ĐƠN</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form_container contact-form">
                    <form method="POST" action="">
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div>
                                    <input type="text" name="sdt" placeholder="Số điện thoại" required>
                                </div>
                            </div>
                        </div>
                        <div class="btn_box">
                            <button type="submit">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        include '../myclass/cls-thuoc.php';
        require_once '../myclass/cls-thanhtoan.php';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sdt = $_POST['sdt'];
            $thanhtoan = new thanhtoan();
            if ($thanhtoan->hoaDonDaThanhToan($sdt)) {
                echo '<div class="row">';
                echo '<div class="col-md-12">';
                echo '<p>Hóa đơn đã được thanh toán.</p>';
                echo '</div>';
                echo '</div>';
            } else {
            $toaThuoc = new toathuoc();
            $data = $toaThuoc->xemToaThuoc($sdt);

            if (!empty($data)) {
                echo '<div class="row">';
                echo '<div class="col-md-12">';
                echo '<h3>Kết quả tìm kiếm</h3>';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Họ Tên</th>';
                echo '<th>Giới tính</th>';
                echo '<th>Năm sinh</th>';
                echo '<th>Điện thoại</th>';
                echo '<th>Địa chỉ</th>';
                echo '<th>Chẩn đoán</th>';
                echo '<th>Ngày kê đơn</th>';
                echo '<th>Lời dặn</th>';
                echo '<th>Tên bác sĩ</th>';
                echo '<th>Thuốc</th>';
                echo '<th>Số lượng</th>';
                echo '<th>Liều dùng</th>';
                echo '<th>Giá</th>';
                echo '<th>Thành tiền</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                $tongTien = 0;
                $hoTen = '';
                $dienThoai = '';

                foreach ($data as $row) {
                    $hoTen = $row['hoTen'];
                    $dienThoai = $row['dienThoai'];
                    $rowSpan = count($row['thuoc']) > 0 ? count($row['thuoc']) : 1;
                    echo '<tr>';
                    echo '<td rowspan="' . $rowSpan . '">' . $row['hoTen'] . '</td>';
                    echo '<td rowspan="' . $rowSpan . '">' . $row['gioiTinh'] . '</td>';
                    echo '<td rowspan="' . $rowSpan . '">' . $row['namSinh'] . '</td>';
                    echo '<td rowspan="' . $rowSpan . '">' . $row['dienThoai'] . '</td>';
                    echo '<td rowspan="' . $rowSpan . '">' . $row['diaChi'] . '</td>';
                    echo '<td rowspan="' . $rowSpan . '">' . $row['chanDoan'] . '</td>';
                    echo '<td rowspan="' . $rowSpan . '">' . $row['ngayKeDon'] . '</td>';
                    echo '<td rowspan="' . $rowSpan . '">' . $row['loiDan'] . '</td>';
                    echo '<td rowspan="' . $rowSpan . '">' . $row['tenBacSi'] . '</td>';

                    if (count($row['thuoc']) > 0) {
                        $firstThuoc = array_shift($row['thuoc']);
                        $thanhTien = $firstThuoc['gia'] * $firstThuoc['soLuong'];
                        $tongTien += $thanhTien;
                        echo '<td>' . $firstThuoc['tenThuoc'] . '</td>';
                        echo '<td>' . $firstThuoc['soLuong'] . '</td>';
                        echo '<td>' . $firstThuoc['lieuDung'] . '</td>';
                        echo '<td>' . $firstThuoc['gia'] . '</td>';
                        echo '<td>' . $thanhTien . '</td>';
                        echo '</tr>';
                        foreach ($row['thuoc'] as $thuoc) {
                            $thanhTien = $thuoc['gia'] * $thuoc['soLuong'];
                            $tongTien += $thanhTien;
                            echo '<tr>';
                            echo '<td>' . $thuoc['tenThuoc'] . '</td>';
                            echo '<td>' . $thuoc['soLuong'] . '</td>';
                            echo '<td>' . $thuoc['lieuDung'] . '</td>';
                            echo '<td>' . $thuoc['gia'] . '</td>';
                            echo '<td>' . $thanhTien . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<td colspan="5">Không có thuốc</td>';
                        echo '</tr>';
                    }
                }
                echo '</tbody>';
                echo '<tfoot>';
                echo '<tr>';
                echo '<td colspan="13" style="text-align:right"><strong>Tổng tiền:</strong></td>';
                echo '<td><strong>' . $tongTien . '</strong></td>';
                echo '</tr>';
                echo '</tfoot>';
                echo '</table>';

                // Thêm form thanh toán VNPay
                echo '<form action="vnpay_payment.php" method="POST">';
                echo '<input type="hidden" name="tongTien" value="' . $tongTien . '">';
                echo '<input type="hidden" name="hoTen" value="' . $hoTen . '">';
                echo '<input type="hidden" name="dienThoai" value="' . $dienThoai . '">';
                echo '<div class="btn_box">';
                echo '<button type="submit">Thanh toán VNPay</button>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="row">';
                echo '<div class="col-md-12">';
                echo '<p>Không tìm thấy hóa đơn cho số điện thoại này.</p>';
                echo '</div>';
                echo '</div>';
            }
        }
    }
        ?>

    </div>
</section>

<?php include("master-view/footer.php"); ?>
