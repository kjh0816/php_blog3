<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

# 로그아웃 후 이용 / 아이디 중복되면 안 됨

if(isset($_SESSION['loginedMemberId'])){
    echo "로그아웃 후 이용해주세요.";
    exit;
}

?>

<?php 
$loginPage = true;
$pageTitle = "회원가입";
?>

<?php require_once __DIR__ . '/../head.php'?>
<form action="doJoin.php">
로그인 아이디: <input required placeholder="로그인 아이디" type="text" name="loginId"><br>
로그인 비밀번호: <input required placeholder="로그인 비밀번호" type="password" name="loginPw"><br>
비밀번호 확인: <input required placeholder="로그인 비밀번호 재입력" type="password" name="loginPwConfirm"><br>
이름: <input required placeholder="이름" type="text" name="name"><br>   
닉네임: <input required placeholder="닉네임" type="text" name="nickname"><br>
핸드폰 번호: <input required placeholder="핸드폰 번호" type="text" name="cellphoneNo"><br>
이메일: <input required placeholder="이메일" type="text" name="email"><br>
<input type="submit" value="가입하기"><br>
</form>


<?php require_once __DIR__ . '/../foot.php'?>