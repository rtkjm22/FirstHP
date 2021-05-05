<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) === false) {
    echo 'ログインされていません。<br>';
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
} else {
    $login_msg = "<p class=\"login_msg\">ようこそ!__<span>{$_SESSION['staff_name']}さんがログイン中</span></p><br>";
}

require_once('../others/common.php');

$title = filter_input(INPUT_POST, 'title');
$category = filter_input(INPUT_POST, 'category');
$content = filter_input(INPUT_POST, 'content');


if (count($_POST) !== 0) {
    $post = sanitize($_POST);
}


if (empty($title)) {
    $check_title = '商品名が入力されていません。<br>';
} else {
    $title = $post['title'];
    $check_title = "商品名 : {$title}<br>";
}

if (empty($category)) {
    $check_category = '<br>';
} else {
    $category = $post['category'];
    $check_category = "カテゴリー : {$category}<br>";
}

if (empty($content)) {
    $check_content = 'コンテンツが入力されていません。';
} else {
    $content = $post['content'];
    $check_content = "content : {$content}<br>";
}


if (empty($title) || empty($content)) {
    $str = <<< EOM
    <form>
    <input type="button" onclick="history.back()" value="戻る">
    </form>
    EOM;
} else {
    $str = <<< "EOM"
    <p>以下の内容で登録します。</p>
    <form method="post" action="news_add_done.php">
    <input type="hidden" name="title" value="{$title}">
    <input type="hidden" name="category" value="{$category}">
    <input type="hidden" name="content" value="{$content}">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
    </form>
    EOM;
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>news_add_check</title>
</head>
<body>
    <?=$login_msg?>
    <?=$check_title?>
    <?=$check_category?>
    <?=$check_content?>
    <?=$str?>


    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>