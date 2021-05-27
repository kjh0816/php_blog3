<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';


if(!isset($_GET['id'])){
    echo "id를 입력해주세요.";
    exit;
}

$id = intval($_GET['id']);

$sql = "
SELECT * FROM article
WHERE id = ${id};
";

$article = DB__getRow($sql);

if($article == null){
    echo "${id}번 게시물은 존재하지 않습니다.";
    exit;
}

?>

<?php $pageTitle = "${id}번 게시물 상세페이지";
?>
<hr>
<?php require_once __DIR__ . "/../head.php";   
?>
<div><a href="list.php">게시물 리스트</a></div>

<hr>
<div>
    번호 : <?=$article['id']?><br>
    제목 : <?=$article['title']?><br>
    작성날짜 : <?=$article['regDate']?><br>
    수정날짜 : <?=$article['updateDate']?><br>
    내용 : <?=$article['body']?><br>
</div>
<hr>

<div>
<a href="modify.php?id=<?=$id?>">수정하기</a>
<a onClick="if(!confirm('이 게시물을 삭제하시겠습니까?')){return false}" href="doDelete.php?id=<?=$id?>">삭제하기</a>
</div>
<?php require_once __DIR__ . "/../foot.php";   
?>