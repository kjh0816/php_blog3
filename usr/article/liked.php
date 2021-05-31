<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/webInit.php';
?>

<?php
loginCheck();

$articleId = $_GET['articleId'];
$memberId = $_GET['memberId'];
$digitalCode = $_GET['digitalCode'];


$sqlChangeHeart = "
UPDATE articleLiked
SET digitalCode = ${digitalCode}
WHERE memberId = ${memberId}
AND articleId = ${articleId};
"; 

DB__update($sqlChangeHeart);
?>
<script>
    <?php if($digitalCode == 1){?>

        <?php
        $sqlAddLiked = "
        UPDATE article
        SET liked = liked + 1
        WHERE id = ${articleId};
        ";    
        
        mysqli_query($dbConn, $sqlAddLiked);
            
        ?>
        
        alert('좋아요를 눌렀습니다.');
        location.replace('detail.php?id=<?=$articleId?>')
    <?php }else { ?>

        <?php
        $sqlRemoveLiked = "
        UPDATE article
        SET liked = liked - 1
        WHERE id = ${articleId};
        ";    
        
        mysqli_query($dbConn, $sqlRemoveLiked);
            
        ?>

        alert('좋아요를 취소했습니다.');
        location.replace('detail.php?id=<?=$articleId?>')
    <?php } ?>
</script>