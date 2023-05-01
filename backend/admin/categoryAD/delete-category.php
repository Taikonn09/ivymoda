<?php

//-------------------------xóa---------------------------------------
// Kết nối đến CSDL
$conn = mysqli_connect("localhost", "root", "", "web_productss");

// Kiểm tra xem người dùng đã nhấn nút "Xóa" chưa.
if (isset($_POST["delete"])) {
    // Lấy giá trị id của category từ input hidden.
    $id = $_POST["id_categories"];

    // Thực hiện các thao tác trên CSDL sử dụng biến "id_categories" ở đây.
    if (isset($id)) {
        // Xóa category khỏi CSDL.
        $sql = "DELETE FROM categories WHERE id_categories = $id";
        mysqli_query($conn, $sql);

        // Chuyển hướng trang web đến trang danh sách category.
        header("Location: category-list.php");
        exit();
    }
}

//--------------------------sửa-----------------------------------------------


?>




