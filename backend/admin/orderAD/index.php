<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Trang quản trị</title>
	<link rel="stylesheet" href="../css/adminCSS.css">
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
						<a href="comments.php">Quản lý lượt bình </a>
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
				<h1 style="font-size: 30px;">Quản lý đặt hàng</h1>
			</div>

        


            <?php
    // Kết nối với cơ sở dữ liệu
  

    // Lấy số lượng đơn hàng của 10 sản phẩm bán chạy nhất
    $sql = "SELECT products.product_name, users.user_name , users.user_email , products.product_price, orders.order_date, details.status, SUM(order_details.quantity) as total_quantity
            FROM order_details
            INNER JOIN products ON order_details.product_id = products.id
            INNER JOIN orders ON order_details.order_id = orders.id
            INNER JOIN details ON details.order_id = orders.id
            INNER JOIN users ON users.id = orders.user_id
            WHERE details.status = 'Hoàn thành'
            GROUP BY products.id
            ORDER BY total_quantity DESC LIMIT 10";

    $result = mysqli_query($conn, $sql);

    // Duyệt qua kết quả trả về và hiển thị thông tin sản phẩm hot
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table'>";
        echo "<tr><th class='product'>Tên sản phẩm</th><th class='product'>Giá</th><th class='product'>Ngày đặt hàng</th><th class='product'>Trạng thái</th><th class='user'>Người dùng</th><th class='user'>Email</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['product_price'] . "</td>";
            echo "<td>" . $row['order_date'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['user_email'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Không có sản phẩm hot nào.";
    }

    // Đóng kết nối
    mysqli_close($conn);
?>


<style>

	.content-title h1{
		text-align: center;
	}
    .product{
        color: #00FF00;
    }
    .table {
        border-collapse: collapse;
        width: 1100px;
		margin: 0px auto;
		margin-top: 20px;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #EE0000;
    }

    tr:nth-child(even) {
        background-color: #999999;
        color: white;
    }
</style>
<style>
	table {
		border-collapse: collapse;
		width: 100%;
	}
	th, td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #EE0000dd;
	}
	th {
		background-color: #f2f2#EE0000f2;
		color: #333;
		font-weight: bold;
	}
	
	
	.product-name {
		width: 40%;
	}
	.product-price {
		width: 20%;
	}
	.order-date {
		width: 20%;
	}
	.status {
		width: 20%;
	}
</style>
