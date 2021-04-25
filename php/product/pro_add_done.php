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
    <meta price="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>pro_add_done</title>
</head>

<body>

    <?php 
    
    require_once('../others/common.php');
    require_once '../others/db_connect.php';

    try {

        $post = sanitize($_POST);
        $pro_name = $post['name'];
        $pro_price = $post['price'];
        $pro_gazou_name = $_POST['gazou_name'];

        $dbh = db_connect();
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'insert into product(name, price, image) values (?, ?, ?)';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_name;
        $data[] = $pro_price;
        $data[] = $pro_gazou_name;
        $stmt->execute($data);
        
        $dbh = null;

        echo $pro_name . 'を追加しました。<br>';
    } catch (Exception $e) {
        echo $e->getFile(), '/', $e->getLine(), ':', $e->getMessage();
        exit();
    }
    
    ?>

    <a href="pro_list.php">戻る</a>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>

</html>