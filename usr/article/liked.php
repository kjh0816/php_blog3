<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/webInit.php';
?>

<?php

loginCheck();


$articleId = getIntValueOr($_GET['articleId'], 0);
if($articleId == 0){
    jsHistoryBackExit("게시물 번호(id)가 존재하지 않습니다.");
}

$memberId = getIntValueOr($_GET['memberId'], 0);
if($memberId == 0){
    jsHistoryBackExit("회원이 존재하지 않습니다.");
}

$digitalCode = getIntValueOr($_GET['digitalCode'], 3);
if($digitalCode == 3){
    jsHistoryBackExit("좋아요가 입력되지 않았습니다.");
}



$sqlChangeHeart = "
UPDATE articleLiked
SET digitalCode = ${digitalCode}
WHERE memberId = ${memberId}
AND articleId = ${articleId};
"; 

DB__update($sqlChangeHeart);
?>


    <?php if($digitalCode == 1){

        
        $sqlAddLiked = "
        UPDATE article
        SET liked = liked + 1
        WHERE id = ${articleId};
        ";    
        
        mysqli_query($dbConn, $sqlAddLiked);

        jsLocationReplaceExit("/usr/article/detail.php?id=${articleId}", "좋아요를 눌렀습니다.");
            
        

     }else { 

        
        $sqlRemoveLiked = "
        UPDATE article
        SET liked = liked - 1
        WHERE id = ${articleId};
        ";    
        
        mysqli_query($dbConn, $sqlRemoveLiked);

        jsLocationReplaceExit("/usr/article/detail.php?id=${articleId}", "좋아요를 취소했습니다.");
            
        

    }
    ?>
