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

$sqlDeleteArticle = "
DELETE FROM article
WHERE id = ${id};
";

DB__delete($sqlDeleteArticle);
?>
<script>
alert('<?=$id?>번 게시물이 삭제되었습니다.');
location.replace('list.php');
</script>

