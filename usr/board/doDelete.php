<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
?>

<?php

loginCheck();

if(!isset($_GET['id'])){
    echo "게시판이 존재하지 않습니다.";
    exit;
}


$boardId = $_GET['id'];




$sqlGetBoard = "
SELECT * FROM board
WHERE id = ${boardId};
";

$board = DB__getRow($sqlGetBoard);

if($board == null){
    echo "게시판이 존재하지 않습니다.";
    exit;
}





$sqlDeleteBoard = "
DELETE FROM board
WHERE id = ${boardId};
";


?>

<?php if($_SESSION['loginedMemberId'] == 1){ ?>

<?php DB__delete($sqlDeleteBoard); ?>

<script>
alert('<?=$boardId?>번 게시판이 관리자 권한으로 삭제되었습니다.');
location.replace('list.php');
</script>


<?php }else {?>

<?php if($board['memberId'] != $_SESSION['loginedMemberId']){ ?>

    <script>
    alert('권한이 없습니다.');
    location.replace('detail.php?id=<?=$boardId?>');
    </script>
    

<?php }else{ ?>
    <?php DB__delete($sqlDeleteArticle); ?>
    <script>
    alert('<?=$boardId?>번 게시판이 삭제되었습니다.');
    location.replace('list.php');
    </script>

<?php }?>
<?php } ?>