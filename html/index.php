<?php

require ('../php/others/db_connect.php');

try {
    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = 'SELECT name,price,image FROM product WHERE 1';
    $stmt = $dbh->query($sql);
    $stmt->execute();
    
    $dbh = null;

    $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
    function product_list ($i) {
        for ($j=0; $j < count($i); $j++) { 
            $str = <<< "EOM"
            <div class="top_product_item">
            <img src="../img/{$i[$j]['image']}" alt="">
            <div class="top_product_item_content">
            <p>{$i[$j]['name']}</p>
            <p>{$i[$j]['price']}円</p>
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

            <!-- スライドショー -->
            <!-- <div class="slide_show">
                <img class="beforeImg" src="/img/before.jpg" alt="">
                <img class="currentImg" src="/img/product_top.jpg" alt="">
                <img class="afterImg" src="/img/after.jpg" alt="">
            </div> -->
            
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
                    <?= product_list($rec); ?>
                    </div>
                </div>
            </section>



            <section class="top_main_content">
                <div class="top_news_container">
                    <h2 class="top_main_title">News</h2>
                    <div class="top_news_items">

                        <div class="top_news_item">
                            <img src="/img/product_example.png" alt="">
                            <div class="top_news_item_content">
                                <h3 class="top_news_title">ブログをはじめました。</h3>
                                <div class="top_news_text">
                                    <p> こんにちは。美味しいスイーツを作っています。</p>
                                    <p>旬のフルーツを使ったタルトやクリスマスなどのイベント時期限定の新作スイーツを発売しています。</p>
                                    <p>ぜひ、よろしくおねがいします。</p>
                                    <p>毎週水曜日に更新予定です。</p>
                                </div>
                            </div>
                        </div>

                        <div class="top_news_item">
                            <img src="/img/product_example.png" alt="">
                            <div class="top_news_item_content">
                                <h3 class="top_news_title">ブログをはじめました。</h3>
                                <div class="top_news_text">
                                    <p> こんにちは。美味しいスイーツを作っています。</p>
                                    <p>旬のフルーツを使ったタルトやクリスマスなどのイベント時期限定の新作スイーツを発売しています。</p>
                                    <p>ぜひ、よろしくおねがいします。</p>
                                    <p>毎週水曜日に更新予定です。</p>
                                </div>
                            </div>
                        </div>

                        <div class="top_news_item">
                            <img src="/img/product_example.png" alt="">
                            <div class="top_news_item_content">
                                <h3 class="top_news_title">ブログをはじめました。</h3>
                                <div class="top_news_text">
                                    <p> こんにちは。美味しいスイーツを作っています。</p>
                                    <p>旬のフルーツを使ったタルトやクリスマスなどのイベント時期限定の新作スイーツを発売しています。</p>
                                    <p>ぜひ、よろしくおねがいします。</p>
                                    <p>毎週水曜日に更新予定です。</p>
                                </div>
                            </div>
                        </div>

                        <div class="top_news_item">
                            <img src="/img/product_example.png" alt="">
                            <div class="top_news_item_content">
                                <h3 class="top_news_title">ブログをはじめました。</h3>
                                <div class="top_news_text">
                                    <p> こんにちは。美味しいスイーツを作っています。</p>
                                    <p>旬のフルーツを使ったタルトやクリスマスなどのイベント時期限定の新作スイーツを発売しています。</p>
                                    <p>ぜひ、よろしくおねがいします。</p>
                                    <p>毎週水曜日に更新予定です。</p>
                                </div>
                            </div>
                        </div>
                        

                        
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