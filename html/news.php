<?php

define('UPLOADPATH','../img/');

require_once('../php/others/common.php');
require_once('../php/others/db_connect.php');

$dbh = db_connect();
$dbh -> setAttribute(PDO::MYSQL_ATTR_MULTI_STATEMENTS, false);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$sql = 'SELECT code,category,title,date,news,image FROM news ORDER BY code desc';
$stmt = $dbh->prepare($sql);
$stmt -> execute();
$rec = $stmt->fetchAll();
$dbh = null;


function news_item ($i) {
    for ($j=0; $j < count($i); $j++) { 
        $news_items_sanitized = sanitize($i[$j]);
        $code = $news_items_sanitized['code'];
        $title = $news_items_sanitized['title'];
        $category = $news_items_sanitized['category'];
        $date = $news_items_sanitized['date'];
        $news = $news_items_sanitized['news'];
        $news = nl2br($news);
        $image = $news_items_sanitized['image'];
        $image_path = UPLOADPATH . $image;

        $str = <<< "EOM"
        <article id="news_article">
            <a class="news_link" href="./news_item.php?code={$code}"></a>
            <div class="news_item">
                <div class="news_img_wrap">
                    <img class="news_img" src="{$image_path}">
                </div>
                <p class="news_date">{$date}</p>
                <h1 class="news_title">{$title}</h1>
                <p class="news_category">{$category}</p>
                <p class="news_caption">{$news}</p>
                <p class="news_more">詳しく見る</p>
            </div>
        </article>
        EOM;
        echo $str;
    }
}
// $hoge = sanitize($rec[0]);
// var_dump($hoge);



?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/news.css">
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
                            <div class="header_nav_item"><a class="header_nav_item_link" href="contact.php">Contact</a></div>
                        </li>
                    </ul>
                </nav>
                <h1 class="top_title">News</h1>
        </header>
        <div>
            <div class="scroll_top">TOP</div>
        </div>
    


        <main>
            <div id="news">
                <div class="news_wrap">
                    <div class="news_items">

                        <?=news_item($rec)?>

                        <!-- <template id="news_template">
                            <article id="news_article">
                                <a class="news_link" href="./news/news_item.php?code=1"></a>
                                <div class="news_item">
                                    <div class="news_img_wrap">
                                        <img class="news_img">
                                    </div>
                                    <p class="news_date"></p>
                                    <h1 class="news_title"></h1>
                                    <p class="news_category">お菓子</p>
                                    <p class="news_caption"></p>
                                    <p class="news_more">詳しく見る</p>
                                </div>
                            </article>
                        </template> -->
                    </div>
                    <div class="news_more_btn">
                        <a href="#">&gt;&gt; もっと見る</a>
                    </div>
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
    <script src="../js/main.js"> </script>
    <script src="../js/news.js"> </script>
</body>
</html>