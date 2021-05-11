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
    <title>pro_edit</title>
</head>
<body>
    <?=$login_msg?>

    <?php
    require_once '../others/db_connect.php';

    try {
    
        $pro_code = $_GET['procode'];

        $dbh = db_connect();
        
        $sql = 'SELECT name,price,image FROM product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);
        
        $rec = $stmt->fetch();
        $pro_name = $rec['name'];
        $pro_price = $rec['price'];
        $pro_gazou_name_old = $rec['image'];
        
        $dbh = null;

        if ($pro_gazou_name_old == '') {
            $disp_gazou = '';
        } else {
            $disp_gazou = '<img src="../../img/' . $pro_gazou_name_old .'">';
        }


    } catch (Exception $e) {
        echo $e->getFile(), '/', $e->getLine(), ':', $e->getMessage();
        exit();
    }
    

    ?>

    <p>商品修正</p>
    <br>
    <?php echo '商品コード : ' . $pro_code; ?>
    <br>
    <form action="pro_edit_check.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="code" value="<?php echo $pro_code; ?>">
        <input type="hidden" name="gazou_name_old" value="<?php echo $pro_gazou_name_old; ?>">

        商品名<br>
        <input type="text" name="name" style="width: 200px;" value="<?php echo $pro_name; ?>">
        <br>
        
        価格<br>
        <input type="text" name="price" style="width: 50px;" value="<?php echo $pro_price; ?>">
        <br>

        <?php echo $disp_gazou; ?>
        <br>
        画像を選択してください。<br>
        <input type="file" name="gazou_name_new" style="width: 400px;" required>
        <br><br>

        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="ＯＫ">
    </form>


    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>