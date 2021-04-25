<?php
    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['login']) === false) {
        echo 'ログインされていません。<br>';
        echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
        exit();
    } else {
        echo 'ようこそ！！！！<br>';
        echo "{$_SESSION['name']}さんがログイン中";
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>pro_ng</title>
</head>
<body>

    <p>商品が選択されていません。</p>
    <a href="pro_list.php">戻る</a>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>