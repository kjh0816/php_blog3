<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';



if(isset($_SESSION['loginedMemberId'])){
    echo "잘못된 접근입니다.";
    exit;
}

$loginPage = false;
$pageTitle = "로그인";
?>

<?php require_once __DIR__ . "/../head.php"; ?>


<!-- <script>
function checkid(){
	document.getElementById("uid");
    
        alert('클릭됨');
    
	}
</script> -->

<form action="doLogin.php" method="get">
    <div>
    <span>로그인 아이디</span>
    <input required placeholder=" 로그인 아이디 입력" type="text" name="loginId" id="uid">
    <!-- <input type="button" onclick="" value="중복 확인"> -->
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