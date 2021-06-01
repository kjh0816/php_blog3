<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

loginCheck();
$memberId = $_SESSION['loginedMemberId'];

$sqlGetMemberById = "
SELECT * FROM `member`
WHERE id = ${memberId};
";

$member = DB__getRow($sqlGetMemberById);





$loginPw = getStrValueOr($_GET['loginPw'], "");
if(empty($loginPw)){
    jsHistoryBackExit("로그인 비밀번호를 입력해주세요.");
}


$loginPw = $_GET['loginPw'];

if($member['loginPw'] != $loginPw){
    jsHistoryBackExit("비밀번호가 일치하지 않습니다.");

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

jsLocationReplaceExit("/usr/member/login.php", "회원탈퇴 되었습니다.");
?>


