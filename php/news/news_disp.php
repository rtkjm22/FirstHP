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

require_once('../others/db_connect.php');
require_once('../others/common.php');

define('UPLOADPATH', '../../img/');

try {

    $news_code = filter_input(INPUT_GET, 'code' , FILTER_SANITIZE_NUMBER_INT);
    
    if ($news_code === null || $news_code === false) {
        header('Location: news_ng.php');
        exit();
    }
    
    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    $sql = 'SELECT title,category,news,date,image FROM news WHERE code=:news_code';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':news_code', (int)$news_code, PDO::PARAM_INT);
    $stmt->execute();
    
    $rec = $stmt->fetch();
    
    $dbh = null;
    if (!$rec) {
        header('Location: news_ng.php');
        exit();
    }
    $news_title = str_sanitize($rec['title']);
    $news_category = str_sanitize($rec['category']);
    $news_date = $rec['date'];
    $news_news = str_sanitize($rec['news']);
    $news_news = nl2br($news_news);
    $news_image = $rec['image'];
    $news_image_path = UPLOADPATH . $news_image;
    
    
    $date = trim_date($news_date);
    
    $display_content = <<< "EOM"
    <h1>ニュース参照</h1>
    <h2>$news_title</h2>
    <p>カテゴリー : $news_category</p>
    <p>日付 : {$date['year']}年{$date['month']}月{$date['day']}日</p>
    <p>コンテンツ : $news_news</p>
    <img src="$news_image_path" style="width:200px;">
    <br>
    <a href="news_list.php">戻る</a>
    EOM;

} catch (Exception $e) {
    echo $e->getFile(), '/', $e->getLine(), ':', $e->getMessage();
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>news_disp</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
    <?=$login_msg?>
    <?=$display_content?>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
    <script type="text/javascript" src="/js/main.js"> </script>
</body>
</html>