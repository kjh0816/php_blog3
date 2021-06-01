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

$sqlGetBoard = "
SELECT * FROM board
WHERE id = ${boardId};
";

$board = DB__getRow($sqlGetBoard);

if($board['memberId'] != $memberId){
    jsHistoryBackExit("권한이 없습니다.");
}



$name = getStrValueOr($_GET['name'], "");
if(empty($name)){
    jsHistoryBackExit("게시판 이름을 입력해주세요.");
}


$code = getStrValueOr($_GET['code'], "");
if(empty($code)){
    jsHistoryBackExit("게시판 코드를 입력해주세요.");
}


$sqlGetBoardByName = "
SELECT * FROM board
WHERE name = '${name}';
";


$boardByName = DB__getRow($sqlGetBoardByName);
if($boardByName != null){
    jsHistoryBackExit("${name} 게시판이 이미 존재합니다.");
    
}

$sqlGetBoardByCode = "
SELECT * FROM board
WHERE code = '${code}';
";


$boardByCode = DB__getRow($sqlGetBoardByCode);
if($boardByCode != null){
    jsHistoryBackExit("${code} 게시판 코드가 이미 존재합니다.");
}

$sqlModifyBoard = "
UPDATE board
SET regDate = regDate,
updateDate = NOW(),
memberId = memberId,
`name` = '${name}',
`code` = '${code}'
WHERE id = ${boardId};
";

DB__update($sqlModifyBoard);

jsLocationReplaceExit("/usr/board/detail?id=${boardId}", "${boardId}번 게시판이 수정되었습니다.");
?>
