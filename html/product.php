<?php

require_once('../php/others/db_connect.php');

try {

    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name,price,image FROM product WHERE 1';
    $stmt = $dbh->query($sql);
    $stmt->execute();

    $dbh = null;

    $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    function product_item ($i) {
        for ($j=0; $j < count($i); $j++) { 
            $link_index = $j + 1;
            $str = <<< "EOM"
            <div class="product_item">
                <a class="pro_link" href="product_item.php?code={$i[$j]['code']}"></a>
                <div class="product_thumbnail">
                    <img class="product_thumbnail_img" src="../img/{$i[$j]['image']}">
                </div>
                <div class="product_info">
                    <p class="product_info_name">{$i[$j]['name']}</p>
                    <p class="product_info_price">{$i[$j]['price']}円</p>
                </div>
            </div>
            EOM;
            echo $str;
        }
    }
    // href="product_item.php/?code=1


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
    <title>Document</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/product.css">
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
            <h1 class="top_title">Product</h1>
        </header>
    
    
    
        <div>
            <div class="scroll_top">TOP</div>
        </div>
    


        <main>
            <div id="product">
                <div class="product_wrap">
                    <div class="product_items">
                        <?=product_item($rec);?>
                        <?=product_item($rec);?>
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


    <script type="text/javascript" src="../js/main.js"> </script>
    <script type="text/javascript" src="../js/product.js"> </script>
</body>
</html>

