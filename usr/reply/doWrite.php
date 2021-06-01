<?php 
require_once $_SERVER['DOCUMENT_ROOT']. '/webInit.php';
?>


<?php

loginCheck();
$memberId = $_SESSION['loginedMemberId'];

$relId = getIntValueOr($_GET['relId'], 0);
if($relId == 0){
    jsHistoryBackExit('게시물이 존재하지 않습니다.');
}

$body = getStrValueOr($_GET['body'], "");
if(empty($body)){
    jsHistoryBackExit('댓글을 입력해주세요.');
}


$sqlWriteReply = "
INSERT INTO reply
SET regDate = NOW(),
updateDate = NOW(),
memberId = ${memberId},
relTypeCode = 'article',
relId = ${relId},
liked = 0,
`body` = ${body} 
";

$replyId = DB__insert($sqlWriteReply);

jsLocationReplaceExit("/usr/article/detail.php?id=${relId}", "댓글이 등록되었습니다.");
?>




