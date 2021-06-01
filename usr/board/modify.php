<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

?>

<?php

loginCheck();
$memberId = $_SESSION['loginedMemberId'];

$boardId = getIntValueOr($_GET['id'], 0);
if($boardId == 0){
    jsHistoryBackExit("게시판이 존재하지 않습니다.");
}



$sqlGetMember = "
SELECT * FROM `member`
WHERE id = ${memberId};
";

$member = DB__getRow($sqlGetMember);


$sqlGetBoard = "
SELECT * FROM board
WHERE id = ${boardId};
";

$board = DB__getRow($sqlGetBoard);

if($board == null){
    jsHistoryBackExit("게시판이 존재하지 않습니다.");
}


if($member['id'] != $board['memberId']){
    jsHistoryBackExit("권한이 없습니다.");
}

?>
<?php 
$loginPage = true;
$pageTitle = "게시판 수정";
require_once __DIR__. '/../head.php';
?>

<form action="doModify.php">
<input type="hidden" name="id" value=<?=$boardId?>>
게시판 이름: <input required placeholder="게시판 이름 입력" type="text" name="name"><br>
게시판 코드: <input required placeholder="게시판 코드 입력" type="text" name="code"><br>
<input type="submit" value="완료">
</form>



<?php 
require_once __DIR__. '/../foot.php';
?>