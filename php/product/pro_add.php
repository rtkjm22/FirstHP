<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>pro_add</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>

    <p>商品紹介</p>

    <br>

    <form action="pro_add_check.php" method="post" enctype="multipart/form-data">

        商品名を入力してください。<br>
        <input type="text" name="name" style="width: 200px;"><br>

        価格を入力してください。<br>
        <input type="text" name="price" style="width: 50px;"><br>

        画像を選んでください。<br>
        <input type="file" name="gazou" style="width: 400px;"><br>
        <br>

        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="ＯＫ">

    </form>


    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
    <script type="text/javascript" src="/js/main.js"> </script>
</body>

</html>