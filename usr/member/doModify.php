<?php 
require_once $_SERVER['DOCUMENT_ROOT']. '/webInit.php';
?>

<?php

loginCheck();
$memberId = $_SESSION['loginedMemberId'];





$loginPw = getStrValueOr($_GET['loginPw'], "");
if(empty($loginPw)){
    jsHistoryBackExit("로그인 비밀번호를 입력해주세요.");
}

$loginPwConfirm = getStrValueOr($_GET['loginPwConfirm'], "");
if(empty($loginPwConfirm)){
    jsHistoryBackExit("로그인 비밀번호를 한 번 더 입력해주세요.");
}



$name = getStrValueOr($_GET['name'], "");
if(empty($name)){
    jsHistoryBackExit("이름을 입력해주세요.");
}

$nickname = getStrValueOr($_GET['nickname'], "");
if(empty($nickname)){
    jsHistoryBackExit("닉네임을 입력해주세요.");
}

$cellphoneNo = getStrValueOr($_GET['cellphoneNo'], "");
if(empty($cellphoneNo)){
    jsHistoryBackExit("핸드폰 번호를 입력해주세요.");
}

$email = getStrValueOr($_GET['email'], "");
if(empty($email)){
    jsHistoryBackExit("이메일을 입력해주세요.");
}

if($loginPw != $loginPwConfirm){
    jsHistoryBackExit("입력하신 두 비밀번호가 일치하지 않습니다.");
}

$sqlModifyMember = "
UPDATE `member`
SET delStatus = delStatus,
regDate = regDate,
updateDate = NOW(),
loginId = loginId,
loginPw = '${loginPw}',
`name` = '${name}',
nickname = '${nickname}',
cellphoneNo = '${cellphoneNo}',
email = '${email}'
WHERE id = ${memberId};
";

DB__update($sqlModifyMember);

jsLocationReplaceExit("/usr/member/user.php", "${nickname}님의 회원정보가 수정되었습니다.");
?>
    