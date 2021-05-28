<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
// DB 함수도 쓸 수 있고, 세션도 불러왔다.


// 최신순 정렬
$sql = "
SELECT * FROM article
ORDER BY id DESC;
";


$articles = DB__getRows($sql);

$loginPage = true;
$pageTitle = "게시물 리스트";

?>
<?php require_once __DIR__ . "/../head.php"; ?>
<div>
  <a href="../member/user.php">내 정보</a>
  <a href="write.php">글 작성</a>
</div>
<hr>
<?php foreach($articles as $article){?>
    <?php $articleDetailUri = "detail.php?id=${article['id']}"?>
    <a href="<?=$articleDetailUri?>">번호 : <?=$article['id']?></a><br>
    <div>
    작성날짜 : <?=$article['regDate']?><br>
    수정날짜 : <?=$article['updateDate']?><br>
    </div>
    <a href="<?=$articleDetailUri?>">제목 : <?=$article['title']?></a><br>
    <hr>
<?php } ?>
<?php require_once __DIR__ . "/../foot.php"; ?>