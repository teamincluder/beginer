<?php
    // 何をもってログアウトになるか？
    // ログアウトとは、ログイン状態ではなくす行為
    //
    // 1. サーバ側をクリーンにする
    //      $_SESSION を破棄する
    // 2. クライアント側をクリーンにする
    //      セッションID の Cookie を破棄する

    session_start();

    // セッションを破棄する
    session_destroy();

    // セッション Cookie を破棄する
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"],   $params["domain"],
        $params["secure"], $params["httponly"]
    );

header('Location: login.php');
