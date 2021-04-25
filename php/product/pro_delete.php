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
    <title>pro_delete</title>
</head>
<body>

    <?php

    require_once '../others/db_connect.php';

    try {
    
        $pro_code = $_GET['procode'];

        $dbh = db_connect();
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT name,image FROM product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);
        
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_name = $rec['name'];
        $pro_gazou_name = $rec['image'];
        
        $dbh = null;

        if ($pro_gazou_name == '') {
            $disp_gazou == '';
        } else {
            $disp_gazou = '<img src="../../img/' . $pro_gazou_name . '">';
        }
    
    } catch (Exception $e) {
        echo $e->getFile(), '/', $e->getLine(), ':', $e->getMessage();
        exit();
    }


    ?>

    <p>商品削除</p>
    <br>
    <?php

    echo '商品コード : ' . $pro_code . '<br>';
    echo '商品名 : ' . $pro_name . '<br>';
    echo $disp_gazou . '<br>';

    ?>

    <br>
    <p>この商品を削除してよろしいですか？</p>
    <br>
    <form action="pro_delete_done.php" method="post">
        <input type="hidden" name="code" value="<?php echo $pro_code; ?>">
        <input type="hidden" name="gazou_name" value="<?php echo $pro_gazou_name; ?>">
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="ＯＫ">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>