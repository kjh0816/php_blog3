<?php 
require_once $_SERVER['DOCUMENT_ROOT']. '/webInit.php';

loginCheck();

if(!isset($_GET['id'])){
    jsHistoryBackExit('댓글이 존재하지 않습니다.');
}


if(!isset($_GET['body'])){
    jsHistoryBackExit('수정할 댓글을 적어주세요.');
}

$replyId = $_GET['id'];
$body = $_GET['body'];




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