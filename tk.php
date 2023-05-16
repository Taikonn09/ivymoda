<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <title>Trang chủ | IVY Moda</title>
</head>

<body>
    <div class="container-page">
        <header id="header-page" #top>
            <nav class="nav-page">
                <li>
                    <a href="">Nữ</a>
                    <!-- <ul>
                        <li>Áo</li>
                        <li>Quần</li>
                        <li>Váy</li>
                       </ul> -->
                </li>
                <li><a href="">nam</a></li>
                <li><a href="">trẻ em</a></li>
                <li><a style="color: #ff0000" href="">sale đại lễ</a></li>
                <li><a href="">bộ sưu tập</a></li>
                <li><a href="">lifestyle</a></li>
                <li><a href="">về chúng tôi</a></li>
            </nav>

            <a href="index.html">
                <img src="images/logo.png" alt="logo YVI">
            </a>

            <article class="header-right">
                <section class="header-right-item">
                    <button type="get" action="tk.php" method="POST"><span
                            class="material-symbols-outlined">search</span></button>
                    <input type="text" placeholder="TÌM KIẾM SẢN PHẨM">

                    <ul>
                        <li><a href="#"><span class="material-symbols-outlined">headphones</span></a></li>
                        <li><a href="login-signup/"><span class="material-symbols-outlined">person</span></a></li>

                        <!-- -----------------------------------------giỏ hàng------------------------------------ -->
                        <li>
                            <a class="shopping-cart" onclick="showCart()">
                                <span class="material-symbols-outlined">local_mall</span>
                                <!-- <p id="lenght-cart">0</p> -->
                            </a>

                            <div id="show-cart">
                                <div>
                                    <p class="title-cart">Giỏ hàng</p>
                                    <button style="background-color: #000; color: #fff;" class="close-btn" type="button"
                                        onclick="hideCart()"><span
                                            class="material-symbols-outlined">close</span></button>
                                </div>

                                <div id="my-cart">
                                    <p id="cart-items"></p>
                                    <p id="cart-total">Tổng tiền: <span> 0 đ</span></p>
                                </div>

                                <div id="checkout">
                                    <a href="cart.html">Xem giỏ hàng</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>
            </article>

        </header>
    </div>



<?php
// Kiểm tra biến $_GET["search"] có tồn tại hay không
if (isset($_GET["search"])) {
  $search = $_GET["search"];
  $conn = mysqli_connect("localhost", "root", "", "ivy_demo");
  if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
  }
  $sql = "SELECT * FROM product WHERE product_name LIKE '%$search%'";
  $result = $conn->query($sql);
  if ($result && $result->num_rows > 0) {
    echo "<p class='heading-search--tk container-search'>Kết quả tìm kiếm cho:". " <span>" .$search ."</span>" ."</p>";
    echo "<ul class='product-list container-search'>";
    while ($row = $result->fetch_assoc()) {
      echo "<li class='product-item '>";
      echo "<img class='product-image' src='admin-page/admin/productAD/upload/" . htmlspecialchars($row['product_img']) . "' alt='Image of " . htmlspecialchars($row["product_name"]) . "'>";
      echo "<p class='product-price'>" . "<span>" . $row["product_price"] . "</span>" . "</p>";
      echo "<p class='product-name'>" . $row["product_name"] . "</p>";
      echo "<p class='product-description'>Mô tả: " . $row["product_description"] . "</p>";
      echo "<button class='btn-add-to-cart'><span class='material-symbols-outlined'>local_mall</span></button>";
      echo "</li>";
    }
    echo "</ul>";
  } else {
    echo " <h3 class='else-heading-search'>Không có sản phẩm bạn muốn tìm, hãy thử lại ^^</h3>";
  }
  $conn->close();
} else {
  echo "Vui lòng nhập từ khóa tìm kiếm!";
}

?>

</body>
  <script src="js/app.js"></script>
</html>







