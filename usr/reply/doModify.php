<?php 
require_once $_SERVER['DOCUMENT_ROOT']. '/webInit.php';

loginCheck();

$replyId = getIntValueOr($_GET['id'], 0);
if($replyId == 0){
    jsHistoryBackExit('댓글이 존재하지 않습니다.');
}


$body = getStrValueOr($_GET['body'], "");
if(empty($body)){
    jsHistoryBackExit('수정할 댓글을 입력해주세요.');
}






$sqlGetReply = "
SELECT * FROM reply
WHERE id = $replyId
";

$reply = DB__getRow($sqlGetReply);
if($reply == null){
    jsHistoryBackExit('댓글이 존재하지 않습니다.');
}

if($_SESSION['loginedMemberId'] == $reply['memberId']){
    
    $sqlModifyReply = "
    UPDATE reply
    SET `body` = $body
    WHERE id = $replyId
    ";

    DB__update($sqlModifyReply);

    
    jsHistoryBackExit('댓글을 수정했습니다.');
    
}else{
    jsHistoryBackExit('권한이 없습니다.');
}

?>