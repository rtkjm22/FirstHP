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

try {

    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::MYSQL_ATTR_MULTI_STATEMENTS, false);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = 'select code,title,category,news,date from news where 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;


    while (true) {
        $rec = $stmt->fetch();
        if ($rec === false) {
            break;
        }
        $str = <<< "EOM"
        <input type="radio" name="code" value="{$rec['code']}">
        {$rec['title']}/{$rec['category']}/
        {$rec['date']}/
        {$rec['news']}
        <br />
        EOM;
        $contents[] = $str;
    }

    function listup_contents ($i) {
        for ($j=0; $j < count($i); $j++) { 
            echo $i[$j];
        }
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
    <title>news_list</title>
</head>
<body>
    <?=$login_msg?>
    <?php echo 'ニューストップページ<br><br>';?>
    <?php echo '<form action="news_branch.php" method="post">'?>
    <?=listup_contents($contents);?>
    <?php echo '<br>';?>
    <?php echo '<input type="submit" name="disp" value="参照">';?>
    <?php echo '<input type="submit" name="add" value="追加">';?>
    <?php echo '<input type="submit" name="edit" value="修正">';?>
    <?php echo '<input type="submit" name="delete" value="削除">';?>
    <?php echo '</form>'?>
    <br>
    <a href="../../html/index.php">TOP</a>
    <a href="../staff_login/staff_top.php">戻る</a>


    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>