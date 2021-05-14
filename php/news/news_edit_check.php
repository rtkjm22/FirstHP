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

    $code = (int) filter_input(INPUT_POST, 'code', FILTER_SANITIZE_NUMBER_INT);
    $title = filter_input(INPUT_POST, 'title');
    $category = filter_input(INPUT_POST, 'category');
    $news = filter_input(INPUT_POST, 'news');
    $old_image = filter_input(INPUT_POST, 'old_image');
    $tempfile = $_FILES['new_image']['tmp_name'];
    $new_image_name = $_FILES['new_image']['name'];

    
    if ($code === null || $code === false) {
        echo 'ニュースが取得できませんでした。<br>';
        echo '<a href="news_list.php">戻る</a>';
        exit();
    }
    
    $form_msg = array();
    $form_msg['correct_msg'] = '';
    $form_msg['err_msg'] = '';
    $flag = (int) 0;


    if (preg_match('/\A[[:^cntrl:]]{1,50}\z/ui', $title) !== 1) {
        $form_msg['err_msg'] .=  '<p>50文字以内でタイトルを入力してください。</p>';
        $flag++;
    } else {
        $title = h($title);
        $form_msg['correct_msg'] .= "<p>タイトル : $title</p>";
    }

    if (preg_match('/\A[[:^cntrl:]]{1,20}\z/ui', $category) !== 1) {
        $form_msg['err_msg'] .=  '<p>20文字以内でカテゴリーを入力してください。</p>';
        $flag++;
    } else {
        $category = str_sanitize($category);
        $category = nl2br($category);
        $form_msg['correct_msg'] .= "<p>タイトル : $category</p>";
    }

    if (preg_match('/\A[\r\n\t[:^cntrl:]]{1,400}\z/ui', $news) !== 1) {
        $form_msg['err_msg'] .=  '<p>400文字以内で記事を入力してください。</p>';
        $flag++; 
    } else {
        $news = str_sanitize($news);
        $form_msg['correct_msg'] .= "<p>ニュース記事 : $news</p>";
    }

    // 画像ファイルのバリデーション
    if (!is_uploaded_file($tempfile)) {
        $form_msg['err_msg'] .= '<p>ファイルがアップロードされていません。</p>';
        $flag++;
    } else {
        $uploaded_file = get_upload_file_name($new_image_name, UPLOADPATH);
        $uploaded_file_path = $uploaded_file['filename'];
        $uploaded_file_name = basename($uploaded_file['filename']);
        if (isset($uploaded_file['err_msg'])) {
            $form_msg['err_msg'] .= $uploaded_file['err_msg'];
            $flag++;
        }
        if (!move_uploaded_file($tempfile, UPLOADPATH . $uploaded_file_name)) {
            $form_msg['err_msg'] .= '<p>ファイルがアップロードできませんでした。ファイル名を別名に指定してください。</p>';
            $flag++;
        } else {
            $form_msg['correct_msg'] .= "<p>画像の名前 : {$uploaded_file_name}</p>";
            $form_msg['correct_msg'] .= "<img src=\"$uploaded_file_path\" style=\"width: 300px;\">";
        }
    }


    if ($flag !== 0) {
        $form_msg = $form_msg['err_msg'];
        $str = <<< "EOM"
        {$form_msg}
        <button onclick="history.back()" value="戻る">戻る</button>
        EOM;
    } else {
        $form_msg = $form_msg['correct_msg'];
        $str = <<< "EOM"
        {$form_msg}
        <form action="news_edit_done.php" method="POST">
            <input type="hidden" name="code" value="{$code}">
            <input type="hidden" name="title" value="{$title}">
            <input type="hidden" name="category" value="{$category}">
            <input type="hidden" name="news" value="{$news}">
            <input type="hidden" name="old_image" value="{$old_image}">
            <input type="hidden" name="new_image" value="{$uploaded_file_name}">
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
</head>
<body>
    <?=$login_msg?>

    <?=$str?>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>