<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

?>
<?php if(!isset($_SESSION['loginedMemberId'])){ ?>
    <script>
    alert('로그인 후 이용해주세요.');
    location.replace('../member/login.php');
    </script>
    
<?php }?>
<?php

if(!isset($_GET['id'])){
    echo "id를 입력해주세요.";
    exit;
}

$id = $_GET['id'];

$sqlGetArticle = "
SELECT * FROM article
WHERE id = ${id};
";

$article = DB__getRow($sqlGetArticle);
if($article == null){
    echo "${id}번 게시물이 존재하지 않습니다.";
    exit;
}

$sqlDeleteArticle = "
DELETE FROM article
WHERE id = ${id};
";
?>

 
 <?php if($_SESSION['loginedMemberId'] == 1){ ?>

    <?php DB__delete($sqlDeleteArticle); ?>

    <script>
    alert('<?=$id?>번 게시물이 관리자 권한으로 삭제되었습니다.')
    location.replace('list.php');
    </script>


<?php }else {?>

<?php if($article['memberId'] != $_SESSION['loginedMemberId']){ ?>

        <script>
        alert('권한이 없습니다.');
        location.replace('detail.php?id=<?=$id?>');
        </script>
        

    <?php }else{ ?>
        <?php DB__delete($sqlDeleteArticle); ?>
        <script>
        alert('<?=$id?>번 게시물이 삭제되었습니다.');
        location.replace('list.php');
        </script>

    <?php }?>
<?php } ?>







