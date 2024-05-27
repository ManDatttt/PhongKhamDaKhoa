<?php
include("master-view/header.php");
require_once '../myclass/cls-lichkham.php';

$lichkham = new lichkham();
$sql = "SELECT * FROM tbl_lichkham ORDER BY ngay ASC, gio ASC";
$data = $lichkham->xemlichkham($sql);
?>

<div class="container">
    <h2 class="mt-5">Lịch khám bác sĩ</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>STT</th>
                <th>Khoa</th>
                <th>Ngày</th>
                <th>Giờ</th>
                <th>Bác sĩ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 1;
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td>{$stt}</td>";
                echo "<td>{$row['khoa']}</td>";
                echo "<td>{$row['ngay']}</td>";
                echo "<td>{$row['gio']}</td>";
                echo "<td>{$row['bacsi']}</td>";
                echo "</tr>";
                $stt++;
            }
            ?>
        </tbody>
    </table>
</div>

<?php include("master-view/footer.php"); ?>
