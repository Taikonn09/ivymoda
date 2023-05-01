<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Trang quản trị</title>
    <link rel="stylesheet" href="../css/adminCSS.css">
    <link rel="stylesheet" href="product-list.css">
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

        <section class="content-right">
            <form action="" class="form-product-add" method="POST">
                <h1>Danh sách sản phẩm</h1>

                <table class="table-product-list">
                    <thead class="thead-product-list">
                        <tr class="tr-product-list">
                            <th class="th-product-list" id="medium-container">STT</th>
                            <th class="th-product-list">Hình ảnh</th>
                            <th class="th-product-list">Tên sản phẩm</th>
                            <th class="th-product-list">Giá tiền</th>
                            <th class="th-product-list">Mô tả</th>
                            <th class="th-product-list">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-product-list">
                        <?php
                        // truy vấn dữ liệu từ bảng products
                        $sql = "SELECT * FROM products";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // hiển thị dữ liệu lên bảng
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr class='tr-product-list'>";
                                echo "<td class='td-product-list'>" . $i . "</td>";

                                echo "</td>";
                                echo "<td class='td-product-list'>";
                                if (isset($row["product_img"])) {
                                    echo "<img class='product-image' src='upload/" . htmlspecialchars($row['product_img']) . "' alt='Image of " . htmlspecialchars($row['product_name']) . "'>";
                                }
                                echo "</td>";

                                echo "</td>";
                                echo "<td class='td-product-list'>";
                                if (isset($row["product_name"])) {
                                    echo $row["product_name"];
                                }
                                echo "</td>";
                                echo "<td class='td-product-list'>";
                                if (isset($row["product_price"])) {
                                    echo $row["product_price"];
                                }
                                echo "</td>";
                                echo "<td class='td-product-list'>";
                                if (isset($row["product_description"])) {
                                    echo $row["product_description"];
                                }
                                echo "</td>";
                                echo "<td class='td-product-list'>";
                                echo "<button>Sửa</button>";
                                echo "<button name='delete'>Xóa</button>";
                                echo "</td>";
                                echo "</tr>";
                                $i++;
                            }
                        } else {
                            echo "Không có dữ liệu.";
                        }
                        
                        ?>
                    </tbody>

                </table>

            </form>
        </section>
        <style>
            .th-product-list:nth-child(1) {
                width: 2%;
            }

            .th-product-list:nth-child(2) {
                width: 15%;
            }

            .th-product-list:nth-child(3) {
                width: 15%;
            }

            .th-product-list:nth-child(4) {
                width: 15%;
            }

            .th-product-list:nth-child(5) {
                width: 38%;
            }

            .th-product-list:nth-child(6) {
                width: 15%;
            }


            /*-------------nội dung table---------------------*/
            .td-product-list:nth-child(2) img {
                width: 100px;
                height: 100px;
            }
            .td-product-list:nth-child(3)  {
                color: #0000FF;
            }
            .td-product-list:nth-child(4)  {
                color: red;
            }
        </style>
</body>
<script>

</script>
<script src="../js/admin.js"></script>

</html>