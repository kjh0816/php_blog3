<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . "/webInit.php";



$loginId = mysqli_real_escape_string($dbConn, $_POST['loginId']);
if(empty($loginId)){
    jsHistoryBackExit("로그인 아이디를 입력해주세요.");
}

$loginPw = mysqli_real_escape_string($dbConn, $_POST['loginPw']);
if(empty($loginPw)){
    jsHistoryBackExit("로그인 비밀번호를 입력해주세요.");
}
echo $loginId;
echo $loginPw;
exit;


$sql = "
SELECT * FROM `member`
WHERE loginId = '$loginId'
AND delStatus = 0;
";


$member = DB__getRow($sql);
if(empty($member)){
    jsHistoryBackExit("존재하지 않는 회원입니다.");
}

if($member['loginPw'] != $loginPw){
    jsHistoryBackExit("비밀번호가 일치하지 않습니다.");
}


$_SESSION['loginedMemberId'] = $member['id'];

jsLocationReplaceExit("/usr/member/userHome.php", "${member['nickname']}님, 환영합니다.");
?>

