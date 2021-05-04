<?php

require_once('../../php/others/common.php');

$pref_items = pref_list();


$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$pref = filter_input(INPUT_POST, 'pref', FILTER_SANITIZE_NUMBER_INT);
$message = filter_input(INPUT_POST, 'message');

$err_msg = array();
$result_msg = array();

if (!$name) {
    $err_msg['name'] = '名前が入力されていません。<br>';
} else {
    if (strlen($name) > 50) {
        $err_msg['name'] = '名前を50文字以内で入力してください。<br>';
    } else {
        $result_msg['name'] = str_sanitize($name);
    }
}

if (!$email) {
    $err_msg['email'] = 'Eメールアドレスが入力されていません。<br>';
} else {
    if (strlen($email) > 100) {
        $err_msg['email'] = 'Eメールアドレスを100文字以内で入力してください。<br>';
    } else {
        $result_msg['email'] = str_sanitize($email);
    }
}

if (!$pref) {
    $err_msg['pref'] = '都道府県が選択されていません。<br>';
} else {
    if ($pref > 47) {
        $err_msg['pref'] = '都道府県が正しく選択されていません。<br>';
    } else {
        $pref_item = $pref_items[str_sanitize($pref)];
        $result_msg['pref'] = $pref_item;
    }
}

if (!$message) {
    $err_msg['message'] = 'お問い合わせ内容が入力されていません。<br>';
} else {
    if (preg_match('/\A[\r\n[:^cntrl:]]{1,400}\z/u', $message) !== 1) {
        $err_msg['message'] = 'お問い合わせ内容は400字以内で入力してください。(改行以外の制御文字は入力できません。)<br>';
    } else {
        $result_msg['message'] = str_sanitize($message);
    }
}


function check_form_item($result, $index, $err) {
    if (!isset($result[$index]) || !$result[$index]) {
        $result[$index] = $err[$index];
        echo "<p class=\"check_contact_item_content\" style=\"color: red;\">$result[$index]</p>";
    } else {
        echo "<p class=\"check_contact_item_content\">$result[$index]</p>";
    }
}

if ($err_msg) {
    $contact_btn = '';
} else {
    $contact_btn = '<input type="submit" class="contact_btn" value="問い合わせをする">';
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>contact</title>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../css/contact.css">
</head>
<body>

    <div class="container">

        <header id="header" class="top_img">
            <nav>
                <ul class="header_nav_items">
                    <li>
                        <div class="header_nav_item"><a class="header_nav_item_link" href="index.php">Top</a></div>
                    </li>
                    <li>
                        <div class="header_nav_item"><a class="header_nav_item_link" href="about.html">About</a></div>
                    </li>
                    <li>
                        <div class="header_nav_item"><a class="header_nav_item_link" href="product.php">Product</a></div>
                    </li>
                    <li>
                        <div class="header_nav_item"><a class="header_nav_item_link" href="news.php">News</a></div>
                    </li>
                    <li>
                        <div class="header_nav_item"><a class="header_nav_item_link" href="#">Contact</a></div>
                    </li>
                </ul>
            </nav>
            <h1 class="top_title">Contact</h1>
        </header>
    
    
    
        <div>
            <div class="scroll_top">TOP</div>
        </div>
    

        <main>
            <div class="contact_wrapper">

                <div class="contact_title">
                    <h2>お問い合わせの確認</h2>
                </div>




                <div class="check_contact_items">

                    <div class="check_contact_item">
                        <p class="check_contact_item_title">お名前：</p>
                        <?=check_form_item($result_msg, 'name', $err_msg)?>
                    </div>

                    <div class="check_contact_item">
                        <p class="check_contact_item_title">Eメールアドレス：</p>
                        <?=check_form_item($result_msg, 'email', $err_msg)?>
                    </div>

                    <div class="check_contact_item">
                        <p class="check_contact_item_title">都道府県：</p>
                        <?=check_form_item($result_msg, 'pref', $err_msg)?>
                    </div>

                    <div class="check_contact_item">
                        <p class="check_contact_item_title">お問い合わせ内容：</p>
                        <?=check_form_item($result_msg, 'message', $err_msg)?>
                    </div>

                </div>

                <form action="contact_done.php" method="POST">
                    <input type="button" class="contact_btn" value="入力画面へ戻る" onclick="history.back()">
                    <?=$contact_btn?>
                </form>



            </div>
        </main>

        
        <footer>
            <div class="footer_nav">
                <nav>
                    <ul class="footer_nav_items">
                        <li class="footer_nav_item"><a href="../index.php">Top</a></li>
                        <li class="footer_nav_item"><a href="../about.html">About</a></li>
                        <li class="footer_nav_item"><a href="../product.php">Product</a></li>
                        <li class="footer_nav_item"><a href="../news.php">News</a></li>
                        <li class="footer_nav_item"><a href="../contact.php">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer_copyright">
                <small>©ryotak</small>
            </div>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
    <script type="text/javascript" src="../../js/main.js"> </script>
    <script type="text/javascript" src="../../js/contact.js"> </script>
</body>
</html>