<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Trang quản trị</title>
	<link rel="stylesheet" href="../css/adminCSS.css">
	<link rel="stylesheet" href="category-list.css">
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
						<li class="dropdown-menu-item"><a href="index.php">Thêm loại sản phẩm mới</a></li>
						<li class="dropdown-menu-item"><a href="#">Danh sách loại sản phẩm</a></li>
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

		<section class="content-right">
		<form action="delete-category.php" class="form-category-add" method="POST">
    <h1>Danh mục sản phẩm</h1>

    <table class="table-category-list">
        <thead class="thead-category-list">
            <tr class="tr-category-list">
                <th class="th-category-list">STT</th>
                <th class="th-category-list">ID Danh Mục</th>
                <th class="th-category-list">Tên Danh Mục</th>
                <th class="th-category-list">Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
			

            // Truy vấn dữ liệu từ bảng category.
            $sql = "SELECT id_categories, category_name FROM categories";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // hiển thị dữ liệu lên bảng
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr class='tr-category-list'>";
                    echo "<td class='td-category-list'>" . $i . "</td>";
                    echo "<td class='td-category-list'>" . $row["id_categories"] . "</td>";
                    echo "<td class='td-category-list'>" . $row["category_name"] . "</td>";
                    echo "<td class='td-category-list'>";
                    echo "<input type='hidden' name='id_categories' value='" . $row["id_categories"] . "'>";
                    echo "<button type='submit' name='edit'> <a href='edit-category.php'>sửa</a></button>";
                    echo "<button type='submit' name='delete'>Xóa</button>";
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                }
            } else {
                echo "<tr class='tr-category-list'><td colspan='4'>Không có dữ liệu.</td></tr>";
            }

			// Lưu giá trị id_categories vào session khi người dùng nhấn vào nút Sửa
			if(isset($_POST['edit'])){
				$_SESSION['category_id'] = $_POST['id_categories'];
				header("Location: edit-category.php");
				exit();
			}
            ?>
        </tbody>
    </table>
</form>

		</section>

</body>
<script>

</script>
<script src="../js/admin.js"></script>

</html>