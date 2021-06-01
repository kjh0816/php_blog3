<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

loginCheck();
$memberId = $_SESSION['loginedMemberId'];

$boardId = getIntValueOr($_GET['boardId'], 0);
if($boardId == 0){
    jsHistoryBackExit("게시판을 선택해주세요.");
}



$title = getStrValueOr($_GET['title'], "");
if(empty($title)){
    jsHistoryBackExit("제목(title)을 입력해주세요.");
}


$body = getStrValueOr($_GET['body'], "");
if(empty($body)){
    jsHistoryBackExit("내용(body)을 입력해주세요.");
}




$sql = "
INSERT INTO article
SET regDate = NOW(),
updateDate = NOW(),
memberId = ${memberId},
boardId = ${boardId},
title = '${title}',
`body` = '${body}';
";

$articleId = DB__insert($sql);

jsLocationReplaceExit("/usr/article/detail?id=${articleId}", "${articleId}번 게시물이 추가되었습니다.");

?>

