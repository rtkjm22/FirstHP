<?php
require_once('../../php/others/common.php');
require_once('../../php/others/db_connect.php');

session_start();

if (isset($_SESSION['token'])) {
    $token_session = $_SESSION['token'];
} else {
    $token_session = null;
}

if (isset($_POST['token'])) {
    $token_post = $_POST['token'];
} else {
    $token_post = null;
}

if ($token_session !== $token_post || $token_session === null || $token_post === null) {
    echo '不正なアクセスが検出されました。';
    $_SESSION = array();
    session_destroy();
    exit();
}

$_SESSION['name'] = '';
$_SESSION['email'] = '';
$_SESSION['pref'] = '';
$_SESSION['message'] = '';
$_SESSION['token'] = '';
session_destroy();

$pref_items = pref_list();

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$pref = filter_input(INPUT_POST, 'pref', FILTER_SANITIZE_NUMBER_INT);
$message = filter_input(INPUT_POST, 'message');

$dbh = db_connect();


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
                    <h2>お問い合わせが完了しました</h2>
                    <p class="done_msg">お問い合わせありがとうございます。</p>
                    <p class="done_msg">email宛に確認用メールを送信いたしましたので、ご確認ください。</p>
                    <a href="../index.php" class="contact_btn done_contact_btn">TOPへ戻る</a>
                </div>
                </div>
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