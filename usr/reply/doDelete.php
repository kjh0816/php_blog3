<?php 
require_once $_SERVER['DOCUMENT_ROOT']. '/webInit.php';

loginCheck();

if(!isset($_GET['id'])){
    jsHistoryBackExit('댓글이 존재하지 않습니다.');
}



$replyId = $_GET['id'];



$sqlGetReply = "
SELECT * FROM reply
WHERE id = $replyId
";


$reply = DB__getRow($sqlGetReply);
if($reply == null){
    jsHistoryBackExit('댓글이 존재하지 않습니다.');
}

if($_SESSION['loginedMemberId'] == $reply['memberId'] || $_SESSION['loginedMemberId'] == 1){
    
    $sqlDeleteReply = "
    DELETE FROM reply
    WHERE id = $replyId
    ";

    DB__delete($sqlDeleteReply);

    if($_SESSION['loginedMemberId'] == 1){
        jsHistoryBackExit('관리자 권한으로 댓글을 삭제했습니다.');
        
    }else{
        jsHistoryBackExit('댓글을 삭제했습니다.');
    }

}else{
    jsHistoryBackExit('권한이 없습니다.');
}

?>