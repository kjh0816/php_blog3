<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
?>

<?php

loginCheck();

$articleId = getIntValueOr($_GET['id'], 0);
if($articleId == 0){
    jsHistoryBackExit("번호(id)를 입력해주세요.");
}

$sqlGetArticle = "
SELECT * FROM article
WHERE id = ${articleId};
";

$article = DB__getRow($sqlGetArticle);
if($article == null){
    jsHistoryBackExit("${articleId}번 게시물이 존재하지 않습니다.");
}

$sqlDeleteArticle = "
DELETE FROM article
WHERE id = ${articleId};
";
?>

 
 <?php if($_SESSION['loginedMemberId'] == 1){ ?>

    <?php DB__delete($sqlDeleteArticle); ?>

    <script>
    alert('<?=$id?>번 게시물이 관리자 권한으로 삭제되었습니다.')
    location.replace('list.php');
    </script>


<?php }else {?>

<?php if($article['memberId'] != $_SESSION['loginedMemberId']){ 

         
        jsHistoryBackExit("권한이 없습니다.");
        

     }else{ ?>
        
        여기부터 하면 됨
        
        <?php DB__delete($sqlDeleteArticle); ?>
        <script>
        alert('<?=$id?>번 게시물이 삭제되었습니다.');
        location.replace('list.php');
        </script>

    <?php }?>
<?php } ?>







