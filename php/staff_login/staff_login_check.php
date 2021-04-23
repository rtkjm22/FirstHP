<?php

require_once '../others/common.php';
require_once '../others/db_connect.php';

try {

    $staff_code = filter_input(INPUT_POST, 'code');
    $staff_pass = filter_input(INPUT_POST, 'pass');
    
    $post = sanitize($_POST);
    $staff_code = $post['code'];
    $staff_pass = $post['pass'];

    // $staff_pass = md5($staff_pass);

    $dbh = db_connect();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT name FROM staff WHERE code=? AND pass=?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, (int)$staff_code, PDO::PARAM_INT);
    $stmt->bindValue(2, (string)$staff_pass, PDO::PARAM_STR);
    $stmt->execute();
    
    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($rec == false) {
        echo 'スタッフコードは間違っています。<br>';
        echo '<a href="staff_login.html" value="戻る">ログイン画面へ</a>';
    } else {
        session_start();
        $_SESSION['login'] = 1;
        $_SESSION['staff_code'] = $staff_code;
        $_SESSION['staff_pass'] = $staff_pass;

        header('Location: staff_top.php');
        exit();
    }

} catch (Exception $e) {
    echo $e->getFile(), '/', $e->getLine(), ':', $e->getMessage();
    exit();
}

?>