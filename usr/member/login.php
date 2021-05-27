<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

$loginPage = false;
$pageTitle = "로그인";
?>

<?php require_once __DIR__ . "/../head.php"; ?>

<form action="doLogin.php">
    <div>
    <span>로그인 아이디</span>
    <input required placeholder=" 로그인 아이디 입력" type="text" name="loginId">
    </div>
    <div>
    <span>로그인 비밀번호</span>
    <input required placeholder="로그인 비밀번호 입력" type="password" name="loginPw">
    </div>
    <div>
    <input type="submit" value="로그인">
    </div>
</form>

<?php require_once __DIR__ . "/../foot.php"; ?>