<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Trang quản trị</title>
	<link rel="stylesheet" href="../css/adminCSS.css">
	<link rel="stylesheet" href="category.css">
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
						<li class="dropdown-menu-item"><a href="#">Thêm loại sản phẩm mới</a></li>
						<li class="dropdown-menu-item"><a href="category-list.php">Danh sách loại sản phẩm</a></li>
						<li class="dropdown-menu-item"><a href="../productAD/index.php">Thêm sản phẩm mới</a></li>
						<li class="dropdown-menu-item"><a href="../productAD/product-list.php">Danh sách sản phẩm</a></li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="#">
						<i class="fa-solid fa-truck"></i>
						Quản lý đơn hàng
					</a>
				</li>
				<li class="nav-item">
					<a href="#">
						<i class="fa-solid fa-users"></i>
						Quản lý người dùng
					</a>
				</li>
				<li class="nav-item">
					<a href="#">
						<i class="fa-solid fa-comments"></i>
						Quản lý lượt bình luận
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
		<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$category_name = $_POST['category_name'];
			$sql_check = "SELECT COUNT(*) as count FROM categories WHERE category_name = '$category_name'";
			$result_check = mysqli_query($conn, $sql_check);
			$count = mysqli_fetch_assoc($result_check)['count'];
			if ($count > 0) {
				echo "<span class='mesage-submit'>Loại sản phẩm đã tồn tại trong cơ sở dữ liệu !</span>";
			} else {
				$sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					echo "<span class='mesage-submit'>Thêm loại sản phẩm thành công !</span>";
				} else {
					echo "<span class='mesage-submit'>Thêm loại sản phẩm thất bại: " . mysqli_error($conn) . "</span>";
				}
			}
			mysqli_close($conn);
		}
		?>
		<section class="content-right">
			<form action="" class="form-category-add" method="POST">
				<h1>Thêm danh mục sản phẩm</h1>
				<input required name="category_name" type="text" placeholder="Nhập tên danh mục...">
				<div class="btn-cate-page">
					<a class="btn-category-list" href="category-list.php">Danh sách danh mục</a>

					<button class="btn-add" type="submit" name="add">Thêm</button>
				</div>
			</form>

		</section>
	</main>
</body>
<script src="categoryAD.js"></script>
<script src="../js/admin.js"></script>

</html>
