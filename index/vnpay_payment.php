<?php
require '../myclass/cls-admin.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Lấy thông tin từ biểu mẫu
$hoTen = $_POST['hoTen'];
$dienThoai = $_POST['dienThoai'];
$tongTien = $_POST['tongTien'];

$vnp_TmnCode = "P6BKC0VI"; // Mã website của bạn tại VNPay
$vnp_HashSecret = "KVVJFEKPKKOZMVIUODRUJBFTDDNRGHKO"; // Chuỗi bí mật
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL thanh toán của VNPay
$vnp_Returnurl = "http://localhost/phongkhamhd/index/return_url.php"; // URL trả về sau khi thanh toán
$vnp_IpnUrl = "http://localhost/phongkhamhd/index/notify_url.php"; // URL thông báo kết quả thanh toán (IPN URL)

$vnp_TxnRef = time(); // Mã đơn hàng
$vnp_OrderInfo = "Thanh toán hóa đơn #" . $vnp_TxnRef;
$vnp_OrderType = 'billpayment';
$vnp_Amount = $tongTien * 100; // Số tiền thanh toán
$vnp_Locale = 'vn';
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
);

ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}

// Lưu thông tin thanh toán vào cơ sở dữ liệu
$admin = new admin();
$conn = $admin->connect();

$sql = "INSERT INTO tbl_thanhtoan (hoTen, dienThoai, tongTien, maDonHang) VALUES ('$hoTen', '$dienThoai', '$tongTien', '$vnp_TxnRef')";
if ($conn->query($sql) === TRUE) {
    echo "Lưu thông tin thanh toán thành công!";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: ' . $vnp_Url);
exit();
?>
