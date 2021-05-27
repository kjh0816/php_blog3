<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

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
?>
<?php $pageTitle = "${id}번 게시물 수정"?>
<?php require_once __DIR__ . '/../head.php'?>

<form action="doModify.php">
<input type="hidden" name="id" value="<?=$id?>">
<div>
<span>수정할 제목</span>
<input required placeholder="제목 입력" type="text" name="title">
</div>
<div>
<span>수정할 내용</span>
<textarea required placeholder="내용 입력" name="body"></textarea>
</div>
<input type="submit" value="완료">
</form>

<?php require_once __DIR__ . '/../foot.php'?>