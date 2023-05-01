<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Trang quản trị</title>
	<link rel="stylesheet" href="../css/adminCSS.css">
	<link rel="stylesheet" href="comment.css">
</head>
<?php
include "../../database/connectDB.php";
include "../../database/library.php";
?>

<body>
	<header id="header-admin">
		<a href="../index.php">
			<img src="../../images/logo.jpg" alt="logo">
		</a>
		<h1 class="heading-title-page">Chào mừng đến với AIO</h1>

		<div class="header-right">
			<img id="admin-img" src="../../images/admin.png" alt="admin-img">
			<div id="admin-name" class="admin-name">
				<?php
				session_start();
				// Kiểm tra xem đã đăng nhập chưa
				require_once('../../database/library.php');
				check_login();
				// Hiển thị câu chào mừng
				echo $_SESSION['username'] . '<i class="fa-solid fa-chevron-down icon-right-name"></i>';
				?>
			</div>
			<a id="logout-link" class="logout-admin hidden" href="logout.php">
				<p>logout</p>
				<i style="margin-left: 5px;" class="fa-solid fa-right-from-bracket"></i>
			</a>
		</div>

	</header>

	<main id="main-page">
		<section id="slider">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="../index.php">
						<i class="fa-solid fa-house"></i>
						Trang chủ
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="dropdown-toggle">
						<i class="fa-brands fa-windows"></i>
						Quản lý sản phẩm <i class="fa-solid fa-chevron-down icon-right-name"></i>
					</a>
					<ul class="dropdown-menu">
						<li class="dropdown-menu-item"><a href="categoryAD/index.php">Thêm loại sản phẩm mới</a></li>
						<li class="dropdown-menu-item"><a href="categoryAD/category-list.php">Danh sách loại sản phẩm</a></li>
						<li class="dropdown-menu-item"><a href="productAD/index.php">Thêm sản phẩm mới</a></li>
						<li class="dropdown-menu-item"><a href="productAD/product-list.php">Danh sách sản phẩm</a></li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="#">
						<i class="fa-solid fa-truck"></i>
						<a href="order.php">Quản lý đơn hàng</a> 
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="dropdown-toggle">
						<i class="fa-solid fa-users"></i>
						<a href="users.php">Quản lý người dùng</a>
					</a>
				</li>
				<li class="nav-item">
					<a href="#">
						<i class="fa-solid fa-comments"></i>
						<a href="../commentAD/index.php">Quản lý bình luận</a>
					</a>
				</li>
				<li class="nav-item">
					<a href="#">
						<i class="fa-solid fa-gear"></i>
						Cài đặt trang web
					</a>
				</li>
			</ul>
		</section>

		<div id="content-page">
			<div class="content-title">
				<h1 style="font-size: 30px;">Bình luận của người dùng</h1>
			</div>

        


            <?php
    // Kết nối với cơ sở dữ liệu
    $conn = mysqli_connect("localhost", "root", "", "web_productss");
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Lấy số lượng đơn hàng của 10 sản phẩm bán chạy nhất
    $sql = "SELECT comments.id, products.product_name, users.user_name, comments.cm_time, comments.content
        FROM comments
        INNER JOIN users ON comments.user_id = users.id
        INNER JOIN products ON products.id = comments.product_id
        ORDER BY comments.id DESC 
        LIMIT 10";


    $result = mysqli_query($conn, $sql);

    // Duyệt qua kết quả trả về và hiển thị thông tin sản phẩm hot
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table'>";
        echo "<tr><th class='id'>ID</th><th class='product-name'>Tên sản phẩm</th><th class='user_name'>Tên nguời dùng</th><th class='time'>Thời gian</th><th class='content'>Nội dung</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
			echo "<td class='id'>" . $row['id'] . "</td>";
            echo "<td class='product-name'>" . $row['product_name'] . "</td>";
            echo "<td class='user_name'>" . $row['user_name'] . "</td>";
            echo "<td class='time'>" . $row['cm_time'] . "</td>";
			echo "<td class='content'>" . $row['content'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Không có sản phẩm hot nào.";
    }

    // Đóng kết nối
    mysqli_close($conn);
?>



