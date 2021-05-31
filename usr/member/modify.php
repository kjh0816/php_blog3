<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/webInit.php';
?>
<?php

loginCheck();

$memberId = $_SESSION['loginedMemberId'];

if(!isset($_GET['loginPw'])){
    echo "비밀번호를 입력해주세요.";
    exit;
}

$sqlGetMember = "
SELECT * FROM `member`
WHERE id = ${memberId};
";

$member = DB__getRow($sqlGetMember);

if($_GET['loginPw'] != $member['loginPw']){
    echo "비밀번호가 일치하지 않습니다.";
    exit;
}



?>
<?php 
$loginPage = false;
$pageTitle = "내 정보 수정";
?>

<?php require_once __DIR__ . '/../head.php';?>

<form action="doModify.php">
<input type="hidden" name="loginId" value="<?=$member['loginId']?>"><br>
로그인 비밀번호: <input required placeholder="로그인 비밀번호" type="password" name="loginPw"><br>
비밀번호 확인: <input required placeholder="로그인 비밀번호 재입력" type="password" name="loginPwConfirm"><br>
이름: <input required placeholder="이름" type="text" name="name"><br>   
닉네임: <input required placeholder="닉네임" type="text" name="nickname"><br>
핸드폰 번호: <input required placeholder="핸드폰 번호" type="text" name="cellphoneNo"><br>
이메일: <input required placeholder="이메일" type="text" name="email"><br>
<input type="submit" value="수정 완료"><br>
</form>


<?php require_once __DIR__ . '/../foot.php';?>