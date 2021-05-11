<?php
session_start();

require_once('../php/others/common.php');



if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
} else {
    $name = '';
}
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = '';
}
if (isset($_SESSION['pref'])) {
    $pref = $_SESSION['pref'];
} else {
    $pref = '';
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
} else {
    $message = '';
}

$pref_list = pref_list();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>contact</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/contact.css">
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
                    <h2>お問い合わせフォーム</h2>
                    <p>お気軽にお問い合わせください。</p>
                </div>
                <div class="contact_form">
                    <form action="contact/contact_check.php" method="POST">
                        <div class="contact_form_item">
                            <label for="name">お名前</label><br>
                            <input type="text" id="name" name="name" placeholder="お名前" value="<?=$name?>">
                        </div>
                        <div class="contact_form_item">
                            <label for="email">Eメールアドレス</label><br>
                            <input type="email" id="email" name="email" placeholder="Eメールアドレス" value="<?=$email?>">
                        </div>
                        <div class="contact_form_item">
                            <label for="pref">都道府県</label><br>
                            <select name="pref" id="pref">
                                <?=assign_option($pref_list, $pref)?>
                            </select>
                        </div>
                        <div class="contact_form_item">
                            <label for="message">お問い合わせ内容</label><br>
                            <textarea name="message" id="message" cols="30" rows="10" placeholder="お問い合わせ内容"><?=$message?></textarea>
                        </div>
                        <input class="contact_btn" type="submit" value="お問い合わせ確認画面へ">
                    </form>
                </div>
            </div>
        </main>

    
    
    
        <footer>
            <div class="footer_nav">
                <nav>
                    <ul class="footer_nav_items">
                        <li class="footer_nav_item"><a href="index.php">Top</a></li>
                        <li class="footer_nav_item"><a href="about.html">About</a></li>
                        <li class="footer_nav_item"><a href="product.php">Product</a></li>
                        <li class="footer_nav_item"><a href="news.php">News</a></li>
                        <li class="footer_nav_item"><a href="contact.php">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer_copyright">
                <small>©ryotak</small>
            </div>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
    <script type="text/javascript" src="../js/main.js"> </script>
    <script type="text/javascript" src="../js/contact.js"> </script>
</body>
</html>