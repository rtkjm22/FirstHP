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

define('UPLOADPATH' , '../../img/');

require_once('../others/common.php');

$title = filter_input(INPUT_POST, 'title');
$category = filter_input(INPUT_POST, 'category');
$content = filter_input(INPUT_POST, 'content');
$tempfile = $_FILES['image']['tmp_name'];
$filename = $_FILES['image']['name'];


$form_msg = array();
$form_msg['correct_msg'] = '';
$form_msg['err_msg'] = '';
$flag = (int) 0;

if (count($_POST) !== 0) {
    $post = sanitize($_POST);
}

if (empty($title)) {
    $form_msg['err_msg'] .= '<p>商品名が入力されていません。</p>';
    $flag++;
} else {
    $title = $post['title'];
    $form_msg['correct_msg'] .= "<p>商品名 : {$title}</p>";
}

if (empty($category)) {
    $form_msg['correct_msg'] .= '<p>カテゴリー : なし</p>';
} else {
    $category = $post['category'];
    $form_msg['correct_msg'] .= "<p>カテゴリー : {$category}</p>";
}

if (empty($content)) {
    $form_msg['err_msg'] .= '<p>コンテンツが入力されていません。</p>';
    $flag++;
} else {
    $content = $post['content'];
    $form_msg['correct_msg'] .= "<p>content : {$content}</p>";
}

//ファイルのバリデーション
if (!is_uploaded_file($tempfile)) {
    $form_msg['err_msg'] .= '<p>ファイルがアップロードされていません。</p>';
    $flag++;
} else {
    $uploaded_file = get_upload_file_name($filename, UPLOADPATH);
    $uploaded_file_path = $uploaded_file['filename'];
    $uploaded_file_name = basename($uploaded_file['filename']);
    if (isset($uploaded_file['err_msg'])) {
        $form_msg['err_msg'] .= $uploaded_file['err_msg'];
        $flag++;
    } 
    if (!move_uploaded_file($tempfile, UPLOADPATH . $uploaded_file_name)) {
        $form_msg['err_msg'] .= '<p>ファイルをアップロードできません。ファイル名を別名に指定してください。</p>';
        $flag++;
    } else {
        $form_msg['correct_msg'] .= "<p>画像の名前 : {$uploaded_file_name}</p>";
        $form_msg['correct_msg'] .= "<img src=\"$uploaded_file_path\">";
    }
}



if ($flag !== 0) {
    $form_msg = $form_msg['err_msg'];
    $str = <<< "EOM"
    {$form_msg}
    <form>
    <input type="button" onclick="history.back()" value="戻る">
    </form>
    EOM;
} else {
    $form_msg = $form_msg['correct_msg'];
    $str = <<< "EOM"
    {$form_msg}
    <p>以下の内容で登録します。</p>
    <form method="post" action="news_add_done.php">
    <input type="hidden" name="title" value="{$title}">
    <input type="hidden" name="category" value="{$category}">
    <input type="hidden" name="content" value="{$content}">
    <input type="hidden" name="image" value="{$uploaded_file_name}">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
    </form>
    EOM;
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>news_add_check</title>
</head>
<body>
    <?=$login_msg?>
    <?=$str?>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>