
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trà sữa Meow Meow</title>
    <script src="https://kit.fontawesome.com/1d381da0b0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/style.css" />
    <script src="public/js/index.js"></script>
</head>

<body>
    <header class="big-header">
        <a href="index.php?page=home"><img src="img/logo.png" alt=""></a>
        <a href="index.php?page=home"><h1>Trà sữa Meow Meow</h1></a>
        <nav>
            <ul>
                <li><a href="index.php?page=home">Trang chủ</a></li>
                <li><a href="index.php?page=list">Danh sách</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<li><a>Xin chào, {$_SESSION['username']}</a></li>";
                    echo "<li><a href='index.php?page=signout'>Đăng xuất</a></li>";
                } else {
                    echo "<li><a href='index.php?page=signin'>Đăng nhập</a></li>";
                    echo "<li><a href='index.php?page=register'>Đăng ký</a></li>";
                }

                if (isset($_SESSION['admin']) && $_SESSION['admin'] > 0) {
                    echo "<li><a href='/asm1/admin'>Quản trị admin</a></li>";
                }
                ?>
                <li><a href="index.php?page=cart"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Giỏ hàng</a></li>
            </ul>
        </nav>
        
    </header>