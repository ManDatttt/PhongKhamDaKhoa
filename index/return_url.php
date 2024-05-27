<?php
require '../myclass/cls-admin.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

$vnp_HashSecret = "KVVJFEKPKKOZMVIUODRUJBFTDDNRGHKO"; // Chuỗi bí mật từ VNPay

$inputData = array();
$returnData = $_GET;

foreach ($returnData as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

$vnp_SecureHash = $inputData['vnp_SecureHash'];
unset($inputData['vnp_SecureHash']);

ksort($inputData);
$hashData = "";
$i = 0;
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

if ($secureHash == $vnp_SecureHash) {
    if ($inputData['vnp_ResponseCode'] == '00') {
        echo "Thanh toán thành công!";
        // Bạn có thể cập nhật trạng thái đơn hàng tại đây
    } else {
        echo "Thanh toán không thành công. Mã lỗi: " . $inputData['vnp_ResponseCode'];
    }
} else {
    echo "Chữ ký không hợp lệ!";
}
?>