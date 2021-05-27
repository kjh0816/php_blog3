<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';


if(!isset($_SESSION['loginedMemberId'])){
    echo "로그인이 필요합니다.";
    exit;
}

$memberId = $_SESSION['loginedMemberId'];

$sqlGetMember = "
SELECT * FROM `member`
WHERE id = ${memberId};
";

$member = DB__getRow($sqlGetMember);



?>



<?php $pageTitle = "내 정보"?>
<?php require_once __DIR__ . '/../head.php'?>
<div><a href="../article/list.php">게시물 리스트</a></div>
<hr>
<div>
이름 : <?=$member['name']?><br>
별명 : <?=$member['nickname']?><br>
핸드폰 번호 : <?=$member['cellphoneNo']?><br>
이메일 : <?=$member['email']?>
</div>
<hr>
<div>
<a href="modify.php">정보 수정</a>
<a class ="delete" href="doQuit.php" onclick="if(!confirm('정말 탈퇴하시겠습니까?')){return false}">회원 탈퇴</a>
</div>


<?php require_once __DIR__ . '/../foot.php'?>