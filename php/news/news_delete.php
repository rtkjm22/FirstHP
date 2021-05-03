<?php
require_once('../others/db_connect.php');
require_once('../others/common.php');

try {

    $code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_NUMBER_INT);
    
    if ($code === null || $code === false) {
        echo '記事が選択されていません。';
        echo '<br>';
        echo '<a href="news_list.php">戻る</a>';
    }

    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::MYSQL_ATTR_MULTI_STATEMENTS, false);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = 'SELECT title,category,date,news FROM news WHERE code=:code';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':code', (int)$code, PDO::PARAM_INT);
    $stmt->execute();

    $rec = $stmt->fetch();
    $title = $rec['title'];
    $category = $rec['category'];
    $date = $rec['date'];
    $news = $rec['news'];

    $dbh = null;


    $title = str_sanitize($title);
    $category = str_sanitize($category);
    $date = str_sanitize($date);
    $news = str_sanitize($news);

    $date = trim_date($date);


    $str = <<< "EOM"
    <p>以下の内容を削除してよろしいですか？</p>
    <br>
    <p>タイトル：$title</p>
    <p>日付：{$date['year']}年{$date['month']}月{$date['day']}日</p>
    <p>カテゴリー：$category</p>
    <p>ニュース：$news</p>
    <form method="get" action="news_delete_done.php?code={$code}">
    <input type="hidden" name="code" value="$code">
    <input type="submit" value="OK">
    <input type="button" onclick="history.back()" value="戻る">
    </form>
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
    <title>news_delete</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>

    <?=$str?>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
    <script type="text/javascript" src="/js/main.js"> </script>
</body>
</html>