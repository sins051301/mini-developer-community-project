<?php
// 세션 시작
session_start();

// 세션 데이터 모두 삭제
$_SESSION = array();

// 쿠키에 저장된 세션 ID 삭제
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 세션 삭제
session_destroy();

// 로그아웃 후 리다이렉트
header("Location:../pages/login/LoginPage.php");
exit;
?>