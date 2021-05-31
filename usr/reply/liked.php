<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/webInit.php';
?>

<?php

loginCheck();

if(!isset($_GET['articleId'])){
    jsHistoryBackExit('게시물이 존재하지 않습니다.');
}

if(!isset($_GET['memberId'])){
    jsHistoryBackExit('댓글 작성자가 존재하지 않습니다.');
}

if(!isset($_GET['replyId'])){
    jsHistoryBackExit('댓글이 존재하지 않습니다.');
}

if(!isset($_GET['digitalCode'])){
    jsHistoryBackExit('잘못된 접근입니다.');
}

$articleId = $_GET['articleId'];
$memberId = $_GET['memberId'];
$replyId = $_GET['replyId'];
$digitalCode = $_GET['digitalCode'];




$sqlReplyChangeHeart = "
UPDATE replyLiked
SET digitalCode = ${digitalCode}
WHERE memberId = ${memberId}
AND articleId = ${articleId}
AND replyId = ${replyId}
"; 

DB__update($sqlReplyChangeHeart);
?>
<script>
    <?php if($digitalCode == 1){?>

        <?php
        $sqlAddReplyLiked = "
        UPDATE reply
        SET liked = liked + 1
        WHERE id = ${replyId};
        ";    
        
        mysqli_query($dbConn, $sqlAddReplyLiked);
            
        ?>
        
        alert('좋아요를 눌렀습니다.');
        location.replace('/usr/article/detail.php?id=<?=$articleId?>')
    <?php }else { ?>

        <?php
        $sqlRemoveReplyLiked = "
        UPDATE reply
        SET liked = liked - 1
        WHERE id = ${replyId};
        ";    
        
        mysqli_query($dbConn, $sqlRemoveReplyLiked);
            
        ?>

        alert('좋아요를 취소했습니다.');
        location.replace('/usr/article/detail.php?id=<?=$articleId?>')
    <?php } ?>
</script>