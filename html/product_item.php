<?php

require_once('../php/others/common.php');
require_once('../php/others/db_connect.php');

try {

    // function trimString ($i) {
    //     return trim($i);
    // }
    // $code = filter_input(INPUT_GET, 'code', FILTER_CALLBACK, array('options' => 'trimString'));

    $code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_NUMBER_INT);
    
    if ($code <= 0) {
        echo 'お探しの商品はありませんでした。<br>';
        echo '<a href=product.php>戻る</a>';
        exit();
    } 
    
    $dbh = db_connect();
    
    $sql = 'SELECT name,price,image FROM product WHERE code=:code';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':code', (int)$code, PDO::PARAM_INT);
    $stmt->execute();
    
    $dbh = null;
    
    $rec = $stmt->fetch();

    if (!isset($rec['name'])|| !isset($rec['price']) || !isset($rec['image'])) {
        echo 'お探しの商品はありませんでした。<br>';
        echo '<a href=product.php>戻る</a>';
        exit();
    }


} catch (Exception $e) {
    echo $e->getFile(), '<br>', $e->getLine(), '_:_', $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>product_item_<?=$rec['name']?></title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/product_item.css">
</head>
<body>

    <div class="container">

    <header id="header" class="top_img">
        <nav>
            <ul class="header_nav_items">
                <li>
                    <div class="header_nav_item"><a class="header_nav_item_link" href="/html/index.php">Top</a></div>
                </li>
                <li>
                    <div class="header_nav_item"><a class="header_nav_item_link" href="/html/about.html">About</a></div>
                </li>
                <li>
                    <div class="header_nav_item"><a class="header_nav_item_link" href="/html/product.php">Product</a></div>
                </li>
                <li>
                    <div class="header_nav_item"><a class="header_nav_item_link" href="/html/news.php">News</a></div>
                </li>
                <li>
                    <div class="header_nav_item"><a class="header_nav_item_link" href="/html/contact.php">Contact</a></div>
                </li>
            </ul>
        </nav>
        <h1 class="top_title">Product</h1>
    </header>



    <div>
        <div class="scroll_top">TOP</div>
    </div>




    <main id="product_item">

        <article id="product_item_article">

            <div class="tp">
                    <p>
                    <a href="index.php">Top</a> 
                    <span>&gt;</span>
                    <a href="product.php">Product</a> 
                    <span>&gt;</span>
                    <a class="tp_current" href="#"><?=$rec['name']?></a>
                    </p>
            </div>

            <div class="main_item">

                <div class="main_item_img">
                    <img src="../img/<?=$rec['image']?>" alt="<?=$rec['name']?>の画像です">
                </div>

                <div class="main_item_info">
                    <h1 class="main_item_info_title"><?=$rec['name']?></h1>
                    <div class="main_item_info_sent">
                        <p>こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。</p>
                        <p>美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。美味しいよ。</p>
                        <p>こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。こだわって作りました。</p>
                    </div>
                </div>

            </div>

        </article>

    </main>




    <footer>
        <div class="footer_nav">
            <nav>
                <ul class="footer_nav_items">
                    <li class="footer_nav_item"><a href="/html/index.php">Top</a></li>
                    <li class="footer_nav_item"><a href="/html/about.html">About</a></li>
                    <li class="footer_nav_item"><a href="/html/product.php">Product</a></li>
                    <li class="footer_nav_item"><a href="/html/news.php">News</a></li>
                    <li class="footer_nav_item"><a href="/html/contact.php">Contact</a></li>
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
</body>
</html>