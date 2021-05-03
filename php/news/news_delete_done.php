<?php
require_once('../others/db_connect.php');
try {

    $code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_NUMBER_INT);
    
    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::MYSQL_ATTR_MULTI_STATEMENTS, false);

    $sql = 'DELETE FROM news WHERE code=:code';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':code', (int)$code, PDO::PARAM_INT);
    $stmt->execute();

    $dbh = null;

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
    <title>news_delete_done</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>

    <p>削除しました。</p>
    <a href="news_list.php">戻る</a>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
    <script type="text/javascript" src="/js/main.js"> </script>
</body>
</html>