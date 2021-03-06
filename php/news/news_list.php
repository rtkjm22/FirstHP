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


    $sql = 'select code,title,category,news,date,image from news where 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;
    // code,title, date, category, news, image


    while (true) {
        $rec = $stmt->fetch();
        if ($rec === false) {
            break;
        }
        $code = str_sanitize($rec['code']);
        $title = str_sanitize($rec['title']);
        $date = str_sanitize($rec['date']);
        $category = str_sanitize($rec['category']);
        $news = str_sanitize($rec['news']);
        $news = nl2br($news);
        $img_path = UPLOADPATH . $rec['image'];
        
        $str = <<< "EOM"
        <tr>
            <td><input type="radio" name="code" id="{$code}" value="{$code}"></td>
            <td>{$title}</td>
            <td>{$date}</td>
            <td>{$category}</td>
            <td>{$news}</td>
            <td><img src="{$img_path}" style="width: 200px;"></td>
        </tr>
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
    <h1>ニューストップページ</h1>
    <br>
    <br>
    <form action="news_branch.php" method="post">
    <table border="1">
        <tr>
            <th>code</th>
            <th>title</th>
            <th>date</th>
            <th>category</th>
            <th>news</th>
            <th>image</th>
        </tr>
        <?=listup_contents($contents);?>
    </table>
    <br>
    <input type="submit" name="disp" value="参照">
    <input type="submit" name="add" value="追加">
    <input type="submit" name="edit" value="修正">
    <input type="submit" name="delete" value="削除">
    </form>
    <br>
    <a href="../../html/index.php">TOP</a>
    <a href="../staff_login/staff_top.php">戻る</a>


    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>