<?php
    include '../database/connectDB.php'
?>
<?php
session_start();  // Bắt đầu phiên làm việc

// Kiểm tra nếu có dữ liệu submit đi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $pass_word = $_POST['pass_word'];

    // Thực hiện truy vấn kiểm tra tài khoản
    $sql = "SELECT * FROM user WHERE user_name = '$user_name' AND pass_word = '$pass_word'";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra kết quả truy vấn
    if (mysqli_num_rows($result) > 0) {
        // Tài khoản đăng nhập đúng
        $_SESSION['user_name'] = $user_name;
        $userLoggedIn = true; // Cập nhật giá trị $userLoggedIn thành true
        echo "Đăng nhập thành công";
        header("Location: ../test.php");
        exit();
    } else {
        // Tài khoản đăng nhập sai
        echo "<script>alert('Sai tài khoản hoặc mật khẩu ^^');</script>";
    }
}
// Đóng kết nối
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Đăng nhập | IVY Moda</title>
</head>

<body>
    <div class="container-page">
        <header id="header-page">
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

            <a href="../index.html">
                <img src="../images/logo.png" alt="logo YVI">
            </a>

            <article class="header-right">
                <section class="header-right-item">
                    <form class="search-box" method="GET">
                        <div>
                            <button><span class="material-symbols-outlined">search</span></button>
                        </div>
                        <input type="text" placeholder="TÌM KIẾM SẢN PHẨM">
                    </form>

                    <ul>
                        <li><a href="#"><span class="material-symbols-outlined">headphones</span></a></li>
                        <li><a href="#"><span class="material-symbols-outlined">person</span></a></li>
                        <li><a href="#"><span class="material-symbols-outlined">local_mall</span></a></li>
                    </ul>
                </section>
            </article>

        </header>
    </div>

    <article id="main-login-page" class="container-login">
        <section class="login-page">
            <form class="login-form" method="POST">
                <h1>Bạn đã có tài khoản IVY</h1>
                <p>Nếu bạn đã có tài khoản, hãy đăng nhập để tích lũy điểm thành viên và nhận được những ưu đãi tốt hơn!
                </p>

                <div class="input-box">
                    <input type="text" placeholder=" " required name="user_name">
                    <label>Tên đăng nhập</label>
                </div>

                <div class="input-box">
                    <input type="password" placeholder=" " required name="pass_word">
                    <label>Mật khẩu</label>
                </div>

                <div class="remember-check">
                    <input type="checkbox" name="" id="">
                    <p>Ghi nhớ đăng nhập</p>
                </div>

                <div class="link--">
                    <a href="#">Quên mật khẩu?</a>
                    <a href="#">Đăng nhập bằng OTP</a>
                </div>

                <button type="submit">Đăng nhập</button>
            </form>
        </section>

        <section class="signup-page">
            <form class="signup-form">
                <h1>Khách hàng mới của IVY moda</h1>
                <p>Nếu bạn chưa có tài khoản trên IVYmoda, hãy sử dụng tùy chọn này để truy cập biểu mẫu đăng ký.</p>
                <p>Bằng cách cung cấp cho IVY moda thông tin chi tiết của bạn, quá trình mua hàng trên ivymoda.com sẽ là
                    một trải nghiệm thú vị và nhanh chóng hơn!</p>
                <button type="submit">
                    <a href="signup.php">Đăng ký</a>
                </button>
            </form>
        </section>
    </article>

    
</body>

</html>