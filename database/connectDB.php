<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ivy_demo";
 
    // Kết nối đến CSDL
    $conn = mysqli_connect($servername, $username, $password, $dbname);
 
    // Kiểm tra kết nối
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
