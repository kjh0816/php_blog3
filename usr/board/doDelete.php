<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

$memberId = $_SESSION['loginedMemberId'];
if($memberId == null){
    echo "로그인이 필요합니다.";
    exit;
}

if(!isset($_GET['id'])){
    echo "게시판이 존재하지 않습니다.";
    exit;
}


$boardId = $_GET['id'];



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
    echo "게시판이 존재하지 않습니다.";
    exit;
}


if($member['id'] != $board['memberId']){
    echo "권한이 없습니다.";
    exit;
}


$sqlDeleteBoard = "
DELETE FROM board
WHERE id = ${boardId};
";

DB__delete($sqlDeleteBoard);
?>
<script>
alert('<?=$boardId?>번 게시판이 삭제되었습니다.');
location.replace('../article/list.php');
</script>