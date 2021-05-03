<?php

require_once('../others/db_connect.php');

try {

    $code = (int) filter_input(INPUT_POST, 'code', FILTER_SANITIZE_NUMBER_INT);
    $title = filter_input(INPUT_POST, 'title');
    $category = filter_input(INPUT_POST, 'category');
    $news = filter_input(INPUT_POST, 'news');

    if ($code === null || $code === false) {
        echo 'ニュースが取得できませんでした。<br>';
        echo '<a href="news_list.php">戻る</a>';
        exit();
    }


    $flag = (int) 0;

    // if (preg_match('/\A[[:^cntrl:]]{1, 50}\z/u',$title) !== 1) {
    //     echo '50文字以内でタイトルを入力してください。<br>';
    //     $flag++;
    // }

    // if (preg_match('/\A[[:^cntrl:]]{1, 20}\z/ui', $category) === 1) {
    //     echo '20文字以内でカテゴリーを入力してください。<br>';
    //     $flag++;
    // }

    // if (preg_match('/\A[\r\n\t[:^cntrl:]]{1, 400}\z/ui', $news) === 1) {
    //     echo '400文字以内で記事を入力してください。<br>';
    //     $flag++;
    // }

    $vtitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $vcategory = htmlspecialchars($category, ENT_QUOTES, 'UTF-8');
    $vnews = htmlspecialchars($news, ENT_QUOTES, 'UTF-8');

    $check_news = <<< "EOM"
    <p>以下の内容に変更します。</p>
    <p>タイトル：$vtitle</p>
    <p>カテゴリー：$vcategory</p>
    <p>記事：$vnews</p>
    EOM;

    if ($flag !== 0) {
        $str = <<< "EOM"
        <button onclick="history.back()" value="戻る">戻る</button>
        EOM;
    } else {
        $str = <<< "EOM"
        <form action="news_edit_done.php" method="POST">
            <input type="hidden" name="code" value="$code">
            <input type="hidden" name="title" value="$title">
            <input type="hidden" name="category" value="$category">
            <input type="hidden" name="news" value="$news">
            <input type="submit" value="OK">
            <input type="button" onclick="history.back()" value="戻る">
        </form>
        EOM;
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
    <title>news_edit_check</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>

    <?=$check_news?>
    <?=$str?>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
    <script type="text/javascript" src="/js/main.js"> </script>
</body>
</html>