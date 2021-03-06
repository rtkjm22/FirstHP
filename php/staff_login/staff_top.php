<?php
    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['login']) === false) {
        echo 'ログインされていません。<br>';
        echo '<a href="staff_login.html">ログイン画面へ戻る</a>';
        exit();
    } else {
        $login_msg = "<p class=\"login_msg\">ようこそ!__<span>{$_SESSION['staff_name']}さんがログイン中</span></p><br>";
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>staff_top.php</title>
</head>
<body>
    <?=$login_msg?>

    <h1>ショップ管理画面</h1>

    <a href="../product/pro_list.php">商品管理画面</a>
    <br>

    <a href="../news/news_list.php">ニュース記事管理画面</a>
    <br>

    <a href="staff_login.html">ログイン画面</a>
    <br>
    
    <a href="staff_logout.php">ログアウト画面</a>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>