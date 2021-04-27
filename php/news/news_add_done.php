<?php

// require_once('../others/common.php');
require_once('../others/db_connect.php');

try {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = 'insert into news(title, category, news) values (:title, :category, :content)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':title', (string)$title, PDO::PARAM_STR);
    $stmt->bindValue(':category', (string)$category, PDO::PARAM_STR);
    $stmt->bindValue(':content', (string)$content, PDO::PARAM_STR);
    $stmt->execute();

    $dbh = null;

    $hoge = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');



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
    <p><?=$hoge?>を追加しました。</p>
    <a href="news_list.php">戻る</a>
    

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
    <script type="text/javascript" src="/js/main.js"> </script>
</body>
</html>