<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

$boardId = getIntValueOr($_GET['id'], 0);
if($boardId == 0){
    jsHistoryBackExit("게시판이 존재하지 않습니다.");
}



$sqlGetBoard = "
SELECT * FROM board
WHERE id = ${boardId};
";

$board = DB__getRow($sqlGetBoard);

if($board == null){
    jsHistoryBackExit("게시판이 존재하지 않습니다.");
}


$memberId = $board['memberId'];


$sqlGetMember = "
SELECT * FROM `member`
WHERE id = ${memberId};
";

$member = DB__getRow($sqlGetMember);




?>

<?php 
$loginPage = true;
$pageTitle = "[${board['name']}] 게시판 상세 보기";
?> 

<?php  
require_once __DIR__ . '/../head.php';
?>
<a href="/usr/board/list.php">게시판 리스트</a>
<hr>
<div>
게시판 번호: <?=$board['id']?><br>
게시판 이름: <?=$board['name']?><br>
게시판 코드: <?=$board['code']?><br>
게시판 주인: <?=$member['nickname']?><br>
게시판 생성일:<?=$board['regDate']?><br>
게시판 수정일:<?=$board['updateDate']?><br>
</div>
<hr>
<?php if($board['memberId'] == $_SESSION['loginedMemberId'] || $_SESSION['loginedMemberId'] == 1){?>
<div>
<span><a href="modify.php?id=<?=$boardId?>">수정하기</a></span>
<span><a class="delete" onclick="if(!confirm('이 게시판을 삭제하시겠습니까?')){return false}" href="doDelete.php?id=<?=$boardId?>">삭제하기</a></span>
</div>
<?php } ?>



<?php  
require_once __DIR__ . '/../foot.php';
?>
