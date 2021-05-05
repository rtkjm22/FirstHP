<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) === false) {
    echo 'ログインされていません。<br>';
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
}

if (isset($_POST['disp'])) {
    if (!isset($_POST['code'])) {
        header('Location: news_ng.php');
        exit();
    } else {
        $news_code = $_POST['code'];
        header("Location: news_disp.php?code={$news_code}");
    }
}

if (isset($_POST['add'])) {
    header('Location: news_add.php');
    exit();
}

if (isset($_POST['edit'])) {
    if (!isset($_POST['code'])) {
        header('Location: news_ng.php');
        exit();
    } else {
        $news_code = $_POST['code'];
        header("Location: news_edit.php?code={$news_code}");
        exit();
    }
}

if (isset($_POST['delete'])) {
    if (!isset($_POST['code'])) {
        header('Location: news_ng.php');
        exit();
    } else {
        $news_code = $_POST['code'];
        header("Location: news_delete.php?code={$news_code}");
        exit();
    }
}




?>