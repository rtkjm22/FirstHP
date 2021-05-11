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

define('UPLOADPATH', '../../img/');


try {

    $news_code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_NUMBER_INT);
    
    if ($news_code === null || $news_code === false) {
        header('Location: news_ng.php');
        exit();
    }

    $dbh = db_connect();

    $sql = 'SELECT title,category,news,image FROM news WHERE code=:code';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':code', (int)$news_code, PDO::PARAM_INT);
    $stmt->execute();

    $dbh = null;

    $rec = $stmt->fetch();

    $title = $rec['title'];
    $category = $rec['category'];
    $news = $rec['news'];
    $old_image = $rec['image'];

    if (!isset($old_image) || $old_image !== '') {
        $old_image_path = UPLOADPATH . $old_image;
        $old_image_msg = "<img src=\"$old_image_path\" style=\"width: 300px;\">";
    } else {
        $old_image_msg = "<p>アップロードされている画像はありません。</p>";
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
    <title>news_edit</title>
</head>
<body>
    <?=$login_msg?>

    <p>ニュース修正</p>
    <br>
    <form action="news_edit_check.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="code" value="<?=$news_code?>">

        <div>
            <label for="title">タイトル</label>
            <br>
            <input type="text" name="title" id="title" value="<?=$title?>">
        </div>
        <br>

        <div>
            <label for="category">カテゴリー</label>
            <br>
            <input type="text" name="category" id="category" value="<?=$category?>">
        </div>
        <br>

        <div>
            <label for="news">コンテンツ</label>
            <br>
            <textarea name="news" id="news" cols="50" rows="5"><?=$news?></textarea>
        </div>
        <br>

        <p>現在アップロードされている画像</p>
        <?=$old_image_msg?>
        <br>
        <br>

        <div>
            <input type="hidden" name="old_image" value="<?=$old_image?>">
            <label for="new_image">画像を変更したい場合は、以下のフォームにて選択してください。</label><br>
            <input type="hidden" name="MAX_FILE_SIZE">
            <input type="file" id="new_image" name="new_image">
        </div>
        <br>

        <input type="submit" value="決定">
        <input type="button" onclick="history.back()" value="戻る">

    </form>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>