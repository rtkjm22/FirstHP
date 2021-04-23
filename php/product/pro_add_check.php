<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>pro_add_check</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>

    <?php 
    
    require_once('../others/common.php');

    $post = sanitize($_POST);
    $pro_name = $post['name'];
    $pro_price = $post['price'];
    $pro_gazou = $_FILES['gazou'];
    
    if ($pro_name == '') {
        echo '商品名が入力されていません。<br>';
    } else {
        echo '商品名 :' . $pro_name . '<br>';
    }

    if (preg_match('/\A[0-9]+\z/', $pro_price) == 0) {
        echo '価格をきちんと入力してください。<br>';
    } else {
        echo '価格 :' . $pro_price . '円 <br>';
    }

    if ($pro_gazou['size'] > 0) {
        if ($pro_gazou['size'] > 1000000) {
            echo '値が大きすぎます。';
        } else {
            move_uploaded_file($pro_gazou['tmp_name'],'../../img/'.$pro_gazou['name']);
            echo '<img src="../../img/' . $pro_gazou['name'] . '">';
            echo '<br>';
        }
    }

    if ($pro_name == '' || preg_match('/\A[0-9]+\z/', $pro_price) == 0 || $pro_gazou['size'] > 1000000) {
        echo '<form>';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '</form>';
    } else {
        echo '上記の商品を追加します。';
        echo '<form method="post" action="pro_add_done.php">';
        echo '<input type="hidden" name="name" value="' . $pro_name .'">';
        echo '<input type="hidden" name="price" value="' . $pro_price .'">';
        echo '<input type="hidden" name="gazou_name" value="' . $pro_gazou['name'] . '">';
        echo '<br>';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '<input type="submit" value="ＯK">';
        echo '</form>';
    }
    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
    <script type="text/javascript" src="/js/main.js"> </script>
</body>

</html>