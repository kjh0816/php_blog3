<?php 
require_once $_SERVER['DOCUMENT_ROOT']. '/webInit.php';

?>
<?php if(!isset($_SESSION['loginedMemberId'])){ ?>
    <script>
    alert('로그인 후 이용해주세요.');
    location.replace('../member/login.php');
    </script>
    
<?php }?>
<?php

$memberId = intval($_SESSION['loginedMemberId']);



if(!isset($_GET['loginPw'])){
    echo "비밀번호를 입력해주세요.";
    exit;
}

$loginPw = $_GET['loginPw'];

if(!isset($_GET['loginPwConfirm'])){
    echo "비밀번호를 입력해주세요.";
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

if($loginPw != $loginPwConfirm){
    echo "입력하신 두 비밀번호가 일치하지 않습니다.";
    exit;
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


?>
    <script>
    alert('<?=$nickname?>님의 정보가 수정되었습니다.');
    location.replace('user.php');
    </script>