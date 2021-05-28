<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';



// 최신순 정렬
$sql = "
SELECT * FROM article
ORDER BY id DESC;
";


$articles = DB__getRows($sql);




?>
<?php 
$loginPage = true;
$pageTitle = "게시물 리스트";
?>
<?php require_once __DIR__ . "/../head.php"; ?>
<div>
  <a href="write.php">글 작성</a>
</div>
<hr>
<?php foreach($articles as $article){?>
    <?php

    $sqlGetMemberById = "
    SELECT * FROM member
    WHERE id = ${article['memberId']};
    ";
    
    $sqlGetBoardById = "
    SELECT * FROM board
    WHERE id = ${article['boardId']};
    ";
    
    
    $member = DB__getRow($sqlGetMemberById);
    $board = DB__getRow($sqlGetBoardById);

    $articleDetailUri = "detail.php?id=${article['id']}"
    
    ?>
    
    <div>
    번호 : <?=$article['id']?><br>
    게시판 : <?=$board['name']?><br>
    <a href="<?=$articleDetailUri?>">제목 : <?=$article['title']?></a><br>   
    작성날짜 : <?=$article['regDate']?><br>
    작성자 : <?=$member['nickname']?>
    </div>
    
    <hr>
<?php } ?>
<?php require_once __DIR__ . "/../foot.php"; ?>