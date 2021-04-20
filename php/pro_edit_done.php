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

    <?php

    require_once('./common.php');       

    try {
    
    
        $post = sanitize($_POST);
        $pro_code = $post['code'];
        $pro_name = $post['name'];
        $pro_price = $post['price'];
        $pro_gazou_name_old = $post['gazou_name_old'];
        $pro_gazou_name_new = $post['gazou_name_new'];
    
        $dsn = 'mysql:dbname=db_shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = 'root';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
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
                unlink('../img/' . $pro_gazou_name_old);
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