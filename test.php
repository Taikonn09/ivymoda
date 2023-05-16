<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <title>Trang chủ | IVY Moda</title>
</head>
<?php
include "database/connectDB.php";
?>

<body>
    <div class="container-page">
        <header id="header-page" #top>
            <nav class="nav-page">
                <?php
                $query = "SELECT * FROM category";
                $result = mysqli_query($conn, $query);

                // Kiểm tra và xử lý kết quả truy vấn
                if (mysqli_num_rows($result) > 0) {
                    // Lặp qua từng hàng kết quả
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Xử lý dữ liệu và hiển thị
                        $categoryName = $row['category_name'];
                        echo "<li><a href=''>" . $categoryName . "</a></li>";
                    }
                }
                ?>
                <li><a href="">về chúng tôi</a></li>
            </nav>

            <a href="index.html">
                <img src="images/logo.png" alt="logo YVI">
            </a>

            <article class="header-right">
                <section class="header-right-item">
                    <?php
                    // Kiểm tra trạng thái đăng nhập
                    $userLoggedIn = false; // Giả sử là chưa đăng nhập

                    // Lấy tên người dùng từ session (nếu đã đăng nhập)
                    $user_name = "";
                    if ($userLoggedIn) {
                        $user_name = $_SESSION['user_name'];
                    }
                    ?>

                    <div id="name-img-user" style="<?php $nameImgUserStyle = $userLoggedIn ? '' : 'display: none;'; ?>">
                        <img src="images/user.png" alt="user" id="user-img">
                        <p id="user-name">
                            <?php
                            if ($userLoggedIn) {
                                echo 'Xin chào, <span style="color: red;">' . $user_name . '</span>!';
                            }
                            ?>
                        </p>

                        <form action="../ivymoda/login-signup/logout.php" method="POST" class="logout-action">
                            <button id="logout-button" type="submit">Đăng xuất</button>
                        </form>
                    </div>

                    <style>
                        #name-img-user {
                            text-align: center;
                            margin-right: 20px;
                            position: relative;
                            cursor: pointer;
                        }

                        #name-img-user img {
                            width: 30px;
                            height: 30px;
                        }

                        #name-img-user p {
                            text-transform: capitalize;
                        }

                        #name-img-user .logout-action button {
                            background-color: #000;
                            color: #fff;
                            width: 100px;
                            padding: 10px;
                            text-align: center;
                            position: absolute;
                            right: 5px;
                            top: 50px;
                            display: none;
                            cursor: pointer;
                        }
                    </style>

                    <form class="search-box" method="GET">
                        <div>
                            <button><span class="material-symbols-outlined">search</span></button>
                        </div>
                        <input type="text" placeholder="TÌM KIẾM SẢN PHẨM">
                    </form>
                    <ul>
                        <li><a href="#"><span class="material-symbols-outlined">headphones</span></a></li>
                        <li><a href="login-signup/index.php"><span class="material-symbols-outlined">person</span></a></li>

                        <!-- -----------------------------------------giỏ hàng------------------------------------ -->
                        <li>
                            <a class="shopping-cart" onclick="showCart()">
                                <span class="material-symbols-outlined">local_mall</span>
                                <!-- <p id="lenght-cart">0</p> -->
                            </a>

                            <div id="show-cart">
                                <div>
                                    <p class="title-cart">Giỏ hàng</p>
                                    <button style="background-color: #000; color: #fff;" class="close-btn" type="button" onclick="hideCart()"><span class="material-symbols-outlined">close</span></button>
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

    <main>
        <section class="banner-page">
            <img src="images/banner1.jpg" alt="banner1">
        </section>

        <section class="input-radio">
            <input type="radio" checked>
            <input type="radio">
            <input type="radio">
        </section>
        <?php
        // Kết nối đến CSDL ivy_demo của bạn
        $conn = mysqli_connect('localhost', 'root', '', 'ivy_demo');

        // Kiểm tra kết nối
        if (!$conn) {
            die('Kết nối không thành công: ' . mysqli_connect_error());
        }
        $sql = "SELECT * FROM product";
        $result = mysqli_query($conn, $sql);
        ?>
        <section class="new-product container-page">
            <h1>New Arrival</h1>

            <ul id="product-list">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_name = $row['product_name'];
                    $product_image = $row['product_img'];
                    $price_old = $row['price_old'];
                    $price_new = $row['price_new'];
                    echo '<li class="product-item">'; ?>
                    <span class="badget">-30%</span>
                    <a href="#"><img src="images/product1.jpg" alt="product-img"></a>
                    <div>
                    <?php
                    // Hiển thị thông tin sản phẩm trong cấu trúc HTML đã cho
                    echo '<div></div>';
                    echo '<p class="product-name">' . $product_name . '</p>';
                    echo '<div style="display: flex; justify-content: space-between;">';
                    echo '<div class="product-price">';
                    echo '<p class="price-new">' . $price_new . '</p>';
                    echo '<p class="price-old"><del>' . $price_old . '</del></p>';
                    echo '</div>';
                    echo '<button type="button" class="add-to-cart"><span class="material-symbols-outlined">local_mall</span></button>';
                    echo '</div>';
                    echo '</li>';
                }
                    ?>
            </ul>
        </section>
    </main>
</body>
<script>
    // Lấy phần tử button logout
    var logoutButton = document.getElementById("logout-button");

    // Bắt sự kiện click trên phần tử user-name
    document.getElementById("name-img-user").addEventListener("click", function() {
        toggleLogoutButton();
    });


    // Hàm ẩn/hiển thị button logout
    function toggleLogoutButton() {
        if (logoutButton.style.display === "none") {
            logoutButton.style.display = "block";
        } else {
            logoutButton.style.display = "none";
        }
    }






    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    var userLoggedIn = <?php echo isset($_SESSION['user_name']) ? 'true' : 'false'; ?>;

    // Ẩn hoặc hiển thị phần tử dựa trên trạng thái đăng nhập
    window.addEventListener('DOMContentLoaded', function() {
        var nameImgUser = document.getElementById('name-img-user');
        if (!userLoggedIn) {
            nameImgUser.style.display = 'none'; // Ẩn phần tử khi chưa đăng nhập
        }
    });
</script>




<script src="js/app.js"></script>
</html>