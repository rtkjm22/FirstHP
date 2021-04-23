<?php
    session_start();
    $_SESSION = array();
    if (isset($_COOKIE['session_name']) === true) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>staff_logout.php</title>
</head>
<body>

    <p>ログアウトしました。</p>
    <br>
    <a href="staff_login.html">ログイン画面へ</a>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"> </script>
</body>
</html>