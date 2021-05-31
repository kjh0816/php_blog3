<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

loginCheck();

$sqlGetMemberById = "
SELECT * FROM `member`
WHERE id = ${memberId};
";

$memberId = $_SESSION['loginedMemberId'];
$member = DB__getRow($sqlGetMemberById);

if(!isset($_GET['loginId'])){
    echo "존재하지 않는 로그인 아이디입니다.";
    exit;
}
$loginId = $_GET['loginId'];

if(!isset($_GET['loginPw'])){
    echo "비밀번호를 입력해주세요.";
    exit;
}
$loginPw = $_GET['loginPw'];

if($member['loginPw'] != $loginPw){
    echo "비밀번호가 일치하지 않습니다.";
    exit;

}

$sqlQuit = "
UPDATE `member`
SET delStatus = 1,
regDate = regDate,
updateDate = updateDate(),
loginId = loginId,
loginPw = loginPw,
name = name,
nickname = nickname,
cellphoneNo = cellphoneNo,
email = email;
WHERE id = ${memberId};
";

DB__update($sqlQuit);
unset($_SESSION['loginedMemberId']);


?>
<script>
    alert('회원탈퇴 되었습니다.');
    location.replace('login.php');
</script>

