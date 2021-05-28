<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if(!isset($_GET['id'])){
    echo "게시판이 존재하지 않습니다.";
    exit;
}



$boardId = $_GET['id'];



$sqlGetBoard = "
SELECT * FROM board
WHERE id = ${boardId};
";

$board = DB__getRow($sqlGetBoard);

$memberId = $board['memberId'];

$sqlGetMember = "
SELECT * FROM `member`
WHERE id = ${memberId};
";

$member = DB__getRow($sqlGetMember);


if($board == null){
    echo "게시판이 존재하지 않습니다.";
    exit;
}

?>

<?php 
$loginPage = true;
$pageTitle = "[${board['name']}] 게시판 상세 보기";
?> 

<?php  
require_once __DIR__ . '/../head.php';
?>

<div>
게시판 번호: <?=$board['id']?><br>
게시판 이름: <?=$board['name']?><br>
게시판 코드: <?=$board['code']?><br>
게시판 주인: <?=$member['nickname']?><br>
</div>
<hr>
<div>
<span><a href="modify.php?id=<?=$boardId?>">수정하기</a></span>
<span><a class="delete" onclick="if(!confirm('이 게시판을 삭제하시겠습니까?')){return false}" href="doDelete.php?id=<?=$boardId?>">삭제하기</a></span>
</div>




<?php  
require_once __DIR__ . '/../foot.php';
?>
