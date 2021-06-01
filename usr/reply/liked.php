<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/webInit.php';
?>

<?php

loginCheck();

$articleId = getIntValueOr($_GET['articleId'], 0);
if($articleId == 0){
    jsHistoryBackExit('게시물이 존재하지 않습니다.');
}

$memberId = getIntValueOr($_GET['memberId'], 0);
if($memberId == 0){
    jsHistoryBackExit('댓글 작성자가 존재하지 않습니다.');
}

$replyId = getIntValueOr($_GET['replyId'], 0);
if($replyId == 0){
    jsHistoryBackExit('댓글이 존재하지 않습니다.');
}

$digitalCode = getIntValueOr($_GET['digitalCode'], 3);
if($digitalCode == 3){
    jsHistoryBackExit('잘못된 접근입니다.');
}






$sqlReplyChangeHeart = "
UPDATE replyLiked
SET digitalCode = ${digitalCode}
WHERE memberId = ${memberId}
AND articleId = ${articleId}
AND replyId = ${replyId}
"; 

DB__update($sqlReplyChangeHeart);


    if($digitalCode == 1){

        
        $sqlAddReplyLiked = "
        UPDATE reply
        SET liked = liked + 1
        WHERE id = ${replyId};
        ";    
        
        mysqli_query($dbConn, $sqlAddReplyLiked);
        
        jsLocationReplaceExit("/usr/article/detail.php?id=${articleId}", "좋아요를 눌렀습니다.");
        
        
        
      }else { 

        
        $sqlRemoveReplyLiked = "
        UPDATE reply
        SET liked = liked - 1
        WHERE id = ${replyId};
        ";    
        
        mysqli_query($dbConn, $sqlRemoveReplyLiked);

        jsLocationReplaceExit("/usr/article/detail.php?id=${articleId}", "좋아요를 취소했습니다.");
            
        


    } ?>
