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

require_once('../others/common.php');
require_once('../others/db_connect.php');



try {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $image = $_POST['image'];

    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = 'insert into news(title, category, news, image) values (:title, :category, :content, :image)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':title', (string)$title, PDO::PARAM_STR);
    $stmt->bindValue(':category', (string)$category, PDO::PARAM_STR);
    $stmt->bindValue(':content', (string)$content, PDO::PARAM_STR);
    $stmt->bindValue(':image', (string)$image, PDO::PARAM_STR);
    $stmt->execute();

    $dbh = null;

    $news_title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');



} catch (Exception $e) {
    echo $e->getFile(), '<br>', $e->getLine(), ':', $e->getMessage();
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>news_add_done</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
    <?=$login_msg?>
    <p><?=$news_title?>を追加しました。</p>
    <a href="news_list.php">戻る</a>
    

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
    <script type="text/javascript" src="/js/main.js"> </script>
</body>
</html>