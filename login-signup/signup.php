<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/signup.css">
    <title>Đăng ký | IVY Moda</title>
</head>

<?php
include '../database/connectDB.php'
?>

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

    <main class="container-signup">
        <section class="form-signup">
            <h1>Chào mừng đến với IVY</h1>
            <form action="" method="POST">
                <div class="container-signup">
                    <div class="input-box">
                        <span class="material-symbols-outlined">person</span>
                        <input type="text" name="user_name" placeholder=" ">
                        <label for="">Tên đăng nhập</label>
                    </div>

                    <div class="input-box">
                        <span class="material-symbols-outlined">mail</span>
                        <input type="email" name="email" placeholder=" ">
                        <label for="">Email</label>
                    </div>

                    <div class="input-box">
                        <span class="material-symbols-outlined">lock</span>
                        <input type="password" name="pass_word" placeholder=" ">
                        <label for="">Mật khẩu</label>
                    </div>

                    <div class="input-box">
                        <span class="material-symbols-outlined">lock_open</span>
                        <input type="text" name="confirm-pass" placeholder=" ">
                        <label for="">Nhập lại mật khẩu</label>
                    </div>
                </div>

                <p>Nhấn đăng ký, bạn đồng ý với điều khoản và dịch vụ của IVY</p>

                <div style="text-align: center;">
                    <button class="btn-signup" type="submit">Đăng ký</button>
                </div>
            </form>
        </section>

        <p class="location-page">Bạn đã có tài khoản IVY? <a href="index.php">Đăng Nhập</a></p>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form đăng ký
            $user_name = $_POST['user_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $pass_word = $_POST['pass_word'] ?? '';

            // Kiểm tra xem tên đăng nhập đã tồn tại trong cơ sở dữ liệu chưa
            $sql_check_user = "SELECT * FROM user WHERE email = '$email' AND user_name = '$user_name'";
            $result_check_user = mysqli_query($conn, $sql_check_user);

            if (mysqli_num_rows($result_check_user) > 0) {
                // Nếu tên đăng nhập đã tồn tại, hiển thị thông báo lỗi
                echo "<p class='mesage-signup'>Tên đăng nhập đã tồn tại</p>";
            } else {
                // Nếu tên đăng nhập chưa tồn tại, thêm thông tin người dùng vào cơ sở dữ liệu
                $sql_add_user = "INSERT INTO user (user_name, email, pass_word, role_id) VALUES ('$user_name', '$email', '$pass_word', '1')";
                $result_add_user = mysqli_query($conn, $sql_add_user);

                if ($result_add_user) {
                    // Nếu thêm thông tin người dùng thành công, hiển thị thông báo đăng ký thành công
                    echo "<p class='mesage-signup'>Đăng ký thành công</p>";
                    header('location: index.php');
                } else {
                    // Nếu thêm thông tin người dùng thất bại, hiển thị thông báo lỗi
                    echo "Đăng ký thất bại";
                }
            }
        }
        // Đóng kết nối
        mysqli_close($conn);
        ?>

        <style>
            .mesage-signup{
    text-align: center;
    position: absolute;
    top: 30%;
    background-color: #fff;
}
        </style>

    </main>
</body>

</html>