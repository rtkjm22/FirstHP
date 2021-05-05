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
    <title>news_add</title>
</head>
<body>
    <?=$login_msg?>

    <p>news記事</p>

    <br>

    <form action="news_add_check.php" method="post">

        <div>
            <label for="title">タイトルを入力してください。</label><br>
            <input type="text" name="title" style="width: 200px;" id="title" placeholder="title">
            <br>
        </div>
        <div>
            <label for="category">カテゴリーを入力してください。</label><br>
            <input type="text" name="category" style="width: 200px;" id="category" placeholder="category">
            <br>
        </div>
        <div>
            <label for="content">コンテンツを入力してください。</label><br>
            <textarea name="content" id="content" cols="50" rows="5" placeholder="news_content"></textarea>
            <br>
        </div>
        <input type="submit" value="送信">
        <input type="button" value="戻る" onclick="history.back()">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>