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
    <title>pro_delete_done</title>
</head>
<body>
    <?=$login_msg?> 


    <?php
    require_once '../others/db_connect.php';

    try {
    
        $pro_code = $_POST['code'];
        if (isset($_POST['gazou_name'])) {
            $pro_gazou_name = $_POST['gazou_name'];
        }

        $dbh = db_connect();

        $sql = 'DELETE FROM product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);
        
        $dbh = null;

        if ($pro_gazou_name != '') {
            unlink('../../img/' . $pro_gazou_name);
        }
    
    } catch (Exception $e) {
        echo $e->getFile(), '/', $e->getLine(), ':', $e->getMessage();
        exit();
    }

    ?>

    <p>削除しました。</p>
    <br>
    <a href="pro_list.php">戻る</a>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>