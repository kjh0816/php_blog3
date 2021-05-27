<?php 

// member 관련 변수 입력 여부 확인(시작)
require_once $_SERVER['DOCUMENT_ROOT'].'/webInit.php';

if(!isset($_GET['loginId'])){
    echo "로그인 아이디를 입력해주세요.";
    exit;
}

$loginId = $_GET['loginId'];

if(!isset($_GET['loginPw'])){
    echo "로그인 비밀번호를 입력해주세요.";
    exit;
}

$loginPw = $_GET['loginPw'];

if(!isset($_GET['loginPwConfirm'])){
    echo "로그인 비밀번호를 한번 더 입력해주세요.";
    exit;
}

$loginPwConfirm = $_GET['loginPwConfirm'];



if(!isset($_GET['name'])){
    echo "이름을 입력해주세요.";
    exit;
}

$name = $_GET['name'];

if(!isset($_GET['nickname'])){
    echo "닉네임을 입력해주세요.";
    exit;
}

$nickname = $_GET['nickname'];

if(!isset($_GET['cellphoneNo'])){
    echo "핸드폰 번호를 입력해주세요.";
    exit;
}

$cellphoneNo = $_GET['cellphoneNo'];

if(!isset($_GET['email'])){
    echo "이메일을 입력해주세요.";
    exit;
}

$email = $_GET['email'];
// member 관련 변수 입력 여부 확인(끝)

// member 관련 변수 입력 여부 확인(시작)

$sqlGetMember = "
SELECT * FROM `member`
WHERE loginId = '${loginId}';
";

$member = DB__getRow($sqlGetMember);
if($member != null){
    echo "${loginId}는(은) 이미 존재하는 로그인 아이디입니다.";
    exit;
}

$sqlGetMemberByEmailName = "
SELECT * FROM `member`
WHERE `name` = '${name}'
AND email = '${email}';
";

$memberByEmailName = DB__getRow($sqlGetMemberByEmailName);
if($memberByEmailName !=  null){
    echo "이미 동일한 이름과 이메일로 가입한 계정이 존재합니다.";
    exit;
}

if($loginPw != $loginPwConfirm){
    echo "입력하신 두 비밀번호가 다릅니다.";
    exit;
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

?>

<script>
alert('<?=$nickname?>님의 회원가입이 완료되었습니다.');
location.replace('login.php');
</script>


