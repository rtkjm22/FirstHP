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
    <title>pro_add</title>
</head>

<body>
    <?=$login_msg?>


    <p>商品追加</p>

    <br>

    <form action="pro_add_check.php" method="post" enctype="multipart/form-data">

        商品名を入力してください。<br>
        <input type="text" name="name" style="width: 200px;"><br>

        価格を入力してください。<br>
        <input type="text" name="price" style="width: 50px;"><br>

        画像を選んでください。<br>
        <input type="hidden" name="MAX_FILE_SIZE" value="1200000">
        <input type="file" name="gazou" style="width: 400px;"><br>
        <br>

        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="ＯＫ">

    </form>


    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>

</html>