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
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>pro_edit_done</title>
</head>
<body>
    <br>
    <?=$login_msg?>

    <?php

    require_once('../others/common.php');
    require_once '../others/db_connect.php';


    try {
    
    
        $post = sanitize($_POST);
        $pro_code = $post['code'];
        $pro_name = $post['name'];
        $pro_price = $post['price'];
        $pro_gazou_name_old = $post['gazou_name_old'];
        $pro_gazou_name_new = $post['gazou_name_new'];
    
        $dbh = db_connect();
    
        $sql = 'UPDATE product SET name=?, price=?, image=? WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_name;
        $data[] = $pro_price;
        $data[] = $pro_gazou_name_new;
        $data[] = $pro_code;
        $stmt->execute($data);
        
        $dbh = null;

        if ($pro_gazou_name_old != $pro_gazou_name_new) {
            if ($pro_gazou_name_old != '') {
                unlink('../../img/' . $pro_gazou_name_old);
            }
        }
    
        echo '修正しました。<br>';
        
    } catch (Exception $e) {
        echo $e->getFile(), '/', $e->getLine(), ':', $e->getMessage();
        exit();
    }

    ?>

    <a href="pro_list.php">戻る</a>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>