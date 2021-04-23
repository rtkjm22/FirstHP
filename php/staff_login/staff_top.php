<?php
    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['login']) === false) {
        echo 'ログインされていません。<br>';
        echo '<a href="staff_login.html">ログイン画面へ戻る</a>';
        exit();
    } else {
        echo $_SESSION['login'];
        echo '<br>';
        echo $_SESSION['staff_pass'] . 'さんがログイン中です。';
        echo $_COOKIE[session_name()];
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

    <h1>ショップ管理画面</h1>

    <a href="../product/pro_list.php">商品管理画面</a>
    <br>

    <a href="staff_login.html">ログイン画面</a>
    <br>
    
    <a href="staff_logout.php">ログアウト画面</a>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>