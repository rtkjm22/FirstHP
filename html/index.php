<?php

require_once('../php/others/db_connect.php');
require_once('../php/others/common.php');

define('UPLOADPATH', '../img/');

try {
    //product情報の取得
    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::MYSQL_ATTR_MULTI_STATEMENTS, false);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $sql = 'SELECT code,name,price,image FROM product WHERE 1';
    $stmt = $dbh->query($sql);
    $stmt->execute();
    
    $dbh = null;

    $pro_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

    function product_list ($i) {
        for ($j=0; $j < count($i); $j++) { 

            $code = str_sanitize($i[$j]['code']);
            $name = str_sanitize($i[$j]['name']);
            $price = str_sanitize($i[$j]['price']);
            $image = str_sanitize($i[$j]['image']);
            $image_path = UPLOADPATH . $image;

            $str = <<< "EOM"
            <div class="top_product_item">
            <a class="top_product_item_link" href="./product_item.php?code={$code}"></a>
            <img src="{$image_path}" alt="">
            <div class="top_product_item_content">
            <p>{$name}</p>
            <p>{$price}円</p>
            </div>
            </div>
            EOM;
            echo $str;
        }
    }

} catch (Exception $e) {
    echo $e->getFile(), '<br>', $e->getLine(), ':', $e->getMessage();
    exit();
}

try {
    // //news情報の取得
    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::MYSQL_ATTR_MULTI_STATEMENTS, false);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $sql = 'SELECT code,category,title,date,news,image FROM news WHERE 1';
    $stmt = $dbh->query($sql);
    $stmt->execute();
    
    $dbh = null;

    $news_arr = $stmt->fetchAll();


    function news_list ($i) {
        for ($j=0; $j < count($i); $j++) { 

            $code = str_sanitize($i[$j]['code']);
            $category = str_sanitize($i[$j]['category']);
            $title = str_sanitize($i[$j]['title']);


            $date = divide_hyphen($i[$j]['date']);
            $date = str_sanitize($date);

            $news = str_sanitize($i[$j]['news']);


            $image = str_sanitize($i[$j]['image']);
            $image_path = UPLOADPATH . $image;

            $str = <<< "EOM"
            <div class="top_news_item">
            <a href="./news_item.php?code={$code}"></a>
            <img src="{$image_path}" alt="">
            <div class="top_news_item_content">
            <h3 class="top_news_title">{$title}</h3>
            <p class="top_news_date">{$date}</p>
            <p class="top_news_category">カテゴリー : {$category}</p>
            <div class="top_news_text">
            <p>{$news}</p>
            </div>
            </div>
            </div>
            EOM;
            echo $str;
        }
    }




} catch (Exception $e) {
    echo $e->getFile(), '<br>', $e->getLine(), ':', $e->getMessage();
    exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>top</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/top.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Mincho&display=swap" rel="stylesheet">
</head>
<body>




    <div class="top_container">
        <header id="top">
                <div class="top_header_nav">
                    <div class="top_header_logo" onclick="location.href='index.php'"></div>
                    <nav>
                        <ul class="top_header_nav_items">
                            <li>
                                <div class="top_header_nav_item"><a href="/html/index.php">Top</a></div>
                            </li>
                            <li>
                                <div class="top_header_nav_item"><a href="/html/about.html">About</a></div>
                            </li>
                            <li>
                                <div class="top_header_nav_item"><a href="/html/product.php">Product</a></div>
                            </li>
                            <li>
                                <div class="top_header_nav_item"><a href="/html/news.php">News</a></div>
                            </li>
                            <li>
                                <div class="top_header_nav_item"><a href="/html/contact.php">Contact</a></div>
                            </li>
                        </ul>
                    </nav>
                </div>

            
            <div class="top_header_cp">
                <h1>美味しいスイーツ、作ります</h1>
            </div>
        </header>

        <div>
            <div class="scroll_top">TOP</div>
        </div>


        <main>

            <section class="top_main_content">
                <div class="top_about_container">
                    <h2 class="top_main_title">About</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. <br><span class="top_main_title_span">Minus, deleniti!</span></p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. <br><span class="top_main_title_span">Non, dolores?</span></p>
                </div>
            </section>




            <section class="top_main_content">
                <div class="top_product_container">
                    <h2 class="top_main_title">Product</h2>
                    <p class="top_main_intro">美味しいスイーツをたくさんそろえました。</p>
                    <div class="top_product_items">
                    <?= product_list($pro_arr)?>
                    </div>
                </div>
            </section>



            <section class="top_main_content">
                <div class="top_news_container">
                    <h2 class="top_main_title">News</h2>
                    <div class="top_news_items">
                        <?=news_list($news_arr)?>
                    </div>
                </div>
            </section>

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
    <script type="text/javascript" src="../js/top.js"> </script>
</body>
</html>