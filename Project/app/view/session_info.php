<?php 
session_start();

if (isset($_SESSION["users"])) {
    $users = $_SESSION["users"];

    if (!empty($users)) {
        $lastUserIndex = count($users) - 1;
        $lastUser = $users[$lastUserIndex];

        $username = $lastUser['username'];
        $password = $lastUser['password'];

        echo 'Thông tin của session username là: ' . $username . '<br>';
        echo 'Thông tin của session password là: ' . $password . '<br>';
    } else {
        echo 'Session "users" không có dữ liệu.';
    }
} else {
    echo 'Session "users" chưa được khởi tạo.';
}
?>