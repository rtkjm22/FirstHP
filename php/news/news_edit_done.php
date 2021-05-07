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
define('UPLOADPATH', '../../img/');

try {

    
    $code = (int) filter_input(INPUT_POST, 'code', FILTER_SANITIZE_NUMBER_INT);
    $title = filter_input(INPUT_POST, 'title');
    $category = filter_input(INPUT_POST, 'category');
    $news = filter_input(INPUT_POST, 'news');
    $old_image = filter_input(INPUT_POST, 'old_image');
    $new_image = filter_input(INPUT_POST, 'new_image');



    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::MYSQL_ATTR_MULTI_STATEMENTS, false);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = 'UPDATE news SET title=:title, category=:category, news=:news, image=:image WHERE code=:code';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->bindValue(':news', $news, PDO::PARAM_STR);
    $stmt->bindValue(':code', (int)$code, PDO::PARAM_INT);
    $stmt->bindValue(':image', $new_image, PDO::PARAM_STR);
    $stmt->execute();

    $dbh = null;
    echo $old_image;
    if (isset($old_image) || $old_image !== '') {
        $old_image_path = UPLOADPATH . $old_image;
        unlink($old_image_path);
    }

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
    <title>news_edit_done</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
    <?=$login_msg?>

    <p>変更しました。</p>
    <a href="news_list.php">戻る</a>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
    <script type="text/javascript" src="/js/main.js"> </script>
</body>
</html>