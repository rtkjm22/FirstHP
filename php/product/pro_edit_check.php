<?php
    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['login']) === false) {
        echo 'ログインされていません。<br>';
        echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
        exit();
    } else {
        echo 'ようこそ！！！！<br>';
        echo "{$_SESSION['staff_name']}さんがログイン中";
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>pro_edit_check</title>
</head>
<body>
    <br>

    <?php

    require_once('../others/common.php');

    $post = sanitize($_POST);
    $pro_code = $post['code'];
    $pro_name = $post['name'];
    $pro_price = $post['price'];
    $pro_gazou_name_old = $_POST['gazou_name_old'];
    if (isset($_FILES['gazou_name_new'])) {
        $pro_gazou_name_new = $_FILES['gazou_name_new'];
    }

    if ($pro_name == '') {
        echo '商品名が入力されていません。<br>';
    } else {
        echo '商品名 : ' . $pro_name . '<br>';
    }

    if (preg_match('/\A[0-9]+\z/', $pro_price) == 0) {
        echo '価格をきちんと入力してください。<br>';
    } else {
        echo '価格 : ' . $pro_price . '円<br>';
    }

    if ($pro_gazou_name_new['size'] > 0) {
        if ($pro_gazou_name_new['size'] > 1000000) {
            echo '画像が大きすぎます。';
        } else {
            move_uploaded_file($pro_gazou_name_new['tmp_name'], '../../img/' . $pro_gazou_name_new['name']);
            echo '<img src="../../img/' . $pro_gazou_name_new['name'] . '">';
            echo '<br>';
        }
    }

    if ($pro_name == '' || preg_match('/\A[0-9]+\z/', $pro_price) == 0 || $pro_gazou_name_new['size'] > 1000000) {
        echo '<form>';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '</form>';
    } else {
        echo '上記のように変更します。<br>';
        echo '<form method="post" action="pro_edit_done.php">';
        echo '<input type="hidden" name="code" value="' . $pro_code .'">';
        echo '<input type="hidden" name="name" value="' . $pro_name .'">';
        echo '<input type="hidden" name="price" value="' . $pro_price .'">';
        echo '<input type="hidden" name="gazou_name_old" value="' . $pro_gazou_name_old . '">';
        echo '<input type="hidden" name="gazou_name_new" value="' . $pro_gazou_name_new['name'] . '">';

        echo '<br>';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '<input type="submit" value="ＯK">';
        echo '</form>';
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>