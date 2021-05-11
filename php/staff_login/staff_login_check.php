<?php

require_once '../others/common.php';
require_once '../others/db_connect.php';

try {
    
    $staff_code = filter_input(INPUT_POST, 'code');
    $staff_pass = filter_input(INPUT_POST, 'pass');
    
    if ($staff_code !== null && !$staff_pass !== null) {
        $post = sanitize($_POST);
        $staff_code = sanitize($_POST)['code'];
        $staff_pass = sanitize($_POST)['pass'];
        // $staff_code = $post['code'];
        // $staff_pass = $post['pass'];
    } else {
        echo '不正アクセスです。<br>';
        echo '<a href="staff_login.html" value="戻る">ログイン</a>';
        exit();
    }

    // $staff_pass = md5($staff_pass);

    $dbh = db_connect();


    $sql = 'SELECT name FROM staff WHERE code=? AND pass=?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, (int)$staff_code, PDO::PARAM_INT);
    $stmt->bindValue(2, (string)$staff_pass, PDO::PARAM_STR);
    $stmt->execute();
    
    $dbh = null;

    $rec = $stmt->fetch();
    
    if ($rec == false) {
        echo 'スタッフコードが間違っています。<br>';
        echo '<a href="staff_login.html" value="戻る">ログイン画面へ</a>';
    } else {
        $staff_name = $rec['name'];
        session_start();
        $_SESSION['login'] = 1;
        $_SESSION['staff_code'] = $staff_code;
        $_SESSION['staff_pass'] = $staff_pass;
        $_SESSION['staff_name'] = $staff_name;

        header('Location: staff_top.php');
        exit();
    }

} catch (Exception $e) {
    echo $e->getFile(), '/', $e->getLine(), ':', $e->getMessage();
    exit();
}

?>