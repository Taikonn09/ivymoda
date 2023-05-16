<?php
// Xóa các session hoặc biến cookie
session_destroy();

// Chuyển hướng người dùng đến trang đăng nhập (hoặc trang khác tùy ý)
header("Location: ../test.php");
exit;
?>
