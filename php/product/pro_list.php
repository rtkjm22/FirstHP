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
    <meta price="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>pro_list</title>
</head>

<body>
    <?=$login_msg?>

    <?php 

    try {
        require_once '../others/db_connect.php';

        $dbh = db_connect();

        $sql = 'SELECT code,name,price FROM product WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        
        $dbh = null;

        echo '商品一覧<br><br>';
        echo '<form method="post" action="pro_branch.php">';
        
        while (true) {
            $rec = $stmt->fetch();
            if ($rec === false) {
                break;
            }
            echo '<input type="radio" name="procode" value="' . $rec['code'] . '">';
            echo $rec['name'] . " --- ";
            echo $rec['price'] . '円';
            echo '<br />';
        }
        echo '<input type="submit" name="disp" value="参照">';
        echo '<input type="submit" name="add" value="追加">';
        echo '<input type="submit" name="edit" value="修正">';
        echo '<input type="submit" name="delete" value="削除">';

        echo '</form>';



    } catch (Exception $e) {
        echo $e->getFile(), '/', $e->getLine(), ':', $e->getMessage();
        exit();
    }
    
    ?>
    <br>
    <a href="../../html/index.php">TOP</a>
    <a href="../staff_login/staff_top.php">戻る</a>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>

</html>