<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Trang quản trị</title>
	<link rel="stylesheet" href="../css/adminCSS.css">
	<link rel="stylesheet" href="productAD.css">
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
						<li class="dropdown-menu-item"><a href="../categoryAD/index.php">Thêm loại sản phẩm mới</a></li>
						<li class="dropdown-menu-item"><a href="../categoryAD/category-list.php">Danh sách loại sản phẩm</a></li>
						<li class="dropdown-menu-item"><a href="product-list.php">Thêm sản phẩm mới</a></li>
						<li class="dropdown-menu-item"><a href="product-list.php">Danh sách sản phẩm</a></li>
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

		<div class="content-right">
			<form action="" class="form-product-add" method="POST" enctype="multipart/form-data">
				<h1>Thêm sản phẩm mới</h1>
				<?php
				// Thực hiện truy vấn để lấy danh sách các danh mục sản phẩm
				$sql = "SELECT * FROM categories";
				$result = mysqli_query($conn, $sql);

				// Tạo thẻ <option> cho mỗi danh mục sản phẩm
				$options = '';
				while ($row = mysqli_fetch_assoc($result)) {
					$options .= "<option value='{$row['id_categories']}'>{$row['category_name']}</option>";
				}
				?>
				<div class="choose-category">
					<label>Chọn danh mục sản phẩm</label>
					<select name="id" id="id">
						<option value="">----- Chọn -----</option>
						<?php echo $options; ?>
					</select>
				</div>

				<div style="display: flex; justify-content: space-between;">
					<div style="width: 50%; margin-right: 10px">
						<label>Tên sản phẩm:</label>
						<input type="text" name="product_name" required>
						<label>Giá sản phẩm:</label>
						<input type="number" name="product_price" required>
						<label>Mô tả:</label>
						<input type="text" name="product_description" required 	>
						<label>Hình ảnh:</label>
						<input type="file" name="product_img" accept="image/*" required>
						<div style="display: flex;">
							
						<div style="display: flex; ">
							<button type="btn"><a href="product-list.php">Danh sách sản phẩm</a></button>
							<button type="submit" name="add">Thêm sản phẩm</button>
						</div>
					</div>
				</div>
			</form>
				<style>
					button{
						width: 250px;
						height: auto;
						margin-bottom: 20px;
					}
					div button:first-child{
						margin-right: 170px;
						
					}
				</style>

			<?php
			if (isset($_POST["add"])) {
				if (isset($_POST["product_name"]) && isset($_POST["product_price"]) && isset($_POST["product_description"]) && isset($_FILES["product_img"])) {
					$TENSP = $_POST["product_name"];
					$GIASP = $_POST["product_price"];
					$MOTA = $_POST["product_description"];
					$IMG = $_FILES['product_img']['name'];
					$target_dir = "C:/xampp/htdocs/testwebsite/testweb/admin/productAD/upload/";
					$target_file = $target_dir . basename($_FILES["product_img"]["name"]);
					move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file);

					// Lấy ID của danh mục sản phẩm được chọn
					$IDDM = $_POST['id'];
					$sql = "SELECT category_name FROM categories WHERE id_categories = $IDDM";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$category_name = $row['category_name'];


					// Kiểm tra xem sản phẩm có tồn tại trong database chưa
					$sql_check = "SELECT * FROM products WHERE product_name = '$TENSP'";
					$result_check = mysqli_query($conn, $sql_check);
					if (mysqli_num_rows($result_check) > 0) {
						echo "<span class='mesage-submit'>Sản phẩm đã tồn tại!</span>";
					} else {
						$sql = "INSERT INTO products (product_name, product_price, product_description, product_img, categories_id) 
                    VALUES ('$TENSP', '$GIASP', '$MOTA', '$IMG', '$category_name')";
						if (mysqli_query($conn, $sql)) {
							echo "<span class='mesage-submit'>Thêm sản phẩm thành công!</span>";
						} else {
							echo "<span class='mesage-submit'>Thêm không thành công!</span>";
						}
					}
				} else {
					echo "<span class='mesage-submit'>Vui lòng chọn danh mục sản phẩm !</span>";
				}
			} else {
				echo "<span class='mesage-submit'>Vui lòng nhập đầy đủ thông tin !</span>";
			}


			?>
		</div>
</body>
<script>
	let mesageSubmit = document.querySelector('.mesage-submit');
	mesageSubmit.classList.add('show');
	setTimeout(function() {
		mesageSubmit.classList.remove('show');
	}, 1500);

	const dropdownToggle = document.querySelector('.dropdown-toggle');
	dropdownToggle.addEventListener('click', function() {
		const dropdownMenu = this.nextElementSibling;
		dropdownMenu.classList.toggle('show');
		this.classList.toggle('active');
		const icon = this.querySelector("i");
		if (dropdownMenu.classList.contains("show")) {
			icon.classList.remove("fa-chevron-down");
			icon.classList.add("fa-chevron-up");
		} else {
			icon.classList.remove("fa-chevron-up");
			icon.classList.add("fa-chevron-down");
		}
	});

	// Sử dụng sự kiện click bên ngoài để đóng menu khi nhấn ra ngoài
	document.addEventListener('click', function(event) {
		const dropdowns = document.querySelectorAll('.dropdown-menu');
		dropdowns.forEach(function(dropdown) {
			if (dropdown.classList.contains('show') && !dropdown.contains(event.target) && !dropdownToggle.contains(event.target)) {
				dropdown.classList.remove('show');
				dropdownToggle.classList.remove('active');
				const icon = dropdownToggle.querySelector("i");
				icon.classList.remove("fa-chevron-up");
				icon.classList.add("fa-chevron-down");
			}
		});
	});
</script>
<script src="../js/admin.js"></script>

</html>