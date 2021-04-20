<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>pro_disp</title>
</head>
<body>

    <?php

    try {
        
        $pro_code = $_GET['procode'];

        $dsn = 'mysql:dbname=db_shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = 'root';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT name,price,image FROM product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);
        
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_name = $rec['name'];
        $pro_price = $rec['price'];
        $pro_gazou_name = $rec['image'];

        $dbh = null;

        if ($pro_gazou_name == '') {
            $disp_gazou = '';
        } else {
            $disp_gazou = '<img src="../img/' . $pro_gazou_name . '">';
        }

    } catch (Exception $e) {
        echo $e->getFile(), '/', $e->getLine(), ':', $e->getMessage();
        exit();
    }

    ?>

    <p>商品情報参照</p>
    <br>
    <p>商品コード</p>
    <br>
    <?php

    echo '商品コード : ' . $pro_code . '<br>';
    echo '商品名 : ' . $pro_name . '<br>';
    echo '価格 : ' . $pro_price . '円<br>';
    echo $disp_gazou;

    ?>

    <br>
    <br>
    <form">
        <input type="button" onclick="history.back()" value="戻る">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>