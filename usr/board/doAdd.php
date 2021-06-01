<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
?>

<?php

loginCheck();
$memberId = $_SESSION['loginedMemberId'];



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


$sqlAddBoard = "
INSERT INTO board
SET regDate = NOW(),
updateDate = NOW(),
memberId = ${memberId},
`name` = '${name}',
`code` = '${code}';
";

$boardId = DB__insert($sqlAddBoard);

jsLocationReplaceExit("/usr/board/detail?id=${boardId}", "${boardId}번 게시판이 추가되었습니다.");
?>

