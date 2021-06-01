<?php 

// member 관련 변수 입력 여부 확인(시작)
require_once $_SERVER['DOCUMENT_ROOT'].'/webInit.php';


$loginId = getStrValueOr($_GET['loginId'], "");
if(empty($loginId)){
    jsHistoryBackExit("로그인 아이디를 입력해주세요.");
}

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


// member 관련 변수 입력 여부 확인(끝)

// member 관련 변수 입력 여부 확인(시작)

$sqlGetMember = "
SELECT * FROM `member`
WHERE loginId = '${loginId}';
";

$member = DB__getRow($sqlGetMember);
if($member != null){
    jsHistoryBackExit("${loginId}는(은) 이미 존재하는 로그인 아이디입니다.");
}

$sqlGetMemberByEmailName = "
SELECT * FROM `member`
WHERE `name` = '${name}'
AND email = '${email}';
";

$memberByEmailName = DB__getRow($sqlGetMemberByEmailName);
if($memberByEmailName !=  null){
    jsHistoryBackExit("이미 동일한 이름과 이메일로 가입한 계정이 존재합니다.");
}

if($loginPw != $loginPwConfirm){
    jsHistoryBackExit("입력하신 두 비밀번호가 다릅니다.");
}


$sqlJoinComplete = "
INSERT INTO `member`
SET delStatus = 0,
regDate = NOW(),
updateDate = NOW(),
loginId = '${loginId}',
loginPw = '${loginPw}',
name = '${name}',
nickname = '${nickname}',
cellphoneNo = '${cellphoneNo}',
email = '${email}';
";

$memberId = DB__insert($sqlJoinComplete);


jsLocationReplaceExit("/usr/member/login.php", "${nickname}님의 회원가입이 완료되었습니다.");
?>




