<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta price="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>pro_add_done</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>

    <?php 
    
    require_once('./common.php');

    try {

        $post = sanitize($_POST);
        $pro_name = $post['name'];
        $pro_price = $post['price'];
        $pro_gazou_name = $_POST['gazou_name'];

        $dsn = 'mysql:dbname=db_shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = 'root';
        $dbh = new PDO($dsn, $user, $password);
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
    <script type="text/javascript" src="/js/main.js"> </script>
</body>

</html>